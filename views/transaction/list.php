<link href="../css/transaction.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../js/search2/jcfilter.min.js"></script>
	<?php
	if(isset($_GET['did']) && $_GET['did'] == 1){
		?>
		<section class="content_new">
			<div class="alert alert-info alert-dismissable">
				<i class="fa fa-check"></i>
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<b>Sukses !</b>
				Simpan Berhasil
			</div>
		</section>
		<?php
	}else if(isset($_GET['err']) && $_GET['err'] == 1){
		?>
		<section class="content_new">
			<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-check"></i>
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<b>Simpan Gagal !</b>
				Menu masih kosong, Pilih menu terlebih dahulu !
			</div>
		</section>
		<?php
	}
	?>
	<form id="formpenjual"  action="<?= $action ?>" method="POST" enctype="multipart/form-data" role="form">
		<!-- Main content -->
		<section class="content" style="padding-top: 0">
			<div class="col-md-12">
                    </br>
                    <div class="box box-cokelat">
						<div class="box-body">
							<div class="container">
								<!-- Top Navigation -->

									<div class="row">
										<div class="">
											<div class="col-md-3">
												<div class="form-group">
													<input type="hidden" id="transaction_id" name="transaction_id" value="<?= $transaction_id?>"/>
													<label>Date </label>
													<div class="input-group">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" required class="form-control pull-right normal"
													id="date_picker1" name="i_date" value="<?= $date ?>"/>
												</div><!-- /.input group -->
												</div>
											</div>
                      <div class="col-md-3" style="display: none;">
                        <div class="form-group">
                          <label>Order Type </label>
                          <select name="i_tot_id[]" id="i_tot_id" class="selectpicker show-tick form-control" data-live-search="true" onchange="order_member()">
                            <?php
                            $qotype = mysql_query("select tot_id from transactions_tmp where table_id = '".$_GET['table_id']."'");
                            $typ = mysql_fetch_array($qotype);
                            $type = "";
                            if(count($typ)>0){
                              $type= $typ['tot_id'];
                            }
                            if ($_SESSION['type_id']) {
                              $type = $_SESSION['type_id'];
                            }
                            $query_tot = mysql_query("select * from transaction_order_types");
                            while($row_tot = mysql_fetch_array($query_tot)){
                              ?>
                              <option value="<?= $row_tot['tot_id']?>" <?php if($type == $row_tot['tot_id']){echo "Selected";} ?>>
                                <?= $row_tot['tot_name']; ?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
  										<div class="col-md-3">
  										  <div class="form-group">
  											<label>Member</label>
                        <select id="i_member" name="i_member" size="1" class="selectpicker show-tick form-control"
                        data-live-search="true">
                        <option value="0"></option>
                        <?php
                        while($r_member = mysql_fetch_array($query_member)){
                         ?>
                         <option value="<?= $r_member['member_id']?>"><?= $r_member['member_name']?>
                         </option>
                         <?}?>
                        </select>
  											</div>
  										</div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Cabang</label>
                          <select id="i_branch_id" name="i_branch_id" size="1" class="selectpicker show-tick form-control" data-live-search="true">
                          <?php
                          while($r_branch = mysql_fetch_array($query_branch)){
                            $branch_id = '';
                            if ($_SESSION['branch_id']) { $branch_id=$_SESSION['branch_id']; }?>
                            <option value="<?= $r_branch['branch_id'] ?>"
                            <?php if($branch_id==$r_branch['branch_id']){echo "selected";}?>>
                              <?= $r_branch['branch_name']?>
                            </option>
                          <?}?>
                          </select>
                        </div>
                      </div>
  									</div>
									</div>
							<div class="row">
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<input type="text" id="search" class="form-control input-sm normal" placeholder="Cari produk">
											<span class="input-group-btn">
												<button class="btn btn-default btn-sm" type="button">
													<i class="fa fa-search"></i>
												</button>
											</span>
										 </div><!-- /input-group -->
									</div>
									<div class="col-md-6">
										<div class="">
													<input type="text" name="" value="" id="total_allcurr" class="price-tag form-control normal" style="text-align: right;" readonly>
													<input type="hidden" name="" value="" id="total_all" class="price-tag form-control normal">
												</div><!-- /input-group -->
									</div>
								</div>
								<div class="col-md-6">
										<div id="" class="panel panel-default panel-item">
											<div class="row">
											<table id="table_item" class="table my-item" style="font-size: 12px;">
		                      <thead>
		                        <tr>
								 								<th width="5%">No.</th>
		                          	<th width="50%">NAMA ITEM</th>
		                          	<th class="text-right">HARGA</th>
		                          	<th class="text-center"><i class="fa fa-th"></i></th>
		                        </tr>
		                      </thead>
		                      <tbody class="" id="data_items" class="scrollable">

		                      </tbody>
		                    </table>
										</div>
									</div>
								</div>
									<div class="col-md-6">
										<div class="panel panel-default panel-item">
										<table class="table my-item">
											<thead>
												<tr>
													<th class="text-center" style="width:10%;">QTY</th>
													<th width="40%">ITEM</th>
													<th style="">HARGA</th>
													<th class="text-center hide" id="sales-column-discount">DISC</th>
													<th class="text-right">TOTAL</th>
													<th width="13%" class="text-center"><i class="fa fa-th"></i></th>
												</tr>
											</thead>
											<tbody id="tbody_sales_cart">

											</tbody>
										</table>
									</div>
								</div>
							</div> <!-- row -->
					<div class="box-footer" style="background-color: #fff; border-color:#ddd;">
	            <button id="btn-bayar" type="button" class="btn btn-primary">Bayar</button>
	            <a href="<?= $close_button?>">
								<button type="button" name="button" class="btn btn-danger" >
									Close
								</button>
							</a>
	        </div>
							</div> <!-- container -->
						</div> <!-- box-body -->
					</div> <!-- box-cokelat -->
				</div> <!-- table -->
			</div> <!-- row -->
</section>
<script type="text/javascript">
var items = [];
var html = '';
var add_item_list = [];
var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));

