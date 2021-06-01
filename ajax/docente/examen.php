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


function curso()
   { 
    include "../../codes/rector/conexion.php";
    $curso=$_POST['curso'];
    $id=$_SESSION['Id_Doc'];
    $con3="SELECT area.* FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN grado_sede ON grado_sede.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id__docente=$id AND grado_sede.id=$curso GROUP BY area.id_area";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
    foreach($con2 as $key){
        ?>
<option value="<?php echo($key['nombre']); ?>">
    <?php echo($key['nombre']); ?>
</option>
<?php
    }
}

function crear_examen2(){

  date_default_timezone_set("America/Bogota");
  $hora=date("H:i:s");
  $fecha=date("Y-m-d");
  $ano=date("Y") ;
  include "../../codes/rector/conexion.php";
  $Asignaturas=$_POST['Asignaturas'];
  $tema=$_POST['tema'];
  $Tiempo=$_POST['Tiempo']; 
  $Hora=$_POST['Hora'];
  $Fecha=$_POST['Fecha']; 
  $curso1=$_POST['curso1']; 
  $jornada_sede1=$_POST['jornada_sede1'];
 
  $porciones = explode(",", $Asignaturas);
  $nombre_materia=$porciones[0];
  $periodo=$porciones[1];
  $id_area_tecno=$porciones[2];
  $area=$porciones[3];
  $tipo=$porciones[4];

  $porciones2 = explode(" ", $curso1);
  $grado=$porciones2[0];
  $curso=$porciones2[1]; 


  $porciones3 = explode(" ", $jornada_sede1);
  $id_jornada_sede=$porciones3[0];
  $id_tipo_calificacion=$porciones3[1]; 

  $sql="INSERT INTO `nota_tecnologica_independiente` ( `id_curso`, `id_grado`, `id_jornada_sede`, `id_tipo_calificaciones`, `nombre`, `id_periodo`, `fecha`, `hora`, `id_competencia`, `ano`) VALUES ( '$curso', '$grado','$id_jornada_sede','$id_tipo_calificacion',  '$tema','$periodo','$fecha','$hora', '$id_area_tecno', '$ano')";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array()); 
  $id_nota=$conexion->lastInsertId();
  $id_notaq=$id_nota; 
   
    
  $a="INSERT INTO `examen_tecnica` (`id_nota_tecnologica_independiente`, `nombre_materia`, `minutos`, `fecha`, `hora`, `ano`) VALUES ('$id_notaq', '$nombre_materia', '$Tiempo', '$Fecha', '$Hora', '$g');
  INSERT INTO `tecnica_por_paso` (`nota`,`id_tecnologia`, `id_nota_tecnologia_independiente`, `id_informe_academico`, `identificador`)
  SELECT '0', tecnologia.id_tecnologia,'$id_notaq',informeacademico.id_informe_academico,'1'  from tecnologia,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$grado'    and informeacademico.id_curso='$curso'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=tecnologia.id_informe_academico   and tecnologia.id_periodo='$periodo' and tecnologia.id_competrencia='$id_area_tecno'";
  $a1=$conexion->prepare($a);
  $a1->execute(array());


   $a="SELECT tecnologia.id_tecnologia  from tecnologia,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$grado'    and informeacademico.id_curso='$curso'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=tecnologia.id_informe_academico and  tecnologia.id_periodo='$periodo' and tecnologia.id_competrencia='$id_area_tecno'";
  $a1=$conexion->prepare($a);
  $a1->execute(array()); 
  $registro=$a1->fetchAll(); 
  foreach($registro  as  $valueQ) { 

    $r1=0;$r2=0;
    $id_m=0; 
    $sum=0;
    $cont=0;
    $uno=0;
    $tipo_calificaiones1="UPDATE `tecnologia` SET `nota` = ( SELECT SUM(de.su)as f from (SELECT tecnologia.id_tecnologia, SUM(tecnica_por_paso.nota)/COUNT(tecnica_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_tecnologica_independiente,tipo_calificaiones, tecnologia,tecnica_por_paso WHERE tecnologia.id_tecnologia='".$valueQ['id_tecnologia']."'  and tecnologia.id_tecnologia=tecnica_por_paso.id_tecnologia and tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and nota_tecnologica_independiente.id_tipo_calificaciones=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `tecnologia`.`id_tecnologia` =".$valueQ['id_tecnologia'];
    $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
    $tipo_calificaiones1->execute(array());  
       
  } 
}

