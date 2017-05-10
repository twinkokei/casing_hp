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
	//  include'../lib/escpos/autoload.php';
  // require'../lib/escpos/autoload.php';
	// 	use Mike42/Escpos/Printer;
	// 	use Mike42/Escpos/PrintConnectors/WindowsPrintConnector;
		// $connector = new FilePrintConnector("/dev/usb/lp0");
	// 	// $printer = new Printer($connector);
	//
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
	<body>
	<!-- <body> -->
		<div class="header">
			<span style="font-size:14px;">BAKMI GILI EXPRESS<br>
PLAZA SURABAYA<br>FOODCOURT LT. 4</span>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		  <tr>
		    <td><?= "Meja : ". $row['table_name']?></td>

		    <td align="right" ><?= $row['transaction_date'] ?></td>
		  </tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: -10;" >
		<?php
		  $no_item = 1;
		  $total_price = 0;
		  $dapid = "";

		    $query = mysql_query("select a.*, b.menu_name,b.dapur_id, c.* from widget_tmp a
	                            join menus b on b.menu_id = a.menu_id
	                            join menu_types c on c.menu_type_id = b.menu_type_id
	                            where table_id = '$table_id' order by b.dapur_id");
		  while($row = mysql_fetch_array($query)){
				if($dapid != false){
					if($dapid != $row['dapur_id'])
				 {
					 echo "<script>";
					 echo "var winPrint = window.open('', '', 'left=0,top=0,width=800,height=600,toolbar=0,scrollbars=0,status=0');";
					 echo "winPrint.document.write();";
					 echo "winPrint.document.close();";
					 echo "winPrint.focus();";
					 echo "winPrint.print();";
					 echo "winPrint.close();";
					 echo "</script>";
					}
				}
		  ?>
		  <tr>&nbsp;
		    <td><?= $no_item. '. '.$row['menu_name']?></td>
				<input disabled="disable" id="i_menu_name" value="<?= $no_item. '. '.$row['menu_name']?>" type="hidden"/>
				<td align="center"><?=  $row['dapur_id'] ?></td>
				<input disabled="disable" id="i_dapur_id" value="<?=  $row['dapur_id'] ?>" type="hidden"/>
		    <td align="right"><?=  $row['jumlah'] ?></td>
				<input id="i_jumlah" value="<?=  $row['jumlah'] ?>" type="hidden"/>
		  </tr>
			<!-- <div style='page-break-after:always;'>
			</div> -->
		<?php
	        $query_widget_detail = mysql_query("select a.*, b.note_name
	                                from widget_tmp_details a
	                                join notes b on b.note_id = a.note_id
	                                where wt_id = '".$row['wt_id']."'
	                                order by wt_id
	                                ");
	        while($row_widget_detail = mysql_fetch_array($query_widget_detail)){
		      ?>
			      <tr>
			         <td>&nbsp;&nbsp;&nbsp;&nbsp;- <?= $row_widget_detail['note_name']?></td>
			          <td></td>
		      	</tr>
	              <?php
	              }
	              ?>
				<?php
				  // if($dapid != false){
					// 	if($dapid != $row['dapur_id'])
					//  {
					// 		echo "<tr><td>";
					// 	  echo "<hr>";
					// 	  echo "</td></tr>";
					// 	}
					// }
						$dapid = $row['dapur_id'];
						$no_item++;

				  }
		 		?>
		</table>
		<a href="order.php" style="text-decoration:none"><div class="back_to_order"></div></a>

	</body>
	<script>
		var menu_name =getElementById('i_menu_name').value;
		var i_dapur_id =getElementById('i_dapur_id').value;
		var i_jumlah =getElementById('i_jumlah').value;
		$(document).ready(function() {
// $.ajax({
// 		type: 'POST',
// 		url: '../include/ListOfCities.php',
// 		dataType: "json",
// 		data: {
// 				i_menu_name:i_menu_name,
// 				i_dapur_id:i_dapur_id,
// 				i_jumlah:i_jumlah
// 			},
// 		});
	});
	</script>
