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
use OCP\Files\IRootFolder;
use OCP\ILogger;

use OCP\Files\File;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

use \OCA\PopcornApp\Mlt\Mlt;

use XMLWriter;

class MltController extends Controller {

        private $xml;
        private $content;
        private $title;
        private $logger;
        protected $request;
        
        public function __construct($AppName, IRequest $request, ILogger $logger, XMLWriter $xml){
                parent::__construct($AppName, $request);
                $this->request = $request;
                $this->logger = $logger;
                $this->view = new \OC\Files\view();
                $this->xml = $xml;
                $this->content = array();
        }
        
        public function getRequest(){
            return $this->request;
        }
        
        public function getLogger(){
            return $this->logger;
        }
        
        public function getView(){
            return $this->view;
        }
        
        public function getXml(){
            return $this->xml;
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

        public function createXML($title, $files){
                $this->logger->debug($files, array('app' => 'popcornapp'));      
                $this->title = $title;
                $this->xml->openURI('/home/camila/Projects/Owncloud/owncloud/data/'.$this->title.'.xml');
                $this->xml->setIndent(true);
                $this->xml->setIndentString('    ');
                $this->xml->startDocument('1.0', 'utf-8');
                    $this->xml->startElement('mlt');
                        $this->xml->writeAttribute('title', $this->title);  
                        $this->setPlaylists($files);
                        $this->xml->startElement('tractor');
                            $this->xml->writeAttribute('id', 'tractor0');  
                            $this->xml->writeAttribute('in', 0);  
                            $this->xml->writeAttribute('out', 630);  
                            $this->setTracks($files);
                            $this->setTransitions();                       
                        $this->xml->endElement();
                    $this->xml->endElement(); 
                $this->xml->endDocument(); 
                $this->publishVideo(); 
                
                return new DataResponse(['data' => '/home/camila/Projects/Owncloud/owncloud/data/'.$this->title.'.mp4']);
        }
    
    public function setPlaylists($files){
        $i = 0;           
        foreach ($files as $file) {
            $this->xml->startElement('producer');
                $this->xml->writeAttribute('id', 'producer'.$i);  
                $this->xml->startElement('property');
                    $this->xml->writeAttribute('name', 'resource');
                    $this->xml->text($file);         
                $this->xml->endElement();
            $this->xml->endElement();
            $this->xml->startElement('playlist');
                $this->xml->writeAttribute('id', 'playlist'.$i);  
                $this->xml->startElement('blank');
                    $this->xml->writeAttribute('length', 1);       
                $this->xml->endElement();
                $this->xml->startElement('entry');
                    $this->xml->writeAttribute('producer', 'producer'.$i);       
                $this->xml->endElement();                            
            $this->xml->endElement();                    
            $i++;
        }            
    }    
    
    public function setTracks($files){
        $this->xml->startElement('multitrack');
            $this->xml->writeAttribute('id', 'multitrack0');
            $i = 0;           
            foreach ($files as $file) {            
                $this->xml->startElement('track');
                    $this->xml->writeAttribute('producer', 'playlist'.$i);
                $this->xml->endElement();  
                $i++;
            }
        $this->xml->endElement();        
    }        
    
    public function setTransitions(){
        $this->xml->startElement('transition');
            $this->xml->writeAttribute('id', 'transition0');  
            $this->xml->writeAttribute('in', 100);
            $this->xml->writeAttribute('out', 200);
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'a_track');
                $this->xml->text(0); 
            $this->xml->endElement();
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'b_track');
                $this->xml->text(1); 
            $this->xml->endElement();                          
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'mlt_service');
                $this->xml->text('luma'); 
            $this->xml->endElement();                            
        $this->xml->endElement();   
        $this->xml->startElement('transition');
            $this->xml->writeAttribute('id', 'transition1');  
            $this->xml->writeAttribute('in', 100);
            $this->xml->writeAttribute('out', 200);
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'a_track');
                $this->xml->text(0); 
            $this->xml->endElement();
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'b_track');
                $this->xml->text(1); 
            $this->xml->endElement();                            
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'mlt_service');
                $this->xml->text('mix'); 
            $this->xml->endElement();  
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'start');
                $this->xml->text(0.1); 
            $this->xml->endElement();  
            $this->xml->startElement('property');
                $this->xml->writeAttribute('name', 'end');
                $this->xml->text(2.0); 
            $this->xml->endElement();                              
        $this->xml->endElement();            
    }
    
    public function publishVideo(){
        exec('cd /home/camila/Projects/Owncloud/owncloud/data/ && melt6 -producer xml:'.$this->title.'.xml -consumer avformat:'.$this->title.'.mp4');
    }                

}