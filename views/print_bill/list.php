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
		font-size:10px;

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
	</style>
	<body  onload=print()>
	<!--<body>-->
	<div class="header">
		<span style="font-size:14px;">BAKMI GILI EXPRESS<br>
                    PLAZA SURABAYA<br>FOODCOURT LT. 4
		</span><br>
	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;">
	  <tr>
	    <td><?= $row['table_name']?></td>
	    <td align="right" ><?= $row['transaction_date'] ?></td>
	  </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;">
	<?php
	  $no_item = 1;
	  $total_price = 0;
	 $query1 = mysql_query("select a.*,b.*, c.menu_name
	                from transactions_tmp a
	                join transaction_tmp_details b on b.transaction_id = a.transaction_id
	                join menus c on c.menu_id = b.menu_id
	                where table_id = '".$table_id."'");
	  						while($row_item = mysql_fetch_array($query1)){
	 							$count = count($row_item);
	  					?>
	  				<tr>
	    		<td><?= $row_item['menu_name'] ?></td>
	    	<td align="right">&nbsp;</td>
	  	</tr>
	  	<tr>
	    	<td><?= $row_item['transaction_detail_qty']." x ".number_format($row_item['transaction_detail_price'])?></td>
	    	<td align="right"><?= number_format($row_item['transaction_detail_total'])?></td>
	  	</tr>
			  <?php
			 $no_item++;
			 $total_price = $total_price + $row_item['transaction_detail_total'];
			  }
			 ?>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; padding-top: 5;">
	  <tr>
	    <td style="font-size:12px"><strong>Total</strong></td>
	    <td style="font-size:12px" align="right"><strong><?= number_format($total_price)?></strong></td>
	  </tr>
	</table>
	<a href="order.php" style="text-decoration:none"><div class="back_to_order"></div></a>
