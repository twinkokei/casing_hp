<?php
/*
$outprint = "Just the test printer";
$printer = printer_open("58 Printer(1)");
printer_set_option($printer, PRINTER_MODE, "RAW");
printer_start_doc($printer, "Tes Printer");
printer_start_page($printer);
printer_write($printer, $outprint);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
*/
?>
<style type="text/css">
body{
	font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
}
.frame{
	border:1px solid #000;
	width:10%;
	margin-left:auto;
	margin-right:auto;
	padding:10px;
}
table{
	font-size:14px;

}
.header{
	text-align:center;
	font-weight:bold;
	font-size:11px;

}
.header_img{

	width:164px;
	height:79px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:10px;
}

.back_to_order{
	width:10%;
	margin-left:auto;
	margin-right:auto;
	color:#fff;
	font-weight:bold;
	background:#09F;
	text-align:center;
	border-radius:10px;
	margin-top:10px;
	padding:5px;height:30px;
}
.back_to_order:hover{
	background:#069;
}
@media print {
	.back_to_order{
		display: none;
	}
}
</style>
<body>
<!--<body>-->

<div class="header">
<span style="font-size:14px;">Bakmi Gili</span><br>
Foodcourt Delta lt. 4
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;font-size:12px;">
	<tr>
		<td>N/<?= $row['transaction_code']?></td>
		<td align="right" >cashier: <?= $row['user_name'] ?></td>
	</tr>
	<tr>
		<td align="right" ><?= $row['transaction_date'] ?></td>
		<input type="hidden" id="transaction_code" name="transaction_code" value="<?= $row['transaction_code']?>">
		<input type="hidden" id="branch_id" name="branch_id" value="<?= $row['branch_id']?>">
	</tr>
</table>
<table>
	<tr>
		<?php
		if($row['member_id']!=0){
			$query = mysql_query("select * from members where member_id = ".$row['member_id']);
			$rmember= mysql_fetch_array($query);
		?>
		<td>Nama: <?= $rmember['member_name']?></td>
	</tr>
	<tr>
		<td>Alamat: <?= $rmember['member_alamat']?></td>
	</tr>
	<tr>
		<td>Tlp: <?= $rmember['member_phone']?></td>
	</tr>
	<?php } ?>
</table>
<?php $bank = array('Mandiri', 'BCA', 'BRI');?>
<?php if($row['payment_method_id'] != 1 ){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:5px; font-size:12px;">
  <tr>
    <td>Bank: <?= $bank[$row['bank_id']]?></td>
    <td align="right" >Account Number: <?= $row['bank_account_number'] ?></td>
  </tr>
</table>
<?php }?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding: 0;">
<?php
  $no_item = 1;
  $total_price = 0;

  while($row_item = mysql_fetch_array($query_item)){
  ?>
  <tr>
    <td style="font-size:12px"><?= $row_item['menu_name'] ?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td><?= $row_item['transaction_detail_qty']." x ".number_format($row_item['transaction_detail_price'])?></td>
    <td align="right" style="font-size:12px"><?= number_format($row_item['transaction_detail_total'])?></td>
  </tr>
  <?php
 $no_item++;
 $total_price = $total_price + $row_item['transaction_detail_total'];
  }
 ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; padding: 0">
	<tr>
			<td>Total</td>
			<td align="right"><?= number_format($row['transaction_total'])?></td>
	</tr>
	<?if($row['transaction_discount'] != 0){?>
	  <tr>
			<td>Diskon(<?= number_format($row['transaction_discount'])?>%)</td>
			<td align="right">-<?= number_format($row['transaction_discount']/100*$row['transaction_total'])?></td>
	  </tr>
  <?}
	if($row['transaction_disc_nominal'] != 0){?>
	<tr>
		<td>Diskon Nominal</td>
		<td align="right">-<?= number_format($row['transaction_disc_nominal'])?></td>
	</tr>
	<?}
	if($row['disc_member'] != 0){?>
	<tr>
		<td>Disk. member(<?= $rmember['member_discount']?>)%</td>
		<td align="right">-<?= number_format($row['disc_member'])?></td>
	</tr>
	<?}
		$totalawal  = $row['transaction_total'];
		$totalkedua =	$totalawal;
		$totalkedua=ceil($totalkedua);
		if (substr($totalkedua,-2)!=00){
			if(substr($totalkedua,-2)<50){
				$totalkedua=round($totalkedua,-2)+100;
			}else{
				$totalkedua=round($totalkedua,-2);
			}}?>
  <tr>
    <td style="font-size:16px"><strong>Grand Total</strong></td>
    <td style="font-size:16px" align="right"><strong><?= number_format($row['transaction_grand_total'])?></strong></td>
  </tr>
  <tr>
    <td style="font-size:16px">Bayar</td>
    <td align="right"><?= number_format($row['transaction_payment'])?></td>
  </tr>
  <tr>
    <td><strong>Kembali</strong></td>
    <!-- <td align="right"><strong><?= number_format($row['transaction_payment']-$totalkedua)?></strong></td> -->
		<td align="right"><strong><?= number_format($row['transaction_change'])?></strong></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;">
  <tr>
    <td align="center" style="font-size: 10px;">TERIMA KASIH ATAS KUNJUNGAN ANDA</td>
  </tr>
   <tr>
    <td align="center" style="font-size: 9px;">kritik dan saran</td>
  </tr>
  <tr>
    <td align="center" style="font-size: 9px;">085730311361</td>
  </tr>
  <tr>
    <td align="center" style="font-size: 8px;">- Powered By Jasasoftwaresurabaya.com -</td>
  </tr>
</table>
<a href="transaction_new.php" style="text-decoration:none">
	<div class="back_to_order">Back To Order</div>
</a>
</body>
<script>
var url = "send_data.php?transaction_code=<?= $row['transaction_code'] ?>&branch_id=<?= $row['branch_id']?>&transaction_date=<?= $row['transaction_date']?>";
    window.onload = function(){
         window.open(url, "_blank"); // will open new tab on window.onload
    }
		setTimeout(function(){ print(); }, 500);
</script>
