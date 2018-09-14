<?php
class User_Search_Model extends CI_Model
{
    function fetch_data($data1,$data2,$data3)
    {

        $this->db->select("*");
        $this->db->from("user_details");

        if ($data1 != '' || $data2 != '' || $data3 != '' ){
            $this->db->like('firstname', $data1);
            $this->db->like('type', $data2);

        }

        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }
}
?>
