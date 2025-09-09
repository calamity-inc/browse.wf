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
						<tr id="next-type-2"><th><input id="filter-type-2" type="checkbox" class="form-check-input" checked /> <label for="filter-type-2">Survival</label></th><td></td><td></td></tr>
						<tr id="next-type-8"><th><input id="filter-type-8" type="checkbox" class="form-check-input" checked /> <label for="filter-type-8">Defense</label></th><td></td><td></td></tr>
						<tr id="next-type-13"><th><input id="filter-type-13" type="checkbox" class="form-check-input" checked /> <label for="filter-type-13">Interception</label></th><td></td><td></td></tr>
						<tr id="next-type-17"><th><input id="filter-type-17" type="checkbox" class="form-check-input" checked /> <label for="filter-type-17">Excavation</label></th><td></td><td></td></tr>
						<tr id="next-type-21"><th><input id="filter-type-21" type="checkbox" class="form-check-input" checked /> <label for="filter-type-21">Infested Salvage</label></th><td></td><td></td></tr>
						<tr id="next-type-27"><th><input id="filter-type-27" type="checkbox" class="form-check-input" checked /> <label for="filter-type-27">Defection</label></th><td></td><td></td></tr>
						<tr id="next-type-33"><th><input id="filter-type-33" type="checkbox" class="form-check-input" checked /> <label for="filter-type-33">Disruption</label></th><td></td><td></td></tr>
						<tr id="next-type-34"><th><input id="filter-type-34" type="checkbox" class="form-check-input" checked /> <label for="filter-type-34">Void Flood</label></th><td></td><td></td></tr>
						<tr id="next-type-35"><th><input id="filter-type-35" type="checkbox" class="form-check-input" checked /> <label for="filter-type-35">Void Cascade</label></th><td></td><td></td></tr>
						<tr id="next-type-36"><th><input id="filter-type-36" type="checkbox" class="form-check-input" checked /> <label for="filter-type-36">Void Armageddon</label></th><td></td><td></td></tr>
						<tr id="next-type-38"><th><input id="filter-type-38" type="checkbox" class="form-check-input" checked /> <label for="filter-type-38">Alchemy</label></th><td></td><td></td></tr>
						<tr id="next-tier-S"><th><input id="filter-tier-S" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-S">S Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-A"><th><input id="filter-tier-A" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-A">A Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-B"><th><input id="filter-tier-B" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-B">B Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-C"><th><input id="filter-tier-C" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-C">C Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-D"><th><input id="filter-tier-D" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-D">D Tier</label></th><td></td><td></td></tr>
						<tr id="next-tier-F"><th><input id="filter-tier-F" type="checkbox" class="form-check-input" checked /> <label for="filter-tier-F">F Tier</label></th><td></td><td></td></tr>
						<tr id="next-fc-0"><th><input id="filter-fc-0" type="checkbox" class="form-check-input" checked /> <label for="filter-fc-0">Grineer</label></th><td></td><td></td></tr>
						<tr id="next-fc-1"><th><input id="filter-fc-1" type="checkbox" class="form-check-input" checked /> <label for="filter-fc-1">Corpus</label></th><td></td><td></td></tr>
						<tr id="next-fc-2"><th><input id="filter-fc-2" type="checkbox" class="form-check-input" checked /> <label for="filter-fc-2">Infested</label></th><td></td><td></td></tr>
						<tr id="next-fc-3"><th><input id="filter-fc-3" type="checkbox" class="form-check-input" checked /> <label for="filter-fc-3">Corrupted</label></th><td></td><td></td></tr>
						<tr id="next-fc-7"><th><input id="filter-fc-7" type="checkbox" class="form-check-input" checked /> <label for="filter-fc-7">The Murmur</label></th><td></td><td></td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php require "components/commonjs.html"; ?>
	<script src="supplemental-data/arbyTiers.js"></script>
	<script src="arbys.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://censorcanary.org/censorcanary.js" defer></script>
</body>
</html>
