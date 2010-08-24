<html>
<?php
/*
$connection = new Mongo("http://www.horribad.com");
$db = $connection->mydb;
$collection = $db->things;
echo $collection->count();
*/
function get_bookmarks() {
	$ch = curl_init("http://www.wschwarz.com/Site/bookmarks.html")			;
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

function clean_html($raw) {
	$output = "<?xml version='1.0' standalone='yes'?><root>" . $raw . "</root>";
	$output = str_ireplace("<html>", "", $output);
	$output = str_ireplace("</html>", "", $output);
	return $output;
}

$raw_html = get_bookmarks();
$clean_html = strip_tags($raw_html, '<a><h3><title><h1>');
$clean_html = clean_html($clean_html);
//print_r($clean_html);
$xml_bookmarks = new SimpleXMLElement($clean_html);
//echo $xml_bookmarks->asXML();
foreach ($xml_bookmarks->A as $name) {
	echo $name . "<br />";
	echo $name["HREF"] . "<br />";
}


?>
</html>