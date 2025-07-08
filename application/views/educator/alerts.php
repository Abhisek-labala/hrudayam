<?php 
	if($this->session->flashdata('message')){
	$msg = $this->session->flashdata('message');
	?>				
	<div class="alert alert-success">
	<strong>Success!</strong> <?php echo $msg?>
	</div>				
	<?php }
	?>

	<?php 
	if($this->session->flashdata('info')){
	$msg = $this->session->flashdata('info');
	?>				
	<div class="alert alert-success">
	<strong>Success!</strong> <?php echo $msg?>
	</div>				
	<?php }
	?>

	<?php 
	if($this->session->flashdata('error')){
	$msg = $this->session->flashdata('error');
	?>				
	<div class="alert alert-danger">
	<?php echo $msg?>
	</div>				
	<?php }
	?>
	

	<?php 
unset($_SESSION['error']);
unset($_SESSION['message']);
unset($_SESSION['info']);
?>