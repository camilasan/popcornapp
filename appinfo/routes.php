<?php
/**
 * Nextcloud - popcorn
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Camila Ayres <hello@camila.codes>
 * @copyright Camila Ayres 2016
 */

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\PopcornApp\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
	   ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
	   ['name' => 'mlt#listFiles', 'url' => '/list', 'verb' => 'POST'],
	   ['name' => 'mlt#createVideo', 'url' => '/video', 'verb' => 'POST'],
	   ['name' => 'mlt#createXML', 'url' => '/video1', 'verb' => 'POST'],
	   
    ]
];
