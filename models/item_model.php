<?php

function select(){
	$query = mysql_query("select a.*,b.merk_name,c.bahan_name
							from items a
							join merk b on b.merk_id = a.item_merk
							join jenis_bahan c on c.bahan_id = a.item_bahan
							order by item_id");
	return $query;
}

function select_item(){
	$query = mysql_query("select * from items order by item_id ");
	return $query;
}

function select_merk(){
	$query = mysql_query("select * from merk order by merk_id");
	return $query;
}

function select_bahan(){
	$query = mysql_query("select * from jenis_bahan order by bahan_id");
	return $query;
}

function read_id($id){
	$query = mysql_query("select *
			from items 
			where item_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into items values(".$data.")");
}

function update($data, $id){
	mysql_query("update items set ".$data." where item_id = '$id'");
}

function delete($id){
	mysql_query("delete from items where item_id = '$id'");
}


?>