<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}

function consultar_estudiantes_por_apellido(){
	include '../../conexion.php';
    $ano=date('Y');
   

	 
     
     $consultar_nivel="SELECT g.sede,g.jornada,g.grado,g.curso,alumnos.genero,alumnos.nombre,alumnos.apellido,alumnos.foto,informeacademico.id_informe_academico ,informeacademico.fecha_desercion,informeacademico.fecha_retiro from alumnos,informeacademico,(SELECT grado_sede.id_jornada_sede,grado_sede.id_grado,grado_sede.id_curso, grado.nombre as grado,sede.NOMBRE as sede,curso.numero as curso,jornada.NOMBRE as jornada FROM grado,sede,jornada,curso,grado_sede,jornada_sede WHERE grado_sede.id_grado=grado.id_grado AND grado_sede.id_curso=curso.id_curso AND grado_sede.id_jornada_sede=jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA )as g WHERE informeacademico.id_alumno=alumnos.id_alumnos and alumnos.apellido like('%".$_POST['ape']."%') and informeacademico.ano='$ano' and g.id_jornada_sede=informeacademico.id_jornada_sede and g.id_grado=informeacademico.id_grado and g.id_curso=informeacademico.id_curso order by alumnos.apellido
     "; 
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registrow=$consultar_nivel1->rowCount(); 
	if ($registrow>0) {
			?>
			<style type="text/css">
				td{
					<?php echo $_POST['style'] ?>} 
				
			</style>

		     <div class="table-responsive" style="padding: 10px">

			  <table class="table   table-hover ">
			  	<tr>
			  		<th>id</th>
			  		<th style="padding-left: 45px;padding-right: 45px">Foto</th>
			  		<th>Nombre</th> 
			  		<th>Sede</th> 
			  		<th>Curso</th>
			  		<th>Estado</th> 
			  		<th>Observar</th> 
			  	</tr>
				<?php $t=0;
				foreach ($consultar_nivel1 as $key  ) {?>
				 	<tr>
				 		<td><br> <?php echo $t=$t+1; ?></td>
				 		<td><center><img style="padding: 3px" class="profile-user-img img-responsive img-circle"  width="60px" src="<?php 
								if($key['foto']=='' && $key['genero']!=1){
									echo '../../../logos/niño.jpg';
								}if($key['foto']=='' && $key['genero']==1){
									echo '../../../logos/niña.jpg';
								}if($key['foto']!=''){
									echo $key['foto'];
								} ?>"></center></td>
				 		<td><br><?php echo $key['nombre'] ?> <?php echo $key['apellido'] ?></td>
				 		<td><br><?php  
								echo $key['sede'];
						 
				 			?> - <?php  
								echo $key['jornada']; 
				 			?>
				 		</td> 
				 		</td>
				 		<td><br><?php  
								echo $key['grado'];
							 
				 			?> <?php 
				 			 
								echo $key['curso'];
							 
				 			?>  
				 		</td>
				 		<td  style="    padding-top: 22px;"> 
				                <?php 
				                $s=1;
				                if ($key['fecha_desercion']!='0000-00-00') { 
				                	echo'<span class="btn btn-danger ">Desertor</span>';
				                	$s=0;
				                }
				                if ($key['fecha_retiro']!='0000-00-00') { 
				                	echo'<span class="btn btn-warning ">Retirado</span>';
				                	$s=0;
				                }
				                if (($key['fecha_retiro']=='0000-00-00') && ($key['fecha_retiro']=='0000-00-00')) {
				                	echo'<span class="btn btn-info">Cursando</span>';
				                }

				                ?>
				            </td>
				 		 
				 		<td style="    padding-top: 15px;">     
		  <!-- Modal -->
		<a href="#" data-toggle="modal" data-target="#mymodal"     onclick="      var id=<?php echo $key['id_informe_academico'] ;?> ;funcion(id) "><img style="width: 54px;height: 54px" src="data:image/svg+xml;base64,&#10;        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==">
		   

		</td>


						  <!-- Modal -->
					 
				 	</tr><?php

				 } ?>
			</table>
		</div>

	<?php
	}else{
		?>
		<div id="www" class="callout callout-info" style="margin: 20px; display: block;">
			<h4 style="<?php echo $_POST['style'] ?> <?php echo $_POST['sty'] ?>"">información:</h4>
			No se encuentran alumnos registrados. 
        </div>
		<?php
	}
}
 
