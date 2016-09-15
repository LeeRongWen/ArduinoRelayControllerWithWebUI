<?php
	$relay = $_POST['relay'];
	$state = $_POST['state'];
	
	//$relay = 1;
	//$state = 1;
	
	if($relay == 1){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay1 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 2){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay2 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 3){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay3 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 4){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay4 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 5){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay5 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 6){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay6 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 7){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay7 = $state;
		$lampu->asXML('data.xml');
	}elseif($relay == 8){
		$lampu = simplexml_load_file('data.xml');
		$lampu->relay8 = $state;
		$lampu->asXML('data.xml');
	}
?>