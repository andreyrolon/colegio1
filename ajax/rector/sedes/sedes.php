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

include '../../conexion.php';


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


$consultar_nivel="SELECT * from sede   where NOMBRE like('%$d%') and inhabilitar=0 ORDER by sede.ID_SEDE DESC   ";
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


$consultar_nivel="SELECT * from sede  where sede.NOMBRE like('%$d%%') and inhabilitar=0 ORDER by sede.ID_SEDE DESC  LIMIT $limit, $nroLotes ";
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
    <br>
    <table class="table table-striped  table-hover">
      <tr>
        <th width="50">#</th>
          <th width="50">Id</th> 
          <th width="60">Nombre</th>  

          <th width="50">Telefono</th>

          <th width="50" >Jornada</th>
          <th width="50">Actualizar</th>
          <th width=50>Grados</th>
          <th width="50">Eliminar</th>

          </tr>  <?php
          foreach ($registro as $registro2) {

            echo'<tr id="fila'.$registro2['ID_SEDE'].'">
            <td>

            <input class="sss" type="checkbox" name="id[]" value="'.$registro2['ID_SEDE'].'"></td> 
            <td>'.($registro2['ID_SEDE']).'</td>
            <td>'.$registro2['NOMBRE'].'</td>  



            <td>'.($registro2['TELEFONO']).'</td>';






            echo ' <td>'; 
            $id_sede=$registro2['ID_SEDE'];
            $consultar_nivel="SELECT jornada.NOMBRE  FROM jornada,jornada_sede WHERE jornada.ID_JORNADA=jornada_sede.ID_JORNADA  and inhabilitar=0 AND jornada_sede.ID_SEDE=".$id_sede;
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());
            $registro=$consultar_nivel1->fetchAll();

            $registrow=$consultar_nivel1->rowCount();
            $y=0;
            foreach ($registro as $registro2) {
              echo $registro2['NOMBRE'];
              $y=$y+1;
              if ($y!=$registrow) {
                echo ", ";
              }
            }

            echo ' </td>
            <td>';    ?>  <a href="observar.php?id=<?php echo $id_sede; ?>"  ><img style="width: 40px;height: 40px" src="data:image/svg+xml;base64,
              PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==" /></a>              





            </td>




            <td> <a href="grado.php?id=<?php echo $id_sede; ?>"  ><img width="35" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ5Ni40ODUgNDk2LjQ4NSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjQ4NSA0OTYuNDg1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHJlY3QgeD0iNzMuNjk3IiB5PSIxMS42MzYiIHN0eWxlPSJmaWxsOiMyRUEyREI7IiB3aWR0aD0iMzI1LjgxOCIgaGVpZ2h0PSIzNTkuMTc2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNMzk5LjUxNSwzNzguNTdINzMuNjk3Yy0zLjg3OSwwLTcuNzU4LTMuMTAzLTcuNzU4LTcuNzU4VjExLjYzNmMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICBoMzI1LjgxOGMzLjg3OSwwLDcuNzU4LDMuMTAzLDcuNzU4LDcuNzU4djM1OS4xNzZDNDA3LjI3MywzNzQuNjkxLDQwNC4xNywzNzguNTcsMzk5LjUxNSwzNzguNTd6IE04MS40NTUsMzYzLjA1NWgzMTEuMDc5VjE4LjYxOCAgSDgxLjQ1NVYzNjMuMDU1eiIvPgo8Zz4KCTxyZWN0IHg9IjEwMy45NTIiIHk9IjQxLjExNSIgc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHdpZHRoPSIyNjUuMzA5IiBoZWlnaHQ9IjI5OS40NDIiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDQuOTk0LDExLjYzNmMtMjAuOTQ1LDAtMzcuMjM2LDE2LjI5MS0zNy4yMzYsMzcuMjM2VjMzMi44YzAsMjAuOTQ1LDE3LjA2NywzNy4yMzYsMzcuMjM2LDM3LjIzNiAgIGgyOC43MDN2LTM1OC40SDQ0Ljk5NHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTczLjY5NywzNzguNTdINDQuOTk0QzIwLjE3LDM3OC41NywwLDM1OC40LDAsMzMzLjU3NlY0OC44NzNDMCwyNC4wNDgsMjAuMTcsMy44NzksNDQuOTk0LDMuODc5ICBoMjguNzAzYzMuODc5LDAsNy43NTgsMy4xMDMsNy43NTgsNy43NTh2MzU5LjE3NkM4MS40NTUsMzc0LjY5MSw3OC4zNTIsMzc4LjU3LDczLjY5NywzNzguNTd6IE00NC45OTQsMTguNjE4ICBjLTE2LjI5MSwwLTMwLjI1NSwxMy4xODgtMzAuMjU1LDMwLjI1NVYzMzIuOGMwLDE2LjI5MSwxMy4xODgsMzAuMjU1LDMwLjI1NSwzMC4yNTVoMjEuNzIxVjE4LjYxOEg0NC45OTR6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDUxLjQ5MSwxMS42MzZoLTUxLjJ2MzU5LjE3Nmg1MS4yYzIwLjk0NSwwLDM3LjIzNi0xNy4wNjcsMzcuMjM2LTM3LjIzNlY0OC44NzMgIEM0ODguNzI3LDI3LjkyNyw0NzIuNDM2LDExLjYzNiw0NTEuNDkxLDExLjYzNnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTQ1MS40OTEsMzc4LjU3aC01MS4yYy0zLjg3OSwwLTcuNzU4LTMuMTAzLTcuNzU4LTcuNzU4VjExLjYzNmMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICAgaDUxLjJjMjQuODI0LDAsNDQuOTk0LDIwLjE3LDQ0Ljk5NCw0NC45OTRWMzMyLjhDNDk2LjQ4NSwzNTcuNjI0LDQ3Ni4zMTUsMzc4LjU3LDQ1MS40OTEsMzc4LjU3eiBNNDA3LjI3MywzNjMuMDU1aDQ0LjIxOCAgIGMxNi4yOTEsMCwzMC4yNTUtMTMuMTg4LDMwLjI1NS0zMC4yNTVWNDguODczYzAtMTYuMjkxLTEzLjE4OC0zMC4yNTUtMzAuMjU1LTMwLjI1NWgtNDQuMjE4VjM2My4wNTV6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTQxLjExNSwyMjQuOTdjLTMuODc5LDAtNy43NTgtMy4xMDMtNy43NTgtNy43NTh2LTUxLjk3NmMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICAgYzMuODc5LDAsNy43NTgsMy4xMDMsNy43NTgsNy43NTh2NTEuOTc2QzQ4LjA5NywyMjEuMDkxLDQ0Ljk5NCwyMjQuOTcsNDEuMTE1LDIyNC45N3oiLz4KPC9nPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNFMUU2RTk7IiBjeD0iNDQ0LjUwOSIgY3k9IjE5MC44MzYiIHI9IjIxLjcyMSIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNMTY2LjAxMiwyMDcuOTAzbC02LjIwNiwxNC43MzlIMTQ4LjE3bDI3LjkyNy02Mi44MzZoMTEuNjM2bDI3LjkyNyw2Mi44MzZoLTExLjYzNmwtNi4yMDYtMTQuNzM5ICAgSDE2Ni4wMTJ6IE0xOTMuMTY0LDE5OC41OTRsLTExLjYzNi0yNi4zNzZsLTEwLjg2MSwyNi4zNzZIMTkzLjE2NHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNMjM2LjYwNiwyMDguNjc5di0xNy4wNjdoLTE3LjA2N3YtOC41MzNoMTcuMDY3di0xNy4wNjdoNy43NTh2MTcuMDY3aDE3LjA2N3Y4LjUzM2gtMTcuMDY3djE3LjA2NyAgIEgyMzYuNjA2eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzE5MzY1MTsiIGQ9Ik0zMDIuNTQ1LDIyMi42NDJoLTI3LjkyN3YtNjIuODM2aDI0LjgyNGM0LjY1NSwwLDcuNzU4LDAuNzc2LDEwLjg2MSwxLjU1MiAgIGMzLjEwMywwLjc3Niw1LjQzLDIuMzI3LDYuOTgyLDMuODc5YzMuMTAzLDMuMTAzLDQuNjU1LDYuOTgyLDQuNjU1LDEwLjg2MWMwLDQuNjU1LTEuNTUyLDguNTMzLTQuNjU1LDEwLjg2MSAgIGMtMC43NzYsMC43NzYtMS41NTIsMS41NTItMi4zMjcsMS41NTJjLTAuNzc2LDAtMS41NTIsMC43NzYtMi4zMjcsMC43NzZjMy44NzksMC43NzYsNi45ODIsMi4zMjcsOS4zMDksNS40MyAgIGMyLjMyNywyLjMyNywzLjEwMyw2LjIwNiwzLjEwMywxMC4wODVjMCw0LjY1NS0xLjU1Miw4LjUzMy00LjY1NSwxMS42MzZDMzE3LjI4NSwyMjAuMzE1LDMxMS44NTUsMjIyLjY0MiwzMDIuNTQ1LDIyMi42NDJ6ICAgIE0yODYuMjU1LDE4NS40MDZoMTMuMTg4YzcuNzU4LDAsMTEuNjM2LTIuMzI3LDExLjYzNi03Ljc1OGMwLTMuMTAzLTAuNzc2LTUuNDMtMy4xMDMtNi4yMDZjLTEuNTUyLTEuNTUyLTQuNjU1LTIuMzI3LTguNTMzLTIuMzI3ICAgaC0xMy45NjR2MTYuMjkxSDI4Ni4yNTV6IE0yODYuMjU1LDIxMi41NThoMTYuMjkxYzMuODc5LDAsNi45ODItMC43NzYsOS4zMDktMS41NTJjMi4zMjctMS41NTIsMy4xMDMtMy44NzksMy4xMDMtNi45ODIgICBjMC01LjQzLTQuNjU1LTguNTMzLTEzLjE4OC04LjUzM2gtMTUuNTE1VjIxMi41NTh6Ii8+CjwvZz4KPGc+Cgk8cmVjdCB4PSIxODguNTA5IiB5PSI3OS4xMjciIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiB3aWR0aD0iMTQuNzM5IiBoZWlnaHQ9IjE0LjczOSIvPgoJPHJlY3QgeD0iMjI5LjYyNCIgeT0iNzkuMTI3IiBzdHlsZT0iZmlsbDojMTkzNjUxOyIgd2lkdGg9IjE0LjczOSIgaGVpZ2h0PSIxNC43MzkiLz4KCTxyZWN0IHg9IjI2OS45NjQiIHk9Ijc5LjEyNyIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iMTQuNzM5Ii8+CjwvZz4KPGc+Cgk8cmVjdCB4PSIxODguNTA5IiB5PSIyODcuODA2IiBzdHlsZT0iZmlsbDojMTkzNjUxOyIgd2lkdGg9IjE0LjczOSIgaGVpZ2h0PSIxNC43MzkiLz4KCTxyZWN0IHg9IjIyOS42MjQiIHk9IjI4Ny44MDYiIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiB3aWR0aD0iMTQuNzM5IiBoZWlnaHQ9IjE0LjczOSIvPgoJPHJlY3QgeD0iMjY5Ljk2NCIgeT0iMjg3LjgwNiIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iMTQuNzM5Ii8+CjwvZz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YxNjA1MTsiIHBvaW50cz0iMjcuOTI3LDQ0OC4zODggOTMuODY3LDQ4NC44NDkgOTMuODY3LDQxMS45MjcgIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNOTMuODY3LDQ5Mi42MDZjLTEuNTUyLDAtMi4zMjcsMC0zLjg3OS0wLjc3NkwyNC4wNDgsNDU1LjM3Yy0yLjMyNy0xLjU1Mi0zLjg3OS0zLjg3OS0zLjg3OS02LjIwNiAgYzAtMy4xMDMsMS41NTItNS40MywzLjg3OS02LjIwNmw2NS45MzktMzYuNDYxYzIuMzI3LTEuNTUyLDUuNDMtMS41NTIsNy43NTgsMGMyLjMyNywxLjU1MiwzLjg3OSwzLjg3OSwzLjg3OSw2LjIwNnY3Mi45MjEgIGMwLDIuMzI3LTEuNTUyLDUuNDMtMy44NzksNi4yMDZDOTYuMTk0LDQ5Mi42MDYsOTUuNDE4LDQ5Mi42MDYsOTMuODY3LDQ5Mi42MDZ6IE00My40NDIsNDQ4LjM4OGw0Mi42NjcsMjQuMDQ4di00Ny4zMjEgIEw0My40NDIsNDQ4LjM4OHoiLz4KPHJlY3QgeD0iOTMuODY3IiB5PSI0MTEuOTI3IiBzdHlsZT0iZmlsbDojRkZGRkZGOyIgd2lkdGg9IjM0Mi4xMDkiIGhlaWdodD0iNzIuOTIxIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNNDM1Ljk3Niw0OTIuNjA2SDkzLjg2N2MtMy44NzksMC03Ljc1OC0zLjEwMy03Ljc1OC03Ljc1OHYtNzIuOTIxYzAtMy44NzksMy4xMDMtNy43NTgsNy43NTgtNy43NTggIGgzNDIuMTA5YzMuODc5LDAsNy43NTgsMy4xMDMsNy43NTgsNy43NTh2NzIuOTIxQzQ0My43MzMsNDg5LjUwMyw0MzkuODU1LDQ5Mi42MDYsNDM1Ljk3Niw0OTIuNjA2eiBNMTAxLjYyNCw0NzcuODY3aDMyNy4zNyAgdi01OC4xODJoLTMyNy4zN1Y0NzcuODY3eiIvPgo8cmVjdCB4PSI0MzUuOTc2IiB5PSI0MjcuNDQyIiBzdHlsZT0iZmlsbDojRjE2MDUxOyIgd2lkdGg9IjQ1Ljc3IiBoZWlnaHQ9IjQyLjY2NyIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTQ4MS43NDUsNDc3LjA5MWgtNDUuNzdjLTMuODc5LDAtNy43NTgtMy4xMDMtNy43NTgtNy43NTh2LTQyLjY2N2MwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICBoNDUuNzdjMy44NzksMCw3Ljc1OCwzLjEwMyw3Ljc1OCw3Ljc1OHY0Mi42NjdDNDg5LjUwMyw0NzMuOTg4LDQ4NS42MjQsNDc3LjA5MSw0ODEuNzQ1LDQ3Ny4wOTF6IE00NDMuNzMzLDQ2Mi4zNTJoMzEuMDNWNDM1LjIgIGgtMzEuMDNWNDYyLjM1MnoiLz4KPGc+Cgk8cmVjdCB4PSIxNTUuMTUyIiB5PSI0MzkuODU1IiBzdHlsZT0iZmlsbDojMTkzNjUxOyIgd2lkdGg9IjE0LjczOSIgaGVpZ2h0PSIxNy4wNjciLz4KCTxyZWN0IHg9IjE5NS40OTEiIHk9IjQzOS44NTUiIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiB3aWR0aD0iMTQuNzM5IiBoZWlnaHQ9IjE3LjA2NyIvPgoJPHJlY3QgeD0iMjM2LjYwNiIgeT0iNDM5Ljg1NSIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iMTcuMDY3Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTI3LjkyNyw0NTYuMTQ1SDE0LjczOWMtMy44NzksMC03Ljc1OC0zLjEwMy03Ljc1OC03Ljc1OGMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4aDEyLjQxMiAgIGMzLjg3OSwwLDcuNzU4LDMuMTAzLDcuNzU4LDcuNzU4QzM0LjkwOSw0NTMuMDQyLDMxLjgwNiw0NTYuMTQ1LDI3LjkyNyw0NTYuMTQ1eiIvPgoJPHJlY3QgeD0iMzY2LjkzMyIgeT0iNDExLjkyNyIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iNzIuOTIxIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /></a></td>


            <td>

              <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $id_sede?>"><img style="width: 35px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>              
              <div class="modal fade" id="mymodal<?php echo $id_sede?>" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" style="<?php echo $_POST['sty'] ?>">Confirmación</h4>
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

          <div class="modal fade" id="may" >
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
///tabla de la sedess

