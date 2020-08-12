<script>
    import {onMount} from "svelte";
    import Cell from "./Cell.svelte";
    import * as Utils from './utils.js';

    const ASSETS = "http://localhost:7000";
    const getAllLogos = ASSETS + "/get-logos";

    let cell;
    let grid = [];
    let allLogos = [];
    let count = 0;

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
                setTimeout(new3, 6000);
            });
    });

    function new3()
    {
        let newCell;
        count++;
        /*
        let slotsToReplace = Utils.getRandomSample(grid, 3);
        console.log("slotsToReplace: ", slotsToReplace);
        let slotIds = slotsToReplace.map(value => value.id);
        for (let i = 0; i < 12; i++) {
            if (slotIds.indexOf(grid[i].id) > -1) {
                newCell = newRandomCell(allLogos, slotsToReplace);
                console.log("Replacing " + grid[i] + " with new: " + newCell);

                // cell = newCell;

                grid[i] = newCell;
            }
        }
        */

        let newId = Utils.randomInteger(0, allLogos.length - 1);
        let newSlot = Utils.randomInteger(0, 11);
        grid[newSlot] = allLogos[newId];
        grid = grid;

        if (count < 12) {
            setTimeout(new3, 6000, grid);
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

<div class="inner">

    <div class=" ">
        <div class="row">
            <div class="col-md-4">
                <div id="g1" class="square">
                    wtf1
                    <Cell cell={grid[0]}/>
                </div>
            </div>
            <div id="g2" class="col-md-4">
                <div class="square">
                    <Cell cell={grid[1]}/>
                </div>
            </div>
            <div id="g3" class="col-md-4">
                <div class="square">...
                    <Cell cell={grid[2]}/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>


<style>
    .square {
        width: 100%;
        height: 100%;
        color: white;
        background-color: cornflowerblue;
        font-size: 5vmin;
        border: none;
        margin: 0;
        will-change: transform;
    }

    .inner {
        background-color: white;
        position: relative;
        Xdisplay: flex;
        Xflex-direction: column;
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
