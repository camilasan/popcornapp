/**
 * ownCloud - popcorn
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
                        var files = disp($('#files div').toArray());
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: OC.generateUrl('/apps/popcornapp/video'),
                            data: { title: $('#title').val(), files: files, theme: $('#theme').val() }
                        }).done(displayVideo);
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
    $('#error').text(data.error);
    $('#video video source').attr('src', data.data);
    $('#video').show();
}