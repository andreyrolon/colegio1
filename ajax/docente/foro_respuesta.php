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
function actualizar_foro_r()
{ 
    include "../../codes/rector/conexion.php";

    $responder=$_POST['responder'];
    $r=0; 

    if (preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s.,:z]+$/", $responder)) {

        
        $id=$_POST['id'];
        $con3="UPDATE `foro_respuestas` SET `respuesta` = '$responder' WHERE `foro_respuestas`.`id_foro_r` = $id";
        $con1=$conexion->prepare($con3);
        $con1->execute(array());
        $r=1;
    }

    $var=array($r);

    echo json_encode($var);
}
 
     
function foro_actu_doce_res()
{
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $responder=$_POST['responder'];
    $con3="UPDATE `foro_respuestas_respuesta` SET `respuesta`='$responder' WHERE id_foro_respuesta='$id'";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
}

function foro_delete_doce_res()
{
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $con3="DELETE FROM `foro_respuestas_respuesta` WHERE id_foro_respuesta='$id'";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
}

function foroR()
   { 
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nota=$_POST['i'];
    $con3="UPDATE `foro_respuestas` SET `nota`='$nota' WHERE foro_respuestas.id_foro_r='$id'";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
}

function respuesta()
   { 
    include "../../codes/rector/conexion.php";       
    $respuestar=$_POST['respuesta'];
    $id=$_SESSION['Id_Doc'];
    $id_r=$_POST['id_r'];
    $con3="INSERT INTO `foro_respuestas_respuesta`(`id_foro_r`, `id_comenta`, `respuesta`) VALUES ('$id_r','$id','$respuestar')";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    
}

function eliminarF()
   { 
    include "../../codes/rector/conexion.php";
    $id=$_POST['elimForo'];
    $con3="SELECT foro_respuestas.id_foro FROM `foro_respuestas` WHERE foro_respuestas.id_foro=$id and  foro_respuestas.nota>1";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    if($count>0){
        echo 1;
    }else {
        $con3="DELETE FROM `foro` WHERE foro.id_foro=$id";
        $con1=$conexion->prepare($con3);
        $con1->execute(array());
        echo 2;
    }
    
}


function foroRES()
    { 
    include "../../codes/rector/conexion.php";
    $foro_=$_POST['foro'];
      
    ?>
    <center><h4>Tema: <?php echo($_POST['tema']); ?></h4></center>
    <hr>
    <strong>Pregunta</strong>
    <textarea class="form-control" readonly=""> <?php echo($_POST['pregunta']); ?></textarea><br>
    <div class="row">
       <?php
        $sql="SELECT foro_respuestas.id_foro_r, foro_respuestas.respuesta,foro_respuestas.nota, alumnos.nombre, alumnos.genero, alumnos.apellido, alumnos.foto, alumnos.id_alumnos FROM `foro_respuestas` INNER JOIN alumnos ON alumnos.id_alumnos=foro_respuestas.id_alumno WHERE foro_respuestas.id_foro=$foro_ order by apellido";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $con2=$sql1->fetchAll();
        $div=0;
        foreach($con2 as $value){
            $div++;
            $foto=$value['foto'];
            if ($value['foto']=='' && $value['genero']==1) {
                $foto='../../../logos/niña.jpg';
            }
            if ($value['foto']=='' && $value['genero']==0) {
                $foto='../../../logos/niño.jpg';
            }
            ?>
            <div class="col-md-12" ><br>   <hr>
 
                <div class="col-md-3">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo($foto); ?>" alt="User profile picture">
                    <div  style="text-align: center;"><?php echo mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8")  ?>  </div>

                </div>
                <div class="col-md-9">
                
                    <textarea class="form-control "   readonly><?php echo($value['respuesta']); ?></textarea>
                    <?php
                    if($value['nota']==0 && $_SESSION['Rol']=='Docente'){
                            for($i=1;$i<=10;$i++){  ?>
                            <button id="cal<?php echo($value['id_foro_r'].'/'.$i); ?>" onclick="clickCal(0,'cal<?php echo($value['id_foro_r'].'/'); ?>',<?php echo($i); ?>,<?php echo($value['id_foro_r']); ?>);" class="" style="border: unset;background-color: transparent; cursor: pointer;">
                            <i class="fa fa-star-o text-yellow" id="i<?php echo($i); ?>"></i></button>
                        <?php
                        }
                    }else{ 
                        for ($i=1; $i <=$value['nota']; $i++) { 
                           
                            ?>
                            <button id="cal<?php echo($value['id_foro_r'].'/'.$i); ?>" style="border: unset;background-color: transparent; cursor: pointer;" onclick="clickCal(1,'cal<?php echo($value['id_foro_r'].'/'); ?>',<?php echo($i); ?>,<?php echo($value['id_foro_r']); ?>);"><i class="fa text-yellow fa-star"></i></button> 
                            <?php 
                        } 
                        for($j=$i;$j<=10;$j++){
                            ?>
                                <button id="cal<?php echo($value['id_foro_r'].'/'.$j); ?>" onclick="clickCal(0,'cal<?php echo($value['id_foro_r'].'/'); ?>',<?php echo($j); ?>,<?php echo($value['id_foro_r']); ?>);" class="" style="border: unset;background-color: transparent; cursor: pointer;">
                                <i class="fa fa-star-o text-yellow" id="i<?php echo($j); ?>"></i></button>
                            <?php
                        }
                            
                    }?>
                  
                  
                </div>
                 
            </div>
            <?php
        }
            ?>
    </div>
 
      
    <input type="hidden" id="div" value="<?php echo($div); ?>">
    <script>
      
   
      
                 
        function clickCal(v,campo,i,id) {
             mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/foro_respuesta.php?action=foroR",
                data: {
                    id,
                    i
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );

                     for (var io=parseInt(i);  io > 0; io--) { 
                        document.getElementById(campo+io).innerHTML ='<i class="fa text-yellow fa-star"></i>';
                    } 
                     for (var io2=i+1;  io2 <=10; io2++) { 
                        
                        document.getElementById(campo+io2).innerHTML ='<i class="fa fa-star-o text-yellow" id="i<?php echo($j); ?>"></i>';
                    }
                }
            });              
        }
  
    </script>
    <?php
    
}

?>