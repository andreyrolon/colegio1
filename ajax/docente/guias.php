 



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


function crear()
{
  $tema=$_POST['tema']; 
  $fecha=$_POST['fecha'];
  $curso1=$_POST['curso1'];
  $porciones2 = explode(" ", $curso1);
  $grado=$porciones2[0];
  $curso=$porciones2[1]; 

  $jornada_sede1=$_POST['jornada_sede1']; 
  $porciones3 = explode(" ", $jornada_sede1);
  $id_jornada_sede=$porciones3[0];

  $Asignaturas=$_POST['Asignaturas'];
  $porciones = explode(",", $Asignaturas); 
  $id_area_tecno=$porciones[2];

  date_default_timezone_set("America/Bogota"); 
  $fecha_r=date("Y-m-d");
  $numero=$_SESSION['numero'];

    if(isset($_FILES['files'])){ 
      $soporte=$_FILES['files'];
    }
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../guias/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2=$na;
    }
 

  include "../../codes/rector/conexion.php";echo "string";
  echo $consultar_nivel="
  INSERT INTO `guias` (`nombre`, `guia`, `id_grado`, `id_curso`, `id_jornada_sede`, `fecha_presentacion`, `fecha_registro`, `id_periodo`, `id_area`) VALUES ('$tema', '$ruta2', '$grado', '$curso', '$id_jornada_sede', '$fecha', '$fecha_r', '$numero','$id_area_tecno')";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}
function crear2()
{
  $tema=$_POST['tema']; 
  $fecha=$_POST['fecha']; 
  $graditos=$_POST['graditos'];
  $porciones2 = explode(",", $graditos);
  $grado=$porciones2[2];
  $area=$porciones2[3]; 
 
 

  date_default_timezone_set("America/Bogota"); 
  $fecha_r=date("Y-m-d");
  $numero=$_SESSION['numero'];

    if(isset($_FILES['files'])){ 
      $soporte=$_FILES['files'];
    }
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../guias/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2=$na;
    }
 

  include "../../codes/rector/conexion.php";echo "string";
  echo $consultar_nivel="
  INSERT INTO `guias` (`nombre`, `guia`, `id_grado`, `id_curso`, `id_jornada_sede`, `fecha_presentacion`, `fecha_registro`, `id_periodo`, `id_area`) SELECT '$tema','$ruta2',grado_sede.id_grado,grado_sede.id_curso ,grado_sede.id_jornada_sede,'$fecha','$fecha_r','".$_SESSION['numero']."',are_grado_sede.id_area from are_grado_sede,grado_sede WHERE are_grado_sede.id_area=$area and are_grado_sede.id__docente='".$_SESSION['Id_Doc']."' and grado_sede.id=are_grado_sede.id_grado_sede and grado_sede.id_grado=$grado ";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}
function crear3()
{
  $tema=$_POST['tema']; 
  $fecha=$_POST['fecha']; 
  $graditos=$_POST['graditos'];
  $porciones2 = explode(",", $graditos);
  $grado=$porciones2[2];
  $area=$porciones2[3]; 
 
 

  date_default_timezone_set("America/Bogota"); 
  $fecha_r=date("Y-m-d");
  $numero=$_SESSION['numero'];

    if(isset($_FILES['files'])){ 
      $soporte=$_FILES['files'];
    }
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../guias/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2=$na;
    }
 

  include "../../codes/rector/conexion.php";echo "string";
  echo $consultar_nivel="
   INSERT INTO `guias` (`nombre`, `guia`, `id_grado`, `id_curso`, `id_jornada_sede`, `fecha_presentacion`, `fecha_registro`, `id_periodo`, `id_area`)SELECT '$tema', '$ruta2', w.id_grado,w.id_curso,w.id_jornada_sede, '$fecha', '$fecha_r','".$_SESSION['numero']."', w.id_area  from (SELECT area.codigo,area.area, grado_sede.id_grado,grado_sede.id_curso ,grado_sede.id_jornada_sede, are_grado_sede.id_area from are_grado_sede,grado_sede ,area WHERE are_grado_sede.id__docente=53 and grado_sede.id=are_grado_sede.id_grado_sede and area.id_area=are_grado_sede.id_area )as w WHERE w.codigo='01' or w.area not in('1')
 ";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}
function crear_tecnico3()
{
  $tema=$_POST['tema']; 
  $fecha=$_POST['fecha']; 
  $graditos=$_POST['graditos'];
  $porciones2 = explode(",", $graditos);
  $grado=$porciones2[2];
  $area=$porciones2[3]; 
 
 

  date_default_timezone_set("America/Bogota"); 
  $fecha_r=date("Y-m-d");
  $numero=$_SESSION['numero'];

    if(isset($_FILES['files'])){ 
      $soporte=$_FILES['files'];
    }
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../guias/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2=$na;
    }
 

  include "../../codes/rector/conexion.php";echo "string";
  echo $consultar_nivel="

