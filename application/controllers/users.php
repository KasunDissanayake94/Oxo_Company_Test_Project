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
<<<<<<< HEAD
		
		
		
	
			$email = $_POST['email'];
			$password = $_POST['password'];
=======

		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()== FALSE){

			// redirect('users/index');
			echo 'invalid';
		}
		else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
>>>>>>> 0e994602abb61c39079aaa732848b08c07431b14

			$this->load->model('user_model');
			$user_id = $this->user_model->login_user($email,$password);

			if($user_id){
<<<<<<< HEAD
			
				$user_data = array(
						'user_id' => $user_id,
						'email' => $email,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('login_success','you are now logged in');
=======


				// if logged in, show the view

				// $this->load->view('home',$user_data);
				echo 'all ok';
>>>>>>> 0e994602abb61c39079aaa732848b08c07431b14

					// if logged in, show the view 
					
					$this->load->view('home',$user_data);
			}else{
<<<<<<< HEAD
				
				$this->session->set_flashdata('login_failed','Email or Password is incorrect... Try again..');
				redirect('Welcome/login');
			}
		
		
=======

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
>>>>>>> 0e994602abb61c39079aaa732848b08c07431b14

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
