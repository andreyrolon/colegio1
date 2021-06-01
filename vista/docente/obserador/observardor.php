<?php
session_start(); 
include('../enlaces/head.php');

include('../../../codes/docente/observador.php');
$obser=new observador();  
 
$ca=$obser->categoria();
$category=$obser->compromiso();

 
require_once "../../../codes/docente/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../login.php");
    }
include "../../../codes/docente/foro.php";
$foro=new foro();
$dat=$foro->jornada_sede($_SESSION['Id_Doc'],'conocer'); 
?>
<style>
    .tem{
        
    background-color: #a2a6a9;
    border-color: #367fa9;
    color: #fff;
    padding: 4px;
    border-radius: 6px;

    }
    #cursoL {
        margin-top: 10px;
    }

    #col {
        display: none;
    }

    .col-md-12 {
        margin-bottom: 20px;
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
<?php include('../enlaces/header.php');   ?>
    <div class="wrapper"> 
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-3"> 

                        <div id="sapo"></div>
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <form action="" method="post">
                                    
                                    <label for="curso">Sedes y jornadas:</label>
                                        <select class="form-control" id="jornada_sede1"> 
                                        <?php
                                        $js1='';
                                        foreach($dat[0] as $key){
                                        ?>
                                            <option value="<?php echo($key['ID_JS'].",".$key['sede'].",".$key['jornada']) ?>">
                                                <?php echo($key['sede']." ".$key['jornada']) ?>
                                            </option>
                                            <?php
                                            $js  = ($js1.''.$key['ID_JS']);
                                            $js1=$key['ID_JS'];
                                        } 
                                        foreach($dat[2] as $keyq){  ?>
                                            <option value="<?php echo($keyq['ID_JS']) ?>">
                                                <?php echo($keyq['sede']." ".$keyq['jornada']) ?>
                                            </option> <?php 
                                        }
                                        
                                        
                                        ?>

                                    </select>    
                                    <label for="curso" id="fri"  >Cursos:</label>          
                                    <select class="form-control" id="curso1" >
                                    </select>  

                                    <label for="curso" id="fri2" >Asignaturas:</label>          
                                    <select class="form-control" id="asignaturas1"   onchange="
                                    cambio_area()"  >
                                    </select><br>
                                    <button type="button" id="Buscar" class="btn btn-block btn-info enter"  onclick="buscar()">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9" id="col">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div  class="row" id="tabla"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
     
    <div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(3, 64, 95, 0.3);">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                 
                <div class="modal-header btn-info">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                     Actualizar Observacion <span  id="label"></span>
                </div>
                <div class="modal-body">
                    <div class="" > 
                        <input type="hidden" id="id_hidden1">
                        <input type="hidden" id="id_hidden2">
                        <input type="hidden" id="id_hidden3">
                        <strong>Tipo de Proceso:</strong>
                        <select id="actualizar_tipo" class="form-control" onchange="
                        let actualizar_tipo= document.getElementById('actualizar_tipo').value;
                        actulizar_select(actualizar_tipo)">
                            <?php 
                            foreach($ca as $vare){ 
                                ?>
                                <option value="<?php echo($vare['id']); ?>">
                                    <?php echo($vare['nombre']); ?>
                                </option>
                                <?php
                            }  ?>
                        </select><br> 
                        <strong>Categoria:</strong>
                        <select id="actualizar_categoria" class="form-control"></select><br> 
                        <strong>Descripcion:</strong>
                        <textarea id="actualizar_decripcion" class="form-control"></textarea> <br>
                        <div  id="div_actualizar_administrador" style="display: none;">
                            <strong>Remitido a:</strong>
                            <select id="actualizar_administrador" class=" form-control   ">
                                <option value="0">Seleccione un directivo</option> 
                                <?php 
                                $i=0;
                                $nom_ad=explode(',',$_SESSION['nom_ad']);
                                $foto_se=explode(',',$_SESSION['foto_se']);

                                $id_administrador1=trim($_SESSION['id_administrador'],',');
                                $id_administrador=explode(',',$id_administrador1 );
                                $option='';
                                foreach ($id_administrador as $key ) { 
                                    
                                    echo '<option  data-img-src="'.($foto_se[$i]).'" aria-disabled="true" value="'. $key .'" >'. $nom_ad[$i].'</option>';
                                    $i++;
                                }
                                 ?>
                            </select>
                        </div> <br>
                        <strong>compromiso del estudiante o del acudiente:</strong>
                        <select id="compromiso" class="form-control select2" >
                            <option value="0">El acudiente y el estudiante no se han comprometido a la  observación</option>
                            <?php 
                            foreach($category as $var){ 
                                ?>
                                <option value="<?php echo($var['id']); ?>">
                                    <?php echo($var['texto']); ?>
                                </option>
                                <?php
                            }  ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn   btn-info" d  onclick=" executeExample2();">Actualizar</button>
                    <button type="button" class="btn   btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!---Modal Universal-->
    <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(3, 64, 95, 0.3);">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 130%;">
                 
                <div class="modal-header btn-primary">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                     Observacion <span  id="label"></span>
                </div>
                <div class="modal-body">
                    <div class="row" id="ver">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
                                    </select>
                                </div>
                                <div class="col-md-6" style="display: none;" id="Tipo">
                                    <label for="tipo">Tipo</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="display: none;" id="ADMIN">
                                <div class="col-md-12">
                                    <label for="tipo">Remitido a</label>
                                    <div id="admin2"></div>   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha observacion">
                                </div>
                                <div class="col-md-6"   id="Asignatura">
                                    <label for="asignatura">Asignatura</label>
                                    <input disabled class="form-control" id="asignatura" name="asignatura">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
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
                    <input type="hidden" id="valor" value="0" name="">
                    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-block btn-primary" name="Save" id="Save">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <!---fin modal --->
    <!---Modal Vizualizar observador del alumno--->

   
             
    <!---Fin Modal--->
       <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

<script src="../../../js/jquery.loadingModal.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>


<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>
<!-- iCheck --> 
    

  
    <script>


        //el modal de carga
        function mostrar(){
          $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }
        //seleccionar el primer curso a cargo del docente cuando cargue la pagina

        function ver_select(){ 
            mostrar();
            var jornada_sede2 = $('#jornada_sede1').val(); 
            let porcion1= jornada_sede2.split(",");
            let id_js=porcion1[0];
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
                    data: {
                    id_js,id
                },
                dataType: "text",
                success: function(data) {              
                    $('#curso1').html(data);  
                    let id_grado_sede = $('#curso1').val();
                    var id=<?php echo $_SESSION['Id_Doc'] ?>;
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                        data: {
                            id_grado_sede,id
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
                }
            });
        }
        ver_select();



        //actualiza el tipo de proceso
        function actulizar_select(actualizar_tipo)  {
            mostrar();
             
            let id_admin=document.getElementById('id_hidden3').value;
            let categoria = $('#actualizar_tipo').val();
         
            if (categoria >2) {
                
                document.getElementById('actualizar_administrador').value=id_admin;
                document.getElementById('div_actualizar_administrador').style.display = 'block';
            }else{

                document.getElementById('actualizar_administrador').value=0;
                document.getElementById('div_actualizar_administrador').style.display = 'none';
            }
               
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

                        $('#actualizar_categoria').html(data);
                    

                }
            });
        }
        //enviar los datos  al modal para que se pueda actualizar
        function actual(compromiso,id_alumno,id_admin,categoria,tipo,id,descripcion){ 
            mostrar();

            document.getElementById('id_hidden1').value=id;
            document.getElementById('id_hidden2').value=id_alumno;
            document.getElementById('id_hidden3').value=id_admin;
            if (id_admin>0) {
                document.getElementById('div_actualizar_administrador').style.display = 'block';
                document.getElementById('actualizar_administrador').value=id_admin;

            }else{

                document.getElementById('actualizar_administrador').value=0;
                document.getElementById('div_actualizar_administrador').style.display = 'none';
            }
            document.getElementById('actualizar_decripcion').value=descripcion;  
            document.getElementById('actualizar_tipo').value=categoria;
            document.getElementById('compromiso').value=compromiso;
            
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

                        
                        $('#actualizar_categoria').html(data);
                        $('#actualizar_categoria').val(tipo);

                    }
                });
            
        }
        //busca la tabla del curso por medio del button
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
                    url: "../../../ajax/docente/observador.php?action=tabla",
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
        //funcion atuaclizar
        function  executeExample2(){

            let jornada_sede2 = $("#jornada_sede1").val();
            let porcion1= jornada_sede2.split(","); 
            let sede=porcion1[1];
            let jornada=porcion1[2]; 

            let curso1 = $("#curso1").val(); 
            let porcion_curso= curso1.split(",");
            let curso=porcion_curso[1]; 

            let nombre = $("#nombre_vista").val(); 
            let apellido = $("#apellido_vista").val(); 
            let foto = $("#foto_vista").val();

            Swal.fire({
                title: 'Quieres guardar los camnbios?',
                showDenyButton: true, 
                confirmButtonText: `Guargar `,
                denyButtonText: `No Guardes`,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                mostrar();

                let id_observacion=document.getElementById('id_hidden1').value;
                let id_alumno=document.getElementById('id_hidden2').value;
                let id_admin=document.getElementById('actualizar_administrador').value;
                let categoria=document.getElementById('actualizar_tipo').value;
                let tipo=document.getElementById('actualizar_categoria').value;
                let compromiso=document.getElementById('compromiso').value;
                let descripcion=document.getElementById('actualizar_decripcion').value;
                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/observador.php?action=actualizar",
                    data: {
                        id_observacion,id_admin,categoria,tipo,compromiso,descripcion
                    },
                    dataType: "text",
                    success: function(data) {
                        
                        $('body').loadingModal({text: 'Showing loader animations...'});
                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                         
                        if (data==1) { 
                            observador(curso,jornada,sede,nombre,apellido,foto,id_alumno);   
                            Swal.fire('Guardado!', '', 'success')
               
                                                 
                        }else{


                            Swal.fire(data, '', 'info');
                            
                        }
                        
                    }
                
                });
              } else if (result.isDenied) {
                Swal.fire('Los cambios no se guardaran', '', 'info');
              }
            })
        }
        //la funcion confirmacion de eliminar
        function executeExample(id,id_i){
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
                    let jornada_sede2 = $("#jornada_sede1").val();
                    let porcion1= jornada_sede2.split(","); 
                    let sede=porcion1[1];
                    let jornada=porcion1[2]; 

                    let curso1 = $("#curso1").val(); 
                    let porcion_curso= curso1.split(",");
                    let curso=porcion_curso[1]; 
                    
                    let nombre = $("#nombre_vista").val(); 
                    let apellido = $("#apellido_vista").val(); 
                    let foto = $("#foto_vista").val();
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/docente/observador.php?action=eliminar",
                        data: {
                            id
                        },
                        dataType: "text",
                        success: function(data) {
                            
                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 
                              
                            if(data==1){

                                $("html,body").animate({ scrollTop:0 });
                                observador(curso,jornada,sede,nombre,apellido,foto,id_i);
                                swalWithBootstrapButtons.fire(
                                  'Eliminado!',
                                  'Su archivo ha sido eliminado.',
                                  'success'
                                ); 
                            }else{
                                swalWithBootstrapButtons.fire(
                                  'Cancelado',
                                  ' La remisión se encuentra respondida por tal motivo el archivo no se puede eliminar :)',
                                  'error'
                                );
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
        // onchange en el area para hacer el cambio visual en el modal de registrar en el campo del area
        function cambio_area(){

            let asignaturas1 = $("#asignaturas1").val();
            let porcion= asignaturas1.split(",");
            let asignatura=porcion[0];
            $("#asignatura").val(asignatura);

        }
        //registrar nuevo observacion
        $("#Save").click(function(event){
            mostrar(); 
            let nombre = $("#nombre_vista").val(); 
            let apellido = $("#apellido_vista").val(); 
            let foto = $("#foto_vista").val();
            let valor = $("#valor").val();


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
               $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/observador_categoria.php?action=form2",
                    data: {
                        categoria,
                        id_c,
                        id_g,
                        tipo,
                        id_alumno,
                        id_informe_academico,
                        jornada_sede1,
                        asignatura,
                        descripcion,
                        fecha,
                        admin,
                        valor
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
                            Swal.fire({ 
                                icon: 'error',
                                title: 'solo puedes ingresar letras, tildes, puntos(.), comas(,),dos puntos(:) y numeros.  <br>no se permite mas caracteres, recuerde que todos los campos son requeridos',
                                showConfirmButton: true, 
                            }); 
                            $("#descripcion").val('');
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
                            Swal.fire({ 
                                  icon: 'success',
                                  title: 'Registro Exitoso ',
                                  showConfirmButton: false,
                                  timer: 2000
                            });
                            $("#descripcion").val(''); 
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


            $("#jornada_sede1").change(function() {
            mostrar(); 
            var jornada_sede2 = $('#jornada_sede1').val(); 
            let porcion1= jornada_sede2.split(",");
            let id_js=porcion1[0];
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
                    data: {
                    id_js,id
                },
                dataType: "text",
                success: function(data) {   
                                   
                     $('#curso1').html(data);  
                    let id_grado_sede = $('#curso1').val();
                    var id=<?php echo $_SESSION['Id_Doc'] ?>;
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                        data: {
                            id_grado_sede,id
                        },
                        dataType: "text",
                        success: function(data) { 
                            $('body').loadingModal({text: 'Showing loader animations...'});
                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 

                            $('#asignaturas1').css('display', 'block');
                            $('#asignaturas1').html(data);  
                             
                        }
                    });
                }
            });

        });

        
        $("#curso1").change(function() {
            mostrar();
            let id_grado_sede = $('#curso1').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                data: {
                    id_grado_sede,id
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    $('#asignaturas1').css('display', 'block');
                    $('#asignaturas1').css('display', 'block');
                    $('#asignaturas1').html(data);       
                }
            });
        });


        

        
        //buscar  tipo y la categori
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
                        $("#valor").val(1);
                        
                    }
                });
            }
        }
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
        /*-------LLAMAR MODAL------------*/
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

 





