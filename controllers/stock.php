<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/stock_model.php';

$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Item Stock");

$_SESSION['menu_active'] = 8;

switch ($page) {
	case 'list':
		get_header($title);
		
                if($_SESSION['user_type_id']==1 || $_SESSION['user_type_id']==3){
                    $query = select();
                    $where_branch = "";
                    $q_branch = select_branch($where_branch);
                    $add_button = "stock.php?page=form";
                    include '../views/stock/list_admin.php';
                    
                }elseif($_SESSION['user_type_id']==2 || $_SESSION['user_type_id']==4){
                    $query = select();
                    $where_branch = "";
                    $q_branch = select_branch($where_branch);
                    
                    $where_branch = " where branch_id = '".$_SESSION['branch_id']."' ";
                    $add_button = "stock.php?page=form";
                    include '../views/stock/list.php';
                }  else {
                    $add_button = "stock.php?page=form";
                    include '../views/stock/list.php';
                }
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "stock.php?page=list";
		
		$query_merk = select_merk();
		

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
			
			$action = "stock.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->item_name = false;
			$row->item_merk = false;
			$row->item_limit = false;
			
			
			$action = "stock.php?page=save";
		}

		include '../views/stock/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);
		$i_merk_id = get_isset($i_merk_id);
		$i_item_limit = get_isset($i_item_limit);
		
		
		$data = "'',
					'$i_name',
					'$i_merk_id',
					'$i_item_limit'
			";
			
			echo $data;

			// create($data);
		
			// header("Location: stock.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);
		
		$id = get_isset($_GET['id']);
		
		$i_name = get_isset($i_name);
		$i_merk_id = get_isset($i_merk_id);
		$i_item_limit = get_isset($i_item_limit);
	
		
					$data = "
					item_name = '$i_name',
					item_merk = '$i_merk_id',
					item_limit = '$i_item_limit'

					";
			
			update($data, $id);
			// echo($data);			
			header('Location: stock.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: stock.php?page=list&did=3');

	break;
}

?>