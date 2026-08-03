import type { IAbility, IArcane, IAvionic, ICustom, IExportEnemies, IFlavourItem, IGear, IPowersuit, IRecipe, IRegion, IRelic, IResource, ISentinel, IUpgrade, IWeapon, TMissionDeck } from "warframe-public-export-plus";

interface IResult {
	type: string;
	key: string;
	value: any;
}

interface IRewardSource {
	name: string[];
	rotation?: number;
	itemCount: number;
	probability: number;
	probabilityWorstCase?: number;
}

// common.js
declare let onLanguageUpdate: () => void;
declare function getDictPromise(): Promise<Record<string, string>>;
declare function resolveTextIcons(text: string): string;
declare function setImageSource(img: HTMLImageElement, icon: string): void;

// fetch
declare const dict: Record<string, string>;
declare const ExportRegions: Record<string, IRegion>;
declare const ExportRelics: Record<string, IRelic>;
declare const ExportEnemies: IExportEnemies;
declare const supplementalGlyphData: Record<string, {
	promo_code?: string;
	twitch?: string;
	youtube?: string;
	discord?: string;
	twitter?: string;
	mixer?: string;
	"other-site"?: string;
	markdown?: string;
}>;
declare global {
	interface Window {
		dict: Record<string, string>;
		dict_entries: [string, string][];
		ExportWarframes_entries: [string, IPowersuit][];
		ExportWeapons_entries: [string, IWeapon][];
		ExportUpgrades_entries: [string, IUpgrade][];
		ExportArcanes_entries: [string, IArcane][];
		ExportAvionics_entries: [string, IAvionic][];
		ExportResources_entries: [string, IResource][];
		ExportFlavour_entries: [string, IFlavourItem][];
		ExportCustoms_entries: [string, ICustom][];
		ExportGear_entries: [string, IGear][];
		ExportSentinels_entries: [string, ISentinel][];
		ExportAbilities_entries: [string, IAbility][];
		ExportRewards_entries: [string, TMissionDeck][];
		meta_entries: {
			warframe: [string, IPowersuit][];
			weapon: [string, IWeapon][];
			upgrade: [string, IUpgrade][];
			arcane: [string, IArcane][];
			avionic: [string, IAvionic][];
			resource: [string, IResource][];
			flavour: [string, IFlavourItem][];
			custom: [string, ICustom][];
			gear: [string, IGear][];
			sentinel: [string, ISentinel][];
			ability: [string, IAbility][];
		};
		itemToRecipeMap: Record<string, string>;
		missionDeckNames: Record<string, string[]>;
		droptableNames: Record<string, string[]>;
	}
}

const params = new URLSearchParams(location.hash.replace("#", ""));
if (params.has("q"))
{
	(document.getElementById("query") as HTMLInputElement).value = params.get("q");
	document.getElementById("results-status").textContent = "Loading...";
}

(document.getElementById("query") as HTMLInputElement).oninput = function(this: HTMLInputElement)
{
	if (this.value == "")
	{
		history.replaceState({}, undefined, "/");
	}
	else
	{
		history.replaceState({}, undefined, "/#q=" + encodeURIComponent(this.value));
	}
	document.getElementById("results-status").textContent = "Sorry, data is still downloading. Your query will be processed ASAP.";
};

