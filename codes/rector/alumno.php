<?php 

class alumno
{
        //muestra todo el personal del area adminstrativo 
  function consultar_acudiente($var1,$var2,$var3){
    
    include "conexion.php";
    $consultar_nivel="SELECT * from acudiente WHERE acudiente.id_acudiente in('$var1','$var2','$var3')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }

  function registrar($nombre, $apellido, $fecha_nacimiento, $lugar_nacimiento_direccion, $tipo_documento, $numero_documento, $expedido, $fecha_matricula, $tipo_alumno, $colegio_origen, $tipo_colegio, $edad, $genero, $direccion, $barrio, $telefono, $celular, $correo, $religion, $filiacion_salud, $tipo_sangre, $estrato, $sisben_puntaje, $numero_carnet, $subsidiado, $proviene_bienestar, $desplazado, $discapacidad, $cual_discapacidad, $desmovilizado, $hijos_desmovilizado, $municipio_desmovilizado, $afrocolombiano, $etnia, $cual_etnia, $familia_accion, $pae, $foto, $nombre1, $apellido1, $tipo_documentoa1, $num_documentoa1, $expedidaa1, $direcciona1 ,$barrioa1, $celulara1, $ocupaciona1, $direccion_trabajo1, $emaila1, $nombre2, $apellido2, $tipo_documentoa2, $num_documentoa2, $expedidaa2, $direcciona2, $barrioa2, $celulara2, $ocupaciona2, $direccion_trabajo2, $emaila2, $nombre3, $apellido3, $parentesco3, $tipo_documentoa3, $num_documentoa3, $expedidaa3, $direcciona3, $barrioa3, $celulara3, $ocupaciona3, $direccion_trabajo3, $emaila3,$Sede,$jornada,$grado,$curso,$ima1,$ima2,$ima3,$ima4,$nombreimg1,$nombreimg2,$nombreimg3,$nombreimg4,$teltrab1,$teltrab2,$teltrab3,$fecha_desercion,$fecha_retiro,$porque,$zona,$metodologia,$clave,$clavep,$id_periodo){
      //REGISTRAMOS EL ALUMNO 
 
    include "conexion.php";

$acumulador2='';$acumulador='';

  $consultar_nivel="SELECT * FROM `grado_sede` WHERE grado_sede.id_grado='$grado' and grado_sede.id_sede='$Sede' and grado_sede.id_jornada='$jornada' and grado_sede.id_curso='$curso'";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $consultar_nivel12s=$consultar_nivel1->rowCount();
    if ($consultar_nivel12s>0){   

      $consultar_nivel="INSERT INTO `alumnos` (`id_alumnos`,`nombre`, `apellido`, `fecha_nacimiento`, `lugar_nacimiento_direccion`, `tipo_documento`, `numero_documento`, `expedido`, `tipo_alumno`, `colegio_origen`, `tipo_colegio`, `edad`, `genero`, `direccion`, `barrio`, `telefono`, `celular`, `correo`, `religion`, `filiacion_salud`, `tipo_sangre`, `estrato`, `sisben_puntaje`, `numero_carnet`, `subsidiado`, `proviene_bienestar`, `desplazado`, `discapacidad`, `cual_discapacidad`, `desmovilizado`, `hijos_desmovilizado`, `municipio_desmovilizado`, `afrocolombiano`, `etnia`, `cual_etnia`, `familia_accion`, `pae`, `foto`, `clavea`, `claves`,`zona`, `rol`) VALUES ('null', '$nombre', '$apellido', '$fecha_nacimiento', '$lugar_nacimiento_direccion', '$tipo_documento', '$numero_documento', '$expedido', '$tipo_alumno', '$colegio_origen', '$tipo_colegio', '$edad', '$genero', '$direccion', '$barrio', '$telefono', '$celular', '$correo', '$religion', '$filiacion_salud', '$tipo_sangre', '$estrato', '$sisben_puntaje', '$numero_carnet', '$subsidiado', '$proviene_bienestar', '$desplazado', '$discapacidad', '$cual_discapacidad', '$desmovilizado', '$hijos_desmovilizado', '$municipio_desmovilizado', '$afrocolombiano', '$etnia', '$cual_etnia', '$familia_accion', '$pae', '$foto', '$clave', '$clavep','$zona','Alumno')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      //UNA VEZREGISTRADO SACAMOS SU ID 
      $recupera1 =$conexion->lastInsertId() ;


      //DECIMOS LA VARIABLE DEL PAPA Q CONTIENE TIENE EL  NOMBRE Y  EL APELLIDO SON DIFERENTE A VACIO HAGA EL REGISTO DEL PADRE
      if ($nombre1!='' && $apellido1!='') {
        $consultar_nivel="INSERT INTO `acudiente` (`id_acudiente`, `nombre`, `apellido`, `parentesco`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `acudiente`, `telefono_trabajo`) VALUES (null, '$nombre1', '$apellido1', 'Padre', '$tipo_documentoa1', '$num_documentoa1', '$expedidaa1', '$direcciona1' ,'$barrioa1', '$celulara1', '$ocupaciona1', '$direccion_trabajo1', '$emaila1', '0','$teltrab1')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        //UNA VEZ REGISTRADO EL PADRE SACAMOSEL ID
        $recupera2 =$conexion->lastInsertId() ;
        // REGISTRAMOS LA RELACION DEL PADRE CON EL ALUMNO CON EL ID DEL PADRE Y DEL MOCOSO EN EL CUAL RECUPERAMOS CON LA FUNCION lastInsertId
        $consultar_nivel="INSERT INTO `alumno_acudiente` (`id`, `id_acudiente`, `id_alumnos`) VALUES ('NULL', '$recupera2', '$recupera1')" ;
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
      //DECIMOS LA VARIABLE DE LA MAMA Q CONTIENE TIENE EL  NOMBRE Y  EL APELLIDO SON DIFERENTE A VACIO HAGA EL REGISTO DEL MADRE
      if ($nombre2!='' && $apellido2!='') {
        $consultar_nivel="INSERT INTO `acudiente` (`id_acudiente`, `nombre`, `apellido`, `parentesco`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `acudiente`, `telefono_trabajo`)  VALUES (null, '$nombre2', '$apellido2', 'Madre', '$tipo_documentoa2', '$num_documentoa2', '$expedidaa2', '$direcciona2' ,'$barrioa2', '$celulara2', '$ocupaciona2', '$direccion_trabajo2', '$emaila2', '0','$teltrab2')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());

        //UNA VEZ REGISTRADO LA MAMA SACAMOSEL ID
        $recupera3 =$conexion->lastInsertId() ;


        // REGISTRAMOS LA RELACION DE LA MAMA CON EL ALUMNO CON EL ID DE LA MADRE Y DEL MOCOSO EN EL CUAL RECUPERAMOS CON LA FUNCION lastInsertId
        $consultar_nivel="INSERT INTO `alumno_acudiente` (`id`, `id_acudiente`, `id_alumnos`) VALUES ('NULL', '$recupera3', '$recupera1')" ;
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }



       //DECIMOS LA VARIABLE DEL ACUDIENTE Q CONTIENE TIENE EL  NOMBRE Y  EL APELLIDO SON DIFERENTE A VACIO HAGA EL REGISTO DEL ACUDIENTE
      if ($nombre3!='' && $apellido3!='') {
        $consultar_nivel="INSERT INTO `acudiente` (`id_acudiente`, `nombre`, `apellido`, `parentesco`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `acudiente`, `telefono_trabajo`)  VALUES (null, '$nombre3', '$apellido3', '$parentesco3', '$tipo_documentoa3', '$num_documentoa3', '$expedidaa3', '$direcciona3' ,'$barrioa3', '$celulara3', '$ocupaciona3', '$direccion_trabajo3', '$emaila3', '1','$teltrab3')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());


        //UNA VEZ REGISTRADO EL ACUDIENTE SACAMOSEL ID
        $recupera4 =$conexion->lastInsertId() ;

        // REGISTRAMOS LA RELACION DEL ACUDIENTE CON EL ALUMNO CON EL ID DEL ACUDIENTE Y DEL MOCOSO EN EL CUAL RECUPERAMOS CON LA FUNCION lastInsertId
        $consultar_nivel="INSERT INTO `alumno_acudiente` (`id`, `id_acudiente`, `id_alumnos`) VALUES ('NULL', '$recupera4', '$recupera1')" ;
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }

      $fecha = date('20y-m-d');
      $ano=date('Y'); 
        $consultar_nivel="INSERT INTO `informeacademico` (`id_informe_academico`, `id_alumno`, `fecha`, `fecha_desercion`, `fecha_retiro`, `porque`, `metodologia`, `ano`, `estado_aprovado`, `id_grado`, `id_curso`, `id_jornada`, `id_sede`) VALUES (NULL, '$recupera1', '$fecha', '$fecha_desercion', '$fecha_retiro', '$porque', '$metodologia', '$ano', '', '$grado', '$curso', '$jornada', '$Sede') " ;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $f =$conexion->lastInsertId() ;

        $consultar_nivel="SELECT area.*,hh.id_area_grado_sede,hh.id from area,(SELECT are_grado_sede.id_area,are_grado_sede.id_area_grado_sede,grado_sede.id FROM are_grado_sede,grado_sede WHERE are_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_sede=$Sede and grado_sede.id_grado='$grado' and grado_sede.id_jornada='$jornada' and grado_sede.id_curso=$curso )as hh WHERE hh.id_area=area.id_area";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();  
      foreach ($consultar_nivel12 as $key){
        $rf1=$key['nombre'];
        $rf2=$key['area'];
        $rf=$key['id_area_grado_sede'];

        $codigo=$key['codigo'];
       $consultar_nivel="INSERT INTO `materias` (`id_materias`, `id_informe_academico`, `ap`, `id_area_grado_sede`, `nom_materia`, `area`, `codigo`) VALUES (NULL, '$f', '', '$rf', '$rf1', '$rf2','$codigo') " ;
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
          $id_m =$conexion->lastInsertId() ;
           $acumulador2=$acumulador2."'".$rf1."',";

       $periodo="SELECT * FROM `periodo`";
        $con=$conexion->prepare($periodo);
        $con->execute(array());
        $con2=$con->fetchAll();
          foreach ($con2 as $key){
              $periodo="INSERT INTO `materia_por_periodo`(`id_materia_por_periodo`, `id_materia`, `periodo`, `nota`) VALUES ('', '$id_m', '$key[6]', 0)";
                $con=$conexion->prepare($periodo);
                $con->execute(array());
                $ghj =$conexion->lastInsertId() ;
                $acumulador=$acumulador."'".$ghj."',";
 
          }
      }
         

       $consulta="SELECT * FROM `materias` WHERE    `materias`.`id_informe_academico`=$f ";   
      $consulta=$conexion->prepare($consulta);
      $consulta->execute(array());
      foreach ($consulta as   $value) {
        $c=$value['codigo'];
        $are=$value['area'];
        if ($c!=01 and $are==1) {
          # code...
        }else{ 
        $nom_materia=$value['nom_materia'];
    $selevv="SELECT * FROM `nota_independiente` WHERE    `nota_independiente`.`id_jornada`=".$jornada."   and   `nota_independiente`.`id_curso`=".$curso."    and `nota_independiente`.`id_grado`=".$grado." and   `nota_independiente`.`id_sede`=".$Sede."      and      `nota_independiente`.`id_periodo`=".$id_periodo." and  `nota_independiente`.`nombre_materia`='".$nom_materia."'" ;   
          $selevv=$conexion->prepare($selevv);
          $selevv->execute(array());
                 
          foreach ($selevv as $fgf){
            $op="INSERT INTO `materia_por_paso` (`id_materia_por_paso`, `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`, `nota`)VALUES ('', '$ghj', '$f','".$fgf['id_nota_independiente']."', '0')";
            $op=$conexion->prepare($op);
            $op->execute(array());
          } }
      }
                 
                

 
    }else{
 
    }
  }
}
?>