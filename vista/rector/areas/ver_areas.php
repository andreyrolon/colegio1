


  <?php 
   session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); 
    }

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
          <div class="col-md-1">

            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">






            <div class="box box-primary">
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

            <div id="_MSG_"></div>


 

<form method="post">
                      <div class="modal fade" id="myModal" role="dialog">
                       <div class="modal-dialog">
                        <div class="modal-content" id="cotent">
                          <div class="modal-header" id="header" style="">
                            <button type="button" class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <h3 class="modal-title" id="modal-register-label">NUEVA AREA</h3> 
                          </div>

                          <div class="modal-body" id="body" >
                            <div id="_MSG2_"></div>
                           <div class="form-group">
                            <label class="sr-only" for="form-first-name"></label>
                            <input type="text" name="area" placeholder="Area..." class="form-first-name form-control" id="area"  pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"  required="">
                          </div>

                          <div class="form-group">
                            <label class="sr-only" for="form-email"></label>
                            <input type="text" id="codigo" name="codigo" placeholder="Codigo..." class="form-email form-control"  minlength="2" maxlength="3" required="">

                            <input type="hidden" name="t" value="1"  >
                          </div> 
                          <div class="form-group">
                            <label class="sr-only" for="form-last-name"></label>
 
                             <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion..." class="form-email form-control"   required=""    style="height: 80px">
                          </div>
                          <button type="button" name="registro" id="registro" class="btn btn-danger" style="width: 100%;font-size: 20px">Registrar</button>
                         </div>
                     </div>
                 </div>
             </div>
         </form>

              

    
            <div id="tabla" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
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

   <!-- jQuery 3 -->
   <!-- jQuery 3 -->



   

   <!-- jQuery 3 -->
   <!-- jQuery 3 -->
   
   <script type="text/javascript">


var ere = document.getElementById("area");
ere.addEventListener("keyup", function(event) {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("registro").click();
  }
});
var input = document.getElementById("codigo");
input.addEventListener("keyup", function(event) {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("registro").click();
  }
});
var input2 = document.getElementById("descripcion");
input2.addEventListener("keyup", function(event) {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("registro").click();
  }
});

    for (var i=0; i < 100; i++) {   




     function myFunction(i) {

      var dato=document.getElementById("fname").value;

      var mySelect=document.getElementById("mySelect").value;

      $.ajax({  

        type: "post",
        url:"../../../ajax/rector/areas/areas.php?action=tabla",

        data:{i,dato,mySelect},    dataType:"text", 

        success:function(data){  
          $('#tabla').html(data); 


        }  


      });  



    }



  }



  $(document).ready(function(){  

 



    if($("#myModal").hasClass('modal fade in')){
      alert("qwerty");
    }
    function mostrar(){
     $.ajax({   
      type: "post",
      url:"../../../ajax/rector/areas/areas.php?action=tabla",
      dataType:"text", 

      success:function(data){  
        $('#tabla').html(data); 


      }  


    }); }

     

          $( "#registro" ).click(function() {
            var NOMBRE = $("#area").val();
            var CODIGO = $("#codigo").val();
            var descripcion = $("#descripcion").val();
            if (NOMBRE=='') {
              mensaje2(2,"Ingrese el nombre del area");
            document.getElementById("area").focus();
            return false; 
            }
            if(ESnombre(NOMBRE)){
            mensaje2(2,"El nombre del area no permite numeros");
            document.getElementById("area").value='';
            document.getElementById("area").focus();
            return false;

            }

            if(ESnumeros(CODIGO)){
            mensaje2(2,"El codigo del area no permite letras");
            document.getElementById("codigo").value='';
            document.getElementById("codigo").focus();
            return false;
            } 
            if (CODIGO=='') { 
              mensaje2(2,"Ingrese un  codigo");

            document.getElementById("codigo").focus();
            return false;
            }else{ 
              $.ajax({   
                type: "post",
                data:{
                  NOMBRE,
                  CODIGO,
                  descripcion
                },  
                url:"../../../ajax/rector/areas/areas.php?action=nuevo_area",
                dataType:"text", 

                success:function(data){
                  $("#area").val("");
                  $("#codigo").val("");
                  $("#descripcion").val("");
                  mostrar();

                  $('#_MSG2_').html(data);
            document.getElementById("area").focus();
                }  
              });
            }
          });

     mostrar();  






   });




  </script>
  <?php 
     include('../enlaces/footer.php');  ?>