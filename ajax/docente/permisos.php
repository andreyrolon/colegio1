<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
function tabla()
{     

include '../conexion.php';


  if(isset($_POST['dato'])){
   $d=$_POST['dato'];
 }else{
  $d='';
}
if(isset($_POST['i'])){
 $paginaActual = $_POST['i'];
}else{
 $paginaActual=1;
}

if(isset($_POST['id_docente'])){
 $id_docente = $_POST['id_docente'];
}else{
 $id_docente=1;
}


$consultar_nivel="SELECT q.nombre,q.apellido,q.id_docente,q.tipo,q.fecha,q.respuesta,q.soporte,q.tiempo,q.id_admin FROM (SELECT docente.nombre,docente.apellido,permiso_docente.* from docente LEFT JOIN permiso_docente on docente.id_docente=permiso_docente.id_docente WHERE docente.id_docente=$id_docente )as q WHERE q.tipo LIKE '%$d%' or q.fecha like '%$d%' or q.respuesta like '%$d%'";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
 $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}

$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
   $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}


$consultar_nivel="SELECT q.nombre,q.apellido,q.id_docente,q.tipo,q.fecha,q.respuesta,q.soporte,q.tiempo,q.id_admin FROM (SELECT docente.nombre,docente.apellido,permiso_docente.* from docente LEFT JOIN permiso_docente on docente.id_docente=permiso_docente.id_docente WHERE docente.id_docente=$id_docente )as q WHERE q.tipo LIKE '%$d%' or q.fecha like '%$d%' or q.respuesta like '%$d%'  LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="eliminis">
 <div class="box-body no-padding">

  <div class="mailbox-controls">
 
    <!-- Check all button -->
    <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> 
    <div class="btn-group"> 

      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"> <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTI0LDE0LjA1OVY1LjU4NEwxOC40MTQsMEgwdjMyaDI0di0wLjA1OWM0LjQ5OS0wLjUsNy45OTgtNC4zMSw4LTguOTQxICAgIEMzMS45OTgsMTguMzY2LDI4LjQ5OSwxNC41NTYsMjQsMTQuMDU5eiBNMTcuOTk4LDIuNDEzTDIxLjU4Niw2aC0zLjU4OEMxNy45OTgsNiwxNy45OTgsMi40MTMsMTcuOTk4LDIuNDEzeiBNMiwzMFYxLjk5OGgxNCAgICB2Ni4wMDFoNnY2LjA2Yy0xLjc1MiwwLjE5NC0zLjM1MiwwLjg5LTQuNjUyLDEuOTQxSDR2MmgxMS41MTdjLTAuNDEyLDAuNjE2LTAuNzQzLDEuMjg5LTAuOTk0LDJINHYyaDEwLjA1OSAgICBDMTQuMDIyLDIyLjMyOSwxNCwyMi42NjEsMTQsMjNjMCwyLjgyOSwxLjMwOCw1LjM1MiwzLjM1LDdIMnogTTIzLDI5Ljg4M2MtMy44MDEtMC4wMDktNi44NzYtMy4wODQtNi44ODUtNi44ODMgICAgYzAuMDA5LTMuODAxLDMuMDg0LTYuODc2LDYuODg1LTYuODg1YzMuNzk5LDAuMDA5LDYuODc0LDMuMDg0LDYuODgzLDYuODg1QzI5Ljg3NCwyNi43OTksMjYuNzk5LDI5Ljg3NCwyMywyOS44ODN6IiBmaWxsPSIjMDAwMDAwIi8+CgkJPHJlY3QgeD0iNCIgeT0iMTIiIHdpZHRoPSIxNiIgaGVpZ2h0PSIyIiBmaWxsPSIjMDAwMDAwIi8+CgkJPHBvbHlnb24gcG9pbnRzPSIyNC4wMDIsMjIgMjQuMDAyLDE4IDIyLDE4IDIyLDIyIDE4LDIyIDE4LDI0IDIyLDI0IDIyLDI4IDI0LjAwMiwyOCAyNC4wMDIsMjQgMjgsMjQgICAgIDI4LDIyICAgIiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" / style='width: 14px;height: 14px'></button>
      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button> 
      <?php if($paginaActual > 1){
        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
      </div>
      <!-- /.btn-group --> 
      <div class="pull-right">

        <?php 

        $aaa=$registrow+0;
        $aa=$paginaActual+0;
        $g=$aa *$aaa;
        if ($o==0) {
         echo $g .'-'.$paginaActual.'/'. $nroProductos ;
       }else{
        echo $nroProductos;

        echo   '-'.$paginaActual.'/'. $nroProductos ;
      }





      ?>
      <div class="btn-group"> 

        <?php if($paginaActual > 1){
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>

    <div class="table-responsive mailbox-messages" style="
  
  text-align: justify; /* For Edge */
  -moz-text-align-last: left; /* For Firefox prior 58.0 */
  text-align-last: left; ">

     
 <br><table class="table table-striped  table-hover">
      <tr>
      <th width="60">Fecha</th>  

      <th width="50">Tipo</th>

      <th width="50" >Respuesta</th>
      <th width="50">observa</th>

      </tr>  <?php
      foreach ($registro as $registro2) {

        echo'<tr id="fila'.$registro2['id_permiso_docente'].'"> 
        <td>'.$registro2['fecha'].'</td>  

        <td>'.($registro2['tipo']).'</td>

        <td>'.($registro2['respuesta']).'</td>';

      


 

 
         ?> 
<td>

  <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $registro2['id_permiso_docente']?>"><img style="width: 35px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>              
         <div class="modal fade" id="mymodal<?php echo $registro2['id_permiso_docente']?>?>" data-keyboard="true" data-backdrop="false"  backdrop="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> estás seguro de eliminar la sede   ?</p>

              </div>
              <div class="modal-footer">    
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                  id="btn"   onclick="var io= <?php echo($id_sede) ?>; myFunction3(io)">Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>

      </td>








      </tr><?php  
    }
    echo "

";?></table>

   <div class="modal fade" id="may" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> estás seguro de eliminar la sede   ?</p>

              </div>
              <div class="modal-footer">   
                  <input type="hidden" id="elimina" name="docentees" value='<?php echo $id_sede?>'>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit"  value='<?php echo $id_sede?>' class="btn btn-primary"  name="eliminar_sedes" 
                  onclick='
    $("#may").modal({backdrop: false});
    $("#may").modal("hide");'>Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>

    


  </div></form> </div>
 
    <?php

    echo '<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> <ul class="pagination" id="pagination">
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button>'.$lista.'</ul>





    
    ' ;
    ?>
    <script type="text/javascript">
       $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
    </script>
<?php

}


function registro(){
  require '../conexion.php'; 
  $soporte=$_FILES['soporte'];
  if ($soporte=='') {
    $ruta2='';
  }else{ 
    $na=md5($soporte['tmp_name']).$_POST['ad'];
    $ruta2='../../archivo_permiso/'.$na;
    move_uploaded_file($soporte['tmp_name'], $ruta2);
  }
  $consultar_nivel= "INSERT INTO `permiso_docente` (`id_permiso_docente`, `id_docente`, `tipo`, `fecha`, `respuesta`, `motivo del permiso`, `soporte`, `tiempo`, `id_admin`) VALUES (NULL, '".$_POST['id_doci']."', '".$_POST['tipo']."', '".$_POST['fecha']."', 'En espera', '".$_POST['motivo']."', '".$ruta2."', '".$_POST['tiempo'] .' '.$_POST['numero']."', '".$_POST['id_doci']."')"; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}