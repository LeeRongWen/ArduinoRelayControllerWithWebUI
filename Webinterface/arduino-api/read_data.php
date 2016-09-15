<?php
	$xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");
	$d = json_decode(json_encode($xml), TRUE);
	echo "<" . $d['relay1'] . $d['relay2'] . $d['relay3'] . $d['relay4'] . $d['relay5'] . $d['relay6'] . $d['relay7'] . $d['relay8'] . ">";
?>