<?php
 session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../index.html"); echo($_SESSION['Session']);
    }
include('../../../codes/docente/horario.php');
$doce=new horario();
include('../enlaces/head.php'); 
$se=$doce->sede($_SESSION['Id_Doc']);
 



 

  
 $sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
  
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <br>
      <div class="row">
        <div class="col-md-12">
           
          <!-- /.col -->
          <div class="col-md-12">




 

    
            <div id="tabla" style=""> 
            </div>

          
   
   






          </div>

        </div>
        <div class="col-md-12" style="padding: 30px" >
 
   
 
 
   
     
          <div id="table">
            
          </div>
        </div>
        <!-- /. box -->
     
    <!-- /.row -->
  </div>
  <!-- /.content -->
</div>






  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Ibunotas.</b> 
    </div>
    <strong>Desarrollado por Ibusoft
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
   <!-- ./wrapper -->

   <!-- jQuery 3 -->
   <!-- jQuery 3 -->



   <!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


 

<script src="../../../js/jquery.loadingModal.js"></script>
<script type="text/javascript">
    function mostrar1(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
 
 
  function tyt(id_docente){
    mostrar1();
     $.ajax({   
      type: "post",
      data:{id_docente},
      url:"../../../ajax/rector/horario.php?action=table",
      dataType:"text",
      success:function(data){  


        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#table').html(data); 
      }  
    });
  }

  function dd(){
    mostrar1();
    var id_docente= <?php echo $_SESSION['Id_Doc'] ?>; 
    $.ajax({   
      type: "post",
      data:{id_docente},
      url:"../../../ajax/rector/horario.php?action=ver_horario_docente",
      dataType:"text",
      success:function(data){  

        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        if (id_docente!='') { 
          document.getElementById('tabla').style.display='block';
          document.getElementById('table').style.display='block';
        }
        if (id_docente=='') { 
          document.getElementById('tabla').style.display='none';
          document.getElementById('table').style.display='none';
        }
      
        $('#tabla').html(data); 
        tyt(id_docente);

      }  
    });    
  }
       dd();     

</script>
