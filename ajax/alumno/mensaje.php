<?php
session_start();
if ($_GET)
{
	$action = $_GET["action"];
	if (function_exists($action))
	{
		call_user_func($action);
	}
}  





function consultar_docente(){ 

  include "../../codes/rector/conexion.php"; 
  
  $id_curso=$_SESSION['id_curso']; 
  $id_grado=$_SESSION['id_grado'];
  $id_jornada_sede=$_SESSION['id_jornada_sede'];
  $sql="SELECT docente.nombre,docente.genero,docente.apellido,docente.id_docente,docente.foto from are_grado_sede INNER JOIN docente on docente.id_docente=are_grado_sede.id__docente INNER JOIN grado_sede on are_grado_sede.id_grado_sede=grado_sede.id WHERE  grado_sede.id_grado=$id_grado and grado_sede.id_curso=$id_curso  AND grado_sede.id_jornada_sede=$id_jornada_sede GROUP BY docente.id_docente ";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $sql2=$sql1->fetchAll();
   ?>
  <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
  <script src="../../../js/chosen.jquery.js"></script>
  <script src="../../../js/ImageSelect.jquery.js"></script> 
  <select id="docente" name="docente" class=" form-control my-select" data-placeholder="Todos los docentes"  >  <?php
    $id=0;
    foreach($sql2 as $key){ 
       $foto=$key['foto'];
        if ($key['genero']==1 && $key['foto']=='' ) {
          $foto='../../../logos/femenino.png';
        }
        if (($key['genero']==0 && $key['foto']=='' ) or ($key['genero']=='' && $key['foto']=='' )) {
          $foto='../../../logos/masculino.png';
        }
        
        ?>
        <option data-img-src="<?php echo($foto); ?>" aria-disabled="true" value="<?php echo($key['id_docente']); ?>"><?php echo($key['nombre']." ".$key['apellido']); ?></option> <?php
    
    } ?>
  </select>
  <input type="hidden" id="tabla" value="2">
  <script>
    $(".my-select").chosen()({
      placeholder: "Select a state",
      allowClear: true
    });
    </script><?php
}

 
 
function registrar(){
  include "../../codes/rector/conexion.php";  
          $file=$_FILES;
  if($file['files']['name']==""){
    $variable='';
    if (isset($_POST['invisible'])) {
      $variable=$_POST['invisible'];
    }
    $ruta=$variable;
  }else{
    $ruta='../mensajeria/imagen/'.$file['files']['name'];
    move_uploaded_file($file['files']['tmp_name'],$ruta);
    $ruta=$file['files']['name'];
  }
  $ano=date('Y');
  $asunto=$_POST['asunto']; 
  $mensaje=$_POST['mensaje'];  
  $docente=$_POST['docente'];
  
 
  $id=$_SESSION['Id_Doc'];
 

   $sqlq="INSERT INTO `mailbox` (`tabla_de`, `de`, `asunto`, `mensaje`, `archivo`,  `id_curso`,`id_grado`,`id_jornada_sede`,`dirigido`,`todos`) VALUES ('6', '$id', '$asunto', '$mensaje', '$ruta','0','0','0','5','0')";
  $sql1=$conexion->prepare($sqlq);
  $sql1->execute(array());
  $recupera2 =$conexion->lastInsertId() ;

  

  $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) VALUES ( '5', '$docente', '$recupera2', '0', '1')"; 
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
 

  
 
}

function reenvio(){
  include "../../codes/rector/conexion.php";  
  $file=$_FILES;
  if($file['files1']['name']==""){
    $ruta='';
  }else{
    $ruta='../mensajeria/imagen/'.$file['files1']['name'];
    move_uploaded_file($file['files1']['tmp_name'],$ruta);
    $ruta=$file['files1']['name'];
  }

  $mensaje1=$_POST['mensaje1'];
  $asunto1=$_POST['asunto1']; 
  $id=$_POST['de'];
  $para=$_POST['para'];
  $tabla_para=$_POST['tabla_para'];
  $reenvio=$_POST['reenvio'];





 
 
    $RO=6;
  

  echo$sqlq="INSERT INTO `mailbox` (`tabla_de`, `de`, `asunto`, `mensaje`, `archivo`,  `id_curso`,`id_grado`,`id_jornada_sede`,`dirigido`,`todos`) VALUES ('$RO', '$id', '$asunto1', '$mensaje1', '$ruta','0','0','0','$tabla_para','0')";
  $sql1=$conexion->prepare($sqlq);
  $sql1->execute(array());
  $recupera2 =$conexion->lastInsertId() ;
 

 echo "<br>". $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`, `reenvio`) VALUES ( '$tabla_para', '$para', '$recupera2', '0', '1', '$reenvio')";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
}



function papelera(){
  include "../../codes/rector/conexion.php";
  $id=$_POST['elim'];
  $sql="UPDATE `mailbox_person` SET `habilitado` = '0' WHERE `mailbox_person`.`id` = $id";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
}