<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function UserRegistration(){
        $this->load->view('userRegistration');
    }
    public function userView(){
        $this->load->view('viewUser');
    }
    public function userEdit(){
        if($this->input->get()){
            $id = $this->input->get('user_id');
            $this->load->model('adminModel');
            $data['instant_req'] = $this->adminModel->edit_User($id);
            $this->load->view('editUser',$data);


        }

    }
    public  function userDelete(){
        if($this->input->get())
        {
            $id = $this->input->get('user_id');
            $this->load->model('adminModel');
            $this->adminModel->delete_User($id);
            $this->load->view('viewUser');
        }


    }
    public function importUsers(){
        $this->load->view('importUsers');
    }
    public function registerUser(){
        $this->form_validation->set_rules('firstname','First Name','required');
        $this->form_validation->set_rules('lastname','Last Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('type','Type','required');
        $this->form_validation->set_rules('contactnumber','Contact Number','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirmpassword','Confirm Password','required');

        //echo form_open_multipart('upload/do_upload');


        if($this->form_validation->run()== FALSE){
            $this->session->set_flashdata('register_failed','Please fill all the fields');
            $this->load->view('userRegistration');

        }else if ($this->input->post('password') != $this->input->post('confirmpassword')) {
            $this->session->set_flashdata('register_failed','Please add the same password');
            $this->load->view('userRegistration');
        }
        else{
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $type = $this->input->post('type');
            $contact_number = $this->input->post('contactnumber');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $image_url = $this->input->post('imageurl');
            if(!$image_url){
                $image_url = 'user.jpg';
            }

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
    public function editUser(){
        $this->form_validation->set_rules('firstname','First Name','required');
        $this->form_validation->set_rules('lastname','Last Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('type','Type','required');
        $this->form_validation->set_rules('contactnumber','Contact Number','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirmpassword','Confirm Password','required');

        //echo form_open_multipart('upload/do_upload');


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
            $image_url = $this->input->post('imageurl');
            if(!$image_url){
                $image_url = 'user.jpg';
            }

            $this->load->model('adminModel');
            $user_id = $this->adminModel->edit_User_Final($id,$firstname,$lastname,$email,$type,$contact_number,$password,$image_url);

            $this->load->view('viewUser');




        }
    }
    public function fetch()
    {
        $data = $this->excel_import_model->select();
        $output = '
  <h3 align="center">Total Data - '.$data->num_rows().'</h3>
  <table class="table table-striped table-bordered">
   <tr>
    <th>Customer Name</th>
    <th>Address</th>
    <th>City</th>
    <th>Postal Code</th>
    <th>Country</th>
   </tr>
  ';
        foreach($data->result() as $row)
        {
            $output .= '
   <tr>
    <td>'.$row->CustomerName.'</td>
    <td>'.$row->Address.'</td>
    <td>'.$row->City.'</td>
    <td>'.$row->PostalCode.'</td>
    <td>'.$row->Country.'</td>
   </tr>
   ';
        }
        $output .= '</table>';
        echo $output;
    }




}
