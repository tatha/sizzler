<?php
/*
	MySQLi Database class
*/
require_once('config.inc.php');
class db {
	
	var $conn;
	
	function __construct() {
		
	}
	
	function con_db() {
		$this->conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		if($this->conn->connect_errno) {
			echo "Database Connectivity Error : ".str_replace(DB_USER, '******', $this->conn->connect_error);
			exit();
		} else {
			return $this->conn;
		}
	}	
	
	//Real escape string
	function RealEscape($data) {
		foreach($data as $key=>$val)
		{
			if(is_array($data[$key])) {
				$data[$key] = $this->RealEscape($data[$key]);
			} else {
				$data[$key] = $this->conn->real_escape_string(trim($val));
			}
		}
		return $data;
	}
	
	//Fetch Single Record
	function SZ_GetRecord($table, $fields, $where='', $order='',$by='') {
		$q = "SELECT $fields FROM ".DB_PREFIX."$table";
		if($where) {
			$q .= " WHERE $where";
		}
		if($order) {
			$q .= " ORDER BY $order";
		}
		if($by) {
			$q .= " $by";
		}
		$res = $this->conn->query($q);
		if($res) {
			$result = $res->fetch_array();
			return $result;	
		} else {
			return false;
		}
	}
	
	//Fetch Multiple Records
	function SZ_GetRecords($table, $fields, $where='', $group='', $order='', $limit='') {
		$q = "SELECT $fields FROM ".DB_PREFIX."$table";
		if($where) {
			$q .= " WHERE $where";
		}		
		if($group) {
			$q .= " GROUP BY $group"; 
		}		
		if($order) {
			$q .= " ORDER BY $order";
		}		
		if($limit) {
			$q .= " $limit";
		}
		$res = $this->conn->query($q);
		if($res) {
			$rec_count = $res->num_rows;
			if($rec_count > 0) { 
				$recs = array();
				while($rec = $res->fetch_assoc()) {
					array_push($recs, $rec);
				}
				return $recs;
			}
		} else {
			return 0;
		}     
	}
	
	//Insert
	function SZ_Insert($table, $fields, $values) {
		$q = "INSERT INTO ".DB_PREFIX."$table ($fields) VALUES ($values)";
		$result = $this->conn->query($q);
		$id = $this->conn->insert_id;
		return $id;
	}
	
	//Update
	function SZ_Update($table, $pairs, $where) {
		if(is_array($pairs)) {
			$fields = implode(", ", $pairs);
		} else {
			$fields = $pairs;
		}	
		$q = "UPDATE ".DB_PREFIX."$table SET $fields WHERE $where";
		$result = $this->conn->query($q);
		if($result || $result != 0) {
			return true;
		} else {
			return false;
		}
	}
	
	//Delete
	function SZ_Delete($table, $where) {
		$q = "DELETE FROM ".DB_PREFIX."$table WHERE $where";	
		$result = $this->conn->query($q);	
		if($result) {
			return true;
		} else {
			return false;
		}
	}
	
	//Get Count
	function SZ_GetCount($table, $fields, $where='', $group='', $order='', $limit='') {
		$q = "SELECT $fields FROM ".DB_PREFIX."$table";
		if($where) {
			$q .= " WHERE $where";
		}		
		if($group) {
			$q .= " GROUP BY $group";
		}		
		if($order) {
			$q .= " ORDER BY $order";
		}		
		if($limit) {
			$q .= " $limit";
		}
		$result = $this->conn->query($q);
		if($result) {
			$rec_count = $result->num_rows;
			if($rec_count > 0) { 
				return $rec_count;
			}
		} else {
			return 0;
		}     
	}
	
	//Autocommit
	function SZ_Autocommit($mode) {
		$this->conn->autocommit($mode);
	}
	
	//Commit
	function SZ_Commit() {
		$this->conn->commit();
	}
	
	//Rollback
	function SZ_Rollback() {
		$this->conn->rollback();
	}
	
}
?>