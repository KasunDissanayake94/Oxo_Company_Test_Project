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

			$email = $this->input->post('email');
			$password = $this->input->post('password');

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
					$this->load->view('home',$user_data);
			}else{


				$this->session->set_flashdata('login_failed','Email or Password is incorrect... Try again..');
				redirect('Welcome/login');
			}

	}

	public function logout(){
		//destroy the session
		$this->session->sess_destroy();
		redirect('Welcome/index');
	}
	public function editProfile(){
        $this->load->view('edit_user_profile');
    }

}
