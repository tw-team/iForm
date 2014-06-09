<?php

require_once '../../application/libraries/quickstart.php';


$cat=$_REQUEST['cate'];

$obj1 = new WindowsAzureCloudProcessing();
$obj1->downloadBlobs($cat);

if(filesize('bigFile.xml') > 0){
echo "<br/>";
$fh = fopen('bigFile.xml','r');
$string = fread($fh,filesize('bigFile.xml'));
fclose($fh);
$path_to_xml_file = str_replace('<?xml version="1.0" encoding="UTF-8"?>'," ",$string);
$path_to_xml_file = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<forms>'.$path_to_xml_file."\n".'</forms>';

$fh = fopen('bigFile.xml', 'w');
fwrite($fh, $path_to_xml_file);
fclose($fh);

$path_to_xml_file = 'bigFile.xml';

			$chars_to_replace = array('[\r]','[\n]','[\t]');
			$xmlstring = trim(preg_replace($chars_to_replace, '', file_get_contents($path_to_xml_file)));

		$xml = new SimpleXMLElement($xmlstring);
		$variabila = $xml->form;
//		echo '<tr>';
//		foreach ($variabila->question as $record) {
//			echo '<th> '.$record. '</th>';
//		}
//		echo '</tr>';
		foreach ($xml->form as $form) {
		echo '<table border="1" style="text-align:center">';
		foreach ($form->question as $record) {
			echo '<tr>';
			$smth = "";
			//foreach($record->answer as $ans){
			if(count($record->answer) > 1) {
				foreach($record->answer as $ans) {
					$smth .= $ans."|";
				}
				$smth = substr($smth, 0, -1);
			}
			else
			{
				$smth = $record->answer;
			}
				echo '<th style="padding:5px">'.$record.'</th>'.'<td style="padding:5px">'. $smth.' </td>';
				echo '</tr>';

		}
		echo '</table><br/>';
	}
//		
}
else
echo "<br/><p class='lead'> No results for this form </p>";

?>
