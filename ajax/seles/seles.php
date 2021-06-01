<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}

function hora(){
	date_default_timezone_set("America/Bogota");
	$f=date('H:i:s');
	echo  ($f);
}
 
function sacar_el_grado_competencia()
{  
	include '../conexion.php';
	$consultar_nivel="SELECT tecnicas.nombre_tecnica,tecnicas.id_tecnica from tecnicas where inhabilitado=0";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo "<option value=''>Seleccione una tecnica</option>";
	foreach ($registro as $value  ){	?>
		
	<option value="<?php echo $value['id_tecnica'] ?>"><?php echo $value['nombre_tecnica'] ?></option>
	<?php
	}
}
function sede41()
{  
	include '../conexion.php';
echo	$consultar_nivel="SELECT sede.NOMBRE as sede,jornada.NOMBRE as jornada ,jornada_sede.ID_JS from grado_sede,jornada_sede,jornada,sede WHERE sede.ID_SEDE=jornada_sede.ID_SEDE and jornada_sede.ID_JS=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and jornada_sede.inhabilitar=0 and sede.inhabilitar=0  and grado_sede.id_grado= ".$_POST['id_grado'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo "<option value=''>Seleccione una sede</option>";
	foreach ($registro as $value  ){	?>
		
	<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?></option>
	<?php
	}
}
function grado41()
{  
	include '../conexion.php';
	$consultar_nivel="SELECT grado.nombre,curso.numero,grado.id_grado,curso.id_curso from grado_sede,grado,curso WHERE grado_sede.id_grado=grado.id_grado and grado_sede.id_curso=curso.id_curso  and grado_sede.id_jornada_sede='".$_POST['id_js']."'   and grado_sede.id_grado=".$_POST['id_grado'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo "<option value=''>Seleccione una curso</option>";
	foreach ($registro as $value  ){	?>
		
	<option value="<?php echo $value['id_curso'].' '.$value['id_grado'] ?>">Grado: <?php echo $value['nombre'] ?> - Curso: <?php echo $value['numero'] ?></option>
	<?php
	}
}

function estado()
{  
	include '../conexion.php';
	$por=$_POST['id'];
	$Epor=explode(',',$por);
	$id=$Epor[0];
	$consultar_nivel="SELECT  estado.estadonombre from  estado   WHERE  estado.ubicacionpaisid='$id'";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo "<option value=''>Seleccione una departamento</option>";
	foreach ($registro as $value  ){	?>
		
	<option value="<?php echo $value['estadonombre'] ?>"><?php echo $value['estadonombre'] ?></option>
	<?php
	}
}
 
function sacar_el_grado_competencia2()
{  
	include '../conexion.php';
	$consultar_nivel="SELECT tecnica_grado_sede.id_tecnica_grado_sede,r.grado,r.curso,r.sede,r.jornada from tecnica_grado_sede,(SELECT sede.NOMBRE as sede ,jornada.NOMBRE as jornada, grado.numero as grado,curso.numero as curso , grado_sede.id from curso,grado_sede ,grado,sede,jornada_sede,jornada WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA AND jornada_sede.ID_JS=grado_sede.id_jornada_sede and grado.id_grado=grado_sede.id_grado AND curso.id_curso=grado_sede.id_curso)as r WHERE r.id=tecnica_grado_sede.id_grado_sede and tecnica_grado_sede.id_tecnica=".$_POST['id']." order by r.sede";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo "
		<option>Seleccione un curso</option>";
	foreach ($registro as $value  ){	?>
	<option value="<?php echo $value['id_tecnica_grado_sede'] .' '. $value['grado'] ?>">sede: <?php echo $value['sede'] ?> - jornada: <?php echo $value['jornada'] ?> - grado:<?php echo $value['grado'] ?> - curso:<?php echo $value['curso'] ?></option> 
	<?php
	}
} 
function competencias()
{  
	include '../conexion.php';
	$partes=explode(' ', $_POST['id']);
	$id=$partes['0'];
	echo$consultar_nivel="SELECT competencias.codigo,competencias.nombre from competencias  group by nombre ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo "
		<option>Seleccione una competencia</option>";
	foreach ($registro as $value  ){	?>
	<option value="<?php echo $value['codigo'] ?>">competencia: <?php echo $value['nombre'] ?> </option> 
	<?php
	}
}








function sacar_el_id_grado()
{  
include '../conexion.php';
$consultar_nivel="SELECT id_grado from grado_sede where  grado_sede.id='".$_POST['id']."'  ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();
foreach ($registro as $key  ) {
	$grado=$key['id_grado']; 
}
echo $grado;

 

}

function sacar_el_id_curso()
{  
include '../conexion.php';
$consultar_nivel="SELECT id_curso from grado_sede where  grado_sede.id='".$_POST['id']."'  ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();
foreach ($registro as $key  ) {
	$curso=$key['id_curso']; 
}
echo $curso;

 

}

//actividad
function select2_sedes_cronograma()
{  
include '../conexion.php';
$consultar_nivel="SELECT * from sede   ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();


echo '<option value="todas">Todas las sedes</option>';
foreach ($registro as   $value) {
	?>
	<option value="<?php echo $value['NOMBRE'] ?>"><?php echo $value['NOMBRE'] ?></option>
	<?php
}

}
function select2_jornada_sede()
{  
 if(isset($_POST['id'])){
 	$t=$_POST['id'];
 	if ($t==''  ) {
 		$id=$t;
 	}else{
 		$id='WHERE  sede.NOMBRE="'.$_POST['id'].'"';
 	}
	}else{
			$id='';
	}
	if ($t=='todas') {
		
			$id='';
	}
	include '../conexion.php'; 
    $consultar_nivel="SELECT t.NOMBRE from jornada_sede,(SELECT jornada.ID_JORNADA , jornada.NOMBRE from jornada)as t WHERE jornada_sede.ID_JORNADA=t.ID_JORNADA and jornada_sede.ID_SEDE in(SELECT sede.ID_SEDE FROM sede  $id)";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
		$consultar_nivel12s=$consultar_nivel1->rowCount();
		if ($consultar_nivel12s>0) {
   		 
		echo '<option value="todas">Todas las sedes</option>';
		foreach ($registro as   $value) {
			?>
			<option value="<?php echo $value['NOMBRE'] ?>"><?php echo $value['NOMBRE'] ?></option>
			<?php
		}	
		}else{

		}


}

function seleccion(){
	 if(isset($_POST['ida'])){
 	$t=$_POST['ida'];
  
 		$id='WHERE  cronograma_de_actividades.id="'.$_POST['ida'].'"';
 	}
	  

	include '../conexion.php'; 
    $consultar_nivel="SELECT cronograma_de_actividades.id,cronograma_de_actividades.jornada FROM cronograma_de_actividades  $id";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
		$consultar_nivel12s=$consultar_nivel1->rowCount();
		if ($consultar_nivel12s>0) {
   		 
		foreach ($registro as   $value) {
			?>
			<option value="<?php echo $value['jornada'] ?>"><?php echo $value['jornada'] ?></option>
			<?php
		}	
		}else{

		}
}

function seleccion11(){
	 
 if(isset($_POST['ida'])){
 	$t=$_POST['ida'];
 	if ($t==''  ) {
 		$id=$t;
 	}else{
 		$id='WHERE  sede.NOMBRE="'.$_POST['ida'].'"';
 	}
	}else{
			$id='';
	}
	if ($t=='todas') {
		
			$id='';
	}
	include '../conexion.php'; 
    $consultar_nivel="SELECT t.NOMBRE from jornada_sede,(SELECT jornada.ID_JORNADA , jornada.NOMBRE from jornada)as t WHERE jornada_sede.ID_JORNADA=t.ID_JORNADA and jornada_sede.ID_SEDE in(SELECT sede.ID_SEDE FROM sede  $id)";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
		$consultar_nivel12s=$consultar_nivel1->rowCount();
		if ($consultar_nivel12s>0) {
   		
		echo '<option value="">selecion por jornada</option>';
		echo '<option value="todas">Todas las sedes</option>';
		foreach ($registro as   $value) {
			?>
			<option value="<?php echo $value['NOMBRE'] ?>"><?php echo $value['NOMBRE'] ?></option>
			<?php
		}	
		}else{

		}

}




function seleccion1(){
	 if(isset($_POST['ida'])){
 	$t=$_POST['ida'];
  
 		$id='WHERE  cronograma_de_actividades.id="'.$_POST['ida'].'"';
 	}
	  

	include '../conexion.php'; 
    $consultar_nivel="SELECT cronograma_de_actividades.id,cronograma_de_actividades.sede FROM cronograma_de_actividades  $id";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
		$consultar_nivel12s=$consultar_nivel1->rowCount();
			$n='';
		if ($consultar_nivel12s>0) {
   		
		foreach ($registro as   $value) {
			$n= $value['sede'];
			?>
			<option value="<?php echo $value['sede'] ?>"><?php echo $value['sede'] ?></option>
			<?php
		}	
		}else{

		}
		?>
			<option value="">Seleccione otra sede</option>
			<?php
		    $consultar_nivel="SELECT sede.NOMBRE,sede.ID_SEDE FROM sede   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
		$consultar_nivel12s=$consultar_nivel1->rowCount();
		if ($consultar_nivel12s>0) {
   		 
		foreach ($registro as   $value) {
			?>
			<option value="<?php echo $value['NOMBRE'] ?>"><?php echo $value['NOMBRE'] ?></option>
			<?php
		}	
		}else{

		}
} 
//fin de la paginas de cronogramas calendario

/////////////logros





function materia(){

	if(isset($_POST['id'])){
		$id=$_POST['id'];

	}


	include '../conexion.php'; 
	$consultar_nivel="SELECT area.area, area.nombre as aaa,area.id_area,area.codigo, grado.id_grado,grado.nombre FROM grado_sede INNER JOIN grado on grado_sede.id_grado=grado.id_grado INNER JOIN(SELECT area.area, area.nombre,area.id_area,area.codigo,are_grado_sede.id_grado_sede FROM are_grado_sede,area WHERE are_grado_sede.id_area=area.id_area)as area on area.id_grado_sede=grado_sede.id WHERE grado.id_grado='$id' GROUP by area.id_area DESC ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo '<option value="todas">Seleccione un area</option>';
	foreach ($registro as   $value) {

		if ($value['codigo']!='01' && $value['area']=='1') {
          # code...
		}else{ 
			?>
			<option value="<?php echo $value['id_area'] ?>"><?php echo $value['aaa'] ?></option>
			<?php
		}
	}

}


function grados(){



	include '../conexion.php'; 
	$consultar_nivel="SELECT * from grado_sede,grado WHERE grado_sede.inhabilitar=0 and   grado.id_grado=grado_sede.id_grado GROUP by grado.id_grado";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	echo '<option value="todas">Seleccione un grado</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_grado'] ?>"><?php echo $value['nombre'] ?></option>
		<?php
	}

}



