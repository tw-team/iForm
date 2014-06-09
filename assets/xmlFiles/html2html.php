<?php

require_once '../../application/libraries/quickstart.php';

$myFile =strtolower(uniqid()).".php";

$dbh = "localhost";
$dbn = "iform";
$dbu = "root";
$dbp = "";

$connect = mysql_connect($dbh, $dbu, $dbp);
if(!$connect) {
	die("A crapat!".mysql_error());
}

if(!mysql_select_db($dbn, $connect)){
	die("A crapat din alt motiv!".mysql_error());
}
$user = $_POST['username'];
$formtitle = $_POST['formtitle'];
$sql = "INSERT INTO FORMS (USER, FORMID, FORMTITLE) VALUES ('$user', '$myFile', '$formtitle')";
mysql_query($sql);

mysql_close();

$obj1 = new WindowsAzureCloudProcessing();
$obj1->containerCreator(strtolower(str_replace(".php", "", $myFile)));
$fh = fopen($myFile, 'w');

fwrite($fh, "<?php session_start(); ?>");
fwrite($fh,"<!DOCTYPE HTML>\n <head>\n <title>".$_POST['formtitle']."</title>\n

<script type=\"text/javascript\" src=\"http://w.sharethis.com/button/buttons.js\"></script>

<script type=\"text/javascript\">stLight.options({publisher: \"4066fcd8-b29e-4a54-9bea-7c5aaa566199\", doNotHash: true, doNotCopy: false, hashAddressBar: false});

</script>\n");
fwrite($fh,"<link rel=\"stylesheet\" href=\"../bootstrap/css/bootstrap.css\" type=\"text/css\" media=\"screen\" />\n
<link rel=\"stylesheet\" href=\"../bootstrap/css/bootstrap-responsive.css\" type=\"text/css\" media=\"screen\" />

</head>\n<body style='margin-left:43%;'>");

$question = $_POST['qtitle'];
$qhelp = $_POST['qhelp'];
$option = $_POST['mylist'];
$validate = $_POST['type'];
$regex = $_POST['regex'];

fwrite($fh, "<h1>".$_POST['formtitle']."</h1>");
fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."title"."\""."value =" ."\"". $_POST['formtitle']."\""."/>\n");




fwrite($fh,"<form id="."\""."jform"."\""." action="."\""."html2xml.php"."\""." method="."\""."post"."\""." enctype="."\""."multipart/form-data"."\"".">\n<div id ="."\""."startdiv"."\"".">\n");
fwrite($fh, "<fieldset id = "."\""."init"."\"". ">\n<legend>".$_POST['formdesc'] ."</legend>");

fwrite($fh,'<input type = "hidden" name = "title" value = "'.strtolower(str_replace(".php", "", $myFile)). '"/>');
fwrite($fh,'<input type = "hidden" name = "desc" value = "'.$_POST['formdesc'] .'"/>');

for($i = 0; $i < count($question); $i++){


	fwrite($fh, "<p ID ="."\"". $i."\"".">\n"."<label style='' font-size:16px;' for="."\"".$i."\""." class="."\""."block"."\"".">"."<b>".$question[$i]."</b>"."</label>"  );
	fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."question".$i."\""."value =" ."\"". $question[$i]."\""."/>\n");

	fwrite($fh, "<label for="."\"".$i."\""." class="."\""."block"."\""."><u>Help text</u>&nbsp;&nbsp;".$qhelp[$i]."</label>"  );
	fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."helptext".$i."\""."value =" ."\"". $qhelp[$i]."\""."/>\n");

	if($option[$i] == 'text' && $validate[$i] == 'regex')
		fwrite($fh, "<input name=" ."\""."input".$i."[]"."\""."id=" ."\""."input".$i."\""."pattern = "."\"".$regex[$i]."\""." required />\n");


	else if($option[$i] == 'text' && $validate[$i] != 'regex'){
		
		if($validate[$i] == 'number')
			fwrite($fh, "<input  name=" ."\""."input".$i."[]"."\""."id=" ."\""."input".$i."\""."pattern= \"[0-9]+\" required />\n");
		else
			fwrite($fh, "<input type="."\"".$validate[$i] ."\""." name=" ."\""."input".$i."[]"."\""."id=" ."\""."input".$i."\""." required />\n");
	}
	else{
		$multipleAnswers = $_POST['answer'.($i + 1)];
			echo count($multipleAnswers);
			for($j = 0; $j < count($multipleAnswers); $j++){
				fwrite($fh, "<input type="."\"".$option[$i] ."\""." name=" ."\""."input".$i."[]"."\""."id=" ."\""."input".$i."\""." value = "."\"".$multipleAnswers[$j]."\""."/>&nbsp;&nbsp;&nbsp;".$multipleAnswers[$j]."\n");
		}
	}
	fwrite($fh,"</p>\n");
	fwrite($fh,"<br/>");
}
fwrite($fh,"
<span><b>Share your form on Social Networks!</b></span>
	</fieldset> \n 
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_googleplus_large' displayText='Google +'></span>
<span class='st_reddit_large' displayText='Reddit'></span><br/>"); 

fwrite($fh,"<input class='btn btn-success' type=" ."\""."submit"."\""." value="."\""."Send form"."\""." />\n</div>\n</form>");

fwrite($fh,"<form id="."\""."jform2"."\""." action="."\""."edit.php"."\""." method="."\""."post"."\""." enctype="."\""."multipart/form-data"."\"".">\n<div id ="."\""."startdiv2"."\"".">\n");
fwrite($fh,'<input type = "hidden" name = "Ftitle" value = "'.strtolower(str_replace(".php", "", $myFile)). '"/>');
fwrite($fh,'<input type = "hidden" name = "Ftitlu" value = "'.$_POST['formtitle']. '"/>');
fwrite($fh,'<input type = "hidden" name = "Fdesc" value = "'.$_POST['formdesc'] .'"/>');

for($i = 0; $i < count($question); $i++){
	fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."Qnume".$i."\""."value =" ."\"". $question[$i]."\""."/>\n");
	fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."Hnume".$i."\""."value =" ."\"". $qhelp[$i]."\""."/>\n");
	fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."Onume".$i."\""."value =" ."\"". $option[$i]."\""."/>\n");

	if($option[$i] == 'text'){
		fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."Tnume".$i."\""."value =" ."\"". $validate[$i]."\""."/>\n");
		if($validate[$i] == 'regex')
			fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."TRnume".$i."\""."value =" ."\"". $regex[$i]."\""."/>\n");
	}
	else{
		$multipleAnswers = $_POST['answer'.($i + 1)];
			for($j = 0; $j < count($multipleAnswers); $j++){
				fwrite($fh, "<input type="."\""."hidden" ."\""." name=" ."\""."Anume".$i."[]\""."value =" ."\"". $multipleAnswers[$j]."\""."/>\n");
			//	fwrite($fh, "<input type="."\"".$option[$i] ."\""." name=" ."\""."input".$i."[]"."\""."id=" ."\""."input".$i."\""." value = "."\"".$multipleAnswers[$j]."\""."/>".$multipleAnswers[$j]."\n");
		}
	}
	
}

fwrite($fh, "<?php ".'if ($_SESSION[\'login\'] == 123) echo \'<input style="margin-left:100px; margin-top:-94px;" class="btn btn-primary" type="submit" value="Edit form" />\'; ?>'."</div></form>\n\n");


fwrite($fh,"\n</body>\n</html>");
fclose($fh);
header("Location: ../../home/index"); /* Redirect browser */
exit();

?>