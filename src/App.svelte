<script>
    // import Gallery from "./Gallery.svelte";
    import Gallery from "./Alternative.svelte";

    let logoSlots;
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
</style>