function logro(){

	include '../conexion.php'; 
	if(isset($_POST['grado'])){
		$grado=$_POST['grado'];

	}
	if(isset($_POST['materia'])){
		$materia=$_POST['materia'];

	}
	if(isset($_POST['toa'])){
		$toa=$_POST['toa'];

	}
 
	if ($toa==1) {
		$var='Logro';
	}
 
	if ($toa==2) {
		$var='Recomendacion';
	}
 
	if ($toa==3) {
		$var='Dificultades';
	}
 


	if(isset($_POST['dato'])){
		$d=$_POST['dato'];
	}else{
		$d='';
	}
	if(isset($_POST['i'])){
		$paginaActual = $_POST['i'];
	}else{
		$paginaActual=1;
	}
//logro.NOMBRE like('%$d%')

	   $consultar_nivel="  SELECT logro.logro,logro.id_logro, grado.nombre,area.nombre ,logro.tipo FROM logro,grado,area WHERE area.id_area=logro.id_area and logro.id_grado=grado.id_grado and logro.tipo='$toa' and logro.logro like('%$d%') and logro.id_area=$materia and logro.id_grado=$grado      ORDER by logro.id_logro DESC   ";
	$s=$consultar_nivel;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());

	$nroProductos=$consultar_nivel1->rowCount();


	if(isset($_POST['mySelect'])){
		$nroLotes = $_POST['mySelect'];
	}else{
		$nroLotes = 5;
	}

	$nroPaginas = ceil($nroProductos/$nroLotes);
	$lista = '';
	$tabla = '';

	if($paginaActual > 1){
		$fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
	}

	for($i=1; $i<=$nroPaginas; $i++){
		if($i == $paginaActual){
			$lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
		}else{
			$lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
		}
	}
	if($paginaActual < $nroPaginas){
		$lista = $lista.'<li>
		<button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
		$o=0;
	}else{
		$o=1;
	}

	if($paginaActual <= 1){
		$limit = 0;
	}else{
		$limit = $nroLotes*($paginaActual-1);
	}


	  $consultar_nivel="  SELECT logro.logro,logro.id_logro, grado.nombre,area.nombre ,logro.tipo FROM logro,grado,area WHERE area.id_area=logro.id_area and logro.id_grado=grado.id_grado and logro.tipo='$toa' and logro.logro like('%$d%') and logro.id_area=$materia and logro.id_grado=$grado      ORDER by logro.id_logro DESC   LIMIT $limit, $nroLotes ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	$registrow=$consultar_nivel1->rowCount();
	?>  