Promise.all([
	getDictPromise(),
	fetch("https://browse.wf/warframe-public-export-plus/ExportWarframes.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportWeapons.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportUpgrades.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportArcanes.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportAvionics.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportResources.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportFlavour.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportCustoms.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportGear.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportSentinels.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRewards.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRegions.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportEnemies.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRecipes.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportImages.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportTextIcons.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportRelics.json").then(res => res.json()),
	fetch("https://browse.wf/warframe-public-export-plus/ExportAbilities.json").then(res => res.json()),
	fetch("supplemental-data/glyphs.json").then(res => res.json())
	]).then(([
		dict,
		ExportWarframes,
		ExportWeapons,
		ExportUpgrades,
		ExportArcanes,
		ExportAvionics,
		ExportResources,
		ExportFlavour,
		ExportCustoms,
		ExportGear,
		ExportSentinels,
		ExportRewards,
		ExportRegions,
		ExportEnemies,
		ExportRecipes,
		ExportImages,
		ExportTextIcons,
		ExportRelics,
		ExportAbilities,
		supplementalGlyphData
	]) =>
{
	window.dict = dict;
	window.dict_entries = Object.entries(window.dict).sort(([key1, value1], [key2, value2]) => value1.length - value2.length);
	//(window as any).ExportWarframes = ExportWarframes;
	//(window as any).ExportWeapons = ExportWeapons;
	//(window as any).ExportUpgrades = ExportUpgrades;
	//(window as any).ExportArcanes = ExportArcanes;
	//(window as any).ExportResources = ExportResources;
	//(window as any).ExportFlavour = ExportFlavour;
	//(window as any).ExportCustoms = ExportCustoms;
	//(window as any).ExportGear = ExportGear;
	//(window as any).ExportSentinels = ExportSentinels;
	//(window as any).ExportRewards = ExportRewards;
	(window as any).ExportRegions = ExportRegions;
	(window as any).ExportEnemies = ExportEnemies;
	(window as any).ExportImages = ExportImages;
	(window as any).ExportTextIcons = ExportTextIcons;
	(window as any).ExportRelics = ExportRelics;
	//(window as any).ExportAbilities = ExportAbilities;
	(window as any).supplementalGlyphData = supplementalGlyphData;

	for (const suit of Object.values(ExportWarframes as Record<string, IPowersuit>))
	{
		for (const ability of suit.abilities)
		{
			ExportAbilities[ability.uniqueName] = ability;
			delete ability.uniqueName;
		}
	}

	window.ExportWarframes_entries = Object.entries(ExportWarframes as Record<string, IPowersuit>);
	window.ExportWeapons_entries = Object.entries(ExportWeapons as Record<string, IWeapon>).filter(([uniqueName, item]) => item.totalDamage != 0);
	window.ExportUpgrades_entries = Object.entries(ExportUpgrades as Record<string, IUpgrade>);
	window.ExportArcanes_entries = Object.entries(ExportArcanes as Record<string, IArcane>).filter(arr => !arr[1].excludeFromCodex); // Filter fixes result for Arcane Steadfast
	window.ExportAvionics_entries = Object.entries(ExportAvionics as Record<string, IAvionic>);
	window.ExportResources_entries = Object.entries(ExportResources as Record<string, IResource>);
	window.ExportFlavour_entries = Object.entries(ExportFlavour as Record<string, IFlavourItem>);
	window.ExportCustoms_entries = Object.entries(ExportCustoms as Record<string, ICustom>);
	window.ExportGear_entries = Object.entries(ExportGear as Record<string, IGear>);
	window.ExportSentinels_entries = Object.entries(ExportSentinels as Record<string, ISentinel>);
	window.ExportAbilities_entries = Object.entries(ExportAbilities as Record<string, IAbility>);

	window.ExportRewards_entries = Object.entries(ExportRewards as Record<string, TMissionDeck>);

	window.meta_entries = {
		warframe: window.ExportWarframes_entries,
		weapon: window.ExportWeapons_entries,
		upgrade: window.ExportUpgrades_entries,
		arcane: window.ExportArcanes_entries,
		avionic: window.ExportAvionics_entries,
		resource: window.ExportResources_entries,
		flavour: window.ExportFlavour_entries,
		custom: window.ExportCustoms_entries,
		gear: window.ExportGear_entries,
		sentinel: window.ExportSentinels_entries,
		ability: window.ExportAbilities_entries,
	};

	window.itemToRecipeMap = {};
	Object.entries(ExportRecipes as Record<string, IRecipe>).forEach(([uniqueName, recipe]) => {
		window.itemToRecipeMap[recipe.resultType] = uniqueName;
	});

	updateMissionDeckNames();

	if ((document.getElementById("query") as HTMLInputElement).value)
	{
		doQuery((document.getElementById("query") as HTMLInputElement).value);
	}

	document.getElementById("query").oninput = function(this: HTMLInputElement)
	{
		if (this.value == "")
		{
			history.replaceState({}, undefined, "/");
			document.getElementById("results-status").textContent = "It's like a search engine, but for space ninjas.";
			document.getElementById("results").innerHTML = "";
		}
		else
		{
			history.replaceState({}, undefined, "/#q=" + encodeURIComponent(this.value));
			doQuery(this.value);
		}
	};

	onLanguageUpdate = function()
	{
		window.dict_entries = Object.entries(window.dict).sort(([key1, value1], [key2, value2]) => value1.length - value2.length);

		updateMissionDeckNames();

		const params = new URLSearchParams(location.hash.replace("#", ""));
		if (params.has("q"))
		{
			doQuery(params.get("q"));
		}
	};
});