function actulizar_nota_periodo2(){ 
	include '../../conexion.php';
	date_default_timezone_set("America/Bogota");
	session_start(); 
	$fecha=date("Y-m-d");
	$hora=date("h:i:s"); 
		
		echo$SELECT1=" 
		INSERT INTO `seguimiento_tecnica_definitiva` (`rol`, `id_tecnologia`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES( '".$_SESSION['Rol']."', '".$_POST['id_nota']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');

		UPDATE `tecnologia` SET `nota` = '".$_POST['nota']."' WHERE `tecnologia`.`id_tecnologia` =". $_POST['id_nota'];
		$SELECT1=$conexion->prepare($SELECT1);
		$SELECT1->execute(array()); 
		 

}



function actulizar_nota_periodo(){
	include '../../conexion.php';
	date_default_timezone_set("America/Bogota");
	session_start(); 
	$fecha=date("Y-m-d");
	$hora=date("h:i:s");
	$ui=$_POST['ui'];
	if ($_POST['codigo']==01) {
		
		$SELECT1="INSERT INTO `seguimiento_notas_definitivas` (  `rol`, `id_materia_por_periodo`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$_POST['id_nota']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');

		UPDATE `materia_por_periodo` SET `nota` = '".$_POST['nota']."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =". $_POST['id_nota'];
		$SELECT1=$conexion->prepare($SELECT1);
		$SELECT1->execute(array()); 
		echo 1;
	}else{

		$SELECT1="INSERT INTO `seguimiento_notas_definitivas` (  `rol`, `id_materia_por_periodo`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$_POST['id_nota']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');

		UPDATE `materia_por_periodo` SET `nota` = '".$_POST['nota']."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =". $_POST['id_nota'];
		$SELECT1=$conexion->prepare($SELECT1);
		$SELECT1->execute(array());

		$SELECT1="SELECT sum( materia_por_periodo.nota)/COUNT( materia_por_periodo.nota) as www, q.id_materia_por_periodo from materia_por_periodo,
		
		(SELECT materia_por_periodo.id_materia_por_periodo from materia_por_periodo WHERE   materia_por_periodo.area=1  and materia_por_periodo.codigo='".$_POST['codigo']."' and materia_por_periodo.periodo='".$_POST['periodo']."' AND materia_por_periodo.id_informe_academico='".$_POST['ui']."')as q


		WHERE materia_por_periodo.id_informe_academico='".$_POST['ui']."' and materia_por_periodo.area='".$_POST['area']."' and materia_por_periodo.codigo='".$_POST['codigo']."' and materia_por_periodo.periodo='".$_POST['periodo']."' ORDER BY `materia_por_periodo`.`periodo` ASC" ;
		$SELECT1=$conexion->prepare($SELECT1);
		$SELECT1->execute(array()); 
		foreach ($SELECT1 as   $value) {
			$id=$value['id_materia_por_periodo'];
			$www=$value['www'];
			$SELECT1="INSERT INTO `seguimiento_notas_definitivas` (  `rol`, `id_materia_por_periodo`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$id."', '$fecha', '".$www."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');

			UPDATE `materia_por_periodo` SET `nota` = '".$www."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =". $id;
			$SELECT1=$conexion->prepare($SELECT1);
			$SELECT1->execute(array());
			echo 0;
		}

	}

		 
}


function tabla_materias(){

    session_start();
	include '../../conexion.php';
    $SELECT="SELECT numero FROM periodo order by numero";
	$SELECT=$conexion->prepare($SELECT);
	$SELECT->execute(array());



    $SELECTw="SELECT tecnologia.id_informe_academico from tecnologia WHERE tecnologia.id_informe_academico=".$_POST['id'];
	$SELECTww=$conexion->prepare($SELECTw);
	$SELECTww->execute(array());  
	$registrow11=$SELECTww->rowCount();

	?>  

	
	<style>
		 
[data-title] {  
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: -272%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 8px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}
td{

}
#we269{ <?php echo $_POST['sty'] ?>
	width: 90px;  
	border-radius: 4px; 
	padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px; 
	margin-bottom: 5px ; 
    color: #1dc9b7;
    border: solid 1px #1dc9b7;
    float: left;margin-left: 10px;
}
#we269:hover{
	background-color: #1dc9b7;color:#fff;
	border:solid 1px #189e90;
}
#we26{ <?php echo $_POST['sty'] ?>
	 width: 90px; float: left;margin-left: 10px; border-radius: 4px; padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px; margin-bottom: 5px ; 
    color: #00c0ef;
    border: solid 1px #00acd6;
}
#we26:hover{
	background-color: #00c0ef;color:#fff;
	border:solid 1px #007c9a;
}
#eee:hover{
	background-color: #26bfafa6;color: #fff;border:solid 2px #26bfaf;
}
	</style>
	<div  style=" <?php echo $_POST['sty'] ?>"  id="fg<?php echo $kj=$_POST['id'] ?>"></div>

	<?php 

	if ($registrow11>0) {?>
		<nav  id="we26" onclick="
		document.getElementById('fer1').style.display='block';
		document.getElementById('fer2').style.display='none'; ">
			Academico
		</nav>	 
		<nav style="" id="we269"   onclick="
		document.getElementById('fer1').style.display='none';
		document.getElementById('fer2').style.display='inline-table'; ">
			Tecnico
		</nav> <br><br>

		<?php
	}
	 ?>
	
	<table class="table table-hover" id="fer2"  style="width: 100%; display: none;">
		<tr  style=" background-color: #26bfaf;color: #fff">
			<th>
				Competencia
			</th>
			<th>
				Periodo
			</th>
			<th>
				Nota
			</th>
		</tr>
		<?php 
		$SELECTw1="SELECT tecnologia.competencia,tecnologia.nota,tecnologia.id_tecnologia ,tecnica_por_paso.id_tecnica_por_paso,tecnologia.id_periodo FROM tecnologia  LEFT JOIN tecnica_por_paso on tecnica_por_paso.id_tecnologia=tecnologia.id_tecnologia WHERE tecnologia.id_informe_academico='".$_POST['id']."'  GROUP by tecnologia.id_tecnologia";
		$SELECTww1=$conexion->prepare($SELECTw1);
		$SELECTww1->execute(array());
		foreach ($SELECTww1 as $key ) { 
			 ?>
			<tr  >
				<td><?php echo $key['competencia'] ?></td>
				<td><?php echo $key['id_periodo'] ?></td>
				<?php 
				if ($key['id_tecnica_por_paso']=="") {
				 	?>
				 	<td>
						<input type="" value="<?php echo $key['nota']  ?>"   style="width: 60px;  " id='xxsui<?php echo $key['id_tecnologia']  ?>' onchange='
						var nota=document.getElementById("xxsui<?php echo $key['id_tecnologia']  ?>").value;
						var id_nota=<?php echo $key['id_tecnologia'] ?>; 
						var nombre="xxsui<?php echo $key['id_tecnologia']  ?>";
						var notar=<?php echo $key['nota']  ?>; 
						var ui=<?php echo  $_POST['id'] ?>;
						var maximo=<?php echo $_SESSION['maximo2'] ?>;
						var minimo=<?php echo $_SESSION['minimo2'] ?>;  
						myfun2(minimo,maximo, id_nota, notar,nombre,nota);'>
					</td>
				 	<?php 
				} ?> 
			</tr><?php 
		} ?>
	</table>

	<div  id="fer1">
		<table class="table table-hover"  > 
		        <tr style="background-color: #00acd6;
    color: #fff;"> 
			        <th>Materia</th> 
			        <?php

						foreach ($SELECT as   $value) {
						 
							echo  '<th>' . (($value['numero'])).' Periodo</th>'  ;
						} ?> 
			       
		        </tr>  
		    	<?php 

		    	$SELECT=" SELECT q.nombre_materia,q.codigo,q.area,q.id_materia_por_periodo from ( SELECT  nombre_materia,codigo,area,id_materia_por_periodo  FROM materia_por_periodo WHERE id_informe_academico=".$_POST['id']." )as q group by nombre_materia , area order by q.id_materia_por_periodo";
				$SELECT=$conexion->prepare($SELECT);
				$SELECT->execute(array());
				foreach ($SELECT as   $value) {  

					$codigo=$value['codigo'];
					$area=$value['area'];  
					$rt='';
					if($value['area']==1){
						$rt='style="background-color: #bbe3f299"';
					}

					if ($value['codigo']==01 or $value['area']!=1){  ?>
						 
					    <tr <?php echo $rt ?>>
					        <td style=" <?php echo $_POST['style'] ?> padding:11px;">   <?php echo ucwords($value['nombre_materia']) ?></td>
					        <?php 
					        $SELECT1="SELECT materia_por_paso.id_materia_por_paso, materia_por_periodo.nota,materia_por_periodo.id_materia_por_periodo ,materia_por_periodo.periodo FROM materia_por_periodo LEFT JOIN materia_por_paso on materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo  WHERE  nombre_materia='".$value['nombre_materia']."' and area='".$value['area']."' and id_informe_academico=".$_POST['id']." GROUP by materia_por_periodo.id_materia_por_periodo order by periodo  " ;
							$SELECT1=$conexion->prepare($SELECT1);
							$SELECT1->execute(array());$con=0;
							foreach ($SELECT1 as $keyr ) { 
								$con=$con+1; 
									if ($keyr['id_materia_por_paso']=='') {
										?>
										<td style="padding:11px;">  
									 		<input type="" value="<?php echo $keyr['nota']  ?>" TABINDEX="<?php  echo $con.'0'  ?>" name="ui<?php echo $keyr['id_materia_por_periodo']  ?>" style="width: 60px;  " id='ui<?php echo $keyr['id_materia_por_periodo']  ?>' onchange='
											  		var nota=document.getElementById("ui<?php echo $keyr['id_materia_por_periodo']  ?>").value;
											  		var id_nota=<?php echo $keyr['id_materia_por_periodo'] ?>; 
											  		var nombre="ui<?php echo $keyr['id_materia_por_periodo']  ?>";
											  		var notar=<?php echo $keyr['nota']  ?>;
											  		var ui=<?php echo $_POST['id'] ?>;
											  		var maximo=<?php echo $_SESSION['maximo'] ?>;
											  		var minimo=<?php echo $_SESSION['minimo'] ?>;
											  		var codigo="<?php echo $codigo ?>";
											  		var area=<?php echo $area ?>;
											  		var periodo=<?php echo $keyr['periodo'] ?>;
									  				myfun(minimo,maximo,ui,id_nota,notar,nombre,nota,area,codigo,periodo);'>
									  	</td> <?php	
									}	else{
											$string1 = "".$keyr['nota']."";
										    $t1=strlen($string1);
										    if ($t1>2) {
										    $yut=$string1[0].$string1[1].$string1[2];
										    }if ($t1==1){ 
												$yut=$string1[0];
											}
											if ($t1==2){ 
												$yut=$string1[0].$string1[1];
											}
											?>
											<td style="padding:11px;">  <a  data-title="no puede actualizar la nota ya que el docente tiene notas registradas"  data-title="mostrar documento">
										 		<input type="" value="<?php echo $yut  ?>" TABINDEX="<?php  echo $con.'0'  ?>" name="ui<?php echo $keyr['id_materia_por_periodo']  ?>" style="width: 60px;  " id='ui<?php echo $keyr['id_materia_por_periodo']  ?>' on >
										 	</a>
										  	</td> <?php	
									}
							 
							} ?> 
					    </tr><?php 
					}else{ ?>
						<tr style="background-color: #bbe3f299">
					          <td style=" <?php echo $_POST['style'] ?> "><?php echo ucwords($value['nombre_materia']) ?></td>
					        <?php 
					        $SELECT1="SELECT  nota,id_materia_por_periodo ,periodo FROM materia_por_periodo WHERE nombre_materia='".$value['nombre_materia']."'    and id_informe_academico=".$_POST['id']." and area='".$value['area']."'   order by periodo " ;
							$SELECT1=$conexion->prepare($SELECT1);
							$SELECT1->execute(array());$con=0;
							foreach ($SELECT1 as $keyr ) { 
								$con=$con+1; 	 
									$string1 = "".$keyr['nota']."";
								    $t1=strlen($string1);
								    if ($t1>2) {
								    $yut=$string1[0].$string1[1].$string1[2];
								    }if ($t1==1){ 
										$yut=$string1[0];
									}
									if ($t1==2){ 
										$yut=$string1[0].$string1[1];
									}
							 		?>
								 	<td>  
								 		<input type="" value="<?php echo $yut  ?>" style="width: 60px;" disabled >
								  	</td> <?php 
							} ?> 
					    </tr<?php 
					}
				} ?> 
	 	</table>
	</div>

 	<?php
}

function consultar_curso_por_periodo(){
	include '../../conexion.php';
    $ano=date('Y');
    session_start();
 
    $SELECT="SELECT nombre FROM periodo order by numero";
	$SELECT=$conexion->prepare($SELECT);
	$SELECT->execute(array()); 


    $consultar_nivel="SELECT alumnos.genero,alumnos.nombre,alumnos.apellido,alumnos.foto,informeacademico.id_informe_academico ,informeacademico.fecha_desercion,informeacademico.fecha_retiro from alumnos,informeacademico, (SELECT grado_sede.id_jornada_sede,grado_sede.id_grado,grado_sede.id_curso from grado_sede WHERE grado_sede.id=".$_POST['id'].")as Ky WHERE informeacademico.id_alumno=alumnos.id_alumnos and informeacademico.id_curso=ky.id_curso and informeacademico.id_jornada_sede=ky.id_jornada_sede and informeacademico.ano='$ano' and informeacademico.id_grado=ky.id_grado order by alumnos.apellido";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registrow=$consultar_nivel1->rowCount();
	if ($registrow) {
	    ?>  
	    <div class="table-responsive">   
	    	<table class="table table-hover">         
	    		<tr>
	    			<th width=" ">id</th>             
	    			<th width="200" style="padding-left: 44px;padding-right: 44px; text-align: center;">
	    			Foto</th>
	    			<th width=" ">Nombres</th>        
	    			<th width=" ">Apellidos</th>  
	    			<th>Estado</th>           
	    			<th width=" ">Observar</th>         
	    		</tr>
	    		<?php $contw=0;
				foreach ($consultar_nivel1 as $key  ) { $contw=$contw+1;
				?>
				<tr> <td><br><?php echo $contw ?></td>
					<td><center><img style="padding: 3px" class="profile-user-img img-responsive img-circle"  width="60px" src="<?php 
							if($key['foto']=='' && $key['genero']!=1){
								echo '../../../logos/niño.jpg';
							}if($key['foto']=='' && $key['genero']==1){
								echo '../../../logos/niña.jpg';
							}if($key['foto']!=''){
								echo $key['foto'];
							} ?>"></center></td>
					<td><br><?php echo $key['nombre']  ?></td>
					<td><br><?php echo  $key['apellido']; ?></td>
					<td  style="    padding-top: 22px;"> 
		                <?php 
		                $s=1;
		                if ($key['fecha_desercion']!='0000-00-00') { 
		                	echo'<span class="btn btn-danger ">Desertor</span>';
		                	$s=0;
		                }
		                if ($key['fecha_retiro']!='0000-00-00') { 
		                	echo'<span class="btn btn-warning ">Retirado</span>';
		                	$s=0;
		                }
		                if (($key['fecha_retiro']=='0000-00-00') && ($key['fecha_retiro']=='0000-00-00')) {
		                	echo'<span class="btn btn-info">Cursando</span>';
		                }

		                ?>
		            </td>

			<td>
	 



				<a href="#"   data-toggle="modal" data-target="#mymodal" onclick="      var id=<?php echo $key['id_informe_academico'] ;?> ;funcion(id) "><img style="width: 54px;height: 54px" src="data:image/svg+xml;base64,&#10;        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==">
			</td>
	  <!-- Modal -->

	 
			 	</tr><?php

			 } ?>
		</table></div>
	<?php
	}else{
		?>
		<div id="www" class="callout callout-info" style="margin: 20px; display: block;">
			<h4>información:</h4>
			actualmente este curso no tiene alumnos. 
        </div>

		<?php
	}
}





