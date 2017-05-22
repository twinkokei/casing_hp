<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/menu_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Item");

$_SESSION['item_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);

		$query = select_config('items', '');
		$add_button = "menu.php?page=form";

		include '../views/menu/list.php';
		get_footer();
	break;

	case 'form':
		get_header();

		$close_button = "menu.php?page=list";
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){
			$where = "WHERE item_id = '$id'";
			$row = select_object_config('items', $where);
			// $query_recipe = select_recipe($id);
			$action = "menu?page=edit&id=$id";
		} else{

			//inisialisasi
			$row = new stdClass();

			$row->item_name = false;
			$row->item_kategori=false;
			$row->item_type_id = false;
			$row->item_original_price = false;
			$row->item_margin_price = false;
			$row->item_price = false;
			$row->item_img = false;
			$action = "menu?page=save";
		}

		include '../views/menu/form.php';
		get_footer();
	break;

	case 'save':

		extract($_POST);
		$i_name = get_isset($i_name);
		$i_item_kategori = get_isset($i_item_kategori);
		$i_item_type_id = get_isset($i_item_type_id);
		$i_original_price = get_isset($i_original_price);
		$i_margin_price = get_isset($i_margin_price);
		$i_price = get_isset($i_price);
		$i_partner_id = get_isset($i_partner_id);
		$i_out_time = get_isset($i_out_time);
		$i_dapur_id = get_isset($i_dapur_id);
		$path = "../img/item/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";

			$data = "'',
					'$i_item_kategori',
					'$i_item_type_id',
					'$i_name',
					'$i_original_price',
					'$i_margin_price',
					'$i_price',
					'$i_img',
					'$i_partner_id',
					'$i_out_time',
					'$i_dapur_id'
					''
			";
				$create=mysql_query("insert into items values(".$data.")");
				if($i_img){
				move_uploaded_file($i_img_tmp, $path.$i_img);
			}
			header("Location: menu?page=list&did=1");
				var_dump($data);


	break;

	case 'save_item':

		extract($_POST);

		$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : null;

		$i_item_id = get_isset($i_item_id);
		$i_item_qty = get_isset($i_item_qty);

			$data = "'',
					'$item_id',
					'$i_item_id',
					'$i_item_qty'
			";

			//echo $data;

			create_item($data);


			header("Location: menu?page=form&id=$item_id");


	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_item_kategori = get_isset($i_item_kategori);
		$i_item_type_id = get_isset($i_item_type_id);
		$i_original_price = get_isset($i_original_price);
		$i_margin_price = get_isset($i_margin_price);
		$i_price = get_isset($i_price);
		$i_partner_id = get_isset($i_partner_id);
		$i_out_time = get_isset($i_out_time);

		$path = "../img/item/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";

			if($i_img){

				if($i_img){
				if(move_uploaded_file($i_img_tmp, $path.$i_img)){
					$get_img_old = get_img_old($id);
					if($get_img_old){
						if(file_exists($path.$get_img_old)){
							unlink($path . $get_img_old);
						}
					}

					$data = " item_name = '$i_name',
							item_type_id = '$i_item_type_id',
							item_original_price = '$i_original_price',
							item_margin_price = '$i_margin_price',
							item_price = '$i_price',
							item_img = '$i_img',
							partner_id = '$i_partner_id',
							out_time = '$i_out_time'

					";
				}
			}

			}else{
				$data = " item_name = '$i_name',
							item_type_id = '$i_item_type_id',
							item_original_price = '$i_original_price',
							item_margin_price = '$i_margin_price',
							item_price = '$i_price',
							partner_id = '$i_partner_id',
							out_time = '$i_out_time'
					";
			}
			update($data, $id);

			header('Location: menu?page=list&did=2');
	break;

	case 'edit_item':
		extract($_POST);
		$id = get_isset($_GET['id']);
		$item_id = get_isset($_GET['item_id']);
		$i_item_id = get_isset($i_item_id);
		$i_item_qty = get_isset($i_item_qty);


			$data = " item_id = '$i_item_id',
								item_qty = '$i_item_qty'";

		$where = "item_id = '$i_item_id'";
		update_config2('items', $data, $where);

		header("Location: menu?page=form&id=$item_id");
	break;

	case 'delete':

		$id = get_isset($_GET['id']);

		$path = "../img/item/";
		$get_img_old = get_img_old($id);
					if($get_img_old){
						if(file_exists($path.$get_img_old)){
							unlink($path . $get_img_old);
						}
					}
		delete($id);

		header('Location: menu?page=list&did=3');

	break;

	case 'delete_item':

		$id = get_isset($_GET['id']);
		$item_id = get_isset($_GET['item_id']);
		$where = "item_id = '$item_id'";
		delete_config('items', $where);
		header("Location: menu?page=form&id=$item_id");

	break;

	case 'item_type';

		$id = $_POST['x'];
		$query = mysql_query("select * from item_types where id_kategori_utama = ".$id);
		while($item_types = mysql_fetch_array($query)){
			$item['data'][] = array(
				'item_type_id' => $item_types['item_type_id'],
				'item_type_name' => $item_types['item_type_name']
			);
		};
		$item['status'] = '200';
		echo json_encode($item);
		break;

}

?>
