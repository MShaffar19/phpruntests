<?php

  require_once 'PHPUnit/Framework.php';
  require_once dirname(__FILE__) . '../../../src/rtAutoload.php';


  class rtCommandLineOptionsTest extends PHPUnit_Framework_TestCase
  {
    public function testNoOption() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php'));
      $fileArray = $clo->getTestFilename();
      $this->assertTrue(is_array($fileArray));
    }

    public function testShortOption() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', '-n'));
      $this->assertTrue($clo->hasOption('n'));
    }

    public function testLongOption() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', '--help'));
      $this->assertTrue($clo->hasOption('help'));
    }

    public function testShortOptionWithArg() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', '-l', 'the-l-arg'));
      $this->assertTrue($clo->hasOption('l'));
      $this->assertEquals('the-l-arg', $clo->getOption('l'));
    }

    public function testLongOptionWithArg() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', '--html', 'the-html-arg'));
      $this->assertTrue($clo->hasOption('html'));
      $this->assertEquals('the-html-arg', $clo->getOption('html'));
    }

    public function testNonexistingOption() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php'));
      $this->assertFalse($clo->hasOption('nonexisting'));
      // test for exception when calling getRunOption('nonexisting')?
    }

   /**
    * @expectedException RuntimeException
    */
    public function testMissingShortOptionArgument() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', '-l'));
      $clo->getOption('l');
    }

   /**
    * @expectedException RuntimeException
    */
    public function testMissingLongOptionArgument() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', '--html'));
      $clo->getOption('html');
    }

    public function testFileArgument() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', 'the-filename'));
      $fileArray = $clo->getTestFilename();
      $this->assertEquals('the-filename', $fileArray[0]);
    }
    
    public function testManyFileArgument() {
      $clo = new rtCommandLineOptions();
      $clo->parse(array('run-tests.php', 'the-filename1', 'the-filename2'));
      $fileArray = $clo->getTestFilename();
      $this->assertEquals('the-filename2', $fileArray[1]);
    }

    // a nasty case is a filename starting with - or --
    // the filename should be quoted in that case
  }

?>