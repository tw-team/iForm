<!Doctype HTML>
<html>
<head>
<title>iForm</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/toastr.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
</head>
<body style="padding-bottom: 100px;background: #777777">

<?php 
    $this->load->view('navbar');
    $this->load->view('new_form');
    $this->load->view('footer');
?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/toastr.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/form.js');?>" charset="utf-8"></script>
</body>
</html>



