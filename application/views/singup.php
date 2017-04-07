 <div class="container auth-container">
   	<div class="row">
       
	<div class="col-md-4 col-md-offset-4">
		<h1><?php echo lang('auth_signup'); ?></h1>
		<?php
           if ($this->session->flashdata('register_error') != null) {
             ?>
           <div class="alert alert-danger">
           	<?php echo $this->session->flashdata('register_error'); ?>
           </div>
             <?php
           }
		?>
		<form action="<?php echo $base_url?>user/register" method="post">
			<div class="form-group">
				<label for="username"><?php echo lang('auth_username'); ?></label><br>
				<input type="text" id="username" class="form-control" name="username">
			</div>

			<div class="form-group">
				<label for="email"><?php echo lang('auth_email'); ?></label><br>
				<input type="text" id="email" class="form-control" name="email">
			</div>

			<div class="form-group">
				<label for="password"><?php echo lang('auth_password'); ?></label><br>
				<input type="password" class="form-control" id="password" name="password">
			</div>

			<div class="form-group">
				<label for="conf_password"><?php echo lang('auth_password_again'); ?></label><br>
				<input type="password" class="form-control" id="conf_password" name="conf_password">
			</div>

			<button type="submit" class="btn btn-primary"><?php echo lang('auth_signup'); ?></button>
			<input type="hidden" name="_token" value="7W7TFiaRmclsOiW5hSvQHrkEUxgKinVImVoiF1eX">
		</form>
	</div>
</div>
   </div>