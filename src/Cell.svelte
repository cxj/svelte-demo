<script>
    import Upload from "./Upload.svelte";
    import Identity from "./SvelteKey.svelte";
    import {onMount, beforeUpdate, afterUpdate, onDestroy} from "svelte";
    import {quintOut} from 'svelte/easing';
    import {crossfade, fade, scale} from 'svelte/transition';

    export let cell = {id: 0, path: "", cycle: 0, mode: "view"};

    let files;

    const DELETE = "/mylogos/";

    onMount(() => {
        console.log("Cell mounted");
    });

    beforeUpdate(() => {
        //    console.log(`Cell update id: ${cell.id}, path: ${cell.path}`);
    });

    onDestroy(() => {
        console.log(" *** Cell destroyed ***");
    });

    function remove(e)
    {
        let id = e.target.attributes.href.value;
        console.log("id: ", id);
        fetch(DELETE + id, {
            method: 'DELETE',
        })
            .then(res => res.text())
            .then(res => console.log(res));

        // Change delete logo image to "empty" placeholder.
        cell.mode = 'empty';
    }
</script>

<Identity key="{cell.id}">
    <div id="cell-{cell.id}" class="cell"
         in:fade="{{delay: 500, duration: 3000}}"
         out:fade="{{delay: 0, duration: 3000}}"
    >
        <div class="{cell.mode !== 'edit' ? 'hidden' : ''}">
            <button class="badge" href="{cell.id}" on:click={remove}>
                X
            </button>
        </div>

        {#if cell.mode === 'add'}
        <span class="add">
            <Upload/>
        </span>
        {:else if cell.mode === 'empty'}
        <span class="empty"></span>
        {:else}
        <img src="/{cell.path}" alt="{cell.path}">
        {/if}
    </div>
</Identity>

<style>
    .add {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        color: white;
        font-weight: bold;
        font-size: 3vh;
        background-color: #99ce4e;
        border-radius: 20px;
        object-fit: contain;
    }

    .badge {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 999;
        background-color: red;
    }

    .cell, img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    img {
        object-fit: contain;
    }
</style>
