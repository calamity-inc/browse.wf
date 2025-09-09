import type { IRegion } from "warframe-public-export-plus";

// common.js
declare let onLanguageUpdate: () => void;
declare function getDictPromise(): Promise<Record<string, string>>;
declare function toTitleCase(str: string): string;

// arbyTiers.js
declare const arbyTiers: Record<string, string>;

// fetch
declare let dict: Record<string, string>;
declare let ExportRegions: Record<string, IRegion>;
declare let arbys: [number, string][];

// state
declare let currentHour: number;

const days = [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ];
const months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

function loc(key)
{
	return dict[key] ?? key;
}

function totwo(num)
{
	if (num < 10)
	{
		return "0" + num;
	}
	return num;
}

function formattz(offset)
{
	if (offset == 0)
	{
		return "UTC+0";
	}
	offset /= 60;
	if (offset < 0)
	{
		return "UTC+" + (offset * -1);
	}
	return "UTC-" + offset;
}
document.getElementById("local-time-option").textContent += " (" + formattz(new Date().getTimezoneOffset()) + ")";

function formathour(hour)
{
	switch ((document.getElementById("select-hourfmt") as HTMLSelectElement).value)
	{
	case "mil": default: // This is the default because it indicates when zulu time is used, making it easier to parse screenshots of the schedule.
		return totwo(hour) + "00" + ((document.getElementById("select-tz") as HTMLSelectElement).value == "zulu" ? "Z" : "");

	case "24":
		return totwo(hour) + ":00";

	case "12":
		return ((hour % 12) == 0 ? "12" : (hour % 12)) + (hour >= 12 ? "pm" : "am");
	}
}

const params = new URLSearchParams(location.hash.replace("#", ""));
if (params.has("days"))
{
	(document.getElementById("select-days") as HTMLSelectElement).value = params.get("days");
}
else if ("userAgentData" in navigator && (navigator.userAgentData as { mobile?: boolean }).mobile)
{
	(document.getElementById("select-days") as HTMLSelectElement).value = "1";
}
if (params.has("tz"))
{
	(document.getElementById("select-tz") as HTMLSelectElement).value = params.get("tz");
}
if (params.has("hourfmt"))
{
	(document.getElementById("select-hourfmt") as HTMLSelectElement).value = params.get("hourfmt");
}
if (params.has("exclude"))
{
	params.get("exclude").split(".").forEach(opt =>
	{
		const checkbox = document.getElementById("filter-" + opt) as HTMLInputElement | null;
		if (checkbox)
		{
			checkbox.checked = false;
		}
	});
}

Promise.all([
	getDictPromise(),
	fetch("https://cdn.jsdelivr.net/gh/calamity-inc/warframe-public-export-plus@0.5.x/ExportRegions.json").then(res => res.json()),
	fetch("https://browse.wf/arbys.txt").then(res => res.text())
]).then(([ dict, ExportRegions, arbys ]) => {
	(window as any).dict = dict;
	(window as any).ExportRegions = ExportRegions;
	(window as any).arbys = arbys.split("\n").map(line => line.split(",")).filter(arr => arr.length == 2).map(arr => [ parseInt(arr[0]), arr[1] ]);
	onLanguageUpdate = function()
	{
		updateLog();
		updateFilterNamesForLocale();
	};
	onLanguageUpdate();
});

function updateFilterNamesForLocale()
{
	document.querySelector("label[for=filter-type-2]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Survival"]);
	document.querySelector("label[for=filter-type-8]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Defense"]);
	document.querySelector("label[for=filter-type-13]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Territory"]);
	document.querySelector("label[for=filter-type-17]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Excavation"]);
	document.querySelector("label[for=filter-type-21]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Purify"]);
	document.querySelector("label[for=filter-type-27]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Evacuation"]);
	document.querySelector("label[for=filter-type-33]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Artifact"]);
	document.querySelector("label[for=filter-type-34]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Corruption"]);
	document.querySelector("label[for=filter-type-35]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_VoidCascade"]);
	document.querySelector("label[for=filter-type-36]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Armageddon"]);
	document.querySelector("label[for=filter-type-38]").textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_Alchemy"]);

	document.querySelector("label[for=filter-fc-0]").textContent = dict["/Lotus/Language/Game/Faction_GrineerUC"];
	document.querySelector("label[for=filter-fc-1]").textContent = dict["/Lotus/Language/Game/Faction_CorpusUC"];
	document.querySelector("label[for=filter-fc-2]").textContent = dict["/Lotus/Language/Game/Faction_InfestationUC"];
	document.querySelector("label[for=filter-fc-3]").textContent = dict["/Lotus/Language/Game/Faction_OrokinUC"];
	document.querySelector("label[for=filter-fc-7]").textContent = dict["/Lotus/Language/Game/Faction_MITW"];
}

