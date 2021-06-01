<?php 
  
  if ($_GET)
  {
    $action = $_GET["action"];
    if (function_exists($action))
    {
      call_user_func($action);
    }
  }
 
  function consultar_apellido_notas_de_paso()
  {
    $ida=$_POST["first_name"] ;

    include "conexion.php";
      $consultar_nivel="SELECT sede.NOMBRE as sede,jornada.NOMBRE as jornada,curso.nombre as curso ,grado.nombre as grado, alumnos.nombre,alumnos.apellido,informeacademico.id_informe_academico as id FROM jornada,curso,grado, alumnos,informeacademico,sede WHERE alumnos.id_alumnos=informeacademico.id_alumno and sede.ID_SEDE=informeacademico.id_sede and informeacademico.id_grado=grado.id_grado and informeacademico.id_curso=curso.id_curso AND informeacademico.id_jornada=jornada.ID_JORNADA and alumnos.apellido like '%$ida%'";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $variable=$consultar_nivel1->fetchAll(); 
    
    ?>

  <div class="col-md-8 col-md-offset-2">
             
              <div class="panel panel-primary">
               <div class="panel-heading">Buscar alumno</div>
               <div class="panel-body">
                 
                



                <table class="table table-striped table-hover ">
                  <thead class="thead-dark">

                    <tr>
                      <th class='table-header'>nombres</th> 
                      <th class='table-header'>apellidos</th>
                      <th class='table-header' >jornada</th>
                      <th class='table-header'  >sede</th> 

                      <th class='table-header' >grado</th>

                      <th class='table-header' >curso</th> 
                      <th class='table-header' >mostrar</th>  
                    </tr>
                  </thead>
                  <tbody id='table-body'>
                    <?php 
                    foreach ($variable as $key  ) {
                      

                      
                     ?>

                     <tr>
                      <td><?php echo $key['nombre'] ; ?></td>
                      <td><?php echo $key['apellido'];  ?></td>
                      <td><?php echo $key['grado'] ; ?></td>
                      <td><?php echo $key['curso']  ?></td>
                      <td><?php echo $key['sede'] ; ?></td>
                      <td><?php echo $key['jornada'] ; ?></td> 
                      <td>  <form  method="get" action="notas_relleno2.php" ><button type=" submit" class="panel-primary" value="<?php echo $key['id'] ; ?>" name="u">mostrar</button></form></td>
                      </tr>

                    <?php } ?>



                  </tbody></table>


                  
                </div> 
              </div>
            </div>






    <?php





  }


  function periodos()
  {

    include "conexion.php";
         $consultar_nivel="SELECT * FROM periodo";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();  
      ?>

<tr>
        <th class='table-header'>materia</th> 
                      <?php foreach ($consultar_nivel12 as $key) {

                        ?>
                         <th><?php echo $key['nombre'] ?></th>

                      <?php
                       } ?>  
                    </tr>


      <?php   
  }
  function materiasex()
  {
    $rt=$_POST['first_namei'];

    include "conexion.php";
         $consultar_nivel="SELECT materias.* from materias WHERE materias.id_informe_academico='$rt' and materias.codigo in('01') or materias.id_materias in(SELECT materias.id_materias FROM `materias` WHERE materias.codigo not in('01') and materias.area=0 AND materias.id_informe_academico='$rt')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll(); 
    foreach ($consultar_nivel12 as $key) {
    ?>
    <tr>
      <th><?php echo $key['nom_materia'] ?> </th>
      <?php  
      $consultar_nivel="SELECT materia_por_periodo.* from materia_por_periodo WHERE  materia_por_periodo.id_materia=".$key['id_materias'];
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll(); 
      foreach ($consultar_nivel12 as $key) {
        ?>id_materia_por_periodo
        <th>
 

          <input type="hidden" value="<?php echo $key['id_materia_por_periodo'] ?>"name="<?php echo "id_nota_por_periodo[]" ;?>"  >
          <input type="text" value="<?php echo $key['nota'] ?>" name="<?php echo "nota_por_periodo[".$key["id_materia_por_periodo"]."]";?>"  style='width: 40px' pattern="^[0-9]+([.][0-9]+)?$" title="debe ser un numero menor que 6 y se punto no ">
        </th>
        <?php
      } ?>
   </tr>
                      <?php
    } 
 } 

 function actualizar_notas_de_paso()
{
 
  $id_nota_por_periodo = $_POST["id_nota_por_periodo"];
  $nota_por_periodo = $_POST["nota_por_periodo"];  
  
    # code...
 
   
    include "conexion.php";
        foreach ( $id_nota_por_periodo as $key ) {  


   $consultar_nivel="UPDATE `materia_por_periodo` SET `nota` = '$nota_por_periodo[$key]' WHERE `materia_por_periodo`.`id_materia_por_periodo` = '$key'" ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);

    $consultar_nivel1->execute(array());

   }
    

}




  ?>
