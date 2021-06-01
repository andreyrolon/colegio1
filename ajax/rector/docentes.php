


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}


/////////////////////////////////////// funciones de la pagina de la vista grado grado_por_materia.php
 
function ver_titular(){
  include '../conexion.php'; 
  $consultar_nivel="SELECT foto,id_docente,nombre,apellido from docente WHERE docente.inhabilitado not in('1')";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $registro=$consultar_nivel1->fetchAll();
  $consul="SELECT grado_sede.id, grado.nombre as grado,curso.numero as curso,docente.nombre,docente.id_docente,docente.apellido,docente.foto  from curso,grado,grado_sede grado_sede LEFT JOIN docente on docente.id_docente=grado_sede.titular WHERE grado_sede.id_jornada_sede='".$_POST['i']."'  and grado_sede.id_grado=grado.id_grado   and grado_sede.id_curso=curso.id_curso  order by grado.id_grado";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array()); 
  $sql3=$consulta->rowCount();
  if ($sql3>0) { 
  ?>
    <link rel="stylesheet" href="../../../css/chosen.css">
    <link rel="stylesheet" href="../../../css/ImageSelect.css"> 
    <script src="../../../js/chosen.jquery.js"></script>
    <script src="../../../js/ImageSelect.jquery.js"></script> 
    <style>
      tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
        }
    </style>
    <table  style="padding: 5px;  " class="table table-hover">
      <tr>
        <th width="">id</th>
        <th width="">Grado</th>
        <th width="">Curso</th>
        <th width=""> tiulares</th>
      </tr>
      <?php
      $s=1;
      foreach ($consulta as $key ) {
         ?>
        <tr>
          <td><?php echo $s++ ?></td>
          <td><?php echo $key['grado'] ?></td>
          <td><?php echo $key['curso'] ?></td>
          <td>
            <select  style="width: 300px" class=" form-control my-select" id="<?php echo $key['id'] ?>"  onchange=" 
            var id_docente= document.getElementById('<?php echo $key['id'] ?>').value;
            id=<?php echo $key['id'] ?>; 
            myFunction(id_docente,id)"    >
              <?php
              if ($key['id_docente']!='') {
                ?> 
                <option selected="selected"  data-img-src="<?php echo $key['foto'] ?>" value="<?php echo $key['id_docente'] ?>"><?php echo $key['nombre'].' '.$key['apellido'] ?></option>  
                <?php
              }else{
                ?>
                <option value="todas">Seleccione un docente</option>
                <?php
              }
              foreach ($registro as   $value) {
                if ($key['id_docente']!=$value['id_docente']) { 
                  ?> 
                  <option data-img-src="<?php echo $value['foto'] ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
                  <?php
                }
              } ?>


            </select>
          </td>
        </tr>
      <?php } ?>
    </table> 

    <script> 
       $(".my-select").chosen()({
             placeholder: "Select a state",
          allowClear: true
      }); 
         

     
    </script><?php
  }
}
function actualizar_titulaar(){
  include '../conexion.php'; 
  $consultar_nivel="UPDATE `grado_sede` SET `titular` = '".$_POST['id_docente']."' WHERE `grado_sede`.`id` = '".$_POST['id']."';";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}
function validar_documento(){
  include "../conexion.php";
  $numero_documento=$_POST['numero_documento'];
  $tipo_documento=$_POST['tipo_documento'];
  $consultar_nivel="SELECT docente.id_docente from docente  WHERE docente.numero_documento='$numero_documento'  and docente.tipo_documento='$tipo_documento'";
     $consultar_nivel1=$conexion->prepare($consultar_nivel);
     $consultar_nivel1->execute(array());
     $sql3=$consultar_nivel1->rowCount();
     if ($sql3>0) {?>
      <script type="text/javascript">
       mensaje(1,'el numero de documento ya esta registrado en el sistema');
        document.getElementById('NUMERO_DOCUMENTO').focus(); 
       </script><?php
     } else{
      echo " ";
     }

}






function excel(){
  include '../conexion.php';  
  include '../../Classes/PHPExcel/IOFactory.php';
  $c = $_FILES['ex'];
  $nombreArchivo=$c['tmp_name'];
  $objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
  $objPHPExcel->setActiveSheetIndex(0);
  $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
  
   
  
  for($i = 2; $i <= $numRows; $i++){
    
    $A = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
    $B = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
    $C = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
    $D = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
    $E = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(); 
    $F = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
    $G = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
    $H = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
    $I = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();

    $J = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue()));

    $K = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
    $L = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
    $M = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
    $N = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue(); 
    $O = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
    $P = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue(); 
    $Q = $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();  

    $R = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue()));
    
    $S = $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue(); 
    if($O==''){
      $cor = password_hash('1234',PASSWORD_DEFAULT);
    }else{
      $cor = password_hash($O,PASSWORD_DEFAULT);
    }
   

    $sql = "INSERT INTO `docente` ( `nombre`, `apellido`, `telefono`, `celular`, `genero`, `foto`, `fecha_nacimiento`, `barrio`, `tipo_documento`, `numero_documento`, `expedicion`, `correo`, `clave`, `escalafon`, `direccion`, `fecha_nombramiento`, `decreto_nombramiento`, `decreto_traslado`, `fecha_traslado`, `inhabilitado`, `fecha`, `pais`, `estado`, `ciudad`)VALUES ('$A', '$B', '$N', '$M', '$I', '', '$J', '$L', '$C', '$D', '$E', '$P', '$cor', '$Q',  '$K', '$R', '$S',  '', '', '0','','$F','$G','$H')";
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array()); 
    $recupera =$conexion->lastInsertId() ;



$consultar_nivel="INSERT INTO `docente_habilitado` (`id_periodo`, `activo_nota`, `activo_recuperacion`, `id_docente`) SELECT numero,'0','0', '$recupera' FROM periodo  ";
    $consultar_nivel12=$conexion->prepare($consultar_nivel);
    $consultar_nivel12->execute(array());  
 
  


}
}
function registro(){


  if(isset($_POST['TELEFONO_CA'])){ $TELEFONO_CA=$_POST['TELEFONO_CA']; }else{$TELEFONO_CA='';}
  if(isset($_POST['CELULAR'])){ $CELULAR=$_POST['CELULAR']; }else{$CELULAR='';}
  if(isset($_POST['CORREO'])){ $CORREO=$_POST['CORREO']; }else{$CORREO='';}
  if(isset($_POST['ESCALAFON'])){ $ESCALAFON=$_POST['ESCALAFON']; }else{$ESCALAFON='';}
  if(isset($_POST['CIUDAD'])){ $CIUDAD=$_POST['CIUDAD']; }else{$CIUDAD='';}
  if(isset($_POST['Area'])){ $Area=$_POST['Area']; }else{$Area='';}
  if(isset($_POST['PAIS'])){ $porcion=explode(',', $_POST['PAIS']);$PAIS=$porcion[1]; }else{$PAIS='';}

  $ruta2='';
  $soporte='';
  if(isset($_POST['ad'])){
    if(isset($_FILES['imgh'])){ 
      $soporte=$_FILES['imgh'];
    }
    if ($soporte['tmp_name']==='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).$_POST['ad'];
        $ruta2='../../img/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
        $ruta2='../'.$ruta2;
    }
  }

 
  $cor = password_hash($_POST['CLAVE'],PASSWORD_DEFAULT);
 
  include './../conexion.php'; 
 echo   $consultar_nivel="INSERT INTO `docente` ( `nombre`, `apellido`, `telefono`, `celular`, `genero`, `foto`, `fecha_nacimiento`, `barrio`, `tipo_documento`, `numero_documento`, `expedicion`, `correo`, `clave`, `escalafon`, `direccion`, `fecha_nombramiento`, `decreto_nombramiento`, `decreto_traslado`, `fecha_traslado`, `inhabilitado`, `fecha`, `pais`, `estado`, `ciudad`) VALUES ('".$_POST['NOMBRE']."', '".$_POST['APELLIDO']."', '".$TELEFONO_CA."', '".$CELULAR."', '".$_POST['GENERO']."', '$ruta2', '".$_POST['FECHA_NACIMIENTO']."', '".$_POST['BARRIO']."', '".$_POST['TIPO_DOCUMENTO']."', '".$_POST['NUMERO_DOCUMENTO']."', '".$_POST['EXPEDICION']."', '".$CORREO."', '".$cor."' , '".$ESCALAFON."', '".$_POST['DIRECCION']."','', '', '', '', '0',  '', '".$PAIS."', '".$_POST['ESTADO']."', '".$CIUDAD."')";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  $recupera =$conexion->lastInsertId() ;

  $items2a=$_POST['nombre'];
  $items3a=$_POST['institucion'];
  $items4a=$_POST['ano'];   

  $r=0;
  foreach ($items2a as $key ) {
    if ($key!='') {
      $sql = "INSERT INTO titulos_docente ( nombre, institucion, ano, id_docente) VALUES ('$key','$items3a[$r]','$items4a[$r]','$recupera')"; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
    }

    
    $r=$r+1;
  }
  foreach ($Area as $keyq ) {
    $sql = "INSERT INTO `area_docente` ( `area`, `id_docente`) VALUES ('$keyq', '$recupera')"; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
  }
   
 
    $consultar_nivel="INSERT INTO `docente_habilitado` (`id_periodo`, `activo_nota`, `activo_recuperacion`, `id_docente`) SELECT numero,'0','0', '$recupera' FROM periodo  ";
    $consultar_nivel12=$conexion->prepare($consultar_nivel);
    $consultar_nivel12->execute(array());  

  
 

}



