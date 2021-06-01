 
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
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -30px;
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
      <div class=" row">
        
        <!-- /.col -->
        <div class="col-md-12">
 
  
         <br> 
          <div class="col-md-3"> 
             
            <div class="box box-danger" style="background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
             
              <div class= "   "   style="margin: 7px; padding: 2px">
                <div id="_MSG5_" style="margin-bottom: 5px"></div>
                <strong>Buscador Docente:</strong>  
                <br> 
                <div id="primero" style=""></div><br> 
                <strong>Buscador Sede:</strong>  
                <br> 
                <select name=""  style="<?php echo $style ?>" class="form-control" id="js"> 
                </select><br> 
                <strong>Buscador Curso:</strong>  
                <br> 
                <select name="curso1" style="<?php echo $style ?>"  class="form-control" id="curso1"> 
                </select><br> 
                <strong>Buscador Areas o Asignaturas:</strong>  
                <br> 
                <select name="Asignaturas"  style="<?php echo $style ?>" class="form-control" id="Asignaturas"> 
                </select><br>
                <button type="button" style="<?php echo $style ?>"  class="btn btn-block btn-danger" style="margin-bottom: 7px; <?php echo $style ?>" onclick='  buscar()'>Buscar</button>
                 </div>
            </div>
          </div> 
          <div class="col-md-8 "  id="r">

           <div id="sapo">  </div>
            <div class="modal fade in" id="mymodal" style="background-color: rgba(3, 64, 95, 0.3); ">
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 id="titulo" class="modal-title" style="<?php echo $sty ?>">  REGISTRAR PLAN DE AULA</h4>
                                </div> <div id="_MSG_" style=" margin: 10px"></div>
                                    <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                                <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
                                  <div class="modal-body table-responsive" id="pdf">
                                    <input type="hidden" value="" name="id_are_grado" id="id_are_grado">
                                    <strong>Descripción:</strong><br>
                                      <textarea id="descripcion" name="descripcion" class="form-control" required=""></textarea><br>   
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
                                    <h4 id="titulo4" class="modal-title" style="<?php echo $sty ?>">  Actualizar plan de aula </h4>
                                </div> <div id="_MSG2_" style=" margin: 10px"></div>
                                    <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                                <form name="formulario-envia2" id="formulario-envia2" enctype="multipart/form-data" method="post">
                                  <div class="modal-body table-responsive" id="pdf">
                                    
                                    <strong>Actualizar Descripción:</strong><br>
                                      <textarea id="descripcion3" name="descripcion3" class="form-control" required=""></textarea><br>  
                                      <input type="hidden" value="1" name='rol3'> 
                                      <input type="hidden" id="id_plan_aula" name='id_plan_aula'>
                                      <input type="hidden" id="rutas" name="rutas">
                                      <strong>Actualizar Archivo:</strong><br>
                                      <div class="btn btn-default btn-file" style="width:  70%">
                                        
                                          <i class="fa fa-file-pdf-o"></i>Formato  PDF
                                          <input type="file" name="Foto3" id="Foto3" accept="application/pdf,application">
                                          <input type="hidden" name="url" id="url">

                                      </div> <br><br>
                                      
                                   
                                  </div>
                                  <div class="modal-footer">    
                                    <button type=""   class="btn btn-block btn-primary" name="eliminary2" id="eliminary2" onclick="sasa() " value="520">Actualizar</button> 
                                    <button type="button" class="btn  btn-block btn-danger" data-dismiss="modal">Cancelar</button>
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




            <div  class="box box-primary" id="vv" style="display: none; background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><strong>
               <div id="titulo2" style="padding: 7px;color: #fff; background-color: #3c8dbc">PLAN DE AULA</div><br>
                 </strong> 
                 <button type="button" data-toggle="modal" data-target="#mymodal" style="margin-left: 10px ;<?php echo $style ?>"    class="btn   btn-info" style="<?php echo $_POST['sty'] ?>">Nuevo</button>
                  <div id="ver" style="margin: 10px">
                      
                    </div><div style="padding: 0.11px;margin-left: 10px;margin-right: 10px ">
                                   <div id="_MSG3_" ></div>
                </div>
              
               
            </div>
          </div>
 

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


     <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 
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
        url:"../../../ajax/seles/seles.php?action=sele_docente2",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#primero').html(data); 
        }  
      });
                        
  }
  mostrarse();


  function myFunction(){
    var id__docente=$('#docente').val();
  mostrar();
  
    $.ajax({   
      type: "post",
      data:{id__docente},  
      url:"../../../ajax/seles/seles.php?action=buscar_jor_sede",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#js').html(data); 

        var id_js = $('#js').val();
        var id=$('#docente').val();
        $.ajax({
            type: "post",
            url: "../../../ajax/seles/seles.php?action=sacar_curso_docente2",
            data: {
                id_js,id
            },
            dataType: "text",
            success: function(data) { 
              $('body').loadingModal({text: 'Showing loader animations...'});

              var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
              var time = 100;

              delay(time)
              .then(function() { $('body').loadingModal('hide'); return delay(time); } )
              .then(function() { $('body').loadingModal('destroy') ;} );  
                $('#curso1').html(data);
                let id_grado_sede = $('#curso1').val();
                var id__docente=$('#docente').val();
                $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente2",
                    data: {
                        id_grado_sede,id
                    },
                    dataType: "text",
                    success: function(data) {  
                      $('body').loadingModal({text: 'Showing loader animations...'});

                      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                      var time = 100;

                      delay(time)
                      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                      .then(function() { $('body').loadingModal('destroy') ;} ); 
                        $('#Asignaturas').html(data);
                        var Asignaturas=$('#Asignaturas').val(); 
                        var porciones = Asignaturas.split(',');
                        if(porciones[4]==1){ 
                            document.getElementById("taa").click();
                        }
                    }
                });
            }
        });
      }  
    });
                        
  }
  $("#js").change(function() {
        var id_js = $('#js').val();
        var id=$('#docente').val();
        $.ajax({
            type: "post",
            url: "../../../ajax/seles/seles.php?action=sacar_curso_docente2",
            data: {
                id_js,id
            },
            dataType: "text",
            success: function(data) {  
                $('#curso1').html(data);
                let id_grado_sede = $('#curso1').val();
                var id=$('#docente').val();
                $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente2",
                    data: {
                        id_grado_sede,id
                    },
                    dataType: "text",
                    success: function(data) {  
                        $('#Asignaturas').html(data);
                        var Asignaturas=$('#Asignaturas').val(); 
                        var porciones = Asignaturas.split(',');
                        if(porciones[4]==1){ 
                            document.getElementById("taa").click();
                        }
                    }
                });
            }
        });

    });
  $("#curso1").change(function() {
         
                let id_grado_sede = $('#curso1').val();
                var id=$('#docente').val();
                $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente2",
                    data: {
                        id_grado_sede,id
                    },
                    dataType: "text",
                    success: function(data) {  
                        $('#Asignaturas').html(data);
                        var Asignaturas=$('#Asignaturas').val(); 
                        var porciones = Asignaturas.split(',');
                        if(porciones[4]==1){ 
                            document.getElementById("taa").click();
                        }
                    }
                });
    });










