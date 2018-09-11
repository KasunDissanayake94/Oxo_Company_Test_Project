<!--Header Start-->
<?php
$this->load->view('header');
?>
<!--Header End-->


<body id="page-top">

<!--Nav Bar Start-->
<?php
$this->load->view('navbar');
?>
<!--Nav Bar End-->

<div id="wrapper">
    <!--Side Bar Start-->
    <?php
    $this->load->view('sidebar');
    ?>
    <!--Side Bar End-->

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">User Registration</li>
            </ol>



            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    User Registration Form</div>
                <div class="card-body">
                    <?php $attribute= array('id'=>'login_form', 'class'=>'form_horizontal');?>


                    <?php echo form_open('users/register',$attribute); ?>
                    <div class="form-group">
                        <?php echo form_label('First Name'); ?>
                        <?php
                        $data = array(
                            'class' =>'form-control',
                            'name' =>'firstname',
                            'placeholder' =>'Enter Your First Name here',
                        );
                        ?>
                        <?php echo form_input($data); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Last Name'); ?>
                        <?php
                        $data = array(
                            'class' =>'form-control',
                            'name' =>'lastname',
                            'placeholder' =>'Enter your Last Name here',
                        );
                        ?>
                        <?php echo form_input($data); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Email'); ?>
                        <?php
                        $data = array(
                            'class' =>'form-control',
                            'name' =>'email',
                            'placeholder' =>'Enter your Email here',
                            'type' => 'email'
                        );
                        ?>
                        <?php echo form_input($data); ?>
                    </div>



                    <div class="form-group">
                        <?php echo form_label('Password'); ?>
                        <?php
                        $data = array(
                            'class' =>'form-control',
                            'name' =>'password',
                            'placeholder' =>'Enter your Password here',
                            'type'=>'password'
                        );
                        ?>
                        <?php echo form_input($data); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Confirm Password'); ?>
                        <?php
                        $data = array(
                            'class' =>'form-control',
                            'name' =>'confirmpassword',
                            'placeholder' =>'ReEnter your Password here',
                            'type'=>'password'
                        );
                        ?>
                        <?php echo form_input($data); ?>
                    </div>



                    <div class="form-group">

                        <?php
                        $data = array(
                            'class' =>'btn btn-primary',
                            'name' =>'submit',
                            'value' =>'Register'

                        );
                        ?>
                        <?php echo form_submit($data); ?>
                    </div>



                    <?php	echo form_close(); ?>
                </div>
            </div>



        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer Start-->
        <?php
        $this->load->view('footer');
        ?>
        <!--Sticky Footer Ens-->

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url();?>users/logout"><?php if($this->session->userdata('logged_in')):?>Logout<?php endif;?></a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url();?>assets/assets1/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url();?>assets/assets1/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url();?>assets/assets1/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/assets1/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/assets1/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url();?>assets/assets1/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="<?php echo base_url();?>assets/assets1/js/demo/datatables-demo.js"></script>
<script src="<?php echo base_url();?>assets/assets1/js/demo/chart-area-demo.js"></script>

</body>

</html>