<form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
		<div class="box-body no-padding">

			<div class="mailbox-controls">

				<!-- Check all button -->
				<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
				</button><button type="button" class="btn btn-default btn-sm" onclick=" myFunction(1)"> <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGcgaWQ9Imxvb3BfeDVGX2FsdDIiPgoJCTxnPgoJCQk8cGF0aCBkPSJNMTkuOTQ1LDIybDYuMDA4LThMMzIsMjJoLTR2MmMwLDMuMzA5LTIuNjkxLDYtNiw2SDEwYy0zLjMwOSwwLTYtMi42OTEtNi02di0yaDR2MiAgICAgYzAsMS4xMDIsMC44OTgsMiwyLDJoMTJjMS4xMDIsMCwyLTAuODk4LDItMnYtMkgxOS45NDV6IiBmaWxsPSIjMDAwMDAwIi8+CgkJCTxwYXRoIGQ9Ik0xMi4wNTUsMTBsLTYuMDA4LDhMMCwxMGg0VjhjMC0zLjMwOSwyLjY5MS02LDYtNmgxMmMzLjMwOSwwLDYsMi42OTEsNiw2djJoLTRWOCAgICAgYzAtMS4xMDItMC44OTgtMi0yLTJIMTBDOC44OTgsNiw4LDYuODk4LDgsOHYySDEyLjA1NXoiIGZpbGw9IiMwMDAwMDAiLz4KCQk8L2c+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" style="width: 14px;height: 14px"></button> <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" onclick="document.getElementById('tipo').value=<?php echo $toa ?>;
				document.getElementById('logro').placeholder = '<?php echo $var ?>..';"> Nuevo</button
				<div class="btn-group"> 

					 
					<?php if($paginaActual > 1){
						echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

						<?php
						if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
					</div>
					<!-- /.btn-group --> 
					<div class="pull-right">

						<?php 

						$aaa=$registrow+0;
						$aa=$paginaActual+0;
						$g=$aa *$aaa;
						if ($o==0) {
							echo $g .'-'.$paginaActual.'/'. $nroProductos ;
						}else{
							echo $nroProductos;

							echo   '-'.$paginaActual.'/'. $nroProductos ;
						}





						?>
						<div class="btn-group"> 

							<?php if($paginaActual > 1){
								echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

								<?php
								if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

							</div>
							<!-- /.btn-group -->
						</div>
						<!-- /.pull-right -->
					</div>

					<div class="table-responsive " style="

					text-align: justify; /* For Edge */
					-moz-text-align-last: left; /* For Firefox prior 58.0 */
					text-align-last: left; ">

					 <br><table class="table table-striped  mailbox-messages">
					<tr><th width="15"># </th> 
						<th width="15">Id </th> 
 
					<th width=""><?php echo $var ?></th>  
					<th width="30">Editar</th>
					<th width="30">Eliminar</th>

					</tr><?php
					foreach ($registro as $registro2) { ?>


						<tr id="fila<?php echo $registro2['id_logro']?>">

						<td>

						<input class="sss" type="checkbox" name="ids[]" id="ids" value="<?php echo $registro2['id_logro']?>"></td>  
								<td><?php echo $registro2['id_logro']?>	</td>
						<td id="uiu<?php echo $registro2['id_logro']; ?>" contenteditable="false" 
							onblur='document.getElementById("uiu<?php echo $registro2['id_logro']; ?>").contentEditable = false; 

							  var w="uiu<?php echo $registro2['id_logro']; ?>"; 
							  var ides=<?php echo $registro2['id_logro'] ?>;
							  var n="logro";
							  var u = $("#uiu<?php echo $registro2['id_logro']; ?>").text(); 
							  var identificador="<?php echo $registro2['logro']?>";
							  if (identificador==u) {
							  	return;
							  }else{ 
							  cambiar(u,ides,n,w); } '><?php echo $registro2['logro']?></td>  
						 




						  
					 
						<td><a  data-title="Actualizar <?php echo $var ?>" onclick='document.getElementById("uiu<?php echo $registro2['id_logro']; ?>").contentEditable = true; document.getElementById("uiu<?php echo $registro2['id_logro']; ?>").focus();' >
							<img  style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
						</a></td>		
 
						<td>

							<a   data-title="eliminar <?php echo $var ?>" data-toggle="modal" data-target="#mymodal<?php echo ($registro2['id_logro']) ?>"> <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo="></a>              
							<div class="modal fade" id="mymodal<?php echo ($registro2['id_logro']) ?>" data-keyboard="true" data-backdrop="false"  backdrop="false">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Confirmación</h4>
										</div>
										<div class="modal-body">
											<p> estás seguro de eliminar la sede   ?</p>

										</div>
										<div class="modal-footer">    
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
											<button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
											id="btn"   onclick="var io= <?php echo $registro2['id_logro'] ?>; myFunction3i(io)">Aceptar</button> 

										</div>
									</div>
								</div>
							</div>

						</td>








						</tr><?php  
					} ;?>
</table>
 
					<div class="modal fade" id="may" data-keyboard="true" data-backdrop="false" backdrop="false">
						<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Confirmación</h4>
										</div>
										<div class="modal-body">
											<p> estás seguro de eliminar la sede   ?</p>

										</div>
										<div class="modal-footer">    
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
										 <input type="button" data-dismiss="modal" class="btn btn-primary"  name="fds" value="Aceptar" onclick="sasa()">



										</div>
									</div>
								</div>
						</div>
</div></div>  
					</form>
 
 

					<?php

					echo '<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
					</button> <ul class="pagination" id="pagination">
					<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button>'.$lista.'</ul>






					' ;
					?>
					<script type="text/javascript"> 

 
 

  

						$(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
    	checkboxClass: 'icheckbox_flat-blue',
    	radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
    	var clicks = $(this).data('clicks');
    	if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    }
    $(this).data("clicks", !clicks);
});

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
    	e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
      	$this.toggleClass("glyphicon-star");
      	$this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
      	$this.toggleClass("fa-star");
      	$this.toggleClass("fa-star-o");
      }
  });
});
</script>
<?php

}



////////fin de los logros


//////sedulas de los acudientes


//////fin de acudoientes
function consultar_cedula_acudiente(){ 
	
	include '../conexion.php'; 
   echo $sql="SELECT num_documento,id_acudiente from acudiente ";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $sql2=$sql1->fetchAll();
    ?>
    <option value="">Seleccione</option>
    <?php foreach ($sql2 as $key) { ?>
    	<option value="<?php echo($key['id_acudiente']) ?>"><?php echo($key['num_documento']) ?></option><?php
    }  
}

/////select jefes de areas


function select_jefes_area(){
	
}



////// fin del select jefes de areas



/////////select de docentes

