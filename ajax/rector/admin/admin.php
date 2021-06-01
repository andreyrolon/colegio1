<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}
function eliminar_departamento(){
	include '../../conexion.php'; 
	$consultar_rotulo=" DELETE FROM `estado` WHERE `estado`.`id` = '".$_POST['ids']."'";
	$consultar_rotulo1=$conexion->prepare($consultar_rotulo);
	$consultar_rotulo1->execute(array());
}
function pais(){
	include '../../conexion.php'; 
	$consultar_rotulo="INSERT INTO `pais` (  `paisnombre`) VALUES ( '".$_POST['pais']."')";
	$consultar_rotulo1=$conexion->prepare($consultar_rotulo);
	$consultar_rotulo1->execute(array());
	 
}
function insert_departamento(){
	include '../../conexion.php'; 
	$consultar_rotulo="INSERT INTO `estado` (  `ubicacionpaisid`, `estadonombre`) VALUES ('".$_POST['pais']."', '".$_POST['departamento']."')";
	$consultar_rotulo1=$conexion->prepare($consultar_rotulo);
	$consultar_rotulo1->execute(array());
}

function departamentos_actualizar(){
	include '../../conexion.php'; 
	$consultar_rotulo="UPDATE `estado` SET `estadonombre` = '".$_POST['nom']."' WHERE `estado`.`id` = ".$_POST['ids'].";";
	$consultar_rotulo1=$conexion->prepare($consultar_rotulo);
	$consultar_rotulo1->execute(array());
	 
}
function departamentos(){
	include '../../conexion.php'; 
 
 
    if(isset($_POST['dato'])){
     $d=$_POST['dato'];
 }else{
  $d='';
}
if(isset($_POST['i'])){
   $paginaActual = $_POST['i'];
}else{
   $paginaActual=1;
}
 $ids=explode(',', $_POST['id']);
 $id=$ids[0];

        $consultar_nivel="SELECT Q.estadonombre,Q.id from  (SELECT  estado.estadonombre,estado.id from  estado   WHERE  estado.ubicacionpaisid='$id' )as	Q	where Q.estadonombre like('%$d%') ORDER by Q.estadonombre  ";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
   $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}
echo  '<br>';
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';




 


