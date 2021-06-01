 

 <?php 
$seleccion=$_GET['seleccion'];
 
if ($seleccion==1) {  
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta/puesto1.png">
    <div style="position: absolute;
      margin-top: 390px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre1']  .'
  </div> 
   
  </body> 
  </html>';
  require_once   '../../../mpdf/vendor/autoload.php';
   
  $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
    'margin_left' =>  -0,   
    'margin_bottom' => -14,
    'margin_right' => -0 ]);

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta/puesto2.png">
    <div style="position: absolute;
      margin-top: 390px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre2']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head>  <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta/puesto3.png">
    <div style="position: absolute;
      margin-top: 390px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre3']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);   
  $mpdf->Output();
}
 if ($seleccion==2) { 

   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (2)/puesto1.png">
    <div style="position: absolute;
      margin-top: 373px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre1']  .'
  </div> 
   
  </body> 
  </html>';
  require_once   '../../../mpdf/vendor/autoload.php';
   
  $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
    'margin_left' =>  -0,   
    'margin_bottom' => -14,
    'margin_right' => -0 ]);

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (2)/puesto2.png">
    <div style="position: absolute;
      margin-top: 373px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre2']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head>  <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (2)/puesto3.png">
    <div style="position: absolute;
      margin-top: 373px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre3']  .'
  </div> 
   
  </body> 
  </html>';
 
 
   
   
   
  $mpdf->WriteHTML($html);   
  $mpdf->Output();
    
 }
 if ($seleccion==3) { 

   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (3)/puesto1.png">
    <div style="position: absolute;
      margin-top: 389px; 
      margin-left: 70px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre1']  .'
  </div> 
   
  </body> 
  </html>';
  require_once   '../../../mpdf/vendor/autoload.php';
   
  $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
    'margin_left' =>  -0,   
    'margin_bottom' => -14,
    'margin_right' => -0 ]);

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (3)/puesto2.png">
    <div style="position: absolute;
      margin-top: 389px; 
      margin-left: 70px;    
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre2']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head>  <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (3)/puesto3.png">
    <div style="position: absolute;
      margin-top: 389px; 
      margin-left: 70px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre3']  .'
  </div> 
   
  </body> 
  </html>';
 
 
   
   
   
  $mpdf->WriteHTML($html);   
  $mpdf->Output();


 }
 if ($seleccion==4) { 
   
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (4)/puesto1.png">
    <div style="position: absolute;
      margin-top: 373px;   
      margin-left: 280px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre1']  .'
  </div> 
   
  </body> 
  </html>';
  require_once   '../../../mpdf/vendor/autoload.php';
   
  $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
    'margin_left' =>  -0,   
    'margin_bottom' => -14,
    'margin_right' => -0 ]);

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (4)/puesto2.png">
    <div style="position: absolute;
      
      margin-top: 373px;   
      margin-left: 280px; 
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre2']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head>  <img style="position: absolute;      " src="../../../mencion/ejemplos final/Nueva carpeta (4)/puesto3.png">
    <div style="position: absolute;
      
      margin-top: 373px;   
      margin-left: 280px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre3']  .'
  </div> 
   
  </body> 
  </html>';
 
 
   
   
   
  $mpdf->WriteHTML($html);   
  $mpdf->Output();
 }
 if ($seleccion==5) { 
   $img='../../../mencion/ejemplos final/Sin título-1.png';
 

   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Sin título-1.png">
    <div style="position: absolute;
      margin-top: 355px;   
      margin-left: 10px;  
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre1']  .'
  </div> 
   
  </body> 
  </html>';
  require_once   '../../../mpdf/vendor/autoload.php';
   
  $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
    'margin_left' =>  -0,   
    'margin_bottom' => -14,
    'margin_right' => -0 ]);

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Sin título-1.png">
    <div style="position: absolute;
      
      margin-top: 355px;   
      margin-left: 10px; 
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre2']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head>  <img style="position: absolute;      " src="../../../mencion/ejemplos final/Sin título-1.png">
    <div style="position: absolute;
      
      margin-top: 355px;   
      margin-left: 10px; 
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 40px;"  > 
   ';
   $html.=   $_GET['nombre3']  .'
  </div> 
   
  </body> 
  </html>';
 
 
   
   
   
  $mpdf->WriteHTML($html);   
  $mpdf->Output();
 }
 if ($seleccion==6) { 
  
   $img='../../../mencion/ejemplos final/Sin título-1.png';
 
 
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Sin título-4.png">
    <div style="position: absolute;
      margin-top: 333px;     
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 33px;"  > 
   ';
   $html.=   $_GET['nombre1']  .'
  </div> 
   
  </body> 
  </html>';
  require_once   '../../../mpdf/vendor/autoload.php';
   
  $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L','format' =>[216 , 279],'margin_top' => 0,
    'margin_left' =>  -0,   
    'margin_bottom' => -14,
    'margin_right' => -0 ]);

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head> 
    <img style="position: absolute;      " src="../../../mencion/ejemplos final/Sin título-4.png">
    <div style="position: absolute;
      
      margin-top: 333px;     
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 33px;"  > 
   ';
   $html.=   $_GET['nombre2']  .'
  </div> 
   
  </body> 
  </html>';
 

  // Define the Header/Footer before writing anything so they appear on the first page
   
   
   
  $mpdf->WriteHTML($html);  
  $mpdf->AddPage(); 
  $img='../../../mencion/hhh.jpeg';
    
   $html=' 
  <body> 
    

  </head>  <img style="position: absolute;      " src="../../../mencion/ejemplos final/Sin título-4.png">
    <div style="position: absolute;
            margin-top: 333px;     
      text-align: center;
      align-content: center;
      font-family: fuente1;
      width:100%;
       font-size: 33px;"  > 
   ';
   $html.=   $_GET['nombre3']  .'
  </div> 
   
  </body> 
  </html>';
 
 
   
   
   
  $mpdf->WriteHTML($html);   
  $mpdf->Output();
 }
 
 
 