function sele_docente(){
	include '../conexion.php'; 
	$consultar_nivel="SELECT foto,id_docente,nombre,apellido from docente WHERE docente.inhabilitado not in('1')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="docente" class=" form-control my-select"  onchange="myFunction()"    >
	<option value="todas">Seleccione un docente</option>';
	foreach ($registro as   $value) {
		?> 
		  
 <option data-img-src="<?php echo $value['foto'] ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
		<?php
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
<script type="text/javascript">
 
 


      
	function myFunction(){

    var id=document.getElementById("docente").value;
		 $.ajax({   
        type: "post", 
        data:{id},
        url:"../../../ajax/rector/docentes.php?action=hoja_vida", 
        dataType:"text", 

        success:function(data){  
        	$("#koooo").show();
 $("#oop").show();
          $('#koooo').html(data); 


        }  


      }); 
    }
</script>
<?php
}
function calendario_docente(){
	$idjs=$_POST['idjs'];
	include '../conexion.php'; 
	$consultar_nivel="SELECT  docente.id_docente,docente.nombre,docente.apellido,docente.genero,docente.foto FROM docente,grado_sede,are_grado_sede WHERE  grado_sede.id_jornada_sede=$idjs   and  grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id__docente=docente.id_docente";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="docente" class=" form-control my-select"  onchange="myFunction()"    >
	<option value="todas">Seleccione un docente</option>';
	foreach ($registro as   $value) {
		?> 
		  
 <option data-img-src="<?php echo $value['foto'] ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
		<?php
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>'; 
}
function buscar_jor_sede(){
	include '../conexion.php';
	$id=$_POST['id__docente']; 
	echo $consultar_nivel="SELECT  jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE AS jornada from jornada,sede,jornada_sede,grado_sede,are_grado_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and grado_sede.id=are_grado_sede.id_grado_sede AND are_grado_sede.id__docente='$id' and jornada_sede.inhabilitar=0   and  sede.inhabilitar=0   GROUP by jornada_sede.ID_JS";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	foreach ($consultar_nivel1 as  $value) {
	 
	?>
		<option value="<?php echo $value['ID_JS']; ?>">Sede: <?php echo $value['sede']; ?> - <?php echo $value['jornada']; ?></option>
	<?php
	}
}
function sele_docente2(){
	include '../conexion.php'; 
	$consultar_nivel="SELECT id_docente,nombre,foto ,apellido,genero from docente WHERE docente.inhabilitado not in('1')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="docente" name="docente" class=" form-control my-select"  onchange="myFunction()" required    >
	<option value="">Seleccione un docente</option>';
	foreach ($registro as   $value) {
		$foto=$value['foto'];
		if ($value['foto']=='' && $value['genero']==1) {
			$foto='../../../logos/femenino.png';
		}if ($value['foto']=='' && $value['genero']==0){
			$foto='../../../logos/masculino.png';
		}
		?> 
		  
 <option data-img-src="<?php echo $foto ?>" value="<?php echo $value['id_docente'] ?>"> <?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
		<?php
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}
function sele_docente22(){
	include '../conexion.php'; 
	$consultar_nivel="SELECT id_docente,nombre,foto ,apellido from docente WHERE docente.inhabilitado not in('1')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="docente" class=" form-control my-select"  onchange="myFunction()" required="true"   >
	<option value="">Seleccione un docente</option>';
	foreach ($registro as   $value) {
		?> 
		  
 <option data-img-src="<?php echo $value['foto'] ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
		<?php
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}

function sele_docente3(){
	include '../conexion.php'; 
	$consultar_nivel="SELECT * from docente WHERE docente.inhabilitado not in('1')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="id_per" name="id_per[]" class=" form-control my-select" data-placeholder="Seleccione un docente"  multiple="multiple">  
	<option value="00.2">todos los docente</option>';
	foreach ($registro as   $value) {
		if ($value['foto']=='' and $value['genero']==1) {
			$foto='../../../logos/femenino.png';  
		}
		if ($value['foto']=='' and $value['genero']==0) {
			$foto='../../../logos/masculino.png';  
		}if ($value['foto']!='') {
			$foto=$value['foto']; 
		}
		?> 
		  
 <option data-img-src="<?php echo $foto ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido']  ?></option>  
		<?php
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}


function sele_docente4(){
	include '../conexion.php'; 
	$ano=date('Y');
	$consultar_nivel="SELECT alumnos.nombre,alumnos.apellido,alumnos.genero,alumnos.foto,alumnos.id_alumnos,informeacademico.fecha_desercion,informeacademico.fecha_retiro from alumnos, informeacademico WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.ano='$ano'   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="id_per" name="id_per[]" class=" form-control my-select" data-placeholder="Seleccione los alumnos"  multiple="multiple">  
	<option value="00.2">todos los alumnos</option>';
	foreach ($registro as   $value) {
		if ($value['fecha_retiro']=='0000-00-00' && $value['fecha_desercion']=='0000-00-00' ) {
			# code...
		
			if ($value['foto']=='' and $value['genero']==1) {
				$foto='../../../logos/niña.jpg';  
			}
			if ($value['foto']=='' and $value['genero']==0) {
				$foto='../../../logos/niño.png';  
			}if ($value['foto']!='') {
				$foto=$value['foto']; 
			}
			?> 
			  
			<option data-img-src="<?php echo $foto ?>" value="<?php echo $value['id_alumnos'] ?>"><?php echo $value['nombre'].' '.$value['apellido']  ?></option>  
				<?php
		}
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}

function alumnos_por_curso(){
	include '../conexion.php'; 
	$ano=date('Y');
	 if(isset($_POST['ID_JS'])){
 		$ID_JS=" and informeacademico.id_jornada_sede='".$_POST['ID_JS']."'";
 	 
 	}else{
 	 	$ID_JS='';
 	}
	 if(isset($_POST['id_curso'])){
	 	if($_POST['id_curso']!=''){ 
 		$id_curso=" and informeacademico.id_curso='".$_POST['id_curso']."'";
 	 }else{
 	 	$id_curso='';
 	 }
 	}else{
 	 	$id_curso='';
 	}
	 if(isset($_POST['id_grado'])){
	 	if($_POST['id_grado']!=''){ 
 		$id_grado=" and informeacademico.id_grado='".$_POST['id_grado']."'";
 	 }else{
 	 	$id_grado="";
 	 }
 	}else{
 	 	$id_grado='';
 	}
	     $consultar_nivel="SELECT alumnos.id_alumnos, alumnos.nombre,alumnos.apellido,alumnos.genero,alumnos.foto,informeacademico.fecha_retiro,informeacademico.fecha_desercion from alumnos,informeacademico WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.ano='$ano' $id_grado $id_curso $ID_JS ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	$contador=$consultar_nivel1->rowCount();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="id_per" name="id_per[]" class=" form-control my-select" data-placeholder="Seleccione los alumnos"  multiple="multiple"> ';
	if ($contador>0) {
		echo ' 
	<option value="00.2">todos los alumnos</option>';
	}
	foreach ($registro as   $value) {
		if ($value['fecha_retiro']=='0000-00-00' && $value['fecha_desercion']=='0000-00-00' ) {
			# code...
		
			if ($value['foto']=='' and $value['genero']==1) {
				$foto='../../../logos/niña.jpg';  
			}
			if ($value['foto']=='' and $value['genero']==0) {
				$foto='../../../logos/niño.png';  
			}if ($value['foto']!='') {
				$foto=$value['foto']; 
			}
			?> 
			  
			<option data-img-src="<?php echo $foto ?>" value="<?php echo $value['id_alumnos'] ?>"><?php echo $value['nombre'].' '.$value['apellido']  ?></option>  
				<?php
		}
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}
//////// fin del select de docentes


function docente_por_curso(){
	include '../conexion.php'; 
	$ano=date('Y');
	 if(isset($_POST['ID_JS'])){
 		$ID_JS="  grado_sede.id_jornada_sede='".$_POST['ID_JS']."' and";
 	 
 	}else{
 	 	$ID_JS='';
 	}
	 if(isset($_POST['id_curso'])){
	 	if($_POST['id_curso']!=''){ 
 		$id_curso=" grado_sede.id_curso='".$_POST['id_curso']."'  and ";
 	 }else{
 	 	$id_curso='';
 	 }
 	}else{
 	 	$id_curso='';
 	}
	 if(isset($_POST['id_grado'])){
	 	if($_POST['id_grado']!=''){ 
 		$id_grado=" grado_sede.id_grado='".$_POST['id_grado']."'  and ";
 	 }else{
 	 	$id_grado="";
 	 }
 	}else{
 	 	$id_grado='';
 	}
	     $consultar_nivel="SELECT docente.nombre,docente.apellido,docente.id_docente,docente.genero,docente.foto FROM docente,are_grado_sede,grado_sede  WHERE   $id_grado $id_curso $ID_JS       grado_sede.id=are_grado_sede.id_grado_sede   and are_grado_sede.id__docente=docente.id_docente and docente.inhabilitado NOT in('1')  group by docente.id_docente";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
	$contador=$consultar_nivel1->rowCount();

	echo '
 	<link rel="stylesheet" href="../../../css/chosen.css">
  	<link rel="stylesheet" href="../../../css/ImageSelect.css">
	<script src="../../../js/chosen.jquery.js"></script>
	<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="id_per" name="id_per[]" class=" form-control my-select" data-placeholder="Seleccione los docentes"  multiple="multiple"  > ';
	if ($contador>0) {
		echo ' 
		<option value="00.2">todos los alumnos</option>';
	}
	foreach ($registro as   $value) {
		 
		
			if ($value['foto']=='' and $value['genero']==1) {
				$foto='../../../logos/femenino.png';  
			}
			if ($value['foto']=='' and $value['genero']==0) {
				$foto='../../../logos/masculino.png';  
			}if ($value['foto']!='') {
				$foto=$value['foto']; 
			}
			?> 
			  
			<option data-img-src="<?php echo $foto ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido']  ?></option>  
				<?php
		 
	}echo '</select><script>
	    
 
 $(".my-select").chosen()({
 	     placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}


//////////comienza los seles de nueva tecnica
function sele_sede(){
	include '../conexion.php';
	echo$consultar_nivel="SELECT ID_SEDE,NOMBRE from sede where sede.inhabilitar=0   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione una sede</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['ID_SEDE'] ?>"><?php echo $value['NOMBRE'] ?></option>
		<?php
	}
}

 


////////// fin de los seles de nueva tecnica


//////////comienza los seles de competencias
function sele_tecnica(){
	include '../conexion.php';
	$consultar_nivel="SELECT * from tecnicas   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione una sede</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_tecnica'] ?>"><?php echo $value['abrevido'] ?></option>
		<?php
	}
}

 


////////// fin de los seles de competencias





//////select de jornada_sede para registrar grados//


function nuevo_grado(){
	include '../conexion.php';
	echo $consultar_nivel="SELECT jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE as jornada FROM jornada,sede ,jornada_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar=0 and  sede.inhabilitar=0 ORDER BY sede.NOMBRE";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione una sede  </option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php
	}
}
function nuevo_gradoxt(){
	include '../conexion.php';
	echo $consultar_nivel="SELECT jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE as jornada FROM jornada,sede ,jornada_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar=0 and  sede.inhabilitar=0 ORDER BY sede.NOMBRE";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> todas las sedes </option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php
	}
}
//////select de jornada_sede para registrar grados//

///sacar  curso por medio de la jornada y el curso

function sacar_curso(){
	include '../conexion.php';
	$idjs=$_POST['idjs'];
	$consultar_nivel="SELECT grado_sede.id,grado.numero,curso.numero as curso,grado.nombre as grado FROM grado_sede INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado WHERE grado_sede.id_jornada_sede=$idjs and grado_sede.inhabilitar=0 ORDER BY grado.numero
" ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione curso</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
	}
}

function sacar_curso_observador_rector(){
	include '../conexion.php';
	$idjs=$_POST['id_js'];
	$consultar_nivel="SELECT curso.id_curso,grado.id_grado,grado_sede.id, curso.numero as curso,grado.nombre as grado FROM grado_sede INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado WHERE grado_sede.id_jornada_sede=$idjs and grado_sede.inhabilitar=0 ORDER BY grado.numero
" ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione curso</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_grado'].' '. $value['id_curso'].' '. $value['id'].' ,'.$value['grado'].'-'.$value['curso'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
	}
}
function sacar_curso1(){
	include '../conexion.php';
	$idjs=$_POST['idjs'];
	$consultar_nivel="SELECT grado_sede.id_grado,grado_sede.id_curso,grado.numero,curso.numero as curso,grado.nombre as grado FROM grado_sede INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado WHERE grado_sede.id_jornada_sede=$idjs and grado_sede.inhabilitar=0 ORDER BY grado.numero" ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione curso</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_curso'].' '. $value['id_grado'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
	}
}
function sacar_curso_max(){
	include '../conexion.php';
	$idjs=$_POST['idjs'];
	echo$consultar_nivel="SELECT grado_sede.id_grado,grado_sede.id_curso,grado.numero,curso.numero as curso,grado.nombre as grado FROM grado_sede INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado WHERE grado_sede.id_jornada_sede=$idjs and grado_sede.inhabilitar=0 ORDER BY grado.numero" ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> Seleccione todos</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_curso'].' '. $value['id_grado'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
	}
}
 
function sacar_curso133(){
	include '../conexion.php';
	$idjs=$_POST['idjs'];
	echo$consultar_nivel="SELECT grado_sede.id_grado,grado_sede.id_curso,grado.numero,curso.numero as curso,grado.nombre as grado FROM grado_sede   INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado  INNER JOIN(SELECT sede.nombre as sede,jornada.NOMBRE as jornada,jornada_sede.ID_JS FROM jornada_sede,sede,jornada WHERE jornada_sede.ID_JS='$idjs' AND jornada.ID_JORNADA=jornada_sede.ID_JORNADA and sede.ID_SEDE=jornada_sede.ID_SEDE )as a WHERE  a.ID_JS=grado_sede.id_jornada_sede and grado_sede.inhabilitar=0 ORDER BY  grado.numero " ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	$contador=$consultar_nivel1->rowCount();
	if ($contador>0) {
		# code...
	echo '<option value=""> seleccione el  curso</option>
	<option value="0">Todo los cursos</option>';
	}
		  
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_curso'].' '. $value['id_grado'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
	}
}
function sacar_curso6(){
	include '../conexion.php';
	$idjs=$_POST['idjs'];
	echo$consultar_nivel="SELECT grado_sede.id_grado,grado_sede.id_curso,grado.numero,curso.numero as curso,grado.nombre as grado FROM grado_sede   INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado  INNER JOIN(SELECT sede.nombre as sede,jornada.NOMBRE as jornada,jornada_sede.ID_JS FROM jornada_sede,sede,jornada WHERE jornada_sede.ID_JS='$idjs' AND jornada.ID_JORNADA=jornada_sede.ID_JORNADA and sede.ID_SEDE=jornada_sede.ID_SEDE )as a WHERE  a.ID_JS=grado_sede.id_jornada_sede and grado_sede.inhabilitar=0 ORDER BY  grado.numero " ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione curso</option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_curso'].' '. $value['id_grado'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
	}
}
 

