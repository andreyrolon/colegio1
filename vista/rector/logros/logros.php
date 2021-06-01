


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
</style>
  
  
<body class="hold-transition skin-blue sidebar-mini">
 
<?php include('../enlaces/header.php'); ?>
<div class="content-wrapper">
 
    <div class="col-md-3"> <br>
      <form method="post" id="registro">
        <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content" id="cotent">
              <div class="modal-header" id="header" style="">
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title" id="modal-register-label">Nuevo logro</h3> 
              </div>

              <div class="modal-body" id="body" >
                <div id="_MSG_"></div>
                 
                <div class="form-group">
                  <label class="sr-only" for="form-email">Logro</label>
                  <textarea class="form-control" id="logro" name="logro" placeholder="Logro" style="height: 127px"></textarea>
                </div>  
                <input type="hidden" id="tipo"  name="tipo">
                <input type="hidden" id="materia2" name="materia"><input type="hidden" id="grado2" name="grado">
                <button type="submit" name="registro" id="btn1"   class="btn">Registrar</button>

              </div>
            </div>
          </div>
        </div> 
      </form>
      <div class="box box-success"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <form   method="post">
          <div class="box-header with-border"  >
            <h4 class="box-title">Buscar por:</h4>
          </div>
          <div class="box-body">
            <!-- the events -->
            <div id="external-events"> 
              <div id="sapo"></div> 
              <select name="grado" class="form-control select2 " style="width: 100%;"   id="grado"  > 
              </select>
              <br><br> 
              <select name="materia" class="form-control select2 " style="width: 100%;"   id="materia"  > 
              </select><br><br>
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
              </label>

            </div>
            <br><br> 

          </div>
        </form>
      </div>  
    </div> 
<div class="col-md-8">
  <br> 
  <div class="box bo"  id="v" style="display: none; background-color: #ffff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><br><br>
  <div id="_MSG2_"></div>
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
  <div id="koooo"></div> 
</div> 

 
  

    

<?php 
include('../enlaces/footer.php'); ?>
  <script type="text/javascript">

  function clim() {

  
    var materia=document.getElementById("materia").value; 
    var grado=document.getElementById("grado").value; 
    if (grado=='' || materia=='' ) {  
      return;
    }else{ 

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

     $.ajax({   
        type: "post", 
        data:{grado,materia,toa},  
        url:"../../../ajax/seles/seles.php?action=logro",
        dataType:"text", 

        success:function(data){ 
        document.getElementById('v').style.display='block'; 
          $('#koooo').html(data); 


        }  


      });
      } 
    }





    function cambiar(u,ides,n,w){
      $.ajax({  
        type: "post",
        url:"../../../ajax/rector/logros/logros.php?action=actualizar1",
        data:{u,ides,n,w},    
        dataType:"text",
        success:function(data){ 
          $('#_MSG2_').html(data); 
        }  
      });
    }
    


    for (var i =1; i <= 100; i++) {

    function myFunction(i) {
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
      var materia=document.getElementById("materia").value; 
    var grado=document.getElementById("grado").value;
      var dato=document.getElementById("fname").value;  
      var mySelect=document.getElementById("mySelect").value; 
      $.ajax({  
        type: "post",
               url:"../../../ajax/seles/seles.php?action=logro",
        data:{i,dato,mySelect,grado,materia,toa},    
        dataType:"text",
        success:function(data){ 
          $('#koooo').html(data); 
        }  
      });  
    }
  }

    function mostrarr(){
        var materia=document.getElementById("materia").value; 
    var grado=document.getElementById("grado").value;
      var dato=document.getElementById("fname").value;  
      var mySelect=document.getElementById("mySelect").value; 
      i=1;
      $.ajax({  
        type: "post",
               url:"../../../ajax/seles/seles.php?action=logro",
        data:{i,dato,mySelect,grado,materia},    
        dataType:"text",
        success:function(data){  
          $('#koooo').html(data); 
        }  
      });  
    }
    function sasa() {
     
    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({
      
      data:parametros,
      url:"../../../ajax/rector/logros/logros.php?action=eliminar2",
      type:"POST",
      contentType:false,
      processData:false,
      success: function(dataq){
          $('#_MSG2_').html(dataq); 
      }
       });
  }

    function myFunction3i(io){
       
       
          $.ajax({   
            type: "post", 
            data:{io},  
            url:"../../../ajax/rector/logros/logros.php?action=eliminar",
            dataType:"text", 

            success:function(data){  
                 $('#_MSG2_').html(data); 

            }  


          });
    }

    
    $(document).ready(function(){

  






 



$(document).on("submit", "#registro", function(e){
    e.preventDefault();  

    var materia=document.getElementById("materia").value; 
    var grado=document.getElementById("grado").value;

     document.getElementById("materia2").value=materia; 
     document.getElementById("grado2").value=grado;

    var logro=document.getElementById('logro').value;   
    if (logro==''){
      document.getElementById('logro').focus();;
      mensaje(2,'Ingrese un logro');
      return;
    } else{
      $.ajax({

        type: "post",
        url:"../../../ajax/rector/logros/logros.php?action=registro", 
        data: $(this).serialize(),
        dataType:"text", 
        success: function(data)
        { 

          $('#_MSG_').html(data);
        document.getElementById('logro').focus();
        document.getElementById('logro').value=''
 myFunction(1);

        }
      });
    }
   
  });





   $.ajax({   
        type: "post", 
        url:"../../../ajax/seles/seles.php?action=grados", 
        dataType:"text", 

        success:function(data){  
          $('#grado').html(data); 


        }  


      }); 
  
  $("#grado").change(function(){
    var id=document.getElementById("grado").value; 
     $.ajax({   
        type: "post",
        data:{id}, 
        url:"../../../ajax/seles/seles.php?action=materia", 
        dataType:"text", 

        success:function(data){  
          $('#materia').html(data); 


        }  


      }); 
});
    $("#materia").change(function(){

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

    var materia=document.getElementById("materia").value; 
    var materia=document.getElementById("materia").value; 
    var grado=document.getElementById("grado").value; 
     $.ajax({   
        type: "post", 
        data:{grado,materia,toa},  
        url:"../../../ajax/seles/seles.php?action=logro",
        dataType:"text", 

        success:function(data){ 
        document.getElementById('v').style.display='block'; 
          $('#koooo').html(data); 


        }  


      }); 
}); 

 

 
 
 
       });  
 
    </script>




</body>

</html>
 