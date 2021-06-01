
<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}
function actualizar1(){
	include '../../conexion.php';
	$_POST['u'];
	$_POST['ides'];
	$y=$_POST['n'];

	 
	 $consultar_nivel="SELECT * FROM logro WHERE logro.id_logro='".$_POST['ides']."'   ";
	$consultar_nivel12=$conexion->prepare($consultar_nivel);
	$consultar_nivel12->execute(array());
	 
	 $consultar_nivel="SELECT * FROM logro WHERE logro.".$_POST['n']."='".$_POST['u']."'   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$nroProductos=$consultar_nivel1->rowCount();
	foreach ($consultar_nivel12 as $key  ) {
		$o=$key[$y];
	}
	if ($nroProductos>0) {
		?>
		<script type="text/javascript">
		 document.getElementById("<?php echo $_POST['w']  ?>").innerHTML = "<?php echo $o ?>";  
			mensaje2(1,'Ya se encuentra registrado la misma descripcion');
		</script><?php
	}else{
		$consultar_nivel="UPDATE `logro` SET `".$_POST['n']."` = '".$_POST['u']."' WHERE `logro`.`id_logro` = ".$_POST['ides'];
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$nroProductos=$consultar_nivel1->rowCount();	
		?>
		<script type="text/javascript">
			mensaje2(3,'Registro actualizado');
		</script><?php
	}	
	 
	
}

function eliminar(){
 	include '../../conexion.php'; 
  	$ano=date('Y');
  	$consultar_nivel=" SELECT logro.id_logro from logro,informeacademico,materia_por_periodo,logro_periodo WHERE informeacademico.ano='$ano' and materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico and materia_por_periodo.id_materia_por_periodo=logro_periodo.id_materia_por_periodo and logro.id_logro=logro_periodo.id_logro AND logro.id_logro= '".$_POST['io']."'  GROUP by logro.id_logro";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	echo$verifay=$consultar_nivel1->rowCount();
	if ($verifay==0) {
	 	$consultar_nivel="DELETE FROM `logro` WHERE `logro`.`id_logro` = '".$_POST['io']."'   ";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array()); 
	} 
 }
function eliminar2(){
 	include '../../conexion.php';
  	$yu=$_POST['ids'];
  	if ($yu=='') {
  		?>
		<script type="text/javascript">
			mensaje2(2,'Campos vacios');
		</script><?php
  	}else{
  		foreach ($yu as $key  ) {
		 	$consultar_nivel="DELETE FROM `logro` WHERE `logro`.`id_logro` = '".$key."'   ";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());
			?>
			<script type="text/javascript">
				document.getElementById('fila<?php echo $key; ?>').style.display='none'; 
			</script><?php
 		}
 		?>
		<script type="text/javascript">
			mensaje2(3,'Registros eliminadoss');
		</script><?php	
		$key='';
		$yu='';
  	}
 	
 	
 }

 function nuevo_logro_tecnica(){ 
	include '../../conexion.php'; 
	 
	 
	$consultar_nivel="INSERT INTO `logro_tecnica` (`logro`, `tipo`, `id_competencias`) VALUES  ('".$_POST['logro']."', '".$_POST['toa']."' , '".$_POST['id']."')";	 
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	?>
	<script type="text/javascript">
		mensaje(3,'Registro exitoso'); 
	</script><?php 

}
 function registro(){ 
	include '../../conexion.php'; 
	if(isset($_POST['grado'])){
		$grado=$_POST['grado'];

	}
	if(isset($_POST['materia'])){
		$materia=$_POST['materia'];

	} 
	$consultar_nivel="INSERT INTO `logro` ( `logro`, `tipo`, `id_area`, `id_grado`) VALUES('".$_POST['logro']."', '".$_POST['tipo']."', '".$_POST['materia']."' , '".$_POST['grado']."')";	 
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	?>
	<script type="text/javascript">
		mensaje(3,'Registro exitoso');
		document.getElementById('codigo').focus();
		document.getElementById('logro').value='';
		document.getElementById('recomendacion').value='';
		document.getElementById('dificultad').value='';
		document.getElementById('codigo').value='';
	</script><?php 

}



function eliminar_logro_tecnica(){ 
	include '../../conexion.php'; 
	if(isset($_POST['id'])){
		$id=$_POST['id'];

	}
	 
 	$ano=date('Y');
 

		 

		$consultar_nivel="SELECT logro_periodo_tecnica.id_logro_tecnica from logro_periodo_tecnica,tecnologia,informeacademico WHERE informeacademico.ano='$ano' and tecnologia.id_informe_academico=informeacademico.id_informe_academico and tecnologia.id_tecnologia=logro_periodo_tecnica.id_tecnologia and logro_periodo_tecnica.id_logro_tecnica= '$id'";	 
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$nroProductos=$consultar_nivel1->rowCount();
		if ($nroProductos==0) {
			$consultar_nivel="DELETE FROM `logro_tecnica` WHERE `logro_tecnica`.`id` = '$id'";	 
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());
			?> 
			<script type="text/javascript">
				mensaje9(3,'Logro Elimindo'); 
			</script><?php
		}else{ 
			?>
			<script type="text/javascript">
				mensaje9(1,'El logro está registrado a un estudiante.'); 
			</script><?php 
		}

	 



}