function buscar_estudiante_notas_por_saberes(){
	include '../../conexion.php';
    $ano=date('Y');
    $consultar_nivel=" 

SELECT g.sede,g.jornada,g.grado,g.curso,alumnos.genero,alumnos.nombre,alumnos.apellido,alumnos.foto,informeacademico.id_informe_academico,informeacademico.id_grado,informeacademico.id_jornada_sede,informeacademico.id_curso,informeacademico.ano,informeacademico.fecha_desercion,informeacademico.fecha_retiro from alumnos,informeacademico,(SELECT grado_sede.id_jornada_sede,grado_sede.id_grado,grado_sede.id_curso, grado.nombre as grado,sede.NOMBRE as sede,curso.numero as curso,jornada.NOMBRE as jornada FROM grado,sede,jornada,curso,grado_sede,jornada_sede WHERE grado_sede.id_grado=grado.id_grado AND grado_sede.id_curso=curso.id_curso AND grado_sede.id_jornada_sede=jornada_sede.ID_JS and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA )as g WHERE informeacademico.id_alumno=alumnos.id_alumnos and alumnos.apellido like('%".$_POST['ape']."%') and informeacademico.ano='$ano' and g.id_jornada_sede=informeacademico.id_jornada_sede and g.id_grado=informeacademico.id_grado and g.id_curso=informeacademico.id_curso

order by alumnos.apellido
     "; 
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registrow=$consultar_nivel1->rowCount(); 
	if ($registrow>0) {  
	 

	 	$cat="SELECT numero FROM periodo     ORDER BY periodo.numero";
	    $cat1=$conexion->prepare($cat);
	    $cat1->execute(array()); 
	    $con2=$cat1->fetchAll();
	    
		 

	    ?>   
			<style type="text/css">
			    	tr:hover{
			    		border: solid 2px #b7b7b7;
			    	}
		    	</style>
		    	<div style="padding-left: 10px;padding-top: 6px">
		    	
		    	
		    <strong>Lista de estudiantes</strong><br>
		    Seleccione el estudiante y el periodo que desea ver sus calificaciones. Tenga en cuenta que las recuperaciones solo se pueden ver si esta habilitado por el sistema. <br>
		    </div><br> 
	     <div class="table-responsive" style="padding: 10px"> 
			<table class="table  table-hover ">
		            	<tr>
		            		<th width="">id</th>             
		            		<th width="" style="padding-right: 40px;padding-left: 40px " >Foto</th>
							<th width="">Nombre completo</th>             
							<th width="">Sede</th>             
							<th width="">Jornada</th>             
							<th width="">Curso</th> 
							<th>Estado</th>            
							<th  width="">Mostrar</th>         </tr>

				<?php $contw=0;
				foreach ($consultar_nivel1 as $key  ) {
					$contw=$contw+1;
					?>
					<tr> <td><br><?php echo $contw ?></td>
						<td><center><img style="padding: 3px" class="profile-user-img img-responsive img-circle"  width="60px" src="<?php 
							if($key['foto']=='' && $key['genero']!=1){
								echo '../../../logos/niño.jpg';
							}if($key['foto']=='' && $key['genero']==1){
								echo '../../../logos/niña.jpg';
							}if($key['foto']!=''){
								echo $key['foto'];
							} ?>"></center></td>
						<td><br><?php echo $key['nombre'].' '.$key['apellido']; ?></td>
						<td><br><?php echo $key['sede']?></td>
						<td><br><?php echo $key['jornada'] ?></td>
						<td><br><?php echo $key['grado'] ?> <?php echo $key['curso'] ?></td>
						<td><br>
			                <?php 
			                $s=1;
			                if ($key['fecha_desercion']!='0000-00-00') { 
			                	echo'<span class="btn btn-danger ">Desertor</span>';
			                	$s=0;
			                }
			                if ($key['fecha_retiro']!='0000-00-00') { 
			                	echo'<span class="btn btn-warning ">Retirado</span>';
			                	$s=0;
			                }
			                if (($key['fecha_retiro']=='0000-00-00') && ($key['fecha_retiro']=='0000-00-00')) {
			                	echo'<span class="btn btn-primary">Cursando</span>';
			                }

			                ?>
			            </td>

		   				<td><br> <?php 
		   					foreach ($con2 as  $value) { 
		   						if($s==1){
		   						 	?>
		   						 	<a class="btn btn-info" href="notas_por_saberes2.php?genero=<?php echo($key['genero']); ?>&&id=<?php echo($key['id_informe_academico']); ?>&&nombre=<?php echo($key['nombre']); ?>&&apellido=<?php echo $key['apellido'] ; ?>&&foto=<?php echo($key['foto']); ?>&&id_grado=<?php echo($key['id_grado']); ?>&&id_curso=<?php echo $key['id_curso'] ; ?>&&id_jornada_sede=<?php echo $key['id_jornada_sede'] ; ?> &&numero=<?php echo $value['numero']; ?>" target="_blank">P<?php echo $value['numero']  ?></a>
		   						
				             	<?php
				             	}else{
				             		?>
		   						 	<a class="btn btn-info"  >P<?php echo $value['numero']  ?></a>
		   						
				             	<?php
				             	}
				            } ?>
				        </td>
				    </tr><?php

				} ?>
			</table>
		</div>
		<?php
	}else{
		?>
		<div id="www" class="callout callout-info" style="margin: 20px; display: block;">
			<h4>información:</h4>
			No se encuentran alumnos registrados. 
        </div>
		<?php
	}
}


















function consultar_notas_por_saberes(){
	include '../../conexion.php';
    $ano=date('Y');
 	$porcion=explode(' ', $_POST['id'] );
	$id_grado=$porcion[1];
	$id_curso=$porcion[0]; 
	$id_jornada_sede=$_POST['idjs'];


    $consultar_nivel="SELECT alumnos.genero,alumnos.nombre,alumnos.apellido,alumnos.foto,informeacademico.id_informe_academico,informeacademico.fecha_desercion,informeacademico.fecha_retiro  from alumnos,informeacademico WHERE informeacademico.id_alumno=alumnos.id_alumnos and   informeacademico.id_curso=$id_curso  and  informeacademico.id_jornada_sede=$id_jornada_sede  and  informeacademico.ano='$ano'  and informeacademico.id_grado=$id_grado order by alumnos.apellido    ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registrow=$consultar_nivel1->rowCount(); 
	if ($registrow>0) {  
	    ?>
	    <div style="padding-left: 10px;padding-top: 6px">
	    	
	    	
	    <strong>Lista de estudiantes</strong><br>
	    Seleccione el estudiante y el periodo que desea ver sus calificaciones. Tenga en cuenta que las recuperaciones solo se pueden ver si esta habilitado por el sistema. <br>
	    </div>
	    <div class="table-responsive" style="padding: 10px"> 
	    	<style type="text/css">
		    	tr:hover{
		    		border: solid 2px #b7b7b7;
		    	}
	    	</style>
	    	<center>
	    		<table class="table table-hover">         
	    			<tr>
	    				<th  >id</th>             
	    				<th   style="padding-left: 40px;padding-right: 40px">
	    					Foto
	    				</th>
	    				<th  style="padding-left: 40px;padding-right: 40px">Nombre  </th>             
	    				<th  >Estado</th>              
	    				<th  >Mostrar</th>         
	    			</tr>

					<?php $contw=0;
					foreach ($consultar_nivel1 as $key  ) {
						$contw=$contw+1;
						?>
						<tr> 
							<td><br><?php echo $contw ?></td>

							<td><center><img style="padding: 3px" class="profile-user-img img-responsive img-circle" width="60px" src="<?php 
							if($key['foto']=='' && $key['genero']==0){
									echo '../../../logos/niño.jpg';
								}
							if($key['foto']=='' && $key['genero']==''){
									echo '../../../logos/niño.jpg';
								}if($key['foto']=='' && $key['genero']==1){
									echo '../../../logos/niña.jpg';
								}if($key['foto']!='' ){
									echo $key['foto'];
								} ?>"></center></td>
							<td><br><?php echo $key['nombre'].' '.$key['apellido']; ?></td>
							<td><br>
				                <?php 

				                if ($key['fecha_desercion']!='0000-00-00') { 
				                	echo'<span class="btn btn-danger ">Desertor</span>';
				                }
				                if ($key['fecha_retiro']!='0000-00-00') { 
				                	echo'<span class="btn btn-warning ">Retirado</span>';
				                }
				                if (($key['fecha_retiro']=='0000-00-00') && ($key['fecha_retiro']=='0000-00-00')) {
				                	echo'<span class="btn btn-primary">Cursando</span>';
				                }

				                ?>
				            </td>
							<td><br>
								<?php 
								$cat="SELECT numero FROM periodo       ORDER BY periodo.numero";
					            $cat1=$conexion->prepare($cat);
					            $cat1->execute(array()); 
					            foreach ($cat1 as  $value) {
					             	?>
					          		<a class="btn btn-info" href="notas_por_saberes2.php?id=<?php echo($key['id_informe_academico']); ?>&&nombre=<?php echo($key['nombre']); ?>&&genero=<?php echo $key['genero'] ?>&&apellido=<?php echo($key['apellido']); ?>&&foto=<?php echo($key['foto']); ?>&&id_grado=<?php echo($id_grado); ?>&&id_curso=<?php echo($id_curso); ?>&&id_jornada_sede=<?php echo($id_jornada_sede); ?>&&numero=<?php echo $value['numero'] ?>" target="_blank">P<?php echo $value['numero']  ?></a>
					             	<?php
					            } ?>
							</td>
						</tr><?php

					} ?>
				</table>
	    	</center>
	    </div> <?php
	}else{
		?>
		<div id="www" class="callout callout-info" style="margin: 20px; display: block;">
			<h4>información:</h4>
			actualmente este curso no tiene alumnos. 
        </div><br><?php
	}
}