//eliminar sede
 function eliminis(){
  date_default_timezone_set("America/Bogota");
  session_start(); 
  $fecha=date("Y-m-d h:i:sa");
  $ano=date('Y');

  if(isset($_POST['id'])){
   $id=$_POST['id'];
  }else{
    $id='';
  }
  $r=0;
  include "../../conexion.php";
  if ($id=='') { ?>
    <script>mensaje2(2," Seleccione una sede ");</script>

    <?php
  }else{ 
    $sum=0;
    foreach ($id as   $eliminar) {
      
      include "../../conexion.php";
      $didi=0;
      $consultar_nivel="SELECT jornada_sede.ID_JS FROM jornada_sede WHERE jornada_sede.ID_SEDE=$eliminar";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      foreach ($consultar_nivel1 as $key) {

        $consultar_nivel="SELECT  informeacademico.id_jornada_sede FROM informeacademico WHERE informeacademico.ano=$ano and informeacademico.id_jornada_sede='".$key['ID_JS']."' group by informeacademico.id_jornada_sede ";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0) {   
          $didi=$didi+1;
        }
      }


      if ($didi>0) {    ?>
        <script>mensaje2(1," actual mente la sede tiene alumnos registrados");</script>

        <?php
      }else{    

        $consultar_nivel="UPDATE `sede` SET `inhabilitar` = '1' WHERE `sede`.`ID_SEDE` = $eliminar";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 

        $consultar_nivel="INSERT INTO `historial_sede` (`id_historial_sede`, `id_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$eliminar."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); $sum=$sum+1;


      }
    }
    if ($sum>0) {
      ?> <script>window.location.assign( window.location.href) ;</script><?php
    }
  }
}
          
