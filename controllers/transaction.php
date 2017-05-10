<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/transaction_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("transaction");

$_SESSION['menu_active'] = 3;

switch ($page) {
	case 'list':
	get_header($title);
	$close_button = 'home.php';
	$date = format_date(date("Y-m-d"));
	if(isset($_GET['date'])){
		$date = format_date($_GET['date']);
	}

	$transaction_id = '';

	$query_member = select_member();
	$query_branch = select_branch();

	$action = "transaction.php?page=save";
	include '../views/transaction/list.php';
	get_footer($query_find);
	break;

}
?>
