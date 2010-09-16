<?php
include 'dbAccess.php';
$db = new db();
//Access Functions


function delete ($id) {
	echo $db->delete_entry($id);	
}

switch($_POST['method']) {
	case "delete" : 
		delete($_POST['id']);
		break;
	case "sort" :
		break;
	default :
		break;
}	

?>