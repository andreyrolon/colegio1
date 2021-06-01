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
                                                <li class="active"><a href="enviados.php"><i class="fa fa-send-o "></i> Enviados</a></li>
                                                <li><a href="papelera.php"><i class="fa fa-trash-o"></i> Papelaria</a></li>
                                            </ul>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <div class="col-md-9">
                                    <div class="box box-info " style=" 
                                    overflow: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tablaF">
                                        <div class="box-body" id="tabla">
                                        </div>
                                    </div>
                                    
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

    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
    <script>
        function mostrar1(){
            $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }
       
     
        for (var i = 0; i < 100; i++) {
            function myFunction(i) {
 
                var id=<?php echo $_SESSION['Id_Doc'] ?>;
                $.ajax({
                    type: "post",
                    url: "../../../ajax/alumno/tabla_mensaje.php?action=envios",
                    data: {
                        i, 
                        id
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#tabla').html(data);
                    }
                });
            }
        }
 
            function mostrar() {
                mostrar1();
                var id=<?php echo $_SESSION['Id_Doc'] ?>;
                $.ajax({
                    type: "post",
                    url: "../../../ajax/alumno/tabla_mensaje.php?action=envios",
                    data: {  id },
                    dataType: "text",
                    success: function(data) {
                        $('#tabla').html(data);
                        $('body').loadingModal({text: 'Showing loader animations...'});
                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                    }
                });
            }
            mostrar(); 
   $(document).on("submit", "#envio", function(e){
    e.preventDefault();  
    $.ajax({

      type: "post",
    url:"../../../ajax/docente/tabla_mensaje.php?action=mail_papelera_masivo", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 
        if (data==1) {
            mensaje(2,'Selecione los mensajes que desea enviar a papelera');
        } else{

           window.location.assign( window.location.href); 
        }

      }
    });
  });
   
    </script>
       

    </script>
 