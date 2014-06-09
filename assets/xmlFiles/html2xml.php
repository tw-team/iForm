<?php

require_once '../../application/libraries/quickstart.php';

$writer = new XMLWriter();
$name = time();
$writer->openURI($name.'.xml');
$writer->startDocument("1.0","UTF-8");
$writer->startElement("form");
$writer->writeRaw("\n");

echo $_POST['title'];
$fh = fopen($_POST['title'].'.php','r') or die($php_errormsg);
$string = fread($fh,filesize($_POST['title'].'.php'));
$nr = substr_count( $string, '</p>' );

	for($i = 0; $i < $nr; $i++){
		$input = $_POST['input'.($i)];
		$label = $_POST['question'.($i)];
		$writer->startElement("question"/*. $input[$i]*/);
		$writer->writeRaw($label."\n");

		for($j = 0; $j < count($input); $j++){
			$writer->startElement("answer");
			$writer->writeRaw($input[$j]."\n");
			$writer->endElement();
		}

		$writer->endElement();

	}

$writer->endElement();
$writer->endDocument();
$writer->flush();

$obj1 = new WindowsAzureCloudProcessing();
$obj1->containerCreator($_POST['title']);
$obj1->uploadFile($_POST['title'], "../../assets/xmlFiles/".$name.".xml", $name);

//$obj1->downloadBlobs();

header("Location: ../../home/index");

exit();



?>