<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}

function  mostrar(){
	include '../../conexion.php';
    $ano=date('Y');

    $consultargrado_sede="SELECT grado_sede.*,grado.nombre,curso.numero,jornada.NOMBRE as jornada,sede.NOMBRE AS sede from sede,jornada,curso,grado,grado_sede WHERE sede.ID_SEDE=grado_sede.id_sede and grado.id_grado=grado_sede.id_grado and jornada.ID_JORNADA=grado_sede.id_jornada and curso.id_curso=grado_sede.id_curso and grado_sede.id=".$_POST['id'];
	$consultargrado_sede1=$conexion->prepare($consultargrado_sede);
	$consultargrado_sede1->execute(array());
	foreach ($consultargrado_sede1 as $key) {
		$id_grado=$key['id_grado'];
		$id_curso=$key['id_curso'];
		$id_jornada=$key['id_jornada'];
		$id_sede=$key['id_sede'];
		$sede=$key['sede'];
		$jornada=$key['jornada'];
		$numero=$key['numero'];
		$nombre=$key['nombre'];

	}


      $consultar_nivel="SELECT alumnos.tipo_documento,alumnos.numero_documento,alumnos.genero,alumnos.nombre,alumnos.apellido,alumnos.foto,informeacademico.*,informeacademico.ano from alumnos,informeacademico WHERE informeacademico.id_alumno=alumnos.id_alumnos and  informeacademico.id_sede=$id_sede and  informeacademico.id_curso=$id_curso  and  informeacademico.id_jornada=$id_jornada  and  informeacademico.ano='$ano'  and informeacademico.id_grado=$id_grado order by alumnos.apellido ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());


	 $count="SELECT count(informeacademico.id_informe_academico)as f from alumnos,informeacademico WHERE informeacademico.id_alumno=alumnos.id_alumnos and  informeacademico.id_sede=$id_sede and  informeacademico.id_curso=$id_curso  and  informeacademico.id_jornada=$id_jornada  and  informeacademico.ano='$ano'  and informeacademico.id_grado=$id_grado order by alumnos.apellido ";
	$count=$conexion->prepare($count);
	$count->execute(array());

	 foreach ($count as  $value) {
	 	$cont=$value['f'];
	 }
if($_POST['tipo_lista']==4){ 
?> 


  <table  class="table-responsive" id="" style=" width:100%;"> 
          <thead style="border: solid 1px; color: #000;">
            <tr style="background-color: #00b300">
              <th style="border:1px;text-transform: uppercase;">
          <center><h2>INSTITUCION EDUCATIVA NUESTRA SEÑORA DE BELEN</h2>
<hr><br>



          </center>
          </th>
          <th style="border:1px;text-transform: uppercase;"><img src="../../../logos/foto4.png" alt="" style="width: 72%;height: 60%"></th></tr><tr>
          	</table>
          	<table><tr>
<th  style="width: 100px">sede:</th><th style="width: 100px"><?php echo $sede ?></th><th style="width: 100px">jornada:</th><th style="width: 100px"><?php echo $jornada ?></th><th style="width: 100px">Grado:</th><th style="width: 100px"><?php echo $nombre ?></th><th style="width: 100px">Curso:</th><th style="width: 100px"><?php echo $numero ?></th> 
     </table>
 			<h4 style="float: left;">Nombre de actividad:________________________________________</h4>
          <h4 style="text-align: center;"> <?php 
          echo  '<strong>'. " Etudiantes en total:</strong> ". $cont; ?></h4> 
        <table  class="table-responsive" id="" style=" border-collapse: collapse;border: 1px solid #ddd;text-align: left;width: 100%"> 
          <thead>
            <tr style="background-color: #00b300;">
             
              <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Id</th>
              <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Nombre completo</th>
             <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Tipo documento</th>
             <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Numero documento</th>
 			<th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;width: 200px">Firma</th>
 

            </tr>
          </thead>
          
          <tbody style="border: solid 1px;">
             <?php $d=0;
             foreach ($consultar_nivel1 as $row) {

               ?>
               <tr>      
  
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $d=$d+1;?></td>
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $row['nombre'].' '.$row['apellido']; ?></td>

<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $row['tipo_documento']; ?></td> 
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $row['numero_documento']; ?></td>  
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"> </td> 
              </tr>
              


            <?php 
            }

             ?>

 
          </tbody>
        </table><?php
}if($_POST['tipo_lista']==1){ 
?> 


  <table  class="table-responsive" id="" style=" width:100%;"> 
          <thead style="border: solid 1px; color: #000;">
            <tr style="background-color: #00b300">
              <th style="border:1px;text-transform: uppercase;">
          <center><h2>INSTITUCION EDUCATIVA NUESTRA SEÑORA DE BELEN</h2>
<hr><br>



          </center>
          </th>
          <th style="border:1px;text-transform: uppercase;"><img src="../../../logos/foto4.png" alt="" style="width: 72%;height: 60%"></th></tr><tr>
          	</table>
          	<table><tr>
<th  style="width: 100px">sede:</th><th style="width: 100px"><?php echo $sede ?></th><th style="width: 100px">jornada:</th><th style="width: 100px"><?php echo $jornada ?></th><th style="width: 100px">Grado:</th><th style="width: 100px"><?php echo $nombre ?></th><th style="width: 100px">Curso:</th><th style="width: 100px"><?php echo $numero ?></th> 
     </table>
 			<h4 style="float: left;"> Calificaciones</h4>
          <h4 style="text-align: center;"> <?php 
          echo  '<strong>'. " Etudiantes en total:</strong> ". $cont; ?></h4> 
        <table  class="table-responsive" id="" style=" border-collapse: collapse;border: 1px solid #ddd;text-align: left;width: 100%"> 
          <thead>
            <tr style="background-color: #00b300;">
             
              <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Id</th>
              <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Nombre completo</th>
             <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Tipo documento</th>
             <th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;">Numero documento</th>
 			<th style="border:  1px solid #ddd ;text-align: left;padding: 5px; text-transform: uppercase;width: 200px">Firma</th>
 

            </tr>
          </thead>
          
          <tbody style="border: solid 1px;">
             <?php $d=0;
             foreach ($consultar_nivel1 as $row) {

               ?>
               <tr>      
  
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $d=$d+1;?></td>
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $row['nombre'].' '.$row['apellido']; ?></td>

<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $row['tipo_documento']; ?></td> 
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"><?php echo $row['numero_documento']; ?></td>  
<td style="color: gray;border:  1px solid #ddd ;text-align: left;padding: 15px; text-transform: uppercase;"> </td> 
              </tr>
              


            <?php 
            }

             ?>

 
          </tbody>
        </table><?php
}
}


?>