


<?php 
  
session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include('../../../codes/rector/sede.php');

$cs=new sede();

if (isset($_POST['eliminar_sede'])){

 $cs->eliminar($_POST['eliminar_sede']);

} 

if (isset($_POST['eliminar_sedes'])){

 $h=$_POST['id'];
 foreach ($h as $key ) {

   $cs->eliminar($key);
 }

} 


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
  <?php include('../enlaces/header.php');  



  ?>


  <!-- AQUI VA EL CONTENIDO -->
  <div class="content-wrapper"> 

    <div class=" ">
      <div class=" ">
        
        <!-- /.col -->
        <div class="col-md-12">
 
 




          <br><br>
          <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <br> 

            <div class="box-header with-border">
             <select id="mySelect"  onchange="myFunction(1)">


              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            <div class="box-tools pull-right">
              <div class="has-feedback">
                <input type="text" class="form-control input-sm" id='fname' placeholder="Search Mail" onkeyup="myFunction(1)">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
            </div>
            <!-- /.box-tools -->
          </div>


          <div id="_MSG2_"></div>

          <div id="tabla">

            <!-- /.box-header -->




          </div>

          <form method="post" id="agregar">
            <div class="modal fade" id="myModal" role="dialog">
             <div class="modal-dialog">
              <div class="modal-content" id="cotent">
                <div class="modal-header" id="header" style="">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                  </button>
                  <h3 class="modal-title" id="modal-register-label" style="<?php echo $sty; ?>">NUEVA SEDE</h3> 
                </div>

                <div class="modal-body" id="body" >
                  <div id="_MSG_"></div>
                  <div class="form-group">
                    <label class="sr-only" for="form-first-name"></label>
                    <input type="text" name="Sede" placeholder="Sede..." class="form-first-name form-control" id="Sede" maxlength="25"  required="">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="form-last-name">Codigo</label>
                    <input type="text" name="Codigo" placeholder="Codigo..." class="form-last-name form-control" id="Codigo"  maxlength="15"  required="">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="form-email">Telefono</label>
                    <input type="text" name="Telefono" placeholder="Telefono..." class="form-email form-control" id="Telefono" maxlength="7">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="form-last-name">Direccion</label>
                    <input type="text" name="Direccion" placeholder="Direccion..." class="form-last-name form-control" id="Direccion" maxlength="20">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="form-last-name">Barrio</label>
                    <input type="text" name="Barrio" id="Barrio" placeholder="Barrio..." class="form-last-name form-control"    required="">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="form-email">Dane</label>
                    <input type="text" name="Dane" placeholder="Dane..." class="form-email form-control" id="Dane"   maxlength="20"  >
                  </div>

                  <button type="button" name="registro" id="btn1"  onclick="nuevv()" class="btn">Registrar</button>

                </div>

              </div>
            </div></div> </form>

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



 

 <!-- jQuery 3 -->
 <!-- jQuery 3 -->
 
 <script type="text/javascript">

  function mostrar(){
    var sty='<?php echo $sty; ?>';
   $.ajax({   
    type: "post",
    data:{sty}, 
    url:"../../../ajax/rector/sedes/sedes.php?action=tabla",
    dataType:"text", 

    success:function(data){  
      $('#tabla').html(data); 
    }  
  }); 
}
  var Codigo = document.getElementById("Codigo");
  Codigo.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      document.getElementById("btn1").click();
    }
  });
  var Sede = document.getElementById("Sede");
  Sede.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      document.getElementById("btn1").click();
    }
  });
  var Telefono = document.getElementById("Telefono");
  Telefono.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      document.getElementById("btn1").click();
    }
  });
  var Direccion = document.getElementById("Direccion");
  Direccion.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      document.getElementById("btn1").click();
    }
  });
  var Barrio = document.getElementById("Barrio");
  Barrio.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      document.getElementById("btn1").click();
    }
  });
  var Dane = document.getElementById("Dane");
  Dane.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      document.getElementById("btn1").click();
    }
  });
  function nuevv(){ 
    var Codigo=document.getElementById("Codigo").value;
    var Sede=document.getElementById("Sede").value;
    var Telefono=document.getElementById("Telefono").value;
    var Direccion=document.getElementById("Direccion").value;
    var Barrio=document.getElementById("Barrio").value;
    var Dane=document.getElementById("Dane").value;
    if (Sede=='') { 
      mensaje(2,"Ingrese el nombre de la sede");

      document.getElementById("Sede").focus();
      return false;
    }
    if(ESnombre(Sede)){
      mensaje(2,"El nombre de la sede  no permite numeros");
      document.getElementById("Sede").value='';
      document.getElementById("Sede").focus();
      return false;
    } 
    
    if (Codigo=='') { 
      mensaje(2,"Ingrese un Codigo");

      document.getElementById("Codigo").focus();
      return false;
    }
    if (Telefono=='') { 
      mensaje(2,"Ingrese un  numero de telefono");

      document.getElementById("Telefono").focus();
      return false;
    }
    if(te(Telefono)){
      mensaje(2,"El campo del Telefono solo permite siete numeros");
      document.getElementById("Telefono").value='';
      document.getElementById("Telefono").focus();
      return false;
    }   

    if (Direccion=='') { 
      mensaje(2,"Ingrese la Direccion de la sede");

      document.getElementById("Direccion").focus();
      return false;
    }
    if (Barrio=='') { 
      mensaje(2,"Ingrese el nombre del barrio");

      document.getElementById("Barrio").focus();
      return false;
    } 
    if(ESnumeros(Dane)){ 
      mensaje(2,"El campo del Dane no permite letras");
      document.getElementById("Dane").value='';
      document.getElementById("Dane").focus();
      return false;
    }else{ 
      $.ajax({

        type: "post",
        url:"../../../ajax/rector/sedes/sedes.php?action=agregar",
        data: {Dane,Direccion,Sede,Barrio,Codigo,Telefono},
        dataType: 'text',
        success: function(data)
        { 
          $('#_MSG_').html(data);       mostrar();

        }
      });
    }
  }

 

   function myFunction3(io){ 


    $.ajax({
      type: "post",

      url:"../../../ajax/rector/sedes/sedes.php?action=elimiario", 
      data: {io},
      dataType:"text", 
      success: function(data)
      {    

        $('#_MSG2_').html(data);
    
      
      }
    });
  }

  for (var i=0; i < 100; i++) {   




   function myFunction(i) {

    var dato=document.getElementById("fname").value;

    var mySelect=document.getElementById("mySelect").value;

    var sty='<?php echo $sty; ?>';

    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/sedes/sedes.php?action=tabla",

      data:{i,dato,mySelect,sty},    dataType:"text", 

      success:function(data){  
        $('#tabla').html(data); 


      }  


    });  



  }



}



$(document).ready(function(){  


  function mostrar(){

    var sty='<?php echo $sty ?>';
   $.ajax({   
    data:{sty}, 
    type: "post",
    url:"../../../ajax/rector/sedes/sedes.php?action=tabla",
    dataType:"text", 

    success:function(data){  
      $('#tabla').html(data);

    }  
  }); 
}

   



   $(document).on("submit", "#eliminis", function(e){
    e.preventDefault();  
    $.ajax({

      type: "post",
    url:"../../../ajax/rector/sedes/sedes.php?action=eliminis", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 

        $('#_MSG2_').html(data); 
       setTimeout(myFunction, 3000)

      }
    });
  });
 
   mostrar();  






 });




</script>
<?php 
include('../enlaces/footer.php');  ?>