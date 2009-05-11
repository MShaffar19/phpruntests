<?php
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '../../../../../src/rtAutoload.php';

class rtCookieSectionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateInstance() 
    {
        $cookieSection = new rtCookieSection('COOKIE', array('hello=World&goodbye=MrChips'));  
        $envlist = $cookieSection->getCookieVariables();

        $this->assertEquals('hello=World&goodbye=MrChips', $envlist['HTTP_COOKIE']);
    }
}
?>