function hoja_vida(){

  require '../conexion.php';
  $sql = "SELECT * FROM docente WHERE docente.id_docente=".$_POST['id']; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array());
  foreach ($consultar_nivel1 as $key ) {
    $id=$key['id_docente']; 
    $nombre=$key['nombre'];
     $apellido=$key['apellido'];

     $telefono=$key['telefono'];
    $celular=$key['celular'];
    $genero=$key['genero'];

     $foto=$key['foto'];
      $fecha_nacimiento=$key['fecha_nacimiento'];
      $lugar_nacimiento=$key['lugar_nacimiento'];
      $barrio=$key['barrio']; 
    $tipo_documento=$key['tipo_documento'];
    $numero_documento=$key['numero_documento'];
    $correo= $key['correo']; $clave=$key['clave'];
     $escalafon=$key['escalafon'];
     $direccion=$key['direccion'];
    $fecha_nombramiento= $key['fecha_nombramiento'];
    $decreto_nombramiento=$key['decreto_nombramiento'];
    $decreto_traslado= $key['decreto_traslado']; 
    $fecha_traslado=$key['fecha_traslado'];
  }
  ?>

  <ul class="nav nav-tabs">
<li class="active"><a href="#activity" data-toggle="tab">Datos Personales</a></li>
<li><a href="#timeline" data-toggle="tab">Información de Contacto</a></li>
<li><a href="#settings" data-toggle="tab">Información laboral</a></li>
</ul>
<div class="tab-content">
<div class="active tab-pane" id="activity">
<form id="myForm" action="" method="post">
<div class="row">
<div class="col-md-12">
<div class="col-md-6">
<label for="documento">Documento</label>
<select class="form-control" style="width: 19%;" id="tipo_documento" onchange='
var col=document.getElementById("tipo_documento").value;
var nombre="tipo_documento";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>

  <option value="<?php echo($tipo_documento) ?>"><?php echo($tipo_documento) ?></option>
<?php  
$ui='<option value="<?php echo($tipo_documento) ?>"><?php echo($tipo_documento) ?></option>';
$vec=array("<option value='CC'>CC</option>","<option value='CE'>CE</option>");
  foreach ($vec as $value) {
    if ($ui!=$value) {
      echo $value;
    }
  }

 ?>
</select>
<input type="number" class="form-control" name="numero_documento" id="numero_documento" value="<?php echo($numero_documento) ?>"  style=" margin-top: -34px; margin-left: 69px; width: 81%;"  
 oninput='
var col=document.getElementById("numero_documento").value;
var nombre="numero_documento";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-6">
<label for="genero">Genero</label>
<input type="" value="<?php echo($genero) ?>" class="form-control" id="genero" name="genero" 
oninput='
var col=document.getElementById("genero").value;
var nombre="genero";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
 
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label for="nombre">Nombres</label>
<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo($nombre) ?>" 
oninput='
var col=document.getElementById("nombre").value;
var nombre="nombre";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-6">
<label for="apellido">Apellidos</label>
<input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo($apellido) ?>"  oninput='
var col=document.getElementById("apellido").value;
var nombre="apellido";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label for="fecha_n">Fecha nacimiento</label>
<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo($fecha_nacimiento) ?>"  oninput='
var col=document.getElementById("fecha_nacimiento").value;
var nombre="fecha_nacimiento";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-6">
<label for="lugar_n">Lugar nacimiento</label>
<input type="text" name="lugar_nacimiento" id="lugar_nacimiento" class="form-control" value="<?php echo($lugar_nacimiento) ?>" oninput='
var col=document.getElementById("lugar_nacimiento").value;
var nombre="lugar_nacimiento";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="timeline">
<form id="Form" action="" method="post">
<div class="row">
<div class="col-md-12">
<div class="col-md-6">
<label for="email">Email</label>
<input type="email" name="correo" id="correo" class="form-control" value="<?php echo($correo) ?>" 
oninput='
var col=document.getElementById("correo").value;
var nombre="correo";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-6">
<label for="celular">Celular</label>
<input type="number" name="celular" id="celular" class="form-control" value="<?php echo($celular) ?>"
oninput='
var col=document.getElementById("celular").value;
var nombre="celular";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '
>
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label for="telefono">Telefono</label>
<input type="number" name="telefono" id="telefono" class="form-control" value="<?php echo($telefono) ?>"
oninput='
var col=document.getElementById("telefono").value;
var nombre="telefono";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-6">
<label for="direccion">Direccion</label>
<input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo($direccion) ?>" oninput='
var col=document.getElementById("direccion").value;
var nombre="direccion";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
</div>
<div class="col-md-12">
<div class="col-md-3"></div>
<div class="col-md-6">
<label for="barrio">Barrio</label>
<input type="text" name="barrio" id="barrio" class="form-control" value="<?php echo($barrio) ?>"
oninput='
var col=document.getElementById("barrio").value;
var nombre="barrio";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-3"></div>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="settings">
<form id="FormLa" action="" method="post">
<div class="row">
<div class="col-md-12">
<div class="col-md-6">
 
<label for="titulo">Decreto de nombramiento</label>
<input type="text" name="decreto_nombramiento" id="decreto_nombramiento" class="form-control" value="<?php echo($decreto_nombramiento) ?>" 
oninput='
var col=document.getElementById("decreto_nombramiento").value;
var nombre="decreto_nombramiento";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-6">
<label for="institucion">Fecha de nombramiento</label>
<input type="date" name="fecha_nombramiento" id="fecha_nombramiento" class="form-control" value="<?php echo($fecha_nombramiento) ?>" oninput='
var col=document.getElementById("fecha_nombramiento").value;
var nombre="fecha_nombramiento";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
 
</div>
 <div class="col-md-12"><br>
<div class="col-md-4">
<label for="titulo">Decreto de traslado</label>
<input type="text" name="decreto_traslado" id="decreto_traslado" class="form-control" value="<?php echo($decreto_traslado) ?>" oninput='
var col=document.getElementById("decreto_traslado").value;
var nombre="decreto_traslado";
var id=<?php echo $id; ?>
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-4">
<label for="institucion">Fecha de traslado</label>
<input type="date" name="fecha_traslado" id="fecha_traslado" class="form-control" value="<?php echo($fecha_traslado) ?>" oninput='
var col=document.getElementById("fecha_traslado").value;
var nombre="fecha_traslado";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
<div class="col-md-4">

<label for="escalafon">Escalafon</label>
<input type="number" name="escalafon" id="escalafon" class="form-control" value="10" 
oninput='
var col=document.getElementById("escalafon").value;
var nombre="escalafon";
var id=<?php echo $id; ?>;
   actualizar_hoja(col,nombre,id) '>
</div>
</div>
 

<div class="col-md-12"><hr>
<div id="titulos"></div>
</div>
<div class="col-md-12">
 
<div class="col-md-3"><button type="button" name="nuevo" id="nuevo" class="btn btn-info" style="margin-top: 23px;">Nuevo titulo</button></div>
</div>
</div>
</form>
</div>
<!-- /.tab-pane -->
</div>
<!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->

<script type="text/javascript">

  function   actualizar_hoja(col,nombre,id){
    $.ajax({   
      type: "post", 
      data:{col,nombre,id},
      url:"../../../ajax/rector/docentes.php?action=actualizar_hoja1", 
      dataType:"text", 

      success:function(data){   



      }  
    });

  }
  $(document).ready(function(){  

    var nombre=document.getElementById("nombre").value; 
    var apellido=document.getElementById("apellido").value; 

    var foto='<?php echo $foto; ?>'; 
    function img(){

      var id=<?php echo $id ?>;
      $.ajax({   
        type: "post", 
        data:{nombre,foto,apellido,id},
        url:"../../../ajax/rector/docentes.php?action=imagen", 
        dataType:"text", 

        success:function(data){  
          $('#imagen').html(data); 



        }  });} 
      img();
      function mostrar(){
       var id=<?php echo $id ?>;
       $.ajax({   
        type: "post", 
        data:{id},
        url:"../../../ajax/rector/docentes.php?action=hoja_vida_titulos", 
        dataType:"text", 

        success:function(data){  
          $('#titulos').html(data); 


        }  


      });
     }  
     mostrar();




     $("#nuevo").click(function(){
      var id=<?php echo $id ?>;
      $.ajax({   
        type: "post", 
        data:{id},
        url:"../../../ajax/rector/docentes.php?action=nuevo_titulos", 
        dataType:"text", 

        success:function(data){  
          mostrar(); 


        }  


      });

    });
   }); 
 </script>
 <?php
}

