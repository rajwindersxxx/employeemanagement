<?php
include('../connection.php');
include('config.php');

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require('../includes/tcpdf/tcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('recept');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 10, 10);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// Your original string with placeholders
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<table style="width: 100%; border: 2px solid black; border-collapse: collapse; font-size: 14px">
  <tbody>
  <tr>
  <td style="width: 660px; text-align: right;" colspan="12">Application No: [application]</td>
  </tr>
  <tr>
  <td style="width: 660px; text-align: center; font-weight: bold;" colspan="12"><u>For office Use</u></td>
  </tr>
  <tr>
  <td style="width: 660px; text-align: center; font-weight: bold;" colspan="12">Employee &amp; Service Record Management System</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px; border: 1px solid lightgray" colspan="2">SERVICE ASKED FOR:&nbsp;</td>
  <td style="width: 396px;border: 1px solid lightgray" colspan="8">[service]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 117.703px;">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 68px;">&nbsp;</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px;border: 1px solid lightgray" colspan="2">APPLICANT NAME:</td>
  <td style="width: 133px;border: 1px solid lightgray" colspan="3">[name]</td>
  <td style="width: 131px;border: 1px solid lightgray" colspan="2">MOBILE NUMBER:</td>
  <td style="width: 132px;border: 1px solid lightgray" colspan="3">[number]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 117.703px;">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 68px;">&nbsp;</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px;border: 1px solid lightgray" colspan="2">APPLY DATE:</td>
  <td style="width: 133px;border: 1px solid lightgray" colspan="3">[date-only]</td>
  <td style="width: 131px;border: 1px solid lightgray" colspan="2">TOTAL AMOUNT:</td>
  <td style="width: 132px;border: 1px solid lightgray" colspan="3">[amount]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 117.703px;">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 68px;">&nbsp;</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px;border: 1px solid lightgray" colspan="2">DEPARTMENT:</td>
  <td style="width: 133px;border: 1px solid lightgray" colspan="3">[dept]</td>
  <td style="width: 131px;border: 1px solid lightgray" colspan="2">OPERATOR:</td>
  <td style="width: 132px;border: 1px solid lightgray" colspan="3">[emp_name]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 582.703px;" colspan="10">I&nbsp; <span style="font-weight: bold;">[name]</span>&nbsp; clarify that the details should to the organization are correct and varified by me.</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 221.703px;" colspan="3">Print date: [date]</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 204px; text-align: right;" colspan="4">Signature of the Applicant.</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  </tbody>
  </table>
  
  <div style="height: 30px;">-----------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
  <table style="width: 100%; border: 2px solid black; border-collapse: collapse; font-size: 14px">
  <tbody>
  <tr>
  <td style="width: 660px; text-align: right;" colspan="12">Application No: [application]</td>
  </tr>
  <tr>
  <td style="width: 660px; text-align: center; font-weight: bold;" colspan="12"><u>For Citizen Use</u></td>
  </tr>
  <tr>
  <td style="width: 660px; text-align: center; font-weight: bold;" colspan="12">Employee &amp; Service Record Management System</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px; border: 1px solid lightgray" colspan="2">SERVICE ASKED FOR:&nbsp;</td>
  <td style="width: 396px;border: 1px solid lightgray" colspan="8">[service]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 117.703px;">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 68px;">&nbsp;</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px;border: 1px solid lightgray" colspan="2">APPLICANT NAME:</td>
  <td style="width: 133px;border: 1px solid lightgray" colspan="3">[name]</td>
  <td style="width: 131px;border: 1px solid lightgray" colspan="2">MOBILE NUMBER:</td>
  <td style="width: 132px;border: 1px solid lightgray" colspan="3">[number]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 117.703px;">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 68px;">&nbsp;</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px;border: 1px solid lightgray" colspan="2">APPLY DATE:</td>
  <td style="width: 133px;border: 1px solid lightgray" colspan="3">[date-only]</td>
  <td style="width: 131px;border: 1px solid lightgray" colspan="2">TOTAL AMOUNT:</td>
  <td style="width: 132px;border: 1px solid lightgray" colspan="3">[amount]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 117.703px;">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 68px;">&nbsp;</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 186.703px;border: 1px solid lightgray" colspan="2">DEPARTMENT:</td>
  <td style="width: 133px;border: 1px solid lightgray" colspan="3">[dept]</td>
  <td style="width: 131px;border: 1px solid lightgray" colspan="2">OPERATOR:</td>
  <td style="width: 132px;border: 1px solid lightgray" colspan="3">[emp_name]</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 582.703px;" colspan="10">I&nbsp; <span style="font-weight: bold;">[name]</span>&nbsp; clarify that the details should to the organization are correct and varified by me.</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 39.2969px;">&nbsp;</td>
  <td style="width: 221.703px;" colspan="3">Print date: [date]</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 204px; text-align: right;" colspan="4">Signature of the Official.</td>
  <td style="width: 38px;">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td style="width: 157px;" colspan="2">&nbsp;</td>
  <td style="width: 69px;">&nbsp;</td>
  <td style="width: 35px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 49px;">&nbsp;</td>
  <td style="width: 59px;">&nbsp;</td>
  <td style="width: 72px;">&nbsp;</td>
  <td style="width: 25px;">&nbsp;</td>
  <td style="width: 39px;">&nbsp;</td>
  <td style="width: 106px;" colspan="2">&nbsp;</td>
  </tr>
  </tbody>
  </table>
EOF;

// Replace placeholders with PHP variables
$html = str_replace('[service]', $_SESSION['service_type'], $html);
$html = str_replace('[name]', $_SESSION['customer_name'], $html);
$html = str_replace('[date-only]', substr($_SESSION['date-time'], 0, 10), $html);
$html = str_replace('[date]', $_SESSION['date-time'], $html);
$html = str_replace('[dept]', $_SESSION['selected_dept_name'], $html);
$html = str_replace('[number]', $_SESSION['customer_number'], $html);
$html = str_replace('[amount]', $_SESSION['amount']. " Rs/- ", $html);
$html = str_replace('[application]', $_SESSION['application-no'], $html);
$html = str_replace('[emp_name]', $_SESSION['first_name']. " ". $_SESSION['last_name'] , $html);

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// output the HTML content

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Close and output PDF document
ob_end_clean();
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>