if($paginaActual > 1){
  $fttg1=    $lista = $lista.'<nav aria-label="...">
  <ul class="pagination" style="cursor: pointer;">  

<li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
      <a class="page-link">Anterior</a>
    </li>
';
}else{
    $lista = $lista.'<nav aria-label="...">
  <ul class="pagination">  

<li class="page-item disabled "   >
      <a class="page-link">Anterior</a>
    </li>
';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
     $lista = $lista.'

    <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
      <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </span>
    </li> ';
 }else{
  $lista = $lista.'
    <li class="page-item  "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
      <a class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </a>
    </li> ';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'  

<li class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
      <a class="page-link">siguiente</a>
    </li>';
  $o=0;
}else{
   $lista = $lista.'  

<li class="page-item  disabled "   ">
      <a class="page-link">Siguiente</a>
    </li>';
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}


        $consultar_nivel=" SELECT Q.estadonombre,Q.id from  (SELECT  estado.estadonombre,estado.id from  estado   WHERE  estado.ubicacionpaisid='$id' )as	Q	where Q.estadonombre like('%$d%') ORDER by Q.estadonombre LIMIT $limit, $nroLotes  ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="eliminis">

   <div class="box-body no-padding">

       <div class="mailbox-controls">

        <!-- Check all button -->
      
        <div class="pull-left btn-group"> 

 
          <?php if($paginaActual > 1){
            echo  ' <button type="button" class="lop"  style="" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button" style=";" class="lop " id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
        </div>
        <!-- /.btn-group --> 
        <div class="pull-right">

            <?php 

            $aaa=$registrow+0;
            $aa=$paginaActual+0;
            $g=$aa *$aaa;
            if ($o==0) {
               echo $g .'-'.$paginaActual.'/'. $nroProductos ;
           }else{
            echo $nroProductos;

            echo   '-'.$paginaActual.'/'. $nroProductos ;
        }





        ?>
        <div class="btn-group"> 

            <?php if($paginaActual > 1){
              echo  ' <button type="button" class="lop" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

              <?php
              if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="lop" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

          </div>
          <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
  </div>

  <div class="table-responsive" >
    <style>
 
[data-title] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 8px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}
tr:hover td{
    background-color: #55b3ca3d;
    padding:40px;
}
</style>


 

  <br><table class="table   table-hover" style=" ">
     <tr>
        <th>Departamento del pais</th> 
        <th   >Actualizar</th>  
        <th >Eliminar</th>
        </tr>  <?php
        foreach ($registro as $var) {

         ?>
         <tr>
            <td style="text-align: justify;">
                <input id="<?php echo($var['estadonombre'].$var['id']); ?>" type="" class="form-control" disabled value="<?php echo($var['estadonombre']); ?>" onblur="document.getElementById('<?php echo($var['estadonombre'].$var['id']); ?>').disabled=true;var nom=document.getElementById('<?php echo($var['estadonombre'].$var['id']); ?>').value;
                	var ids=<?php echo($var['id']);  ?>;
                	var id=<?php echo $id ?>; actualizar(nom,id,ids);">
            </td>
            
            <td><center>
            	<a data-title='Actualizar departamento o estado' onclick="document.getElementById('<?php echo($var['estadonombre'].$var['id']); ?>').disabled=false;document.getElementById('<?php echo($var['estadonombre'].$var['id']); ?>').focus();">
              <img src="../../../logos/actualizar.png" alt="" width="35" style="top: 0px;padding-top: 0"></center>
              </a>
            </td>
            
            

            <td>    <center>              
              <a href="#"  style="top: -7px; " data-toggle="modal" data-target="#mymodal2"     data-title="Eliminar departamento o estado"  onclick="
               
                var opk=   confirm('Esta seguro de eliminar la asignatura?');
                if(opk==true){
                	var ids=<?php echo($var['id']);  ?>; 
                	var id=<?php echo $id ?>;  
                  	eliminar_departamento(ids,id);
                }else{
                   
                } "   > 
                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" ></center>
              </a>
            </td>

</tr> <?php  
}
echo "

";?></table>

 
 
 <div  class="mailbox-controls">
 

 <div class="btn-group" style="float: left;"> <nav aria-label="..."> <ul class="pagination" id="pagination"><?php echo  $lista ?> </ul></nav>


</div><div class="pull-right" style="margin-top: 44px; margin-right: 25px"><?php  echo $nroProductos ?> archivos en  total

</div>
</div>
</div></form> </div>


 
 <?php
	 
}
function varificar_contrasena(){
	include '../../conexion.php';
	$cor = $_POST['contraseña1'];
	$consultar_rotulo="SELECT CLAVE from administradores WHERE  `administradores`.`ID_ADMIN` = ".$_POST['id'];
	$consultar_rotulo1=$conexion->prepare($consultar_rotulo);
	$consultar_rotulo1->execute(array());
	foreach ($consultar_rotulo1 as $lol) {
		if(password_verify($cor, $lol['CLAVE'])){ 
			echo 1;
		}else{
			echo 0;
		}
	}
}
function   actualizar_contra_admin1(){
	include '../../conexion.php'; 
	$cor = password_hash($_POST['contraseña3'],PASSWORD_DEFAULT);
		echo	$consultar_rotulo="UPDATE `administradores` SET `CLAVE` = '".$cor."' WHERE `administradores`.`ID_ADMIN` = ".$_POST['id'];

			$consultar_rotulo1=$conexion->prepare($consultar_rotulo);
			$consultar_rotulo1->execute(array());
}
function excel(){
	include '../../conexion.php';  
	include '../../../Classes/PHPExcel/IOFactory.php';
 	$c = $_FILES['ex'];
	$nombreArchivo=$c['tmp_name'];
	$objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	
	 
	
	for($i = 2; $i <= $numRows; $i++){
		
		$A = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$B = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$C = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$D = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$E = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue()));
		$F = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$G = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$H = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
		$I = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
		$J = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
		$K = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
		$L = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
		$M = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
		$N = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
		$O = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue(); 
		$P = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue()));
		$Q = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue()));
		$R = $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue(); 
		$S = $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue(); 
		$T = $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue(); 
		 
	   $cor = password_hash($L,PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO `administradores` (`ID_ADMIN`, `NOMBRE`, `APELLIDO`, `TIPO_DOCUMENTO`, `NUMERO_DOCUMENTO`, `FECHA_NACIMIENTO`, `LUGAR_NACIMIENTO`, `DIRECCION`, `BARRIO`, `CELULAR`, `TELEFONO_CA`, `ROL`, `CLAVE`, `FOTO`, `CORREO`, `GENERO`, `ESCALAFON`, `FECHA`, `fecha_nombramiento`, `decreto_nombramiento`, `decreto_traslado`, `fecha_traslado`, `INHABILITADO`) VALUES (NULL, '$A', '$B', '$C', '$D', '$E', '$F', '$G', '$H', '$I', '$J', '$K', '$cor', '', '$M', '$N', '$O', '$P', '$Q', '$R', '', '', '')";
		$consultar_nivel1=$conexion->prepare($sql);
		$consultar_nivel1->execute(array()); 
		$recupera =$conexion->lastInsertId() ;

		echo  $sqlq = "SELECT jornada_sede.ID_JS FROM jornada_sede WHERE jornada_sede.ID_SEDE='$S' AND jornada_sede.ID_JORNADA='$T'";
		$consultar_nivel1q=$conexion->prepare($sqlq);
		$consultar_nivel1q->execute(array());
		foreach ($consultar_nivel1q as $key) {
			$opC=$key['ID_JS'];
		}
		if($opC!=''){echo 
			 $sqlq1 = "INSERT INTO `admin_jornada_sede` (`id_admin_jornada_sede`, `id_js`, `id_admin`) VALUES (NULL, '$opC', '$recupera')";
			$consultar_nivel1q1=$conexion->prepare($sqlq1);
			$consultar_nivel1q1->execute(array());
			$opC='';
		}
	}
	
 
	


}
function registro(){
	$ruta2='';
	$soporte='';
	if(isset($_POST['ad'])){
	 	if(isset($_FILES['foto'])){ 
	 		$soporte=$_FILES['foto'];
	 	}
		if ($soporte=='') {
		    $ruta2='';
		}else{ 
		    $na=md5($soporte['tmp_name']).$_POST['ad'];
		    $ruta2='../../../img/'.$na; 
		    move_uploaded_file($soporte['tmp_name'], $ruta2);
		}
	}

 
 	$cor = password_hash($_POST['CLAVE'],PASSWORD_DEFAULT);
 
	include '../../conexion.php'; 
    $consultar_nivel="INSERT INTO `administradores` (`ID_ADMIN`, `NOMBRE`, `APELLIDO`, `TIPO_DOCUMENTO`, `NUMERO_DOCUMENTO`, `FECHA_NACIMIENTO`, `LUGAR_NACIMIENTO`, `DIRECCION`, `BARRIO`, `CELULAR`, `TELEFONO_CA`, `ROL`, `CLAVE`, `FOTO`, `CORREO`, `GENERO`, `ESCALAFON`, `FECHA`, `fecha_nombramiento`, `decreto_nombramiento`, `decreto_traslado`, `fecha_traslado`, `INHABILITADO`) VALUES (NULL, '".$_POST['NOMBRE']."', '".$_POST['APELLIDO']."', '".$_POST['TIPO_DOCUMENTO']."', '".$_POST['NUMERO_DOCUMENTO']."', '".$_POST['FECHA_NACIMIENTO']."', '".$_POST['LUGAR_NACIMIENTO']."', '".$_POST['DIRECCION']."', '".$_POST['BARRIO']."', '".$_POST['CELULAR']."', '".$_POST['TELEFONO_CA']."', '".$_POST['ROL']."', '".$cor."', '$ruta2', '".$_POST['CORREO']."', '".$_POST['GENERO']."', '".$_POST['ESCALAFON']."', '".$_POST['fecha2']."', '".$_POST['fecha_nombramiento']."', '".$_POST['decreto_nombramiento']."', '', '', '0')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	$recupera =$conexion->lastInsertId() ;

	$items2a=$_POST['nombre'];
	$items3a=$_POST['institucion'];
	$items4a=$_POST['ano'];   

	$r=0;
	foreach ($items2a as $key ) {


	  $sql = "INSERT INTO `titulos` (`id_titulos`, `nombre`, `institucion`, `ano`, `ID_ADMIN`) VALUES (NULL,'$key','$items3a[$r]','$items4a[$r]','$recupera')"; 
	  $consultar_nivel1=$conexion->prepare($sql);
	  $consultar_nivel1->execute(array());
	  $r=$r+1;
	}
	
	$consultar_nivel="INSERT INTO `admin_jornada_sede` (`id_admin_jornada_sede`, `id_js`, `id_admin`) VALUES (NULL, '".$_POST['sede']."', '$recupera');";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
 


}

