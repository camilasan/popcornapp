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
            
                $('#test').click(function (event) {
                    alert('Blah!!');
                });

                $('#selectfiles').click(function (event) {
                    event.preventDefault();
                    OC.dialogs.filepicker(
                        t('settings', "Select a profile picture"),
                        function (files) {
                                $.ajax({
                                    type: "POST",
                                    url: OC.generateUrl('/apps/popcornapp/list'),
                                    data: { files: files, title: $('#title').val() }
                                }).done(filesResponseHandler)
                            },
                            true,
                            ["image/png", "image/jpeg"]
                    );
                });
	});

})(jQuery, OC);

function filesResponseHandler(data) {
    $('#files video').attr('src', data.data);
    $('#files').show();
}