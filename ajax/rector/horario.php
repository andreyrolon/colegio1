<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}

function Actualiza(){
	if(isset($_POST['h'])){
 	$h=$_POST['h'];
   
 	} 
	 if(isset($_POST['id'])){
 	$id=$_POST['id'];
   
 	} 
	include '../conexion.php';
	echo  $sql="UPDATE `horario` SET `id_area_grado_sede`=$h WHERE id_horario=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}
function Actualiza1(){
	if(isset($_POST['h'])){
 	$h=$_POST['h'];
   
 	} 
	 if(isset($_POST['d'])){
 	$d=$_POST['d'];
   
 	} 
	 if(isset($_POST['id'])){
 	$id=$_POST['id'];
   
 	}
	 if(isset($_POST['idt'])){
 	$idt=$_POST['idt'];
   
 	} 
	include '../conexion.php';
	echo $sql="SELECT area.*, are_grado_sede.id__docente, horario.* FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area INNER JOIN horario ON horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede WHERE are_grado_sede.id_grado_sede=$idt  and horario.hora=$d and horario.dias=$h";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());echo "<br>";
    foreach ($sql1 as $key ) {
    	$idh=$key['id_horario'];
    }
    echo$nsql1os=$sql1->rowCount();
    if ($nsql1os>0) {
		echo  $sql="UPDATE `horario` SET `id_area_grado_sede`=$id WHERE id_horario=$idh";
	    $sql1=$conexion->prepare($sql);
	    $sql1->execute(array());echo "<br>";
	}
	  if ($nsql1os==0) { 
    	echo  $sql="INSERT INTO `horario` (`id_horario`, `id_area_grado_sede`, `hora`, `dias`) VALUES (NULL, '$id', '$d', '$h')";
	    $sql1=$conexion->prepare($sql);
	    $sql1->execute(array());
    }
}

function registrar(){   
	include '../conexion.php';
  	$hora_inicio=$_POST['hora_inicio'];
  	$hora_fin=$_POST['hora_fin'];
  	$dia=$_POST['dia'];
  	$hora=$_POST['hora'];
  	$mimo55=$_POST['mimo55'];
  	$id_area_grado_sede1=$_POST['id_area_grado_sede1'];
	$sql="SELECT horario.id_horario FROM horario,are_grado_sede WHERE are_grado_sede.id_area_grado_sede=horario.id_area_grado_sede and are_grado_sede.id_grado_sede in(SELECT are_grado_sede.id_grado_sede from area,are_grado_sede WHERE area.id_area=are_grado_sede.id_area and are_grado_sede.id_area_grado_sede='$id_area_grado_sede1' ) and  horario.hora='$hora'  and   horario.dias='$dia' ";
	$sql1=$conexion->prepare($sql);
	$sql1->execute(array());  
	$count=$sql1->rowCount();
	if ($count>0) {
		echo 1;
	}else{
		$sqlq="SELECT horario.id_horario from horario WHERE horario.id_area_grado_sede='$id_area_grado_sede1'";
		$sql1q=$conexion->prepare($sqlq);
		$sql1q->execute(array());  
		$countq=$sql1q->rowCount();

		if ($countq<$mimo55) {
			$sql="INSERT INTO `horario` ( `id_area_grado_sede`, `hora`, `dias`, `hora_inicio`, `hora_fin`) VALUES ( '$id_area_grado_sede1', '$hora', '$dia', '$hora_inicio', '$hora_fin')";
			$sql1=$conexion->prepare($sql);
			$sql1->execute(array());  
			$count=$sql1->rowCount(); 
			echo 0;
		}else{
			echo 11;
		}
	}
 


}
 function sesion(){
 	session_start();
 	$sty=$_POST['a']; 
 	if ($sty=='') {
 		$_SESSION['num']='';
      	$_SESSION['link']='';
       	$_SESSION['sty']="";
    }
 	if ($sty==2) {
 		$_SESSION['num']=2;
      	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">';
       	$_SESSION['sty']="font-family: 'Irish Grover', cursive;font-size: 17px;";
    }
    if ($sty==1) {
    	$_SESSION['num']=1;
       	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Mystery+Quest&display=swap" rel="stylesheet">';
       	$_SESSION['sty']="font-family: 'Mystery Quest', cursive;font-size: 17px;";
    }
    if ($sty==3) {
    	$_SESSION['num']=3;
       	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">';
       	$_SESSION['sty']="font-family: 'Playball', cursive;font-size: 17px;";
    }
    if ($sty==4) {
    	$_SESSION['num']=4;
       	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">';
       	$_SESSION['sty']="font-family: 'Lily Script One', cursive;font-size: 17px;";
    }
    if ($sty==5) {
    	$_SESSION['num']=5;
       	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">';
        $_SESSION['sty']="font-family: 'Leckerli One', cursive;font-size: 16.5px;";
    }
    if ($sty=='font-style: italic;') {
    	$_SESSION['num']='font-style: italic;';
        $_SESSION['sty']='font-style: italic;';
        $_SESSION['link']='';
    }  
    if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
        $_SESSION['sty']='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style:italic;';
        $_SESSION['link']='';
        $_SESSION['num']='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style:italic;';

    }
   
    if ($sty==6) {
    	$_SESSION['num']=6;
       	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Fontdiner+Swanky&display=swap" rel="stylesheet">';
        $_SESSION['sty']="font-family: 'Fontdiner Swanky', cursive;font-size: 15px";
    }
    if ($sty==8) {
    	$_SESSION['num']=8;
       	$_SESSION['link']='<link href="https://fonts.googleapis.com/css2?family=Original+Surfer&display=swap" rel="stylesheet">';
        $_SESSION['sty']="font-family: 'Original Surfer', cursive;font-family: 'Rancho', cursive;";
    }
 }

