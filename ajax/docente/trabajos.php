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
function archivos_academico()
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

     SELECT nota_independiente.id_area, grado.id_grado,curso.id_curso,nota_independiente.id_jornada_sede, nota_independiente.id_periodo, nota_independiente.id_nota_independiente,grado.nombre as grado,curso.nombre as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,tareas_materias.nombre_materia,nota_independiente.nombre from are_grado_sede,grado_sede, nota_independiente,tareas_materias,grado,curso,jornada_sede,jornada,sede WHERE nota_independiente.id_curso=curso.id_curso and grado.id_grado=nota_independiente.id_grado and nota_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and tareas_materias.id_nota_independiente=nota_independiente.id_nota_independiente and are_grado_sede.id_area=nota_independiente.id_area AND are_grado_sede.id__docente='".$_POST['id_docente']."' AND are_grado_sede.id_grado_sede=grado_sede.id and nota_independiente.id_grado=grado_sede.id_grado AND grado_sede.id_curso=nota_independiente.id_curso and grado_sede.id_jornada_sede=nota_independiente.id_jornada_sede GROUP by nota_independiente.id_nota_independiente
     ) as q where q.grado like ('%$d%')  or  q.curso like ('%$d%') or q.sede like ('%$d%')  or q.jornada like ('%$d%')  or q.nombre like ('%$d%')  or q.nombre_materia like ('%$d%') order by q.id_nota_independiente desc
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


    $consultar_nivel="SELECT q.id_periodo, q.id_nota_independiente, q.grado,q.curso,q.sede,q. jornada,q.nombre_materia,q.nombre from (

    SELECT nota_independiente.id_area, grado.id_grado,curso.id_curso,nota_independiente.id_jornada_sede, nota_independiente.id_periodo, nota_independiente.id_nota_independiente,grado.nombre as grado,curso.nombre as curso, sede.NOMBRE as sede , jornada.NOMBRE as jornada ,tareas_materias.nombre_materia,nota_independiente.nombre from are_grado_sede,grado_sede, nota_independiente,tareas_materias,grado,curso,jornada_sede,jornada,sede WHERE nota_independiente.id_curso=curso.id_curso and grado.id_grado=nota_independiente.id_grado and nota_independiente.id_jornada_sede= jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and tareas_materias.id_nota_independiente=nota_independiente.id_nota_independiente and are_grado_sede.id_area=nota_independiente.id_area AND are_grado_sede.id__docente='".$_POST['id_docente']."' AND are_grado_sede.id_grado_sede=grado_sede.id and nota_independiente.id_grado=grado_sede.id_grado AND grado_sede.id_curso=nota_independiente.id_curso and grado_sede.id_jornada_sede=nota_independiente.id_jornada_sede GROUP by nota_independiente.id_nota_independiente

    ) as q where q.grado like ('%$d%')  or  q.curso like ('%$d%') or q.sede like ('%$d%')  or q.jornada like ('%$d%')  or q.nombre like ('%$d%')  or q.nombre_materia like ('%$d%') order by q.id_nota_independiente desc
    LIMIT $limit, $nroLotes ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $registro=$consultar_nivel1->fetchAll();

    $registrow=$consultar_nivel1->rowCount();
    ?>  
    <form method="post" id="eliminis">
        <div class="box-body no-padding">

            <div class="mailbox-controls"> 

                <div class="btn-group"> 
                    <?php if($paginaActual > 1){

                        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;}  
                    if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
                </div> 
                <div class="pull-right">  <?php 

                    $aaa=$registrow+0;
                    $aa=$paginaActual+0;
                    $g=$aa *$aaa;
                    if ($o==0) {
                         echo $g .'-'.$paginaActual.'/'. $nroProductos ;
                    }else{
                        echo $nroProductos;

                        echo   '-'.$paginaActual.'/'. $nroProductos ;
                    } ?>
                    <div class="btn-group"> <?php 
                        if($paginaActual > 1){
                            echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;}  
                        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

                    </div> 
                </div>
              <!-- /.pull-right -->
            </div>
            <div class="modal fade" id="yy" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Recuerde que la nota   se bloqueara despúes  de</h4>
                        </div>
                        <div class="modal-body" id="table">
                            
                        </div>
                        <div class="modal-footer">    
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                            id="btn"   onclick="var id= <?php echo $var['id_nota_independiente']?>; del(id)">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="table-responsive mailbox-messages" style="
            text-align: justify; /* For Edge */
            -moz-text-align-last: left; /* For Firefox prior 58.0 */
            text-align-last: left; ">
                <br>
                <table class="table table-striped  table-hover" style=" margin: px">
                    <tr>
                    <th>Sede </th>
                        <th>Jornada</th>
                        <th>Curso</th>
                        <th>Materia</th>
                        <th>Periodo</th>
                        <th>Nombre evaluacion</th> 
                        <th  width="30">Resultados</th>
                        <th width="30">Eliminar</th>
                    </tr>  <?php
                    foreach ($registro as $var) { ?>
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
                                $sql="SELECT * FROM `examen_respuesta` WHERE id_notas_independientes='".$var['id_nota_independiente']."'";
                                $sql1=$conexion->prepare($sql);
                                $sql1->execute(array());
                                $sq=$sql1->rowCount(); ?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#yy"><i class="fa fa-check-square-o" aria-hidden="true" onclick="var id_nota_independiente= <?php echo $var['id_nota_independiente']?>; mostrary(id_nota_independiente)"></i></button> 

                            </td>
                            <td><?php
                                if($sq==0){ ?>

                                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#mymodal<?php echo $var['id_nota_independiente']?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button> 
                                    <div class="modal fade" id="mymodal<?php echo $var['id_nota_independiente']?>" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Confirmación</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p> estás seguro de eliminar la evaluación   ?</p>

                                                </div>
                                                <div class="modal-footer">    
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                                                  id="btn"   onclick="var id= <?php echo $var['id_nota_independiente']?>; del(id)">Aceptar</button> 

                                                </div>
                                            </div>
                                        </div>
                                    </div>   <?php
                                }else{ ?>

                                    <button class="btn btn-danger" id="elimF<?php echo($for); ?>" disabled><i class="fa fa-trash-o" aria-hidden="true"></i></button> <?php  
                                } ?>
                            </td>
                        </tr> <?php  
                    } ?>
                </table>
            </div>
        </div>
    </form> <?php
    echo '  <ul class="pagination" id="pagination"> '.$lista.'</ul>' ;?>
    <script type="text/javascript">
      
        function mostrary(id_nota_independiente){
        
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/trabajos.php?action=table1",
                data: {
                    id_nota_independiente 
                },
                dataType: "text",
                success: function(data) {
                    $('#table').html(data); 
                }
            }); 
        }
    </script> <?php
}

 
function table1(){

    include "../../codes/rector/conexion.php";
    $id_nota_independiente=$_POST['id_nota_independiente'];
}


