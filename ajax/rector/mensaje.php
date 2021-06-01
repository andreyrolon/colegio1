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
function consultar_estudiante(){
    $ano=date('Y');
    include "../../codes/rector/conexion.php";
    $cur=$_POST['cur']; $id=$_SESSION['Id_Doc'];
   
    $sede='';$jornada='';$curso='';$grado='';
    $SELECT="SELECT grado_sede.* from grado_sede WHERE grado_sede.id=".$cur;
    $SELECT12=$conexion->prepare($SELECT);
    $SELECT12->execute(array());
    foreach ($SELECT12 as $we) {
        $sede=$we['id_sede'];$jornada=$we['id_jornada'];$curso=$we['id_curso'];$grado=$we['id_grado'];
    }
    $consultar_nivel2="SELECT alumnos.nombre,alumnos.apellido,alumnos.foto,alumnos.id_alumnos FROM alumnos,informeacademico WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.ano=$ano and informeacademico.id_grado=$grado AND informeacademico.id_curso=$curso  and informeacademico.id_jornada=$jornada   and informeacademico.id_sede=$sede";
    $consultar_nivel12=$conexion->prepare($consultar_nivel2);
    $consultar_nivel12->execute(array());

    $consultar_nivel12s=$consultar_nivel12->rowCount();
 
      '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script><br>
    <select id="alumno" name="alumno[]" class=" form-control my-select" data-placeholder="Seleccione un  alumno como minimo"  multiple="multiple"> ';
    if ($consultar_nivel12s>1) {
        # code...
            echo "<option value='todos ".$cur."'>todos los alumnos</option>";
    }
        
    foreach ($consultar_nivel12 as   $value) {
        
        ?> 
          
 <option data-img-src="<?php echo $value['foto'] ?>" aria-disabled="true"  value="<?php echo $value['id_alumnos'] ?>"><?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
        <?php
    }echo '</select>
    <script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>';    

}

function consultar_admin(){ 

  include "../../codes/rector/conexion.php";
  $id_admin=$_SESSION['Id_Doc'];
  if ($_POST['first_name']==1) {
    $rol='Rector'; 

    $mostrar='';
  }
  if ($_POST['first_name']==2) {
    $rol='Coordinador'; 
    $mostrar='data-placeholder="Todos los Coordinadores" multiple="multiple"';
  }
  if ($_POST['first_name']==3) {
    $rol='Psicoorientadores'; 
    $mostrar='data-placeholder="Todos los Psicoorientadores" multiple="multiple"';
  }
  if ($_POST['first_name']==4) {
    $rol='Secretarias'; 
    $mostrar='data-placeholder="Todos las Secretarias" multiple="multiple"';
  }
   $sql="SELECT ROL,ID_ADMIN, FOTO,NOMBRE,APELLIDO,GENERO FROM `administradores` WHERE administradores.ROL='$rol' AND administradores.ID_ADMIN NOT IN('$id_admin') ";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $sql2=$sql1->fetchAll(); ?>
  <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
  <script src="../../../js/chosen.jquery.js"></script>
  <script src="../../../js/ImageSelect.jquery.js"></script>
  <select id="docente" name="docente[]" class=" form-control my-select" <?php echo $mostrar ?>   >  <?php
    foreach($sql2 as $key){

      ECHO$FOTO=$key['FOTO'];
      ECHO $key['GENERO'];
      if($key['FOTO']=='' && $key['GENERO']==1){
        $FOTO='../../../logos/femenino.png';
      }if($key['FOTO']=='' && $key['GENERO']==0){
        $FOTO='../../../logos/masculino.png';
      }
       ?>
        <option data-img-src="<?php echo($FOTO); ?>" aria-disabled="true" value="<?php echo($key['ID_ADMIN'] ); ?>"><?php echo($key['NOMBRE']." ".$key['APELLIDO']); ?></option><?php

    } ?>
  </select>
  <input type="hidden" id="tabla" value="1">
  <input type="hidden" id="validar" value="<?php echo $rol ?>"> 
  <script>
    $(".my-select").chosen()({
      placeholder: "Select a state",
      allowClear: true
    });
    </script><?php
}