function eliminar(){

	include '../conexion.php'; 
  	$dia=$_POST['dia'];
  	$hora=$_POST['hora'];
  	$id_area_grado_sede1=$_POST['id_area_grado_sede1'];
	$sql="DELETE FROM horario WHERE hora= '$hora' and dias='$dia'  and id_area_grado_sede='$id_area_grado_sede1'";
	$sql1=$conexion->prepare($sql);
	$sql1->execute(array());  

	
}

function asignar_titular(){
	$grado='';
    $curso='';
    $jornada='';
    $sede='';
    include '../conexion.php';
 	if(isset($_POST['docente'])){
		$docente=$_POST['docente'];
	}
	if(isset($_POST['grado_sede'])){
		$grado_sede=$_POST['grado_sede'];
	} 
    $sql="SELECT grado_sede.id, grado.nombre as grado, curso.numero as curso,sede.NOMBRE as sede,jornada.NOMBRE as jornada from grado_sede INNER JOIN sede on sede.ID_SEDE=grado_sede.id_sede INNER JOIN jornada on jornada.ID_JORNADA=grado_sede.id_jornada INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN grado on grado.id_grado=grado_sede.id_grado  WHERE grado_sede.titular=$docente";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    foreach ($sql1 as   $value) {
    	$grado=$value['grado'];
    	$curso=$value['curso'];
    	$jornada=$value['jornada'];
    	$sede=$value['sede']; 
    }
    $count=$sql1->rowCount();
    if($count==0){
	    $sql="UPDATE `grado_sede` SET `titular`=$docente WHERE id=$grado_sede";
	    $sql1=$conexion->prepare($sql);
	    $sql1->execute(array());
	    echo ' <script type="text/javascript">  window.location.assign( window.location.href); </script>';
	}else{?> <script type="text/javascript">  mensaje3(2,"Actualmente el profesero es titular del curso <?php echo $grado.' '.$curso;?> en la sede <?php echo $sede;?> jornada: <?php echo $jornada;?>"   ); </script><?php
	}
}