function updateMissionDeckNames(): void
{
	window.missionDeckNames = {
		"/Lotus/Types/Game/MissionDecks/SortieRewards": ["Sortie"],
		"/Lotus/Types/Game/MissionDecks/ArchonSortieRewards": ["Archon Hunt"],
		"/Lotus/Types/Game/MissionDecks/EntratiMissionRewards/EntratiVaultRewards": ["Netracells"],
		"/Lotus/Types/Game/MissionDecks/EntratiLabConquestRewards/EntratiLabConquestArcaneRewards": ["Deep Archimedea Arcane Rewards"],
		"/Lotus/Types/Game/MissionDecks/EntratiLabConquestRewards/EntratiLabConquestGoldRewards": ["Deep Archimedea Gold Rewards"],
		"/Lotus/Types/Game/MissionDecks/EntratiLabConquestRewards/EntratiLabConquestSilverRewards": ["Deep Archimedea Silver Rewards"],
		"/Lotus/Types/Game/MissionDecks/EndlessExterminationRewards/EndlessExterminationRewardsEasy": ["Sanctuary Onslaught"],
		"/Lotus/Types/Game/MissionDecks/EndlessExterminationRewards/EndlessExterminationRewardsHard": ["Elite Sanctuary Onslaught"],
	};
	Object.values(ExportRegions).forEach(region => {
		region.rewardManifests.forEach(deckName => {
			window.missionDeckNames[deckName] ??= [];
			window.missionDeckNames[deckName].push(dict[region.name] + " (" + dict[region.systemName] + ")");
		});
		if (region.cacheRewardManifest)
		{
			window.missionDeckNames[region.cacheRewardManifest] ??= [];
			window.missionDeckNames[region.cacheRewardManifest].push("Caches on " + dict[region.name] + " (" + dict[region.systemName] + ")");
		}
	});
	Object.values(ExportRelics).forEach(relic => {
		window.missionDeckNames[relic.rewardManifest] = [dict["/Lotus/Language/Relics/VoidProjectionName"].split("|ERA|").join(relic.era).split("|CATEGORY|").join(relic.category)];
	});

	window.droptableNames = {};
	Object.values(ExportEnemies.avatars).forEach(avatar => {
		if (avatar.droptable) {
			window.droptableNames[avatar.droptable] ??= [];
			if (!window.droptableNames[avatar.droptable].find(name => name == dict[avatar.name]))
			{
				window.droptableNames[avatar.droptable].push(dict[avatar.name]);
			}
		}
	});
}

