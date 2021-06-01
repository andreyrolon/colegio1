


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
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-3">
            <div id="tablass" style="padding-top: 5px;margin: 5px;  background-color: #fff;border-top: solid 3px #3c8dbc; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <strong style="margin-left: 10px;padding-top: 10px;">Buscar docente:</strong>
              
                <div style="padding: 5px">
                  <?php  include '../../../codes/rector/conexion.php'; 
                  $consultar_nivel="SELECT id_docente,nombre,foto ,apellido from docente WHERE docente.inhabilitado not in('1')";
                  $consultar_nivel1=$conexion->prepare($consultar_nivel);
                  $consultar_nivel1->execute(array());
                  $registro=$consultar_nivel1->fetchAll(); ?>
                 <link rel="stylesheet" href="../../../css/chosen.css">
                  <link rel="stylesheet" href="../../../css/ImageSelect.css">
                 
                <script src="../../../js/chosen.jquery.js"></script>
                <script src="../../../js/ImageSelect.jquery.js"></script>
                  <select id="docente" name="docente" class=" form-control my-select"  onchange="dd()" required    >
                  <option value="">Seleccione un docente</option><?php
                  foreach ($registro as   $value) {
                    ?> 
                      
                 <option data-img-src="<?php echo $value['foto'] ?>" value="<?php echo $value['id_docente'] ?>"> <?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
                    <?php
                  } ?></select><script>
                      
                 
                 $(".my-select").chosen()({
                       placeholder: "Select a state",
                    allowClear: true
                });
                </script> 
                </div>  
                <div id="mostrar" style=" display:  none; padding:10px;padding-bottom: 13px; margin-top: 6px; ">
                  <button style=" width: 100%;" class="btn   btn-danger  ">
                        <img style="width: 27px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDgyLjE0IDQ4Mi4xNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDgyLjE0IDQ4Mi4xNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIGQ9Ik0xNDIuMDI0LDMxMC4xOTRjMC04LjAwNy01LjU1Ni0xMi43ODItMTUuMzU5LTEyLjc4MmMtNC4wMDMsMC02LjcxNCwwLjM5NS04LjEzMiwwLjc3M3YyNS42OSAgIGMxLjY3OSwwLjM3OCwzLjc0MywwLjUwNCw2LjU4OCwwLjUwNEMxMzUuNTcsMzI0LjM3OSwxNDIuMDI0LDMxOS4xLDE0Mi4wMjQsMzEwLjE5NHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTxwYXRoIGQ9Ik0yMDIuNzA5LDI5Ny42ODFjLTQuMzksMC03LjIyNywwLjM3OS04LjkwNSwwLjc3MnY1Ni44OTZjMS42NzksMC4zOTQsNC4zOSwwLjM5NCw2Ljg0MSwwLjM5NCAgIGMxNy44MDksMC4xMjYsMjkuNDI0LTkuNjc3LDI5LjQyNC0zMC40NDlDMjMwLjE5NSwzMDcuMjMxLDIxOS42MTEsMjk3LjY4MSwyMDIuNzA5LDI5Ny42ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8cGF0aCBkPSJNMzE1LjQ1OCwwSDEyMS44MTFjLTI4LjI5LDAtNTEuMzE1LDIzLjA0MS01MS4zMTUsNTEuMzE1djE4OS43NTRoLTUuMDEyYy0xMS40MTgsMC0yMC42NzgsOS4yNTEtMjAuNjc4LDIwLjY3OXYxMjUuNDA0ICAgYzAsMTEuNDI3LDkuMjU5LDIwLjY3NywyMC42NzgsMjAuNjc3aDUuMDEydjIyLjk5NWMwLDI4LjMwNSwyMy4wMjUsNTEuMzE1LDUxLjMxNSw1MS4zMTVoMjY0LjIyMyAgIGMyOC4yNzIsMCw1MS4zLTIzLjAxMSw1MS4zLTUxLjMxNVYxMjEuNDQ5TDMxNS40NTgsMHogTTk5LjA1MywyODQuMzc5YzYuMDYtMS4wMjQsMTQuNTc4LTEuNzk2LDI2LjU3OS0xLjc5NiAgIGMxMi4xMjgsMCwyMC43NzIsMi4zMTUsMjYuNTgsNi45NjVjNS41NDgsNC4zODIsOS4yOTIsMTEuNjE1LDkuMjkyLDIwLjEyN2MwLDguNTEtMi44MzcsMTUuNzQ1LTcuOTk5LDIwLjY0NiAgIGMtNi43MTQsNi4zMi0xNi42NDMsOS4xNTctMjguMjU4LDkuMTU3Yy0yLjU4NSwwLTQuOTAyLTAuMTI4LTYuNzE0LTAuMzc5djMxLjA5Nkg5OS4wNTNWMjg0LjM3OXogTTM4Ni4wMzQsNDUwLjcxM0gxMjEuODExICAgYy0xMC45NTQsMC0xOS44NzQtOC45Mi0xOS44NzQtMTkuODg5di0yMi45OTVoMjQ2LjMxYzExLjQyLDAsMjAuNjc5LTkuMjUsMjAuNjc5LTIwLjY3N1YyNjEuNzQ4ICAgYzAtMTEuNDI4LTkuMjU5LTIwLjY3OS0yMC42NzktMjAuNjc5aC0yNDYuMzFWNTEuMzE1YzAtMTAuOTM4LDguOTIxLTE5Ljg1OCwxOS44NzQtMTkuODU4bDE4MS44OS0wLjE5djY3LjIzMyAgIGMwLDE5LjYzOCwxNS45MzQsMzUuNTg3LDM1LjU4NywzNS41ODdsNjUuODYyLTAuMTg5bDAuNzQxLDI5Ni45MjVDNDA1Ljg5MSw0NDEuNzkzLDM5Ni45ODcsNDUwLjcxMywzODYuMDM0LDQ1MC43MTN6ICAgIE0xNzQuMDY1LDM2OS44MDF2LTg1LjQyMmM3LjIyNS0xLjE1LDE2LjY0Mi0xLjc5NiwyNi41OC0xLjc5NmMxNi41MTYsMCwyNy4yMjYsMi45NjMsMzUuNjE4LDkuMjgyICAgYzkuMDMxLDYuNzE0LDE0LjcwNCwxNy40MTYsMTQuNzA0LDMyLjc4MWMwLDE2LjY0My02LjA2LDI4LjEzMy0xNC40NTMsMzUuMjI0Yy05LjE1Nyw3LjYxMi0yMy4wOTYsMTEuMjIyLTQwLjEyNSwxMS4yMjIgICBDMTg2LjE5MSwzNzEuMDkyLDE3OC45NjYsMzcwLjQ0NiwxNzQuMDY1LDM2OS44MDF6IE0zMTQuODkyLDMxOS4yMjZ2MTUuOTk2aC0zMS4yM3YzNC45NzNoLTE5Ljc0di04Ni45NjZoNTMuMTZ2MTYuMTIyaC0zMy40MiAgIHYxOS44NzVIMzE0Ljg5MnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+"> Descargar horario
                      </button>
                </div>  
            </div><br><br>
          </div>
          <!-- /.col -->
          <div class="col-md-9">




 

    
            <div id="tabla" style=""> 
            </div>

          
   
   






          </div>

        </div>
        <div class="col-md-12" style="padding: 30px" >
          <div id="table">
            
          </div>
        </div>
        <!-- /. box -->
     
    <!-- /.row -->
  </div>
  <!-- /.content -->
