<?php

function select_detail($date1, $date2){
	$query = mysql_query("SELECT a.item_id , a.item_price, a.item_name, b.jumlah, jumlah_dasar, jumlah_omset
												FROM items a
												JOIN (

													SELECT SUM( transaction_detail_qty ) AS jumlah,
														SUM( transaction_detail_qty * transaction_detail_original_price ) AS jumlah_dasar,
														SUM( transaction_detail_qty * transaction_detail_price ) AS jumlah_omset,
														item_id
													FROM transaction_details a
													JOIN transactions b ON b.transaction_id = a.transaction_id
													WHERE  b.transaction_date >= '$date1'
													AND b.transaction_date <= '$date2'
													GROUP BY item_id
												) AS b ON b.item_id = a.item_id
												ORDER BY b.jumlah DESC");

	return $query;
}

function select_transaction($date1, $date2){

	$query = mysql_query("SELECT a.*
									FROM transactions a
									WHERE  a.`transaction_date` >= '$date1'
									AND a.`transaction_date` <= '$date2'
									AND a.`status` = 0
									ORDER BY transaction_id
						");

	return $query;
}

function read_id($id){
	$query = mysql_query("SELECT a.*, b.unit_name, c.transaction_type_name
							FROM  transactions a
							JOIN units b on a.unit_id = b.unit_id
							JOIN transaction_types c on c.transaction_type_id = a.transaction_type_id
 							WHERE  a.transaction_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}

function get_jumlah_penjualan($date1, $date2){
	$query = mysql_query("SELECT count(transaction_id) as jumlah
							from transactions
							WHERE  transaction_date >= '$date1'
							AND transaction_date <= '$date2'
							 ");
	$result = mysql_fetch_object($query);
	return $result->jumlah;
}

function get_total_penjualan($date1, $date2){
	$query = mysql_query("SELECT sum(transaction_grand_total) as jumlah
							from transactions
							WHERE  transaction_date >= '$date1'
							AND transaction_date <= '$date2'
							 ");
	$result = mysql_fetch_array($query);
	$result = ($result['jumlah']) ? $result['jumlah'] : "0";
	return $result;
}

function get_menu_terlaris($date1, $date2){
	$query = mysql_query("SELECT a.item_id, a.item_price, a.item_name, jumlah
								FROM items a
								JOIN (

									SELECT SUM( transaction_detail_qty ) AS jumlah, item_id
									FROM transaction_details a
									JOIN transactions b ON b.transaction_id = a.transaction_id
									WHERE  b.transaction_date >= '$date1 00:00:00'
									AND b.transaction_date <= '$date2 23:59:59'
									GROUP BY item_id
								) AS b ON b.item_id = a.item_id
								ORDER BY jumlah DESC, item_id ASC
								LIMIT 1
							 ");
	$result = mysql_fetch_array($query);
	$result = ($result['item_name']) ? $result['item_name'] : "-";
	return $result;
}

function select_partner($date1, $date2){
	$query = mysql_query("SELECT a.partner_id, a.partner_name, jumlah_qty, jumlah_margin, jumlah_original, jumlah_omset
								FROM partners a
								JOIN (

									SELECT sum(transaction_detail_qty) as jumlah_qty,
											sum(transaction_detail_qty * transaction_detail_margin_price ) AS jumlah_margin,
											sum(transaction_detail_qty * transaction_detail_original_price ) AS jumlah_original,
											sum(transaction_detail_qty * transaction_detail_price ) AS jumlah_omset,
											partner_id
									FROM transaction_details a
									JOIN transactions b on b.transaction_id = a.transaction_id
									JOIN menus c on c.menu_id = a.menu_id
									WHERE  b.transaction_date >= '$date1 00:00:00'
									AND b.transaction_date <= '$date2 23:59:59'
									AND partner_id <> 1
									GROUP BY partner_id
								) AS b ON b.partner_id = a.partner_id


								");

	return $query;
}



function get_total_dasar($date1, $date2, $partner_id){
	$query = mysql_query("SELECT a.menu_id, a.menu_price, a.menu_name, jumlah
								FROM menus a
								JOIN (

									SELECT sum( transaction_detail_qty ) AS jumlah, menu_id
									FROM transaction_details a
									JOIN transactions b on b.transaction_id = a.transaction_id
									WHERE  b.transaction_date >= '$date1 00:00:00'
									AND b.transaction_date <= '$date2 23:59:59'
									GROUP BY menu_id
								) AS b ON b.menu_id = a.menu_id
								order by jumlah desc, menu_id asc
								limit 1

							 ");
	$result = mysql_fetch_array($query);
	$result = ($result['menu_name']) ? $result['menu_name'] : "-";
	return $result;
}

function select_itemday($date1, $date2){
	$query = mysql_query("SELECT a.*, b.`item_name` FROM historystockday a
												LEFT JOIN items b ON b.`item_id` = a.`item`
												WHERE a.`historystock_date` >= '$date1'
												AND a.`historystock_date` <= '$date1'");
	return $query;
}

function select_itemmonth($date1, $date2)
{
	$query = mysql_query("SELECT a.*, b.`item_name` FROM historystockmonth a
												LEFT JOIN items b ON b.`item_id` = a.`item`
												WHERE MONTH(a.`historystock_date`) >= MONTH('$date1')
												AND MONTH(a.`historystock_date`) <= '$date1'");
	return $query;
}

function select_detailpembelian($date1, $date2){
	$query = mysql_query("SELECT a.*, b.supplier_name, d.user_name FROM purchases a
												LEFT JOIN suppliers b ON b.`supplier_id` = a.`supplier_id`
												LEFT JOIN branches c ON c.`branch_id` = a.`branch_id`
												LEFT JOIN users d ON d.`user_id` = a.`user_id`
												WHERE a.`purchase_date` >= '$date1'
												AND a.`purchase_date` <= '$date2'
												AND a.`status` = 0");
	return $query;
}

?>
