

<div class="wrapper">
        <div>

        <div id="dragAndDropArea" class="drag_and_drop_area">
            <h2 class="title-medium-text light-text">
Drag and Drop Files Here
</h2>


            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="46" height="46"><path fill="#c4c4c4" d="M2 1.75C2 .784 2.784 0 3.75 0h5.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0 1 12.25 15h-7a.75.75 0 0 1 0-1.5h7a.25.25 0 0 0 .25-.25V6H9.75A1.75 1.75 0 0 1 8 4.25V1.5H3.75a.25.25 0 0 0-.25.25V4.5a.75.75 0 0 1-1.5 0Zm-.5 10.487v1.013a.75.75 0 0 1-1.5 0v-1.012a3.748 3.748 0 0 1 3.77-3.749L4 8.49V6.573a.25.25 0 0 1 .42-.183l2.883 2.678a.25.25 0 0 1 0 .366L4.42 12.111a.25.25 0 0 1-.42-.183V9.99l-.238-.003a2.25 2.25 0 0 0-2.262 2.25Zm8-10.675V4.25c0 .138.112.25.25.25h2.688l-.011-.013-2.914-2.914-.013-.011Z"></path></svg>        </div>

            <p class="subtitle-text" id="file_count"> </p>
            <p class="subtitle-text" id="size"> </p>
        </div>

        <table id="fileStack" class="file_table">
            <thead>
            <tr>
                <th class="title-small-text">
Name</th>
                <th class="title-small-text">
Size</th>
                <th class="title-small-text">
Type</th>
                <th class="title-small-text">
                     </th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>
    <form id="fileUploadForm" enctype="multipart/form-data">
        <input type="file" name="file[]" id="file" multiple style="display: none;">
        <input class="form-input" type="text" name="path" id="path" placeholder="Destination" value="~/Library/Uploads">
        <input type="submit" value="Upload" class="btn">
        <button id="finalSubmitBtn" class="btn" style="display: none;">Submit</button>

    </form>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="static/js/script.js" defer></script>