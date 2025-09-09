import type { IPowersuit } from "warframe-public-export-plus";

interface BaseSuitType {
    name: string;
    codename: string;
}

interface OracleResponse {
    suits: string[];
    offensiveUpgrades: string[];
    defensiveUpgrades: string[];
}

interface Inventory {
    InfestedFoundry?: {
        InvigorationIndex?: number;
        InvigorationSuitOfferings?: string[];
    };
}

declare global {
    interface Window {
        dict: Record<string, string>;
        baseSuitTypes: Record<string, BaseSuitType>;
    }
}

declare function getDictPromise(): Promise<Record<string, string>>;

let onLanguageUpdate: () => void;

const peekBox = document.getElementById("peek") as HTMLInputElement;
peekBox.onchange = function (this: HTMLInputElement): void {
    document.getElementById("input-header")!.textContent = this.checked ? "Current Offerings" : "Previous Offerings";
};

const invigorationNames: Record<string, string> = {
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationPowerStrength": "+200% Ability Strength",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationPowerRange": "+100% Ability Range",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationPowerDuration": "+100% Ability Duration",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationMeleeDamage": "+250% Melee Damage",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationPrimaryDamage": "+250% Primary Damage",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationSecondaryDamage": "+250% Secondary Damage",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationPrimaryCritChance": "+200% Primary Critical Chance",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationSecondaryCritChance": "+200% Secondary Critical Chance",
    "/Lotus/Upgrades/Invigorations/Offensive/OffensiveInvigorationMeleeCritChance": "+200% Melee Critical Chance",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationPowerEfficiency": "+75% Ability Efficiency",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationMovementSpeed": "+75% Sprint Speed",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationParkourSpeed": "+75% Parkour Velocity",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationHealth": "+1000 Health",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationEnergy": "+200% Energy Max",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationStatusResistance": "Status Immunity",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationReloadSpeed": "+75% Reload Speed",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationHealthRegen": "+25 Health Regen/s",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationArmor": "+1000 Armor",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationJumps": "5 Jump Resets",
    "/Lotus/Upgrades/Invigorations/Utility/UtilityInvigorationEnergyRegen": "+2 Energy Regen",
};

function doSubmit(): void {
    const request = {
        n: (document.getElementById("username") as HTMLInputElement).value.split("#")[0],
        s: [] as string[],
        p: peekBox.checked,
    };
    document.querySelectorAll<HTMLSelectElement>(".suit-select").forEach(select => {
        if (select.value !== "---") {
            request.s.push(select.value);
        }
    });
    fetch("https://oracle.browse.wf/invigorations?" + encodeURIComponent(JSON.stringify(request)))
        .then(res => res.json())
        .then((res: OracleResponse) => {
            document.getElementById("results")!.classList.remove("d-none");
            document.querySelector("#results h4")!.textContent = request.p ? "Next Week's Offerings" : "Current Offerings";
            document.querySelectorAll(".explainer").forEach(x => { x.classList.add("d-none"); });
            if (request.s.length !== res.suits.length) {
                document.querySelector("#explain-noprev")!.classList.remove("d-none");
            } else if (!request.p) {
                document.querySelector("#explain-current")!.classList.remove("d-none");
            } else {
                document.querySelector("#explain-peek")!.classList.remove("d-none");
            }
            document.querySelectorAll("#results b").forEach(x => { x.textContent = request.n; });
            for (let i = 0; i !== res.suits.length; ++i) {
                (document.getElementById("out-suit-" + i) as HTMLElement).textContent = window.dict[window.baseSuitTypes[res.suits[i]].name];
                (document.getElementById("out-off-" + i) as HTMLElement).textContent = invigorationNames[res.offensiveUpgrades[i]];
                (document.getElementById("out-def-" + i) as HTMLElement).textContent = invigorationNames[res.defensiveUpgrades[i]];
            }
        });
}

Promise.all([
    getDictPromise(),
    fetch("https://cdn.jsdelivr.net/gh/calamity-inc/warframe-public-export-plus@0.5.x/ExportWarframes.json").then(res => res.json()),
]).then(([dict, ExportWarframes]: [Record<string, string>, Record<string, IPowersuit>]) => {
    window.dict = dict;

    onLanguageUpdate = function (): void {
        window.baseSuitTypes = {};
        const warframes: IPowersuit[] = Object.values(ExportWarframes);
        warframes.sort((a, b) => dict[a.name].localeCompare(dict[b.name]));
        warframes.forEach(suit => {
            if (suit.productCategory == "Suits" && suit.name.indexOf("Prime") == -1 && suit.name.indexOf("Umbra") == -1) {
                window.baseSuitTypes[suit.parentName] = {
                    name: suit.name,
                    codename: suit.parentName.split("/")[3],
                };
            }
        });

        document.querySelectorAll<HTMLSelectElement>(".suit-select").forEach(select => {
            const value = select.value || "---";
            select.innerHTML = "<option>---</option>";
            for (const [uniqueName, data] of Object.entries(window.baseSuitTypes) as [string, BaseSuitType][]) {
                const option = document.createElement("option");
                option.value = uniqueName;
                option.textContent = dict[data.name];
                if (data.codename !== option.textContent) {
                    option.textContent += ` ("${data.codename}")`;
                }
                select.appendChild(option);
            }
            select.value = value;
        });
    };
    onLanguageUpdate();

    if (localStorage.getItem("inventory")) {
        document.getElementById("inventory-upsell")!.classList.add("d-none");
        document.getElementById("inventory-status")!.classList.remove("d-none");

        const inventory = JSON.parse(localStorage.getItem("inventory")!) as Inventory;
        if (inventory.InfestedFoundry) {
            if (inventory.InfestedFoundry.InvigorationIndex !== undefined) {
                peekBox.checked = (inventory.InfestedFoundry.InvigorationIndex == Math.trunc(((Date.now() / 1000) - 1391990400) / 604800));
                peekBox.onchange!(new Event("change"));
            }
            if (inventory.InfestedFoundry.InvigorationSuitOfferings) {
                const selects = document.querySelectorAll<HTMLSelectElement>(".suit-select");
                for (let i = 0; i !== 3; ++i) {
                    selects[i].value = inventory.InfestedFoundry.InvigorationSuitOfferings[i];
                }
            }
        }
    }
});

