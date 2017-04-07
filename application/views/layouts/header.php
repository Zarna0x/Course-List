<!DOCTYPE html>
<html>
<head>
	<title>Course List</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  

   <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js
"></script>
<!--
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css">
-->


    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/assets/css/app.css">

    <!-- Sweetalert-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- Sweetalert-->

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 


  <!-- Select Picker -->

</head>
<body>


<div class="loader_wrapper">
  <div class="loader"></div>
</div>

   <div id="header" >
   	  
   	  	<div id="menu">
   	  	   <a href="" id="logo"></a>
   	  	   <ul <?php if(get_lang() == 'geo'){ echo "id='geo_lang_class'"; } ?>>
   	  	     <?php if (is_logged()): ?>
              <li><a class="nodrop"  href="#home"><?php echo lang('navbar_home'); ?></a></li>
             <li><a class="nodrop" href="<?php echo $base_url; ?>dashboard/courses/1"><?php echo lang('navbar_completed_courses'); ?></a></li>
             <li><a class="nodrop"  href="<?php echo $base_url; ?>dashboard/courses/0"><?php echo lang('navbar_curently_watching'); ?></a></li>
             <li><a class="nodrop"  href="<?php echo $base_url; ?>dashboard/stuff"><?php echo lang('navbar_saved_readings'); ?></a></li>
             <li><a class="nodrop"  href="<?php echo $base_url; ?>user/logout"><?php echo lang('navbar_logout'); ?></a></li>
          <?php else: ?>

             <li><a class="nodrop" href="<?php echo $base_url; ?>user/login"><?php echo lang('auth_signin'); ?></a></li>
             <li><a class="nodrop" href="<?php echo $base_url; ?>/signup"><?php echo lang('auth_signup'); ?></a></li>
                            
         <?php endif; ?>
              <?php if(get_lang() == 'geo'): ?>
                 <li class="langimg"><a href="<?php echo $base_url; ?>language/switchLanguage/eng"><img class="lang_img" id="eng" src="https://maxcdn.icons8.com/Share/icon/Maps//usa1600.png"></a></li>
              <?php elseif(get_lang() == 'eng'): ?>
                 <li class="langimg"><a href="<?php echo $base_url; ?>language/switchLanguage/geo"><img class="lang_img" id="geo" src="http://img.freeflagicons.com/thumb/square_icon/georgia/georgia_640.png"></a></li>
              <?php endif; ?>
   	  	    
             
   	  	</div>
   	  
   </div>

<?php
 echo lang('gineba_shegeci');
?>


<script type="text/javascript">
  $(document).ready(function () {
    $('.loader').hide();
  });
</script>