//hoja de vida admnin en la sede
function Inhabilitarq_admin1(){
	require '../../conexion.php'; 
 	$cate=date('Y-m-d');
   echo $consultar_nivel= "UPDATE `administradores` SET `INHABILITADO` = '1',`decreto_traslado` = '".$_POST['u']."',	`fecha_traslado` = '".$cate."'  WHERE `administradores`.`ID_ADMIN` = ".$_POST['io'].""; 	
   $consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
}
function actualizar_img(){
	require '../../conexion.php'; 
  


  $Foto=$_FILES['Foto'];
    $url=$_POST['url'];
    if ($url=='') {
      $url='dsad';
    }
    $urll=substr($url, 3);
    unlink("$urll");
    $na=md5($Foto['tmp_name']).'.jpg';
    $ruta2='../../../img/'.$na;
    move_uploaded_file($Foto['tmp_name'], $ruta2);



     $consultar_nivel= "UPDATE `administradores` SET `FOTO` = '".$ruta2."' WHERE `administradores`.`ID_ADMIN` = ".$_POST['id'].""; 
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
}
function liminar_titulo(){
	
	include '../../conexion.php';
	echo$consultar_nivel="DELETE FROM `titulos` WHERE `titulos`.`id_titulos` = ".$_POST['ids'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());	

}
function actualizar_titulos1(){
	include '../../conexion.php';
	$consultar_nivel="UPDATE `titulos` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `titulos`.`id_titulos` = ".$_POST['id'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());	
}
function nuevo_titulo_admin(){
	include '../../conexion.php';
	$sql = "INSERT INTO `titulos` ( `nombre`, `institucion`, `ano`, `ID_ADMIN`,`clase`) VALUES ('','','','".$_POST['id']."','')"; 
	$consultar_nivel1=$conexion->prepare($sql);
	$consultar_nivel1->execute(array());	
}

