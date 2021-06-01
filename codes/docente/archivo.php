<?php

class archivo
    {
    
    function tipo_archivo(){
        include "../../../codes/rector/conexion.php";
        $sql="SELECT * FROM `tipo_archivo`";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();
        return $sql2;
    }
    
    function nuevo_archivo($nom,$tipo,$cur,$des,$id,$arc){
        include "../../../codes/rector/conexion.php";
        $ruta='../../../archivos/'.$arc['files']['name'];
        move_uploaded_file($arc['files']['tmp_name'],$ruta);
        foreach($cur as $c){
            $sql="INSERT INTO `archivo`(`id`, `nombre`, `id_tipo_archivo`, `id_grado_sede`, `archivo`, `descripcion`, `id_docente`) VALUES ('','$nom','$tipo','$c','$ruta','$des','$id')";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
        } 
    }
    
    function borrar_masivo($id){
        include "../../../codes/rector/conexion.php";
        foreach($id as $key){
            $sql="DELETE FROM `archivo` WHERE archivo.id=$key";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
        }
    }
}

?>