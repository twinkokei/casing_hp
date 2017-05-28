<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/item_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("item");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);
		
		$query = select();
		$add_button = "item.php?page=form";

		include '../views/item/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "item.php?page=list";
		$query_merk = select_merk();
		$query_bahan = select_bahan();

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
			$action = "item.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->item_name = false;
			$row->item_merk = false;
			$row->harga_beli = false;
			$row->item_price = false;
			$row->item_bahan = false;
			$row->harga_reseller = false;
			

			$action = "item.php?page=save";
		}

		include '../views/item/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);
		$i_merk = get_isset($i_merk);
		$i_beli = get_isset($i_beli);
		$i_jual = get_isset($i_jual);
		$i_reseller = get_isset($i_reseller);
		$i_bahan = get_isset($i_bahan);

		$data = "'',
					'$i_name',
					'$i_merk',
					'$i_beli',
					'$i_jual',
					'$i_reseller',
					'$i_bahan'
			";
			
			echo $data;

			create($data);
		
			header("Location: item.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_merk = get_isset($i_merk);
		$i_beli = get_isset($i_beli);
		$i_jual = get_isset($i_jual);
		$i_reseller = get_isset($i_reseller);
		$i_bahan = get_isset($i_bahan);
		
					$data = " item_name = '$i_name',
							  item_merk = '$i_merk',
							  harga_beli = '$i_beli',
							  item_price = '$i_jual',
							  harga_reseller = '$i_reseller',
							  item_bahan = '$i_bahan'
							";
					
			echo $data;
			update($data, $id);
			
			header('Location: item.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: item.php?page=list&did=3');

	break;
}

?>