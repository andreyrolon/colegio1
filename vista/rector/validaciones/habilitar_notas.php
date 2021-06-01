

<!-- Google Font -->

<?php
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session']);
    }
     include('../enlaces/head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini"><?php include('../enlaces/header.php'); ?>
<div class=" ">



  <!-- AQUI VA EL CONTENIDO -->

  <div class="content-wrapper">
    <br> 

    <div class="container">

      <div class="row">

        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div class="nav-tabs-custom" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" onclick=" document.getElementById('t1').style.display='block';  document.getElementById('t2').style.display='none';  ver2();     "><strong>Notas</strong></a></li>
              <li><a href="#timeline" data-toggle="tab" onclick=" document.getElementById('t2').style.display='block';document.getElementById('t1').style.display='none';  ver1()"><strong>Recuperacion</strong></a></li> 
            </ul>


              <div class="tab-content table-responsive">
                <div class="active tab-pane" id="activity"> 

                  <form action="post" id="permiso">
                    <div      id="ioi"> 
                    </div>
                  </form>

                  <br>
                </div>


                <div class="tab-pane table-responsive" id="timeline">

                  <form action="post" id="permisos">
                   <div  id="ooo">


                   </div> 
                 </form>
               </div>
              
           </div>
         </div>
       </div>
      </div>
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div class="nav-tabs-custom table-responsive"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><br>
            <strom style='font-size: 25px;margin:50px;font-family: initial;'>Habilitar calificaciones por docentes</strom>
            <hr style="font-family:initial; border-bottom: 5px solid ;border-color: rgba(0, 0, 0, 0.2); ">
            <div class="box-header with-border"id='t1'>
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

            <div class="box-header with-border" style=" display: none;" id='t2'>
             <select id="mySelect1"  onchange="myFunction1(1)">


              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            <div class="box-tools pull-right">
              <div class="has-feedback">
                <input type="text" class="form-control input-sm" id='fname1' placeholder="Search Mail" onkeyup="myFunction1(1)">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
            </div>
            <!-- /.box-tools -->
          </div>
              <div id="docente"></div>
             
          </div>
        </div>
      </div>
   </div> <!-- /container -->

   <!-- ./wrapper -->

   <script type="text/javascript">
    function che(i){
        $.ajax({
            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=permiso_profe", 

      data:{i}, 
            dataType:"text", 
            success: function(data)
            {    

            }
          });
    }
    function noche(i){
        $.ajax({
            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=permiso_profe2", 

      data:{i}, 
            dataType:"text", 
            success: function(data)
            {      
            }
          });
    }
    function notap(i){
        $.ajax({
            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=notap", 

      data:{i}, 
            dataType:"text", 
            success: function(data)
            {    
            }
          });
    }
    function recup(i){
        $.ajax({
            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=recup", 

      data:{i}, 
            dataType:"text", 
            success: function(data)
            {  

            }
          });
    }

     for (var i=0; i < 100; i++) {   




   function myFunction(i) {

    var dato=document.getElementById("fname").value;

    var mySelect=document.getElementById("mySelect").value;

    $.ajax({  

      type: "post", 

        url:"../../../ajax/rector/habilitar/habilitar.php?action=docentes",

      data:{i,dato,mySelect},     
            dataType:"text", 

            success:function(data){  
              $('#docente').html(data); 



      }  


    });  
  }



   function myFunction1(i) {

    var dato=document.getElementById("fname1").value;

    var mySelect=document.getElementById("mySelect1").value;

    $.ajax({  

      type: "post", 

        url:"../../../ajax/rector/habilitar/habilitar.php?action=docentes2",

      data:{i,dato,mySelect},     
            dataType:"text", 

            success:function(data){  
              $('#docente').html(data); 



      }  


    });  
  }
}

function ver1(){
          $.ajax({  

            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=docentes2",
            dataType:"text", 

            success:function(data){  
              $('#docente').html(data); 


            }  


          }); 
        }
function ver2(){
          $.ajax({  

            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=docentes",
            dataType:"text", 

            success:function(data){  
              $('#docente').html(data); 


            }  


          }); 
        }ver2();
 
      $(document).ready(function(){ 


        function mostrar_rn(){
          $.ajax({  

            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=recuperacion",
            dataType:"text", 

            success:function(data){  
              $('#ooo').html(data); 


            }  


          }); 
        }


 
        mostrar_rn();

        function mostrar_pn(){
          $.ajax({  

            type: "post",
            url:"../../../ajax/rector/habilitar/habilitar.php?action=notas",
            dataType:"text", 

            success:function(data){  
              $('#ioi').html(data); 


            }  


          }); 
        }
        mostrar_pn();

    

 



         


      });
    </script>
    <?php include('../enlaces/footer.php'); ?>
