<?php 
    /**
     * 
     */
    class jornada
    {

        function mostrar()
        {


            include "conexion.php";
            $consultar_nivel="SELECT ID_JORNADA,ABREVIACION,NOMBRE FROM jornada  ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            
            $consultar_nivel1->execute(array());
            $consultar_nivel12=$consultar_nivel1->fetchAll(); 
            $conexion="NULL";
            return $consultar_nivel12;


        }

        function mostrar_jornada_sede()
        {


            include "conexion.php";
            $consultar_nivel="SELECT jornada_sede.ID_JS,jornada.NOMBRE as jornada,sede.NOMBRE as sede from sede,jornada,jornada_sede WHERE jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_SEDE=sede.ID_SEDE and sede.inhabilitar=0 and jornada_sede.inhabilitar=0 order by  jornada_sede.ID_SEDE";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            
            $consultar_nivel1->execute(array());
            $consultar_nivel12=$consultar_nivel1->fetchAll();
            $conexion="NULL";
            return $consultar_nivel12;


        }
        function periodo()
        {


            include "conexion.php";
            $consultar_nivel="SELECT numero from periodo";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());
            $consultar_nivel12=$consultar_nivel1->fetchAll();
             

            return $consultar_nivel12;


        }
        function docente()
        {


            include "conexion.php";
            $consultar_nivel="SELECT id_docente,nombre,foto ,apellido,genero from docente WHERE docente.inhabilitado not in('1')";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());
            $registro=$consultar_nivel1->fetchAll();
            return $registro;


        }
    }





    ?>