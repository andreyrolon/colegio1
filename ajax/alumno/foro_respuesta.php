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
function foro()
   
    { 
    include "../../codes/rector/conexion.php";
    $foro_=$_POST['foro'];
        
    ?>
    <center><h4>Tema: <?php echo($_POST['tema']); ?></h4></center>
    <hr>
    <h3>Pregunta</h3>
    <textarea class="form-control"  readonly><?php echo($_POST['pregunta']); ?></textarea>
    
    
    <div id="primer"></div> 
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
        if ( $value['id_alumnos']==$_SESSION['Id_Doc']) { 
            $text='<div class="col-md-12" style="background-color: #f5f5f5;border: solid  #eee;margin-top: 10px;"; ><div style="margin:10px" id="_MSG4_"></div><br><hr><div class="col-md-3"><img class="profile-user-img img-responsive img-circle" src=" '.$foto.'" alt="User profile picture"><div  style="text-align: center;">'. mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8")  .'</div></div><div class="col-md-9"><textarea class="form-control " id="id'.$value['id_alumnos'].'"   >'.  ($value['respuesta']).'</textarea>';
            if ($value['respuesta']=='') {
                    
                $text.='<br><div id="cambio'.$value['id_alumnos'].'"><button type="button" name="comentar" class="btn btn-info" style="margin-left: 10px;" id="comentar" onclick="  responde('.$value['id_foro_r'].')">Registrar</button></div></div></div>';
            }else{
                if($value['nota']==0 && $_SESSION['Rol']=='Docente'){
                    for($i=1;$i<=10;$i++){   
                        $text.=' <i class="fa fa-star-o text-yellow"    "></i> ';
                     
                    }
                }else{ 
                    for ($i=1; $i <=$value['nota']; $i++) { 
                       
                        $text.='  <i class="fa text-yellow fa-star"></i>'; 
                       
                    } 
                    for($j=$i;$j<=10;$j++){
                        $text.='     <i class="fa fa-star-o text-yellow"   ></i>';
                    }
                } 
                $text.='</div></div>';

            }
        ?>
            <script type="text/javascript">
                $('#primer').html('<?php echo $text ?>');
            </script> <?php


        }else{
            $text=' 

            <div class="col-md-12" >
                <br><hr>

                <div class="col-md-3">
                    <img class="profile-user-img img-responsive img-circle" src=" '.$foto.'" alt="User profile picture">
                    <div  style="text-align: center;">'. mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8")  .'</div>

                </div>
                <div class="col-md-9">
                
                    <textarea class="form-control "   readonly>'.  ($value['respuesta']).'</textarea>';

                   
                    if($value['nota']==0 && $_SESSION['Rol']=='Docente'){
                        for($i=1;$i<=10;$i++){   
                            $text.=' <i class="fa fa-star-o text-yellow"    "></i> ';
                         
                        }
                    }else{ 
                        for ($i=1; $i <=$value['nota']; $i++) { 
                           
                            $text.='  <i class="fa text-yellow fa-star"></i>'; 
                           
                        } 
                        for($j=$i;$j<=10;$j++){
                            $text.='     <i class="fa fa-star-o text-yellow"   ></i>';
                        }
                            
                    } 
                    $text.=' 
                </div>
                 
            </div>';
        echo($text);
        }
              
              

        $text=''; 
         
    } ?>
           
    
    <input type="hidden" id="div" value="<?php echo($div); ?>">
    <script>
        
   
        
        function responde(id) { 
            mostrar();
            var responder=document.getElementById('id<?php echo $_SESSION['Id_Doc'] ?>').value;
           
            if(responder=='')  {
                mensaje4(2,'Debe ingresar un comentario');
                document.getElementById('id<?php echo $_SESSION['Id_Doc'] ?>').focus();
                return true;
            }else{ 

                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/foro_respuesta.php?action=actualizar_foro_r",
                    data: {
                        responder,
                        id
                    },
                    dataType: "json",
                    success: function(data){ 
                        if (data[0]==1) {
                            $('#cambio<?php echo $_SESSION['Id_Doc'] ?>').html('<button type="button" name="comentar" class="btn btn-primary" style="margin-left: 10px;" id="comentar" onclick="  actualizar('+id+')">Actualizar</button>');

                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 

                            Swal.fire({ 
                              icon: 'success',
                              title: 'Comentario Registrado',
                              showConfirmButton: false,
                              timer: 1500
                            });
                        }else{

                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 

                            Swal.fire({ 
                                icon: 'error',
                                title: 'solo puedes ingresar letras, tildes, puntos(.), comas(,) y numeros.  <br>no se permite mas caracteres',
                                showConfirmButton: true, 
                            }); 
                        }
                    }
                });
            }
        }

        function actualizar(id) { 
            mostrar();
            var responder=document.getElementById('id<?php echo $_SESSION['Id_Doc'] ?>').value;
           
            if(responder=='')  {
                mensaje4(2,'Debe ingresar un comentario');
                document.getElementById('id<?php echo $_SESSION['Id_Doc'] ?>').focus();
                return true;
            }else{ 

                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/foro_respuesta.php?action=actualizar_foro_r",
                    data: {
                        responder,
                        id
                    },
                    dataType: "json",
                    success: function(data){ 
                       
                        if (data[0]==1) {
                            

                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 

                            Swal.fire({ 
                              icon: 'success',
                              title: 'Comentario Actualizado',
                              showConfirmButton: false,
                              timer: 1500
                            });
                        }else{

                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 

                            Swal.fire({ 
                                icon: 'error',
                                title: 'solo puedes ingresar letras, tildes, puntos(.), comas(,),dos puntos(:) y numeros.  <br>no se permite mas caracteres',
                                showConfirmButton: true, 
                            }); 
                        }
                    }
                });
            }
        }
 
    </script>
    <?php
    
}
?>
                 
 