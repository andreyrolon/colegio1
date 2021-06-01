<?php 
session_start();
//mensajeria
require_once "../../../codes/rector/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

//session
if(!isset($_SESSION['Session1'])){
  header("location: ../../../login.php"); 
}
//trae los datos de la jornada y la sede
 

 
include('../enlaces/head.php'); 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;
?>
 






<body style=" <?php echo $sty ?> " class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper"  >
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  > 

      <div class="modal fade" id="alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(3, 64, 95, 0.3);">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header btn-primary">
              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
              <nav>Observacion</nav>
            </div>
            <div class="modal-body">
              <div id="modal2"> 

              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" value="0" id="valor" name="">
              <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Cancelar</button>
               
            </div>
          </div>
        </div>
      </div>
      <section id="content" class="content">
        <div class="row">
          <div class="col-md-3"> <br> 
                
            <div class="box box-primary"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <form   method="post">
                <div class="box-header with-border"  >
                  <strong>Observador año electivo:</strong>
                </div>
                <div class="box-body">
                  <input type="" class="form-control" id="apellido1" placeholder="Buscar Apellido"><br>

                  <button type="button" class="btn btn-block btn-danger" onclick=" buscar1()">buscar</button>
                </div>
              </form>
            </div>  <br> 
                
            <div class="box box-info"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <form   method="post">
                <div class="box-header with-border"  >
                  <strong>Observador acumulado:</strong>
                </div>
                <div class="box-body">
                  <input type="" class="form-control" name="" id="apellido2" placeholder="Buscar Apellido"><br>

                  <button type="button" class="btn btn-block btn-info" onclick=" buscar2()">buscar</button>
                </div>
              </form>
            </div>   
          </div> 
          <div class="col-md-9">
            <br> 
            <div class="box box-primary"  id="v" style=" padding:4px;  background-color: #ffff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
              <div id="_MSG2_"></div>
              <div id="tabla" class="row" > </div> 
            </div> 
          </div>
        </div> 
      </section>
    </div>
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
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
 
 
    function buscar2(){ 

      let apellido = $('#apellido2').val(); 

      
      mostrar();
      $.ajax({
        type: "post",
        url: "../../../ajax/rector/observador/observador_alumno.php?action=tabla2",
        data: {
          apellido
        },
        dataType: "text",
        success: function(data) {

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#col').css('display', 'block');
          $('#tabla').html(data);
        }
      }); 
    }

    function buscar1(){ 

      let apellido = $('#apellido1').val(); 

      
      mostrar();
      $.ajax({
        type: "post",
        url: "../../../ajax/rector/observador/observador_alumno.php?action=tabla1",
        data: {
          apellido
        },
        dataType: "text",
        success: function(data) {

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#col').css('display', 'block');
          $('#tabla').html(data);
        }
      }); 
    }
 
    function mostrar2(id,nombre,apellido){ 
 

      
      mostrar();
      $.ajax({
        type: "post",
        url: "../../../ajax/rector/observador/observador_alumno.php?action=mostrar2",
        data: {
          id,nombre,apellido
        },
        dataType: "text",
        success: function(data) {

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );  
          $('#modal2').html(data);
        }
      }); 
    }
    

  </script>




</body>

</html>
 