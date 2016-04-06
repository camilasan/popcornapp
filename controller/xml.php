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

use SimpleXMLElement;

class XML {

        private $title;
        private $files;
        private $theme;
        
        public function __construct($title, $files, $theme){
            $themes = array('blackandwhite', 'thehappyone');
            $this->title = $title;
            $this->files = $files;
            $this->theme = '/home/camila/Projects/Personal/popcornapp/themes/'.$themes[$theme].'.xml';
        }
        
        public function getTheme(){
            return $this->theme;
        } 
        
        public function setProducers(){
            $xml_obj = simplexml_load_file($this->theme);
            $xml_obj = $xml_obj->asXML();
            $new_xml_obj = new SimpleXMLElement($xml_obj);
            $i = 0;
            foreach($new_xml_obj->producer as $resource){
                if ($i == 4) break;
                $resource->property[3] = $this->files[$i];
                $i++;
            }
            
            return $new_xml_obj->asXML('/home/camila/Projects/Owncloud/owncloud/data/'.$this->title.'.xml');
        }        
       

}