function materias_periodo_por_saberes(){
	include '../../conexion.php';
	  
 
    

  session_start();
  	

    $tipo_calificaionesr="SELECT desde FROM escala_academica WHERE escala_academica.mini=1";
	$tipo_calificaionesr=$conexion->prepare($tipo_calificaionesr);
    $tipo_calificaionesr->execute(array()); 
    foreach ($tipo_calificaionesr as  $valuer) {
    	$lim=$valuer['desde'];
    }  

    $tipo_calificaiones="SELECT nombre,id_tipo_calificaciones,porceentajes FROM tipo_calificaiones order by numero";
	$tipo_calificaiones=$conexion->prepare($tipo_calificaiones);
    $tipo_calificaiones->execute(array());
     $con2=$tipo_calificaiones->fetchAll();
  	
  	$peri="SELECT periodo.activar_recuperacion   FROM `periodo`  WHERE numero=".$_POST['numero'];
	$peri=$conexion->prepare($peri);
    $peri->execute(array()); 
    foreach ($peri as  $value) {
    	$num=$value['activar_recuperacion'];
    }

    

    ?>
    <style type="text/css">
    	tr:hover{
    		border:solid 2px #CBC6C6;
    	}
    </style>
 	<div class="table-responsive" style="padding: 10px">
		<div id="_MSG_"></div>
		<button type="button" class="btn btn-info" onclick="document.getElementById('blin1').style.display='block';document.getElementById('blin2').style.display='none';"> Academico </button>
		<button type="button" class="btn btn-danger" onclick="document.getElementById('blin2').style.display='block';document.getElementById('blin1').style.display='none';"> Tecnico </button><br><br>



		<!--  div tecnico   --->
		<div id="blin2" style="display: none">
			<table class="table table-hover">
				<tr>
					<th style="padding: 10px">Competencias</th>
					<?php foreach ($con2 as $value) {
					?>
					<th  ><?php echo $value['nombre'].' ' .$value['porceentajes']; ?>%</th><?php
					} ?>
					<th >Definitivas</th>
				</tr>
				<?php 
				$materias="SELECT tecnologia.id_tecnologia,  tecnologia.competencia,tecnologia.nota,tecnologia.recuperacion,tecnologia.trabajo,tecnologia.sustentacion from tecnologia WHERE tecnologia.id_periodo='".$_POST['numero']."'   and tecnologia.id_informe_academico= '".$_POST['id']."'   ORDER by  tecnologia.id_tecnologia";
				$materias=$conexion->prepare($materias);
		    	$materias->execute(array()); 
	     
				foreach ($materias as $kematerias) { 
					$r='';
					 
					?>
					<tr <?php echo($r) ?>>
						<td style="padding: 10px"><?php echo   $kematerias['competencia']; ?></td>
						<?php 
						 
						
					     //foreache  de tipo de notas
					    foreach ($con2 as $value1) {
					      	$dfd="SELECT tecnica_por_paso.nota,tecnica_por_paso.id_tecnica_por_paso   from  tecnica_por_paso,nota_tecnologica_independiente  WHERE tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente  AND tecnica_por_paso.id_tecnologia= '".$kematerias['id_tecnologia']."' and  nota_tecnologica_independiente.id_tipo_calificaciones='".$value1['id_tipo_calificaciones']."' "; 
					      	$rtdfd=$dfd;
						    $dfd=$conexion->prepare($dfd);
						    $dfd->execute(array());
						    ?> <td  ><?php
						    //foreache de materias por paso
						    foreach ($dfd as $kdfdue) {  ?>   

						    	<input type="text" value="<?php echo $kdfdue['nota'] ?>" id='ident<?php echo $kdfdue["id_tecnica_por_paso"] ?>' style='width: 26px; 
								  '   onchange="
								  
								   var nota =document.getElementById('ident<?php echo $kdfdue["id_tecnica_por_paso"] ?>').value; 
								   var id=<?php echo $kdfdue["id_tecnica_por_paso"] ?>;
								   var id_tecnologia=<?php echo $kematerias['id_tecnologia'] ?>;
								   var id_tecnologia=<?php echo  $kdfdue['nota'] ?>;

								   inserto2(id_tecnologia,id,nota,valor);
								  "> 
						    	<?php
						    } 
						    echo '</td>';
						} 
			 
						//td de notas degfinitivas ?>
 

						<td id="definitiva<?php echo $kematerias['id_tecnologia'] ?>">  
                                   <?php echo $kematerias['nota'] ?>
                                </td>

						<?php  
						//pregunta si esta habilitado la recuperacion
						if ($num==1) { ?>

						 
							<?php 
							//saca la recuperacion del periodo
							if ( $kematerias['area']==1 && $kematerias['codigo']!=01 ) {
						?><td></td><td></td>
									<td id="recuperacion<?php echo $kematerias['id_materia_por_periodo'] ?>"> 
										<?php 
										$string = "".$kematerias['recuperacion']."";
										$t=strlen($string);
										if ($t>2) {
										   $hu=$string[0].$string[1].$string[2];
										}if ($t==1){ 
											$hu=$string[0];
										}
										if ($t==2){ 
											$hu=$string[0].$string[1];
										}   echo $hu ?> </td><?php 
							} else{
								if ($kematerias['nota']<$lim) {
								 	# code...
								 ?> 
									<td>
									<input type="text" value="<?php echo $r=$kematerias['trabajo']+0; ?>" id='trabajo<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>' style='width: 26px; 
										   '   onchange="
										  var qw='trabajo<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>';
										  var valor=<?php echo $kematerias['trabajo'] ?>;
									  		var maximo=<?php echo $_SESSION['maximo'] ?>;
									  		var minimo=<?php echo $_SESSION['minimo'] ?>;
										  var codigo=<?php echo $kematerias['codigo'] ?>;
										  var area=<?php echo $kematerias['area'] ?>; 
										   var nota =document.getElementById('trabajo<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>').value;
										   var id=<?php echo $kematerias["id_materia_por_periodo"]?>;
										   var campo='trabajo';
										   funtines(campo,area,codigo,maximo,minimo,id,nota,qw,valor);
										  "></td><td>
									<input type="text" value="<?php echo $kematerias['sustentacion']+0 ?>" id='sustentacion<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>' style='width: 26px; 
										   '   onchange="
										  var qw='sustentacion<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>';
										  var valor=<?php echo $kematerias['sustentacion'] ?>;
									  		var maximo=<?php echo $_SESSION['maximo'] ?>;
									  		var minimo=<?php echo $_SESSION['minimo'] ?>;
										  var codigo=<?php echo $kematerias['codigo'] ?>;
										  var area=<?php echo $kematerias['area'] ?>; 
										  var campo='sustentacion';
										   var nota =document.getElementById('sustentacion<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>').value;
										   var id=<?php echo $kematerias["id_materia_por_periodo"]?>;
										   funtines(campo,area,codigo,maximo,minimo,id,nota,qw,valor);
										  "></td><td id="recuperacion<?php echo $kematerias['id_materia_por_periodo'] ?>"> <?php 	$string = "".$kematerias['recuperacion']."";
										$t=strlen($string);
										if ($t>2) {
										   $hu=$string[0].$string[1].$string[2];
										}if ($t==1){ 
											$hu=$string[0];
										}
										if ($t==2){ 
											$hu=$string[0].$string[1];
										}   echo $hu  ?> </td><?php 
								}else{  
									?>
									 <?php 
								} }?>
					 
					<?php }
				 			    ?>

					</tr>
					<?php
				} ?>
			</table>
		</div>
		<!--  div tecnico terminación   --->



		<!--  div academico   --->
		<div id="blin1">
			<table class="table table-hover"  >
				<tr>
					<th style="padding: 10px">Materias</th>
					<?php foreach ($con2 as $value) {
					?>
					<th  ><?php echo $value['nombre'].' ' .$value['porceentajes']; ?>%</th><?php
					} ?>
					<th >Definitivas</th>
					<?php if ($num==1) {
						# code...
					?>
					<th >Trabajo</th>
					<th >Sustentacion</th>
					<th >Recuperacion</th>
					<?php } ?>

				</tr>
				<?php 
				   $materias="SELECT materia_por_periodo.area,materia_por_periodo.codigo,materia_por_periodo.recuperacion,materia_por_periodo.nota,materia_por_periodo.trabajo,materia_por_periodo.sustentacion, materia_por_periodo.id_materia_por_periodo,  materia_por_periodo.nombre_materia from materia_por_periodo WHERE  materia_por_periodo.periodo='".$_POST['numero']."' and materia_por_periodo.id_informe_academico=".$_POST['id']."  order by materia_por_periodo.id_materia_por_periodo";
				$materias=$conexion->prepare($materias);
		    	$materias->execute(array()); 
	     
				foreach ($materias as $kematerias) { 
					$r='';
					if ( $kematerias['area']==1) {
						$r='style=" background-color: #d5e8f4"';
					}else{$r='';}
					?>
					<tr <?php echo($r) ?>>
						<td style="padding: 10px"><?php echo   $kematerias['nombre_materia']; ?></td>
						<?php 
						 
						
					     //foreache  de tipo de notas
					     foreach ($con2 as $value1) {
					      	$dfd="SELECT materia_por_paso.id_materia_por_paso,materia_por_paso.nota from materia_por_paso,nota_independiente WHERE  materia_por_paso.id_materia_por_periodo='".$kematerias['id_materia_por_periodo']."'  and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente   and nota_independiente.id_tipo_calificacion='".$value1['id_tipo_calificaciones']."'   "; 
					      	$rtdfd=$dfd;
						    $dfd=$conexion->prepare($dfd);
						    $dfd->execute(array());
						    ?> <td  ><?php
						    //foreache de materias por paso
						    foreach ($dfd as $kdfdue) {  ?>   

						    	<input type="text" value="<?php echo $kdfdue['nota'] ?>" id='ident<?php echo $kdfdue["id_materia_por_paso"] ?>' style='width: 26px; 
								  '   onchange="var area=<?php echo $kematerias["area"] ?>;var codigo=<?php echo $kematerias["codigo"] ?>; var qw=<?php echo $kdfdue["id_materia_por_paso"] ?>;
								  var valor=<?php echo $kdfdue['nota'] ?>;
									  		var maximo=<?php echo $_SESSION['maximo'] ?>;
									  		var minimo=<?php echo $_SESSION['minimo'] ?>;
								  var id_materia_por_periodo=<?php echo $kematerias['id_materia_por_periodo'] ?>;
								var numero=<?php echo   $_POST['numero']?>;
								   var nota =document.getElementById('ident<?php echo $kdfdue["id_materia_por_paso"] ?>').value; 
								   var id=<?php echo $kdfdue["id_materia_por_paso"] ?>;

								   funtin(numero,id_materia_por_periodo,maximo,minimo,area,codigo,id,nota,qw,valor);
								  "> 
						    	<?php
						    } 
						    echo '</td>';
						} 
			 
						//td de notas degfinitivas ?>

						<td id="fgt<?php echo $kematerias['id_materia_por_periodo'] ?>">
						 	 <?php echo $kematerias['nota'] ?>
						</td>

						<?php  
						//pregunta si esta habilitado la recuperacion
						if ($num==1) { ?>

						 
							<?php 
							//saca la recuperacion del periodo
							if ( $kematerias['area']==1 && $kematerias['codigo']!=01 ) {
						?><td></td><td></td>
									<td id="recuperacion<?php echo $kematerias['id_materia_por_periodo'] ?>"> 
										<?php 
										$string = "".$kematerias['recuperacion']."";
										$t=strlen($string);
										if ($t>2) {
										   $hu=$string[0].$string[1].$string[2];
										}if ($t==1){ 
											$hu=$string[0];
										}
										if ($t==2){ 
											$hu=$string[0].$string[1];
										}   echo $hu ?> </td><?php 
							} else{
								if ($kematerias['nota']<$lim) {
								 	# code...
								 ?> 
									<td>
									<input type="text" value="<?php echo $r=$kematerias['trabajo']+0; ?>" id='trabajo<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>' style='width: 26px; 
										   '   onchange="
										  var qw='trabajo<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>';
										  var valor=<?php echo $kematerias['trabajo'] ?>;
									  		var maximo=<?php echo $_SESSION['maximo'] ?>;
									  		var minimo=<?php echo $_SESSION['minimo'] ?>;
										  var codigo=<?php echo $kematerias['codigo'] ?>;
										  var area=<?php echo $kematerias['area'] ?>; 
										   var nota =document.getElementById('trabajo<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>').value;
										   var id=<?php echo $kematerias["id_materia_por_periodo"]?>;
										   var campo='trabajo';
										   funtines(campo,area,codigo,maximo,minimo,id,nota,qw,valor);
										  "></td><td>
									<input type="text" value="<?php echo $kematerias['sustentacion']+0 ?>" id='sustentacion<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>' style='width: 26px; 
										   '   onchange="
										  var qw='sustentacion<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>';
										  var valor=<?php echo $kematerias['sustentacion'] ?>;
									  		var maximo=<?php echo $_SESSION['maximo'] ?>;
									  		var minimo=<?php echo $_SESSION['minimo'] ?>;
										  var codigo=<?php echo $kematerias['codigo'] ?>;
										  var area=<?php echo $kematerias['area'] ?>; 
										  var campo='sustentacion';
										   var nota =document.getElementById('sustentacion<?php echo $kematerias["id_materia_por_periodo"]."gt" ?>').value;
										   var id=<?php echo $kematerias["id_materia_por_periodo"]?>;
										   funtines(campo,area,codigo,maximo,minimo,id,nota,qw,valor);
										  "></td><td id="recuperacion<?php echo $kematerias['id_materia_por_periodo'] ?>"> <?php 	$string = "".$kematerias['recuperacion']."";
										$t=strlen($string);
										if ($t>2) {
										   $hu=$string[0].$string[1].$string[2];
										}if ($t==1){ 
											$hu=$string[0];
										}
										if ($t==2){ 
											$hu=$string[0].$string[1];
										}   echo $hu  ?> </td><?php 
								}else{  
									?>
									 <?php 
								} }?>
					 
					<?php }
				 			    ?>

					</tr>
					<?php
				}
					?>
			 
			</table> 
		</div>
	</div>
	<div id="sapito"></div>
<script type="text/javascript">


        function  inserto2(id_tecnologia,id,nota,valor) { 
            var maximo =<?php echo $_SESSION["maximo2"] ?>;
            var minimo =<?php  echo $_SESSION["minimo2"]; ?>;
            var periodo = <?php echo $_POST['p'] ?>;   
            var n = nota.length;
            if(decimaa(nota)){
                if(ESnombre1(nota)){
                    document.getElementById("ident"+id).value=valor; 
                    $('#ph').html('! Solo permite numeros deacuerdo a lo estipulado por la institucion');
                    document.getElementById("iss").click(); 
                    return;
                } 
                if(decimaa1(nota)){ 
                    document.getElementById("ident"+id).value=valor; 

                    $('#ph').html('! Los numeros decimales  no utilizan coma sino punto');
                    document.getElementById("iss").click(); 
                    return;
                }else{ 
                   
                 document.getElementById("ident"+id).value=valor; 

                    $('#ph').html('! El numero esta mal escrito');
                    document.getElementById("iss").click();
                    return;
                } 
            }if(ESnombre1(nota)){ 
                document.getElementById("ident"+id).value=valor; 
                   $('#ph').html('! solo permite numeros deacuerdo a lo estipulado por la institucion ');
                    document.getElementById("iss").click(); 
                    return;
            }if((decimaa2(nota)==true) && n>3){
                if(nota>maximo){ 
                    document.getElementById("ident"+id).value=valor; 
                    $('#ph').html('! recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
                    document.getElementById("iss").click();
                    return;
                }else{  
                    document.getElementById("ident"+id).value=valor; 
                    $('#ph').html('! solo soporta un umero antes del punto');
                    document.getElementById("iss").click();
                    return;
                }
            }
            if(nota<minimo){ 
                document.getElementById("ident"+id).value=valor; 
                $('#ph').html('!recordamos que la nota mas baja es <?php  echo $_SESSION["minimo"]; ?>');
                    document.getElementById("iss").click();
                return;
            }
            if(nota>maximo){ 
                document.getElementById("ident"+id).value=valor; 
                $('#ph').html('!recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
                    document.getElementById("iss").click();
                return;
            }else{ 
                $.ajax({  

                    type: "post",
                    url:"../../../ajax/rector/notas/notas.php?action=actualizar_nota2",
                    data:{id,nota,periodo,id_tecnologia},
                    dataType:"text", 
                    success:function(data){  
        
                            $('#sapo').html(data); 
                        $.ajax({  
                        type: "post",
                        url:"../../../ajax/rector/notas/notas.php?action=definitiva2",
                        data:{id_tecnologia},    dataType:"text",
                        success:function(data){  
                            $('#definitiva'+id_tecnologia).html(data); 

                        }  
                        });
                    }  
                });   
            }
        }





		    function funtin(numero,id_materia_por_periodo,maximo,minimo,area,codigo,id,nota,qw,valor){
      var periodo = <?php echo $_POST['numero'] ?>;   
       var n = nota.length;
           if(decimaa(nota)){
            if(ESnombre1(nota)){
            mensaje(2,'Solo permite numeros deacuerdo a lo estipulado por la institucion '); 
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;
          } 
            if(decimaa1(nota)){
            mensaje(2,'Los numeros decimales  no utilizan coma sino punto'); 
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;
          }  else{ 
            mensaje(2,' El numero esta mal escrito ');
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
         
            return;}
          } if(ESnombre1(nota)){
            mensaje(2,'solo permite numeros deacuerdo a lo estipulado por la institucion ');
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;
          }if((decimaa2(nota)==true) && n>3){ if(nota>maximo){
            mensaje(2,'la nota es mas alta que la estipulada por la institucion ');
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;
          }else{ 
            mensaje(2,'solo soporta un umero antes del punto ');
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;}
          }
          if(nota<minimo){
            mensaje(2,'La nota es mas baja que la estipulada por la institucion  ');
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;
          }
          if(nota>maximo){
            mensaje(2,'la nota es mas alta que la estipulada por la institucion ');
            document.getElementById('ident'+qw).focus(); 
            document.getElementById('ident'+qw).value=valor; 
            return;
          }




          else{ 
      $.ajax({  

        type: "post",
        url:"../../../ajax/rector/notas/notas.php?action=actualizar_nota",

        data:{area,id_materia_por_periodo,codigo,id,nota,periodo},    dataType:"text", 

        success:function(data){   
        $('#sapito').html(data);   
      	     $.ajax({  

					        type: "post",
					        url:"../../../ajax/rector/notas/notas.php?action=mostrari",

					        data:{id_materia_por_periodo},    dataType:"json", 

					        success:function(gg){  
					          $('#fgt'+id_materia_por_periodo).html(gg[0]); 
					          $('#fgt'+gg[2]).html(gg[1]); 
					         
					   		}  
					   	}); 
        }  
      });   
    }
}
</script>


<?php



}
function definitiva(){
	
 include '../../conexion.php';

	$materia_por_periodo="SELECT  materia_por_periodo.nota  FROM   materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo= ".$_POST['id_materia_por_periodo'];
	$materia_por_periodo=$conexion->prepare($materia_por_periodo);
	$materia_por_periodo->execute(array());
	foreach ($materia_por_periodo as $value) {
		$hu = number_format($value['nota'], 1, '.', ''); 
		echo$hu;
	}
}
function definitiva2(){
	
 include '../../conexion.php';

	$materia_por_periodo="SELECT  tecnologia.nota  FROM   tecnologia WHERE tecnologia.id_tecnologia= ".$_POST['id_tecnologia'];
				$materia_por_periodo=$conexion->prepare($materia_por_periodo);
			    $materia_por_periodo->execute(array());
			    foreach ($materia_por_periodo as $value) {
  $y=$value['nota'];
			    	 }
			    	   $string = "".$y."";
		    $t=strlen($string);
		    if ($t>2) {
		    $hu=$string[0].$string[1].$string[2];
		    }if ($t==1){ 
				$hu=$string[0];
			}
			if ($t==2){ 
				$hu=$string[0].$string[1];
			}
	 echo$hu;
		
}
function recuperacion(){
	
 	include '../../conexion.php';

	$materia_por_periodo="SELECT  materia_por_periodo.recuperacion  FROM   materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo= ".$_POST['id_materia_por_periodo'];
	$materia_por_periodo=$conexion->prepare($materia_por_periodo);
    $materia_por_periodo->execute(array());
	foreach ($materia_por_periodo as $value) {
  		$y=$value['recuperacion'];
	}
	$string = "".$y."";
	$t=strlen($string);
		    if ($t>2) {
		    $hu=$string[0].$string[1].$string[2];
		    }if ($t==1){ 
				$hu=$string[0];
			}
			if ($t==2){ 
				$hu=$string[0].$string[1];
			}
	 echo $hu;
		
}
function actualizar_recuperacion(){
	include '../../conexion.php';
	$cont=0;
	$acum=0;
	

 

     $materia_por_periodoq=" 
    UPDATE `materia_por_periodo` SET `".$_POST['campo']."`  = '".$_POST['nota']."' WHERE `materia_por_periodo`.`id_materia_por_periodo` = ".$_POST['id'];
	$materia_por_periodoq=$conexion->prepare($materia_por_periodoq);
	$materia_por_periodoq->execute(array());
	$op=$_POST['id'];  
   
		
	 $opo=	 $materia_por_periodoq="UPDATE `materia_por_periodo` SET `recuperacion`=  (SELECT (materia_por_periodo.trabajo+materia_por_periodo.sustentacion)/2 as sustentado  FROM materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo='".$_POST['id']."')	WHERE `materia_por_periodo`.`id_materia_por_periodo` = ".$_POST['id'];
	$materia_por_periodoq=$conexion->prepare($materia_por_periodoq);
	$materia_por_periodoq->execute(array());
 
	if ($_POST['area']!=1  && $_POST['codigo']!=01  ) {
		$h=0;
		$nota=0;$rec=0;
		$tipo_calificaiones12="SELECT o.area,o.nota,o.id_materia_por_periodo,o.recuperacion ,escala_academica.desde from (SELECT materia_por_periodo.area,materia_por_periodo.nota, materia_por_periodo.id_materia_por_periodo,materia_por_periodo.recuperacion from materia_por_periodo,(SELECT materia_por_periodo.codigo, materia_por_periodo.id_informe_academico FROM materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo='".$_POST['id']."')as q WHERE q.id_informe_academico=materia_por_periodo.id_informe_academico and materia_por_periodo.periodo='".$_POST['periodo']."' and materia_por_periodo.codigo=q.codigo)as o ,escala_academica WHERE escala_academica.mini=1 ";
		$tipo_calificaiones12=$conexion->prepare($tipo_calificaiones12);
		$tipo_calificaiones12->execute(array()); 
		foreach ($tipo_calificaiones12 as   $value) {
			if ($value['area']==1) { 
				$id_materia_por_periodo= $value['id_materia_por_periodo'];

			 	$desde= $value['desde'];
				$nota22= $value['nota'];
			} 
			if ($value['area']==0 ) {
				 $rec=$value['recuperacion'];
				$nota= $nota+ $rec ;
				$h=$h+1;

				if ($value['id_materia_por_periodo']==$_POST['id']) {
					$vin=$value['recuperacion'];
				}
			}
		} 
		  $desde; 
		if ($nota22<$desde) { 
			$total=$nota/$h ;
			$tipo_calificaiones1="UPDATE `materia_por_periodo` SET `recuperacion` = '".$total."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_materia_por_periodo;
			$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
			$tipo_calificaiones1->execute(array());
		}


	 	$string = "".$vin."";
		$t=strlen($string);
		if ($t>2) {
		   $hu=$string[0].$string[1].$string[2];
		}if ($t==1){ 
			$hu=$string[0];
		}
		if ($t==2){ 
			$hu=$string[0].$string[1];
		}
		 echo ('<br>'.$hu);	
	}
	else{

		$tipo_calificaiones12=" SELECT materia_por_periodo.recuperacion  FROM materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo= ".$_POST['id'];
		$tipo_calificaiones12=$conexion->prepare($tipo_calificaiones12);
		$tipo_calificaiones12->execute(array()); 
		foreach ($tipo_calificaiones12 as   $value) {
			$totalw=$value['recuperacion'];
		}

	 	$string = "".$totalw."";
		$t=strlen($string);
		if ($t>2) {
		   $hu=$string[0].$string[1].$string[2];
		}if ($t==1){ 
			$hu=$string[0];
		}
		if ($t==2){ 
			$hu=$string[0].$string[1];
		}

		echo ('<br>'.$hu);
	}
}
function mostrari(){
	include '../../conexion.php';
	//consulta definitiva de asignatura
	$materia_por_periodo="SELECT   materia_por_periodo.nota FROM materia_por_periodo WHERE  materia_por_periodo.id_materia_por_periodo=".$_POST['id_materia_por_periodo'];
				$materia_por_periodo=$conexion->prepare($materia_por_periodo);
			    $materia_por_periodo->execute(array());
			    foreach ($materia_por_periodo as $value) {
			    	 $y=$value['nota'];

			    } 
		    $string = "".$y."";
		    $t=strlen($string);
		    if ($t>2) {
		    $hu=$string[0].$string[1].$string[2];
		    }if ($t==1){ 
				$hu=$string[0];
			}
			if ($t==2){ 
				$hu=$string[0].$string[1];
			}
	//consulta definitiva de area
			$y1=0;$y1w=0;
	  $materia_por_periodo1="
SELECT materia_por_periodo.nota,materia_por_periodo.id_materia_por_periodo from materia_por_periodo,(SELECT materia_por_periodo.periodo, materia_por_periodo.codigo,materia_por_periodo.id_informe_academico from materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo='".$_POST['id_materia_por_periodo']."' )as f WHERE materia_por_periodo.id_informe_academico=f.id_informe_academico AND materia_por_periodo.area=1 AND materia_por_periodo.codigo=f.codigo and materia_por_periodo.periodo=f.periodo ";
		$materia_por_periodo1=$conexion->prepare($materia_por_periodo1);
		$materia_por_periodo1->execute(array());
		foreach ($materia_por_periodo1 as $value1) {
			$y1=$value1['nota'];
			//con esta variable puede identificar  la nota del area
			$y1w=$value1['id_materia_por_periodo'];

		} 
		    $string1 = "".$y1."";
		    $t1=strlen($string1);
		    if ($t1>2) {
		    $hu1=$string1[0].$string1[1].$string1[2];
		    }if ($t1==1){ 
				$hu1=$string1[0];
			}
			if ($t1==2){ 
				$hu1=$string1[0].$string1[1];
			}
 
 
	  		    	   $t=array($hu,$hu1,$y1w);	echo json_encode($t);	   
	 
}


function actualizar_nota(){
	include '../../conexion.php';
	$id=$_POST['id'];
	$nota=$_POST['nota'];
	$acum1=0;
	$acum2=0;
	$acum3=0;
	$conta1=0;
	$conta2=0;
	$aux=0;
	$porceentajes=0;
	$i=0;

	date_default_timezone_set("America/Bogota");
	session_start(); 
	$fecha=date("Y-m-d");
	$hora=date("h:i:s");

		if ($_POST['area']==1 &&  $_POST['codigo']==1) {
	 
			$cont=0;$sum=0;
		 	  $tipo_calificaiones1="UPDATE `materia_por_paso` SET `nota` = '".$_POST['nota']."' WHERE `materia_por_paso`.`id_materia_por_paso` =". $_POST['id'].";INSERT INTO `seguimiento_notas_paso` (`rol`, `id_materia_por_paso`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$_POST['id']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');
			";
			$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
			$tipo_calificaiones1->execute(array()); 

                           
 			echo  $tipo_calificaiones1=" SELECT    SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$_POST['id_materia_por_periodo']."' and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero ";
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array()); 
            foreach ($tipo_calificaiones1 as  $value) {
            
                    $sum=$sum+$value['su'];
                

                 
            } 
            $tipo_calificaiones1="  UPDATE `materia_por_periodo` SET `nota` = '".$sum."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$_POST['id_materia_por_periodo']  ;
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array()); 			 
		}else{  
			$cont=0;$sum=0;
		 	  $tipo_calificaiones1="UPDATE `materia_por_paso` SET `nota` = '".$_POST['nota']."' WHERE `materia_por_paso`.`id_materia_por_paso` =". $_POST['id'].";INSERT INTO `seguimiento_notas_paso` (`rol`, `id_materia_por_paso`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$_POST['id']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');
			";
			$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
			$tipo_calificaiones1->execute(array()); 

 			  $tipo_calificaiones1="SELECT materia_por_periodo.area, materia_por_periodo.id_materia_por_periodo, SUM(DE.su) as nos, materia_por_periodo.nota FROM   (SELECT materia_por_periodo.id_informe_academico,  materia_por_periodo.codigo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$_POST['id_materia_por_periodo']."' and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero) AS DE,materia_por_periodo WHERE materia_por_periodo.periodo='".$_POST['periodo']."' AND materia_por_periodo.id_informe_academico=DE.id_informe_academico AND materia_por_periodo.codigo=DE.codigo GROUP by materia_por_periodo.id_materia_por_periodo";
                           
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array()); 
            foreach ($tipo_calificaiones1 as  $value) {
                if($value['id_materia_por_periodo']==$_POST['id_materia_por_periodo']){
                    $r1=$value['nos'];
                    $r2=$value['id_materia_por_periodo'];
                    $uno=1;
                }
                if ($value['area']==0 && $value['id_materia_por_periodo']!=$_POST['id_materia_por_periodo']) {
                    $cont=$cont+1;
                    $sum=$sum+$value['nota'];
                }

                if ($value['area']==1) {
                    $id_m=$value['id_materia_por_periodo'];
                }
            }
            $cont=$cont+$uno;
            $sum=$sum+$r1;
            $sum1=$sum/$cont    ;
            $tipo_calificaiones1="  UPDATE `materia_por_periodo` SET `nota` = '".$r1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$r2."; UPDATE `materia_por_periodo` SET `nota` = '".$sum1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_m ;
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array()); 			
		}

}


