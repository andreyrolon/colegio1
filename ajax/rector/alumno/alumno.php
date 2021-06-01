
<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}
function actualizar_acudiente3(){
	include '../../conexion.php';

  	$consultar_nivel="UPDATE `alumno_acudiente` SET `".$_POST['col']."` = '".$_POST['nom']."' WHERE `alumno_acudiente`.`id` = '".$_POST['id']."'";
  	$consultar_nivel1=$conexion->prepare($consultar_nivel);
  	$consultar_nivel1->execute(array());
}
function actualizar_acudiente(){
	include '../../conexion.php';

  $consultar_nivel="UPDATE `acudiente` SET `".$_POST['col']."` = '".$_POST['nom']."' WHERE `acudiente`.`id_acudiente` = '".$_POST['id']."'";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}
function validar_documento(){
	include "../../conexion.php";
	$numero_documento=$_POST['numero_documento'];
	$tipo_documento=$_POST['tipo_documento'];
	$consultar_nivel="SELECT alumnos.id_alumnos FROM `alumnos` WHERE alumnos.numero_documento='$numero_documento'  ";
     $consultar_nivel1=$conexion->prepare($consultar_nivel);
     $consultar_nivel1->execute(array());
     $sql3=$consultar_nivel1->rowCount();
     if ($sql3>0) {?>
     	<script type="text/javascript">
     	 mensaje(1,'el numero de documento ya esta registrado en el sistema');
     		document.getElementById('numero_documento').focus();
     		document.getElementById('control_numero').value=1;
     	 </script><?php
     } else{
     	echo " ";
     }

}
function validar_documento1(){
	include "../../conexion.php";
	$num_documentoa1=$_POST['num_documentoa1']; 
	$identifay=$_POST['identifay']; 
	$consultar_nivel="SELECT acudiente.id_acudiente FROM `acudiente` WHERE acudiente.num_documento='$num_documentoa1'";
     $consultar_nivel1=$conexion->prepare($consultar_nivel);
     $consultar_nivel1->execute(array());
     $sql3=$consultar_nivel1->rowCount();
     if ($sql3>0) {?>
     	<script type="text/javascript">
     	 mensaje(1,'el numero de documento ya esta registrado en el sistema');
     		document.getElementById('<?php echo $identifay ?>').focus(); 
     		     	 </script><?php
     } else{
     	echo " ";
     }

}function validar_documento2(){
	include "../../conexion.php";
	$num_documentoa1=$_POST['num_documentoa1']; 
	$identifay=$_POST['identifay']; 
	$consultar_nivel="SELECT acudiente.id_acudiente FROM `acudiente` WHERE acudiente.num_documento='$num_documentoa1'";
     $consultar_nivel1=$conexion->prepare($consultar_nivel);
     $consultar_nivel1->execute(array());
     $sql3=$consultar_nivel1->rowCount();
     if ($sql3>0) {?>
     	<script type="text/javascript">
     	 mensaje5(1,'el numero de documento ya esta registrado en el sistema');
     		document.getElementById('<?php echo $identifay ?>').focus(); 
     		     	 </script><?php
     } else{
     	echo " ";
     }

}
function registro(){

	if(isset($_POST['fecha_nacimiento'])){ $fecha_nacimiento=$_POST['fecha_nacimiento']; }else{$fecha_nacimiento='';}
	if (!preg_match ("/^[0-9-]+$/", $fecha_nacimiento)) { echo 2; return; }
	if ($fecha_nacimiento=="") { echo 3; return; }

	if(isset($_POST['ciudad_nacimiento'])){ $ciudad_nacimiento=$_POST['ciudad_nacimiento']; }else{$ciudad_nacimiento='';}

	if (!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s.,:z]+$/", $ciudad_nacimiento)) { echo 4; return; }
	if ($ciudad_nacimiento=="") { echo 5; return; }

	if(isset($_POST['tipo_documento'])){ $tipo_documento=$_POST['tipo_documento']; }else{$tipo_documento='';}

	if (!preg_match ("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s.,:z]+$/", $ciudad_nacimiento)) { echo 6; return; }
	if ($ciudad_nacimiento=="") { echo 1; return; }

	if(isset($_POST['ciudad_expedicion'])){ $ciudad_expedicion=$_POST['ciudad_expedicion']; }else{$ciudad_expedicion='';}
	if(isset($_POST['fecha_matricula'])){ $fecha_matricula=$_POST['fecha_matricula']; }else{$fecha_matricula='';}
	if(isset($_POST['tipo_alumno'])){ $tipo_alumno=$_POST['tipo_alumno']; }else{$tipo_alumno='';}
	if(isset($_POST['colegio_origen'])){ $colegio_origen=$_POST['colegio_origen']; }else{$colegio_origen='';}
	if(isset($_POST['tipo_colegio'])){ $tipo_colegio=$_POST['tipo_colegio']; }else{$tipo_colegio='';}
	if(isset($_POST['edad'])){ $edad=$_POST['edad']; }else{$edad='';}
	if(isset($_POST['genero'])){ $genero=$_POST['genero']; }else{$genero='';}
	if(isset($_POST['direccion'])){ $direccion=$_POST['direccion']; }else{$direccion='';}
	if(isset($_POST['barrio'])){ $barrio=$_POST['barrio']; }else{$barrio='';}
	if(isset($_POST['telefono'])){ $telefono=$_POST['telefono']; }else{$telefono='0';}
	if(isset($_POST['celular'])){ $celular=$_POST['celular']; }else{$celular='';}
	if(isset($_POST['correo'])){ $correo=$_POST['correo']; }else{$correo='';}
	if(isset($_POST['religion'])){ $religion=$_POST['religion']; }else{$religion='';}
	if(isset($_POST['filiacion_salud'])){ $filiacion_salud=$_POST['filiacion_salud']; }else{$filiacion_salud='';}
	if(isset($_POST['tipo_sangre'])){ $tipo_sangre=$_POST['tipo_sangre']; }else{$tipo_sangre='';}
	if(isset($_POST['estrato'])){ $estrato=$_POST['estrato']; }else{$estrato='';}
	if(isset($_POST['sisben_puntaje'])){ $sisben_puntaje=$_POST['sisben_puntaje']; }else{$sisben_puntaje='';}
	if(isset($_POST['numero_carnet'])){ $numero_carnet=$_POST['numero_carnet']; }else{$numero_carnet='';}
	if(isset($_POST['subsidiado'])){ $subsidiado=$_POST['subsidiado']; }else{$subsidiado='';}
	if(isset($_POST['proviene_bienestar'])){ $proviene_bienestar=$_POST['proviene_bienestar']; }else{$proviene_bienestar='';}
	if(isset($_POST['desplazado'])){ $desplazado=$_POST['desplazado']; }else{$desplazado='';}
	if(isset($_POST['discapacidad'])){ $discapacidad=$_POST['discapacidad']; }else{$discapacidad='';}
	if(isset($_POST['afrocolombiano'])){ $afrocolombiano=$_POST['afrocolombiano']; }else{$afrocolombiano='';}
	if(isset($_POST['cual_discapacidad'])){ $cual_discapacidad=$_POST['cual_discapacidad']; }else{$cual_discapacidad='';}
	if(isset($_POST['desmovilizado'])){ $desmovilizado=$_POST['desmovilizado']; }else{$desmovilizado='';}
	if(isset($_POST['hijos_desmovilizado'])){ $hijos_desmovilizado=$_POST['hijos_desmovilizado']; }else{$hijos_desmovilizado='';}
	if(isset($_POST['etnia'])){ $etnia=$_POST['etnia']; }else{$etnia='';}
	if(isset($_POST['cual_etnia'])){ $cual_etnia=$_POST['cual_etnia']; }else{$cual_etnia='';}
	if(isset($_POST['familia_accion'])){ $familia_accion=$_POST['familia_accion']; }else{$familia_accion='';}
	if(isset($_POST['pae'])){ $pae=$_POST['pae']; }else{$pae='';}
	if(isset($_POST['nombre1'])){ $nombre1=$_POST['nombre1']; }else{$nombre1='';}
	if(isset($_POST['apellido1'])){ $apellido1=$_POST['apellido1']; }else{$apellido1='';}
	if(isset($_POST['num_documentoa1'])){ $num_documentoa1=$_POST['num_documentoa1']; }else{$num_documentoa1='';}
	if(isset($_POST['expedidaa1'])){ $expedidaa1=$_POST['expedidaa1']; }else{$expedidaa1='';}
	if(isset($_POST['direcciona1'])){ $direcciona1=$_POST['direcciona1']; }else{$direcciona1='';}
	if(isset($_POST['barrioa1'])){ $barrioa1=$_POST['barrioa1']; }else{$barrioa1='';}
	if(isset($_POST['celulara1'])){ $celulara1=$_POST['celulara1']; }else{$celulara1='0';}
	if(isset($_POST['ocupaciona1'])){ $ocupaciona1=$_POST['ocupaciona1']; }else{$ocupaciona1='';}
	if(isset($_POST['direccion_trabajo1'])){ $direccion_trabajo1=$_POST['direccion_trabajo1']; }else{$direccion_trabajo1='';}
	if(isset($_POST['emaila1'])){ $emaila1=$_POST['emaila1']; }else{$emaila1='';}
	if(isset($_POST['nombre2'])){ $nombre2=$_POST['nombre2']; }else{$nombre2='';}
	if(isset($_POST['apellido2'])){ $apellido2=$_POST['apellido2']; }else{$apellido2='';}
	if(isset($_POST['tipo_documentoa2'])){ $tipo_documentoa2=$_POST['tipo_documentoa2']; }else{$tipo_documentoa2='';}
	if(isset($_POST['num_documentoa2'])){ $num_documentoa2=$_POST['num_documentoa2']; }else{$num_documentoa2='';}
	if(isset($_POST['expedidaa2'])){ $expedidaa2=$_POST['expedidaa2']; }else{$expedidaa2='';}
	if(isset($_POST['direcciona2'])){ $direcciona2=$_POST['direcciona2']; }else{$direcciona2='';}
	if(isset($_POST['emaila2'])){ $emaila2=$_POST['emaila2']; }else{$emaila2='';}
	if(isset($_POST['nombre3'])){ $nombre3=$_POST['nombre3']; }else{$nombre3='';}
	if(isset($_POST['barrioa2'])){ $barrioa2=$_POST['barrioa2']; }else{$barrioa2='';}
	if(isset($_POST['direccion_trabajo2'])){ $direccion_trabajo2=$_POST['direccion_trabajo2']; }else{$direccion_trabajo2='';} 
	if(isset($_POST['apellido3'])){ $apellido3=$_POST['apellido3']; }else{$apellido3='';}
	if(isset($_POST['direcciona3'])){ $direcciona3=$_POST['direcciona3']; }else{$direcciona3='';}
	if(isset($_POST['barrioa3'])){ $barrioa3=$_POST['barrioa3']; }else{$barrioa3='';}
	if(isset($_POST['celulara3'])){ $celulara3=$_POST['celulara3']; }else{$celulara3='';} 
	if(isset($_POST['jornada_sede'])){ $jornada_sede=$_POST['jornada_sede']; }else{$jornada_sede='';}
	if(isset($_POST['nombreimg3'])){ $nombreimg3=$_POST['nombreimg3']; }else{$nombreimg3='';}
	if(isset($_POST['nombreimg2'])){ $nombreimg2=$_POST['nombreimg2']; }else{$nombreimg2='';}
	if(isset($_POST['fecha_retiro'])){ $fecha_retiro=$_POST['fecha_retiro']; }else{$fecha_retiro='';}
	if(isset($_POST['nombreimg4'])){ $nombreimg4=$_POST['nombreimg4']; }else{$nombreimg4='';}
	if(isset($_POST['porque'])){ $porque=$_POST['porque']; }else{$porque='';}
	if(isset($_POST['fecha_desercion'])){ $fecha_desercion=$_POST['fecha_desercion']; }else{$fecha_desercion='';}
	if(isset($_POST['clave_padre'])){ $clave_padre=$_POST['clave_padre']; }else{$clave_padre=123;}
	if(isset($_POST['metodologia'])){ $metodologia=$_POST['metodologia']; }else{$metodologia=1;}
	if(isset($_POST['teltrab1'])){ $teltrab1=$_POST['teltrab1']; }else{$teltrab1='';}
	if(isset($_POST['clave'])){ $clave=$_POST['clave']; }else{$clave=1234;}
	if(isset($_POST['Parentesco'])){ $Parentesco=$_POST['Parentesco']; }else{$Parentesco='';}

 
		$id_cursoa= explode(' ', $_POST['curso']) ; 
		$id_curso=$id_cursoa[0];
		$id_grado=$id_cursoa[1];

	if(isset($_POST['zona'])){ $zona=$_POST['zona']; }else{$zona='';}
	if(isset($_POST['nombreimg1'])){ $nombreimg1=$_POST['nombreimg1']; }else{$nombreimg1='';}
	if(isset($_POST['ocupaciona2'])){ $ocupaciona2=$_POST['ocupaciona2']; }else{$ocupaciona2='';}
	if(isset($_POST['expedidaa3'])){ $expedidaa3=$_POST['expedidaa3']; }else{$expedidaa3='';}
	if(isset($_POST['emaila3'])){ $emaila3=$_POST['emaila3']; }else{$emaila3='';}
	if(isset($_POST['ocupaciona3'])){ $ocupaciona3=$_POST['ocupaciona3']; }else{$ocupaciona3='';}
	if(isset($_POST['tipo_documentoa3'])){ $tipo_documentoa3=$_POST['tipo_documentoa3']; }else{$tipo_documentoa3='';}
	if(isset($_POST['direccion_trabajo3'])){ $direccion_trabajo3=$_POST['direccion_trabajo3']; }else{$direccion_trabajo3='';}
	if(isset($_POST['teltrab2'])){ $teltrab2=$_POST['teltrab2']; }else{$teltrab2='';} 
	if(isset($_POST['id_p'])){ $id_p=$_POST['id_p']; }else{$id_p='';} 
	if(isset($_POST['num_documentoa3'])){ $num_documentoa3=$_POST['num_documentoa3']; }else{$num_documentoa3='';} 
	if(isset($_POST['celulara2'])){ $celulara2=$_POST['celulara2']; }else{$celulara2='';} 
	if(isset($_POST['deportado'])){ $deportado=$_POST['deportado']; }else{$deportado='';} 
	if(isset($_POST['capacidad_excepcional'])){ $capacidad_excepcional=$_POST['capacidad_excepcional']; }else{$capacidad_excepcional='';} 
	if(isset($_POST['otros_talentos'])){ $otros_talentos=$_POST['otros_talentos']; }else{$otros_talentos='';} 
	if(isset($_POST['tipo_documentoa1'])){ $tipo_documentoa1=$_POST['tipo_documentoa1']; }else{$tipo_documentoa1='';} 
	if(isset($_POST['teltrab3'])){ $teltrab3=$_POST['teltrab3']; }else{$teltrab3='';} 
	if(isset($_POST['id_periodo'])){ $id_periodo=$_POST['id_periodo']; }else{$id_periodo='';} 
	if(isset($_POST['nombre'])){ $nombre=$_POST['nombre']; }else{$nombre='';} 
	if(isset($_POST['apellido'])){ $apellido=$_POST['apellido']; }else{$apellido='';} 
	if(isset($_POST['municipio_Expulsor'])){ $municipio_Expulsor=$_POST['municipio_Expulsor']; }else{$municipio_Expulsor='';} 
	if(isset($_POST['numero_documento'])){ $numero_documento=$_POST['numero_documento']; }else{$numero_documento='';} 

 if(isset($_POST['id_papa2'])){ $id_papa=$_POST['id_papa2']; }else{$id_papa='';} 

 if(isset($_POST['id_mama2'])){ $id_mama=$_POST['id_mama2']; }else{$id_mama='';}  
 if(isset($_POST['id_acudiente2'])){ $id_acudiente=$_POST['id_acudiente2']; }else{$id_acudiente='';} 

 if(isset($_POST['pais_nacimiento'])){ 
 	$porcion_pais1=explode(",", $_POST['pais_nacimiento']);
 	$pais_nacimiento=$porcion_pais1[1]; 
 }else{

 	$pais_nacimiento='';
 } 
 if(isset($_POST['departamento_nacimiento'])){ 

 	  
 	$departamento_nacimiento= $_POST['departamento_nacimiento'];
 }else{
 	$departamento_nacimiento='';
 } 

 if(isset($_POST['pais_expedicion'])){ 

 	$porcion_pais_ex=explode(",", $_POST['pais_expedicion']);
 	$pais_expedicion=$porcion_pais_ex[1];  
 }else{
 	$pais_expedicion='';
 } 
 if(isset($_POST['departamento_expedicion'])){ $departamento_expedicion=$_POST['departamento_expedicion']; }else{$departamento_expedicion='';} 

 if(isset($_POST['Nombre_archivo1'])){ $Nombre_archivo1=$_POST['Nombre_archivo1']; }else{$Nombre_archivo1='';} 
 if(isset($_POST['Nombre_archivo2'])){ $Nombre_archivo2=$_POST['Nombre_archivo2']; }else{$Nombre_archivo2='';} 
 if(isset($_POST['Nombre_archivo3'])){ $Nombre_archivo3=$_POST['Nombre_archivo3']; }else{$Nombre_archivo3='';} 
 if(isset($_POST['Nombre_archivo4'])){ $Nombre_archivo4=$_POST['Nombre_archivo4']; }else{$Nombre_archivo4='';} 

 if(isset($_FILES['archivo1'])){ $archivo1=$_FILES['archivo1']; }else{$archivo1='';} 
 if(isset($_FILES['archivo2'])){ $archivo2=$_FILES['archivo2']; }else{$archivo2='';} 
 if(isset($_FILES['archivo3'])){ $archivo3=$_FILES['archivo3']; }else{$archivo3='';} 
 if(isset($_FILES['archivo4'])){ $archivo4=$_FILES['archivo4']; }else{$archivo4='';}  

 
 
 if(isset($_POST['validacion_r1'])){ $validacion_r1=$_POST['validacion_r1']; }else{$validacion_r1='';} 
 if(isset($_POST['validacion_r2'])){ $validacion_r2=$_POST['validacion_r2']; }else{$validacion_r2='';} 
 if(isset($_POST['validacion_r3'])){ $validacion_r3=$_POST['validacion_r3']; }else{$validacion_r3='';} 
 if(isset($_POST['ano'])){ $ano=$_POST['ano']; }else{$ano='';} 

include "../../conexion.php";

	$ruta2='';
	$soporte='';
	if(isset($_POST['ad'])){
	 	if(isset($_FILES['imgh'])){ 
	 		$soporte=$_FILES['imgh'];

	 	}
	 	 
		if ($soporte['tmp_name']=='') {
		    $ruta2='';
		}else{ 
		    $na=md5($soporte['tmp_name']).$_POST['ad'];
		    $ruta2='../../../img_alumno/'.$na; 
		    move_uploaded_file($soporte['tmp_name'], $ruta2);
		}
	}

 	if ($clave=="") { 
 		$clave =1234;
 	}
 	if ($clave_padre=="") { 
 		$clave_padre =1234;
 	}
 	$cor1 =  $clave_padre ;
    $acumulador2='';$acumulador='';

 

 



     $consultar_nivel="INSERT INTO `alumnos` (`nombre`, `apellido`, `fecha_nacimiento`, `ciudad_nacimiento`, `tipo_colegio`, `colegio_origen`, `tipo_documento`, `numero_documento`, `ciudad_expedido`, `tipo_alumno`, `edad`, `genero`, `direccion`, `barrio`, `telefono`, `celular`, `correo`, `religion`, `filiacion_salud`, `tipo_sangre`, `estrato`, `sisben_puntaje`, `numero_carnet`, `subsidiado`, `proviene_bienestar`, `desplazado`, `discapacidad`, `cual_discapacidad`, `desmovilizado`, `hijos_desmovilizado`, `municipio_desmovilizado`, `afrocolombiano`, `etnia`, `cual_etnia`, `familia_accion`, `pae`, `foto`, `clavea`, `claves`, `zona`, `deportado`, `capacidad_excepcional`, `otros_talentos`, `pais_nacimiento`, `departamento_nacimiento`, `pais_expedicion`, `departamento_expedicion`, `vive`) VALUES
 		( '".$nombre."', '".$apellido."', '".$fecha_nacimiento."', '".$ciudad_nacimiento."', '".$tipo_colegio."', '".$colegio_origen."', '".$tipo_documento."', '".$numero_documento."', '".$ciudad_expedicion."', '".$tipo_alumno."', '".$edad."', '".$genero."', '".$direccion."', '".$barrio."', '".$telefono."', '".$celular."', '".$correo."', '".$religion."', '".$filiacion_salud."', '".$tipo_sangre."', '".$estrato."', '".$sisben_puntaje."', '".$numero_carnet."', '".$subsidiado."', '".$proviene_bienestar."', '".$desplazado."', '".$discapacidad."', '".$cual_discapacidad."', '".$desmovilizado."', '".$hijos_desmovilizado."', '".$municipio_Expulsor."', '".$afrocolombiano."', '".$etnia."', '".$cual_etnia."', '".$familia_accion."', '".$pae."', '".$ruta2."', '".$clave."', '".$clave_padre."','".$zona."','".$deportado."','".$capacidad_excepcional."','".$otros_talentos."','".$pais_nacimiento."','".$departamento_nacimiento."','".$pais_expedicion."','".$departamento_expedicion."','".$_POST["vive"]."')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    //UNA VEZREGISTRADO SACAMOS SU ID 
    $recupera1 =$conexion->lastInsertId() ;
    

     if ($nombre1!='' && $apellido1!='' && $validacion_r1=='0') {
      $consultar_nivel="INSERT INTO `acudiente` ( `nombre`, `apellido`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `telefono_trabajo`) VALUES ('".$nombre1."', '".$apellido1."',  '".$tipo_documentoa1."', '".$num_documentoa1."', '".$expedidaa1."', '".$direcciona1."' ,'".$barrioa1."', '".$celulara1."', '".$ocupaciona1."', '".$direccion_trabajo1."', '".$emaila1."',  '".$teltrab1."')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $recupera2 =$conexion->lastInsertId() ;

      $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ('$recupera2', '$recupera1','Papá')" ;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
    } 
    if ($validacion_r1=='1' && $id_papa!='') {

	     $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ( '$id_papa', '$recupera1','Papá')" ;
	     $consultar_nivel1=$conexion->prepare($consultar_nivel);
	     $consultar_nivel1->execute(array());
    } 




    if ($nombre2!='' && $apellido2!='' &&  $validacion_r2=='0' ) {
      $consultar_nivel="INSERT INTO `acudiente` ( `nombre`, `apellido`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `telefono_trabajo`)  VALUES ( '".$nombre2."', '".$apellido2."', '".$tipo_documentoa2."', '".$num_documentoa2."', '".$expedidaa2."', '".$direcciona2."' ,'".$barrioa2."', '".$celulara2."', '".$ocupaciona2."', '".$direccion_trabajo2."', '".$emaila2."', '".$teltrab2."')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $recupera3 =$conexion->lastInsertId() ;


      $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ( '$recupera3', '$recupera1','Mamá')" ;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
    }


    if ($validacion_r2=='1' &&  $id_mama!='') { 
	     $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ( '$id_mama', '$recupera1','Mamá')" ;
	    $consultar_nivel1=$conexion->prepare($consultar_nivel);
	    $consultar_nivel1->execute(array());
    }

 
    if ($nombre3!='' && $apellido3!='' && $validacion_r3=='0') {
      $consultar_nivel="INSERT INTO `acudiente` ( `nombre`, `apellido`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `telefono_trabajo`)  VALUES ( '".$nombre3."', '".$apellido3."', '".$tipo_documentoa3."', '".$num_documentoa3."', '".$expedidaa3."', '".$direcciona3."' ,'".$barrioa3."', '".$celulara3."', '".$ocupaciona3."', '".$direccion_trabajo3."', '".$emaila3."', '".$teltrab3."')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $recupera4 =$conexion->lastInsertId() ;

      
      $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ( '$recupera4', '$recupera1', '$Parentesco')" ;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
    }

    if ( $validacion_r3=='1' && $id_acudiente!='') { 
      
      $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ( '$id_acudiente', '$recupera1', '$Parentesco')" ;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
    }

    $fecha = date('Y-m-d');
   

    ///////////informe acdemico
 

     $consultar_nivel="INSERT INTO `informeacademico` ( `id_alumno`, `fecha`, `fecha_desercion`, `fecha_retiro`, `porque`, `metodologia`, `ano`, `estado_aprovado`, `id_grado`, `id_curso`, `id_jornada_sede`, `prematicula`, `id_votacion`)VALUES ( '$recupera1', '$fecha', '".$fecha_desercion."', '".$fecha_retiro."', '".$porque."', '".$metodologia."', '$ano', '0', '".$id_grado."', '".$id_curso."', '".$jornada_sede."','0','0') " ;

     /*echo $consultar_nivel="INSERT INTO `informeacademico` ( `id_alumno`, `fecha`, `fecha_desercion`, `fecha_retiro`, `porque`, `metodologia`, `ano`, `estado_aprovado`, `id_grado`, `id_curso`, `id_jornada_sede`, `prematicula`, `vive`)VALUES ( '$recupera1', '$fecha', '".$fecha_desercion."', '".$fecha_retiro."', '".$porque."', '".$metodologia."', '$ano', '0', '".$id_grado."', '".$id_curso."', '".$jornada_sede."','0', '".$_POST['vive']."') " ;*/
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $f =$conexion->lastInsertId() ;

    ///////////fin del informe acdemico




//////////////////////registro de archivos
	if ($archivo1['tmp_name']!='' && $Nombre_archivo1!='') { 

 
		$na=md5($archivo1['tmp_name']).'.pdf';
		$ruta1='../../../archivos/'.$na; 
		move_uploaded_file($archivo1['tmp_name'], $ruta1);
		 
      	$consultar_nivel="INSERT INTO `archivos_informe_academico` ( `nombre`, `arcihivo`, `id_informe_academico`) VALUES ('$Nombre_archivo1', '$ruta1', '$f')" ;
      	$consultar_nivel1=$conexion->prepare($consultar_nivel);
      	$consultar_nivel1->execute(array());
    }
	if ($archivo2['tmp_name']!='' && $Nombre_archivo2!='') { 
 
		$na=md5($archivo2['tmp_name']).'.pdf';
		$ruta2='../../../archivos/'.$na; 
		move_uploaded_file($archivo2['tmp_name'], $ruta2);
      
      	$consultar_nivel="INSERT INTO `archivos_informe_academico` ( `nombre`, `arcihivo`, `id_informe_academico`) VALUES ('$Nombre_archivo2', '$ruta2', '$f')" ;
      	$consultar_nivel1=$conexion->prepare($consultar_nivel);
      	$consultar_nivel1->execute(array());
    }
	if ($archivo3['tmp_name']!='' && $Nombre_archivo3!='') { 

		$na=md5($archivo3['tmp_name']).'.pdf';
		$ruta3='../../../archivos/'.$na; 
		move_uploaded_file($archivo3['tmp_name'], $ruta3);
      
      $consultar_nivel="INSERT INTO `archivos_informe_academico` ( `nombre`, `arcihivo`, `id_informe_academico`) VALUES ('$Nombre_archivo3', '$ruta3', '$f')" ;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
    } 
	if ($archivo4['tmp_name']!='' && $Nombre_archivo4!='') { 
      
		$na=md5($archivo4['tmp_name']).'.pdf';
		$ruta4='../../../archivos/'.$na; 
		move_uploaded_file($archivo4['tmp_name'], $ruta4);
      	$consultar_nivel="INSERT INTO `archivos_informe_academico` ( `nombre`, `arcihivo`, `id_informe_academico`) VALUES ('$Nombre_archivo4', '$ruta4', '$f')" ;
      	$consultar_nivel1=$conexion->prepare($consultar_nivel);
      	$consultar_nivel1->execute(array());
    }  

/////////////fin de registros de archivos


 
    
     $competencias="INSERT INTO `tecnologia` ( `competencia`, `nota`, `recuperacion`, `id_periodo`, `id_informe_academico`, `trabajo`, `id_competrencia`, `sustentacion`, `codigo`)  
  SELECT competencias.nombre,'0','0',competencias.id_periodo,'$f','0',competencias.id_competencias,'0',competencias.codigo from grado_sede,tecnica_grado_sede,competencias WHERE  grado_sede.id_grado='".$id_grado."'  and grado_sede.id_jornada_sede= '".$jornada_sede."' and   grado_sede.id_curso='".$id_curso."'  and grado_sede.id=tecnica_grado_sede.id_grado_sede  and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede" ;
    $competencias1=$conexion->prepare($competencias);
    $competencias1->execute(array());

         
 		$periodo="INSERT INTO `materia_por_periodo` ( `periodo`, `id_informe_academico`, `id_area`, `codigo`, `area`, `nombre_materia`)
        SELECT r.numero,'$f',q.id_area,q.codigo,q.area,q.nombre from(SELECT area.nombre,area.area,area.codigo,area.id_area from area,are_grado_sede,grado_sede WHERE are_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_jornada_sede='".$jornada_sede."' and grado_sede.id_grado='".$id_grado."'  and grado_sede.id_curso='".$id_curso."' and are_grado_sede.id_area=area.id_area)as q,(SELECT periodo.numero from periodo)as r ";
        $con=$conexion->prepare($periodo);
        $con->execute(array()); 



	    $consultar_nivel="INSERT INTO `materia_por_paso` ( `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`, `nota`, `identificador`)
	    SELECT materia_por_periodo.id_materia_por_periodo,'$f', nota_independiente.id_nota_independiente,'0','0' from materia_por_periodo,nota_independiente WHERE nota_independiente.ano='$ano' and  nota_independiente.id_curso='$id_curso' and nota_independiente.id_grado='$id_grado' and nota_independiente.id_jornada_sede='$jornada_sede' and nota_independiente.id_periodo='$id_periodo'  AND materia_por_periodo.id_informe_academico='$f' AND materia_por_periodo.periodo='$id_periodo' and nota_independiente.id_area=materia_por_periodo.id_area";
	    $consultar_nivel1=$conexion->prepare($consultar_nivel);
	    $consultar_nivel1->execute(array()); 


	    $consultar_nivel="INSERT INTO `tecnica_por_paso` ( `nota`, `id_tecnologia`, `id_nota_tecnologia_independiente`, `id_informe_academico`, `identificador`) 
	    	SELECT '0', tecnologia.id_tecnologia, nota_tecnologica_independiente.id_nota_tecnologica_independiente,'$f','0' from nota_tecnologica_independiente,tecnologia WHERE nota_tecnologica_independiente.ano=$ano and  nota_tecnologica_independiente.id_curso='$id_curso' and nota_tecnologica_independiente.id_grado='$id_grado' and nota_tecnologica_independiente.id_jornada_sede='$jornada_sede' and nota_tecnologica_independiente.id_periodo='$id_periodo' and tecnologia.id_informe_academico='$f' and tecnologia.id_competrencia=nota_tecnologica_independiente.id_competencia ";
	    $consultar_nivel1=$conexion->prepare($consultar_nivel);
	    $consultar_nivel1->execute(array()); 

	    
	  
         


  }


