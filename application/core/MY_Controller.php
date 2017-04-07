<?php

/*
 * Base Controller
 */

class MY_Controller extends CI_Controller 
{
   public $data = array(); 
   public function __construct () 
   {
   	 parent::__construct();


     $this->data['base_url'] = base_url();
     $this->load->library('user_agent');
     $this->guestMiddleware();
     $this->userMiddleware();

     $this->load->model('course_model');
   }

   protected function guestMiddleware()
   { // middleware for guests
      
      $notAllowedURIs = [
         'dashboard',
         'dashboard/index',
         'dashboard/courses/1',
         'dashboard/courses/0',
         'dashboard/add',
         'user/logout'
      ];

      if ($this->session->userdata('user') == null) { // if not logged in
           if (in_array(uri_string(),$notAllowedURIs)) {
              redirect('/user/login');
           }
      }
   }

   protected function userMiddleware()
   {
   	  $notAllowedURIs = [
         'user',
         'signup',
         'user/singup',
         'user/register',
         'user/postSignup',
         'user/login' 
      ];

      if ($this->session->userdata('user') != null) { // if logged in
           if (in_array(uri_string(),$notAllowedURIs)) {
              redirect('/dashboard');
           }
      }

   }
 

 public function langchange()
 {
   echo 'wtf';
 }

}



/*
 * Admin Controller
 */

class Admin_Controller extends MY_Controller 
{
	public function __construct ()
	{
		parent::__construct();
	}
}

?>