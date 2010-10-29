<?php
include 'dbAccess.php';
$db = new db();
//Access Functions

switch($_POST['method']) {
	case "delete" : 
		$status = $db->delete_entry($_POST['id']);
		if ($status == 1)
			echo $_POST['id'];
		break;
	case "sort" :
		break;
	default :
		break;
}	
$db->close();
?>