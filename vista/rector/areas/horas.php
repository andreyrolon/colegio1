


  <?php 
   session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); 
    }
  include '../../../codes/rector/area.php';
  $area=new area();
  $areas=$area->areras_unico();


  include('../../../codes/rector/sede.php');




  include('../enlaces/head.php'); ?>

  <style type="text/css">



  #im {
    height: 50px;
    margin: 0;
    padding: 0 20px;
    vertical-align: middle;
    background: #333;
    border: 1px solid #333;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 50px;
    color: #888;
    -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
  }

  textarea,
  textarea.form-control {
    padding-top: 10px;
    padding-bottom: 10px;
    line-height: 30px;
  }

  #im {
    outline: 0;
    background: #444;
    border: 3px solid #555;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
  }
  #im { color: #888; } 



  #btn1 {
    width: 100%;
    height: 50px;
    margin: 0;
    padding: 0 20px;
    vertical-align: middle;
    background: #fd625e;
    border: 0;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 50px;
    color: #fff;
    -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
    text-shadow: none;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
  }

  #btn1:hover { opacity: 0.6; color: #fff; }

  #btn1:active { outline: 0; opacity: 0.6; color: #fff; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }

  #btn1:focus { outline: 0; opacity: 0.6; background: #fd625e; color: #fff; }

  #btn1:active:focus{ outline: 0; opacity: 0.6; background: #fd625e; color: #fff; }
  #content {
    background: #3a3a3a;
    -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
    border: 0;
    text-align: left;
  }

  #header {
    padding: 25px 25px 15px 25px;
    background: #333;
    border: 0;
    -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; border-radius: 4px 4px 0 0;
    color: #888;
  }

  #header .close {
    font-size: 36px;
    color: #eee;
    font-weight: 300;
    text-shadow: none;
    opacity: 1;
  }

  #title {
    margin-bottom: 10px;
    line-height: 30px;
    color: #eee;
  }

  #body {
    padding: 25px 25px 30px 25px;
    background: #3a3a3a;
    text-align: left;
    -moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;
  }



  #body form textarea {
    height: 100px;
  }

  #body form .input-error {
    border-color: #fd625e;
  }

  </style>
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>

 




 

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
  <style type="text/css">
    a:hover{
      color: #000;
      text-decoration: underline;
    }
  </style>
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-primary" style="padding: 10px;background-color: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <strong>Bucar area:</strong>
              <select name="" class=" form-control select2" style="width: 100%" id="buscar" onchange=" buscar()">
                <option value="">Seleccione una area</option>
                <?php foreach ($areas as $key) {
                  ?>
                  <option value="<?php echo $key['nombre']?>"><?php echo $key['nombre']?></option><?php
                } ?>
              </select><br><br>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-5">






            <div class="box box-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div style="padding: 5px;margin-left: 10px"><strong>Hintensidad horaria</strong></div>
              <br> 

             


          

    
            <div id="tabla"  style="padding: 20px" >
              
            </div>

          
   
   






          </div>

        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content -->







  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">

    <!-- /.tab-pane -->

  </aside>
  <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->
<?php 
      include('../enlaces/footer.php'); ?>
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

      <script type="text/javascript">
 
 
         
  function mostrar(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }



 
  function  buscar() {
    mostrar();
    var area=document.getElementById("buscar").value;
    $.ajax({  

      type: "post",
      data:{area}, 
      url:"../../../ajax/rector/areas/areas.php?action=tabla32",
      dataType:"text", 
      success:function(data){  
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#tabla').html(data); 
      }  
    });  
  }
 

 


  function  funcion(hora,id,grado){ 
    mostrar();
    var area=document.getElementById("buscar").value;
    $.ajax({  

      type: "post",
      data:{hora,id,grado,area}, 
      url:"../../../ajax/rector/areas/areas.php?action=registrar_intensidad_horaria",
      dataType:"text", 
      success:function(data){  
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
         buscar()
      }  
    }); 
  }

 



  </script> 