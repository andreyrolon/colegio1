

<?php 
  
    if ($_GET)
  {
    $action = $_GET["action"];
    if (function_exists($action))
    {
      call_user_func($action);
    }
  }

    function periodos1()
  {

        include "conexion.php";
      $consultar_nivel="SELECT * FROM periodo";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll();  
        ?>
        <tr> 
                <?php 
               
                foreach ($consultar_nivel12 as $key){ 

                  $st=$key['id_periodo'];
                  $t=$key['activar_nota'];

                  if ($t==1) {
                  ?>
                   
         
                    <th style="padding-left: 35px;padding-bottom: 6px;padding-top: 6px">
                      <input type="hidden" value="<?php echo $st  ?>" name="<?php echo 'id_periodo[]';  ?>"> 
                       <input type="checkbox" name="<?php echo 'u['.$st.']' ?>" id="cb1"  value='1' checked> <?php echo $key['nombre'] ?>
   

                    <?php
                  }
                  else{ 

                  ?>
                   
                    <th style="padding-left: 35px;padding-bottom: 6px;padding-top: 6px">b<?php echo $st;  ?>
                      <input type="hidden" value="<?php echo $st  ?>" name="<?php echo 'id_periodo[]';  ?>"> 
                       <input type="checkbox" name="<?php echo 'u['.$st.']' ?>" id="cb1"  value='1' > <?php echo $key['nombre'] ?>
   

                    <?php
                  }
                } ?>  
        </tr><?php  
    }

    function periodos2()
  {

        include "conexion.php";
      $consultar_nivel="SELECT * FROM periodo";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll();  
        ?>
        <tr> 
                <?php 
                
                foreach ($consultar_nivel12 as $key){ 

                  $t=$key['activar_recuperacion'];

                  $st=$key['id_periodo'];
                  if ($t==1) {
                  ?>
                   
                   
                    <th style="padding-left: 35px;padding-bottom: 6px;padding-top: 6px">
                     <input type="hidden" value="<?php echo $st  ?>" name="<?php echo 'id_periodo1[]';  ?>"> 
                       <input type="checkbox" name="<?php echo 'd['.$st.']' ?>" id="cb1"  value='1' checked> <?php echo $key['nombre'] ?>
   

                    <?php
                  }
                  else{ 

                  ?>
                   
                   
                    <th style="padding-left: 35px;padding-bottom: 6px;padding-top: 6px">x<?php echo $st ?>

                     <input type="hidden" value="<?php echo $st  ?>" name="<?php echo 'id_periodo1[]';  ?>"> 
                       <input type="checkbox" name="<?php echo 'd['.$st.']' ?>" id="cb1"  value='1' > <?php echo $key['nombre'] ?>

                    <?php
                  }
                } ?>  
        </tr><?php  
    }
     

