<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminController extends CI_Controller {
    public function UserRegistration(){
        $this->load->view('userRegistration');
    }



}
