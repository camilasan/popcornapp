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

namespace OCA\PopcornApp\Tests\Controller;

use OCA\PopcornApp\Controller\XML;
use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\App;

class XMLTest extends PHPUnit_Framework_TestCase {


        public function setUp() {
                parent::setUp();
                
                $app = new App('popcornapp');
                $this->container = $app->getContainer();

                //echo var_dump($userSession);
                $this->controller = new XML(
                        'Test', array('/data/Pictures/holiday1.jpg', '/data/Pictures/holiday2.jpg', '/data/Pictures/holiday3.jpg', '/data/Pictures/holiday4.jpg'), 1
                );
        }
        
        public function testGetTheme(){
                $result = $this->controller->getTheme();
                echo ($result);
        } 
        
        public function testSetProducers(){
                $result = $this->controller->setProducers();
                echo ($result);
        }          
        
        

}