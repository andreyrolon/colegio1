 
 <?php
 session_start();
 require_once "../../../codes/rector/chat.php";
 $chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session1'])){
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




<body style=" <?php echo $sty ?>


 " class="hold-transition skin-blue sidebar-mini" >
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
           <div class="col-md-3"> 

            <div class="box box-danger" style="background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div id="titulo2" style="padding: 7px;color: # Registrar archivos generale; background-color: # "><strong>Registrar Archivos Generales:</strong></div><br> 
              <div class= "   "   style="margin: 7px; padding: 2px">
              <div id="_MSG_"></div>
                <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
                  <strong>Nombre:</strong><br>
                  <input type="text"  style="<?php echo $style ?>"  class="form-control" name="nombre" required>
                 <br> <strong>Descripción:</strong><br>
                  <textarea style="  <?php echo $style ?>  height: 150px" id="descripcion" name="descripcion" class="form-control" required=""></textarea>   
                  <br><strong>Buscar Archivo:</strong><br> 
                  <div class="btn btn-default btn-file" style="<?php echo $style ?>;width:  100%" >
                    <i class="fa fa-file-pdf-o"></i>Formato  PDF
                    <input type="file" name="Foto" id="Foto" accept="application/pdf,application"> 
                  </div> <br><br><br>
                  <button type=" " style="<?php echo $style ?>"  class="btn btn-block btn-danger" style="margin-bottom: 10px; <?php echo $style ?>"  ><strong>Registrar</strong></button> 

                </form>
              </div>
            </div>
          </div> 
          <div class="col-md-9 "  id="r">

           <div id="sapo">  </div>
           


              <div class="modal fade in" id="mymodal126" style="background-color: rgba(3, 64, 95, 0.3); ">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" style="<?php echo $sty ?>" > Confirmación</h4>
                    </div>
                    <div class="modal-body">
                      <p> estás seguro de eliminar este plan de aula   ?</p>
                      <input type="hidden" id="id">
                      <input type="hidden" id="elimini">
                    </div>
                    <div class="modal-footer">    
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminar_sede" id="btn" onclick=" var id=document.getElementById('id').value; var elimini=document.getElementById('elimini').value;eliminar(id,elimini)">Aceptar</button> 

                    </div>
                  </div>
                </div>
              </div>

            <div class="modal fade in" id="mymodal3" style="background-color: rgba(3, 64, 95, 0.3); ">
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 id="titulo4" class="modal-title" style="<?php echo $sty ?>">  Actualizar formato genaral </h4>
                                </div> <div id="_MSG2_" style=" margin: 10px"></div>
                                    <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                                <form name="formulario-envia2" id="formulario-envia2" enctype="multipart/form-data" method="post">
                                  <div class="modal-body table-responsive" id="pdf">
                                    
                                    <strong>Actualizar Descripción:</strong><br>
                                    <input type="text" name="nombres" id="nombres" style="<?php echo $style ?>"  class="form-control"><br> 
                                    <strong>Actualizar Descripción:</strong><br>
                                      <textarea id="descripcion3" name="descripcion3" style="<?php echo $style ?>"  class="form-control" required=""></textarea><br>   
                                      <input type="hidden" id="id_archivos_general" name='id_archivos_general'>
                                      <input type="hidden" id="rutas" name="rutas">
                                      <strong>Actualizar Archivo:</strong><br>
                                      <div class="btn btn-default btn-file"   style="<?php echo $style ?>;width:  100%">
                                        
                                          <i class="fa fa-file-pdf-o"></i>Formato  PDF
                                          <input type="file" name="Foto3" id="Foto3" accept="application/pdf,application">
                                          <input type="hidden" name="url" id="url">

                                      </div> <br><br>
                                      
                                   
                                  </div>
                                  <div class="modal-footer">    
                                    <button type=""   class="btn btn-block btn-primary"  style="<?php echo $style ?>"  name="eliminary2" id="eliminary2"   value="520">Actualizar</button> 
                                    <button type="button" class="btn  btn-block btn-danger"  style="<?php echo $style ?>"  data-dismiss="modal">Cancelar</button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>

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




            <div  class="box box-primary" id="vv" style="display:  ; background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><strong>
               <div id="titulo2" style="padding: 7px;color: #fff; background-color: #3c8dbc">ARCHIVOS GENERALES </div><br>
                 </strong>  
                  <div id="ver" style="margin: 10px">
                      
                    </div><div style="padding: 0.11px;margin-left: 10px;margin-right: 10px ">
                                   <div id="_MSG3_" ></div>
                </div>
              
               
            </div>
          </div>
 

        </div><br>
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
  
    $.ajax({   
        type: "post",
        data:{},  
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

 








 

 function eliminar(id,elimini){
       mostrar(); 
    $.ajax({   
        type: "post",
        data:{id,elimini},  
        url:"../../../ajax/rector/plan_area/plan_area.php?action=eliminar_general ",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          mostrarse(); 
        }  
      });
  }
  $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault();  
    mostrar(); 

    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({
      data:parametros,
        url:"../../../ajax/rector/plan_area/plan_area.php?action=insert",
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
 
        if(rety==1){
          mensaje(2,'Debe ingresar el archivo pdf');
          document.getElementById('Foto').focus();
        }else{ 
          document.getElementById("formulario-envia").reset();
          mensaje(3,'Registro exitoso');
          mostrarse();

        }
                               
      }
    });
  });
  $(document).on("submit", "#formulario-envia2", function(e){
    e.preventDefault();  
    mostrar(); 

    var parametros=new FormData($("#formulario-envia2")[0]);
    $.ajax({
      data:parametros,
        url:"../../../ajax/rector/plan_area/plan_area.php?action=actualizar_general",
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
        $("#mymodal3").modal("hide");
        mostrarse();  
      }
    });
  });
  </script>
</body>



