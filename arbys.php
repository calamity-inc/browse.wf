<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>Arbitration Schedule | browse.wf</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<!--<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Arby%27s_logo.svg/1200px-Arby%27s_logo.svg.png">-->
	<link rel="icon" href="https://browse.wf/Lotus/Interface/Icons/Categories/GrimoireModIcon.png">
	<style>
		#log h3:not(:first-child)
		{
			margin-top: 1rem;
		}

		#log span, #log b
		{
			display: block;
			margin-bottom: 1px;
		}
	</style>
</head>
<body data-bs-theme="dark">
	<?php require "components/navbar.php"; ?>
	<div class="p-3">
		<p>
			The next <select id="select-days">
				<option value="1">24 hours</option>
				<option value="7">7 days</option>
				<option value="30" selected>30 days</option>
				<option value="90">90 days</option>
				<option value="365">12 months</option>
				<option value="9999999999">eon</option>
			</select> of arbitrations, in <select id="select-tz">
				<option id="local-time-option" value="local">local time</option>
				<option value="zulu">universal time (UTC+0)</option>
			</select>, using <select id="select-hourfmt">
				<option value="mil">military time</option>
				<option value="24">24-hour time</option>
				<option value="12">12-hour time</option>
			</select>.
		</p>
		<div class="row">
			<div id="log" class="col-xl-6 mb-3">
				<p>Loading, please wait...</p>
			</div>
			<div class="col-xl-6">
				<table class="table">
					<thead>
						<td></td>
						<th colspan="2">Next Occurrence</th>
					</thead>
					<tbody>
						<tr id="next-MT_SURVIVAL"><th><input id="filter-MT_SURVIVAL" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_SURVIVAL">Survival</label></th><td></td><td></td></tr>
						<tr id="next-MT_DEFENSE"><th><input id="filter-MT_DEFENSE" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_DEFENSE">Defense</label></th><td></td><td></td></tr>
						<tr id="next-MT_TERRITORY"><th><input id="filter-MT_TERRITORY" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_TERRITORY">Interception</label></th><td></td><td></td></tr>
						<tr id="next-MT_EXCAVATE"><th><input id="filter-MT_EXCAVATE" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_EXCAVATE">Excavation</label></th><td></td><td></td></tr>
						<tr id="next-MT_PURIFY"><th><input id="filter-MT_PURIFY" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_PURIFY">Infested Salvage</label></th><td></td><td></td></tr>
						<tr id="next-MT_EVACUATION"><th><input id="filter-MT_EVACUATION" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_EVACUATION">Defection</label></th><td></td><td></td></tr>
						<tr id="next-MT_ARTIFACT"><th><input id="filter-MT_ARTIFACT" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_ARTIFACT">Disruption</label></th><td></td><td></td></tr>
						<tr id="next-MT_CORRUPTION"><th><input id="filter-MT_CORRUPTION" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_CORRUPTION">Void Flood</label></th><td></td><td></td></tr>
						<tr id="next-MT_VOID_CASCADE"><th><input id="filter-MT_VOID_CASCADE" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_VOID_CASCADE">Void Cascade</label></th><td></td><td></td></tr>
						<tr id="next-MT_ARMAGEDDON"><th><input id="filter-MT_ARMAGEDDON" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_ARMAGEDDON">Void Armageddon</label></th><td></td><td></td></tr>
						<tr id="next-MT_ALCHEMY"><th><input id="filter-MT_ALCHEMY" type="checkbox" class="form-check-input" checked /> <label for="filter-MT_ALCHEMY">Alchemy</label></th><td></td><td></td></tr>
						<tr id="next-tier-S"><th><input id="filter-tier-S" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-S">S Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-A"><th><input id="filter-tier-A" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-A">A Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-B"><th><input id="filter-tier-B" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-B">B Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-C"><th><input id="filter-tier-C" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-C">C Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-D"><th><input id="filter-tier-D" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-D">D Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-F"><th><input id="filter-tier-F" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-F">F Tier</label></th><td></td><td></td></tr>
						<tr id="next-FC_GRINEER"><th><input id="filter-FC_GRINEER" type="checkbox" class="form-check-input" checked /> <label for="filter-FC_GRINEER">Grineer</label></th><td></td><td></td></tr>
						<tr id="next-FC_CORPUS"><th><input id="filter-FC_CORPUS" type="checkbox" class="form-check-input" checked /> <label for="filter-FC_CORPUS">Corpus</label></th><td></td><td></td></tr>
						<tr id="next-FC_INFESTATION"><th><input id="filter-FC_INFESTATION" type="checkbox" class="form-check-input" checked /> <label for="filter-FC_INFESTATION">Infested</label></th><td></td><td></td></tr>
						<tr id="next-FC_OROKIN"><th><input id="filter-FC_OROKIN" type="checkbox" class="form-check-input" checked /> <label for="filter-FC_OROKIN">Corrupted</label></th><td></td><td></td></tr>
						<tr id="next-FC_MITW"><th><input id="filter-FC_MITW" type="checkbox" class="form-check-input" checked /> <label for="filter-FC_MITW">The Murmur</label></th><td></td><td></td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php require "components/commonjs.html"; ?>
	<script src="supplemental-data/arbyTiers.js"></script>
	<script src="typestripped/arbys.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://censorcanary.org/censorcanary.js" defer></script>
</body>
</html>
