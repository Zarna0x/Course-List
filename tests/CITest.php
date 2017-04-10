<?php
 class CITest extends PHPUnit_Framework_TestCase
  {
    private $CI;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
      $this->CI->load->model('course_model');
    }
    public function testGetPost()
    {
      $this->assertEquals(1,1);
    }
  }