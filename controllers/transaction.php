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
				$action = "transaction.php?page=save";
				$where = "";
				$date_picker1 	= $_GET['date_picker1'];
				$member_id		= $_GET['member_id'];
				$branch_id 		= $_GET['branch_id'];
				$total_all 		= $_GET['total_all'];
				$where_branchid = "WHERE branch_id = '$branch_id'";
				$branch_name 	= select_config_by('branches', 'branch_name', $where_branchid);
				$query_payment_method = select_config('payment_methods', $where);
				$query_bank = select_config('banks', $where);
				include '../views/transaction/bayar_popmodal.php';
			break;

		case 'simpan_transaksi':

			$itemid = $_POST['item_id'];
			$itemprice = $_POST['item_price'];
			$itemqty = $_POST['item_qty'];
			$date_picker1 = $_POST['i_date'];
			$i_member = $_POST['i_member'];
			$i_branch_id = $_POST['i_branch_id'];
			$tanggal = explode("/", $date_picker1);
			$tanggal = $tanggal[2]." / ".$tanggal[1]." / ".$tanggal[0];
			$transaction_id = get_last_id('transactions', 'transaction_id');
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
							 '0'";

			$id = create_config('transactions', $data);
			if ($id) {
				foreach ($itemid as $row => $value) {
					$whereitem_id = "WHERE item_id = '".$itemid[$row]."'";
					$r_item = select_object_config('items', $whereitem_id);

					$total = 0;
					$total = $itemqty[$row]*$r_item->item_price;
					$datadetail = "'',
												 '$id',
												 '".$itemid[$row]."',
												 '$r_item->harga_beli',
												 '',
												 '$r_item->item_price',
												 '',
												 '$r_item->item_price',
												 '".$itemqty[$row]."',
												 '$total'";
					create_config('transaction_details', $datadetail);
				}
			}
			$data = array();
			$data['id'] = $id;

			if ($id) {
				$data['status'] = '200';
			} else {
				$data['status'] = '204';
			}

			echo json_encode($data);

			break;


}
?>
