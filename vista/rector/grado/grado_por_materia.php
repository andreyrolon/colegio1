


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
    <div class="content-wrapper"> <br><br>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8"  >
          <div class="box box-danger"style="background-color: #fff;padding: 10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <STRONG>CARGAR AREAS  A LOS GRADOS</STRONG><br><br>
            <div id="todo_los_grados" >

            </div><br>
          </div>
        </div>
        <div class="col-md-2">
        </div>
      </div>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer> 
  </div>


    <?php 
    include('../enlaces/footer.php'); ?>


    
  </body>

</html>
<script type="text/javascript">


  $(document).ready(function(){  




   $.ajax({   
    type: "post",
  
    url:"../../../ajax/rector/grado/grado.php?action=todo_los_grados",
    dataType:"text", 

    success:function(data){  
      $('#todo_los_grados').html(data); 


    } 
  });     
 }); 
</script>