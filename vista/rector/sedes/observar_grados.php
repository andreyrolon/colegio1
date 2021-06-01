 
     

<?php 

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }


$id= $_GET['id'];


 include('../../../codes/rector/sede.php'); 
include('../enlaces/head.php');
$cs=new sede();  
?> 

<style type="text/css">


textarea,
textarea.form-control {
  padding-top: 10px;
  padding-bottom: 10px;
  line-height: 30px;
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
<style>
 
#d{
  padding: 30px;
}
#myTopnav{
  border-top-style: solid; 
  border-bottom-style: solid;
  font-size: 18px;
  padding: 4px 6px;
  color: red;
  height: 62px; 
}


#s{
  border-top-style: solid; 

}
#t-u{
  border-right-style: 10px;
}
#fd{
  padding: 10px;
  border-bottom-style: solid; 
}

#r {
  background-color: #fff;
  margin: 10px;
   
  
}

         

</style>
<?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }
   ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
 
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
    <div class="content-wrapper"> 
      <div class="container">
        <div class="row">

          <div class="modal fade" id="may" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title" style="<?php echo $sty ?>">Confirmación</h4>
                </div>
                <div class="modal-body"> 
                  <p><strong>Confirmación:</strong> Está seguro de eliminar el curso?

              .</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     
                    <button type="button" class="btn btn-primary" id="uuu"  data-dismiss="modal"  onclick="eliminaras();"  >Eliminar</button>
                </div>
              </div>
              
            </div>
          </div>


          <form method="post" id="nuevo_grado">
            <div class="modal fade" id="nmn" role="dialog">
             <div class="modal-dialog"> 
               <div class="modal-content" id="cotent">

                <div class="modal-header" id="header" style="">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                  </button>
                  <h3 class="modal-title" id="modal-register-label" style="<?php echo $sty ?>">Creación de cursos</h3> 
                </div>

                <div class="modal-body" id="body" >
                  <div id="_MSG_"></div>
                  <div class="form-group">
                    <label class="sr-only" for="form-first-name"></label>
 

                    <select id="grado" name="id_grado" class="form-control select2" style="width: 100%;outline: 0;background: #444;border: 3px solid #555;-moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;" required></select>
 
                  </div>

                   <div class="form-group">
                    <label class="sr-only" for="form-first-name"></label>
 

                    <select id="curso" name="id_curso" class="form-control select2" style="width: 100%;outline: 0;background: #444;border: 3px solid #555;-moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;" required></select><br><br>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" required>
 
                  </div> 

                  <input type="hidden" value="<?php echo $id ?>"  id="id_jornada_sede" name='id_jornada_sede'>
                  <button type="submit" name="registro" id="btn1" class="btn"  placeholder="Capcidad"   >Registrar</button>

                </div>

              </div>
            </div></div>  

          </form>
           
          <div class="col-md-11 "  id="r" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><br>

            <div style="font-size: 13px">
              <div id="_MSG2_" style="<?php echo $sty ?>"></div>

              <h3 style="font-family:initial; border-bottom: 5px solid ;padding-bottom: 1px;<?php echo $sty ?>">
                Sede: <?php  $aa=$cs->mostrar4($id); 
                foreach ($aa as $as ) {

                  echo $as['sede'];
                  echo "<br>Jornada:".$as['jornada'];
                }?> <br>
              </h3> 

             
              <button class="btn btn-danger" data-toggle="modal" data-target="#nmn" style="<?php echo $sty ?>">nuevo</button>
              <div class="box-header with-border">
                 <select id="mySelect"  onchange="myFunction(1)">


                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select>
                <div class="box-tools pull-right">
                  <div class="has-feedback">
                    <input type="text" class="form-control input-sm" id='fname' placeholder="Buscar grado" onkeyup="myFunction(1)">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                  </div>
                </div>
                <!-- /.box-tools -->
              </div>
              <div id="sapo"></div>
              <div id="observar_grados"></div>
            </div>
          </div>
        </div>
      </div>
    </div> 
    
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
  function eliminaras(){ 
  mostrar1();
      var parametros=new FormData($("#eliminis7")[0]);
      $.ajax({

        data:parametros,
        url:"../../../ajax/rector/grado/grado.php?action=eliminis7",

        type:"POST",
        contentType:false,
        processData:false,

        success: function(data){ 
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 

              $('#_MSG2_').html(data); 
   
    
        }
      });
    }
  function actualiza(id,num){
    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/grado/grado.php?action=actualizar",

      data:{id,num},    
      dataType:"text", 

      success:function(data){  
        mensaje2(3,'Has actualizado la capicidad del curso');
      }  
    });  
  }

  function myFunction3(id){
   

    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/grado/grado.php?action=eliminar_curso",

      data:{id},    dataType:"text", 

      success:function(data){  
        $('#sapo').html(data); 
      }  
    });  
  }
  for (var i=1; i < 100; i++) {   




   function myFunction(i) {
    var id_jornada_sede=document.getElementById("id_jornada_sede").value;
    var dato=document.getElementById("fname").value;

    var sty='<?php echo $sty ?>';
    var mySelect=document.getElementById("mySelect").value;

    $.ajax({  

      type: "post",
        url:"../../../ajax/rector/grado/grado.php?action=observar_grados",

      data:{i,dato,mySelect,id_jornada_sede,sty},    dataType:"text", 

      success:function(data){  
        $('#observar_grados').html(data); 


      }  


    });  



  }



}


  $(document).ready(function(){  
    mostrar1(); 
    function mostrar(){

    var id_jornada_sede=document.getElementById("id_jornada_sede").value;
    var dato=document.getElementById("fname").value;
 
    var mySelect=document.getElementById("mySelect").value;
    var sty='<?php echo $sty ?>';
      $.ajax({   
        type: "post",
        data:{id_jornada_sede,sty,mySelect,dato},  
        url:"../../../ajax/rector/grado/grado.php?action=observar_grados",
        dataType:"text", 

        success:function(data){  

          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          $('#observar_grados').html(data); 

        }  
      }); 
    }

$(document).on("submit", "#nuevo_grado", function(e){
      e.preventDefault(); 
    mostrar1();

      $.ajax({
        type: "post",
        url:"../../../ajax/rector/grado/grado.php?action=nuevo_grado",
        data: $(this).serialize(),
        dataType: 'text',
        success: function(data)
        { 

          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          $('#observar_grados').html(data); 
              $('#_MSG_').html(data); 
          
   grado();    mostrar(); 
    
        }
      });
    });









   mostrar();
   function grado(){
      $.ajax({   
        type: "post", 
        url:"../../../ajax/rector/grado/grado.php?action=grado",
        dataType:"text", 

        success:function(data){  
          $('#grado').html(data); 
        }  
      }); 
    }
   grado();
   
   $("#grado").change(function(){ 
    var id_jornada_sede=document.getElementById("id_jornada_sede").value;
    var grado=document.getElementById("grado").value;
     $.ajax({   
        type: "post",
        data:{grado,id_jornada_sede},         
        url:"../../../ajax/rector/grado/grado.php?action=curso",

        dataType:"text", 

        success:function(data){  
     
      
          $('#curso').html(data);  


        }  


      }); 
});
      });
    
 </script>