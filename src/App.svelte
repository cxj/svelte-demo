<script>
    import Grid from "./Charlie.svelte";

    let grid;
    let mode = 'view';

    export function tellGrid(e)
    {
        if (mode === 'view') {
            grid.handleEdit();
            mode = 'edit';
        } else {
            grid.handleView();
            mode = 'view';
        }
        console.log("Mode: ", mode);
    }
</script>

<div class="container">
    <div class="frame">
        <h2>&nbsp; myLOGO</h2>
        <div class="outer">
            <div>
                <h3 id="title" class="form-control-static pull-left">
                    {mode === 'edit' ? 'edit Gallery' : 'myGallery'}
                </h3>
                <button id="viewing"
                        class="mode btn btn-default pull-right"
                        on:click="{tellGrid}"
                >
                    {mode === 'edit' ? 'View' : 'Edit'} Gallery
                </button>
            </div>

            <div class="inner">
                <Grid bind:this={grid}></Grid>
            </div>

        </div>
    </div>
</div>

<style>
    .container {
        position: absolute;
        display: flex;
        align-items: center;
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
