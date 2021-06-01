  <?php
 session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../index.html"); echo($_SESSION['Session']);
    }
include "../../../codes/docente/carga_academica.php";
$carga=new carga();
include "../../../codes/docente/logro.php";
 $logroqq=new logro();
$curso=$logroqq->curso($_GET['id_g'],$_GET['id_c'],$_GET['id_jornada_sede']);

if(isset($_GET['nombre'])  &&  isset($_GET['codigo']) && isset($_GET['id']) && isset($_GET['id_g']) && isset($_GET['id_c']) && isset($_GET['id_jornada_sede'])   && isset($_GET['p'])   && isset($_GET['nomd'])){
    $nombre=$_GET['nombre'];$id=$_GET['id']; $id_g=$_GET['id_g']; $id_c=$_GET['id_c']; $id_jornada_sede=$_GET['id_jornada_sede'];   $p=$_GET['p'];$nomd=$_GET['nomd'];$codigo=$_GET['codigo'];$nomd=$_GET['nomd'];
}
$tipo_C=$carga->tipo_calificaciones();
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
#formulario{ margin     : 10px;
        border: solid 1px #d4d4d4c2;

}
    #idw{
        color: #3c8dbc; 
    }
    #idw:hover{  color:#fff;background-color: #3c8dbc
    }
    #idww:hover{   ;border: solid 0.5px;
    }
    #op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
    }
    #er{
        margin-left: 10PX;    color: #007bff;
    border: solid #007bff 1px;    padding: .375rem .75rem;background-color: transparent;border-radius: .25rem;margin-top: 5px;
    }
    #er:hover{
        background-color: #007bff;
        color: #fff;
    }
    #er1{ margin-left: 10PX; 
        color: #343a40;
        border: solid #343a40 1px;    padding: .375rem .75rem;background-color: transparent;border-radius: .25rem;margin-top: 5px;
    }
    #er1:hover{
        background-color: #48494a;
        color: #fff;
    }
    #er2{
        margin-left: 10PX;    color: #dc3545;
    border: solid #dc3545 1px;    padding: .375rem .75rem;background-color: transparent;border-radius: .25rem;margin-top: 5px;
    }
    #er2:hover{
        background-color: #dc3949;
        color: #fff;
    }
    #er3{
        margin-left: 10PX;    color: #28a745;
    border: solid #28a745 1px;    padding: .375rem .75rem;background-color: transparent;border-radius: .25rem;margin-top: 5px;
    }
    #er3:hover{
        background-color: #28a745;
        color: #fff;
    }
     
 
      [data-title] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 
  margin-left: 100px; 
     
}

