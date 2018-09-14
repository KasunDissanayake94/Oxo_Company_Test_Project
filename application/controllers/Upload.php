<?php

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $this->load->view('', array('error' => ' ' ));
    }

    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imageurl'))
        {
            $_SESSION['upload_image'] = false;
            $this->session->set_flashdata('register_failed','Failed to Upload Image...');
            $this->load->view('userRegistration');
        }else{
            $_SESSION['upload_image'] = true;
            $this->session->set_flashdata('register_success','Good');
            $this->load->view('');
        }

    }
}