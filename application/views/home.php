<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "4066fcd8-b29e-4a54-9bea-7c5aaa566199",shorten:false});
</script>

<?php
	$user = $this->session->userdata('logged_in');
?>

<!Doctype HTML>
<html>
<head>
<title>iForm</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/toastr.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style.css" type="text/css" media="screen" />



</head>

<body style="background: #777777">
<?php $this->load->view('navbar');?>

<div class="container culoareTextAlb" style="margin-bottom: 150px">
    <h1>My forms</h1>
    <?php
        foreach($this->session->userdata["forms"] as $form)
        {
            echo '<form class="container" action="'.base_url("form_page/show").'">';
            echo '<h2>'.$form->title.'</h2>';
            echo '<input type="hidden" name="token" value="'.$form->token.'">';
			echo  "Created @".date('D,d M Y H:i:s',substr($form->token,20)+3600);
			echo "<br>" ;
            echo '<input type="submit" class="btn btn-success" style="margin: 5px;" value="View">';
            echo '<input type="button" class="btn btn-success" style="margin: 5px;" value="Show Result" onclick="show_results(this)">';
            ///echo '<input type="button" class="btn btn-info" style="margin: 5px;" value="Modify Form" onclick="modify_form(this)">';
            echo '<input type="button" class="btn btn-danger" style="margin: 5px;" value="Delete Form" onclick="delete_form(this)">';
			echo "<br>";
			echo '<span class="st_facebook_large" st_url="www.iform.com/iform/form_page/show?token='.$form->token.'"displayText="Facebook"></span>';
            echo '<span class="st_twitter_large" st_url="www.iform.com/iform/form_page/show?token='.$form->token.'"displayText="Tweet"></span>';
            echo '<span class="st_linkedin_large" st_url="www.iform.com/iform/form_page/show?token='.$form->token.'"displayText="LinkedIn"></span>';
            echo '<span class="st_googleplus_large" st_url="www.iform.com/iform/form_page/show?token='.$form->token.'"displayText="Google +"></span>';
            echo '</form>';
        }
    ?>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/toastr.js');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/form.js');?>" charset="utf-8"></script>
<?php $this->load->view('footer'); ?>

</body>



</html>