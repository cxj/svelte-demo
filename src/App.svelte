<script>
    import Grid from "./Charlie.svelte";

    let grid;
    export function tellGrid() {
        grid.handleEdit();
    }
</script>

<div class="container">
    <div class="frame">
        <h2>&nbsp; myLOGO</h2>
        <div class="outer">
            <div>
                <h3 class="form-control-static pull-left">myGallery</h3>
                <button class="btn btn-default pull-right"
                        on:click="{tellGrid}">
                    Edit Gallery
                </button>
            </div>

            <div class="inner">
                <Grid bind:this={grid}/>
            </div>

        </div>
    </div>
</div>

<style>
    .container {
        position: absolute;
        display: flex;
        align-items: center;
        Xjustify-content: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .frame {
        width: 100%;
    }

    .outer {
        position: relative;
        display: flex;
        flex-direction: column;
        background-color: #eee;
        border: 10vmin solid #eee;
        border-top-width: 5vmin;
    }

    .inner {
        background-color: white;
    }
</style>
