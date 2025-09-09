<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>Color Picker | browse.wf</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="icon" href="https://browse.wf/Lotus/Interface/Icons/Categories/GrimoireModIcon.png">
	<style>
		#picker-cards .card {
			cursor: pointer;
		}

		.colour-block {
			height: 44px;
			width: 44px;
		}

		.colour-overlay {
			color: #fff;
			/*text-shadow: #fff 0 0 10px;
			mix-blend-mode: difference;*/
			text-shadow: #000 0 0 5px, #000 0 0 10px;
		}

		#picker-table tr:first-child td:first-child > div {
			border-top-left-radius: 0.375rem;
		}

		#picker-table tr:first-child td:last-child > div {
			border-top-right-radius: 0.375rem;
		}

		#picker-table tr:last-child td:first-child > div {
			border-bottom-left-radius: 0.375rem;
		}

		#picker-table tr:last-child td:last-child > div {
			border-bottom-right-radius: 0.375rem;
		}
	</style>
</head>
<body data-bs-theme="dark">
	<?php require "components/navbar.php"; ?>
	<div class="container pt-3">
		<div class="input-group mb-3">
			<input class="form-control form-control-color" type="color" style="flex:0 0 auto;width:50px" value="#ff0000" />
			<input class="form-control" type="text" value="#ff0000" maxlength="7" />
		</div>
		<div class="row" style="overflow:hidden">
			<div class="col-5 col-lg-4" id="picker-cards" style="height:calc(100vh - 126px);overflow: auto;">
				Loading...
			</div>
			<div class="col-7 col-lg-8" style="height:calc(100vh - 126px);overflow:auto">
				<table id="picker-table"></table>
			</div>
		</div>
	</div>
	<?php require "components/commonjs.html"; ?>
	<script>
		let active_picker = "/Lotus/Types/StoreItems/SuitCustomizations/ColourPickerPrimeWarframesItemA";

		const params = new URLSearchParams(location.hash.replace("#", ""));
		if (params.has("i"))
		{
			document.querySelector("input[type=color]").value = "#" + params.get("i");
			document.querySelector("input[type=text]").value = "#" + params.get("i");
		}
		if (params.has("p"))
		{
			active_picker = params.get("p");
		}

		Promise.all([
			fetch("https://browse.wf/warframe-public-export-plus/ExportFlavour.json").then(res => res.json()),
			fetch("https://browse.wf/warframe-public-export-plus/ExportImages.json").then(res => res.json()),
			getDictPromise()
		]).then(([ExportFlavour, ExportImages, dict]) =>
		{
			window.ExportFlavour = ExportFlavour;
			window.ExportImages = ExportImages;
			window.dict = dict;

			updatePickerCards();

			onLanguageUpdate = function()
			{
				updatePickerCards();
			};
		});

		function updatePickerCards()
		{
			const colour_pickers = [];
			Object.entries(ExportFlavour).forEach(([uniqueName, flavourItem]) =>
			{
				if (flavourItem.hexColours)
				{
					colour_pickers.push({
						uniqueName: uniqueName,
						icon: flavourItem.icon,
						name: dict[flavourItem.name],
						colours: flavourItem.hexColours,
					});
					if (flavourItem.legacyColours)
					{
						colour_pickers.push({
							uniqueName: uniqueName + ":legacy",
							icon: flavourItem.icon,
							name: dict[flavourItem.name] + " (Legacy)",
							colours: flavourItem.legacyColours,
						});
					}
				}
			});

			const targetRgb = document.querySelector("input[type=text]").value.length == 7 ? hexToRgb(document.querySelector("input[type=text]").value) : undefined;
			if (targetRgb)
			{
				colour_pickers.forEach(picker =>
				{
					picker.peakSimilarity = 0;
					for (colour of picker.colours)
					{
						const similiary = rgbSimilarity(hexToRgb(peColourToHex(colour)), targetRgb);
						if (similiary > picker.peakSimilarity)
						{
							picker.peakSimilarity = similiary;
						}
					}
				});
				colour_pickers.sort((a, b) => b.peakSimilarity - a.peakSimilarity);
			}

			document.getElementById("picker-cards").innerHTML = "";
			colour_pickers.forEach(picker =>
			{
				const card = document.createElement("div");
				card.setAttribute("data-uniqueName", picker.uniqueName);
				card.onclick = () => { setActivePicker(picker.uniqueName); };
				card.className = "card mb-2";
				{
					const row = document.createElement("div");
					row.className = "row g-0";
					{
						const col = document.createElement("div");
						col.className = "col-3 col-xl-2 d-none d-md-block";
						{
							const img = document.createElement("img");
							img.className = "img-fluid rounded-start";
							setImageSource(img, picker.icon);
							col.appendChild(img);
						}
						row.appendChild(col);
					}
					{
						const col = document.createElement("div");
						col.className = "col-md-9 col-xl-10";
						{
							const body = document.createElement("div");
							body.className = "card-body";
							{
								const h5 = document.createElement("h5");
								h5.className = "card-title";
								h5.textContent = picker.name;
								body.appendChild(h5);
							}
							{
								const h6 = document.createElement("h6");
								h6.className = "card-subtitle text-body-secondary";
								h6.textContent = (picker.peakSimilarity * 100).toFixed(0) + "% Peak Similarity";
								body.appendChild(h6);
							}
							col.appendChild(body);
						}
						row.appendChild(col);
					}
					card.appendChild(row);
				}
				document.getElementById("picker-cards").appendChild(card);
			});

			setActivePicker(active_picker);
		}

		function peColourToHex(colour)
		{
			return "#" + colour.value.substr(4);
		}

		function hexToRgb(hex)
		{
			return [
				parseInt(hex.substr(1, 2), 16),
				parseInt(hex.substr(3, 2), 16),
				parseInt(hex.substr(5, 2), 16)
			];
		}

		function rgbDistance(e1, e2)
		{
			const rmean = (e1[0] + e2[0]) / 2;
			const r = e1[0] - e2[0];
			const g = e1[1] - e2[1];
			const b = e1[2] - e2[2];
			return Math.sqrt((((512 + rmean) * r * r) >> 8) + 4 * g * g + (((767 - rmean) * b * b) >> 8));
		}

		function rgbSimilarity(e1, e2)
		{
			return 1.0 - (rgbDistance(e1, e2) / 765.0);
		}

		function updatePickerTable(hexColours)
		{
			const targetRgb = document.querySelector("input[type=text]").value.length == 7 ? hexToRgb(document.querySelector("input[type=text]").value) : undefined;

			document.getElementById("picker-table").innerHTML = "";
			let tr = document.createElement("tr");
			for (let i = 0; i != hexColours.length; )
			{
				const hex = peColourToHex(hexColours[i])

				const td = document.createElement("td");
				{
					const block = document.createElement("div");
					block.className = "colour-block";
					block.style.backgroundColor = hex;
					if (targetRgb)
					{
						const similarity = rgbSimilarity(hexToRgb(hex), targetRgb);
						const overlay = document.createElement("div");
						overlay.className = "colour-overlay text-center pt-2";
						overlay.style.opacity = Math.max(0.5, similarity);
						overlay.textContent = (similarity * 100).toFixed(0) + "%";
						block.appendChild(overlay);
					}
					td.appendChild(block);
				}
				tr.appendChild(td);
				if ((++i % 5) == 0)
				{
					document.getElementById("picker-table").appendChild(tr);
					tr  = document.createElement("tr");
				}
			}
		}

		function setActivePicker(uniqueName)
		{
			active_picker = uniqueName;

			document.querySelectorAll("#picker-cards [data-uniqueName].border-primary").forEach(elm => elm.classList.remove("border-primary"));
			document.querySelector("#picker-cards [data-uniqueName='" + uniqueName + "']").classList.add("border-primary");

			const picker = ExportFlavour[uniqueName.split(":legacy").join("")];
			const legacy = (uniqueName.indexOf(":legacy") != -1);
			updatePickerTable(legacy ? picker.legacyColours : picker.hexColours);

			history.replaceState({}, undefined, location.pathname + "#i=" + document.querySelector("input[type=color]").value.substr(1) + "&p=" + active_picker);
		}

		document.querySelector("input[type=color]").onchange = function()
		{
			document.querySelector("input[type=text]").value = this.value;
			updatePickerCards();
		};

		document.querySelector("input[type=text]").oninput = function()
		{
			if (this.value.length == 7)
			{
				document.querySelector("input[type=color]").value = this.value;
				updatePickerCards();
			}
		};
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://censorcanary.org/censorcanary.js" defer></script>
</body>
</html>
