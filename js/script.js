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
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: OC.generateUrl('/apps/popcornapp/video'),
                            data: { title: $('#title').val() }
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

function listFile(data) {
    $('#files').append(data.file+'<br>');
}

function displayVideo(data) {
    $('#video video').attr('src', data.data);
    $('#video').show();
}