function consultar_docente(){ 

  include "../../codes/rector/conexion.php"; 
  $id=$_POST['id'];
 
  $sql="SELECT id_docente,foto,apellido,nombre,genero FROM `docente`  ";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $sql2=$sql1->fetchAll(); ?>
  <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
  <script src="../../../js/chosen.jquery.js"></script>
  <script src="../../../js/ImageSelect.jquery.js"></script>
  <strong>Docente:</strong>
  <select id="docente" name="docente[]" class=" form-control my-select" data-placeholder="Todos los docentes"  multiple="multiple">  <?php
    foreach($sql2 as $key){
      if($key['id_docente']!=$id){ 

        if ($key['genero']==1 && $key['foto']=='' ) {
          $foto='../../../logos/femenino.png';
        }
        if (($key['genero']==0 && $key['foto']=='' ) or ($key['genero']=='' && $key['foto']=='' )) {
          $foto='../../../logos/masculino.png';
        }
        if ($key['foto']!='' ) {
          $foto=$key['foto'];
        }

        ?>
        <option data-img-src="<?php echo($foto); ?>" aria-disabled="true" value="<?php echo($key['id_docente']); ?>"><?php echo($key['nombre']." ".$key['apellido']); ?></option> <?php
      }
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

function consultar_jornada(){
  include "../../codes/rector/conexion.php"; 
  $id=$_POST['id'];
  $jornada1=$_POST['jornada1'];
 
  $sql="SELECT docente.nombre,docente.apellido,docente.genero,docente.foto,docente.id_docente from grado_sede, competencias,tecnica_grado_sede,docente WHERE grado_sede.id_jornada_sede=$jornada1 AND grado_sede.id=tecnica_grado_sede.id_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede and docente.id_docente=competencias.id_docente group by docente.id_docente";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $sql2=$sql1->fetchAll();  ?>

  <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
  <script src="../../../js/chosen.jquery.js"></script>
  <script src="../../../js/ImageSelect.jquery.js"></script>
  <strong>Docente:</strong>
  <select id="docente" name="docente[]" class=" form-control my-select" data-placeholder="Todos los docentes"  multiple="multiple"> 
     
   <?php
    $js1='';
    foreach($sql2 as $key){
      if($key['id_docente']!=$id){ 

        if ($key['genero']==1 && $key['foto']=='' ) {
          $foto='../../../logos/femenino.png';
        }
        if (($key['genero']==0 && $key['foto']=='' ) or ($key['genero']=='' && $key['foto']=='' )) {
          $foto='../../../logos/masculino.png';
        }
        if ($key['foto']!='' ) {
          $foto=$key['foto'];
        }

        ?>
        <option data-img-src="<?php echo($foto); ?>" aria-disabled="true" value="<?php echo($key['id_docente']); ?>"><?php echo($key['nombre']." ".$key['apellido']); ?></option> <?php

        $js  .= ' and docente.id_docente not in("'.$key['id_docente'].'")'; 
      }
    }


   
    $sqqq="SELECT docente.nombre,docente.apellido,docente.genero,docente.foto,docente.id_docente from grado_sede, are_grado_sede,docente WHERE grado_sede.id_jornada_sede=$jornada1 AND grado_sede.id=are_grado_sede.id_grado_sede and docente.id_docente=are_grado_sede.id__docente $js group by docente.id_docente";
    $sqlq1=$conexion->prepare($sqqq);
    $sqlq1->execute(array());
    $sqql2=$sqlq1->fetchAll();

    foreach($sqql2 as $keyq){ 
      if ($keyq['id_docente']!=$id){   

        if ($keyq['genero']==1 && $keyq['foto']=='' ) {
          $foto='../../../logos/femenino.png';
        }
        if (($keyq['genero']==0 && $keyq['foto']=='' ) or ($keyq['genero']=='' && $keyq['foto']=='' )) {
          $foto='../../../logos/masculino.png';
        }
        if ($keyq['foto']!='' ) {
          $foto=$keyq['foto'];
        }

        ?> 
        <option data-img-src="<?php echo($foto); ?>" aria-disabled="true" value="<?php echo($keyq['id_docente']); ?>"><?php echo($keyq['nombre']." ".$keyq['apellido'])  ?></option> <?php
      }
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



function consultar_alumno(){ 

  include "../../codes/rector/conexion.php";  
  $ano=date('Y');
  $j='';
  $t='';
  if (isset($_POST['curso']) ){
    if ($_POST['jorna']!='') {
      $jorna=$_POST['jorna'];
      $j='and informeacademico.id_jornada_sede='.$jorna;
    }
  }
  if (isset($_POST['curso']) ){
    if ( $_POST['curso']!='') {
      $porcion=explode(' ', $_POST['curso']);
      $t=' AND informeacademico.id_curso='.$porcion[0].' AND informeacademico.id_grado='.$porcion[1];
    } 
  }
   
   $sql="SELECT alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.genero,alumnos.foto from alumnos,informeacademico WHERE informeacademico.ano='$ano'  and informeacademico.id_alumno=alumnos.id_alumnos $t $j ORDER BY alumnos.apellido  ";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $sql2=$sql1->fetchAll(); ?>
  <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
  <script src="../../../js/chosen.jquery.js"></script>
  <script src="../../../js/ImageSelect.jquery.js"></script>
  <strong>Alumnos:</strong>
  <select id="docente" name="docente[]" class=" form-control my-select" data-placeholder="Todos los Alumnos"  multiple="multiple">  <?php
    foreach($sql2 as $key){ 

      if ($key['genero']==1 && $key['foto']=='' ) {
        $foto='../../../logos/niña.jpg';
      }
      if (($key['genero']==0 && $key['foto']=='' ) or ($key['genero']=='' && $key['foto']=='' )) {
        $foto='../../../logos/niño.jpg';
      }
      if ($key['foto']!='' ) {
        $foto=$key['foto'];
      }

      ?>
      <option data-img-src="<?php echo($foto); ?>" aria-disabled="true" value="<?php echo($key['id_alumnos']); ?>"><?php echo($key['nombre']." ".$key['apellido']); ?></option> <?php 
    } ?>
  </select>
  <input type="hidden" id="tabla" value="3">
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
  $usuario=$_POST['usuario'];
  $mensaje=$_POST['mensaje']; 
  if (isset($_POST['docente'])) {
    $docente=$_POST['docente'];
    $todos=0;
  }else{
    $todos=1;
    $docente='';
  }

    $jornada1='';
    $curso='';
    $grado=''; 
  if (isset($_POST['jornada1'])) {
    $jornada1=$_POST['jornada1']; 
  } 
  $tabla=$_POST['tabla'];
  $id=$_SESSION['Id_Doc'];
   
  $siiiii=0;
  if (isset($_POST['curso1'])) {
    $porcion=explode(' ',$_POST['curso1']);
      $curso=$porcion[0];
    $grado=$porcion[1]; 
  }
  $todos=0;
  if ($docente=='') {
    $todos=1;
  }
  if ($_SESSION['Rol']=='Rector') {
    $RO=1;
  }
  if ($_SESSION['Rol']=='Coordinador') {
    $RO=2;
  }
  if ($_SESSION['Rol']=='Psicoorientadores') {
    $RO=3;
  }
  if ($_SESSION['Rol']=='Secretarias') {
    $RO=4;
  }

    $sqlq="INSERT INTO `mailbox` (`tabla_de`, `de`, `asunto`, `mensaje`, `archivo`,  `id_curso`,`id_grado`,`id_jornada_sede`,`dirigido`,`todos`) VALUES ('$RO', '$id', '$asunto', '$mensaje', '$ruta','$curso','$grado','$jornada1','$usuario','$todos')";
  $sql1=$conexion->prepare($sqlq);
  $sql1->execute(array());
  $recupera2 =$conexion->lastInsertId() ;

 echo "<br>";
  if ($usuario==7   ) {
   
     $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '1', administradores.ID_ADMIN , '$recupera2' ,'0','1' from administradores WHERE     administradores.ID_ADMIN not in ('$id')";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
 
  if ($usuario==8  ) {
   
    $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '5',  docente.id_docente, '$recupera2' ,'0','1' FROM docente;

    INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '1', administradores.ID_ADMIN , '$recupera2' ,'0','1' from administradores WHERE     administradores.ID_ADMIN not in ('$id')";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
 
  if ($usuario==9 and $docente=='' ) {
   
     $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '5',  docente.id_docente, '$recupera2' ,'0','1' FROM docente;

      INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`)  SELECT   '6',alumnos.id_alumnos , '$recupera2' ,'0','1'  from alumnos ,informeacademico WHERE informeacademico.ano='$ano'     and informeacademico.id_alumno=alumnos.id_alumnos";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
 
  if ($usuario==10 and $docente=='' ) {
   
    $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '5',  docente.id_docente, '$recupera2' ,'0','1' FROM docente; 

    INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`)  SELECT   '6',alumnos.id_alumnos , '$recupera2' ,'0','1'  from alumnos ,informeacademico WHERE informeacademico.ano='$ano'   and informeacademico.id_alumno=alumnos.id_alumnos;

    INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '1', administradores.ID_ADMIN , '$recupera2' ,'0','1' from administradores WHERE     administradores.ID_ADMIN not in ('$id')";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }






 
  if ($usuario==6 and $docente=='' ) {
    $g='';
    $c='';
    $j='';
    if ($grado>0) {
      $g=' and informeacademico.id_grado='.$grado;
      $c=' and informeacademico.id_curso='.$curso;
    } 
    if ($jornada1>0) {
      $j=' and informeacademico.id_jornada_sede='.$jornada1;
    }
     

   echo   $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`)  SELECT   '6',alumnos.id_alumnos , '$recupera2' ,'0','1'  from alumnos ,informeacademico WHERE informeacademico.ano='$ano'    $g $c $j       and informeacademico.id_alumno=alumnos.id_alumnos";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
 
  if ($usuario==2 and $docente=='' ) {
   
    $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '1', administradores.ID_ADMIN , '$recupera2' ,'0','1' from administradores WHERE administradores.ROL='Coordinador' and   administradores.ID_ADMIN not in ('$id')";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
  if ($usuario==3  and $docente=='') {
   
    $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '1', administradores.ID_ADMIN , '$recupera2' ,'0','1' from administradores WHERE administradores.ROL='Psicoorientadores' and   administradores.ID_ADMIN not in ('$id')";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
  if ($usuario==4 and $docente=='' ) {
   
    $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '1', administradores.ID_ADMIN , '$recupera2' ,'0','1' from administradores WHERE administradores.ROL='Secretarias' and   administradores.ID_ADMIN not in ('$id')";
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }
   
  if ($usuario==5 and $docente=='' ) {

    $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) SELECT '5',  docente.id_docente, '$recupera2' ,'0','1' FROM docente ";

    if($jornada1!=''){

        $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`)SELECT '5',  are_grado_sede.id__docente , '$recupera2' ,'0','1' from  grado_sede,are_grado_sede  WHERE are_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_jornada_sede=$jornada1  GROUP by are_grado_sede.id__docente  ";
      }


    echo $sql;
    $sql1=$conexion->prepare($sql);
      $sql1->execute(array());
  }

 

  
  $sql='';
  if($docente!=''){

    foreach ($docente as $key ) { 


      $sql.="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`) VALUES ( '$tabla', '$key', '$recupera2', '0', '1');";
      
    }
    echo $sql;
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
  }

  
 
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
 echo $tabla=$_POST['tabla'];
  $reenvio=$_POST['reenvio'];





if ($docente=='') {
    $todos=1;
  }
  if ($_SESSION['Rol']=='Rector') {
    $RO=1;
  }
  if ($_SESSION['Rol']=='Coordinador') {
    $RO=2;
  }
  if ($_SESSION['Rol']=='Psicoorientadores') {
    $RO=3;
  }
  if ($_SESSION['Rol']=='Secretarias') {
    $RO=4;
  }

  echo$sqlq="INSERT INTO `mailbox` (`tabla_de`, `de`, `asunto`, `mensaje`, `archivo`,  `id_curso`,`id_grado`,`id_jornada_sede`,`dirigido`,`todos`) VALUES ('$RO', '$id', '$asunto1', '$mensaje1', '$ruta','0','0','0','$tabla_para','0')";
  $sql1=$conexion->prepare($sqlq);
  $sql1->execute(array());
  $recupera2 =$conexion->lastInsertId() ;
 

 echo "<br>". $sql="INSERT INTO `mailbox_person` ( `tabla_para`, `para`, `id_mailbox`, `visto`, `habilitado`, `reenvio`) VALUES ( '$tabla', '$para', '$recupera2', '0', '1', '$reenvio')";
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