function sacar_curso_docente22(){
	include '../conexion.php';
	$id_js=$_POST['id_js'];
	$id_doc=$_POST['id'];
	$consultar_nivel="   SELECT grado.id_grado,curso.id_curso,  grado.nombre as grado,curso.numero AS curso, grado_sede.id  from grado,curso,are_grado_sede,grado_sede WHERE grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso AND grado_sede.id=are_grado_sede.id_grado_sede AND grado_sede.id_jornada_sede='$id_js'  AND are_grado_sede.id__docente='$id_doc' GROUP BY  grado_sede.id";
        $sql1=$conexion->prepare($consultar_nivel);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();


 	$js1='';
	foreach ($sql2 as   $value) {
		$id_grado=$value['id_grado'];
		$id_curso=$value['id_curso'];
		$id=$value['id'];
		?>
		<option value="<?php echo $value['id_grado'].' '. $value['id_curso'].' '. $value['id'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
		
		$js  =  ($js1.' '.$id);
		$js1=$id;
	}

	$js=explode(' ', $js);
	session_start(); 

	$consultar_nivewqql="SELECT grado.id_grado,curso.id_curso, grado.nombre as grado,curso.numero AS curso, grado_sede.id from grado,curso,tecnica_grado_sede,competencias,grado_sede WHERE grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso  AND grado_sede.id_jornada_sede='$id_js' AND  grado_sede.id=tecnica_grado_sede.id_grado_sede AND tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede and  competencias.id_docente='$id_doc'  GROUP BY grado_sede.id";
        $sql3=$conexion->prepare($consultar_nivewqql);
        $sql3->execute(array()); 
        $cont=0;
		foreach ($sql3 as   $valuee) { 
			$ty=$cont++;
			if ($js[$ty]!=$valuee['id']) {
				?>
				<option value="<?php echo $valuee['id_grado'].' '. $valuee['id_curso'].' '. $valuee['id'] ?>">Grado: <?php echo $valuee['grado'] ?> - Curso: <?php echo $valuee['curso'] ?>  </option>
				<?php 
			}
				
		}
 
	
}






