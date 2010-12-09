<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=windows-1250">
		<title>Bookmarks</title>
		<link rel="Shortcut Icon" href="<?=base_url()?>system/application/styles/Images/1280357233_Red.ico" type="image/x-icon">
		<link rel="STYLESHEET" type="text/css" href='<?=base_url()?>system/application/styles/main.css'>
		<link rel="STYLESHEET" type="text/css" href='<?=base_url()?>system/application/styles/south-street/jquery-ui-1.8.6.custom.css'>
		<script type="text/javascript" src="<?=base_url()?>system/application/scripts/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>system/application/scripts/jquery-ui-1.8rc3.custom.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>system/application/scripts/script.js"></script>
	</head>
	<body>
		<div class="container">
			<h1 class="title">B.M. Listerizer</h1>
			<div class="top_menu">
				<ul>
					<li><a class="ui-button ui-button-text-only ui-widget ui-state-default" href="http://www.horribad.com">Home</a></li>
					<li><a class="ui-button ui-button-text-only ui-widget ui-state-default" href="#">Categories</a></li>
				</ul>
			</div>
			<div id="messages">
			</div>
			
			<div style="float:right; position:relative; ">
				<label>Search: <input type='text' name='SearchField' id='SearchField' style="width: 250px;"/></label>
			</div>
			<br /> <br />
			<div id="listing">
			</div>
			<br />
			<button id="Delete">
	   			Delete
			</button>
			<br />
			<br />
		</div>
	</body>
</html>