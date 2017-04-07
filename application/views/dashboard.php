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