INSERT INTO `guias_tecnico` (`nombre`, `guia`, `id_grado`, `id_curso`, `id_jornada_sede`, `fecha_presentacion`, `fecha_registro`, `id_periodo`, `id_competencia`) SELECT  '$tema','$ruta2', grado_sede.id_grado,grado_sede.id_curso,grado_sede.id_jornada_sede,'$fecha','$fecha_r','".$_SESSION['numero']."',competencias.id_competencias from competencias,tecnica_grado_sede,grado_sede WHERE grado_sede.id=tecnica_grado_sede.id_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede and competencias.id_docente='".$_SESSION['Id_Doc']."'  and competencias.id_periodo='".$_SESSION['numero']."'";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}

function crear_tecnico2()
{
  
  $tema=$_POST['tema']; 
  $fecha=$_POST['fecha']; 
  $graditos=$_POST['graditos'];
  $porciones2 = explode(",", $graditos);
  $competencia=$porciones2[0];
  $area=$porciones2[3]; 

  date_default_timezone_set("America/Bogota"); 
  $fecha_r=date("Y-m-d");
  $numero=$_SESSION['numero'];

    if(isset($_FILES['files'])){ 
      $soporte=$_FILES['files'];
    }
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../guias/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2=$na;
    }
 

  include "../../codes/rector/conexion.php";echo "string";
  echo $consultar_nivel="

INSERT INTO `guias_tecnico` (`nombre`, `guia`, `id_grado`, `id_curso`, `id_jornada_sede`, `fecha_presentacion`, `fecha_registro`, `id_periodo`, `id_competencia`)   SELECT  '$tema','$ruta2', grado_sede.id_grado,grado_sede.id_curso,grado_sede.id_jornada_sede,'$fecha','$fecha_r','".$_SESSION['numero']."',competencias.id_competencias from competencias,tecnica_grado_sede,grado_sede WHERE grado_sede.id=tecnica_grado_sede.id_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede and competencias.nombre= '$competencia'  and competencias.id_docente='".$_SESSION['Id_Doc']."'  and competencias.id_periodo='".$_SESSION['numero']."'";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}

function crear_tecnico()
{
  $tema=$_POST['tema']; 
  $fecha=$_POST['fecha'];
  $curso1=$_POST['curso1'];
  $porciones2 = explode(" ", $curso1);
  $grado=$porciones2[0];
  $curso=$porciones2[1]; 

  $jornada_sede1=$_POST['jornada_sede1']; 
  $porciones3 = explode(" ", $jornada_sede1);
  $id_jornada_sede=$porciones3[0];

  $Asignaturas=$_POST['Asignaturas'];
  $porciones = explode(",", $Asignaturas); 
  $id_area_tecno=$porciones[2];

  date_default_timezone_set("America/Bogota"); 
  $fecha_r=date("Y-m-d");
  $numero=$_SESSION['numero'];

    if(isset($_FILES['files'])){ 
      $soporte=$_FILES['files'];
    }
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../guias/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2=$na;
    }
 

  include "../../codes/rector/conexion.php";echo "string";
  echo $consultar_nivel="

INSERT INTO `guias_tecnico` (`nombre`, `guia`, `id_grado`, `id_curso`, `id_jornada_sede`, `fecha_presentacion`, `fecha_registro`, `id_periodo`, `id_competencia`)   VALUES ('$tema', '$ruta2', '$grado', '$curso', '$id_jornada_sede', '$fecha', '$fecha_r', '$numero','$id_area_tecno')";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}


function eliminar(){
  include "../../codes/rector/conexion.php";
  $id_guia=$_POST['id_guia'];
  $consultar_nivel=" DELETE FROM `guias` WHERE `guias`.`id_guias` = $id_guia";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}

function eliminar2(){
  include "../../codes/rector/conexion.php";
  $id_guias_tecnico=$_POST['id_guias_tecnico'];
  $consultar_nivel=" DELETE FROM `guias_tecnico` WHERE `guias_tecnico`.`id_guias_tecnico` = $id_guias_tecnico";
  $consultar_nivel=$conexion->prepare($consultar_nivel);
  $consultar_nivel->execute(array());

}

