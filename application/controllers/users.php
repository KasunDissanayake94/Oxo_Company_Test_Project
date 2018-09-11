<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function user_login(){
		$this->load->view('login_form');

	}
	public function user_register(){
		$this->load->view('register_form');
	}


	public function login(){

		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()== FALSE){

			// redirect('users/index');
			echo 'invalid';
		}
		else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->load->model('user_model');
			$user_id = $this->user_model->login_user($email,$password);

			if($user_id){


				// if logged in, show the view

				// $this->load->view('home',$user_data);
				echo 'all ok';

				 // redirect('home/index');
			}else{

				// redirect('users/index');
				echo 'no perwon in db';
			}
		}
	}
	//User Registration

	public function register(){
		$this->form_validation->set_rules('firstname','First Name','required');
		$this->form_validation->set_rules('lastname','Last Name','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','required');

		if($this->form_validation->run()== FALSE){
			// redirect('users/index');
			echo 'invalid';

		}else if ($this->input->post('password') != $this->input->post('confirmpassword')) {
			echo "Please add the same password";
		}
		else{
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('password');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirmpassword');

			$this->load->model('user_model');
			$user_id = $this->user_model->login_user($email,$password);

			if($user_id){

				// if logged in, show the view

				// $this->load->view('home',$user_data);
				echo 'all ok';

				 // redirect('home/index');
			}else{

				// redirect('users/index');
				echo 'no perwon in db';
			}

			//User Registration


		}

	}
}
