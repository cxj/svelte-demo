<script>
    import {onMount} from "svelte";
    import Cell from "./Cell.svelte";
    import * as Utils from './utils.js';

    const MAX_CYCLES = 100;  // short for testing, very large for actual use.
    const ASSETS = ""; // http://localhost:7000";
    const getAllLogos = ASSETS + "/mylogos";

    let cell;
    let mode;

    let grid = [];
    let allLogos = [];
    let count = 0;
    let timer;

    /**
     * Used by App-level button.
     */
    export function handleEdit()
    {
        mode = 'edit';
        clearTimeout(timer);
        console.log("Timer stopped");
        // Enable editing on grid members.
        grid = grid.map(obj => ({...obj, mode: 'edit'}));
        // 12th (last) member of grid becomes an "Add New" button.
        grid[11].mode = "add";

        console.log("last grid cell: ", grid[11]);  // debug
    }

    /**
     * Used by App-level button.
     */
    export function handleView()
    {
        mode = 'view';

        // Force reload of grid as persistence may have been altered.
        (async function () {
            await fetch(getAllLogos)
                .then(r => r.json())
                .then(data => {
                    allLogos = data;
                    // Init all to non-editable.
                    allLogos = allLogos.map(obj => ({...obj, mode: 'view'}));

                    // Select first 12 (grid size) in array as initial grid.
                    grid = get12(allLogos);

                    timer = setTimeout(new3, 6000);
                    console.log("View Timer started");
                });
        })();
    }

    function get12(list) {
        if (list.length > 11) {
            return list.slice(0, 12);
        }
        let missing = 12 - list.length;
        for (let i=0; i<missing; i++) {
            list.push({
                id: list.length + 1,
                path: ""
            });
            console.log('added dummy image: ', list);
        }
        return list;
    }

    onMount(async () => {
        fetch(getAllLogos)
            .then(r => r.json())
            .then(data => {
                allLogos = data;
                // Init all to non-editable.
                allLogos = allLogos.map(obj => ({...obj, mode: 'view'}));

                // Select first 12 (grid size) in array as initial grid.
                grid = get12(allLogos);

                console.log("allLogos: ", allLogos);
                console.log("grid: ", grid);

                // Start "rotation".
                timer = setTimeout(new3, 6000);
            });
    });

    function new3()
    {
        let newCell;
        count++;
        let slotsToReplace = Utils.getRandomSample(grid, 3);
        let slotIds = slotsToReplace.map(value => value.id);

        for (let i = 0; i < 12; i++) {
            if (slotIds.indexOf(grid[i].id) > -1) {
                newCell = newRandomCell(allLogos, slotsToReplace);
                grid[i] = newCell;
            }
        }

        if (count < MAX_CYCLES) {
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
            <div class="box-content">
                <Cell cell={grid[0]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[1]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[2]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[3]}/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[4]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[5]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[6]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[7]}/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[8]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[9]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[10]}/>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <Cell cell={grid[11]}/>
            </div>
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
        padding-top: calc(9 / 16 * 100%);
    }

    .box .box-content {
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
