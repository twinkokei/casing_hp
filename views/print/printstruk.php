<?php
require_once '../../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new Dompdf();

$html= '
<html>
	<head>
	<style>
	body{
		font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
		margin-top: 0px;
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
	table#office_header td{
		width: 200px;
		text-align: center;
		font-size: 20px;
	}
	table#lintable th{
		text-align: center;
	}
	.btn_row{
		margin-left:auto;
		margin-right:auto;
	}

	table#lintable,
	table#lintable th,
	table#lintable td {
		border: none;
		border-collapse: collapse;
	}
	table#lintable th,
	table#lintable td {
		border: 1px solid;
	}
	table#lintable th{
		text-align: center;
	}
	</style>

	</head>
		<body>
	      <div class="header" style="font-size:30px;">
	      	<div style="clear:both;"></div>
	      	<b>INVOICE PEMBELIAN</b>
	      </div>
      	  <div class="header"></div>
      	  <br>
      		<table style="float:right;">
		      <tr>
		      	<td>
		      		<tr>
		      			<td>Tanggal</td><td>: '.$r_transaction['transaction_date'].'</td>
		      		</tr>
		      		<tr>
		      			<td>No</td><td>: '.$r_transaction['transaction_code'].'</td>
		      		</tr>
		      	</td>
		      </tr>
		    </table>
			<table>
			<tr>
			<td>Cabang</td><td>: '.$r_transaction['branch_name'].'</td>
			</tr>
			</table>';
    $html .='<table style="float:left;">
    		 <tr>
    	 	 <td>
    		 </td>
    		 </tr>
    		 </table>
    		 <div style="clear:both;"></div>';
  $html .='<div style="clear:both;"></div>
	<table id="lintable" style="width:100%;" style="float:right;">
  	<thead>
  		<tr>
  			<th>Nama Barang</th>
  			<th>Jumlah</th>
  			<th>Harga barang</th>
  			<th>Total</th>
  		</tr>
  	</thead>
  	<tbody>';
  $q_transaction_detail = get_transaction($r_purchases['purchase_id']);
  while ($r_transaction_detail = mysql_fetch_array($q_transaction_detail)) {
	$html .='
  <tr>
    <td style="padding:10px;"> '.$r_transaction_detail['item_name'].'</td>
    <td style="padding:10px;text-align:center;">'.$r_transaction_detail['transaction_detail_qty'].'</td>
    <td style="padding:10px;text-align:center;"> '.format_rupiah($r_transaction_detail['transaction_detail_price']).'</td>
    <td style="text-align:right; padding-right:12px;">'.format_rupiah($r_transaction_detail['transaction_detail_price']*$r_transaction_detail['transaction_detail_qty']).'</td>
  </tr>';}
	$html .= '<tr class="sub_table">
										<td colspan="3" style="text-align:right; border:none; padding-right:55px;">Total</td>
										<td border="1" style="text-align:right; padding-right:12px;">'.format_rupiah($r_purchases_t['purchase_total']).'</td>
									</tr>
									<tr class="sub_table">
										<td colspan="3" style="text-align:right; border:none; padding-right:55px;">Bayar</td>
										<td border="1" style="text-align:right; padding-right:12px;">'.format_rupiah($r_purchases_t['purchase_payment']).'</td>
									</tr>';
                  $q_payment_method=mysql_query("SELECT a.*,b.* FROM transactions a
													JOIN payment_methods b ON b.payment_method_id = a.payment_method_id
													WHERE a.payment_method_id ");

                  			$r_payment_method = mysql_fetch_array($q_payment_method);

                  	$q_bank=mysql_query("select * from banks WHERE bank_id = '".$r_purchases['bank_id']."'");
                  	$r_bank=mysql_fetch_array($q_bank);
                  	$q_bank_to=mysql_query("select * from banks WHERE bank_id = '".$r_purchases['bank_id_to']."'");
                  	$r_bank_to=mysql_fetch_array($q_bank_to);
	$html .='</table>';
	$html .=	'<div style="clear:both;"></div>
		<table style="float:left;">
			<tr>
				<td>
					Tipe Pembayaran
				</td>
				<td>
					:'.$r_payment_method['payment_method_name'].'
				</td>
			</tr>';
			if ($r_purchases['payment_method']>1){
		$html .='<tr>
				<td>
					Dari Bank
				</td>
				<td>
					:'.$r_bank['bank_name']?>//<?= $r_purchases['i_bank_account'].'
				</td>
			</tr>
			<tr>
				<td>
					Menuju Bank
				</td>
				<td>
					:'.$r_bank_to['bank_name']?>//<?= $r_purchases['i_bank_account_to'].'
				</td>
			</tr>';
		}
	$html .='</table>
			<table style="width:100%;padding-top:0;text-align:center;">
			</table>';

$html .='</tbody>';
$html .='</table>';
$html .='</body></html>';
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("pembelian".$r_purchases['purchases_date']);

 ?>