function elimiario()
{
  date_default_timezone_set("America/Bogota");
  session_start();
  
  if(isset($_POST['io'])){
   $eliminar=$_POST['io'];
  }else{
    $eliminar='';
  }
  $fecha=date("Y-m-d h:i:sa");
  $ano=date('Y');
  include "../../conexion.php";
  $didi=0;
  $consultar_nivel="SELECT * FROM jornada_sede WHERE jornada_sede.ID_SEDE=$eliminar";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  foreach ($consultar_nivel1 as $key) {

    $consultar_nivel="SELECT * FROM informeacademico WHERE informeacademico.ano=$ano and informeacademico.id_jornada_sede='".$key['ID_JS']."' group by informeacademico.id_jornada_sede ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $consultar_nivel12s=$consultar_nivel1->rowCount();
    if ($consultar_nivel12s>0) {   
      $didi=$didi+1;
    }
  }


   if ($didi>0) {    ?>
      <script>mensaje2(1," actual mente la sede tiene alumnos registrados");</script>

      <?php
    }else{    

      $consultar_nivel="UPDATE `sede` SET `inhabilitar` = '1' WHERE `sede`.`ID_SEDE` = $eliminar";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 

      $consultar_nivel="INSERT INTO `historial_sede` (`id_historial_sede`, `id_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$eliminar."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      ?>
      
        <script>     
          window.location.assign( window.location.href); 
     
        </script>
      <?php

    }



 
}
//fin de eliminar sede

//nueva sede

function agregar(){
  $DANE=$_POST['Dane'];
  $NOMBRE=$_POST['Sede'];
  $CODIGO=$_POST['Codigo'];
  $DIRECCION=$_POST['Barrio'];
  $BARRIO=$_POST['Barrio'];
  $TELEFONO=$_POST['Telefono'];
  include '../../conexion.php';


  $consultar_nivel="SELECT * from sede WHERE sede.NOMBRE in('$NOMBRE') ";
  $s=$consultar_nivel;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $nroProductos=$consultar_nivel1->rowCount();
  if ($nroProductos>0) {
    ?>
    <script type="text/javascript">

      document.getElementById("Sede").focus();
      mensaje(1,'actualmente ya hay una sede con el mismo nombre');
    </script><?php
  }
  $consultar_nivel="SELECT sede.CODIGO from sede WHERE  sede.CODIGO='$CODIGO' ";
  $s=$consultar_nivel;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $nroProductos=$consultar_nivel1->rowCount();
  if ($nroProductos>0) {
    ?>
    <script type="text/javascript">

      document.getElementById("Codigo").value='';
      document.getElementById("Codigo").focus();
      mensaje(1,'actualmente ya hay una sede con el mismo codigo');
    </script><?php
  } else{
    $consultar_nivel="INSERT INTO `sede` (`ID_SEDE`, `NOMBRE`, `CODIGO`, `DIRECCION`, `BARRIO`, `TELEFONO`, `DANE`) VALUES (null,'$NOMBRE','$CODIGO','$DIRECCION','$BARRIO','$TELEFONO','$DANE')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); ?>
    <script type="text/javascript">


          document.getElementById("agregar").reset();
      document.getElementById("Sede").focus();
      mensaje(3,'registro exitoso');
    </script><?php
  }
}

//fin de la nueva sede


