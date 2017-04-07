<?php
if ($this->session->flashdata('user_dont_exists') != null) {
?>
  <script type="text/javascript">
     sweetAlert("<?php echo $this->session->flashdata('user_dont_exists'); ?>", "", "error");
  </script>
<?php }?>
 <div class="container auth-container">
   	<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1><?php echo lang('auth_signin'); ?></h1>
		 	<?php if (!empty(validation_errors())): ?>
               <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
		 	<?php endif; ?>
		 	<form action="" method="post">
			<div class="form-group">
				<label for="email"><?php echo lang('auth_email'); ?></label><br>
				<input type="text" id="email" class="form-control" name="email">
			</div>

			<div class="form-group">
				<label for="password"><?php echo lang('auth_password'); ?></label><br>
				<input type="password" class="form-control" id="password" name="password">
			</div>
			<button type="submit" class="btn btn-primary"><?php echo lang('auth_signin'); ?></button>
		</form>
		<p><?php echo lang('auth_dont_have'); ?> <a href="<?php echo $base_url; ?>signup"><?php echo lang('auth_register_redirect'); ?></a> </p>
	</div>
</div>
   </div>
