<?php

function select(){
	$query = mysql_query("SELECT a.*,  c.merk_name
							FROM items a
							JOIN merk c ON c.merk_id = a.item_merk
							order by item_id");
	return $query;
}


function select_merk(){
	$query = mysql_query("select * from merk order by merk_id");
	return $query;
}

function select_branch($where){
	$query = mysql_query("select * from branches $where order by branch_id");
	return $query;
}

function read_id($id){
	$query = mysql_query("SELECT a.*,c.merk_name
						  FROM items a
						  JOIN merk c ON c.merk_id = a.item_merk
						  WHERE item_id = '$id'
						");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into items values(".$data.")");
}

function update($data, $id){
	mysql_query("update items set ".$data." where item_id = '$id'");
}

function get_stock($item_id, $branch_id){
	$query = mysql_query("select item_stock_qty as result from item_stocks where item_id = '$item_id' and branch_id = '$branch_id'");
	$row = mysql_fetch_array($query);

	$result = ($row['result']) ? $row['result'] : "0";
	return $result;
}

function delete($id){
	$query = mysql_query("delete from items where item_id = '$id'");
}


?>