function sacar_areas_sede_jornada_docente1v(){
	include '../conexion.php';
	$id=$_POST['id'];
	$id_grado_sede=$_POST['id_grado_sede'];
	$porciones = explode(" ", $id_grado_sede);
	$porciones[2];
	 
    
  	session_start();


	$consultar_nivel="SELECT area.nombre,area.id_area,area.area ,area.codigo from are_grado_sede,area WHERE area.id_area=are_grado_sede.id_area and are_grado_sede.id__docente='$id'   and are_grado_sede.id_grado_sede=$porciones[2]	  ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
    

	echo$tecni="SELECT curdate(),  competencias.nombre,competencias.id_periodo,competencias.id_competencias FROM competencias,tecnica_grado_sede,periodo WHERE  competencias.id_docente='$id' and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_periodo=periodo.numero AND  tecnica_grado_sede.id_grado_sede= $porciones[2]    ";

	$tecnologia=$conexion->prepare($tecni);
	$tecnologia->execute(array()); 
		
  
		foreach ($registro as   $value) {
			if($value['area']!=1 or $value['codigo']==01){
			
				?>
				<option value="<?php echo $value['nombre'] .','.$_SESSION['numero'].','.$value['id_area'].','.$value['area'].','.'0';  ?>">  <?php echo $value['nombre'] ?> </option>
				<?php
			}
		} 
		foreach ($tecnologia as   $value) { 
			
				?>
				<option value="<?php echo $value['nombre'].','.$value['id_periodo'].','.$value['id_competencias'].','.'uuu'.','.'1' ?>">  <?php echo $value['nombre'] ?> </option>
				<?php 
		}
	
}


function sacar_curso_docente(){
	session_start();
	include '../conexion.php';
	$id_js=$_POST['id_js'];
	$id_doc=$_POST['id'];
	  
	$consultar_nivel="   SELECT grado.id_grado,curso.id_curso,  grado.nombre as grado,curso.numero AS curso, grado_sede.id  from grado,curso,are_grado_sede,grado_sede WHERE grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso AND grado_sede.id=are_grado_sede.id_grado_sede AND grado_sede.id_jornada_sede='$id_js'  AND are_grado_sede.id__docente='$id_doc' GROUP BY  grado_sede.id";
        $sql1=$conexion->prepare($consultar_nivel);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();


 	$js='';

	foreach ($sql2 as   $value) {
		$id_grado=$value['id_grado'];
		$id_curso=$value['id_curso'];
		 
		?>
		<option value="<?php echo $value['id_grado'].' '. $value['id_curso'].' '. $value['id'].' ,'.$value['grado'].'-'.$value['curso'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
		

		$js .=  (",'". $value['id']."'");
	 
	}
 		 
	$not=substr($js, 1);
	$no='';
	if ($not!='') {
		$no=' grado_sede.id not in('.$not.') and ';
	}
	$consultar_nivewqql="SELECT grado.id_grado,curso.id_curso, grado.nombre as grado,curso.numero AS curso, grado_sede.id from grado,curso,tecnica_grado_sede,competencias,grado_sede WHERE $no  grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso  AND grado_sede.id_jornada_sede='$id_js' AND  grado_sede.id=tecnica_grado_sede.id_grado_sede AND tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede and  competencias.id_docente='$id_doc' and competencias.id_periodo='".$_SESSION['numero']."' GROUP BY grado_sede.id";
    $sql3=$conexion->prepare($consultar_nivewqql);
    $sql3->execute(array()); 
    $cont=0;
	foreach ($sql3 as   $valuee) { 
	 
		?>
		<option value="<?php echo $valuee['id_grado'].' '. $valuee['id_curso'].' '. $valuee['id'] ?>">Grado: <?php echo $valuee['grado'] ?> - Curso: <?php echo $valuee['curso'] ?>  </option>
		<?php 	 
	}	
}

function sacar_curso_docente2(){
	include '../conexion.php';
	$id_js=$_POST['id_js'];
	$id=$_POST['id'];
	$consultar_nivel="   SELECT grado.id_grado,curso.id_curso,  grado.nombre as grado,curso.numero AS curso, grado_sede.id  from grado,curso,are_grado_sede,grado_sede WHERE grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso AND grado_sede.id=are_grado_sede.id_grado_sede AND grado_sede.id_jornada_sede='$id_js'  AND are_grado_sede.id__docente='$id' GROUP BY  grado_sede.id";
        $sql1=$conexion->prepare($consultar_nivel);
        $sql1->execute(array());
        $sql2=$sql1->fetchAll();


 
	foreach ($sql2 as   $value) {
		$id_grado=$value['id_grado'];
		$id_curso=$value['id_curso'];
		$id=$value['id'];
		?>
		<option value="<?php echo $value['id_grado'].' '. $value['id_curso'].' '. $value['id'] ?>">Grado: <?php echo $value['grado'] ?> - Curso: <?php echo $value['curso'] ?> </option>
		<?php
		 
	}
 
	
}
//fin



///sacar  curso por medio de la jornada y la sede para hallar las areas

function sacar_sede_jornada(){
	include '../conexion.php';
	$consultar_nivel="SELECT jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE as jornada FROM jornada_sede ,jornada,sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar=0 ORDER BY sede.NOMBRE";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione una sede  </option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php
	}
}
function sacar_sede_jornadas(){
	include '../conexion.php';
	echo$consultar_nivel="SELECT jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE as jornada FROM jornada_sede ,jornada,sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar=0 ORDER BY sede.NOMBRE";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value="-1"> todas las sedes y las jornadas  </option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php
	}
}
function sacar_sede_jornadax(){
	include '../conexion.php';
	echo$consultar_nivel="SELECT jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE as jornada FROM jornada_sede ,jornada,sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar=0 ORDER BY sede.NOMBRE";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> todas las sedes y las jornadas  </option>';
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php
	}
}







function curso_mensaje(){
	include '../conexion.php';
	$jorna=$_POST['jorna'];
	$id=$_POST['id'];

	

	
	$consultar_nivel="SELECT grado_sede.id,grado_sede.id_curso,grado_sede.id_grado,grado.nombre ,curso.numero from curso,grado_sede,grado ,tecnica_grado_sede,competencias WHERE grado.id_grado=grado_sede.id_grado and grado_sede.id_curso=curso.id_curso and grado_sede.id_jornada_sede='$jorna' and grado_sede.id=tecnica_grado_sede.id_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede AND competencias.id_docente='$id' GROUP BY grado_sede.id";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

 
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_curso'].','.$value['id_grado'] ?>"><?php echo $value['nombre'] ?> - <?php echo $value['numero'] ?> </option>
		<?php
		$var=' and grado_sede.id not in("'.$value['id'].'")  ';
	}

	
	$consultar_nivel="SELECT grado_sede.id_curso,grado_sede.id_grado,grado.nombre ,curso.numero from curso,grado_sede,grado ,are_grado_sede WHERE grado.id_grado=grado_sede.id_grado and grado_sede.id_curso=curso.id_curso and grado_sede.id_jornada_sede='$jorna'  and are_grado_sede.id_grado_sede=grado_sede.id and are_grado_sede.id__docente='$id' $var GROUP BY grado_sede.id";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

 
	foreach ($registro as   $value) {
		?>
		<option value="<?php echo $value['id_curso'].','.$value['id_grado'] ?>"><?php echo $value['nombre'] ?> - <?php echo $value['numero'] ?> </option>
		<?php
	}
}



