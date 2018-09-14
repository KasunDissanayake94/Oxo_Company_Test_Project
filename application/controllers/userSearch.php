<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSearch extends CI_Controller {

    function index()
    {
        $this->load->view('viewUser');
    }

    function fetch()
    {
        $output = '';
        $data = '';
        $data1 = '';
        $data2 = '';
        $data3 = '';

        $this->load->model('user_search_model');
        if(true)
        {
            $data1 = $this->input->post('data1');
            $data2 = $this->input->post('data2');
            $data3 = $this->input->post('data3');
        }
        $data = $this->user_search_model->fetch_data($data1,$data2,$data3);
        $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <tr>
       <th>First Name</th>
       <th>Last Name</th>
       <th>Email</th>
       <th>Type</th>
       <th>Contact Number</th>
       <th>Edit User</th>
       <th>Delete User</th>
      </tr>
  ';
        if($data->num_rows() > 0)
        {
            foreach($data->result() as $row)
            {
                $output .= '
      <tr>
       <td>'.$row->firstname.'</td>
       <td>'.$row->lastname.'</td>
       <td>'.$row->email.'</td>
       <td>'.$row->type.'</td>
       <td>'.$row->contact_number.'</td>
       
       <td><p><a href="'.base_url().'index.php/adminController/userEdit?user_id='.$row->id.'"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><i class="fas fa-edit"></i>
</button></p></td></a>
    <td><p><a class="dropdown-item" href="#" data-toggle="modal" data-target="#d'.$row->id.'"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><i class="fas fa-trash-alt"></i>
</button></p></td></a>
      </tr>
      
      
      <!-- Delete Modal-->
<div class="modal fade" id="d'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to Delete this User??</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="'.base_url().'index.php/adminController/userDelete?user_id='.$row->id.'">Delete<?php endif;?></a>
            </div>
        </div>
    </div>
</div>
    ';
            }
        }
        else
        {
            $output .= '<tr>
       <td colspan="5">No Data Found</td>
      </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

}
