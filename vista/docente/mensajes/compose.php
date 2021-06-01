    <?php 
session_start();
if(!isset($_SESSION['Session'])){
    header("location: ../../../login.php");  
}
include "../../../codes/docente/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
include('../enlaces/head.php');
 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper"  >
        <?php include('../enlaces/header.php'); ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
         

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        
                        <a href="compose.php" style="width: 100%" class="btn   btn-primary  "><i class="fa fa-envelope-o" style="margin-right:9px;margin-top: 2px; float: left;"></i> <span style="float: left;">Crear Mensaje</span></a><br> <br>

                        <div class="box box-solid" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                             
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="mailbox.php"><i class="fa    fa-folder-o"></i> Bandeja de entrada
                                            <?php if ($mensaje[0]>0){ ?>
                                                <span class="label label-primary pull-right">
                                                    <?php echo($mensaje[0]); ?> 
                                                </span>
                                            <?php } ?>
                                        </a></li>
                                    <li><a href="sent.php"><i class="fa fa-send-o "></i> Enviados</a></li>
                                    <li><a href="trash.php"><i class="fa fa-trash-o"></i> Papelaria</a></li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-header with-border">
                                <h3 class="box-title">Redactar nuevo mensaje</h3>
                            </div>
                            <!-- /.box-header -->
                            <div id="sapo"></div>
                            <form action="" id="formulario-envia" name="formulario-envia" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" id="tabla" name="tabla" value="1">
                                        <label for="usuario">Para:</label>
                                        <select name="usuario" id="usuario" class="form-control" onchange="myFunction()">
                                            <option value=""></option>
                                            <option value="1">Rector</option>
                                            <option value="2">Coordinador</option>
                                            <option value="3">Psicoorientador</option>
                                            <option value="4">Secretaria</option>
                                            <option value="5">Docente</option>
                                            <option value="6">Alumno </option> 
                                        </select> 
                                          
                                        <div id="ver1" style="display: none;margin-top: 13px;">
                                            <strong>Sedes y jornadas:</strong>
                                            <select id="jornada1" name="jornada1" class="  form-control select2" style="width: 100%"  onchange="buscar1()">
                                            
                                            </select>
                                        </div>
                                        <div id="ver2" style="display: none;margin-top: 13px;">
                                            <strong>Cursos:</strong>
                                            <select id="curso1" name="curso1" class="  form-control " style="width: 100%"  onchange="buscar2()">
                                            
                                            </select>
                                        </div>
                                        <div  id="hoi" style="display:none;padding-top: 13px;border-radius: 59px;">
                                        
                                        </div>
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
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer>
    </div>
</body>
<script src="https://don3y87ddu1r5.cloudfront.net/ckeditor/ckeditor.js"></script>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 

<script src="../../../js/jquery.loadingModal.js"></script>