function crear_examen(){

    date_default_timezone_set("America/Bogota");
    $hora=date("H:i:s");
    $fecha=date("Y-m-d");
    $ano=date("Y") ;

    include "../../codes/rector/conexion.php";
    $Asignaturas=$_POST['Asignaturas'];
    $tema=$_POST['tema'];
    $Tiempo=$_POST['Tiempo']; 
    $Hora=$_POST['Hora'];
    $Fecha=$_POST['Fecha']; 
    $curso1=$_POST['curso1']; 
    $jornada_sede1=$_POST['jornada_sede1'];
 
    $porciones = explode(",", $Asignaturas);
    $nombre_materia=$porciones[0];
    $periodo=$porciones[1];
    $id_area_tecno=$porciones[2];
    $area=$porciones[3];
    $tipo=$porciones[4];

    $porciones2 = explode(" ", $curso1);
    $grado=$porciones2[0];
    $curso=$porciones2[1]; 


    $porciones3 = explode(" ", $jornada_sede1);
    $id_jornada_sede=$porciones3[0];
    $id_tipo_calificacion=$porciones3[1]; 


    if ($tipo==0) {
            
        $sql="INSERT INTO `nota_independiente` (`id_curso`, `id_grado`, `id_jornada_sede`, `id_tipo_calificacion`, `nombre`, `id_periodo`, `id_area`, `fecha`, `hora`, `ano`) VALUES ( '$curso', '$grado','$id_jornada_sede','$id_tipo_calificacion',  '$tema','$periodo', '$id_area_tecno','$fecha','$hora','$ano')";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 
        $id_nota=$conexion->lastInsertId();
        $id_notaq=$id_nota; 

        $a="
        INSERT INTO `examen` (`id_notas_independientes`, `nombre_materia`, `minutos`, `fecha`, `hora`, `ano`) VALUES ('$id_notaq', '$nombre_materia', '$Tiempo', '$Fecha', '$Hora', '$ano');


        INSERT INTO `materia_por_paso` ( `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`,`nota`,`identificador` )SELECT materia_por_periodo.id_materia_por_periodo,informeacademico.id_informe_academico,'$id_notaq','0','1'  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$grado'    and informeacademico.id_curso='$curso'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico   and materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='$id_area_tecno'";
        $a1=$conexion->prepare($a);
        $a1->execute(array());


        $a="SELECT materia_por_periodo.id_materia_por_periodo  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$grado'    and informeacademico.id_curso='$curso'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and  materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='$id_area_tecno'; ";
        $a1=$conexion->prepare($a);
        $a1->execute(array()); 


        foreach ($a1 as  $valueQ) { 

            $r1=0;$r2=0;
            $id_m=0;
            $sum=0;
            $cont=0;

            if ($area!=1 ) {

                $uno=0;

                $tipo_calificaiones1="SELECT materia_por_periodo.area, materia_por_periodo.id_materia_por_periodo, SUM(DE.su) as nos, materia_por_periodo.nota FROM 
                (SELECT materia_por_periodo.id_informe_academico,materia_por_periodo.area,materia_por_periodo.codigo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$valueQ['id_materia_por_periodo']."' and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero) AS DE,

                materia_por_periodo WHERE materia_por_periodo.periodo='$periodo' AND materia_por_periodo.id_informe_academico=DE.id_informe_academico AND materia_por_periodo.codigo=DE.codigo GROUP by materia_por_periodo.id_materia_por_periodo";
                $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                $tipo_calificaiones1->execute(array()); 
                foreach ($tipo_calificaiones1 as  $value) {
                    if($value['id_materia_por_periodo']==$valueQ['id_materia_por_periodo']){
                        $r1=$value['nos'];
                        $r2=$value['id_materia_por_periodo'];
                        $uno=1;
                    }
                    if ($value['area']==0 && $value['id_materia_por_periodo']!=$valueQ['id_materia_por_periodo']) {
                        $cont=$cont+1;
                        $sum=$sum+$value['nota'];
                    }

                    if ($value['area']==1) {
                        $id_m=$value['id_materia_por_periodo'];
                    }
                }
                $cont=$cont+$uno;
                $sum=$sum+$r1;
                $sum1=$sum/$cont    ;
                $tipo_calificaiones1="  UPDATE `materia_por_periodo` SET `nota` = '".$r1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$r2."; UPDATE `materia_por_periodo` SET `nota` = '".$sum1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_m ;
                $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                $tipo_calificaiones1->execute(array()); 
            }else{ 
                $tipo_calificaiones1="
                SELECT SUM(de.su)as f,de.id_materia_por_periodo from (SELECT materia_por_periodo.id_materia_por_periodo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$valueQ['id_materia_por_periodo']."'  and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de

                ";
                $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                $tipo_calificaiones1->execute(array()); 
                foreach ($tipo_calificaiones1 as  $value) {
                    $tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = '".$value['f']."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$value['id_materia_por_periodo'];
                    $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                    $tipo_calificaiones1->execute(array()); 
                }
            }
        }
    }else{
echo "string";
    }
}




function examen_academico()
{

//SELECT w.id_grado, q.id_grado,q.id_curso,q.id_jornada_sede, q.id_periodo,q.id_nota_independiente, q.grado,q.curso,q.sede,q. jornada,q.nombre_materia,q.nombre from (SELECT grado.id_grado,curso.id_curso,nota_independiente.id_jornada_sede, nota_independiente.id_periodo, nota_independiente.id_nota_independiente,grado.nombre as grado,curso.nombre as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,examen.nombre_materia,nota_independiente.nombre from nota_independiente,examen,grado,curso,jornada_sede,jornada,sede WHERE nota_independiente.id_curso=curso.id_curso and grado.id_grado=nota_independiente.id_grado and nota_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and examen.id_notas_independientes=nota_independiente.id_nota_independiente) as q  ,
//(SELECT grado_sede.id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso,are_grado_sede.id_area FROM grado_sede,are_grado_sede WHERE grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id__docente=44 GROUP by grado_sede.id
//)as w
//WHERE  w.id_grado=q.id_grado and w.id_curso=q.id_curso and q.id_jornada_sede=w.id_jornada_sede  GROUP by q.id_nota_independiente
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
 

   $consultar_nivel="SELECT q.id_nota_independiente, q.grado,q.curso,q.sede,q. jornada,q.nombre_materia,q.nombre from (


SELECT nota_independiente.id_area, grado.id_grado,curso.id_curso,nota_independiente.id_jornada_sede,  nota_independiente.id_periodo, nota_independiente.id_nota_independiente,grado.numero as grado,curso.nombre as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,examen.nombre_materia,nota_independiente.nombre from are_grado_sede,grado_sede, nota_independiente,examen,grado,curso,jornada_sede,jornada,sede WHERE 

nota_independiente.id_curso=curso.id_curso and grado.id_grado=nota_independiente.id_grado and nota_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and examen.id_notas_independientes=nota_independiente.id_nota_independiente and are_grado_sede.id_area=nota_independiente.id_area AND are_grado_sede.id__docente='".$_POST['id_docente']."' AND are_grado_sede.id_grado_sede=grado_sede.id   and nota_independiente.id_grado=grado_sede.id_grado AND    grado_sede.id_curso=nota_independiente.id_curso   and grado_sede.id_jornada_sede=nota_independiente.id_jornada_sede GROUP by nota_independiente.id_nota_independiente
  ORDER BY nota_independiente.id_nota_independiente DESc
 ) as q where q.grado like ('%$d%')  or  q.curso like ('%$d%') or q.sede like ('%$d%')  or q.jornada like ('%$d%')  or q.nombre like ('%$d%')  or q.nombre_materia like ('%$d%')
";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
   $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}

$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
     $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}


    $consultar_nivel="SELECT q.area ,q.id_area,q.id_curso,q.id_grado,q.ID_JS,q.id, q.minutos, q.fecha,q.hora,q.id_periodo, q.id_nota_independiente, q.grado,q.curso,q.sede,q. jornada,q.nombre_materia,q.nombre, q.grado_sede from (


