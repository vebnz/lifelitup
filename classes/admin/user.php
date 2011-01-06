<?php

class AdminUser {

	function getAllUsers() {
		$db = Database::obtain();
		
		$sql = "SELECT *
			FROM " . tbl_users;
			
		$rows = $db->fetch_array($sql);

		return $rows;
	}
	
	function getUserDetails($userid) {
	
	}
	
	function updateUserDetails($userid) {
	
	}
	
	function deleteUser($userid) {
	
	}
	
	function banUser($userid) {
	
	}
	
	function unbanUser($userid) {
	
	}
}