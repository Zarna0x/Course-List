<?php
 class CITest extends PHPUnit_Framework_TestCase
  {
    private $CI;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
      
      $x = str_clean($text);
      var_dump($x);
    }
    public function testGetPost()
    {
      $this->assertEquals(1,1);
    }
  }