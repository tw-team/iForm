<!Doctype HTML>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style.css" type="text/css" media="screen" />
</head>
<body class='culoareTextAlb ' style="background: #777777">
	<?php $this->load->view('navbar'); ?>
	
	<h1 style="text-align:center;">iForm Documentation</h1>
	<br/>
	<article style="text-align:center; margin:0 auto 0 auto;" class='latimeBodyViewForm'>
		<section id='introduction'>
			<h4> Small description of the iForm project</h4>
			<p>This application is meant to be something like google docs. To acces it you must create an account.</p>
			<p>Each user can create their own custom forms, wich they can share with their friends, in order to fill them in.
On the home page you can view your created forms, also you can view the results of the selected form and delete them. 
			</p>
		</section>
		<section id='login_recovery'>
			<h3>Login</h3>
			<div> <img alt="login_Image" src="<?php echo base_url() ?>assets/images/login.png"></div>
			
			<p>In order to Log on the application, you must create an accout. Here we have captcha validation, to prevent bots from using various types of computing services or collecting certain types of sensitive information.</p>
			<div> <img alt="register_Image" src="<?php echo base_url() ?>assets/images/register.png"></div>
			<p>Another login related functionality is that you can change your password and, in case of emergency, you can recover your password on the registered account e-mail. On the e-mail you will receive a new generated password, wich, after you log on the application, you can change it in whatever password you like. </p>
			<img alt="Email_preview" src="#">
		</section>
		
		<section id='home_overview'>
			<h3>Home page</h3>
			<p>On the home page you can view or delete your created forms and view results for each item.</p>
			<img alt="home_FormsPreview"src="#">
		</section>
		<section id='Create_form'>
			<h3>Create new form.</h3>
			<img alt="CreateForm" src="#">
			<p>As seen in the above image, this is how you can make a new form. User have the possibility to add new questions and attach description for them, in order to suggest how you can answer to that question. For each of them you can choose the answer type from a variety of options, like: textAreas, checkboxes, radio buttons, email fields, number fields, etc..
				<br/>
				A fancy functionality is that you can customize your answer via regular expression (aka. regex). For example, if you use <big style="color:yellow">^[a-z]+$</big> expression, you will validate that field according to it. (You will be allowed to enter only alfanumeric characters. No numbers, no anything else!)
				<img alt="regular_expressionImage" src="#">
				<br/>
				You can preview the form, whenever you want, too know how the end user will see it.
				<br/>
				Also, you can share your form on the social media newtworks, like Facebook, Twitter, etc.</p>
				<img alt="Social_media_Buttons" src="#">

		</section>
		
		<section id='View_form'>
			<h3>Fill in the form</h3>
			<p>Form can be filled in, if you have the direct link or from your "home" page, by pressing the View button.</p>
			<img alt="Main_form" src="#">
		</section>
		<section id='Show_results'>
			<h3>Results</h3>
			<p>In order to see the results of your completed form, press the "View results" button. Below will appear a table with the question answers for that form.</p>
			<img alt="Questions_Answers" src="#">
		</section>
	</article>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.js');?>" charset="utf-8"></script>
</body>