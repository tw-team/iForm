<?php

$fh = fopen($_POST['Ftitle'].'.php','r') or die($php_errormsg);
$string = fread($fh,filesize($_POST['Ftitle'].'.php'));
$nr = substr_count( $string, '</p>' );


echo '<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../js/validate.js" charset="utf-8"></script> 




</head>
<body class="bodyline">


<div id="content" style="display: none">
	
		<fieldset id = "f" class = "clonable">
			<p ID = "a">
				<label for="qtitle" class="block">Question Title:</label>
				<input type="text" name="qtitle[]" id="qtitle" placeholder="Enter question title " style="width: 400px; height: 20px;" />
			</p>
			<p ID = "b">
				<label for="qhelp" class="block">Help text:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input type="text" name="qhelp[]" id="qhelp" placeholder="Enter help text " style="width: 400px; height: 20px;" />
			</p>
			
			<p ID = "c">
				<select name = "mylist[]" id="mylist" onchange="chkind(this.value,this.id)">
				<!--	<option selected="selected"> </option>-->
					<option selected="selected" name="one" value="checkbox">Multiple choice</option>
					<option name="two" value="radio"> Radio box</option>
					<option name="three" value="text">Text Area</option>
					</select> 
					
			</p>
			<p ID = "d">
				Select your text field type:<select name = "type[]" id="type" onchange="chvalid(this.value,this.id)">
					<option name="four" value="text" selected="selected">Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url">URL</option>					
					<option name="five" value="regex">Regex</option>
					</select> 
			</p>
			<p ID = "e">
				Enter regex:<input type = "text" name = "regex[]" id = "regex">
			</p>
			<div ID = "button">
				<p ID = "addbut" ondrop="drop(event)" ondragover="allowDrop(event)" >
					<button class="btn btn-info" type="button" id = "addbutton" onclick="addAnswer(this.parentNode.parentNode.id)">Add field</button>
				<!--	<input type = "text" name = "answer[]" id = "ans">

					<button type="button" id = "deletebutton" onclick="deleteAnswer(this.id)">-</button> -->
				</p>
			</div>
		
		<br /><input class ="btn btn-danger" type="button" value="Delete question" onclick="deleteQuestion(this.parentNode.parentNode.id)" /><br />
<br />		</fieldset>
		
</div>


<form id="jform" action="anotherhtml2html.php" method="post" enctype="multipart/form-data">
<div id = "title" >
	<input type = "hidden" name="formtitle" id = "formtitle" value = "'.$_POST['Ftitlu'].'"/>
	<input type = "hidden" name="formname" id = "formname" value = "'.$_POST['Ftitle'].'"/>
	<h2 id = "t1">'; echo $_POST['Ftitlu'].'</h2>
</div>
<div id = "title1" >
	<input type = "hidden" name="formdesc" id = "formdesc" value = "'.$_POST['Fdesc'].'"/>
	<h4 id = "t2">'; echo $_POST['Fdesc'] .'</h4>
</div>';

