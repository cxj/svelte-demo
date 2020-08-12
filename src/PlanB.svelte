<script>
    import {onMount} from "svelte";
    import Cell from "./Cell.svelte";
    import * as Utils from './utils.js';

    let grid = [];
    let allLogos;

    const ASSETS = "http://localhost:7000";
    const getAllLogos = ASSETS + "/get-logos";

    onMount(async () => {
        fetch(getAllLogos)
            .then(r => r.json())
            .then(data => {
                allLogos = data;
                grid = allLogos.slice(0, 12);
                console.log("allLogos: ", allLogos);
                console.log("grid: ", grid);
            });
    });

    /* ---- */
    setTimeout(new3, 3000);

    let count = 0;

    function new3()
    {
        let newCell;
        count++;
        let slotsToReplace = Utils.getRandomSample(grid, 3);
        console.log("slotsToReplace: ", slotsToReplace);
        let slotIds = slotsToReplace.map(value => value.id);
        for (let i = 0; i < 12; i++) {
            if (slotIds.indexOf(grid[i].id) > -1) {
                newCell = newRandomCell(allLogos, slotsToReplace);
                console.log("Replacing " + grid[i] + " with new: " + newCell);
                grid[i] = newCell;
            }
        }

        grid = grid;

        if (count < 4) {
            setTimeout(new3, 3000, grid);
        } else {
            console.log("Timed changes done.");
        }
    }

    function newRandomCell(list, avoid)
    {
        let rep = {id: null, path: null};
        while (rep.id === null) {
            let trial = Utils.randomInteger(0, list.length - 1);
            let newId = list[trial].id;
            if (avoid.indexOf(newId) == -1) {
                rep = list[trial];
            }
        }
        return rep;
    }
</script>

<div class="inner">
    <div class="grid">
        {#each grid as cell, i}
            <div class="square">
                <Cell {cell}/>
            </div>
        {/each}
    </div>
</div>


<style>
    .square {
        width: 100%;
        height: 100%;
        color: white;
        font-size: 5vmin;
        border: none;
        margin: 0;
        will-change: transform;
    }

    .inner {
        background-color: white;
        position: relative;
        display: flex;
        flex-direction: column;
        width: 80vmin;
        height: 50vmin;
        padding: 3vmin;
    }

    .grid {
        display: grid;
        flex: 1;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(3, 1fr);
        grid-gap: 2vmin;
    }
</style>
