 
 <?php
 session_start();
 require_once "../../../codes/docente/chat.php";
 $chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session'])){
  header("location: ../../../index.html"); echo($_SESSION['Session']);
}


 
include('../enlaces/head.php');
?>


<style>
    table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left; 
}
   select{
    height: 250px;
   }
    #op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
    }
</style>
 <?php 
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
  <?php include('../enlaces/header.php');  



  ?>
<style>
 
[data-title] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  
    <?php if($style==''){ echo "font-size: 12px; ";  }else{ echo $style; } ?>
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 3px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}
tr:hover td{
    background-color: #55b3ca3d;
    padding:10px;
}
 
    .active-result  {
      <?php echo $style ?>
    }
    span{
      <?php echo $style ?>
    }
  </style>
  <!-- AQUI VA EL CONTENIDO -->
  <div class="content-wrapper"> 

    <div class=" ">
      <div class=" ">
        
        <!-- /.col -->
        <div class=" ">
 
  
         <br> 
           <div class="col-md-1"> 
 
          </div> 
          <div class="col-md-10 "  id="r">

            <div class="modal fade in" id="mymodal2" style="background-color: rgba(3, 64, 95, 0.3); ">
                        <div class="modal-dialog modal-lg">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 id="titulo3" class="modal-title" style="<?php echo $sty ?>">Ver plan de aula</h4>
                                </div>  
                                <div class="modal-body table-responsive" id="pdf">
                                    <iframe id="myImg" src="" style="width:100%;height: 700px" frameborder="0"></iframe></div>
                             
                            </div>
                        </div>
                    </div>





            <div  class="box box-primary" id="vv" style="display:  ; background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" ><strong>
               <div id="titulo2" style="padding: 7px;color: #fff; background-color: #3c8dbc">ARCHIVOS INSTITUCIONALES </div><br>
                 </strong>  
                  <div id="ver" style=" margin: 10px ">
                      
                    </div><div style="padding: 0.11px;margin-left: 10px;margin-right: 10px ">
                                   <div id="_MSG3_" ></div>
                </div>
              
               
            </div>
          </div>
 <br>

        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content -->







  <!-- /.content-wrapper -->
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
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <!-- jQuery 3 -->



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
 


 function  mostrarse(){  
  mostrar();
    var uno=1;
    $.ajax({   
        type: "post",
        data:{uno},  
        url:"../../../ajax/rector/plan_area/plan_area.php?action=ver_general",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#ver').html(data); 
        }  
      });
                        
  }
  mostrarse();

 




 
  </script>
</body>



