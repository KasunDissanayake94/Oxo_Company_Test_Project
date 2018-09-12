<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminController extends CI_Controller {
    public function UserRegistration(){
        $this->load->view('userRegistration');
    }
    public function registerUser(){
        $this->form_validation->set_rules('firstname','First Name','required');
        $this->form_validation->set_rules('lastname','Last Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('type','Type','required');
        $this->form_validation->set_rules('contactnumber','Contact Number','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirmpassword','Confirm Password','required');
        $this->form_validation->set_rules('imageurl','Image Url','required');

        if($this->form_validation->run()== FALSE){
            // redirect('users/index');
            echo 'invalid';

        }else if ($this->input->post('password') != $this->input->post('confirmpassword')) {
            echo "Please add the same password";
        }
        else{
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $type = $this->input->post('type');
            $contact_number = $this->input->post('contactnumber');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $image_url = $this->input->post('imageurl');


            $this->load->model('adminModel');
            $user_id = $this->adminModel->register_User($firstname,$lastname,$email,$type,$contact_number,$password,$image_url);

            if($user_id){
                $this->session->set_flashdata('register_success','User Registered Successfully!');
                $this->load->view('userRegistration');
            }else{


                $this->session->set_flashdata('register_failed','Failed to Register User.Try again..');
                $this->load->view('userRegistration');
            }



        }
    }



}
