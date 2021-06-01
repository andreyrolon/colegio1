


 <?php 
  session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }


include('../enlaces/head.php'); ?>
 

 
  
<style type="text/css">

 
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
 
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 



<div class="row">
        <div class="col-md-3"  >
 
  <br>
  <div class="nav-tabs-custom"  style="  margin-right: 7px;margin-left: 7px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div id="sp"></div>
    <form   method="post">
      <div class="box-header with-border" style="background-color: #d73925;color: #fff">
        <h4 class="box-title" style="<?php echo $sty; ?>">Buscar docente</h4>
      </div>
      <div class="box-body">
        <!-- the events -->
        <div id="external-events"> 
          <select class="form-control select2" id='sapo1' onchange="noni1()"  >
            
          </select> <br><br>

          <select class="form-control select2" id='sapo2' onchange="noni2()"  >
            
          </select> 
         
        </div>
      </div></form>

    </div>
    <br> 
      
  </div> 


 


<div class="col-md-9" >  <br>
<div class="nav-tabs-custom" id="koooo" style="  display: none; margin-right: 7px;margin-left: 7px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">  
<div class="box-header with-border" style="border-top: solid 3px #3c8dbc;
    color: #000;">
        <h4 class="box-title" style="<?php echo $sty; ?>">Carga Academica Por Curso</h4>
      </div> 
      <div id="_MSG_" style="padding-left: 10px;padding-right: 10px"></div>
  <div id="ver_areas"style="padding: 10px;">
    
  </div>
  <!-- /.col -->
</div>

<div class="col-md-1"></div>
 </div>
 
     </div>  
  
</div><footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer> 
</div>
  
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>


<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>

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
  function mostrar1(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }
 
    
    function veer(){
      mostrar1()
      document.getElementById("koooo").style.display = "none";
      $.ajax({   
        type: "post",  
        url:"../../../ajax/seles/seles.php?action=nuevo_grado",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#sapo1').html(data); 
        }  
      });
    } 
    veer();




    function noni1(){
      var idjs=document.getElementById('sapo1').value;
      mostrar1();
      $.ajax({   
        type: "post", 
        url:"../../../ajax/seles/seles.php?action=sacar_curso",
        data:{idjs},
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#sapo2').html(data); 
        }  
      }); 
    }

    function noni2(){
      mostrar1();
      document.getElementById("koooo").style.display = "block";
      var id=document.getElementById('sapo2').value;
      $.ajax({   
        type: "post",
        data:{id},  
        url:"../../../ajax/rector/grado/grado.php?action=ver_areas",
        dataType:"text", 

        success:function(data){
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#ver_areas').html(data); 
                  }  
      }); 
    }
    function funct(doc,id){  
      mostrar1();
      $.ajax({


        type: "post",
        data:{doc,id},  
        url:"../../../ajax/rector/grado/grado.php?action=carga_docentes",
        dataType:"text",  
        success: function(data)
        {  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
          mensaje(3,'Carga academica actualizada');
        }
      });
    } 
    function todos(doc){ 
      var id=document.getElementById('sapo2').value;
      mostrar1();
      $.ajax({   
        type: "post",
        data:{id,doc},  
        url:"../../../ajax/rector/grado/grado.php?action=carga_docentes_todos",
        dataType:"text", 

        success:function(data){ 
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
          noni2();
          mensaje(3,'Carga academica actualizada.');
        }  
      });  
    }
  </script>




</body>

</html>
 