function actualizar_nota2(){
	include '../../conexion.php';
	$id=$_POST['id'];
	$nota=$_POST['nota'];
	$acum1=0;
	$acum2=0;
	$acum3=0;
	$conta1=0;
	$conta2=0;
	$aux=0;
	$porceentajes=0;
	$i=0;

	date_default_timezone_set("America/Bogota");
	session_start(); 
	$fecha=date("Y-m-d");
	$hora=date("h:i:s");

	 		
		 	 $tipo_calificaiones1="INSERT INTO `seguimiento_tecnica_por_paso` ( `rol`, `id_tecnica_por_paso`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$_POST['id']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');
			UPDATE `tecnica_por_paso` SET `nota` = '".$_POST['nota']."' WHERE `tecnica_por_paso`.`id_tecnica_por_paso` =". $_POST['id'];
			$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
			$tipo_calificaiones1->execute(array()); 

			     $tipo_calificaiones1="UPDATE `tecnologia` SET `nota` = (SELECT SUM(de.su)as f from (SELECT tecnica_por_paso.id_tecnologia, SUM(tecnica_por_paso.nota)/COUNT(tecnica_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM tipo_calificaiones, nota_tecnologica_independiente,tecnica_por_paso WHERE tecnica_por_paso.id_tecnologia='".$_POST['id_tecnologia']."' and tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and nota_tecnologica_independiente.id_tipo_calificaciones=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `tecnologia`.`id_tecnologia` =".$_POST['id_tecnologia'];
                $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                $tipo_calificaiones1->execute(array()); 
		 
		

}


