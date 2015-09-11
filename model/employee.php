<?php
require_once('classes/db.class.php');
class employee extends db {
	var $db;
	function __construct() {
		$this->db = $this->con_db();
	}
	function FetchList() {
		$employees = array();
		$employees = $this->SZ_GetRecords("employee", "*");
		return $employees;
	}
	function Save($data) {
		$data = $this->RealEscape($data);
		if(!isset($data['e_id'])) {
			return $this->SZ_Insert("employee", "e_id, e_name, e_gender", "'', '".$data['e_name']."', '".$data['e_gender']."'");
		} else {
			return $this->SZ_Update("employee", "e_name = '".$data['e_name']."', e_gender = '".$data['e_gender']."'", "e_id = ".$data['e_id']);
		}
	}
	function GetDetails($e_id) {
		return $this->SZ_GetRecord("employee", "*", "e_id = ".$e_id);
	}
	function Delete($e_id) {
		return $this->SZ_Delete("employee", "e_id = ".$e_id);
	}
}
?>