SELECT  area.area ,jornada_sede.ID_JS,examen.fecha,examen.hora,examen.id ,examen.minutos,nota_independiente.id_area, grado.id_grado,curso.id_curso,nota_independiente.id_jornada_sede,  nota_independiente.id_periodo, nota_independiente.id_nota_independiente,grado.numero as grado,curso.nombre as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,examen.nombre_materia,nota_independiente.nombre, grado_sede.id aS grado_sede from are_grado_sede,grado_sede, nota_independiente,examen,grado,curso,jornada_sede,jornada,sede,area WHERE 

nota_independiente.id_curso=curso.id_curso and grado.id_grado=nota_independiente.id_grado and nota_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and examen.id_notas_independientes=nota_independiente.id_nota_independiente and are_grado_sede.id_area=nota_independiente.id_area AND are_grado_sede.id__docente='".$_POST['id_docente']."' AND  area.id_area=are_grado_sede.id_area and are_grado_sede.id_grado_sede=grado_sede.id   and nota_independiente.id_grado=grado_sede.id_grado AND    grado_sede.id_curso=nota_independiente.id_curso   and grado_sede.id_jornada_sede=nota_independiente.id_jornada_sede   GROUP by nota_independiente.id_nota_independiente
 ORDER BY nota_independiente.id_nota_independiente DESc
 ) as q where q.grado like ('%$d%')  or  q.curso like ('%$d%') or q.sede like ('%$d%')  or q.jornada like ('%$d%')  or q.nombre like ('%$d%')  or q.nombre_materia like ('%$d%')
LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="eliminis">

   <div class="box-body no-padding">

      <div class="mailbox-controls">

        <!-- Check all button -->
      
        <div class="btn-group"> 

 
          <?php if($paginaActual > 1){
            echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
              echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

              <?php
              if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

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
        <th>Nombre</th> 
        <th  width="20">Actualizar</th>
        <th  width="20">Pregunta</th>
        <th  width="20">Resultados</th>
        <th width="20">Eliminar</th>
        </tr>  <?php
        foreach ($registro as $var) {

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
                <?php echo($var['nombre_materia']); ?>
            </td>
            <td>
                <?php echo($var['id_periodo']); ?>
            </td>          
            <td>
                <?php echo($var['nombre']); 
                $sql="SELECT id_notas_independientes FROM `examen_respuesta` WHERE id_notas_independientes='".$var['id_nota_independiente']."'";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
                $rm=$sq=$sql1->rowCount();?>

            </td> 
            <td> 
                <?php 
                if($rm==0) {?> 
                    <a href="#"  style="top: -7px; "  data-toggle="modal" data-target="#mymodal5" data-title="actualizar evaluación"  onclick="document.getElementById('tema').value='<?php echo($var['nombre']); ?>';
                          document.getElementById('id_nota_independiente1').value='<?php echo $var['id_nota_independiente']?>';
                          document.getElementById('fecha').value='<?php  echo  $var['fecha'];?>'; 
                          document.getElementById('hora').value='<?php  echo  $var['hora'];?>';
                          document.getElementById('ides').value='<?php  echo  $var['id'];?>';
                          document.getElementById('minutos').value='<?php  echo  $var['minutos'];?>';">
                        <img src="../../../logos/actualizar.png" alt="" width="35"  style="top: 0px;padding-top: 0">
                    </a> 
                     
                <?php }else{  ?>
                    <a href="#" style="top: -7px;cursor: not-allowed;  " data-title="la evaluación se encuentra calificada, por tal motivo no se podra actualizar">
                    <img src="../../../logos/actualizar.png"  style="top: -7px;cursor: not-allowed;" alt="" width="38" ></a>
                <?php } ?>

            </td>
            <td>
                <?php
               
                if($sq==0){
                    ?>
                    <a href="#"    style=" top: -7px "   data-toggle="modal" data-target="#rrr"  onclick=" 
                    var id_nota_independiente=<?php echo($var['id_nota_independiente']); ?>; document.getElementById('id_nota_independiente').value=<?php echo($var['id_nota_independiente']); ?>;
                    ver_preguntas(id_nota_independiente)"  data-title="Agregar preguntas">
                        <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                    </a>
                     

                <?php }else{
                  ?>
                     <a href="#"   style="top: -7px;cursor: not-allowed;"   data-title="la evaluación se encuentra calificada, por tal motivo no podras agregar mas preguntas">
                        <img width="37"     src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                    </a>

                  <?php  
              }
              ?>
          </td>
          <td><?php
          if($sq==0){
            ?>  
            <a href="#"   style="top: -7px;cursor: not-allowed;" data-title="Ningun estudiante a realizado la evaluación">
              <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
            </a>

        <?php }else{
          ?>
         <a href="examen_resultado.php?resultado=<?php echo($var['id_nota_independiente']); ?>&&curso=<?php echo($var['id_curso']); ?>&&grado=<?php echo($var['id_grado']); ?>&&id_js=<?php echo($var['ID_JS']); ?>" target="_blank" style="top: -7px; " data-title="Puedes ver los resultados de la evaluación">
          <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />

          </a> 

          <?php  
      }
      ?>

  </td>
  <td><?php
  if($sq==0){
    ?>
         
        <a href="#"  style="top: -7px; " data-toggle="modal" data-target="#mymodal"     data-title="Eliminar evaluación"  onclick=" 


       document.getElementById('eliminare1').value=<?php echo($var['id_nota_independiente']); ?>;
       document.getElementById('id_curso1').value=<?php echo($var['id_curso']); ?>;
       document.getElementById('id_grado1').value=<?php echo($var['id_grado']); ?>;
       document.getElementById('ID_JS1').value=<?php echo($var['ID_JS']); ?>;
       document.getElementById('id_periodo1').value=<?php echo($var['id_periodo']); ?>;
       document.getElementById('id_area1').value=<?php echo($var['id_area']); ?>; 
       document.getElementById('area1').value=<?php echo($var['area']); ?>;   

       document.getElementById('eliminare1').value=<?php echo($var['id_nota_independiente']); ?>;
       document.getElementById('id_curso1').value=<?php echo($var['id_curso']); ?>;
       document.getElementById('id_grado1').value=<?php echo($var['id_grado']); ?>;
       document.getElementById('ID_JS1').value=<?php echo($var['ID_JS']); ?>;
       document.getElementById('id_periodo1').value=<?php echo($var['id_periodo']); ?>;
       document.getElementById('id_area1').value=<?php echo($var['id_area']); ?>; 
       document.getElementById('area1').value=<?php echo($var['area']); ?>;   ">
        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
    </a>
              
<?php }else{
  ?>

  <a href="#"  style="top: -7px;cursor: not-allowed; "     data-title="Ya hay estudiantes que presentaron la prueba, por tal motivo no se podra eliminar el examen">
        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
    </a>

  <?php  
}
?>

</td>

</tr> <?php  
}
echo "

";?></table>

<div class="modal fade" id="may" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Confirmación</h4>
    </div>
    <div class="modal-body">
        <p> estás seguro de eliminar la sede   ?</p>

    </div>
    <div class="modal-footer">   
      <input type="hidden" id="elimina" name="docentees" value='<?php echo $id_sede?>'>
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit"  value='<?php echo $id_sede?>' class="btn btn-primary"  name="eliminar_sedes" 
          onclick='
          $("#may").modal({backdrop: false});
          $("#may").modal("hide");'>Aceptar</button> 

      </div>
  </div>
</div>
</div>




</div></form> </div>

<?php

echo '  <ul class="pagination" id="pagination"> '.$lista.'</ul>






' ;

}



