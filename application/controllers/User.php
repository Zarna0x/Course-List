<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct () 
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->model('user_model');
	}





	public function singup ()
	{
		//var_dump($this->data);
	   $this->data['page'] = 'singup';
	   $this->load->view('template',$this->data);	
	}
    
    protected function isPost ($request = null) 
    {
       if ($_SERVER['REQUEST_METHOD'] == "POST") {
       	  return true;
       }

       return false;
    }
   
	public function postSignup() 
	{
        if  ($this->isPost()) {
            $userData = $this->input->post();
            #parr($userData);
            /*
             * Validation
             */
            $this->form_validation->set_rules('username', 'lang:username_a', 'trim|required|min_length[3]|max_length[32]');
            $this->form_validation->set_rules('password', 'lang:password_a', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('conf_password', 'lang:password_conf_a', 'trim|required|matches[password]');
			$this->form_validation->set_rules('email', 'lang:email_field_a', 'required|valid_email');
			
			if ($this->form_validation->run()) {
               $register = $this->user_model->addUser($userData);

               if (!isset($register['msg'])) {

                  $this->session->set_userdata('user',[
                     "id"        => $register['user_id'],
                     'username'  => $userData['username'],
                     'email'     => $userData['email'],
                     'logged_in' => true,
                  ]);

                  $this->session->set_flashdata('register_success',"You Registered Succesfully");	
                  redirect('/dashboard/courses/1');                          
               
               } else {
                  $this->session->set_flashdata('register_error',$this->user_model->addUser($userData)['msg']);	
                  redirect('/signup');             
               }
 			} else {
			  $this->session->set_flashdata('register_error',validation_errors());	
              redirect('/signup');              
            
			}
        }else{
        	redirect('/');
        } 
	}


	public function login () 
	{
       if ($this->isPost()) {
         $loginData =  $this->input->post();
          
         	$this->form_validation->set_rules('email', 'lang:email_field_a', 'required|valid_email');
    			$this->form_validation->set_rules('password', 'lang:password_a', 'trim|required|min_length[5]');
			
            if ($this->form_validation->run()) {
               if ($this->user_model->userExists($loginData['email'],$loginData['password'])) {
                 // user exists
                 
                 $user_info = $this->user_model->getUserData($loginData['email'],$loginData['password']);
               
                 if ($user_info != false) {
                 	$this->session->set_userdata('user',[
                     "id"        => $user_info['id'],
                     'username'  => $user_info['username'],
                     'email'     => $user_info['email'],
                     'logged_in' => true,
                  ]);


                  $this->session->set_flashdata('login_success',lang('login_success_msg'));	
                  redirect('/dashboard/courses/1');      
                 }
               } else {
               	 $this->session->set_flashdata('user_dont_exists',lang('wrong_email_or_user'));
               	 redirect('user/login');
               }
            }else{
               $this->data['page'] = 'singin';
		       $this->load->view('template',$this->data);            	
            }
       }else {


		$this->data['page'] = 'singin';
		$this->load->view('template',$this->data);
       }
	}

	public function logout () 
	{
		if (is_logged()) {
          unset($_SESSION['user']);
          redirect('/signup');
		} else {
			redirect(base_url()."/user/login");
		}
	}

  public function changeLanguage() {
     echo 'sd';
     //parent::__construct('geo'); 
   }

}
