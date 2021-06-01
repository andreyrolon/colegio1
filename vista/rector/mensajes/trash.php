<?php
session_start();
include "../../../codes/rector/conexion.php";
include "../../../codes/docente/chat.php";
$chat=new chat();
$mensaje=$chat->mensajes($_SESSION['Id_Doc']); 
include('../enlaces/head.php');
    include('../enlaces/header.php');
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>"   class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
             

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Crear Mensaje</a>

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
                                <select id="mySelect" onchange="myFunction(1)" class="form-control" style="width:70px;">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                                <div class="box-tools pull-right">
                                    <div class="has-feedback">
                                        <input type="text" class="form-control input-sm" id="fname" placeholder="Search Mail" onkeyup="myFunction(1)">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
                                </div>
                                <!-- /.box-tools -->
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
    </div>
    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>
    <!-- iCheck -->
    <script src="../../../plugins/iCheck/icheck.min.js"></script>

    <!-- Page Script -->
    <script>
        $(function() {
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('.mailbox-messages input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function() {
                var clicks = $(this).data('clicks');
                if (clicks) {
                    //Uncheck all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                    $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                    //Check all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("check");
                    $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
            });

            //Handle starring for glyphicon and font awesome
            $(".mailbox-star").click(function(e) {
                e.preventDefault();
                //detect type
                var $this = $(this).find("a > i");
                var glyph = $this.hasClass("glyphicon");
                var fa = $this.hasClass("fa");

                //Switch states
                if (glyph) {
                    $this.toggleClass("glyphicon-star");
                    $this.toggleClass("glyphicon-star-empty");
                }

                if (fa) {
                    $this.toggleClass("fa-star");
                    $this.toggleClass("fa-star-o");
                }
            });
        });

    </script>

    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
    <script type="text/javascript">
        for (var i = 0; i < 100; i++) {
            function myFunction(i) {

                var dato = document.getElementById("fname").value;

                var mySelect = document.getElementById("mySelect").value;

                $.ajax({
                    type: "post",
                    url: "../../../ajax/rector/tabla_mensaje.php?action=tabla1",
                    data: {
                        i,
                        dato,
                        mySelect
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#tabla').html(data);
                    }
                });
            }
        }

        $(document).ready(function() {
            function mostrar() {
                $.ajax({
                    type: "post",
                    url: "../../../ajax/rector/tabla_mensaje.php?action=tabla1",
                    dataType: "text",
                    success: function(data) {
                        $('#tabla').html(data);
                    }
                });
            }
            mostrar();
        });

    </script>
</body>



 
