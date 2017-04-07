<?php
if ($this->session->flashdata('register_success') != null) {
?>
  <script type="text/javascript">
     sweetAlert("<?php echo $this->session->flashdata('register_success'); ?>", "", "success");
  </script>
<?php } elseif($this->session->flashdata('login_success') != null) {?>

  <script type="text/javascript">
     sweetAlert("<?php echo $this->session->flashdata('login_success'); ?>", "", "success");
  </script>

<?php
}?>
<?php
if ($this->session->flashdata('delete_info') != null) {
?>
  <script type="text/javascript">
     sweetAlert("<?php echo $this->session->flashdata('delete_info'); ?>", "", "success");
  </script>
<?php }?>
<div id="panel_container" class="container-fluid panel panel-default">

<?php
 ###parr($current_page);
?>
  <div class="panel-heading-completed panel-heading " <?php if(get_lang() == 'geo'){ echo "class='geo_lang_class_1'"; } ?> <?php if($status == 0){ echo "id='active_heading'"; } ?>><h1 id="tableheader"> <?php echo $header_text; ?></h1></div>
  <hr>        

   <div class="row">
   	 <div class="col-md-4">
   	 	<div class="form-group">

  <div class="input-group">
  <span class="input-group-addon"><?php echo lang('search_btn'); ?></span>
    <input type="text" name="search"  class="form-control" id="search_input">
  </div>
</div>
   	 </div>
   	 <!-- <div class="col-md-3">
   	 		<div class="form-group">
          <button type="button" id="search-button" class="btn btn-primary" id="usr"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
         </div>
   	 </div>
   	  --><div class="col-md-1">
   	 	<div class="form-group">
          <button type="button" id="add-button"  class="btn btn-warning" id="usr"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_course_btn'); ?></button>
       </div>
   	 </div>
   </div>
  

  <!-- Main Table -->

  <div class="row">
     <div class="col-md-12">
       <table id="mainTable" class="table table-bordered table-hover table-condensed">
    <thead <?php if(get_lang() == 'geo'){ echo "class='geo_thead'"; } ?> id="table_head">
      <tr class="active">
        <th><p>#</p></th>
        <th><p><?php echo lang('course_table_name'); ?></p></th>
        <th><p><?php echo lang('course_table_link'); ?></p></th>
        <?php if($status == 0): ?>
          <th><p><?php echo lang('course_table_current'); ?></p></th>
        <?php endif; ?>
        <th><p><?php echo lang('course_table_lecture_num'); ?></p></th>
        <?php if($status == 0): ?>
          <th><p><?php echo lang('course_table_progress'); ?></p></th>
        <?php endif; ?>
         <th><p><?php echo lang('course_table_tags'); ?></p></th>
         <th><p><?php echo lang('course_table_desc'); ?></p></th>
         <th><p><?php echo lang('course_table_projects'); ?></p></th>
         <th><p><?php echo lang('course_table_img'); ?></p></th>
         <th></th>
         <th></th>
      </tr>
    </thead>
    <tbody id="table_body">
   <?php if(!empty($completedCourses)): 
   

   $i = 1;
   ?>
   <?php foreach($completedCourses as $course): ?>
        <tr>
        <td  class="course_name"><?php echo $offset + $i; ?></td>
        <td id="cname" class="course_name"><?php echo $course->course_name; ?></td>
        <td  class="course_name"><a target="_blank" href="<?php echo $course->course_link; ?>">Lecture Videos</a></td>
        <?php if($status == 0): ?>
          <td  class="course_name"><?php echo $course->lectures_watched; ?></td>
        <?php endif; ?>
        <td  class="course_name"><?php echo $course->lecture_numbers; ?></td>
        <?php if($status == 0):
           $percent = round(($course->lectures_watched * 100) / $course->lecture_numbers); 
       ?>
          <td  class="course_name">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $course->lectures_watched; ?>" aria-valuemin="0" aria-valuemax="<?php echo $course->lecture_numbers; ?>" style="width: <?php echo $percent;?>%;">
    <b style="color:#c0d6f9;"><?php echo $percent."%";?></b>
  </div>
          </td>
        <?php endif; ?>
        <td  class="course_name">
         <?php foreach(json_decode($course->categorys) as $tag){
         ?>
               <a href=""><?php echo strtolower($tag); ?></a><br>
         <?php
          }?>
      
        </td>
        
        <td class="course_name"><?php echo str_clean($course->course_description); ?></td>
        
        <td class="course_name">
          <?php if(!empty($course->course_projects)): ?>
            <?php foreach(json_decode($course->course_projects) as $pKey => $pVal):
         ?>
             <a target="_blank" href="<?php echo $pVal; ?>"><?php echo $pKey; ?></a><br>
         


          <?php 
              
          endforeach; ?>
         
          <?php endif; ?>
        </td>
          <td>
            <img id="course_image" src="<?php echo $course->course_img; ?>">
          </td>
         <td class="course_name" id="btn_edit" value="<?php echo $course->id; ?>">
          <i class="fa fa-pencil-square-o fa-2x black-fa" aria-hidden="true"></i>
         </td >
         <td id="delete_btn" class="course_name"><a href="<?php echo $base_url.'dashboard/delete/'.$course->id; ?>"><i class="fa fa-trash fa-2x black-fa" aria-hidden="true"></i></a></td>

         
      </tr>
   <?php $i++;
   endforeach; ?>
   <?php else: ?>
     <div class="container">
       <div class=" alert alert-danger"> You don't have <?php if($status == 1){echo "completed"; }else { echo "active"; }?> courses yet </div>
     </div> 

   <?php endif; ?>
     
      
      
    </tbody>
  </table>
  <?php if($num_of_pages > 1): ?>
    <ul class="pagination pull-right">
                  <li><a href="?page=<?php echo ($current_page-1); ?>">&laquo</a></li>
             <?php for($i = 1; $i <= $num_of_pages; $i++){
              ?>
             <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
             <?php
              } ?>
 
            <?php if ($current_page < $num_of_pages): ?>
              <li><a href="?page=<?php echo ($current_page+1); ?>">&raquo</a></li>
            <?php endif; ?>
   
