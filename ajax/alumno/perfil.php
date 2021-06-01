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

 
 
function carga(){
    include "../../codes/rector/conexion.php"; 
    $id=$_POST['i'];
    $id_materia=$_POST['id'];
    $p=$_POST['p'];
    $no=0;       
    $sql="SELECT tipo_calificaiones.nombre as tipo ,tipo_calificaiones.porceentajes, q.nombre,tipo_calificaiones.id_tipo_calificaciones,q.nota from tipo_calificaiones LEFT JOIN (SELECT nota_independiente.nombre,nota_independiente.id_tipo_calificacion,materia_por_paso.nota from materia_por_paso,nota_independiente WHERE materia_por_paso.id_materia_por_periodo=$id_materia and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente ORDER BY nota_independiente.id_tipo_calificacion ) as q on q.id_tipo_calificacion=tipo_calificaiones.id_tipo_calificaciones";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con2=$sql1->fetchAll();
    $sql2="SELECT materia_por_periodo.nota from materia_por_periodo WHERE materia_por_periodo.periodo=$p and materia_por_periodo.id_materia_por_periodo=$id_materia";
    $sql12=$conexion->prepare($sql2);
    $sql12->execute(array());
    $con22=$sql12->fetchAll();
    ?>
    <style type="text/css">
        .inp{
            font-size: 12px;
            width: 40px;
            border: solid 1px #a9a5a5;
            border-radius: 3px;
            text-align: center;
        }
    </style>
    <div class="modal fade in" id="modal_nota" role="dialog" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header btn-primary">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Tipo de notas
                    </h4>
                </div>
                <div class="modal-body">
                     
                    <div class="alert" style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">    <strong id="nota"></strong>   </div>
                    
                </div> 
                <div class="modal-footer">
                    <button style="width: 100%;  margin-top: 15px;" id="myCheck" type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancelar
                    </button>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="table table-responsive">   
        <table class="table table-striped table-bordered">
            <?php
            $id_tipo_calificacion=0;?>
            <tr>    
                <td>SER</td>
                <td>HACER</td>
                <td>CONOCER</td>
                <td>BIMESTRAL</td>
                <td>TOTAL</td>
            </tr>
            <tr><?php
                $i=1;
                foreach ($con2 as $key) {
                    if ($id_tipo_calificacion!=$key['id_tipo_calificaciones']) {
                        echo "<th>";
                    }
                    ?> 
                    <button onclick=" $('#nota').html('<?php echo$key['nombre'] ?>'); " class="inp" data-target="#modal_nota" data-toggle="modal" >N <?php echo $i++ ?></button>
                    <?php
                    
                    $id_tipo_calificacion=$key['id_tipo_calificaciones'];
                    
                }?>

                <th>
                    <button class="inp"  >NF</button>
                </th>
            </tr>
            <tr><?php

                foreach ($con2 as $key) {
                    if ($id_tipo_calificacion!=$key['id_tipo_calificaciones']) {
                        echo "<td>";
                    }
                    ?> 
                        <input type="text" value="<?php echo $key['nota'] ?>" class='inp'> 
                   
                    <?php
                    
                    $id_tipo_calificacion=$key['id_tipo_calificaciones'];
                    
                }      

                foreach ($con22 as $keys) {                        
                    $no = number_format($keys["nota"], 1, '.', ''); 
                }
                 ?>

                <td> 
                    <input type="text" value="<?php  echo $no; ?> " class='inp'> 
                </td>               
            </tr>
        </table>
    </div>
    <?php
}
function carga2(){
    include "../../codes/rector/conexion.php"; 
    $id=$_POST['i'];
    $area=$_POST['id'];
    $p=$_POST['p'];
    $no=0;      
    $sql="SELECT tipo_calificaiones.nombre as tipo ,tipo_calificaiones.porceentajes,q.no, q.nombre,tipo_calificaiones.id_tipo_calificaciones,q.nota from tipo_calificaiones LEFT JOIN (SELECT tecnologia.nota as no,tecnica_por_paso.nota,nota_tecnologica_independiente.nombre,nota_tecnologica_independiente.id_tipo_calificaciones from nota_tecnologica_independiente,tecnologia,tecnica_por_paso WHERE tecnologia.id_informe_academico=$id and tecnologia.id_periodo=$p and tecnologia.id_competrencia=$area and tecnologia.id_tecnologia=tecnica_por_paso.id_tecnologia and nota_tecnologica_independiente.id_nota_tecnologica_independiente=tecnica_por_paso.id_nota_tecnologia_independiente order by nota_tecnologica_independiente.id_tipo_calificaciones ) as q on q.id_tipo_calificaciones=tipo_calificaiones.id_tipo_calificaciones  ";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con2=$sql1->fetchAll();
    ?>
    <style type="text/css">
        .inp{

            width: 43px;
            border: solid 1px #a9a5a5;
            border-radius: 3px;
            text-align: center;
        }
    </style>
    <div class="modal fade in" id="modal_nota" role="dialog" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header btn-primary">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Tipo de notas
                    </h4>
                </div>
                <div class="modal-body">
                     
                    <div class="alert" style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">    <strong id="nota"></strong>   </div>
                    
                </div> 
                <div class="modal-footer">
                    <button style="width: 100%;  margin-top: 15px;" id="myCheck" type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancelar
                    </button>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="table table-responsive">   
        <table class="table table-striped table-bordered">
            <?php
            $id_tipo_calificacion=0;?>
            <tr>    
                <td>SER</td>
                <td>HACER</td>
                <td>CONOCER</td>
                <td>BIMESTRAL</td>
                <td>TOTAL</td>
            </tr>
            <tr><?php
                $i=1;
                foreach ($con2 as $key) {
                    if ($id_tipo_calificacion!=$key['id_tipo_calificaciones']) {
                        echo "<td>";
                    }
                    ?> 
                    <button onclick=" $('#nota').html('<?php echo$key['nombre'] ?>'); " class="inp" data-target="#modal_nota" data-toggle="modal"  >N <?php echo $i++ ?></button>
                    <?php
                    
                    $id_tipo_calificacion=$key['id_tipo_calificaciones'];
                    
                }?>
                <td>
                    <button class="inp"  >NF</button>
                </td>
            </tr>
            <tr><?php

                foreach ($con2 as $key) {
                    if ($id_tipo_calificacion!=$key['id_tipo_calificaciones']) {
                        echo "<td>";
                    }
                    ?> 
                        <input type="text" value="<?php echo $key['nota'] ?>" class='inp'> 
                   
                    <?php
                    
                    $id_tipo_calificacion=$key['id_tipo_calificaciones'];
                    $no=$key['no'];
                }                              
                $no = number_format($no, 1, '.', ''); 

                 ?>

                <td> 
                    <input type="text" value="<?php  echo $no; ?> " class='inp' > 
                </td>               
            </tr>
        </table>
    </div>
    <?php
}
function logro(){
    include "../../codes/rector/conexion.php"; 
    $id=$_POST['i'];
    $area=$_POST['id'];
    $p=$_POST['p'];
    $no=0;      
    $sql="SELECT logro.tipo,logro.logro from logro,logro_periodo,materia_por_periodo WHERE materia_por_periodo.id_informe_academico=$id and materia_por_periodo.id_area=$area  and materia_por_periodo.id_materia_por_periodo=logro_periodo.id_materia_por_periodo and logro_periodo.id_logro=logro.id_logro  ";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con2=$sql1->fetchAll();
    ?>
    <style type="text/css">
        .dd:hover td{
            border:solid 2px #d2d2d2;
            
        }
        .inp{

            width: 43px;
            border: solid 1px #a9a5a5;
            border-radius: 3px;
            text-align: center;
        }
    </style>
     
    <div class="table table-responsive" style="padding: 10px">   
        <table class="table table-striped table-bordered table-hover">
            <?php
            $id_tipo_calificacion=0;?>
            <tr>    
                <th style="padding-left: 21px">TIPO</th>
                <th>DESCRIPCIÓN</th> 
            </tr>
            <?php
            $i=1;
            foreach ($con2 as $key) {  
                if ($key[0]==1) { 
                    $tipo='<button type="button"  id="er3" >
                                Logro
                            </button>';
                }
                if ($key[0]==2) { 
                    $tipo='<button type="button" id="er2"  >
                                Recomendaciones
                            </button>';
                }
                if ($key[0]==3) { 
                    $tipo='<button type="button"  id="er1" >
                                Dificultad
                            </button>';
                }
                  ?>
                <tr class="dd">
                    <td   >
                        <?php echo $tipo ?> 
                    </td>
                    <td>
                        <?php echo $key[1] ?> 
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
function logro2(){
    include "../../codes/rector/conexion.php"; 
    $id=$_POST['i'];
    $area=$_POST['id'];
    $p=$_POST['p'];
    $no=0;      
    $sql="SELECT logro_tecnica.tipo,logro_tecnica.logro from logro_tecnica,logro_periodo_tecnica,tecnologia WHERE tecnologia.id_informe_academico=$id and tecnologia.id_competrencia=$area and tecnologia.id_periodo=$p AND tecnologia.id_tecnologia=logro_periodo_tecnica.id_tecnologia  and logro_tecnica.id=logro_periodo_tecnica.id_logro_tecnica  ";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $con2=$sql1->fetchAll();
    ?>
    <style type="text/css">
        .dd:hover td{
            border:solid 2px #d2d2d2;
            
        }
        .inp{

            width: 43px;
            border: solid 1px #a9a5a5;
            border-radius: 3px;
            text-align: center;
        }
    </style>
     
    <div class="table table-responsive" style="padding: 10px">   
        <table class="table table-striped table-bordered table-hover">
            <?php
            $id_tipo_calificacion=0;?>
            <tr>    
                <th style="padding-left: 21px">TIPO</th>
                <th>DESCRIPCIÓN</th> 
            </tr>
            <?php
            $i=1;
            foreach ($con2 as $key) {  
                if ($key[0]==1) { 
                    $tipo='<button type="button"  id="er3" >
                                Logro
                            </button>';
                }
                if ($key[0]==2) { 
                    $tipo='<button type="button" id="er2"  >
                                Recomendaciones
                            </button>';
                }
                if ($key[0]==3) { 
                    $tipo='<button type="button"  id="er1" >
                                Dificultad
                            </button>';
                }
                  ?>
                <tr class="dd">
                    <td   >
                        <?php echo $tipo ?> 
                    </td>
                    <td>
                        <?php echo $key[1] ?> 
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}

 

function form1(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $genero=$_POST['genero'];
    $fecha_=$_POST['fecha_n'];
    $lugar=$_POST['lugar_n'];
    $sql="UPDATE `alumnos` SET `nombre`='$nombre',`apellido`='$apellido',`genero`='$genero', `fecha_nacimiento`='$fecha',`lugar_nacimiento_direccion`='$lugar' WHERE alumnos.id_alumnos=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form2(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $email=$_POST['email'];
    $cell=$_POST['celular'];
    $telefono=$_POST['telefono'];
    $dir=$_POST['direccion'];
    $barrio=$_POST['barrio'];
    $sql="UPDATE `docente` SET `telefono`='$telefono',`celular`='$cell',`barrio`='$barrio',`correo`='$email',`direccion`='$dir' WHERE docente.id_docente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form3(){
    include "../../codes/rector/conexion.php";
    $titulo=$_POST['x']; $id=$_POST['c'];
    $sql="UPDATE `titulos` SET `nombre`='$titulo' WHERE titulos.id_titulos='$id'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form4(){
    include "../../codes/rector/conexion.php";
    $institucion=$_POST['x']; $id=$_POST['c'];
    $sql="UPDATE `titulos` SET `institucion`='$institucion' WHERE titulos.id_titulos='$id'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form7(){
    include "../../codes/rector/conexion.php";
    $anual=$_POST['x']; $id=$_POST['c'];
    $sql="UPDATE `titulos` SET `ano`='$anual' WHERE titulos.id_titulos='$id'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form5(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $escalafon=$_POST['escalafon'];
    $sql="UPDATE `docente` SET `escalafon`='$escalafon' WHERE docente.id_docente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function nuevo_titulo(){
    include "../../codes/rector/conexion.php";
    $institucion=$_POST['institucion']; $titulo=$_POST['titulo']; $anual=$_POST['anual']; $id=$_SESSION['Id_Doc'];
    $sql="INSERT INTO `titulos`(`id_titulos`, `nombre`, `institucion`, `ano`, `ID_ADMIN`) VALUES ('','$titulo','$institucion','$anual','$id')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}


?>