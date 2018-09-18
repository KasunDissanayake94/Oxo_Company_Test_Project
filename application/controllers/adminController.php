<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('adminModel');
        $this->load->library('excel');
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
    //Schools Allocation of Admin
    public function allocateSchools(){
        $this->load->view('allocateSchools');
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
    //Upload Image

    public function uploadData(){

        if ($this->input->post('submit')) {

            $path = 'uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if(empty($error)){
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                        if($flag){
                            $flag =false;
                            continue;
                        }
                        $inserdata[$i]['org_name'] = $value['A'];
                        $inserdata[$i]['org_code'] = $value['B'];
                        $inserdata[$i]['gst_no'] = $value['C'];
                        $inserdata[$i]['org_type'] = $value['D'];
                        $inserdata[$i]['Address'] = $value['E'];
                        $i++;
                    }
                    $result = $this->import->importdata($inserdata);
                    if($result){
                        echo "Imported successfully";
                    }else{
                        echo "ERROR !";
                    }

                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' .$e->getMessage());
                }
            }else{
                echo $error['error'];
            }


        }
        $this->load->view('upload');
    }

    //Excel Import
    public function fetch()
    {
        $data = $this->adminModel->select();
        $output = '
  <h3 align="center">Total Users - '.$data->num_rows().'</h3>
  <table class="table table-striped table-bordered">
   <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Type</th>
    <th>Contact Number</th>
   </tr>
  ';
        foreach($data->result() as $row)
        {
            $output .= '
   <tr>
    <td>'.$row->firstname.'</td>
    <td>'.$row->lastname.'</td>
    <td>'.$row->email.'</td>
    <td>'.$row->type.'</td>
    <td>'.$row->contact_number.'</td>
   </tr>
   ';
        }
        $output .= '</table>';
        echo $output;
    }

    public function import()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $firstname = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $lastname = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $type = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $contact_number = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $data[] = array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'type' => $type,
                        'contact_number' => $contact_number
                    );
                }
            }
            $this->adminModel->insert($data);
            echo 'Data Imported successfully';
        }
    }










    }
