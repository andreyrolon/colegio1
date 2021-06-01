 
 
<?php 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include('../enlaces/head.php'); 
include '../../../codes/rector/jornada.php';
  $c=new jornada(); 


  $vec=$c->mostrar();
?>
   <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }  

  if ($sty=='font: 1.856em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;'){

    $style="font-size: 17px;";

  }else{
    $style=$sty;
  } ?>
 
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
<div class="wrapper">

<?php include('../enlaces/header.php'); ?>
  
  <!-- AQUI VA EL CONTENIDO -->
  <div class="content-wrapper">
  <div class="container"><br><br>
<div class="box box-success" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">
            <div class="box-header" style="background-color: #00a65a;color: #fff;">
              <div class="box-title" style="font-size: 26px;margin-left: 9px;">Jornadas:</div>
            </div>
            <div class="box-body">
              <!-- Date -->
             <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Abreviación</th>
 
                    </tr>
                  </thead>
                  <tbody>
                 <?php 
                       
                       foreach ($vec as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['ID_JORNADA'] . '</td>';
                                echo '<td>'. $row['NOMBRE'] . '</td>';
                                echo '<td>'. $row['ABREVIACION'] . '</td>';
                                echo '<td width=250>';
                    
                                echo '</td>';
                                echo '</tr>';
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
<footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer> 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php include '../enlaces/footer.php';?>
</body>
</html>
