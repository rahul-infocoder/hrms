<?php
class Kiba extends CI_Controller{

function testexcel()



{

include APPPATH.'my_classes/PHPExcel.php';



/** PHPExcel_Writer_Excel2007 */

include APPPATH.'my_classes/PHPExcel/Writer/Excel5.php';




// Create new PHPExcel object



echo date('H:i:s') . " Create new PHPExcel object\n";



$objPHPExcel = new PHPExcel();



// Set properties



echo date('H:i:s') . " Set properties\n";



$objPHPExcel->getProperties()->setCreator("BazZ");

$objPHPExcel->getProperties()->setLastModifiedBy("BazZ");

$objPHPExcel->getProperties()->setTitle("TestExcel");

$objPHPExcel->getProperties()->setSubject("");



// Set row height



$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);



$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);





// Set column width



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);



$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);



$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);



$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);



$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);



$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);



$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);



$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);



$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);



$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);



$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);



$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);



$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);



$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);





//Merge cells (warning: the row index is 0-based)

$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,1,13,1);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,2,13,2);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,3,0,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(1,3,1,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2,3,3,3);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2,4,2,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(3,4,3,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(4,3,4,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(5,3,5,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(6,3,6,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(7,3,9,3);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(7,4,7,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(8,4,9,4);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(10,3,10,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(11,3,11,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(12,3,12,5);



$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(13,3,13,5);





//Modify cell's style



$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(

array(

'font' => array(

'name'         => 'Times New Roman',



'bold'         => true,

'italic'    => false,

'size'        => 20



),



'alignment' => array(

'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,

'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

'wrap'       => true



)

)



);





$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(

array(

'font' => array(

'name'         => 'Times New Roman',



'bold'         => true,

'italic'    => false,

'size'        => 14



),



'alignment' => array(

'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,

'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

'wrap'       => true



)

)



);





$objPHPExcel->getActiveSheet()->duplicateStyleArray(

array(

'font' => array(

'name'         => 'Times New Roman',



'bold'         => true,

'italic'    => false,

'size'        => 12



),



'borders' => array(

'top'        => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),



'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),



'left'        => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),



'right'        => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE)

),

'alignment' => array(

'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,

'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

'wrap'       => true



)

),

'A3:N5'

);



// Add some data



echo date('H:i:s') . " Add some data\n";



$objPHPExcel->setActiveSheetIndex(0);





$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Try PHPExcel with CodeIgniter');

$objPHPExcel->getActiveSheet()->SetCellValue('A2',"Subtitle here");



$objPHPExcel->getActiveSheet()->SetCellValue('A3',"No.");



$objPHPExcel->getActiveSheet()->SetCellValue('B3',"Name");

$objPHPExcel->getActiveSheet()->SetCellValue('C3',"Number");

$objPHPExcel->getActiveSheet()->SetCellValue('C4',"Code");

$objPHPExcel->getActiveSheet()->SetCellValue('D4',"Register");

$objPHPExcel->getActiveSheet()->SetCellValue('E3',"Space (M2)");



$objPHPExcel->getActiveSheet()->SetCellValue('F3',"Year");

$objPHPExcel->getActiveSheet()->SetCellValue('G3',"Location");



// Rename sheet



echo date('H:i:s') . " Rename sheet\n";



$objPHPExcel->getActiveSheet()->setTitle('Try PHPExcel with CodeIgniter');



// Save Excel 2003 file



echo date('H:i:s') . " Write to Excel2003 format\n";



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);



$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

}


function readexcel()
{

require_once APPPATH.'my_classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("test.xlsx");
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;

	for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $mcell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
           
			 echo '<td>' . $val . '</td>';
        }
	//print_r ($testArray);
	
	
	
	
    echo "<br>The worksheet ".$worksheetTitle." has ";
    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    echo ' and ' . $highestRow . ' row.';
	
    echo '<br>Data: <table border="1"><tr>';
    for ($row = 1; $row <= $highestRow; ++ $row) {
        echo '<tr>';
		// $col=0;
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
           
			 echo '<td>' . $val . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
	
}
}

function convert(){
$objPHPExcel = PHPExcel_IOFactory::load("XMLTest.xml");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('covertedXml2Xlsx.xlsx');	
}


function mergingCheck(){
require_once APPPATH.'my_classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("test.xls");
$cellAddress = 'A12';
$foundInRange = false;
foreach($objPHPExcel->getActiveSheet()->getMergeCells() as $range) {
   if ($objPHPExcel->getActiveSheet()->getCell($cellAddress)->isInRange($range)) {
      $rangeDetails = PHPExcel_Cell::splitRange($range);
	  print_r ($rangeDetails);
      $result = $objPHPExcel->getActiveSheet()->getCell($rangeDetails[0][0])->getValue();
      $foundInRange = true;
      break;
   }
}
if ($foundInRange) {
   echo $result = $objPHPExcel->getActiveSheet()->getCell($cellAddress)->getValue();
}
}
}

?>