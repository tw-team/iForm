<?php
if(isset($_POST["B1"]))
{   
	$fulladdr = "assets/xmlFiles/".$_POST["B1"];
    unlink($fulladdr);
	mysql_close();					
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
	$uid = $_POST["B1"];
	$sql = "DELETE FROM forms WHERE formid = '$uid'";
	mysql_query($sql);
	
	redirect(base_url("home"));
}
?>