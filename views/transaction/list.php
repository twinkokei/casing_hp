<!-- select2 -->
<script type="text/javascript" src="../select2/dist/js/select2.js"></script>
<!-- end select2 -->
<script type="text/javascript" src="../js/search2/jcfilter.min.js"></script>
<!-- <script>
$("#entersomething").keyup(function(e){
   var code = e.which; // recommended to use e.which, it's normalized across browsers
   alert(code);
   if(code==13)e.preventDefault();
   if(code==32||code==13||code==188||code==186){
       $("#displaysomething").html($(this).val());
   } // missing closing if brace
});
</script> -->
<!-- <script type="text/javascript">
	function filter_cat(){
		alert("test");
	}
	function CurrencyFormat(number)
	{
	   var decimalplaces = 0;
	   var decimalcharacter = "";
	   var thousandseparater = ",";
	   number = parseFloat(number);
	   var sign = number < 0 ? "-" : "";
	   var formatted = new String(number.toFixed(decimalplaces));
	   if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
	   var integer = "";
	   var fraction = "";
	   var strnumber = new String(formatted);
	   var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
	   if( dotpos > -1 )
	   {
	      if( dotpos ) { integer = strnumber.substr(0,dotpos); }
	      fraction = strnumber.substr(dotpos+1);
	   }
	   else { integer = strnumber; }
	   if( integer ) { integer = String(Math.abs(integer)); }
	   while( fraction.length < decimalplaces ) { fraction += "0"; }
	   temparray = new Array();
	   while( integer.length > 3 )
	   {
	      temparray.unshift(integer.substr(-3));
	      integer = integer.substr(0,integer.length-3);
	   }
	   temparray.unshift(integer);
	   integer = temparray.join(thousandseparater);
	   return sign + integer + decimalcharacter + fraction;
	}
	function get_total_price(){
		var total_harga = 0;
		<?php
		while($row2 = mysql_fetch_array($query2)){
		?>
		var jumlah = document.getElementById("i_jumlah_"+<?= $row2['menu_id']?>).value;
		var harga = document.getElementById("i_harga_"+<?= $row2['menu_id']?>).value;

		var total = jumlah * harga;
		total_harga = total_harga + total;
		<?php
		}
		?>
		document.getElementById("i_total_harga").value = total_harga;
		document.getElementById("i_total_harga_rupiah").value = CurrencyFormat(total_harga);
	}

	function confirm_delete_history(id){
		var a = confirm("Anda yakin ingin menghapus order ini ?");
		var table_id = document.getElementById("i_table_id").value;

		if(a==true){
			window.location.href = 'transaction.php?page=delete_history&table_id=' + table_id + '&id=' + id;
		}
	}

	function load_data_history(id)
	{
	}
	</script> -->
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
	<form action="<?= $action ?>" method="POST" enctype="multipart/form-data" role="form">
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
                      <div class="col-md-3">
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
													<input type="text" name="" value="" class="price-tag form-control normal" readonly>
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
	            <button id="" type="submit" class="btn btn-primary">Save</button>
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

