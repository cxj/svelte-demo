<script>
    import Cell from "./Cell.svelte";
    import * as Utils from './utils.js';

    export let grid = [];

    const ASSETS = "http://localhost:7000";
    const getAllLogos = ASSETS + "/get-logos";
    const getRandomLogo = ASSETS + "/get-one";
    const swapThree = ASSETS + "/swap-3";

    fetch(getAllLogos)
        .then(r => r.json())
        .then(data => {
            grid = data;
        });

    /* ---- */
    setTimeout(new3, 3000);

    let count = 0;

    function new3()
    {
        console.log("pre-post grid = " + grid);
        doPost(grid);
        console.log("POST result: " + result);

        if (result != null && result.length === 3) {
            // Pick 3 random cells to replace.
            let cells = Utils.sampleWithoutReplacement(12, 3);
            for (let i = 0; i < cells.length; i++) {
                console.log(
                    `cells[${i}]: ${cells[i]} - result: ${result[i].id}`
                );
                grid[cells[i]] = result[i];
            }
        }
        else if (result != null ) {
            console.log(" !! result.length = " + result.length);
        }
        else {
            console.log(" !! result is null");
        }

        count++;
        /*
        let randomSlot = Utils.randomInteger(1, 12);
        console.log("randomSlot = " + randomSlot);

        fetch(getRandomLogo)
            .then(r => r.json())
            .then(data => {
                grid[randomSlot] = data;

                grid = grid;        // May be unnecessary.
            });
         */
        if (count < 2) {
            setTimeout(new3, 3000, grid);
        } else {
            console.log("Timed changes done.");
        }
    }

    let result = null;

    async function doPost(input)
    {
        const data = {post: input};
        console.log("POST data: ", data);

        const res = await fetch(swapThree, {
            method:  'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body:    JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success: ', data);
                result = data;
            })
            .catch((error) => {
                console.error('Error: ', error);
                result = [];
            });
    }
</script>

<div class="inner">
    <div class="grid">
        {#each grid as cell}
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