function actualizar_logro_tecnica(){
	include '../../conexion.php';
	$ides=$_POST['ides'];
	$n=$_POST['n'];
	$u=$_POST['u'];

	$consultar_nivel="UPDATE `logro_tecnica` SET `$n` = '$u' WHERE `logro_tecnica`.`id` = $ides;";
	 
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());

}
function logro_tecnica(){

	include '../../conexion.php'; 
	 
	if(isset($_POST['id'])){
		$id=$_POST['id'];

	}
	if(isset($_POST['toa'])){
		$toa=$_POST['toa'];

	}
 
	if ($toa==1) {
		$de='El ';
		$var='Logro';
	}
 
	if ($toa==2) {
		$de='La ';
		$var='Recomendacion';
	}
 
	if ($toa==3) {
		$de='La';
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

	$consultar_nivel=" SELECT logro_tecnica.id,logro_tecnica.logro from logro_tecnica WHERE  logro_tecnica.id_competencias='$id' and  logro_tecnica.tipo='$toa' and logro_tecnica.logro like('%$d%')   ORDER by logro_tecnica.id DESC  ";
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
  $fttg1=    $lista = $lista.'<nav aria-label="...">
  <ul class="pagination" style="cursor: pointer;">  

<li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
      <a class="page-link">Anterior</a>
    </li>
';
}else{
    $lista = $lista.'<nav aria-label="...">
  <ul class="pagination">  

<li class="page-item disabled "   >
      <a class="page-link">Anterior</a>
    </li>
';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
     $lista = $lista.'

    <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
      <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </span>
    </li> ';
 }else{
  $lista = $lista.'
    <li class="page-item  "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
      <a class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
      </a>
    </li> ';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'  

<li class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
      <a class="page-link">siguiente</a>
    </li>';
  $o=0;
}else{
   $lista = $lista.'  

<li class="page-item  disabled "   ">
      <a class="page-link">Siguiente</a>
    </li>';
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}

	  $consultar_nivel="SELECT logro_tecnica.id,logro_tecnica.logro from logro_tecnica WHERE  logro_tecnica.id_competencias='$id' and  logro_tecnica.tipo='$toa' and logro_tecnica.logro like('%$d%')   ORDER by logro_tecnica.id DESC  LIMIT $limit, $nroLotes  ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();

	$registrow=$consultar_nivel1->rowCount();
	?>  
<form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
		<div class="box-body no-padding">

			<div class="mailbox-controls">
 		  		
				<div class="btn-group" style="margin-left: 5px"> 
  					 
					<?php if($paginaActual > 1){
						echo  ' <button type="button" class="popo btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

						<?php
						if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="popo btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
								echo  ' <button type="button" class="popo btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

								<?php
								if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="popo btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

							</div>
							<!-- /.btn-group -->
						</div>
						<!-- /.pull-right -->
					</div>

					<div class="table-responsive " style="

					text-align: justify; /* For Edge */
					-moz-text-align-last: left; /* For Firefox prior 58.0 */
					text-align-last: left; padding: 10px" >
 <table class="table table-hover  mailbox-messages">
					<tr>  
 					<th style="width: 25px">Id</th>
					<th style="width: 230px"><?php echo $var ?></th>  
					<th style="width: 25px" >Editar</th>
					<th style="width: 25px" >Eliminar</th>

					</tr><?php
					$i=1;
					foreach ($registro as $registro2) { ?>



						<tr id="fila<?php echo $registro2['id']?>"> 
						 
						<td><?php echo $i++ ?></td>
						<td id="uiu<?php echo $registro2['id']; ?>" contenteditable="false" 
							onblur='document.getElementById("uiu<?php echo $registro2['id']; ?>").contentEditable = "false"; 

							  var w="<?php echo $de ?> <?php echo $var ?>"; 
							  var ides=<?php echo $registro2['id'] ?>;
							  var n="logro";
							  var u = $("#uiu<?php echo $registro2['id']; ?>").text(); 
							  var identificador="<?php echo $registro2['logro']?>";
							  if (identificador==u) {
							  	 
							  }else{ 
							  cambiar(u,ides,n,w); } '><?php echo $registro2['logro']?></td>  



						  
					 
						<td  > <a  data-title="Actualizar <?php echo $var ?>" onclick='document.getElementById("uiu<?php echo $registro2['id']; ?>").contentEditable = true; document.getElementById("uiu<?php echo $registro2['id']; ?>").focus();' >
							<img  style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
						</a></td>		
 
						<td>

							<a  onclick='document.getElementById("eliminar").value=<?php echo $registro2["id"]; ?>'   data-title="eliminar <?php echo $var ?>" data-toggle="modal" data-target="#mymodal1"> <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo="></a>              
							

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

					echo '  <ul  style="margin-left: 10px" class="pagination" id="pagination"> '.$lista.'</ul>






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




?>