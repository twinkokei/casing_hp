<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/purchase_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Pembelian");

$_SESSION['menu_active'] = 7;

switch ($page) {
	case 'list':
		get_header($title);
		
		
		if($_SESSION['user_type_id']==1 || $_SESSION['user_type_id']==2){
			$where_branch = "";
		}else{
			$where_branch = " where a.branch_id = '".$_SESSION['branch_id']."' ";
		}
		
		$query = select($where_branch);
		$add_button = "purchase.php?page=form";

		include '../views/purchase/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "purchase.php?page=list";
		
		$query_supplier = select_supplier();
		$query_item = select_item();
		$query_branch = select_branch();
		$query_merk = select_merk();
		$query_bahan = select_bahan();

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
			$row->purchase_date = format_date($row->purchase_date);
		
			$action = "purchase.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->purchase_date = format_date(date("Y-m-d"));
			$row->item_id = false;
			$row->purchase_price = false;
			$row->purchase_qty = false;
			$row->purchase_total = false;
			$row->supplier_id = false;
			$row->branch_id = false;
			
			$action = "purchase.php?page=save";
		}
			$row->item_name = false;
			$row->item_merk = false;
			$row->harga_beli = false;
			$row->item_price = false;
			$row->item_bahan = false;

		include '../views/purchase/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		
		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		$i_item_id = get_isset($i_item_id);
		$i_harga = get_isset($i_harga);
		$i_qty = get_isset($i_qty);
		$i_total = get_isset($i_total);
		$i_supplier = get_isset($i_supplier);
		$i_branch_id = get_isset($i_branch_id);
		
		$get_item_name = get_item_name($i_item_id);
		
		$data = "'',
					'$i_date', 
					'$i_item_id', 
					'$i_qty',
					'$i_harga',
					'$i_total',
					'$i_supplier',
					'$i_branch_id'
			";
			
			//echo $data;

			create($data);
			$data_id = mysql_insert_id();
			
			// simpan jurnal
			create_journal($data_id, "purchase.php?page=form&id=", 2, $i_harga, $get_item_name, '', $i_branch_id);
			
			add_stock($i_item_id, $i_branch_id, $i_qty);
		
			header("Location: purchase.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		
		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		$i_item_id = get_isset($i_item_id);
		$i_harga = get_isset($i_harga);
		$i_qty = get_isset($i_qty);
		$i_total = get_isset($i_total);
		$i_supplier = get_isset($i_supplier);
		$i_branch_id = get_isset($i_branch_id);
		
					$data = "purchase_date = '$i_date',
							 item_id = '$i_item_id', 
							 purchase_qty = '$i_qty',
							 purchase_price = '$i_harga',
							 purchase_total = '$i_total',
							 supplier_id = '$i_supplier',
							 branch_id = '$i_branch_id'

					";
			
			update($data, $id);
			
			header('Location: purchase.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: purchase.php?page=list&did=3');

	break;

	case 'save_add_item':

	extract($_POST);

    	$i_name = get_isset($i_name);
		$i_merk = get_isset($i_merk);
		$i_beli = get_isset($i_beli);
		$i_jual = get_isset($i_jual);
		$i_bahan = get_isset($i_bahan);

		$data_s = "'',
					'$i_name',
					'$i_merk',
					'$i_beli',
					'$i_jual',
					'$i_bahan'
			";
    	create_config('items',$data_s);
    	// var_dump($_POST);
    	echo $data_s;
    header('location: purchase.php?page=form&id=');
	break;
}

?>