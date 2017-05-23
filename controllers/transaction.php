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

	$query_member = select_config('members', '');
	$query_branch = select_config('branches', '');

	$action = "transaction.php?page=save";
	include '../views/transaction/list.php';
	get_footer();
	break;

	case 'get_items':
		$where = "";
		$query = select_config('items', $where);
		$data = array();
		while ($row = mysql_fetch_array($query)) {
			$data[] = array(
				'item_id' 		=> $row['item_id'],
				'item_name' 	=> $row['item_name'],
				'item_price' 	=> $row['item_price']
			);
		}
		echo json_encode($data);
		break;

		case 'bayar_popmodal':
				$branch_id 		= isset($_GET['branch_id']);
				$where_branchid = "WHERE branch_id = '$branch_id'";
				$branch_name 	= select_config_by('branches', 'branch_name', $where_branchid);
				include '../views/transaction/bayar_popmodal.php';
			break;

		case 'save':
			$itemid = $_POST['itemid'];
			$itemprice = $_POST['itemprice'];
			$itemqty = $_POST['itemqty'];
			$date_picker1 = $_POST['date_picker1'];
			$i_member = $_POST['i_member'];
			$i_branch_id = $_POST['i_branch_id'];

			$tanggal = explode("/", $date_picker1);
			$tanggal = $tanggal[2]."/".$tanggal[1]."/".$tanggal[0];
			$transaction_id = get_last_date('transactions', 'transaction_id');
			$transaction_code = "INV/".$tanggal."/".$transaction_id;
			$tanggaltransaksi = date("Y-m-d H:m:s");
			$data = "'',
							 '$transaction_code',
							 '$i_branch_id',
							 '$i_member',
							 '$tanggaltransaksi',
							 '',
							 '',
							 '',
							 '',
							 '',
							 '',
							 '',
							 '',
							 '',
							 '',
							 '',
							 ''";
			// foreach ($itemid as $row) {
			//
			// }

			break;


}
?>