function excel2(){


	include '../../conexion.php';
	include '../../../Classes/PHPExcel/IOFactory.php';
	$c = $_FILES['ex']; 

	$nombreArchivo=$c['tmp_name']; 

	$objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


	$NOTAAA = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();
	$patrones = array ('/[^0-9]/'); 
	$Periodo= preg_replace($patrones, '', $NOTAAA);
	$Periodo;
    
	$zx='';
	session_start();
	foreach ($_SESSION['id_periodo'] as   $value) { 
        if ($Periodo==$value) {
        	$zx=1;
        }
    }
    if ($Periodo==$_SESSION['numero']) {
        $zx=1;
    }

	date_default_timezone_set("America/Bogota");
	 
	$fecha=date("Y-m-d");
	$hora=date("h:i:s");
    if ($zx>0) { 

		for($i = 3; $i <= $numRows; $i++){

			$ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
			$NOTA = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();

		 	 

	 		
		 	$tipo_calificaione="INSERT INTO `seguimiento_tecnica_por_paso` ( `rol`, `id_tecnica_por_paso`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$ID."', '$fecha', '".$NOTA."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."');
			UPDATE `tecnica_por_paso` SET `nota` = '".$NOTA."' WHERE `tecnica_por_paso`.`id_tecnica_por_paso` =".$ID;
			$tipo_calificaione=$conexion->prepare($tipo_calificaione);
			$tipo_calificaione->execute(array()); 



			echo $tipo_calificaiones1="SELECT SUM(de.su)as f,de.id_tecnologia from (SELECT tecnica_por_paso.id_tecnologia, SUM(tecnica_por_paso.nota)/COUNT(tecnica_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM tipo_calificaiones, nota_tecnologica_independiente,tecnica_por_paso,tecnologia WHERE tecnologia.id_tecnologia=tecnica_por_paso.id_tecnologia and tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and nota_tecnologica_independiente.id_tipo_calificaciones=tipo_calificaiones.numero and tecnologia.id_tecnologia in (SELECT tecnica_por_paso.id_tecnologia from tecnica_por_paso WHERE tecnica_por_paso.id_tecnica_por_paso='$ID') GROUP by tipo_calificaiones.numero)as de";
			$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
			$tipo_calificaiones1->execute(array()); 
			$registrow=$tipo_calificaiones1->rowCount(); 
			if($registrow>0){

				$cont=0;
				$r1=0;
				$uno=0;
				$sum=0;
				$id_m=0;

				foreach ($tipo_calificaiones1 as  $value) {
					$nota=$value['f']; 
					$id_tecnologia=$value['id_tecnologia']; 
				 echo '<br><br>'.$tipo_calificaiones1q=" UPDATE `tecnologia` SET `nota` =  '".$nota."' WHERE tecnologia.id_tecnologia= ".$id_tecnologia ;
						$tipo_calificaiones1qq=$conexion->prepare($tipo_calificaiones1q);
						$tipo_calificaiones1qq->execute(array()); 
				}

			} 
		}
	}
}





