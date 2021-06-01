<?php 
    /**
     * 
     */
    class admin
    {

      function pais(){
        include "conexion.php";
          $consultar_nivel="SELECT  id,paisnombre FROM pais order by paisnombre";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        return $consultar_nivel12;
      }
      function salud(){
        include "conexion.php";
          $consultar_nivel="SELECT   nombre FROM salud ";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        return $consultar_nivel12;
      }

      function estado($pais){
        include 'conexion.php';
        
         $consultar_nivel="SELECT estado.estadonombre from estado,pais WHERE estado.ubicacionpaisid=pais.id AND pais.paisnombre='$pais'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        return $consultar_nivel12;

      }
    
      function departamento(){
        include 'conexion.php';
        
          $consultar_nivel="SELECT estado.estadonombre from pais,estado WHERE pais.id=estado.ubicacionpaisid and pais.paisnombre='colombia'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        return $consultar_nivel12;

      }
    function area1()
    {
        
        
      include "conexion.php";
      $consultar_nivel="SELECT area.nombre FROM area WHERE area.nombre not in(SELECT area_docente.area FROM area_docente) GROUP by area.nombre
";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      return $consultar_nivel1;
    }

        //registra todo el personal del area adminstrativo con sus titulos
        
        function registrar($nombre,$apellido,$tiopd,$numerod,$fechan,$lugar,$direccion,$barrio,$celular,$telefon,$rol,$clave,$foto,$correo,$gener,$escala,$ano,$id_sede,$id_jornada,$items2,$items3,$items4)
        {
            
            $contra = password_hash($clave,PASSWORD_DEFAULT);


            include "../../codes/conexion.php";
              $consultar_nivel="INSERT INTO `administradores` (`ID_ADMIN`, `NOMBRE`, `APELLIDO`, `TIPO_DOCUMENTO`, `NUMERO_DOCUMENTO`, `FECHA_NACIMIENTO`, `LUGAR_NACIMIENTO`, `DIRECCION`, `BARRIO`, `CELULAR`, `TELEFONO_CA`, `ROL`, `CLAVE`, `FOTO`, `CORREO`, `GENERO`, `ESCALAFON`, `FECHA`) VALUES (null,'$nombre','$apellido','$tiopd','$numerod','$fechan','$lugar','$direccion','$barrio','$celular','$telefon','$rol','$contra','$foto','$correo','$gener','$escala','$ano')";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 

             $recupera =$conexion->lastInsertId() ;
           $consultar_nivel="INSERT INTO `jornada_sede_admin` (`ID_JSA`, `ID_SEDE`, `ID_JORNADA`, `ID_ADMIN`) VALUES (?, ?,?,?);";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array(null,$id_sede,$id_jornada,$recupera)); 

            if ($consultar_nivel1) {




                $items2a=implode($items2);
                $items3a=implode($items3);
                $items4a=implode($items4);   

                if ($items4a==''&& $items3a=='' &&$items2a=='') {
                     
                }else{

                 

 
                    while(true) {
 
                        $item2 = current($items2);
                        $item3 = current($items3);
                        $item4 = current($items4);  
 
                        $nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
                        $carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
                        $gru=(( $item4 !== false) ? $item4 : ", &nbsp;"); 
 
                        $valores='("","'.$nom.'","'.$carr.'","'.$gru.'","'.$recupera.'"  ),';
 
                        $valoresQ= substr($valores, 0, -1);
 
                         $sql = "INSERT INTO titulos (id_titulos, nombre, institucion, ano, ID_ADMIN) 
                        VALUES $valoresQ"; 
                        $consultar_nivel1=$conexion->prepare($sql);
                        $consultar_nivel1->execute(array());
 

 
                        $item2 = next( $items2 );
                        $item3 = next( $items3 );
                        $item4 = next( $items4 ); 
 
                        if(  $item2 === false && $item3 === false && $item4 === false  ) break;
                         
                    }
                }













                ?>
                <script>alert("El   usuario a sido registrado exitosamente");</script><?php
            }
        }


       ///////////////// elimina   el personal del area administrativo

        function  eliminar($ro){

            include "../../codes/conexion.php";

            $consultar_nivel=" DELETE  FROM jornada_sede_admin WHERE jornada_sede_admin.ID_ADMIN=$ro ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 

            $h="DELETE  FROM administradores WHERE administradores.ID_ADMIN=$ro";
            $y=$conexion->prepare($h);
            $y->execute(array());
    
        
            if($y){

              ?>
              <script>alert("el usuario ha sio  eliminado del sistema");</script>

              <?php
            } 
        }
    

       ///////////////// elimina   el personal del area administrativo masivamente

    function eliminarc($y){
        if ($y=='') {
            ?>
            <script>alert(" campos vacios");</script>

            <?php
        }else{ 
            include "../../codes/conexion.php";

            foreach($y as $eliminar ){
                $consultar_nivel=" DELETE  FROM jornada_sede_admin WHERE jornada_sede_admin.ID_ADMIN=$eliminar ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 

            $h="DELETE  FROM administradores WHERE administradores.ID_ADMIN=$eliminar";
            $yS=$conexion->prepare($h);
            $yS->execute(array());
    
        
         

                } 
                   if($yS){

              ?>
              <script>alert("los usuarios  han sido  eliminado del sistema);</script>

              <?php
            } 
            
        }
    }
        
    
       ///////////////// muestra   el personal del area administrativo
    function mostrar($q)
    {
            
            
       include "../../codes/conexion.php";
         $consultar_nivel=" SELECT sede.ID_SEDE, administradores.*,jornada.NOMBRE as NOMBRE_j,sede.NOMBRE as NOMBRE_S FROM jornada_sede_admin INNER JOIN administradores on administradores.ID_ADMIN=jornada_sede_admin.ID_ADMIN INNER JOIN jornada on jornada.ID_JORNADA=jornada_sede_admin.ID_JORNADA INNER JOIN sede on sede.ID_SEDE=jornada_sede_admin.ID_SEDE ".$q  ;
       $consultar_nivel1=$conexion->prepare($consultar_nivel);
            
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll();
        return $consultar_nivel12;
    }

    function mostrar_admin($q){
          include "conexion.php";
         $consultar_nivel=" SELECT   administradores.*  FROM  administradores WHERE administradores.ID_ADMIN=".$q  ;
       $consultar_nivel1=$conexion->prepare($consultar_nivel);
            
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll();
        return $consultar_nivel12;
    }

 
}
    ?>