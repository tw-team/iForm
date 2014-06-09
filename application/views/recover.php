<html>
<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
</head>
<body style="background: #777777">
<?php $this->load->view('navbar');?>
<div class="container">
    <form class="container span4 offset4 text-center" style="background: #555555;padding: 0px;border-radius:9px" action='<?php echo base_url("user/recovery"); ?>' method="POST">
        <h1 style="margin: 30px;color: #CCCCCC">Recovery</h1>
        <input placeholder="Your name" style="font-size: 20px; height: 30px; margin: 10px" autofocus="autofocus" type="text" name="Name">
        <input placeholder="Your Email" style="font-size: 20px; height: 30px; margin: 10px" type="text" name="Email"><br/>
        <input  class="btn btn-success" style="margin: 40px; background: green" type="submit" name="submit" value="Recover!">
    </form>
</div>


<?php $this->load->view('footer'); ?>
</body>
</html>