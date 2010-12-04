<?php
/*DB operations*/
class Bookmarks_model extends Model {
	//access variable
	protected $collection;
	protected $connection;
	
	//db initialization
	function Bookmarks_model($serverName="localhost", $dbName="bookmarks", $collectionName="entries") {
		parent::Model();
		try {
			$this->connection = new Mongo($serverName); //personal mongo db server
			$db = $this->connection->$dbName;
			$collection = $db->$collectionName;
			$this->collection = $collection;
		}
		catch(MongoException $e) {
			echo $e;
		}
	}
	
	//pull all entries and return as array
	function getAll($page=0, $pageSize=0) {
		try {
			$cursor = $this->collection->find();
			$resultArray = array();
			$counter = 0;
			while ($cursor->hasNext()) {
				if ($page == 0 && $pageSize == 0)
					array_push($resultArray, $cursor->getNext());
				else if ($counter >= (($page - 1) * $pageSize) && $counter <= ($page * $pageSize))
					array_push($resultArray, $cursor->getNext());
				else
					$cursor->getNext();
				$counter += 1;
			}
			return $resultArray;
		}
		catch(MongoException $e) {
			echo $e;
		}
	}
	
	function filterPages($page, $pageSize, $beginArray) {
		$resultArray = array();
		$counter = 0;
		if (count($beginArray) >= $pageSize * $page) {
			foreach($beginArray as $row) {
				if ($page == 0 && $pageSize == 0)
					array_push($resultArray, $row);
				else if ($counter >= (($page - 1) * $pageSize) && $counter <= ($page * $pageSize))
					array_push($resultArray, $row);
				$counter += 1;
			}	
		}
		return $resultArray;
	}
	
	function getTotal() {
		try {
			$cursor = $this->collection->find();
			return $cursor->count();
		}
		catch (MongoException $e) {
			echo $e;
		}
	}
	
	//inserts a single entry. $entry is an array 
	function insert($entry) {
		try {
			$this->collection->insert($entry, true);
		}
		catch(MongoCursorException $e) {
			echo "Insertion failed: $e";
		}
	}
	
	function query($value) {
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
	}
	
	function getAllSort($sortField, $direction) {
		try {
			$cursor = $this->collection->find();
			$cursor->sort(array($sortField => (int)$direction));
			$resultArray = array();
			while ($cursor->hasNext()) {
				array_push($resultArray, $cursor->getNext());
			}
			return $resultArray;
		}
		catch (MongoException $e) {
			echo $e;
		}
	}
	
	//deletes a single entry
	function delete_entry($entryId) {
		return $this->collection->remove(array('_id' => new MongoId($entryId)), array("justOne", true));
	}
	
	function toggleRead($id) {
		try {
			$id = new MongoId($id);
			$read = $this->collection->findOne(array("_id" => $id));
			if ($read['read'] == "No") {
				if ($this->collection->update(array("_id" => $id), array('$set' => array("read" => "Yes"))))
					return $id;
				else
					return "Model {case: no} error occurred";
			}
			else if ($read['read'] == "Yes") {
				if ($this->collection->update(array("_id" => $id), array('$set' => array("read" => "No"))))
					return $id;
				else
					return "Model {case: yes} error occurred";
			}
		}
		catch(MongoException $e) {
			return "Query Failed: $e";
		}
	}
	
	function close() {
		$this->connection->close();
	}
}

?>