<?php 
    /**
     * 
     */
    class curso
    {
    	
    	function mostrar()
    	{
    		
    		
    		include "conexion.php";
 	        $consultar_nivel="SELECT * FROM curso  ";
 	        $consultar_nivel1=$conexion->prepare($consultar_nivel);
            
        $consultar_nivel1->execute(array());
            $consultar_nivel12=$consultar_nivel1->fetchAll();
            return $consultar_nivel12;
        
   
    	}
    }





 ?>