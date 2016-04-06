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

use OCP\IRequest;

use OCP\Files\File;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

// use \OCA\PopcornApp\Mlt\Mlt;

use \OCA\PopcornApp\Controller\XML;

//use XMLWriter;

class MltController extends Controller {

        private $xml;
        private $content;
        private $title;
        protected $request;
        
        public function __construct($AppName, IRequest $request){
                parent::__construct($AppName, $request);
                $this->request = $request;
                $this->view = new \OC\Files\view();
                $this->content = array();                
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
            $fullPath = $this->view->getLocalFile($file);
            $fileinfo = pathinfo($fullPath);
            $dir = $fileinfo['dirname'].'/';
            $filename = $fileinfo['filename'].'.'.$fileinfo['extension'];
            return new DataResponse(['file' => $dir.$filename]);
        }
        
        public function createVideo($title, $files, $theme){    
            $error = null;
            $xml = new XML($title, $files, $theme);
            echo $xml->getTheme();
            if($xml->setProducers()){
                exec('cd /home/camila/Projects/Owncloud/owncloud/data/ && melt6 -producer xml:'.$this->title.'.xml -consumer avformat:'.$this->title.'.mp4');
            }else $error = 'Something went wrong! We all are going to die!';
            
            return new DataResponse(['data' => '/home/camila/Projects/Owncloud/owncloud/data/'.$this->title.'.mp4', 'error' => $error]);        
        }
              

}