function hoja_vida_titulos(){

  require '../conexion.php'; 
  $sql = "SELECT * FROM titulos_docente WHERE titulos_docente.id_docente=".$_POST['id']; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array());
  foreach ($consultar_nivel1 as $key ) {
    $id=$key['id_titulo_docente'];
    ?>
    <div class="col-md-4" id="fila1<?php echo $id ?>">
      <label for="titulo">Titulo</label>
      <input type="text" name="titulo<?php echo $id; ?>" id="titulo<?php echo $id; ?>" class="form-control" value="<?php echo($key['nombre']) ?>" oninput='
var col=document.getElementById("titulo<?php echo $id; ?>").value;
var nombre="nombre";
var id=<?php echo $id; ?>;
   actualizar_titulo(col,nombre,id) '>
    </div>
    <div class="col-md-4" id="fila2<?php echo $id ?>">
      <label for="institucion">Graduado en</label>
      <input type="text" name="institucion<?php echo $id; ?>" id="institucion<?php echo $id; ?>" class="form-control" value="<?php echo $key['institucion'] ?>" oninput='
var col=document.getElementById("institucion<?php echo $id; ?>").value;
var nombre="institucion";
var id=<?php echo $id; ?>;
   actualizar_titulo(col,nombre,id) '>
    </div>
    <div class="col-md-3" id="fila3<?php echo $id ?>">
      <label for="ano">Año</label>
      <input type="text" name="ano<?php echo $id; ?>" id="ano<?php echo $id; ?>" class="form-control" value="<?php echo($key['ano']) ?>" oninput='
var col=document.getElementById("ano<?php echo $id; ?>").value;
var nombre="ano";
var id=<?php echo $id; ?>;
   actualizar_titulo(col,nombre,id) '>
    </div>
    <div class="col-md-1" id="fila4<?php echo $id ?>"><a  onclick=" var id=<?php echo $id  ?> ;  liminar_titulo(id)">
      <img style="width: 25px;margin-top: 28px" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
      </a>
    </div>
    <script type="text/javascript">
   function   liminar_titulo(id){
         $.ajax({   
          type: "post", 
          data:{id},
          url:"../../../ajax/rector/docentes.php?action=liminar_titulo", 
          dataType:"text", 

          success:function(data){    
            
            $("#fila1"+id).remove();

            $("#fila2"+id).remove();
            $("#fila3"+id).remove();
            $("#fila4"+id).remove();
          }  
        });
      }

      function actualizar_titulo(col,nombre,id){
         $.ajax({   
          type: "post", 
          data:{col,nombre,id},
          url:"../../../ajax/rector/docentes.php?action=actualizar_titulo", 
          dataType:"text", 

          success:function(data){    

          }  
        });

  
      }
    </script>
    <?php
  }
}

function nuevo_titulos(){ 
  require '../conexion.php'; 
  $sql = "INSERT INTO `titulos_docente` (`id_titulo_docente`, `nombre`, `institucion`, `ano`, `id_docente`) VALUES (NULL, '', '', '', '".$_POST['id']."')"; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array());
}



function imagen(){
  require '../conexion.php'; 
  $sql = "SELECT * FROM docente WHERE docente.id_docente=".$_POST['id']; 
  $consultar_nivel1=$conexion->prepare($sql);
  $consultar_nivel1->execute(array());
  foreach ($consultar_nivel1 as $key ) {
    $foto=$key['foto'];
  }
  ?>
  <img class="profile-user-img img-responsive img-circle" src="<?php echo($foto) ?>" alt="User profile picture" style="    margin: 0 auto;
  width: 180px;height: 180px;
  padding: 3px;
  border: 3px solid #d2d6de;">
  <h3 class="profile-username text-center">
    <?php echo($_POST['nombre']) ?> <?php echo($_POST['apellido']) ?> </h3>
    <p class="text-muted text-center">Docente</p>
  <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
      <div class="btn btn-default btn-file">
        <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
        <input type="file" name="Foto" id="Foto">
      </div>
      <input type="hidden" value="<?php echo $_POST['nombre'] ?>" name="nombre" id='nombre'>
      <input type="hidden" value="<?php echo $_POST['apellido'] ?>" name="apellido" id='apellido'>
      <input type="hidden" name="url" id="url" value="<?php echo($foto) ?>">
      <input type="hidden" name="id" id="id"  value="<?php echo $_POST['id'] ?>">
      <button type="button" class="btn btn-primary" name="foto" onclick="sasa()">Subir</button>
<br><br><a style="color: #fff" data-toggle="modal" data-target="#mymodal">
      <div class="btn btn-default btn-file" style="width: 100% ;background-color: #d73925;color: #fff">

        <img style="margin-right: 5px; width: 20px"  src="data:image/svg+xml;base64,
PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTUxMC4zNzEsMjI2LjUxM2MtMS4wODgtMi42MDMtMi42NDUtNC45NzEtNC42MjktNi45NTVsLTYzLjk3OS02My45NzljLTguMzQxLTguMzItMjEuODI0LTguMzItMzAuMTY1LDAgICAgIGMtOC4zNDEsOC4zNDEtOC4zNDEsMjEuODQ1LDAsMzAuMTY1bDI3LjU4NCwyNy41ODRIMzIwLjAxM2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzNzOS41MzYsMjEuMzMzLDIxLjMzMywyMS4zMzMgICAgIGgxMTkuMTY4bC0yNy41ODQsMjcuNTg0Yy04LjM0MSw4LjM0MS04LjM0MSwyMS44NDUsMCwzMC4xNjVjNC4xNiw0LjE4MSw5LjYyMSw2LjI1MSwxNS4wODMsNi4yNTFzMTAuOTIzLTIuMDY5LDE1LjA4My02LjI1MSAgICAgbDYzLjk3OS02My45NzljMS45ODQtMS45NjMsMy41NDEtNC4zMzEsNC42MjktNi45NTVDNTEyLjUyNSwyMzcuNjA2LDUxMi41MjUsMjMxLjcxOCw1MTAuMzcxLDIyNi41MTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGN0Y1RjUiIGRhdGEtb2xkX2NvbG9yPSIjM0YzRjNGIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0zNjIuNjgsMjk4LjY2N2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzN2MTA2LjY2N2gtODUuMzMzVjg1LjMzM2MwLTkuNDA4LTYuMTg3LTE3LjcyOC0xNS4yMTEtMjAuNDM3ICAgICBsLTc0LjA5MS0yMi4yMjloMTc0LjYzNXYxMDYuNjY3YzAsMTEuNzc2LDkuNTM2LDIxLjMzMywyMS4zMzMsMjEuMzMzczIxLjMzMy05LjU1NywyMS4zMzMtMjEuMzMzdi0xMjggICAgIEMzODQuMDEzLDkuNTU3LDM3NC40NzcsMCwzNjIuNjgsMEgyMS4zNDdjLTAuNzY4LDAtMS40NTEsMC4zMi0yLjE5NywwLjQwNWMtMS4wMDMsMC4xMDctMS45MiwwLjI3Ny0yLjg4LDAuNTEyICAgICBjLTIuMjQsMC41NzYtNC4yNjcsMS40NTEtNi4xNjUsMi42NDVjLTAuNDY5LDAuMjk5LTEuMDQ1LDAuMzItMS40OTMsMC42NjFDOC40NCw0LjM1Miw4LjM3Niw0LjU4Nyw4LjIwNSw0LjcxNSAgICAgQzUuODgsNi41NDksMy45MzksOC43ODksMi41MzEsMTEuNDU2Yy0wLjI5OSwwLjU3Ni0wLjM2MywxLjE5NS0wLjU5NywxLjc5MmMtMC42ODMsMS42MjEtMS40MjksMy4yLTEuNjg1LDQuOTkyICAgICBjLTAuMTA3LDAuNjQsMC4wODUsMS4yMzcsMC4wNjQsMS44NTZjLTAuMDIxLDAuNDI3LTAuMjk5LDAuODExLTAuMjk5LDEuMjM3VjQ0OGMwLDEwLjE3Niw3LjE4OSwxOC45MjMsMTcuMTUyLDIwLjkwNyAgICAgbDIxMy4zMzMsNDIuNjY3YzEuMzg3LDAuMjk5LDIuNzk1LDAuNDI3LDQuMTgxLDAuNDI3YzQuODg1LDAsOS42ODUtMS42ODUsMTMuNTI1LTQuODQzYzQuOTI4LTQuMDUzLDcuODA4LTEwLjA5MSw3LjgwOC0xNi40OTEgICAgIHYtMjEuMzMzSDM2Mi42OGMxMS43OTcsMCwyMS4zMzMtOS41NTcsMjEuMzMzLTIxLjMzM1YzMjBDMzg0LjAxMywzMDguMjI0LDM3NC40NzcsMjk4LjY2NywzNjIuNjgsMjk4LjY2N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y3RjVGNSIgZGF0YS1vbGRfY29sb3I9IiMzRjNGM0YiPjwvcGF0aD4KCQk8L2c+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />Inhabilitar cuenta 
                                    </div></a>
        <div class="modal fade" id="mymodal" data-keyboard="true" data-backdrop="false"  backdrop="">
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
                  id="btn"   onclick="var io= <?php echo($_POST['id']) ?>; Inhabilitar(io)">Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>
    </form>
    <script type="text/javascript"> 
  
      function sasa() {
          var foto=document.getElementById("Foto").value; 
          var nombre=document.getElementById("nombre").value; 
          var apellido=document.getElementById("apellido").value; 
          var id=document.getElementById("id").value; 
       var parametros=new FormData($("#formulario-envia")[0]);
       
           $.ajax({
      
      data:parametros,
      url:"../../../ajax/rector/docentes.php?action=actualizar_img",
      type:"POST",
      contentType:false,
      processData:false,
      success: function(data){
          function img(){

       
      $.ajax({   
        type: "post", 
        data:{nombre,foto,apellido,id},
        url:"../../../ajax/rector/docentes.php?action=imagen", 
        dataType:"text", 

        success:function(data){  
          $('#imagen').html(data); 



        }  });
    } 
      img();
      }
       });
        
      } 
    </script>
    <?php
  }
  function actualizar_img(){
    require '../conexion.php'; 
    $Foto=$_FILES['Foto'];
    $url=$_POST['url'];
    if ($url=='') {
      $url='dsad';
    }
    $urll=substr($url, 3);
    unlink("$urll");
    $na=md5($Foto['tmp_name']).'.jpg';
    $ruta2='../../img/'.$na;
    move_uploaded_file($Foto['tmp_name'], $ruta2);

     $consultar_nivel= "UPDATE `docente` SET `foto` = '../".$ruta2."' WHERE `docente`.`id_docente` = ".$_POST['id'].""; 
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }
  function Inhabilitar(){
    
    require '../conexion.php'; 
    $sql = "UPDATE   `are_grado_sede`  SET id__docente='0'  WHERE `are_grado_sede`.`id__docente` = ".$_POST['io'].""; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());

    $sql = "DELETE FROM `area_docente`  WHERE `area_docente`.`id_docente` = ".$_POST['io'].""; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
    $sql = "UPDATE   `competencias` SET id_docente= '0'  WHERE `competencias`.`id_docente` = ".$_POST['io'].""; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());

     $sql = "UPDATE `docente` SET `inhabilitado` = '1' WHERE `docente`.`id_docente` = ".$_POST['io'].""; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array()); ?>
    <script type="text/javascript">
     
    </script>
    <?php
  }
  function actualizar_titulo(){
    require '../conexion.php'; 

     $sql = "UPDATE `titulos_docente` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `titulos_docente`.`id_titulo_docente` = ".$_POST['id'].";"; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());
  }
  function actualizar_hoja1(){
    
    require '../conexion.php'; 
    $sql = "UPDATE `docente` SET `".$_POST['nombre']."` = '".$_POST['col']."' WHERE `docente`.`id_docente` = ".$_POST['id'].";"; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());

  }