<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<script>
  

    $('.select2').select2({
});
 
   function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


    }
    CKEDITOR.replace('compose-textarea',{
        height:300,
        filebrowserUploadUrl:'../../../ajax/mensajeria/mensaje.php' });

    
                            
    $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault();  
        mostrar();
  
        var parametros=new FormData($("#formulario-envia")[0]);
        $.ajax({

          data:parametros,
          url:"../../../ajax/docente/mensaje.php?action=registrar",
          type:"POST",
          contentType:false,
          processData:false,
          success: function(data){
           $('body').loadingModal({text: 'Showing loader animations...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 0;
            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
            
             window.location.assign( window.location.href);
          }
        }); 
    });



    function buscar1(){
        mostrar();
        var first_name = document.getElementById("tabla").value; 
        var jornada1 = document.getElementById("jornada1").value;
        var id=<?php echo $_SESSION['Id_Doc'] ?>;
        if (first_name==5) { 

            document.getElementById('ver2').style.display='none';
            $.ajax({

                type: "post",
                url: "../../../ajax/docente/mensaje.php?action=consultar_jornada",

                data: {
                    jornada1,id
                },
                dataType: "text",

                success: function(data) {
                    $('#hoi').html(data);


                }
            });
        } 
        if (first_name==6) { 
            var jorna=$('#jornada1').val(); 
            document.getElementById('ver2').style.display='block';
            $.ajax({

                type: "post",
                url: "../../../ajax/seles/seles.php?action=curso_mensaje", 
                data: { jorna,id },
                dataType: "text", 
                success: function(data) {
                    $('#curso1').html(data); 
                    var curso=$('#curso1').val(); 
                    $.ajax({

                        type: "post",
                        url: "../../../ajax/docente/mensaje.php?action=consultar_alumno", 
                        data: { jorna,id,curso },
                        dataType: "text", 
                        success: function(data) {
                            $('#hoi').html(data); 

                        }
                    });

                }
            });
        } 

        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
    }

    function buscar2(){ 
        mostrar();

        var curso=$('#curso1').val(); 
        var jorna=$('#jornada1').val(); 
        $.ajax({

            type: "post",
            url: "../../../ajax/docente/mensaje.php?action=consultar_alumno", 
            data: { jorna,curso },
            dataType: "text", 
            success: function(data) {

                $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                $('#hoi').html(data); 

            }
        });
    }


    function myFunction() {
        var first_name = document.getElementById("usuario").value;
        var id=<?php echo $_SESSION['Id_Doc'] ?>;
        mostrar();
        //si el mensaje es para la dministracion
        if (first_name==1 || first_name==2 || first_name==3 || first_name==4 ) { 
            $('#tabla').val(1);
            document.getElementById('ver2').style.display='none';
            $("#alumn").css("display", "none");
            $("#cur").css("display", "none");
            $("#ver1").css("display", "none");
            $("#ver2").css("display", "none");
            $("#hoi").css("display", "block");
            $.ajax({

                type: "post",
                url: "../../../ajax/docente/mensaje.php?action=consultar_admin",

                data: {
                    first_name
                },
                dataType: "text",

                success: function(data) {
                    $('#hoi').html(data);


                }
            });
        }

        //si el mensaje es para los docentes
        if (first_name==5) {
            $('#tabla').val(5);  
            $("#hoi").css("display", "block");
            $("#jornada1").css("display", "block");
            $("#ver1").css("display", "block"); 

            document.getElementById('ver2').style.display='none';
            $.ajax({

                type: "post",
                url: "../../../ajax/docente/mensaje.php?action=consultar_docente",

                data: {
                     id
                },
                dataType: "text",

                success: function(data) {
                    $.ajax({

                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_sede_jornadas", 
                        dataType: "text",

                        success: function(dataa) {
                            $('#jornada1').html(dataa);


                        }
                    }); 

                    $('#hoi').html(data);
                    


                }
            });    
        }

        //si el mensaje es para los alomnos
        if (first_name==6) { 
            $('#tabla').val(6);
            $("#hoi").css("display", "block");
            $("#jornada1").css("display", "block");
            $("#ver1").css("display", "block"); 
            $("#ver2").css("display", "block");  

            document.getElementById('curso1').style.display='block';
            $.ajax({

                type: "post",
                url: "../../../ajax/seles/seles.php?action=carga_academica_sede", 
                data: { id },
                dataType: "text", 
                success: function(data) {
                    $('#jornada1').html(data); 
                    var jorna=$('#jornada1').val(); 
                    $.ajax({

                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=curso_mensaje", 
                        data: { jorna,id },
                        dataType: "text", 
                        success: function(data) {
                            $('#curso1').html(data); 
                            var curso=$('#curso1').val(); 
                            $.ajax({

                                type: "post",
                                url: "../../../ajax/docente/mensaje.php?action=consultar_alumno", 
                                data: { jorna,id,curso },
                                dataType: "text", 
                                success: function(data) {
                                    $('#hoi').html(data); 

                                }
                            });

                        }
                    });
                }
            });
        }  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
    }

  

</script>