//tabla del administrador
function admin(){     
  ?>
     <div  id="yuya">  <?php
    include '../../conexion.php';

    if(isset($_POST['id_js'])){
     $id_js=$_POST['id_js'];
    } 
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
 
    if ($id_js=='rector' or $id_js=='RECTOR' OR $id_js=='Rector') {
     $id_js=1;
    }


    $consultar_nivel="SELECT Q.GENERO,Q.FOTO,Q.ID_ADMIN,Q.NOMBRE,Q.APELLIDO,Q.TIPO_DOCUMENTO,Q.NUMERO_DOCUMENTO,Q.DIRECCION,Q.BARRIO ,Q.INHABILITADO FROM (SELECT administradores.* from administradores RIGHT JOIN(SELECT admin_jornada_sede.id_js,admin_jornada_sede.id_admin FROM admin_jornada_sede WHERE admin_jornada_sede.ID_JS='".$_POST['id_js']."')as d on d.id_admin=administradores.ID_ADMIN WHERE administradores.NOMBRE like('%$d%') or administradores.APELLIDO like('%$d%') or administradores.ROL like('%$d%')
    )AS Q WHERE Q.INHABILITADO=0   ";
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


    $consultar_nivel="SELECT Q.GENERO,Q.FOTO,Q.CELULAR,Q.ROL,Q.ID_ADMIN,Q.NOMBRE,Q.APELLIDO,Q.TIPO_DOCUMENTO,Q.NUMERO_DOCUMENTO,Q.DIRECCION,Q.BARRIO ,Q.INHABILITADO FROM (SELECT administradores.* from administradores RIGHT JOIN(SELECT admin_jornada_sede.id_js,admin_jornada_sede.id_admin FROM admin_jornada_sede WHERE admin_jornada_sede.ID_JS='".$_POST['id_js']."')as d on d.id_admin=administradores.ID_ADMIN WHERE administradores.NOMBRE like('%$d%') or administradores.APELLIDO like('%$d%') or administradores.ROL like('%$d%')
    )AS Q WHERE Q.INHABILITADO=0   LIMIT $limit, $nroLotes  ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $registro=$consultar_nivel1->fetchAll();

    $registrow=$consultar_nivel1->rowCount();
    ?>
    <form method="post">
      <div class="box-body no-padding">

        <div class="mailbox-controls">
          <div class="btn-group">   
            <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
            </button> 
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may1"><i class="fa fa-trash-o"></i>
            </button>
            <?php if($paginaActual > 1){ ?>
              <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button> <?php
            } ?> <?php
            if($paginaActual < $nroPaginas){ ?>
              <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>  <?php
            } ?>
          </div>
     
          <div class="pull-right"> <?php 
            $aaa=$registrow+0;
            $aa=$paginaActual+0;
            $g=$aa *$aaa;
            if ($o==0) {
             echo $g .'-'.$paginaActual.'/'. $nroProductos ;
            }else{
              echo $nroProductos;

              echo   '-'.$paginaActual.'/'. $nroProductos ;
            }  ?>
            <div class="btn-group"> <?php 
              if($paginaActual > 1){ ?>
                <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button> <?php 
              } 
              if($paginaActual < $nroPaginas){ ?>
                <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button><?php
              } ?>
            </div> 
          </div>
        </div>
        <div class="table-responsive mailbox-messages"> 
          <table class="table table-striped table-condensed table-hover">
            <tr>
              <th width="80">#</th>
              <th width="100">Foto</th> 
              <th width="200">Nombre</th>
              <th width="200">Apellido</th>
              <th width="100">Celular</th> 

              <th width="100"><center>Actualizar</center></th>  
              <th width="100"><center>Eliminar</center></th>
            </tr> <?php
            foreach ($registro as $registro2){
              $id_admin=$registro2['ID_ADMIN'];?>
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <img class="profile-user-img img-responsive img-circle" src="<?php
                    if ($registro2['FOTO']!='') {
                     echo  $registro2['FOTO'];
                    } if ($registro2['FOTO']=='' && $registro2['GENERO']=='Masculino') {
                      echo $tytu='../../../logos/masculino.png';
                    }
                    if ($registro2['FOTO']=='' && $registro2['GENERO']=='Femenino') {
                      echo $tytu='../../../logos/femenino.png';
                    } ?>" 
                  > 
                </td> 
                <td><?php echo $registro2['NOMBRE'] ?></td>
                <td> <?php echo $registro2['APELLIDO']?></td> 
                <td><?php echo $registro2['ROL']?>  </td>  
                <td>   
                  <a href="observar_admin.php?id=<?php echo $registro2['ID_ADMIN'] ?>"  > 
                    <img style=" width: 35px;height: 36px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg=="/>

                  </a> 
                </td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $registro2['ID_ADMIN'] ?>">
                    <center>
                      


 

           <img style="width: 25px; " src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">

                    </center>
                  </a>
                </td>
              </tr>





           <div class="modal fade" id="mymodal<?php echo $registro2['ID_ADMIN'] ?>" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Confirmación</h4>
                    </div>
                    <div class="modal-body">
                      <p> estás seguro de eliminar el usuario de  la sede    ?</p>

                    </div>
                    <div class="modal-footer">  
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <input type="hidden" value='<?php echo $value["ID_JORNADA"]?>'  name="Aceptarr">
                      <button type="button" data-dismiss="modal" name="Aceptar" id="dsd" value='<?php echo $value["ID_JORNADA"]?>'  class="btn btn-primary" 
                        onclick="var id=<?php echo $registro2['ID_ADMIN'] ?>;var id1=<?php echo $_POST['id_js']; ?>;   myFunction34(id,id1)">Aceptar</button> 

                    </div>
                  </div>
                </div>
              </div>
              <?php  
            } ?>
          </table></div>
        </div> 
      </form>
          <div class="modal fade" id="may1" data-keyboard="false" data-backdrop="static">
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
                    $("#may1").modal({backdrop: false});
                    $("#may1").modal("hide");'>Aceptar</button> 

                </div>
              </div>
            </div>
          </div>
          <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button> 
          <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may1"><i class="fa fa-trash-o"></i></button> <ul class="pagination" id="pagination"> <?php echo $lista ?></ul>
          <script type="text/javascript">
          function myFunction34(id,id1){

            $.ajax({   
              type: "post", 
              data:{id,id1},
              url:"../../../ajax/rector/sedes/sedes.php?action=eliminar_admin", 
              dataType:"text",
              success:function(data){ 
               var id_js=id1;

               $.ajax({   
                type: "post",

                data:{id_js}, 
                url:"../../../ajax/rector/sedes/sedes.php?action=admin",
                dataType:"text", 

                success:function(data){  
                  $('#admin').html(data); 


                }  


              });
             }
           });





          }




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
</div> 


   <div class="tab-pane" id="sssa"> 
 
          <div class="table table-rasponsibe">
        <table class="table table-hover">
       
            <tr>
              <th>Lunes</th>
              <th>Martes</th>
              <th>Miercoles</th>
              <th>Jueves</th>
              <th>Viernes</th>
              

            </tr>
          
        
            <?php 
            for ($i=1; $i <7 ; $i++) { ?>
              <tr>
                <?php $vect=array('Lunes','Martes','Miercoles','Jueves','Vierenes');
                for ($ie=1; $ie <6 ; $ie++) { 
                     
                      $cons="SELECT a.nombre ,a.id_area_grado_sede ,horario.id_horario from horario INNER JOIN( SELECT area.nombre , are_grado_sede.id_area_grado_sede FROM are_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE are_grado_sede.id_grado_sede='1') as a WHERE horario.id_area_grado_sede=a.id_area_grado_sede AND horario.hora='$i' and horario.dias='$ie'";
                      $cons1=$conexion->prepare($cons);
                      $cons1->execute(array());
                 ?> 
                 <td> <?php $op=''; 
                    foreach ($cons1 as   $value) {
                      $op=$value['nombre'];
                      $uid=$value['id_area_grado_sede'];
                      $id_horario=$value['id_horario'];
                    } 
                    if ($op=='') { ?>

                      <select  class="form-control" data-style="btn-primary"   ><?php
                        $consq="SELECT area.nombre,area.codigo,area.area, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area WHERE are_grado_sede.id_grado_sede='1' GROUP BY area.id_area";
                        $cons1q=$conexion->prepare($consq);
                        $cons1q->execute(array()); 
                        ?> <option value="">SELECCIONE UNA ASIGNATURA</option><?php
                        foreach ($cons1q as $u) {
                          if ($u['area']!=1 || $u['codigo']==01  ) {
                           
                              ?>
                              
                              <option value="<?php echo $u['id_area_grado_sede']; ?>"><?php echo($u['nombre'] ) ?></option>
                              <?php
                             
                          }
                        }?>
                      </select><?php
                       
                    }else{?>  
                      <select  class="form-control" data-style="btn-primary"  "><?php
                        $consq="SELECT area.nombre,area.codigo,area.area, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area WHERE are_grado_sede.id_grado_sede='".$_POST['grado']."' GROUP BY area.id_area";
                        $cons1q=$conexion->prepare($consq);
                        $cons1q->execute(array()); 
                        ?> <option value="<?php echo $uid; ?>"><?php echo($op) ?></option><?php
                        foreach ($cons1q as $u) {
                          if ($u['area']!=1 || $u['codigo']==01  ) {
                            if ( $u['nombre']!=$op) {
                              ?>
                              
                              <option value="<?php echo $u['id_area_grado_sede']; ?>"><?php echo($u['nombre'] ) ?></option>
                              <?php
                            }
                          }
                        }?>
                      </select><?php
                    }   ?>
                   
                 </td>
                 <?php
                }
                 ?>
              </tr><?php
            }
             ?>   </table>
       </div> 
               </div> 
   <div class=" tab-pane" id="menu2">  



            <?php if(isset($_POST['datop'])){
   $d=$_POST['datop'];
 }else{
  $d='';
}
if(isset($_POST['ip'])){
 $paginaActual = $_POST['ip'];
}else{
 $paginaActual=1;
}
if(isset($_POST['id_sede'])){
 $id_sede = $_POST['id_sede'];
}else{
 $id_sede='';
}
if(isset($_POST['id_jornada'])){
 $id_jornada = $_POST['id_jornada'];
}else{
 $id_jornada='';
}



 $consultar_nivel="SELECT q.id_docente,q.dd,q.apellido, q.dd,q.apellido, q.nombre,q.id_area,q.id_area_grado_sede,q.grado,q.curso,q.sede,q.jornada,q.id_grado,q.id_sede,q.id_jornada,q.id_curso,q.id from (SELECT docen.id_docente, docen.nombre as dd,docen.apellido, area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_sede,s.id_jornada,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada where sede.ID_SEDE='$id_sede' AND jornada.ID_JORNADA='$id_jornada')as s INNER JOIN(SELECT docente.* from docente)as docen   on s.id=are_grado_sede.id_grado_sede and docen.id_docente=are_grado_sede.id__docente  )as q
 where q.dd like('%$d%') or q.apellido like('%%')   GROUP by q.id_docente ORDER by q.id_docente DESC";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelectp'])){
 $nroLotes = $_POST['mySelectp'];
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


 $consultar_nivel="SELECT q.id_docente,q.foto,q.dd,q.apellido, q.dd,q.apellido, q.nombre,q.id_area,q.id_area_grado_sede,q.grado,q.curso,q.sede,q.jornada,q.id_grado,q.id_sede,q.id_jornada,q.id_curso,q.id from (SELECT docen.foto, docen.id_docente, docen.nombre as dd,docen.apellido, area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_sede,s.id_jornada,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada where sede.ID_SEDE='$id_sede' AND jornada.ID_JORNADA='$id_jornada')as s INNER JOIN(SELECT docente.* from docente)as docen   on s.id=are_grado_sede.id_grado_sede and docen.id_docente=are_grado_sede.id__docente  )as q
 where q.dd like('%$d%') or q.apellido like('%%')   GROUP by q.id_docente ORDER by q.id_docente DESC LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>
