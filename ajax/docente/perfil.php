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

function form1(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $genero=$_POST['genero'];
    $fecha_=$_POST['fecha_n'];
    $lugar=$_POST['lugar_n'];
    $sql="UPDATE `docente` SET `nombre`='$nombre',`apellido`='$apellido',`genero`='$genero', `fecha_nacimiento`='$fecha',`lugar_nacimiento`='$lugar' WHERE docente.id_docente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form2(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $email=$_POST['email'];
    $cell=$_POST['celular'];
    $telefono=$_POST['telefono'];
    $dir=$_POST['direccion'];
    $barrio=$_POST['barrio'];
    $sql="UPDATE `docente` SET `telefono`='$telefono',`celular`='$cell',`barrio`='$barrio',`correo`='$email',`direccion`='$dir' WHERE docente.id_docente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form3(){
    include "../../codes/rector/conexion.php";
    $titulo=$_POST['x']; $id=$_POST['c'];
    $sql="UPDATE `titulos` SET `nombre`='$titulo' WHERE titulos.id_titulos='$id'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form4(){
    include "../../codes/rector/conexion.php";
    $institucion=$_POST['x']; $id=$_POST['c'];
    $sql="UPDATE `titulos` SET `institucion`='$institucion' WHERE titulos.id_titulos='$id'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form7(){
    include "../../codes/rector/conexion.php";
    $anual=$_POST['x']; $id=$_POST['c'];
    $sql="UPDATE `titulos` SET `ano`='$anual' WHERE titulos.id_titulos='$id'";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function form5(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $escalafon=$_POST['escalafon'];
    $sql="UPDATE `docente` SET `escalafon`='$escalafon' WHERE docente.id_docente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function nuevo_titulo(){
    include "../../codes/rector/conexion.php";
    $institucion=$_POST['institucion']; $titulo=$_POST['titulo']; $anual=$_POST['anual']; $id=$_SESSION['Id_Doc'];
    $sql="INSERT INTO `titulos`(`id_titulos`, `nombre`, `institucion`, `ano`, `ID_ADMIN`) VALUES ('','$titulo','$institucion','$anual','$id')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

   
?>