////


















 function  buscar(){  

  
  var docente=document.getElementById('docente').value;
  var id_js=document.getElementById('js').value;
  var curso1=document.getElementById('curso1').value;
  var Asignaturas=document.getElementById('Asignaturas').value;
  if (docente=='') {
    mensaje5(2,'Seleccione un docente.');
  }
  if (id_js=='') {
    mensaje5(2,'Seleccione un sede.');
  }
  if (curso1=='') {
    mensaje5(2,'Seleccione un curso.');
  }
  if (Asignaturas=='') {
    mensaje5(2,'Seleccione una area, asignatura o competencia tecnologica.');
  }else{ 
    mostrar();
    document.getElementById('vv').style.display='block';
    $.ajax({   
        type: "post",
        data:{Asignaturas,id_js,curso1,docente},  
        url:"../../../ajax/rector/plan_area/plan_area.php?action=ver_aula",
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
                        
  }

 function eliminar(id,elimini){
       mostrar(); 
    $.ajax({   
        type: "post",
        data:{id,elimini},  
        url:"../../../ajax/rector/plan_area/plan_area.php?action=eliminar_plan_aula ",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          buscar() 
        }  
      });
  }
  $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault();  
    mostrar(); 

    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({
      data:parametros,
        url:"../../../ajax/rector/plan_area/plan_area.php?action=registrar_plan_aula",
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

        document.getElementById("formulario-envia").reset();
        if(rety==1){
          mensaje(2,'Debe ingresar el archivo pdf');
        }else{
          $("#mymodal").modal("hide");
          buscar();

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
        url:"../../../ajax/rector/plan_area/plan_area.php?action=actualizar_plan_aula",
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
        buscar();  

      }
    });
  });
  </script>
</body>



