<?php
/*DB operations*/
class Bookmarks_model extends Model {
	//access variable
	protected $collection;
	protected $connection;
	
	//db initialization
	function Bookmarks_model() {
		parent::Model();
	}
	
	function Initialize($serverName="", $dbName="bookmarks", $collectionName="entries") {
		$this->connection = new Mongo(); //personal mongo db server
		$db = $this->connection->$dbName;
		$collection = $db->$collectionName;
		$this->collection = $collection;
	}
	
	//pull all entries and return as array
	function getAll() {
		$this->Initialize();
		$cursor = $this->collection->find();
		$resultArray = array();
		while ($cursor->hasNext()) {
			array_push($resultArray, $cursor->getNext());
		}
		return $resultArray;
		$this->close();
	}
	
	//inserts a single entry. $entry is an array 
	function insert($entry) {
		$this->Initialize();
		try {
			$this->collection->insert($entry, true);
		}
		catch(MongoCursorException $e) {
			echo "Insertion failed: $e";
		}
		$this->close();
	}
	
	function query($value) {
		$this->Initialize();
		try {
			$resultArray = array();
			$cursor = $this->collection->find(array("title" => new MongoRegex('/'.$value.'/i')));
			while ($cursor->hasNext()) {
				array_push($resultArray, $cursor->getNext());
			}
			return $resultArray;
		}
		catch (MongoException $e) {
			echo "Query Faild: $e";
		}
		$this->close();		
	}
	
	function getAllSort($sortField, $direction) {
		$this->Initialize();
		$cursor = $this->collection->find();
		$cursor->sort(array($sortField => (int)$direction));
		$resultArray = array();
		while ($cursor->hasNext()) {
			array_push($resultArray, $cursor->getNext());
		}
		return $resultArray;
		$this->close();
	}
	
	//deletes a single entry
	function delete_entry($entryId) {
		$this->Initialize();
		return $this->collection->remove(array('_id' => new MongoId($entryId)), array("justOne", true));
		$this->close();
	}
	
	function close() {
		$this->connection->close();
	}
}

?>