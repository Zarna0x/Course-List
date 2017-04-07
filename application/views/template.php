<?php 
$this->load->view('layouts/header');
 if (isset($page)) {
   $this->load->view($page);
 }
$this->load->view('layouts/footer');

?>