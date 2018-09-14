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
    public function delete_User($user_id){

        $this->db->where('id', $user_id);
        $this->db->delete('user_details');
        return;
    }
    public function edit_User($user_id){
        $this->db->where('id', $user_id);
        $this->db->select('id,firstname,lastname,email,type,contact_number,password');
        $user_data = $this->db->get('user_details');
        if($user_data->num_rows() > 0)
        {
            // we will store the results in the form of class methods by using $q->result()
            // if you want to store them as an array you can use $q->result_array()
            foreach ($user_data->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function edit_User_Final($id,$firstname,$lastname,$email,$type,$contact_number,$password,$image_url){

        $data = array(
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'email'=>$email,
            'type'=>$type,
            'contact_number'=>$contact_number,
            'password'=>$password,
            'image_url'=>$image_url
        );
        $this->db->where('id', $id);
        $this->db->update('user_details', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }


}



?>