function actualizar_admin(){
	include '../../conexion.php';
 

echo	$consultar_nivel="UPDATE `administradores` SET `".$_POST['columna']."` = '".$_POST['tex']."' WHERE `administradores`.`ID_ADMIN` = ".$_POST['id'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
}
function tabla(){
	include '../../conexion.php';
	 
	$consultar_nivel="SELECT clase,nombre FROM titulos WHERE titulos.ID_ADMIN=".$_POST['id'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	foreach ($consultar_nivel1 as $key ) { ?> 
		<i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 9px;"></i> <?php echo $key['clase']; ?>: <?php echo $key['nombre'] ?>  
 								<br><?php
	}	
}
function  titulos1(){ 
	include '../../conexion.php';
	$style=$_POST['style'];
	$consultar_nivel="SELECT * FROM titulos WHERE titulos.ID_ADMIN=".$_POST['id'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	foreach ($consultar_nivel1 as $key ) { 
		?> 
		<div class="col-md-12">
			<script type="text/javascript">
				document.getElementById('clase<?php echo $key['id_titulos'] ?>').value="<?php echo $key['clase'] ?>";
			</script>
		    <div  class="col-md-3"  id="fila<?php echo $key['id_titulos'] ?>"><br>
		      	<label for="clase">clase de titulo</label>
		      	<select style='<?php echo $style ?>' type="text" name="clase<?php echo $key['id_titulos'] ?>" id="clase<?php echo $key['id_titulos'] ?>" class="form-control"   onchange="
				var col=document.getElementById('clase<?php echo $key['id_titulos'] ?>').value;
				var nombre='clase';
				var id=<?php echo $key['id_titulos'] ?>;
				actualizar_titulo_admin(col,nombre,id) "><br>
					<option value="Tecnico">Tecnico</option>
					<option value="Tecnología">Tecnología</option>
					<option value="Profecional">Profecional</option>
					<option value="Licenciatura">Licenciatura</option>
					<option value="Seminario">Seminario</option>
					<option value="Curso">Curso</option>
					<option value="Especialización">Especialización</option>
					<option value="Maestria">Maestria</option>
					<option value="Doctorado">Doctorado</option>
					<option value="Especialización">Especialización</option>
					<option value="Especialización">Especialización</option>
				</select>
		   		<div id="wclase<?php echo $key['id_titulos'] ?>" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div>

		    </div>
		    <div  class="col-md-3"  id="fila<?php echo $key['id_titulos'] ?>"><br>
		      <label for="titulo">Titulo</label>
		      <input style='<?php echo $style ?>' type="text" name="nombre<?php echo $key['id_titulos'] ?>" id="nombre<?php echo $key['id_titulos'] ?>" class="form-control" value="<?php echo $key['nombre'] ?>" onchange="
				var col=document.getElementById('nombre<?php echo $key['id_titulos'] ?>').value;
				var nombre='nombre';
				var id=<?php echo $key['id_titulos'] ?>;
			   	actualizar_titulo_admin(col,nombre,id) ">
			   	<div id="wnombre<?php echo $key['id_titulos'] ?>" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div>
		    </div>
		    <div class="col-md-3"  id="fila<?php echo $key['id_titulos'] ?>"><br>
		      <label for="institucion">Graduado en</label>
		      <input  style='<?php echo $style ?>' type="text" name="institucion<?php echo $key['id_titulos'] ?>" id="institucion<?php echo $key['id_titulos'] ?>" class="form-control" value="<?php echo $key['institucion'] ?>" onchange="
				var col=document.getElementById('institucion<?php echo $key['id_titulos'] ?>').value;
				var nombre='institucion';
				var id=<?php echo $key['id_titulos'] ?>;
		   		actualizar_titulo_admin(col,nombre,id) ">
		   		<div id="winstitucion<?php echo $key['id_titulos'] ?>" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div>
		    </div>
		    <div class="col-md-2"   id="fila<?php echo $key['id_titulos'] ?>"><br>
		      <label for="ano">Año</label>
		      <input style='<?php echo $style ?>' type="text" name="ano<?php echo $key['id_titulos'] ?>" id="ano<?php echo $key['id_titulos'] ?>" class="form-control" value="<?php echo $key['ano'] ?>" onchange="
				var col=document.getElementById('ano<?php echo $key['id_titulos'] ?>').value;
				var nombre='ano';
				var id=<?php echo $key['id_titulos'] ?>;
		   		actualizar_titulo_admin(col,nombre,id) ">
		   		<div id="wano<?php echo $key['id_titulos'] ?>" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div>
		    </div>
		    <div  class="col-md-1"  id="fila<?php echo $key['id_titulos'] ?>"><br>

		    	<a onclick=" var ids=<?php echo $key['id_titulos'] ?>;  liminar_titulo1(ids)">
		      <img style="width: 25px;margin-top: 28px" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
		      </a>
		    </div> 
	    </div>
	 
  
		
    <?php
	}
}
///fin


function carga(){
	include '../../conexion.php';
	$consultar_nivel="SELECT area.nombre,grado.nombre,curso.numero,grado.numero from curso, grado, area,are_grado_sede,grado_sede WHERE are_grado_sede.id__docente='".$_POST['id_docente']."' and are_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_jornada_sede='".$_POST['id_js']."' AND are_grado_sede.id_area=area.id_area and grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso ORDER by grado.numero";
	$s=$consultar_nivel;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$cont=0;

	$area='';
	$grado='';
	$curso='';
	foreach ($consultar_nivel1 as $key ) {
		
		if ($grado!=$key[1] or $curso!=$key[2]) {
			?>

	
		<div style="width: 100%">
			<div data-toggle="collapse" data-target="#demo1" style="  color:#fff;  margin-left: 20px;    background-color: #33b5e5; 
		 	color: #fff;  border-radius: 3px;padding: 5px;  
		  	border: 3px solid #00acd6; " class="" aria-expanded="true">grado: <?php  echo $key[1];  ?> - curso: <?php  echo $key[2];  ?> 
			</div>
		</div>
	 <?php
		
		 
		}

		else{

		}
		?>
		<div style="margin-left: 27px;margin-top: 10px;margin-bottom: 10px"><input type="" class="form-control" value="<?php echo $key[0];  ?>" name="" disabled></div>
		<?php
		$cont++;
		$area=$key[0];
		$grado=$key[1];
		$curso=$key[2];
	}
}


function ver_DOCENTE(){ 


    include "../../conexion.php";
    if(isset($_POST['dato'])){
     $d=$_POST['dato'];
 }else{
  $d='';
}
if(isset($_POST['i'])){
   $paginaActual = $_POST['i'];
}else{
   $paginaActual=1;
}
 

        $consultar_nivel="SELECT q.id_docente,q.nombre,q.apellido,q.genero,q.foto from( SELECT docente.id_docente,docente.nombre,docente.apellido,docente.genero,docente.foto FROM docente,are_grado_sede,grado_sede WHERE grado_sede.id_jornada_sede='".$_POST['id_js']."'   and grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id__docente=docente.id_docente and docente.inhabilitado=0 GROUP by docente.id_docente)as q  WHERE q.nombre like ('%$d%') or q.apellido like('%$d%') ";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
   $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}
echo  '<br>';
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';




 


if($paginaActual > 1){
  $fttg1=    $lista = $lista.' 
  <ul class="pagination" style="cursor: pointer;">  

<li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
      <a class="page-link">Anterior</a>
    </li>
';
}else{
    $lista = $lista.'<nav aria-label="...">
  <ul class="pagination">  

<li class="page-item disabled "   >
      <a class="page-link">Anterior</a>
    </li>
';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
     $lista = $lista.'

    <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
      <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </span>
    </li> ';
 }else{
  $lista = $lista.'
    <li class="page-item  "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
      <a class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </a>
    </li> ';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'  

<li class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
      <a class="page-link">siguiente</a>
    </li>';
  $o=0;
}else{
   $lista = $lista.'  

<li class="page-item  disabled "   ">
      <a class="page-link">Siguiente</a>
    </li>';
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}


        $consultar_nivel="SELECT q.id_docente,q.nombre,q.apellido,q.genero,q.foto from( SELECT docente.id_docente,docente.nombre,docente.apellido,docente.genero,docente.foto FROM docente,are_grado_sede,grado_sede WHERE grado_sede.id_jornada_sede='".$_POST['id_js']."'   and grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id__docente=docente.id_docente and docente.inhabilitado=0  GROUP by docente.id_docente )as q  WHERE q.nombre like ('%$d%') or q.apellido like('%$d%')  LIMIT $limit, $nroLotes  ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
if ($registrow>0) {
	 
	?>  
	<form method="post" id="eliminis">

	   <div class="box-body no-padding">

	       <div class="mailbox-controls">

	        <!-- Check all button -->
	      
	        <div class="btn-group"> 
			<button  type="button" id="f" class="lop btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
			    
			    </button>
	 
	          <?php if($paginaActual > 1){
	            echo  ' <button type="button" class="lop"  style="" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

	            <?php
	            if($paginaActual < $nroPaginas){ echo  ' <button type="button" style=";" class="lop " id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
	        </div>
	        <!-- /.btn-group --> 
	        <div class="pull-right">

	            <?php 

	            $aaa=$registrow+0;
	            $aa=$paginaActual+0;
	            $g=$aa *$aaa;
	            if ($o==0) {
	               echo $g .'-'.$paginaActual.'/'. $nroProductos ;
	           }else{
	            echo $nroProductos;

	            echo   '-'.$paginaActual.'/'. $nroProductos ;
	        }





	        ?>
	        <div class="btn-group"> 

	            <?php if($paginaActual > 1){
	              echo  ' <button type="button" class="lop" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

	              <?php
	              if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="lop" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

	          </div>
	          <!-- /.btn-group -->
	      </div>
	      <!-- /.pull-right -->
	  </div>

	  <div class="table-responsive mailbox-messages" >

	 


	 

	  <br><table class="table table-striped  table-hover">
	     <tr> 
	     	<th>#</th>
	        <th ">Foto </th>
	        <th>Nombre</th> 
	        <th>carga academica</th>
	        <th>Ihabilitar</th>   <?php
	        $conta=0;
	        foreach ($registro as $var) {

	         ?>
	         <tr> 
	         	<td> <input class="sss" type="checkbox" name="id[]" value="<?php echo $var['id_docente'] ?>"></td>
	            <td>  
	<div class="pull-left image">
	          <img style="    margin: 0 auto;
	    width: 80px;border-radius: 47%;
	    height: 80px;
	    padding: 3px;
	    border: 3px solid #d2d6de;" src="<?php if($var['foto']=='' && $var['genero']=='0'){echo '../../../logos/masculino.png';}  if($var['foto']=='' && $var['genero']=='1'){echo '../../../logos/femenino.png';}else{  echo($var['foto']); } ?>" alt="User profile picture" class=" " alt="User Image">
	        </div>




	            </td>
	            <td>
	                <?php echo($var['nombre']); ?> <?php echo($var['apellido']); ?> 
	            </td> 
	             
	            
					<td><a style="top: -8px" onclick=" 
	                var id_docente= <?php echo $var['id_docente'] ?>; docente(id_docente) " data-toggle="modal" data-target="#my" data-title="Ver carga acdemica">
	                <img style=" width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+">
	              </a></td>
	            <td>                  
	              <a href="#"  style="top: -7px; " data-toggle="modal" data-target="#mymodal1"     data-title="Inhabilitar docente "  onclick="
	               document.getElementById('eliminary2').value=<?php echo($var['id_docente']); ?>; " > 
	                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
	              </a>
	            </td>

	</tr> <?php  
	}
	echo "

	";?></table>

	 
	 <div  class="mailbox-controls">
	 
	 

	 <div class="btn-group" style="float: left;"> 
	 	<nav aria-label="..."> <ul class="pagination" id="pagination"><li  class="page-item  disabled "><button  type="button" id="t" class="lop btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    
    </button></li><?php echo  $lista ?> </ul></nav>


	</div><div class="pull-right" style="margin-top: 44px; margin-right: 25px"><?php  echo $nroProductos ?> archivos en  total

	</div>
	</div>
	</div></form>  


  <script type="text/javascript">
       $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
    </script>
 
<?php
}else{
	?>

	<div class="alert bg-info-500" role="alert " style="margin: 30px; color: #0a6ebd; background-color: #e3f2fd;border-color: #82c4f8;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button><strong style="float: ">Informacion!</strong>  <br> Está sede  no tiene ningun docente, debes registrar la carga academica por medio del curso o del profesor   </div> 
  
	<?php
}

} 
function actualizar_jornada_sede(){
	include '../../conexion.php';
	$id_js=$_POST['id_js'];
	$id=$_POST['id'];
	$consultar_nivel2="UPDATE `jornada_sede` SET `id_coordinador` = '$id' WHERE `jornada_sede`.`ID_JS` = '$id_js'";
	$registro=$conexion->prepare($consultar_nivel2);
	$registro->execute(array());
}
function Inhabilitar_administrador(){
	include '../../conexion.php';
	$id_js=$_POST['id_js'];
	$io=$_POST['io'];
	$consultar_nivel="
 	UPDATE `jornada_sede` SET `id_coordinador` = '0' WHERE `jornada_sede`.`ID_JS` = '$id_js';
	UPDATE `administradores` SET `INHABILITADO` = '1' WHERE `administradores`.`ID_ADMIN` = '$io';";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());	
}
function coodinador_ver(){
	include '../../conexion.php';
	$id_js=$_POST['id_js'];


	$ID_ADMIN='';

	$consultar_nivel="SELECT administradores.GENERO, administradores.ID_ADMIN,administradores.CORREO,administradores.FOTO,administradores.NOMBRE,administradores.APELLIDO,administradores.TIPO_DOCUMENTO,administradores.NUMERO_DOCUMENTO,administradores.CELULAR,administradores.TELEFONO_CA,administradores.DIRECCION,administradores.BARRIO FROM administradores,jornada_sede WHERE jornada_sede.ID_JS='$id_js' and jornada_sede.id_coordinador=administradores.ID_ADMIN";

	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$nroProductos=$consultar_nivel1->rowCount();
	foreach ($consultar_nivel1 as $key) {
	 	 $GENERO=$key['GENERO'];
	 	$FOTO=$key['FOTO'];
	 	$NOMBRE=$key['NOMBRE'];
	 	$APELLIDO=$key['APELLIDO'];
		$TIPO_DOCUMENTO=$key['TIPO_DOCUMENTO'];
		$NUMERO_DOCUMENTO=$key['NUMERO_DOCUMENTO'];
		$CELULAR=$key['CELULAR'];
		$TELEFONO_CA=$key['TELEFONO_CA'];
		$DIRECCION=$key['DIRECCION'];
		$BARRIO=$key['BARRIO']; 
		$CORREO=$key['CORREO']; 
		$ID_ADMIN=$key['ID_ADMIN']; 
		 
		if($TIPO_DOCUMENTO=='1'){
			$tipo='Tarjeta de Identidad';
		}
		if($TIPO_DOCUMENTO=='2'){
			$tipo='Cedula de Ciudadania';
		}
		if($TIPO_DOCUMENTO=='3'){
			$tipo='Cedula Extranjeria';
		}
		if($TIPO_DOCUMENTO=='4'){
			$tipo='Pasaporte';
		}
		if($TIPO_DOCUMENTO=='5'){
			$tipo='Permiso Especial Permanencia(PEP)';
		}
		if($TIPO_DOCUMENTO=='6'){
			$tipo='Registro Civil';
		}
	}
	$consultar_nivel2="SELECT administradores.GENERO, administradores.FOTO,administradores.NOMBRE,administradores.APELLIDO,administradores.ID_ADMIN FROM administradores  WHERE administradores.INHABILITADO='0' and   administradores.ROL='Coordinador' AND administradores.ID_ADMIN NOT IN('$ID_ADMIN')";
	$registro=$conexion->prepare($consultar_nivel2);
	$registro->execute(array());

	?>
	<div class="row"   style=""> <div id="_MSG_" style="margin: 20px"></div>
		<?php 
		if ($nroProductos>0) { ?>
			<div class="col-md-4 "    > 
				<div class="box-body box-profile" id="imagen"  style="">
					<img class="profile-user-img img-responsive img-circle" src="<?php if($FOTO=='' && $GENERO=='1'){echo '../../../logos/femenino.png';}  if($FOTO=='' && $GENERO=='0'){echo '../../../logos/masculino.png';}else{  echo($FOTO); } ?>" alt="User profile picture" style="    margin: 0 auto;width: 180px;height: 180px;padding: 3px;border: 3px solid #d2d6de;">
					 
						 
					<link rel="stylesheet" href="../../../css/chosen.css">
					<link rel="stylesheet" href="../../../css/ImageSelect.css">
					 
					<script src="../../../js/chosen.jquery.js"></script>
					<script src="../../../js/ImageSelect.jquery.js"></script>
					<center><br>
						<select id="docenteq" class="   form-control my-select" style="float: left; width: 78%   "  onchange="myFunction()"    >
						<option value="">Seleccione un Coodinador</option><?php
							foreach ($registro as   $value) { ?> 
								<option data-img-src="<?php if($value['FOTO']=='' && $value['GENERO']=='1'){echo '../../../logos/femenino.png';}  if($value['FOTO']=='' && $value['GENERO']=='0'){echo '../../../logos/masculino.png';}else{  echo($value['FOTO']); } ?>" 
									alt="User profile picture"   value="<?php echo $value['ID_ADMIN'] ?>"><?php echo $value['NOMBRE'].' '.$value['APELLIDO'] ?></option>  
								<?php
							}?> 
						</select>
						<button type="button" class="btn btn-primary" name="foto" onclick="
						var id=document.getElementById('docenteq').value; 
						if(id==''){mensaje(2,'Seleccione un coordinador'); return;}else{   sasa(id);}"  style="border-radius: 0px;">Subir</button>
					</center> <br> 
					<a  data-toggle="modal" data-target="#sww" onclick=" document.getElementById('eliminary3').value=<?php echo $ID_ADMIN ?>; ">
						<div class="btn btn-default btn-file" style="width: 100% ;background-color: #d73925;color: #fff">
							<img style="margin-right: 5px; width: 20px" src="data:image/svg+xml;base64,
							PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTUxMC4zNzEsMjI2LjUxM2MtMS4wODgtMi42MDMtMi42NDUtNC45NzEtNC42MjktNi45NTVsLTYzLjk3OS02My45NzljLTguMzQxLTguMzItMjEuODI0LTguMzItMzAuMTY1LDAgICAgIGMtOC4zNDEsOC4zNDEtOC4zNDEsMjEuODQ1LDAsMzAuMTY1bDI3LjU4NCwyNy41ODRIMzIwLjAxM2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzNzOS41MzYsMjEuMzMzLDIxLjMzMywyMS4zMzMgICAgIGgxMTkuMTY4bC0yNy41ODQsMjcuNTg0Yy04LjM0MSw4LjM0MS04LjM0MSwyMS44NDUsMCwzMC4xNjVjNC4xNiw0LjE4MSw5LjYyMSw2LjI1MSwxNS4wODMsNi4yNTFzMTAuOTIzLTIuMDY5LDE1LjA4My02LjI1MSAgICAgbDYzLjk3OS02My45NzljMS45ODQtMS45NjMsMy41NDEtNC4zMzEsNC42MjktNi45NTVDNTEyLjUyNSwyMzcuNjA2LDUxMi41MjUsMjMxLjcxOCw1MTAuMzcxLDIyNi41MTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGN0Y1RjUiIGRhdGEtb2xkX2NvbG9yPSIjM0YzRjNGIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0zNjIuNjgsMjk4LjY2N2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzN2MTA2LjY2N2gtODUuMzMzVjg1LjMzM2MwLTkuNDA4LTYuMTg3LTE3LjcyOC0xNS4yMTEtMjAuNDM3ICAgICBsLTc0LjA5MS0yMi4yMjloMTc0LjYzNXYxMDYuNjY3YzAsMTEuNzc2LDkuNTM2LDIxLjMzMywyMS4zMzMsMjEuMzMzczIxLjMzMy05LjU1NywyMS4zMzMtMjEuMzMzdi0xMjggICAgIEMzODQuMDEzLDkuNTU3LDM3NC40NzcsMCwzNjIuNjgsMEgyMS4zNDdjLTAuNzY4LDAtMS40NTEsMC4zMi0yLjE5NywwLjQwNWMtMS4wMDMsMC4xMDctMS45MiwwLjI3Ny0yLjg4LDAuNTEyICAgICBjLTIuMjQsMC41NzYtNC4yNjcsMS40NTEtNi4xNjUsMi42NDVjLTAuNDY5LDAuMjk5LTEuMDQ1LDAuMzItMS40OTMsMC42NjFDOC40NCw0LjM1Miw4LjM3Niw0LjU4Nyw4LjIwNSw0LjcxNSAgICAgQzUuODgsNi41NDksMy45MzksOC43ODksMi41MzEsMTEuNDU2Yy0wLjI5OSwwLjU3Ni0wLjM2MywxLjE5NS0wLjU5NywxLjc5MmMtMC42ODMsMS42MjEtMS40MjksMy4yLTEuNjg1LDQuOTkyICAgICBjLTAuMTA3LDAuNjQsMC4wODUsMS4yMzcsMC4wNjQsMS44NTZjLTAuMDIxLDAuNDI3LTAuMjk5LDAuODExLTAuMjk5LDEuMjM3VjQ0OGMwLDEwLjE3Niw3LjE4OSwxOC45MjMsMTcuMTUyLDIwLjkwNyAgICAgbDIxMy4zMzMsNDIuNjY3YzEuMzg3LDAuMjk5LDIuNzk1LDAuNDI3LDQuMTgxLDAuNDI3YzQuODg1LDAsOS42ODUtMS42ODUsMTMuNTI1LTQuODQzYzQuOTI4LTQuMDUzLDcuODA4LTEwLjA5MSw3LjgwOC0xNi40OTEgICAgIHYtMjEuMzMzSDM2Mi42OGMxMS43OTcsMCwyMS4zMzMtOS41NTcsMjEuMzMzLTIxLjMzM1YzMjBDMzg0LjAxMywzMDguMjI0LDM3NC40NzcsMjk4LjY2NywzNjIuNjgsMjk4LjY2N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y3RjVGNSIgZGF0YS1vbGRfY29sb3I9IiMzRjNGM0YiPjwvcGF0aD4KCQk8L2c+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==">Inhabilitar cuenta 
						</div>
					</a>
					<script>
						    
					 
					 $(".my-select").chosen()({
					 	     placeholder: "Select a state",
					    allowClear: true
					});
					</script>
				</div>
			</div>
			<div class="col-md-8" style="width: "> 
				<div class="tab-content">
					<div class="active tab-pane" id="activity">
					<form id="myForm" action="" method="post">
					<div class="row">
					<div class="col-md-12">
					<div class="col-md-6">
					<label for="documento">Tipo de documento</label>
				 
					<input type=" " value=" <?php echo $tipo ?>" class="form-control"   disabled >
					</div>
					<div class="col-md-6">
					<label for="genero">numero de documento</label>
					 
					<input  value=" <?php echo $NUMERO_DOCUMENTO ?>" class="form-control"    disabled>
					</div>
					</div>
					<div class="col-md-12">
					<div class="col-md-6">
					<label for="nombre">Nombres</label>
					<input type="text" name="nombre" id="nombre" class="form-control" value=" <?php echo $NOMBRE ?>" disabled>
					</div>
					<div class="col-md-6">
					<label for="apellido">Apellidos</label>
					<input type="text" name="apellido" id="apellido" class="form-control"value=" <?php echo $APELLIDO ?>" disabled>
					</div>
					</div>
					<div class="col-md-12">
					<div class="col-md-6">
					<label for="fecha_n">Celular</label>
					<input type=" " name="fecha_n" id="fecha_n" class="form-control" value=" <?php echo $CELULAR ?>" disabled>
					</div>
					<div class="col-md-6">
					<label for="lugar_n">Telefono</label>
					<input type="text" name="lugar_n" id="lugar_n" class="form-control" value=" <?php echo $TELEFONO_CA ?>" disabled>
					</div>
					</div>
					<div class="col-md-12">
					<div class="col-md-6">
					<label for="email">Barrio</label>
					<input type="email" name="email" id="email" class="form-control"  value=" <?php echo $BARRIO ?>" disabled>
					</div>
					<div class="col-md-6">
					<label for="celular">Dirección</label>
					<input type=" " name="celular" id="celular" class="form-control"  value=" <?php echo $DIRECCION ?>" disabled>
					</div>
					</div>
					<div class="col-md-12">
					<div class="col-md-12">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control"  value=" <?php echo $CORREO ?>" disabled>
					</div>
					 
					</div>
					</div>
					</form>
					</div>
				  
					<!-- /.tab-pane -->
				</div>
			</div><?php 
		} else{?>  
				<div class="col-md-4 "    > 
					<div class="box-body box-profile" id="imagen"  style="">
						<link rel="stylesheet" href="../../../css/chosen.css">
						<link rel="stylesheet" href="../../../css/ImageSelect.css"> 
						<script src="../../../js/chosen.jquery.js"></script>
						<script src="../../../js/ImageSelect.jquery.js"></script>
						<center>
							<select id="docenteq" class="form-control my-select" style="float: left; width: 74%   "  onchange="myFunction()"    >
								<option value="">Seleccione un Coordinador</option><?php
								foreach ($registro as   $value) { ?> 
									<option data-img-src="<?php if($value['FOTO']=='' && $value['GENERO']=='1'){echo '../../../logos/femenino.png';}  if($value['FOTO']=='' && $value['GENERO']=='0'){echo '../../../logos/masculino.png';}else{  echo($value['FOTO']); } ?>" alt="User profile picture"   value="<?php echo $value['ID_ADMIN'] ?>"><?php echo $value['NOMBRE'].' '.$value['APELLIDO'] ?></option>  
										<?php
								}?> 
							</select>
							<button type="button" class="btn btn-primary" name="foto" onclick="
						var id=document.getElementById('docenteq').value;  
						if(id==''){mensaje(2,'Seleccione un coordinador'); return;}else{   sasa(id);}"  style="border-radius: 0px;">Subir</button>
						</center>
					</div>
				</div> 
				<div class="col-md-12 "    > 
					<div class="alert bg-info-500" role="alert " style="margin: 30px; color: #0a6ebd; background-color: #e3f2fd;border-color: #82c4f8;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button><strong style="float: ">Informacion!</strong>  <br> No hay Coordinadores encargado de esta sede </div> 
				</div>
				<script>
						    
					 
					 $(".my-select").chosen()({
					 	     placeholder: "Select a state",
					    allowClear: true
					});
					</script>
			<?php } ?>
	</div>

    					<?php
}

 
?>