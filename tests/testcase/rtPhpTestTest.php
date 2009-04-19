<?php
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '../../../src/rtAutoload.php';

class rtPhpTestTest extends PHPUnit_Framework_TestCase {

  public function setUp() {
    $this->testCase = array (
                        'TEST', 
                        'This is a test',
                        'FILE',
                        '<?php',
                        ' echo "hello world"; ',
                        '?>',
                        'EXPECTF',
                        'hello world',
    );
  }

  public function testCreateInstance() {
    $config = rtRuntestsConfiguration::getInstance(array('run-tests.php', '-p', 'a-php-exe', 'test.phpt'));
    $config->configure();
    
    $test = new rtPhpTest($this->testCase, 'nameOfTest', array('TEST', 'FILE', 'EXPECTF'), $config);
    $this->assertEquals('rtPhpTest', get_class($test));
  
  }
  
  public function testSections() {
    $config = rtRuntestsConfiguration::getInstance(array('run-tests.php', '-p', 'a-php-exe', 'test.phpt'));
    $config->configure();
    
    $test = new rtPhpTest($this->testCase, 'nameOfTest', array('TEST', 'FILE', 'EXPECTF'), $config);
    $this->assertEquals('rtTestHeaderSection', get_class($test->getSection('TEST')));
    $this->assertEquals('rtFileSection', get_class($test->getSection('FILE')));
    $this->assertEquals('rtExpectFSection', get_class($test->getSection('EXPECTF')));
  } 
  
  
}
?>