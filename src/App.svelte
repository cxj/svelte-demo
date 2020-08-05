<script>
    import {crossfade, scale} from 'svelte/transition';
    import {onMount} from "svelte";
    import {onInterval} from './utils.js';
    import Gallery from "./Gallery.svelte";

    let logoSlots;

    /*
    let logos = [];

    onMount(async () => {
        const res = await fetch("http://localhost:7000/get-logos.php");
        logos = await res.json();
    });

    const [send, receive] = crossfade({
        duration: 200,
        fallback: scale
    });

    let selected = null;
    let loading = null;

    const ASSETS = `https://sveltejs.github.io/assets/crossfade`;

    const load = logo => {
        const timeout = setTimeout(() => loading = logo, 100);

        const img = new Image();

        img.onload = () => {
            selected = logo;
            clearTimeout(timeout);
            loading = null;
        };

        img.src = `${ASSETS}/${logo.id}.jpg`;
    };
     */
</script>

<div class="container">
    <div class="frame">
        <h2>&nbsp; myLOGO</h2>
        <div class="outer">
            <div>
                <h3 class="form-control-static pull-left">myGallery</h3>
                <button class="btn btn-default pull-right">
                    Edit Gallery
                </button>
            </div>

            <Gallery {logoSlots}/>

            <!--
                        <div class="inner">
                            <div class="grid">
                                {#each logos as logo}
                                    <div class="square">
                                        {#if selected !== logo}
                                            <button
                                                style="background-color: {logo.color};"
                                                on:click="{() => load(logo)}"
                                                in:receive={{key:logo.id}}
                                                out:send={{key:logo.id}}
                                            >{loading === logo ? '...' : logo.id}</button>
                                        {/if}
                                    </div>
                                {/each}
                            </div>

                            {#if selected}
                                {#await selected then d}
                                    <div class="logo" in:receive={{key:d.id}}
                                         out:send={{key:d.id}}>
                                        <img
                                            alt={d.alt}
                                            src="{ASSETS}/{d.id}.jpg"
                                            on:click="{() => selected = null}"
                                        >
                                    </div>
                                {/await}
                            {/if}
                        </div>
                        -->
        </div>
    </div>
</div>

<style>
    .container {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .frame {
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .outer {
        position: relative;
        display: flex;
        flex-direction: column;
        background-color: #eee;
        border: 10vmin solid #eee;
        border-top-width: 1vmin;
    }

    .inner {
        background-color: white;
        position: relative;
        display: flex;
        flex-direction: column;
        width: 75vmin;
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

    .square button {
        width: 100%;
        height: 100%;
        color: white;
        font-size: 5vmin;
        border: none;
        margin: 0;
        will-change: transform;
    }

    .logo, img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .logo {
        display: flex;
        align-items: stretch;
        justify-content: flex-end;
        flex-direction: column;
        will-change: transform;
    }

    img {
        object-fit: cover;
        cursor: pointer;
    }
</style>
