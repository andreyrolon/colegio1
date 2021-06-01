<?php

class examen
    {
        
   function insert($tema,$curso,$asignatura,$tiempo)
   {  
    include "../../../codes/rector/conexion.php";
    $con3="SELECT grado_sede.id_grado, grado_sede.id_sede, grado_sede.id_jornada, grado_sede.id_curso FROM `grado_sede` WHERE grado_sede.id=$curso";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $con2=$con1->fetchAll();
    foreach($con2 as $key){
        $con3="INSERT INTO `examen`(`id`, `id_grado`, `id_sede`, `id_jornada`, `id_curso`, `nombre_materia`, `tema`, `minutos`) VALUES ('','$key[0]','$key[1]','$key[2]','$key[3]','$asignatura','$tema','$tiempo')";
        $con1=$conexion->prepare($con3);
        $con1->execute(array());
    }
}
    
}
?>