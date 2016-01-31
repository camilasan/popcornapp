<div style="padding:30px;">
    <form id="fileslist-form" method="post" action="/apps/popcorn/list" enctype="multipart/form-data">
            <h2 style="margin-bottom:20px">Pick the pictures you want to use:</h2>
            <label for="title">Pick a title for the video:</label>
            <input type="text" name="title" id="title"><br><br>            
            <label for="fileslist" id="selectfiles" style="padding:10px;border:1px solid #ccc;">Select files</label>
            <input type="file" name="files" id="fileslist" style="display:none"><br>
    </form>
    <div id="files" style="padding:30px;">
    </div>
</div>