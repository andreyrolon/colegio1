<?php
//call the autoload
require 'vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

//styling arrays
//table head style
$tableHead = [
    'font'=>[
        'color'=>[
            'rgb'=>'FFFFFF'
        ],
        'bold'=>true,
        'size'=>16
    ],
    'fill'=>[
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '538ED5'
        ]
    ],
];
//even row
$evenRow = [
    'fill'=>[
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'DFDFDF'
        ]
    ]
];
//odd row
$oddRow = [
    'fill'=>[
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'f7f7f7'
        ]
    ]
];

//styling arrays end

//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();

//set default font
$spreadsheet->getDefaultStyle()
    ->getFont()
    ->setName('Arial')
    ->setSize(15);

//heading
    $R=mb_convert_case($_GET['nom'], MB_CASE_TITLE, "UTF-8");
$spreadsheet->getActiveSheet()
    ->setCellValue('A1', $_GET['rom'] )
    ->setCellValue('A2', 'Nombre: '.$R.' - Periodo: '.$_GET['p'] );

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("A1:D1");

// set font style
$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//merge heading
$spreadsheet->getActiveSheet()->mergeCells("A2:H2");

// set font style
$spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

//setting column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(27);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(27);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(27);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10); 

//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A3',"CODIGO")
    ->setCellValue('B3',"Nombre")
    ->setCellValue('C3',"APELLIDO")
    ->setCellValue('D3',"NOTA") ;

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A3:D3')->applyFromArray($tableHead);

//the content
//read the json file

include "../../../codes/rector/conexion.php"; 
    $id_a=$_GET['id_a'];  
 

    $ano=date('Y');
    $tipo_calificaiones="SELECT materia_por_paso.id_materia_por_paso,materia_por_periodo.id_materia_por_periodo, alumnos.nombre,alumnos.apellido,materia_por_paso.nota from materia_por_paso,informeacademico,alumnos,materia_por_periodo WHERE informeacademico.ano='$ano' and  informeacademico.id_alumno=alumnos.id_alumnos AND materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo AND materia_por_paso.id_nota_independiente='$id_a' GROUP BY materia_por_paso.id_materia_por_paso ORDER BY alumnos.apellido";
    $tipo_calificaionesq=$conexion->prepare($tipo_calificaiones);
    $tipo_calificaionesq->execute(array());
    $registro=$tipo_calificaionesq->fetchAll(); 

//loop through the data
//current row
$row=4 ;
foreach($registro as $student){

    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()
        ->setCellValue('A'.$row , $student['id_materia_por_paso'].'-'.$student['id_materia_por_periodo'].'-'.$_GET['area'])
        ->setCellValue('B'.$row , $student['nombre'])
        ->setCellValue('C'.$row , $student['apellido'])
        ->setCellValue('D'.$row , $student['nota']) ;
    
    //set row style
    if( $row % 2 == 0 ){
        //even row
        $spreadsheet->getActiveSheet()->getStyle('A'.$row.':D'.$row)->applyFromArray($evenRow);
    }else{
        //odd row
        $spreadsheet->getActiveSheet()->getStyle('A'.$row.':D'.$row)->applyFromArray($oddRow);
    }
    //increment row
    $row++;
}

//autofilter
//define first row and last row
$firstRow=3;
$lastRow=$row-1;
//set the autofilter
$spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":D".$lastRow);














//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
$vo=$_GET['rom'];
header('Content-Disposition: attachment;filename="'.$vo.' - Nota: '.$R.' periodo:'.$_GET['p'].'.xlsx"');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');