function excel(){

	session_start();
	include '../../conexion.php';
	include '../../../Classes/PHPExcel/IOFactory.php';
	$c = $_FILES['ex']; 

	$nombreArchivo=$c['tmp_name']; 

	$objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


	$NOTAAA = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();
	$blin = $objPHPExcel->getActiveSheet()->getCell('A5')->getCalculatedValue();
	$expw=explode('-', $blin);
	$var=$expw[2];


	$patrones = array ('/[^0-9]/'); 
	$Periodo= preg_replace($patrones, '', $NOTAAA);
	$Periodo;
    
	$zx=''; 
	echo $_SESSION['numero'];
	$po=explode(',',$_SESSION['id_periodo']);
	foreach ($po as   $value) { 
		 
        if ($Periodo==$value or $Periodo==$_SESSION['numero']) {
        	$zx=1;
        }
    }
    

    if ($zx>0) {
		if ($var==0) {
	    	for($i = 4; $i <= $numRows; $i++){

				$ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
				$NOTA = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
				$exp=explode('-', $ID);
				$id_materia_por_paso=$exp[0];
				$id_materia_por_periodo=$exp[1]; 

			 	$tipo_calificaione=" UPDATE `materia_por_paso` SET `nota` = '".$NOTA."' WHERE `materia_por_paso`.`id_materia_por_paso` =". $id_materia_por_paso;
				$tipo_calificaione=$conexion->prepare($tipo_calificaione);
				$tipo_calificaione->execute(array()); 


					blink($Periodo,$id_materia_por_periodo,$conexion);
	         
				  
			}
	    } if ($var==1) {
	    	for($i = 4; $i <= $numRows; $i++){

				 '<br>'.$ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
				$NOTA = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
				$exp=explode('-', $ID);
				$id_materia_por_paso=$exp[0];
				$id_materia_por_periodo=$exp[1]; 

			  	$tipo_calificaione=" UPDATE `materia_por_paso` SET `nota` = '".$NOTA."' WHERE `materia_por_paso`.`id_materia_por_paso` =". $id_materia_por_paso;
				$tipo_calificaione=$conexion->prepare($tipo_calificaione);
				$tipo_calificaione->execute(array()); echo "<br>";


					blink2($Periodo,$id_materia_por_periodo,$conexion);
	         
				  
			}
	    }
          	
	}
}
 
 function blink2($Periodo,$id_materia_por_periodo,$conexion){
 	echo "<br><br>".$tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = ( SELECT SUM(de.su)as f from (SELECT materia_por_periodo.id_materia_por_periodo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$id_materia_por_periodo."'  and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_materia_por_periodo;
                        $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                        $tipo_calificaiones1->execute(array()); 
 } 
 function blink($Periodo,$id_materia_por_periodo,$conexion){
 	echo '<br>'.$tipo_calificaiones1="
				SELECT  materia_por_periodo.id_materia_por_periodo,sum(q.nota_p) as nota_p  ,materia_por_periodo.area,materia_por_periodo.nota FROM  materia_por_periodo, (SELECT  sum(materia_por_paso.nota)/count(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as nota_p ,  materia_por_periodo.id_informe_academico, materia_por_periodo.codigo from materia_por_periodo,materia_por_paso,nota_independiente,tipo_calificaiones WHERE  materia_por_periodo.id_materia_por_periodo='$id_materia_por_periodo' and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero  GROUP by tipo_calificaiones.numero)as q WHERE materia_por_periodo.id_informe_academico=q.id_informe_academico AND materia_por_periodo.codigo=q.codigo and  materia_por_periodo.periodo=$Periodo GROUP by materia_por_periodo.id_materia_por_periodo ";
				$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
				$tipo_calificaiones1->execute(array()); 
				$registrow=$tipo_calificaiones1->rowCount();  
				$cont=0;
				$r1=0;
				$uno=0;
				$sum=0;
				$id_m=0;

				foreach ($tipo_calificaiones1 as  $value) {
					if($value['id_materia_por_periodo']==$id_materia_por_periodo){
						$r1=$value['nota_p'];
						$r2=$id_materia_por_periodo;
						$uno=1;
					}
					if ($value['area']==0 && $value['id_materia_por_periodo']!=$id_materia_por_periodo) {
						$cont=$cont+1;
						$sum=$sum+$value['nota'];
					}

					if ($value['area']==1) {
						$id_m=$value['id_materia_por_periodo'];
					}
				}
				$cont=$cont+$uno;
		        $sum=$sum+$r1;
				$sum1=$sum/$cont	;
				echo  '<br><br>'.$tipo_calificaiones1="  UPDATE `materia_por_periodo` SET `nota` = '".$r1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$r2."; UPDATE `materia_por_periodo` SET `nota` = '".$sum1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_m ;
				$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
				$tipo_calificaiones1->execute(array());  	
 }
function excel_recuperacion_academico(){

	include '../../conexion.php';
	include '../../../Classes/PHPExcel/IOFactory.php';
	$c = $_FILES['ex']; 

	$nombreArchivo=$c['tmp_name']; 

	$objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


	$NOTAAA = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();
	$blin = $objPHPExcel->getActiveSheet()->getCell('A5')->getCalculatedValue();
	$expw=explode('-', $blin);
	$var=$expw[1];


	$patrones = array ('/[^0-9]/'); 
	$Periodo= preg_replace($patrones, '', $NOTAAA);
	$Periodo;
    
	$zx='';
	session_start();  
	foreach ($_SESSION['id_periodo'] as   $value) { 
		echo $value;
        if ($Periodo==$value) {
        	echo $zx=1;
        }
    }
    if ($Periodo==$_SESSION['numero']) {
        $zx=1;
    }

    if ($zx>0) {
		if ($var==0) {
	    	for($i = 4; $i <= $numRows; $i++){

				$ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
				$t = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(); 
				$s = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
				$exp=explode('-', $ID);
				$id_materia=$exp[0]; 
				$r=($t+$s)/2;

			 	 
				 

			 	 $h=0;
				$nota=0;$rec=0;$h1=0;
				 echo'<br>'.$tipo_calificaiones12="SELECT o.area,o.nota,o.id_materia_por_periodo,o.recuperacion ,escala_academica.desde from (SELECT materia_por_periodo.area,materia_por_periodo.nota, materia_por_periodo.id_materia_por_periodo,materia_por_periodo.recuperacion from materia_por_periodo,(SELECT materia_por_periodo.codigo, materia_por_periodo.id_informe_academico FROM materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo='$id_materia')as q WHERE q.id_informe_academico=materia_por_periodo.id_informe_academico and materia_por_periodo.periodo='$Periodo' and materia_por_periodo.codigo=q.codigo)as o ,escala_academica WHERE escala_academica.mini=1 ";
				$tipo_calificaiones12=$conexion->prepare($tipo_calificaiones12);
				$tipo_calificaiones12->execute(array()); 
				foreach ($tipo_calificaiones12 as   $value) {
					if ($value['area']==1) { 
						$id_materia_por_periodo= $value['id_materia_por_periodo'];

					 	$desde= $value['desde'];
						$nota22= $value['nota'];
					} 
					if ($value['area']==0 && $value['id_materia_por_periodo']!=$id_materia) {
						 $rec=$value['recuperacion'];
						$nota= $nota+ $rec ;
						$h=$h+1;

						 
					}
					if ($value['area']==0 && $value['id_materia_por_periodo']==$id_materia) {
						 $idto=$value['id_materia_por_periodo'];
						 
						$h1= 1;

						 
					}
				} 
				  $desde; 
				if ($nota22<$desde) {
					$h=$h+$h1;
					$nota=$nota+$r; 
					$total=$nota/$h ;
					$tipo_calificaiones1="UPDATE `materia_por_periodo` SET `trabajo`  = '$t',`sustentacion`  = '$s' ,`recuperacion`  = '$r' WHERE `materia_por_periodo`.`id_materia_por_periodo` = ".$id_materia.";UPDATE `materia_por_periodo` SET `recuperacion` = '".$total."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_materia_por_periodo;
					$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
					$tipo_calificaiones1->execute(array());
				} else{
					$tipo_calificaiones1="UPDATE `materia_por_periodo` SET `trabajo`  = '$t',`sustentacion`  = '$s' ,`recuperacion`  = '$r' WHERE `materia_por_periodo`.`id_materia_por_periodo` = ".$id_materia ;
					$tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
					$tipo_calificaiones1->execute(array());
				}	  
			}
	    } if ($var==1) {
	    	for($i = 4; $i <= $numRows; $i++){

				echo'<br><br>'.$ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
				$t = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(); 
				$s = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
				$exp=explode('-', $ID);
				$id_materia=$exp[0]; 
				$r=($t+$s)/2;
			 	 $materia_por_periodoq=" 
			    UPDATE `materia_por_periodo` SET `trabajo`  = '$t',`sustentacion`  = '$s' ,`recuperacion`  = '$r' WHERE `materia_por_periodo`.`id_materia_por_periodo` = ".$id_materia;
				$materia_por_periodoq=$conexion->prepare($materia_por_periodoq);
				$materia_por_periodoq->execute(array());
				$op=$_POST['id'];  
			   
				  
	         
				  
			}
	    }
          	
	}
}	 
 

    
 
 function actualizar_recuperacion_tecnico(){
	include '../../conexion.php';
	$cont=0;
	$acum=0;
	

 
	$r=($_POST['nota2']+$_POST['nota'])/2;
	$string1 = "".$r."";
    $t1=strlen($string1);
    if ($t1>2) {
    $yut=$string1[0].$string1[1].$string1[2];
    }if ($t1==1){ 
		$yut=$string1[0];
	}
	if ($t1==2){ 
		$yut=$string1[0].$string1[1];
	}
	echo '<br>'.$yut;
    $materia_por_periodoq="UPDATE `tecnologia` SET `".$_POST['campo']."`  = '".$_POST['nota']."' ,`".$_POST['campo2']."`  = '".$_POST['nota2']."' , `recuperacion` = '$r' WHERE `tecnologia`.`id_tecnologia` = ".$_POST['id'];
	$materia_por_periodoq=$conexion->prepare($materia_por_periodoq);
	$materia_por_periodoq->execute(array());
	
   
}




function excel_recuperacion_tecnico(){

	include '../../conexion.php';
	include '../../../Classes/PHPExcel/IOFactory.php';
	$c = $_FILES['ex']; 

	$nombreArchivo=$c['tmp_name']; 

	$objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


	$NOTAAA = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();  
	$patrones = array ('/[^0-9]/'); 
	$Periodo= preg_replace($patrones, '', $NOTAAA);
	$Periodo;
    
	$zx='';
	session_start();  
	foreach ($_SESSION['id_periodo'] as   $value) { 
		echo $value;
        if ($Periodo==$value) {
        	echo $zx=1;
        }
    }
    if ($Periodo==$_SESSION['numero']) {
        $zx=1;
    }

    if ($zx>0) { 
    	for($i = 4; $i <= $numRows; $i++){

			$ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
			$t = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(); 
			$s = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();  
			$r=($t+$s)/2;

		 	 
			 

		 	 $h=0;
			$nota=0;$rec=0;$h1=0;
			echo'<br>'.$materia_por_periodoq="UPDATE `tecnologia` SET `Trabajo`  = '".$t."' ,`sustentacion`  = '".$s."' , `recuperacion` = '$r' WHERE `tecnologia`.`id_tecnologia` = ".$ID;
			$materia_por_periodoq=$conexion->prepare($materia_por_periodoq);
			$materia_por_periodoq->execute(array());
			 	  
		} 
          	
	}
}	 

?>




