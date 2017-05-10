<?php

function select($transaction_id){
	$query = mysql_query("SELECT b.*, c.menu_name
											  FROM transactions_tmp a
											  JOIN transaction_tmp_details b ON b.transaction_id = a.transaction_id
											  JOIN menus c ON c.menu_id = b.menu_id
											  WHERE a.transaction_id = '$transaction_id'");
	return $query;
}

function create($data){
	mysql_query("insert into buildings values(".$data.")");
}

function get_table_name($table_id){
	$query = mysql_query("select table_name as result from tables where table_id = '$table_id'");
	$row = mysql_fetch_array($query);

	return $row['result'];
}
function get_building_name($id){
	$query = mysql_query("select building_name as result from buildings where building_id = '$id'");
	$row = mysql_fetch_array($query);

	return $row['result'];
}

function get_transaction_code($transaction_id){
	$query = mysql_query("select transaction_code as result from transactions_tmp where transaction_id = '$transaction_id'");
	$row = mysql_fetch_array($query);

	return $row['result'];
}
function get_member_id($transaction_id){
	$query = mysql_query("select member_id as result from transactions_tmp where transaction_id = '$transaction_id'");
	$row = mysql_fetch_array($query);

	return $row['result'];
}
function get_member_name($id){
	$query = mysql_query("select member_name as result from members where member_id = '$id'");
	$row_member = mysql_fetch_array($query);

	return $row['result'];
}
function read_voucher($id){
	$query = mysql_query("select * from vouchers where voucher_id = '$id'");
	$row = mysql_fetch_array($query);

	return $row;
}

function delete_config($table, $where){
	mysql_query("delete from $table $where");
}


?>
