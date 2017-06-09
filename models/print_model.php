<?php

function select($transaction){
	$query = mysql_query("SELECT a.*,c.*, d.user_name
							  FROM transactions a
							  LEFT JOIN members c ON c.member_id = a.member_id
							  LEFT JOIN users d ON d.user_id = a.user_id
							  WHERE transaction_id = '".$transaction."'");
	return $query;
}
function select_item($transaction){
	$query = mysql_query("SELECT b.*, c.item_name
							  FROM transactions a
							  JOIN transaction_details b ON b.transaction_id = a.transaction_id
							  JOIN items c ON c.item_id = b.item_id
							  WHERE a.transaction_id = '".$transaction."' AND c.item_price !=0");
	return $query;
}
function selectbydate($start, $end){
	$query = mysql_query("SELECT a.*,c.member_name, c.member_discount, e.user_login, e.user_name, f.payment_method_name, g.*
							FROM transactions a
							LEFT JOIN members c ON c.member_id = a.member_id
							LEFT JOIN users e ON e.user_id = a.user_id
							LEFT JOIN payment_methods f ON f.payment_method_id = a.payment_method_id
							LEFT JOIN banks g ON g.bank_id = a.bank_id
							WHERE
								transaction_date BETWEEN '$start'
							AND '$end'");
	return $query;
}
function selectmenubydate($start, $end){
	$query = mysql_query("SELECT DATE(a.transaction_date) AS DATE, b.item_id, SUM(b.transaction_detail_qty) AS qty,
												b.transaction_detail_original_price, c.item_name FROM transactions a
												LEFT JOIN transaction_details b ON b.transaction_id = a.transaction_id
												LEFT JOIN items c ON c.item_id = b.item_id
												WHERE transaction_date BETWEEN '$start'
												AND '$end' GROUP BY DATE,
												item_id ORDER BY DATE");
	return $query;
}
function graph($start, $end){
        $query = mysql_query("SELECT a.*,c.member_name, c.member_discount,e.user_login, e.user_name
							FROM transactions a
							LEFT JOIN members c ON c.member_id = a.member_id
							left join users e on e.user_id = a.user_id
							WHERE transaction_date BETWEEN '$start'
							AND '$end'");
        return $query;
}
function select_transaction($id){
	$query = mysql_query("SELECT a.*, b.*,c.branch_name FROM transactions a
							 LEFT JOIN members b ON b.member_id = a.member_id
							 LEFT JOIN branches c ON c.branch_id = a.branch_id
							 ORDER BY transaction_id");
	return $query;
}
function select_supplier($id){
	$query = mysql_query("SELECT * FROM suppliers ORDER BY supplier_id");
	return $query;
}
function select_trasactiondet($id){
	$query = mysql_query("SELECT a.*, b.item_name, b.item_price FROM transaction_details a
							 LEFT JOIN items b ON b.item_id = a.item_id
							 ORDER BY transaction_detail_id");
	return $query;
}

function select_transactionall($id){
	$query = mysql_query("SELECT a.*, b.*, d.member_name, e.branch_name FROM transactions a
												LEFT JOIN transaction_details b ON b.transaction_id = a.transaction_id
												LEFT JOIN items c ON c.item_id = b.item_id
												LEFT JOIN members d ON d.`member_id` = a.`member_id`
												LEFT JOIN branches e ON e.`branch_id`= a.`branch_id`
												WHERE a.transaction_id = '$id'
											 	ORDER BY a.transaction_id");
	return $query;
}

?>
