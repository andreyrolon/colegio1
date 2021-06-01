<?php
include "../../../codes/alumno/alumno.php";
session_start();
require_once "../../../codes/alumno/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

  if(!isset($_SESSION['Session2'])){
        header("location: ../../../login.php");
    }
$alumno=new alumno();
include('../enlaces/head.php');
$dat=$alumno->curso($_SESSION['id_informe_academico']);

if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
 
<style>
    .bin::-webkit-scrollbar{
        width: 6px;
    }
    .bin::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #00c0ef   ;


    }
  
    
    #crear, #Buscar {
        margin-top: 10px;
    }
    
    #row, #tabF, #tablaF {
        display: none;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
    <div class="wrapper">
        <?php 
        include('../enlaces/header.php'); ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <h4>Buscar Foro</h4>
                                <form action="" method="post">
                                    <label for="">Asignatura</label>
                                    <select class="form-control" id="btn1" >
                                    <option value="">Seleccione Asignatura</option>
                                        <?php
                                        foreach($dat[1] as $key){
                                            if($key['area']!=1 || $key['codigo']==01){
                                                ?>
                                                <option value="<?php echo($key['nombre'].','.$key['id_area'].',0') ?>">
                                                    <?php echo($key['nombre']) ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        foreach($dat[0] as $key){ 
                                            ?>
                                            <option value="<?php echo($key['nombre'].','.$key['id_competencias'].','.$key['id_periodo']) ?>">
                                                <?php echo($key['nombre']) ?>
                                            </option>
                                            <?php
                                            
                                        }
                                        ?>
                                    </select><br>
                                    <button  type="button" class="btn btn-block btn-danger" onclick="sasa()" >Buscar foro</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" id="foro">
                        <div class="box box-primary bin" style="height: 482px;overflow: auto;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tablaF">
                            <div class="box-body" id="tabla">
                            </div>
                        </div>
                        <div class="box box-primary bin" style="height: 482px;overflow: auto;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tabF">
                            <div class="box-body" id="tabla_foro">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
      <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 
<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 



<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>


<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
    <script>
        function mostrar(){
          $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }

        function  sasa(){  
            mostrar();
            var asignatura =document.getElementById("btn1").value;
             
                $.ajax({
                    type: "post",
                    url: "../../../ajax/alumno/foro.php?action=tabla",
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
                        $("#tablaF").css('display', 'block');
                        $('#tabla').html(data);
                    }
                });
             
        }
    </script>
</body> 
