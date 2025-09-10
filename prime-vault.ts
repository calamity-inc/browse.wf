import type { IPowersuit, IRecipe, IRelic, ISentinel, IWeapon, TMissionDeck } from "warframe-public-export-plus";

// common.js
declare let onLanguageUpdate: () => void;
declare function getDictPromise(): Promise<Record<string, string>>;

// fetch + derived
declare let dict: Record<string, string>;
//declare let ExportRelics: Record<string, IRelic>;
//declare let ExportRewards: Record<string, TMissionDeck>;
declare let ExportWeapons: Record<string, IWeapon>;
declare let ExportWarframes: Record<string, IPowersuit>;
declare let ExportSentinels: Record<string, ISentinel>;
declare let component_to_item: Record<string, string>;
declare let VarziaItems: Record<string, boolean>;
declare let MissionRewards: Record<string, boolean>;
declare let items: Record<string, TState>;

type TState = 0 | 1 | 2;
const STATE_VAULTED = 0;
const STATE_RESURGENCE = 1;
const STATE_INROTATION = 2;

Promise.all([
	getDictPromise(),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRelics.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRewards.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRecipes.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportWeapons.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportWarframes.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportSentinels.json").then(res => res.json()),
	fetch("https://raw.githubusercontent.com/calamity-inc/warframe-worldstate-history/senpai/worldState.json").then(res => res.json()),
	]).then(function([
		dict,
		ExportRelics,
		ExportRewards,
		ExportRecipes,
		ExportWeapons,
		ExportWarframes,
		ExportSentinels,
		worldState
	]: [
		Record<string, string>,
		Record<string, IRelic>,
		Record<string, TMissionDeck>,
		Record<string, IRecipe>,
		Record<string, IWeapon>,
		Record<string, IPowersuit>,
		Record<string, ISentinel>,
		any
	]): void
{
	(window as any).dict = dict;
	//(window as any).ExportRelics = ExportRelics;
	//(window as any).ExportRewards = ExportRewards;
	(window as any).ExportWeapons = ExportWeapons;
	(window as any).ExportWarframes = ExportWarframes;
	(window as any).ExportSentinels = ExportSentinels;

	console.time("build component_to_item");
	(window as any).component_to_item = {};
	for (const [type, recipe] of Object.entries(ExportRecipes as Record<string, IRecipe>))
	{
		component_to_item[type] = recipe.resultType;
		for (const ingredient of recipe.ingredients)
		{
			component_to_item[ingredient.ItemType] = recipe.resultType;
		}
	}
	console.timeEnd("build component_to_item");

	console.time("build VarziaItems");
	(window as any).VarziaItems = {};
	for (const offering of worldState.PrimeVaultTraders[0].Manifest)
	{
		VarziaItems[offering.ItemType.split("/Lotus/StoreItems/").join("/Lotus/")] = true;
	}
	console.timeEnd("build VarziaItems");

	console.time("build MissionRewards");
	(window as any).MissionRewards = {};
	for (const deck of Object.values(ExportRewards as Record<string, TMissionDeck>))
	{
		for (const tier of deck)
		{
			for (const reward of tier)
			{
				MissionRewards[reward.type.split("/Lotus/StoreItems/").join("/Lotus/")] = true;
			}
		}
	}
	console.timeEnd("build MissionRewards");

	console.time("build items");
	(window as any).items = {};
	for (const [type, relic] of Object.entries(ExportRelics as Record<string, IRelic>))
	{
		if (relic.quality == "VPQ_BRONZE" && relic.era != "Requiem")
		{
			const state = type in MissionRewards
							? STATE_INROTATION
							: type in VarziaItems
								? STATE_RESURGENCE
								: STATE_VAULTED
							;
			for (const reward of ExportRewards[relic.rewardManifest][0])
			{
				if (reward.type != "/Lotus/StoreItems/Types/Recipes/Components/FormaBlueprint")
				{
					const item = component_to_item[reward.type.split("/Lotus/StoreItems/").join("/Lotus/")];
					if (!items[item] || state > items[item])
					{
						items[item] = state;
					}
				}
			}
		}
	}
	console.timeEnd("build items");

	updateList();
	onLanguageUpdate = updateList;
});

function updateList(): void
{
	const state_to_elm: Record<TState, HTMLDivElement> = {
		[STATE_VAULTED]: document.getElementById("vaulted") as HTMLDivElement,
		[STATE_RESURGENCE]: document.getElementById("resurgence") as HTMLDivElement,
		[STATE_INROTATION]: document.getElementById("inrotation") as HTMLDivElement,
	};
	for (const div of Object.values(state_to_elm))
	{
		div.innerHTML = "";
	}
	let named_items = [];
	for (const [item, state] of Object.entries(items))
	{
		const name = dict[ExportWarframes[item]?.name] ?? dict[ExportWeapons[item]?.name] ?? dict[ExportSentinels[item]?.name];
		if (name)
		{
			named_items.push({
				key: item,
				name: name.split("<ARCHWING>").join("").trim(),
				state
			});
		}
		else
		{
			console.info("discarding", item);
		}
	}
	named_items = named_items.sort((a, b) => a.name.localeCompare(b.name));
	for (const item of named_items)
	{
		const li = document.createElement("li");
		li.textContent = item.name + " ";
		{
			const a = document.createElement("a");
			a.textContent = "(Wiki)";
			a.href = "https://wiki.warframe.com/w/" + encodeURIComponent(item.name);
			a.target = "_blank";
			li.appendChild(a);
		}
		{
			const span = document.createElement("span");
			span.textContent = " ";
			li.appendChild(span);
		}
		{
			const a = document.createElement("a");
			a.textContent = "(browse.wf)";
			a.href = "/#q=" + encodeURIComponent(item.key);
			a.target = "_blank";
			li.appendChild(a);
		}
		state_to_elm[item.state].appendChild(li);
	}
}