function carga_academica_sede(){
	include '../conexion.php';
	$id=$_POST['id'];
	echo$sql="SELECT grado_sede.id, jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE AS jornada from jornada,sede,jornada_sede,grado_sede,competencias,tecnica_grado_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and jornada_sede.inhabilitar=0 and sede.inhabilitar=0 and tecnica_grado_sede.id_grado_sede=grado_sede.id and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_docente=$id GROUP by jornada_sede.ID_JS";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $sql2=$sql1->fetchAll(); 
 
	$var='';
	foreach ($sql2 as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php

		$var.=' and jornada_sede.ID_JS not in ("'. $value['ID_JS'].'")'; 
	}


    echo$sqla="SELECT  jornada_sede.ID_JS ,sede.NOMBRE as sede, jornada.NOMBRE AS jornada from jornada,sede,jornada_sede,grado_sede,are_grado_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE AND jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_JS=grado_sede.id_jornada_sede and grado_sede.id=are_grado_sede.id_grado_sede AND are_grado_sede.id__docente='$id' and jornada_sede.inhabilitar=0   and  sede.inhabilitar=0  $var GROUP by jornada_sede.ID_JS";
    $sqla1=$conexion->prepare($sqla);
    $sqla1->execute(array());
    $sqla2=$sqla1->fetchAll(); 
 
	foreach ($sqla2 as   $value) {
		?>
		<option value="<?php echo $value['ID_JS'] ?>">  Sede: <?php echo $value['sede'] ?> - Jornada: <?php echo $value['jornada'] ?> </option>
		<?php
	}

}
//fin

///una vez sacada la jornada y la sede sacamos las areas

function sacar_areas_sede_jornada(){
	include '../conexion.php';
	$id_js=$_POST['id'];
	 
    
	$consultar_nivel="SELECT d.nombre,d.id_area,d.codigo,d.area,d.id_area_grado_sede,d.id,d.id_grado,d.id_curso,d.titular from (SELECT area.nombre,area.id_area,area.codigo,area.area,are_grado_sede.id_area_grado_sede ,grado_sede.* from grado_sede, are_grado_sede,area WHERE grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id_area=area.id_area and grado_sede.id_jornada_sede=$id_js and grado_sede.inhabilitar=0  GROUP by area.id_area)as d WHERE d.codigo=01 or d.area not in('1') GROUP by d.nombre";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();


	echo '<option value=""> seleccione una asignatura  </option>';
	foreach ($registro as   $value) {
		if($value['area']!=1 || $value['codigo']==01){?>
			<option value="<?php echo $value['nombre'] ?>">  <?php echo $value['nombre'] ?> </option>
			<?php
		}
	}	
}
  
function grado_solito(){
	include '../conexion.php'; 
	session_start();
    
	$consultar_nivel="SELECT w.grado, w.codigo, w.nombre,w.area, w.id_grado, w.id_area,COUNT(*) from (SELECT grado.nombre as grado, area.nombre, area.codigo, area.area, grado.id_grado,area.id_area from area,are_grado_sede,grado_sede,grado WHERE area.id_area=are_grado_sede.id_area and grado_sede.id=are_grado_sede.id_grado_sede and grado_sede.id_grado=grado.id_grado and are_grado_sede.id__docente='".$_SESSION['Id_Doc']."'  )as w WHERE w.codigo='01' or w.area not in('1') GROUP by w.codigo, w.area, w.id_grado, w.id_area HAVING COUNT(*)>1";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo $consultar_nivel1="

SELECT  w.grado,w.id_grado,w.codigo,w.nombre,w.id_periodo,w.id_competencias,COUNT(*) from  (  SELECT   grado.nombre as grado,grado.id_grado,competencias.codigo,competencias.nombre,competencias.id_periodo,competencias.id_competencias FROM 
competencias,tecnica_grado_sede,periodo ,grado_sede,grado WHERE
grado.id_grado=grado_sede.id_grado and grado_sede.id=tecnica_grado_sede.id_grado_sede and competencias.id_docente='".$_SESSION['Id_Doc']."' and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_periodo=periodo.numero AND CURDATE()>=periodo.fecha_inicio and curdate()<=periodo.fecha_fin  ) as w GROUP by w.grado,w.id_grado,w.codigo,w.nombre,w.id_periodo HAVING COUNT(*)>1";
	$consultar_nivel11=$conexion->prepare($consultar_nivel1);
	$consultar_nivel11->execute(array());
	$registro1=$consultar_nivel11->fetchAll();

	


	foreach ($registro as   $value) { ?>

		<option value="<?php echo $value['nombre'].','.$_SESSION['numero'].','.$value['id_grado'].','.$value['id_area'].','.$value['area'].','.'0' ?>">  
			<?php echo $value['grado'].'-'. $value['nombre'] ?> 

		</option> <?php 
	}

	foreach ($registro1 as   $value1) { ?>

		<option value="<?php echo $value1['nombre'].','. $value1['id_periodo'].','.$value1['id_grado'].','.$value1['id_competencias'].','.'g'.','.'1' ?>">  
			<?php echo $value1['grado'].'-'. $value1['nombre'] ?> 

		</option> <?php 
	}
	
}


function sacar_areas_sede_jornada_docente1(){
	include '../conexion.php';
	$id=$_POST['id'];
	$id_grado_sede=$_POST['id_grado_sede']; 
	 
   
  	session_start();
 


	$consultar_nivel="SELECT area.nombre,area.id_area,area.area ,area.codigo from are_grado_sede,area WHERE area.id_area=are_grado_sede.id_area and are_grado_sede.id__docente=$id   and are_grado_sede.id_grado_sede=$id_grado_sede	  ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
    
	$tecni="SELECT   competencias.nombre,competencias.id_periodo,competencias.id_competencias FROM competencias,tecnica_grado_sede,periodo WHERE  competencias.id_docente='$id' and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_periodo=periodo.numero  and tecnica_grado_sede.id_grado_sede= $id_grado_sede    ";
	$tecnologia=$conexion->prepare($tecni);
	$tecnologia->execute(array()); 
		
  	echo "<option value=''>Seleccione una materia</option> ";
		foreach ($registro as   $value) {
			if($value['area']!=1 or $value['codigo']==01){
			
				?>
				<option value="<?php echo $value['nombre'] .','.$_SESSION['numero'].','.$value['id_area'].','.$value['area'].','.'0';  ?>">  <?php echo $value['nombre'] ?> </option>
				<?php
			}
		} 
		foreach ($tecnologia as   $value) { 
			
				?>
				<option value="<?php echo $value['nombre'].','.$value['id_periodo'].','.$value['id_competencias'].','.'uuu'.','.'1' ?>">  <?php echo $value['nombre'] ?> </option>
				<?php 
		}
	
}