function examen_tecnico()
{

//SELECT nota_tecnologica_independiente.id_competencia, grado.id_grado,curso.id_curso,nota_tecnologica_independiente.id_jornada_sede, nota_tecnologica_independiente.id_periodo, nota_tecnologica_independiente.id_nota_tecnologica_independiente,grado.numero as grado,curso.nombre as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,examen_tecnica.nombre_materia,nota_tecnologica_independiente.nombre from competencias, nota_tecnologica_independiente,examen_tecnica,grado,curso,jornada_sede,jornada,sede WHERE nota_tecnologica_independiente.id_curso=curso.id_curso and grado.id_grado=nota_tecnologica_independiente.id_grado and nota_tecnologica_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and examen_tecnica.id_nota_tecnologica_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and competencias.id_competencias=nota_tecnologica_independiente.id_competencia AND competencias.id_docente='53'  GROUP by nota_tecnologica_independiente.id_nota_tecnologica_independiente ORDER BY nota_tecnologica_independiente.id_nota_tecnologica_independiente DESc
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
 

   $consultar_nivel="SELECT  q.grado,q.curso,q.sede,q.jornada,q.nombre_materia,q.nombre from (

SELECT  grado.nombre as grado,curso.numero as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,competencias.nombre as nombre_materia,nota_tecnologica_independiente.nombre from competencias, nota_tecnologica_independiente,examen_tecnica,grado,curso,jornada_sede,jornada,sede WHERE nota_tecnologica_independiente.id_curso=curso.id_curso and grado.id_grado=nota_tecnologica_independiente.id_grado and nota_tecnologica_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and examen_tecnica.id_nota_tecnologica_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and competencias.id_competencias=nota_tecnologica_independiente.id_competencia AND competencias.id_docente='".$_POST['id_docente']."'  GROUP by nota_tecnologica_independiente.id_nota_tecnologica_independiente ORDER BY nota_tecnologica_independiente.id_nota_tecnologica_independiente DESc


  
 ) as q where q.grado like ('%$d%')  or  q.curso like ('%$d%') or q.sede like ('%$d%')  or q.jornada like ('%$d%')  or q.nombre like ('%$d%')  or q.nombre_materia like ('%$d%')
";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
   $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}

$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
     $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction1('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction1('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}


     $consultar_nivel="SELECT q.id,q.id_competencia ,q.id_curso,q.id_grado,q.id_jornada_sede, q.minutos, q.fecha,q.hora,q.id_periodo, q.id_nota_tecnologica_independiente, q.grado,q.curso,q.sede,q.jornada,q.nombre_materia,q.nombre from (

