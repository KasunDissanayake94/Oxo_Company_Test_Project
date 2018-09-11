<?php

class AdminModel extends CI_Model {
    public function register_User($firstname,$lastname,$email,$type,$contact_number,$password,$image_url){

        $data = array(
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'email'=>$email,
            'type'=>$type,
            'contact_number'=>$contact_number,
            'password'=>$password,
            'image_url'=>$image_url
        );

        $this->db->insert('user_details',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

}



?>
