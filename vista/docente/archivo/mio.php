
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"  
        crossorigin="anonymous"> 
 <?php
 session_start();
 require_once "../../../codes/docente/chat.php";
 $chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session'])){
  header("location: ../../../index.php"); echo($_SESSION['Session']);
}



include('../enlaces/head.php');
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
  border-radius: 4px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 5px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 8px solid #000;
}
   table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left; 
}
tr:hover  {
 
   
     padding:10px;border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;  
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
  <?php include('../enlaces/header.php');  ?>
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <div class="container">
        <div class="row">
          <input type="hidden" value="<?php echo $id ?>" id="id">
          <input type="hidden" id="mio" value="<?php echo $id ?>">
         <br> 
          <div class="col-md-12 "  id="r">
            <div id="sapo"></div>
            <div style="background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
             <div style="background-color: #28A5E6;padding: 10px">
                <div style="  color: #fff">  <strong>MIS ARCHIVOS Y GUIAS 
                </strong> 
                </div>
              </div>

              
               <div class="modal fade in" id="mymodal2" style="background-color: rgba(3, 64, 95, 0.3); ">
                        <div class="modal-dialog modal-lg">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 id="titulo3" class="modal-title"> </h4>
                                </div>  
                                <div class="modal-body table-responsive" id="pdf">
                                    <iframe id="myImg" src="" style="width:100%;height: 700px" frameborder="0"></iframe></div>
                             
                            </div>
                        </div>
                    </div>
            
              <div class="modal fade in" id="mymodal126" style="background-color: rgba(3, 64, 95, 0.3); ">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" style="<?php echo $sty ?>" > Confirmación</h4>
                    </div>
                    <div class="modal-body">
                      <p> estás seguro de eliminar este plan de aula   ?</p>
                      <input type="hidden" id="ids">
                      <input type="hidden" id="elimini">
                    </div>
                    <div class="modal-footer">    
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminar_sede" id="btn" onclick=" var id=document.getElementById('ids').value; var elimini=document.getElementById('elimini').value;eliminar(id,elimini)">Aceptar</button> 

                    </div>
                  </div>
                </div>
              </div>
           <div class="modal fade in" id="mymodal3" style="background-color: rgba(3, 64, 95, 0.3); ">
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 id="titulo4" class="modal-title">ACTUALIZAR GUIAS </h4>
                                </div> <div id="_MSG2_" style=" margin: 10px"></div>
                                    <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                                <form name="formulario-envia2" id="formulario-envia2" enctype="multipart/form-data" method="post">
                                  <div class="modal-body table-responsive" id="pdf">
                                    
                                    <strong>Actualizar Descripción:</strong><br><br>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required=""><br>
                                    <strong>Actualizar Descripción:</strong><br>
                                      <textarea id="descripcion" name="descripcion" class="form-control" required=""></textarea><br>  
                                      <input type="hidden" id="id_archivos_docente" name='id_archivos_docente'>
                                      <input type="hidden" id="rutas" name="rutas">
                                      <strong>Actualizar Archivo:</strong> <br>
                                      <div class="btn btn-default btn-file" style="width:  70%">
                                        
                                          <i class="fa fa-file-pdf-o"></i>Formato  PDF
                                          <input type="file" name="Foto3" id="Foto3" accept="application/pdf,application">
                                          
  
                                      </div> <br> 
                                      
                                   
                                  </div>
                                  <div class="modal-footer">    
                                    <button type=""   class="btn btn-block btn-primary" name="eliminary2" id="eliminary2"   value="520">Actualizar</button> 
                                    <button type="button" class="btn  btn-block btn-danger" data-dismiss="modal">Cancelar</button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>

     <div class="modal fade in" id="mymodal" style="background-color: rgba(3, 64, 95, 0.3); ">
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 id="titulo" class="modal-title" style="<?php echo $sty ?>">  REGISTRAR GUIA EN PDF</h4>
                                </div> <div id="_MSG_" style=" margin: 10px"></div>
                                    <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                                <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
                                  <div class="modal-body table-responsive" id="pdf">
                                    <input type="hidden" value="<?php echo $_SESSION['Id_Doc'] ?>" name="docente" id="docente">
                                    
                                    <strong>Nombre:</strong><br>
                                    <input type="" class="form-control" id="nombres" name="nombres" required=""> <br>
                                    <strong>Descripción:</strong><br>
                                      <textarea id="descripcions" name="descripcions" class="form-control" required=""></textarea><br>   
                                      <strong>Buscar Archivo:</strong><br>
                                      <div class="btn btn-default btn-file" style="width:  70%" >
                                        
                                          <i class="fa fa-file-pdf-o"></i>Formato  PDF
                                          <input type="file" name="Foto" id="Foto" accept="application/pdf,application"> 

                                      </div> <br><br>
                                      
                                   
                                  </div>
                                  <div class="modal-footer">    
                                    <button type=""   class="btn btn-block btn-primary" name="eliminary2" id="eliminary2" onclick=" document.getElementById('id_are_grado').value=document.getElementById('Asignaturas').value;   " value="520">Aceptar</button> 
                                    <button type="button" class="btn  btn-block btn-danger" data-dismiss="modal">Cancelar</button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>

              <br>
              <button type="button" data-toggle="modal" data-target="#mymodal" style="margin-left: 10px ;" class="btn   btn-info">Nuevo</button>
              <div class="modal-body table-responsive" id="ver"> 
                
             
             </div>
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
 
 function  mostrarse(){  
  mostrar();
    var id=<?php echo $_SESSION['Id_Doc'] ?>;
    $.ajax({   
        type: "post",
        data:{id},  
        url:"../../../ajax/docente/archivo.php?action=tabla",
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



    $(document).on("submit", "#formulario-envia2", function(e){
    e.preventDefault();  
    mostrar(); 

    var parametros=new FormData($("#formulario-envia2")[0]);
    $.ajax({
      data:parametros,
        url:"../../../ajax/docente/archivo.php?action=actualizar",
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


    $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault();  
    mostrar(); 

    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({
      data:parametros,
        url:"../../../ajax/docente/archivo.php?action=registra",
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
       
         mostrarse();     
      }
    });
  });




  function eliminar(id,elimini) {  
       mostrar();  
    $.ajax({   
        type: "post",
        data:{id,elimini},  
        url:"../../../ajax/docente/archivo.php?action=eliminar",
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
  </script>
</body>



