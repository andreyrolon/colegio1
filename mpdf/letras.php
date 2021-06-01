 


 <?php

include 'vendor/autoload.php';
$css=file_get_contents('style.css');
$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 4,
    'margin_left' => 4,
    'margin_right' => 4,
    'mirrorMargins' => true
]);
$html='';
 for ($i=0; $i <1    ; $i++) { 
  
 $html.=' 


         
<img width="30" src="letras/a.png">
<img width="30" src="letras/l.png">
<img width="30" src="letras/e.png">
<img width="30" src="letras/x.png">
         
<img width="30" src="letras/c.png">
<img width="30" src="letras/a.png">
<img width="30" src="letras/m.png">
<img width="30" src="letras/p.png">
<img width="30" src="letras/o.png">';


$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->AddPage();

  

// Now the right-margin (inner margin on page 2) = 30

 
}
$mpdf->Output();

?>
