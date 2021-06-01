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
 

//trae los datos del observador (categoria y compromiso)
include('../../../codes/docente/observador.php');
$obser=new observador();  
$remision=$obser->remision();
$compromiso=$obser->compromiso();

include('../enlaces/head.php'); 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;
?>
 






<body style=" <?php echo $sty ?> " class="skin-blue sidebar-mini sidebar-collapse" >

  <div class="wrapper"  >
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  > 
      <section id="content" class="content">
        
        

        <div class="row">
           
          <div class="col-md-12"> 
            <div class="box box-primary col-md-12"  id="v" style=" padding:4px;  background-color: #ffff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
              <div id="_MSG2_"></div> 
              <span style="font-size: 18px" class="btn btn-link btn-xs"><strong>Lista de Remisiones</strong></span><br><br><br>
              <div class="" style=" ">
                
                <table id="example" class=" table table-hover table-bordered"  style="width: 100%" >

                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Sede</th>
                        <th>jornada</th>
                        <th>curso</th>
                        <th>Estudiante</th>
                        <th>Remision tipo</th> 
                        <th>Estado</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($remision as   $value) { ?>
                    <tr>
                        <td><?php echo $value["fecha"] ?></td>
                        <td><?php echo $value["sede"] ?></td>
                        <td><?php echo $value["jornada"] ?></td>
                        <td><?php echo $value["grado"]."-".$value["curso"] ?></td>
                        <td><?php echo $value["nom"]." ". $value["ape"] ?></td>
                        <td><?php echo $value["tipo"] ?></td> 
                        <td><?php echo $value["estado"] ?></td>
                        <td><button class="btn btn-info" data-toggle="modal" data-target="#modal<?php echo $value['id'] ?>" onclick='
                        document.getElementById("proceso<?php echo $value['id'] ?>").value=<?php echo $value['matricula_condicional'] ?>;
                        document.getElementById("estado<?php echo $value['id'] ?>").value="<?php echo $value['estado'] ?>";
                        document.getElementById("proceso<?php echo $value['id'] ?>").value=<?php echo $value['matricula_condicional'] ?>;
                        ' >ver</button></td>
                        
                        <div class="modal fade" id="modal<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(3, 64, 95, 0.3);">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                              <div class="modal-header btn-primary">
                                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                <nav>Remision</nav>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <form action="" method="post" id="FormObs">
                                    <div class="row">
            <div class="col-md-2">
                 <div class="box-body box-profile center-block">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $value['fo'] ?>" alt="User profile picture" style="width: 90px;"><br>
 
                    
                </div>
            </div>  
            <div class="col-md-9"> 
                <div class="col-md-6">
                    <label for="genero">Sede:</label> 
                    <input type="text" class="form-control" value="<?php echo $value['sede'] ?>" disabled=""><br>
                </div> 
                <div class="col-md-6">
                    <label for="genero">Jornada</label> 
                    <input type="text" class="form-control" value="<?php echo $value['jornada'] ?>" disabled=""><br>
                </div>  
                <div class="col-md-6">
                    <label for="genero">Nombre</label> 
                    <input type="text" class="form-control" value="<?php echo $value['nom']." ".$value['ape'] ?>" disabled=""><br>
                </div> 
                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-8">
                        <label for="genero">Curso</label> 
                        <input type="text" class="form-control" value="<?php echo $value['grado']."-".$value['curso'] ?>" disabled=""><br>
                    </div>  
                    </div> 
                </div> 

               
            </div><div class=" col-md-12">

            <div style="border: solid #d5d5d5;background: #e6e6e6;padding: 10px;margin: 10px;">
                <div class="user-block"> 
                    <img style="width: 80px;height: 90px;margin-right: 10px" class="profile-user-img img-responsive img-circle" src="<?php echo $value['foto'] ?>" alt="user image">
                        <span class="username">
                          <a>Nini Minios</a> 
                        </span>
                    <span class="description">Publicado el <?php echo $value['fecha'] ?></span>
                    <span class="description">Area: <?php echo $value['area'] ?></span><br>
                </div><br>
                <!-- /.user-block -->
                 
                    <span class="btn btn-warning btn-xs">Categoria de Observacion</span> <span class="btn btn-default btn-xs"> <?php echo $value['categoria'] ?></span><br>
                <p>
                    </p><div style="margin-top: 10px;margin-bottom: 10px">
                        <span class="btn btn-info btn-xs">tipo</span>  <span class="btn btn-default btn-xs"><?php echo $value['tipo'] ?></span>
                    <br>
                    </div>
                                            <div style="margin-top: 10px;margin-bottom: 10px">
                            <span class="btn btn-link btn-xs"><strong>Remitido a</strong></span>  
 
                        <select  class=" form-control my-select" id="../../../logos/n"  > 
                          <option selected="selected" data-img-src="<?php echo $value['FOTO'] ?>" aria-disabled="true" value=><?php echo $value['NOMBRE']."-".$value['APELLIDO'] ?></option>
                          <?php if ($value['NOMBRE']!=$_SESSION['nombre'] || $value['NOMBRE']!=$_SESSION['apellido']) {   ?>
                            <option   data-img-src="<?php echo $_SESSION['foto'] ?>" aria-disabled="true"><?php echo $_SESSION['Nom_U']."-".$_SESSION['Ape_U'] ?></option>
                          <?php } ?>
                        </select>

                        <br><br>  
                     
                    
                    
                    
                <p>
                    <span class="btn btn-primary btn-xs">Descripción</span> 
                    </p><div class="  btn-default btn-xs">
                        <?php echo $value['descripcion'] ?>                    </div>
                    <div style="margin-top: 10px;margin-bottom: 10px">
                        <span class="btn btn-link btn-xs"><strong>Compromiso</strong></span>  

                        <select class="form-control" id="compromiso<?php echo $value['id'] ?>">
                          <option value="0">no tiene compromiso</option>
                          <?php 
                          foreach ($compromiso as $key ) { ?>
                            <option value="<?php echo $key['id'] ?>"><?php echo $key['texto'] ?></option> <?php 
                          } ?>
                        </select>
                        <br> 
                        <span class="btn btn-link btn-xs"><strong>Orientación</strong></span>  

                        
                        <textarea class="form-control" id="orientacion<?php echo $value['id'] ?>"><?php echo $value['orientacion'] ?></textarea>
                        <br>
                     
 
                        <span class="btn btn-link btn-xs"><strong>Medidas de control</strong></span>  

                        <textarea class="form-control" id="accion<?php echo $value['id'] ?>"><?php echo $value['accion'] ?></textarea> 

                        <br>

                        <span class="btn btn-link btn-xs"><strong>Proceso de matricula condicional</strong></span> <br>
                        <select class="form-control" id="proceso<?php echo $value['id'] ?>" onchange="  
                        let proceso=document.getElementById('proceso<?php echo $value['id'] ?>').value;
                        if (proceso>0) {
                          document.getElementById('mostrar_texto_remision<?php echo $value['id'] ?>').style.display ='block';
                        }else{ 
                          $('#texto_remision<?php echo $value['id'] ?>').val('');
                          document.getElementById('mostrar_texto_remision<?php echo $value['id'] ?>').style.display ='none';
                        }
                         ">
                          <option value="0">Sin proceso</option>
                          <option value="1">Academica</option>
                          <option value="2">Disciplinaria</option>
                        </select><br>
                        <?php 
                        $display="none";
                        if ($value['matricula_condicional']>0) {
                          $display="block";
                        } ?>
                        <div id="mostrar_texto_remision<?php echo $value['id'] ?>" style="display:<?php echo $display ?> ">
                          <span class="btn btn-link btn-xs"><strong>Descripcion de matricula</strong></span>  

                          <textarea class="form-control" id="texto_remision<?php echo $value['id'] ?>"><?php echo $value['texto_remision'] ?></textarea> 

                          <br>
                        </div>

                        <span class="btn btn-link btn-xs"><strong>Estado</strong></span> <br>
                        <select class="form-control" id="estado<?php echo $value['id'] ?>">
                          <option value="Espera">Espera</option>
                          <option value="Atendida">Atendida</option>
                        </select>
                    </div>
                   
                                             
                                </div>
        </div>
        </div>
                                  </form>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-block btn-primary" name="Save" id="Save" onclick=' 
 
                                  let compromiso = $("#compromiso<?php echo $value['id'] ?>").val(); 
                                  let orientacion = $("#orientacion<?php echo $value['id'] ?>").val(); 
                                  let accion = $("#accion<?php echo $value['id'] ?>").val();  
                                  let proceso = $("#proceso<?php echo $value['id'] ?>").val(); 
                                  let texto_remision = $("#texto_remision<?php echo $value['id'] ?>").val();
                                  let estado = $("#estado<?php echo $value['id'] ?>").val();  
                                  let id_observador=<?php echo $value['id'] ?>;
                                  let id_remision=<?php echo $value['id_remision'] ?>;
                                  actualizar(compromiso,orientacion,accion,proceso,texto_remision,estado,id_observador,id_remision);
                                '>Actualizar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </tr> 
                  <?php } ?> 
                </tbody>
              </table>
              </div>
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


  

                        <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