</ul>
  <?php endif; ?>
</div>


     </div>
  </div>


    
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo lang('add_new_course'); ?></h4>
        </div>
        <div class="modal-body">
           <form id="modalform" action="" method="post">
                       
                    <div class="row">
                        <!--left side-->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            
                            <div class="form-group">
                                <label for="course_name" class="col-sm-4 control-label"><?php echo lang('course_table_name'); ?><span class="required" aria-required="true">*</span></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-user-circle"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="" required value="" name="course_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="course_link" class="col-sm-4 control-label"><?php echo lang('course_table_link'); ?><span class="required" aria-required="true">*</span></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-external-link" aria-hidden="true"></i>
                                    </div>
                                    <input type="text"  minlength="6"  class="form-control n_validation" placeholder="" required name="course_link"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lecture_numbers" class="col-sm-4 control-label"><?php echo lang('course_table_lecture_num'); ?></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                                    <input type="number" required class="form-control"  maxlength="11" min='1' placeholder="" required name="lecture_numbers">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lectures_watched" class="col-sm-4 control-label"><?php echo lang('course_table_current'); ?> <small>(<?php echo lang('course_optional'); ?>)</small></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </div>
                                    <input type="number" class="form-control" placeholder=""   name="lectures_watched">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categorys" class="col-sm-4 control-label"><?php echo lang('course_table_tags'); ?> <small>(<?php echo lang('course_optional'); ?>)</small></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i>
                                    </div>
                                    <input required type="text" class="form-control" placeholder=""  name="categorys">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="course_description" class="col-sm-4 control-label"><?php echo lang('course_table_desc'); ?> <small>(<?php echo lang('course_optional'); ?>)</small></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-comments" aria-hidden="true"></i></div>
                                    <textarea  class="form-control summernote" placeholder=""  name="course_description"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="course_projects" class="col-sm-4 control-label"><?php echo lang('course_table_projects'); ?> <small>(<?php echo lang('course_optional'); ?>)</small></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-tasks" aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder=""  name="course_projects">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="course_img" class="col-sm-4 control-label"><?php echo lang('course_table_img'); ?></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                                    <input type="text" required class="form-control" placeholder=""  name="course_img">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="completed" class="col-sm-4 control-label"><?php echo lang('course_status'); ?></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-trophy" aria-hidden="true"></i>
                                    </div>
                                    <select required class="form-control" placeholder=""  name="completed">
                                        <option value="1"><?php echo lang('course_completed'); ?></option>
                                        <option value="0"><?php echo lang('course_active'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <div class="input-group">

                                    <input type="submit" class="btn btn-primary" class="form-control" id="addcourse_button" placeholder="" value="Add new course"  >
                                    <!--  Add new course
                                    </button> -->
                                </div>
                            </div>


                           



                        </div>

                       
                    </form>


        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
  
  <!-- endmodal -->


<script type="text/javascript">
 
 $(document).ready(function() {
  
  $("#search_input").keyup(function () {
    //split the current value of searchInput
    var data = this.value.split(" ");

    //create a jquery object of the rows
    var jo = $("#table_body").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});
 
  $('#add-button').click( function () {
    $('#modalform')[0].reset();
    $("input[name=id]").val("");
    $('#myModal').modal('toggle');
  });



    $("#addcourse_button").click(function () {
               
       $("#modalform").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      course_name: "required",
      course_link: "required",
      
      course_description: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      course_name: "Please enter Course name",
      course_link: "Please enter course link",
      course_description: {
        required: "desc is required",
        minlength: "Your description must be at least 5 characters long"
      },
     
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        //form.submit();
        //JSON.stringify(
        
        var formdata = $("#modalform").serializeArray();
        
        //console.log(formdata);
         
       // Sent form using ajax
       $.ajax({
                    method:"POST",
                    url:"<?php echo $base_url; ?>dashboard/add",
                    data:formdata,
                    dataType:"json"
                }).done(function(res){
                      event.preventDefault();
                      if (res.status == "true") {
                        // Success Swal message
                      if (res.action == 'insert') {
                     swal({
                        title: "<?php echo lang('course_add_success'); ?>",
                        text: "",
                        type: "success"
                    }, function() {
                        window.location.reload();
                    });

                      } else if (res.action == 'edit') {
                        swal({
                            title: "<?php echo lang('course_edit_success'); ?>",
                            text: "",
                            type: "success"
                        }, function() {
                            window.location.reload();
                        });

                      }                       

                      } else {
                        alert('pizdeeeec');
                      }

                     // window.opener.location.reload();

                }).fail(function(res){
                    console.log('pizdec'+res);
                });
    }
  });

      
     
    });    


