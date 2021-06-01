<?php
/**
* 
*/

		try {
			
			$conexion=new pdo('mysql:host=localhost;dbname=col','root','');
		} catch (Exception $e) {
			die("Error".$e->getMessage());
			echo "Linea del error".$e->getLine();
		}
		return $conexion;
 


?>