SELECT examen_tecnica.id_examen_tecnica as id,examen_tecnica.minutos,examen_tecnica.fecha,examen_tecnica.hora, nota_tecnologica_independiente.id_competencia, grado.id_grado,curso.id_curso,nota_tecnologica_independiente.id_jornada_sede, nota_tecnologica_independiente.id_periodo, nota_tecnologica_independiente.id_nota_tecnologica_independiente,grado.nombre as grado,curso.numero as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,competencias.nombre as nombre_materia,nota_tecnologica_independiente.nombre from competencias, nota_tecnologica_independiente,examen_tecnica,grado,curso,jornada_sede,jornada,sede WHERE nota_tecnologica_independiente.id_curso=curso.id_curso and grado.id_grado=nota_tecnologica_independiente.id_grado and nota_tecnologica_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and examen_tecnica.id_nota_tecnologica_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and competencias.id_competencias=nota_tecnologica_independiente.id_competencia AND competencias.id_docente='".$_POST['id_docente']."'  GROUP by nota_tecnologica_independiente.id_nota_tecnologica_independiente ORDER BY nota_tecnologica_independiente.id_nota_tecnologica_independiente DESc


  
 ) as q where q.grado like ('%$d%')  or  q.curso like ('%$d%') or q.sede like ('%$d%')  or q.jornada like ('%$d%')  or q.nombre like ('%$d%')  or q.nombre_materia like ('%$d%')
LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="eliminis">

   <div class="box-body no-padding">

      <div class="mailbox-controls">

        <!-- Check all button -->
      
        <div class="btn-group"> 

 
          <?php if($paginaActual > 1){
            echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
              echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

              <?php
              if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

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
        <th>Nombre</th> 
        <th  width="20">Actualizar</th>
        <th  width="20">Pregunta</th>
        <th  width="20">Resultados</th>
        <th width="20">Eliminar</th>
        </tr>  <?php
        foreach ($registro as $var) {

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
                <?php echo($var['nombre_materia']); ?>
            </td>
            <td>
                <?php echo($var['id_periodo']); ?>
            </td>          
            <td>
                <?php echo($var['nombre']); 
                $sql="SELECT id_nota_tecnologica_independiente FROM `examen_tecnica_respuesta` WHERE id_nota_tecnologica_independiente='".$var['id_nota_tecnologica_independiente']."'";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
                $rm=$sq=$sql1->rowCount();?>

            </td> 
            <td>
                <?php 
                if($rm==0) {?>
 
                    <a href="#"  style="top: -7px; "  data-toggle="modal" data-target="#mymodal5" data-title="actualizar evaluación"  onclick="document.getElementById('tema').value='<?php echo($var['nombre']); ?>';
                          document.getElementById('id_nota_independiente1').value='<?php echo $var['id_nota_independiente']?>';
                          document.getElementById('fecha').value='<?php  echo  $var['fecha'];?>'; 
                          document.getElementById('hora').value='<?php  echo  $var['hora'];?>';
                          document.getElementById('ides').value='<?php  echo  $var['id'];?>';
                          document.getElementById('minutos').value='<?php  echo  $var['minutos'];?>';">
 
                    <a href="#"  style=" "  data-toggle="modal" data-target="#mymodal6"data-title="actualizar evaluación"  onclick="document.getElementById('qtemaq').value='<?php echo($var['nombre']); ?>';
                          document.getElementById('qid_nota_tecnologica_independienteq').value='<?php echo $var['id_nota_tecnologica_independiente']?>';

                          document.getElementById('qfechaq').value='<?php  echo  $var['fecha'];?>'; 
                          document.getElementById('qhoraq').value='<?php  echo  $var['hora'];?>';
                          document.getElementById('qidesq').value='<?php  echo  $var['id'];?>';
                          document.getElementById('qminutosq').value='<?php  echo  $var['minutos'];?>';">
 
                        <img src="../../../logos/actualizar.png" alt="" width="35"  style="top: 0px;padding-top: 0">
                    </a> 
                     
                <?php }else{  ?>
                    
                    <img src="../../../logos/actualizar.png"  style=" cursor: not-allowed;" alt="" width="38" data-title="la evaluación se encuentra calificada, por tal motivo no se podra actualizar">
                <?php } ?>

            </td>
            <td>
                <?php
               
                if($sq==0){
                    ?>
                    <a href="#"    style=" "   data-toggle="modal" data-target="#rrr2"  onclick=" 
                    var id_nota_independiente2=<?php echo($var['id_nota_tecnologica_independiente']); ?>; 
                    document.getElementById('id_nota_independiente2').value=<?php echo($var['id_nota_tecnologica_independiente']); ?>;
                    ver_preguntas2(id_nota_independiente2)"  data-title="Agregar preguntas">
                        <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                    </a>
                     

                <?php }else{
                  ?>
                     <a href="#"   style=" cursor: not-allowed;"   data-title="la evaluación se encuentra calificada, por tal motivo no podras agregar mas preguntas">
                        <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                    </a>

                  <?php  
              }
              ?>
          </td>
          <td><?php
          if($sq==0){
            ?> 
            <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />

        <?php }else{
          ?><a href="examen_tecnico_resultado.php?resultado=<?php echo($var['id_nota_tecnologica_independiente']); ?>&&curso=<?php echo($var['id_curso']); ?>&&grado=<?php echo($var['id_grado']); ?>&&id_js=<?php echo($var['id_jornada_sede']); ?>" target="_blank" style="top: -7px; " data-title="Puedes ver los resultados de la evaluación">
              <img width="37"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /></a>

          <?php  
      }
      ?>

  </td>
  <td><?php
  if($sq==0){
    ?>
         
        <a href="#"  style="top: -7px; " data-toggle="modal" data-target="#mymodal2"     data-title="Eliminar evaluación"  onclick=" 
       document.getElementById('2eliminare1').value=<?php echo($var['id_nota_tecnologica_independiente']); ?>;
       document.getElementById('2id_curso1').value=<?php echo($var['id_curso']); ?>;
       document.getElementById('2id_grado1').value=<?php echo($var['id_grado']); ?>;
       document.getElementById('2ID_JS1').value=<?php echo($var['id_jornada_sede']); ?>;
       document.getElementById('2id_periodo1').value=<?php echo($var['id_periodo']); ?>;
       document.getElementById('2id_competencia1').value=<?php echo($var['id_competencia']); ?>; " > 
        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
    </a>
              
<?php }else{
  ?>

  <a href="#"  style="top: -7px;cursor: not-allowed; "     data-title="Ya hay estudiantes que presentaron la prueba, por tal motivo no se podra eliminar el examen">
        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
    </a>

  <?php  
}
?>

</td>

</tr> <?php  
}
echo "

";?></table>

 
 



</div></form> </div>

<?php

echo '  <ul class="pagination" id="pagination"> '.$lista.'</ul>






' ;
?>
<script type="text/javascript">
 





</script>
<?php

}   

