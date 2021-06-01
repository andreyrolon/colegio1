
 <?php
 $nom=$_GET['nom'];
 $puesto=$_GET['puesto'];
 $seleccion=$_GET['seleccion'];
 if ($seleccion==1) { 
   $img='../../../mencion/ejemplos final/Nueva carpeta/puesto'.$puesto.'.png';
    
 $html=' 
<body> 
  

</head> 
  <img style="position: absolute;      " src="'.$img.'">
  <div style="position: absolute;
    margin-top: 390px;  
    text-align: center;
    align-content: center;
    font-family: fuente1;
    width:100%;
     font-size: 40px;"  > 
 ';
 $html.=   $nom  .'
</div> 
 
</body> 
</html>';
 }
 if ($seleccion==2) { 
   $img='../../../mencion/ejemplos final/Nueva carpeta (2)/puesto'.$puesto.'.png';
    
 $html=' 
<body> 
  

</head> 
  <img style="position: absolute;      " src="'.$img.'">
  <div style="position: absolute;
    margin-top: 370px;  
    text-align: center;
    align-content: center;
    font-family: fuente1;
    width:100%;
     font-size: 40px;"  > 
 ';
 $html.=   $nom  .'
</div> 
 
</body> 
</html>';
 }
 if ($seleccion==3) { 
   $img='../../../mencion/ejemplos final/Nueva carpeta (3)/puesto'.$puesto.'.png';
    
 $html='
<body> 
  

</head> 
  <img style="position: absolute;      " src="'.$img.'">
  <div style="position: absolute;
    margin-top: 390px;  
    margin-left: 100px;  
    text-align: center;
    align-content: center;
    font-family: fuente1;
    width:100%;
     font-size: 40px;"  > 
 ';
 $html.=   $nom  .'
</div> 
 
</body> 
</html>';
 }
 if ($seleccion==4) { 
  $img='../../../mencion/ejemplos final/Nueva carpeta (4)/puesto'.$puesto.'.png';
    
 $html='
<body> 
  

</head> 
  <img style="position: absolute;      " src="'.$img.'">
  <div style="position: absolute;
    margin-top: 370px;  
    margin-left: 270px;  
    text-align: center;
    align-content: center;
    font-family: fuente1;
    width:100%;
     font-size: 40px;"  > 
 ';
 $html.=   $nom  .'
</div> 
 
</body> 
</html>';
 }
 if ($seleccion==5) { 
   $img='../../../mencion/ejemplos final/Sin título-1.png';
    
 $html=' 
<body> 
  

</head> 
  <img style="position: absolute;      " src="'.$img.'">
  <div style="position: absolute;
    margin-top: 355px;  
    text-align: center;
    align-content: center;
    font-family: fuente1;
    width:100%;
     font-size: 33px;"  > 
 ';
 $html.=   $nom  .'
</div> 
 
</body> 
</html>';
 }
 if ($seleccion==6) { 
   $img='../../../mencion/ejemplos final/Sin título-4.png';
    
 $html=' 
<body> 
  

</head> 
  <img style="position: absolute;      " src="'.$img.'">
  <div style="position: absolute;
    margin-top: 339px;  
    text-align: center;
    align-content: center;
    font-family: fuente1;
    width:100%;
     font-size: 30px;"  > 
 ';
 $html.=   $nom  .'
</div> 
 
</body> 
</html>';
 }
 
require_once   '../../../mpdf/vendor/autoload.php';
 
$mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
  'margin_left' =>  -0,   
  'margin_bottom' => -14,
  'margin_right' => -0 ]);

// Define the Header/Footer before writing anything so they appear on the first page
 
 
 
$mpdf->WriteHTML($html);  

$mpdf->Output(); 
exit;