<?php
    if (!defined('PHPUNIT_RUN')) {
            define('PHPUNIT_RUN', 1);
    }
    require_once '/home/camila/Projects/Owncloud/owncloud/lib/base.php';
    \OC::$loader->addValidRoot(\OC::$SERVERROOT . '/tests');
    \OC_App::loadApp('popcornapp');
    if(!class_exists('PHPUnit_Framework_TestCase')) {
            require_once('PHPUnit/Autoload.php');
    }
    OC_Hook::clear();