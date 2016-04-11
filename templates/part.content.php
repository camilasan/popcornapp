<div class="popcorn">
    <div id="error"></div>
    <form id="fileslist-form" method="post" action="/apps/popcorn/list" enctype="multipart/form-data">
            <div class="app-logo"><img src="/apps/popcornapp/img/app-logo.gif"></div>
            <div class="form-container">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title">            
                <label for="title">Theme:</label>
                <select name="theme" id="theme">
                    <option value="0">Black & White</option>
                    <option value="1">The Happy One</option>
                </select>   
                <br>
                <div class="files-container" id="selectfiles">
                    <label for="file">Select Files</label>
                    <input type="file" name="file" id="file">
                    <div id="files">
                        <ul></ul>
                    </div> 
                </div>                
                <button name="submit" id="submit">Create video</button>
            </div>   
    </form>      
    <div id="progress"><img src="/apps/popcornapp/img/ajax-loader.gif"></div>
    <div id="video">
        <video width="600" height="480" controls>
            <source type="video/ogg">
            Your browser does not support the video tag.
        </video>    
    </div>
</div>