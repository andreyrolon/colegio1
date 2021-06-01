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
function tabla()
   {
    include "../../codes/rector/conexion.php";
    $asignatura=explode(',',$_POST['asignatura']);

    $id=$_SESSION['id_informe_academico'];
 
        ?>
        
        <h3>Sede <?php echo($_SESSION['sede']); ?></h3>
        <h4>Jornada <?php echo($_SESSION['jornada']); ?></h4>
        <h5>Curso <?php echo($_SESSION['grado']." ".$_SESSION['curso']); ?></h5>
        <h6>Asignatura <button type="button" class="btn btn-info"><?php echo($asignatura[0]); ?></button></h6>
        <table class="table table-striped  table-hover">
            <thead>
                <tr>
                    <th>Tema</th>
                    <th>Pregunta</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
        <?php 

        $asignatura[2];
        if ($asignatura[2]==0) {
            $sql="SELECT foro.id_foro,foro.tema,foro.pregunta,foro.periodo FROM foro, grado_sede,are_grado_sede WHERE grado_sede.id_grado='".$_SESSION['id_grado']."' and grado_sede.id_jornada_sede='".$_SESSION['id_jornada_sede']."' and grado_sede.id_curso='".$_SESSION['id_curso']."' and grado_sede.id=are_grado_sede.id_grado_sede and  are_grado_sede.id_area=$asignatura[1] and are_grado_sede.id_area_grado_sede=foro.id_area_grado_sede  ORDER BY id_foro desc ";
        }else{
 

            $sql="SELECT foro.id_foro,foro.tema,foro.pregunta,foro.periodo FROM foro WHERE foro.id_competencia=$asignatura[1]  ORDER BY id_foro desc ";

        }
        
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
                <button onclick="ver(<?php echo($var[0]); ?>,'<?php echo($var["tema"]); ?>','<?php echo($var["pregunta"]); ?>')" class="btn btn-success" id="foro__<?php echo($for); ?>"><i class="fa fa-weixin" aria-hidden="true"></i></button> 
                </td>
            </tr>
            <?php
        }
        ?>
        
            </tbody>
        </table>
        <input type="hidden" id="for" value="<?php echo($for); ?>">
        <?php
    
    ?>
    <script>
        function ver(foro,tema,pregunta){  
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/foro_respuesta.php?action=foro",
                data: {
                    foro,tema,pregunta
                },
                dataType: "text",
                success: function(data){
                    $("#tablaF").css('display', 'none');
                    $("#tabF").css('display', 'block');
                    $('#tabla_foro').html(data);
                }
            });
               
        }
        
    </script>
    <?php
}
?>