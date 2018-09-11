<?php if($this->session->userdata('logged_in')):?>
	<h2>Logout</h2>



	<?php 
		if($this->session->userdata('email')){
			echo "<p>You are logged in as ".$this->session->userdata('email')."<p>";
		}
	
	?>

<?php endif;?>




	