[data-title]:hover::before { 
  content: attr(data-title);   
  position: absolute;   ;
  bottom: 15px;  width: 400px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 6px;
  background: #000;
  color: #fff;
  font-size: 12px; right: 20px;
  font-family: sans-serif;
  white-space: normal; 
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: -50px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    

  border-top: 11px solid #000;


}
td,th,tr{
          border: 1px solid #ddd;
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
 
    
<div class="wrapper" class="form-control"><?php include('../enlaces/header.php');   ?>
    <div class="content-wrapper">  
        <div class="row"><br>
            <div class="col-md-12"> 
                <div class="col-md-12"> <div id="sapo"></div> 
                                                     
                    <div class="col-md-1"></div>
                    <div  class="col-md-10" style=" background-color: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="row">
                            <div style="background-color: #00a7d0;padding: 10px;color: #fff"> 
                                <div style="float: left;"><img src="https://colmabrija.edu.co/docentes/imagenes/logros.png" alt=""></div>
                                <div style="float:  ;">ASIGNACIÓN DE LOGROS </div>
                                <div style="float:  ;"> 
                                  <?php 
                                  foreach ($curso as $key ) {
                                    echo 'Sede: '.$key['s'].' - '.$key['j'].'/ Grado: '.$key['g'].'-'.$key['c'];
                                   } ?>
                                </div>
                            </div> 
                                  <br>                             
                             
                            <button type="button" onclick=" document.getElementById('curso').innerHTML ='Descripción de la Dificultad:'; document.getElementById('text').value=3; document.getElementById('tipo_codigo').value='Dificultad'; var n=3; document.getElementById('idsss').value='';$('#titulos').html('Tabla De Dificultades');  mostrarr(n)" id="er1"   data-toggle="modal" data-target="#my" >
                                Dificultad
                            </button>
                            <button type="button" id='er2'   onclick=" document.getElementById('curso').innerHTML ='Descripción de la Recomendación:'; document.getElementById('text').value=2; document.getElementById('tipo_codigo').value='Recomendación'; var n=2; document.getElementById('idsss').value='';$('#titulos').html('Tabla De Recomendaciones'); mostrarr(n)"   data-toggle="modal" data-target="#my">
                                Recomendaciones
                            </button> 
                              <button type="button"  id="er3"  onclick=" document.getElementById('curso').innerHTML ='Descripción de la Fortaleza:'; document.getElementById('text').value=1; document.getElementById('tipo_codigo').value='Fortaleza'; var n=1; document.getElementById('idsss').value='';$('#titulos').html('Tabla De Fortalezas');  mostrarr(n)"  data-toggle="modal" data-target="#my">
                                Fortalezas
                            </button> 
                            <div style="float: right; margin:10px;">
                            <strong> Buscador:</strong>
                                <input style="margin-left: 10px;    height: 27px; 
                                padding: 6px 12px;
                                font-size: 14px;
                                line-height: 1.42857143;
                                color: #555;
                                background-color: #fff;
                                background-image: none;
                                border: 1px solid #ccc;
                                border-radius: 2px;" type="text" class="form-" id="pala" placeholder="Buscar estudiante.."name="search" onkeyup='mostrar1()'> 
                            </div>
                        </div> 
                        <div class="box box-danger" id="ww" style="display: none;">
                            <div class="box-header">
                                <h4 style="text-align: center;"> CARGANDO</h4><br><br>
                            </div>
                            <div class="box-body"> 
                            </div>
                            <div class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>

                        </div>
                        <div id="tabla" style="overflow:auto;height:800px;"></div>
                    </div>
                    <div class="col-md-1"></div>
                </div>  
            </div>
        </div> <br><br><br>
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



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 


 
    <script>
     function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }
    function prueva(){
        $("#my").modal("hide");
    }
    function mostrar1() {  
    document.getElementById('ww').style.display='block';
        var nomd = "<?php echo $_GET['nomd'] ?>";
        var id_a = "<?php echo $_GET['id'] ?>";
        var codigo = "<?php echo $_GET['codigo'] ?>";
        var id_g = "<?php echo $_GET['id_g'] ?>";
        var id_c = "<?php echo $_GET['id_c'] ?>";
        var id_jornada_sede = "<?php echo $_GET['id_jornada_sede'] ?>"; 
        var p ="<?php echo $_GET['p'] ?>"; 
        var palabra=document.getElementById('pala').value;  
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/logro_tecnico.php?action=curso_logro",
            data: {nomd,
                id_a,
                id_g,
                id_c, codigo,
                id_jornada_sede,palabra,
                p
            },
            dataType: "text",
            success: function(data) {
               
                document.getElementById('ww').style.display='none';
                 $('#tabla').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('#tabla').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                
               
                $('#tabla').html(data);
            }
        });
    }


       
         $(document).on("submit", "#tinti", function(e){
                      e.preventDefault();  
                      mostrar(); 
                      $.ajax({

                        type: "post",
                      url: "../../../ajax/docente/logro_tecnico.php?action=masivo_registro", 
                        data: $(this).serialize(),
                        dataType:"text", 
                        success: function(data)
                        { 

                          $('body').loadingModal({text: 'Showing loader animations...'});

                          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                          var time = 100;

                          delay(time)
                          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                          .then(function() { $('body').loadingModal('destroy') ;} );
                          $('body').loadingModal({text: 'Showing loader animations...'});

                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                          var codigo=document.getElementById('tipo_codigo').value;
                           if (data==0) {
                            document.getElementById("_MSG9_").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Alerta!</strong> <br>Seleccione el codigo de la '+codigo+' . </div>';
                            window.setTimeout(function  () {
                                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                            }, 3900);
                            return false;
                          }
                           if ((data==10) || (data==1)) {
                            document.getElementById("_MSG9_").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Alerta!</strong> <br>En la tabla estudiante seleccine los logros para registrar la  '+codigo+' . </div>';
                            window.setTimeout(function  () {
                                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                            }, 5900);
                            return false;
                          }if ((data!=10)  && (data!=1) && (data!=0)) {
                            prueva();
                            setTimeout(mostrar1, 550)
                            

                          }
 
                        }
                      });
                    });



 

        
        mostrar1();  

    </script> 
</body> 
                
           
   


       




 