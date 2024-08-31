<?php
require_once('../functions.php');
include('../lib/tcpdf.php');

$pdf = new TCPDF('p','mm','A4');

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);

$style = array(
    'border' => true,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$pdf->AddPage();

$title = 'Times New Roman';
$txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nec volutpat purus, imperdiet ultricies augue.';
$testNum = '24060119130102';
$testText = 'Dheo Ronaldo Sirait / 24060119130102';
$testLink = 'https://www.google.com/';

$pdf->SetFont('TimesB','',20);
$pdf->Cell(190,10,$title,0,1,'C');

$pdf->SetFont('TimesI','',8);
$pdf->Cell(190,5,$title,0,1,'C');

$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,"NIK",1,"C");
$pdf->Cell(160,5,"Nama Asesor",1,"C");
$pdf->Ln();

$sql = "SELECT nik, nama FROM uji_asesor";
$hasil = $conn->query($sql);   

//Ambil Data
if ($hasil->num_rows > 0) {
    $i = 1;
    while ($row = $hasil->fetch_assoc()) {
        $nik_asesor = $row['nik'];
        $nama_asesor = $row['nama'];

        $pdf->SetFont('Times','',10);
        $pdf->Cell(30,5,$nik_asesor,1);
        $pdf->Cell(160,5,$nama_asesor,1);
        $pdf->Ln();
    }
}

$pdf->write2DBarcode($testText, 'QRCODE,H', 150, 220, 40, 40, $style, 'N');

// $pdf->write2DBarcode($testLink, 'QRCODE,M', 70, 40, 40, 40, $style, 'N');

// $pdf->write2DBarcode($testLink, 'QRCODE,L', 130, 40, 40, 40, $style, 'N');

// $pdf->write1DBarcode($testNum, 'S25+', '', '', '', 18, 0.3861, $style, 'N');

$pdf->AddPage();

$title2 = 'Times New Roman';
$txt2 = 'Times New Roman';

$pdf->setFont('HelveticaB','', 20);
$pdf->Cell(190,10,$title2,0,1,'C');

$pdf->setFont('HelveticaI','',8,);
$pdf->Cell(190,5,$txt2,0,1,'C');



$pdf->Output('LaporanBAP.pdf','I');