function doQuery(query: string): void
{
	console.time("Input to language tags");
	let results: IResult[] = getDictEntriesFromQuery(query).reduce((arr, [key, value]) =>
	{
		arr.push({ type: "tag", key, value });
		return arr;
	}, []);
	console.timeEnd("Input to language tags");

	console.time("resolveTagsToUses");
	results = resolveTagsToUses(results);
	console.timeEnd("resolveTagsToUses");

	console.time("addUniqueNameResults");
	addUniqueNameResults(results, query);
	console.timeEnd("addUniqueNameResults");

	console.time("Filter results");
	{
		const keys_set = new Set();
		for (let i = 0; i != results.length; ++i)
		{
			const result = results[i];
			if (keys_set.has(result.key))
			{
				results.splice(i--, 1);
			}
			else
			{
				keys_set.add(result.key);
				if (typeof result.value == "object"
					&& "description" in result.value
					&& result.value.description != ""
					)
				{
					const j = results.findIndex(x => x.type == "tag" && x.key == result.value.description);
					if (j != -1)
					{
						results.splice(j, 1);
						if (i >= j)
						{
							--i;
						}
					}
				}
			}
		}
	}
	console.timeEnd("Filter results");

	console.time("Sort results");
	results.sort((a, b) => {
		// Warframes first
		if (a.type == "warframe" && b.type != "warframe") {
			return -1;
		}
		if (a.type != "warframe" && b.type == "warframe") {
			return 1;
		}
		// Tags last
		return Number(a.type == "tag") - Number(b.type == "tag");
	});
	console.timeEnd("Sort results");

	console.time("Commit to DOM");
	document.getElementById("results-status").textContent = "Found " + results.length + " result" + (results.length == 1 ? "" : "s") + ".";
	const MAX_RESULTS = 200;
	if (results.length > MAX_RESULTS)
	{
		document.getElementById("results-status").textContent += " Showing the first " + MAX_RESULTS + ".";
	}
	document.getElementById("results").innerHTML = "";
	let results_shown = 0;
	for (const result of results)
	{
		let root = document.createElement("div");
		root.className = "card mb-3";
		root = document.getElementById("results").appendChild(root);

		if (typeof result.value == "object"
			&& "icon" in result.value
			)
		{
			const row = root.appendChild(document.createElement("div"));
			row.className = "row g-0";
			{
				const col = document.createElement("div");
				col.className = "col-2";
				{
					const img = document.createElement("img");
					img.className = "img-fluid rounded-start";
					setImageSource(img, result.value.icon);
					col.appendChild(img);
				}
				row.appendChild(col);
			}
			{
				root = row.appendChild(document.createElement("div"));
				root.className = "col-10";
			}
		}

		root = root.appendChild(document.createElement("div"));
		root.className = "card-body";

		if (typeof result.value == "object"
			&& "name" in result.value
			)
		{
			const title = document.createElement("h5");
			title.className = "card-title";
			title.innerHTML = resolveTextIcons(dict[result.value.name] ?? result.value.name) + " ";
			{
				const a = document.createElement("a");
				a.textContent = "📖";
				a.title = "See other languages";
				a.href = "https://browse.wf" + result.value.name;
				a.target = "_blank";
				a.style.textDecoration = "none";
				title.appendChild(a);
			}
			root.appendChild(title);
		}

		{
			const subtitle = document.createElement("h6");
			subtitle.className = "card-subtitle mb-2 text-body-secondary";
			subtitle.textContent = result.key + " ";
			{
				const a = document.createElement("a");
				a.textContent = "📖";
				a.title = "View raw data";
				a.href = "https://browse.wf" + result.key;
				a.target = "_blank";
				a.style.textDecoration = "none";
				subtitle.appendChild(a);
			}
			root.appendChild(subtitle);
		}

		if (typeof result.value == "object"
			&& "description" in result.value
			&& result.value.description != ""
			)
		{
			let p = document.createElement("p");
			p.className = "card-text";
			p.textContent = (dict[result.value.description] ?? result.value.description) + " ";
			{
				const a = document.createElement("a");
				a.textContent = "📖";
				a.title = "See other languages";
				a.href = "https://browse.wf" + result.value.description;
				a.target = "_blank";
				a.style.textDecoration = "none";
				p.appendChild(a);
			}
			root.appendChild(p);
		}

		if (result.type == "weapon")
		{
			let p = document.createElement("p");
			p.className = "card-text";
			p.innerHTML = "Riven Disposition: " + result.value.omegaAttenuation + "x (<span class='font-monospace'>●" + (result.value.omegaAttenuation >= 0.7 ? "●" : "○") + (result.value.omegaAttenuation >= 0.9 ? "●" : "○") + (result.value.omegaAttenuation >= 1.11 ? "●" : "○") + (result.value.omegaAttenuation >= 1.31 ? "●" : "○") + "</span>) &middot; ";
			{
				const a = document.createElement("a");
				a.textContent = "View stat ranges";
				a.href = "/rivencalc#weapon=" + encodeURIComponent(dict[result.value.name]);
				a.target = "_blank";
				a.style.textDecoration = "none";
				p.appendChild(a);
			}
			root.appendChild(p);
		}
		else if (result.type == "upgrade" || result.type == "avionic")
		{
			let p = document.createElement("p");
			p.className = "card-text";
			if (result.value.fusionLimit == 0)
			{
				p.textContent = "This mod can not be upgraded.";
			}
			else
			{
				p.textContent = "Max Rank: " + result.value.fusionLimit + " (" + ("●".repeat(result.value.fusionLimit)) + ")";
			}
			root.appendChild(p);
		}
		else if (result.type == "flavour")
		{
			let have_obtain_info = false;
			if (result.key in supplementalGlyphData)
			{
				if (supplementalGlyphData[result.key].promo_code)
				{
					have_obtain_info = true;

					let p = document.createElement("p");
					p.className = "card-text";
					p.textContent = "Promo Code: ";
					{
						let a = document.createElement("a");
						a.href = "https://www.warframe.com/promocode?code=" + supplementalGlyphData[result.key]?.promo_code;
						a.target = "_blank";
						a.textContent = supplementalGlyphData[result.key]?.promo_code;
						p.appendChild(a);
					}
					root.appendChild(p);

					p = document.createElement("p");
					p.className = "card-text";
					p.textContent = "If the promo code no longer works, ";
					{
						let a = document.createElement("a");
						a.href = "https://github.com/calamity-inc/browse.wf/issues";
						a.target = "_blank";
						a.textContent = "please let us know.";
						p.appendChild(a);
					}
					root.appendChild(p);
				}
				else if (supplementalGlyphData[result.key].twitch
					|| supplementalGlyphData[result.key].youtube
					|| supplementalGlyphData[result.key].discord
					|| supplementalGlyphData[result.key].twitter
					|| supplementalGlyphData[result.key].mixer
					|| supplementalGlyphData[result.key]["other-site"]
					|| supplementalGlyphData[result.key].markdown
					)
				{
					have_obtain_info = true;

					let p = document.createElement("p");
					p.className = "card-text";
					p.textContent = "The following information is user-contributed. ";
					{
						let a = document.createElement("a");
						a.href = "https://github.com/calamity-inc/browse.wf/issues";
						a.target = "_blank";
						a.textContent = "Report issues you find here.";
						p.appendChild(a);
					}
					root.appendChild(p);

					if (supplementalGlyphData[result.key].twitch
						|| supplementalGlyphData[result.key].youtube
						|| supplementalGlyphData[result.key].discord
						|| supplementalGlyphData[result.key].twitter
						|| supplementalGlyphData[result.key].mixer
						|| supplementalGlyphData[result.key]["other-site"]
						)
					{
						let p = document.createElement("p");
						p.className = "card-text glyph-socials";

						if (supplementalGlyphData[result.key].twitch)
						{
							let a = document.createElement("a");
							a.href = supplementalGlyphData[result.key].twitch;
							a.target = "_blank";
							a.title = "Twitch";
							a.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M391.2 103.5H352.5v109.7h38.6zM285 103H246.4V212.8H285zM120.8 0 24.3 91.4V420.6H140.1V512l96.5-91.4h77.3L487.7 256V0zM449.1 237.8l-77.2 73.1H294.6l-67.6 64v-64H140.1V36.6H449.1z"/></svg>`;
							p.appendChild(a);
						}

						if (supplementalGlyphData[result.key].youtube)
						{
							let a = document.createElement("a");
							a.href = supplementalGlyphData[result.key].youtube;
							a.target = "_blank";
							a.title = "Youtube";
							a.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>`;
							p.appendChild(a);
						}

						if (supplementalGlyphData[result.key].discord)
						{
							let a = document.createElement("a");
							a.href = supplementalGlyphData[result.key].discord;
							a.target = "_blank";
							a.title = "Discord";
							a.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M524.5 69.8a1.5 1.5 0 0 0 -.8-.7A485.1 485.1 0 0 0 404.1 32a1.8 1.8 0 0 0 -1.9 .9 337.5 337.5 0 0 0 -14.9 30.6 447.8 447.8 0 0 0 -134.4 0 309.5 309.5 0 0 0 -15.1-30.6 1.9 1.9 0 0 0 -1.9-.9A483.7 483.7 0 0 0 116.1 69.1a1.7 1.7 0 0 0 -.8 .7C39.1 183.7 18.2 294.7 28.4 404.4a2 2 0 0 0 .8 1.4A487.7 487.7 0 0 0 176 479.9a1.9 1.9 0 0 0 2.1-.7A348.2 348.2 0 0 0 208.1 430.4a1.9 1.9 0 0 0 -1-2.6 321.2 321.2 0 0 1 -45.9-21.9 1.9 1.9 0 0 1 -.2-3.1c3.1-2.3 6.2-4.7 9.1-7.1a1.8 1.8 0 0 1 1.9-.3c96.2 43.9 200.4 43.9 295.5 0a1.8 1.8 0 0 1 1.9 .2c2.9 2.4 6 4.9 9.1 7.2a1.9 1.9 0 0 1 -.2 3.1 301.4 301.4 0 0 1 -45.9 21.8 1.9 1.9 0 0 0 -1 2.6 391.1 391.1 0 0 0 30 48.8 1.9 1.9 0 0 0 2.1 .7A486 486 0 0 0 610.7 405.7a1.9 1.9 0 0 0 .8-1.4C623.7 277.6 590.9 167.5 524.5 69.8zM222.5 337.6c-29 0-52.8-26.6-52.8-59.2S193.1 219.1 222.5 219.1c29.7 0 53.3 26.8 52.8 59.2C275.3 311 251.9 337.6 222.5 337.6zm195.4 0c-29 0-52.8-26.6-52.8-59.2S388.4 219.1 417.9 219.1c29.7 0 53.3 26.8 52.8 59.2C470.7 311 447.5 337.6 417.9 337.6z"/></svg>`;
							p.appendChild(a);
						}

						if (supplementalGlyphData[result.key].twitter)
						{
							let a = document.createElement("a");
							a.href = supplementalGlyphData[result.key].twitter;
							a.target = "_blank";
							a.title = "X (formerly known as Twitter)";
							a.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>`;
							p.appendChild(a);
						}

						if (supplementalGlyphData[result.key].mixer)
						{
							let a = document.createElement("a");
							a.href = supplementalGlyphData[result.key].mixer;
							a.target = "_blank";
							a.title = "Mixer";
							a.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M114.6 76.1a45.7 45.7 0 0 0 -67.5-6.4c-17.6 16.2-19 43.5-4.8 62.8l91.8 123L41.8 379.6c-14.2 19.3-13.1 46.6 4.7 62.8A45.7 45.7 0 0 0 114 435.9L242.9 262.7a12.1 12.1 0 0 0 0-14.2zM470.2 379.6 377.9 255.5l91.8-123c14.2-19.3 12.8-46.6-4.8-62.8a45.7 45.7 0 0 0 -67.5 6.4l-128 172.1a12.1 12.1 0 0 0 0 14.2L398 435.9a45.7 45.7 0 0 0 67.5 6.4C483.4 426.2 484.5 398.8 470.2 379.6z"/></svg>`;
							p.appendChild(a);
						}

						if (supplementalGlyphData[result.key]["other-site"])
						{
							let a = document.createElement("a");
							a.href = supplementalGlyphData[result.key]["other-site"];
							a.target = "_blank";
							a.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/></svg>`;
							p.appendChild(a);
						}

						root.appendChild(p);
					}

					{
						var converter = new window.showdown.Converter();
						converter.setOption("openLinksInNewWindow", true);
						converter.setOption("strikethrough", true);
						let div = document.createElement("div");
						div.className = "card-text";
						div.innerHTML = converter.makeHtml(supplementalGlyphData[result.key].markdown ?? "No instructions were provided. Check the socials above for more information.");
						root.appendChild(div);
					}
				}
			}

			if (!have_obtain_info
				&& result.key.substring(0, 48) == "/Lotus/Types/StoreItems/AvatarImages/FanChannel/"
				)
			{
				let p = document.createElement("p");
				p.className = "card-text";
				p.textContent = "If you know how to obtain this glyph, ";
				{
					let a = document.createElement("a");
					a.href = "https://github.com/calamity-inc/browse.wf/issues";
					a.target = "_blank";
					a.textContent = "please let us know.";
					p.appendChild(a);
				}
				root.appendChild(p);
			}
		}
		else if (result.type == "ability")
		{
			let p = document.createElement("p");
			if (result.value.energyRequiredToActivate)
			{
				p.textContent = "Requires " + result.value.energyRequiredToActivate + " Energy";
			}
			if (result.value.energyConsumptionOverTime)
			{
				if (p.textContent)
				{
					p.textContent += " • ";
				}
				p.textContent += "Consumes " + result.value.energyConsumptionOverTime + " Energy/s";
			}
			if (p.textContent)
			{
				p.className = "card-text";
				root.appendChild(p);
			}
		}
		else if (result.type == "tag")
		{
			let p = document.createElement("p");
			p.className = "card-text";
			p.innerHTML = resolveTextIcons(result.value) + " ";
			{
				const a = document.createElement("a");
				a.textContent = "📖";
				a.title = "See other languages";
				a.href = "https://browse.wf" + result.key;
				a.target = "_blank";
				a.style.textDecoration = "none";
				p.appendChild(a);
			}
			root.appendChild(p);
		}

		if (result.type == "warframe"
			|| result.type == "weapon"
			|| result.type == "upgrade"
			|| result.type == "arcane"
			|| result.type == "avionic"
			|| result.type == "resource"
			|| result.type == "sentinel"
			)
		{
			const dropType = window.itemToRecipeMap[result.key] ?? result.key;
			const dropIsBlueprint = !!window.itemToRecipeMap[result.key];
			const storeItem = "/Lotus/StoreItems/" + dropType.substring(7);
			const sources: IRewardSource[] = [];
			window.ExportRewards_entries.forEach(([deckName, tiers]) =>
			{
				for (let i = 0; i != tiers.length; ++i)
				{
					for (const reward of tiers[i])
					{
						if (reward.type == storeItem)
						{
							if (deckName in window.missionDeckNames)
							{
								const source: IRewardSource = {
									name: window.missionDeckNames[deckName] ?? [deckName],
									rotation: tiers.length > 1 ? i : undefined,
									itemCount: reward.itemCount,
									probability: reward.probability ?? { COMMON: 0.76, UNCOMMON: 0.40, RARE: 0.10 }[reward.rarity],
								};
								if (!reward.probability)
								{
									source.probabilityWorstCase = { COMMON: 0.50, UNCOMMON: 0.22, RARE: 0.02 }[reward.rarity];
								}
								sources.push(source);
							}
							else
							{
								console.warn("Mission deck has", dict[result.value.name], "but no human friendly name:", deckName);
							}
						}
					}
				}
			});
			Object.entries(ExportEnemies.droptables).forEach(([droptableName, pools]) =>
			{
				for (const pool of pools)
				{
					for (const reward of pool.items)
					{
						if (reward.type == dropType)
						{
							sources.push({
								name: window.droptableNames[droptableName] ?? [droptableName],
								itemCount: 1,
								probability: reward.probability * pool.chance
							});
						}
					}
				}
			});
			if (sources.length != 0)
			{
				sources.sort((a, b) => (b.itemCount * b.probability) - (a.itemCount * a.probability));

				let ul = document.createElement("ul");
				sources.forEach(source => {
					let li = document.createElement("li");
					if (source.name.length == 1)
					{
						li.textContent = source.name[0];
					}
					else
					{
						let abbr = document.createElement("abbr");
						abbr.textContent = source.name[0];
						abbr.title = "has the same rewards as: ";
						for (let i = 1; i != source.name.length; ++i)
						{
							if (i != 1)
							{
								abbr.title += ", "
							}
							abbr.title += source.name[i];
						}
						li.appendChild(abbr);
					}
					{
						let span = document.createElement("span");
						if (source.rotation !== undefined)
						{
							span.textContent += ", Rotation " + ("ABCD"[source.rotation]);
						}
						span.textContent += " gives " + source.itemCount;
						if (dropIsBlueprint)
						{
							span.textContent += " blueprint";
						}
						span.textContent += " @ ";
						if ("probabilityWorstCase" in source)
						{
							span.textContent += (source.probabilityWorstCase * 100).toFixed(0) + "-" + (source.probability * 100).toFixed(0) + "%";;
						}
						else
						{
							span.textContent += (source.probability * 100).toFixed(2) + "%";
						}
						li.appendChild(span);
					}
					ul.appendChild(li);
				});
				root.appendChild(ul);
			}
		}

		if (++results_shown == MAX_RESULTS)
		{
			break;
		}
	}
	console.timeEnd("Commit to DOM");
}

function getDictEntriesFromQuery(query: string): [string, string][]
{
	let num_results = 0;
	query = query.toLowerCase();
	return window.dict_entries.filter(([key, value]) =>
	{
		value = value.toLowerCase();
		return value == query
			|| (
				(value.substring(0, query.length) == query
				|| value.indexOf(" " + query) !== -1
				)
				&& ++num_results < 100
				)
			;
	});
}

function resolveTagsToUses(results: IResult[]): IResult[]
{
	const res = [];
	outer: for (const result of results)
	{
		if (result.type == "tag")
		{
			for (const [type, entries] of Object.entries(window.meta_entries))
			{
				const entry = entries.find(([uniqueName, item]) => item.name == result.key);
				if (entry)
				{
					res.push({ type: type, key: entry[0], value: entry[1] });
					continue outer;
				}
			}
		}
		res.push(result);
	}
	return res;
}

function addUniqueNameResults(res: IResult[], query: string): void
{
	query = query.toLowerCase();
	for (const [type, entries] of Object.entries(window.meta_entries))
	{
		for (const [uniqueName, item] of entries)
		{
			if (uniqueName.toLowerCase().indexOf(query) != -1)
			{
				res.push({ type: type, key: uniqueName, value: item });
			}
		}
	}
}
