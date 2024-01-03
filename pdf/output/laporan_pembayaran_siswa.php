<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include "../../koneksi.php";
//  ============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
// laporan_peserta_didik.php
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group html
 * @group rtl
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Aline Syahfitri');
$pdf->setTitle('Laporan Pembayaran Siswa');
$pdf->setSubject('Pembayaran Siswa');
$pdf->setKeywords('SIP,Pembayaran Siswa');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'SIP 1.0', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

$tanggal_awal=$_GET['tanggal_awal'];
$tanggal_akhir=$_GET['tanggal_akhir'];
$id_siswa=$_GET['id_siswa'];
// create some HTML content
$html = '
<p align="center"><strong><bold>Laporan Pembayaran Siswa</strong></b></p><br>
<b>Periode : '.date('d-F-Y',strtotime($tanggal_awal)). ' S/D '. date('d-F-Y',strtotime($tanggal_akhir)).'</b><br><br>
<table style="width:100%; border-collapse:collapse; border: 1px solid black;" border="1">
    <tr style="font-weight:bold; text-align:center;">
        <td style="width:5%;">No</td>
        <td style="width:5%;">NIS</td>
        <td style="width:25%;">Nama</td>
        <td style="width:15%;">Kelas</td>
        <td style="width:15%;">Tanggal Pembayaran</td>
        <td style="width:15%;">Status</td> 
        <td style="width:20%;">Nominal Pembayaran</td> 
    </tr>

';

$sql="SELECT bayar.*,siswa.nis,siswa.nama,siswa.kelas,bayar_metode.metode FROM bayar,siswa,bayar_metode WHERE bayar.dihapus_pada IS NULL AND bayar.id_siswa=siswa.id_siswa AND bayar.id_bayar_metode=bayar_metode.id_bayar_metode AND bayar.tanggal_bayar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'AND bayar.id_siswa=$id_siswa ORDER BY bayar.tanggal_bayar ASC";
$query=mysqli_query($koneksi,$sql);
$no=0;
$total=0;
while($bayar=mysqli_fetch_array($query)){
    $no++;
    $total=$total+$bayar['nominal_bayar'];
    $html.='
    <tr>
        <td>'.$no.'</td>
        <td>'.$bayar['nis'].'</td>
        <td>'.$bayar['nama'].'</td>
        <td>'.$bayar['kelas'].'</td>
        <td>'.$bayar['tanggal_bayar'].'</td>
        <td>'.$bayar['status_verifikasi'].'</td>
        <td align="right">'.number_format($bayar['nominal_bayar']).'</td>
    </tr>
    ';
}

$html.='
<tr>
    <td colspan="6" align="center"><b>Grandtotal</b></td>
    <td align="right"><b>'.number_format($total).'</b></td>
</tr>
</table>
<br><br>
-- Dicetak Pada : '.date('d-F-Y H:i:s').' --
';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('laporan_peserta_didik.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
