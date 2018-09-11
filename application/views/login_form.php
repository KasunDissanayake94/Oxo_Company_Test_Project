<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

</body>
</html>




	
<div class="container">
	

	<form class="form-signin text-center" action="<?php echo base_url();?>users/login" method="POST">
	   	<div class="col col-lg-4 col-sm-4">
	   		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>


	   		<div class="form-group text-danger">		
				<?php if($this->session->flashdata('login_failed')):  ?>
					<?php echo $this->session->flashdata('login_failed');?>
				<?php endif;?>
			</div>


	   		<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters">
			</div>

	    
	      <div class="checkbox mb-3">
	        <label>
	          <input type="checkbox" value="remember-me"> Remember me
	        </label>
	      </div>
	      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
	   	</div>
      
    </form>

</div>

