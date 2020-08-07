<script>
    import {fade, crossfade, scale} from 'svelte/transition';
    import { cubicOut } from 'svelte/easing';
    export let cell;

    const [send, receive] = crossfade({
        duration: 5000,
        easing: cubicOut,
        fallback: scale
    });

    console.log(`Cell:: id: ${cell.id}, path: ${cell.path}`);
</script>

<div class="cell"
     in:receive={{key:cell.path}}
     out:send={{key:cell.path}}
>
    <span class="badge">{cell.id}</span>

    <img in:fade="{{duration: 2000}}"
         out:fade="{{duration: 2000}}"
         src="http://localhost:7000/{cell.path}"
         alt="{cell.path}">
</div>

<style>
    .cell, img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .cell {
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
