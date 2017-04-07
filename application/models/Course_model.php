<?php
defined('BASEPATH') or die;

class Course_model extends CI_Model
{
   public function getCoursesByStatus($user_id,$completed = 1,$currentPage = 1, $perPage)
   {
      ##var_dump($currentPage);
      ##var_dump($perPage);

      $this->db->where('completed',$completed);
      $this->db->where('user_id',$user_id);
      if ($currentPage == 1) {
         $this->db->limit($perPage);
      } else {
         $this->db->limit($perPage,($currentPage - 1)*$perPage);
      }

      $this->db->order_by('id','DESC');
      $query = $this->db->get('courses');
      ##echo $this->db->last_query();
      return $query->result();  
      ##parr($query->result());
   }


   public function addNewCourse ($formData)
   {
    
      $checkImage = @exif_imagetype($formData['course_img']);

      $formData['course_img'] = ($checkImage != false) ? $formData['course_img'] : 'http://leafletjs.com/examples/geojson/thumbnail.png';
      
      if (!empty($formData['categorys'])) {
         $formData['categorys'] = json_encode(explode(',', $formData['categorys']));
       }

       if (!empty($formData['course_projects'])) {
         $formData['course_projects'] = json_encode(["url" => $formData['course_projects']]);
       }

       if (is_logged()) {
           $formData['user_id'] = $this->session->userdata('user')['id'];
       }
  
       if ($this->db->insert('courses', $formData)) {
       	  return [
            'action' => 'insert',
            'status' => true
          ];
       } else
       {
       	 return false;
       }
    }


    public function deleteCourse($courseId,$user_id) 
    {
     
        $delete = $this->db->delete('courses',[
          'id' => intval($courseId),
           'user_id' => intval($user_id)
        ]);
       
       if ($this->db->affected_rows() != 0) {
           return true;
       } else {

         return false;
       } 

   }

   public function getCourseById($course_id)
   {
      $this->db->where('id',$course_id);
      $query = $this->db->get('courses');
      if (count($query->result())) {
        return $query->result_array();
      }
   }

   public function editCourse ($course_data)
   {
    $checkImage = @exif_imagetype($course_data['course_img']);

      $course_data['course_img'] = ($checkImage != false) ? $course_data['course_img'] : 'http://leafletjs.com/examples/geojson/thumbnail.png';
      
      if (!empty($course_data['categorys'])) {
         $course_data['categorys'] = json_encode(explode(',', $course_data['categorys']));
       }

       if (!empty($course_data['course_projects'])) {
         $course_data['course_projects'] = json_encode(["url" => $course_data['course_projects']]);
       }

       if (is_logged()) {
           $course_data['user_id'] = $this->session->userdata('user')['id'];
       }
      if (is_logged()) {
           $course_data['user_id'] = $this->session->userdata('user')['id'];
       }
     $this->db->where('id',$course_data['id']);
     $update = $this->db->replace('courses',$course_data);
     if ($this->db->affected_rows() != 0) {
        return [
            'action' => 'edit',
            'status' => true
          ];
     }else {
       return false;
     }
   }


   public function countResult ($status,$user_id) 
   {
       $this->db->where('completed',$status);
       $this->db->where('user_id',$user_id);
       $this->db->from('courses');

       return $this->db->count_all_results();
   }

}
?>