<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function index(){	
	
		$this->load->view('login_form');

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
}
