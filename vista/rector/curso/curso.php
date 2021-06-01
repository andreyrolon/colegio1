 

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
include '../../../codes/rector/curso.php';
$c=new curso(); 


$vec=$c->mostrar();
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
      <div class="row">
        <div class="col-md-1"  >
        </div> 
        <div class="col-md-9">  <br>
          <div class="box box-success" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;" >
        <div class="box-header">
          <h3 class="box-title">Cursos:</h3>
        </div>
          <div class="table-rasponsive">
          <div class="box-body">
            <!-- Date -->
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Identificador</th>
                  <th>Numeros</th>
                  <th>Nombre</th>

                </tr>
              </thead>
              <tbody>
               <?php 

               foreach ($vec as $row) {
                echo '<tr>';
                echo '<td>'. $row['id_curso'] . '</td>';
                echo '<td>'. $row['numero'] . '</td>';
                echo '<td>'. $row['nombre'] . '</td>'; 
                echo '</tr>';
              }

              ?>
            </tbody>
          </table>

          <!-- /.form group -->

        </div>
</div></div></div>
<div class="col-md-1"></div>
 
 
     </div>  
  
</div><footer class="main-footer">
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
