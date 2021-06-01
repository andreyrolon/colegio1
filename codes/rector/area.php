<?php 
    /**
     * 
     */
  class area
  {
    	//muestra todas las areas
    function mostrar_asignatura($r)
    {
        
        
      include "conexion.php";
      $consultar_nivel="SELECT * from area ".$r;
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();
      return $consultar_nivel12;
    }


    function areras_unico()
    {
        
        
      include "conexion.php";
      $consultar_nivel="SELECT area.id_area,area.nombre from area WHERE area.area not in ('1') or  area.codigo in ('01') GROUP BY area.nombre
";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();
      return $consultar_nivel12;
    }
    function areras_unico3()
    {
         
      include "conexion.php";
      $id=$_SESSION['Id_Doc'];
      
      $consultar_nivel="SELECT q.nombre,q.id_area,area_docente.id_docente,q.codigo,q.area   from (SELECT area.codigo,area.area, are_grado_sede.id__docente, area.id_area,area.nombre from area,are_grado_sede WHERE area.id_area=are_grado_sede.id_area and are_grado_sede.id__docente='$id')as q LEFT JOIN  area_docente on area_docente.area=q.nombre  WHERE q.area  not in ('1')  or q.codigo=01";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();
      return $consultar_nivel12;
    }
    function areras_unico2()
    {
        
        
      include "conexion.php";
      $consultar_nivel="SELECT area.id_area,area.nombre from area WHERE area.nombre not in( SELECT area_docente.area from area_docente) GROUP BY area.nombre";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();
      return $consultar_nivel12;
    }

         
 

      //registra las areas y asignaturas

    function nuevo_area($NOMBRE,$descripchion,$CODIGO,$are)
    {
            

      if ($NOMBRE=='' or   $CODIGO==''  ) {
             echo '<script type="text/javascript"> alert("campos vacios");</script>';
      }else{


        include "conexion.php";


        $consultar_nivel="INSERT INTO `area` (`id_area`, `nombre`, `descripcion`, `codigo`, `area`) VALUES (NULL,'$NOMBRE','$descripchion','$CODIGO','$are')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());   
      }
    }




  
    function actualizar($NOMBRE,$descripchion,$CODIGO,$id)
    {


      include "conexion.php";
      $consultar_nivel=" SELECT * FROM area WHERE area.area=0 and area.codigo in(SELECT area.codigo FROM area where area.id_area=$id and area.codigo not in('01'))";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      $consultar_nivel12s=$consultar_nivel1->rowCount();
      if ($consultar_nivel12s>0){
        if ($CODIGO==01) {

          $consultar_nivel="UPDATE `area` SET  `nombre` = '$NOMBRE', `descripcion` = '$descripchion' WHERE `area`.`id_area` = $id;";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 

          ?><script>alert("actualmente el area tiene asignaturas por tal motivo no podra combiar su codigo");</script><?php 

        }else{

           $consultar_nivel=" SELECT * FROM area WHERE  area.area=1 and  area.codigo=$CODIGO and area.codigo not in('01') and area.id_area not in('$id') ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
          $consultar_nivel12s=$consultar_nivel1->rowCount();
          if ($consultar_nivel12s>0){

            ?><script>alert("el codigo actualmente esta registrado en otra area");</script><?php 
          }else{  


            $consultar_nivel=" SELECT * FROM area WHERE   area.codigo in(SELECT area.codigo FROM area where area.id_area=$id and area.codigo not in('01'))";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());
            $consultar_nivel12=$consultar_nivel1->fetchAll();  
            foreach ($consultar_nivel12 as $key){
              $ry1=$key['codigo'];
              $ry2=$key['nombre'];
              $ry3=$key['descripcion']; 
              $ry4=$key['id_area'];            
              $consultar_nivel="UPDATE `area` SET `codigo` = '$CODIGO' WHERE `area`.`id_area` = $ry4;";
              $consultar_nivel1=$conexion->prepare($consultar_nivel);
              $consultar_nivel1->execute(array()); 
            }
            $consultar_nivel="UPDATE `area` SET `codigo` = '$CODIGO', `nombre` = '$NOMBRE', `descripcion` = '$descripchion' WHERE `area`.`id_area` = $id;";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 
            ?><script>alert("el area ha sido modificada");</script><?php 
          }
        }

      }else{

         $consultar_nivel=" SELECT * FROM area WHERE   area.codigo=$CODIGO and area.codigo not in('01') and area.id_area not in('$id') ";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0){

          ?><script>alert("el codigo actualmente esta registrado en otra area");</script><?php 
        }else{ 

          $consultar_nivel="UPDATE `area` SET `codigo` = '$CODIGO', `nombre` = '$NOMBRE', `descripcion` = '$descripchion' WHERE `area`.`id_area` = $id;";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
          ?><script>alert("el area ha sido modificada");</script><?php 
        }

      }
    }

    

     function nuevo_asignatura($NOMBRE,$descripchion,$CODIGO,$are)
    {
            

      if ($NOMBRE=='' ) {
             echo '<script type="text/javascript"> alert("campossssssss vacios");</script>';
      }else{


        include "conexion.php";


         $consultar_nivel="INSERT INTO `area` (`id_area`, `nombre`, `descripcion`, `codigo`, `area`) VALUES (NULL,'$NOMBRE','$descripchion','$CODIGO','$are')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());  

        $recupera =$conexion->lastInsertId() ;


        $consultar_nivel=" SELECT are_grado_sede.*,COUNT(area.codigo),area.codigo from are_grado_sede, area WHERE area.codigo='$CODIGO' and are_grado_sede.id_area=area.id_area GROUP by are_grado_sede.id_grado_sede";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0) {   
           "string";
          $consultar_nivel12=$consultar_nivel1->fetchAll();   
          foreach ($consultar_nivel12 as  $value) {
           $tg=$value['id_grado_sede'];
           $consultar_nivel="INSERT INTO `are_grado_sede` (`id_area_grado_sede`, `id_area`, `id_grado_sede`, `id__docente`) VALUES (NULL, '$recupera', '$tg', '0')";
           $consultar_nivel1=$conexion->prepare($consultar_nivel);
           $consultar_nivel1->execute(array());  
          }
        }
         
      }
    }




    function eliminarc($codigo,$tt){
      if ($tt=='') {
        ?>
        <script>alert(" campos vacios");</script>
        <?php
      }else{ 

        foreach ($tt as $eliminar) {
          

          include "conexion.php";
          $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area=$eliminar and  area.id_area=are_grado_sede.id_area   ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
          $consultar_nivel12s=$consultar_nivel1->rowCount();
          if ($consultar_nivel12s>0) {    ?>
            <script>alert(" actualmente el area  esta  relacionado con alguna sede");</script>
            <?php
          }else{ 

                    
            if ($codigo==01) {
              $consultar_nivel=" DELETE  FROM area WHERE area.id_area=$eliminar ";
              $consultar_nivel1=$conexion->prepare($consultar_nivel);
              $consultar_nivel1->execute(array()); 


              if($consultar_nivel1){

                ?><script>alert("el area   ha sido  eliminado del sistema");</script><?php
              }
            } else{
              $consultar_nivel=" DELETE  FROM area WHERE area.codigo=$codigo ";
              $consultar_nivel1=$conexion->prepare($consultar_nivel);
              $consultar_nivel1->execute(array()); 

              if($consultar_nivel1){
                ?><script>alert("el area   ha sido  eliminado del sistema");</script><?php
              }
            } 
          }
        }
      }
    } 





    function eliminar($codigo,$eliminar){
      if ($eliminar=='') {
        ?>
        <script>alert(" campos vacios");</script>
        <?php
      }else{ 




        include "conexion.php";
        $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area=$eliminar and  area.id_area=are_grado_sede.id_area   ";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0) {    ?>
          <script>alert(" actualmente el area  esta  relacionado con alguna sede");</script>
          <?php
        }else{ 

                    
          if ($codigo==01) {
            $consultar_nivel=" DELETE  FROM area WHERE area.id_area=$eliminar ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 


            if($consultar_nivel1){

              ?><script>alert("el area   ha sido  eliminado del sistema");</script><?php
            }
          } else{
            $consultar_nivel=" DELETE  FROM area WHERE area.codigo=$codigo ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 

            if($consultar_nivel1){
              ?><script>alert("el area   ha sido  eliminado del sistema");</script><?php
            }

          } 
        }
      }
    }

    function eliminar_asignatura($eliminar){
      if ($eliminar=='') {
        ?>
        <script>alert(" campos vacios");</script>
        <?php
      }else{ 




        include "conexion.php";
        $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area=$eliminar and  area.id_area=are_grado_sede.id_area   ";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0) {    ?>
          <script>alert(" actualmente la asignatura  esta  relacionado con alguna sede");</script>
          <?php
        }else{

          $consultar_nivel=" DELETE  FROM area WHERE area.id_area=$eliminar ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array());     
        }
      }
    }


    function eliminar_asignaturac($ss){
      if ($ss=='') {
        ?>
        <script>alert(" campos vacios");</script>
        <?php
      }else{ 


        foreach ($ss as $eliminar) {
        
          include "conexion.php";
          $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area=$eliminar and  area.id_area=are_grado_sede.id_area   ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
          $consultar_nivel12s=$consultar_nivel1->rowCount();
          if ($consultar_nivel12s>0) {    ?>
            <script>alert(" actualmente la asignatura  esta  relacionado con alguna sede");</script>
            <?php
          }else{

             $consultar_nivel=" DELETE  FROM area WHERE area.id_area=$eliminar ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());     
          }  # code...
        }
      }
    } 





