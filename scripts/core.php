<?php
$servername = "localhost";
$username = "root";
$password = "";

$host = "http://localhost/blogger";

// Create connection
$conn = new mysqli($servername, $username, $password,"blogger_dev_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function create($table_name="",$fields=[]) {
	global $conn;
	
		$field_string = "";
		$value_string = "";

		foreach ($fields as $field => $value) {
			$field_string .= $field . ", ";
			$value_string .= "'" . $value . "', ";
		}
		$field_string = rtrim($field_string, ", ");
		$value_string = rtrim($value_string, ", ");

		$sql = "insert into " . $table_name . "(" . $field_string . ") VALUES (" . $value_string . ")";
		$result = $conn->query($sql);
		if ($result == false) {
			return false;
		}
		return true;
	
}

function read($table="",$where=[]) {
	global $conn;
	$where_str = "";
	if (count($where) > 0) {
		foreach ($fields as $key => $value) {
			$where_str .= $key . "='" . $value . "' and";
		}
	}
	$where_str = rtrim($where_str, " and");
	$sql = "select * from " . $table . " where " . $where_str;
	$result_set = $conn->query($sql);
	if ($result_set->num_rows == 0) {
		return false;
	}
	if ($result_set->num_rows == 1) {
		return mysqli_fetch_assoc($result_set);
	}
	if ($result_set->num_rows > 1) {
		$final_results = [];
		while ($result = mysqli_fetch_assoc($result_set)) {
			$final_results[] = $result;
		}
		return $final_results;
	}
}

function update($table="",$fields=[],$where=[]) {
	global $conn;
	$string = "";
	$where_str = "";
	if (count($fields) > 0) {
		foreach ($fields as $field => $value) {
			$string .= $field . "='" . $value . "',";
		}
	}
	$string = rtrim($string,",");
	if (count($where) > 0) {
		foreach ($where as $key => $value) {
			$where_str .= $key . "='" . $value . "' and";
		}
	}
	$where_str = rtrim($where_str, " and");
	$sql = "update " . $table . " set " . $string . " where " . $where_str;
	$result_set = $conn->query($sql);
	if ($conn->affected_rows > 0) {
		return true;
	}
	return false;
}