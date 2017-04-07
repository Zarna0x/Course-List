<?php
defined('BASEPATH') or die;

class User_model extends CI_Model
{
    
   public function userExists($email,$password = null) {
     $this->db->where('email',$email);
      if ($password != null) {
        $this->db->where('password',sha1($password));
      }
      $query = $this->db->get('users');
      
      if ($query->num_rows() > 0) {
         return true;
      } else {
      	return false;
      }
  }

    public function addUser ($userData) 
    {
      // check if email is taken
      if ($this->userExists($userData['email'])) {
         return [
            'msg' => lang('email_exists'),
            'status' => false
          ];
      }

      unset($userData['conf_password']);
      unset($userData['_token']);
      $userData['password']  = sha1($userData['password']);
      //add user
       
       if ($this->db->insert('users',$userData)) {
       	
          return [
             "user_id" => $this->db->insert_id(),
             'status'  => true   
          ];
       } 

       else {
       	 return [
           'msg' => lang('adduser_error'),
           'status' => false 
       	 ];
       } 

    }

    public function getUserData ($email,$password = null) {
      
      $this->db->select(['id','email','username']);
      $this->db->where('email',$email);
      if ($password != null) {
        $this->db->where('password',sha1($password));
      }
      $query = $this->db->get('users');
      
      if ($query->num_rows() > 0) {
         return $query->result_array()[0];
      } else {
      	return false;
      }	
    }
}


?>