<?php
session_start();
require_once "../../../codes/alumno/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../login.php");
    }
include "../../../codes/alumno/alumno.php";
$alumno=new alumno();
include('../enlaces/head.php');
$dat=$alumno->curso($_SESSION['id_informe_academico']);
?>
<style>
    #i{
        cursor: not-allowed;
    }
      
    .i{
        cursor: not-allowed;
    }
            .profile-user-img {
                            margin: 0;
                            width: 60px;
                            height: 60px;
                            border: 3px solid #3c8dbc;
                        }
                 
             
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
            .tr1:hover {
                border:solid 2px #DDD;
                padding:40px;
            }
        
    .iradio_flat-red {
        display: inline-block;    
        vertical-align: middle;
        margin: 0;
        padding: 0;
        width: 20px;
        height: 20px;
        border: none;
        cursor: pointer;
    }
    textarea {
        min-height: 55px;
        max-height: 55px;
        min-width: 100%;
        max-width: 100%;
    }
    
    #crear, #Buscar {
        margin-top: 10px;
    }
    #tt{
        cursor: ns-resize;
    }
    #row, #tabF, #tablaF, #tabR {
        display: none;
    }
        .bin::-webkit-scrollbar{
width: 6px;


    }
    .bin::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #00c0ef   ;


    }

       body::-webkit-scrollbar{
width: 0px;


    }
</style>
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  

<body class="skin-blue sidebar-mini sidebar-collapse" >
 
    <div class="wrapper" class="form-control"  >
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper"  >  
            <div  > 
                <div class="row" >
             


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
                                            
                    <div id="tablaw" ></div>
                    <section class="content" >
                        <div  >
                            <div class="col-md-2">
                              
                                
                                <div id='timon'></div>
                                <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <div class="box-body">
                                        <h4 style=" ">Buscar Examen</h4>
                                        <form action="" method="post"> 
                                            <select class="form-control" id="asignaturaB">
                                                <option value="">Seleccione Asignatura</option>
                                                <?php
                                                foreach($dat[1] as $key){
                                                    if($key['area']!=1 || $key['codigo']==01){ ?>
                                                        <option value="<?php echo($key['nombre']) ?>,<?php echo($key['id_area']) ?>,0">
                                                            <?php echo($key['nombre']) ?>   
                                                        </option> <?php
                                                    }
                                                }
                                                foreach($dat[0] as $keyq){?>
                                                    <option value="<?php echo($keyq['nombre']) ?>,<?php echo($keyq['id_competencias']) ?>,1">
                                                        <?php echo($keyq['nombre']) ?>   
                                                    </option><?php
                                                }
                                                ?> 
                                            </select> 
                                            <button type="button" class="btn btn-primary" style="width: 100%" id="Buscar" onclick="rie()">Buscar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="box box-info bin" style="height: 482px;
                                overflow: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tablaF">
                                    <div class="box-body" id="tabla">
                                    </div>
                                </div>
                                <div class="box box-info bin" style="height: 482px;
                                overflow: auto;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tabF">
                                    <div class="box-body" id="tabla_foro">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="tabR">
                                <div class="box box-info bin" style="height: 482px;
                                overflow: auto;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <div class="box-body" id="tabla_R">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div> 
        </div>
        
        <input type="hidden" value="" id="visi">
        <input type="hidden" value="" id="visi2">
        <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer>
    </div>
    </body>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">
 

<script src="../../../js/jquery.loadingModal.js"></script>

<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>

 

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
    <script>
        function mostrar(){
            $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }
        
      
        function examen_click2(id,nombre,hora,minutos,id_tecnica_por_paso,base,final){
            mostrar(); 
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/examen_tecnico.php?action=examenR",
                data: {
                    id,nombre,hora,minutos,id_tecnica_por_paso,base,final
                },
                dataType: "text",
                success: function(data){
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    if (data==-1) {
                        Swal.fire({
                         icon: 'error',
                          title: 'Acceso denegado',
                          text: 'Todavia no es hora del examen',  
                        }) 
                    }
                    if (data==0) {
                        Swal.fire({
                         icon: 'error',
                          title: 'Acceso denegado',
                          text: 'Ya paso la hora del  examen',  
                        }) 

                          
                    }
                    if (data!=0 && data!=-1 ) { 
                        $("#tablaF").css('display', 'none');
                        $("#tabR").css('display', 'none');
                        $("#tabF").css('display', 'block');
                        $('#tabla_foro').html(data);
                    }
                }
            });
        }




        function examen_click(id,nombre,hora,minutos,id_materia_por_paso,base,final){
            mostrar(); 
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/examen.php?action=examenR",
                data: {
                    id,nombre,hora,minutos,id_materia_por_paso,base,final
                },
                dataType: "text",
                success: function(data){
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 

                    if (data==-1) {
                        Swal.fire({
                         icon: 'error',
                          title: 'Acceso denegado',
                          text: 'Todavia no es hora del examen',  
                        }) 
                    }
                    if (data==0) {
                        Swal.fire({
                         icon: 'error',
                          title: 'Acceso denegado',
                          text: 'Ya paso la hora del  examen',  
                        }) 

                          
                    }
                    if (data!=0 && data!=-1 ) { 
                        $("#tablaF").css('display', 'none');
                        $("#tabR").css('display', 'none');
                        $("#tabF").css('display', 'block');
                        $('#tabla_foro').html(data);
                    }
                }
            });
        }

        function click_query2(id,nota){
            mostrar(); 
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/examen_tecnico.php?action=resultadoE",
                data: {
                    id,nota
                },
                dataType: "text",
                success: function(data){

                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 

                    $("#tablaF").css('display', 'none');
                    $("#tabF").css('display', 'none');
                    $("#tabR").css('display', 'block');
                    $('#tabla_R').html(data);
                }
            });
                
        }
        function click_query(id,nota){
            mostrar(); 
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/examen.php?action=resultadoE",
                data: {
                    id,nota
                },
                dataType: "text",
                success: function(data){

                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 

                    $("#tablaF").css('display', 'none');
                    $("#tabF").css('display', 'none');
                    $("#tabR").css('display', 'block');
                    $('#tabla_R').html(data);
                }
            });
                
        }
                
        function rie(){

            var asignatura = $('#asignaturaB').val();
            if (asignatura=="") {
                Swal.fire({
                 icon: 'info',
                  title: 'Ingrese la asignatura',  
                });
                return ;
            }
            mostrar(); 
            $("#tabla").css('display', 'block');
            debugger;
            var porciones = asignatura.split(',');
            
            if(porciones[2]==0){ 

                mostrar();
                $.ajax({
                    type: "post",
                    url: "../../../ajax/alumno/examen.php?action=tabla",
                    data: {
                        asignatura
                    },
                    dataType: "text",
                    success: function(data) {
                        $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                        $("#tabF").css('display', 'none');
                        $("#tabR").css('display', 'none');
                        $("#tablaF").css('display', 'block');
                        $('#tabla').html(data);
                    }
                });
            }else{
                mostrar();
                $.ajax({
                    type: "post",
                    url: "../../../ajax/alumno/examen_tecnico.php?action=tabla",
                    data: {
                        asignatura
                    },
                    dataType: "text",
                    success: function(data) {
                        $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                        $("#tabF").css('display', 'none');
                        $("#tabR").css('display', 'none');
                        $("#tablaF").css('display', 'block');
                        $('#tabla').html(data);
                    }
                });
            }
        }

    </script>
<?php
include('../enlaces/footer.php');
?>