<form method="post">
 <div class="box-body no-padding">

  <div class="mailbox-controls">

    <!-- Check all button -->
   
    <div class="btn-group"> 
      
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

    <div class="table-responsive mailbox-messages">

     

    <br><table class="table table-striped table-condensed table-hover">
      <tr>  
      <th width="100">Foto</th>
      <th width="200">Nombre</th>
      <th width="200">Apellido</th>  
  
      <th width="300">Cursos</th>
      <th width="50">Actualizar</th>

      </tr>  <?php
      foreach ($registro as $registro2) { ?>
        <tr>
        
        <td><img class="profile-user-img img-responsive img-circle" src=" <?php echo $registro2['foto']?>"></td>
        
        <td style="font-size: 17px"><?php echo $registro2['dd'] ?></td> 
        <td style="font-size: 17px"> <?php echo $registro2['apellido'] ?></td> 
        <td><?php
          $consultar_nivel="SELECT q.id_docente,q.dd,q.apellido, q.dd,q.apellido, q.nombre,q.id_area,q.id_area_grado_sede,q.grado,q.curso,q.sede,q.jornada,q.id_grado,q.id_sede,q.id_jornada,q.id_curso,q.id from (SELECT docen.id_docente, docen.nombre as dd,docen.apellido, area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_sede,s.id_jornada,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada where sede.ID_SEDE='$id_sede' AND jornada.ID_JORNADA='$id_jornada')as s INNER JOIN(SELECT docente.* from docente)as docen   on s.id=are_grado_sede.id_grado_sede and docen.id_docente=are_grado_sede.id__docente  )as q
           where q.id_docente='".$registro2['id_docente']."'   GROUP by q.id_curso ORDER by q.id_area_grado_sede DESC ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array());
          foreach ($consultar_nivel1 as $key ) {
           echo $key['grado'].$key['curso'].'-'.$key['nombre'].'<br> ';
          }
          ?>
        </td>  
        <td> <center> <a href="observar.php?id=<?php echo $id_sede; ?>"  > <img style=" width: 35px;height: 36px" src="data:image/svg+xml;base64,
        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==" /> </a>   </center>            





      </td>


 





      </tr><?php  
    } ?>
  </table> </div> </div></form>

  <ul class="pagination" id="pagination"> <?php echo $lista ?>'</ul>





    
    ' ;
     


?></div><?php

}
//fin e la tabla admin

//tabla profesor
function eliminar_admin(){
  include '../../conexion.php';
  $consultar_nivel="DELETE FROM `admin_jornada_sede` WHERE `admin_jornada_sede`.`id_admin`='".$_POST['id']."'  and `admin_jornada_sede`.`id_js` = '".$_POST['id1']."'";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
}
function profe(){     

include '../../conexion.php';


  if(isset($_POST['datop'])){
   $d=$_POST['datop'];
 }else{
  $d='';
}
if(isset($_POST['ip'])){
 $paginaActual = $_POST['ip'];
}else{
 $paginaActual=1;
}
if(isset($_POST['id_sede'])){
 $id_sede = $_POST['id_sede'];
}else{
 $id_sede='';
}
if(isset($_POST['id_jornada'])){
 $id_jornada = $_POST['id_jornada'];
}else{
 $id_jornada='';
}



$consultar_nivel="SELECT q.id_docente,q.dd,q.apellido, q.dd,q.apellido, q.nombre,q.id_area,q.id_area_grado_sede,q.grado,q.curso,q.sede,q.jornada,q.id_grado,q.id_sede,q.id_jornada,q.id_curso,q.id from (SELECT docen.id_docente, docen.nombre as dd,docen.apellido, area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_sede,s.id_jornada,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada where sede.ID_SEDE='$id_sede' AND jornada.ID_JORNADA='$id_jornada')as s INNER JOIN(SELECT docente.* from docente)as docen   on s.id=are_grado_sede.id_grado_sede and docen.id_docente=are_grado_sede.id__docente  )as q
 where q.dd like('%$d%') or q.apellido like('%%')   GROUP by q.id_docente ORDER by q.id_docente DESC";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelectp'])){
 $nroLotes = $_POST['mySelectp'];
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


 $consultar_nivel="SELECT q.id_docente,q.foto,q.dd,q.apellido, q.dd,q.apellido, q.nombre,q.id_area,q.id_area_grado_sede,q.grado,q.curso,q.sede,q.jornada,q.id_grado,q.id_sede,q.id_jornada,q.id_curso,q.id from (SELECT docen.foto, docen.id_docente, docen.nombre as dd,docen.apellido, area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_sede,s.id_jornada,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada where sede.ID_SEDE='$id_sede' AND jornada.ID_JORNADA='$id_jornada')as s INNER JOIN(SELECT docente.* from docente)as docen   on s.id=are_grado_sede.id_grado_sede and docen.id_docente=are_grado_sede.id__docente  )as q
 where q.dd like('%$d%') or q.apellido like('%%')   GROUP by q.id_docente ORDER by q.id_docente DESC LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>
<form method="post">
 <div class="box-body no-padding">

  <div class="mailbox-controls">

    <!-- Check all button -->
   
    <div class="btn-group"> 
      
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

    <div class="table-responsive mailbox-messages">

      <?php

      echo '<br><table class="table table-striped table-condensed table-hover">
      <tr>  
      <th width="100">Foto</th>
      <th width="200">Nombre</th>
      <th width="200">Apellido</th>  
  
      <th width="300">Cursos</th>
      <th width="50">Actualizar</th>

      </tr>';
      foreach ($registro as $registro2) {

        echo'<tr>';?>
        
        <td><img class="profile-user-img img-responsive img-circle" src=" <?php echo $registro2['foto']?>"></td>
        
      <td style="font-size: 17px"><?php echo $registro2['dd'] ?></td> 
        <td style="font-size: 17px"> <?php echo $registro2['apellido'] ?></td> 
        <td><?php
$consultar_nivel="SELECT q.id_docente,q.dd,q.apellido, q.dd,q.apellido, q.nombre,q.id_area,q.id_area_grado_sede,q.grado,q.curso,q.sede,q.jornada,q.id_grado,q.id_sede,q.id_jornada,q.id_curso,q.id from (SELECT docen.id_docente, docen.nombre as dd,docen.apellido, area.nombre as nombre,area.id_area ,are_grado_sede.id_area_grado_sede,s.grado,s.curso,s.sede,s.jornada,s.id_grado,s.id_sede,s.id_jornada,s.id_curso,s.id FROM are_grado_sede INNER JOIN area on are_grado_sede.id_area=area.id_area INNER JOIN(SELECT grado.nombre as grado,curso.numero as curso,jornada.NOMBRE as jornada,sede.NOMBRE as sede , grado_sede.* from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada where sede.ID_SEDE='$id_sede' AND jornada.ID_JORNADA='$id_jornada')as s INNER JOIN(SELECT docente.* from docente)as docen   on s.id=are_grado_sede.id_grado_sede and docen.id_docente=are_grado_sede.id__docente  )as q
 where q.id_docente='".$registro2['id_docente']."'   GROUP by q.id_curso ORDER by q.id_area_grado_sede DESC ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
foreach ($consultar_nivel1 as $key ) {
 echo $key['grado'].$key['curso'].'-'.$key['nombre'].'<br> ';
}
?></td>   <?php 
 
      echo '  
      <td>';    ?> <center> <a href="observar.php?id=<?php echo $id_sede; ?>"  > <img style=" width: 35px;height: 36px" src="data:image/svg+xml;base64,
        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==" /> </a>   </center>            





      </td>


 





      </tr><?php  
    }
    echo "</table></form></div></div>";

    echo ' <ul class="pagination" id="pagination"> '.$lista.'</ul>





    
    ' ;
     


}
//fin de la tabla de profesores




 //actualizar datos de la sede


function actualizar(){

 $conexion=new pdo('mysql:host=localhost;dbname=pablito1','root','');


$sede= $_POST['sede'];
$codigo=$_POST['codigo'];
$direccion=$_POST['direccion'];
$barrio=$_POST['barrio'];
$telefono=$_POST['telefono'];

$dane=$_POST['dane'];
$io=$_POST['io'];
 echo $consultar_rotulo="UPDATE `sede` SET  `NOMBRE`='$sede',`CODIGO`='$codigo',`DIRECCION`='$direccion',`BARRIO`='$barrio',`TELEFONO`='$telefono',`DANE`='$dane' WHERE sede.ID_SEDE='$io'";
   $consultar_rotulo1=$conexion->prepare($consultar_rotulo);
   $consultar_rotulo1->execute(array());

}