///////////////////////////////////////////////////////////

    /////////////////elimina las areas  ya asignaturas relacionadas con el 
    function eliminar_relacion_area_asignaturas($i,$t){
      $u=0;
      $u1=0;
      include "conexion.php";
      $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll(); 
      foreach ($consultar_nivel12 as $key ) {


        $id=$key['id'];
        $consultar_nivel="SELECT * FROM `are_grado_sede` WHERE are_grado_sede.id_area=$t AND are_grado_sede.id_grado_sede=$id AND  are_grado_sede.id__docente  NOT  IN ('0')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
 
        foreach ($consultar_nivel1 as $keys ) {
          $keys[0]; 
          $u1=$u1+1;             
        }

        $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 



        foreach ($consultar_nivel1 as $keys ) {
          $id_area=$keys['id_area'];
          
          $consultar_nivel="SELECT * FROM `are_grado_sede` WHERE are_grado_sede.id_area=$id_area AND are_grado_sede.id_grado_sede=$id AND  are_grado_sede.id__docente  NOT  IN ('0')";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
 
          foreach ($consultar_nivel1 as $keys ) {
            $keys[0]; 
            $u=$u+1;             
          }
        }
        
      }



      if ($u==0 && $u1==0 ){
        $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        foreach ($consultar_nivel12 as $key ) {


          $id=$key['id'];
          $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 

          $consultar_nivel12ss=$consultar_nivel1->fetchAll(); 
          foreach ($consultar_nivel12ss as $ssa ) {
            $ss=$ssa['id_area'];
               
            $consultar_nivel="DELETE  FROM `are_grado_sede` WHERE are_grado_sede.id_area=$ss AND are_grado_sede.id_grado_sede=$id ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 
          }  
          $consultar_nivel="DELETE  FROM `are_grado_sede` WHERE are_grado_sede.id_area=$t AND are_grado_sede.id_grado_sede=$id ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array());  
        }      
      }



      if ($u!=0) {
        echo "tiene maestros";
      }
    }

    //consulta las areas disponibles para el grado
 
    function consultar_areas($e){
     
      include "conexion.php";
       $consultar_nivel=" SELECT area.* FROM area WHERE area.area=1 AND area.nombre not in (SELECT area.nombre FROM are_grado_sede,area WHERE are_grado_sede.id_area=area.id_area and are_grado_sede.id_grado_sede in(SELECT grado_sede.id FROM grado_sede WHERE grado_sede.id_grado=$e))";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();
      return $consultar_nivel12;
    } 

