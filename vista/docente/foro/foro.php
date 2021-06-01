


<?php
 session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../login.php");
    }
include "../../../codes/docente/foro.php";
$foro=new foro();
include('../enlaces/head.php');
$dat=$foro->jornada_sede($_SESSION['Id_Doc'],'conocer');
$tipo=$foro->tipo();
?>
<style>

    
    #crear, #Buscar {
        margin-top: 10px;
    }
    
    #row, #tabF, #tablaF {
        display: none;
    }  
    .enter{
        width: 100%;
    }
     table {
  border-collapse: collapse;
  width: 100%;
}

th, td { 
  text-align: left; 
}
   
    tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
    }
</style>
<?php 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
 
    <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper">  
            <div class="row">
                <div class="col-md-12">

                    <!---  modal de eliminar -->
                    <div class="modal fade in" id="mymodal2" style="background-color: rgba(3, 64, 95, 0.3);   padding-right: 17px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> estás seguro de eliminar el taller   ?</p>
                                    <input type="hidden" id="2eliminare1" name=""> 
                                </div>
                                <input type="hidden" value="" id="numero">
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminary2" id="eliminary2" onclick=" 
                                  
                                    eliminar() " value="585">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---  modal de notas -->
                    <div class="modal fade in" id="mymodal4" style="background-color: rgba(3, 64, 95, 0.3);   padding-right: 17px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div id="_MSG2_"></div>
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar3" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> Está seguro de subir  los promedios  de los foros a la carga académica de las notas de los estudiantes? </p> Este proceso se hace una sola vez por periodo. 
                                    <input type="hidden" id="tecnico" name="tecnico"> <br>  <br>    
                                    <strong>Periodo Actual:</strong><br>  
                                    <input type="" class="form-control" name="p" id="p" value="<?php echo $_SESSION['numero'] ?>" disabled>
                                     <br>    
                                    <strong>Tipo de calificación:</strong><br>  
                                    <select class="form-control" id="tipo">
                                        <option></option>
                                        <?php foreach ($tipo as $key ): ?>
                                            <option value="<?php echo $key[1] ?>"><?php echo $key[0] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <input type="hidden" value="" id="numero">
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button"  class="btn btn-primary" name="eliminary2" id="eliminary2" onclick=" 
                                  
                                    subir_nota() " value="585">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---  modal de actualizar -->
                    <div class="modal fade in" id="mymodal3" style="background-color: rgba(3, 64, 95, 0.3);   padding-right: 17px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Actualizar foro</h4>
                                </div>
                                <div class="modal-body">
                                    <strong>Tema:</strong><br>
                                    <input type="" id="tema2" name="" class="form-control"><br>
                                    <strong>Pregunta:</strong><br>
                                    <textarea id="pregunta2" class="form-control"> </textarea><br>

                                    <strong>Periodo:</strong><br>
                                    <input type="" id="periodo" name="" class="form-control" disabled><br> 
                                </div>
                                <input type="hidden" value="" id="numero2">
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal" class="btn btn-primary" onclick=" 
                                  
                                    actualizar() "  >Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>


                    <button type="button" id='iss' style="background-color:transparent;border:0"  data-toggle="modal" data-target="#myModal"  > </button>
                    <div class="modal fade" id="myModal" role="dialog"        >
                        <div class="modal-dialog modal-lg"style=" background-color: #f39c12 ">
                            <div class="modal-content"style=" background-color: #f39c12 ">
                                <div class="modal-body" style="color: #fff"><button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Alerta</h4>
                                    <p id="ph"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                                            
                    <div id="tablaw"></div>
                    <section class="content">
                        <div class="row"><div id="sapo"></div>
                            <div class="col-md-4">
                        <div class="box box-info" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <h4>Buscar Foro</h4>
                                <form action="" method="post">
                                    <label for="curso">Sedes y jornadas:</label>
                                        <select class="form-control" id="jornada_sede1"> 
                                        <?php
                                        $js1='';
                                        foreach($dat[0] as $key){
                                        ?>
                                            <option value="<?php echo($key['ID_JS']) ?>">
                                                <?php echo($key['sede']." ".$key['jornada']) ?>
                                            </option>
                                            <?php
                                            $js  = ($js1.''.$key['ID_JS']);
                                            $js1=$key['ID_JS'];
                                        } 
                                        foreach($dat[2] as $keyq){  ?>
                                            <option value="<?php echo($keyq['ID_JS']) ?>">
                                                <?php echo($keyq['sede']." ".$keyq['jornada']) ?>
                                            </option> <?php 
                                        }
                                        
                                        
                                        ?>

                                    </select>    
                                    <label for="curso" id="fri"  >Cursos:</label>          
                                    <select class="form-control" id="curso1" >
                                    </select>  

                                    <label for="curso" id="fri2" >Asignaturas:</label>          
                                    <select class="form-control" id="asignaturas1"    >
                                    </select>
                                    <button type="submit" id="Buscar" class="btn btn-info enter" >Buscar</button>
                                </form>
                            </div>
                        </div>
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <form id="register" name='register' method="post">
                                    <div id="_MSG_" style="margin:5px"></div>
                                    <strong>Crear Foro</strong><br><br>
                                     <label for="curso">Sedes y jornadas:</label>
                                        <select class="form-control" id="jornada_sede2" name="jornada_sede2"> 
                                        <?php
                                        $js1='';
                                        foreach($dat[0] as $key){
                                        ?>
                                            <option value="<?php echo($key['ID_JS']) ?>">
                                                <?php echo($key['sede']." ".$key['jornada']) ?>
                                            </option>
                                            <?php
                                            $js  = ($js1.''.$key['ID_JS']);
                                            $js1=$key['ID_JS'];
                                        }
                                        $t=0;
                                        foreach($dat[2] as $keyq){
                                            $y=$t++;

                                            if ($keyq['ID_JS']!=$js[$y]){  ?>
                                                <option value="<?php echo($keyq['ID_JS']) ?>">
                                                    <?php echo($keyq['sede']." ".$keyq['jornada']) ?>
                                                </option> <?php 
                                            }
                                        }
                                        
                                        
                                        ?>

                                    </select>   
                                    <label for="curso">Curso</label>
                                    <select class="form-control" id="curso2" name="curso2">
                                    </select>
                                    <label for="asignatura"  id="label">Asignatura</label>
                                    <select class="form-control" id="asignaturas2" name="asignaturas2"  required >
                                    </select>
                                    <label for="tema">Tema</label>
                                    <textarea class="form-control" id="tema" name="tema" required=""></textarea>
                                    <label for="pregunta">Pregunta</label>
                                    <textarea class="form-control" id="pregunta" name="pregunta" required=""></textarea><br>
                                    <button type="submit" id="crear" class="btn btn-primary enter">Crear</button>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-8" id="foro">
                            <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tablaF">
                                    <div class="box-body" id="tabla">
                                    </div>
                                </div>
                                <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tabF">
                                    <div class="box-body" id="tabla_foro">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer>
    </div>
                    
                
      <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 