function crear_trabajos_masivos_academico(){

    date_default_timezone_set("America/Bogota");
    $hora=date("H:i:s");
    $fecha=date("Y-m-d");
    $ano=date("Y") ;

    include "../../codes/rector/conexion.php";
    $id_tipo_calificacion=$_POST['jx'];
    $tema=$_POST['tema'];
    $fecha_entrega=$_POST['fecha'];
    $do=$_POST['do'];

    $graditos=$_POST['graditos'];  
    $porciones = explode(" ", $graditos);
    $nombre_materia=$porciones[0];
    $periodo=$porciones[1];
    $id_grado=$porciones[2];
    $id_area_tecno=$porciones[3];
    $area=$porciones[3]; 

 

 
    

    echo  $SELECT="SELECT area.codigo,area.area, grado_sede.id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso,area.id_area,area.nombre FROM area,grado_sede,are_grado_sede WHERE are_grado_sede.id_area=area.id_area AND grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id__docente=$do and grado_sede.id_grado in('$id_grado') and area.id_area in ('$id_area_tecno')";
    $SELECT=$conexion->prepare($SELECT);
    $SELECT->execute(array());  
    foreach ($SELECT as $keye) {
     

      $sql="INSERT INTO `nota_independiente` (`id_curso`, `id_grado`, `id_jornada_sede`, `id_tipo_calificacion`, `nombre`, `id_periodo`, `id_area`, `fecha`, `hora`) VALUES ( '".$keye['id_curso']."', '".$keye['id_grado']."','".$keye['id_jornada_sede']."','$id_tipo_calificacion',  '$tema','$periodo', '".$keye['id_area']."','$fecha','$hora')";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 
        $id_nota=$conexion->lastInsertId();
        $id_notaq=$id_nota; 

          $a=" 

            INSERT INTO `tareas_materias` ( `id_nota_independiente`, `fecha_entrega`, `nombre_materia`, `documentos`) VALUES ('$id_notaq',  '$fecha_entrega', '$nombre_materia', '');


            INSERT INTO `materia_por_paso` ( `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`,`identificador` )
            SELECT materia_por_periodo.id_materia_por_periodo,informeacademico.id_informe_academico,'$id_notaq','1'  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='".$keye['id_grado']."'    and informeacademico.id_curso='".$keye['id_curso']."'   and informeacademico.id_jornada_sede='".$keye['id_jornada_sede']."'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico   and materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='".$keye['id_area']."'";
        $a1=$conexion->prepare($a);
        $a1->execute(array()); 
          $a="SELECT materia_por_periodo.id_materia_por_periodo  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='".$keye['id_grado']."'   and informeacademico.id_curso='".$keye['id_curso']."'  and informeacademico.id_jornada_sede='".$keye['id_jornada_sede']."'    and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and  materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='".$keye['id_area']."'; 
 

          ";
        $a1=$conexion->prepare($a);
        $a1->execute(array()); 
        foreach ($a1 as  $valueQ) { 

            $r1=0;$r2=0;
            $id_m=0;
            $sum=0;
            $cont=0;

            if ($keye['area']!=1 ) {

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

        
    }
}




function eliminar_trabajos_academicos()
   {
        include "../../codes/rector/conexion.php";
        $id=$_POST['id'];
         


  
      

        date_default_timezone_set("America/Bogota");
        $hora=date("H:i:s");
        $fecha=date("Y-m-d");
        $ano=date("Y") ; 
        $r1=0;$r2=0;
        $id_m=0;
        $sum=0;
        $cont=0;
        $uno=0;
        $sql="SELECT nota_independiente.id_area,nota_independiente.id_periodo, nota_independiente.id_curso,nota_independiente.id_grado,nota_independiente.id_jornada_sede from materia_por_paso,nota_independiente WHERE  nota_independiente.id_nota_independiente=materia_por_paso.id_nota_independiente and materia_por_paso.id_nota_independiente=$id   GROUP by materia_por_paso.id_nota_independiente";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 
        foreach ($sql1 as $key  ) {
            $id_jornada_sede=$key['id_jornada_sede'];
            $id_c=$key['id_curso'];
            $id_g=$key['id_grado'];
            $id_a=$key['id_area'];
            $periodo=$key['id_periodo'];
        }

        $sql="SELECT nota_independiente.id_area,nota_independiente.id_periodo, nota_independiente.id_curso,nota_independiente.id_grado,nota_independiente.id_jornada_sede from materia_por_paso,nota_independiente WHERE  nota_independiente.id_nota_independiente=materia_por_paso.id_nota_independiente and materia_por_paso.id_nota_independiente=$id and materia_por_paso.nota not in('0') GROUP by materia_por_paso.id_nota_independiente";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 
        $not=$sql1->rowCount(); 
        if($not==0){
            $a=" DELETE FROM `materia_por_paso` WHERE materia_por_paso.id_nota_independiente=$id;DELETE FROM `nota_independiente` WHERE nota_independiente.id_nota_independiente=$id";
            $a1=$conexion->prepare($a);
            $a1->execute(array());  
            $a="SELECT materia_por_periodo.id_materia_por_periodo  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and  materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='$id_a'; ";
            $a1=$conexion->prepare($a);
            $a1->execute(array());  
            foreach ($a1 as  $valueQ) { 

                $r1=0;$r2=0;
                $id_m=0;
                $sum=0;
                $cont=0;
                $uno=0;

                if ($id_a!=1 ) {
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
                    $tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = ( SELECT SUM(de.su)as f from (SELECT materia_por_periodo.id_materia_por_periodo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$valueQ['id_materia_por_periodo']."'  and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$valueQ['id_materia_por_periodo'];
                        $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                        $tipo_calificaiones1->execute(array()); 
                }
            } 
        }else{ 
            echo 1;
        }
    }
?>