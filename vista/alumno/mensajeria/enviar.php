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
include('../../docente/enlaces/head.php');
$dat=$alumno->curso($_SESSION['id_informe_academico']);
?>
 
 
  
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  <style type="text/css">
    body::-webkit-scrollbar{
width: 0px;


    }
    #sapo::-webkit-scrollbar{
width: 6px;


    }
    #sapo::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #3c8dbc;


    }
    #sapo{
        height: 664px;
                                overflow: auto;
    }
  
      
      
    @media only screen and (max-width: 1700px) {
  #sapo { 
    height:670px;
                                overflow: auto;
  }
}  
    @media only screen and (max-width: 1500px) {
  #sapo { 
    height: 590px;
                                overflow: auto;
  }
}
       @media only screen and (max-width: 1400px) {
  #sapo {
 
    
    height: 527px;
                                overflow: auto;
  }
}
  



       @media only screen and (max-width: 1200px) {
  #sapo {  
    height: 474px;
                                overflow: auto;
  }
}
            .label{
                padding: 5px
            }
            tr:hover{
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 4px 0 0 8px rgba(0.4, 0.1, 0.2, 0);
            }
            .bin{
                color: #333;
                background-color: #fff;
                border-color: #ccc;
                height: 33px;
            }
            
        </style>

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
 
    <div class="wrapper" class="form-control"  >
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper"   >  
            <div   class=" "> 
                 
             


                   
                   <nav style="font-size: 1px;">hhoih</nav>
                                            
                    <div id="tablaw" ></div>
                    <div  id="sapo">
                    <div id="_MSG_" style="margin:10px"></div>
                        <section class="content bin2" >
                            <div  >
                                <div class="col-md-3">
                                    <a href="enviar.php" style="width: 100%" class="btn   btn-primary  "><i class="fa fa-envelope-o" style="margin-right:9px;margin-top: 2px; float: left;"></i> <span style="float: left;">Crear Mensaje</span></a><br> <br>
                                    <div class="box box-solid" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                         
                                        <div class="box-body no-padding">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="recividos.php"><i class="fa    fa-folder-o"></i> Bandeja de entrada
                                                        <?php if ($mensaje[0]>0){ ?>
                                                            <span class="label label-primary pull-right">
                                                                <?php echo($mensaje[0]); ?> 
                                                            </span>
                                                        <?php } ?>
                                                    </a></li>
                                                <li><a href="enviados.php"><i class="fa fa-send-o "></i> Enviados</a></li>
                                                <li><a href="papelera.php"><i class="fa fa-trash-o"></i> Papelaria</a></li>
                                            </ul>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <div class="col-md-9">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-header with-border">
                                <h3 class="box-title">Redactar nuevo mensaje</h3>
                            </div>
                            <!-- /.box-header -->
                            <div id="ver"></div>
                            <form action="" id="formulario-envia" name="formulario-envia" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group"> 
                                        <label for="usuario">Para:</label>
                                        <div id="select_docente"></div>
                                          
                                         
                                         
                                        
                                    </div>
                                    <div class="form-group">
                                        <strong>Asunto:</strong>
                                        <input class="form-control" placeholder="" name="asunto" required>
                                    </div>
                                    <div class="form-group">

                                        
                                        <textarea id="compose-textarea" class="form-control" style="height: 300px" name="mensaje"> </textarea> 
                                    </div>
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Adjuntar archivo
                                            <input type="file" name="files">
                                        </div>
                                        <p class="help-block">Max. 20MB</p>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer"> 
                                        <button type="submit" style="width: 100%" class="btn btn-primary" name="send"><i class="fa  fa-send-o"></i> Enviar Mensaje</button>
                                    
                                </div>
                            </form>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /. box -->
                    </div>
                                 
                            </div>
                        </section> 
                        <div class="col-md-12 main" style=" background-color: #fff"><br>
                                    <div  style="padding: 10px" >
                                        <div class="pull-right -xs">
                                            <b> IBUnotas</b> 1.0
                                        </div>
                                        <strong>Desarrollado por  IBUsoft. <br></strong>  
                                    </div>
                                </div>
                    </div>
                </div>
            </div> 
        </div>
         
         
    </body>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 

<script src="../../../js/jquery.loadingModal.js"></script>


<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>

<script src="https://don3y87ddu1r5.cloudfront.net/ckeditor/ckeditor.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
    <script>

        CKEDITOR.replace('compose-textarea',{
            height:300,
            filebrowserUploadUrl:'../../../ajax/mensajeria/mensaje.php' });
        var editor = CKEDITOR.instances['compose-textarea'];
 

        function mostrar1(){
            $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }
       
     
    
         mostrar1();
        function mostrar() {  
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/mensaje.php?action=consultar_docente",
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    $('#select_docente').html(data);
                }
            });
        }
        mostrar(); 
        $(document).on("submit", "#formulario-envia", function(e){
        e.preventDefault();  
            mostrar();
      
            var parametros=new FormData($("#formulario-envia")[0]);
            $.ajax({

                data:parametros,
                url:"../../../ajax/alumno/mensaje.php?action=registrar",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                   $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    editor.setData('');
                    document.getElementById('formulario-envia').reset();
                   
                    mensaje(3,'Mensaje enviado');
                    $("#sapo").animate({
                       scrollTop:0
                    });
                }
            }); 
        });

        
   
    </script>
        
 