<script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>'

<script src="../../../css/datatables.min.css"></script>   
<script src="../../../js/datatables.min.js"></script> 
<script src="../../../js/jquerydatatable.js"></script>
 
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 

  

<script src="../../../js/jquery.loadingModal.js"></script>



<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            "scrollX": true,
          "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
         
        } );
    } );
    function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
   

    function actualizar(compromiso,orientacion,accion,proceso,texto_remision,estado,id_observador,id_remision){

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: '¿Estás seguro?',
        text: "¡Quieres actualizar la remision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Actualiselo!',
        cancelButtonText: 'No, cancelalo!',
        reverseButtons: true
      }).then((result) => {
                //si se confirma se elimina por medio de ajax
        if (result.isConfirmed) {


          $.ajax({
            type: "post",
            url: "../../../ajax/rector/observador/remision.php?action=actualizar",
            data: {
              compromiso,orientacion,accion,proceso,texto_remision,estado,id_observador,id_remision
            },
            dataType: "text",
            success: function(data) {   
              $('body').loadingModal({text: 'Showing loader animations...'});
              var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
              var time = 0;    
              delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
              .then(function() { $('body').loadingModal('destroy') ;} );  
              if (data==3) {
                Swal.fire({ 
                  icon: 'error',
                  title: 'Error en la actualización',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==1) {
                Swal.fire({ 
                  icon: 'success',
                  title: 'Registro Actualizado',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==4) {
                Swal.fire({ 
                  icon: 'info',
                  title: 'El campo descripcion de matricula debe estar lleno',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==11) {
                Swal.fire({ 
                  icon: 'info',
                  title: 'El campo Orientación  debe estar lleno',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==12) {
                Swal.fire({ 
                  icon: 'info',
                  title: 'El campo Medidas de contorl  debe estar lleno',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==13) {
                Swal.fire({ 
                  icon: 'info',
                  title: 'El campo Estado  debe estar lleno',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==7) {
                Swal.fire({ 
                  icon: 'error',
                  title: 'No se permite el uso de  punto y coma (;) ni caracteres especiales (<>!*+?¡°$%&#"" )',
                  showConfirmButton: true, 
                });
                return;
              } 
                                      
            }
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'Los datos no se han Actualizado :)',
            'error'
            )
        }
      })
    } 
    function observador(curso,jornada,sede,nombre,apellido,foto,id_i){
        mostrar();
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/observador.php?action=modal",
            data: {
                curso,jornada,sede,nombre,apellido,foto,id_i
            },
            dataType: "text",
            success: function(data) {  
                $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                $("html,body").animate({ scrollTop:0 });
                $('#tabla').html(data);
            }
        });
    }

  </script>




</body>

</html>
