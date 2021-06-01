


 <?php 
 

session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.php"); echo($_SESSION['Session1']);
}
include '../../../codes/docente/observador.php';
$observador=new observador();
$categoria=$observador->categoria();

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
      <section id="content" class="content">
        <div class="modal fade" id="actualizar" role="dialog" style="background-color: rgba(3, 64, 95, 0.3)" >
          <div class="modal-dialog">
            <div class="modal-content" id="cotent">
              <div class="modal-header" id="header" style="">
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                 <strong>Actualizar categoria </strong>
              </div>

              <div class="modal-body" id="body" >
                Categoria <br>
                <select class="form-control" id="categoriaa">
                  <?php 
                  foreach ($categoria as  $value) { ?>
                    <option value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option>
                    <?php 
                  }
                  ?>
                </select><br>
                Nombre<br>
                <input type="hidden" id="id" name="">
                <input type="hidden" id="dato" name="">
                <input type="hidden" id="id_categoria" name="">
                <input type=" " class="form-control" id="tipo"  name="tipo" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
                 
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" onclick="
                let categoriaa=$('#categoriaa').val();
                let id=$('#id').val();
                let nombre=$('#tipo').val();
                let dato=$('#dato').val(); 
                let id_categoria=$('#id_categoria').val(); 
                actualizar(nombre,id,dato,categoriaa,id_categoria)">Actualizar</button>
                <button class="btn btn-default" data-dismiss="modal"  >Cancelar</button>
              </div>
            </div>
          </div>
        </div>
 
        <div class="row">
          <div class="col-md-3"> <br> 
              
            <div class="box box-info"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <form   method="post">
                <div class="box-header with-border"  >
                  <strong>Crear Tipo:</strong>
                </div>
                <div class="box-body">
                  <!-- the events --> 
                  Categoria de observaciones<br>
                  <select class="form-control" id="categoriar">
                    <?php 
                    foreach ($categoria as  $value) { ?>
                      <option value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option>
                      <?php 
                    }

                    ?>
                  </select><br>
                  Tipo de observación <br> 
                  <input type="text" class="form-control" id="nombre" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
                

                  <button type="button" class="btn btn-block btn-info" onclick="let nombre=$('#nombre').val();let id_categoriar=$('#categoriar').val();registrar(nombre,id_categoriar)">Registrar</button>
                </div>
              </form>
            </div>  
          </div> 
          <div class="col-md-8">
            <br> 
            <div class="box box-primary"  id="v" style=" padding:4px;  background-color: #ffff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
              <div id="_MSG2_"></div>
              <div id="tabla"> </div> 
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
    function mostrar_tabla(){ 
    
      mostrar();
      $.ajax({  

        type: "post", 
        url:"../../../ajax/rector/observador/observador.php?action=mostrar_tipo",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );
            $('#tabla').html(data);
        } 
      });
    }
    mostrar_tabla();

    function registrar(nombre,id_categoriar){  
      mostrar();
      $.ajax({  

        type: "post", 
        data:{nombre,id_categoriar},
        url:"../../../ajax/rector/observador/observador.php?action=registrar_tipo",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
          if (data==0) {
            mostrar();
              Swal.fire({ 
                icon: 'info',
                title: 'Seleccione el nombre del tipo de observación', 
              });
          }
          if (data==1) {
            mostrar_tabla();
              Swal.fire({ 
                icon: 'success',
                title: 'Registro exitoso', 
              });
              $("#nombre").val("");
          }
          if (data==3) {
              Swal.fire({ 
                icon: 'error',
                title: 'El registro se encuentra repetido', 
              });

              $("#nombre").val("");
          }
          if (data==2) {
              Swal.fire({ 
                icon: 'error',
                title: 'El campo solo permite letras', 
              });
              $("#nombre").val("");
          }
        } 
      });
    }
    function actualizar(nombre,id,dato,categoriaa,id_categoria){  
      mostrar();
      $.ajax({  

        type: "post", 
        data:{nombre,id,dato,categoriaa,id_categoria},
        url:"../../../ajax/rector/observador/observador.php?action=actualizar_tipo",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
        
          if (data==0) {
            mostrar();
              Swal.fire({ 
                icon: 'info',
                title: 'El campo nombre esta vacio', 
              });
          }
          if (data==4) {
            mostrar_tabla();
              Swal.fire({ 
                icon: 'success',
                title: 'Error en el actualizar ', 
              });
              $("#nombre").val("");
          }
          if (data==1) {
            mostrar_tabla();
              Swal.fire({ 
                icon: 'success',
                title: 'Registro Actualizado', 
              });
              $("#nombre").val("");
          }
          if (data==3) {
              Swal.fire({ 
                icon: 'info',
                title: 'Debes hacer un cambio en el formulario', 
              });

              $("#nombre").val("");
          }
          if (data==2) {
              Swal.fire({ 
                icon: 'error',
                title: 'El campo solo permite letras', 
              });
              $("#nombre").val("");
          }
          if (data==7) {
              Swal.fire({ 
                icon: 'info',
                title: 'No se puede actualizar ya que  se encuentra   registrado  en una observación de un estudiante', 
              });
              $("#nombre").val("");
          }
        } 
      });
    }
    //eliminar
    function executeExample(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminalo!',
                cancelButtonText: 'No, cancelalo!',
                reverseButtons: true
            }).then((result) => {
                //si se confirma se elimina por medio de ajax
                if (result.isConfirmed) {
                  mostrar();
                  $.ajax({  

                    type: "post", 
                    data:{id},
                    url:"../../../ajax/rector/observador/observador.php?action=eliminar_tipo",
                    dataType:"text", 

                    success:function(data){  
                      $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 100;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                      
                      if (data==1) {
                        mostrar_tabla();
                          Swal.fire({ 
                            icon: 'success',
                            title: 'Registro Eliminado', 
                          });
                      } 
                      if (data==2) {
                          Swal.fire({ 
                            icon: 'error',
                            title: 'ERROR en el registro', 
                          });
                          $("#nombre").val("");
                      }
                    
                      if (data==3) {
                          Swal.fire({ 
                            icon: 'info',
                            title: 'No se puede eliminar ya que  se encuentra   registrado  en una observación de un estudiante', 
                          });
                          $("#nombre").val("");
                      }
                    } 
                  });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Los archivos no se han eliminado :)',
                      'error'
                    )
                }
            })
        } 
    
  </script>




</body>

</html>
 