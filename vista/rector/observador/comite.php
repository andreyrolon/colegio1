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
include "../../../codes/rector/jornada.php";
$js=new jornada();
$jornada_sede=$js->mostrar_jornada_sede();
$periodo=$js->periodo();
$doc=$js->docente();

//trae los datos del observador (categoria y compromiso)
include('../../../codes/docente/observador.php');
$obser=new observador();  
$ca=$obser->categoria();
$category=$obser->compromiso();

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
            
          </div>
        </div>
      </div>
  

        <div class="row">
          <div class="col-md-3"> <br> 
                
            <div class="box box-info"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <form   method="post">
                <div class="box-header with-border"  >
                  <strong>Buscar curso:</strong>
                </div>
                <div class="box-body">
                  <!-- the events --> 
                  Sede <br> 
                  <select class="form-control select2" id="jornada_sede1" autofocus>
                    <option value="">Seleccione una sede</option>
                    <?php 
                    foreach ($jornada_sede as $key  ) { ?>

                      <option value="<?php echo($key['ID_JS'].",".$key['sede'].",".$key['jornada']) ?>">
                        <?php echo($key['sede']." ".$key['jornada']) ?>
                      </option> <?php
                     } ?>
                  </select> <br>
                   
                  Curso <br>
                  <select class="form-control" id="curso1" >
                  </select>  <br>

                  <button type="button" class="btn btn-block btn-info" onclick=" buscar()">buscar</button>
                </div>
              </form>
            </div>
            <br> 
                
            <div class="box box-primary"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <form   method="post">
                <div class="box-header with-border"  >
                  <strong>Buscar Alumno:</strong>
                </div>
                <div class="box-body">
                  <!-- the events --> 
                  <input type="" class="form-control" id="apellidos2" placeholder="Buscar apellido" name=""><br>

                  <button type="button" class="btn btn-block btn-danger" onclick=" buscar2()">buscar</button>
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
    
    function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
    //trae el curso se gun la sede
    $("#jornada_sede1").change(function() {
      mostrar(); 
      var jornada_sede2 = $('#jornada_sede1').val(); 
      let porcion1= jornada_sede2.split(",");
      let id_js=porcion1[0]; 
      $.ajax({
        type: "post",
        url: "../../../ajax/seles/seles.php?action=sacar_curso_observador_rector",
        data: {
          id_js
        },
        dataType: "text",
        success: function(data) {   

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#curso1').html(data);         
        }
      });

    });

 

    //trae el curso
    function buscar(){ 

      let curso1 = $('#curso1').val();
      let apellidos = $('#apellidos').val();
      let porcion_c= curso1.split(",");
      let porcion_= curso1.split(" ");
      let nom_curso=porcion_c[1]; 
      let grado=porcion_[0]; 
      let curso=porcion_[1]; 
      
      let jornada_sede2 = $('#jornada_sede1').val();
      let porcion1= jornada_sede2.split(",");
      let sede=porcion1[1]; 
      let jornada=porcion1[2];
      let jornada_sede1=porcion1[0];

     
 
      if (curso != '') {
        mostrar();
        $.ajax({
          type: "post",
          url: "../../../ajax/rector/observador/remision.php?action=comite",
          data: {
            jornada_sede1,curso,sede,jornada ,nom_curso,curso,grado,apellidos
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
    }

    function buscar2(){ 
 
      let apellidos = $('#apellidos2').val(); 
     
  
        mostrar();
        $.ajax({
          type: "post",
          url: "../../../ajax/rector/observador/remision.php?action=comite2",
          data: {
            apellidos
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
    //moestra el seguimiento de los estudiantes 
    function seguimiento(id,remision,id_remision){ 

     

    
      mostrar();
      $.ajax({
        type: "post",
        url: "../../../ajax/rector/observador/remision.php?action=seguimiento",
        data: {
          id,remision ,id_remision
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
    function registrar(id,id_remision,novedad,motivo,remision){
      
      mostrar();
      $.ajax({
        url: "../../../ajax/rector/observador/remision.php?action=registrar_seguimiento",
        type: 'POST',
        dataType: 'text',
        data: { id,id_remision,novedad,motivo},
        success: function(data){

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );   
       
          if (data==1) {
            Swal.fire({ 
              icon: 'success',
              title: 'Registro Exito',
              showConfirmButton: true, 
            });
            seguimiento(id,remision,id_remision)
            return;
          }
          if (data==9) {
            Swal.fire({ 
              icon: 'info',
              title: 'Todos los campos son obligatorios',
              showConfirmButton: true, 
            });
            return;
          }
        
          if (data==8) {
            Swal.fire({ 
              icon: 'error',
              title: 'No puedes modificar las variables',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==7) {
            Swal.fire({ 
              icon: 'info',
              title: 'No se permiten caracteres especiales ($#/*+-;)',
              showConfirmButton: true, 
            });
            return;
          }
        }
      });
      
    }
    function  actualizar(novedad_actualizar,motivo_actualizar,id,seguimiento,descripcion){ 
       
      mostrar();
      $.ajax({
        url: "../../../ajax/rector/observador/remision.php?action=actualizar_seguimiento",
        type: 'POST',
        dataType: 'text',
        data: { novedad_actualizar,motivo_actualizar,id,seguimiento,descripcion},
        success: function(data){

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );   
             if (data==1) {
            Swal.fire({ 
              icon: 'success',
              title: 'Registro Actualizado',
              showConfirmButton: true, 
            }); 
            return;
          }
        
          if (data==9) {
            Swal.fire({ 
              icon: 'info',
              title: 'Todos los campos son obligatorios',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==3) {
            Swal.fire({ 
              icon: 'error',
              title: 'No puedes modificar las variables',
              showConfirmButton: true, 
            }); 
            return;
          }
          if (data==8) {
            Swal.fire({ 
              icon: 'error',
              title: 'No puedes modificar las variables',
              showConfirmButton: true, 
            });
            $("#novedad_actualizar").val(seguimiento);
            return;
          }
          if (data==7) {
            Swal.fire({ 
              icon: 'info',
              title: 'No se permiten caracteres especiales ($#/*+-;)',
              showConfirmButton: true, 
            });
            $("#motivo_actualizar").val(descripcion);
            return;
          }
          if (data==4) {
            Swal.fire({ 
              icon: 'info',
              title: 'Debes hacer un cambio para poder actualizar',
              showConfirmButton: true, 
            });
            return;
          }
        }
      });
      
    }
    function  eliminar(id,remision,id_remision,id_seguimiento){ 
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: '¿Estás seguro?',
        text: "¡Quieres Eliminar el seguimiento de comite!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminalo!',
        cancelButtonText: 'No, cancelalo!',
        reverseButtons: true
      }).then((result) => {
                //si se confirma se elimina por medio de ajax
      if (result.isConfirmed) {
        mostrar();
        $.ajax({
          url: "../../../ajax/rector/observador/remision.php?action=eliminar_seguimiento",
          type: 'POST',
          dataType: 'text',
          data: { id_seguimiento},
          success: function(data){

            $('body').loadingModal({text: 'Showing loader animations...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 0;
            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );   
         
            if (data==1) {
              Swal.fire({ 
                icon: 'success',
                title: 'Registro Eliminado',
                showConfirmButton: true, 
              });
              seguimiento(id,remision,id_remision)
              return;
            }
          
            if (data==0) {
              Swal.fire({ 
                icon: 'error',
                title: 'Problemas con la base de datos',
                showConfirmButton: true, 
              });
              return;
            } 
          }
        });
      }
      else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'Los datos no se han Eliminado :)',
            'error'
            )
        }
      })
    } 
      
    
    
  </script>




</body>

</html>
 