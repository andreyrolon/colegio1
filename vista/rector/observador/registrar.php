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
        
        <div class="modal fade" id="myModalUniversal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(3, 64, 95, 0.3);">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                   
                  <div class="modal-header btn-primary">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                       <nav>Observacion</nav>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <form action="" method="post" id="FormObs">
                              <input type="hidden" id="id_tabla" value="0">
                              <input type="hidden" id="nombre_vista" value="0">
                              <input type="hidden" id="apellido_vista" value="0">
                              <input type="hidden" id="foto_vista" value="0">
                              <div class="col-md-12">
                                <div class="col-md-12">
                                  <strong>Docente</strong>
                                  <select id="docente" name="docente" class=" form-control my-select" onchange="myFunction()" required=""> 
                                    <option value="">Seleccione un docente</option>
                                    <?php foreach ($doc as $value) {   
                                      $foto=$value['foto'];
                                      if ($value['foto']=='' && $value['genero']==1) {
                                        $foto='../../../logos/femenino.png';
                                      }if ($value['foto']=='' && $value['genero']==0){
                                        $foto='../../../logos/masculino.png';
                                      } ?>  
                                      <option data-img-src="<?php echo $foto ?>" value="<?php echo $value['id_docente'] ?>"> <?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
                                    <?php } ?>
                                  </select><br><br>
                                </div>
                                <div class="col-md-6">
                                  <label for="categoria">Categoria</label>
                                  <select class="form-control" name="categoria" onchange="categoria_();" id="categoria">
                                    <option value="0">Selecione</option>
                                    <?php
                                    $num='';
                                    $nom='';
                                    foreach($ca as $var){ 
                                      ?>
                                      <option value="<?php echo($var['id']); ?>">
                                        <?php echo($var['nombre']); ?>
                                      </option>
                                      <?php
                                    } 
                                    ?>
                                  </select><br>
                                </div>
                                <div class="col-md-6" style="display: none;" id="Tipo">
                                  <label for="tipo">Tipo</label>
                                  <select class="form-control" name="tipo" id="tipo">
                                  </select><br>
                                </div>
                              </div>
                              <div class="col-md-12" style="display: none;" id="ADMIN">
                                <div class="col-md-12">
                                  <label for="tipo">Remitido a</label>
                                  <div id="admin2"></div> <br>  
                                </div>
                              </div>
                              <div class="col-md-12" >
                                <div class="col-md-12">
                                  <label for="asignatura">Asignatura</label> 
                                  <select class="form-control" id="asignaturas1"    >
                                  </select> <br>
                                </div>
                              </div>
                              <div class="col-md-12"> 
                                  <div class="col-md-6">
                                      <label for="fecha">Fecha</label>
                                      <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha observacion">
                                  </div>
                                  <div class="col-md-6"   id=" ">
                                    <label for="fecha">Periodo</label> 
                                    <select name="" id="periodo" class="form-control">
                                      <?php 
                                      foreach ($periodo as  $value) {
                                        ?>
                                        <option value="<?php echo  $value['numero'] ?>"><?php echo  $value['numero'] ?></option>
                                        <?php 
                                       } ?>
                                    </select>
                                  </div>
                              </div>
                               

                 
                              <div class="col-md-12">
                                  <div class="col-md-12"><br>
                                      <label for="descripcion">Descripcion</label>
                                      <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" rows="7"></textarea>
                                  </div>
                              </div>
                              <input type="hidden" value="" id="id_alumno">
                              <input type="hidden" value="" id="id_informe_academico">
                          </form>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" value="0" id="valor" name="">
                      <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-block btn-primary" name="Save" id="Save">Registrar</button>
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
                  <select class="form-control" id="jornada_sede1" autofocus>
                    <option value="">Seleccione una sede</option>
                    <?php 
                    foreach ($jornada_sede as $key  ) { ?>

                      <option value="<?php echo($key['ID_JS'].",".$key['sede'].",".$key['jornada']) ?>">
                        <?php echo($key['sede']." ".$key['jornada']) ?>
                      </option> <?php
                     } ?>
                  </select> 
                   
                  Curso <br>
                  <select class="form-control" id="curso1" >
                  </select>  <br>

                  <button type="button" class="btn btn-block btn-info" onclick="let nombre=$('#nombre').val();buscar()">buscar</button>
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
      var id=<?php echo $_SESSION['Id_Doc'] ?>;
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

    //trae las asignaturas segun el curso que elija
    $("#curso1").change(function() {
      mostrar();
      let id_grado_sede = $('#curso1').val(); 
      $.ajax({
        type: "post",
        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_observador_rector",
        data: {
          id_grado_sede,
        },
        dataType: "text",
        success: function(data) {
          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );  
          $('#asignaturas1').html(data);       
        }
      });
    });

    //trae el curso
    function buscar(){ 

      let curso = $('#curso1').val();
      let porcion_c= curso.split(",");
      let nom_curso=porcion_c[1]; 
      let jornada_sede2 = $('#jornada_sede1').val();
      let porcion1= jornada_sede2.split(",");
      let sede=porcion1[1]; 
      let jornada=porcion1[2];
      let jornada_sede1=porcion1[0];

      let asignaturas1 = $('#asignaturas1').val();
      let porcion= asignaturas1.split(",");
      var materia=porcion[0];

      $('#asignatura').val(porcion[0]);
      if (curso != '') {
        mostrar();
        $.ajax({
          type: "post",
          url: "../../../ajax/rector/observador/observador.php?action=tabla",
          data: {
            asignaturas1,jornada_sede1,curso,sede,jornada ,nom_curso
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
    //trae los administrativos para poder un proceso de remision
    $.ajax({
      type: "post",
      url: "../../../ajax/docente/observador_categoria.php?action=admnistrativo",
      data: {

      },
      dataType: "text",
      success: function(data) {
        $('#admin2').html(data);
      }
    });
    //trae los docente para poder crear una observacion
   
    //trae los tipos de observacion segun la categoria que elija para registrar
    function categoria_() {
      mostrar();


      let categoria = $('#categoria').val();

      if (categoria <3) {

        $.ajax({
          type: "post",
          url: "../../../ajax/docente/observador_categoria.php?action=tipo",
          data: {
            categoria
          },
          dataType: "text",
          success: function(data) {
            $('body').loadingModal({text: 'Showing loader animations...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 0;
            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#Tipo').css('display', 'block');
            $('#tipo').html(data);
            $('#ADMIN').css('display', 'none');
            $('#valor').val(0);

          }
        });
      } 


      if (categoria >2) {
        debugger;
        $.ajax({
          type: "post",
          url: "../../../ajax/docente/observador_categoria.php?action=tipo",
          data: {
            categoria
          },
          dataType: "text",
          success: function(data) {

            $('body').loadingModal({text: 'Showing loader animations...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 0;
            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#Tipo').css('display', 'block');
            $('#tipo').html(data);

            $('#ADMIN').css('display', 'block');
            $('#valor').val(1);

          }
        });
      }
    }

    $("#Save").click(function(event){
      mostrar(); 
      let nombre = $("#nombre_vista").val(); 
      let docente = $("#docente").val(); 
      let apellido = $("#apellido_vista").val(); 
      let foto = $("#foto_vista").val();
      let id=<?php echo $_SESSION['Id_Doc']; ?>;

      let id_tabla = $("#id_tabla").val(); 
      let id_alumno = $("#id_alumno").val(); 
      let id_informe_academico = $("#id_informe_academico").val(); 
      let asignaturas1 = $("#asignaturas1").val();
      let jornada_sede2 = $("#jornada_sede1").val();
      let porcion1= jornada_sede2.split(",");
      let jornada_sede1=porcion1[0];
      let sede=porcion1[1];
      let jornada=porcion1[2];    

      let curso1 = $("#curso1").val();
      let porciones= curso1.split(" ");
      let id_c=porciones[1];
      let id_g=porciones[0]; 
      let porcion_curso= curso1.split(",");
      let curso=porcion_curso[1]; 

      let categoria=$("#categoria").val();
      let porcion= asignaturas1.split(",");
      let asignatura=porcion[0];
      let descripcion = $("#descripcion").val();
      let tipo = $("#tipo").val();
      let admin = $("#admin").val();
      let fecha = $("#fecha").val(); 
      let periodo = $("#periodo").val(); 
      let valor = $("#valor").val(); 

      $.ajax({
        type: "post",
        url: "../../../ajax/rector/observador/observador.php?action=registrar_observacion",
        data: {
          valor,
          docente,
          periodo,
          id,
          categoria, 
          id_c,
          id_g,
          tipo,
          id_alumno,id_informe_academico,
          jornada_sede1,
          asignatura,
          descripcion,
          fecha,
          admin
        },
        dataType: "text",
        success: function(data) {    
          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          

          if (data==-4) {
            Swal.fire({ 
              icon: 'error',
              title: ' Debe ingresar el campo Descripcion',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==-6) {
            Swal.fire({ 
              icon: 'error',
              title: 'Todo proceso debe ser Remitido  a un directivo',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==-1) {
            Swal.fire({ 
              icon: 'error',
              title: 'Problemas en el registro',
              showConfirmButton: true, 
            });
            return;
          }

          if (data==-5) {
            Swal.fire({ 
              icon: 'error',
              title: 'Debe ingresar el campo Categoria',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==-7) {
            Swal.fire({ 
              icon: 'error',
              title: 'El formato de la fecha es Erroneo',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==7) {
            Swal.fire({ 
              icon: 'error',
              title: 'Seleccione un periodo',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==8) {
            Swal.fire({ 
              icon: 'error',
              title: 'Seleccione un docente',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==9) {
            Swal.fire({ 
              icon: 'error',
              title: 'Error en el registro',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==-2) {
            Swal.fire({ 
              icon: 'error',
              title: 'Debe ingresar el campo Tipo',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==-3) {
            Swal.fire({ 
              icon: 'error',
              title: 'Debe ingresar el campo Fecha',
              showConfirmButton: true, 
            });
            return;
          }
          if (data==0) {
            $("#descripcion").val('');
            Swal.fire({ 
              icon: 'error',
              title: 'solo puedes ingresar letras, tildes, puntos(.), comas(,),dos puntos(:) y numeros.  <br>no se permite mas caracteres, recuerde que todos los campos son requeridos',
              showConfirmButton: true, 
            });  
            return;
          }
          if (data==1) {
            Swal.fire({ 
              icon: 'error',
              title: 'La observacion se encuentra repetida',
              showConfirmButton: true, 
            });

            return;
          }
          if (data==2) {
            $("#descripcion").val('');
            Swal.fire({ 
              icon: 'success',
              title: 'Registro Exitoso ',
              showConfirmButton: false,
              timer: 2000
            }); 
          }
          if (id_tabla==0) {
            buscar();
          }
          if (id_tabla==1) {
            observador(curso,jornada,sede,nombre,apellido,foto,id_alumno);
          }                        
        }
      });


    });
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
 