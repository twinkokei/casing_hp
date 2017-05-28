<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/jenis_bahan_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("jenis bahan");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);
		
		$query = select();
		$add_button = "jenis_bahan.php?page=form";

		include '../views/jenis_bahan/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "jenis_bahan.php?page=list";

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
		
			$action = "jenis_bahan.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->bahan_name = false;

			$action = "jenis_bahan.php?page=save";
		}

		include '../views/jenis_bahan/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);

		$data = "'',
					'$i_name'
			";
			
			echo $data;

			create($data);
		
			header("Location: jenis_bahan.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		
					$data = " bahan_name = '$i_name'
							";
					
			echo $data;
			update($data, $id);
			
			header('Location: jenis_bahan.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: jenis_bahan.php?page=list&did=3');

	break;
}

?>