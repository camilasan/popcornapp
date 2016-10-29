<?php
    if (!defined('PHPUNIT_RUN')) {
            define('PHPUNIT_RUN', 1);
    }
    require_once '/media/camila/home@opensuse/camila/Projects/Nextcloud/nextcloud/lib/base.php';
    \OC::$loader->addValidRoot(\OC::$SERVERROOT . '/tests');
    \OC_App::loadApp('popcornapp');
    if(!class_exists('PHPUnit_Framework_TestCase')) {
            require_once('PHPUnit/Autoload.php');
    }
    OC_Hook::clear();