function actualizar_examnen(){
    include "../../codes/rector/conexion.php"; 
    $div=$_POST['div'];
    $nombre=$_POST['nombre'];
    $id=$_POST['id']; 
    $colum=$_POST['colum']; 
    if ($div==1) {

     echo   $sql=" UPDATE `nota_independiente` SET `$colum` = '$nombre' WHERE `nota_independiente`.`id_nota_independiente` = $id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }else{

     echo   $sql=" UPDATE `examen` SET `$colum` = '$nombre' WHERE `examen`.`id` = $id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }
    

}    
function actualizar_examnen2(){
    include "../../codes/rector/conexion.php"; 
    $div=$_POST['div'];
    $nombre=$_POST['nombre'];
    $id=$_POST['id']; 
    $colum=$_POST['colum']; 
    if ($div==1) {

     echo   $sql=" UPDATE `nota_tecnologica_independiente` SET `$colum` = '$nombre' WHERE `nota_tecnologica_independiente`.`id_nota_tecnologica_independiente` = $id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }else{

     echo   $sql=" UPDATE `examen_tecnica` SET `$colum` = '$nombre' WHERE `examen_tecnica`.`id_examen_tecnica` = $id";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
    }
    

}


function  crear_preguntas(){
    include "../../codes/rector/conexion.php";
    $respuesta1=$_POST['respuesta1'];
    $respuesta2=$_POST['respuesta2'];
    $respuesta3=$_POST['respuesta3'];
    $respuesta4=$_POST['respuesta4'];
    $respuesta_correcta=$_POST['respuesta_correcta'];
    $pregunta=$_POST['pregunta'];
    $id_nota_independiente=$_POST['id_nota_independiente'];

  echo  $sql="  INSERT INTO `examen_pregunta` (`id`, `id_notas_independientes`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `respuestaCorecta`) VALUES (NULL, '$id_nota_independiente', '$pregunta', '$respuesta1', '$respuesta2', '$respuesta3', '$respuesta4', '$respuesta_correcta')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con=$sql1->fetchAll();
}
function  crear_preguntas2(){
    include "../../codes/rector/conexion.php";
    $respuesta1=$_POST['2respuesta1'];
    $respuesta2=$_POST['2respuesta2'];
    $respuesta3=$_POST['2respuesta3'];
    $respuesta4=$_POST['2respuesta4'];
    $respuesta_correcta=$_POST['2respuesta_correcta'];
    $pregunta=$_POST['2pregunta'];
    $id_nota_independiente=$_POST['id_nota_independiente2'];

  echo  $sql=" INSERT INTO `examen_tecnica_pregunta` (`id_examen_tecnica_pregunta`, `id_nota_tecnologica_independiente`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `respuesta_correcta`) VALUES (NULL, '$id_nota_independiente', '$pregunta', '$respuesta1', '$respuesta2', '$respuesta3', '$respuesta4',  '$respuesta_correcta')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con=$sql1->fetchAll();
}
function  ver_preguntas(){
    include "../../codes/rector/conexion.php";
    $id_nota_independiente=$_POST['id_nota_independiente'];

    $sql=" SELECT id,pregunta,respuesta1,respuesta2,respuesta3,respuesta4,respuestaCorecta FROM examen_pregunta WHERE id_notas_independientes='$id_nota_independiente'  Order by id desc";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con=$sql1->fetchAll();
    $count = 0 ;
    foreach ($con as  $value) {
      $count = $count + 1;
     ?>
     <div style="width: 100%;"> 
  
 
    <div   data-toggle="collapse" data-target="#demo<?php echo($count); ?>" style="width: 100%; color:#fff;    background-color: #33b5e5; 
  color: #fff;  border-radius: 3px;padding: 5px;  
  border: 3px solid #00acd6; "><?php echo $value['pregunta'];?></div>
 
</div>
  <div id="demo<?php echo($count); ?>" class="collapse">
    <div id="<?php echo($value['id']); ?>examen<?php echo $id_nota_independiente ?>"></div>
    <br>
    <form>
    <label for="pregunta">Pregunta</label>
    <textarea type="text" class="form-control" name="pregunta" id="<?php echo($value['id']); ?>;pregunta<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente= <?php echo $id_nota_independiente ?>; 
    var id=<?php echo($value['id']); ?>;
    var nom=document.getElementById('<?php echo($value['id']); ?>;pregunta<?php echo $id_nota_independiente ?>').value;
    var text='Pregunta actualizada';
    var colum='pregunta'; actualizar_pregunta(id_nota_independiente,text,id,nom,colum);ver_preguntas(id_nota_independiente);"  ><?php echo($value['pregunta']); ?>
      
    </textarea><br>


   
    <label for="respuesta1">Respuesta numero 1</label>
    <textarea type="text" class="form-control" name="respuesta1" id="<?php echo($value['id']); ?>;respuesta1<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente= <?php echo $id_nota_independiente ?>; 
    var id=<?php echo($value['id']); ?>;
    var nom=document.getElementById('<?php echo($value['id']); ?>;respuesta1<?php echo $id_nota_independiente ?>').value;
    var text='respuesta numero 1 actualizada ';
    var colum='respuesta1'; actualizar_pregunta(id_nota_independiente,text,id,nom,colum)" ><?php echo($value['respuesta1']); ?>
      
    </textarea><br>

   
    <label for="respuesta2">Respuesta numero 2</label>
    <textarea type="text" class="form-control" name="respuerespuesta2sta1" id="<?php echo($value['id']); ?>;respuesta2<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente= <?php echo $id_nota_independiente ?>; 
    var id=<?php echo($value['id']); ?>;
    var nom=document.getElementById('<?php echo($value['id']); ?>;respuesta2<?php echo $id_nota_independiente ?>').value;
    var text='respuesta numero 2 actualizada ';
    var colum='respuesta2'; actualizar_pregunta(id_nota_independiente,text,id,nom,colum)" ><?php echo($value['respuesta2']); ?>
      
    </textarea><br>

   
    <label for="respuesta3">Respuesta numero 3</label>
    <textarea type="text" class="form-control" name="respuesta3" id="<?php echo($value['id']); ?>;respuesta3<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente= <?php echo $id_nota_independiente ?>; 
    var id=<?php echo($value['id']); ?>;
    var nom=document.getElementById('<?php echo($value['id']); ?>;respuesta3<?php echo $id_nota_independiente ?>').value;
    var text='respuesta numero 3 actualizada ';
    var colum='respuesta3'; actualizar_pregunta(id_nota_independiente,text,id,nom,colum)" ><?php echo($value['respuesta3']); ?>
      
    </textarea><br>

   
    <label for="respuesta4">Respuesta numero 4</label>
    <textarea type="text" class="form-control" name="respuesta4" id="<?php echo($value['id']); ?>;respuesta4<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente= <?php echo $id_nota_independiente ?>; 
    var id=<?php echo($value['id']); ?>;
    var nom=document.getElementById('<?php echo($value['id']); ?>;respuesta4<?php echo $id_nota_independiente ?>').value;
    var text='respuesta numero 4 actualizada ';
    var colum='respuesta4'; actualizar_pregunta(id_nota_independiente,text,id,nom,colum)" ><?php echo($value['respuesta4']); ?>
      
    </textarea><br>
   
    

 


    <label for="respuesta_correcta">El numero de la respuesta  Correcta</label>
    <select class="form-control" id="<?php echo($value['id']); ?>;respuestaCorecta<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente= <?php echo $id_nota_independiente ?>;
    var id=<?php echo($value['id']); ?>;
    var nom=document.getElementById('<?php echo($value['id']); ?>;respuestaCorecta<?php echo $id_nota_independiente ?>').value;
    var text='El numero de la respuesta  Correcta   actualizado';
    var colum='respuestaCorecta'; actualizar_pregunta(id_nota_independiente,text,id,nom,colum)" >

      <option value="<?php echo($value['respuestaCorecta']); ?>"><?php echo($value['respuestaCorecta']); ?></option><?php 
      for ($i=1; $i <5 ; $i++) {
        if ($i!=$value['respuestaCorecta'] ) {
          echo '<option value="'.$i.'">'.$i.'</option>';
        }  
      } ?>
    </select><br>
    </form>
    <button class="btn btn-danger" style="width: 100%" onclick=" var id=<?php echo($value['id']); ?>; var id_nota_independiente= <?php echo $id_nota_independiente ?>; 
      var opk=   confirm('Esta seguro de eliminar la pregunta?');
      if(opk==true){ 
        eliminar_preguntas(id,id_nota_independiente);}else{ return;}">Eliminar</button><br><br>
  </div>
     

     <?php
    }
}
function  ver_preguntas2(){
    include "../../codes/rector/conexion.php";
    $id_nota_independiente=$_POST['id_nota_independiente2'];

     $sql=" SELECT id_examen_tecnica_pregunta,pregunta,respuesta1,respuesta2,respuesta3,respuesta4,respuesta_correcta FROM examen_tecnica_pregunta WHERE id_nota_tecnologica_independiente='$id_nota_independiente'  Order by id_examen_tecnica_pregunta desc";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con=$sql1->fetchAll();
    $count = 0 ;
    foreach ($con as  $value) {
      $count = $count + 1;
     ?>
     <div style="width: 100%;"> 
  
 
    <div   data-toggle="collapse" data-target="#demo2<?php echo($count); ?>" style="width: 100%; color:#fff;    background-color: #33b5e5; 
  color: #fff;  border-radius: 3px;padding: 5px;  
  border: 3px solid #00acd6; "><?php echo $value['pregunta'];?></div>
 
</div>
  <div id="demo2<?php echo($count); ?>" class="collapse">
    <div id="<?php echo($value['id_examen_tecnica_pregunta']); ?>2examen<?php echo $id_nota_independiente ?>"></div>
    <br>
    <form>
    <label for="pregunta">Pregunta</label>
    <textarea type="text" class="form-control" name="pregunta2" id="<?php echo($value['id_examen_tecnica_pregunta']); ?>;2pregunta<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente2= <?php echo $id_nota_independiente ?>; 
    var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>;
    var nom2=document.getElementById('<?php echo($value['id_examen_tecnica_pregunta']); ?>;2pregunta<?php echo $id_nota_independiente ?>').value;
    var text2='Pregunta actualizada';
    var colum2='pregunta'; actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2);ver_preguntas2(id_nota_independiente2);"  ><?php echo($value['pregunta']); ?>
      
    </textarea><br>


   
    <label for="respuesta1">Respuesta numero 1</label>
    <textarea type="text" class="form-control" name="respuesta1" id="<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta1<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente2= <?php echo $id_nota_independiente ?>; 
    var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>;
    var nom2=document.getElementById('<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta1<?php echo $id_nota_independiente ?>').value;
    var text2='respuesta numero 1 actualizada ';
    var colum2='respuesta1'; actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2)" ><?php echo($value['respuesta1']); ?>
      
    </textarea><br>

   
    <label for="respuesta2">Respuesta numero 2</label>
    <textarea type="text" class="form-control" name="respuerespuesta2sta1" id="<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta2<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente2= <?php echo $id_nota_independiente ?>; 
    var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>;
    var nom2=document.getElementById('<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta2<?php echo $id_nota_independiente ?>').value;
    var text2='respuesta numero 2 actualizada ';
    var colum2='respuesta2'; actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2)" ><?php echo($value['respuesta2']); ?>
      
    </textarea><br>

   
    <label for="respuesta3">Respuesta numero 3</label>
    <textarea type="text" class="form-control" name="respuesta3" id="<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta3<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente2= <?php echo $id_nota_independiente ?>; 
    var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>;
    var nom2=document.getElementById('<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta3<?php echo $id_nota_independiente ?>').value;
    var text2='respuesta numero 3 actualizada ';
    var colum2='respuesta3'; actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2)" ><?php echo($value['respuesta3']); ?>
      
    </textarea><br>

   
    <label for="respuesta4">Respuesta numero 4</label>
    <textarea type="text" class="form-control" name="respuesta4" id="<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta4<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente2= <?php echo $id_nota_independiente ?>; 
    var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>;
    var nom2=document.getElementById('<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta4<?php echo $id_nota_independiente ?>').value;
    var text2='respuesta numero 4 actualizada ';
    var colum2='respuesta4'; actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2)" ><?php echo($value['respuesta4']); ?>
      
    </textarea><br>
   
    

 


    <label for="respuesta_correcta">El numero de la respuesta  Correcta</label>
    <select class="form-control" id="<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta_correcta<?php echo $id_nota_independiente ?>" onchange="
    var id_nota_independiente2= <?php echo $id_nota_independiente ?>;
    var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>;
    var nom2=document.getElementById('<?php echo($value['id_examen_tecnica_pregunta']); ?>;2respuesta_correcta<?php echo $id_nota_independiente ?>').value;
    var text2='El numero de la respuesta  Correcta   actualizado';
    var colum2='respuesta_correcta'; actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2)" >

      <option value="<?php echo($value['respuesta_correcta']); ?>"><?php echo($value['respuesta_correcta']); ?></option><?php 
      for ($i=1; $i <5 ; $i++) {
        if ($i!=$value['respuesta_correcta'] ) {
          echo '<option value="'.$i.'">'.$i.'</option>';
        }  
      } ?>
    </select><br>
    </form>
    <button class="btn btn-danger" style="width: 100%" onclick=" var id2=<?php echo($value['id_examen_tecnica_pregunta']); ?>; var id_nota_independiente2= <?php echo $id_nota_independiente ?>; 
      var opk=   confirm('Esta seguro de eliminar la pregunta?');
      if(opk==true){ 
        eliminar_preguntas2(id2,id_nota_independiente2);}else{ return;}">Eliminar</button><br><br>
  </div>
     

     <?php
    }
}
function actualizar_pregunta(){
  include "../../codes/rector/conexion.php";
 echo $sql="UPDATE `examen_pregunta` SET `".$_POST['colum']."` = '".$_POST['nom']."' WHERE `examen_pregunta`.`id` =  '".$_POST['id']."'";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $con2=$sql1->fetchAll();
}
function actualizar_pregunta2(){
  include "../../codes/rector/conexion.php";
 echo $sql="UPDATE `examen_tecnica_pregunta` SET `".$_POST['colum2']."` = '".$_POST['nom2']."' WHERE `examen_tecnica_pregunta`.`id_examen_tecnica_pregunta` =  '".$_POST['id2']."'";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $con2=$sql1->fetchAll();
}
 function eliminar_preguntas(){

    include "../../codes/rector/conexion.php";
    $sql="DELETE FROM `examen_pregunta` WHERE `examen_pregunta`.`id` = '".$_POST['id']."'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con2=$sql1->fetchAll();
 }
 
 function eliminar_preguntas2(){

    include "../../codes/rector/conexion.php";
    $id=$_POST['id2'];
    $sql="DELETE FROM `examen_tecnica_pregunta` WHERE `examen_tecnica_pregunta`.`id_examen_tecnica_pregunta` =".$id;
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con2=$sql1->fetchAll();
 }


function insert()
{
    include "../../codes/rector/conexion.php";
    $pregunta=$_POST['pregunta'];
    $respuesta1=$_POST['respuesta1'];
    $respuesta2=$_POST['respuesta2'];
    $respuesta3=$_POST['respuesta3'];
    $respuesta4=$_POST['respuesta4'];
    $respuestaC=$_POST['respuestaC'];
    $id=$_POST['id'];
    $con3="INSERT INTO `examen_pregunta`(`id`, `id_examen`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `respuestaCorecta`) VALUES ('','$id','$pregunta','$respuesta1','$respuesta2','$respuesta3','$respuesta4','$respuestaC')";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
}
?>
