
<?php
session_start();
    if(!isset($_SESSION['Session'])){
        header("location: ../../../login.php"); echo($_SESSION['Session']);
    } 
include('../../../codes/docente/asistencia.php');
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$obser=new select();
//$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
//include '../../../codes/rector/docente.php';
//$periodo=new docente();
//$sql1=$periodo->ver_periodos();

$gra=$obser->buscar_grado($_SESSION['Id_Doc']);
include('../enlaces/head.php'); ?>
  
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
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 8px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   
  
  
      
         
               .myButton{
                margin:10px;font-size: 18px;
               }
               .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec
        }
          
        .img-circle{
            width: 62px;
        }
        .img-circle:hover{
            width: 73px;  
        }
        td{
            padding: 0px;
        }

           </style>
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
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper">  
            <div class="row">
                <div class="col-md-12">




 

                    <div class="modal fade in" id="radicacion" style="background-color: rgba(3, 64, 95, 0.3);  padding-right: 17px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="radis"></div>
                                </div>
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminary2" id="eliminary2" onclick="
                                  var id_guia=document.getElementById('eliminary2').value;
                                  
                                    eliminar(id_guia) " value="1">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>





























                    <div class="modal fade bd-example-modal-lg" id="my" aria-labelledby="myLargeModalLabel"  style="background-color: rgba(3, 64, 95, 0.3)"  >
                        <div class="modal-dialog modal-lg">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><strong>Historial de inasistencia </strong> 
                                        </h4>
                                </div> <br> 
                                    <div  style="  margin-left: 10px;margin-right: 10px" id=" ">
                                        <div style="float: left; margin-right: 14px" > <strong> Total de registros </strong><strong id="qwq"></strong></div>
                                        <div  id="busca1" style="float: right;"><strong> Buscar:</strong>
                                        <input type="" class="form-control" placeholder="nombre Materias" id="busca"  name="busca" style="height: 26px; width: 200px;display: unset;margin-left: 8px;" onchange=" 
                                        var id_informe_academico=document.getElementById('id_informe_academicov').value;
                                        var id_area=document.getElementById('id_areav').value;
                                        var titular=document.getElementById('titularv').value;
                                        var busca1=document.getElementById('busca').value;
                                        var tec=document.getElementById('tecxx').value;
                                        
                                        mostrar2(tec,id_informe_academico,id_area,titular,busca1); "></div>
                                        
                                    </div><div style="width: 100%;color:#fff;margin-bottom: 6px">s</div> 
                                    <div class="modal-body table-responsive" id="mostrar1">

                                    </div>  
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade bd-example-modal-lg" id="my1" aria-labelledby="myLargeModalLabel"  style="background-color: rgba(3, 64, 95, 0.3)"  >
                        <div class="modal-dialog modal-lg">  
                            <div class="modal-content">
                                <form method="post" id="regis">
                                    <div class="modal-header btn-primary table-responsive">
                                        <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title"><strong>Agregar Inasistencia </strong> 
                                            </h4>
                                    </div> 
                                    <div class="modal-body table-responsive"   > 
                                        <div id='_MSG7_'></div> 
                                        <input type="hidden" id="idtecni" name="idtecni"> 
                                        <input type="hidden" id="nombre_materia" name="nombre_materia"> 
                                        <input type="hidden" id="id_al" name="id_al"> 
                                        <input type="hidden" id="id_aa" name="id_aa">
                                        <input type="hidden" id="indice" name="indice">
                                        <div>
                                            <label for="genero">Fecha</label>
                                            <input type="date" class="form-control" name="fech" id="fech" required ><br>
                                        </div> 

                                        <div id="ho1">
                                            <label for="genero">Hora</label>
                                            <input type="time" class="form-control" name="hora_" required>
                                        </div>

                                        

                                        <div id="ho3" style="display: none;">
                                            <label for="genero">Hora</label>
                                            <select name="fech3" class="form-control" id="fech3"> 
                                                <option value="12:31:09 1">12:31</option>
                                                <option value="13:31:09 2">13:31</option>
                                                <option value="14:31:09 3">14:31</option>
                                                <option value="15:31:09 4">15:31</option>  
                                                <option value="16:31:09 5">16:31</option>  
                                                <option value="17:31:09 6">17:31</option> 
                                            </select> 
                                        </div> 

                                        <div id="ho4" style="display: none;">
                                            <label for="genero">Hora</label>
                                            <input type="text" class="form-control" name="fech4" id="fech4"> 
                                        </div> 
                                        <div id="ho5"  ><br>
                                            <label for="genero">Lista</label>

                                            <select class="form-control" id="listas" name="listas">
                                                <option value="1">Inasistencia</option>
                                                <option value="2">Inasistencia Justificado</option>
                                                <option value="3">Retardo</option>
                                                <option value="4">Retardo Justificado</option>
                                                
                                            </select>
                                        </div>  <br>
                                            <label for="genero">Periodo actual</label>
                                            <input class="form-control" value=" <?php echo $_SESSION['numero'] ?>" disabled>  
                                         
                                    </div>
                                    <div style="padding:16px">    
                                        <button type="submit"  class="btn btn-primary" name="eliminary2" id="eliminary2"  style="width: 100%;margin-top:13px ">Aceptar</button>  
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100%;margin-top:13px">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <br>


                    <div class="col-md-3"> 
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <form action="" method="post">
                                    <label for="curso" id="cursoL">Curso:</label>
                                    <select name="curso" class="form-control" id="curso" onchange=" cambi1()"  > 
                                        <?php
                                        foreach($gra as $key){
                                    ?>
                                        <option value="<?php echo  $key['id_jornada_sede'] .','.$key['id_grado'].','.$key['id_curso'].','.$key['id'] .','.$key['numero']; ?>">
                                            <?php echo($key['grado']." ".$key['curso']." Sede: ".$key['sede']." Jornada: ".$key['jornada']); ?>
                                        </option>
                                        <?php
                                        }
                                    ?>
                                    </select>

                                    <label for="curso" id="cursoL">Materia:</label>
                                    <select name="tiempo" class="form-control" id="materia" onchange =" var tiempo= document.getElementById('tiempo').value;var materia= document.getElementById('materia').value;
                                    if (tiempo==2 && materia!='' ) { cambio1(); } " >  
                                    </select>

                                    <label for="curso" id="cursoL">Tiempo:</label>
                                    <select name="tiempo" class="form-control" id="tiempo" onchange="cambio1()"> 
                                        <option value="1">Curricular</option>
                                        <option value="2">Extracurricular</option>
                                    </select>

                                    <label for="curso" id="cursoL">Tipo de lista:</label>
                                    <input type="hidden" value="1"  name="tipo" id="tipo" value="1">
                                    <input class="form-control" value="Asistencia" disabled> 
                                    <label for="curso" id="cursoL">Periodo actual:</label>
                                     <input type="" class="form-control" disabled="true" value="<?php echo($_SESSION['numero'])?>" name=""><br>
                                    <a style="color: #fff" data-toggle="modal" data-target="#mymodal"> 
                                        <div class="btn btn-default btn-file" style="width: 100% ;background-color: #d73925;color: #fff;margin-bottom: 4px">
                                            <img style="margin-right: 5px; width: 20px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDQ1OSA0NTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ1OSA0NTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz48Zz4KCTxnIGlkPSJhcmNoaXZlIj4KCQk8cGF0aCBkPSJNNDQ2LjI1LDU2LjFsLTM1LjctNDMuMzVDNDA1LjQ1LDUuMSwzOTUuMjUsMCwzODIuNSwwaC0zMDZDNjMuNzUsMCw1My41NSw1LjEsNDUuOSwxMi43NUwxMi43NSw1Ni4xICAgIEM1LjEsNjYuMywwLDc2LjUsMCw4OS4yNVY0MDhjMCwyOC4wNSwyMi45NSw1MSw1MSw1MWgzNTdjMjguMDUsMCw1MS0yMi45NSw1MS01MVY4OS4yNUM0NTksNzYuNSw0NTMuOSw2Ni4zLDQ0Ni4yNSw1Ni4xeiAgICAgTTIyOS41LDM2OS43NUw4OS4yNSwyMjkuNWg4OS4yNXYtNTFoMTAydjUxaDg5LjI1TDIyOS41LDM2OS43NXogTTUzLjU1LDUxbDIwLjQtMjUuNWgzMDZMNDAyLjksNTFINTMuNTV6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />Descargar lista 
                                        </div><br>
                                        <button class="btn btn-block btn-primary ">Estudiante radicados </button>
                                    </a>
                                </form>
                            </div>
                        </div><br>
                        
                    </div>
                    <div class="col-md-9" id="col">
                         
                        <div id="sapo"></div>
                        <div class="  " style=" background: #FFF; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div id="tabla" style='overflow: auto;height: 900px'></div>
                        </div>
                       
                    </div>  
                </div>
           </div>
       </div>
       <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer></div></body>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

  

    <script src="../../../js/jquery.loadingModal.js"></script>



    <!-- Slimscroll --> 
    <!-- FastClick --> 
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>
    <script>

        function mostrar(){
            $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }

        var curso = $('#curso').val();
        var tiempo = $('#tiempo').val();
        var tipo = $('#tipo').val();
        var id=<?php echo $_SESSION['Id_Doc'] ?>; 
        var porciones1 = curso.split(',');
        var id_grado_sede=porciones1[3];
            $.ajax({
                type: "post", 
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente1",
                data: {
                    id,id_grado_sede
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
  
                    $('#materia').html(data);
                }
            });

        //MUESTRA LAS AREAS
        function cambi1(){
            mostrar();
            var curso = $('#curso').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>; 
            var porciones1 = curso.split(',');
            var id_grado_sede=porciones1[3];
            $.ajax({
                type: "post", 
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente1",
                data: {
                    id,id_grado_sede
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
  
                    $('#materia').html(data);
                }
            });
        }   
    

        
        //muestra la lista de inacistencia
        function mostrar2(tec,id_informe_academico,id_area,titular){
            var  busca1=document.getElementById('busca').value;
            var busca=' AND inasistencia.materia LIKE "%'+busca1+'%"' ;
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asistencia.php?action=mostrar2",
                data: {
                    tec,id_informe_academico,id_area,titular,busca
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                    
                    $('#mostrar1').html(data); 
                }
            });
        }
      

        function  actualizar_asisten(id_inasistencia,asis){
            mostrar();
            let tiempo=$("#tiempo").val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asistencia.php?action=actualizar_asisten",
                data: {
                   id_inasistencia,asis
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                        alert(tiempo); 
                    if (tiempo==1) {
                        ben();
                    }  
                        
                    
                }
            });  
        }
        //actualiza la tabla en horario curricular
        function ben(){

 
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asistencia.php?action=tabla1",
                data: {
                    
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
        } ben();
        //muestra el curso en horario estracurricular
        function    cambio1(){
            var id_area=$('#materia').val();
            var tiempo = $('#tiempo').val();
            var curso = $('#curso').val();
            var materia= document.getElementById('materia').value; 

            var porciones = id_area.split(',');
            var indice=porciones[4];
            document.getElementById('indice').value=indice; 
            $("#idtecni").val(indice);
            $("#nombre_materia").val(porciones[0]);
            var mate=porciones[0];
            if (tiempo==2  && materia!='' ) {
                mostrar();
                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/asistencia.php?action=tabla11",
                    data: {
                        curso,id_area,mate
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

        $(document).on("submit", "#regis", function(e){
            e.preventDefault();  
            mostrar();
            $.ajax({

                type: "post",
                url:"../../../ajax/docente/asistencia.php?action=regist",
                data: $(this).serialize(),
                dataType:"text", 
                success: function(data)
                { $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                    document.getElementById('fech').value="";
                    mensaje7(3,'Registro Exitoso'); 
                    alert(data);

                }
            });
        });

        function eliminar_remision(id,tec,id_area,id_curso,id_js,id_grado,titular){
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asistencia.php?action=eliminar_remision",
                data: {
                    id
                },
                dataType: "text",
                success: function(data) {  
                }
            });
           
        }

 
       
        function eliminar_re11(id_inasistencia){
            mostrar();

            let tiempo=$("#tiempo").val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asistencia.php?action=eliminar_re1",
                data: {
                    id_inasistencia
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                    if (tiempo==1) {
                        ben();
                    }    
                }
            });
        } 

    
       

        function tomar_asistencia(dias,tecnica,hora,asis,fecha,id_area,id_informe_academico,periodo,area){ 
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asistencia.php?action=tomar_asistencia1",
                data: {
                    dias,tecnica,hora,asis,fecha,id_area,id_informe_academico,periodo,area
                },
                dataType: "text",
                success: function(data) {

                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );  
                }
            });
        }
  
        function consultar_radicacion(titular , id_jornada_sede , id_grado ,id_curso ,id_area  ,tecnica,num){
            mostrar();
            $.ajax({
                url: "../../../ajax/docente/asistencia.php?action=consultar_radicado",
                type: 'POST',
                dataType: 'text', 
                data: {
                    titular , id_jornada_sede , id_grado ,id_curso ,id_area  ,tecnica,num
                },
                success: function(data){
                    
                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );  
                    $("#radis").html(data)
                }
            })
            
        }
        
                     
                 
             
    </script>
</body>




 
