<?php 

class sede
{
      //muestra todas las sedes
  function acudiente($ID){
    include  "conexion.php";
    $consultar_nivel="SELECT acudiente.*,alumno_acudiente.parentesco FROM acudiente,alumno_acudiente WHERE alumno_acudiente.id_alumnos='$ID' AND alumno_acudiente.id_acudiente=acudiente.id_acudiente " ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);

    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll();
    return $consultar_nivel12;
  }
  function mostrar4($id_js){
    include  "conexion.php";
    $consultar_nivel="SELECT sede.NOMBRE as sede ,jornada.NOMBRE as jornada FROM sede,jornada,jornada_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=" .$id_js ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);

    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll();
    return $consultar_nivel12;
  }
  function mostrar($p)
  {


    include  "conexion.php";
    $consultar_nivel="SELECT sede.*,d.jorna,d.ID_JORNADA,d.ABREVIACION,d.ID_JS FROM sede LEFT JOIN (SELECT jornada_sede.ID_JS, jornada_sede.ID_SEDE,jornada.ID_JORNADA,jornada.NOMBRE as jorna,jornada.ABREVIACION FROM jornada_sede RIGHT JOIN jornada on jornada_sede.ID_JORNADA=jornada.ID_JORNADA)as d on sede.ID_SEDE=d.ID_SEDE " .$p ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);

    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll();
    return $consultar_nivel12;
  }



  function curso($c,$g,$js)
  {


    include "conexion.php";


     $consultar_nivel="SELECT  grado.nombre as grado,curso.numero,sede.NOMBRE as sede,jornada.NOMBRE as jornada FROM jornada_sede,grado_sede,grado,curso,sede,jornada WHERE curso.id_curso=$c and curso.id_curso=grado_sede.id_curso  and    grado.id_grado=$g   AND grado_sede.id_grado=grado.id_grado  and  jornada_sede.ID_JS=$js and jornada_sede.ID_JS=grado_sede.id_jornada_sede   AND jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA  ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());   
        return $consultar_nivel1;
  }
  function auto_logros($a,$g){
    

    $consultar_nivel="SELECT logro.logro,logro.tipo from logro WHERE logro.id_area=$a and logro.id_grado=$g";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());   
        return $consultar_nivel1;
  }
  function logros_notas($id,$p)
  {


    include "conexion.php";


     $consultar_nivel="SELECT materia_por_periodo.area,materia_por_periodo.id_area, materia_por_periodo.id_materia_por_periodo,logro.logro,logro.tipo,materia_por_periodo.nota,materia_por_periodo.nombre_materia,materia_por_periodo.periodo from materia_por_periodo LEFT JOIN logro_periodo on logro_periodo.id_materia_por_periodo= materia_por_periodo.id_materia_por_periodo LEFT JOIN logro on logro.id_logro=logro_periodo.id_logro WHERE materia_por_periodo.id_informe_academico=$id and materia_por_periodo.periodo=$p";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());   
        return $consultar_nivel1;
  }



  function logro_tecnica($id,$p)
  { 

    include "conexion.php";
     $consultar_nivel="SELECT tecnologia.nota, tecnologia.id_tecnologia,competencias.nombre as competencia,logro_tecnica.logro,logro_tecnica.tipo from tecnologia LEFT JOIN logro_periodo_tecnica on logro_periodo_tecnica.id_tecnologia=tecnologia.id_tecnologia LEFT JOIN logro_tecnica on logro_tecnica.id=logro_periodo_tecnica.id_logro_tecnica LEFT JOIN competencias on competencias.id_competencias=tecnologia.id_competrencia WHERE  competencias.id_periodo=$p and tecnologia.id_informe_academico=$id";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());   
        return $consultar_nivel1;
  }
  function inasistenciaa($a,$i,$p)
  {


    include "conexion.php";


     $consultar_nivel="SELECT COUNT(inasistencia.id_inasistencia)as q,inasistencia.inasistencia from inasistencia WHERE inasistencia.id_informe_academico=$i   and inasistencia.id_periodo=$p   and inasistencia.id_area=$a   GROUP by inasistencia.inasistencia";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());   
        return $consultar_nivel1;
  }



        //registra la sede

  function nuevo($NOMBRE,$CODIGO,$DIRECCION,$BARRIO,$TELEFONO,$DANE)
  {


    include "conexion.php";


    $consultar_nivel="INSERT INTO `sede` (`ID_SEDE`, `NOMBRE`, `CODIGO`, `DIRECCION`, `BARRIO`, `TELEFONO`, `DANE`) VALUES (null,'$NOMBRE','$CODIGO','$DIRECCION','$BARRIO','$TELEFONO','$DANE')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());   
  }


        //consulta si la sede tiene estudiantes y si tiene personal administrativo si no tiene se puede eliminar uno por uno
  function eliminar($eliminar)
  {

    include "conexion.php";

    $consultar_nivel="SELECT * FROM jornada_sede WHERE jornada_sede.ID_SEDE=$eliminar";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $consultar_nivel12s=$consultar_nivel1->rowCount();
    if ($consultar_nivel12s>0) {    ?>
      <script>alert(" actualmente la sede no puede ser eliminada ya que  tiene jornadas registradas ");</script>

      <?php
    }else{ 

      $consultar_nivel="SELECT * FROM informeacademico WHERE informeacademico.id_sede=$eliminar";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $consultar_nivel12s=$consultar_nivel1->rowCount();
      if ($consultar_nivel12s>0) {    ?>
        <script>alert(" actual mente la sede tiene alumnos registrados");</script>

        <?php
      }else{

        

      $consultar_nivel="SELECT * FROM grado_sede WHERE grado_sede.id_sede=$eliminar";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $consultar_nivel12s=$consultar_nivel1->rowCount();
      if ($consultar_nivel12s>0) {    ?>
        <script>alert(" actual mente la sede tiene grados registrados");</script>

        <?php
      }else{
           $consultar_nivel=" DELETE  FROM sede WHERE sede.ID_SEDE=$eliminar ";
       $consultar_nivel1=$conexion->prepare($consultar_nivel);
       $consultar_nivel1->execute(array()); 


       if($consultar_nivel1){

        ?>
        <script>alert("la sede  ha sio  eliminado del sistema);</script>

          <?php
        } 
      }



    
      }
    } 
  }



        //consulta si la sede tiene estudiantes y si tiene personal administrativo si no tiene se puede eliminar masivamente
  function eliminarc($y){
    if ($y=='') {
      ?>
      <script>alert(" campos vacios");</script>

      <?php
    }else{ 




      include "conexion.php";
      foreach($y as $eliminar ){
        $consultar_nivel="SELECT * FROM jornada_sede WHERE jornada_sede.ID_SEDE=$eliminar";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0) {    ?>
          <script>alert(" actual mente la sede tiene personal administrativo");</script>

          <?php
        }else{ 

          $consultar_nivel="SELECT * FROM informeacademico WHERE informeacademico.id_sede=$eliminar";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
          $consultar_nivel12s=$consultar_nivel1->rowCount();
          if ($consultar_nivel12s>0) {    ?>
            <script>alert(" actual mente la sede tiene alumnos");</script>

            <?php
          }else{




           $consultar_nivel=" DELETE  FROM sede WHERE sede.ID_SEDE=$eliminar ";
           $consultar_nivel1=$conexion->prepare($consultar_nivel);
           $consultar_nivel1->execute(array()); 


           if($consultar_nivel1){

            ?>
            <script>alert("la sede  ha sio  eliminado del sistema);</script>

              <?php
            } 
          }
        }
      }
    }
  }




          //elimina la relacion que tenga la jornada    con la sede
  function eliminar_relacion_jornada($y,$t){

    include "conexion.php";

    $consultar_nivel=" SELECT *  FROM jornada_sede WHERE jornada_sede.ID_JORNADA=$y and jornada_sede.ID_SEDE=$t ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $consultar_nivel12=$consultar_nivel1->fetchAll();

    foreach ($consultar_nivel12 as $key ) {
      $ID_JS=$key['ID_JS'];
    }


    $consultar_nivel="SELECT * FROM admin_jornada_sede   WHERE admin_jornada_sede.id_js=$ID_JS";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $consultar_nivel12s=$consultar_nivel1->rowCount();
    if ($consultar_nivel12s>0) {    ?>
      <script>mensaje2(1," actualmente la jornada tiene personal  ");</script>

      <?php
    }else{ 

      $consultar_nivel="SELECT * FROM informeacademico WHERE informeacademico.id_sede=$t and informeacademico.id_jornada=$y";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $consultar_nivel12s=$consultar_nivel1->rowCount();
      if ($consultar_nivel12s>0) {    ?>
        <script>mensaje2(1 ," actualmente la jornada tiene alumnos registrados");</script>

        <?php
      }else{

        

      $consultar_nivel="SELECT * FROM grado_sede WHERE grado_sede.id_sede=$t and grado_sede.id_jornada=$y";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $consultar_nivel12s=$consultar_nivel1->rowCount();
      if ($consultar_nivel12s>0) {    ?>
        <script>mensaje2(1," actualmente la jornada tiene grados registrados");</script>

        <?php
      }else{







$consultar_nivel="DELETE  FROM jornada_sede WHERE jornada_sede.ID_JORNADA=$y and jornada_sede.ID_SEDE=$t ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());


  ?>
        <script>mensaje2(3,"se ha eliminado la relacion de la sede con la jornada");</script>

        <?php





}}}





 

  }



        //////////////////////registra la sede con la jornada


  function registrar_relacion_jornada($j,$p){


    if ($j=='' or $p=='') {
       ?>
        <script>alert("debe selecionar una sede");</script>

        <?php
    }else{ include "conexion.php";

       $consultar_nivel="SELECT * FROM jornada_sede WHERE jornada_sede.ID_SEDE=$j and jornada_sede.ID_JORNADA=$p";
       $consultar_nivel1=$conexion->prepare($consultar_nivel);
       $consultar_nivel1->execute(array()); 
       $consultar_nivel12s=$consultar_nivel1->rowCount();
       if ($consultar_nivel12s>0) {    ?>
         <script>alert(" la sede ya esta relacionado con la jornada");</script>

         <?php
       }else{




         

          $consultar_nivel="INSERT INTO `jornada_sede` (`ID_JS`, `ID_SEDE`, `ID_JORNADA`) VALUES (?,?,?);";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array(null,$j,$p)); 


    

          if($consultar_nivel1){

            ?>
            <script>alert("la jornada ha sido  registrado en esta sede");</script>

            <?php
          }
        }
      }
    }

  
 ////////////////////////////////modifica la sede
    
  function modificar($I,$n,$c,$d,$b,$t,$da){
   include "conexion.php";

   $consultar_rotulo="UPDATE `sede` SET  `NOMBRE`='$n',`CODIGO`='$c',`DIRECCION`='$d',`BARRIO`='$b',`TELEFONO`='$t',`DANE`='$da' WHERE sede.ID_SEDE='$I'";
   $consultar_rotulo1=$conexion->prepare($consultar_rotulo);
   $consultar_rotulo1->execute(array());
    if ($consultar_rotulo1) {

      echo      
       '<script>alert("has modificado la sede");</script>   '; 
    }
  }
}





 ?>