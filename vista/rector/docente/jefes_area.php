 
<?php
session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.html"); echo($_SESSION['Session1']);
}
require_once'../../../codes/rector/area.php';

$area=new area();
$areras_unico=$area->areras_unico2();


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
select{
    height: 250px;
}
#op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
}

.containerq {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 4px;
  cursor: pointer;
  font-size: 15px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.containerq input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
    border:solid 2px #868686;
    border-radius: 3px;
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.containerq:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containerq input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.containerq input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.containerq .checkmark:after {
  left: 4px;
  top: 1px;

  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
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
    <div class="wrapper" class="form-control">
      <?php include('../enlaces/header.php');  



      ?>
    
  <!-- AQUI VA EL CONTENIDO -->
  <div class="content-wrapper"> 

    <div class="row">
        <div class=" ">

        <!-- /.col -->
        <div class="col-md-12">
          
    <div class="modal" id="my" style="background-color: rgba(3, 64, 95, 0.3); ">
        <div class="modal-dialog" role="document"  >
            <div class="modal-content  modal-sm" >
                <div class="modal-header btn-primary table-responsive">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="titulo4" class="modal-title"> Eliminar o Agregar Area</h4>
                </div> 
                <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                
                  <div  class="modal-body table-responsive" id="pdf">
                   

                    <img class="profile-user-img img-responsive img-circle" id="img" src="" style="    margin: 0 auto;width: 160px;height: 180px;padding: 3px;border: 3px solid #d2d6de;">

                    <h3 class="profile-username text-center" id="titu" style="">

                    </h3>
                    <center><strong style="margin-bottom: 5px" >Docente</strong></center>
                    <br>

                <center>
                    <form name="formulario-envia3" id="formulario-envia3" enctype="multipart/form-data" method="post">
                        <input type="hidden" id="ss1" name="ss1">
                        <select   class="form-control select2" multiple="multiple" data-placeholder="Seleccion el area " style="width: 100%;" name="sele2[]" required=""> 
                              <?php 
                              foreach ($areras_unico as $value) {
                               ?><option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option><?php
                           } ?>
                        </select>
                        <button type="" class="btn btn-primary" name="foto" >Subir area acargo</button><br><br>  
                    </form>    
                </center>
                
                 



  <div id="_MSG2_"></div>


                </div>
                <form name="formulario-envia2" id="formulario-envia2" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="ss" name="ss">
                <div style="padding: 25px" >
                    <center></center>
                    <strong>
                        <i class="fa fa-cubes"> </i> <span>AREAs QUE TIENE ACARGO</span><br><br>  </strong>

                        <div id="moster">

                        </div>


                    </div>
                <div class="modal-footer">    
                    <button type=""   class="btn btn-block btn-danger" name="eliminary2" id="eliminary2" onclick="" value="520">Eliminar</button> 
                    <button type="button" class="btn  btn-block btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


           <br> 
           <div class="col-md-3">   
                    <div class="box box-danger" style="padding: 10px; background-color: #fff; display: no ; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <form id="registro" method="post">



                            <div id="_MSG5_" style="margin-bottom: 5px"></div>
                            <strong>Buscador Docente:</strong>  
                            <br> 
                            <div id="primero" style=""></div><br> 
                            <strong>Buscador Area:</strong>  
                            <br> 
                            <select id="sele" class="form-control select2" multiple="multiple" data-placeholder="Seleccione el area que va quedar acargo" style="width: 100%;" name="sele[]" required=""> 
                              <?php   
                              foreach ($areras_unico as $value) {
                               ?><option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option><?php
                           } ?>
                       </select>
                       <br><br>
                       <button type=""    class="btn btn-block btn-danger" style="margin-bottom: 7px; " oncl >Registrar</button>
                   </form>
               </div>
            </div> 
   <div class="col-md-9 "  id="r">










<div  class="box box-primary" id="vv" style="display:  ; background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><strong>
 <div id="titulo2" style="padding: 10px;color: #fff; background-color: #3c8dbc">LISTA DE JEFES DE AREA </div><br>
</strong>  

<div class="table-responsive box-header with-border"> <br>
 <select class="form-control" style="width: 67px;border-radius: 7px" id="sele_tabla" onchange ="var va=document.getElementById('sele_tabla').value;

    document.getElementById('pagina').value=1; 
    document.getElementById('cantidad').value=va;  ddd()">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="40">40</option> 
    </select>
  <div class="box-tools pull-right"><br>
    <div class="has-feedback">
        <input type="text" class="form-control   " id="fname" placeholder="buscador.." onkeyup="myFunction_input(1)" style="margin-top: 5px;border-radius: 7px">
        <span class="fa fa-search form-control-feedback" style=" color: #B7B7B7"></span>
    </div>
</div>
<!-- /.box-tools -->
</div>
<div id="ver" style="padding: 10px;overflow: auto; ">

</div> 
</div>


</div>
</div>


</div>
<!-- /. box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<!-- /.content -->







<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> IBUnotas</b> 1.0
  </div>
  <strong>Desarrollado por  IBUsoft. </strong> 
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

 <!-- jQuery 3 -->
 <!-- jQuery 3 -->



 <!-- Slimscroll -->
 <script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
 <!-- FastClick -->
 <script src="../../../bower_components/fastclick/lib/fastclick.js"></script> 
 <!-- iCheck -->
 <script src="../../../plugins/iCheck/icheck.min.js"></script>
 




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

<script>
  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


}

function  mostrarse(){  
  mostrar();
  
  $.ajax({   
    type: "post",
    data:{},  
    url:"../../../ajax/seles/seles.php?action=sele_docente2",
    dataType:"text", 

    success:function(data){  
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      $('#primero').html(data); 
  }  
});

}
mostrarse();



function  ver(){  
  mostrar();
  
  $.ajax({   
    type: "post",
    data:{},  
    url:"../../../ajax/rector/jefe_area/jefe_area.php?action=ver",
    dataType:"text", 

    success:function(data){  
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      $('#ver').html(data); 
  }  
});

}
ver();


$(document).on("submit", "#registro", function(e){
    e.preventDefault();  
    $.ajax({

        type: "post",
        url:"../../../ajax/rector/jefe_area/jefe_area.php?action=inser",
        data: $(this).serialize(),
        dataType:"text", 
        success: function(data)
        { 
           window.location.assign( window.location.href); 
      }
  }); 
});
$(document).on("submit", "#formulario-envia3", function(e){
    e.preventDefault();  
    $.ajax({

        type: "post",
        url:"../../../ajax/rector/jefe_area/jefe_area.php?action=inser2",
        data: $(this).serialize(),
        dataType:"text", 
        success: function(data)
        { 

           window.location.assign( window.location.href); 
      }
  }); 
});

function che(id){
    mostrar();

    $.ajax({   
        type: "post",
        data:{id},  
        url:"../../../ajax/rector/jefe_area/jefe_area.php?action=prueva",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#moster').html(data); 
      }  
  });
}

$(document).on("submit", "#formulario-envia2", function(e){
    e.preventDefault();  
    $.ajax({

        type: "post",
        url:"../../../ajax/rector/jefe_area/jefe_area.php?action=el",
        data: $(this).serialize(),
        dataType:"text", 
        success: function(data)
        { 
           if (data==1) {
                mensaje2(2,'Debe seleccionar una area o asignatura');
            }else{

           window.location.assign( window.location.href); 
            }
      }
  }); 
}); 

    function myFunction_input(i){ 
        var dato=document.getElementById('fname').value;
        $.ajax({   
            type: "post",
            data:{dato},  
            url:"../../../ajax/rector/jefe_area/jefe_area.php?action=ver",
            dataType:"text", 

            success:function(data){  
              $('body').loadingModal({text: 'Showing loader animations...'});

              var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
              var time = 100;

              delay(time)
              .then(function() { $('body').loadingModal('hide'); return delay(time); } )
              .then(function() { $('body').loadingModal('destroy') ;} ); 
              $('#ver').html(data); 
          }  
      });
    }
    
 


</script>
</body>



