


<?php 

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['1Session']);
    }

    include '../../../codes/rector/docente.php';
$p=new docente();
$rperiodoo=$p->ver_periodos();

include('../enlaces/head.php'); ?>


 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>

 

 <style>
/* The container */
.containerqq {

  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px; 
}

/* Hide the browser's default radio button */
.containerqq input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
  border-radius: 50%;
border: 1px solid #d2d6de;
}

/* On mouse-over, add a grey background color */
.containerqq:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.containerqq input:checked ~ .checkmark {
  background-color: #1abc9c;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.containerqq input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.containerqq .checkmark:after {
  top: 5px;
  left: 5px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;

}

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
  left: 2px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   

tr:hover{border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;
  color:   #757575
}
.popo{
                height: 34px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc; 
           
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
 
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
  <div class="row">
  <div class="col-md-12"><br> 
 
          
                   <div class="modal fade" id="myModal" role="dialog"style="background-color: rgba(3, 64, 95, 0.3);  ">
         <div class="modal-dialog">
            <div class="modal-content" id="cotent" >
              <div class="modal-header" id="header" style="color:#fff;background-color: #3c8dbc;">
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title" id="sss" style="<?php echo $sty; ?>">Nuevo logro</h3> 
              </div>

              <div class="modal-body" id="body" >
                <div id="_MSG2_"></div>
                 
                <div class="form-group">
                  <label class="sr-only" for="form-email">Logro</label>
                  <textarea class="form-control" id="logro" name="logro" placeholder="Logro" style="height: 127px"></textarea>
                </div>  
                <input type="hidden" id="tipo"  name="tipo">
                <input type="hidden" id="materia2" name="materia"><input type="hidden" id="grado2" name="grado">
                 

              </div>
              <div class="modal-footer">  
                <button type="button" style="" class="btn btn-block btn-primary"onclick="   nuevo()">Aceptar</button>
                <button type="button" style="" data-dismiss="modal" name="Aceptar"  data-dismiss="modal" id="dsd" class="btn btn-block btn-danger" >Cancelar</button> 
              </div>
            </div>
          </div>
        </div> 

        <div class="modal fade" id="mymodal1" role="dialog" style="background-color: rgba(3, 64, 95, 0.3);  ">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Confirmación</h4>
                    </div>
                    <div class="modal-body">
                      <p> está seguro de eliminar el logro?</p>
                      <input type="hidden" id="eliminar">

                    </div>
                    <div class="modal-footer">    
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                      id="btn"   onclick="var id=document.getElementById('eliminar').value; myFunction3i(id)">Aceptar</button> 

                    </div>
                  </div>
                </div>
              </div>


       
 
      <div class="col-md-4"  >
        <br>

        <div class="box bo box box-success"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">

          <form   method="post">
            <div class="box-header with-border" style="background-color: # ;color: #000">
              <h4 class="box-title">Buscar tecnica</h4>

            </div> 
            <div class="box-body"> 
              <select name="sede" onchange="ver()" class="form-control select2" id="ko" style="width: 100%; border-radius: " >

              </select> 

              <br> 
              <br>
               <div style="float: left;margin-left: 30px" >Logros</div>
              <label class="containerqq">
                <input type="radio" id="radio1" name="tt" checked onclick="clim()" >
                <span class="checkmark"></span>
              </label><br><div style="float: left;margin-left: 30px" >Recomendaciones</div>
              <label class="containerqq">
                <input type="radio" id="radio2" name="tt" onclick="clim()">
                <span class="checkmark"></span>
              </label><br>
              <div style="float: left;margin-left: 30px" >Dificultades</div>
              <label class="containerqq">
                <input type="radio" id="radio3" name="tt" onclick="clim()">
                <span class="checkmark"></span>
              </label><br>
              <div id="external-events">  


                <br>   

              </div>
            </div></form>

          </div> 
           
        </div> 

 

 
        <div class="col-md-7"    > <br>  <div class="table table- " >
           
          <div class="box box-primary" id="eee"   style="  display: none;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
            <div style="margin-left: 6px;margin-top: 5px"><strong>Tabla de logros, recomendaciones y dificultades</strong></div>
            <div id="_MSG9_"></div> 
            <div id="_MSG5_"></div> <br>
            <button type="button" style="margin-left: 6px" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="document.getElementById('tipo').value=<?php echo $toa ?>;
        $('#sss').html('Nuevo <?php echo $var ?>');
        document.getElementById('logro').placeholder = '<?php echo $var ?>..';"> Nuevo</button>
            <div class="box-header with-border">
             <select id="mySelect" class="popo" onchange="myFunction(1)">


              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            <div class="box-tools pull-right">
              
            <div class="has-feedback">
                        <input type="text" style="margin-top: 3px" class=" popo" id="fname" placeholder=" buscador.." onkeyup="myFunction(1)">
                        <span class="fa fa-search form-control-feedback" style=" color: #AAAAAA"></span>
                    </div>
            </div>
            <!-- /.box-tools -->
          </div>

                        <div class="box box-danger" id="ww" style="display: none ;">
                            <div class="box-header">
                                <h4 style="text-align: center;"> CARGANDO</h4><br><br>
                            </div>
                            <div class="box-body"> 
                            </div>
                            <div class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>

                        </div>
            <div id="tec">
              
            </div>

            <!-- /.col -->
          </div>
 
        </div>
</div>
   </div>

        
    </div> <!-- /container -->
    <!-- Content Header (Page header) -->
    
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->
<footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer> 
</div>
<!-- jQuery 3 --> 
</body>
</html>




<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
 
      <script type="text/javascript">
 
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
         
  function mostrar(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }


 
 
function mostrat(){
    mostrar()
        document.getElementById("ko").focus();
        $.ajax({   
          type: "post",

          url:"../../../ajax/seles/seles.php?action=competencias",
          dataType:"text", 

          success:function(data){  
            $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#ko').html(data); 


          }  
        });
      }mostrat();
  

  function clim(){
    mostrar();
    var radio1=document.getElementById("radio1").checked; 
    var radio2=document.getElementById("radio2").checked; 
    var radio3=document.getElementById("radio3").checked; 
    if (radio3==true) {
      var toa= 3;
    }
    if (radio2==true) {
      var toa= 2;
    }
    if (radio1==true) {
      var toa= 1;
    }
    var id=document.getElementById("ko").value;
    $.ajax({   
      type: "post",
      data:{id,toa},  

      url:"../../../ajax/rector/logros/logros.php?action=logro_tecnica",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        document.getElementById('eee').style.display='block';
        $('#tec').html(data); 
      }  
    });
  }

  function ver(){
    mostrar();
    var radio1=document.getElementById("radio1").checked; 
    var radio2=document.getElementById("radio2").checked; 
    var radio3=document.getElementById("radio3").checked; 
    if (radio3==true) {
      var toa= 3;
    }
    if (radio2==true) {
      var toa= 2;
    }
    if (radio1==true) {
      var toa= 1;
    }
    var id=document.getElementById("ko").value;
    $.ajax({   
      type: "post",
      data:{id,toa},  

      url:"../../../ajax/rector/logros/logros.php?action=logro_tecnica",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        document.getElementById('eee').style.display='block';
        $('#tec').html(data); 
      }  
    });
  }


  function nuevo(){
    mostrar();
    var radio1=document.getElementById("radio1").checked; 
    var radio2=document.getElementById("radio2").checked; 
    var radio3=document.getElementById("radio3").checked; 
    if (radio3==true) {
      var toa= 3;
      var l='Dificultad';
    }
    if (radio2==true) {
      var toa= 2;
      var l='Recomendaciones';
    }
    if (radio1==true) {
      var toa= 1;
      var l='Logro';
    }
    var id=document.getElementById("ko").value;
    var logro=document.getElementById("logro").value;
    if (logro=='') {
      mensaje2(2,'No has llenado el campo  '+ l)
    }else{

      $.ajax({   
        type: "post",
        data:{id,toa,logro},  

        url:"../../../ajax/rector/logros/logros.php?action=nuevo_logro_tecnica",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          document.getElementById("logro").value='';
          document.getElementById("logro").focus();

          mensaje2(3,'Registro exitoso ')
          ver();
        }  
      });
    }
  }
  
  function cambiar(u,ides,n,w){
    mostrar();
    $.ajax({   
      type: "post",
      data:{u,ides,n,w},  

      url:"../../../ajax/rector/logros/logros.php?action=actualizar_logro_tecnica",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        mensaje5(3,'Registro actualizado. ');
          
      }  
    });  
  }
  function myFunction3i(id){
    mostrar();
    $.ajax({   
      type: "post",
      data:{id},  

      url:"../../../ajax/rector/logros/logros.php?action=eliminar_logro_tecnica",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        ver();
        $('#_MSG9_').html(data);
      }  
    });
  }
 
 

  for (var i=0; i < 100; i++) {   
    function myFunction(i) {
      document.getElementById('ww').style.display='block';
      var radio1=document.getElementById("radio1").checked; 
      var radio2=document.getElementById("radio2").checked; 
      var radio3=document.getElementById("radio3").checked; 
      if (radio3==true) {
        var toa= 3;
        var l='Dificultad';
      }
      if (radio2==true) {
        var toa= 2;
        var l='Recomendaciones';
      }
      if (radio1==true) {
        var toa= 1;
        var l='Logro';
      }
      var id=document.getElementById("ko").value;


      var dato=document.getElementById("fname").value;
      var mySelect=document.getElementById("mySelect").value;
      $.ajax({ 
        type: "post",
        url:"../../../ajax/rector/logros/logros.php?action=logro_tecnica",
        data:{i,id,toa,dato,mySelect},    dataType:"text", 
        success:function(data){ 
          document.getElementById('ww').style.display='none'; 
        $('#tec').html(data); 
        }
      });  
    }
  }
  

       
    </script>



 