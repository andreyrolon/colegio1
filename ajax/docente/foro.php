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
   echo $con3="SELECT area.* FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN grado_sede ON grado_sede.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id__docente=$id AND grado_sede.id=$curso GROUP BY area.id_area";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
    foreach($con2 as $key){
        ?>
        <option value="<?php echo($key['id_area']); ?>"><?php echo($key['nombre']); ?></option>
        <?php
    }
}

function form()
   {
     include "../../codes/rector/conexion.php"; 
    $tema=$_POST['tema']; 
    $pregunta=$_POST['pregunta']; 
    $periodo=$_SESSION['numero'];
    $jornada_sede2=$_POST['jornada_sede2'];
    $curso2= explode(' ',  $_POST['curso2']);
    $curso=$curso2[1];
    $grado=$curso2[0];

    
    
    $identificador=explode(',',$_POST['asignaturas2']);
    if ($identificador[4]==1) {
        $id=0;
        $id_competencia=$identificador[2];
    }else{
        $id=$identificador[5];
        $id_competencia=0;
    }
  
    $sql="INSERT INTO `foro`(`id_area_grado_sede`, `tema`, `pregunta`, `id_competencia`,`periodo`) VALUES ('$id','$tema','$pregunta','$id_competencia','$periodo')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array()); 
    $id_tabla=$conexion->lastInsertId();


    $sql="INSERT INTO `foro_respuestas` (  `id_foro`, `id_alumno`, `respuesta`, `nota`) SELECT '$id_tabla',alumnos.id_alumnos,'','1' from alumnos LEFT JOIN informeacademico on informeacademico.id_alumno=alumnos.id_alumnos  WHERE informeacademico.id_grado=$grado and informeacademico.id_jornada_sede=$jornada_sede2 and informeacademico.id_curso=$curso";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array()); 
    $r='sdsd';
     $var=array($id_tabla);

    echo json_encode($var);
     
    
}
function nota_foro(){

    include "../../codes/rector/conexion.php";
    $jornada_sede1= $_POST['jornada_sede1'];
    $p= $_POST['p'];
    $tecnico= $_POST['tecnico'];
    $tipo= $_POST['tipo'];
    $identificador= explode(',', $_POST['asignaturas1']);
    $area= $identificador[2];
    $curso1= explode(' ',   $_POST['curso1']);

    $grado=$curso1[0];
    $curso=$curso1[1];
    $hora=date("H:i:s");
    $fecha=date("Y-m-d");
    $valor=0;
    if ($tecnico==0) {
        $r="SELECT foro.id_foro from foro WHERE foro.periodo=$p and  foro.id_area_grado_sede=".$identificador[5];
        $rt=$conexion->prepare($r);
        $rt->execute(array());
        $count1=$rt->rowCount();
        if ($count1>0) {
        
            $sele="SELECT nota_independiente.id_nota_independiente from nota_independiente WHERE nota_independiente.id_curso=$curso  and nota_independiente.id_grado=$grado  and  nota_independiente.id_jornada_sede=$jornada_sede1  and nota_independiente.id_periodo=$p and nota_independiente.id_area=$area  and nota_independiente.nombre='foro'";
            $sele1=$conexion->prepare($sele);
            $sele1->execute(array());
            $count=$sele1->rowCount();
            if ($count==0) {
                
            

                $sql="INSERT INTO `nota_independiente` (`id_curso`, `id_grado`, `id_jornada_sede`, `id_tipo_calificacion`, `nombre`, `id_periodo`, `id_area`, `fecha`, `hora`) VALUES ('$curso', '$grado', '$jornada_sede1', '$tipo', 'foro', '$p', '$area', '$fecha', '$hora')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
                $id_tabla=$conexion->lastInsertId();

                if ($id_tabla>0) {
                    # code...
                
                    $sql="INSERT INTO `materia_por_paso` (  `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`, `nota`, `identificador`) 
                        SELECT materia_por_periodo.id_materia_por_periodo,informeacademico.id_informe_academico,'$id_tabla', round(avg(foro_respuestas.nota),1)as nota, 0 from alumnos LEFT JOIN foro_respuestas on foro_respuestas.id_alumno=alumnos.id_alumnos LEFT JOIN informeacademico on informeacademico.id_alumno=alumnos.id_alumnos LEFT JOIN foro on foro.id_foro=foro_respuestas.id_foro LEFT JOIN materia_por_periodo on materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico WHERE foro.periodo=$p and informeacademico.id_grado=$grado and informeacademico.id_jornada_sede=$jornada_sede1 and informeacademico.id_curso=$curso and materia_por_periodo.periodo=$p  and materia_por_periodo.id_area=$area GROUP by  alumnos.id_alumnos  ORDER BY `alumnos`.`apellido` ASC";
                    $sql1=$conexion->prepare($sql);
                    $sql1->execute(array());
                    $valor=1;
                }
            }
        }else{
            $valor=2;
        }
    }else{

    }
    echo $valor;
}
function foro_() 
{
    include "../../codes/rector/conexion.php";
    $curso=explode(" ", $_POST['cursoB']);
    $asignatura=explode(",", $_POST['asignaturaB']);
    if ($asignatura[4]==1) {
        $tec=1;
        $where=' foro.id_competencia='.$asignatura[2];
    }else{
        $tec=0;
        $where=' foro.id_area_grado_sede='.$asignatura[5];
    }
    ?>
    <div class="table-responsive" style="padding: 10px">

        <strong>Foros de <?php echo $asignatura[0] ?></strong> <br>       
        <button data-toggle="modal"  data-target="#mymodal4"   class="btn btn-danger" style="margin-top: 10px" onclick="document.getElementById('tecnico').value=<?php echo $tecnico ?>;">Registrar nota
        </button><br><br>
        <table class="table table-hover">
            
                <tr>
                    <th>Tema</th>
                    <th>Pregunta</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr> 
            <tbody>
        <?php
        $sql="SELECT foro.* FROM `foro` WHERE $where  ORDER BY id_foro DESC";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $con2=$sql1->fetchAll();
        $for=0;
        foreach($con2 as $var){
            $for++;
            ?>
            <tr>
                <td><?php echo($var['tema']); ?></td>
                <td><?php echo($var['pregunta']); ?></td>
                <td>
                <button class="btn btn-success"  onclick="foro(<?php echo $var[0] ?>,'<?php echo $var['tema'] ?>','<?php echo $var['pregunta'] ?>')"><i class="fa fa-weixin" aria-hidden="true"></i></button>
                <input type="hidden" id="foro<?php echo($for); ?>" value="">
                </td>
                <td>
                    <button data-toggle="modal"  data-target="#mymodal3"    type="button" class="btn btn-warning"  onclick=" 
                    document.getElementById('periodo').value='<?php echo $var['periodo'] ?>'; document.getElementById('tema2').value='<?php echo $var['tema'] ?>';document.getElementById('pregunta2').value='<?php echo $var['pregunta'] ?>'; document.getElementById('numero2').value='<?php echo $var[0] ?>'">  <i class=" fa fa-pencil"></i>  </button>
                </td>
                <td>
                <button class="btn btn-danger" data-toggle="modal" onclick="document.getElementById('numero').value='<?php echo $var[0] ?>'"  data-target="#mymodal2"  type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></button> 
                </td>
            </tr>
            
            <?php
        }
        ?>
        
            </tbody>
        </table>
    </div> 
    <?php 
}

function actualizar_foro()   { 
    include "../conexion.php";
    $id=$_POST['id'];
    $tema=$_POST['tema'];
    $pregunta=$_POST['pregunta'];
    $con3="SELECT foro_respuestas.id_foro FROM `foro_respuestas` WHERE foro_respuestas.id_foro=$id and  foro_respuestas.nota>1";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    if($count>0){
        echo 1;
    }else {
        $con3="UPDATE `foro` SET `tema`='".$tema."',`pregunta`='".$pregunta."' WHERE foro.id_foro=".$id;
        $con1=$conexion->prepare($con3);
        $con1->execute(array());
        echo 2;
    }
    
}

?>