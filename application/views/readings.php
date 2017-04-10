<div class="container auth-container">
	<div class="row">
		<div class="col-md-6 panel main-panel  panel-default col-md-offset-3">
			<div class="panel-heading">
				<header>
				  <h1>Saved Stuff</h1>
			   </header>
			</div>
			<div class="panel-body ">

			</div>

                <?php 
                  if (count($stuff)):
                ?>
			<table class="table table-bordered table-hover">
               <thead>
                 <th>#</th>
               	 <th>Name</th>
               	 <th>Url</th>
                 <th>Categories</th>
                 <th></th>
               </thead>
                <tbody>
                 <?php 
                 $i = 1;
                 foreach($stuff as $item): 
                  
                 ?>
                      <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                      <p><?php echo $item->name; ?></p>
                    </td>
                    <td><a href="<?php echo $item->url; ?>" target="_blank">Url</a></td>
                    <td>
                    <?php foreach(json_decode($item->categories) as $category): ?>
                      <a href="#"><?php echo $category; ?></a>
                      <br>
                    <?php endforeach; ?>
                    </td>
                    <td>
                      <a href="<?php echo $base_url.'dashboard/deleteStuff/'.$item->id; ?>" id="delete_a_btn">
                        <span class="label label-danger del_label">Delete</span>
                      </a>
                    </td>
                  </tr>

                <?php  $i++;
                endforeach; ?>
                
                </tbody>				
			</table>
			<div class="row">
         <div class="col-md-9">
           <ul class="pagination">
                  <li><a href="#">&laquo</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="">&raquo</a></li>
</ul>
         </div>
         <div class="col-md-3">
            <div data-toggle="modal" data-target="#myModal" class="btn btn-success" id="add_stuff_btn">
               Add New Item
            </div>
         </div>
      </div>

                <?php else: ?>
              <div class="alert alert-danger add_stuff_btn">
                 You dont have saved stuff yet
              </div>
    
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
                                <label for="name" class="col-sm-4 control-label"><?php echo lang('course_table_name'); ?><span class="required" aria-required="true">*</span></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-user-circle"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="" required value="" name="name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url" class="col-sm-4 control-label"><?php echo lang('course_table_link'); ?><span class="required" aria-required="true">*</span></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-external-link" aria-hidden="true"></i>
                                    </div>
                                    <input type="text"  minlength="6"  class="form-control n_validation" placeholder="" required name="url"  >
                                </div>
                            </div>
                          
                           <div class="form-group">
                                <label for="categories" class="col-sm-4 control-label"><?php echo lang('course_table_tags'); ?> <small>(<?php echo lang('course_optional'); ?>)</small></label>
                                <div class="input-group">

                                    <div class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i>
                                    </div>
                                    <input required type="text" class="form-control" placeholder=""  name="categories">
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <div class="input-group">

                                    <input type="submit" class="btn btn-primary" class="form-control" id="addstuff_button" placeholder="" value="Add new course"  >
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



 <script type="text/javascript">
   $("#addstuff_button").click(function () {
               
       $("#modalform").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      url: "required",
      
      
    },
    // Specify validation error messages
    messages: {
      name: "Please enter name of saved item",
      url: "Please enter url of saved item",
      
     
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        //form.submit();
        //JSON.stringify(
        
        var formdata = $("#modalform").serializeArray();
        
        console.log(formdata);
         
       // Sent form using ajax
       $.ajax({
                    method:"POST",
                    url:"<?php echo $base_url; ?>dashboard/addStuff",
                    data:formdata,
                    dataType:"json"
                }).done(function(res){
                      event.preventDefault();
                       if (res.status == "true") {
                         swal({
                        title: res.msg,
                        text: "",
                        type: "success"
                    }, function() {
                        window.location.reload();
                    });
                       }                     
                }).fail(function(res){
                    console.log('pizdec'+res);
                });
    }
  });

      
     
    });    

 </script> 