<?php 
session_start();
if ($_GET)
{
    $action = $_GET["action"];
    if (function_exists($action))
    {
        call_user_func($action);
    }
}


function tipo()
   {
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $categoria=$_POST['categoria'];
   echo $sql="SELECT  id,nombre FROM `observacion_tipo` WHERE observacion_tipo.id_observacion_categoria=$categoria";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $sql2=$sql1->fetchAll();
    ?> <option value="0">Selecione</option> <?php
    foreach($sql2 as $key){
        ?>
        <option value="<?php echo($key['id']); ?>">
        <?php echo($key['nombre']); ?>
        </option>
        <?php
    }
}

 
//area
function form2()
{   
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
 
    $fecha='';
    $id_alumno='';
    $asignatura='';
    $descripcion='';
    $admin='0';
    $tipo=''; 
    $categoria='';
    $id_informe_academico="";
    if (isset($_POST['id_informe_academico'])) {
        $id_informe_academico=$_POST['id_informe_academico'];
     } 
    if (isset($_POST['id_alumno'])) {
        $id_alumno=$_POST['id_alumno'];
     } 
    if (isset($_POST['asignatura'])) {
        $asignatura=$_POST['asignatura'];
     } 
    if (isset($_POST['descripcion'])) {
        $descripcion=$_POST['descripcion'];
    }
    if (isset($_POST['categoria'])) {
        $categoria=$_POST['categoria'];
    } 
    if (isset($_POST['admin'])) {
        $admin=$_POST['admin'];
    } 
    if (isset($_POST['tipo'])) {
        $tipo=$_POST['tipo']; 
    } 
    if (isset($_POST['fecha'])) {
        $fecha=$_POST['fecha']; 
    }     
    $id_js=$_POST['jornada_sede1'];
    $id_g=$_POST['id_g'];
    $id_c=$_POST['id_c'];
     
    if ($categoria=='' ) {
            
        echo $num=-5; return;
    }
    if ($tipo==0) {
            
        echo $num=-2; return;
    } 
    //decimos si valor es 0 no  es una remision por eso el admin debe ser 0
    if ($_POST['valor']==0 ) {
      $admin=0;
    }
    //si es valor es 1  significa que es una remision y el admin no puede llevar 0
    if ($_POST['valor']>0 && $admin==0) {
            
        echo $num=-6; return;
    }
    if ($fecha=='') {
        
           echo $num=-3; return;
    }  
    if ($descripcion=='') {
        
           echo $num=-4; return;
    } 
    if ($tipo==0) {
            
        echo $num=-2; return;
    } 
    if ((!preg_match ("/^[0-9]+$/", $id_g)) && (!preg_match ("/^[0-9]+$/", $id_informe_academico)) && (!preg_match ("/^[0-9]+$/", $id_c)) && (!preg_match ("/^[0-9]+$/", $id_js)) && (!preg_match ("/^[0-9]+$/", $admin)) && (!preg_match ("/^[0-9]+$/", $tipo)) && (!preg_match ("/^[0-9]+$/", $id)) && (!preg_match ("/^[0-9]+$/", $id_alumno))) 
    {
          
        echo $num=-1; return;
    }      
 

 $num=0;  
     
    if(preg_match('/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/',  $fecha)){ 
        
        
        
        if (  (preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/", $descripcion))&& (preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $asignatura)) ) {
            $num=1;

            $ss="SELECT * FROM `observacion` WHERE fecha='$fecha' AND descripcion='$descripcion' AND id_observacion_tipo='$tipo' AND id_alumno='$id_alumno' AND id_docente='$id' And  area='$asignatura' ";
            $ss1=$conexion->prepare($ss);
            $ss1->execute(array());
            $con=$ss1->rowCount();

            if($con==0){
              $num=2;
              $sql="INSERT INTO `observacion` ( `area`, `competencia`, `fecha`, `descripcion`, `id_alumno`, `id_docente`, `id_observacion_tipo`, `id_admin`, `id_jornada_sede`, `id_grado`, `id_curso`, `compromiso`, `periodo`) VALUES ('$asignatura','0','$fecha','$descripcion','$id_alumno','$id','$tipo','$admin','$id_js','$id_g','$id_c','0','".$_SESSION['numero']."')";
              $sql1=$conexion->prepare($sql);
              $sql1->execute(array()); 
              $recupera1 =$conexion->lastInsertId() ; 
              if ($_POST["valor"]>0 && $recupera1>0) {
                $sql="INSERT INTO `remision` ( `estado`, `orientacion`, `accion`, `matricula_condicional`, `id_observacion`, `texto_remision`, `id_informe_academico`) VALUES ( 'Espera', '', '','0','$recupera1','','$id_informe_academico')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
              }
            } 
        }
    }
    echo $num;
} 
function admnistrativo()
{

   include "../../codes/rector/conexion.php";
 $sql="SELECT ROL,ID_ADMIN, FOTO,NOMBRE,APELLIDO,GENERO FROM `administradores`  ";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $sql2=$sql1->fetchAll(); ?>
  <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
  <script src="../../../js/chosen.jquery.js"></script>
  <script src="../../../js/ImageSelect.jquery.js"></script>
  <select id="admin" class=" form-control my-select"     > 
  <option value="0"> Elija el encargado</option> <?php
    
    $nom_ad='';
    $ID_ADMIN='';
    $foto_se=''; 
    foreach($sql2 as $key){
        $FOTO=$key['FOTO'];
      if($key['FOTO']=='' && $key['GENERO']==1){
        $FOTO='../../../logos/femenino.png';
      }if($key['FOTO']=='' && $key['GENERO']==0){
        $FOTO='../../../logos/masculino.png';
      }
      $nom_ad.=$key['NOMBRE']." ".$key['APELLIDO'].',';
      $ID_ADMIN.=$key['ID_ADMIN'].',';
      $foto_se.=$FOTO.',';
       ?>
        <option data-img-src="<?php echo($FOTO); ?>" aria-disabled="true" value="<?php echo($key['ID_ADMIN'] ); ?>"><?php echo($key['NOMBRE']." ".$key['APELLIDO']); ?></option> <?php

    } 
    $_SESSION['id_administrador']=$ID_ADMIN;
    $_SESSION['nom_ad']=$nom_ad;
    $_SESSION['foto_se']=$foto_se;

    ?>
  </select> 
  <script>
    $(".my-select").chosen()({
      placeholder: "Select a state",
      allowClear: true
    });
    </script><?php
}
?>
