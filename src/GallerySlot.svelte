<script>
    import {crossfade, scale} from 'svelte/transition';

    export let logoSlot;

    const [send, receive] = crossfade({
        duration: 500,
        fallback: scale
    });

    console.log("GallerySlot::logoSlot.path = " + logoSlot.path);

    const ASSETS = `https://sveltejs.github.io/assets/crossfade`;

</script>

<div class="logo">
    <button
        in:receive={{key:logoSlot.id}}
        out:send={{key:logoSlot.id}}
        style="background-color: {logoSlot.color};"
    >{logoSlot.id}</button>

    <img src="http://localhost:7000/{logoSlot.path}" alt="{logoSlot.path}">
</div>

<style>
    button {
        postion: absolute;
        top: 0;
        left: 0;
        width: 20%;
        height: 20%;
        color: white;
        font-size: 1vmin;
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