//fin de la atualizacion de datos

//tabla de jornadas
function jornada(){  

if(isset($_POST['mi'])){
 $p =' WHERE sede.ID_SEDE= '. $_POST['mi'];
  $sp = $_POST['mi'];
}else{
  $p = '';
}
  include '../../conexion.php';
   $consultar_nivel="SELECT sede.*,d.jorna,d.ID_JORNADA,d.ABREVIACION,d.ID_JS FROM sede LEFT JOIN (SELECT jornada_sede.ID_JS, jornada_sede.ID_SEDE,jornada.ID_JORNADA,jornada.NOMBRE as jorna,jornada.ABREVIACION FROM jornada_sede RIGHT JOIN jornada on jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar='0')as d on sede.ID_SEDE=d.ID_SEDE " .$p ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);

    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll();
    

   
  ?>
 
     <form method="post" id="dfd">  
 <input type="hidden" value="<?php echo $sp ?>" name="id_sede">
              <div class="table-responsive mailbox-messages">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>JORNADA</th>
                        <th>ABREVIACION</th>
                        <th>PERSONAL</th>
                        <th>eliminar</th>
                      </tr>
                    </thead>
                    <tbody>

                     <?php  
                     foreach ($consultar_nivel12 as   $value) {
$tyy=$value['ID_JS'];
$tyy1=$value['ID_JORNADA'];
$tyy2=$value['ID_SEDE'];

                      ?>

                      <tr id="ghg<?php echo $value['ID_JORNADA']; ?>"> 
                        <td><input type="checkbox" id="<?php echo("idm[]");?>" class="sss" name="<?php echo("idm[]");?>" value="<?php echo $value['ID_JS']; ?>"></td>
                        <td><?php echo $value['jorna']; ?> </td>
                        <td><?php echo $value['ABREVIACION']; ?> </td>
                        <td><a  data-title="Visualizar el personal"  href="personal.php?id=<?php echo $tyy; ?>&id1=<?php echo $tyy1; ?>&id2=<?php echo $tyy2; ?>"  ><img  width="30px" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MDggNTA4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MDggNTA4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojODREQkZGOyIgY3g9IjI1NCIgY3k9IjI1NCIgcj0iMjU0Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGMTU0M0Y7IiBkPSJNNDQxLjIsMTkwLjhjMCwzLjItMC44LDYtMi44LDguOGMtOC44LTQuOC0xOS4yLTcuMi0zMC03LjJjLTExLjIsMC0yMS42LDItMzAsNy4yICBjLTEuNi0yLjgtMi44LTUuNi0yLjgtOC44YzAtMTIsMTQuOC0yMiwzMi44LTIyQzQyNi40LDE2OC44LDQ0MS4yLDE3OC44LDQ0MS4yLDE5MC44eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRkY3MDU4OyIgZD0iTTQ2NC44LDI1NC40YzAsMTIuNC0yLDI1LjItNS4yLDM3LjZIMzU3LjJjLTAuOC0zLjYtMS42LTYuOC0yLjQtMTAuNGM5LjYtMTcuMiwyMC00NS42LDE0LjgtNzYgIGMxMC05LjIsMjMuNi0xMy4yLDM4LjQtMTMuMkM0MzkuNiwxOTIuNCw0NjQuOCwyMDkuNiw0NjQuOCwyNTQuNHoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0Y5QjU0QzsiIGQ9Ik00NDQuOCwzMjhjMCwwLDIuOCwxNi0xNS42LDMyLjRsLTU3LjYtMjhjMC40LTQuNCwxLjYtOC40LDMuMi0xMmM4LjgsMTYsMjAuOCwyNi44LDM0LDI2LjggIHMyNS4yLTExLjIsMzQtMjYuOEM0NDMuNiwzMjIuOCw0NDQuNCwzMjUuMiw0NDQuOCwzMjhMNDQ0LjgsMzI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojNENEQkM0OyIgZD0iTTQ4NS42LDM1OC40Yy04LjgsMjAtMjAuNCwzOC40LTM0LDU1LjJsLTMuMi0xMC40YzItNiw5LjYtMzkuNiw0LjgtNjAuOEw0ODUuNiwzNTguNHoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTQ0OC40LDQwMy4ybC0xMi44LTQwbC02LjQtMy4yYzE4LjQtMTYuNCwxNS42LTMyLjQsMTUuNi0zMi40QzQ2Mi44LDM0MS42LDQ1MC44LDM5NS4yLDQ0OC40LDQwMy4yICAgeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNzIsMzI4Yy0wLjQsMS4yLTAuNCwyLjgtMC44LDQuNGwtMi40LTEuMkMzNjkuNiwzMzAsMzcwLjgsMzI4LjgsMzcyLDMyOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojRkZEMDVCOyIgZD0iTTQ2Mi44LDI5Ni44Yy0zLjYsNy4yLTkuNiwxMC40LTEzLjYsOGMtOS4yLDIzLjYtMjQsNDItNDEuMiw0MnMtMzItMTguNC00MS4yLTQyICBjLTQsMi40LTEwLTEuMi0xMy42LThjLTEuNi0zLjItMi40LTYuNC0yLjgtOS4yYzItMi44LDQtNi40LDYtMTAuNGMwLjgsMCwxLjYsMCwyLjgsMC40bDAsMGwwLjQsMC40bDAsMGMwLTAuNC0xLjYtMTUuMiwzNy42LTMxLjIgIGMxNC01LjYsMjIuOC0xMiwyOC0xOGMyLDguOCw2LjgsMjEuMiwxOS42LDI2YzAsMCwxMiwyLjgsMTAuOCwyMi44bDAsMGMyLTAuOCw0LTAuOCw1LjYsMC40QzQ2Ni40LDI4MS4yLDQ2Ni44LDI4OS42LDQ2Mi44LDI5Ni44eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTZFOUVFOyIgZD0iTTM0Mi44LDM5NS4yTDM0Mi44LDM5NS4yYy0wLjgsNS42LTIsMTEuNi0yLjgsMThsLTE0LTQyLjRDMzMyLjgsMzc2LjQsMzM5LjIsMzg0LDM0Mi44LDM5NS4yeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRjlCNTRDOyIgZD0iTTMzOC44LDMwNGMwLDAsNC44LDI2LjQtMzMuNiw0OS4yTDI2MS42LDMzMmMtMTEuNi0xNS4yLTkuMi0yOC05LjItMjhzMCwwLTAuNCwwICBjMC0wLjQsMC0wLjgsMC40LTEuNmMxMiwxNC44LDI2LjgsMjQuNCw0My4yLDI0LjRzMzEuMi05LjYsNDMuMi0yNC40QzMzOC44LDMwMy4yLDMzOS4yLDMwMy42LDMzOC44LDMwNCAgQzMzOS4yLDMwNCwzMzkuMiwzMDQsMzM4LjgsMzA0eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMkIzQjRFOyIgZD0iTTQ1MS42LDQxMy42Yy0yNCwyOS42LTU0LjQsNTMuNi04OS4yLDcwbC0yMi44LTcwLjRjMS4yLTYsMi0xMiwyLjgtMThjMC40LDAuOCwxMi44LTQ1LjYsNi03My42ICBsODYuNCw0MS42TDQ1MS42LDQxMy42eiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMzQyLjgsMzk1LjJjLTMuNi0xMS4yLTEwLTE5LjItMTYuOC0yNC40bC0yLjgtOC44bC0xNy42LTguNGMzOC40LTIyLjgsMzMuNi00OS4yLDMzLjYtNDkuMiAgIEMzNjIuOCwzMjIsMzQzLjIsMzk2LjQsMzQyLjgsMzk1LjJ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTI2MS42LDMzMmwtMTkuMi05LjJjMS42LTgsNC44LTE0LjgsMTAtMTguOEMyNTIuNCwzMDQsMjUwLDMxNi44LDI2MS42LDMzMnoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojRkZEMDVCOyIgZD0iTTM1MC44LDI2OS4yYy01LjYsMTcuNi04LDI3LjItOCwyOC40bDAsMGMtMTIuOCwxNy4yLTI5LjIsMjkuMi00Ni44LDI5LjJjLTE2LjgsMC0zMi40LTEwLjQtNDQuOC0yNiAgYzAsMCwwLjQsMCwwLjQsMC40Yy0xMi0xNC44LTE0LjgtMzUuNi0xNC40LTUzLjZsMCwwYzQuNC0xMC40LDcuNi0yMi44LDkuNi0zNmMxNiwxMiw1Mi44LDEyLjgsNTIuOCwxMi44ICBjLTE4LjgtMy4yLTIxLjYtMTgtMjEuNi0xOGMzLjIsOS4yLDQ0LjgsMTQuOCw0NC44LDE0LjhDMzY1LjIsMjI3LjIsMzUwLjgsMjY5LjIsMzUwLjgsMjY5LjJ6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6IzJCM0I0RTsiIGQ9Ik0yNTEuMiwzMDEuMmMwLDAtMTQtMTEuMi0yNS42LTMwLjhjMy42LTYsNy42LTE0LDExLjItMjIuOEMyMzYuNCwyNjUuNiwyMzkuMiwyODYuNCwyNTEuMiwzMDEuMnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMyQjNCNEU7IiBkPSJNMzQyLjgsMjk4YzAsMCwyLTEwLDgtMjguNGMwLDAsMTQuNC00Mi0yOC44LTQ4LjRjMCwwLTQxLjYtNS42LTQ0LjgtMTQuOGMwLDAsMy4yLDE1LjIsMjEuNiwxOCAgIGMwLDAtMzYuOC0wLjgtNTIuOC0xMi44YzIuNC0yMCwwLjgtNDItOS42LTY0YzguNC00LjQsMTkuMi02LDM0LTJjMCwwLDU4LjQtMjMuMiw4OC40LDI5LjZDMzkwLjgsMjMxLjYsMzUwLjgsMjkyLjgsMzQyLjgsMjk4eiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiMzMjRBNUU7IiBkPSJNMzM0LjQsMjM5LjJIMzE0aC0yaC0zMi40aC0xLjJoLTIxLjZjLTYuNCwwLTExLjYsNS4yLTExLjYsMTEuNnY5LjZjMCw2LjQsNS4yLDExLjYsMTEuNiwxMS42aDIyLjQgIGMyLjgsMCw1LjYtMS4yLDcuNi0yLjhjMC44LTAuNCwxLjItMC44LDEuNi0xLjZjMS42LTMuNiw0LjQtNS42LDcuMi01LjZjMi44LDAsNS42LDIsNy4yLDUuNmMwLjQsMC44LDAuOCwxLjIsMS42LDEuNiAgYzIsMiw0LjgsMi44LDcuNiwyLjhoMjIuNGM2LjQsMCwxMS42LTUuMiwxMS42LTExLjZ2LTkuNkMzNDYsMjQ0LjQsMzQwLjgsMjM5LjIsMzM0LjQsMjM5LjJ6IE0yNTYuOCwyNjYuNGMtMy4yLDAtNi0yLjgtNi02di05LjYgIGMwLTMuMiwyLjgtNiw2LTZoMjEuNmgxLjJjMy4yLDAsNiwyLjgsNiw2djkuNmMwLDAuOCwwLDEuNi0wLjQsMi40Yy0wLjQsMC40LTAuNCwwLjgtMC44LDEuMmMtMS4yLDEuNi0yLjgsMi40LTQuOCwyLjRIMjU2Ljh6ICAgTTI5NS42LDI1NmMtMS42LDAtMy4yLDAuNC00LjgsMS4ydi02LjhjMC0yLjQtMC44LTQuNC0xLjYtNmgxMy4yYy0xLjIsMS42LTEuNiw0LTEuNiw2djYuOEMyOTguOCwyNTYuNCwyOTcuMiwyNTYsMjk1LjYsMjU2eiAgIE0zNDAuNCwyNjAuNGMwLDMuMi0yLjgsNi02LDZIMzEyYy0yLDAtMy42LTAuOC00LjgtMi40Yy0wLjQtMC40LTAuNC0wLjgtMC44LTEuMmMtMC40LTAuOC0wLjQtMS42LTAuNC0yLjR2LTkuNmMwLTMuMiwyLjgtNiw2LTZoMiAgaDIwLjRjMy4yLDAsNiwyLjgsNiw2VjI2MC40eiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNFNkU5RUU7IiBkPSJNNzcuNiw0MzYuNGMwLjQsMC44LDEuMiwxLjIsMS42LDEuNkM3OC44LDQzNy42LDc4LDQzNy4yLDc3LjYsNDM2LjRMNzcuNiw0MzYuNHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNFNkU5RUU7IiBkPSJNMTYwLDM1NS42Yy0wLjQsMC0wLjgsMC40LTEuMiwwLjRzLTAuOC0wLjQtMS4yLTAuNEgxNjB6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTZFOUVFOyIgZD0iTTIxNCwzOTkuNmMtNC40LDI5LjItMTEuNiw2My4yLTIzLjYsMTAwLjRjLTI2LTYuOC01MC44LTE3LjYtNzIuOC0zMS42Yy02LjgtMjQuOC0xMS4yLTQ4LTE0LTY4LjggICBjMTIuOC00MCw1NS4yLTQzLjYsNTUuMi00My42UzIwMS42LDM1OS42LDIxNCwzOTkuNnoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojRjlCNTRDOyIgZD0iTTIwOS42LDI5MmMwLDAsNi40LDM2LTUwLjgsNjRoLTAuNGMtNTcuMi0yOC01MC44LTY0LTUwLjgtNjRzMCwwLTAuNCwwYzAtMC40LDAuNC0xLjIsMC40LTEuNiAgYzE0LDE3LjIsMzEuNiwyOC40LDUwLjgsMjguNHMzNi40LTExLjIsNTAuOC0yOC40QzIwOS42LDI5MS4yLDIxMCwyOTEuNiwyMDkuNiwyOTJDMjEwLDI5Mi40LDIxMCwyOTIsMjA5LjYsMjkyeiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiM1NEMwRUI7IiBkPSJNMTU5LjIsMzU2QzE1OS4yLDM1NiwxNTguOCwzNTYsMTU5LjIsMzU2Yy0wLjQsMC0wLjQsMC0wLjQsMEgxNTkuMnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiM1NEMwRUI7IiBkPSJNMTc5LjIsMzYxLjZsLTYuOCwxOS42aC0yNi44bC02LjgtMTkuNmMxMS4yLTQuOCwyMC01LjYsMjAtNS42UzE2OCwzNTYuOCwxNzkuMiwzNjEuNnoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojODREQkZGOyIgZD0iTTE4OS4yLDQ5OS42bC0xNi44LTExOC40aC0yNi44TDEzMiw0NzYuOEMxNDkuNiw0ODYuNCwxNjguOCw0OTQuNCwxODkuMiw0OTkuNnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzMyNEE1RTsiIGQ9Ik0xMTcuNiw0NjguNGMtNDQtMjgtNzguOC02OS4yLTk4LjgtMTE4bDc3LjYtMzcuMmMtOCwzMy42LDYuOCw4OCw3LjIsODYuOCAgQzEwNi40LDQyMC40LDExMS4yLDQ0My4yLDExNy42LDQ2OC40eiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMjA5LjYsMjkyYzAsMCw2LjQsMzYtNTAuOCw2NGMwLDAsNDIuOCwzLjIsNTUuMiw0My42QzIxNC44LDQwMC44LDIzOCwzMTMuNiwyMDkuNiwyOTJ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTEwOCwyOTJjLTI4LDIxLjItNC44LDEwOC44LTQuNCwxMDcuMmMxMi44LTQwLDU1LjItNDMuNiw1NS4yLTQzLjZDMTAxLjYsMzI4LjQsMTA4LDI5MiwxMDgsMjkyeiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkQwNUI7IiBkPSJNMjIzLjYsMjUxLjJjLTcuMiwyMi05LjYsMzMuNi05LjYsMzMuNmMtMTQuOCwyMC40LTM0LDM0LTU1LjIsMzRjLTIwLDAtMzgtMTIuNC01Mi44LTMwLjhsMC40LDAuNCAgYy0zMS4yLTM4LjQtOS42LTEwOS4yLTkuNi0xMDkuMmMxNS42LDE3LjYsNjYsMTguOCw2NiwxOC44Yy0yMi0zLjYtMjUuNi0yMS4yLTI1LjYtMjEuMmMzLjYsMTAuOCw1Mi40LDE3LjIsNTIuNCwxNy4yICBDMjQwLjQsMjAyLDIyMy42LDI1MS4yLDIyMy42LDI1MS4yeiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzMjRBNUU7IiBkPSJNMTI5LjYsMTA1LjZjMCwwLDY4LjgtMjcuNiwxMDMuNiwzNC44YzM3LjYsNjYuNC05LjYsMTM4LjgtMTkuMiwxNDQuNGMwLDAsMi40LTExLjYsOS42LTMzLjYgICBjMCwwLDE2LjgtNDkuMi0zMy42LTU2LjhjMCwwLTQ5LjItNi40LTUyLjQtMTcuMmMwLDAsMy42LDE3LjYsMjUuNiwyMS4yYzAsMC01MC40LTEuMi02Ni0xOC44YzAsMC0yMS42LDcwLjgsMTAsMTA5LjIgICBjMCwwLTU0LTQzLjItNDcuNi0xMTBDNTkuMiwxNzguOCw1Ni40LDg3LjIsMTI5LjYsMTA1LjZ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzI0QTVFOyIgZD0iTTM2Mi40LDQ4My42QzMyOS42LDQ5OS4yLDI5Mi44LDUwOCwyNTQsNTA4Yy0yMiwwLTQzLjItMi44LTYzLjItOGMxMi0zNy4yLDE5LjItNzEuMiwyMy42LTEwMC40ICAgbDAsMGMwLjgsMCwxNC44LTUzLjYsNy4yLTg2LjhMMzIzLjIsMzYyTDM2Mi40LDQ4My42eiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /></a></td>

                        <td><a href="#" data-title="Inhabilitar la jornada sus cursos" data-toggle="modal" data-target="#mymodal<?php echo $value["ID_JORNADA"]?>"><img style="width: 20px;margin-right: 10px; " src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">  </a></td>
                      </tr>

                      <div class="modal fade" id="mymodal<?php echo  $value["ID_JORNADA"]?>" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" style="<?php echo $_POST['sty']; ?>">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p> estás seguro de eliminar la jornada?</p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              <input type="hidden" value='<?php echo $value["ID_JORNADA"]?>'  name="Aceptarr">
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd" value='<?php echo $value["ID_JORNADA"]?>'  class="btn btn-primary" 
                                  onclick="myFunction3(<?php echo $value['ID_JS'];?>)">Aceptar</button> 

                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      ?> 
                    </tbody>
                  </table> <br><br>


             


<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" style="<?php echo $_POST['sty']; ?>">Confirmación</h4>
        </div>
        <div class="modal-body"> 
          <p><strong>Nota:</strong> Está seguro de eliminar la jornada?

.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            <button type="submit" class="btn btn-primary" id="uuu"  onclick="
        $('#myModal2').modal('hide');"  >Aceptar</button>
        </div>
      </div>
      
    </div>
  </div>
  



</div> 

      <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button>         
  <button type="button" class="btn btn-info btn-md" id="myBtn2"  >eliminar</button>      </form>
 
    <!-- Check all button -->

     
 
<script type="text/javascript">
 
  $(document).ready(function(){  

      $("#myBtn2").click(function(){ 
        $("#myModal2").modal();
      }); 


      var mio=document.getElementById("mio").value; 
     

       function sel(){ 
         $.ajax({   
          type: "post",

          data:{mio}, 
          url:"../../../ajax/rector/sedes/sedes.php?action=sele",
          dataType:"text", 

          success:function(data){  
            $('#sele').html(data); 
       


          }  

        });  }
 

    $(document).on("submit", "#dfd", function(e){
          e.preventDefault();

          $.ajax({

            type: "post",
            url:"../../../ajax/rector/sedes/sedes.php?action=elim2", 
            data: $(this).serialize(),
            dataType:"text", 
            success: function(data)
            { 

              document.getElementById("dfd").reset();
              $('#_MSG2_').html(data); 
 sel();
  
            }
          });

        });



  
     
  
   
  }); 
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
<!-- Page Script -->

                  <?php
}




