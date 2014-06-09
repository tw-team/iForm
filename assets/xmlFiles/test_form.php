<?php
// verificam daca au fost primite datele din formular
if (isset($_POST['nume'])) 
{
	$path_to_xml_file = $_POST['nume'];	
	//luam numele din formular
//	echo '<p>'.$path_to_xml_file . '</p>';
	// Daca au fost completate campurile din formular
	// Verificam daca nr de caractere introduse e mai mare ca zero
	if (strlen($path_to_xml_file)>0) 
	{
		if (!file_exists($path_to_xml_file)){
			return;
		}else{

		echo '<table border="1">';
			$chars_to_replace = array('[\r]','[\n]','[\t]');
			$xmlstring = trim(preg_replace($chars_to_replace, '', file_get_contents($path_to_xml_file)));
		}
		$xml = new SimpleXMLElement($xmlstring);
		foreach ($xml->question as $record) {
			echo '<tr>';
			echo '<td> Question is:'. $record.' and answer(s) <td> '; 
			foreach($record->answer as $ans){
				echo '<td>'. $ans.' <td>';
				
			}
			echo '</tr>';
			
				
		}

	
	
		
	
	
	
		//afisam datele din formular
	//	echo '<br /><hr />Personajul <b>'. $path_to_xml_file. '</b><br />are o vorba pentru tine:   "<i>'.'</i>"';
    	}
    	else 
	{
		//in caz contrar afisam un mesaj
		echo 'Selectati butonul pentru incarcare.';
    }
}
?> 