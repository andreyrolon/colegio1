
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"  
        crossorigin="anonymous"> 
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
?>
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <div class="container">
        <div class="row">
          <input type="hidden" value="<?php echo $id ?>" id="id">
          <input type="hidden" id="mio" value="<?php echo $id ?>">
         <br> 
          <div class="col-md-11 "  id="r">
            <div style="background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
             <div style="background-color: #28A5E6;padding: 10px"><div style="  color: #fff">  <strong>SISITEMA INSTITUCIONAL DE EVALUACIÓN ESTUDIANTIL</strong> </div></div>
              <div class="modal-body table-responsive" id="pdf"> 
                <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
                      <div class="btn btn-default btn-file">
                        
                          <i class="fa fa-file-pdf-o"></i> Cambiar El Formato
                          <input type="file" name="Foto" id="Foto" accept="application/pdf,application" />
                          <input type="hidden" name="url" id="url" value="../../../img/b0a57492e7b5d997a589bd8085c5bcb7.jpg">

                      </div> 
                    <button type="button" class="btn btn-primary" name="foto" onclick="sasa()">Actualizar</button><br><br> 
                    </form>
              <iframe  src="../../../archivos_colegio/MANUAL_DE_EVALUACION.pdf" style="border:solid 1.2px;width:100%;height: 900px" frameborder="0"></iframe></div>
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
  </div>

<!-- Slimscroll -->
<script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../bower_components/fastclick/lib/fastclick.js"></script> 
<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>
 




<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>



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

  <script>
  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }
 

 function sasa() { mostrar();
    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({
      data:parametros,
      url:"../../../ajax/rector/archivos/archivos.php?action=manual_e",
      type:"POST",
      contentType:false,
      processData:false,
      success: function(rety){ 
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
        window.location.assign( window.location.href); 
                               
      }
    });
                        
  }
  </script>
</body>



