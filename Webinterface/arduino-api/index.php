<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Automation By William</title>
	<link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>
		$(function(){
			$('#myform :checkbox').on('change', function () {
				var name = $(this).attr("name");
				var state = this.checked ? '1' : '0';
				
				$.post("update_data.php", {
					"relay": name,
					"state": state
				});
			});
		});
	</script>
</head>
<body>
		<div data-url="panel-fixed-page1" data-role="page" class="jqm-demos" id="panel-fixed-page1" data-title="Panel fixed positioning">
		<div data-role="header" data-position="fixed">
			<h1>Home Automation</h1>
			<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
			<a href="#add-form" data-icon="gear" data-iconpos="notext">Add</a>
		</div><!-- /header -->
		<div role="main" class="ui-content jqm-content jqm-fullwidth">
			<h1>Kendali Lampu 8 CH</h1>
			<form id="myform">
				<?php
					$xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");
					$d = json_decode(json_encode($xml), TRUE);
					
					foreach ($d as $key => $value) {
						$name = substr($key, -1);
						if($value == 1){
							echo 'Lampu ' . $name . ' : <input data-role="flipswitch" name="' . $name . '" id="flip-checkbox" checked="" type="checkbox"><br />';
						}else{
							echo 'Lampu ' . $name . ' : <input data-role="flipswitch" name="' . $name . '" id="flip-checkbox" type="checkbox"><br />';
						}
					}
				?>
			</form>
		</div><!-- /content -->
		<div data-role="footer" data-position="fixed">
			<h4>Fixed footer</h4>
		</div><!-- /footer -->
		
		<div data-role="panel" data-position-fixed="true" data-display="push" data-theme="b" id="nav-panel">
			<ul data-role="listview">
				<li data-icon="delete"><a href="#" data-rel="close">Close menu</a></li>
					<li><a href="#panel-fixed-page2">Accordion</a></li>
					<li><a href="#panel-fixed-page2">Ajax Navigation</a></li>
					<li><a href="#panel-fixed-page2">Autocomplete</a></li>
					<li><a href="#panel-fixed-page2">Buttons</a></li>
					<li><a href="#panel-fixed-page2">Checkboxes</a></li>
					<li><a href="#panel-fixed-page2">Collapsibles</a></li>
					<li><a href="#panel-fixed-page2">Controlgroup</a></li>
					<li><a href="#panel-fixed-page2">Dialogs</a></li>
					<li><a href="#panel-fixed-page2">Fixed toolbars</a></li>
					<li><a href="#panel-fixed-page2">Flip switch toggle</a></li>
					<li><a href="#panel-fixed-page2">Footer toolbar</a></li>
					<li><a href="#panel-fixed-page2">Form elements</a></li>
					<li><a href="#panel-fixed-page2">Grids</a></li>
					<li><a href="#panel-fixed-page2">Header toolbar</a></li>
					<li><a href="#panel-fixed-page2">Icons</a></li>
					<li><a href="#panel-fixed-page2">Links</a></li>
					<li><a href="#panel-fixed-page2">Listviews</a></li>
					<li><a href="#panel-fixed-page2">Loader overlay</a></li>
					<li><a href="#panel-fixed-page2">Navbar</a></li>
					<li><a href="#panel-fixed-page2">Navbar, persistent</a></li>
					<li><a href="#panel-fixed-page2">Pages</a></li>
					<li><a href="#panel-fixed-page2">New</a></li>
					<li><a href="#panel-fixed-page2">Popup</a></li>
					<li><a href="#panel-fixed-page2">Radio buttons</a></li>
					<li><a href="#panel-fixed-page2">Select</a></li>
					<li><a href="#panel-fixed-page2">Slider, single</a></li>
					<li><a href="#panel-fixed-page2">New</a></li>
					<li><a href="#panel-fixed-page2">New</a></li>
					<li><a href="#panel-fixed-page2">New</a></li>
					<li><a href="#panel-fixed-page2">Text inputs & textarea</a></li>
					<li><a href="#panel-fixed-page2">Transitions</a></li>
			</ul>
		</div><!-- /panel -->
		
		<div data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="a" id="add-form">
			<form class="userform">
				<h2>Login</h2>
				<label for="name">Username:</label>
				<input name="name" id="name" value="" data-clear-btn="true" data-mini="true" type="text">
				<label for="password">Password:</label>
				<input name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true" type="password">
				<div class="ui-grid-a">
					<div class="ui-block-a"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-b ui-mini">Cancel</a></div>
					<div class="ui-block-b"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini">Save</a></div>
				</div>
			</form>
		</div><!-- /panel -->
	</div>
</body>
</html>