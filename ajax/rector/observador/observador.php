


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}



function actualizar_categoria(){

  if ($_POST["nombre"]=="") {
    
    echo 0;
    return;
  }
  if ($_POST["id"]=="") {
    
    echo 4;
    return;
  }
  if ((!preg_match ("/^[0-9]+$/",  $_POST["id"])) ) {
    echo 4;
    return;
  } 
  if ((!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/",  $_POST["nombre"])) ) {
    echo 2;
    return;
  } 
  if ($_POST["nombre"]==$_POST["dato"]) {
    
    echo 3;
    return;
  }
  include '../../conexion.php';
  $consul="SELECT observacion_tipo.id FROM observacion_tipo WHERE observacion_tipo.id_observacion_categoria='".$_POST["id"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 7;
    return;
  }

  $consul="UPDATE `observacion_categotia` SET `nombre` = '".$_POST["nombre"]."' WHERE `observacion_categotia`.`id` = ".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;
  return;

}
function registrar_categoria(){
  if ($_POST["nombre"]=="") {
    
    echo 0;
    return;
  }
  if ((!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/",  $_POST["nombre"])) ) {
    echo 2;
    return;
  }
  include "../../conexion.php" ; 
  $consul="SELECT * FROM `observacion_categotia` WHERE nombre='".$_POST["nombre"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 3;
    return;
  }

  $consul="INSERT INTO observacion_categotia (nombre) VALUE('".$_POST["nombre"]."')";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;


}
function eliminar_categoria(){
  if ($_POST["id"]=="") {
    
    echo 0;
    return;
  }
  if ((!preg_match ("/^[0-9]+$/",  $_POST["id"])) ) {
    echo 2;
    return;
  }
  include "../../conexion.php" ; 
  $consul="SELECT observacion_tipo.id FROM observacion_tipo WHERE observacion_tipo.id_observacion_categoria='".$_POST["id"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 3;
    return;
  }

  $consul="DELETE FROM `observacion_categotia` WHERE `observacion_categotia`.`id` = ".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;


}
 
function mostrar_categoria(){
  include "../../conexion.php" ; 
  $consul="SELECT * FROM `observacion_categotia`";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array()); 
  $sql3=$consulta->rowCount();
  if ($sql3>0) { 
    echo "<strong>".$sql3." Categorias</strong>";
  ?><br><br>

 <style>
 

[data-title] {   
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
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
  bottom: -10px;
  left: 2px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   
</style>
 
    <div class="table-responsive">
      <table  style="padding: 5px;  " class="table table-hover">
        <tr>
          <th width="">N°</th>
          <th width="">Nombre</th>
          <th width="">Actualizar</th>
          <th width="">Eliminar</th> 
        </tr>
        <?php
        $s=1;
        foreach ($consulta as $key ) {
           ?>
          <tr>
            <td  > <?php echo $s++ ?></td>
            <td> <?php echo $key['nombre'] ?></td>
            <td>
              <button    data-title="Actualizar" class="btn btn-primary "  data-toggle="modal" data-target="#actualizar" onclick=" 
              document.getElementById('categoria').value='<?php echo $key['nombre'] ?>';
              document.getElementById('dato').value='<?php echo $key['nombre'] ?>';
              document.getElementById('id').value='<?php echo $key['id'] ?>'"  ><i class="fa  fa-pencil-square-o"></i></button>
              
            </td>
            <td><a class="btn  btn-danger"  onclick=" let id=<?php echo $key['id'] ?>;executeExample(id)" style="margin-bottom: 10px"  data-title="Eliminar"><i class="fa  fa-trash-o"></i></a> </td>  
          
          </tr>
        <?php } ?>
      </table> 
    </div>
  <?php
  }
}
//tipo
function mostrar_tipo(){
  include "../../conexion.php" ; 
  $consul="SELECT observacion_tipo.id_observacion_categoria,observacion_tipo.id,observacion_tipo.nombre,observacion_categotia.nombre as categoria FROM observacion_tipo,observacion_categotia WHERE observacion_tipo.id_observacion_categoria=observacion_categotia.id    ORDER BY `observacion_tipo`.`id_observacion_categoria`";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array()); 
  $sql3=$consulta->rowCount();
  if ($sql3>0) { 
    echo "<strong>".$sql3." Tipos</strong>";
  ?><br><br>

 <style>
 

[data-title] {   
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
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
  bottom: -10px;
  left: 2px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   
</style>
 
    <div class="table-responsive">
      <table  style="padding: 5px;  " class="table table-hover">
        <tr>
          <th width="">N°</th>
          <th width="">Categoria</th>
          <th width="">Tipo</th>
          <th width="">Actualizar</th>
          <th width="">Eliminar</th> 
        </tr>
        <?php
        $s=1;
        foreach ($consulta as $key ) {
           ?>
          <tr>
            <td  > <?php echo $s++ ?></td>
            <td> <?php echo $key['categoria'] ?></td>
            <td> <?php echo $key['nombre'] ?></td>
            <td>
              <button    data-title="Actualizar" class="btn btn-primary "  data-toggle="modal" data-target="#actualizar" onclick=" document.getElementById('categoriaa').value='<?php echo $key['id_observacion_categoria'] ?>';
              document.getElementById('id_categoria').value='<?php echo $key['id_observacion_categoria'] ?>';
              document.getElementById('tipo').value='<?php echo $key['nombre'] ?>';
              document.getElementById('dato').value='<?php echo $key['nombre'] ?>';
              document.getElementById('id').value='<?php echo $key['id'] ?>'"  ><i class="fa  fa-pencil-square-o"></i></button>
              
            </td>
            <td><a class="btn  btn-danger"  onclick=" let id=<?php echo $key['id'] ?>;executeExample(id)" style="margin-bottom: 10px"  data-title="Eliminar"><i class="fa  fa-trash-o"></i></a> </td>  
          
          </tr>
        <?php } ?>
      </table> 
    </div>
  <?php
  }
}

function registrar_tipo(){
  if ($_POST["nombre"]=="") {
    
    echo 0;
    return;
  }
  if ((!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/",  $_POST["nombre"])) ) {
    echo 2;
    return;
  }
  include "../../conexion.php" ; 
  $consul="SELECT id FROM `observacion_tipo` WHERE nombre='".$_POST["nombre"]."' and id_observacion_categoria='".$_POST["id_categoriar"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 3;
    return;
  }

  $consul="INSERT INTO `observacion_tipo`(  `nombre`, `id_observacion_categoria`) VALUES ( '".$_POST["nombre"]."','".$_POST["id_categoriar"]."')";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;


}



function actualizar_tipo(){

  if ($_POST["nombre"]=="") {
    
    echo 0;
    return;
  }
  if ($_POST["categoriaa"]=="") {
    
    echo 4;
    return;
  }
  if ($_POST["id"]=="") {
    
    echo 4;
    return;
  }
  if ((!preg_match ("/^[0-9]+$/",  $_POST["id"])) ) {
    echo 4;
    return;
  } 
  if ((!preg_match ("/^[0-9]+$/",  $_POST["categoriaa"])) ) {
    echo 4;
    return;
  } 
  if ((!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/",  $_POST["nombre"])) ) {
    echo 2;
    return;
  } 
  if ($_POST["nombre"]==$_POST["dato"] && $_POST["categoriaa"]==$_POST["id_categoria"]) {
    
    echo 3;
    return;
  }
  include '../../conexion.php';
  $consul="SELECT observacion.id from observacion WHERE observacion.id_observacion_tipo= '".$_POST["id"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 7;
    return;
  }

  $consul="UPDATE `observacion_tipo` SET `nombre` = '".$_POST["nombre"]."',`id_observacion_categoria` = '".$_POST["categoriaa"]."' WHERE `observacion_tipo`.`id` = ".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;
  return;

}


function eliminar_tipo (){
  if ($_POST["id"]=="") {
    
    echo 2;
    return;
  }
  if ((!preg_match ("/^[0-9]+$/",  $_POST["id"])) ) {
    echo 2;
    return;
  }
  include "../../conexion.php" ; 
  $consul="SELECT observacion.id from observacion WHERE observacion.id_observacion_tipo= '".$_POST["id"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 3;
    return;
  }

  $consul="DELETE FROM `observacion_tipo` WHERE id = ".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;


}

function tabla()
   {
    include "../../conexion.php"; 
    $curso=explode(" ", $_POST['curso']);
    $ano=date('Y');

    $jornada_sede1=( $_POST['jornada_sede1']);
    if((!preg_match ("/^[0-9]+$/",  $curso[0])) or  (!preg_match ("/^[0-9]+$/", $curso[1])) or (!preg_match ("/^[0-9]+$/",  $_POST['jornada_sede1']))){
        ?>
        <div class="erroneo" role="alert" style=" margin: 27px "> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> Los datos estan erroneos. </div> <br> 
        <?php
        return;
    }
     $con3="SELECT informeacademico.id_informe_academico, alumnos.genero, alumnos.foto, alumnos.nombre, alumnos.apellido, alumnos.id_alumnos, informeacademico.estado_aprovado, informeacademico.fecha_retiro, informeacademico.fecha_desercion, informeacademico.id_jornada_sede ,COUNT(observacion.id_alumno)as cont FROM alumnos LEFT JOIN observacion on observacion.id_alumno=alumnos.id_alumnos LEFT JOIN informeacademico on informeacademico.id_alumno=alumnos.id_alumnos WHERE informeacademico.ano=$ano and informeacademico.id_grado='$curso[0]' AND informeacademico.id_curso='$curso[1]' AND informeacademico.id_jornada_sede='$jornada_sede1' GROUP by alumnos.id_alumnos";
    
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
    
    ?>
<style>
  
  .im{
            width: 65px;
            height: 80px;
        }
        .im:hover{
            width: 100px; 
            height: 123px;
        }

        td{ 
            border: solid 1px #d5d5d5; 
            text-align: center;
        }
        th{
             text-align: center; 
        }
    #padin{ 
        padding: 10px;
    }

[data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.5s;
    visibility: visible;
}

[data-title]:after {
    content: attr(data-title);
    background-color: #333;
    color: #fff;
    font-size: 14px; 
    position: absolute;
    padding: 3px 20px;
    bottom: -1.6em;
    left: -150px;
    white-space: nowrap;
    box-shadow: 1px 1px 3px #222222;
    opacity: 0;
    border: 1px solid #111111;
    z-index: 99999;
    visibility: hidden;
    border-radius: 6px;
    
}
[data-title] {
    position: relative;
}

</style>
<?php if($count > 0){ ?>

<div class="col-md-12">

    <div class="table-responsive" style="padding: 7px" >
        <form action="descarga_curso.php" method="get" target="_blank">
            <input type="hidden" value="<?php echo $_POST['nom_curso']; ?>" name="curso">
            <input type="hidden" value="<?php echo $_POST['sede']; ?>" name="sede">
            <input type="hidden" value="<?php echo $_POST['jornada']; ?>" name="jornada">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N°</th>

                        <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
                        <th>Estudiante</th>
                        <th>Estado</th>
                        <th>Anotaciones</th>
                        <th>Ver</th> 
                        <th>Agregar</th>
                        <th data-title="Descargar todo el curso">
                            <button id="idw"  style="border:none;background-color:#fff"> Todos </button>
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con=0;
                    foreach($con2 as $key){
                        
                       
                        $con++;
                        $foto=$key['foto'];
                        if ($key['foto']=='' && $key['genero']==1 ) {
                            $foto='../../../logos/niña.jpg';
                        }if ($key['foto']=='' && $key['genero']==0 ) {

                            $foto='../../../logos/niño.jpg';
                        }
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="id_informe_academico[]" value="<?php echo ($key['id_informe_academico']) ?>">
                            <input type="hidden" name="id[]" value="<?php echo ($key['id_alumnos']) ?>">
                            <input type="hidden" name="nombre[]" value="<?php echo $nombre =strtoupper ($key['nombre']); ?>">
                            <input type="hidden" name="apellido[]" value="<?php echo $apellido=strtoupper($key['apellido']); ?>">
                            <h4>
                                <?php echo($con); ?>
                            </h4>
                        </td>
                        <td><img class="profile-user-img img-responsive img-circle im" src="<?php echo($foto); ?>" alt="User profile picture">
                        </td>
                        <td> <br> <?php echo $nombre_completo= mb_convert_case(($key['nombre']." ".$key['apellido']), MB_CASE_TITLE, "UTF-8")   ; ?></td>
                        <td> <br>
                            <?php if($key['fecha_retiro'] != '0000-00-00'){
                                echo('<button class="btn btn-warning btn-xs">Retirado</button>');
                            }elseif($key['fecha_desercion'] != '0000-00-00'){
                                echo('<button class="btn btn-danger btn-xs">Desertor</button>');
                            }else {
                                echo('<button class="btn btn-info btn-xs">Cursando</button>');
                            }
                            ?>
                        </td>
                        <td><br>
                            <button type="button" class="btn btn-default btn-xs"><?php echo($key['cont']); ?></button>
                        </td>
                         <td>
                             
                            <a  onclick=' 
                                  document.getElementById("id_informe_academico").value=<?php echo($key['id_informe_academico']); ?>;   observador(<?php echo('"'.$_POST['nom_curso'].'","'.$_POST['jornada'].'","'.$_POST['sede'].'","'.$key['nombre'].'","'.$key['apellido'].'","'.$foto.'","'.$key['id_alumnos'].'"'); ?>);'>
                            <img style=" margin-top: 15px; width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+">
                            </a>
                             
                        </td>
                        <td><a  class="" data-toggle="modal" data-target="#myModalUniversal"
                                    onclick="

                                  document.getElementById('id_tabla').value=0;
                                  document.getElementById('id_informe_academico').value='<?php echo($key['id_informe_academico']); ?>';
                                  document.getElementById('id_alumno').value='<?php echo($key['id_alumnos']); ?>';"><br>
                       <img style=" width: 37px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDQzOC41MzMgNDM4LjUzMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8cGF0aCBkPSJNNDA5LjEzMywxMDkuMjAzYy0xOS42MDgtMzMuNTkyLTQ2LjIwNS02MC4xODktNzkuNzk4LTc5Ljc5NkMyOTUuNzM2LDkuODAxLDI1OS4wNTgsMCwyMTkuMjczLDAgICBjLTM5Ljc4MSwwLTc2LjQ3LDkuODAxLTExMC4wNjMsMjkuNDA3Yy0zMy41OTUsMTkuNjA0LTYwLjE5Miw0Ni4yMDEtNzkuOCw3OS43OTZDOS44MDEsMTQyLjgsMCwxNzkuNDg5LDAsMjE5LjI2NyAgIGMwLDM5Ljc4LDkuODA0LDc2LjQ2MywyOS40MDcsMTEwLjA2MmMxOS42MDcsMzMuNTkyLDQ2LjIwNCw2MC4xODksNzkuNzk5LDc5Ljc5OGMzMy41OTcsMTkuNjA1LDcwLjI4MywyOS40MDcsMTEwLjA2MywyOS40MDcgICBzNzYuNDctOS44MDIsMTEwLjA2NS0yOS40MDdjMzMuNTkzLTE5LjYwMiw2MC4xODktNDYuMjA2LDc5Ljc5NS03OS43OThjMTkuNjAzLTMzLjU5NiwyOS40MDMtNzAuMjg0LDI5LjQwMy0xMTAuMDYyICAgQzQzOC41MzMsMTc5LjQ4NSw0MjguNzMyLDE0Mi43OTUsNDA5LjEzMywxMDkuMjAzeiBNMzQ3LjE3OSwyMzcuNTM5YzAsNC45NDgtMS44MTEsOS4yMzYtNS40MjgsMTIuODQ3ICAgYy0zLjYyLDMuNjE0LTcuOTAxLDUuNDI4LTEyLjg0Nyw1LjQyOGgtNzMuMDkxdjczLjA4NGMwLDQuOTQ4LTEuODEzLDkuMjMyLTUuNDI4LDEyLjg1NGMtMy42MTMsMy42MTMtNy44OTcsNS40MjEtMTIuODQ3LDUuNDIxICAgaC0zNi41NDNjLTQuOTQ4LDAtOS4yMzEtMS44MDgtMTIuODQ3LTUuNDIxYy0zLjYxNy0zLjYyMS01LjQyNi03LjkwNS01LjQyNi0xMi44NTR2LTczLjA4NGgtNzMuMDg5ICAgYy00Ljk0OCwwLTkuMjI5LTEuODEzLTEyLjg0Ny01LjQyOGMtMy42MTYtMy42MS01LjQyNC03Ljg5OC01LjQyNC0xMi44NDd2LTM2LjU0N2MwLTQuOTQ4LDEuODA5LTkuMjMxLDUuNDI0LTEyLjg0NyAgIGMzLjYxNy0zLjYxNyw3Ljg5OC01LjQyNiwxMi44NDctNS40MjZoNzMuMDkydi03My4wODljMC00Ljk0OSwxLjgwOS05LjIyOSw1LjQyNi0xMi44NDdjMy42MTYtMy42MTYsNy44OTgtNS40MjQsMTIuODQ3LTUuNDI0ICAgaDM2LjU0N2M0Ljk0OCwwLDkuMjMzLDEuODA5LDEyLjg0Nyw1LjQyNGMzLjYxNCwzLjYxNyw1LjQyOCw3Ljg5OCw1LjQyOCwxMi44NDd2NzMuMDg5aDczLjA4NGM0Ljk0OCwwLDkuMjMyLDEuODA5LDEyLjg0Nyw1LjQyNiAgIGMzLjYxNywzLjYxNSw1LjQyOCw3Ljg5OCw1LjQyOCwxMi44NDdWMjM3LjUzOXoiIGZpbGw9IiMxOWFhY2YiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIHN0eWxlPSIiIGNsYXNzPSIiPjwvcGF0aD4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+" />
                            </a>
                            <!-- Modal -->
                            
                        </td> 
                       
                        <td> <br><a  target="_blank"data-title="Descargar" href="../../../vista/rector/observador/descarga_individual.php?sede=<?php echo strtoupper($_POST['sede']) ?>&&jornada=<?php echo strtoupper($_POST['jornada']) ?>&&curso=<?php echo strtoupper($_POST['nom_curso']) ?>&&id_alumnos=<?php echo $key['id_alumnos'] ?>&&nombre=<?php echo $nombre ?>&&apellido=<?php echo $apellido ?>"><img  style="width: 35px" src="data:image/svg+xml;base64,PHN2ZyBpZD0iY29sb3IiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI0IDI0IiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDI0IDI0IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0xMiAwYy02LjYxNyAwLTEyIDUuMzgzLTEyIDEyczUuMzgzIDEyIDEyIDEyIDEyLTUuMzgzIDEyLTEyLTUuMzgzLTEyLTEyLTEyeiIgZmlsbD0iIzAwYmNkNCIvPjxwYXRoIGQ9Im03IDE5aDEwYy41NTMgMCAxLS40NDggMS0xcy0uNDQ3LTEtMS0xaC0xMGMtLjU1MyAwLTEgLjQ0OC0xIDFzLjQ0NyAxIDEgMXoiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMTEuNDcgMTQuNzhjLjE0Ni4xNDcuMzM4LjIyLjUzLjIycy4zODQtLjA3My41My0uMjJsMy4yNS0zLjI1Yy40NzItLjQ3LjEzOS0xLjI4LS41My0xLjI4aC0yLjI1di00LjVjMC0uNTUyLS40NDctMS0xLTFzLTEgLjQ0OC0xIDF2NC41aC0yLjI1Yy0uNjY5IDAtMS4wMDIuODEtLjUzIDEuMjh6IiBmaWxsPSIjZmZmIi8+PHBhdGggZD0ibTEyIDBjLTYuNjE3IDAtMTIgNS4zODMtMTIgMTJzNS4zODMgMTIgMTIgMTJ2LTVoLTVjLS41NTMgMC0xLS40NDgtMS0xcy40NDctMSAxLTFoNXYtMmMtLjE5MiAwLS4zODQtLjA3My0uNTMtLjIybC0zLjI1LTMuMjVjLS40NzItLjQ3LS4xMzktMS4yOC41My0xLjI4aDIuMjV2LTQuNWMwLS41NTIuNDQ3LTEgMS0xeiIgZmlsbD0iIzAwYTRiOSIvPjxnIGZpbGw9IiNkZWRlZGUiPjxwYXRoIGQ9Im0xMiAxN2gtNWMtLjU1MyAwLTEgLjQ0OC0xIDFzLjQ0NyAxIDEgMWg1eiIvPjxwYXRoIGQ9Im0xMiA0Ljc1Yy0uNTUzIDAtMSAuNDQ4LTEgMXY0LjVoLTIuMjVjLS42NjkgMC0xLjAwMi44MS0uNTMgMS4yOGwzLjI1IDMuMjVjLjE0Ni4xNDcuMzM4LjIyLjUzLjIyeiIvPjwvZz48L3N2Zz4=" /></a>
                    </tr> 
                    <?php
                    }
                    ?>
                </tbody>
            </table>
    </div>
</div   >
<?php } else { ?>
    <div class="col-md-12">
        <div class="alert" role="alert" style=" margin:10px;color: rgb(193, 131, 0); background-color: rgb(255, 248, 233); border-color: rgb(255, 205, 101); position: relative; padding: 1rem 1.25rem; margin-bottom: 2rem; border-radius: 4px; border-style: solid; "> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> Actualmente no tienes estudiantes. </div> 
    </div><br>    
<?php }  
}
function registrar_observacion(){


 include "../../conexion.php";
 
 
 $fecha='';
 $id_alumno='';
 $asignatura='';
 $descripcion='';
 $admin='0';
 $tipo=''; 
 $categoria='';
 $id_informe_academico='';
  if (isset($_POST['id_informe_academico'])) {
    $id_informe_academico=$_POST['id_informe_academico'];
  } 
  if (isset($_POST['docente'])) {
    $id=$_POST['docente'];
  } 
  if (isset($_POST['periodo'])) {
    $periodo=$_POST['periodo'];
  } 
  if (isset($_POST['id_alumno'])) {
    $id_alumno=$_POST['id_alumno'];
  } 
  if (isset($_POST['asignatura'])) {
    $asignatura=$_POST['asignatura'];
  } 
  if (isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];
  }
  if (isset($_POST['categoria'])) {
    $categoria=$_POST['categoria'];
  } 
  if (isset($_POST['admin'])) {
    $admin=$_POST['admin'];
  } 
  if (isset($_POST['tipo'])) {
    $tipo=$_POST['tipo']; 
  } 
  if (isset($_POST['fecha'])) {
    $fecha=$_POST['fecha']; 
  }     
  $id_js=$_POST['jornada_sede1'];
  $id_g=$_POST['id_g'];
  $id_c=$_POST['id_c'];

  if ($periodo=='' ) {

    echo $num=7; return;
  }
  if ($id=='' ) {

    echo $num=8; return;
  }
  if ((!preg_match ("/^[0-9]+$/", $id)) || (!preg_match ("/^[0-9]+$/", $periodo)) || (!preg_match ("/^[0-9]+$/", $id_informe_academico))) {

    echo $num=9; return;
  }
  if ($categoria=='' ) {

    echo $num=-5; return;
  }
  if ($tipo==0) {

    echo $num=-2; return;
  } 
 
  //decimos si valor es 0 no  es una remision por eso el admin debe ser 0
    if ($_POST['valor']==0 ) {
      $admin=0;
    }
    //si es valor es 1  significa que es una remision y el admin no puede llevar 0
    if ($_POST['valor']>0 && $admin==0) {
            
        echo $num=-6; return;
    }
  if ($fecha=='') {

   echo $num=-3; return;
  }  
  if ($descripcion=='') {

   echo $num=-4; return;
  } 
  if ($tipo==0) {

    echo $num=-2; return;
  } 
  if ((!preg_match ("/^[0-9]+$/", $id_g))  || (!preg_match ("/^[0-9]+$/", $id_c))   || (!preg_match ("/^[0-9]+$/", $id_js))   || (!preg_match ("/^[0-9]+$/", $admin)) || (!preg_match ("/^[0-9]+$/", $tipo))   || (!preg_match ("/^[0-9]+$/", $id))  || (!preg_match ("/^[0-9]+$/", $id_alumno))) 
  {

    echo $num=-1; return;
  }      


  $num=0;  

  if(preg_match('/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/',  $fecha)){ 



    if (  (preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/", $descripcion)) || (preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $asignatura)) ) {
      $num=1;

      $ss="SELECT * FROM `observacion` WHERE fecha='$fecha' AND descripcion='$descripcion' AND id_observacion_tipo='$tipo' AND id_alumno='$id_alumno' AND id_docente='$id' And  area='$asignatura' ";
      $ss1=$conexion->prepare($ss);
      $ss1->execute(array());
      $con=$ss1->rowCount();

      if($con==0){
        $num=2;
        $sql="INSERT INTO `observacion` ( `area`, `competencia`, `fecha`, `descripcion`, `id_alumno`, `id_docente`, `id_observacion_tipo`, `id_admin`, `id_jornada_sede`, `id_grado`, `id_curso`, `compromiso`, `periodo`) VALUES ('$asignatura','0','$fecha','$descripcion','$id_alumno','$id','$tipo','$admin','$id_js','$id_g','$id_c','0','".$_POST['periodo']."')";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $recupera1 =$conexion->lastInsertId() ; 
        if ($admin>0 && $recupera1>0) {
          $sql="INSERT INTO `remision` ( `estado`, `orientacion`, `accion`, `matricula_condicional`, `id_observacion`, `texto_remision`, `id_informe_academico`) VALUES ( 'Espera', '', '','0','$recupera1','','$id_informe_academico')";
          $sql1=$conexion->prepare($sql);
          $sql1->execute(array());
        }
      } 

    }
  }
  echo $num;
}

//compromiso acedemico
 
function mostrar_compromiso(){
  include "../../conexion.php" ; 
  $consul="SELECT * FROM `observador_compromiso`";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $conexion="NULL"; 
  $sql3=$consulta->rowCount();
  if ($sql3>0) { 
    echo "<strong>".$sql3." Categorias</strong>";
  ?><br><br>

 <style>
 

[data-title] {   
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
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
  bottom: -10px;
  left: 2px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   
</style>
 
    <div class="table-responsive">
      <table  style="padding: 5px;  " class="table table-hover">
        <tr>
          <th width="">N°</th>
          <th width="">Nombre</th>
          <th width="">Actualizar</th>
          <th width="">Eliminar</th> 
        </tr>
        <?php
        $s=1;
        foreach ($consulta as $key ) {
           ?>
          <tr>
            <td  > <?php echo $s++ ?></td>
            <td> <?php echo $key['texto'] ?></td>
            <td>
              <button    data-title="Actualizar" class="btn btn-primary "  data-toggle="modal" data-target="#actualizar" onclick=" 
              document.getElementById('compromiso').value='<?php echo $key['texto'] ?>';
              document.getElementById('dato').value='<?php echo $key['texto'] ?>';
              document.getElementById('id').value='<?php echo $key['id'] ?>'"  ><i class="fa  fa-pencil-square-o"></i></button>
              
            </td>
            <td><a class="btn  btn-danger"  onclick=" let id=<?php echo $key['id'] ?>;executeExample(id)" style="margin-bottom: 10px"  data-title="Eliminar"><i class="fa  fa-trash-o"></i></a> </td>  
          
          </tr>
        <?php } ?>
      </table> 
    </div>
  <?php
  }
}



function actualizar_compromiso(){

  if ($_POST["nombre"]=="") {
    
    echo 0;
    return;
  }
  if ($_POST["id"]=="") {
    
    echo 4;
    return;
  }
  if ((!preg_match ("/^[0-9]+$/",  $_POST["id"])) ) {
    echo 4;
    return;
  } 
  if ((!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/",  $_POST["nombre"])) ) {
    echo 2;
    return;
  } 
  if ($_POST["nombre"]==$_POST["dato"]) {
    
    echo 3;
    return;
  }
  include '../../conexion.php';
  $consul="SELECT observacion.id from observacion WHERE observacion.compromiso='".$_POST["id"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 7;
    return;
  }

  $consul="UPDATE `observador_compromiso` SET `texto` = '".$_POST["nombre"]."' WHERE `observador_compromiso`.`id` = ".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;
  return;

}

function eliminar_compromiso(){
  if ($_POST["id"]=="") {
    
    echo 0;
    return;
  }
  if ((!preg_match ("/^[0-9]+$/",  $_POST["id"])) ) {
    echo 2;
    return;
  }
  include "../../conexion.php" ; 
  $consul="SELECT observacion.id from observacion WHERE observacion.compromiso='".$_POST["id"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 3;
    return;
  }

  $consul="DELETE FROM `observador_compromiso` WHERE `observador_compromiso`.`id` = ".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;


}


function registrar_compromiso(){
  if ($_POST["nombre"]=="") {
    
    echo 0;
    return;
  }
  if ((!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/",  $_POST["nombre"])) ) {
    echo 2;
    return;
  }
  include "../../conexion.php" ; 
  $consul="SELECT * FROM `observador_compromiso` WHERE texto='".$_POST["nombre"]."'";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    echo 3;
    return;
  }

  $consul="INSERT INTO observador_compromiso (texto) VALUE('".$_POST["nombre"]."')";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  echo 1;


}