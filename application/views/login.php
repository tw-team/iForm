<!Doctype HTML>
<html>
<head>
    <title>iForm</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>
<body style="background: #777777">
<?php
    $this->load->view('navbar');
?>
<div class="container">
    <form class="container span4 offset4 text-center" style="background: #555555;padding: 0px;border-radius:9px" action="<?php echo base_url("user/login");?>" method="post">
        <h1 style="margin: 30px;color: #CCCCCC">Login</h1>
        <input class="span3" type="text" name="Name" style="font-size: 20px; height: 30px; margin: 10px" placeholder="Username">
        <input class="span3" type="password" name="Password" style="font-size: 20px; height: 30px; margin: 10px" placeholder="Password">
        <?php
        if($this->session->userdata('error'))
        {
            echo "<div style='color:red'>".$this->session->userdata('error')."</div>";
            $this->session->unset_userdata('error');
        }
        ?>
        <input class="span2 btn btn-primary" type="submit" style="margin: 40px; background: green" value="Login">
    </form>
    <div class="container span4 offset4 text-center" style="background: #555555; border-radius: 4px;">
        <h4>Did you forgot your password?</h4>
        No problem. Reset it <a href="<?php echo base_url("user/recovery");?>">here</a>
    </div>
</div>
<?php
    $this->load->view('footer');
?>
</body>
</html>