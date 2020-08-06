<script>
    import {onMount} from "svelte";
    import GallerySlot from "./GallerySlot.svelte";
    import * as Utils from './utils.js';

    export let logoSlots;

    const ASSETS = "http://localhost:7000";
    let url = ASSETS + "/get-logos";

    let interval;

    onMount(async () => {
        logoSlots = await Utils.getJsonData(url);
    })
    /*
    onMount(async () => {
        await fetch(ASSETS + "/get-logos")
            .then(r => r.json())
            .then(data => {
                logoSlots = data;
                console.log("logoSlots = " + logoSlots);

            });
    });
     */

    interval = setInterval(rotate3, 5000);
    let count = 0;

    function rotate3()
    {
        console.log("Tick..." + count++);

        let url = ASSETS + "/get-logos";
        let newSlots;
        try {
            newSlots = (async () => {
                let data = await Utils.getJsonData(url);
                return data;
            })();
        } catch (e) {
            alert(e);
        }
        let samples = Utils.sampleWithoutReplacement(12, 3);
        console.log("new samples = " + samples);

        logoSlots = newSlots;

        if (count > 11) {
            clearInterval(interval);
        }
    }
</script>

<div class="inner">
    <div class="grid">
        {#if logoSlots}
            {#each logoSlots as logoSlot }
                <div class="square">
                    <GallerySlot {logoSlot}/>
                </div>
            {/each}
        {:else}
            <p class="loading">loading...</p>
        {/if}
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