//saca las asignaturas de las areas mencionadas
  function consultar_asignaturas($r){
     
      include "conexion.php";
      $consultar_nivel="SELECT area.* FROM area WHERE area.area=0 and area.codigo=$r";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      return $consultar_nivel1;
    }  

// muestra todos los grados que tiene el colegio y los agrupa por nombre para que no se repite
    function todos_los_grados(){
     
      include "conexion.php";
      $consultar_nivel=" SELECT grado.* FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado GROUP by grado.nombre";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();
      return $consultar_nivel12;
    }  
    function materias_grado($t){
     
      include "conexion.php";
      $consultar_nivel=" SELECT area.codigo, are_grado_sede.id_area_grado_sede,are_grado_sede.id_area,are_grado_sede.id_grado_sede,area.nombre FROM are_grado_sede,area WHERE area.area=1 AND are_grado_sede.id_area=area.id_area and are_grado_sede.id_grado_sede in(SELECT grado_sede.id FROM grado_sede WHERE grado_sede.id_grado=$t) GROUP BY area.nombre";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      return $consultar_nivel1;
    } 


      //inserta las areas con asignaturas a todos los grado  que corresponda su nombre
    function registrar_carga_grado($i,$t){

      include "conexion.php";
      $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll(); 
      foreach ($consultar_nivel12 as $key ) {


        $id=$key['id'];
        $consultar_nivel="INSERT INTO `are_grado_sede` (`id_area_grado_sede`, `id_area`, `id_grado_sede`, `id__docente`) VALUES (NULL, '$t', '$id', '')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 

        $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        foreach ($consultar_nivel12 as $key ) {

          
          $id_area=$key['id_area'];
           $consultar_nivel="INSERT INTO `are_grado_sede` (`id_area_grado_sede`, `id_area`, `id_grado_sede`, `id__docente`) VALUES (NULL, '$id_area', '$id', '')";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 

        }
      }     
    } 
  }

?>



 