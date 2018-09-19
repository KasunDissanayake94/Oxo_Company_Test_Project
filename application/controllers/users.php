<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function user_login(){
		$this->load->view('login_form');

	}
	public function user_register(){
		$this->load->view('register_form');
	}
	public function changeImage(){
        $image = $this->input->get('image');
        $this->load->view('edit_Profile_Image',$image);
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
        $email = $this->session->userdata('email');
        if($email){
            $this->load->model('user_model');
            if(!$this->user_model->edit_Profile($email)){
                //User available in user table but unavailable in user_details table cannot happen
                //$this->load->view('error_404');
            }else{
                $data['instant_req'] = $this->user_model->edit_Profile($email);
                $this->load->view('edit_user_profile',$data);
            }


        }
    }
    public function editUserProfile(){
        $this->form_validation->set_rules('firstname','First Name','required');
        $this->form_validation->set_rules('lastname','Last Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('type','Type','required');
        $this->form_validation->set_rules('contactnumber','Contact Number','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirmpassword','Confirm Password','required');




        if($this->form_validation->run()== FALSE){
            $this->session->set_flashdata('register_failed','Please fill all the fields');
            $this->load->view('editUser');

        }else if ($this->input->post('password') != $this->input->post('confirmpassword')) {
            $this->session->set_flashdata('register_failed','Please add the same password');
            $this->load->view('editUser');
        }
        else{
            $id = $this->input->post('id');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $type = $this->input->post('type');
            $contact_number = $this->input->post('contactnumber');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);


            $this->load->model('user_model');
            $user_id = $this->user_model->edit_User_Final($id,$firstname,$lastname,$email,$type,$contact_number,$password);

            $this->session->set_flashdata('register_success','Details Successfully Changed');
            $this->load->view('editUser');

        }
    }

}
