/**
 * Nextcloud - popcorn
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Camila Ayres <hello@camila.codes>
 * @copyright Camila Ayres 2016
 */

(function ($, OC) {
	$(document).ready(function () { 
            
                $('#submit').click(function (event) {
                        event.preventDefault(); 
                        var files = disp($('#files div').toArray());
                        
                        if($('#title').val()=='' || files==''){
                            $('#error').text('Houston, we have a problem. Please, fill up all fields.');
                        }else{
                            $('#error').text('');
                            $('#progress').show();                            
                            $.ajax({
                                type: "POST",
                                url: OC.generateUrl('/apps/popcornapp/video'),
                                data: { title: $('#title').val(), files: files, theme: $('#theme').val() },  
                                fail: function (jqxhr, status) {
                                    $('#error').text('Houston, we have a problem while sending your data: '+status);
                                    $('#progress').hide(); 
                                }
                            }).done(displayVideo);
                        }
                });

                $('#selectfiles').click(function (event) {
                    event.preventDefault();
                    OC.dialogs.filepicker(
                        t('settings', "Select a profile picture"),
                        function (file) {
                                $.ajax({
                                    type: "POST",
                                    url: OC.generateUrl('/apps/popcornapp/list'),
                                    data: { file: file }
                                }).done(listFile)
                            },
                            false,
                            ["image/png", "image/jpeg"]
                    );
                });
	});

})(jQuery, OC);

function disp( divs ) {
  var a = [];
  for ( var i = 0; i < divs.length; i++ ) {
    a.push( divs[ i ].innerHTML );
  }
  return a;
}

function listFile(data) {
    $('#files').append('<div>'+data.file+'</div>');
}

function displayVideo(data) {
    //OC.linkToRemote('webdav') + OC.joinPaths('/popcornapp', data.src)
    $('#error').text('');
    $('#error').text(data.error);
    $('#video video source').attr('src', '/apps/popcornapp/themes/'+data.src);
    $('#video').show();
    $('#progress').hide();
}