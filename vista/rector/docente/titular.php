 
<!-- Google Font -->
<?php 
 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include('../enlaces/head.php'); 
require_once "../../../codes/rector/jornada.php";
$jornada=new jornada();
$jornadas=$jornada->mostrar_jornada_sede();
 

?>
 
   <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }  

   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
    $style='font-size: 17px;';  
  }else{ 
    $style='';
  }  ?>
 
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">

  <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?> 
    <div class="content-wrapper"> 
 
      <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">




 



        <div class="row" >
          <div class="col-md-1"></div>
          <div class="col-md-10"style=" background-color: #fff;margin: 20px ;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <br>
            <?php $tr=1; foreach ($jornadas as  $value) {  ?>
              <div class="box collapsed-box" style="border-top: #fff">
                <div class="box-header with-border" style="background-color: #33b5e5;color: #fff;border: solid 2px #0ea0cc;border-radius: 5px">
                  <h3 class="box-title" ><?php echo $tr++ ?>.  Sede: <?php echo $value['sede'].' - '.$value['jornada'] ?></h3>

                  <div class="box-tools pull-right">
                    <input type="hidden" id="val<?php echo $value['ID_JS']  ?>" value='0'>
                    <button style="color:#fff" onclick="var y=  document.getElementById('val<?php echo $value['ID_JS']  ?>').value;if (y==0) { document.getElementById('val<?php echo $value['ID_JS']  ?>').value=1;}else{document.getElementById('val<?php echo $value['ID_JS']  ?>').value=0;} var i=<?php echo $value['ID_JS']  ?>;  ver(i);  " type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button> 
                  </div>
                </div>
              <!-- /.box-header -->
                <div class="box-body" style="display: none;">
                  <div id="tabla<?php echo $value['ID_JS']  ?>" style="padding: 10px" class="table-responsive">
                     
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </form>
    </div>
    <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> IBUnotas</b> 1.0
    </div>
    <strong>Desarrollado por  IBUsoft. </strong> 
  </footer>
  </div>
</body> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.js"></script>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


 

<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
<script>
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
</script>
<script type="text/javascript">

  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
  }



 


  function myFunction(id_docente,id){
    mostrar();
    $.ajax({   
      type: "post", 
      data:{id,id_docente},
      url:"../../../ajax/rector/docentes.php?action=actualizar_titulaar", 
      dataType:"text", 
      success:function(data){   
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
      }  
    }); 
  }

  function ver(i){ 
    mostrar();
    $.ajax({   
      type: "post",

      data:{i},
      url:"../../../ajax/rector/docentes.php?action=ver_titular",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
       $('#tabla'+i).html(data);

      }  


    });
  }

   





      </script> 