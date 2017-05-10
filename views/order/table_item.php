
<div class="table_total_item">

<?php
$q_t = mysql_query("select table_name from tables where table_id = '".$row['table_id']."'");
$r_t = mysql_fetch_array($q_t);
echo "No Meja : ".$r_t['table_name'];
$q_c_t = mysql_query("select b.table_name
						from table_mergers a
						join tables b on b.table_id = a.table_id
						where table_parent_id = '".$row['table_id']."'");
$i = 1;
$merged = "";
while($r_c_t = mysql_fetch_array($q_c_t)){
  if($i == 1){
    if($r_c_t['table_name']){ echo " ("; }
  }
  $merged .= $r_c_t['table_name'].",";
$i++;
}
echo substr($merged,0, -1);
if($i > 1){ echo ")"; }
?>
</div>
<span class="tooltip-text2 scrollpanel no4 content hide-on-mobile">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table_item" style="margin-right:10px;">
 <thead>
 <tr>
    <td align="center">No</td>
    <td>Menu</td>
    <td align="right">Qty</td>
    <td align="right">Harga</td>
    <td align="right">Jumlah</td>
  </tr>
  </thead>
  <?php
  $no_item = 1;
  $total_price = 0;
  $query_item = mysql_query("select a.transaction_date, b.*, c.menu_name, c.dapur_id, c.out_time
							  from transactions_tmp a
							  join transaction_tmp_details b on b.transaction_id = a.transaction_id
							  join menus c on c.menu_id = b.menu_id
							  where table_id = '".$row['table_id']."'");
  while($row_item = mysql_fetch_array($query_item)){
			  	$now =  strtotime(date("Y-m-d H:i:s"))."<br>";
			  	$minute = $row_item['out_time'];
        	$out_time = strtotime('+'.$minute.' minutes', strtotime($row_item['transaction_date'])); ?>
	<tr>
    <td align="center" valign="top"><?= $no_item ?></td>
    <td valign="top"><?= $row_item['menu_name'] ?></td>
    <td align="right" valign="top"><?= $row_item['transaction_detail_qty'] ?></td>
    <td align="right" valign="top"><?= $row_item['transaction_detail_grand_price'] ?></td>
    <td align="right" valign="top"><?= $row_item['transaction_detail_total'] ?></td>
    <td align="right" valign="top"></td>
  </tr>
 <?php
 $no_item++;
 $total_price = $total_price + $row_item['transaction_detail_total'];
  }
 ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_total_item">
  <tr>
    <td>TOTAL</td>
    <td align="right"><?= $total_price ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><a href="transaction_new.php?page=list&table_id=<?= $row['table_id']?>" style="text-decoration:none;"><div class="btn_edit_item">EDIT </div></a></td>
    <td width="20%">
    <a href="payment.php?table_id=<?= $row['table_id']?>&building_id=<?= $building_id?>" style="text-decoration:none;"><div class="btn_payment">BAYAR</div></a>
    </td>
    <td width="20%">
    <a href="#" onclick="javascript: cancel_order(<?= $row['table_id']?>)"><div class="btn_cancel">CANCEL</div></a>
    </td>
    <td width="20%">
    	<a href="print_order.php?table_id=<?= $row['table_id']?>&building_id=<?= $building_id?>" style="text-decoration:none;"><div class="btn_print">PRINT</div></a>
		</td>
		<td width="20%">
			<!-- <a href="#" id="i_table_switch"><div class="btn-switch">SWITCH</div></a> -->
			<a href="#" onclick="table_switch()"><div class="btn-switch">SWITCH</div></a>
		</td>
  </tr>
</table>
	<div class="test" style="display:none;">
		<form action="<?= $action2 ?>" method="POST" enctype="multipart/form-data" role="form">
				<input type="hidden" value="<?= $row['table_id']?>" id="i_table" name="i_table"/>
				<label><legend>Pindah Meja :</legend></label>
				<select name="i_table_id" id="i_table_id" class="selectpicker show-tick form-control" data-live-search="true">
					<?php
					$query_table = mysql_query("select a.*, b.building_name
					from tables a
					left join buildings b on b.building_id = a.building_id
					where tms_id <> '2'
					order by building_id, table_name
					");
					while($row_table = mysql_fetch_array($query_table)){
						?>
						<option value="<?= $row_table['table_id']?>" <?php if($row_table['table_id'] == $row['table_id']){ ?> selected="selected"<?php }?>><?php
						if($row_table['table_id'] != 0){
							$building = " (".$row_table['building_name'].")";
						}else{
							$building= "";
						}
						echo $row_table['table_name'].$building; ?></option>
						<?php } ?>
				</select>
			<br>
			<div class="col-xs-4">
				<div class="form-group">
					<input class="btn btn-danger button_checkout" type="submit" value="SAVE"/>
				</div>
			</div>
		</form>
	</div>
</span>
<!-- on mobile -->
<span class="tooltip-text show-on-mobile">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table_item" style="margin-right:10px;">
 <thead>
 <tr>
    <td align="center">No</td>
    <td>Menu</td>
    <td align="right">Qty</td>
    <td align="right">Harga</td>
    <td align="right">Jumlah</td>
  </tr>
  </thead>
  <?php
  $no_item = 1;
  $total_price = 0;
  $query_item = mysql_query("select a.transaction_date, b.*, c.menu_name, c.dapur_id, c.out_time
							  from transactions_tmp a
							  join transaction_tmp_details b on b.transaction_id = a.transaction_id
							  join menus c on c.menu_id = b.menu_id
							  where table_id = '".$row['table_id']."'");
  while($row_item = mysql_fetch_array($query_item)){
			  	$now =  strtotime(date("Y-m-d H:i:s"))."<br>";
			  	$minute = $row_item['out_time'];
        	$out_time = strtotime('+'.$minute.' minutes', strtotime($row_item['transaction_date'])); ?>
	<tr>
    <td align="center" valign="top"><?= $no_item ?></td>
    <td valign="top"><?= $row_item['menu_name'] ?></td>
    <td align="right" valign="top"><?= $row_item['transaction_detail_qty'] ?></td>
    <td align="right" valign="top"><?= $row_item['transaction_detail_grand_price'] ?></td>
    <td align="right" valign="top"><?= $row_item['transaction_detail_total'] ?></td>
    <td align="right" valign="top">
   </td>
  </tr>
 <?php
 $no_item++;
 $total_price = $total_price + $row_item['transaction_detail_total'];
  }
 ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_total_item">
  <tr>
    <td>TOTAL</td>
    <td align="right"><?= $total_price ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%"><a href="transaction_new.php?page=list&table_id=<?= $row['table_id']?>" style="text-decoration:none;"><div class="btn_edit_item">EDIT </div></a></td>
    <td width="25%">
    <a href="payment.php?table_id=<?= $row['table_id']?>&building_id=<?= $building_id?>" style="text-decoration:none;"><div class="btn_payment">BAYAR</div></a>
    </td>
    <td width="25%">
    <a href="#" onclick="javascript: cancel_order(<?= $row['table_id']?>)"><div class="btn_cancel">CANCEL</div></a>
    </td>
  </tr>
</table>
</span>
<!-- popmodal for table transfer -->
<script type="text/javascript">
	function table_switch(){
	// document.getElementByClassName('switch').style.display = 'block';
	var x = document.getElementsByClassName("test");
	for(var i = 0; i < x.length; i++) {
    	x[i].style.display = "block";}
	}
</script>
