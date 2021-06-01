<?php
if( isset($_GET['id']) && isset($_GET['id_g']) && isset($_GET['id_c']) && isset($_GET['id_jornada_sede'])   && isset($_GET['p'])   && isset($_GET['nomd'])){ 
    ;$id=$_GET['id']; $id_g=$_GET['id_g']; $id_c=$_GET['id_c']; $id_jornada_sede=$_GET['id_jornada_sede'];   $p=$_GET['p'];$nomd=$_GET['nomd'];

}
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

$tipo_C=$carga->tipo_calificaciones();
include('../enlaces/head.php'); 
?>

 
<style>
  body{
    width: 100% ;padding: 0px;
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
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  "> 
                                    
            <section class="content">
                <div class="row"><div id="sapo">    </div>
 
</div>
  
                     <div  >
                    <button type="button" id='iss' style="background-color:transparent;border:0"  data-toggle="modal" data-target="#myModal"  > </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog"        >
    <div class="modal-dialog modal-lg"style=" background-color: #f39c12 ">
      <div class="modal-content"style=" background-color: #f39c12 ">
        
        <div class="modal-body" style="color: #fff"><button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alerta</h4>
         <p id="ph"></p>
        </div>
         
      </div>
    </div>
  </div>
 
    <div id="_MSG2_"></div>
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
 
                            <input type="hidden" value="<?php echo($id_g); ?>" name="id_g" id="id_g">
                            <input type="hidden" value="<?php echo($id_c); ?>" name="id_c" id="id_c"> 
                            <input type="hidden" value="<?php echo($id_jornada_sede); ?>" name="id_jornada_sede" id="id_jornada_sede"> 
                            <input type="hidden" value="<?php echo($p); ?>" name="p" id="p"> 
                            <input type="hidden" value="<?php echo ($nomd)  ?>" name="nomd" id='nomd'>
                            <input type="hidden" value="<?php echo ($id)  ?>" name="id" id='id'>
                            
                            <div id="tabla" style="overflow: auto;height: 950px">
                             
                            </div>
                        </div>
                    </div>
                
            </section>
        </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
       Desarrollado por IBUsoft.
      </div>
      <strong>IBUnotas 1.0.
    </footer>
</div> 

     <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<!-- Slimscroll <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> --> 

<script src="../../../js/jquery.loadingModal.js"></script>




<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
    <script>
 
      function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


    }
     

        mostrar();
            var nomd = $("#nomd").val(); 
            var id = $("#id").val(); 
            var id_g = $("#id_g").val();
            var id_c = $("#id_c").val();
            var id_jornada_sede = $("#id_jornada_sede").val(); 
            var p = $("#p").val(); 
            var ro="<?php echo $_GET['ro']; ?>";
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/definitiva.php?action=definitiva_tecnica",
                data: {nomd,ro,
                   
                   
                    id_g,
                    id_c, 
                    id_jornada_sede,
                    p,id
                },
                dataType: "text",
                success: function(data) {
                    
                $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                   
                    $('#tabla').html(data);
                
            }
            }); 
      

function funcion(apellido){
      mostrar();
            var nomd = $("#nomd").val(); 
            var id = $("#id").val(); 
            var id_g = $("#id_g").val();
            var id_c = $("#id_c").val();
            var id_jornada_sede = $("#id_jornada_sede").val(); 
            var p = $("#p").val(); 
            var ro="<?php echo $_GET['ro']; ?>";
            var dato=apellido;
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/definitiva.php?action=definitiva_tecnica",
                data: {nomd,ro,
                   
                   
                    id_g,
                    id_c, 
                    id_jornada_sede,
                    p,id,dato
                },
                dataType: "text",
                success: function(data) {
                    
                $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                   
                    $('#tabla').html(data);
                
            }
            }); 
}
        
function del1(id_nota_tecnologica_independiente) {

  mostrar();
        var id=$("#id").val(); 
        var  id_c=$("#id_c").val();
        var  id_g=$("#id_g").val();
        var  periodo=$("#p").val(); 

        var  id_jornada_sede= $("#id_jornada_sede").val(); 
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/carga_academica.php?action=del2",
            data: {
                id_jornada_sede,id_c,id_g,periodo,id,id_nota_tecnologica_independiente,
            },
            dataType: "text",
            success: function(data) {   
                $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    if (data==1) {
                        mensaje2(1,'No se puede eliminar la nota, Actualmente  esta calificada'); 
                    }  else{
                        window.location.assign( window.location.href); 
                    } 
            }
        }); 
    }
      
                        </script>  
</body> 