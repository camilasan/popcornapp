<?php
/**
 * ownCloud - popcorn
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Camila Ayres <hello@camila.codes>
 * @copyright Camila Ayres 2016
 */

namespace OCA\PopcornApp\Controller;

use OCP\IUserSession;
use OCP\IRequest;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

class FilesController extends Controller {

        private $userId;
        private $userSession;
        private $userFolder;
        protected $request;

        public function __construct($AppName, IRequest $request, IUserSession $userSession){
                parent::__construct($AppName, $request);
                $this->userSession = $userSession;
                $this->userFolder = $UserFolder;
                $this->request = $request;
                $this->userId = $this->userSession->getUser()->getUID();
        }

        public function listFiles($path) {
//                 $userId = $this->userId;
//                 $files = $this->request->getUploadedFile('files');
                //echo var_dump($this->request['items']);
                //$path = str_replace(array('/', '\\'), '',  $path);
                return new DataResponse(['data' => $path]);
        }

}