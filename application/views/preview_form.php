<!Doctype HTML>
<html>
<head>
    <title>iForm</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>
<body style="background: #777777; color: white">
<div class="container" id="content">

</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/form.js');?>" charset="utf-8"></script>
<script>
    window.form=<?php echo $this->session->userdata('form')?>;
    $(populate_form());
</script>
</body>
</html>