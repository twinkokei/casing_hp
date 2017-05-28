<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/merk_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("merk");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);
		
		$query = select();
		$add_button = "merk.php?page=form";

		include '../views/merk/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "merk.php?page=list";

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
		
			$action = "merk.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->merk_name = false;

			$action = "merk.php?page=save";
		}

		include '../views/merk/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);

		$data = "'',
					'$i_name'
			";
			
			//echo $data;

			create($data);
		
			header("Location: merk.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		
					$data = " merk_name = '$i_name'
					";
					
			echo $data;
			update($data, $id);
			
			header('Location: merk.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: merk.php?page=list&did=3');

	break;
}

?>