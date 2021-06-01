<?php
if( isset($_GET['resultado']) && isset($_GET['curso']) && isset($_GET['grado']) && isset($_GET['id_js'])){ 
    $resultado=$_GET['resultado']; 
    $curso=$_GET['curso']; 
    $grado=$_GET['grado']; 
    $id_js=$_GET['id_js'];

}
session_start();
require_once "../../../codes/docente/chat.php";
 $chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session'])){
    header("location: ../../../index.html"); echo($_SESSION['Session']);
}
include "../../../codes/docente/foro.php";
include "../../../codes/docente/examen.php";
$foro=new foro();
$examen=new examen();
$vaqr='conocer';
$dat=$foro->jornada_sede($_SESSION['Id_Doc'],$vaqr);

?>
<style>
.box-tools{
    color: #bfbfbf;
    display: block; 
}

li>a:hover {
    color: #000;
    background: #f7f7f7;
}
a{
    color: #fff
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555; 
    background-color: #;
    /* border: 1px solid #73A1BD; */
    /* border-bottom-color: transparent; */
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    background-color: #4581ab;
    border: 0px  ;
    border-bottom-color: transparent;
}
</style> 
<body class="hold-transition skin-blue sidebar-mini"id='bo'>
    <?php 
include('../enlaces/header.php'); ?>
    <div class=" ">
        <div class="content-wrapper"> 

                                    
            <section class="content">
                <div class="row"><div id="sapo"></div></div>
                     <div class="col-md-12">
                         <?php
