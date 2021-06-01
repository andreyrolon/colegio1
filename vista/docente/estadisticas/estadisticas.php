 <?php
session_start();

require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session'])){
    header("location: ../../../index.html"); echo($_SESSION['Session']);
}
 



 
include "../../../codes/docente/foro.php";
$foro=new foro();
include('../enlaces/head.php');
$vaqr='hacer';
 $dat=$foro->jornada_sede($_SESSION['Id_Doc'],$vaqr);


?>
<style>
    .box-tools{
        color: #bfbfbf;
        display: block;
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
    <?php 
include('../enlaces/header.php'); ?>
    <div class="wrapper ">
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                <div class="col-md-3">
                        <div class="box box-danger" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <div id="validacion"></div>
                                <h4>Ver Estadisticas</h4> 
                                <label for="curso">Sedes y jornadas:</label>
                                <select class="form-control" id="jornada_sede1" name="jornada_sede1" required> 
                                                <?php
                                                $js1='';
                                                foreach($dat[0] as $key){
                                                ?>
                                                    <option value="<?php echo($key['ID_JS']) ?>">
                                                        <?php echo($key['sede']." ".$key['jornada']) ?>
                                                    </option>
                                                    <?php
                                                    $js  = ($js1.''.$key['ID_JS']);
                                                    $js1=$key['ID_JS'];
                                                }
                                               $t=0;
                                                foreach($dat[2] as $keyq){
                                                    $y=$t++;
 
                                                        if ($keyq['ID_JS']!=$js[$y]){  ?>
                                                            
                                                           
                                                            <option value="<?php echo($keyq['ID_JS']) ?>">
                                                                <?php echo($keyq['sede']." ".$keyq['jornada']) ?>
                                                            </option> <?php 
                                                        }
                                                    }
                                                
                                                ?>
                                            </select>   
                                <label for="curso" id="fri" style="display:  ;">Cursos:</label>          
                                <select class="form-control" id="curso1" style="display:  ;">
                                </select>  

                                <label for="curso" id="fri2" style="display:  ;">Asignaturas:</label>          
                                <select class=" select2 form-control" id="Asignaturas" style="display:  ;"  >
                                </select>
                                <label for="periodo" id="period">Periodo:</label>          
                                <select class="form-control" id="periodo">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select> 
                                <br>
                                <button type="buttom"  onclick="var input=''; estadistica(input)" style="width: 100%" id="estad" class="btn btn-danger">Estadisticas</button>
                            </div>
                        </div> 
                    </div>
                <div class="col-md-9">
                    <div id="sapo"></div>
                    <div id="LIMPIAR" class="table table-responsive box   box-primary " style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); display: none;">
                        <div id="mostrara" style="padding: 10px"> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer"   >
        <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
        </div>
        <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>
</div>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

     

    <script src="../../../js/jquery.loadingModal.js"></script>


    <script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>

    <!-- Slimscroll --> 
    <!-- FastClick --> 
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> 
    <script>
        function mostrar(){
            $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }

          
       

        function estadistica(input) { 

            //REINICIAR GRAFICA
            
            // Creamos nuestro canvas
           

            var curso=$('#curso1').val();
            var asignatura=$('#Asignaturas').val();
            var periodo=$('#periodo').val();
            var jornada_sede1=document.getElementById('jornada_sede1').value;
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/estadistica.php?action=ver_estadisticas",
                data: {
                    jornada_sede1,
                    curso,
                    asignatura,
                    periodo,input
                }, 
                dataType:"text", 
                success: function(datas) {
                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                     

                    $('.box').show(); 
                    $('#mostrara').html(datas);  

                   
                    


                }
            }); 
            return false;
        } 
       
        
  
        
        function jor(){
            mostrar();
            var id_js = $('#jornada_sede1').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=sacar_curso_docente22",
                data: {
                    id_js,id
                },
                dataType: "text",
                success: function(data) { 
                    $('#curso1').css('display', 'block'); 
                    $('#fri').css('display', 'block'); 
                    $('#curso1').html(data);  
                    let id_grado_sede = $('#curso1').val();
                    var id=<?php echo $_SESSION['Id_Doc'] ?>;
                    $.ajax({
                        type: "post",
                        url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente1v",
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
                            $('#Asignaturas').html(data);
                           
                        }
                    });
                }
            });
        }

        jor();

                


    $("#jornada_sede1").change(function() {
            jor();
        

    });



        $("#curso1").change(function(){
            mostrar();
                let id_grado_sede = $('#curso1').val();
                var id=<?php echo $_SESSION['Id_Doc'] ?>;
                $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente1v",
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
                        $('#Asignaturas').html(data);
                        
                    }
                });
              

    });
    </script>
   
   
</body>




     