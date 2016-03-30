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

use OCA\PopcornApp\Controller\PageController;

use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\App;

class PageControllerTest extends PHPUnit_Framework_TestCase {

	private $controller;

	public function setUp() {
                parent::setUp();
                
                $app = new App('popcornapp');
                $this->container = $app->getContainer();
        
		$request = $this->getMockBuilder('OCP\IRequest')->getMock();
		
                //echo var_dump($userSession);
		$this->controller = new PageController(
			'popcornapp', $request
		);
	}


	public function testIndex() {
		$result = $this->controller->index();

		$this->assertEmpty($result->getParams());
		$this->assertEquals('main', $result->getTemplateName());
		$this->assertTrue($result instanceof TemplateResponse);
	}

}