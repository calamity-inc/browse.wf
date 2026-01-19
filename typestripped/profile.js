const platform_suffix_pluto_promise = pluto_require("platform-suffix.pluto");
/*document.getElementById("username").onfocus = function()
{
    this.select();
};*/
const guideTiers = [0, "Junior Guide of the Lotus", "Senior Guide of the Lotus"];
const founderTiers = [0, "Disciple", "Hunter", "Master", "Grand Master"];
const clanTiers = [0, "Ghost", "Shadow", "Storm", "Mountain", "Moon"];
const syndicateTags = [
    "ArbitersSyndicate",
    "CephalonSudaSyndicate",
    "PerrinSyndicate",
    "NewLokaSyndicate",
    "RedVeilSyndicate",
    "SteelMeridianSyndicate",
    "CetusSyndicate",
    "QuillsSyndicate",
    "SolarisSyndicate",
    "VentKidsSyndicate",
    "VoxSyndicate",
    "ZarimanSyndicate",
    "EntratiSyndicate",
    "NecraloidSyndicate",
    "EntratiLabSyndicate",
    "HexSyndicate",
    "KahlSyndicate",
    "NIGHTWAVE",
    "LibrarySyndicate",
    "ConclaveSyndicate",
    "EventSyndicate",
];
const vallisRaceNames = [0, "Puffin’ Pastures", "Bomb the Spaceport", "Shaving Nef", "Anyo’s Ointment", "Grinding the Void", "Fortuna’s Folley", "Taxman’s Curve", "Kubrodon Twist", "Mumsie Dadsie", "Catalyst", "Skeggin’ Out", "Deathgrip", "Dog Line", "River Run", "The Hard Way", "Sky-Eye", "Pobber’s Drop", "Lord of the Board", "Breakdown Or Bust", "Frost Merchant", "Roky’s Roll", "Meat and Greet"];
const platformNames = {
    "pc": "PC",
    "ps4": "PlayStation",
    "xb1": "Xbox",
    "swi": "Switch",
    "mob": "Mobile",
};
function peColourToHex(colour) {
    return "#" + colour.value.substring(4);
}
function peColourToRgb(colour) {
    return [
        parseInt(colour.value.substring(4, 6), 16),
        parseInt(colour.value.substring(6, 8), 16),
        parseInt(colour.value.substring(8, 10), 16)
    ];
}
function parseRgbaInt(val) {
    return [
        (val >> 16) & 0xff,
        (val >> 8) & 0xff,
        val & 0xff,
        (val >> 24) & 0xff
    ];
}
function toHexString(r, g, b) {
    return "#" + (r.toString(16).padStart(2, "0") + g.toString(16).padStart(2, "0") + b.toString(16).padStart(2, "0")).toUpperCase();
}
function makeColourFilter(colour) {
    const [red, green, blue] = peColourToRgb(colour);
    const svg = `<svg xmlns="http://www.w3.org/2000/svg"><filter id="a"><feColorMatrix color-interpolation-filters="sRGB" in="SourceGraphic" type="matrix" values="${red / 255} 0 0 0 0 0 ${green / 255} 0 0 0 0 0 ${blue / 255} 0 0 0 0 0 1 0" /></filter></svg>`;
    return "url('data:image/svg+xml," + svg + "#a')";
}
function makeSyndicateLogoElement(syndicate) {
    const div = document.createElement("div");
    div.style.backgroundColor /* [sic] */ = peColourToHex(syndicate.backgroundColour);
    {
        const img = document.createElement("img");
        img.src = "https://browse.wf" + syndicate.icon;
        img.style.filter = makeColourFilter(syndicate.colour);
        div.appendChild(img);
    }
    return div;
}
const params = new URLSearchParams(location.hash.replace("#", ""));
Promise.all([
    getDictPromise(),
    fetch("https://browse.wf/warframe-public-export-plus/ExportAchievements.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportCustoms.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportEnemies.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportFactions.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportFlavour.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportNightwave.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportRegions.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportSentinels.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportSyndicates.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportWarframes.json").then(res => res.json()),
    fetch("https://browse.wf/warframe-public-export-plus/ExportWeapons.json").then(res => res.json()),
    fetch("supplemental-data/profile-[DE]Rebecca.json").then(res => res.json())
]).then(([dict, ExportAchievements, ExportCustoms, ExportEnemies, ExportFactions, ExportFlavour, ExportNightwave, ExportRegions, ExportSentinels, ExportSyndicates, ExportWarframes, ExportWeapons, profile]) => {
    window.dict = dict;
    window.ExportAchievements = ExportAchievements;
    window.ExportCustoms = ExportCustoms;
    window.ExportEnemies = ExportEnemies;
    window.ExportFactions = ExportFactions;
    window.ExportFlavour = ExportFlavour;
    window.ExportRegions = ExportRegions;
    window.ExportSentinels = ExportSentinels;
    window.ExportSyndicates = ExportSyndicates;
    window.ExportWarframes = ExportWarframes;
    window.ExportWeapons = ExportWeapons;
    window.profile = profile;
    //window.profile = { Results: [ { DisplayName: "asdasdasd", Created: { $date: { $numberLong: "1364064293561" } } } ] };
    for (let i = 0; i != syndicateTags.length; ++i) {
        if (syndicateTags[i] == "NIGHTWAVE") {
            syndicateTags[i] = ExportNightwave.affiliationTag;
        }
    }
    document.getElementById("profile-nav").classList.remove("d-none");
    activateTab(params.has("tab") ? params.get("tab") : "fashion"); // default tab
    renderProfile();
    onLanguageUpdate = function () {
        renderProfile();
    };
    if (document.getElementById("profile-file").files.length) {
        loadProfile(document.getElementById("profile-file").files[0]);
    }
});
function isXplatName(name) {
    return name.charCodeAt(name.length - 1) >= 0xE000;
}
function xplatNameToPlatformId(name) {
    return name.charCodeAt(name.length - 1) - 0xE000;
}
function sanitiseName(name) {
    if (name.charCodeAt(name.length - 1) >= 0xE000) {
        name = name.substring(0, name.length - 1);
    }
    return name;
}
function loadProfile(file) {
    if (!file) {
        return;
    }
    document.querySelector("#status span").textContent = "Loading profile...";
    document.querySelector("#status").classList.remove("d-none");
    const reader = new FileReader();
    reader.onload = function (e) {
        try {
            window.profile = JSON.parse(e.target.result);
            document.getElementById("profile-nav").classList.remove("d-none");
            activateTab(params.has("tab") ? params.get("tab") : "fashion");
            renderProfile();
            if (!params.has("tab")) {
                location.hash = "tab=fashion";
            }
        }
        catch (err) {
            console.error(err);
            alert("Failed to parse JSON file.");
        }
        document.querySelector("#status").classList.add("d-none");
    };
    reader.readAsText(file);
}
function renderProfile() {
    document.querySelector("#status").classList.add("d-none");
    const sanitisedName = sanitiseName(profile.Results[0].DisplayName);
    document.getElementById("profile-name").textContent = sanitisedName;
    document.getElementById("profile-discriminator").textContent = "";
    if (isXplatName(profile.Results[0].DisplayName)) {
        platform_suffix_pluto_promise.then(() => {
            pluto_invoke("get_discriminator", sanitisedName, xplatNameToPlatformId(profile.Results[0].DisplayName)).then(discriminator => {
                document.getElementById("profile-discriminator").textContent = "#" + discriminator.toString().padStart(3, "0");
            });
        });
    }
    const createdAt = parseInt(profile.Results[0].AccountId.$oid.substr(0, 8), 16);
    document.querySelector("#mr").classList.remove("d-none");
    document.querySelector("#mr b").textContent = (profile.Results[0].PlayerLevel ?? 0);
    document.querySelector("#mr span").textContent = new Date(createdAt * 1000).toLocaleDateString();
    const accolades = [];
    if (profile.Results[0].Staff) {
        accolades.push("Digital Extremes Staff");
    }
    else {
        if (profile.Results[0].Founder) {
            accolades.push("Founder (" + founderTiers[profile.Results[0].Founder] + ")");
        }
        if (profile.Results[0].Guide) {
            accolades.push(guideTiers[profile.Results[0].Guide]);
        }
        if (profile.Results[0].Moderator) {
            accolades.push("Moderator");
        }
        if (profile.Results[0].Partner) {
            accolades.push("Warframe Creator");
        }
        if (createdAt < 1363651200) {
            accolades.push("Closed Beta Player");
        }
        if (profile.Results[0].Accolades?.Heirloom) {
            accolades.push("Ten Year Supporter");
        }
    }
    if (accolades.length != 0) {
        document.querySelector("#accolades span").textContent = accolades.join(", ");
        document.querySelector("#accolades").classList.remove("d-none");
    }
    else {
        document.querySelector("#accolades").classList.add("d-none");
    }
    if (profile.Results[0].GuildName) {
        document.querySelector("#clan span").textContent = profile.Results[0].GuildName + ", " + clanTiers[profile.Results[0].GuildTier] + " Clan Rank " + profile.Results[0].GuildClass;
        document.querySelector("#clan").classList.remove("d-none");
    }
    else {
        document.querySelector("#clan").classList.add("d-none");
    }
    document.getElementById("syndicates").innerHTML = "";
    for (const tag of syndicateTags) {
        const syndicate = ExportSyndicates[tag];
        const affiliation = profile.Results[0].Affiliations?.find(x => x.Tag == tag);
        const col = document.createElement("div");
        col.className = "col-md-6 p-1";
        {
            const card = document.createElement("div");
            card.className = "card";
            {
                const row = document.createElement("div");
                row.className = "row g-0";
                {
                    const logo = makeSyndicateLogoElement(syndicate);
                    logo.className = "col-xxl-2 col-lg-3 col-md-4 col-3 rounded-start";
                    logo.children[0].className = "img-fluid rounded-start";
                    row.appendChild(logo);
                }
                {
                    const body = document.createElement("div");
                    body.className = "col-xxl-10 col-lg-9 col-md-8 col-9";
                    body.style.padding = "14px 16px";
                    {
                        const title = document.createElement("h5");
                        title.className = "card-title";
                        title.textContent = dict[syndicate.name];
                        body.appendChild(title);
                    }
                    const level = (affiliation?.Title ?? 0);
                    const title = syndicate.titles?.find(x => x.level == level);
                    {
                        const subtitle = document.createElement("h6");
                        subtitle.className = "card-subtitle mb-2 text-body-secondary";
                        subtitle.textContent = "Rank " + level;
                        if (title) {
                            subtitle.textContent += " · " + toTitleCase(dict[title.name]);
                        }
                        body.appendChild(subtitle);
                    }
                    {
                        const standing = affiliation?.Standing ?? 0;
                        const minStanding = (level < 0 ? title?.maxStanding : title?.minStanding) ?? 0;
                        const text = document.createElement("p");
                        text.className = "card-text";
                        text.textContent = "Standing: " + (standing - minStanding).toLocaleString();
                        if (minStanding != 0) {
                            text.textContent += " (" + standing.toLocaleString() + " in total)";
                        }
                        body.appendChild(text);
                    }
                    row.appendChild(body);
                }
                card.appendChild(row);
            }
            col.appendChild(card);
        }
        document.getElementById("syndicates").appendChild(col);
    }
    document.getElementById("achievements").innerHTML = "";
    Object.entries(ExportAchievements)
        .sort((a, b) => (a[1].hidden ? 1 : 0) - (b[1].hidden ? 1 : 0))
        .forEach(([tag, achievement]) => {
        if (achievement.icon || achievement.hidden) {
            const col = document.createElement("div");
            col.className = "col-md-6 p-1";
            {
                const card = document.createElement("div");
                card.className = "card";
                {
                    const row = document.createElement("div");
                    row.className = "row g-0";
                    if (achievement.icon) {
                        const div = document.createElement("div");
                        div.className = "col-xxl-2 col-lg-3 col-md-4 col-3 rounded-start";
                        {
                            const img = document.createElement("img");
                            img.className = "img-fluid rounded-start";
                            img.src = "https://browse.wf" + achievement.icon;
                            div.appendChild(img);
                        }
                        row.appendChild(div);
                    }
                    {
                        const body = document.createElement("div");
                        if (achievement.icon) {
                            body.className = "col-xxl-10 col-lg-9 col-md-8 col-9";
                        }
                        body.style.padding = "9px";
                        {
                            const title = document.createElement("h5");
                            title.className = "card-title";
                            title.textContent = dict[achievement.name] ?? tag;
                            if (tag.substring(0, 14) == "OrbVallisRacer") {
                                title.textContent += " (" + vallisRaceNames[tag.substring(14)] + ")";
                            }
                            body.appendChild(title);
                        }
                        if (achievement.description) {
                            const text = document.createElement("p");
                            text.className = "card-text";
                            text.textContent = dict[achievement.description];
                            body.appendChild(text);
                        }
                        const progress = (profile.Results[0].ChallengeProgress?.find(x => x.Name == tag)?.Progress ?? 0);
                        const requiredCount = (achievement.requiredCount ?? 1);
                        body.innerHTML += `<div class="progress" role="progressbar"><div class="progress-bar" style="width: ${(progress / requiredCount) * 100}%">${progress.toLocaleString()}/${requiredCount.toLocaleString()}</div></div>`;
                        row.appendChild(body);
                    }
                    card.appendChild(row);
                }
                col.appendChild(card);
            }
            document.getElementById("achievements").appendChild(col);
        }
    });
    profile.Results[0].Missions ??= [];
    document.querySelector("#missions tbody").innerHTML = "";
    Object.keys(ExportRegions).forEach(tag => {
        if (tag != "EventNode763"
            && !profile.Results[0].Missions.find(x => x.Tag == tag)) {
            profile.Results[0].Missions.push({ Tag: tag, Completes: 0 });
        }
    });
    profile.Results[0].Missions
        .sort((a, b) => b.Completes - a.Completes)
        .forEach(mission => {
        const node = ExportRegions[mission.Tag];
        if (node) {
            if (node.nodeType == 3 /* NT_HUB */ && mission.Completes == 0) {
                return;
            }
            if (node.nodeType == 6 /* NT_SHORTCUT */) {
                return;
            }
        }
        const tr = document.createElement("tr");
        {
            const td = document.createElement("td");
            if (node) {
                td.textContent = dict[node.name];
                if (node.systemName && node.systemIndex != 19) {
                    td.textContent += ", " + (dict[node.systemName] ?? node.systemName);
                    if (node.missionType != "MT_PVP") {
                        td.textContent += " (" + toTitleCase(dict[node.missionName]);
                        if (node.faction && node.systemIndex != 21) {
                            td.textContent += " - " + toTitleCase(dict[ExportFactions[node.faction].name]);
                        }
                        td.textContent += ")";
                    }
                }
            }
            else {
                td.textContent = mission.Tag;
            }
            tr.appendChild(td);
        }
        {
            const td = document.createElement("td");
            td.textContent = mission.Completes;
            tr.appendChild(td);
        }
        {
            const td = document.createElement("td");
            td.textContent = (mission.Tier ? "✓" : "");
            tr.appendChild(td);
        }
        {
            const td = document.createElement("td");
            if (node && node.masteryExp) {
                if (mission.Completes == 0) {
                    td.textContent = "Missing out on " + (node.masteryExp * 2) + " mastery exp ";
                }
                else if (!mission.Tier) {
                    td.textContent = "Missing out on " + node.masteryExp + " mastery exp.";
                }
            }
            tr.appendChild(td);
        }
        document.querySelector("#missions tbody").appendChild(tr);
    });
    profile.Results[0].LoadOutPreset ??= {};
    profile.Results[0].LoadOutInventory ??= {};
    /*if (profile.Results[0].LoadOutPreset.n)
    {
        document.querySelector("#loadout-name span").textContent = profile.Results[0].LoadOutPreset.n;
        document.getElementById("loadout-name").classList.remove("d-none");
    }
    else
    {
        document.getElementById("loadout-name").classList.add("d-none");
    }*/
    for (const category of ["Suits", "LongGuns", "Pistols", "Melee"]) {
        document.getElementById(category + "-config").innerHTML = `<option value="0">Config A</option><option value="1">Config B</option><option value="2">Config C</option><option value="3">Config D</option><option value="4">Config E</option><option value="5">Config F</option>`;
        const key = category.substring(0, 1).toLowerCase();
        if (profile.Results[0].LoadOutPreset[key] && "cus" in profile.Results[0].LoadOutPreset[key]) {
            document.querySelector("#" + category + "-config [value='" + profile.Results[0].LoadOutPreset[key].cus + "']").textContent += " (Active)";
            document.getElementById(category + "-config").value = profile.Results[0].LoadOutPreset[key].cus;
        }
        if (category != "Suits") {
            if (profile.Results[0].LoadOutPreset[key]?.ItemId) {
                document.getElementById(category + "-div").classList.remove("d-none");
            }
            else {
                document.getElementById(category + "-div").classList.add("d-none");
            }
            if (profile.Results[0].LoadOutPreset[key]?.hide) {
                document.getElementById(category + "-hide").classList.remove("d-none");
            }
            else {
                document.getElementById(category + "-hide").classList.add("d-none");
            }
        }
    }
    updateFashion();
    /*if (profile.Results[0].OperatorLoadOuts)
    {
        for (let i = 0; i != 17; ++i)
        {
            displaySkin("Operator", i, profile.Results[0].OperatorLoadOuts[0].Skins[i]);
        }
    }
    else
    {
        for (let i = 0; i != 17; ++i)
        {
            displaySkin("Operator", i, "");
        }
    }*/
    for (const stat of ["TimePlayedSec", "Income", "MissionsCompleted", "MissionsFailed", "MissionsQuit", "MissionsInterrupted", "MissionsDumped", "CiphersSolved", "CiphersFailed", "CipherTime", "ReviveCount", "HealCount", "Deaths" /*, "MeleeKills"*/]) {
        const value = (profile.Stats && profile.Stats[stat]) ? profile.Stats[stat] : 0;
        if (stat == "TimePlayedSec" || stat == "CipherTime") {
            document.getElementById("stat-" + stat).textContent = (value / 3600).toFixed(1) + " hours";
        }
        else {
            document.getElementById("stat-" + stat).textContent = value.toLocaleString();
        }
    }
    if (profile.Stats && profile.Stats.CipherTime && profile.Stats.CiphersSolved) {
        document.getElementById("stat-CipherTimeAvg").textContent = (profile.Stats.CipherTime / profile.Stats.CiphersSolved).toFixed(1) + "s";
    }
    else {
        document.getElementById("stat-CipherTimeAvg").textContent = "0s";
    }
    document.getElementById("equipment-stats").innerHTML = "";
    if (profile.Stats && profile.Stats.Weapons) {
        profile.Stats.Weapons
            .sort((a, b) => b.equipTime - a.equipTime)
            .forEach(item => {
            const type = ExportWarframes[item.type] ?? ExportWeapons[item.type] ?? ExportSentinels[item.type];
            if (!type) {
                return;
            }
            const tr = document.createElement("tr");
            {
                const td = document.createElement("td");
                td.innerHTML = dict[type.name];
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = ((item.equipTime ?? 0) / 3600).toFixed(1);
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (item.kills ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (item.headshots ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (item.assists ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (item.xp ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            document.getElementById("equipment-stats").appendChild(tr);
        });
    }
    document.getElementById("enemy-stats").innerHTML = "";
    if (profile.Stats && profile.Stats.Enemies) {
        profile.Stats.Enemies
            .sort((a, b) => b.kills - a.kills)
            .forEach(enemy => {
            const type = ExportEnemies.avatars[enemy.type];
            if (!type) {
                return;
            }
            const tr = document.createElement("tr");
            {
                const td = document.createElement("td");
                td.innerHTML = dict[type.name];
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (enemy.kills ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (enemy.headshots ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (enemy.assists ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (enemy.executions ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                td.innerHTML = (enemy.deaths ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            {
                const td = document.createElement("td");
                const entry = profile.Stats.Scans?.find(x => x.type == enemy.type);
                td.innerHTML = (entry?.scans ?? 0).toLocaleString();
                tr.appendChild(td);
            }
            document.getElementById("enemy-stats").appendChild(tr);
        });
    }
}
function displaySkin(category, i, value) {
    const elm = document.getElementById(category + "-skin-" + i);
    if (elm) {
        if (value && value != "" && value != "/Lotus/Upgrades/Skins/Armor/WarframeDefaults/EmptyCustomization") {
            if (ExportCustoms[value]) {
                const a = document.createElement("a");
                /*if (ExportCustoms[value].name == "" || dict[ExportCustoms[value].name] == "")
                {
                    a.textContent = value;
                }
                else*/
                {
                    a.textContent = dict[ExportCustoms[value].name] ?? ExportCustoms[value].name ?? value;
                }
                a.href = "https://browse.wf" + ExportCustoms[value].icon;
                a.target = "_blank";
                elm.querySelector("span").innerHTML = "";
                elm.querySelector("span").appendChild(a);
            }
            else {
                elm.querySelector("span").textContent = value;
            }
            elm.classList.remove("d-none");
        }
        else {
            elm.classList.add("d-none");
        }
    }
}
const modularWeapons = {
    "/Lotus/Weapons/SolarisUnited/Primary/LotusModularPrimary": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Primary/LotusModularPrimaryBeam": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Primary/LotusModularPrimaryLauncher": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Primary/LotusModularPrimaryShotgun": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Primary/LotusModularPrimarySniper": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Secondary/LotusModularSecondary": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Secondary/LotusModularSecondaryBeam": "Kitgun",
    "/Lotus/Weapons/SolarisUnited/Secondary/LotusModularSecondaryShotgun": "Kitgun",
    "/Lotus/Weapons/Ostron/Melee/LotusModularWeapon": "Zaw",
};
function updateFashion() {
    for (const category of ["Suits", "LongGuns", "Pistols", "Melee"]) {
        const equipment = profile.Results[0].LoadOutInventory[category] ? profile.Results[0].LoadOutInventory[category][0] : { ItemType: "None", Configs: [] };
        const config = equipment.Configs[document.getElementById(category + "-config").value];
        document.getElementById(category + "-name").textContent = (dict[ExportWarframes[equipment.ItemType]?.name] ?? dict[ExportWeapons[equipment.ItemType]?.name] ?? modularWeapons[equipment.ItemType] ?? equipment.ItemType);
        if (equipment.ItemName && equipment.ItemName != document.getElementById(category + "-name").textContent) {
            if (equipment.ItemName.indexOf("|") === -1) // e.g. for a stock Tenet Arca Plasmor, the ItemName would be "/Lotus/Language/Weapons/CrpBEArcaPlasmorName|PARVI LISSIDPHA" with the respective Lich/Sister name.
             {
                document.getElementById(category + "-name").textContent += " (\"" + equipment.ItemName + "\")";
            }
        }
        if (config?.Skins) {
            for (let i = 0; i != 26; ++i) {
                displaySkin(category, i, config?.Skins[i]);
            }
        }
        else {
            for (let i = 0; i != 26; ++i) {
                displaySkin(category, i, "");
            }
        }
        for (const section of ["pricol", "attcol", "syancol", "sigcol"]) {
            for (const key of ["t0", "t1", "t2", "t3", "m0", "m1", "en", "e1"]) {
                const elm = document.getElementById(category + "-" + section + "-" + key);
                if (elm) {
                    elm.querySelector(".palettes").textContent = "";
                    if (config && config[section] && config[section][key]) {
                        const [r, g, b /*, a*/] = parseRgbaInt(config[section][key]);
                        // Alpha might be interesting for sigils
                        const hex = toHexString(r, g, b);
                        elm.querySelector(".hex").textContent = hex;
                        elm.querySelector(".hex").style.fontFamily = "monospace";
                        elm.querySelector(".colour-blob").style.backgroundColor = hex;
                        Object.values(ExportFlavour).forEach(flavour => {
                            if (flavour.hexColours) {
                                for (const colour of flavour.hexColours) {
                                    const [r2, g2, b2] = peColourToRgb(colour);
                                    if (r == r2 && g == g2 && b == b2) {
                                        elm.querySelector(".palettes").textContent += " · " + dict[flavour.name];
                                        break;
                                    }
                                }
                            }
                            if (flavour.legacyColours) {
                                for (const colour of flavour.legacyColours) {
                                    const [r2, g2, b2] = peColourToRgb(colour);
                                    if (r == r2 && g == g2 && b == b2) {
                                        elm.querySelector(".palettes").textContent += " · " + dict[flavour.name] + " (Legacy)";
                                        break;
                                    }
                                }
                            }
                        });
                    }
                    else {
                        elm.querySelector(".hex").textContent = "Default";
                        elm.querySelector(".hex").style.fontFamily = "";
                        elm.querySelector(".colour-blob").style.backgroundColor = "";
                    }
                }
            }
        }
    }
}
function tabulate(elm, event) {
    event.preventDefault();
    activateTab(elm.getAttribute("data-tab"));
    if ("profile" in window) {
        location.hash = "tab=" + elm.getAttribute("data-tab");
    }
}
function activateTab(id) {
    document.querySelectorAll("[data-tab]").forEach(x => x.classList.remove("active"));
    document.querySelector("[data-tab=" + id + "]").classList.add("active");
    document.querySelectorAll(".tab").forEach(x => x.classList.add("d-none"));
    document.getElementById(id).classList.remove("d-none");
}
//# sourceMappingURL=profile.js.map