<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>


<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>
<!-- iCheck --> 


  
    <script>
        function mostrar(){
          $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }

        function ver_select(){ 
            mostrar();
            var id_js = $('#jornada_sede2').val(); 
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
                    data: {
                    id_js,id
                },
                dataType: "text",
                success: function(data) {                 
                    $('#curso2').html(data);            
                    $('#curso1').html(data);  
                    let id_grado_sede = $('#curso2').val();
                    var id=<?php echo $_SESSION['Id_Doc'] ?>;
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                        data: {
                            id_grado_sede,id
                        },
                        dataType: "text",
                        success: function(data) { 
                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 
                            $('#asignaturas2').html(data);  
                            $('#asignaturas1').html(data);  
                        }
                    });
                }
            });
        }
        ver_select();
        $("#jornada_sede2").change(function() {
            mostrar();
            var id_js = $('#jornada_sede2').val(); 
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
                    data: {
                    id_js,id
                },
                dataType: "text",
                success: function(data) {   
                                   
                     $('#curso2').html(data);  
                    let id_grado_sede = $('#curso2').val();
                    var id=<?php echo $_SESSION['Id_Doc'] ?>;
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                        data: {
                            id_grado_sede,id
                        },
                        dataType: "text",
                        success: function(data) { 
                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 
                            $('#asignaturas2').css('display', 'block');
                            $('#asignaturas2').html(data);  
                             
                        }
                    });
                }
            });

        });

        
        $("#curso2").change(function() {
            mostrar();
            let id_grado_sede = $('#curso2').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                data: {
                    id_grado_sede,id
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    $('#asignaturas2').css('display', 'block');
                    $('#asignaturas2').css('display', 'block');
                    $('#asignaturas2').html(data);       
                }
            });
        }); 
     
        $(document).on("submit", "#register", function(e){
            e.preventDefault();  
             
            $.ajax({

                type: "post",
                url: "../../../ajax/docente/foro.php?action=form",
                data: $(this).serialize(),
                dataType:"json", 
                success: function(data)
                {    
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                  
                    if(data[0]>0){
                         var cursoB = $("#curso1").val();
                        var asignaturaB = $("#asignaturas1").val();
                        $.ajax({
                            type: "post",
                            url: "../../../ajax/docente/foro.php?action=foro_",
                            data: {
                                cursoB,
                                asignaturaB
                            },
                            dataType: "text",
                            success: function(data) {
                                $('body').loadingModal({text: 'Showing loader animations...'});
                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} );  
                                
                                Swal.fire({ 
                                  icon: 'success',
                                  title: 'Registro Exitoso ',
                                  showConfirmButton: false,
                                  timer: 2000
                                });



                                $('#tabla').html(data); 
                                document.getElementById('tema').value=''; 
                                document.getElementById('pregunta').value=''; 
                            }
                        });
                        
                    }else{
                        Swal.fire({ 
                          icon: 'error',
                          title: 'Error en el Registro ',
                          showConfirmButton: false,
                          timer: 2000
                        });
                    }
               
                }
            });
        });

        $("#jornada_sede1").change(function() {
            mostrar();
            var id_js = $('#jornada_sede1').val(); 
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
                    data: {
                    id_js,id
                },
                dataType: "text",
                success: function(data) {   
                                   
                     $('#curso1').html(data);  
                    let id_grado_sede = $('#curso1').val();
                    var id=<?php echo $_SESSION['Id_Doc'] ?>;
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                        data: {
                            id_grado_sede,id
                        },
                        dataType: "text",
                        success: function(data) { 
                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 

                            $('#asignaturas1').css('display', 'block');
                            $('#asignaturas1').html(data);  
                             
                        }
                    });
                }
            });

        });

        
        $("#curso1").change(function() {
            mostrar();
            let id_grado_sede = $('#curso1').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                data: {
                    id_grado_sede,id
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    $('#asignaturas1').css('display', 'block');
                    $('#asignaturas1').css('display', 'block');
                    $('#asignaturas1').html(data);       
                }
            });
        });
        

        function eliminar(){ 
            var elimForo=$('#numero').val();
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/foro_respuesta.php?action=eliminarF",
                data: {
                    elimForo
                },
                dataType: "text",
                success: function(data){
                    if(data == 1){

                        $('body').loadingModal({text: 'Showing loader animations...'});
                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );  
                        Swal.fire({ 
                          icon: 'error',
                          title: 'No se puede borrar el foro',
                          showConfirmButton: false,
                          timer: 2000
                        });
                    }
                    if(data == 2){
                        var cursoB = $("#curso1").val();
                        var asignaturaB = $("#asignaturas1").val();

                        


                        $.ajax({
                            type: "post",
                            url: "../../../ajax/docente/foro.php?action=foro_",
                            data: {
                                cursoB,
                                asignaturaB
                            },
                            dataType: "text",
                            success: function(data) {
                                $('body').loadingModal({text: 'Showing loader animations...'});
                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} );  
                                
                                Swal.fire({ 
                                  icon: 'success',
                                  title: 'Registro elimnado ',
                                  showConfirmButton: false,
                                  timer: 1500
                                });

                                $('#tabla').html(data); 
                            }
                        });

                        
                    }
                }
            });
        }



        function actualizar(){ 
            var tema=$('#tema2').val();
            var pregunta=$('#pregunta2').val();
            var id=$('#numero2').val();
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/foro.php?action=actualizar_foro",
                data: {
                    pregunta,id,tema
                },
                dataType: "text",
                success: function(data){
                    if(data == 1){

                        $('body').loadingModal({text: 'Showing loader animations...'});
                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );  
                        Swal.fire({ 
                          icon: 'error',
                          title: 'No se puede actualizar el foro',
                          showConfirmButton: false,
                          timer: 2200
                        });
                    }
                    if(data == 2){
                        var cursoB = $("#curso1").val();
                        var asignaturaB = $("#asignaturas1").val();

                        


                        $.ajax({
                            type: "post",
                            url: "../../../ajax/docente/foro.php?action=foro_",
                            data: {
                                cursoB,
                                asignaturaB
                            },
                            dataType: "text",
                            success: function(data) {
                                $('body').loadingModal({text: 'Showing loader animations...'});
                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} );  
                                
                                Swal.fire({ 
                                  icon: 'success',
                                  title: 'Foro Actualizado ',
                                  showConfirmButton: false,
                                  timer: 1500
                                });

                                $('#tabla').html(data); 
                            }
                        });

                        
                    }
                }
            });
        }
        
        function foro(foro,tema,pregunta){
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/foro_respuesta.php?action=foroRES",
                data: {
                    foro,tema,pregunta
                },
                dataType: "text",
                success: function(data){
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );

                    $("#tablaF").css('display', 'none');
                    $("#tabF").css('display', 'block');
                    $('#tabla_foro').html(data);
                }
            });
        }


        $("#Buscar").click(function(event){
            event.preventDefault();
            debugger;
            mostrar();
            var cursoB = $("#curso1").val();
            var asignaturaB = $("#asignaturas1").val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/foro.php?action=foro_",
                data: {
                    cursoB,
                    asignaturaB
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    $("#tabF").css('display', 'none');
                    $("#tablaF").css('display', 'block');
                    $('#tabla').html(data);
                }
            });
        });
        function subir_nota(){
            mostrar();
            var p = $("#p").val();
            var tipo = $("#tipo").val();
            if (p=='') {

                $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                document.getElementById('p').focus();
                mensaje2(2,'El campo periodo es requerido');
                return true;
            }
            if (tipo=='') {

                $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                document.getElementById('tipo').focus();
                mensaje2(2,'El campo tipo  es requerido');
                return true;
            }
            var tecnico = $("#tecnico").val();
            var asignaturas1 = $("#asignaturas1").val();
            var curso1 = $("#curso1").val();
            var jornada_sede1 = $("#jornada_sede1").val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/foro.php?action=nota_foro",
                data: {
                    p,tecnico,tipo,
                    curso1,jornada_sede1,asignaturas1
                },
                dataType: "text",
                success: function(data) {

                    document.getElementById('cerrar3').click();
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    if (data==1) {
                        Swal.fire({ 
                          icon: 'success',
                          title: 'HAS REGISTRADO UNA NUEVA NOTA',
                          showConfirmButton: false,
                          timer: 2600
                        });
                    }if (data==0) {

                        Swal.fire({ 
                          icon: 'error',
                          title: 'ya hay una nota registrada',
                          showConfirmButton: true, 
                        });

                    }if (data==2) {

                        Swal.fire({ 
                          icon: 'error',
                          title: 'No tienes foros registrado en el periodo señalado',
                          showConfirmButton: true, 
                        });

                    }
                }
            });
        }

        
    </script>
</body>

  