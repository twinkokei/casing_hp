<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/payment_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucwords("Pembayaran");
$judul = 'Bakmi Gili';

$_SESSION['table_active'] = 1;

switch ($page) {
	case 'list':

		$transaction_id 				= get_isset($_GET['transaction_id']);
		$building_id 			= (isset($_GET['building_id'])) ? $_GET['building_id'] : 0;
		$query 						= select($transaction_id);
		$query2 					= select($transaction_id);
		$action 					= "order.php?page=save_payment&transaction_id=".$transaction_id."&building_id=".$building_id;
		// $table_name 			= get_table_name($table_id);
		// $building_name 		= get_table_name($building_id);
		$transaction_code = get_transaction_code($transaction_id);
		$member_id 				= get_member_id($transaction_id);

		// $button_back = "transaction_new.php?transaction_id=$transaction_id";
		$button_back = "payment.php?page=back&transaction_id=$transaction_id";
		include '../views/payment/list.php';

	break;

	case 'back':
		$transaction_id = $_GET['transaction_id'];
		delete_config('transactions_tmp', "WHERE transaction_id = '$transaction_id'");
		delete_config('transaction_tmp_details', "WHERE transaction_id = '$transaction_id'");
		header("Location: transaction_new.php?page=list&transaction_id=$transaction_id");
		break;



	case 'save':

		extract($_POST);

		$i_name = get_isset($i_name);

		$data = "'',
					'$i_name'
			";
			//echo $data;
			create($data);

			header("Location: payment.php?page=list&did=1");


	break;

	case 'read_voucher':

		extract($_POST);

		$id = get_isset($id);

		$data_voucher = read_voucher($id);

		//echo $data_voucher['voucher_type_id']."-".$data_voucher['voucher_value'];
		$data['voucher_type_id'] = $data_voucher['voucher_type_id'];
		$data['voucher_value'] = $data_voucher['voucher_value'];

		echo json_encode($data);

	break;

	case 'hitungbulat':
		$totalkedua=ceil($_POST['price']);
		if (substr($totalkedua,-2)!=00){
			if(substr($totalkedua,-2)<50){
				$totalkedua=round($totalkedua,-2)+100;
			}else{
				$totalkedua=round($totalkedua,-2);
			}
		}
		echo $totalkedua;
	break;

	case 'tax':

	break;
}

?>
