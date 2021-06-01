 
<?php
 session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../index.html"); echo($_SESSION['Session']);
    }
 

if(isset($_GET['nombre'])  &&  isset($_GET['codigo']) && isset($_GET['id']) && isset($_GET['id_g']) && isset($_GET['id_c']) && isset($_GET['id_jornada_sede'])   && isset($_GET['p'])   && isset($_GET['nomd'])){
    $nombre=$_GET['nombre'];$id=$_GET['id']; $id_g=$_GET['id_g']; $id_c=$_GET['id_c']; $id_jornada_sede=$_GET['id_jornada_sede'];   $p=$_GET['p'];$nomd=$_GET['nomd'];$codigo=$_GET['codigo'];$nomd=$_GET['nomd'];
} 
include('../enlaces/head.php'); 
?>
<style>
    <?php
    for($i=1;$i<15;$i++){
     ?>
    .p<?php echo($i); ?> {
        visibility: hidden;
        margin-top: -20px; 
        position: fixed;
    }
    <?php
    }
    ?>
    .profile-user-img {
        margin: 0;
        width: 60px;
        height: 60px;
        border: 3px solid #3c8dbc;
    }
    
    .font{
        font-size: 10px;
    }
</style>

 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }  
 $style='';
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
     $style='font-size: 17px;';  
  } ?>
 <body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
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


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
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
 
        function funcion(apellido){
            mostrar();
            var nombr_ma ="<?php echo $_GET['nomd'] ?>";
            var id_a = <?php echo $_GET['nombre'] ?>;
            var id_g = <?php echo $_GET['id_g'] ?>;
            var id_c = <?php echo $_GET['id_c'] ?>; 
            var id_jornada_sede = <?php echo $_GET['id_jornada_sede'] ?>;
            var p = <?php echo $_GET['p'] ?>;
            var nombre = <?php echo $_GET['nombre'] ?>;
            var area=<?php echo $_GET['area'] ?>;
            var periodo = <?php echo $_GET['p'] ?>;
            var codigo=<?php echo $_GET['codigo'] ?>;
            var ro='<?php echo $_GET['ro'] ?>';
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asignar_nota.php?action=form1",
                data: {
                    periodo,
                    nombre,
                    id_a,
                    id_g,
                    id_c,id_jornada_sede,
                    p,nombr_ma,codigo,area,ro,apellido
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                    $('#tabla').html(data);
                }
            });
        }
 
        function mostrar1() {
            mostrar();
            var nombr_ma ="<?php echo $_GET['nomd'] ?>";
            var id_a = <?php echo $_GET['nombre'] ?>;
            var id_g = <?php echo $_GET['id_g'] ?>;
            var id_c = <?php echo $_GET['id_c'] ?>; 
            var id_jornada_sede = <?php echo $_GET['id_jornada_sede'] ?>;
            var p = <?php echo $_GET['p'] ?>;
            var nombre = <?php echo $_GET['nombre'] ?>;
            var area=<?php echo $_GET['area'] ?>;
            var periodo = <?php echo $_GET['p'] ?>;
            var codigo=<?php echo $_GET['codigo'] ?>;
            var ro='<?php echo $_GET['ro'] ?>';
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/asignar_nota.php?action=form1",
                data: {
                    periodo,
                    nombre,
                    id_a,
                    id_g,
                    id_c,id_jornada_sede,
                    p,nombr_ma,codigo,area,ro
                },
                dataType: "text",
                success: function(data) { 
                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                    $('#tabla').html(data);
                }
            });
        }


         
 

        
        mostrar1();  

    </script> 
</body> 