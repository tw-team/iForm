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
    <form class="container span4 offset4 text-center" style="background: #555555;padding: 0px;border-radius:9px" action="<?php echo base_url("user/change_password");?>" method="post">
        <h2 style="margin: 30px;color: #CCCCCC">Change password</h2>

        <input class="span3" type="password" name="cur_pw" style="font-size: 20px; height: 30px; margin: 10px" placeholder="Current Password">
        <?php echo form_error('cur_pw',"<div style='color:red'>", "</div>"); ?>

        <input class="span3" type="password" name="new_pw" style="font-size: 20px; height: 30px; margin: 10px" placeholder="New Password">
        <?php echo form_error('new_pw',"<div style='color:red'>", "</div>"); ?>

        <input class="span3" type="password" name="conf_pw" style="font-size: 20px; height: 30px; margin: 10px" placeholder="Confirm Password">
        <?php echo form_error('conf_pw',"<div style='color:red'>", "</div>"); ?>

        <input class="span2 btn btn-primary" type="submit" style="margin: 40px; background: green" value="Login">
    </form>
</div>
<?php $this->load->view('footer');?>
</body>
</html>