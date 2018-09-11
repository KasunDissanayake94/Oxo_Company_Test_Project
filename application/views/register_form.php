<!DOCTYPE html>
<html>
<head>
	<title>Register Form</title>
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

</body>
</html>

<div class="container">
	<div class="form-group">
		<h2>Register Form</h2>
	</div>

	<?php $attribute= array('id'=>'login_form', 'class'=>'form_horizontal');?>


	<?php echo form_open('users/register',$attribute); ?>
	<div class="form-group">
		<?php echo form_label('First Name'); ?>
		<?php
			$data = array(
				'class' =>'form-control',
				'name' =>'firstname',
				'placeholder' =>'Enter Your First Name here',
			);
		?>
		<?php echo form_input($data); ?>
	</div>
  <div class="form-group">
		<?php echo form_label('Last Name'); ?>
		<?php
			$data = array(
				'class' =>'form-control',
				'name' =>'lastname',
				'placeholder' =>'Enter your Last Name here',
			);
		?>
		<?php echo form_input($data); ?>
	</div>
  <div class="form-group">
		<?php echo form_label('Email'); ?>
		<?php
			$data = array(
				'class' =>'form-control',
				'name' =>'email',
				'placeholder' =>'Enter your Email here',
        'type' => 'email'
			);
		?>
		<?php echo form_input($data); ?>
	</div>



	<div class="form-group">
		<?php echo form_label('Password'); ?>
		<?php
			$data = array(
				'class' =>'form-control',
				'name' =>'password',
				'placeholder' =>'Enter your Password here',
				'type'=>'password'
			);
		?>
		<?php echo form_input($data); ?>
	</div>
  <div class="form-group">
		<?php echo form_label('Confirm Password'); ?>
		<?php
			$data = array(
				'class' =>'form-control',
				'name' =>'confirmpassword',
				'placeholder' =>'ReEnter your Password here',
				'type'=>'password'
			);
		?>
		<?php echo form_input($data); ?>
	</div>



	<div class="form-group">

		<?php
			$data = array(
				'class' =>'btn btn-primary',
				'name' =>'submit',
				'value' =>'Register'

			);
		?>
		<?php echo form_submit($data); ?>
	</div>



	<?php	echo form_close(); ?>

</div>