function elim(){
 
  date_default_timezone_set("America/Bogota");
  session_start();
  $fecha=date("Y-m-d h:i:sa");
  $ano=date('Y');
  $didi=0;
  include "../../conexion.php";

  if(isset($_POST['dsd'])){
   $y = $_POST['dsd'];
  }else{
    $y = '';
  }  

   $consultar_nivel="SELECT jornada_sede.ID_JS FROM jornada_sede WHERE jornada_sede.ID_JS=$y and  jornada_sede.ID_JS in(SELECT informeacademico.id_jornada_sede from informeacademico WHERE informeacademico.ano=$ano )";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $consultar_nivel12s=$consultar_nivel1->rowCount();
  if ($consultar_nivel12s>0) {   ?>
    <script>mensaje2(1," actual mente la jornada tiene alumnos registrados");</script><?php
  }else{ 
    $consultar_nivel="UPDATE `jornada_sede` SET `inhabilitar` = '1' WHERE `jornada_sede`.`ID_JS` = $y";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $consultar_nivel="INSERT INTO `historial_jornada_sede` ( `id_jornada_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES ('".$y."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    ?>
    <script type="text/javascript">
      window.location.assign( window.location.href); 
    </script><?php
  }
}
function elim2(){

  include '../../conexion.php';
  if(isset($_POST['idm'])){
   $variable = $_POST['idm'];
  }else{
    $variable = '';
  }
  if ($variable!='') {
     
    date_default_timezone_set("America/Bogota");
    session_start();
    $fecha=date("Y-m-d h:i:sa");
    $ano=date('Y');
    $didi=0;
    foreach ($variable as $y) {  
   
     
    
     

      $consultar_nivel="SELECT jornada_sede.ID_JS FROM jornada_sede WHERE jornada_sede.ID_JS=$y and  jornada_sede.ID_JS in(SELECT informeacademico.id_jornada_sede from informeacademico WHERE informeacademico.ano=$ano )";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12s=$consultar_nivel1->rowCount();
      if ($consultar_nivel12s>0) {   ?>
        <script>mensaje2(1," actual mente la jornada tiene alumnos registrados");</script><?php
      }else{ 
        $consultar_nivel="UPDATE `jornada_sede` SET `inhabilitar` = '1' WHERE `jornada_sede`.`ID_JS` = $y";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel="INSERT INTO `historial_jornada_sede` (`id_historial_jornada_sede`, `id_jornada_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$y."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $didi=$didi+1;
      }
    }if ($didi>0) {
      ?>
        <script type="text/javascript">
          window.location.assign( window.location.href); 
        </script><?php
    }else{
      ?>
      <script>mensaje2(1," actual mente la jornada tiene alumnos registrados");</script><?php

    }
  }else{
    ?> <script>mensaje2(2," Campos vacios");</script><?php
  }
}