function  ver_horario_docente(){
	include '../conexion.php';
	 $id_docente=$_POST['id_docente'];
	 

	  $sqlz=" SELECT grado.numero,curso.numero as curso, sede.NOMBRE as sede,jornada.NOMBRE as jornada,competencias.nombre, horario_competencias.dia,horario_competencias.hora_inicio,horario_competencias.hora_fin from grado,curso,jornada,sede,jornada_sede, grado_sede, tecnica_grado_sede,competencias,horario_competencias where competencias.id_docente='$id_docente' and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and competencias.id_competencias=horario_competencias.id_competencias and tecnica_grado_sede.id_grado_sede=grado_sede.id and jornada_sede.ID_JS=grado_sede.id_jornada_sede and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso GROUP by  `horario_competencias`.`id_horario_competencias`";
    $sql1z=$conexion->prepare($sqlz);
    $sql1z->execute(array());


	  $sql="SELECT q.nombre, intensidad_horaria.hora,q.sede,q.jornada,q.numero,q.curso, q.id_area_grado_sede from (SELECT are_grado_sede.id_area_grado_sede, grado.id_grado, grado.numero,curso.numero as curso, sede.NOMBRE as sede,jornada.NOMBRE as jornada, area.nombre,area.area,area.codigo from grado,curso,jornada,sede,jornada_sede, grado_sede, area ,are_grado_sede where are_grado_sede.id__docente='$id_docente' and area.id_area=are_grado_sede.id_area and are_grado_sede.id_grado_sede=grado_sede.id and jornada_sede.ID_JS=grado_sede.id_jornada_sede and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and grado_sede.id_grado=grado.id_grado and curso.id_curso=grado_sede.id_curso GROUP by are_grado_sede.id_area_grado_sede)as q LEFT JOIN intensidad_horaria on intensidad_horaria.grado=q.id_grado and intensidad_horaria.area=q.nombre WHERE q.codigo=01 or q.area not in ('1') order by q.sede,q.jornada
";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $variable=array('color: #886ab5;border: solid 1px #886ab5;','color: #007bff ;border: solid 1px #007bff ;','color: #dc3545 ;border: solid 1px #dc3545 ;','color: #28a745;border: solid 1px #28a745;','color: #fd3995;border: solid 1px #fd3995;','color: #505050;border: solid 1px #505050;','color: #ffc241;border: solid 1px #ffc241;','color: #1dc9b7;border: solid 1px #1dc9b7;','color: #bd1bb8;border: solid 1px #bd1bb8;','color: #5bc0de;border: solid 1px #5bc0de;','color: #717073;border: solid 1px #717073;','color: #587ea3;border: solid 1px #587ea3;','color: #dc6008;border: solid 1px #dc6008;','color: #3c8dbc;border: solid 1px #3c8dbc;','color: #886ab5;border: solid 1px #886ab5;','color: #d09de0;border: solid 1px #d09de0;','color: #4f07ffcf;border: solid 1px #4f07ffcf;','color: #117a65;border: solid 1px #117a65;','color: #a9cce3;border: solid 1px #a9cce3;','color: #A98307;border: solid 1px #A98307;');


    $variableS=array('background-color: #886ab5;color:#fff','background-color: #007bff;color:#fff','background-color: #dc3545;color:#fff','background-color: #28a745;color:#fff','background-color: #fd3995;color:#fff','background-color: #505050;color:#fff','background-color: #ffc241;color:#fff','background-color: #1dc9b7;color:#fff','background-color: #bd1bb8;color:#fff','background-color: #5bc0de;color:#fff','background-color: #717073;color:#fff','background-color: #587ea3;color:#fff','background-color: #dc6008;color:#fff','background-color: #3c8dbc;color:#fff','background-color: #886ab5;color:#fff','background-color: #d09de0;color:#fff','background-color: #4f07ffcf;color:#fff','background-color: #117a65;color:#fff','background-color: #a9cce3;color:#fff','background-color: #A98307;color:#fff');
    $w=0; ?>
	<?php 
	for ($w=1; $w <20 ; $w++) { 
	 	?>
		<style type="text/css">
	 	#t<?php echo $w  ?>	{
			<?php echo $variable[$w] ?>
	 	}
 </style>
		<style type="text/css">
	 	#t<?php echo $w  ?>:hover	{
			<?php echo $variableS[$w] ?>
	 	}
 </style>
	 	<?php
	 } ?>
 

     <div   style="    padding: 5px ;background-color: #fff;border-top: solid 3px red; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" ><?php
    	$y='';
    	$y1='';
    	$i=0;
	    foreach ($sql1z as  $value) {
	    	$i++;
	    	if ($value['dia']==1) {
	    		$dia='Lunes'; 
	    	}
	    	if ($value['dia']==2) {
	    		$dia='Martes'; 
	    	}
	    	if ($value['dia']==3) {
	    		$dia='Miercoles'; 
	    	}
	    	if ($value['dia']==4) {
	    		$dia='Jueves'; 
	    	}
	    	if ($value['dia']==5) {
	    		$dia='Viernes'; 
	    	}
	    	if ($value['dia']==6) {
	    		$dia='Sabado'; 
	    	}
	    	if ($value['dia']==7) {
	    		$dia='Domingo'; 
	    	}
	    	if ( $value['sede']!=$y or  $value['jornada']!=$y1) { ?>
	    		<span  style="display: block; margin-bottom: 10px;margin-top: 5px"><strong>Competencias acargo en la sede: <?php echo $value['sede']. ' '.$value['jornada']; ?></strong></span> <?php
	    	}
	    	$y=$value['sede'];
	    	$y1=$value['jornada'];
	    	?> 
	    	 
	    	<div id="t<?php echo $i; ?>" style=" display: -webkit-inline-box;   padding: 5px; margin-right: 10px; margin-top: 10px;     "><center><?php echo  $value['numero'].':'.$value['curso'] .' - '.  $value['nombre']; ?> - Dia: <?php echo $dia ?> - Hora inicio: <?php echo $value['hora_inicio'] ?> - Hora fin: <?php echo $value['hora_fin'] ?>  </center></div>
	    	<?php
	    } 

	    $y='';$y1='';
	    foreach ($sql1 as  $value) {
	    	$i++;
	    	if ( $value['sede']!=$y or  $value['jornada']!=$y1) { ?><br><br>
	    		<span  style="display: block; margin-bottom: 10px;margin-top: 5px"><strong>Areas acargo en la sede: <?php echo $value['sede']. ' '.$value['jornada']; ?></strong></span> <?php
	    	}
	    	$y=$value['sede'];
	    	$y1=$value['jornada'];
	    	?> 
	    	<style type="text/css">
	    		#we<?php echo $value['id_area_grado_sede']; ?>{
	    			z-index:1;
	    			<?php   echo $variable[$i]  ?>
	    		}
	    		#we<?php echo $value['id_area_grado_sede']; ?>:hover{
	    			z-index:1;
	    			<?php   echo $variableS[$i]  ?>
	    		}
	    	</style>
	    	<div id="t<?php echo $i; ?>" style=" display: -webkit-inline-box;   padding: 5px; margin-right: 10px; margin-top: 10px;  width: 185px;   "><center><?php echo  $value['numero'].':'.$value['curso'] .' - '.  $value['nombre']; ?> - h: <?php echo $value['hora']; ?></center></div>
	    	<?php
	    }
	    ?><br><br> 
	</div><br>

     	 
 
	 
	
	 
		 

    <?php

}
function table(){
 	$id_docente=$_POST['id_docente'];
	?>
	     <div class="table-responsive" style=" margin-left:5px;margin-right: 5;   padding: 10px ;background-color: #fff;border-top: solid 3px #00c0ef; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
		<button style="margin-left: 10px" type="button" value="Imprime esta pagina" class="btn btn-danger" onclick=" window.print()">
            <i class="fa  fa-file-pdf-o"></i>  Descargar Horario  
        </button><br><br>
		<style>
												tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      }
											    td,th{
											    	border:solid #d5d5d5 2px ;

												}
											</style>
											 
											<table class=" table table-hover">
		                                	 
		                                 
			<tr style="border:solid #d5d5d5 2px ;background: #EEE;">
				<th style="width: 50px;">Horas</th>
				<th>Lunes</th>
				<th>Martes</th>
				<th>Miercoles</th>
				<th>Jueves</th>
				<th>Viernes</th>
				<th>Sabado</th>
				<th>Domingo</th>
			</tr>
			<?php 
			for ($i=1; $i <10 ; $i++) { ?>
				<tr>
					<td style="width: 10px;"><strong><?php echo $i ?></strong></td>
					<?php
					for ($o=1; $o <8 ; $o++) {
						
						?> 
						
						<td style="width: 80px ;height: 40px; "><?php echo fun($id_docente,$i,$o) ?></td>
						<?php

					} ?>
				</tr> <?php
			} ?>
		</table>

     <div> <?php
}
function fun($id_docente,$i,$o){
	?>
 <?php
	include '../conexion.php';
	$sql="SELECT are_grado_sede.id_area_grado_sede, horario.hora_inicio,area.nombre,grado.numero,curso.numero as curso from grado_sede,area,are_grado_sede,horario,curso,grado WHERE are_grado_sede.id__docente=$id_docente and grado_sede.id=are_grado_sede.id_grado_sede and grado_sede.id_curso=curso.id_curso and grado.id_grado=grado_sede.id_grado and are_grado_sede.id_area=area.id_area and are_grado_sede.id_area_grado_sede=horario.id_area_grado_sede and horario.dias='$o' and horario.hora=$i";
	$sql1=$conexion->prepare($sql);
	$sql1->execute(array()); 
	foreach ($sql1 as   $value) {
		?>
		<nav   style="   border-radius: 4px; padding-left: 10px;padding-right: 10px;margin-bottom: 5px "  id="we<?php echo$value['id_area_grado_sede'] ?>"><?php  echo $value['nombre'].'- '.$value['numero'].':'.$value['curso']?><br>Hora: <?php  echo $value['hora_inicio'] ?></nav> 
		<?php
	}
	 

}





?>