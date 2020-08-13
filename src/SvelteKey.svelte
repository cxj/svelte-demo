<script>
    // This entire Component is a work-around for this Svelte limitation:
    // https://github.com/sveltejs/svelte/issues/1469
    // https://stackoverflow.com/questions/58187705/how-to-ensure-local-only-transitions-when-svelte-is-reusing-the-parent-dom-eleme/
    export let key
    // we just need a 1-length array
    const items = [0]
</script>

{#each items as x (key)}
    <slot />
{/each}