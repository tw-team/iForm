<!Doctype HTML>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
</head>
<body style="background: #777777">

<?php $this->load->view('navbar'); ?>

<div class="container">

    <form method="POST" class="container span4 offset4 text-center" action="<?php echo base_url("user/register"); ?>" style="background: #555555;padding: 0px;border-radius:9px">
        <h1 style="margin: 30px;color: #CCCCCC">Register</h1>
        <input class="span3" type="text" name="Name" style="font-size: 20px; height: 30px; margin: 10px" value="<?php echo set_value('Name'); ?>" placeholder="Username">
        <?php echo form_error('Name',"<div style='color:red'>", "</div>"); ?>

        <input class="span3" type="password" style="font-size: 20px; height: 30px; margin: 10px" name="Password" placeholder="Password">
        <?php echo form_error('Password',"<div style='color:red'>", "</div>"); ?>

        <input class="span3" type="text" name="Email" style="font-size: 20px; height: 30px; margin: 10px" value="<?php echo set_value('Email'); ?>" placeholder="E-mail">
        <?php echo form_error('Email',"<div style='color:red'>", "</div>"); ?>

        <img alt="captcha" src="<?php echo base_url("user/captcha") . '/' . rand();?>" style="margin: 10px"/>

        <input class="span3" type="text" name="captcha" style="font-size: 20px; height: 30px; margin: 10px" value="<?php echo set_value('captcha'); ?>" placeholder="Captcha">
        <?php echo form_error('captcha',"<div style='color:red'>", "</div>"); ?>

        <input class="btn btn-success" style="margin: 10px" value="Register me!" type="submit">

    </form>
</div>


<?php $this->load->view('footer');?>
</body>
</html>