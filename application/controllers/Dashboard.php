<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct () 
    {
    	parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('stuff_model');
    }
    public function index () 
    {   
    	if (!is_logged()) {
           redirect('/user/login');
    	}
    	redirect('dashboard/courses/1');
    	$this->data['page'] = 'dashboard/course/1';
        $this->load->view('template',$this->data);
    }


    public function courses ($status = 1)
    {   

        if (!is_logged()) {
           redirect('/user/login');
        }

       
        if ($this->input->get('page') != null) {
           $current_page = (intval($this->input->get('page')) == 0) ? 1 : intval($this->input->get('page'));
        } else {
          $current_page = 1;
        }
        
    	
      $per_page = 5;
      $all_data = $this->course_model->countResult($status,$this->session->userdata('user')['id']);
      
      
    	if ($status != 0 ) {
           $status = 1;
           $this->data['header_text'] = '<i class="fa fa-check" aria-hidden="true"></i> '.lang('navbar_completed_courses');
    	} else {
    		$this->data['header_text'] = "<i class='fa fa-play' aria-hidden='true'></i> ".lang('navbar_active_courses');
    	}
      
      if ($current_page == 1) {
         $offset = 0;
       } else {
         $offset = ($current_page - 1) * $per_page;
       }

    	  $this->data['completedCourses'] = $this->course_model->getCoursesByStatus($this->session->userdata('user')['id'],intval($status),$current_page,$per_page);
        $this->data['page'] = 'completed';
        $this->data['status'] = intval($status);
        $this->data['num_of_pages'] = ceil($all_data/$per_page);
        $this->data['current_page'] = $current_page;
        $this->data['offset']  = $offset;
        $this->load->view('template',$this->data);	
    }


    public function add()
    {
    	if ($this->input->is_ajax_request() && is_logged()) {
             
            $_POST['lectures_watched'] = ( $_POST['lectures_watched'] > $_POST['lecture_numbers']) ? 0 : $_POST['lectures_watched'];

            if ($this->input->post('id') != null) {
             // update course if course_id exists or add otherwise
            $actionCourse = $this->course_model->editCourse($this->input->post());

            }  else {
              
            $actionCourse = $this->course_model->addNewCourse($this->input->post());

            }
         // parr($actionCourse);exit;          

            if (is_array($actionCourse)) {

               if ($actionCourse['action'] == 'insert') {
               echo json_encode([
                  'action' => 'insert',
                  'msg' => 'Course Added Succesfully',
                  'status' => 'true'
                ]);
               } elseif ($actionCourse['action'] == 'edit') {
                echo json_encode([
                  'action' => 'edit',
                  'msg' => 'Course Added Succesfully',
                  'status' => 'true'
                ]);
               }               
            } else {

            	echo json_encode([
                  'msg' => 'Cant Add Course',
                  'status' => 'false'
            	]);
            }

    	} else {
    		redirect('/');
    	}
    }



    public function delete ($id) 
    {   
        $url = parse_url($this->agent->referrer());
        if (!is_logged() || empty($this->agent->referrer()) || strpos($url['path'],"dashboard/courses") == false) {
          redirect('/');
        }

       $delete = $this->course_model->deleteCourse($id,$this->session->userdata('user')['id']);
       
       if ($delete) {

                  $this->session->set_flashdata('delete_info',"Course Deleted Succesfully");   
                  redirect($this->agent->referrer());   
       } else {
               
               redirect('/');
       }

    }


    public function getCourseById()
    {
      if ($this->input->is_ajax_request() && is_logged()) {
            #parr($this->input->post());
          $course = $this->course_model->getCourseById((int)$this->input->post('course_id'));
           if ($course != null) {
             $course[0]['categorys'] = implode(',', json_decode($course[0]['categorys']));
             if (!empty($course[0]['course_projects'])) {
               $course[0]['course_projects'] = json_decode($course[0]['course_projects'])->url;
             }
             echo json_encode($course[0]);
           } else {
             echo json_decode([
                'msg' => 'no data',
                'status' => 'false'
             ]);
           }
        }
         else {
            redirect('/');
         }
    }

    public function stuff ()
    {  
        if (!is_logged()) {
         redirect('/');
       }
       
       $this->data['stuff'] = $this->stuff_model->getAllStuff($this->session->userdata('user')['id']);
       $this->data['page'] = 'readings';
       $this->load->view('template',$this->data);
    }

 
   public function notFound() {
     $this->data['heading'] = "Page Not Found";
     $this->data['message'] = '';
     $this->load->view('errors/html/error_notfound',$this->data);

   }

   public function test() { 

     $this->load->view('test');
   }
  public function addStuff ()
  {
     if ($this->input->is_ajax_request() && is_logged()) {
          if ($this->stuff_model->add_stuff($this->input->post())) {
            echo json_encode([
               "msg" => "Item Added Succesfully",
               "status" => "true"
              ]);
          } else {
            echo json_encode([
               "msg" => "Cant Add Course :(",
               "status" => "false"
              ]);
          }

     } else {
      redirect('/');
     }
  }

  public function deleteStuff($id)
  {
        $url = parse_url($this->agent->referrer());
        if (!is_logged() || empty($this->agent->referrer()) || strpos($url['path'],"dashboard/stuff") == false) {
          redirect('/');
        }
       

        $del = $this->stuff_model->deleteStuffById($id,$this->session->userdata('user')['id']);
        if ($del) {
            $this->session->set_flashdata('delete_info',"Course Deleted Succesfully");   
            redirect($this->agent->referrer());
        } else {
          redirect('/');
        }



  }



}

?>