if (!storage_item_detail) {
		storage_item_detail = [];
		localStorage.setItem('item_detail', JSON.stringify(storage_item_detail));
}

	function set_harga() {
		var i_pijat = $('#i_pijat').val();
		var harga = $('#i_pijat option:selected').data('harga')||0;
		$('#grand_total').val(harga)||0;
		$('#grand_total_currency').val(toRp(harga))||0;
	}

	$('body').on('click', '.btn-add-cart', function (e) {
      $.fn.addCart($(this));
      e.preventDefault();
  });


$(document).ready(function(){

	set_harga();

	$.fn.getItems = function(){
		$.get("transaction.php?page=get_items",function(data){
						var no = 1;
						$.each(JSON.parse(data), function (index, value) {
								items.push(value);
								html += '<tr>\
													<td style="text-align:center;">'+no+'</td>\
													<td id="item-name">'+value.item_name+'\
													<td class="text-right">'+toRp(value.item_price)+'</td><td class="text-center">\
														<button data-disc="" data-price="'+value.item_price+'" \
														data-qty="1" data-name="'+value.item_name+'" \
														data-id="'+value.item_id+'" data-has-promo=""\
														data-status-aktif="'+value.status_id+'"\
														data-promo-item-name="" data-promo-gratis="" data-promo-qty="" \
														class="btn btn-success btn-xs btn-add-cart">\
															<i class="fa fa-plus"></i>\
														</button>\
													</td>\
												</tr>';
									no++;
								});

						$("#data_items").html(html);
				}).fail(function(data){
							alert(data);
					});
	}

	$.fn.addCart = function(btn){

		var this_name 			= btn.attr('data-name');
    var this_id 				= parseInt(btn.attr('data-id'));
		var this_harga_jual = btn.attr('data-price');
		var this_status 		= btn.attr('data-status-aktif');

		var this_qty = 1;
		var item_exist = 0;
		var item_exist_index = -1;

			if (add_item_list) {
				$.each(add_item_list, function (index, value) {
								if (value.item_id == this_id) {
										item_exist = 1;
										item_exist_index = index;
										this_qty = this_qty + value.item_qty;
								}
						});
			}

			if (item_exist) add_item_list.splice(item_exist_index, 1);

			var new_item_detail = {
							'item_name'		: this_name,
							'item_id'		: this_id,
							'item_price'	: this_harga_jual,
							'item_qty'		: this_qty,
							'item_status'	: this_status
					};


			add_item_list.push(new_item_detail);
			localStorage.setItem('item_detail', JSON.stringify(add_item_list));
			$.fn.refreshChart();

	}


		$("body").on("click", ".removeCart", function (event) {
				var item_id 		= $(this).attr('data-id');
				var bapak 			= $(this).parent();
				var mbah				= bapak.parent();
				var mbahembah		= mbah.parent();
				var item_index 	= mbahembah.index();

				$.each(add_item_list, function (index, value) {
							if (value.item_id == item_id) {
									add_item_list.splice(index, 1);
									return false;
							}
					});
					localStorage.setItem('item_detail', JSON.stringify(add_item_list));
					$.fn.refreshChart();
		});



	$.fn.refreshChart = function () {
					storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));

					var html = '';
					var html_struk = '';
					var input_sales_detail = '';
					var intSubTotal = 0;
					var total_item = 0;
					var total_item_qty = 0;
					var total_all = 0;
					var item_total  = 0;
					var item_name = 0
					var item_id = 0;
					var item_price = 0;
					var item_qty = 0;
					var item_status = 0;

					$("#tbody_sales_cart").empty();
					$.each(storage_item_detail, function (index, value) {
							item_name 	= value.item_name;
							item_id 		= value.item_id;
							item_price 	= value.item_price;
							item_qty 		= value.item_qty;
							item_status = value.item_status;
							item_total 	= item_qty * item_price;

							intSubTotal += item_total;
							var itemPrice = Intl.NumberFormat().format(item_price);
							var itemTotal = Intl.NumberFormat().format(item_total);

							html += '<tr>';
							html += '<td class="text-center">';
							html += '<div class="input-group input-group-sm">';
							html += '<span class="input-group-btn">';
							html += '<button data-id="" class="btn btn-danger btn-sm btn-decrease-cart" type="button"><i class="fa fa-minus"></i></button>';
							html += '</span>';
							html += '<input type="text"  style="text-align:center;width:80px;" class="form-control input-sm qty" value="' + item_qty + '">';
							html += '<span class="input-group-btn">';
							html += '<button data-id="" class="btn btn-success btn-sm btn-increase-cart" type="button"><i class="fa fa-plus"></i></button>';
							html += '</span>';
							html += '</div>';
							html += '</td>';
							html += '<td>' + item_name;
							html += '</td>';
							html += '<td class="text-right">'+itemPrice+'</td>';
							html += '<td class="text-right">'+itemTotal+'</td>';
							html += '<td style="text-align: right;">' +
											'<div class="btn-group">' +
											'<button type="button" data-id="'+item_id+'" class="btn btn-danger removeCart"><i class="fa fa-trash-o"></i></button>'+
											'</div>' +
											'</td>';
							html += '</tr>';
							$("#tbody_sales_cart").html(html);
			});

			var intSubTotalcur = Intl.NumberFormat().format(intSubTotal);

			$('#total_allcurr').val(intSubTotalcur);
			$('#total_all').val(intSubTotal);
		};

		$('#search').keyup(function(){
			var word = $(this).val();
			var this_data = '';
			word = word.toLowerCase();

			var search_data = [];

			  $.each(items, function (index, value) {
					var name = value.item_name.toLowerCase();

					if( name.indexOf(word) > -1){
						this_data = {
                        'item_id'		: value.item_id,
                        'item_name' : value.item_name,
												'item_price' : value.item_price
												// 'item_status'			: value.item_status
                    }

						search_data.push(this_data);
						// console.log(search_data);
					}
				});
				var no =1;
				var html = '';
				// $("#data_items").empty();
				$("#data_items").html(html);
				$.each(search_data, function (index, value) {
				// 	// var item_name  = value.item_name;
						html += '<tr>\
											<td style="text-align:center;">'+no+'</td>\
											<td id="item-name">'+value.item_name+'\
											<td class="text-right">'+toRp(value.item_price)+'</td><td class="text-center">\
												<button data-disc="" data-price="'+value.item_price+'" \
												data-qty="1" data-name="'+value.item_name+'" \
												data-id="'+value.item_id+'" data-has-promo=""\
												data-status-aktif="'+value.status_id+'"\
												data-promo-item-name="" data-promo-gratis="" data-promo-qty="" \
												class="btn btn-success btn-xs btn-add-cart">\
													<i class="fa fa-plus"></i>\
												</button>\
											</td>\
										</tr>';
							no++;
				// 			// console.log(value.item_price);
						});
						$("#data_items").html(html);

		});

	$("body").on("click", ".btn-decrease-cart", function (event) {
			var qty = $(this).parent().parent().find("input:text");
			var value = qty.val();
			var value = parseInt(value);
      if (value > 1) {
          var item_row = $(this).parent().parent().parent().parent();
          var item_index = item_row.index();
          var this_name = '';
          var this_id = 0;
          var this_price = 0;
          var this_qty = 0;
          var this_total = 0;
          var item_exist = 0;
          var item_exist_index = -1;
          if (add_item_list) {
              $.each(add_item_list, function (index, value) {
                  if (item_index == index) {
                      var qty = value.item_qty - 1;
                      this_name = value.item_name;
                      this_id = value.item_id;
                      this_price = value.item_price;
											this_qty = qty;
                      this_total = value.item_total * this_qty;
                      item_exist = 1;
                      item_exist_index = index;
                  }
              });
          }
  		}
			var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                };
			add_item_list[item_exist_index] = new_data;
			localStorage.setItem('item_detail', JSON.stringify(add_item_list));
			// console.log(add_item_list);
			$.fn.refreshChart();
      event.preventDefault();
	});

	$("body").on("click", ".btn-increase-cart", function (event) {
		var qty = $(this).parent().parent().find("input:text");
		var value = qty.val();
		var value = parseInt(value);

				var item_row = $(this).parent().parent().parent().parent();
				var item_index = item_row.index();
				var this_name = '';
				var this_id = 0;
				var this_price = 0;
				var this_qty = 0;
				var this_total = 0;
				var item_exist = 0;
				var item_exist_index = -1;
				if (add_item_list) {
						$.each(add_item_list, function (index, value) {
								if (item_index == index) {
										var qty = value.item_qty + 1;
										this_name = value.item_name;
										this_id = value.item_id;
										this_price = value.item_price;
										this_qty = qty;
										this_total = value.item_total * this_qty;
										item_exist = 1;
										item_exist_index = index;
								}
						});
				}

		var new_data = {
									'item_name': this_name,
									'item_id': this_id,
									'item_price': this_price,
									'item_qty': this_qty,
							};
		add_item_list[item_exist_index] = new_data;
		localStorage.setItem('item_detail', JSON.stringify(add_item_list));
		// console.log(add_item_list);
		$.fn.refreshChart();
		event.preventDefault();
	});

	$("#btn-bayar").on('click', function(e) {
			storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
			var order_detail = JSON.parse(localStorage.getItem('order_detail'));
			var itemid = [];
			var itemprice = [];
			var itemqty = [];
			var order = [];
			var total_all = $('#total_all').val();
			var member_id = $('#i_member').val();
			var branch_id = $('#i_branch_id').val();
			var date_picker1 = $('#date_picker1').val();

			$.each(storage_item_detail, function(index, value){
					itemid.push(value.item_id);
					itemprice.push(value.item_price);
					itemqty.push(value.item_qty);
			});
			var data = {
				itemid : itemid,
				itemqty: itemqty,
				total_all : total_all,
				member_id : member_id,
				branch_id : branch_id,
				date_picker1:date_picker1
			}
			order.push(data);
			localStorage.setItem('order_detail', JSON.stringify(order));
			
			getmodal('#medium_modal', 'transaction.php?page=bayar_popmodal&date_picker1='+date_picker1+'&member_id='+member_id+'&branch_id='+branch_id+'&total_all='+total_all);
	    e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	$.fn.getItems();
});

function getmodal(modalid, url){
	$(modalid).modal('show').find('.modal-content').load(url);
}

// function removeCart(elem)
// {
// 	var item_id			=	 $(elem).attr('data-id');
// 	var bapak 			= elem.parentElement;
// 	var mbah				= bapak.parentElement;
// 	var mbahembah		= mbah.parentElement;
// 	var itemdelete	= '';
// 	var row					= '';
//
// 	storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
// 	for (var i = 0; i < storage_item_detail.length; i++) {
// 		itemdelete = storage_item_detail[i].item_id;
// 		if (itemdelete==item_id) {
// 			storage_item_detail[i].remove;
// 			row = i;
//
// 			break;
// 		}
// 	}
// 	mbahembah.remove();
// 	storage_item_detail.splice(row, 1);
// 	localStorage.setItem('item_detail', JSON.stringify(storage_item_detail));
// }
// this.parentElement.style.display = 'none';
</script>
