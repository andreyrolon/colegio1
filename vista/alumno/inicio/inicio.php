<?php
session_start();

include "../../../codes/docente/carga_academica.php";
require_once "../../../codes/alumno/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../index.html");
    }
 


$carga=new carga();
include('../enlaces/head.php');

$dat=$carga->tabla($_SESSION['Id_Doc']);
?>
  
  
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
 
    <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper">  
            <div class=" ">
                <div class="col-md-12">
               
                    <div id="tablaw"></div>
                    <section class="content">
                        <div class="row"> 
                            <div class="col-md-12"> 
                                 
                                 <div class=" "> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="../../../img_alumno/a2.png" alt="Los Angeles" style="    width: 1150px;
    height: 549px;">
      </div>

      <div class="item">
        <img src="../../../img_alumno/a4.png" alt="Chicago" style="    width: 1150px;
    height: 549px;">
      </div>
    
      <div class="item">
        <img src="../../../img_alumno/a3png.png" alt="New york" style="    width: 1150px;
    height: 549px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
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
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>