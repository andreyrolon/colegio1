<?php
$_SESSION=array();
if(ini_get("session.use_cookies"))
{
    $cerrar=session_get_cookie_params();
    setcookie(session_name(),'',time()-42000,
    $cerrar["path"],$cerrar["domain"],
              $cerrar["secure"],$cerrar["httponly"]);
}
session_destroy();
header("location:../../login.php");

?>