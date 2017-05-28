<?php

function select(){
	$query = mysql_query("select a.* 
							from merk a
							
							order by merk_id");
	return $query;
}

function select_merk(){
	$query = mysql_query("select * from merk order by merk_id ");
	return $query;
}


function read_id($id){
	$query = mysql_query("select *
			from merk
			where merk_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into merk values(".$data.")");
}

function update($data, $id){
	mysql_query("update merk set ".$data." where merk_id = '$id'");
}

function delete($id){
	mysql_query("delete from merk where merk_id = '$id'");
}


?>