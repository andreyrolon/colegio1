


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}

function registrar_datos_anuales(){
  date_default_timezone_set("America/Bogota");
  $ano=date('Y');
  require '../conexion.php'; 
  echo $sql = "INSERT INTO `histrorial_datos` ( `ano`, `nombre`, `mision`, `vision`, `resena`, `departamento`, `ciudad`, `direccion`, `eslogan`, `aprobado`, `reprobado`, `telefono1`, `telefono2`, `decreto`, `nit`, `dane`, `caracter`, `correo`, `decreto_evaluacion` ) VALUES ( '".$ano."', '".$_POST['nombre']."', '".$_POST['mision']."', '".$_POST['vision']."', '".$_POST['resena']."', '".$_POST['departamento']."', '".$_POST['ciudad']."', '".$_POST['direccion']."', '".$_POST['eslogan']."', '".$_POST['aprobado']."', '".$_POST['reprobado']."', '".$_POST['telefono1']."', '".$_POST['telefono2']."', '".$_POST['decreto']."', '".$_POST['nit']."', '".$_POST['dane']."', '".$_POST['caracter']."', '".$_POST['correo']."', '".$_POST['decreto_evaluacion']."') "; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
}
function actualizar_datos_anuales (){

  require '../conexion.php'; 
  echo $sql = "UPDATE `datos` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `datos`.`id_datos` = ".$_POST['id']."  "; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
}
function mis_datos(){

  require '../conexion.php'; 
  echo $sql = "UPDATE `datos` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `datos`.`id_datos` = ".$_POST['id']."  "; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
}

 
function periodo(){
  require '../conexion.php';
  date_default_timezone_set("America/Bogota");
  $ano=date('Y');
  $consul="INSERT INTO `historial_periodo` (`id_periodo`,`nombre`, `fecha_inicio`, `fecha_fin`, `numero`, `ano`)  SELECT periodo.id_periodo,periodo.nombre,periodo.fecha_inicio,periodo.fecha_fin,periodo.numero,'$ano' FROM periodo WHERE periodo.id_periodo not in(SELECT historial_periodo.id_periodo from historial_periodo WHERE historial_periodo.ano='$ano') ";
  $consultar_nivel1=$conexion->prepare($consul);
  $consultar_nivel1->execute(array());
    
  $sql = "SELECT * FROM `periodo` ORDER BY periodo.numero"; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array()); 

  ?>
  <div class="col-md- " style="padding: 20px"> 
    <div id="_MSG2_"></div> 
      <div class="co"> 
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"  >Agregar</button><br><br>
      </div> 
      <div class="table-responsive">
      <table class=" table table-hover">
        <tr>
          <th>Numero</th>
          <th style="padding-right: 60px">Nombre del periodo</th>
          <th>Fecha de inicio</th>
          <th>Fecha de terminación</th>
        </tr>
     
        <?php foreach ($consultar_nivel1 as $key ) { ?>
          <tr>
            <td>
              <input type="number" name="numero" id="numero<?php echo $key['id_periodo']  ?>" class="form-control" value="<?php echo $key['numero']; ?>" onchange="
              var col=document.getElementById('numero<?php echo $key['id_periodo']  ?>').value;
              var nombre='numero';
              var id=<?php echo($key['id_periodo']) ?>; 
              var atras=<?php echo($key['numero']) ?>;  
              actualizar_periodo(atras,col,nombre,id) ">
            </td>
            <td>
              <input type="" name="nombre" id="nombre<?php echo $key['id_periodo']  ?>" class="form-control" value="<?php echo $key['nombre']; ?>" onchange="
                    var col=document.getElementById('nombre<?php echo $key['id_periodo']  ?>').value;
                    var nombre='nombre';
                    var id=<?php echo($key['id_periodo']) ?>;
                    var atras='<?php echo $key['nombre']; ?>';
                    actualizar_periodo2(atras,col,nombre,id) ">
            </td>
            <td>
              <input type="date" name="fecha_inicio" id="fecha_inicio<?php echo $key['id_periodo']  ?>" class="form-control" value="<?php echo $key['fecha_inicio']; ?>" oninput="
                    var col=document.getElementById('fecha_inicio<?php echo $key['id_periodo']  ?>').value;
                    var nombre='fecha_inicio';
                    var id=<?php echo($key['id_periodo']) ?>;
                    var atras=<?php echo($key['fecha_inicio']) ?>;
                    actualizar_periodo(atras,col,nombre,id) ">
            </td>
            <td>
              <input type="date" name="fecha_fin" id="fecha_fin<?php echo $key['id_periodo']  ?>" class="form-control" value="<?php echo $key['fecha_fin']; ?>" oninput="
                    var col=document.getElementById('fecha_fin<?php echo $key['id_periodo']  ?>').value;
                    var nombre='fecha_fin';
                    var id=<?php echo($key['id_periodo']) ?>;
                    var atras=<?php echo($key['fecha_fin']) ?>;
                    actualizar_periodo(atras,col,nombre,id) ">
            </td>
            <td>
              <a id="oooo<?php echo $key['id_periodo']; ?>" href="#" data-toggle="modal" data-target="#mymodal<?php echo $key['id_periodo']; ?>">
                    <img style="width: 20px;margin-right: 10px; " src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
                  </a>
            </td>
          </tr>
         
          <div class="modal fade" id="mymodal<?php echo $key['id_periodo']; ?>" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Confirmación</h4>
                </div>
                <div class="modal-body">
                  <p>Estas seguro de eliminar el periodo?</p>
               </div>
               <div class="modal-footer">  
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 
                onclick="var eliminar=<?php echo $key['id_periodo']; ?>;
                        var fila='row<?php echo $key["id_periodo"] ?>';
                        elimna_periodo(eliminar,fila)">Aceptar</button> 

                </div>
              </div>
            </div>
          </div><?php 
        } ?></table></div></div>
                 
  <script type="text/javascript">
    function  actualizar_periodo2(atras,col,nombre,id){
      if(ESnombre(col)){
          mensaje2(2,"El nombre deL periodo solo permirte letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id},
        url:"../../../ajax/rector/mi_colegio.php?action=actualizar_periodo", 
          dataType:"text", 

          success:function(data){  
            if (data==1) { 
            mensaje2(3,'Registro actualizado');
            }if(data==0){
              $('#'+nombre+id).val(atras);
              mensaje2(1,'El dato que ingresó ya esta en la base de datos');
            }if (data==3) {$('#'+nombre+id).val(atras);
              mensaje2(1,'Los periodos solo se pueden registrar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
            }
          }  
        });
      }     
    }
    function actualizar_periodo(atras,col,nombre,id){
      $.ajax({   
        type: "post", 
        data:{col,nombre,id},
        url:"../../../ajax/rector/mi_colegio.php?action=actualizar_periodo", 
        dataType:"text", 

        success:function(data){  
          if (data==1) { 
            mensaje2(3,'Registro actualizado');
          }if(data==0){
            $('#'+nombre+id).val(atras);
            mensaje2(1,'El dato que ingresó ya esta en la base de datos');
          }if (data==3) {$('#'+nombre+id).val(atras);
            mensaje2(1,'Los periodos solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }
        }  
      });
    }
  function elimna_periodo(eliminar,fila){ 
       $.ajax({   
        type: "post", 
        data:{eliminar,fila},
        url:"../../../ajax/rector/mi_colegio.php?action=eliminar_periodo", 
        dataType:"text", 

        success:function(data){   
          if (data==1) {
            $("#"+fila).remove();  
            mensaje2(3,'Registro eliminado');
          }else{
            mensaje2(1,'Los periodos solo se pueden eliminar el 3 al  31 de Diciembre o el  1 al 15 de enero');
          } 
        }   
      });
    } 
  </script>
                <?php
}
function actualizar_periodo(){
  require '../conexion.php';
  date_default_timezone_set("America/Bogota");
  $ano=date('Y'); 
  $fecha=date("md");
  $fechas=$fecha+0;
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {
    $consuls="SELECT periodo.id_periodo from periodo WHERE periodo.".$_POST['nombre']."='".$_POST['col']."'";
    $ss=$conexion->prepare($consuls);
    $ss->execute(array()); 
    $sss=$ss->rowCount();
    if ($sss==0) {
      $sql = "UPDATE `historial_periodo` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE historial_periodo.ano='$ano'  and `historial_periodo`.`id_periodo` =  ".$_POST['id'].";
              UPDATE `periodo` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `periodo`.`id_periodo` = ".$_POST['id']." "; 
      $consultar_nivel1=$conexion->prepare($sql);
      $consultar_nivel1->execute(array());
      echo 1;
    }else{
      echo 0;
    }
  }else{
    echo 3;
  }
}
function eliminar_periodo(){
  require '../conexion.php';
  $eliminar=$_POST['eliminar'];
  date_default_timezone_set("America/Bogota");
  $ano=date('Y'); 
  $fecha=date("md");
  $fechas=$fecha+0;
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {
    
    $consultar_nivel=" DELETE FROM  historial_periodo  WHERE historial_periodo.ano='$ano'  and historial_periodo.id_periodo = $eliminar;
                      DELETE FROM periodo  WHERE periodo.id_periodo = $eliminar";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $registro=$consultar_nivel1->fetchAll();
    echo 1;
  }else{
    echo 0;
  }
}
function registrar_periodo(){
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $fechas=$fecha+0;
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<115 )) {  
    require '../conexion.php';
    
    $consuls="SELECT periodo.id_periodo from periodo WHERE periodo.nombre='".$_POST['Nombre']."'  or periodo.fecha_inicio='".$_POST['Fecha_ini']."'  or periodo.fecha_fin='".$_POST['Fecha_fin']."'     or periodo.numero='".$_POST['numero']."'";
    $ss=$conexion->prepare($consuls);
    $ss->execute(array()); 
    $sss=$ss->rowCount();
    if ($sss==0) {
      $consul="
      INSERT INTO `periodo` ( `nombre`, `fecha_inicio`, `fecha_fin`, `activar_periodo`, `activar_recuperacion`, `numero`) VALUES ( '".$_POST['Nombre']."', '".$_POST['Fecha_ini']."', '".$_POST['Fecha_fin']."', '', '', '".$_POST['numero']."')";
      $consultar_nivel1=$conexion->prepare($consul);
      $consultar_nivel1->execute(array()); 
      echo 1; 
    }else{
      echo 0;
    }   
  }else{
    echo 3;
  }
}













































 
function academico(){
  require '../conexion.php';
  date_default_timezone_set("America/Bogota");
  $ano=date('Y'); 


    
   $sql = "INSERT INTO `historial_escala_academica` ( `id_escala_academica`, `desde`, `hasta`, `sigla`, `nombre`, `numero`, `mini`, `ano`)
   SELECT escala_academica.id_escala_academica, escala_academica.desde,escala_academica.hasta,escala_academica.sigla,escala_academica.nombre,escala_academica.numero,escala_academica.mini,'$ano' from escala_academica WHERE escala_academica.id_escala_academica not in (SELECT historial_escala_academica.id_escala_academica from historial_escala_academica WHERE historial_escala_academica.ano='$ano' )
"; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array()); 


  $sql = "SELECT * FROM `escala_academica` ORDER BY escala_academica.numero"; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array()); 
  ?>
    <div style="padding: 10px">
      <div class=" table-responsive" >
    <div id="_MSG_"></div> 
