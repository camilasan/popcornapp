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

use SimpleXMLElement;

class XML {

        private $title;
        private $files;
        private $theme;
        private $xml_view;
        private $path;

        public function __construct($title, $files, $theme, $user, $app, $settings){
            $themes = array('blackandwhite', 'thehappyone');
            $this->title = $title;
            $this->files = $files;
            $this->theme = '/media/camila/home@opensuse/camila/Projects/Nextcloud/nextcloud/apps/popcornapp/themes/'.$themes[$theme].'.xml';
            $this->user = $user;
            $this->app = $app;
            $this->settings = $settings;
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

            return $new_xml_obj->asXML('/media/camila/home@opensuse/camila/Projects/Nextcloud/nextcloud/apps/popcornapp/themes/'.$this->title.'.xml');
        }


}