function liminar_titulo(){
    require '../conexion.php'; 
    echo $sql = "DELETE FROM `titulos_docente`  WHERE `titulos_docente`.`id_titulo_docente` = ".$_POST['id'].";"; 
    $consultar_nivel1=$conexion->prepare($sql);
    $consultar_nivel1->execute(array());  
}





///fin de la hoja de videa del docente




//inicio de la carga academica




////tabla de carga academica por curso por area observar las areas y horario

function tabla_docente(){
  ?>
   

<!-- /.tab-content -->

<!-- /.nav-tabs-custom -->


 </div>
 <?php
}














function area_acargo(){     

 include '../conexion.php';


   $style=$_POST['style'];
  if(isset($_POST['dato'])){
   $d=$_POST['dato'];
 }else{
  $d='';
}

  if(isset($_POST['id_docente'])){
   $id_docente=$_POST['id_docente'];
 }else{
  $id_docente='';
}
if(isset($_POST['i'])){
 $paginaActual = $_POST['i'];
}else{
 $paginaActual=1;
}


   $consultar_nivel="
select q.horas,q.nombre,q.id_area_grado_sede,q.id,q.sede,q.jornada,q.grado,q.curso ,q.codigo,q.area from (SELECT z.horas,z.nombre,z.id_area_grado_sede,z.id,z.sede,z.jornada,z.grado,z.curso ,z.codigo,z.area from ( SELECT area.codigo,area.area, area.horas,area.nombre,are_grado_sede.id_area_grado_sede,q.id,q.sede,q.jornada,q.grado,q.curso from are_grado_sede INNER JOIN area on area.id_area=are_grado_sede.id_area INNER JOIN (SELECT grado_sede.id,j.sede,j.jornada, grado.nombre as grado,curso.numero as curso from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN (SELECT jornada_sede.ID_JS, sede.NOMBRE as sede , jornada.NOMBRE as jornada from jornada_sede,sede,jornada WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA)as j on j.ID_JS=grado_sede.id_jornada_sede)as q on are_grado_sede.id_grado_sede=q.id and are_grado_sede.id__docente=$id_docente )as z where z.nombre like('%$d%') or z.curso like('%$d%') or z.sede like('%$d%')  or z.jornada  like('%$d%') or z.grado like('%$d%')   ORDER by z.id_area_grado_sede DESC)as q WHERE  q.codigo=01 or  q.area not in('1')  ";
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
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunctions('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
   $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunctions('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunctions('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunctions('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}
 
$consultar_nivel="select q.horas,q.nombre,q.id_area_grado_sede,q.id,q.sede,q.jornada,q.grado,q.curso ,q.codigo,q.area from (SELECT z.horas,z.nombre,z.id_area_grado_sede,z.id,z.sede,z.jornada,z.grado,z.curso ,z.codigo,z.area from ( SELECT area.codigo,area.area, area.horas,area.nombre,are_grado_sede.id_area_grado_sede,q.id,q.sede,q.jornada,q.grado,q.curso from are_grado_sede INNER JOIN area on area.id_area=are_grado_sede.id_area INNER JOIN (SELECT grado_sede.id,j.sede,j.jornada, grado.nombre as grado,curso.numero as curso from grado_sede INNER JOIN grado on grado.id_grado=grado_sede.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN (SELECT jornada_sede.ID_JS, sede.NOMBRE as sede , jornada.NOMBRE as jornada from jornada_sede,sede,jornada WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA)as j on j.ID_JS=grado_sede.id_jornada_sede)as q on are_grado_sede.id_grado_sede=q.id and are_grado_sede.id__docente=$id_docente )as z where z.nombre like('%$d%') or z.curso like('%$d%') or z.sede like('%$d%')  or z.jornada  like('%$d%') or z.grado like('%$d%')  ORDER by z.id_area_grado_sede DESC)as q WHERE  q.codigo=01 or  q.area not in('1')    LIMIT $limit, $nroLotes ";
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

      <button type="button" class="btn btn-default btn-sm"  onclick="actualizar()"> <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGcgaWQ9Imxvb3BfeDVGX2FsdDIiPgoJCTxnPgoJCQk8cGF0aCBkPSJNMTkuOTQ1LDIybDYuMDA4LThMMzIsMjJoLTR2MmMwLDMuMzA5LTIuNjkxLDYtNiw2SDEwYy0zLjMwOSwwLTYtMi42OTEtNi02di0yaDR2MiAgICAgYzAsMS4xMDIsMC44OTgsMiwyLDJoMTJjMS4xMDIsMCwyLTAuODk4LDItMnYtMkgxOS45NDV6IiBmaWxsPSIjMDAwMDAwIi8+CgkJCTxwYXRoIGQ9Ik0xMi4wNTUsMTBsLTYuMDA4LDhMMCwxMGg0VjhjMC0zLjMwOSwyLjY5MS02LDYtNmgxMmMzLjMwOSwwLDYsMi42OTEsNiw2djJoLTRWOCAgICAgYzAtMS4xMDItMC44OTgtMi0yLTJIMTBDOC44OTgsNiw4LDYuODk4LDgsOHYySDEyLjA1NXoiIGZpbGw9IiMwMDAwMDAiLz4KCQk8L2c+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" style='width: 14px;height: 14px' ></button>
      <button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button> 
      <?php if($paginaActual > 1){
        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunctions('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunctions('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunctions('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunctions('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>

    <div class="table-responsive mailbox-messages" style="
  
  text-align: justify; /* For Edge */
  -moz-text-align-last: left; /* For Firefox prior 58.0 */
  text-align-last: left; ">

     
 <br><table class="table table-striped  table-hover" style="<?php echo $style ?>">
      <tr><th >#</th> 
      <th>Asigantura</th>  

      <th >Sede</th>

      <th  >Jornada</th>
      <th >Grado</th>
      <th >Curso</th>
      <th>Hora</th>
      <th >Eliminar</th>

      </tr>  <?php
      foreach ($registro as $registro2) {
        ?>
        <tr id="fila<?php echo($registro2['id_area_grado_sede']) ?>">
          <td>
          <input class="sss" type="checkbox" name="id[]" value="<?php echo($registro2['id_area_grado_sede']) ?>"></td> 
          <td><?php echo($registro2['nombre']) ?></td>
          <td><?php echo($registro2['sede']) ?></td>
          <td><?php echo($registro2['jornada']) ?></td>
          <td><?php echo($registro2['grado']) ?></td>
          <td><?php echo($registro2['curso']) ?></td>  
          <td> <?php
            
            $horario="SELECT count(horario.id_area_grado_sede)as h FROM horario WHERE  horario.id_area_grado_sede=".$registro2['id_area_grado_sede'];
            $horario2=$conexion->prepare($horario);
            $horario2->execute(array());
            foreach ($horario2 as $horario2) {
              echo $horario2['h'];
            }?>
          </td>
          
          <td>

            <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $registro2['id_area_grado_sede'];?>">
               <img style="width: 20px;margin-right: 10px;float: left;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
            </a>              
          </td>
        </tr>
        <div class="modal fade" id="mymodal<?php echo $registro2['id_area_grado_sede'];?>" data-keyboard="true" data-backdrop="false"  backdrop="false">
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
                  id="btn"   onclick="var io= <?php echo($registro2['id_area_grado_sede']) ?>; aliminar_area_acargo(io)">Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div> <?php  
      } ?>
    </table>

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

function aliminar_area_acargo(){
  include '../conexion.php';
  $consultar_nivel=" UPDATE `are_grado_sede` SET `id__docente` = '0' WHERE `are_grado_sede`.`id_area_grado_sede` = ".$_POST['io'];
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
 

  ?>
  <script type="text/javascript">  $("#fila<?php echo $_POST['io'] ?>").remove();
    mensaje(3,'Haz eliminado la asignatura que tenia acargo el docente');

      
 

  
  </script>
  <?php
}

function aliminar_area_acargos(){
  include '../conexion.php';
  $id=$_POST['id'];
  if ($id=='') {?>
    <script type="text/javascript">
      mensaje(2,'debe selecionar las asignaturas que desee eliminar')
    </script><?php
  }else{ 
    foreach ($id as  $value) {
    echo  $consultar_nivel=" UPDATE `are_grado_sede` SET `id__docente` = '0' WHERE `are_grado_sede`.`id_area_grado_sede` = ".$value;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
     

      ?>
      <script type="text/javascript"> 
        $("#fila<?php echo $value ?>").remove();
      </script>
      <?php
    }
    ?>
    <script type="text/javascript">
      mensaje(3,'Haz eliminado las asignaturas que tenia acargo el docente'); 

    </script> <?php
  }  
}



function tabla_carga_curso(){
 include '../conexion.php';

$style=$_POST['style'];
  $consultar_nivel="SELECT  J.NOMBRE as jornada FROM grado_sede INNER JOIN (SELECT  jornada_sede.ID_JS ,jornada.NOMBRE from jornada_sede,jornada where jornada_sede.id_jornada=jornada.ID_JORNADA)AS J ON J.ID_JS=grado_sede.id_jornada_sede where grado_sede.id= ".$_POST['grado'];
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());

  foreach ($consultar_nivel1 as $key ) {
    $jornada=$key['jornada'];
  } 
  if ($_POST['consul']=='todo') {
    $UPDATE="UPDATE `are_grado_sede` SET `id__docente` = '0' WHERE `are_grado_sede`.`id__docente` = ".$_POST['docente2'];
    $UPDATE1=$conexion->prepare($UPDATE);
    $UPDATE1->execute(array());

    $UPDATE="UPDATE `are_grado_sede` SET `id__docente` = '0'    WHERE `are_grado_sede`.`id_grado_sede` = ".$_POST['grado'];
    $UPDATE1=$conexion->prepare($UPDATE);
    $UPDATE1->execute(array());

    $UPDATE="UPDATE `are_grado_sede` SET `id__docente` = '".$_POST['docente2']."'    WHERE `are_grado_sede`.`id_grado_sede` = ".$_POST['grado'];
    $UPDATE1=$conexion->prepare($UPDATE);
    $UPDATE1->execute(array());
    ?>
    <a href="../sedes/horario.php?id=<?php echo  $_POST['grado'] ?>" target="_blank"  class="btn btn-info "   style="width: 100%">Ver horario</a>
    <script type="text/javascript">
      var id_docente=<?php echo $_POST['docente2']; ?>;
      var mySelect=''; var dato='';
      var style='<?php echo $style ?>';
      $.ajax({   
        type: "post", 
        data:{id_docente,mySelect,dato,style},
        url:"../../../ajax/rector/docentes.php?action=area_acargo", 
        dataType:"text",
        success:function(data){   
          $('#area_acargo').html(data);
        } 
      });
    </script><?php
  }else{
        ?>  
    <style type="text/css">
    ul.ksw-cboxtags {
        list-style: none;
        padding: 4px;
    }
    ul.ksw-cboxtags li{
      display: inline;
    }
    ul.ksw-cboxtags li label{
        display: inline-block;
        background-color: rgba(255, 255, 255, .9);
        border: 2px solid rgba(139, 139, 139, .3);
        color: #adadad;
        border-radius: 25px;
        white-space: nowrap;
        margin: 0px 0px;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
        transition: all .2s;
    }

    ul.ksw-cboxtags li label {
        padding: 8px 12px;
        cursor: pointer;
    }

    ul.ksw-cboxtags li label::before {
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 12px;
        padding: 2px 6px 2px 2px;
        content: "\f067";
        transition: transform .3s ease-in-out;
    }

    ul.ksw-cboxtags li input[type="checkbox"]:checked + label::before {
        content: "\f00c";
        transform: rotate(-360deg);
        transition: transform .3s ease-in-out;
    }

    ul.ksw-cboxtags li input[type="checkbox"]:checked + label {
        border: 2px solid #1bdbf8;
        background-color: #12bbd4;
        color: #fff;
        transition: all .2s;
    }

    ul.ksw-cboxtags li input[type="checkbox"] {
      display: absolute;
    }
    ul.ksw-cboxtags li input[type="checkbox"] {
      position: absolute;
      opacity: 0;
    }
    ul.ksw-cboxtags li input[type="checkbox"]:focus + label {
     border: 2px solid #e9a1ff;
    } 
     
    </style>
    <div class="active tab-pane" id="activity3s">  
      <br>
      <?php
      include '../conexion.php';
        $style=$_POST['style'];
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
      $consultar_nivel="SELECT d.aa,d.codigo,d.id_area_grado_sede,d.h,d.nombre,d.apellido,d.id_docente,d.area,d.id FROM (SELECT q.aa,q.codigo,q.id_area_grado_sede,q.h,q.nombre,q.apellido,q.id_docente,q.area,q.id FROM (SELECT area.area as aa,area.codigo, are_grado_sede.id_area_grado_sede, COUNT(horario.id_area_grado_sede)as h, docente.nombre,docente.apellido,docente.id_docente,area.nombre as area,grado_sede.id FROM are_grado_sede INNER JOIN grado_sede on are_grado_sede.id_grado_sede=grado_sede.id LEFT JOIN docente on docente.id_docente=are_grado_sede.id__docente INNER JOIN area on area.id_area=are_grado_sede.id_area LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede where area.nombre like('%$d%') and grado_sede.id=".$_POST['grado']."  GROUP by are_grado_sede.id_area_grado_sede )as q WHERE q.nombre LIKE '%$d%'or q.area LIKE '%$d%' or q.apellido LIKE '%$d%')as d where d.codigo='01' or d.aa not in('1') ";
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
        $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myno('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
      }

      for($i=1; $i<=$nroPaginas; $i++){
        if($i == $paginaActual){
         $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myno('.$i.')">'.$i.'</button></li>';
       }else{
        $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myno('.$i.')">'.$i.'</button></li>';
      }
      }
      if($paginaActual < $nroPaginas){
        $lista = $lista.'<li>
        <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myno('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
        $o=0;
      }else{
        $o=1;
      }

      if($paginaActual <= 1){
        $limit = 0;
      }else{
        $limit = $nroLotes*($paginaActual-1);
      }

      ?><input type="hidden" value="<?php echo $paginaActual  ?>" id='ios'><?php
       $docenx="SELECT  * from docente where id_docente=".$_POST['docente2'];
      $docenxc=$conexion->prepare($docenx);
      $docenxc->execute(array());
      $docenxcz=$docenxc->fetchAll();
      foreach ($docenxcz as $key  ) {
        $nomjk=$key['nombre'];
        $apesd=$key['apellido'];
      } 
      $consultar_nivel=" SELECT d.aa,d.codigo,d.id_area_grado_sede,d.h,d.nombre,d.apellido,d.id_docente,d.area,d.id FROM (SELECT q.aa,q.codigo,q.id_area_grado_sede,q.h,q.nombre,q.apellido,q.id_docente,q.area,q.id FROM (SELECT area.area as aa,area.codigo, are_grado_sede.id_area_grado_sede, COUNT(horario.id_area_grado_sede)as h, docente.nombre,docente.apellido,docente.id_docente,area.nombre as area,grado_sede.id FROM are_grado_sede INNER JOIN grado_sede on are_grado_sede.id_grado_sede=grado_sede.id LEFT JOIN docente on docente.id_docente=are_grado_sede.id__docente INNER JOIN area on area.id_area=are_grado_sede.id_area LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede where area.nombre like('%$d%') and grado_sede.id=".$_POST['grado']."  GROUP by are_grado_sede.id_area_grado_sede )as q WHERE q.nombre LIKE '%$d%'or q.area LIKE '%$d%' or q.apellido LIKE '%$d%')as d where d.codigo='01' or d.aa not in('1')   LIMIT $limit, $nroLotes ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $registro=$consultar_nivel1->fetchAll(); 
      $registrow=$consultar_nivel1->rowCount();
      ?>  
      <form method="post" id="actualizatea">
        <div class="box-body no-padding"> 
          <div class="mailbox-controls">
             
            <div class="btn-group"> 
              <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal12"><i class="fa  fa-check-square"></i></button> 
              <?php if($paginaActual > 1){
                echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myno('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} 
              if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myno('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
            </div> 
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
              } ?>
              <div class="btn-group"> 
                <?php if($paginaActual > 1){
                echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myno('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} 
                if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myno('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>
              </div>
            </div>
          </div>

          <div class="table-responsive  "><br>
            <table class="table table-striped  table-hover" style="<?php echo $style ?>">
              <tr>            
                <td > #</td>
                <th><span >Horas</span></th>
                <th><span >Asignatura</span></th>
                <th><span >docente</span></th>     
              </tr>
              <?php  $nom=array('1checkboax','1checkboaxOne','1checkboaxTwo','1checkboaxThree','1checkboaxFour','1checkboaxFive','1checkboaxSix','1checkboaxSeven','1checkboaxEight','1checkboaxNine','1checkboaxTen','1checkboaxTwelve','1checkboaxThirteen','1checkboaxFourteen','1checkboaxFifteen','1checkboaxSixteen','1checkboaxSeventeen','1checkboaxEighteen','1checkboaxNineteen','1checkboaxTwenty','1checkboaxTwenty-one');
              $uno=0;
              foreach ($registro as $key  ) {
                if ($key['aa']!=1 || $key['codigo']==01) {?>
                  <tr>            
                    <td>
                      <label class="dfg"> <?php 
                        if ($key['id_docente']==$_POST['docente2']){  ?>
                          <input type="checkbox" name="jk[]"   value="<?php echo $key['id_area_grado_sede'] ?> 0"> 
                        <?php }else{ ?>
                          <input type="checkbox" name="jk[]"   value="<?php echo $key['id_area_grado_sede'] ?> <?php echo $_POST['docente2'] ?>">
                        <?php } ?>
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td><span style="font-size:  19px"><?php echo $key['h'] ?></span></td>
                    <td><span style="font-size:  19px"><?php echo $key['area'] ?></span></td>
                    <td>  
                      <ul class="ksw-cboxtags"><?php 
                        if ($key['id_docente']==$_POST['docente2']) { ?>
                          <li>
                            <input type="checkbox"  checked  id="<?php echo $nom[$uno] ?>" name='<?php echo $key['id_area_grado_sede'] ?>' value="<?php echo $key['id_area_grado_sede'] ?>" onclick="
                            var opk=   confirm('Esta seguro de eliminar la asignatura?');
                            if(opk==true){ 
                              var t=document.getElementById('color<?php echo $nom[$uno] ?>').style.display;
                              if(t=='block'){
                                document.getElementById('color<?php echo $nom[$uno] ?>').style.display='none'  ;
                                document.getElementById('color2<?php echo $nom[$uno] ?>').style.display='block'  ;
                                var docente=0;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }else{
                                document.getElementById('color<?php echo $nom[$uno] ?>').style.display='block'  ;
                                document.getElementById('color2<?php echo $nom[$uno] ?>').style.display='none'  ;
                                var docente=<?php echo $_POST['docente2'] ?>;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }
                            }else{
                              document.getElementById('<?php echo $nom[$uno] ?>').checked=true;
                              return;
                            }">
                            <label for="<?php echo $nom[$uno] ?>" >
                              <div id="color<?php echo $nom[$uno] ?>" style="float: right;display: block;"><?php echo $key['nombre'].' '. $key['apellido'] ?>
                              </div>
                              <div id="color2<?php echo $nom[$uno] ?>" style="float: right;display: none;">No tiene docente registrado </div>
                            </label>
                          </li>      <?php
                        }else{?> 
                          <li>
                            <input type="checkbox"     id="<?php echo $nom[$uno] ?>" name='<?php echo $key['id_area_grado_sede'] ?>' value="<?php echo $key['id_area_grado_sede'] ?>" onclick="

                            var opk=   confirm('Esta seguro de eliminar la asignatura?');
                            if(opk==true){ 
                              var t=document.getElementById('color5<?php echo $nom[$uno] ?>').style.display;

                              var t2=document.getElementById('color6<?php echo $nom[$uno] ?>').style.display;
                              var t3=document.getElementById('color7<?php echo $nom[$uno] ?>').style.display;
                              if(t=='block'){
                                document.getElementById('color5<?php echo $nom[$uno] ?>').style.display='none'  ;
                                document.getElementById('color6<?php echo $nom[$uno] ?>').style.display='block'  ;
                                var docente=<?php echo $_POST['docente2'] ?>;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }if(t2=='block'){
                                document.getElementById('color7<?php echo $nom[$uno] ?>').style.display='block'  ;
                                document.getElementById('color6<?php echo $nom[$uno] ?>').style.display='none'  ;
                                 var docente=0;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }
                              if(t3=='block'){
                                document.getElementById('color6<?php echo $nom[$uno] ?>').style.display='block'  ;
                                document.getElementById('color7<?php echo $nom[$uno] ?>').style.display='none'  ;
                                 var docente=<?php echo $_POST['docente2'] ?>;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }
                            }else{
                              document.getElementById('<?php echo $nom[$uno] ?>').checked=false;
                              return;
                            }">
                            <label for="<?php echo $nom[$uno] ?>" >
                              <div id="color5<?php echo $nom[$uno] ?>" style="float: right; display: block;"><?php if ($key['nombre']=='' && $key['apellido']=='') {echo 'No tiene docente registrado';
                                 }else{  echo $key['nombre'].' '. $key['apellido'];} ?>
                              </div>
                              <div id="color7<?php echo $nom[$uno] ?>" style="float: right; display: none;">No tiene docente registrado</div>
                              <div id="color6<?php echo $nom[$uno] ?>" style="float: right; display: none;"><?php echo $nomjk.' '.$apesd; ?></div>
                            </label>
                          </li><?php
                        } ?>
                      </ul>
                    </td>
                  </tr><?php  $uno=$uno+1; 
                } 
              }?>
            </table>

            <div class="modal fade" id="myModal12" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title">Confirmación</h4>
                    </div>
                    <div class="modal-body"> 
                      <p><strong>Nota:</strong> Está seguro de agregar estas asignaturas al docente?  .</p>
                      <input type="submit" style="width: 0;height: 0;background-color: transparent;border:none;" id="tx1" name="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         
                        <button type="button" class="btn btn-primary" ata-dismiss="modal" id="uuu"  onclick="
                    $('#myModal12').modal('hide');delo2();"  >Aceptar</button>
                    </div>
                  </div>
                  
                </div>
            </div>
          </div>  <?php
          echo '  <ul class="pagination" id="pagination">
          <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal12"><i class="fa  fa-check-square"></i></button>'.$lista.'</ul> ' ; ?>
        </div> 
        <script type="text/javascript">
            function delo2(){
              mostrar1();
                setTimeout(function(){ document.getElementById('tx1').click(); }, 1000);
            }
          </script>
      </form> 
    </div><?php
  } 
}


function actualizar_carga_independiente(){
 include '../conexion.php';

  $cont=0;
  $consq="SELECT are_grado_sede.id_area_grado_sede, area.nombre, docente.nombre,docente.id_docente, horario.hora,horario.dias,horario.id_area_grado_sede from are_grado_sede LEFT join docente on docente.id_docente=are_grado_sede.id__docente LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE docente.id_docente=
".$_POST['docente'];
  $cons1q=$conexion->prepare($consq);
  $cons1q->execute(array()); 
  foreach ($cons1q as  $value) {
    $hora1=$value['hora'];
    $dias1=$value['dias'];
    $idli=$value['id_area_grado_sede'];
      $qqq="SELECT area.nombre, docente.nombre,docente.id_docente, horario.hora,horario.dias,horario.id_area_grado_sede from are_grado_sede LEFT join docente on docente.id_docente=are_grado_sede.id__docente LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE are_grado_sede.id_area_grado_sede=".$_POST['area'];
      $qqqq=$conexion->prepare($qqq);
      $qqqq->execute(array()); 
      foreach ($qqqq as $key ) {
        $hora12=$key['hora'];
        $dias12=$key['dias'];
        $idli2=$key['id_area_grado_sede'];
        if ($hora1==$hora12 && $dias1==$dias12) {
          $cont=$cont+1;
          $idli2aa=$idli;
        }
      }
    }
  if ($cont>0) {
    $consq="UPDATE `are_grado_sede` SET `id__docente` = '0'  WHERE `are_grado_sede`.`id_area_grado_sede` = ".$idli2aa;
  $cons1q=$conexion->prepare($consq);
  $cons1q->execute(array()); 
  }
  $consq="UPDATE `are_grado_sede` SET `id__docente` = '".$_POST['docente']."'  WHERE `are_grado_sede`.`id_area_grado_sede` = ".$_POST['area'];
  $cons1q=$conexion->prepare($consq);
  $cons1q->execute(array()); 
}
function actualizar_carga_independiente2(){
 include '../conexion.php';
  $variable=$_POST['jk'];

  foreach ($variable as $kt) {
    $porciones1 = explode(" ", $kt);
    $area=$porciones1[0]; // porción1
    $docente=$porciones1[1];
     $cont=0;
    $consq="SELECT are_grado_sede.id_area_grado_sede, area.nombre, docente.nombre,docente.id_docente, horario.hora,horario.dias,horario.id_area_grado_sede from are_grado_sede LEFT join docente on docente.id_docente=are_grado_sede.id__docente LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE docente.id_docente=".$docente;
    $cons1q=$conexion->prepare($consq);
    $cons1q->execute(array()); 
    foreach ($cons1q as  $value) {
      $hora1=$value['hora'];
      $dias1=$value['dias'];
      $idli=$value['id_area_grado_sede'];
        $qqq="SELECT area.nombre, docente.nombre,docente.id_docente, horario.hora,horario.dias,horario.id_area_grado_sede from are_grado_sede LEFT join docente on docente.id_docente=are_grado_sede.id__docente LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE are_grado_sede.id_area_grado_sede=".$area;
        $qqqq=$conexion->prepare($qqq);
        $qqqq->execute(array()); 
        foreach ($qqqq as $key ) {
          $hora12=$key['hora'];
          $dias12=$key['dias'];
          $idli2=$key['id_area_grado_sede'];
          if ($hora1==$hora12 && $dias1==$dias12) {
            $cont=$cont+1;
            $idli2aa=$idli;
          }
        }
      }
    if ($cont>0) {
      $consq="UPDATE `are_grado_sede` SET `id__docente` = '0'  WHERE `are_grado_sede`.`id_area_grado_sede` = ".$idli2aa;
    $cons1q=$conexion->prepare($consq);
    $cons1q->execute(array()); 
    }
 
    $consq="UPDATE `are_grado_sede` SET `id__docente` = '".$docente."'  WHERE `are_grado_sede`.`id_area_grado_sede` = ".$area;
    $cons1q=$conexion->prepare($consq);
      $cons1q->execute(array()); 
 
  }
 
}
function actualizar_carga_independiente23(){
 include '../conexion.php';
  $variable=$_POST['jk1'];

  foreach ($variable as $kt) {
    $porciones1 = explode(" ", $kt);
    $area=$porciones1[0]; // porción1
    $docente=$porciones1[1];
     $cont=0;
    $consq="SELECT are_grado_sede.id_area_grado_sede, area.nombre, docente.nombre,docente.id_docente, horario.hora,horario.dias,horario.id_area_grado_sede from are_grado_sede LEFT join docente on docente.id_docente=are_grado_sede.id__docente LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE docente.id_docente=".$docente;
    $cons1q=$conexion->prepare($consq);
    $cons1q->execute(array()); 
    foreach ($cons1q as  $value) {
      $hora1=$value['hora'];
      $dias1=$value['dias'];
      $idli=$value['id_area_grado_sede'];
        $qqq="SELECT area.nombre, docente.nombre,docente.id_docente, horario.hora,horario.dias,horario.id_area_grado_sede from are_grado_sede LEFT join docente on docente.id_docente=are_grado_sede.id__docente LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede LEFT JOIN area on area.id_area=are_grado_sede.id_area WHERE are_grado_sede.id_area_grado_sede=".$area;
        $qqqq=$conexion->prepare($qqq);
        $qqqq->execute(array()); 
        foreach ($qqqq as $key ) {
          $hora12=$key['hora'];
          $dias12=$key['dias'];
          $idli2=$key['id_area_grado_sede'];
          if ($hora1==$hora12 && $dias1==$dias12) {
            $cont=$cont+1;
            $idli2aa=$idli;
          }
        }
      }
    if ($cont>0) {
      $consq="UPDATE `are_grado_sede` SET `id__docente` = '0'  WHERE `are_grado_sede`.`id_area_grado_sede` = ".$idli2aa;
    $cons1q=$conexion->prepare($consq);
    $cons1q->execute(array()); 
    }
 
    $consq="UPDATE `are_grado_sede` SET `id__docente` = '".$docente."'  WHERE `are_grado_sede`.`id_area_grado_sede` = ".$area;
    $cons1q=$conexion->prepare($consq);
      $cons1q->execute(array()); 
 
  }
 
}
function carga_por_area(){ 

   include '../conexion.php';
  $id_area=$_POST['id_area'];
  $id_js=$_POST['id_js']; 
  $style=$_POST['style']; 
   $docenx="SELECT nombre,apellido from docente where id_docente=".$_POST['docente2'];
$docenxc=$conexion->prepare($docenx);
$docenxc->execute(array());
$docenxcz=$docenxc->fetchAll();
foreach ($docenxcz as $key  ) {
  $nomjk=$key['nombre'];
  $apesd=$key['apellido'];
}
 

  ?>
 <style type="text/css">
ul.ksw-cboxtags {
    list-style: none;
    padding: 4px;
}
ul.ksw-cboxtags li{
  display: inline;
}
ul.ksw-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 0px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ksw-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ksw-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\f067";
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="checkbox"]:checked + label::before {
    content: "\f00c";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ksw-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ksw-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ksw-cboxtags li input[type="checkbox"]:focus + label {
 border: 2px solid #e9a1ff;
} 
 
</style>
 

 

            <div class="active tab-pane" id="activity3"> 
              <br>

<?php
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


   $consultar_nivel="SELECT QW.id_area_grado_sede      ,QW.id_area   ,QW.H   ,QW.nombre   ,QW.apellido       ,QW.id_docente   ,QW.area   ,QW.id   ,QW.id_curso   ,QW.id_grado   ,QW.grado   ,QW.curso   ,QW.aaa   ,QW.codigo FROM (SELECT   art.id_area_grado_sede ,art.id_area ,art.h ,art.nombre ,art.apellido ,art.id_docente ,art.area ,art.id ,art.id_curso ,art.id_grado ,art.grado ,art.curso,art.aaa,art.codigo from (SELECT are_grado_sede.id_area_grado_sede, area.id_area,area.codigo,area.area as aaa ,COUNT(horario.id_area_grado_sede)as h, docente.nombre,docente.apellido,docente.id_docente,area.nombre as area,q.id,q.id_curso,q.id_grado,q.grado,q.curso FROM are_grado_sede LEFT JOIN docente on docente.id_docente=are_grado_sede.id__docente INNER JOIN area on area.id_area=are_grado_sede.id_area LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede INNER JOIN(SELECT grado.numero, curso.numero as curso ,grado.nombre as grado,grado_sede.* from grado_sede ,grado,curso WHERE grado_sede.id_curso=curso.id_curso and grado_sede.id_grado=grado.id_grado and grado_sede.id_jornada_sede=$id_js  and grado_sede.inhabilitar=0)as q on q.id=are_grado_sede.id_grado_sede where area.nombre='$id_area' GROUP by are_grado_sede.id_area_grado_sede order by q.numero)as art WHERE art.aaa not in  ('1') or art.codigo  in('01'))as QW WHERE QW.nombre LIKE '%$d%' or QW.grado LIKE '%$d%' or QW.curso LIKE'%$d%' ";
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
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="sss1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
   $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="sss1('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="sss1('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="sss1('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}

?><input type="hidden" value="<?php echo $paginaActual  ?>"   id='isi'><?php
 $docenx="SELECT  * from docente where id_docente=".$_POST['docente2'];
$docenxc=$conexion->prepare($docenx);
$docenxc->execute(array());
$docenxcz=$docenxc->fetchAll();
foreach ($docenxcz as $key  ) {
  $nomjk=$key['nombre'];
  $apesd=$key['apellido'];
}





  $consultar_nivel=" SELECT QW.id_area_grado_sede      ,QW.id_area   ,QW.H   ,QW.nombre   ,QW.apellido       ,QW.id_docente   ,QW.area   ,QW.id   ,QW.id_curso   ,QW.id_grado   ,QW.grado   ,QW.curso   ,QW.aaa   ,QW.codigo FROM (SELECT   art.id_area_grado_sede ,art.id_area ,art.h ,art.nombre ,art.apellido ,art.id_docente ,art.area ,art.id ,art.id_curso ,art.id_grado ,art.grado ,art.curso,art.aaa,art.codigo from (SELECT are_grado_sede.id_area_grado_sede, area.id_area,area.codigo,area.area as aaa ,COUNT(horario.id_area_grado_sede)as h, docente.nombre,docente.apellido,docente.id_docente,area.nombre as area,q.id,q.id_curso,q.id_grado,q.grado,q.curso FROM are_grado_sede LEFT JOIN docente on docente.id_docente=are_grado_sede.id__docente INNER JOIN area on area.id_area=are_grado_sede.id_area LEFT JOIN horario on horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede INNER JOIN(SELECT grado.numero, curso.numero as curso ,grado.nombre as grado,grado_sede.* from grado_sede ,grado,curso WHERE grado_sede.id_curso=curso.id_curso and grado_sede.id_grado=grado.id_grado and grado_sede.id_jornada_sede=$id_js  and grado_sede.inhabilitar=0)as q on q.id=are_grado_sede.id_grado_sede where area.nombre='$id_area' GROUP by are_grado_sede.id_area_grado_sede order by q.numero)as art WHERE art.aaa not in  ('1') or art.codigo  in('01'))as QW WHERE QW.nombre LIKE '%$d%' or QW.grado LIKE '%$d%' or QW.curso LIKE'%$d%'  LIMIT $limit, $nroLotes  ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="actualizate3">
 <div class="box-body no-padding">

  <div class="mailbox-controls">
 
 
    <div class="btn-group"> 

    
      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal21"><i class="fa  fa-check-square"></i></button>
      <?php if($paginaActual > 1){
        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="sss1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="sss1('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="sss1('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="sss1('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>

    <div class="table-responsive  ">
 <br><table class="table table-striped  table-hover" style="<?php echo $style ?>">
    <tr>            <td > #</td>
                    <th><span >Curso</span></th> 
                    <th><span >Asignatura</span></th>
                    <th><span >docente</span></th>     
                  </tr>
                  
         <?php  $nom=array('checkboax','checkboaxOne','checkboaxTwo','checkboaxThree','checkboaxFour','checkboaxFive','checkboaxSix','checkboaxSeven','checkboaxEight','checkboaxNine','checkboaxTen','checkboaxTwelve','checkboaxThirteen','checkboaxFourteen','checkboaxFifteen','checkboaxSixteen','checkboaxSeventeen','checkboaxEighteen','checkboaxNineteen','checkboaxTwenty','checkboaxTwenty-one');
                  $uno=0;
                  foreach ($registro as $key  ) {

                     ?>
                 
    <tr>            <td><label class="dfg"> 
      <?php 
                          if ($key['id_docente']==$_POST['docente2']){  ?>
  <input type="checkbox" name="jk1[]"   value="<?php echo $key['id_area_grado_sede'] ?> 0"> <?php }else{ ?>

<input type="checkbox" name="jk1[]"   value="<?php echo $key['id_area_grado_sede'] ?> <?php echo $_POST['docente2'] ?>">

    <?php } ?>
  <span class="checkmark"></span>
</label></td>
                      <td><span style="font-size:  19px"><?php echo $key['grado'] ?>-<?php echo $key['curso'] ?></span></td> 
                      <td><span style="font-size:  19px"><?php echo $key['area'] ?></span></td>
                      <td>  
     
                     
                        <ul class="ksw-cboxtags"><?php 
                          if ($key['id_docente']==$_POST['docente2']) {
                            ?>
                            <li><input type="checkbox"  checked  id="<?php echo $nom[$uno] ?>" name='<?php echo $key['id_area_grado_sede'] ?>' value="<?php echo $key['id_area_grado_sede'] ?>" onclick="

                            var opk=   confirm('Esta seguro de eliminar la asignatura?');
                            if(opk==true){ 
                              var t=document.getElementById('color<?php echo $nom[$uno] ?>').style.display;
                              if(t=='block'){
                                document.getElementById('color<?php echo $nom[$uno] ?>').style.display='none'  ;
                                document.getElementById('color2<?php echo $nom[$uno] ?>').style.display='block'  ;
                                var docente=0;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                                
                              }else{
                                document.getElementById('color<?php echo $nom[$uno] ?>').style.display='block'  ;
                                document.getElementById('color2<?php echo $nom[$uno] ?>').style.display='none'  ;
                                    var docente=<?php echo $_POST['docente2'] ?>;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }
                            }else{
                              
                            }


                            ">
                              <label for="<?php echo $nom[$uno] ?>" >
                                <div id="color<?php echo $nom[$uno] ?>" style="float: right;display: block;"><?php echo $key['nombre'].' '. $key['apellido'] ?></div>
                                <div id="color2<?php echo $nom[$uno] ?>" style="float: right;display: none;">No tiene docente registrado </div>

                              
                              </label></li> 
                            <?php
                          }else{?> 
                       
                            <li>
                              <input type="checkbox"     id="<?php echo $nom[$uno] ?>" name='<?php echo $key['id_area_grado_sede'] ?>' value="<?php echo $key['id_area_grado_sede'] ?>" onclick="

                            var opk=   confirm('Esta seguro de eliminar la asignatura?');
                            if(opk==true){ 
                              var t=document.getElementById('color5<?php echo $nom[$uno] ?>').style.display;

                              var t2=document.getElementById('color6<?php echo $nom[$uno] ?>').style.display;
                              var t3=document.getElementById('color7<?php echo $nom[$uno] ?>').style.display;
                              if(t=='block'){
                                document.getElementById('color5<?php echo $nom[$uno] ?>').style.display='none'  ;
                                document.getElementById('color6<?php echo $nom[$uno] ?>').style.display='block'  ;
                                var docente=<?php echo $_POST['docente2'] ?>;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                                
                              }if(t2=='block'){
                                document.getElementById('color7<?php echo $nom[$uno] ?>').style.display='block'  ;
                                document.getElementById('color6<?php echo $nom[$uno] ?>').style.display='none'  ;
                                 var docente=0;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }
                              if(t3=='block'){
                                document.getElementById('color6<?php echo $nom[$uno] ?>').style.display='block'  ;
                                document.getElementById('color7<?php echo $nom[$uno] ?>').style.display='none'  ;
                                 var docente=<?php echo $_POST['docente2'] ?>;
                                var area=<?php echo $key['id_area_grado_sede'] ?>;
                                titi(docente,area);
                              }
                            }else{
                              return;
                            }


                            ">
                              <label for="<?php echo $nom[$uno] ?>" >
                                <div id="color5<?php echo $nom[$uno] ?>" style="float: right; display: block;"><?php if ($key['nombre']=='' && $key['apellido']=='') {echo 'No tiene docente registrado';
                               }else{  echo $key['nombre'].' '. $key['apellido'];} ?>
                                 
                               </div>
                               <div id="color7<?php echo $nom[$uno] ?>" style="float: right; display: none;">No tiene docente registrado</div>
                               <div id="color6<?php echo $nom[$uno] ?>" style="float: right; display: none;"><?php echo $nomjk.' '.$apesd; ?></div>
                              </label>
                            </li>
                        </ul><?php } ?>
                      </td>
                    </tr><?php  $uno=$uno+1; 
                  } ?>
      </table>

<div class="modal fade" id="myModal21" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Confirmación</h4>
        </div>
        <div class="modal-body"> 
          <p><strong>Nota:</strong> Está seguro de agregar estas asignaturas al docente?

.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
             
            <button type="button" class="btn btn-primary" ata-dismiss="modal" id="uuu"  onclick="
        $('#myModal21').modal('hide');delo1();"   >Aceptar</button>
        </div>
      </div>
      
    </div><input type="submit" style="width: 0;height: 0;background-color: transparent;border:none;" id="tx" name="">
  </div>
 

  </div>
  <script type="text/javascript">
    function delo1(){
      mostrar1();
        setTimeout(function(){ document.getElementById('tx').click(); }, 1000);
    }
  </script>
</form> 


    <?php

    echo '  <ul class="pagination" id="pagination">
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal21"><i class="fa  fa-check-square"></i></button>'.$lista.'</ul>





    
    ' ;
    ?>
   
</div> </div>


 
         





 
             
        <?php
      }
    



 




function carga_por_horario(){  include '../conexion.php';
?>
 <?php
   $tyt=$_POST['util'];
  $porciones = explode(" ", $tyt);
    $j=$porciones[0]; // porción1
    $s=$porciones[1];
 
  ?> 
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
                     
                       $cons="SELECT area.id_area, area.nombre, are_grado_sede.id__docente, grado.numero as grado, curso.numero as curso, curso.numero, horario.hora, horario.dias,are_grado_sede.id_area_grado_sede,horario.id_horario FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN horario ON horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede INNER JOIN grado_sede on are_grado_sede.id_grado_sede=grado_sede.id INNER JOIN grado ON grado_sede.id_grado=grado.id_grado INNER JOIN curso ON grado_sede.id_curso=curso.id_curso WHERE are_grado_sede.id__docente=".$_POST['docente']." AND horario.dias='".$ie."' AND horario.hora='".$i."'  ORDER BY horario.hora, horario.dias ASC";
                      $cons1=$conexion->prepare($cons);
                      $cons1->execute(array());
                 ?> 
                 <td> <?php $op=''; 
                    foreach ($cons1 as   $value) {
                      $grado=$value['grado'];
                      $curso=$value['curso'];
                      $op=$value['nombre'];
                      $uid=$value['id_area_grado_sede'];
                      $id_horario=$value['id_horario'];
                    } 
                    if ($op=='') { ?>

                      <select style="width: 100%"  class="form-control my-select "   id="rtc<?php echo $i.$ie;  ?>" onchange="var d=<?php echo $i ?>;
                      var h=<?php echo $ie ?>;

                      var id=document.getElementById('rtc<?php echo $i.$ie;  ?>').value; 
                      cambio2(id,h,d)"><?php
                        $consq="SELECT h.numero,h.curso, area.nombre,area.codigo,area.area, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM are_grado_sede  INNER JOIN area ON are_grado_sede.id_area=area.id_area inner join (SELECT grado_sede.*,curso.numero as curso,grado.numero  from grado_sede,grado,curso WHERE curso.id_curso=grado_sede.id_curso AND grado.id_grado=grado_sede.id_grado and grado_sede.id_sede=$s AND grado_sede.id_jornada=$j)as h on h.id=are_grado_sede.id_grado_sede   ";
                        $cons1q=$conexion->prepare($consq);
                        $cons1q->execute(array()); 
                        ?> <option value="">SELECCIONE UNA ASIGNATURA</option><?php
                        foreach ($cons1q as $u) {
                          if ($u['area']!=1 || $u['codigo']==01  ) {
                           
                              ?>
                              
                              <option value="<?php echo $u['id_area_grado_sede']  ?>"><?php echo($u['numero'].' '.$u['curso'].' '.$u['nombre'] ) ?></option>
                              <?php
                             
                          }
                        }?>
                      </select><?php
                       
                    }else{?>  
                      <select style="width: 100%"    class="form-control my-select"   id="rtc<?php echo $i.$ie;  ?>" onchange="var id=<?php echo $id_horario ?>;
                      var h=document.getElementById('rtc<?php echo $i.$ie;  ?>').value; 
                      cambio(id,h)"><?php
                         $consq="SELECT h.numero,h.curso, area.nombre,area.codigo,area.area, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM are_grado_sede  INNER JOIN area ON are_grado_sede.id_area=area.id_area inner join (SELECT grado_sede.*,curso.numero as curso,grado.numero  from grado_sede,grado,curso WHERE curso.id_curso=grado_sede.id_curso AND grado.id_grado=grado_sede.id_grado and grado_sede.id_sede=$s AND grado_sede.id_jornada=$j)as h on h.id=are_grado_sede.id_grado_sede   ";
                        $cons1q=$conexion->prepare($consq);
                        $cons1q->execute(array()); 
                        ?> <option value="<?php echo $uid; ?>"><?php echo($grado.'-'.$curso.'-'.$op) ?></option><?php
                        foreach ($cons1q as $u) {
                          if ($u['area']!=1 || $u['codigo']==01  ) {
                            if ( $u['nombre']!=$op) {
                              ?>
                              
                              <option value="<?php echo $u['id_area_grado_sede'] ?>"  ><?php echo($u['numero'].' '.$u['curso'].' '.$u['nombre'] ) ?></option>
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
             ?>   
        </table>  <script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script> <?php
}
///funtion carga academica
 ?>