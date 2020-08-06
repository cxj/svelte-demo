<script>
    import GallerySlot from "./GallerySlot.svelte";
    import * as Utils from './utils.js';


    const ASSETS = "http://localhost:7000";
    let url = ASSETS + "/get-logos.php";
    export let logoSlots = fetch(url).then(r => r.json());

    /* ---- */
    setTimeout(new3, 6000);

    function new3() {

    }
</script>

<div class="inner">
    <div class="grid">
        {#await logoSlots}
            <p class="loading">loading...</p>
        {:then slots}
            {#each slots as logoSlot (logoSlot.id) }
                <div class="square">
                    <GallerySlot {logoSlot}/>
                </div>
            {/each}
        {/await}
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