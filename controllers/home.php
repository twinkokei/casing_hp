<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/home_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Home");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);


		if($_SESSION['user_type_id']==1 || $_SESSION['user_type_id']==2){
			$where_branch = "";
		}else{
			$where_branch = " and branch_id = '".$_SESSION['branch_id']."' ";

		}

		$date_default = "";
		$date1 = "";
		$date2 = "";

		if(isset($_GET['preview'])){
			$i_date = get_isset($_GET['date']);


			$date = explode("-", str_replace(" ", "", $i_date));
			$date1 = format_back_date($date[0]);
			$date2 = format_back_date($date[1]);

			$date_default = $i_date;
		}

		$action = "home.php?page=form_result&preview=1";

		$jumlah_penjualan = get_jumlah_penjualan(date("Y-m-d"), $where_branch);
		$total_omset = number_format(get_total_omset(date("Y-m-d"), $where_branch), "0", ".", ".");
		$date_now = format_date(date("Y-m-d"));
		$menu_terlaris = get_menu_terlaris(date("Y-m-d"), $where_branch);

		$query_top = select_top($date1, $date2, $where_branch);
		$query_stock_limit = select_stock_limit($_SESSION['branch_id']);
		$query_history = select_history();

		include '../views/layout/home.php';
		get_footer();
	break;

	case 'form_result':

			extract($_POST);
			$i_date = (isset($_POST['i_date'])) ? $_POST['i_date'] : null;
			//$date_url = str_replace(" ","", $i_date);
			$date_default = $i_date;

		header("Location: home.php?page=list&preview=1&date=$date_default");
	break;

	case 'Highcharts':
	$q_journal = select_journal();
	while ($r_journal = mysql_fetch_array($q_journal)) {
			$data[] = array(
				'journal_id' 			=> $r_journal['journal_id'],
				'journal_type_id' => $r_journal['journal_type_id'],
				'journal_date' 		=> $r_journal['s_journal_date'],
				'journal_debit' 	=> $r_journal['penjualan'],
				'journal_credit' 	=> $r_journal['pembelian'],
				'journal_piutang' => $r_journal['journal_piutang'],
				'journal_hutang' => $r_journal['journal_hutang']
			 );
		}
	echo json_encode($data);
	break;


}

?>
