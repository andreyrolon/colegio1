<?php
 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}

function manual_c(){
  
  


  $Foto=$_FILES['Foto']; 
    echo $Foto['tmp_name'];

    $urll= '../../../archivos_colegio/MANUAL_DE_CONVIVENCIA.pdf' ;
    unlink("$urll"); 
    $ruta='../../../archivos_colegio/MANUAL_DE_CONVIVENCIA.pdf';
        move_uploaded_file($Foto['tmp_name'],$ruta);

  
}
function manual_e(){
  
  


  $Foto=$_FILES['Foto']; 
    echo $Foto['tmp_name'];

    $urll= '../../../archivos_colegio/MANUAL_DE_EVALUACION.pdf' ;
    unlink("$urll"); 
    $ruta='../../../archivos_colegio/MANUAL_DE_EVALUACION.pdf';
        move_uploaded_file($Foto['tmp_name'],$ruta);

  
}
function PIE(){
  
  


  $Foto=$_FILES['Foto']; 
    echo $Foto['tmp_name'];

    $urll= '../../../archivos_colegio/PIE.pdf' ;
    unlink("$urll"); 
    $ruta='../../../archivos_colegio/PIE.pdf';
        move_uploaded_file($Foto['tmp_name'],$ruta);

  
}
 

 ?>