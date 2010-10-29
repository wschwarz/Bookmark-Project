<?php
/* This file is a webservice that receives bookmark data from a 
chrome extension one entry at a time and inserts it into a 
mongo db database */

include 'dbAccess.php';
$db = new db();

function ReceiveFromPost() {
	$url_array = parse_url($_POST["url"]);
	$entry = array("title" => $_POST["title"],
			"link" => $_POST["link"],
			"add_date" => $_POST["add_date"],
			"last_modified" => $_POST["last_modified"],
			"category" => $_POST["category"],
			"host" => $url_array['host'],
			"path" => $url_array['path'],
			"user" => 1,
			"read" => "No");
	return $entry;
}

function ReceiveAsXML() {
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
	$xml = str_replace("&","&amp;", $xml );
	$xmlParsed = new SimpleXMLElement($xml);
	$url_array = parse_url((string)$xmlParsed->link);
	$entry = array("title" => (string)$xmlParsed->title,
			"link" => (string)$xmlParsed->link,
			"add_date" => (string)$xmlParsed->add_date,
			"last_modified" => (string)$xmlParsed->last_modified,
			"category" => (string)$xmlParsed->category,
			"host" => $url_array['host'],
			"path" => $url_array['path'],
			"user" => 1,
			"read" => "No");
	return $entry;
}
// Receive a bookmark
if (strstr($_SERVER["CONTENT_TYPE"], "application/x-www-form-urlencoded") != FALSE) {
	echo "Starting Post string Processing <br />";
	$entry = ReceiveFromPost();
	$db->insert($entry);
	echo $entry["title"] . " added!";
}
else if (strstr($_SERVER["CONTENT_TYPE"], "text/xml") != FALSE) {
	echo "Starting XML Processing <br />";
	$entry = ReceiveAsXML();
	$db->insert($entry);
	echo $entry["title"] . " added!";
}
else echo "Invalid Post data <br />";
$db->close();
?>