<!Doctype HTML>
<html>
<head>
    <title>iForm</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/toastr.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
     <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>
<body class="culoareTextAlb " style="background: #777777">
<div class="container latimeBodyViewForm" id="content">
</div>
<input type="hidden" id="token" value="<?php echo $this->session->userdata('token')?>">
<div class="container latimeBodyViewForm">
<input type="button" class="btn btn-success " value="Send" onclick="answer_send()">
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/toastr.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/form.js');?>" charset="utf-8"></script>
<script>
    window.form=<?php echo $this->session->userdata('form')?>;
    $(populate_form());
</script>
</body>
</html><?php