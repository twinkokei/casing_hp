<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/report_detail_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Report Detail");

$_SESSION['menu_active'] = 10;

switch ($page) {

	case 'list':
		get_header();

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;

		$date_default = "";
		$date_url = "";

		$button_download = "";

		if(isset($_GET['preview'])){
			$i_date = get_isset($_GET['date']);
			$date_default = $i_date;
			$date_url = "&date=".str_replace(" ","", $i_date);

		}

		$action = "report_detail.php?page=form_result&preview=1";

		include '../views/report_detail/form.php';

		if(isset($_GET['preview'])){

				if(isset($_GET['date'])){
					$i_date = $_GET['date'];
				}else{
					extract($_POST);
					$i_date = get_isset($i_date);
				}
			$date = explode("-", $i_date);
			$date1 = $date[0];
			$date2 = $date[1];
			$date1 = str_replace("/","-", $date1);
			$date2 = str_replace("/","-", $date2);

			// echo $i_date;

			$query_item = select_detail($date1, $date2);
			$query_partner = select_partner($date1, $date2);
			$query_tr = select_transaction($date1, $date2);
			$qitemday = select_itemday($date1, $date2);
			$qitemmonth = select_itemmonth($date1, $date2);

			$qpembelian = select_detailpembelian($date1, $date2);
			//fungsi backup

			$datetime1 = new DateTime($date1);
			$datetime2 = new DateTime($date2);
			$difference = $datetime1->diff($datetime2);
			$jumlah_hari = $difference->days + 1;
			$jumlah_penjualan = get_jumlah_penjualan($date1, $date2);
			$total_penjualan = number_format(get_total_penjualan($date1, $date2), 0);
			$menu_terlaris = get_menu_terlaris($date1, $date2);

			include '../views/report_detail/form_result.php';
			include '../views/report_detail/list_item.php';
			include '../views/report_detail/liststockeveryday.php';
			include '../views/report_detail/liststockeverymonth.php';
			include '../views/report_detail/list_transaction.php';
			include '../views/report_detail/list_pembelian.php';
		}
		get_footer();
	break;

	case 'form_result':
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;

		$date_default = "";
		$date_url = "";

		//if(isset($_GET['preview'])){

			extract($_POST);
			$i_date = (isset($_POST['i_date'])) ? $_POST['i_date'] : null;
			$date_default = $i_date;
			$date_url = "&date=".str_replace(" ","", $i_date);
		//}

		header("Location: report_detail.php?page=list&preview=1&date=$date_default");
	break;



	case 'form_detail':
			$title = ucfirst("Report Event Detail");
			get_header();
			$close_button = "report_detail.php?page=form";
			$id = (isset($_GET['id'])) ? $_GET['id'] : null;

			$row = read_id($id);
			$row->transaction_date = format_date($row->transaction_date);
			$row->transaction_date2 = format_date($row->transaction_date2);
			$all_date = $row->transaction_date." - ".$row->transaction_date2;

			$query_trainer_view = read_trainer_view($id);
			$query_agent_view = read_agent_view($id);

			include '../views/report_detail/form_save.php';
			include '../views/report_detail/list_trainer_view.php';
			include '../views/report_detail/list_agent_view.php';
			include '../views/report_detail/form_comand3.php';

		get_footer();
	break;

	case 'deletereport':
		$id				= $_GET['id'];
		$type 		= $_GET['type'];
		$tanggal 	= date("Y-m-d H:m:s");
		$user_id = $_SESSION['user_id'];
		$date_default = $_GET['date'];
		$branch_id = $_GET['branch_id'];
		$data = "'',
						 '$type',
						 '$id',
						 '$tanggal',
						 '$user_id',
						 '$branch_id'";
		if ($type == 1) {
			create_config("hapusjual", $data);
		} elseif ($type == 2 ) {
			create_config("hapusbeli", $data);
		}
		header("Location: report_detail.php?page=list&preview=1&date=$date_default");
	break;

}

?>
