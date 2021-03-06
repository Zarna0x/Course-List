<?php

defined("BASEPATH") or die('No Direct Access');

class Stuff_model extends CI_Model 
{
  public function getAllStuff ($user_id) 
  {
    $this->db->where('user_id',intval($user_id));
    $query = $this->db->get('stuff');
    //echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
    	return [];
    }
  }

  public function add_stuff($formData) 
  {
     
     if (!empty($formData['categories'])) {
         $formData['categories'] = json_encode(explode(',', $formData['categories']));
      }

     if (is_logged()) {
          $formData['user_id'] = intval($this->session->userdata('user')['id']);
      }
     
      if ($this->db->insert('stuff', $formData)) { 
         return true;
      } else {
      	return false;
      }
     
  }

  public function stuffExists($id) {
     $this->db->where('id',intval($id));
     $query = $this->db->get('stuff');
     if ($query->num_rows() == 1) {
        return true;
     } else  {
      return false;
     }
     
  }

  public function deleteStuffById($stuffId,$user_id)
  {
    if (!$this->stuffExists($stuffId)) {
        return false;
    }

    $delete = $this->db->delete('stuff',[
          'id' => intval($stuffId),
           'user_id' => intval($user_id)
        ]);
       
       if ($this->db->affected_rows() != 0) {
           return true;
       } else {

         return false;
       } 
  }
}

?>