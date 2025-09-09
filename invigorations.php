<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>Invigorations | browse.wf</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="icon" href="https://browse.wf/Lotus/Interface/Icons/Categories/GrimoireModIcon.png">
</head>
<body data-bs-theme="dark">
	<?php require "components/navbar.php"; ?>
	<div class="container pt-3">
		<form onsubmit="doSubmit();return false;">
			<input id="username" class="form-control mb-3" placeholder="Username (case-sensitive)" minlength="4" required />
			<div class="form-check mb-3">
				<input class="form-check-input" type="checkbox" id="peek">
				<label class="form-check-label" for="peek">I've already visited Helminth this week</label>
			</div>
			<h5 id="input-header">Previous Offerings</h5>
			<div class="row g-2 mb-2">
				<div class="col-4">
					<select class="form-control suit-select"></select>
				</div>
				<div class="col-4">
					<select class="form-control suit-select"></select>
				</div>
				<div class="col-4">
					<select class="form-control suit-select"></select>
				</div>
			</div>
			<p id="inventory-upsell">You can <a href="/inventory#for=invigorations">sync your inventory with browse.wf</a> to fill in the offerings automatically.</p>
			<p id="inventory-status" class="d-none">Offerings were automatically filled in from your inventory. <a href="/inventory#for=invigorations">Need to update your inventory?</a></p>
			<input type="submit" class="btn btn-primary mb-3" value="Calculate Offerings" />
			<div id="results" class="d-none">
				<h4 class="mb-0">Current Offerings</h4>
				<p id="explain-noprev" class="explainer text-secondary-emphasis">Due to incomplete input data, these results can only be considered 100% correct if you have never visited Helminth before and your username is <b></b>.</p>
				<p id="explain-current" class="explainer text-secondary-emphasis">Assuming the previous offerings are correct for your account and your username is <b></b> as of this week.</p>
				<p id="explain-peek" class="explainer text-secondary-emphasis">Assuming the current offerings are correct for your account and your username is or will be <b></b>.</p>
				<div class="row text-center">
					<div class="col-4">
						<h5 id="out-suit-0"></h5>
						<p id="out-off-0" class="m-0"></p>
						<p id="out-def-0"></p>
					</div>
					<div class="col-4">
						<h5 id="out-suit-1"></h5>
						<p id="out-off-1" class="m-0"></p>
						<p id="out-def-1"></p>
					</div>
					<div class="col-4">
						<h5 id="out-suit-2"></h5>
						<p id="out-off-2" class="m-0"></p>
						<p id="out-def-2"></p>
					</div>
				</div>
			</div>
		</form>
	</div>
        <?php require "components/commonjs.html"; ?>
        <script src="invigorations.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://censorcanary.org/censorcanary.js" defer></script>
</body>
</html>
