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

use OCA\PopcornApp\Controller\MltController;
use OCA\PopcornApp\Controller\XML;

use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\App;
use OCP\IUserSession;
use OCP\IConfig;

class MltControllerTest extends PHPUnit_Framework_TestCase {

        private $controller;
        private $request;
        private $logger;
        private $xml;
        private $session;

        public function setUp() {
                parent::setUp();
                
                $app = new App('popcornapp');
                $this->container = $app->getContainer();

                $this->request = $this->getMockBuilder('OCP\IRequest')->getMock();
                $this->session = $this->getMockBuilder('OCP\IUserSession')->getMock();
                $this->conf = $this->getMockBuilder('OCP\IConfig')->getMock();
                //echo var_dump($userSession);
                $this->controller = new MltController(
                        'popcornapp', $this->request, $this->session, $this->conf
                );
        }
        
        public function testConstruct() {
                $result = $this->controller;

                $this->assertTrue($result instanceof MltController);
                $this->assertTrue($result->getRequest() instanceof \OCP\IRequest);
                $this->assertTrue($result->getView() instanceof \OC\Files\view);
                $this->assertTrue(is_array($result->getContent()));
        }      
        
        public function testListFiles() {
                $file = '/avatar.jpg';
                $result = $this->controller->listFiles($file);
                $expectedResponse = new DataResponse(['file' => '/media/camila/home@opensuse/camila/Projects/Nextcloud/nextcloud/data'.$file]);
                $this->assertEquals($expectedResponse, $result);
        }  
        
        public function testCreateVideo(){
                $result = $this->controller->createVideo('Test', array('/data/Pictures/holiday1.jpg', '/data/Pictures/holiday2.jpg', '/data/Pictures/holiday3.jpg', '/data/Pictures/holiday4.jpg'), 0);
                //$result = $this->controller->saveVideo();
                echo var_dump($result);
        }          
        
        

}