function actualizar_guia1_1(){
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $colum=$_POST['colum'];
    $consultar_nivel="UPDATE `guias` SET `$colum` = '$nombre' WHERE `guias`.`id_guias` = $id";
    $consultar_nivel=$conexion->prepare($consultar_nivel);
    $consultar_nivel->execute(array());

}
function actualizar_guia2_1(){
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $colum=$_POST['colum'];
      $consultar_nivel="UPDATE `guias_tecnico` SET `$colum` = '$nombre' WHERE `guias_tecnico`.`id_guias_tecnico` = $id";
    $consultar_nivel=$conexion->prepare($consultar_nivel);
    $consultar_nivel->execute(array());

}




function tabla_academico()
{

 
    include "../../codes/rector/conexion.php";
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
 $id=$_SESSION['Id_Doc'];

  $consultar_nivel="SELECT q.grado,q.curso,q.area,q.sede,q.jornada,q.nombre,q.fecha_presentacion,q.id_periodo,q.guia,q.id_guias from (SELECT grado.nombre as grado,curso.numero as curso ,sede.NOMBRE  as sede,jornada.NOMBRE as jornada ,area.nombre as area ,guias.nombre,guias.fecha_presentacion,guias.id_periodo,guias.guia,guias.id_guias FROM curso,grado_sede,grado,jornada_sede,jornada,sede,guias,are_grado_sede,area WHERE are_grado_sede.id__docente=$id and grado_sede.id=are_grado_sede.id_grado_sede and grado.id_grado=grado_sede.id_grado and grado_sede.id_curso=curso.id_curso and grado_sede.id_jornada_sede=jornada_sede.ID_JS AND jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA AND are_grado_sede.id_area=area.id_area and guias.id_grado=grado_sede.id_grado and guias.id_jornada_sede=grado_sede.id_jornada_sede and guias.id_curso=curso.id_curso ) as q where q.nombre like('%$d%') or q.area  like('%$d%') or q.sede like('%$d%') or q.grado like('%$d%') or q.jornada like('%$d%') GROUP by q.id_guias ORDER by q.id_guias desc "; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $con2=$consultar_nivel1->fetchAll();
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


      
?>  
<form method="post" id="eliminis">

   <div class="box-body no-padding">

       <div class="mailbox-controls">

        <!-- Check all button -->
      
        <div class="btn-group"> 

 
          <?php if($paginaActual > 1){
            echo  ' <button type="button" class="lop"  style="" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button" style=";" class="lop " id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
        </div>
        <!-- /.btn-group --> 
        <div class="pull-right">

            <?php 

            $aaa=$nroProductos+0;
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


 

  <br><table class="table table-striped  table-hover" style=" margin: px">
     <tr>
        <th>Sede </th>
        <th>Jornada</th>
        <th>Curso</th>
        <th>Materia</th>
        <th>Periodo</th> 
        <th width="400">Descripción</th> 
        <th   >Mostrar</th> 
        <th   >Actualizar</th>  
        <th >Eliminar</th>
        </tr>  <?php
        foreach (array_slice($con2, $limit, $nroLotes) as $var  )  {

         ?>
         <tr>
            <td>
                <?php echo($var['sede']); ?>
            </td>
            <td>
                <?php echo($var['jornada']); ?>
            </td>
            <td>
                <?php echo($var['grado']); ?>-
                <?php echo($var['curso']); ?>
            </td>
            <td>
                <?php echo($var['area']); ?>
            </td>
            <td>
                <?php echo($var['id_periodo']); ?>
            </td>          
            <td>
                <?php echo($var['nombre']);  ?>

            </td> 
            <td>
              <a  style="top: -8px"   onclick=" 
                var guia=document.getElementById('tito').value='<?php  echo  $var['guia'];?>'; funcion(guia) " data-toggle="modal" data-target="#my"data-title="actualizar documento"  data-title="mostrar documento">
                <img style=" width: 42px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+" />
              </a>
            </td>
            <td> 
              <a href="#"  style="top: -7px; "  data-toggle="modal" data-target="#mymodal5"data-title="actualizar documento"  onclick="document.getElementById('id_guias1').value='<?php echo($var['id_guias']); ?>'; 
                document.getElementById('fecha1').value='<?php  echo  $var['fecha_presentacion'];?>'; 
                document.getElementById('nombre1').value='<?php  echo  $var['nombre'];?>'; 
                document.getElementById('vista1').value='<?php  echo  $var['guia'];?>'; 
                document.getElementById('guia1').value='<?php  echo  $var['guia'];?>'; ">
                <img src="../../../logos/actualizar.png" alt="" width="35"  style="top: 0px;padding-top: 0">
              </a> 
            </td>
            

            <td>                  
              <a href="#"  style="top: -7px; " data-toggle="modal" data-target="#mymodal2"     data-title="Eliminar documento"  onclick="
               document.getElementById('eliminary2').value=<?php echo($var['id_guias']); ?>; " > 
                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
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



function tabla_tecnico()
{

 
    include "../../codes/rector/conexion.php";
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
 
$id=$_SESSION['Id_Doc'];
$consultar_nivel="SELECT ti.competencias,ti.nombre,ti.guia,ti.id_guias_tecnico,ti.fecha_presentacion ,ti.id_periodo,ti.grado,ti.curso , ti.jornada, ti.sede from (SELECT competencias.nombre as competencias,guias_tecnico.id_guias_tecnico,guias_tecnico.nombre,guias_tecnico.guia,guias_tecnico.id_periodo,guias_tecnico.fecha_presentacion,sede.NOMBRE as sede,jornada.NOMBRE as jornada,curso.numero as curso,grado.numero as grado from guias_tecnico, competencias,tecnica_grado_sede,grado_sede,grado,curso,jornada_sede,jornada,sede WHERE competencias.id_docente=$id and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and tecnica_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_grado=grado.id_grado and grado_sede.id_jornada_sede=jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA and curso.id_curso=grado_sede.id_curso and guias_tecnico.id_grado=grado.id_grado and guias_tecnico.id_curso=curso.id_curso AND guias_tecnico.id_jornada_sede=jornada_sede.ID_JS)as ti   where ti.nombre like ('%$d%') or ti.competencias like ('%$d%') or ti.jornada like ('%$d%') or ti.id_periodo like ('%$d%') or ti.sede like ('%$d%') or ti.grado like ('%$d%')   order by ti.id_guias_tecnico desc  "; 
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

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

<li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')">
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

    <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction1('.$i.')">
      <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </span>
    </li> ';
 }else{
  $lista = $lista.'
    <li class="page-item  "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction1('.$i.')">
      <a class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </a>
    </li> ';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'  

<li class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')">
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


    
?>  
<form method="post" id="eliminis">

   <div class="box-body no-padding">

      <div class="mailbox-controls">

        <!-- Check all button -->
      
        <div class="btn-group"> 

 
          <?php if($paginaActual > 1){
            echo  ' <button type="button" class="lop"  style="" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button" style=";" class="lop " id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
        </div>
        <!-- /.btn-group --> 
        <div class="pull-right">

            <?php 

            $aaa=$nroProductos+0;
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
              echo  ' <button type="button" class="lop" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

              <?php
              if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="lop" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

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


 

  <br><table class="table table-striped  table-hover" style=" margin: px">
     <tr>
        <th>Sede </th>
        <th>Jornada</th>
        <th>Curso</th>
        <th>Materia</th>
        <th>Periodo</th> 
        <th width="400px">Descripción</th> 
        <th>Mostrara</th> 
        <th   >Actualizar</th>  
        <th  >Eliminar</th>
        </tr>  <?php 

        foreach (array_slice($registro, $limit, $nroLotes) as $var  )  {

         ?>
         <tr>
            <td>
                <?php echo($var['sede']); ?>
            </td>
            <td>
                <?php echo($var['jornada']); ?>
            </td>
            <td>
                <?php echo($var['grado']); ?>-
                <?php echo($var['curso']); ?>
            </td>
            <td>
                <?php echo($var['competencias']); ?>
            </td>
            <td>
                <?php echo($var['id_periodo']); ?>
            </td>          
            <td>
                <?php echo($var['nombre']);  ?>

            </td> 
            <td>
              <a  style="top: -8px"   onclick=" 
                var guia=document.getElementById('tito2').value='<?php  echo  $var['guia'];?>'; funcion2(guia) " data-toggle="modal" data-target="#my2"data-title="actualizar documento"  data-title="mostrar documento">
                <img style=" width: 42px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+" />
              </a>
            </td>
            <td> 
              <a href="#"  style="top: -7px; "  data-toggle="modal" data-target="#mymodal51"data-title="actualizar documento"  onclick="document.getElementById('id_guias2').value='<?php echo($var['id_guias_tecnico']); ?>'; 
                document.getElementById('fecha2').value='<?php  echo  $var['fecha_presentacion'];?>'; 
                document.getElementById('nombre2').value='<?php  echo  $var['nombre'];?>'; 
                document.getElementById('vista2').value='<?php  echo  $var['guia'];?>'; 
                document.getElementById('guia2').value='<?php  echo  $var['guia'];?>'; ">
                <img src="../../../logos/actualizar.png" alt="" width="35"  style="top: 0px;padding-top: 0">
              </a> 
            </td>
            <td>
                 
              <a href="#"  style="top: -7px; " data-toggle="modal" data-target="#mymodal21"     data-title="Eliminar evaluación"  onclick="
               document.getElementById('eliminary22').value=<?php echo($var['id_guias_tecnico']); ?>; " > 
                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
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

?>





























































 