$answers = 1;
for($i = 0; $i < $nr; $i++){
	$question = $_POST['Qnume'.($i)];
	$helptext = $_POST['Hnume'.($i)];
	$answertype = $_POST['Onume'.($i)];

	echo'<div id="content'.($i + 1).'" style="display: block;">
	
		<fieldset id = "f'.($i + 1).'" class = "clonable">
			
			<p ID = "a'.($i + 1).'">
				<label for="qtitle" class="block">Question Title:</label>
				<input type="text" name="qtitle[]" id="qtitle'.($i + 1).'" placeholder="Enter question title " style="width: 400px; height: 20px;" value = "'.$question.'" />
			</p>
			<p ID = "b'.($i + 1).'">
				<label for="qhelp" class="block">Help text:</label>
				<input type="text" name="qhelp[]" id="qhelp'.($i + 1).'" placeholder="Enter help text " style="width: 400px; height: 20px;" value = "'.$helptext.'"/>
			</p>
		
			
			';
	
	echo '<p ID = "c'.($i + 1).'">
			<select name = "mylist[]" id="mylist'.($i + 1).'" onchange="chkind(this.value,this.id)">';
	
	if($answertype == 'text'){
		echo' 
			<option  name="one" value="checkbox">Multiple choice</option>
			<option name="two" value="radio"> Radio box</option>
			<option name="three" value="text" selected="selected" >Text Area</option>
			</select> 					
			</p>
			<p ID = "d'.($i + 1).'">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">';
		
		$validate = $_POST['Tnume'.$i];
		echo '<p> ' . $validate. '</p>';
		
		if($validate == 'regex')					
			echo'	<option name="four" value="text" >Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url">URL</option>					
					<option name="five" value="regex"selected="selected">Regex</option>
					</select> 
			</p>
			<p ID = "e'.($i + 1).'">
				Enter regex:<input type = "text" name = "regex[]" id = "regex'.($i + 1).'" value = "'.$_POST['TRnume'.$i].'">
			</p>';
		if($validate == 'text')					
			echo'	<option name="four" value="text" selected="selected">Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url">URL</option>					
					<option name="five" value="regex">Regex</option>
					</select> 
			</p>

			<p ID = "d'.($i + 1).'" style="display: none">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">
			</p>';
		if($validate == 'email')					
			echo'	<option name="four" value="text" >Text</option>
					<option name="one" value="email" selected="selected">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url">URL</option>					
					<option name="five" value="regex">Regex</option>
					</select> 
			</p>
			<p ID = "d'.($i + 1).'" style="display: none">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">
			</p>';
		if($validate == 'url')					
			echo'	<option name="four" value="text" >Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url" selected="selected">URL</option>					
					<option name="five" value="regex">Regex</option>
					</select> 
			</p>
						<p ID = "d'.($i + 1).'" style="display: none">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">
			</p>';
			if($validate == 'number')					
			echo'	<option name="four" value="text" >Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number" selected="selected"> Number</option>
					<option name="three" value="url" >URL</option>					
					<option name="five" value="regex">Regex</option>
					</select> 
			</p>
						<p ID = "d'.($i + 1).'" style="display: none">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">
			</p>';
	}
	if($answertype == 'checkbox'){
		echo' 
			<option selected="selected" name="one" value="checkbox">Multiple choice</option>
			<option name="two" value="radio"> Radio box</option>
			<option name="three" value="text">Text Area</option>
			</select> 
			</p>

			<p ID = "d'.($i + 1).'" style="display: none">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">
				<option name="four" value="text" >Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url">URL</option>					
					<option name="five" value="regex"selected="selected">Regex</option>
					</select> 
			</p>
			<p ID = "e'.($i + 1).'" style="display: none">
				Enter regex:<input type = "text" name = "regex[]" id = "regex'.($i + 1).'" value = "'.$_POST['TRnume'.$i].'">
			</p>
			<div ID = "button'.($i + 1).'">
				<p ID = "addbut'.($i + 1).'" ondrop="drop(event)" ondragover="allowDrop(event)" >
					<button class="btn btn-info" type="button" id = "addbutton" onclick="addAnswer(this.parentNode.parentNode.id)">Add field</button>';
			$anscontent = $_POST['Anume'.($i)];
			for($j = 0; $j < count($anscontent); $j++){
				echo '<p ID = "sbut' . $answers . '" class ="answer">
				<input type = "text" name = "answer' . ($i + 1) .'[]" id = "answer' . $answers. '" value = "'.$anscontent[$j].'">
				<button type="button" id = "deletebutton' . $answers. '" onclick="deleteAnswer(this.parentNode.id)">-</button></p>';
				$answers++;
			} 	
			echo '</div>';
				
	}
	if($answertype == 'radio'){
		echo' 
			<option  name="one" value="checkbox">Multiple choice</option>
			<option selected="selected" name="two" value="radio"> Radio box</option>
			<option name="three" value="text">Text Area</option>
			</select> 
			</p>

			<p ID = "d'.($i + 1).'" style="display: none">
				Select your text field type:<select name = "type[]" id="type'.($i + 1).'" onchange="chvalid(this.value,this.id)">
				<option name="four" value="text" >Text</option>
					<option name="one" value="email">Email</option>
					<option name="two" value="number"> Number</option>
					<option name="three" value="url">URL</option>					
					<option name="five" value="regex"selected="selected">Regex</option>
					</select> 
			</p>
			<p ID = "e'.($i + 1).'" style="display: none">
				Enter regex:<input type = "text" name = "regex[]" id = "regex'.($i + 1).'" value = "'.$_POST['TRnume'.$i].'">
			</p>
			<div ID = "button'.($i + 1).'">
				<p ID = "addbut'.($i + 1).'" ondrop="drop(event)" ondragover="allowDrop(event)" >
					<button class="btn btn-info" type="button" id = "addbutton'.($i + 1).'" onclick="addAnswer(this.parentNode.parentNode.id)">Add field</button></p>';
			$anscontent = $_POST['Anume'.($i)];
			for($j = 0; $j < count($anscontent); $j++){
				echo '<p ID = "sbut' . $answers . '" class ="answer">
				<input type = "text" name = "answer' . ($i + 1) .'[]" id = "answer' . $answers. '" value = "'.$anscontent[$j].'">
				<button type="button" id = "deletebutton' . $answers. '" onclick="deleteAnswer(this.parentNode.id)">-</button></p>';
				$answers++;
			} 
			echo '</div>';

	}
	echo ' <input class ="btn btn-danger" type="button" id = "deleteQuest" value="Delete question" onclick="deleteQuestion(this.parentNode.parentNode.id)" /><br /><br />';		
		echo '
			</fieldset>
		</div>';
}


echo'<span id="writeroot"></span>
	
	<input class="btn btn-warning" type="button" onclick="moreFields()" value="Add new question" />
	<input class="btn btn-success" type="submit" value="Save form" /><br/><br/>
	
</form>
</body>
</html>
';


?>