<script>
    import {onMount} from "svelte";
    import Cell from "./Cell.svelte";
    import * as Utils from './utils.js';

    const ASSETS = "http://localhost:7000";
    const getAllLogos = ASSETS + "/mylogos";

    let cell;
    let grid = [];
    let allLogos = [];
    let count = 0;
    let timer;

    export function handleEdit() {
        clearTimeout(timer);
        alert("Timer stopped");
    }


    onMount(async () => {
        fetch(getAllLogos)
            .then(r => r.json())
            .then(data => {
                allLogos = data;
                // Arbitrarily pick the first 12 to start.
                grid = allLogos.slice(0, 12);
                console.log("allLogos: ", allLogos);
                console.log("grid: ", grid);
                // debugger;
                timer = setTimeout(new3, 6000);
            });
    });

    function new3()
    {
        let newCell;
        count++;
        let slotsToReplace = Utils.getRandomSample(grid, 3);
        console.log("slotsToReplace: ", slotsToReplace);
        let slotIds = slotsToReplace.map(value => value.id);
        console.log("About to replace " + slotIds.length + " slots");
        console.log(" The Slots: ", slotIds);

        for (let i = 0; i < 12; i++) {
            if (slotIds.indexOf(grid[i].id) > -1) {
                newCell = newRandomCell(allLogos, slotsToReplace);
                console.log(
                    i + " Replacing ",  grid[i], " with new: ", newCell
                );

                grid[i] = newCell;
            }
        }

        /*
        let newId = Utils.randomInteger(0, allLogos.length - 1);
        let newSlot = Utils.randomInteger(0, 11);
        grid[newSlot] = {...allLogos[newId]};

        grid = JSON.parse(JSON.stringify(grid));
         */

        if (count < 12) {
            clearTimeout(timer);
            console.log("Cycle #", count);  // debug
            timer = setTimeout(new3, 6000, grid);
        } else {
            console.log("Timed changes done.");
        }
    }

    function newRandomCell(list, avoid)
    {
        let cell = {id: null, path: null};
        while (cell.id === null) {
            // randomly pick an element of the list array.
            let index = Utils.randomInteger(0, list.length - 1);
            // get the Id (grid slot number) of the cell at that element.
            let newId = list[index].id;
            // Make sure grid element is not in the avoid list.
            if (avoid.indexOf(newId) === -1) {
                cell = list[index];
            }
        }
        return cell;
    }
</script>

<div class="grid">
    <div class="row">
        <div class="box">
            <div class="inner"><Cell cell={grid[0]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[1]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[2]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[3]}/></div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="inner"><Cell cell={grid[4]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[5]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[6]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[7]}/></div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="inner"><Cell cell={grid[8]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[9]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[10]}/></div>
        </div>
        <div class="box">
            <div class="inner"><Cell cell={grid[11]}/></div>
        </div>
    </div>
</div>

<style>
    .grid {
        margin: 0 auto;
        width: 80vw;
        max-width: 75vh;
        height: 80vw;
        max-height: 38vh;
        padding: 1rem;
    }

    .row {
        display: flex;
    }

    .box {
        margin: 1rem;
        flex: 1 0 auto;
        position: relative;
    }

    .box:after {
        content: "";
        float: left;
        display: block;
        padding-top: calc(9/16 * 100%);
    }

    .box .inner {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
