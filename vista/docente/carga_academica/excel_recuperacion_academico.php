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
$spreadsheet->getActiveSheet()
    ->setCellValue('A1', $_GET['rom'] )
    ->setCellValue('A2', 'Recuperacion del '.$_GET['p'].' - Periodo ' );

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("A1:D1");

// set font style
$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//merge heading
$spreadsheet->getActiveSheet()->mergeCells("A2:D2");

// set font style
$spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

//setting column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(18); 

//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A3',"CODIGO")
    ->setCellValue('B3',"NOMBRE")
    ->setCellValue('C3',"APELLIDO")
    ->setCellValue('D3',"TRABAJO")
    ->setCellValue('E3',"SUSTENTACIÓN") ;

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A3:E3')->applyFromArray($tableHead);

//the content
//read the json file

include "../../../codes/rector/conexion.php"; 
       
 

    $ano=date('Y');
    $ano=date('Y');
    $tipo_calificaiones="SELECT  materia_por_periodo.area, alumnos.nombre, alumnos.apellido,  materia_por_periodo.trabajo,materia_por_periodo.sustentacion,materia_por_periodo.id_materia_por_periodo FROM alumnos, informeacademico ,materia_por_periodo WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso='".$_GET['id_c']."'  AND informeacademico.id_grado='".$_GET['id_g']."' AND informeacademico.id_jornada_sede='".$_GET['id_jornada_sede']."' and  informeacademico.ano=$ano and materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico  AND materia_por_periodo.periodo='".$_GET['p']."' AND materia_por_periodo.id_area='".$_GET['id_a']."'  and materia_por_periodo.nota<(SELECT escala_academica.desde from escala_academica WHERE escala_academica.mini='1')  order by alumnos.apellido";
    $tipo_calificaionesq=$conexion->prepare($tipo_calificaiones);
    $tipo_calificaionesq->execute(array());
    $registro=$tipo_calificaionesq->fetchAll(); 

//loop through the data
//current row
$row=4 ;
foreach($registro as $student){

    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()
        ->setCellValue('A'.$row , $student['id_materia_por_periodo'].'-'.$student['area'])
        ->setCellValue('B'.$row , $student['nombre'])
        ->setCellValue('C'.$row , $student['apellido'])
        ->setCellValue('D'.$row , $student['trabajo'])
        ->setCellValue('E'.$row , $student['sustentacion']) ;
    
    //set row style
    if( $row % 2 == 0 ){
        //even row
        $spreadsheet->getActiveSheet()->getStyle('A'.$row.':E'.$row)->applyFromArray($evenRow);
    }else{
        //odd row
        $spreadsheet->getActiveSheet()->getStyle('A'.$row.':E'.$row)->applyFromArray($oddRow);
    }
    //increment row
    $row++;
}

//autofilter
//define first row and last row
$firstRow=3;
$lastRow=$row-1;
//set the autofilter
$spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":E".$lastRow);














//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
$vo=$_GET['rom'];
header('Content-Disposition: attachment;filename="  recuperacion:'.$_GET['rom'].' - p:'.$_GET['p'].'.xlsx"');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');