</div>






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



   <!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>
<script type="text/javascript">
    function mostrar1(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
 
  function tas(){
    mostrar1();
    $.ajax({   
      type: "post",
      url:"../../../ajax/seles/seles.php?action=sele_docente2",
      dataType:"text",
      success:function(data){  
         $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#sele').html(data); 
     }  
    });
  }
  tas();
  function tyt(id_docente){
    mostrar1();
     $.ajax({   
      type: "post",
      data:{id_docente},
      url:"../../../ajax/rector/horario.php?action=table",
      dataType:"text",
      success:function(data){  


        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#table').html(data); 
      }  
    });
  }

  function dd(){
    mostrar1();
    var id_docente= document.getElementById('docente').value; 
    $.ajax({   
      type: "post",
      data:{id_docente},
      url:"../../../ajax/rector/horario.php?action=ver_horario_docente",
      dataType:"text",
      success:function(data){  

        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        if (id_docente!='') {
          document.getElementById('mostrar').style.display='block';
          document.getElementById('tabla').style.display='block';
          document.getElementById('table').style.display='block';
        }
        if (id_docente=='') {
          document.getElementById('mostrar').style.display='none';
          document.getElementById('tabla').style.display='none';
          document.getElementById('table').style.display='none';
        }
      
        $('#tabla').html(data); 
        tyt(id_docente);

      }  
    });    
  }
            

</script>
 