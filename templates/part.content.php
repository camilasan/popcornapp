<div style="padding:30px;">
    <form id="fileslist-form" method="post" action="/apps/popcorn/list" enctype="multipart/form-data">
            <h2 style="margin-bottom:20px">Pick the pictures you want to use:</h2>
            <label for="title">Pick a title for the video:</label>
            <input type="text" name="title" id="title"><br><br>            
            <label for="file" id="selectfiles" style="padding:10px;border:1px solid #ccc;">Select files</label>
            <input type="file" name="file" id="file" style="display:none"><br>
            <br>
            <button name="submit" id="submit" style="margin-top:30px;border:1px #ccc solid;padding:10px">Create video!</button><br>
    </form>
    <div id="files">
    </div>
    <div id="video" style="padding:30px;display:none;">
        <video width="600" height="400" controls><source src="" type="video/mp4"><source src="'.$title.'.mp4" type="video/mp4">Your browser does not support the video tag.</video>    
    </div>
</div>