function updateLog()
{
	console.time("updateLog");

	const zulu = ((document.getElementById("select-tz") as HTMLSelectElement).value == "zulu");

	currentHour = Math.trunc(Date.now() / 3600000) * 3600;

	const epochHour = arbys[0][0];
	const currentHourIndex = (currentHour - epochHour) / 3600;

	// Update log
	const currentYear = zulu ? new Date().getUTCFullYear() : new Date().getFullYear();
	let remainingArbys = parseInt((document.getElementById("select-days") as HTMLSelectElement).value) * 24;
	let lastArbyDay = -1;
	document.getElementById("log").innerHTML = "";
	for (let i = currentHourIndex; i != arbys.length && remainingArbys-- > 0; ++i)
	{
		const arr = arbys[i];

		const thisArbyGrade = (arbyTiers[arr[1]] ?? "F");
		if (!(document.getElementById("filter-tier-" + thisArbyGrade) as HTMLInputElement).checked)
		{
			continue;
		}

		const node = ExportRegions[arr[1]];
		if (!(document.getElementById("filter-type-" + node.missionIndex) as HTMLInputElement).checked
			|| !(document.getElementById("filter-fc-" + node.factionIndex) as HTMLInputElement).checked
			)
		{
			continue;
		}

		const date = new Date(arr[0] * 1000);
		const thisArbyHour = zulu ? date.getUTCHours() : date.getHours();
		const thisArbyDay = zulu ? date.getUTCDate() : date.getDate();								

		if (thisArbyDay != lastArbyDay)
		{
			lastArbyDay = thisArbyDay;
			const thisArbyWeekDay = zulu ? date.getUTCDay() : date.getDay();
			const thisArbyMonth = zulu ? date.getUTCMonth() : date.getMonth();
			const thisArbyYear = zulu ? date.getUTCFullYear() : date.getFullYear();
			let h3 = document.createElement("h3");
			h3.textContent = days[thisArbyWeekDay] + ", " + months[thisArbyMonth] + " " + thisArbyDay;
			if (thisArbyYear != currentYear)
			{
				h3.textContent += ", " + thisArbyYear;
			}
			document.getElementById("log").appendChild(h3);
		}

		let span = document.createElement(arr[0] == currentHour ? "b" : "span");
		span.setAttribute("data-timestamp", arr[0].toString());
		span.textContent = formathour(thisArbyHour) + " • " + toTitleCase(loc(node.missionName)) + " - " + dict[node.factionName] + " @ " + loc(node.name) + ", " + loc(node.systemName) + " (" + thisArbyGrade + " tier";
		if ("darkSectorData" in node)
		{
			span.textContent += ", " + (node.darkSectorData.resourceBonus * 100).toFixed(0) + "% resource bonus";
		}
		span.textContent += ")";
		document.getElementById("log").appendChild(span);
	}
	if (document.getElementById("log").children.length == 0)
	{
		let span = document.createElement("span");
		span.textContent = "I've looked through " + (arbys.length - currentHourIndex) + " arbitrations but not a one matches your filters. :/";
		document.getElementById("log").appendChild(span);
	}

	// Update table
	document.querySelectorAll("table tbody tr").forEach(tr => {
		tr.setAttribute("data-starved", "true");
		tr.children[1].innerHTML = "N/A";
		tr.children[2].innerHTML = "N/A";
	});
	for (let i = currentHourIndex; i != arbys.length && document.querySelector("[data-starved]"); ++i)
	{
		const arr = arbys[i];

		const date = new Date(arr[0] * 1000);
		const node = ExportRegions[arr[1]];

		const thisArbyHour = zulu ? date.getUTCHours() : date.getHours();
		const thisArbyDay = zulu ? date.getUTCDate() : date.getDate();
		const thisArbyWeekDay = zulu ? date.getUTCDay() : date.getDay();
		const thisArbyMonth = zulu ? date.getUTCMonth() : date.getMonth();

		const thisArbyGrade = (arbyTiers[arr[1]] ?? "F");

		{
			const tr = document.getElementById("next-tier-" + thisArbyGrade);
			if (tr.children[1].innerHTML == "N/A")
			{
				tr.removeAttribute("data-starved");
				tr.children[1].setAttribute("data-timestamp", arr[0].toString());
				tr.children[1].textContent = days[thisArbyWeekDay] + ", " + months[thisArbyMonth] + " " + thisArbyDay + ", " + formathour(thisArbyHour);
				tr.children[2].textContent = toTitleCase(loc(node.missionName)) + " - " + dict[node.factionName] + " @ " + loc(node.name) + ", " + loc(node.systemName);
				if ("darkSectorData" in node)
				{
					tr.children[2].textContent += " (" + (node.darkSectorData.resourceBonus * 100).toFixed(0) + "% resource bonus)";
				}
			}
		}
		{
			const tr = document.getElementById("next-type-" + node.missionIndex);
			if (tr.children[1].innerHTML == "N/A")
			{
				tr.removeAttribute("data-starved");
				tr.children[1].setAttribute("data-timestamp", arr[0].toString());
				tr.children[1].textContent = days[thisArbyWeekDay] + ", " + months[thisArbyMonth] + " " + thisArbyDay + ", " + formathour(thisArbyHour);
				tr.children[2].textContent = dict[node.factionName] + " @ " + loc(node.name) + ", " + loc(node.systemName);
				if ("darkSectorData" in node)
				{
					tr.children[2].textContent += " (" + (node.darkSectorData.resourceBonus * 100).toFixed(0) + "% resource bonus)";
				}
			}
		}
		{
			const tr = document.getElementById("next-fc-" + node.factionIndex);
			if (tr.children[1].innerHTML == "N/A")
			{
				tr.removeAttribute("data-starved");
				tr.children[1].setAttribute("data-timestamp", arr[0].toString());
				tr.children[1].textContent = days[thisArbyWeekDay] + ", " + months[thisArbyMonth] + " " + thisArbyDay + ", " + formathour(thisArbyHour);
				tr.children[2].textContent = toTitleCase(loc(node.missionName)) + " - " + loc(node.name) + ", " + loc(node.systemName);
				if ("darkSectorData" in node)
				{
					tr.children[2].textContent += " (" + (node.darkSectorData.resourceBonus * 100).toFixed(0) + "% resource bonus)";
				}
			}
		}
	}

	// Ensure data stays up-to-date
	if (!("updater" in window))
	{
		(window as any).updater = setInterval(function()
		{
			if (currentHour != (Math.trunc((Date.now() / 1000) / 3600) * 3600))
			{
				updateLog();
			}
		}, 1000);
	}

	console.timeEnd("updateLog");
}

function saveSettings()
{
	let hash = "days=" + encodeURIComponent((document.getElementById("select-days") as HTMLSelectElement).value)
			+ "&tz=" + encodeURIComponent((document.getElementById("select-tz") as HTMLSelectElement).value)
			+ "&hourfmt=" + encodeURIComponent((document.getElementById("select-hourfmt") as HTMLSelectElement).value)
			;

	const filtered_away = [];
	document.querySelectorAll<HTMLInputElement>("input[type=checkbox]").forEach(elm =>
	{
		if (!elm.checked)
		{
			filtered_away.push(elm.id.substr(7)); // "filter-"
		}
	});
	if (filtered_away.length != 0)
	{
		hash += "&exclude=" + encodeURIComponent(filtered_away.join("."));
	}

	location.hash = hash;
}

document.querySelectorAll<HTMLSelectElement | HTMLInputElement>("select, input[type=checkbox]").forEach(elm =>
{
	elm.onchange = function()
	{
		if ("arbys" in window)
		{
			updateLog();
		}
		saveSettings();
	};
});
