<script>
    let files;
    let dataFile = null;
    let value;

    function upload(formData, action)
    {
        console.log("upload called");
        // const formData = new FormData();
        // formData.append('damName', value);
        // formData.append('dataFile', files[0]);
        fetch(action, {
            method: 'POST',
            body:   formData
        })
            .then((response) => response.json())
            .then((result) => {
                console.log('Success:', result);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    function init(ev)
    {
        console.log("WTF in init, ev: ", ev);   // DEBUG

        let formData = new FormData();

        // Since this is the file only, we send it to a specific location
        let action = '/mylogos';

        // FormData only has the file
        let fileInput = document.getElementById('file-id');
        let file = fileInput.files[0];

        console.log("The upload file is: ", file);

        formData.append('our-file', file);

        // Code common to both variants
        upload(formData, action);
    }

    function chooser()
    {
        document.getElementById('file-id').click();
        console.log("file chooser activated");
    }

</script>

<form action="/mylogos" id="form-id" method="post"
      enctype="multipart/form-data">

    <input id="file-id" type="file" name="our-file" class="hidden"
           on:change="{init}">

    <button
        id="upload-button-id"
        class="add"
        type="button"
        value="Upload"
        on:click={chooser}
    >+
    </button>

</form>
<!--
{#if dataFile && files[0]}
    <p>
        {files[0].name}
    </p>
{/if}

{#if value}
    <button on:click={upload}>Submit</button>
{:else}
    <button on:click={upload} disabled>Submit</button>
{/if}
-->
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
</style>
