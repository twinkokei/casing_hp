<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/print_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucwords("Pembayaran");

$_SESSION['table_active'] = 1;

switch ($page) {
	case 'list':

		$transaction_id = get_isset($_GET['transaction_id']);
		//var_dump($transaction_id);
		$query = select($transaction_id);
		//$row_member = select_member($query);
		$row = mysql_fetch_array($query);
		$query_item = select_item($transaction_id);;
		include '../views/print/list.php';

	break;
	case 'bydate':
		$date 	= explode("-", $_GET["date"]);
		$date1 	= $date[0];
		$date2 	= $date[1];
		$date1 	= str_replace("/","-", $date1);
		$date2 	= str_replace("/","-", $date2);

		$query 	= selectbydate($date1, $date2);

		include '../views/print/listreport.php';
	break;

	case 'excelreport':
		$date 	= explode("-", $_GET["date"]);
		$date1 	= $date[0];
		$date2 	= $date[1];
		$date1 	= str_replace("/","-", $date1);
		$date2 	= str_replace("/","-", $date2);

		$query 	= selectbydate($date1, $date2);
		include '../views/print/exceldownload.php';
	break;

	case 'excelreportmenu':
		$date 	= explode("-", $_GET["date"]);
		$date1 	= $date[0];
		$date2 	= $date[1];
		$date1 	= str_replace("/","-", $date1);
		$date2 	= str_replace("/","-", $date2);
		$query 	= selectmenubydate($date1, $date2);
		include '../views/print/excelmenudownload.php';
	break;

	case 'printdapurid':
		echo "ok";
	break;

        case 'graph':
                $date 	= explode("-", $_GET["date"]);
		$date1 	= $date[0];
		$date2 	= $date[1];
		$date1 	= str_replace("/","-", $date1);
		$date2 	= str_replace("/","-", $date2);

		$query 	= selectmenubydate($date1, $date2);
		echo "<pre>";
                echo $date1;
                echo $date2;
                echo "</pre>";
                exit();
                include '../views/print/excelmenudownload.php';
        break;

		case 'printstruk':
		// echo "string";
			$transaction_id = $_GET['id'];
			$query = select($transaction_id);
			$row = mysql_fetch_array($query);
			$q_transaction = select_transactionall($transaction_id);
			$r_transaction = mysql_fetch_array($q_transaction);

			// $dompdf->loadHtml('hello world');
			// include '../views/print/printstruk.php';
			break;

}

?>