function permiso_calificaciones(){

      include "conexion.php";  
      $r1=$_REQUEST['id_periodo'];
      $r2=$_REQUEST['id_periodo1'];

     
    
    

      if(!empty($_REQUEST['u'])){
       $fb1=$_REQUEST['u'];
          foreach ($r1 as $key){

      if(!empty($fb1[$key])){
        $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '$fb1[$key]' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }else{

          $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '0' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
} 
}else{

          foreach ($r1 as $key){
          $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '0' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
      }
      if(!empty($_REQUEST['d'])){
      
         $f1=$_REQUEST['d'];
          foreach ($r2 as   $value) {

      if(!empty($f1[$value])){

        $consultar_nivel="UPDATE `periodo` SET `activar_recuperacion` = '$f1[$value]' WHERE `periodo`.`id_periodo` = '$value'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }else{

        $consultar_nivel="UPDATE `periodo` SET `activar_recuperacion` = '0' WHERE `periodo`.`id_periodo` = '$value'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      } 
      }
} else{
     foreach ($r2 as $value){
          $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '0' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
      }
      



    }
    function permiso_docente_notas(){

    include "conexion.php"; 


      if(!empty($_POST['x'])){
      $rui=$_POST['x']; 
     $consultar_nivel="SELECT docente.foto, docente.nombre,docente.apellido,docente_habilitado.id_periodo,docente_habilitado.activo_nota,docente_habilitado.activo_recuperacion,docente_habilitado.id_docente FROM docente LEFT JOIN docente_habilitado on docente.id_docente=docente_habilitado.id_docente";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll();}else{

 $consultar_nivel="SELECT docente.foto, docente.nombre,docente.apellido,docente_habilitado.id_periodo,docente_habilitado.activo_nota,docente_habilitado.activo_recuperacion,docente_habilitado.id_docente FROM docente LEFT JOIN docente_habilitado on docente.id_docente=docente_habilitado.id_docente";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll();

    }
 
    ?>


      <table class="table table-striped"  style="background-color: #fff;padding: 20px;">
    <thead>
      <tr>
        <th>foto</th>
        <th>nombre</th>
        <th>apellido</th>
        <?php 
        $consultar_nivelx="SELECT * FROM periodo";
        $consultar_nivel1x=$conexion->prepare($consultar_nivelx);
        $consultar_nivel1x->execute(array());
        $consultar_nivel12x=$consultar_nivel1x->fetchAll(); 
        foreach ($consultar_nivel12x as $keyx ) {
            echo "<th>".$keyx['nombre']."<th>";

          } 
         ?>
      </tr>
    </thead>
    <tbody>

    
        <?php
        foreach ($consultar_nivel12 as $key ) { ?>

          <tr>
            <td><img src="<?php echo $key['foto'] ?>" alt="" style='width: 100px;height:  100px;'></td>
            <td><?php echo $key['nombre'] ?></td>
            <td><?php echo $key['apellido'] ?></td>

            <?php 

               $id_docente=$key['id_docente'];
               $pe=$key['id_periodo'];
              $no=$key['activo_nota'];

              $re=$key['activo_recuperacion'];
             foreach ($consultar_nivel12x as $keyx ) {
           

             $n=$keyx['id_periodo']; 
             if($n==$pe and $no==1){ 
               ?>
 


               <td>
               <input type="hidden"  value="<?php $id_docente ?>"  name="<?php echo 'id_docente[]';  ?>">
                <input type="hidden"  value="<?php echo $n ?>"  name="<?php echo 'nombre['.$id_docente.']';  ?>">
                <input type='checkbox' name="<?php echo 'notas['.$id_docente.']' ?>" value='1' checked >n   <?php
          } else{

               ?>
               <td><input type="hidden" name="<?php echo 'id_docente[]';  ?>" value="<?php $id_docente ?>"  >
                <input type="hidden"    name="<?php echo 'nombre['.$id_docente.']';  ?>" value="<?php echo $n ?>">
                <input type='checkbox' name="<?php echo 'notas['.$id_docente.']' ?>" value='1'   >n       <?php
          }
           if($n==$pe and $re==1){ 
            ?>  <input type='checkbox' name="<?php echo 'recu['.$id_docente.']' ?>" value='1' checked >re</r><td>   <?php
          } else{

            ?>  <input type='checkbox' name="<?php echo 'recu['.$id_docente.']' ?>" value='1'  >re</r><td>      <?php
          }

        }
         ?>
 
          </tr>
        
    <?php } ?>

    </tbody>
  </table>

   <?php
  }

function habilitar_docente(){

      include "conexion.php";  
      $id_docente=$_REQUEST['id_docente'];
      $r2=$_REQUEST['id_periodo1'];

     
    
    

      if(!empty($_REQUEST['notas'])){
       $fb1=$_REQUEST['notas'];
          foreach ($r1 as $key){

      if(!empty($fb1[$key])){
        $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '$fb1[$key]' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }else{

          $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '0' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
} 
}else{

          foreach ($r1 as $key){
          $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '0' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
      }
      if(!empty($_REQUEST['d'])){
      
         $f1=$_REQUEST['d'];
          foreach ($r2 as   $value) {

      if(!empty($f1[$value])){

        $consultar_nivel="UPDATE `periodo` SET `activar_recuperacion` = '$f1[$value]' WHERE `periodo`.`id_periodo` = '$value'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }else{

        $consultar_nivel="UPDATE `periodo` SET `activar_recuperacion` = '0' WHERE `periodo`.`id_periodo` = '$value'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      } 
      }
} else{
     foreach ($r2 as $value){
          $consultar_nivel="UPDATE `periodo` SET `activar_nota` = '0' WHERE `periodo`.`id_periodo` = '$key'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
      }
      



    }


 ?>