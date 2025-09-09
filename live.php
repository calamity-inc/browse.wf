<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>Live World State | browse.wf</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This tool shows you everything that's going on in Warframe right now in a hopefully useful way.">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="icon" href="https://browse.wf/Lotus/Interface/Icons/Categories/GrimoireModIcon.png">
	<style>
		abbr { text-decoration: underline dotted; text-decoration-skip-ink: none; }
		[data-bs-toggle=tooltip] { cursor: help; }
		[data-notif-toggle], [data-notif-toggle] > span, .completion-check { text-decoration:none;cursor:pointer;color:inherit }
		.completion-check { display: inline-block; width: 15px }
		.card-block:not(:last-child) { margin-bottom: .5rem; }
		[data-collapse-toggle], [data-collapse-toggle] > span { cursor:pointer }
		.card:has([data-collapse-toggle].engaged) {
			& .card-header { border-bottom: none }
			& > :not(.card-header) { display: none !important }
		}
	</style>
</head>
<body data-bs-theme="dark">
	<?php require "components/navbar.php"; ?>
	<div class="container-fluid pt-3">
		<div class="row g-3 mb-xl-3">
			<div class="col-xl-4">
				<div class="row g-3">
					<div class="col-xl-12 col-md-6">
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="environments"></span> Environments</h5>
								<a class="m-auto me-0" data-notif-toggle="nightfall"></a>
							</div>
							<div class="card-body overflow-auto">
								<table class="table table-hover table-sm table-borderless mb-0">
									<tr>
										<th id="poe-name" class="w-50">Plains of Eidolon / Earth</th>
										<td id="poe" class="w-50">Fetching data...</td>
									</tr>
									<tr>
										<th id="vallis-name" class="w-50">Orb Vallis</th>
										<td id="vallis" class="w-50"></td>
									</tr>
									<tr>
										<th id="deimos-name" class="w-50">Cambion Drift</th>
										<td id="deimos" class="w-50">Fetching data...</td>
									</tr>
									<tr>
										<th id="duviri-name" class="w-50">Duviri</th>
										<td id="duviri" class="w-50">Fetching data...</td>
									</tr>
									<tr>
										<th id="zariman-name" class="w-50">Zariman</th>
										<td id="zariman" class="w-50">Fetching data...</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="news"></span> News</h5>
								<a class="m-auto me-0" data-notif-toggle="news"></a>
							</div>
							<div class="card-body overflow-auto" id="news-body" style="height:167px">
								Loading...
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="darvo"></span> <span id="darvo-header">Darvo's Deal</span></h5>
								<a class="m-auto me-0" data-notif-toggle="darvo"></a>
							</div>
							<div class="d-flex">
								<img style="height:64px;width:64px;margin:10px" id="darvo-icon" />
								<div class="card-body ps-1">
									<p class="mb-1"><b id="darvo-item">Loading...</b> &middot; <span id="darvo-stock">0/0</span> In Stock</p>
									<p class="card-text"><del id="darvo-ogprice">0</del> <b id="darvo-price">0</b> Platinum (-<span id="darvo-discount">0</span>%)</p>
								</div>
							</div>
						</div>
						<div class="card mb-3">
							<h5 class="card-header"><span data-collapse-toggle="arby"></span> <span id="arby-header">Arbitration</span></h5>
							<div class="card-body">
								<p class="card-text"><b id="arby-what">Loading...</b> <span id="arby-where"></span> (<span id="arby-tier">F</span> Tier)</p>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="alerts"></span> Alerts</h5>
								<a class="m-auto me-0" data-notif-toggle="alerts"></a>
							</div>
							<div class="card-body" id="alerts-body">Loading...</div>
						</div>
						<div class="card">
							<h5 class="card-header"><span data-collapse-toggle="goals"></span> Events</h5>
							<div class="card-body" id="goals-body">Loading...</div>
						</div>
					</div>
					<div class="col-xl-12 col-md-6">
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="sortie"></span> <span id="sortie-header">Sortie</span></h5>
								<a class="m-auto me-0" data-notif-toggle="sortie"></a>
							</div>
							<div class="card-body">
								<table class="table table-sm table-borderless table-hover mb-0" id="sortie-table">
									<tr><th>Fetching data...</th></tr>
									<tr><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td></tr>
								</table>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="litesortie"></span> <span id="litesortie-header">Archon Hunt</h5>
								<a class="m-auto me-0" data-notif-toggle="litesortie"></a>
							</div>
							<div class="card-body" id="litesortie-body">Fetching data...</div>
						</div>
						<div class="card mb-3">
							<h5 class="card-header"><span data-collapse-toggle="incursions"></span> <span id="incursions-header">Steel Path Incursions</h5>
							<div class="card-body overflow-auto" id="incursions-body">
								<span class="d-block mb-1"><b>Fetching data...</b></span>
								<span class="d-block mb-1">&nbsp;</span>
								<span class="d-block mb-1">&nbsp;</span>
								<span class="d-block mb-1">&nbsp;</span>
								<span class="d-block mb-1">&nbsp;</span>
								<span class="d-block">&nbsp;</span>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="vendors"></span> <span id="vendors-header">Vendors</h5>
								<a class="m-auto me-0" data-notif-toggle="teshin"></a>
							</div>
							<div class="card-body">
								<p class="mb-1">Steel Path Honors: <b id="teshin-offer"></b> <span id="teshin-check"></span></p>
								<p class="mb-0">Iron Wake <span id="ironwake-check"></span></p>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="weekly-missions"></span> <span id="circuit-header">Weekly Missions</h5>
								<a class="m-auto me-0" data-notif-toggle="circuit"></a>
							</div>
							<div class="card-body">
								<p class="mb-1">Help Clem <span id="clem-check"></span></p>
								<p class="mb-1">Ayatan Treasure Hunt <span id="maroo-check"></span></p>
								<p class="mb-1">The Circuit (Normal): <b id="circuit-frames">Loading...</b> <span id="circuit-frames-check"></span></p>
								<p class="mb-1">The Circuit (Steel Path): <b id="circuit-weapons"></b> <span id="circuit-weapons-check"></span></p>
								<p class="mb-1">Netracells <span id="netracell-checks"></span></p>
								<p class="mb-0">Break Narmer <span id="kahl-checks"></span></p>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="baro"></span> <span id="baro-header">Baro Ki'Teer</h5>
								<a class="m-auto me-0" data-notif-toggle="baro"></a>
							</div>
							<div class="card-body">
								<p id="baro-soon" class="mb-0">Baro's next visit will be at <b class="baro-where">Loading...</b>.</p>
								<div id="baro-now" class="d-none">
									<p>Baro is currently at <b class="baro-where"></b>.</p>
									<table class="table table-sm table-hover table-borderless mb-0" id="baro-table"></table>
								</div>
							</div>
						</div>
						<div class="card">
							<h5 class="card-header"><span data-collapse-toggle="pgr"></span> KinePage</h5>
							<div class="card-body" id="pgr">No new messages. Scanning...</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<div class="card mb-3">
					<div class="card-header d-flex">
						<h5 class="mb-0"><span data-collapse-toggle="bounties"></span> <span id="bounties-header">Bounties</h5>
						<a class="m-auto me-0" data-notif-toggle="bounties"></a>
					</div>
					<div class="card-body overflow-auto" id="bounties-body">
						<p>Rotation <b id="bounty-rot">?</b> (<span id="bounty-rot-rewards">Loading</span>) &middot; Vault Rotation <b id="vault-rot">?</b> (<span id="vault-rot-rewards">Loading</span>)</p>
						<h5 id="ZarimanSyndicate-name">The Holdfasts</h5>
						<table class="table table-hover table-sm table-borderless" id="ZarimanSyndicate-table">
							<tr>
								<th class="mission">Fetching data...</th>
								<td class="challenge"></td>
								<td>50-55</td>
								<td>1/2&nbsp;<abbr class="vq-abbr">VQ</abbr></td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>60-65</td>
								<td>2/3&nbsp;<abbr class="vq-abbr">VQ</abbr></td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>70-75</td>
								<td>3/5&nbsp;<abbr class="vq-abbr">VQ</abbr></td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>90-95</td>
								<td>4/6&nbsp;<abbr class="vq-abbr">VQ</abbr></td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>110-115</td>
								<td>5/8&nbsp;<abbr class="vq-abbr">VQ</abbr></td>
							</tr>
						</table>
						<h5 id="EntratiLabSyndicate-name">Cavia</h5>
						<table class="table table-hover table-sm table-borderless" id="EntratiLabSyndicate-table">
							<tr>
								<th class="mission">Fetching data...</th>
								<td class="challenge"></td>
								<td>55-60</td>
								<td>1000/<wbr/>1500</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>65-70</td>
								<td>2000/<wbr/>3000</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>75-80</td>
								<td>3000/<wbr/>4500</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>95-100</td>
								<td>4000/<wbr/>6000</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td>115-120</td>
								<td>5000/<wbr/>7500</td>
							</tr>
						</table>
						<h5 id="HexSyndicate-name">The Hex</h5>
						<table class="table table-hover table-sm table-borderless mb-0" id="HexSyndicate-table">
							<tr>
								<th class="mission">Fetching data...</th>
								<td class="challenge"></td>
								<td class="ally"></td>
								<td>65-70</td>
								<td>1000/<wbr/>1500</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td class="ally"></td>
								<td>75-80</td>
								<td>2000/<wbr/>3000</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td class="ally"></td>
								<td>85-90</td>
								<td>3000/<wbr/>4500</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td class="ally"></td>
								<td>95-100</td>
								<td>4000/<wbr/>6000</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td class="ally"></td>
								<td>105-110</td>
								<td>5000/<wbr/>7500</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge"></td>
								<td class="ally"></td>
								<td>115-120</td>
								<td>6000/<wbr/>9000</td>
							</tr>
							<tr>
								<th class="mission"></th>
								<td class="challenge" colspan="2"></td>
								<td>125-130</td>
								<td>7500/<wbr/>11250</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row g-3">
					<div class="col-md-6">
						<div class="card mb-3">
							<h5 class="card-header"><span data-collapse-toggle="fissures"></span> Void Fissures (Normal)</h5>
							<div class="card-body overflow-auto">
								<table class="table table-sm table-hover table-borderless mb-0" id="fissures-table"><tr><th>Loading...</th></tr></table>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card mb-3">
							<h5 class="card-header"><span data-collapse-toggle="sp-fissures"></span> Void Fissures (Steel Path)</h5>
							<div class="card-body overflow-auto">
								<table class="table table-sm table-hover table-borderless mb-0" id="sp-fissures-table"><tr><th>Loading...</th></tr></table>
							</div>
						</div>
					</div>
				</div>
				<div class="row g-3 mb-3">
					<div class="col-xxl-8">
						<div class="card mb-3">
							<h5 class="card-header"><span data-collapse-toggle="invasions"></span> <span id="invasions-header">Invasions</h5>
							<div class="card-body overflow-auto">
								<table class="table table-sm table-hover table-borderless mb-0" id="invasions-table"><tr><td>Loading...</td></tr></table>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="labconquest"></span> <span id="labConquest-header">Deep Archimedea</h5>
								<a class="m-auto me-0" data-notif-toggle="labconquest"></a>
							</div>
							<div class="card-body overflow-auto">
								<table class="table table-sm table-borderless table-hover mb-2" id="labConquest-missions">
									<tr><th>Fetching data...</th></tr>
									<tr><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td></tr>
								</table>
								<table class="table table-sm table-borderless mb-0">
									<tr id="labConquest-fv"><td>&nbsp;</td></tr>
								</table>
							</div>
						</div>
						<div class="card">
							<div class="card-header d-flex">
								<h5 class="mb-0"><span data-collapse-toggle="hexconquest"></span> <span id="hexConquest-header">Temporal Archimedea</h5>
								<a class="m-auto me-0" data-notif-toggle="hexconquest"></a>
							</div>
							<div class="card-body overflow-auto">
								<table class="table table-sm table-borderless table-hover mb-2" id="hexConquest-missions">
									<tr><th>Fetching data...</th></tr>
									<tr><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td></tr>
								</table>
								<table class="table table-sm table-borderless mb-0">
									<tr id="hexConquest-fv"><td>&nbsp;</td></tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xxl-4">
						<div class="card mb-3">
							<h5 class="card-header"><span data-collapse-toggle="rj-fissures"></span> Void Storms (Railjack)</h5>
							<div class="card-body overflow-auto">
								<table class="table table-sm table-hover table-borderless mb-0" id="rj-fissures-table"><tr><th>Loading...</th></tr></table>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>
	</div>
	<?php require "components/commonjs.html"; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script>
		const dict_promise = getDictPromise();
		const osdict_promise = getOSDictPromise();
		const dicts_promise = Promise.all([ dict_promise, osdict_promise ]);
		const ExportRegions_promise = fetch("https://browse.wf/warframe-public-export-plus/ExportRegions.json").then(res => res.json());
		const ExportChallenges_promise = fetch("https://browse.wf/warframe-public-export-plus/ExportChallenges.json").then(res => res.json());
		const eMissionType_promise = fetch("https://browse.wf/warframe-public-export-plus/supplementals/eMissionType.json").then(res => res.json());

		dict_promise.then(dict => { window.dict = dict });
		osdict_promise.then(osdict => { window.osdict = osdict });
		ExportRegions_promise.then(res => window.ExportRegions = res);
		ExportChallenges_promise.then(res => window.ExportChallenges = res);
		eMissionType_promise.then(res => window.eMissionType = res);

		function formatExpiry(expiry)
		{
			expiry -= expiry % 1000; expiry += 1000; // normalise the ms so everything ticks at the same time
			const time = Date.now();
			const delta = expiry - time;
			if (delta < 1_000)
			{
				return "Pending update";
			}
			return deltaToUnits(delta).join(" ");
		}

		function deltaToUnits(delta)
		{
			delta = Math.abs(delta);

			let units = [];
			if (delta >= 86_400_000)
			{
				units.push(Math.trunc(delta / 86_400_000) + "d");
				delta %= 86_400_000;
			}
			if (delta >= 3_600_000 || units.length)
			{
				units.push(Math.trunc(delta / 3_600_000) + "h");
				delta %= 3_600_000;
			}
			if (delta >= 60_000 || units.length)
			{
				units.push(Math.trunc(delta / 60_000) + "m");
				delta %= 60_000;
			}
			units.push(Math.trunc(delta / 1_000).toString().padStart(2, "0") + "s");
			return units;
		}

		function formatActivation(activation)
		{
			return deltaToUnits(Date.now() - activation)[0];
		}

		function createExpiryBadge(expiry)
		{
			const span = document.createElement("span");
			span.setAttribute("data-expiry", expiry);
			span.className = "badge text-bg-secondary";
			span.textContent = formatExpiry(expiry);
			return span;
		}

		function setDatum(name, value, expiry)
		{
			const elm = document.getElementById(name);
			elm.querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			elm.textContent = value + " ";
			elm.appendChild(createExpiryBadge(expiry));
		}

		function updateVallis()
		{
			const EPOCH = new Date("November 10, 2018 08:13:48 UTC").getTime();
			const time = Date.now();
			const cycle = Math.trunc((time - EPOCH) / 1600000);
			const cycleStart = EPOCH + cycle * 1600000;
			const cycleEnd = cycleStart + 1600000;
			const cycleColdStart = cycleStart + 400000;
			const stateEnd = (time > cycleColdStart ? cycleEnd : cycleColdStart);
			setDatum("vallis", time > cycleColdStart ? "❄️ Cold" : "☀️ Warm", stateEnd);
			setTimeout(updateVallis, stateEnd - time);
		}
		updateVallis();

		function updateDuviriMoodLocalised()
		{
			setDatum("duviri", osdict[[
				"/Lotus/Language/Duviri/SadMoodTitleShort",
				"/Lotus/Language/Duviri/ScaredMoodTitleShort",
				"/Lotus/Language/Duviri/HappyMoodTitleShort",
				"/Lotus/Language/Duviri/AngryMoodTitleShort",
				"/Lotus/Language/Duviri/JealousMoodTitleShort"
			][window.duviri_mood_index % 5]], window.duviri_expiry);
		}

		function updateDuviriMood()
		{
			const moodIndex = Math.trunc(Date.now() / 7200000);
			const moodStart = moodIndex * 7200000;
			const moodEnd = moodStart + 7200000;

			window.duviri_mood_index = moodIndex;
			window.duviri_expiry = moodEnd;
			updateDuviriMoodLocalised();

			setTimeout(updateDuviriMood, moodEnd - Date.now());
		}
		osdict_promise.then(() => updateDuviriMood());

		let sundown_update_queued = false;
		function updateDayNightCycle()
		{
			const time = Date.now();
			const cycleNightStart = bountyCycleExpiry - 3_000_000;
			const stateEnd = time >= cycleNightStart ? bountyCycleExpiry : cycleNightStart;
			setDatum("poe", time >= cycleNightStart ? "🌑 Night" : "☀️ Day", stateEnd);
			setDatum("deimos", time >= cycleNightStart ? "🌑 Vome" : "☀️ Fass", stateEnd);
			if (time >= cycleNightStart)
			{
				sundown_update_queued = false;
			}
			else if (!sundown_update_queued)
			{
				sundown_update_queued = true;
				setTimeout(updateDayNightCycle, cycleNightStart - Date.now());

				const notifyAt = cycleNightStart - 30 * 1000;
				setTimeout(function()
				{
					if (localStorage.getItem("live.notif.nightfall"))
					{
						sendNotification("The sun sets in 30 seconds.");
					}
				}, notifyAt - Date.now());
			}
		}

		const rotRewards = {
			A: ["/Lotus/Language/Suits/SentientSystemsComponentName", "/Lotus/Language/Weapons/ArchonWhipName"],
			B: ["/Lotus/Language/Suits/SentientChassisComponentName", "/Lotus/Language/Weapons/ArchonDualDaggersName"],
			C: ["/Lotus/Language/Suits/SentientHelmetComponentName", "/Lotus/Language/Weapons/ArchonTridentName"],
		};

		const vaultRotRewards = {
			A: ["/Lotus/Language/Weapons/InfSniperRifleBarrel"],
			B: ["/Lotus/Language/Weapons/InfSniperRifleReceiver"],
			C: ["/Lotus/Language/Weapons/InfSniperRifleStock"],
		};

		const allyNames = {
			"/Lotus/Types/Gameplay/1999Wf/ProtoframeAllies/AmirAllyAgent": "Amir",
			"/Lotus/Types/Gameplay/1999Wf/ProtoframeAllies/AoiAllyAgent": "Aoi",
			"/Lotus/Types/Gameplay/1999Wf/ProtoframeAllies/ArthurAllyAgent": "Arthur",
			"/Lotus/Types/Gameplay/1999Wf/ProtoframeAllies/EleanorAllyAgent": "Eleanor",
			"/Lotus/Types/Gameplay/1999Wf/ProtoframeAllies/LettieAllyAgent": "Lettie",
			"/Lotus/Types/Gameplay/1999Wf/ProtoframeAllies/QuincyAllyAgent": "Quincy",
		};

		function updateBountyCycleLocalised()
		{
			document.getElementById("bounty-rot-rewards").textContent = rotRewards[bountyCycle.rot].map(x => dict[x]).join(", ");
			document.getElementById("vault-rot-rewards").textContent = vaultRotRewards[bountyCycle.vaultRot].map(x => dict[x]).join(", ");
			setDatum("zariman", dict[bountyCycle.zarimanFaction == "FC_GRINEER" ? "/Lotus/Language/Game/Faction_GrineerUC" : "/Lotus/Language/Game/Faction_CorpusUC"], bountyCycle.expiry);
			setDatum("bounties-header", "Bounties", bountyCycle.expiry);
			for (const syndicateTag of ["HexSyndicate", "EntratiLabSyndicate", "ZarimanSyndicate"])
			{
				const rows = document.getElementById(syndicateTag + "-table").querySelectorAll("tr");
				for (let i = 0; i != bountyCycle.bounties[syndicateTag].length; ++i)
				{
					const node = ExportRegions[bountyCycle.bounties[syndicateTag][i].node];
					rows[i].querySelector(".mission").textContent = dict[node.name];
					if (["SolNode850", "SolNode853", "SolNode854", "SolNode856"].indexOf(bountyCycle.bounties[syndicateTag][i].node) == -1)
					{
						rows[i].querySelector(".mission").textContent += " (" + toTitleCase(dict[node.missionName]) + ")";
					}
					if (bountyCycle.bounties[syndicateTag][i].ally)
					{
						rows[i].querySelector(".ally").textContent = allyNames[bountyCycle.bounties[syndicateTag][i].ally];
					}
					const challenge = ExportChallenges[bountyCycle.bounties[syndicateTag][i].challenge];
					const span = document.createElement("span");
					span.textContent = dict[challenge.description].split("\r\n").pop().split("|COUNT|").join(challenge.requiredCount);
					addTooltip(span, dict[challenge.name]);
					rows[i].querySelector(".challenge").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
					rows[i].querySelector(".challenge").innerHTML = "";
					rows[i].querySelector(".challenge").appendChild(span);
				}
			}
		}

		function updateBountyCycle()
		{
			window.refresh_bounty_cycle_at = undefined;
			fetch("https://oracle.browse.wf/bounty-cycle").then(res => res.json()).then(async (bountyCycle) =>
			{
				if (window.bountyCycle && window.bountyCycle.expiry != bountyCycle.expiry && localStorage.getItem("live.notif.bounties"))
				{
					sendNotification("New bounties are available.");
				}
				const stale = window.bountyCycle && window.bountyCycle.expiry == bountyCycle.expiry;
				window.bountyCycle = bountyCycle;
				window.bountyCycleExpiry = bountyCycle.expiry;
				updateDayNightCycle();
				await dicts_promise;
				await ExportRegions_promise;
				await ExportChallenges_promise;
				document.getElementById("bounty-rot").textContent = bountyCycle.rot;
				document.getElementById("vault-rot").textContent = bountyCycle.vaultRot;
				updateBountyCycleLocalised();
				window.refresh_bounty_cycle_at = (stale ? (Date.now() + 60_000) : Math.max(Date.now(), bountyCycleExpiry));
			}).catch(e =>
			{
				console.error(e);
				setTimeout(updateBountyCycle, 5000);
			});
		}

		function updateNames()
		{
			document.getElementById("poe-name").textContent = dict["/Lotus/Language/Locations/EidolonPlains"] + " / " + dict["/Lotus/Language/Locations/Earth"];
			document.getElementById("vallis-name").textContent = dict["/Lotus/Language/Locations/VenusLandscape"];
			document.getElementById("deimos-name").textContent = dict["/Lotus/Language/InfestedMicroplanet/SolarMapDeimosLandscapeName"];
			document.getElementById("zariman-name").textContent = dict["/Lotus/Language/Zariman/ZarimanRegionName"];
			document.getElementById("duviri-name").textContent = dict["/Lotus/Language/Locations/Duviri"];
			document.getElementById("HexSyndicate-name").textContent = dict["/Lotus/Language/1999/MessengerHexName"];
			document.getElementById("EntratiLabSyndicate-name").textContent = dict["/Lotus/Language/EntratiLab/EntratiGeneral/EntratiLabSyndicateName"];
			document.getElementById("ZarimanSyndicate-name").textContent = dict["/Lotus/Language/Syndicates/ZarimanName"];
		}

		function updateArbyLocalised()
		{
			setDatum("arby-header", osdict["/Lotus/Language/Menu/AlertHardMode"], arby_expiry);
			document.getElementById("arby-what").textContent = toTitleCase(dict[arby_node.missionName]) + " - " + dict[arby_node.factionName];
			document.getElementById("arby-where").textContent = "@ " + dict[arby_node.name] + ", " + dict[arby_node.systemName];
		}

		function updateArby()
		{
			const currentHour = Math.trunc(Date.now() / 3600000) * 3600;
			const epochHour = arbys[0][0];
			const currentHourIndex = (currentHour - epochHour) / 3600;
			const arr = arbys[currentHourIndex];
			window.arby_node = ExportRegions[arr[1]];
			window.arby_expiry = (currentHour + 3600) * 1000;
			updateArbyLocalised();
			document.getElementById("arby-tier").textContent = arbyTiers[arr[1]] ?? "F";
			setTimeout(updateArby, arby_expiry - Date.now());
		}

		function updateIncursionsLocalised()
		{
			setDatum("incursions-header", toTitleCase(osdict["/Lotus/Language/Labels/SteelPathDailies"]), incursions_expiry);
			const elms = document.querySelectorAll("#incursions-body span.d-block");
			for (let i = 0; i != elms.length; ++i)
			{
				const node = ExportRegions[incursions_today[i]];
				elms[i].innerHTML = "";
				const b = document.createElement("b");
				b.textContent = toTitleCase(dict[node.missionName]);
				if (node.systemIndex != 21)
				{
					b.textContent += " - " + toTitleCase(dict[node.factionName]);
				}
				elms[i].appendChild(b);
				elms[i].innerHTML += " (" + (100 + node.minEnemyLevel) + "-" + (100 + node.maxEnemyLevel) + ")" + " @ " + dict[node.name] + ", " + dict[node.systemName];
			}
		}

		function updateIncursions()
		{
			const today = Math.trunc(Date.now() / 86400000) * 86400;
			const epochDay = incursions[0][0];
			window.incursions_today = incursions[(today - epochDay) / 86400][1].split(",");
			window.incursions_expiry = (today + 86400) * 1000;
			updateIncursionsLocalised();
			setTimeout(updateIncursions, incursions_expiry - Date.now());
		}

		function addTooltip(elm, title)
		{
			elm.setAttribute("data-bs-toggle", "tooltip");
			elm.setAttribute("data-bs-title", title);
			return new bootstrap.Tooltip(elm);
		}

		function updateWeeklyLocalised()
		{
			{
				setDatum("labConquest-header", osdict["/Lotus/Language/Conquest/SolarMapLabConquestNode"], refresh_weekly_at);
				document.getElementById("labConquest-header").innerHTML += " ";
				document.getElementById("labConquest-header").appendChild(createCompletionToggle("labconquest-" + refresh_weekly_at));
				const tbody = document.createElement("tbody");
				for (const mission of weekly.labConquestMissions)
				{
					const tr = document.createElement("tr");
					{
						const th = document.createElement("th");
						th.textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_" + mission.type] ?? mission.type);
						tr.appendChild(th);
					}
					{
						const td = document.createElement("td");
						const abbr = document.createElement("abbr");
						abbr.textContent = osdict["/Lotus/Language/Conquest/MissionVariant_LabConquest_" + mission.variant];
						addTooltip(abbr, osdict["/Lotus/Language/Conquest/MissionVariant_LabConquest_" + mission.variant + "_Desc"]);
						td.appendChild(abbr);
						tr.appendChild(td);
					}
					for (let i = 0; i != 2; ++i)
					{
						const td = document.createElement("td");
						const abbr = document.createElement("abbr");
						abbr.textContent = osdict["/Lotus/Language/Conquest/Condition_" + mission.conditions[i]];
						addTooltip(abbr, osdict["/Lotus/Language/Conquest/Condition_" + mission.conditions[i] + "_Desc"]);
						td.appendChild(abbr);
						tr.appendChild(td);
					}
					tbody.appendChild(tr);
				}
				document.getElementById("labConquest-missions").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
				document.getElementById("labConquest-missions").innerHTML = "";
				document.getElementById("labConquest-missions").appendChild(tbody);
				document.getElementById("labConquest-fv").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
				document.getElementById("labConquest-fv").innerHTML = "";
				for (const fv of weekly.labConquestFrameVariables)
				{
					const td = document.createElement("td");
					const abbr = document.createElement("abbr");
					abbr.textContent = osdict["/Lotus/Language/Conquest/PersonalMod_" + fv];
					let desc = osdict["/Lotus/Language/Conquest/PersonalMod_" + fv + "_Desc"].replaceAll(/<[^>]+>/g, "");
					if (fv == "ShieldDelay")
					{
						desc = desc.split("|val|").join("500");
					}
					else if (fv == "TimeDilation")
					{
						desc = desc.split("|val|").join("50");
					}
					addTooltip(abbr, desc);
					td.appendChild(abbr);
					document.getElementById("labConquest-fv").appendChild(td);
				}
			}

			{
				setDatum("hexConquest-header", osdict["/Lotus/Language/1999Echoes/1999HexConquestNode"], refresh_weekly_at);
				document.getElementById("hexConquest-header").innerHTML += " ";
				document.getElementById("hexConquest-header").appendChild(createCompletionToggle("hexconquest-" + refresh_weekly_at));
				const tbody = document.createElement("tbody");
				for (const mission of weekly.hexConquestMissions)
				{
					const tr = document.createElement("tr");
					{
						const th = document.createElement("th");
						th.textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_" + mission.type] ?? mission.type);
						tr.appendChild(th);
					}
					{
						const td = document.createElement("td");
						const abbr = document.createElement("abbr");
						abbr.textContent = osdict["/Lotus/Language/Conquest/MissionVariant_HexConquest_" + mission.variant];
						addTooltip(abbr, osdict["/Lotus/Language/Conquest/MissionVariant_HexConquest_" + mission.variant + "_Desc"]);
						td.appendChild(abbr);
						tr.appendChild(td);
					}
					for (let i = 0; i != 2; ++i)
					{
						const td = document.createElement("td");
						const abbr = document.createElement("abbr");
						abbr.textContent = osdict["/Lotus/Language/Conquest/Condition_" + mission.conditions[i]];
						addTooltip(abbr, osdict["/Lotus/Language/Conquest/Condition_" + mission.conditions[i] + "_Desc"]);
						td.appendChild(abbr);
						tr.appendChild(td);
					}
					tbody.appendChild(tr);
				}
				document.getElementById("hexConquest-missions").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
				document.getElementById("hexConquest-missions").innerHTML = "";
				document.getElementById("hexConquest-missions").appendChild(tbody);
				document.getElementById("hexConquest-fv").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
				document.getElementById("hexConquest-fv").innerHTML = "";
				for (const fv of weekly.hexConquestFrameVariables)
				{
					const td = document.createElement("td");
					const abbr = document.createElement("abbr");
					abbr.textContent = osdict["/Lotus/Language/Conquest/PersonalMod_" + fv];
					let desc = osdict["/Lotus/Language/Conquest/PersonalMod_" + fv + "_Desc"].replaceAll(/<[^>]+>/g, "");
					if (fv == "ShieldDelay")
					{
						desc = desc.split("|val|").join("500");
					}
					else if (fv == "TimeDilation")
					{
						desc = desc.split("|val|").join("50");
					}
					addTooltip(abbr, desc);
					td.appendChild(abbr);
					document.getElementById("hexConquest-fv").appendChild(td);
				}
			}
		}

		function updateWeekly()
		{
			window.refresh_weekly_at = undefined;
			Promise.all([
				fetch("https://oracle.browse.wf/weekly").then(res => res.json()),
				dicts_promise
			]).then(([weekly]) =>
			{
				if (window.weekly)
				{
					const weekly_notifications_subscribed_to = [];
					if (localStorage.getItem("live.notif.litesortie"))
					{
						weekly_notifications_subscribed_to.push("Archon Hunt");
					}
					if (localStorage.getItem("live.notif.teshin"))
					{
						weekly_notifications_subscribed_to.push("Vendors");
					}
					if (localStorage.getItem("live.notif.circuit"))
					{
						weekly_notifications_subscribed_to.push("Weekly Missions");
					}
					if (localStorage.getItem("live.notif.labconquest"))
					{
						weekly_notifications_subscribed_to.push("Deep Archimedea");
					}
					if (localStorage.getItem("live.notif.hexconquest"))
					{
						weekly_notifications_subscribed_to.push("Temporal Archimedea");
					}
					if (weekly_notifications_subscribed_to.length != 0)
					{
						sendNotification("It's a new week. " + weekly_notifications_subscribed_to.join(", ") + " refreshed.");
					}
				}
				window.weekly = weekly;
				window.refresh_weekly_at = weekly.expiry * 1000;
				updateWeeklyLocalised();
			}).catch(e =>
			{
				console.error(e);
				setTimeout(updateWeekly, 5000);
			});
		}

		function updateNewsTicker()
		{
			let highest_time = 0;
			const items = [];
			if (window.worldState)
			{
				const LanguageCode = (localStorage.getItem("lang") ?? "en");
				for (const event of window.worldState.Events)
				{
					if (event.Date)
					{
						const time = Math.trunc(event.Date.$date.$numberLong / 1000);
						if (time > highest_time)
						{
							highest_time = time;
						}
						let msg = event.Messages.find(x => x.LanguageCode == LanguageCode)?.Message;
						msg ??= event.Msg;
						if (msg && msg != "/Lotus/Language/CommunityMessages/JoinDiscord")
						{
							items.push({
								type: event.Community ? "success" : "primary",
								data: msg,
								time: time,
								link: event.Prop
							});
						}
					}
				}
			}
			if (window.redtext)
			{
				const cutoff = (Date.now() / 1000) - (30 * 86400);
				for (const event of window.redtext)
				{
					if (event.time > cutoff)
					{
						if (event.time > highest_time)
						{
							highest_time = event.time;
						}
						items.push({
							type: "danger",
							data: event.data.split("WALLOPS :")[1],
							time: event.time
						});
					}
				}
			}
			items.sort((a, b) => b.time - a.time);

			if (window.news_notify_after && localStorage.getItem("live.notif.news"))
			{
				for (let i = items.length; i-- != 0; )
				{
					if (items[i].time > news_notify_after)
					{
						sendNotification(items[i].data);
					}
				}
			}
			if (window.worldState && window.redtext)
			{
				window.refresh_news_sources_at = Date.now() + 60_000;
				window.news_notify_after = highest_time;
			}

			document.getElementById("news-body").innerHTML = "";
			for (let i = 0; i != items.length; ++i)
			{
				const p = document.createElement("p");
				p.className = "card-text mb-1";
				{
					const span = document.createElement("span");
					span.className = "badge text-bg-secondary";
					span.setAttribute("data-activation", items[i].time * 1000);
					span.textContent = formatActivation(items[i].time * 1000);
					p.appendChild(span);
				}
				{
					const span = document.createElement("span");
					span.className = "text-" + items[i].type;
					span.textContent = " ";
					if (items[i].link)
					{
						const a = document.createElement("a");
						a.className = "text-" + items[i].type;
						a.textContent = items[i].data;
						a.href = items[i].link;
						a.target = "_blank";
						span.appendChild(a);
					}
					else
					{
						span.textContent += items[i].data;
					}
					p.appendChild(span);
				}
				document.getElementById("news-body").appendChild(p);
			}
			document.querySelector("#news-body > :last-child").classList.remove("mb-1");
		}

		async function updateNewsSources()
		{
			window.refresh_news_sources_at = undefined;

			const sourcesToUpdate = {
				events: !window.worldState,
				redtext: !window.redtext,
			};
			if (window.worldState || window.redtext)
			{
				try
				{
					const meta = await fetch("https://oracle.browse.wf/min").then(res => res.json());
					if (window.worldState)
					{
						sourcesToUpdate.events = (
							window.events_earmark != meta.latestEvent
							|| worldState.Alerts.length != meta.alerts
							|| worldState.Goals.length != meta.goals
							|| (window.num_fissures && window.num_fissures != meta.fissures)
							);
					}
					if (window.redtext)
					{
						sourcesToUpdate.redtext = (window.redtext[window.redtext.length - 1].time != meta.latestRedtext);
					}
					if (window.dailyDeal)
					{
						document.getElementById("darvo-stock").textContent = (dailyDeal.AmountTotal - meta.darvoSold) + "/" + dailyDeal.AmountTotal;
					}
					if (window.num_invasions && window.num_invasions != meta.invasions)
					{
						updateInvasions();
					}
				}
				catch (e)
				{
					console.error(e);
				}
			}

			if (sourcesToUpdate.events)
			{
				updateWorldState();
			}
			if (sourcesToUpdate.redtext)
			{
				fetch("https://oracle.browse.wf/redtext.json?" + Date.now()).then(res => res.json()).then(redtext =>
				{
					window.redtext = redtext;
					updateNewsTicker();
				});
			}

			if (!sourcesToUpdate.events && !sourcesToUpdate.redtext)
			{
				window.refresh_news_sources_at = Date.now() + 60_000;
			}
		}

		function updateWorldStateLocalised()
		{
			updateNewsTicker();
			updateSorties();
			updateKinePage();
			updateDarvosDeal();
			updateBaro();
			updateAlerts();
			updateGoals();
			updateFissures();
		}

		function updateWorldState()
		{
			window.refresh_world_state_at = undefined;
			fetch("https://oracle.browse.wf/worldState.json?" + Date.now()).then(res => res.json()).then(worldState =>
			{
				window.worldState = worldState;

				window.bountyCycleExpiry = parseInt(worldState.SyndicateMissions.find(x => x.Tag == "HexSyndicate").Expiry.$date.$numberLong);
				updateDayNightCycle();

				window.events_earmark = 0;
				for (const event of worldState.Events)
				{
					if (event.Date)
					{
						const time = Math.trunc(event.Date.$date.$numberLong / 1000);
						if (time > events_earmark)
						{
							events_earmark = time;
						}
					}
				}

				updateWorldStateLocalised();
			});
		}

		const sortieModifiers = {
			"SORTIE_MODIFIER_LOW_ENERGY": "Energy Reduction",
			"SORTIE_MODIFIER_IMPACT": "Enemy Physical Enhancement (Impact)",
			"SORTIE_MODIFIER_SLASH": "Enemy Physical Enhancement (Slash)",
			"SORTIE_MODIFIER_PUNCTURE": "Enemy Physical Enhancement (Puncture)",
			"SORTIE_MODIFIER_EXIMUS": "Eximus Stronghold",
			"SORTIE_MODIFIER_MAGNETIC": "Enemy Elemental Enhancement (Magnetic)",
			"SORTIE_MODIFIER_CORROSIVE": "Enemy Elemental Enhancement (Corrosive)",
			"SORTIE_MODIFIER_VIRAL": "Enemy Elemental Enhancement (Viral)",
			"SORTIE_MODIFIER_ELECTRICITY": "Enemy Elemental Enhancement (Electricity)",
			"SORTIE_MODIFIER_RADIATION": "Enemy Elemental Enhancement (Radiation)",
			"SORTIE_MODIFIER_GAS": "Enemy Elemental Enhancement (Gas)",
			"SORTIE_MODIFIER_FIRE": "Enemy Elemental Enhancement (Heat)",
			"SORTIE_MODIFIER_EXPLOSION": "Enemy Elemental Enhancement (Blast)",
			"SORTIE_MODIFIER_FREEZE": "Enemy Elemental Enhancement (Cold)",
			"SORTIE_MODIFIER_TOXIN": "Enemy Elemental Enhancement (Toxin)",
			"SORTIE_MODIFIER_POISON": "Enemy Elemental Enhancement (Toxin)",
			"SORTIE_MODIFIER_HAZARD_RADIATION": "Radiation Hazard",
			"SORTIE_MODIFIER_HAZARD_MAGNETIC": "Electromagnetic Anomalies",
			"SORTIE_MODIFIER_HAZARD_FOG": "Dense Fog",
			"SORTIE_MODIFIER_HAZARD_FIRE": "Fire Hazard",
			"SORTIE_MODIFIER_HAZARD_ICE": "Cryogenic Leakage",
			"SORTIE_MODIFIER_HAZARD_COLD": "Extreme Cold",
			"SORTIE_MODIFIER_ARMOR": "Augmented Enemy Armor",
			"SORTIE_MODIFIER_SHIELDS": "Enhanced Enemy Shields",
			"SORTIE_MODIFIER_SECONDARY_ONLY": "Pistol Only",
			"SORTIE_MODIFIER_SHOTGUN_ONLY": "Shotgun Only",
			"SORTIE_MODIFIER_SNIPER_ONLY": "Sniper Only",
			"SORTIE_MODIFIER_RIFLE_ONLY": "Assault Rifle Only",
			"SORTIE_MODIFIER_MELEE_ONLY": "Melee Only",
			"SORTIE_MODIFIER_BOW_ONLY": "Bow Only",
		};

		function setWorldStateExpiry(expiry)
		{
			if (Date.now() > expiry)
			{
				console.trace("World state already expired");
				expiry = Date.now() + 30000;
			}
			if (!window.refresh_world_state_at || refresh_world_state_at > expiry)
			{
				window.refresh_world_state_at = expiry;
			}
		}

		async function updateSorties()
		{
			await dicts_promise;
			await eMissionType_promise;

			const sortie = worldState.Sorties.find(x => Date.now() >= x.Activation.$date.$numberLong && Date.now() < x.Expiry.$date.$numberLong);
			setWorldStateExpiry(sortie.Expiry.$date.$numberLong);
			setDatum("sortie-header", toTitleCase(osdict["/Lotus/Language/Menu/SortieMissionName"]), sortie.Expiry.$date.$numberLong);
			document.getElementById("sortie-header").innerHTML += " ";
			document.getElementById("sortie-header").appendChild(createCompletionToggle(sortie._id.$oid));
			const tbody = document.createElement("tbody");
			for (const variant of sortie.Variants)
			{
				const tr = document.createElement("tr");
				const th = document.createElement("th");
				th.textContent = toTitleCase(dict[eMissionType.find(x => x.tag == variant.missionType).name]);
				tr.appendChild(th);
				const td = document.createElement("td");
				td.textContent = sortieModifiers[variant.modifierType];
				tr.appendChild(td);
				tbody.appendChild(tr);
			}
			document.getElementById("sortie-table").innerHTML = "";
			document.getElementById("sortie-table").appendChild(tbody);
			if (window.last_sortie && window.last_sortie != sortie._id.$oid && localStorage.getItem("live.notif.sortie"))
			{
				sendNotification("A new sortie is available.");
			}
			window.last_sortie = sortie._id.$oid;

			const litesortie = worldState.LiteSorties.find(x => Date.now() >= x.Activation.$date.$numberLong && Date.now() < x.Expiry.$date.$numberLong);
			setWorldStateExpiry(litesortie.Expiry.$date.$numberLong);
			setDatum("litesortie-header", osdict["/Lotus/Language/WorldStateWindow/LiteSortieMissionName"], litesortie.Expiry.$date.$numberLong);
			document.getElementById("litesortie-header").innerHTML += " ";
			document.getElementById("litesortie-header").appendChild(createCompletionToggle(litesortie._id.$oid));
			const mission_names = [];
			for (const mission of litesortie.Missions)
			{
				mission_names.push(toTitleCase(dict[eMissionType.find(x => x.tag == mission.missionType).name]));
			}
			const span = document.createElement("span");
			span.textContent = toTitleCase(litesortie.Boss.substr(12));
			span.className = "text-" + { "Amar": "danger", "Nira": "warning", "Boreal": "info" }[span.textContent];
			document.getElementById("litesortie-body").innerHTML = "";
			document.getElementById("litesortie-body").appendChild(span);
			document.getElementById("litesortie-body").innerHTML += " • " + mission_names.join(", ");
		}

		function updateKinePage()
		{
			const Tmp = JSON.parse(worldState.Tmp ?? "{}");
			const lang_code = (localStorage.getItem("lang") ?? "en");
			if (Tmp.pgr && Tmp.pgr[lang_code])
			{
				document.getElementById("pgr").textContent = Tmp.pgr[lang_code];
			}
		}

		async function updateDarvosDeal()
		{
			window.dailyDeal = worldState.DailyDeals.find(x => Date.now() >= x.Activation.$date.$numberLong && Date.now() < x.Expiry.$date.$numberLong);
			setDatum("darvo-header", "Darvo's Deal", dailyDeal.Expiry.$date.$numberLong);
			setWorldStateExpiry(dailyDeal.Expiry.$date.$numberLong);
			const item_data = await getItemDataPromise(dailyDeal.StoreItem);
			await dicts_promise;
			document.getElementById("darvo-item").textContent = dict[item_data.name];
			document.getElementById("darvo-icon").src = "https://browse.wf" + item_data.icon;
			document.getElementById("darvo-stock").textContent = (dailyDeal.AmountTotal - dailyDeal.AmountSold) + "/" + dailyDeal.AmountTotal;
			document.getElementById("darvo-ogprice").textContent = dailyDeal.OriginalPrice;
			document.getElementById("darvo-price").textContent = dailyDeal.SalePrice;
			document.getElementById("darvo-discount").textContent = dailyDeal.Discount;

			if (window.last_darvo_deal
				&& window.last_darvo_deal != dailyDeal.Activation.$date.$numberLong
				&& localStorage.getItem("live.notif.darvo")
				)
			{
				sendNotification("Darvo sells " + dict[item_data.name] + " for " + dailyDeal.SalePrice + " Platinum today.");
			}
			window.last_darvo_deal = dailyDeal.Activation.$date.$numberLong;
		}

		async function updateBaro()
		{
			await dicts_promise;
			await ExportRegions_promise;
			document.querySelectorAll(".baro-where").forEach(x => x.textContent = dict[ExportRegions[worldState.VoidTraders[0].Node].name] + ", " + dict[ExportRegions[worldState.VoidTraders[0].Node].systemName]);
			if (worldState.VoidTraders[0].Manifest)
			{
				document.getElementById("baro-soon").classList.add("d-none");
				document.getElementById("baro-now").classList.remove("d-none");

				setWorldStateExpiry(worldState.VoidTraders[0].Expiry.$date.$numberLong);
				setDatum("baro-header", "Baro Ki'Teer", worldState.VoidTraders[0].Expiry.$date.$numberLong);

				for (const item of worldState.VoidTraders[0].Manifest)
				{
					getItemNamePromise(item.ItemType);
				}

				const items = [];
				for (const item of worldState.VoidTraders[0].Manifest)
				{
					const data = { ...item, ...(await getItemDataPromise(item.ItemType)) };
					if (data.compatName)
					{
						data.__type = 0;
					}
					else if (data.damagePerShot)
					{
						data.__type = 1;
					}
					else
					{
						data.__type = 2;
					}
					items.push(data);
				}
				items.sort((a, b) => a.__type - b.__type);

				const tbody = document.createElement("tbody");
				for (const item of items)
				{
					const tr = document.createElement("tr");
					{
						const td = document.createElement("td");
						td.textContent = await getItemNamePromise(item.ItemType);
						tr.appendChild(td);
					}
					{
						const td = document.createElement("td");
						td.className = "text-end";
						td.textContent = item.PrimePrice;
						tr.appendChild(td);
					}
					{
						const td = document.createElement("td");
						td.className = "text-end";
						td.textContent = item.RegularPrice.toLocaleString();
						tr.appendChild(td);
					}
					tbody.appendChild(tr);
				}
				document.getElementById("baro-table").innerHTML = "";
				document.getElementById("baro-table").appendChild(tbody);

				if (window.last_baro_expiry
					&& window.last_baro_expiry != worldState.VoidTraders[0].Expiry.$date.$numberLong
					&& localStorage.getItem("live.notif.baro")
					)
				{
					sendNotification("Baro Ki'Teer has arrived at " + document.querySelector(".baro-where").textContent + ".");
				}
				window.last_baro_expiry = worldState.VoidTraders[0].Expiry.$date.$numberLong;
			}
			else
			{
				document.getElementById("baro-soon").classList.remove("d-none");
				document.getElementById("baro-now").classList.add("d-none");

				setWorldStateExpiry(worldState.VoidTraders[0].Activation.$date.$numberLong);
				setDatum("baro-header", "Baro Ki'Teer", worldState.VoidTraders[0].Activation.$date.$numberLong);

				window.last_baro_expiry = 69;
			}
		}

		async function updateAlerts()
		{
			if (worldState.Alerts.length != 0)
			{
				const promises = [eMissionType_promise];
				for (const alert of worldState.Alerts)
				{
					promises.push(getFactionNamePromise(alert.MissionInfo.faction));
					if (alert.MissionInfo.missionReward.items)
					{
						for (const reward of alert.MissionInfo.missionReward.items)
						{
							promises.push(getItemNamePromise(reward));
						}
					}
					if (alert.MissionInfo.missionReward.countedItems)
					{
						for (const reward of alert.MissionInfo.missionReward.countedItems)
						{
							promises.push(getItemNamePromise(reward.ItemType));
						}
					}
				}
				await Promise.all(promises);

				document.getElementById("alerts-body").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
				document.getElementById("alerts-body").innerHTML = "";
				for (const alert of worldState.Alerts)
				{
					const block = document.createElement("div");
					block.className = "card-block";
					{
						const span = document.createElement("span");
						span.className = "d-block";
						{
							const b = document.createElement("b");
							b.textContent = toTitleCase(dict[eMissionType.find(x => x.tag == alert.MissionInfo.missionType).name]) + " - " + (await getFactionNamePromise(alert.MissionInfo.faction));
							span.appendChild(b);
						}
						span.innerHTML += " (" + alert.MissionInfo.minEnemyLevel + "-" + alert.MissionInfo.maxEnemyLevel + ") @ "+ dict[ExportRegions[alert.MissionInfo.location].name] + ", " + dict[ExportRegions[alert.MissionInfo.location].systemName] + " ";
						span.appendChild(createExpiryBadge(alert.Expiry.$date.$numberLong));
						setWorldStateExpiry(alert.Expiry.$date.$numberLong);
						span.innerHTML += " ";
						span.appendChild(createCompletionToggle(alert._id.$oid));
						block.appendChild(span);
					}
					{
						const span = document.createElement("span");
						span.className = "d-block";
						span.textContent = alert.MissionInfo.missionReward.credits.toLocaleString() + " Credits";
						block.appendChild(span);
					}
					if (alert.MissionInfo.missionReward.items)
					{
						for (const reward of alert.MissionInfo.missionReward.items)
						{
							const span = document.createElement("span");
							span.className = "d-block";
							span.textContent = await getItemNamePromise(reward);
							block.appendChild(span);
						}
					}
					if (alert.MissionInfo.missionReward.countedItems)
					{
						for (const reward of alert.MissionInfo.missionReward.countedItems)
						{
							const span = document.createElement("span");
							span.className = "d-block";
							span.textContent = reward.ItemCount + "X " + await getItemNamePromise(reward.ItemType);
							block.appendChild(span);
						}
					}
					document.getElementById("alerts-body").appendChild(block);
				}
			}
			else
			{
				document.getElementById("alerts-body").textContent = "None right now.";
			}

			if ("last_alert_count" in window && worldState.Alerts.length > window.last_alert_count && localStorage.getItem("live.notif.alerts"))
			{
				const diff = (worldState.Alerts.length - window.last_alert_count);
				sendNotification(diff == 1 ? "A new alert is live." : diff + " new alerts are live.");
			}
			window.last_alert_count = worldState.Alerts.length;
		}

		async function updateGoals()
		{
			if (worldState.Goals.length != 0)
			{
				await osdict_promise;
				const goal_names = [];
				for (const goal of worldState.Goals)
				{
					goal_names.push(osdict[goal.Desc] ? toTitleCase(osdict[goal.Desc]) : goal.Desc);
				}
				document.getElementById("goals-body").textContent = goal_names.join(", ");
			}
			else
			{
				document.getElementById("goals-body").textContent = "None right now.";
			}
		}

		function updateTeshin()
		{
			const EPOCH = 1736121600 * 1000;
			const week = Math.trunc((Date.now() - EPOCH) / 604800000);
			const weekStart = EPOCH + week * 604800000;
			const weekEnd = weekStart + 604800000;
			setDatum("vendors-header", "Vendors", weekEnd);

			document.getElementById("teshin-offer").textContent = [
				"Umbra Forma Blueprint",
				"50,000x Kuva",
				"Kitgun Riven Mod",
				"3x Forma",
				"Zaw Riven Mod",
				"30,000x Endo",
				"Rifle Riven Mod",
				"Shotgun Riven Mod"
			][week % 8];
			document.getElementById("teshin-check").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("teshin-check").innerHTML = "";
			document.getElementById("teshin-check").appendChild(createCompletionToggle("teshin" + week));

			document.getElementById("ironwake-check").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("ironwake-check").innerHTML = "";
			document.getElementById("ironwake-check").appendChild(createCompletionToggle("ironwake" + week));

			setTimeout(updateTeshin, weekEnd - Date.now());
		}
		updateTeshin();

		const frameChoices = [
			["/Lotus/Language/Suits/InfestationName", "/Lotus/Language/Suits/BardName", "/Lotus/Language/Suits/PriestName"],
			["/Lotus/Language/Suits/GlassName", "/Lotus/Language/Suits/KhoraName", "/Lotus/Language/Suits/RevenantName"],
			["/Lotus/Language/Suits/GarudaName", "/Lotus/Language/Suits/PacifistName", "/Lotus/Language/Suits/IronFrameName"],
			["/Lotus/Language/Suits/ExcaliburName", "/Lotus/Language/Suits/TrinityName", "/Lotus/Language/Suits/EmberName"],
			["/Lotus/Language/Suits/LokiName", "/Lotus/Language/Suits/MagName", "/Lotus/Language/Suits/RhinoName"],
			["/Lotus/Language/Suits/AshName", "/Lotus/Language/Suits/FrostName", "/Lotus/Language/Suits/NyxName"],
			["/Lotus/Language/Suits/SarynName", "/Lotus/Language/Suits/VaubanName", "/Lotus/Language/Suits/NovaName"],
			["/Lotus/Language/Suits/NekrosName", "/Lotus/Language/Suits/ValkyrName", "/Lotus/Language/Suits/OberonName"],
			["/Lotus/Language/Suits/HydroidName", "/Lotus/Language/Suits/MirageName", "/Lotus/Language/Suits/LimboName"],
			["/Lotus/Language/Suits/MesaName", "/Lotus/Language/Suits/ChromaName", "/Lotus/Language/Suits/AtlasName"],
			["/Lotus/Language/Suits/IvaraName", "/Lotus/Language/Suits/InarosName", "/Lotus/Language/Suits/TitaniaName"]
		];

		const weaponChoices = [
			["/Lotus/Language/Items/AutoShotgunName", "/Lotus/Language/Items/ReconnasorName", "/Lotus/Language/Items/CorpusHandRocketLauncherName", "/Lotus/Language/Items/HeavyRifleName", "/Lotus/Language/Items/ParisScytheName"],
			["/Lotus/Language/Items/StaffName", "/Lotus/Language/Items/SemiAutoRifleName", "/Lotus/Language/Items/AutoPistolName", "/Lotus/Language/Items/FistName", "/Lotus/Language/Items/ShotgunName"],
			["/Lotus/Language/Locations/Lex", "/Lotus/Language/Items/PaladinMaceName", "/Lotus/Language/Items/BoltoRifleName", "/Lotus/Language/Items/HandCannonName", "/Lotus/Language/Items/CeramicDaggerName"],
			["/Lotus/Language/ClanTech/Torid", "/Lotus/Language/Items/InfestedLexName", "/Lotus/Language/Weapons/InfestedDualAxeName", "/Lotus/Language/Items/GrineerSawbladeGunName", "/Lotus/Language/Items/GrnHeatGunName"],
			["/Lotus/Language/Items/RegorAxeShieldName", "/Lotus/Language/Items/TennoAssaultRifleName", "/Lotus/Language/Items/TennoRevolverName", "/Lotus/Language/Items/NamiSoloName", "/Lotus/Language/Items/BurstRifleName"],
			["/Lotus/Language/Weapons/SybarisPistolName", "/Lotus/Language/Items/IceHammerName", "/Lotus/Language/Items/StalkerBowName", "/Lotus/Language/Items/StalkerKunaiName", "/Lotus/Language/Items/StalkerScytheName"],
			["/Lotus/Language/Items/EnergyRifleName", "/Lotus/Language/Items/TennoLeverActionRifleName", "/Lotus/Language/Items/CorpusMinigunName", "/Lotus/Language/Items/BurstPistolName", "/Lotus/Language/Items/TennoSaiName"],
			["/Lotus/Language/Items/RifleName", "/Lotus/Language/Items/PistolName", "/Lotus/Language/Items/LongSwordName", "/Lotus/Language/Items/HuntingBowName", "/Lotus/Language/Items/KunaiName"]
		];

		function updateCircuitLocalised()
		{
			const EPOCH = 1734307200 * 1000;
			const week = Math.trunc((Date.now() - EPOCH) / 604800000);
			document.getElementById("circuit-frames").textContent = [...frameChoices[week % frameChoices.length]].map(x => dict[x]).join(" · ") + " ";
			document.getElementById("circuit-weapons").textContent = [...weaponChoices[week % weaponChoices.length]].map(x => dict[x]).join(" · ") + " ";
		}

		function updateCircuit()
		{
			const EPOCH = 1734307200 * 1000;
			const week = Math.trunc((Date.now() - EPOCH) / 604800000);
			const weekStart = EPOCH + week * 604800000;
			const weekEnd = weekStart + 604800000;
			setDatum("circuit-header", "Weekly Missions", weekEnd);
			updateCircuitLocalised();

			document.getElementById("clem-check").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("clem-check").innerHTML = "";
			document.getElementById("clem-check").appendChild(createCompletionToggle("clem" + week));

			document.getElementById("maroo-check").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("maroo-check").innerHTML = "";
			document.getElementById("maroo-check").appendChild(createCompletionToggle("maroo" + week));

			document.getElementById("circuit-frames-check").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("circuit-frames-check").innerHTML = "";
			document.getElementById("circuit-frames-check").appendChild(createCompletionToggle("circuit-normal-" + week));

			document.getElementById("circuit-weapons-check").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("circuit-weapons-check").innerHTML = "";
			document.getElementById("circuit-weapons-check").appendChild(createCompletionToggle("circuit-hard-" + week));

			document.getElementById("netracell-checks").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("netracell-checks").innerHTML = "";
			document.getElementById("netracell-checks").appendChild(createCompletionToggle("netracell1-" + week));
			document.getElementById("netracell-checks").appendChild(createCompletionToggle("netracell2-" + week));
			document.getElementById("netracell-checks").appendChild(createCompletionToggle("netracell3-" + week));
			document.getElementById("netracell-checks").appendChild(createCompletionToggle("netracell4-" + week));
			document.getElementById("netracell-checks").appendChild(createCompletionToggle("netracell5-" + week));

			document.getElementById("kahl-checks").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("kahl-checks").innerHTML = "";
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahl-" + week));
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahlb1-" + week));
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahlb2-" + week));
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahlb3-" + week));
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahlb4-" + week));
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahlb5-" + week));
			document.getElementById("kahl-checks").appendChild(createCompletionToggle("kahlb6-" + week));

			setTimeout(updateCircuit, weekEnd - Date.now());
		}
		dict_promise.then(updateCircuit);

		function loadScriptPromise(src)
		{
			return new Promise((resolve, reject) =>
			{
				const script = document.createElement("script");
				script.src = src;
				script.onload = resolve;
				script.onerror = reject;
				document.documentElement.appendChild(script);
			});
		}

		const item_data_promises = {};
		function getItemDataPromise(uniqueName)
		{
			uniqueName = uniqueName.split("/Lotus/StoreItems/").join("/Lotus/");
			if (!item_data_promises[uniqueName])
			{
				item_data_promises[uniqueName] = fetch("https://browse.wf" + uniqueName).then(res => res.json());
			}
			return item_data_promises[uniqueName];
		}

		async function getItemNamePromise(uniqueName)
		{
			try
			{
				const item_data = await getItemDataPromise(uniqueName);
				if (item_data.resultType)
				{
					const result_name = await getItemNamePromise(item_data.resultType);
					return dict["/Lotus/Language/Items/BlueprintAndItem"].split("|ITEM|").join(result_name);
				}
				if (item_data.category && item_data.era)
				{
					return dict["/Lotus/Language/Relics/VoidProjectionName"].split("|ERA|").join(item_data.era).split("|CATEGORY|").join(item_data.category);
				}
				await dicts_promise;
				return dict[item_data.name] ?? item_data.name;
			}
			catch (e)
			{
				console.error(e);
				return uniqueName;
			}
		}

		async function getFactionNamePromise(tag)
		{
			if (!window.eFaction_promise)
			{
				window.eFaction_promise = fetch("https://browse.wf/warframe-public-export-plus/supplementals/eFaction.json").then(res => res.json())
			}
			await dicts_promise;
			return dict[(await eFaction_promise).find(x => x.tag == tag).name];
		}

		function isOidMarkedAsCompleted(oid)
		{
			const arr = JSON.parse(localStorage.getItem("oids_completed") ?? "[]");
			return arr.findIndex(x => x == oid) != -1;
		}

		function toggleOidCompletion(oid)
		{
			const arr = JSON.parse(localStorage.getItem("oids_completed") ?? "[]");
			const index = arr.findIndex(x => x == oid);
			if (index != -1)
			{
				arr.splice(index, 1);
			}
			else
			{
				arr.push(oid);
			}
			localStorage.setItem("oids_completed", JSON.stringify(arr));
		}

		function createCompletionToggle(oid)
		{
			let what = "completed";
			if (oid.substr(0, 5) == "kahlb")
			{
				what += " (Bonus Objective #" + oid.substr(5, 1) + ")";
			}

			const a = document.createElement("a");
			a.className = "completion-check";
			a.textContent = isOidMarkedAsCompleted(oid) ? "🗹" : "☐";
			const tooltip = addTooltip(a, (isOidMarkedAsCompleted(oid) ? "Unmark as " : "Mark as ") + what);
			a.onclick = function()
			{
				toggleOidCompletion(oid);
				a.textContent = isOidMarkedAsCompleted(oid) ? "🗹" : "☐";
				tooltip.setContent({ ".tooltip-inner": (isOidMarkedAsCompleted(oid) ? "Unmark as " : "Mark as ") + what });
			};
			return a;
		}

		async function updateInvasionsLocalised()
		{
			const tbody = document.createElement("tbody");
			let last_id = "";
			window.num_invasions = 0;
			for (const invasion of invasions)
			{
				const tr = document.createElement("tr");
				{
					const th = document.createElement("th");
					if (last_id != invasion.id)
					{
						++num_invasions;
						const node = ExportRegions[invasion.node];
						th.textContent = dict[node.name] + ", " + dict[node.systemName];
					}
					tr.appendChild(th);
				}
				/*{
					const td = document.createElement("td");
					const span = document.createElement("span");
					span.textContent = dict[invasion.ally == "FC_GRINEER" ? "/Lotus/Language/Game/Faction_GrineerUC" : "/Lotus/Language/Game/Faction_CorpusUC"];
					addTooltip(span, "Your ally");
					td.appendChild(span);
					tr.appendChild(td);
				}*/
				{
					const td = document.createElement("td");
					const span = document.createElement("span");
					span.textContent = toTitleCase(dict["/Lotus/Language/Missions/MissionName_" + invasion.missions[0]]);
					addTooltip(span, "Next: " + toTitleCase(dict["/Lotus/Language/Missions/MissionName_" + invasion.missions[1]]));
					td.appendChild(span);
					tr.appendChild(td);
				}
				{
					const td = document.createElement("td");
					if (invasion.allyPay[0].ItemType != "/Lotus/Types/Items/Research/EnergyComponent"
						&& invasion.allyPay[0].ItemType != "/Lotus/Types/Items/Research/ChemComponent"
						&& invasion.allyPay[0].ItemType != "/Lotus/Types/Items/Research/BioComponent"
						&& invasion.allyPay[0].ItemType != "/Lotus/Types/Items/MiscItems/InfestedAladCoordinate"
						)
					{
						td.className = "fw-bolder";
					}
					td.textContent = invasion.allyPay[0].ItemCount + "x " + await getItemNamePromise(invasion.allyPay[0].ItemType);
					tr.appendChild(td);
				}
				{
					const td = document.createElement("td");
					if (last_id != invasion.id)
					{
						td.appendChild(createCompletionToggle(invasion.id));
					}
					tr.appendChild(td);
				}
				tbody.appendChild(tr);
				last_id = invasion.id;
			}
			setDatum("invasions-header", toTitleCase(osdict["/Lotus/Language/Menu/WorldStatePanel_Invasions"]), refresh_invasions_at);
			document.getElementById("invasions-table").querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			document.getElementById("invasions-table").innerHTML = "";
			document.getElementById("invasions-table").appendChild(tbody);
		}

		function updateInvasions()
		{
			window.refresh_invasions_at = undefined;
			fetch("https://oracle.browse.wf/invasions").then(res => res.json()).then(async (res) =>
			{
				const promises = [dicts_promise, ExportRegions_promise];
				for (const invasion of res.invasions)
				{
					promises.push(getItemNamePromise(invasion.allyPay[0].ItemType));
				}
				await Promise.all(promises);

				window.invasions = res.invasions;
				window.refresh_invasions_at = res.expiry * 1000;

				updateInvasionsLocalised();
			}).catch(e =>
			{
				console.error(e);
				setTimeout(updateInvasions, 5000);
			});
		}

		function setFissuresExpiry(expiry)
		{
			if (!window.refresh_fissures_at || refresh_fissures_at > expiry)
			{
				window.refresh_fissures_at = expiry;
			}
		}

		const fissureTiers = {
			VoidT1: "Lith",
			VoidT2: "Meso",
			VoidT3: "Neo",
			VoidT4: "Axi",
			VoidT5: "Requiem",
			VoidT6: "Omnia",
		};

		async function updateFissures()
		{
			await dict_promise;
			await ExportRegions_promise;

			const fissures = [];
			for (const fissure of worldState.ActiveMissions)
			{
				fissures.push({
					Category: fissure.Hard ? "sp-fissures" : "fissures",
					Hard: fissure.Hard,
					Activation: fissure.Activation,
					Expiry: fissure.Expiry,
					Node: fissure.Node,
					Modifier: fissure.Modifier,
				});
			}
			for (const fissure of worldState.VoidStorms)
			{
				fissures.push({
					Category: "rj-fissures",
					Hard: false,
					Activation: fissure.Activation,
					Expiry: fissure.Expiry,
					Node: fissure.Node,
					Modifier: fissure.ActiveMissionTier,
				});
			}
			fissures.sort((a, b) => a.Modifier.charCodeAt(5) - b.Modifier.charCodeAt(5));

			window.num_fissures = 0;
			const tbody = {
				"fissures": document.createElement("tbody"),
				"sp-fissures": document.createElement("tbody"),
				"rj-fissures": document.createElement("tbody"),
			}
			let last_tier = {};
			for (const fissure of fissures)
			{
				if (Date.now() < fissure.Activation.$date.$numberLong)
				{
					setFissuresExpiry(fissure.Activation.$date.$numberLong);
				}
				else if (Date.now() < fissure.Expiry.$date.$numberLong)
				{
					const tr = document.createElement("tr");
					const th = document.createElement("th");
					if (fissure.Modifier != last_tier[fissure.Hard])
					{
						th.textContent = fissureTiers[fissure.Modifier] ?? fissure.Modifier;
						last_tier[fissure.Hard] = fissure.Modifier;
					}
					tr.appendChild(th);
					const td = document.createElement("td");
					const node = ExportRegions[fissure.Node];
					{
						const b = document.createElement("b");
						b.textContent = toTitleCase(dict[node.missionName]);
						td.appendChild(b);
					}
					{
						const span = document.createElement("span");
						const baselvl = fissure.Hard ? 100 : 0;
						span.textContent = " (" + (node.minEnemyLevel + baselvl) + "-" + (node.maxEnemyLevel + baselvl) + ")";
						if (node.systemIndex != 21)
						{
							span.textContent += " - " + dict[node.factionName];
						}
						if (fissure.Category != "rj-fissures")
						{
							span.textContent += " @ " + dict[node.name] + ", " + dict[node.systemName];
						}
						span.textContent += " ";
						td.appendChild(span);
					}
					td.appendChild(createExpiryBadge(fissure.Expiry.$date.$numberLong));
					tr.appendChild(td);
					tbody[fissure.Category].appendChild(tr);
					setFissuresExpiry(fissure.Expiry.$date.$numberLong);
					++window.num_fissures;
				}
			}
			document.getElementById("fissures-table").innerHTML = "";
			document.getElementById("fissures-table").appendChild(tbody["fissures"]);
			document.getElementById("sp-fissures-table").innerHTML = "";
			document.getElementById("sp-fissures-table").appendChild(tbody["sp-fissures"]);
			document.getElementById("rj-fissures-table").innerHTML = "";
			document.getElementById("rj-fissures-table").appendChild(tbody["rj-fissures"]);
		}

		updateBountyCycle();

		dict_promise.then(() => updateNames());
		dicts_promise.then(([dict, osdict]) =>
		{
			onLanguageUpdate = function()
			{
				updateNames();
				updateDuviriMoodLocalised();
				updateCircuitLocalised();
				if (window.bountyCycle)
				{
					updateBountyCycleLocalised();
				}
				if (window.arbys)
				{
					updateArbyLocalised();
				}
				if (window.incursions)
				{
					updateIncursionsLocalised();
				}
				if (window.weekly)
				{
					updateWeeklyLocalised();
				}
				if (window.worldState)
				{
					updateWorldStateLocalised();
				}
				if (window.invasions)
				{
					updateInvasionsLocalised();
				}
			};

			Promise.all([
				fetch("https://browse.wf/arbys.txt").then(res => res.text()),
				loadScriptPromise("supplemental-data/arbyTiers.js"),
				ExportRegions_promise
			]).then(([arbys]) =>
			{
				window.arbys = arbys.split("\n").map(line => line.split(",")).filter(arr => arr.length == 2);
				updateArby();
			});

			fetch("https://browse.wf/sp-incursions.txt").then(res => res.text()).then(async (incursions) => {
				await ExportRegions_promise;
				window.incursions = incursions.split("\n").map(line => line.split(";")).filter(arr => arr.length == 2);
				updateIncursions();
			});
		});

		updateWeekly();
		updateNewsSources(); // does updateWorldState
		updateInvasions();

		setInterval(function()
		{
			for (const elm of document.querySelectorAll(".badge[data-expiry]"))
			{
				elm.textContent = formatExpiry(elm.getAttribute("data-expiry"));
			}
			for (const elm of document.querySelectorAll(".badge[data-activation]"))
			{
				elm.textContent = formatActivation(elm.getAttribute("data-activation"));
			}
		}, 100);

		setInterval(function()
		{
			if (window.refresh_bounty_cycle_at && Date.now() >= window.refresh_bounty_cycle_at)
			{
				updateBountyCycle();
			}
			if (window.refresh_fissures_at && Date.now() >= window.refresh_fissures_at)
			{
				updateFissures();
			}
			if (window.refresh_news_sources_at && Date.now() >= window.refresh_news_sources_at)
			{
				updateNewsSources();
			}
			if (window.refresh_world_state_at && Date.now() >= window.refresh_world_state_at)
			{
				updateWorldState();
			}
			if (window.refresh_invasions_at && Date.now() >= window.refresh_invasions_at)
			{
				updateInvasions();
			}
			if (window.refresh_weekly_at && Date.now() >= window.refresh_weekly_at)
			{
				updateWeekly();
			}
		}, 500);

		function refreshCollapseStatus(elm)
		{
			const engaged = localStorage.getItem("live.collapse." + elm.getAttribute("data-collapse-toggle"));
			const span = document.createElement("span");
			span.textContent = engaged ? "▼" : "▲";
			if (engaged)
			{
				elm.classList.add("engaged");
			}
			else
			{
				elm.classList.remove("engaged");
			}
			addTooltip(span, engaged ? "Expand" : "Collapse");
			elm.querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			elm.innerHTML = "";
			elm.appendChild(span);
		}

		document.querySelectorAll("[data-collapse-toggle]").forEach(elm =>
		{
			elm.classList.add("text-secondary");
			refreshCollapseStatus(elm);
			elm.onclick = function()
			{
				if (localStorage.getItem("live.collapse." + elm.getAttribute("data-collapse-toggle")))
				{
					localStorage.removeItem("live.collapse." + elm.getAttribute("data-collapse-toggle"));
				}
				else
				{
					localStorage.setItem("live.collapse." + elm.getAttribute("data-collapse-toggle"), "1");
				}
				refreshCollapseStatus(elm);
			};
		});

		function sendNotification(text)
		{
			const toast = document.createElement("div");
			toast.className = "toast align-items-center text-bg-primary border-0";
			const div = document.createElement("div");
			div.className = "d-flex";
			const body = document.createElement("div");
			body.className = "toast-body";
			body.textContent = text;
			div.appendChild(body);
			const button = document.createElement("button");
			button.className = "btn-close btn-close-white me-2 m-auto";
			button.setAttribute("data-bs-dismiss", "toast");
			div.appendChild(button);
			toast.appendChild(div);
			new bootstrap.Toast(document.querySelector(".toast-container").appendChild(toast)).show();

			if (Notification.permission == "granted")
			{
				new Notification(text);
			}
		}

		function refreshNotifStatus(elm)
		{
			const enabled = localStorage.getItem("live.notif." + elm.getAttribute("data-notif-toggle"));
			const span = document.createElement("span");
			span.textContent = enabled ? "🔕" : "🔔";
			const name = elm.getAttribute("data-notif-toggle") == "nightfall" ? "Notifications (30s before Plains of Eidolon nightfall)" : "Notifications";
			addTooltip(span, (enabled ? "Disable " : "Enable ") + name);
			elm.querySelectorAll("[data-bs-toggle=tooltip]").forEach(x => bootstrap.Tooltip.getInstance(x).dispose());
			elm.innerHTML = "";
			elm.appendChild(span);
		}

		document.querySelectorAll("[data-notif-toggle]").forEach(elm =>
		{
			refreshNotifStatus(elm);
			elm.onclick = function()
			{
				if (localStorage.getItem("live.notif." + elm.getAttribute("data-notif-toggle")))
				{
					localStorage.removeItem("live.notif." + elm.getAttribute("data-notif-toggle"));
				}
				else
				{
					localStorage.setItem("live.notif." + elm.getAttribute("data-notif-toggle"), "1");
					if (Notification.permission != "granted")
					{
						Notification.requestPermission().then((permission) =>
						{
							sendNotification("This is an example notification.");
						});
					}
				}
				refreshNotifStatus(elm);
			};
		});

		document.querySelectorAll(".vq-abbr").forEach(elm => addTooltip(elm, "Voidplume Quills"));
	</script>
	<script src="https://censorcanary.org/censorcanary.js" defer></script>
</body>
</html>
