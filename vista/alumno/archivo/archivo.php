<?php
session_start();
 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../../login.php");
    }
include  "../../../codes/alumno/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']); 

        $p=$_SESSION['numero'];
 
    if (isset($_GET['p'])) {
        $p=$_GET['p'];
    }

$guia=$chat->guias();
 
 
include('../enlaces/head.php');
 
?>

 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
<style>

 
[data-title] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 

}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;

  bottom: -13px;
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
  bottom: 3px;
  left: 6px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}
 
.im{
    margin-top: -23px;
}
    
    body::-webkit-scrollbar{
width: 0px;


    }

    tr:hover {
    border:solid  2px  #DDD ;

}


    .bin::-webkit-scrollbar{
width: 6px;


    }
    .bin::-webkit-scrollbar-thumb{
    border-radius: 7px;
    background-color: #3c8dbc;


    }
</style>

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
 
    <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper">  
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade in" id="mymodal5" style="background-color: rgba(3, 64, 95, 0.3);padding-right: 22px;">
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><strong>Actualizar</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 3px">
                                        <strong>Descripción</strong><br>
                                        <textarea disabled type="" class="form-control" name="" id="nombre"></textarea><br>
                                        <strong>Fecha de creación</strong><br>
                                        <input disabled type="date" class="form-control" name="" id="cre"><br>
                                        <strong>Fecha de presentación</strong><br>
                                        <input disabled type="date" class="form-control" name="" id="pres"><br>
                                        <strong>Periodo</strong><br>
                                        <input disabled type="" class="form-control" name="" id="p"><br><br>
                                        <iframe  id="enlace" style="width:100%;height: 400px" frameborder="0"></iframe>
                                    </div>
                                    
                                   
                                </div>
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <button type="button" id='iss' style="background-color:transparent;border:0"  data-toggle="modal" data-target="#myModal"  > </button>
                    <div class="modal fade" id="myModal" role="dialog"        >
                        <div class="modal-dialog modal-lg"style=" background-color: #f39c12 ">
                            <div class="modal-content"style=" background-color: #f39c12 ">
                                <div class="modal-body" style="color: #fff"><button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Alerta</h4>
                                    <p id="ph"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                                            
                    <div id="tablaw"></div>
                    <section class="content">
                        <div class="row"><div id="sapo"></div>
                            <div class="col-md-3">
                                 <div class="box box-info"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <div style="padding: 10px;">
                                    
                                        <strong>Sede:</strong>
                                        <input disabled style="margin-bottom: 10px" type="" class="form-control" value="<?php echo $_SESSION['sede']  ?>"  name="">  
                                        <strong>Jornada:</strong>
                                        <input disabled style="margin-bottom: 10px" type="" class="form-control" value="<?php echo $_SESSION['jornada']  ?>"  name="">  
                                        <strong>Curso:</strong>
                                        <input disabled style="margin-bottom: 10px" type="" class="form-control" value="<?php echo $_SESSION['grado'].' '.$_SESSION['curso']  ?>"  name="">

                                        <strong>Periodo:</strong>
                                        <select id="periodo" class="form-control" disabled>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select> 
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-9"style="">
                                <div id="_MSG2_"></div>
                                <div class="box box-primary bin" style=" height: 462px;overflow: auto;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                                           
                                         
                                    <div class="table table-responsive" style="  padding: 10px">
                                        <table  class="table table-hover" id="ver_tabla"  >
                                            <tr>
                                                <th >AREAS</th>
                                                <th>DESCRIPCIÓN</th> 
                                                <th>MOSTRAR</th> 
                                                <th>DESCARGA</th> 
                                            </tr>
                                            <?php 
                                            $control=0;
                                            foreach($guia as $key) { 
                                            $control=$control+1; ?>
                                                <tr>
                                                    <td  ><?php echo $key['area'] ?></td> 
                                                    <td  ><?php echo $key['nombre'] ?></td> 
                                                    <td  >
                                                        <a onclick=" 
                                                        document.getElementById('nombre').value='<?php echo  $key['nombre'] ?>';
                                                        document.getElementById('p').value='<?php echo  $key['id_periodo'] ?>';
                                                        document.getElementById('cre').value='<?php echo  $key['fecha_registro'] ?>';
                                                        document.getElementById('pres').value='<?php echo  $key['fecha_presentacion'] ?>';
                                                        document.getElementById('enlace').src='../../../guias/<?php echo  $key['guia'] ?>';"    data-toggle="modal" data-target="#mymodal5" data-title="Mostrar documento">
                                                            <img class="im" width="30"  src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGc+PGc+PGNpcmNsZSBjeD0iMjU2IiBjeT0iMjU2IiBmaWxsPSIjZTdlN2U4IiByPSIyNTYiLz48L2c+PGc+PGc+PHBhdGggZD0ibTU1LjAxMiA0MTQuNTYxYzEyLjQzNyAxNS43NDMgMjYuNjgzIDI5Ljk5IDQyLjQyNiA0Mi40MjdsMTE1LjU2Ni0xMTUuNTY2LTQyLjQyNi00Mi40Mjd6IiBmaWxsPSIjMTMyZjNiIi8+PC9nPjxnPjxwYXRoIGQ9Im0xNzAuNTc5IDI5OC45OTUtMTE1LjU2NyAxMTUuNTY2YzYuMjE5IDcuODcyIDEyLjg4NCAxNS4zNzQgMTkuOTY4IDIyLjQ1OGwxMTYuODExLTExNi44MTF6IiBmaWxsPSIjMGExODFlIi8+PC9nPjxnPjxwYXRoIGQ9Im0xOTguODYzIDM2OS43MDYtNTYuNTY5LTU2LjU2OWMtMy45MDUtMy45MDUtMTAuMjM3LTMuOTA1LTE0LjE0MiAwbC0yOC4yODQgMjguMjg0Yy0zLjkwNSAzLjkwNS0zLjkwNSAxMC4yMzcgMCAxNC4xNDJsNTYuNTY5IDU2LjU2OWMzLjkwNSAzLjkwNSAxMC4yMzcgMy45MDUgMTQuMTQyIDBsMjguMjg0LTI4LjI4NGMzLjkwNS0zLjkwNSAzLjkwNS0xMC4yMzcgMC0xNC4xNDJ6IiBmaWxsPSIjZmZhYTRmIi8+PC9nPjxnPjxwYXRoIGQ9Im0xMjguMTUyIDM2OS43MDYgMjguMjg0LTI4LjI4NGMzLjkwNS0zLjkwNSAxMC4yMzctMy45MDUgMTQuMTQyIDBsLTI4LjI4NC0yOC4yODRjLTMuOTA1LTMuOTA1LTEwLjIzNy0zLjkwNS0xNC4xNDIgMGwtMjguMjg0IDI4LjI4NGMtMy45MDUgMy45MDUtMy45MDUgMTAuMjM3IDAgMTQuMTQybDI4LjI4NCAyOC4yODRjLTMuOTA1LTMuOTA1LTMuOTA1LTEwLjIzNyAwLTE0LjE0MnoiIGZpbGw9IiNmZjcyNDciLz48L2c+PGc+PHBhdGggZD0ibTIyOC45MTUgMzU3LjMzMS03NC4yNDYtNzQuMjQ2Yy0zLjkwNS0zLjkwNS0xMC4yMzctMy45MDUtMTQuMTQyIDBsLTI4LjI4NCAyOC4yODRjLTMuOTA1IDMuOTA1LTMuOTA1IDEwLjIzNyAwIDE0LjE0Mmw3NC4yNDYgNzQuMjQ2YzMuOTA1IDMuOTA1IDEwLjIzNyAzLjkwNSAxNC4xNDIgMGwyOC4yODQtMjguMjg0YzMuOTA1LTMuOTA1IDMuOTA1LTEwLjIzNiAwLTE0LjE0MnoiIGZpbGw9IiNmZmUxNTciLz48L2c+PGc+PHBhdGggZD0ibTE0MC41MjcgMzM5LjY1NCAyOC4yODQtMjguMjg0YzMuOTA1LTMuOTA1IDEwLjIzNy0zLjkwNSAxNC4xNDIgMGwtMjguMjg0LTI4LjI4NGMtMy45MDUtMy45MDUtMTAuMjM3LTMuOTA1LTE0LjE0MiAwbC0yOC4yODQgMjguMjg0Yy0zLjkwNSAzLjkwNS0zLjkwNSAxMC4yMzcgMCAxNC4xNDJsMjguMjg0IDI4LjI4NGMtMy45MDYtMy45MDUtMy45MDYtMTAuMjM3IDAtMTQuMTQyeiIgZmlsbD0iI2ZmYWE0ZiIvPjwvZz48Zz48Y2lyY2xlIGN4PSIzMTIiIGN5PSIyMDAiIGZpbGw9IiMxMzJmM2IiIHI9IjIwMCIvPjwvZz48Zz48Y2lyY2xlIGN4PSIzMTIiIGN5PSIyMDAiIGZpbGw9IiM0YmJhZWQiIHI9IjE3MCIvPjwvZz48Zz48Zz48cGF0aCBkPSJtMzEyIDEyMC4xNjhjLTY3LjIxNyAwLTEyMS43MDYgNzkuODMyLTEyMS43MDYgNzkuODMyczU0LjQ5IDc5LjgzMiAxMjEuNzA2IDc5LjgzMiAxMjEuNzA2LTc5LjgzMiAxMjEuNzA2LTc5LjgzMi01NC40ODktNzkuODMyLTEyMS43MDYtNzkuODMyeiIgZmlsbD0iI2VmZWZmMCIvPjwvZz48Zz48cGF0aCBkPSJtMzIzLjEyNCAxMjAuODk4Yy0zLjY2NC0uNDY5LTcuMzczLS43MzEtMTEuMTI0LS43MzEtNjcuMjE3IDAtMTIxLjcwNiA3OS44MzItMTIxLjcwNiA3OS44MzJzNTQuNDkgNzkuODMyIDEyMS43MDYgNzkuODMyYzMuNzUxIDAgNy40NTktLjI2MSAxMS4xMjQtLjczMS05MS4yMzItMTEuNTEyLTkxLjIzMi0xNDYuNjg4IDAtMTU4LjIwMnoiIGZpbGw9IiNlN2U3ZTgiLz48L2c+PGc+PGNpcmNsZSBjeD0iMzEyIiBjeT0iMjAwIiBmaWxsPSIjMTMyZjNiIiByPSI1Ny4zMDMiLz48L2c+PGc+PHBhdGggZD0ibTI4MC42MzMgMjAwYzAtMjcuMTg4IDE4LjkzNC00OS45NTMgNDQuMzM1LTU1LjgyOS00LjE2Ny0uOTY0LTguNTA4LTEuNDc0LTEyLjk2OC0xLjQ3NC0zMS42NDcgMC01Ny4zMDIgMjUuNjU1LTU3LjMwMiA1Ny4zMDNzMjUuNjU1IDU3LjMwMyA1Ny4zMDIgNTcuMzAzYzQuNDYgMCA4LjgwMS0uNTEgMTIuOTY4LTEuNDc0LTI1LjQwMS01Ljg3Ni00NC4zMzUtMjguNjQxLTQ0LjMzNS01NS44Mjl6IiBmaWxsPSIjMGExODFlIi8+PC9nPjwvZz48Zz48cGF0aCBkPSJtMjIwLjA3NiAxMDguMDc2YzYxLjQ5OS02MS40OTggMTU4Ljc3NC02NS45MjYgMjI1LjQzOC0xMy4zMDYtNC4wOTQtNS4xODctOC41MjItMTAuMTk0LTEzLjMwNi0xNC45NzgtNjYuMjgzLTY2LjI4My0xNzQuMTMzLTY2LjI4My0yNDAuNDE2IDBzLTY2LjI4MyAxNzQuMTMzIDAgMjQwLjQxNmM0Ljc4NSA0Ljc4NSA5Ljc5MiA5LjIxMiAxNC45NzggMTMuMzA2LTUyLjYyLTY2LjY2NC00OC4xOTItMTYzLjkzOSAxMy4zMDYtMjI1LjQzOHoiIGZpbGw9IiMzOWFhZGUiLz48L2c+PC9nPjwvZz48L3N2Zz4=" />
                                                        </a>
                                                    </td>
                                                    <td  >
                                                        <a target="_blank" href="../../../guias/<?php echo  $key['guia'] ?>" data-title="Descargar documento">
                                                            <img class="im"   width="30" src="data:image/svg+xml;base64,PHN2ZyBpZD0iY29sb3IiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI0IDI0IiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDI0IDI0IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0xMiAwYy02LjYxNyAwLTEyIDUuMzgzLTEyIDEyczUuMzgzIDEyIDEyIDEyIDEyLTUuMzgzIDEyLTEyLTUuMzgzLTEyLTEyLTEyeiIgZmlsbD0iIzAwYmNkNCIvPjxwYXRoIGQ9Im03IDE5aDEwYy41NTMgMCAxLS40NDggMS0xcy0uNDQ3LTEtMS0xaC0xMGMtLjU1MyAwLTEgLjQ0OC0xIDFzLjQ0NyAxIDEgMXoiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMTEuNDcgMTQuNzhjLjE0Ni4xNDcuMzM4LjIyLjUzLjIycy4zODQtLjA3My41My0uMjJsMy4yNS0zLjI1Yy40NzItLjQ3LjEzOS0xLjI4LS41My0xLjI4aC0yLjI1di00LjVjMC0uNTUyLS40NDctMS0xLTFzLTEgLjQ0OC0xIDF2NC41aC0yLjI1Yy0uNjY5IDAtMS4wMDIuODEtLjUzIDEuMjh6IiBmaWxsPSIjZmZmIi8+PHBhdGggZD0ibTEyIDBjLTYuNjE3IDAtMTIgNS4zODMtMTIgMTJzNS4zODMgMTIgMTIgMTJ2LTVoLTVjLS41NTMgMC0xLS40NDgtMS0xcy40NDctMSAxLTFoNXYtMmMtLjE5MiAwLS4zODQtLjA3My0uNTMtLjIybC0zLjI1LTMuMjVjLS40NzItLjQ3LS4xMzktMS4yOC41My0xLjI4aDIuMjV2LTQuNWMwLS41NTIuNDQ3LTEgMS0xeiIgZmlsbD0iIzAwYTRiOSIvPjxnIGZpbGw9IiNkZWRlZGUiPjxwYXRoIGQ9Im0xMiAxN2gtNWMtLjU1MyAwLTEgLjQ0OC0xIDFzLjQ0NyAxIDEgMWg1eiIvPjxwYXRoIGQ9Im0xMiA0Ljc1Yy0uNTUzIDAtMSAuNDQ4LTEgMXY0LjVoLTIuMjVjLS42NjkgMC0xLjAwMi44MS0uNTMgMS4yOGwzLjI1IDMuMjVjLjE0Ni4xNDcuMzM4LjIyLjUzLjIyeiIvPjwvZz48L3N2Zz4=" />
                                                        </a>
                                                    </td>   
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <?php  
                                        if ($control==0) {
                                            ?>
                                            <style>
                                                #ver_tabla{
                                                    display: none;
                                                }
                                            </style>
                                            <div class="callout callout-info">
                                                <h4>información!</h4>
                                                 Actualmente no tienes guias registrado 
                                            </div>
                                            <?php  
                                        } ?>
                                        
                                    </div>
                                    </div>
                                </div>
                        </div>
 
                                 
                             
                        </div>
                    </section>
                </div>
            </div> <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer>
        </div> 
       
    </div>

     <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 
<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
    
</body> 