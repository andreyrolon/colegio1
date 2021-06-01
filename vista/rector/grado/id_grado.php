 
 
<?php include('../enlaces/head.php'); 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include '../../../codes/rector/grado.php';
  $c=new grado(); 


  $vec=$c->consultar_grado();
?>

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
  <div class="container"><br><br>
<div class="box box-success" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;" >
            <div class="box-header">
              <h3 class="box-title">Grados:</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
             <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>IDENTIFICADOR</th>
                      <th>NUMERO</th>
                      <th>NOMBRE</th>
 
                    </tr>
                  </thead>
                  <tbody>
                 <?php 
                       
                       foreach ($vec as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['id_grado'] . '</td>';
                                echo '<td>'. $row['numero'] . '</td>';
                                echo '<td>'. $row['nombre'] . '</td>'; 
                     
                       }
                     
                      ?>
                      </tbody>
                      </table>
         
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
          
              <br><br>

        
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
<?php include '../enlaces/footer.php';?>
</body>
</html>