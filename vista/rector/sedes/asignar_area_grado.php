<?php

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session']);
    }
include('../enlaces/head.php');


include('../../../codes/rector/grado.php');
$grado=new grado();
$id= $_GET['id'];
  
 
?> 

  <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
 
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty  ?>">
 
  <input type="hidden" value="<?php echo($id) ?>" id="id">
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
    <div class="content-wrapper"> 
      <div class="container">
        <div class="row">
          <br>  

          <div class="col-md-10 "  id="r" style="border-top: solid 3px #1f82b1; margin: 10px; background-color: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div id="cuadrohonor_widget-3" class="widget-main" style="font-size: 13px"> 
              <h4 style="font-family:initial;padding-bottom: 1px; <?php echo $sty ?>">
               <?php
               //TRAER TODO GRADO_SEDE
                $con=" id=$id";
                $datos=$grado->consultar_sede_grados($con);
                foreach ($datos as $key) {
                  ?>
                  Sede: <?php echo($key['sede']); ?><br>
                  Jornada:<?php echo $key['jornada'] ?><br>
                  Curso: <?php echo($key['grado']." ".$key['numero']); ?> 
                  <?php
                }
                ?>
              <div id="_MSG2_" style="margin-top: 10px"></div>
              </h4> 
              <div id="ver_areas"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">

      <!-- /.tab-pane -->

    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg"></div> 
  </div>


 
 
 
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>


<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
<script>
$('.select2').select2({    
  language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});
</script>


<script type="text/javascript">
  function mostrar1(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }  
    var id=<?php echo $id;?>; 
    function mostrar(){
      mostrar1();
      $.ajax({   
        type: "post",
        data:{id},  
        url:"../../../ajax/rector/grado/grado.php?action=ver_areas",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#ver_areas').html(data); 
        }  
      }); 
    }


  function funct(doc,id){  
    mostrar1();
    $.ajax({


      type: "post",
      data:{doc,id},  
      url:"../../../ajax/rector/grado/grado.php?action=carga_docentes",
      dataType:"text",  
      success: function(data)
      {  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
        mensaje2(3,'Carga academica exitosa');
      }
    });
  } 

  function todos(doc){ 
    var id=<?php echo $id;?>; 
    mostrar1();
    $.ajax({   
      type: "post",
      data:{id,doc},  
      url:"../../../ajax/rector/grado/grado.php?action=carga_docentes_todos",
      dataType:"text", 

      success:function(data){ 
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
        mostrar();
        mensaje2(3,'Carga academica actualizada.');
      }  
    });  
  }
   mostrar();
     
    
 </script>