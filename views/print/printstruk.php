<?php
require_once '../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new Dompdf();

$html = '<html>';
$html .= '</html>';

$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("pembelian".$r_purchases['purchases_date'], array("Attachment" => false));

 ?>