include('../enlaces/head.php');
 
    include "../../../codes/rector/conexion.php";
        $sql="SELECT alumnos.id_alumnos, alumnos.nombre, alumnos.apellido, alumnos.foto FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN materia_por_periodo ON materia_por_periodo.id_area=area.id_area INNER JOIN informeacademico ON informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico INNER JOIN alumnos ON alumnos.id_alumnos=informeacademico.id_alumno INNER JOIN grado ON grado.id_grado=informeacademico.id_grado INNER JOIN jornada_sede ON jornada_sede.ID_JS=informeacademico.id_jornada_sede INNER JOIN curso ON curso.id_curso=informeacademico.id_curso WHERE curso.id_curso=$curso AND grado.id_grado=$grado AND jornada_sede.ID_JS=$id_js GROUP BY alumnos.id_alumnos";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $con2=$sql1->fetchAll();
    ?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Resultado</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ver=0;
                foreach($con2 as $key){
                    $ver++;
                ?>
                <tr>
                    <td><img class="profile-user-img img-responsive img-circle" style="height: 100px;" src="<?php echo($key['foto']); ?>" alt="User profile picture"><strong>
                            <?php echo($key['nombre']." ".$key['apellido']); ?></strong>
                    </td>
                    <td>
                        <?php
                    $sql="SELECT * FROM `examen_tecnica_pregunta` WHERE id_nota_tecnologica_independiente=$resultado";
                    $sql1=$conexion->prepare($sql);
                    $sql1->execute(array());
                    $con4=$sql1->fetchAll();
                    $co=0; $in=0; $promedio=0;
                    foreach($con4 as $var){
                        $sql="SELECT * FROM `examen_tecnica_respuesta` WHERE id_examen_tecnica_pregunta=$var[0] AND id_alumno=$key[0]";
                        $sql1=$conexion->prepare($sql);
                        $sql1->execute(array());
                        $con3=$sql1->fetchAll();
                        foreach($con3 as $va){
                            if($va[3] == $var[7]){
                                $co++;
                            }else{
                                $in++;
                            }
                        }
                    }
                    $query = "SELECT MAX(hasta) FROM `escala_tecnica` ORDER BY `desde` ASC";
                        $sql1=$conexion->prepare($query); 
                        $sql1->execute(array());
                        $con3=$sql1->fetchAll();
                        $total=$co+$in;
                        if($co > 0 || $in > 0){
                            foreach ($con3 as $con) {
                                $nota= $con[0]/$total*$co;
                            }
                            if($nota == 0){
                                $nota = 1;
                            }
                    ?>
                        <div class="col-md-4">
                            <span class="label label-success" style="font-size: 17px;">Correctas</span>
                            <?php echo($co); ?>
                        </div>
                        <div class="col-md-4">
                            <span class="label label-danger" style="font-size: 17px;">Incorrectas</span>
                            <?php echo($in); ?>
                        </div>
                        <div class="col-md-4">
                            <span class="label label-info" style="font-size: 13px;">Nota</span>
                            <?php 
                                
                               function truncateFloat($number, $digitos)
                                {
                                    $raiz = 10;
                                    $multiplicador = pow ($raiz,$digitos);
                                    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
                                    return number_format($resultado, $digitos);
                                }
                                $notaR = truncateFloat($nota,1);
                            echo($notaR);
                        ?>
                        </div>
                        <?php
                        }
                    ?>
                    </td>
                    <td>
                        <?php if($co > 0 || $in > 0){ ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ver<?php echo($ver); ?>">Ver</button>
                        <?php } ?>
                        <!-- Modal -->
                        <div class="modal fade" id="ver<?php echo($ver); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="padding-right: 1161px !important;">
                                <div class="modal-content" style="width: 1237px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Resultado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $sql="SELECT examen_tecnica_pregunta.*, examen_tecnica_respuesta.id_respuesta FROM `examen_tecnica_pregunta` INNER JOIN examen_tecnica_respuesta ON examen_tecnica_respuesta.id_examen_tecnica_pregunta=examen_tecnica_pregunta.id_examen_tecnica_pregunta WHERE examen_tecnica_pregunta.id_nota_tecnologica_independiente=$resultado AND examen_tecnica_respuesta.id_alumno=$key[0]";
                                        $sql1=$conexion->prepare($sql);
                                        $sql1->execute(array());
                                        $exa=$sql1->fetchAll();
                                        $n=0;
                                        foreach($exa as $exa1){
                                            $n++;
                                            ?>
                                            <div class="col-md-6" style="height: 342px; border: 1px solid #367fa9;">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            echo($n.". ".$exa1['pregunta']); 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php if($exa1['respuesta_correcta'] == 1){ ?>
                                                    <tr style="background-color: green;">
                                                        <td>
                                                            <?php  echo($exa1['respuesta1']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <tr>
                                                        <td>
                                                            <?php  echo($exa1['respuesta1']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                    <?php if($exa1['respuesta_correcta'] == 2){ ?>
                                                    <tr style="background-color: green;">
                                                        <td>
                                                            <?php  echo($exa1['respuesta2']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <tr>
                                                        <td>
                                                            <?php  echo($exa1['respuesta2']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                    <?php if($exa1['respuesta_correcta'] == 3){ ?>
                                                    <tr style="background-color: green;">
                                                        <td>
                                                            <?php  echo($exa1['respuesta3']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <tr>
                                                        <td>
                                                            <?php  echo($exa1['respuesta3']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                    <?php if($exa1['respuesta_correcta'] == 4){ ?>
                                                    <tr style="background-color: green;">
                                                        <td>
                                                            <?php  echo($exa1['respuesta4']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <tr>
                                                        <td>
                                                            <?php  echo($exa1['respuesta4']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                    <tr style="height: 28px"></tr>
                                                    <tr>
                                                        <td>
                                                           <?php
                                                            if($exa1['id_respuesta']==1){
                                                                echo("<label>".$key['nombre']." ".$key['apellido']."</label> respondio: ".$exa1['respuesta1']);
                                                            }else{
                                                                if($exa1['id_respuesta']==2){
                                                                    echo("<label>".$key['nombre']." ".$key['apellido']."</label> respondio: ".$exa1['respuesta2']);
                                                                }else{
                                                                    if($exa1['id_respuesta']==3){
                                                                        echo("<label>".$key['nombre']." ".$key['apellido']."</label> respondio: ".$exa1['respuesta3']);
                                                                    }else{
                                                                        if($exa1['id_respuesta']==4){
                                                                            echo("<label>".$key['nombre']." ".$key['apellido']."</label> respondio: ".$exa1['respuesta4']);
                                                                        }else{
                                                                            echo("No respondido");
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top: 10px;">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
                    </div>
                
            </section>
        </div>
    </div>
<?php include('../enlaces/footer.php'); ?>
</body> 