function sele(){
  if(isset($_POST['mio'])){
   $p = $_POST['mio'];
  }else{
    $p = '';
  }
  include '../../conexion.php';
  $consultar_nivel="SELECT * FROM jornada WHERE  jornada.ID_JORNADA NOT in (SELECT jornada_sede.ID_JORNADA FROM jornada_sede WHERE jornada_sede.ID_SEDE=$p)"   ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $consultar_nivel12=$consultar_nivel1->fetchAll();
  echo '<option value="">Seleccione una Jornada</option>';
  foreach ($consultar_nivel12 as $value) {
    echo '<option value="'.$value['ID_JORNADA'].'">'.$value['NOMBRE'].'</option>';
  }
}
function jornada_sede(){
  include '../../conexion.php';
  $p = $_POST['mio'];
  $kl = $_POST['sele'];
  if ($kl=='') {
    
    echo "<script type='text/javascript'>mensaje(2,'campos vacios');</script>";
  } else{ 
    foreach ($kl as $key ) {
      $consultar_nivel="INSERT INTO `jornada_sede` (`ID_JS`, `ID_SEDE`, `ID_JORNADA`) VALUES (?,?,?);";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array(null,$p,$key));
    } 
    echo "<script type='text/javascript'>mensaje(3,'has relacionado la sede con la JORNADA');</script>";
  }
}
?>

