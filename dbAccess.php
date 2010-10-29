<?php
/*DB operations*/
class db {
	//access variable
	protected $collection;
	protected $connection;
	
	//db initialization
	public function __construct($serverName="", $dbName="bookmarks", $collectionName="entries") {
		$this->connection = new Mongo(); //personal mongo db server
		$db = $this->connection->$dbName;
		$collection = $db->$collectionName;
		$this->collection = $collection;
	}
	
	//pull all entries and return as array
	public function getAll() {
		$cursor = $this->collection->find();
		$resultArray = array();
		while ($cursor->hasNext()) {
			array_push($resultArray, $cursor->getNext());
		}
		return $resultArray;
	}
	
	//inserts a single entry. $entry is an array 
	public function insert($entry) {
		try {
			$this->collection->insert($entry, true);
		}
		catch(MongoCursorException $e) {
			echo "Insertion failed: $e";
		}
	}
	
	public function query($operation, $value, $collection) {
		
	}
	
	//deletes a single entry
	public function delete_entry($entryId) {
		return $this->collection->remove(array('_id' => new MongoId($entryId)), array("justOne", true));
	}
	
	public function close() {
		$this->connection->close();
	}
}

?>