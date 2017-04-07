<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	public function __consturct()
	{
		parent::__consturct();
	}

	public function migrate ()
	{   
		if(!is_logged()){
          redirect('/');
		}
     	$this->load->library('migration');	

         if ($this->migration->current() == FALSE)
         {
              show_error($this->migration->error_string());
              return ;
         }

         echo 'Migrated Succesfully';
	}
}

?>