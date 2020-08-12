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

<div class="grid">
    <div class="row">
        <div class="box">
            <div class="inner">1
                <Cell cell={grid[0]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">2
                <Cell cell={grid[1]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">3
                <Cell cell={grid[2]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">4
                <Cell cell={grid[3]}/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="inner">5
                <Cell cell={grid[4]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">6
                <Cell cell={grid[5]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">7
                <Cell cell={grid[6]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">8
                <Cell cell={grid[7]}/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="inner">9
                <Cell cell={grid[8]}/>
            </div>
        </div>
        <div class="box">
            <div class="inner">1
                <Cell cell={grid[9]}/>
                0
            </div>
        </div>
        <div class="box">
            <div class="inner">1
                <Cell cell={grid[10]}/>
                1
            </div>
        </div>
        <div class="box">
            <div class="inner">1
                <Cell cell={grid[11]}/>
                2
            </div>
        </div>
    </div>
</div>

<style>
    .grid {
        margin: 0 auto;
        width: 80vw;
        max-width: 60vh;
        height: 80vw;
        max-height: 45vh;
        font-size: 2rem;

        padding-top: 1vh;
        padding-left: 4vw;
        padding-right: 4vw;
    }

    .row {
        display: flex;
    }

    .box {
        border: 1px solid blue;

        background: white;
        margin: 1rem;
        color: tomato;
        font-weight: bold;
        flex: 1 0 auto;
        position: relative;
    }

    .box:after {
        content: "";
        float: left;
        display: block;
        padding-top: 100%;
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
