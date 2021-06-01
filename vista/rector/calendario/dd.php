<?php 




include '../../../ajax/conexion.php';
  session_start();
 echo   $sql = "SELECT notificaciones.* FROM notificaciones  WHERE notificaciones.de='".$_SESSION['Id_Doc']."'   or notificaciones.id_persona='".$_SESSION['Id_Doc']."'";
    $req = $conexion->prepare($sql);
    $req->execute();
    $events = $req->fetchAll();
 


   ?>