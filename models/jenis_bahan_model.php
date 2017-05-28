<?php

function select(){
	$query = mysql_query("SELECT a.* 
							FROM jenis_bahan a
							
							ORDER BY bahan_id");
	return $query;
}


function select_jenis_bahan(){
	$query = mysql_query("select * from jenis_bahan order by bahan_id");
	return $query;
}

function read_id($id){
	$query = mysql_query("select *
			from jenis_bahan
			where bahan_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into jenis_bahan values(".$data.")");
}

function update($data, $id){
	mysql_query("update jenis_bahan set ".$data." where bahan_id = '$id'");
}

function delete($id){
	mysql_query("delete from jenis_bahan where bahan_id = '$id'");
}


?>