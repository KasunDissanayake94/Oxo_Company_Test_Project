<?php

class User_model extends CI_Model {
	public function login_user($email, $password){

		$this->db->where('email',$email);
		$this->db->where('password',$password);

		$result = $this->db->get('users');

		if($result->num_rows()==1){
			return $result->row(0)->id;
		}else{
			return false;
		}
	}
	//Get the details of logged user to edit pwn profile
    public function edit_Profile($email){
        $this->db->where('email',$email);
        $this->db->select('id,firstname,lastname,email,type,contact_number,password');
        $user_data = $this->db->get('user_details');
        if($user_data->num_rows() > 0)
        {
            foreach ($user_data->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function edit_User_Final($id,$firstname,$lastname,$email,$type,$contact_number,$password){

        $data = array(
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'email'=>$email,
            'type'=>$type,
            'contact_number'=>$contact_number,
            'password'=>$password,
        );
        $this->db->where('id', $id);
        $this->db->update('user_details', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

}



?>
