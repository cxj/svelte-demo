<script>
    import Identity from "./SvelteKey.svelte";
    import {onMount, beforeUpdate, afterUpdate, onDestroy} from "svelte";
    import {quintOut} from 'svelte/easing';
    import {crossfade, fade, scale} from 'svelte/transition';

    export let cell = {id: 0, path: "", cycle: 0};

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

        <img src="http://localhost:7000/{cell.path}" alt="{cell.path}">
    </div>

</Identity>

<style>
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
        cursor: pointer;
    }
</style>
