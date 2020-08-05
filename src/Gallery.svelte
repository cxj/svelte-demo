<script>
    import {onMount} from "svelte";
    import GallerySlot from "./GallerySlot.svelte";
    import {onInterval} from './utils.js';


    let logoSlots;

    const ASSETS = "http://localhost:7000";

    onMount(async () => {
        await fetch(ASSETS + "/get-logos.php")
            .then(r => r.json())
            .then(data => {
                logoSlots = data;
                console.log("logoSlots = " + logoSlots);
            });
    });

</script>

<div class="inner">
    <div class="grid">
        {#if logoSlots}
            {#each logoSlots as logoSlot (logoSlot.id) }
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