<br>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2" style="margin-left: 9px" >Agregar</button><br><br>
 
       
      <table class="table">
        <tr>
          <th width="100">Numero</th>
          <th style="padding-right: 120px">Nombre</th>
          <th>Sigla</th>
          <th>Rango minimo </th>
          <th>Rango maximo</th>
          <th>mimimo de aprovación</th>
        </tr>
        <?php foreach ($consultar_nivel1 as $key ) { ?>
          <tr id="rowT<?php echo $key["id_escala_academica"] ?>">
            <td>
              <input type="" name="numero" id="numero<?php echo $key['numero']  ?>" class="form-control" value="<?php echo $key['numero']; ?> " onchange="
                    var col=document.getElementById('numero<?php echo $key['numero']  ?>').value;
                    var nombre='numero';
                    var id=<?php echo($key['id_escala_academica']) ?>;
                    var atras='<?php echo $key['numero']; ?>';
                    actualizar_academico12(atras,col,nombre,id) "  >
            </td>
            <td>
              <input type="" name="nombre" id="nombre<?php echo $key['id_escala_academica']  ?>" class="form-control" value="<?php echo $key['nombre']; ?> " onchange="
                    var col=document.getElementById('nombre<?php echo $key['id_escala_academica']  ?>').value;
                    var nombre='nombre';
                    var id=<?php echo($key['id_escala_academica']) ?>;
                    var atras='<?php echo $key['nombre']; ?>';
                    actualizar_academico14(atras,col,nombre,id) ">
            </td>
            <td>
              <input type="" name="sigla" id="sigla<?php echo $key['id_escala_academica']  ?>" class="form-control" value="<?php echo $key['sigla']; ?> " onchange="
                    var col=document.getElementById('sigla<?php echo $key['id_escala_academica']  ?>').value;
                    var nombre='sigla';
                    var id=<?php echo($key['id_escala_academica']) ?>;
                    var atras='<?php echo $key['sigla']; ?>';
                    actualizar_academico13(atras,col,nombre,id) ">
            </td>
            <td>
              <input type="" name="desde" id="desde<?php echo $key['id_escala_academica']  ?>" class="form-control" value="<?php echo $key['desde']; ?>" onchange="
                    var col=document.getElementById('desde<?php echo $key['id_escala_academica']  ?>').value;
                    var nombre='desde';
                    var id=<?php echo($key['id_escala_academica']) ?>;
                    var atras='<?php echo $key['desde']; ?>';
                    actualizar_academico12(atras,col,nombre,id) ">
            </td>
            <td>
              <input type="" name="hasta" id="hasta<?php echo $key['id_escala_academica']  ?>" class="form-control" value="<?php echo $key['hasta']; ?>" onchange="
                    var col=document.getElementById('hasta<?php echo $key['id_escala_academica']  ?>').value;
                    var nombre='hasta';
                    var id=<?php echo($key['id_escala_academica']) ?>;
                    var atras='<?php echo $key['hasta']; ?>';
                    actualizar_academico11(atras,col,nombre,id) ">
            </td>
            <td> 
              <select class="form-control" id="mini<?php echo $key['id_escala_academica']  ?>" onchange="
                    var col=document.getElementById('mini<?php echo $key['id_escala_academica']  ?>').value;
                    var nombre='mini';
                    var id=<?php echo($key['id_escala_academica']) ?>;
                    var atras='<?php echo $key['mini']; ?>';
                    actualizar_academicoss(atras,col,nombre,id)">
                  <?php 

                    if ($key['mini']==1) {
                      ?>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                      <?php
                    }else{
                      ?>

                        <option value="0">No</option>
                        <option value="1">Si</option>
                      <?php
                    }

                   ?>
                
                
              </select>
            </td>
            <td>
               <a id="oooo<?php echo $key['id_escala_academica']; ?>" href="#" data-toggle="modal" data-target="#TR<?php echo $key['id_escala_academica']; ?>">
                  <img style="width: 20px;margin-right: 10px; " src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
                  </a>

            </td>
          
               
                        <div class="modal fade" id="TR<?php echo $key['id_escala_academica']; ?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p>Si elimina la tecnica  eliminara sus competencias estás seguro de hacerlo  ?</p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                               
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

                      onclick="var eliminar=<?php echo $key['id_escala_academica']; ?>;
                                var fila='rowT<?php echo $key["id_escala_academica"] ?>';
                       

                        elimna_academico(eliminar,fila)">Aceptar</button> 

                              </div>
                            </div>
                          </div>
                        </div>
                <?php }?></tr> </table></div>
      
    </div>
  <script type="text/javascript">
    function  actualizar_academico14(atras,col,nombre,id){
      if(ESnombre(col)){
          mensaje(2,"El nombre de la nota solo permirte letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        var minimo=0;
      $.ajax({   
        type: "post", 
        data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_academico", 
          dataType:"text", 

          success:function(data){  
            if (data==1) {  
            mensaje(3,'Registro actualizado');
          }if (data==0) {  
            document.getElementById(nombre+id).value=atras;    
            mensaje(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }if (data==3) { 
           document.getElementById(nombre+id).value=atras;   
            mensaje(1,'No se repetir  el mismo dato ');
          }

          }  
        });
      }
    }
    function  actualizar_academico13(atras,col,nombre,id){
      if(ESnombre(col)){
          mensaje(2,"La sigla de la nota solo permite letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
         var minimo=0;
      $.ajax({   
        type: "post", 
        data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_academico", 
          dataType:"text", 

          success:function(data){  
            if (data==1) {  
            mensaje(3,'Registro actualizado');
          }if (data==0) {  
            document.getElementById(nombre+id).value=atras;    
            mensaje(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }if (data==3) { 
            document.getElementById(nombre+id).value=atras;     
            mensaje(1,'No se repetir  el mismo dato ');
          }

          }  
        });
      }
    }  
    function  actualizar_academico12(atras,col,nombre,id){
      if(decimaa(col)){
          mensaje(2,"La nota minima solo permirte numeros enteros o decimales con punto");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
         var minimo=0;
      $.ajax({   
        type: "post", 
        data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_academico", 
          dataType:"text", 

          success:function(data){   
            if (data==1) {  
            mensaje(3,'Registro actualizado');
          }if (data==0) {  
            document.getElementById(nombre+id).value=atras;    
            mensaje(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }if (data==3) { 
            document.getElementById(nombre+id).value=atras;     
            mensaje(1,'No se repetir  el mismo dato ');
          }

          }  
        });
      }
    }
    function  actualizar_academico11(atras,col,nombre,id){
      if(decimaa(col)){
          mensaje(2,"La nota maximo solo permirte numeros enteros o decimales con punto");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        var minimo=0;
      $.ajax({   
        type: "post", 
        data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_academico", 
          dataType:"text", 

          success:function(data){   

            if (data==1) {  
            mensaje(3,'Registro actualizado');
          }if (data==0) {  
            
            document.getElementById(nombre+id).value=atras; 
            mensaje(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }if (data==3) { 
            
            document.getElementById(nombre+id).value=atras;     
            mensaje(1,'No se repetir  el mismo dato ');
          }

          }  
        });
      }
    }
    function  actualizar_academicoss(atras,col,nombre,id){
      
      var minimo=col;
      $.ajax({   
        type: "post", 
        data:{col,nombre,id,minimo},
        url:"../../../ajax/rector/mi_colegio.php?action=actualizar_academico", 
        dataType:"text", 

        success:function(data){   
          if (data==1) {  
            mensaje(3,'Registro actualizado');
          }if (data==0) {  
            document.getElementById(nombre+id).value=atras;    
            mensaje(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }if (data==3) { 
            document.getElementById(nombre+id).value=atras;   
            mensaje(1,'No se repetir  el mismo dato ');
          }
        }  
      });
      
    }
  function elimna_academico(eliminar,fila){ 
       $.ajax({   
        type: "post", 
        data:{eliminar,fila},
        url:"../../../ajax/rector/mi_colegio.php?action=elimna_academico", 
        dataType:"text", 

        success:function(data){  
          if (data==1) { 
            $("#"+fila).remove();   
            mensaje(3,'Registro actualizado');
          }if (data==0) {  
            mensaje(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }
                


        }  


      });
     } 
  </script>
                <?php
}

function elimna_academico(){ 
  require '../conexion.php';
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $fechas=$fecha+0;
  $ano=date('Y');
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {  
    $eliminar=$_POST['eliminar'];
    $consultar_nivel="DELETE FROM historial_escala_academica  WHERE historial_escala_academica.ano='$ano' and  historial_escala_academica.id_escala_academica = $eliminar;
                      DELETE FROM `escala_academica`  WHERE `escala_academica`.`id_escala_academica` = $eliminar";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $registro=$consultar_nivel1->fetchAll();
    echo 1;
  }else{
    echo 0;
  }

}


function actualizar_academico(){
  require '../conexion.php';
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $fechas=$fecha+0;
  $ano=date('Y');
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<222 )) { 
    $w='';
    if ($_POST['minimo']==1 ) {
      $w='   escala_academica.mini="'.$_POST['col'].'"   '; 
    }if($_POST['minimo']==11){
        $w1="  escala_academica.".$_POST['nombre']."='".$_POST['col']."' ";
     
    }
    $consuls="SELECT escala_academica.numero from escala_academica WHERE $w    ";
    $ss=$conexion->prepare($consuls);
    $ss->execute(array()); 
    $sss=$ss->rowCount();

    if ($sss==0) {
      $sql = "UPDATE `historial_escala_academica` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE historial_escala_academica.ano='$ano' and `historial_escala_academica`.`id_escala_academica` = ".$_POST['id'].";UPDATE `escala_academica` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `escala_academica`.`id_escala_academica` = ".$_POST['id']." ";
      $consultar_nivel1=$conexion->prepare($sql);
      $consultar_nivel1->execute(array());
      echo 1;
    }else{
      echo 3;
    }
  }else{
    echo 0;
  }
}
 
function registrar_academico(){ 
  require '../conexion.php';
    
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $fechas=$fecha+0;
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {  
    $w='';
    if ($_POST['minimo']==1) {
      $w=' escala_academica.mini="1"  or';
    }
     $consuls="SELECT escala_academica.numero from escala_academica WHERE $w escala_academica.desde='".$_POST['Desde']."'  or escala_academica.hasta='".$_POST['Hasta']."'  or escala_academica.sigla='".$_POST['Sigla']."'     or escala_academica.nombre='".$_POST['SS']."' or escala_academica.numero='".$_POST['numer1']."' ";
    $ss=$conexion->prepare($consuls);
    $ss->execute(array()); 
    $sss=$ss->rowCount();
    if ($sss==0) {
      $consul="INSERT INTO `escala_academica` (`desde`, `hasta`, `sigla`, `nombre`, `numero`, `mini`) VALUES('".$_POST['Desde']."', '".$_POST['Hasta']."', '".$_POST['Sigla']."', '".$_POST['SS']."' ,'".$_POST['numer1']."','".$_POST['minimo']."')";
      $consultar_nivel1=$conexion->prepare($consul);
      $consultar_nivel1->execute(array()); 
      echo 1; 
    }else{
      echo 0;
    }   
  }else{
    echo 3;
  }
  
}













































 
function tecnico(){
 require '../conexion.php';
    
  $sql = "SELECT * FROM `escala_tecnica` ORDER BY escala_tecnica.desde"; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array()); 
  ?>
    <div class="col-md-12" style="margin-bottom: 20px">
    <div id="_MSG6_"></div>
      <div class="col-md-12">

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal23"  >agregar</button><br><br>

      </div>

        <table class="table table-hover">
          <tr> 
            <td>Nombre</td>
            <td>Sigla</td>
            <td>Rango minimo</td>
            <td>Rango maximo</td>
            <td>Minimo de aprovacion</td>
            <td>Eliminar</td>
          </tr>
          <?php foreach ($consultar_nivel1 as $key ) { ?>
            <tr id="row2<?php echo $key['id_escala_tecnica']  ?>"> 
              
              <td>
                <input type="" name="nombre" id="nombre<?php echo $key['id_escala_tecnica']  ?>" class="form-control" value="<?php echo $key['nombre']; ?> " onchange="
                    var col=document.getElementById('nombre<?php echo $key['id_escala_tecnica']  ?>').value;
                    var nombre='nombre';
                    var id=<?php echo($key['id_escala_tecnica']) ?>;
                    var atras='<?php echo $key['nombre']; ?>';
                    actualizar_academico4(atras,col,nombre,id) ">
              </td>
              <td>
                <input type="" name="sigla" id="sigla<?php echo $key['id_escala_tecnica']  ?>" class="form-control" value="<?php echo $key['sigla']; ?> " onchange="
                var col=document.getElementById('sigla<?php echo $key['id_escala_tecnica']  ?>').value;
                var nombre='sigla';
                var id=<?php echo($key['id_escala_tecnica']) ?>;
                var atras='<?php echo $key['sigla']; ?>';
                actualizar_academico3(atras,col,nombre,id) ">

              </td>
              <td>
                <input type="" name="desde" id="desde<?php echo $key['id_escala_tecnica']  ?>" class="form-control" value="<?php echo $key['desde']; ?>" onchange="
                var col=document.getElementById('desde<?php echo $key['id_escala_tecnica']  ?>').value;
                var nombre='desde';
                var id=<?php echo($key['id_escala_tecnica']) ?>;
                var atras='<?php echo $key['desde']; ?>';
                actualizar_academico2(atras,col,nombre,id) ">
              </td>
              <td>
                <input type="" name="hasta" id="hasta<?php echo $key['id_escala_tecnica']  ?>" class="form-control" value="<?php echo $key['hasta']; ?>" onchange="
                var col=document.getElementById('hasta<?php echo $key['id_escala_tecnica']  ?>').value;
                var nombre='hasta';
                var id=<?php echo($key['id_escala_tecnica']) ?>;
                var atras='<?php echo $key['hasta']; ?>';
                actualizar_academico1(atras,col,nombre,id) ">
              </td>
              <td><select class="form-control" id="mini<?php echo $key['id_escala_tecnica']  ?>" onchange="
                    var col=document.getElementById('mini<?php echo $key['id_escala_tecnica']  ?>').value;
                    var nombre='mini';
                    var id=<?php echo($key['id_escala_tecnica']) ?>;
                    var atras='<?php echo $key['mini']; ?>';
                    actualizar_academicossz(atras,col,nombre,id)">
                  <?php 

                    if ($key['mini']==1) {
                      ?>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                      <?php
                    }else{
                      ?>

                        <option value="0">No</option>
                        <option value="1">Si</option>
                      <?php
                    }

                   ?>
                
                
              </select></td>
              <td>
                <a id="" href="#" data-toggle="modal" data-target="#e<?php echo $key['id_escala_tecnica']; ?>">
                  <img style="width: 20px;margin-right: 10px; " src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
                  </a>
              </td><div class="modal fade" id="e<?php echo $key['id_escala_tecnica']; ?>"  >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p>Si elimina la tecnica  eliminara sus competencias estás seguro de hacerlo  ?</p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                               
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

                      onclick="var eliminar=<?php echo $key['id_escala_tecnica']; ?>;
                                var fila='row2<?php echo $key["id_escala_tecnica"] ?>';
                       

                        elimna_tecnico(eliminar,fila)">Aceptar</button> 

                              </div>
                            </div>
                          </div>
                        </div>
              
            </tr>
          <?php } ?>
        </table>  
      </div>
  <script type="text/javascript">

    function  actualizar_academicossz(atras,col,nombre,id){
      
      var minimo=col;
      $.ajax({   
        type: "post", 
        data:{col,nombre,id,minimo},
        url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tecnico", 
        dataType:"text", 

        success:function(data){  
          if (data==1) {  
            mensaje6(3,'Registro actualizado');
          }if (data==0) {  
            document.getElementById(nombre+id).value=atras;    
            mensaje6(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
          }if (data==3) { 
            document.getElementById(nombre+id).value=atras;   
            mensaje6(1,'No se repetir  el mismo dato ');
          }
        }  
      });
      
    }


    function  actualizar_academico4(atras,col,nombre,id){
      var minimo=0;
      if(ESnombre(col)){
          mensaje6(2,"El nombre de la nota solo permirte letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tecnico", 
          dataType:"text", 

          success:function(data){ 
         
            if (data==1) {  
              mensaje6(3,'Registro actualizado');
            }if (data==0) {  
              document.getElementById(nombre+id).value=atras;    
              mensaje6(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
            } 
          }  
        });
      }
    }
    function  actualizar_academico3(atras,col,nombre,id){
      var minimo=0;
      if(ESnombre(col)){
          mensaje6(2,"La sigla de la nota solo permite letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tecnico", 
          dataType:"text", 

          success:function(data){ 
         
            if (data==1) {  
              mensaje6(3,'Registro actualizado');
            }if (data==0) {  
              document.getElementById(nombre+id).value=atras;    
              mensaje6(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
            }  
          }  
        });
      }
    }  
    function  actualizar_academico2(atras,col,nombre,id){
      var minimo=0;
      if(decimaa(col)){
          mensaje6(2,"La nota minima solo permirte numeros enteros o decimales con punto");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tecnico", 
          dataType:"text", 

          success:function(data){
         
            if (data==1) {  
              mensaje6(3,'Registro actualizado');
            }if (data==0) {  
              document.getElementById(nombre+id).value=atras;    
              mensaje6(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
            }   
          }  
        });
      }
    }
    function  actualizar_academico1(atras,col,nombre,id){
      var minimo=0;
      if(decimaa(col)){
          mensaje6(2,"La nota maximo solo permirte numeros enteros o decimales con punto");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id,minimo},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tecnico", 
          dataType:"text", 

          success:function(data){  

         
            if (data==1) {  
              mensaje6(3,'Registro actualizado');
            }if (data==0) {  
              document.getElementById(nombre+id).value=atras;    
              mensaje6(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o el  1 al 15 de enero ');
            } 
          }  
        });
      }
    }
  function elimna_tecnico(eliminar,fila){ 

       $.ajax({   
        type: "post", 
        data:{eliminar,fila},
        url:"../../../ajax/rector/mi_colegio.php?action=elimna_tecnico", 
        dataType:"text", 

        success:function(data){  
                $("#"+fila).remove(); 


        }  


      });
     } 
  </script>
                <?php
}

function elimna_tecnico(){ 
  require '../conexion.php';
  $eliminar=$_POST['eliminar'];
  $consultar_nivel="DELETE FROM `escala_tecnica`  WHERE `escala_tecnica`.`id_escala_tecnica` = $eliminar";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $registro=$consultar_nivel1->fetchAll();

}


function actualizar_tecnico(){
  require '../conexion.php';date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $fechas=$fecha+0;
  $ano=date('Y');
  //if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<222 )) { 
    $w='';
    $sss=0;

    if ($_POST['minimo']==1 ) {
      $w='   escala_tecnica.mini="'.$_POST['col'].'"   '; 
      $consuls="SELECT escala_tecnica.id_escala_tecnica from escala_tecnica WHERE  $w    ";
      $ss=$conexion->prepare($consuls);
      $ss->execute(array()); 
      $sss=$ss->rowCount();
    } 

    if ($sss==0) {
      $sql = "UPDATE `escala_tecnica` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `escala_tecnica`.`id_escala_tecnica`= ".$_POST['id']." "; 
      $consultar_nivel1=$conexion->prepare($sql);
      $consultar_nivel1->execute(array());
      echo 1;
    }else{
      echo 3;
    }
  //}else{
  //  echo 0;
  //}


}
 
  function agregar_tecnico(){ 
  require '../conexion.php';
  echo $consul="INSERT INTO `escala_tecnica` ( `desde`, `hasta`, `sigla`, `nombre`, `numero`) VALUES( '".$_POST['Desde2']."', '".$_POST['Hasta2']."', '".$_POST['Sigla2']."', '".$_POST['SS2']."' ,'".$_POST['numer12']."')";
  $consultar_nivel1=$conexion->prepare($consul);
  $consultar_nivel1->execute(array()); 
}












function mostrar_validation(){
 require '../conexion.php';
 date_default_timezone_set("America/Bogota");
 $ano=date('Y');
  $consultar_nivel="SELECT * FROM datos  ";
 $consultar_nivel1=$conexion->prepare($consultar_nivel);
 $consultar_nivel1->execute(array()); 
 foreach ($consultar_nivel1 as $key ) {
  $calificaciones=$key['calificaciones'];
  $boletines=$key['boletines']; 
  $id_datos=$key['id_datos'];
  $habilitar_asistencia=$key['habilitar_asistencia'];
  $actualizar_asistencia=$key['actualizar_asistencia'];
  $max_inasistencia=$key['max_inasistencia'];
  $max_retardos=$key['max_retardos'];
  $personal_acargo=$key['personal_acargo'];
 } 
    ?>
  <div style="overflow: auto; height: 330px" >
    <div class="col-md-12" style=" margin-bottom: 30px"> 
      <label for="nombre">Calificaciones </label>
      <select class="form-control" id="Calificaciones" onchange="var col=document.getElementById('Calificaciones').value;
      var col1=<?php echo($id_datos) ?>;var col2='calificaciones'; fun(col2,col,col1)" >
      <?php 
      if ($calificaciones=='1') { ?>     
        <option value="1">SOLO LOS ADMINISTRADORES PUEDE AGREGAR LAS NOSTA DEFINITIVAS  </option>
        <option value="0">PERMITIR  A LOS DOCENTES   AGREGAR LAS NOSTA DEFINITIVAS  </option>     <?php }  

      if ($calificaciones=='0') { ?>
        <option value="0">PERMITIR  A LOS DOCENTES   AGREGAR LAS NOSTA DEFINITIVAS  </option>     
        <option value="1">SOLO LOS ADMINISTRADORES PUEDE AGREGAR LAS NOSTA DEFINITIVAS  </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-12" style=" margin-bottom: 30px"> 
      <label for="nombre">Boletines </label>
             <select class="form-control" id="Boletines" onchange="var col=document.getElementById('Boletines').value;
             var col1=<?php echo($id_datos) ?>;var col2='boletines'; fun(col2,col,col1)" >
      <?php 
      if ($boletines=='0') { ?>     
        <option value="0">HABILITAR BOLETINES A PADRES DE FAMILIA CUANDO CIERRAN PERIODO  </option>
        <option value="1">HABILITAR BOLETINES CUANDO EL DOCENTE SE ASESORE QUE EL PADRE VINO A LA REUNION  </option>     <?php }  

      if ($boletines=='1') { ?>
        <option value="1">HABILITAR BOLETINES CUANDO EL DOCENTE SE ASESORE QUE EL PADRE VINO A LA REUNION  </option>     
        <option value="0">HABILITAR BOLETINES A PADRES DE FAMILIA CUANDO CIERRAN PERIODO  </option>
        <?php } ?>
      </select>       
        </div>
    <div class="col-md-12" style=" margin-bottom: 30px"> 
      <label for="nombre">Asistencia </label>
             <select class="form-control" id="Asistencia" onchange="var col=document.getElementById('Asistencia').value;
             var col1=<?php echo($id_datos) ?>;var col2='habilitar_asistencia';
             if (col==1) { document.getElementById('actualizar_asistencia1').style.display='block'; }
             if (col==0) { document.getElementById('actualizar_asistencia1').style.display='none'; }
              fun(col2,col,col1)" >
      <?php 
      if ($habilitar_asistencia=='0') { ?>     
        <option value="0">INHABILITAR LA ASISTENCIA DE LOS ALUMNOS EN SUS CLASES</option>
        <option value="1">HABILITAR ASISTENCIA SEGUN SU CARGA ACADEMICA POR CURSO Y AREA EN EL DIA </option>     <?php }  

      if ($habilitar_asistencia=='1') { ?>
        <option value="1">HABILITAR ASISTENCIA SEGUN SU CARGA ACADEMICA POR CURSO Y AREA EN EL DIA </option>       
        <option value="0">INHABILITAR LA ASISTENCIA DE LOS ALUMNOS EN SUS CLASES</option>
        <?php } ?>
      </select>       
    </div>
      <div class="col-md-12" id="actualizar_asistencia1"  style=" margin-bottom: 30px;
      <?php if ($habilitar_asistencia=='0') {
        echo "display:none;";
      } ?>
      "> 
        <label for="nombre">Modificar asistencia </label>
               <select class="form-control" id="actualizar_asistencia" onchange="var col=document.getElementById('actualizar_asistencia').value;
               var col1=<?php echo($id_datos) ?>;var col2='actualizar_asistencia'; fun(col2,col,col1)" >
        <?php 
        if ($actualizar_asistencia=='0') { ?>     
          <option value="0">PERMITIR A LOS DOCENTES MODIFICAR Y ELIMINAR EL HISTORIAL DE LAS INASISTENCIAS DE  LOS ALUMNOS  </option>
          <option value="1">SOLO LOS ADMINISTRADORES PUEDEN MODIFICAAR Y ELIMINAR   EL HISTORIAL DE LAS INASISTENCIAS DE  LOS ALUMNOS  </option>     <?php }  

        if ($actualizar_asistencia=='1') { ?>
          <option value="1">SOLO LOS ADMINISTRADORES PUEDEN MODIFICAAR Y ELIMINAR   EL HISTORIAL DE LAS INASISTENCIAS DE  LOS ALUMNOS  </option>    
          <option value="0">PERMITIR A LOS DOCENTES MODIFICAR Y ELIMINAR EL HISTORIAL DE LAS INASISTENCIAS DE  LOS ALUMNOS  </option>
          <?php } ?>
        </select>  
      </div>
      <div class="col-md-12" style=" margin-bottom: 30px"> 
      <label for="nombre">Numero maximo de inasistencias </label>
             <input type="number" value="<?php echo $max_inasistencia  ?>" class="form-control" id="max" onchange="var col=document.getElementById('max').value;
             var col1=<?php echo($id_datos) ?>;var col2='max_inasistencia'; 
              fun(col2,col,col1)" >      
    </div> 
    <div class="col-md-12" style=" margin-bottom: 30px"> 
      <label for="nombre">Personal acargo de hacer el seguimiento a las inasistencias y los retardos estudiantiles </label>
             <select class="form-control" id="Personal" onchange="var col=document.getElementById('Personal').value;
             var col1=<?php echo($id_datos) ?>;var col2='personal_acargo'; fun(col2,col,col1)" >
      <?php 
      if ($personal_acargo=='0') { ?>     
        <option value="0">Rector  </option> 
        <option value="1">Coordinador </option> 
        <option value="2">Psicoorientador  </option>     <?php }  

      if ($personal_acargo=='1') { ?>
        <option value="1">Coordinador </option> 
        <option value="0">Rector  </option> 
        <option value="2">Psicoorientador  </option> 
        <?php }  
      if ($personal_acargo=='2') { ?>
        <option value="2">Psicoorientador  </option> 
        <option value="0">Rector  </option> 
        <option value="1">Coordinador </option> 
        <?php } ?>
      </select>       
        </div>
     
  </div> 
  <?php
}
  

function actualizar_va(){
  require '../conexion.php';
  $sql = "UPDATE `datos` SET `".$_POST['col2']."` = '".$_POST['col']."' WHERE `datos`.`id_datos`= ".$_POST['col1']." "; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array());
}























































 
function TIPO_N(){
 require '../conexion.php';
 date_default_timezone_set("America/Bogota");
 $ano=date('Y');
  $consul="  INSERT INTO `historial_tipo_calificaiones` ( `id_tipo_calificaciones`, `nombre`, `descripcion`, `porceentajes`, `numero`, `ano`) 
  SELECT tipo_calificaiones.id_tipo_calificaciones, tipo_calificaiones.nombre,tipo_calificaiones.descripcion,tipo_calificaiones.porceentajes,tipo_calificaiones.numero,'$ano' from tipo_calificaiones WHERE tipo_calificaiones.id_tipo_calificaciones not in( SELECT  historial_tipo_calificaiones.id_tipo_calificaciones from historial_tipo_calificaiones WHERE historial_tipo_calificaiones.ano='$ano') ";
  $consultar_nivel1=$conexion->prepare($consul);
  $consultar_nivel1->execute(array());

  $sql = "SELECT * FROM `tipo_calificaiones` ORDER BY numero"; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array()); 
  ?>
    <div  style="margin-bottom: 20px;padding-left: 16px;padding-right: 16px">
    <div id="_MSG8_"></div>
      <div class=" " style=" "> 

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#TIPO_Nfff"  >Agregar</button><br><br>
 
      </div>
 

      <div class="table-responsive" style=" "  > 
      <table class=" table  "> 
        <tr>
          <th  > Numero</th>
          <th style="padding-right: 100px" > Nombre</th>
          <th style="padding-right: 200px" >Descripcion </th>
          <th  > Porcentaje</th>
          <th  > </th>
        </tr>
       
                  <?php foreach ($consultar_nivel1 as $key ) { ?>
                   <tr id="row9<?php echo $key["id_tipo_calificaciones"] ?>"> 
                    <td>
                    
                    <input type="number" name="numero" id="numero<?php echo $key['id_tipo_calificaciones']  ?>" class="form-control" value="<?php echo $key['numero']; ?>" onchange="
                    var col=document.getElementById('numero<?php echo $key['id_tipo_calificaciones']  ?>').value;
                    var nombre='numero';
                    var id=<?php echo($key['id_tipo_calificaciones']) ?>;
                    var atras='<?php echo $key['nombre']; ?>';
                    actualizar_ti2(atras,col,nombre,id) ">
                  </td>
                    <td>
                    
                    <input type="" name="nombre" id="nombre<?php echo $key['id_tipo_calificaciones']  ?>" class="form-control" value="<?php echo $key['nombre']; ?> " onchange="
                    var col=document.getElementById('nombre<?php echo $key['id_tipo_calificaciones']  ?>').value;
                    var nombre='nombre';
                    var id=<?php echo($key['id_tipo_calificaciones']) ?>;
                    var atras='<?php echo $key['nombre']; ?>';
                    actualizar_ti4(atras,col,nombre,id) ">
                  </td>

                  <td  >
                    <input style="width: 100%" type="" name="descripcion  " id="descripcion<?php echo $key['id_tipo_calificaciones']  ?>" class="form-control" value="<?php echo $key['descripcion']; ?> " onchange="
                    var col=document.getElementById('descripcion<?php echo $key['id_tipo_calificaciones']  ?>').value;
                    var nombre='descripcion';
                    var id=<?php echo($key['id_tipo_calificaciones']) ?>;
                    var atras='<?php echo $key['descripcion']; ?>';
                    actualizar_ti3(atras,col,nombre,id) ">
                  </td>
                  <td >
                    <input type="" name="porceentajes" id="porceentajes<?php echo $key['id_tipo_calificaciones']  ?>" class="form-control" value="<?php echo $key['porceentajes']; ?>" onchange="
                    var col=document.getElementById('porceentajes<?php echo $key['id_tipo_calificaciones']  ?>').value;
                    var nombre='porceentajes';
                    var id=<?php echo($key['id_tipo_calificaciones']) ?>;
                    var atras='<?php echo $key['porceentajes']; ?>';
                    actualizar_ti2(atras,col,nombre,id) ">
                  </td>
                   
                  <td> <center>
                  <a  id="" href="#" data-toggle="modal" data-target="#e<?php echo $key['id_tipo_calificaciones']; ?>">
                  <img style="width: 20px;margin-right: 10px; " src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
                  </a></center>
                  <td>
                  </tr>
               
                        <div class="modal fade" id="e<?php echo $key['id_tipo_calificaciones']; ?>"  >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p>Estas seguro de eliminar el tipo de nota?</p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                               
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

                      onclick="var eliminar=<?php echo $key['id_tipo_calificaciones']; ?>;
                                var fila='row9<?php echo $key["id_tipo_calificaciones"] ?>';
                       

                        elimna_tipo(eliminar,fila)">Aceptar</button> 

                              </div>
                            </div>
                          </div>
                        </div>
                <?php }?> </table></div></div>
  <script type="text/javascript">
    function  actualizar_ti4(atras,col,nombre,id){
      if(ESnombre(col)){
          mensaje8(2,"El nombre de la nota solo permirte letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tipo", 
          dataType:"text", 

          success:function(data){ 
          if (data==1) {
              mensaje8(3,'Registro actualizado');
              
            } else{
                $('#'+nombre+id).html(atras);
              mensaje8(1,'Los Tipos de notas solo se pueden actualizar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
            }  
             
          }  
        });
      }
    }
    function  actualizar_ti3(atras,col,nombre,id){
      if(ESnombre(col)){
          mensaje8(2,"La sigla de la nota solo permite letras");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tipo", 
          dataType:"text", 

          success:function(data){  
            if (data==1) {
              mensaje8(3,'Registro actualizado');
              
            } else{
                  $('#'+nombre+id).html(atras);
              mensaje8(1,'Los Tipos de notas solo se pueden actualizar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
            }
          }  
        });
      }
    }  
    function  actualizar_ti2(atras,col,nombre,id){
      if(decimaa(col)){
          mensaje8(2,"La nota minima solo permirte numeros enteros o decimales con punto");
          document.getElementById(nombre+id).focus();    
          document.getElementById(nombre+id).value=atras;
          return false; 
      }else{ 
        $.ajax({   
          type: "post", 
          data:{col,nombre,id},
          url:"../../../ajax/rector/mi_colegio.php?action=actualizar_tipo", 
          dataType:"text", 

          success:function(data){   
 
            if (data==1) {
              mensaje8(3,'Registro actualizado');
              
            } else{
                $('#'+nombre+id).html(atras);
              mensaje8(1,'Los Tipos de notas solo se pueden actualizar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
            }
          }  
        });
      }
    }
    
  function elimna_tipo(eliminar,fila){ 

       $.ajax({   
        type: "post", 
        data:{eliminar,fila},
        url:"../../../ajax/rector/mi_colegio.php?action=elimna_tipo", 
        dataType:"text", 

        success:function(data){  
          
          if (data==1) {
            mensaje8(3,'Registro eliminado');
            $("#"+fila).remove(); 
          } else{
            mensaje8(1,'Los Tipos de notas solo se pueden eliminar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
          }
        }  


      });
     } 
  </script>
                <?php
}

function elimna_tipo(){ 
  require '../conexion.php';
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $ano=date('Y');
  $fechas=$fecha+0;
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {  
    $eliminar=$_POST['eliminar'];
    $consultar_nivel="DELETE FROM historial_tipo_calificaiones  WHERE historial_tipo_calificaiones.ano='$ano'  and     historial_tipo_calificaiones.id_tipo_calificaciones = $eliminar;
                      DELETE FROM tipo_calificaiones  WHERE tipo_calificaiones.id_tipo_calificaciones = $eliminar";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $registro=$consultar_nivel1->fetchAll();
    echo 1;
  }else{
    echo 0;
  }
}


function actualizar_tipo(){
  require '../conexion.php';
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $ano=date('Y');
  $fechas=$fecha+0;
  if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {   
    require '../conexion.php';
    $sql = "UPDATE `historial_tipo_calificaiones` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `historial_tipo_calificaiones`.`id_tipo_calificaciones`= ".$_POST['id']."  and  `historial_tipo_calificaiones`.`ano`= '$ano'; UPDATE `tipo_calificaiones` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `tipo_calificaiones`.`id_tipo_calificaciones`= ".$_POST['id']." "; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
    echo 1;
  }else{
    echo 0;
  }
}
 
function agregar_tipo(){ 
  require '../conexion.php';
  date_default_timezone_set("America/Bogota"); 
  $fecha=date("md");
  $fechas=$fecha+0;
  $consul="SELECT tipo_calificaiones.nombre from tipo_calificaiones where nombre= '".$_POST['Nombre7']."' or  descripcion='".$_POST['Descripcion']."'     or  numero='".$_POST['numer123']."' ";
  $consultar_nivel1=$conexion->prepare($consul);
  $consultar_nivel1->execute(array()); 
  $sss=$consultar_nivel1->rowCount();
  if($sss==0){ 
    if (($fechas>1202 && $fechas<1232) or ( $fechas>100 &&  $fechas<116 )) {   
      $consul="INSERT INTO `tipo_calificaiones` ( `nombre`, `descripcion`, `porceentajes`, `numero`) VALUES  ( '".$_POST['Nombre7']."', '".$_POST['Descripcion']."', '".$_POST['Porcentaje']."', '".$_POST['numer123']."')";
      $consultar_nivel1=$conexion->prepare($consul);
      $consultar_nivel1->execute(array()); 
      echo 1;
    }else{
      echo 3;
    }
  }else{
    echo 0;
  }
}








  ?>