function sacar_areas_sede_jornada_docente(){
	include '../conexion.php';
	$id=$_POST['id'];
	$id_grado_sede=$_POST['id_grado_sede'];
	$porciones = explode(" ", $id_grado_sede);
	$porciones[2];
	 
    
  	session_start();


	$consultar_nivel="SELECT area.nombre,area.id_area,area.area ,area.codigo,are_grado_sede.id_area_grado_sede from are_grado_sede,area WHERE are_grado_sede.id__docente='$id'  and are_grado_sede.id_grado_sede=$porciones[2]	 and area.id_area=are_grado_sede.id_area   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
    

	 $tecni="SELECT curdate(),  competencias.nombre,competencias.id_periodo,competencias.id_competencias FROM competencias,tecnica_grado_sede,periodo WHERE  competencias.id_docente='$id' AND  CURDATE()>=periodo.fecha_inicio and curdate()<=periodo.fecha_fin and tecnica_grado_sede.id_grado_sede= $porciones[2]   and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_periodo=periodo.numero   ";

	$tecnologia=$conexion->prepare($tecni);
	$tecnologia->execute(array()); 
		
  
		foreach ($registro as   $value) {
			if($value['area']!=1 or $value['codigo']==01){
			
				?>
				<option value="<?php echo $value['nombre'] .','.$_SESSION['numero'].','.$value['id_area'].','.$value['area'].',0,'.$value['id_area_grado_sede']  ?>">  <?php echo $value['nombre'] ?> </option>
				<?php
			}
		} 
		foreach ($tecnologia as   $value) { 
			
				?>
				<option value="<?php echo $value['nombre'].','.$value['id_periodo'].','.$value['id_competencias'].','.'uuu'.','.'1' ?>">  <?php echo $value['nombre'] ?> </option>
				<?php 
		}
	
}



function sacar_areas_sede_jornada_observador_rector(){
	include '../conexion.php'; 
	$id_grado_sede=$_POST['id_grado_sede'];
	$porciones = explode(" ", $id_grado_sede);
	$porciones[2];
	 
    
  	session_start();


	$consultar_nivel="SELECT area.nombre,area.id_area,area.area ,area.codigo,are_grado_sede.id_area_grado_sede from are_grado_sede,area WHERE are_grado_sede.id_grado_sede=$porciones[2]	 and area.id_area=are_grado_sede.id_area   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
    

	 $tecni="SELECT   competencias.nombre,competencias.id_periodo,competencias.id_competencias FROM competencias,tecnica_grado_sede,periodo WHERE     tecnica_grado_sede.id_grado_sede= $porciones[2]   and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_periodo=periodo.numero   ";

	$tecnologia=$conexion->prepare($tecni);
	$tecnologia->execute(array()); 
		
  
		foreach ($registro as   $value) {
			if($value['area']!=1 or $value['codigo']==01){
			
				?>
				<option value="<?php echo $value['nombre'] .', ,'.$value['id_area'].','.$value['area'].',0,'.$value['id_area_grado_sede']  ?>">  <?php echo $value['nombre'] ?> </option>
				<?php
			}
		} 
		foreach ($tecnologia as   $value) { 
			
				?>
				<option value="<?php echo $value['nombre'].','.$value['id_periodo'].','.$value['id_competencias'].','.'uuu'.','.'1' ?>">  <?php echo $value['nombre'] ?> </option>
				<?php 
		}
	
}
//fin

function sacar_areas_sede_jornada_docente2(){
	include '../conexion.php';
	$id=$_POST['id'];
	$id_grado_sede=$_POST['id_grado_sede'];
	$porciones = explode(" ", $id_grado_sede);
	$porciones[2];
	  


	$consultar_nivel="SELECT area.nombre,area.id_area,area.area ,area.codigo,are_grado_sede.id_area_grado_sede from are_grado_sede,area WHERE area.id_area=are_grado_sede.id_area and are_grado_sede.id__docente='$id'   and are_grado_sede.id_grado_sede=$porciones[2]	  ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();
    
 
		
  
		foreach ($registro as   $value) {
			if($value['area']!=1 or $value['codigo']==01){
			
				?>
				<option value="<?php echo $value['id_area_grado_sede']  ;  ?>">  <?php echo $value['nombre'] ?> </option>
				<?php
			}
		} 
		 
	
}



/////select para titulares

function titulars(){
		include '../conexion.php'; 
		$grado_sede=$_POST['grado_sede'];
	$consultar_nivel="SELECT docente.nombre,docente.foto, docente.apellido, docente.id_docente FROM are_grado_sede INNER JOIN docente ON docente.id_docente=are_grado_sede.id__docente INNER JOIN grado_sede on grado_sede.id=are_grado_sede.id_grado_sede WHERE are_grado_sede.id_grado_sede=$grado_sede and grado_sede.titular<>docente.id_docente GROUP by docente.id_docente";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="docente" class=" form-control my-select" >
	<option value="">Seleccione un docente</option>';
	foreach ($registro as   $value) {
		?> 
		  
 <option data-img-src="<?php echo $value['foto'] ?>" value="<?php echo $value['id_docente'] ?>"><?php echo $value['nombre'].' '.$value['apellido'] ?></option>  
		<?php
	}echo '</select><script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php 
}



/////fin del select de titulares






//funtion para ver rectores y coordinadores

function admin(){
			include '../conexion.php'; 
 
	  $consultar_nivel="SELECT * FROM `administradores`  WHERE administradores.INHABILITADO='0'";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="id_per" name="id_per[]" class=" form-control my-select" data-placeholder="Seleccione un docente"  multiple="multiple"> 
	<option value="">Seleccione los administradores</option>
	<option value="00.4">todos</option>';
	foreach ($registro as   $value) {
		 if($value['FOTO']=='' && $value['GENERO']=='Masculino'){
		 	$foto= '../../../logos/masculino.png';
		 } if($value['FOTO']=='' && $value['GENERO']=='Femenino'){
		 	$foto= '../../../logos/femenino.png';
		 } if($value['FOTO']!=''){
		 	$foto= $value['FOTO'];
		 } 
		?>  

 	<option data-img-src="<?php echo $foto  ?>" value="<?php echo $value['ID_ADMIN'] ?>"><?php echo $value['NOMBRE'] ?> <?php echo $value['APELLIDO'] ?> </option>  
		<?php
	}echo '</select><script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>'; 
}

function admin1(){
			include '../conexion.php'; 
 
	  $consultar_nivel="SELECT * FROM `administradores`  WHERE administradores.INHABILITADO='0'";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
	<select id="docente" class=" form-control my-select"  >
	<option value="">Seleccione un docente</option>';
	foreach ($registro as   $value) {
		?> 
	<option>sdfdsfsdf</option>	  
 <option data-img-src="<?php 
 if($value['FOTO']=='' && $value['GENERO']=='Masculino'){
 	echo '../../../logos/masculino.png';
 } if($value['FOTO']=='' && $value['GENERO']=='Femenino'){
 	echo '../../../logos/femenino.png';
 } if($value['FOTO']!=''){
 	echo $value['FOTO'];
 } ?>" value="<?php echo $value['ID_ADMIN'] ?>"><?php echo $value['NOMBRE'].' '.$value['APELLIDO'] ?></option>  
		<?php
	}echo '</select><script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>';?>
 
<?php
}
////fin
?>

