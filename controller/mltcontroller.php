<?php
/**
 * Nextcloud - popcorn
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Camila Ayres <hello@camila.codes>
 * @copyright Camila Ayres 2017
 */

namespace OCA\PopcornApp\Controller;

use OCP\IRequest;

use OCP\Files\File;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\IUserSession;
use \OCP\IConfig;
use \OCA\PopcornApp\Controller\XML;
use OCP\IPreview;

class MltController extends Controller {

        private $xml;
        private $content;
        private $title;
        protected $request;
        protected $preview;
        private $current_user;

        public function __construct($AppName, IRequest $request, IUserSession $session, IConfig $settings){
                parent::__construct($AppName, $request);
                $this->request = $request;
                //$this->current_user = $session->getUser()->getUID();
                $this->content = array();
                $this->settings = $settings;
                $this->app = $AppName;
        }

        public function getRequest(){
            return $this->request;
        }

        public function getView(){
            return $this->view;
        }

        public function getContent(){
            return $this->content;
        }

        public function listFiles($file){
            $file_view = new \OC\Files\view();
            $fullPath = $file_view->getLocalFile($file);
            $fileinfo = pathinfo($fullPath);
            $dir = $fileinfo['dirname'].'/';
            $filename = $fileinfo['filename'].'.'.$fileinfo['extension'];
            $this->preview = new \OC\Preview('', '/', $fullPath, 100, 75, true);
/*			$this->preview->setMaxX(80);
			$this->preview->setMaxY(80);
			$this->preview->setScalingUp(true);
			$this->preview->setKeepAspect(true);     */
            //return new DataResponse(['file' => $file]);
            //var_dump($this->preview->getPreview()->imgPath);
            var_dump($this->preview->getPreview());
            var_dump($this->preview->getPreview()->data());
            return new DataResponse(['file' => $this->preview->getPreview()]);
        }

        private function cleanUpTitle($title){
            $title = strip_tags($title);
            $title = trim($title);
            $title = filter_var($title, FILTER_SANITIZE_STRING);
            $title = str_replace(' ', '_', $title);
            return $title;
        }

        public function createVideo($title, $files, $theme){
            $title = $this->cleanUpTitle($title);

            $xml = new XML($title, $files, $theme, $this->current_user, $this->app, $this->settings);

            $error = null;
            $result = $xml->setProducers();
            if($result){
                exec('cd /media/camila/home@opensuse/camila/Projects/Nextcloud/nextcloud/apps/popcornapp/themes/ && melt6 -producer xml:'.$title.'.xml -consumer avformat:'.$title.'.ogg');
                $xml_view = new \OC\Files\View('/' . $this->current_user . '/files');
                $xml_view->mkdir('popcornapp');
                $content = fopen('/media/camila/home@opensuse/camila/Projects/Nextcloud/nextcloud/apps/popcornapp/themes/'.$title.'.ogg', 'r+');
                $xml_view->file_put_contents('/popcornapp/'.$title.'.ogg', $content);
            }else $error = 'Something went wrong! We all are going to die!';

            return new DataResponse(['src' => $title.'.ogg', 'error' => $error]);
        }


}
