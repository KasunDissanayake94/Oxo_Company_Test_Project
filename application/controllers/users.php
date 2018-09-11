<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function index(){	
	
		$this->load->view('login_form');

	}


	public function login(){
		
		
		
	
			$email = $_POST['email'];
			$password = $_POST['password'];

			$this->load->model('user_model');
			$user_id = $this->user_model->login_user($email,$password);
			
			if($user_id){
			
				$user_data = array(
						'user_id' => $user_id,
						'email' => $email,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('login_success','you are now logged in');

					// if logged in, show the view 
					
					$this->load->view('home',$user_data);
			}else{
				
				$this->session->set_flashdata('login_failed','Email or Password is incorrect... Try again..');
				redirect('Welcome/login');
			}
		
		










	}
}
