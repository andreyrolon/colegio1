


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
          <select class="form-control select2" id='sapo'  >
            
          </select> 
         
        </div>
      </div></form>

    </div>
    <br> 
      
  </div> 


   <form method="post" id="nuevo_grado">
            <div class="modal fade" id="nmn" role="dialog">
             <div class="modal-dialog"> 
               <div class="modal-content" id="cotent">

                <div class="modal-header" id="header" style="">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                  </button>
                  <h3 class="modal-title" id="modal-register-label">NUEVA GRADO</h3> 
                </div>

                <div class="modal-body" id="body" >
                  <div id="_MSG_"></div>
                  <div class="form-group">
                    <label class="sr-only" for="form-first-name"></label>
 

                    <select id="grado" name="id_grado" class="form-control select2" style="width: 100%;outline: 0;background: #444;border: 3px solid #555;-moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;"></select>
 
                  </div>

                   <div class="form-group">
                    <label class="sr-only" for="form-first-name"></label>
 

                    <select id="curso" name="id_curso" class="form-control select2" style="width: 100%;outline: 0;background: #444;border: 3px solid #555;-moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;"></select>
 
                  </div> 

    <input type="hidden"   id="jsd" name='id_jornada_sede'> 
                  <button type="submit" name="registro" id="btn1" class="btn"    >Registrar</button>

                </div>

              </div>
            </div></div>  

          </form>
           


<div class="col-md-9">  <br>
<div class="nav-tabs-custom" id="koooo" style="display: none; margin-right: 7px;margin-left: 7px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <br><div id="_MSG4_"></div>
<div id='_MSG2_'></div>
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
  <div id="ol">
    
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
  
<script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>

<?php 
include('../enlaces/footer.php'); ?>
  <script type="text/javascript">
    function eliminarrelacion(id){
      $.ajax({   
        type: "post", 
        data:{id},   

        url:"../../../ajax/rector/grado/grado.php?action=eliminar_curso2",
        dataType:"text", 

        success:function(data){  
          $('#_MSG2_').html(data); 

        }  
      }); 




    }
  $(document).ready(function(){ 
    document.getElementById("sapo").focus();
       $(document).on("submit", "#eliminis", function(e){
    e.preventDefault();  
    $.ajax({

      type: "post",
    url:"../../../ajax/rector/grado/grado.php?action=eliminis8", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 

        $('#_MSG4_').html(data); 

      }
    });
  });
      document.getElementById("koooo").style.display = "none";
      $.ajax({   
        type: "post",  
        url:"../../../ajax/seles/seles.php?action=nuevo_grado",
        dataType:"text", 

        success:function(data){  
          $('#sapo').html(data); 
        }  
      }); 

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
    var id_jornada_sede=document.getElementById("sapo").value;
    var jsd=document.getElementById("jsd").value=id_jornada_sede;
 
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


   $("#sapo").change(function(){
 
      document.getElementById("koooo").style.display = "block";
      var js =document.getElementById("sapo").value;

if (js==''){}
  else{ 
         $.ajax({   
          data:{js}, 
        type: "post", 
        url:"../../../ajax/rector/grado/grado.php?action=tabla", 
        dataType:"text", 

        success:function(data){  
          $('#ol').html(data); 


        }  


      }); 
    }
   

   });
 
$(document).on("submit", "#nuevo_grado", function(e){
      e.preventDefault(); 

      $.ajax({
        type: "post",
        url:"../../../ajax/rector/grado/grado.php?action=nuevo_grado",
        data: $(this).serialize(),
        dataType: 'text',
        success: function(data)
        {  
  var js =document.getElementById("sapo").value;
              $('#_MSG_').html(data); 
          
   grado();    
      $.ajax({   
          data:{js}, 
        type: "post", 
        url:"../../../ajax/rector/grado/grado.php?action=tabla", 
        dataType:"text", 

        success:function(data){  
          $('#ol').html(data); 


        }  


      }); 
   
document.getElementById("grado").focus();
        }
      });
    });
});

      for (var i=0; i < 100; i++) {   




   function myFunction(i) {
var js =document.getElementById("sapo").value;
    var dato=document.getElementById("fname").value;

    var mySelect=document.getElementById("mySelect").value;

    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/grado/grado.php?action=tabla",

      data:{i,dato,mySelect,js},    dataType:"text", 

      success:function(data){  
        $('#ol').html(data); 


      }  


    });  



  }



}





    
    
   

    </script>




</body>

</html>
 