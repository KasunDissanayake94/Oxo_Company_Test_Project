<?php if($this->session->userdata('logged_in')):?>
	<h2>Logout</h2>

	<!-- <?php echo form_open('users/logout');?> -->

	<?php 
		if($this->session->userdata('username')){
			echo "<p>You are logged in as ".$this->session->userdata('email')."<p>";
		}
	
	?>

<?php endif;?>




	