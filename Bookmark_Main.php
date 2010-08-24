  <?php

//initialization
function intialization() {
	$connection = new Mongo("www.horribad.com"); //personal mongo db server
	$db = $connection->bookmarks;
	$collection = $db->entries;
	return $collection;
}

// hosted bookmarks here
// change to file upload instead
function get_bookmarks() {
	$ch = curl_init("http://www.wschwarz.com/Site/bookmarks.html");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

//change html to xml
function clean_html($raw) {
	//stripping all tags except <a><h3><title><h1> specific to google export bookmark
	$output = strip_tags($raw, '<a><h3><title><h1>');
	$output = "<?xml version='1.0' standalone='yes'?><root>" . $output . "</root>";
	$output = str_ireplace("<html>", "", $output);
	$output = str_ireplace("</html>", "", $output);
	return $output;
}

// grab all links save to db
function save_links_to_db($xml, $collection) {
	foreach ($xml->A as $name) {
		$url_array = parse_url((string)$name["HREF"]);
		$entry = array("title" => (string)$name,
			"link" => (string)$name["HREF"],
			"add_date" => (string)$name["ADD_DATE"],
			"last_visit" => (string)$name["LAST_VISIT"],
			"last_modified" => (string)$name["LAST_MODIFIED"],
			"category" => "",
			"host" => $url_array['host'],
			"path" => $url_array['path']);
		$collection->insert($entry);
		print_r($entry);
		echo "<br />";	
	}
}

function print_nicely($obj) {
	echo "<h1>".(string)$obj['title']."</h1>";
	echo "<a href=".(string)$obj['link'].">".(string)$obj['link']."</a>";
	echo "<br />";
}

function retrieve_links($collection) {
	$cursor = $collection->find();
	while ($cursor->hasNext()) {
		print_nicely($cursor->getNext());
	}
}

function main() {
	$raw_html = get_bookmarks();
	$clean_html = clean_html($raw_html);
	$xml_bookmarks = new SimpleXMLElement($clean_html);
	$collection = intialization();
	save_links_to_db($xml_bookmarks, $collection);
	retrieve_links($collection);
	
}

main();


?>