$('body').on('click','#btn_edit',function  () {
   var course_id = $(this).attr('value');
   $( "#modalform" ).append( "<input type='hidden'  name='id'  value='"+course_id+"' />" );
   // sent data to get data
   $.ajax({
                    method:"POST",
                    url:"<?php echo $base_url; ?>dashboard/getCourseById",
                    data:{"course_id": course_id},
                    dataType:"json"
                }).done(function(res){
                   var modaltitle = $('.modal-title').html("<?php echo lang('course_edit'); ?>");
                   var btntitle = $('#addcourse_button').val("<?php echo lang('course_edit'); ?>");
                   var course_name =  $("input[name=course_name]").val(res.course_name);                   
                   var course_link =  $("input[name=course_link]").val(res.course_link);
                   var lecture_numbers =  $("input[name=lecture_numbers]").val(res.lecture_numbers);
                   var lectures_watched =  $("input[name=lectures_watched]").val(res.lectures_watched);
                   var categorys =  $("input[name=categorys]").val(res.categorys);
                   var course_description =  $("textarea[name=course_description]").val(res.course_description);
                   var course_projects =  $("input[name=course_projects]").val(res.course_projects);
                   var course_img =  $("input[name=course_img]").val(res.course_img);
                   var course_completed =  $("select[name=completed]").val(res.completed);
                  $('#myModal').modal('toggle');
                }).fail(function(res){
                    console.log('pizdec'+res);
                });   
});

});
 
</script>