function excel(){
	set_time_limit(500);
	include '../../conexion.php';  
	include '../../../Classes/PHPExcel/IOFactory.php';

	if(isset($_POST['id_periodo'])){ $id_periodo=$_POST['id_periodo']; }else{$id_periodo='';} 
	if(isset($_POST['jornada_sede'])){ $jornada_sede=$_POST['jornada_sede']; }else{$jornada_sede='';}
	$id_cursoa= explode(' ', $_POST['curso']) ; 
		$id_curso=$id_cursoa[0];
		$id_grado=$id_cursoa[1];
	if(isset($_POST['id_periodo'])){ $id_periodo=$_POST['id_periodo']; }else{$id_periodo='';} 
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


		$R = $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue(); 
		$S = $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue(); 
		$T = $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue(); 
		$U = $objPHPExcel->getActiveSheet()->getCell('U'.$i)->getCalculatedValue(); 
		$V = $objPHPExcel->getActiveSheet()->getCell('V'.$i)->getCalculatedValue(); 
		$W = $objPHPExcel->getActiveSheet()->getCell('W'.$i)->getCalculatedValue(); 
		$X = $objPHPExcel->getActiveSheet()->getCell('X'.$i)->getCalculatedValue(); 
		$Y = $objPHPExcel->getActiveSheet()->getCell('Y'.$i)->getCalculatedValue(); 
		$Z = $objPHPExcel->getActiveSheet()->getCell('Z'.$i)->getCalculatedValue(); 
		$AA = $objPHPExcel->getActiveSheet()->getCell('AA'.$i)->getCalculatedValue(); 
		$AB = $objPHPExcel->getActiveSheet()->getCell('AB'.$i)->getCalculatedValue(); 
		$AC = $objPHPExcel->getActiveSheet()->getCell('AC'.$i)->getCalculatedValue(); 
		$AD = $objPHPExcel->getActiveSheet()->getCell('AD'.$i)->getCalculatedValue(); 
		$AE = $objPHPExcel->getActiveSheet()->getCell('AE'.$i)->getCalculatedValue(); 
		$AF = $objPHPExcel->getActiveSheet()->getCell('AF'.$i)->getCalculatedValue(); 
		$AG = $objPHPExcel->getActiveSheet()->getCell('AG'.$i)->getCalculatedValue();

		$AH = $objPHPExcel->getActiveSheet()->getCell('AH'.$i)->getCalculatedValue(); 
		$AI = $objPHPExcel->getActiveSheet()->getCell('AI'.$i)->getCalculatedValue();

		$AJ = $objPHPExcel->getActiveSheet()->getCell('AJ'.$i)->getCalculatedValue(); 
		$AK = $objPHPExcel->getActiveSheet()->getCell('AK'.$i)->getCalculatedValue(); 
		$AL = $objPHPExcel->getActiveSheet()->getCell('AL'.$i)->getCalculatedValue(); 
		$AM = $objPHPExcel->getActiveSheet()->getCell('AM'.$i)->getCalculatedValue(); 
		$AN = $objPHPExcel->getActiveSheet()->getCell('AN'.$i)->getCalculatedValue(); 
		$AO = $objPHPExcel->getActiveSheet()->getCell('AO'.$i)->getCalculatedValue(); 
		$AP = $objPHPExcel->getActiveSheet()->getCell('AP'.$i)->getCalculatedValue(); 
		$AQ = $objPHPExcel->getActiveSheet()->getCell('AQ'.$i)->getCalculatedValue(); 
		$AR = $objPHPExcel->getActiveSheet()->getCell('AR'.$i)->getCalculatedValue(); 
		$AS = $objPHPExcel->getActiveSheet()->getCell('AS'.$i)->getCalculatedValue();  






		$AT = $objPHPExcel->getActiveSheet()->getCell('AT'.$i)->getCalculatedValue(); 
		$AU = $objPHPExcel->getActiveSheet()->getCell('AU'.$i)->getCalculatedValue(); 
		$AV = $objPHPExcel->getActiveSheet()->getCell('AV'.$i)->getCalculatedValue(); 
		$AW = $objPHPExcel->getActiveSheet()->getCell('AW'.$i)->getCalculatedValue(); 
		$AX = $objPHPExcel->getActiveSheet()->getCell('AX'.$i)->getCalculatedValue(); 
		$AY = $objPHPExcel->getActiveSheet()->getCell('AY'.$i)->getCalculatedValue(); 
		$AZ = $objPHPExcel->getActiveSheet()->getCell('AZ'.$i)->getCalculatedValue(); 
		$BA = $objPHPExcel->getActiveSheet()->getCell('BA'.$i)->getCalculatedValue(); 
		$BB = $objPHPExcel->getActiveSheet()->getCell('BB'.$i)->getCalculatedValue(); 
		$BC = $objPHPExcel->getActiveSheet()->getCell('BC'.$i)->getCalculatedValue(); 
		$BD = $objPHPExcel->getActiveSheet()->getCell('BD'.$i)->getCalculatedValue(); 
		$BE = $objPHPExcel->getActiveSheet()->getCell('BE'.$i)->getCalculatedValue(); 
		$BF = $objPHPExcel->getActiveSheet()->getCell('BF'.$i)->getCalculatedValue(); 
		$BG = $objPHPExcel->getActiveSheet()->getCell('BG'.$i)->getCalculatedValue(); 



		$BH = $objPHPExcel->getActiveSheet()->getCell('BH'.$i)->getCalculatedValue(); 
		$BI = $objPHPExcel->getActiveSheet()->getCell('BI'.$i)->getCalculatedValue(); 
		if ($A!="" and  $B!="") {
		  
	 		if ($AN=='') {
	 			$AN='1234';
	 		}
	 		if ($AM=='') {
	 			$AM='1234';
	 		}
			
			
	 
	 
	  

	 


	 

		    $consultar_nivel="INSERT INTO `alumnos` ( `nombre`, `apellido`, `fecha_nacimiento`, `ciudad_nacimiento`, `tipo_colegio`, `colegio_origen`, `tipo_documento`, `numero_documento`, `ciudad_expedido`, `tipo_alumno`, `edad`, `genero`, `direccion`, `barrio`, `telefono`, `celular`, `correo`, `religion`, `filiacion_salud`, `tipo_sangre`, `estrato`, `sisben_puntaje`, `numero_carnet`, `subsidiado`, `proviene_bienestar`, `desplazado`, `discapacidad`, `cual_discapacidad`, `desmovilizado`, `hijos_desmovilizado`, `municipio_desmovilizado`, `afrocolombiano`, `etnia`, `cual_etnia`, `familia_accion`, `pae`, `foto`, `clavea`, `claves`, `zona`, `deportado`, `capacidad_excepcional`, `otros_talentos`, `pais_nacimiento`, `departamento_nacimiento`, `pais_expedicion`, `departamento_expedicion`, `vive`)  VALUES
		 		( '".$A."', '".$B."', '".$J."', '".$M."', '".$AP."', '".$AO."', '".$C."', '".$D."', '".$G."', '".$AN."', '".$H."', '".$I."', '".$S."', '".$T."', '".$W."', '".$V."', '".$X."', '".$Z."', '".$N."', '".$O."', '".$Y."', '".$P."', '".$Q."', '".$R."', '".$AA."', '".$AB."', '".$AD."', '".$AE."', '".$AF."', '".$AG."', '".$AC."', '".$AH."', '".$AI."', '".$AJ."', '".$AK."', '".$AL."', '', '".$AQ."', '".$AR."','".$U."','".$AM."','".$AS."','".$AT."','".$K."','".$L."','".$E."','".$F."','".$BI."'  )";
		    $consultar_nivel1=$conexion->prepare($consultar_nivel);
		    $consultar_nivel1->execute(array());
		    //UNA VEZREGISTRADO SACAMOS SU ID 
		    $recupera1 =$conexion->lastInsertId() ;
	 
		    if ($AV!='' && $AW!='') {
		    	
			    
			    $consultar_nivel=" 
			    INSERT INTO `acudiente` ( `nombre`, `apellido`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `telefono_trabajo`)  VALUES ( '".$AV."', '".$AW."', '".$AY."', '".$AZ."', '".$BA."', '".$BB."', '".$BC."' ,'".$BD."', '".$BE."', '".$BF."', '".$BG."', '".$BH."')";
			    $consultar_nivel1=$conexion->prepare($consultar_nivel);
			    $consultar_nivel1->execute(array());
			    //UNA VEZ REGISTRADO EL ACUDIENTE SACAMOSEL ID
			    $recupera4 =$conexion->lastInsertId() ;

			    $consultar_nivel="INSERT INTO `alumno_acudiente` ( `id_acudiente`, `id_alumnos`, `parentesco`) VALUES ( '$recupera4', '$recupera1', '$AX');";
			    $consultar_nivel1=$conexion->prepare($consultar_nivel);
			    $consultar_nivel1->execute(array());
			 
		    }

		    $fecha = date('20y-m-d');
		    $ano=date('Y'); 
		    
		    $consultar_nivel=" 

		    INSERT INTO `informeacademico` ( `id_alumno`, `fecha`, `fecha_desercion`, `fecha_retiro`, `porque`, `metodologia`, `ano`, `estado_aprovado`, `id_grado`, `id_curso`, `id_jornada_sede`, `prematicula`, `id_votacion`) VALUES ( '$recupera1', '$fecha', '', '', '', '".$AU."', '$ano', '0', '".$id_grado."', '".$id_curso."', '".$jornada_sede."','0','0') " ;
		    $consultar_nivel1=$conexion->prepare($consultar_nivel);
		    $consultar_nivel1->execute(array());
		    $f =$conexion->lastInsertId() ;
	 
	    
	         $periodo="INSERT INTO `materia_por_periodo` ( `periodo`, `id_informe_academico`, `id_area`, `codigo`, `area`, `nombre_materia`)
	        SELECT r.numero,'$f',q.id_area,q.codigo,q.area,q.nombre from(SELECT area.nombre,area.area,area.codigo,area.id_area from area,are_grado_sede,grado_sede WHERE are_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_jornada_sede='".$jornada_sede."' and grado_sede.id_grado='".$id_grado."'  and grado_sede.id_curso='".$id_curso."' and are_grado_sede.id_area=area.id_area)as q,(SELECT periodo.numero from periodo)as r;

	        

		    INSERT INTO `tecnologia` (`competencia`, `id_periodo`, `id_informe_academico`,  `id_competrencia`) SELECT competencias.nombre,competencias.id_periodo,'$f',competencias.id_competencias from grado_sede,tecnica_grado_sede,competencias WHERE  grado_sede.id_grado='".$id_grado."'  and grado_sede.id_jornada_sede= '".$jornada_sede."' and   grado_sede.id_curso='".$id_curso."'  and grado_sede.id=tecnica_grado_sede.id_grado_sede  and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede

		     ";
	        $con=$conexion->prepare($periodo);
	        $con->execute(array()); 
	    }
                     
    }
}
  /*
        INSERT INTO `materia_por_paso` (`id_materia_por_paso`, `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`, `nota`, `identificador`)
	    SELECT 'NULL',materia_por_periodo.id_materia_por_periodo,'$f', nota_independiente.id_nota_independiente,'0','0' from materia_por_periodo,nota_independiente WHERE nota_independiente.id_curso='$id_curso' and nota_independiente.id_grado='$id_grado' and nota_independiente.id_jornada_sede='$jornada_sede' and nota_independiente.id_periodo='$id_periodo' and nota_independiente.id_area=materia_por_periodo.id_area AND materia_por_periodo.id_informe_academico='$f' AND materia_por_periodo.periodo='$id_periodo';
	    */	
	

 






?>