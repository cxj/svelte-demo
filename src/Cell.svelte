<script>
    import Identity from "./SvelteKey.svelte";
    import {onMount, beforeUpdate, afterUpdate, onDestroy} from "svelte";
    import {quintOut} from 'svelte/easing';
    import {crossfade, fade, scale} from 'svelte/transition';

    export let cell = {id: 0, path: "", cycle: 0, mode: "view"};

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

<Identity key="{cell.id}">

    <div class="cell"
         in:fade="{{duration: 3000, easing: quintOut}}"
         out:fade="{{duration: 3000, easing: quintOut}}"
    >
        <!-- span class="badge">{cell.id}</span -->
        <span class="badge {cell.mode !== 'edit' ? 'hidden' : ''}">X</span>

        {#if cell.mode === 'add'}
            <button type="button" class="add" on:click>+</button>
        {:else}
            <img src="http://localhost:7000/{cell.path}" alt="{cell.path}">
        {/if}
    </div>

</Identity>

<style>
    button.add {
        color: white;
        font-weight: bold;
        font-size: 3vh;
        background-color: #99ce4e;
        border-radius: 20px;
        object-fit: contain;
    }

    span.badge {
        background-color: red;
    }

    .cell, img, button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    img {
        object-fit: contain;
        cursor: pointer;
    }
</style>
