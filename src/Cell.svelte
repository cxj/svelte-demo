<script>
    import {onMount, beforeUpdate, afterUpdate, onDestroy} from "svelte";
    import {send, receive} from "./crossfade.js";

    export let cell = {id:0, path: "", cycle: 0};

    onMount(() => {
        console.log("Cell mounted");
    });

    beforeUpdate(() => {
    //    console.log(`Cell update id: ${cell.id}, path: ${cell.path}`);
    });

    onDestroy(() => {
        console.log(" *** Cell destroyed ***");
    });
</script>

<div class="cell"
     id={`cell-slot-${cell.id}`}
     in:send={{key:cell.id}}
     out:receive={{key:cell.id}}
>
    <span class="badge">{cell.id}</span>
    <img src="http://localhost:7000/{cell.path}" alt="{cell.path}">
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

    .Xcell {
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
