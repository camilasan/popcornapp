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

use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\App;

class MltControllerTest extends PHPUnit_Framework_TestCase {

        private $controller;
        private $request;
        private $logger;
        private $xml;

        public function setUp() {
                parent::setUp();
                
                $app = new App('popcornapp');
                $this->container = $app->getContainer();
                
                //$AppName, IRequest $request, ILogger $logger, XMLWriter $xml
        
                $this->request = $this->getMockBuilder('OCP\IRequest')->getMock();
                $this->logger = $this->getMockBuilder('OCP\ILogger')->getMock();
                $this->xml = $this->getMockBuilder('XMLWriter')->getMock();
                
                //echo var_dump($userSession);
                $this->controller = new MltController(
                        'popcornapp', $this->request, $this->logger, $this->xml
                );
        }


        public function testConstruct() {
                $result = $this->controller;
                
                $this->assertTrue($result instanceof MltController);
                $this->assertTrue($result->getRequest() instanceof \OCP\IRequest);
                $this->assertTrue($result->getLogger() instanceof \OCP\ILogger);
                $this->assertTrue($result->getXml() instanceof \XMLWriter);
                $this->assertTrue($result->getView() instanceof \OC\Files\view);
                $this->assertTrue(is_array($result->getContent()));
        }
        
        public function testListFiles() {
                $file = '/avatar.jpg';
                $result = $this->controller->listFiles($file);
                $expectedResponse = new DataResponse(['file' => '/home/camila/Projects/Owncloud/owncloud/data'.$file]);
                $this->assertEquals($expectedResponse, $result);
        }        

}