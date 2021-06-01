<?php 
    /**
     * 
     */
    class docente
    {
        //muestra todo el personal del area adminstrativo

        function registrar( $NOMBRE,  $apellido, $telefono, $celular, $genero, $fecha_nacimiento, $lugar_nacimiento, $barrio, $tipo_documento, $numero_documento, $correo, $destino, $clave, $escalafon,$direccion,$fecha1,$items2,$items3,$items4)
        {

            $contra = password_hash($clave,PASSWORD_DEFAULT);


            include "../../../codes/rector/conexion.php";
            $consultar_nivel="INSERT INTO `docente` (`id_docente`, `NOMBRE`,  `apellido`, `telefono`, `celular`, `genero`, `fecha_nacimiento`, `lugar_nacimiento`, `barrio`, `tipo_documento`, `numero_documento`, `correo`, `foto`, `clave`, `escalafon`,`direccion`,`fecha`, `rol`) VALUES ('null','$NOMBRE',  '$apellido', '$telefono', '$celular', '$genero', '$fecha_nacimiento', '$lugar_nacimiento', '$barrio', '$tipo_documento', '$numero_documento', '$correo', '$destino', '$contra', '$escalafon','$direccion','$fecha1','Docente')";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());  

            $recupera =$conexion->lastInsertId() ;

            if ($consultar_nivel1) {




                $items2a=implode($items2);
                $items3a=implode($items3);
                $items4a=implode($items4);   

                if ($items4a==''&& $items3a=='' &&$items2a=='') {

                }else{




                ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
                    while(true) {

                    //// RECUPERAR LOS VALORES DE LOS ARREGLOS //////// 
                        $item2 = current($items2);
                        $item3 = current($items3);
                        $item4 = current($items4);  

                    ////// ASIGNARLOS A VARIABLES /////////////////// 
                        $nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
                        $carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
                        $gru=(( $item4 !== false) ? $item4 : ", &nbsp;"); 

                    //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
                        $valores='("","'.$nom.'","'.$carr.'","'.$gru.'","'.$recupera.'"  ),';

                    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
                        $valoresQ= substr($valores, 0, -1);

                    ///////// QUERY DE INSERCIÓN ////////////////////////////  
                        $sql = "INSERT INTO titulos_docente (id_titulo_docente, nombre, institucion, ano, id_docente) 
                        VALUES $valoresQ"; 
                        $consultar_nivel1=$conexion->prepare($sql);
                        $consultar_nivel1->execute(array());



                    // Up! Next Value 
                        $item2 = next( $items2 );
                        $item3 = next( $items3 );
                        $item4 = next( $items4 ); 

                    // Check terminator
                        if(  $item2 === false && $item3 === false && $item4 === false  ) break;

                    }
                }













                ?>
                <script>alert("El   usuario a sido registrado exitosamente");</script><?php
            }
        }

        function mostrar($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT docente.*,titulos_docente.nombre AS titulo,titulos_docente.institucion,titulos_docente.ano FROM titulos_docente RIGHT JOIN docente ON titulos_docente.id_docente=docente.id_docente ".$va;
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
            
        }

        function editar($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT docente.*,titulos_docente.nombre AS titulo,titulos_docente.institucion,titulos_docente.ano FROM titulos_docente RIGHT JOIN docente ON titulos_docente.id_docente=docente.id_docente ".$va;
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
            
        }

        function titulos($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT titulos_docente.* FROM titulos_docente ".$va;
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
            
        }

        function actualizar($id,$nombre,$apellido,$telefono,$celular,$genero,$fecha_nacimiento,$lugar_nacimiento,$barrio,$tipo_documento,$numero_documento,$correo,$direccion,$escalafon,$fecha,$clave) 
        {


            $contra = password_hash($clave,PASSWORD_DEFAULT);


            include"../../../codes/rector/conexion.php";
            if($clave==''){ 
            $mod="UPDATE `docente` SET `nombre` = '$nombre', `apellido` = '$apellido', `telefono` = '$telefono', `celular` = '$celular', `genero` = '$genero', `fecha_nacimiento` = '$fecha_nacimiento', `lugar_nacimiento` = '$lugar_nacimiento', `barrio` = '$barrio', `tipo_documento` = '$tipo_documento', `numero_documento` = '$numero_documento', `correo` = '$correo', `escalafon` = '$escalafon', `direccion` = '$direccion', `fecha` = '$fecha' WHERE `docente`.`id_docente` =".$id;
                $consultar_rotulo1=$conexion->prepare($mod);
                $consultar_rotulo1->execute(array());
           
            }
            else{
             $mod="UPDATE `docente` SET `nombre` = '$nombre', `apellido` = '$apellido', `telefono` = '$telefono', `celular` = '$celular', `genero` = '$genero', `fecha_nacimiento` = '$fecha_nacimiento', `lugar_nacimiento` = '$lugar_nacimiento', `barrio` = '$barrio', `tipo_documento` = '$tipo_documento', `numero_documento` = '$numero_documento', `correo` = '$correo', `clave` = '$contra' `escalafon` = '$escalafon', `direccion` = '$direccion', `fecha` = '$fecha' WHERE `docente`.`id_docente` =".$id;
                $consultar_rotulo1=$conexion->prepare($mod);
                $consultar_rotulo1->execute(array());   
            }
        }

        function memorandum($nombre, $apellido,$cargo,$fecha_acontecimiento,$acontecimientos,$atenuantes)

        {

            include "../../../codes/rector/conexion.php";
            $consultar_nivel="INSERT INTO `memorandum` (`id_memorandum`.`nombre`,`apellido`,`cargo`,`fecha_acontecimiento`,`acontecimientos`.`atenuantes`) VALUES (null, '$nombre','$apellido','cargo','fecha_acontecimiento','acontecimientos','atenuantes')";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 
            $recupera1 =$conexion->lastInsertId() ;


            ?>
            <script>alert("El memorandum fue generado exitosamente");</script><?php

        }
        
        
        function agregar_jefe_area($id_doc,$area){
            include "../../../codes/rector/conexion.php";
            foreach($area as $value){
            $sql="SELECT * FROM `area_docente` WHERE area_docente.id_area=$value AND area_docente.id_docente=$id_doc";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql3=$sql1->rowCount();
                if($sql3 == 0){
                    $inser="INSERT INTO `area_docente`(`id`, `id_area`, `id_docente`) VALUES ('',$value,$id_doc)";
                    $ins=$conexion->prepare($inser);
                    $ins->execute(array());
                }else{
                    ?>
                    <script>alert('Esa area ya la tiene asignada el docente');</script>
                    <?php
                }
            }
            
        }
        
        function eliminar_area($id){
            include "../../../codes/rector/conexion.php";
            $sql="DELETE FROM `area_docente` WHERE area_docente.id_docente=$id";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            
        }

        
        function ver_asignatura($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT area.*, a.grado, a.curso FROM are_grado_sede INNER JOIN area ON are_grado_sede.id_area=area.id_area INNER JOIN (SELECT grado_sede.id, grado.nombre as grado, curso.nombre as curso FROM grado_sede INNER JOIN grado ON grado_sede.id_grado=grado.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso) as a ON a.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id__docente=$va GROUP BY area.id_area
";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
            
        }
        
        function docente_ver($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT * FROM docente $va";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
        
        function titulos_perfil($va){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT * FROM titulos $va";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
        
         function ver_periodos(){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT numero FROM periodo order by numero";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
         function ver_periodos1(){
            include "../../../codes/rector/conexion.php";
            $sql="SELECT periodo.numero from periodo WHERE  CURDATE()>=periodo.fecha_inicio and curdate()<=periodo.fecha_fin";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;
        }
           
        
    }
?>
