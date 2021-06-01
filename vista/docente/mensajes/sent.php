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
        <style type="text/css">
            .bin{
                color: #333;
                background-color: #fff;
                border-color: #ccc;
                height: 33px;
            }
            .label{
                padding: 5px
            }
            tr:hover{
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 4px 0 0 8px rgba(0.4, 0.1, 0.2, 0);
            }
            
        </style>
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
                                    <li class="active"><a href="sent.php"><i class="fa fa-send-o "></i> Enviados</a></li>
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
                                <select id="mySelect" onchange="myFunction(1)" class="form-control" style="border-radius:5px;width:67px;height: 34px">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                                <div class="box-tools pull-right">
                                    <div class="has-feedback">
                                        <input type="text" class="form-control   " id="fname" placeholder="Buscar asunto.." onkeyup="myFunction(1)" style="border-radius:5px;margin-top: 5px;">
                                        <span class="fa fa-search form-control-feedback" style=" "></span>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div id="tabla"></div>
                            <div class="box-footer no-padding">
                            </div>
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
    <script type="text/javascript">
        function mostrar1(){
            $('body').loadingModal({text: 'Cargando...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        } 
        for (var i = 0; i < 100; i++) {
            function myFunction(i) {

                var dato = document.getElementById("fname").value;

                var mySelect = document.getElementById("mySelect").value;
                var id=<?php echo $_SESSION['Id_Doc'] ?>;
                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/tabla_mensaje.php?action=envios",
                    data: {
                        i,
                        dato,
                        mySelect,
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
                    url: "../../../ajax/docente/tabla_mensaje.php?action=envios", 
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

   
    </script>



 
