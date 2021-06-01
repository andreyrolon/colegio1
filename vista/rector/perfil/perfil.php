 <?php 
session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil1=$chat->perfil_2($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session']);
    }
require_once "../../../codes/rector/admin.php";
$admin=new admin();
$paiss=$admin->pais();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
 
   
		$NUMERO_DOCUMENTO='';  
 	$FECHA_NACIMIENTO='';  
 	$LUGAR_NACIMIENTO='';  
 	$DIRECCION='';  
 	$BARRIO='';  
 	$TIPO_DOCUMENTO='';  
 	$BARRIO='';  
 	$TELEFONO_CA='';  
 	$CORREO='';  
 	$GENERO='';  
 	$ESCALAFON='';  
	$NOMBRE='';  
	$APELLIDO='';  
	$ROL='';  
	$FOTO='';  
	$CELULAR='';   
	$FECHA='';  
	$fecha_nombramiento='';  
	$decreto_nombramiento='';  
	$fecha_traslado='';  
foreach ($perfil1 as $kperfile) {
 	$NUMERO_DOCUMENTO=$kperfile['NUMERO_DOCUMENTO'];
 	$FECHA_NACIMIENTO=$kperfile['FECHA_NACIMIENTO'];
 	$pais=$kperfile['pais'];
 	$DIRECCION=$kperfile['DIRECCION'];
 	$BARRIO=$kperfile['BARRIO'];
 	$TIPO_DOCUMENTO=$kperfile['TIPO_DOCUMENTO'];
 	$BARRIO=$kperfile['BARRIO'];
 	$TELEFONO_CA=$kperfile['TELEFONO_CA'];
 	$CORREO=$kperfile['CORREO'];
 	$GENERO=$kperfile['GENERO'];
 	$ESCALAFON=$kperfile['ESCALAFON'];
	$NOMBRE=$kperfile['NOMBRE'];
	$APELLIDO=$kperfile['APELLIDO'];
	$ROL=$kperfile['ROL'];
	$FOTO=$kperfile['FOTO'];
	$CELULAR=$kperfile['CELULAR']; 
	$FECHA=$kperfile['FECHA'];
	$fecha_nombramiento=$kperfile['fecha_nombramiento'];
	$decreto_nombramiento=$kperfile['decreto_nombramiento'];
	$fecha_traslado=$kperfile['fecha_traslado']; 
	$expedicion=$kperfile['expedicion']; 
	if ($pais=='') {
	 	$pais='Colombia';
	 }
	$estadito='';
	if($kperfile['estado']!=''){
		$estado='<option value="'.$kperfile['estado'].'">'.$kperfile['estado'].'</option>';	
		$estadito=$kperfile['estado'];
	} else{
		$estado='';
	}
	if($kperfile['ciudad']!=''){
		$ciudad=$kperfile['ciudad'];	
	} else{
		$ciudad='';
	}
}
 include '../enlaces/head.php'; ?> 
  <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } 
  $tin='';
  if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
  	$tin='font-size: 22px;';	
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
  	$tin='font-size: 17px;';	
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style=" width: 100%;<?php echo $sty; ?>">

 <div class="wrapper" class="form-control"> 
    <?php include('../enlaces/header.php');   ?>
    <div class="content-wrapper"> 
      	<div class="row">
      		<div class="col-md-12"><br>   
				<div class="col-md-3">
					<div id="sapo"></div>
					<!-- Profile Image -->
 					<div class="box box-primary" id="oop" style="margin-right: 10px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">
						<div class="box-body box-profile" id="imagen">
							<img class="profile-user-img img-responsive img-circle" src="<?php echo $FOTO ?>" alt="User profile picture" style="    margin: 0 auto;width: 160px;height: 180px;padding: 3px;border: 3px solid #d2d6de;">
  								<h3 class="profile-username text-center" style="<?php echo $sty; ?>">
   									<?php echo $NOMBRE.' '.$APELLIDO; ?> 
   								</h3>
    							<p class="text-muted text-center"><?php echo $ROL ?></p>

    							
  								<form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post"><center>
							        <div class="btn btn-default btn-file">
							        	
									        <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
									        <input type="file" name="Foto" id="Foto">
									        <input type="hidden" name="url" id="url" value="<?php echo($FOTO) ?>">

							      	</div>
								    <input type="hidden" value="maria fff" name="nombre" id="nombre">
								    <input type="hidden" value="diaz" name="apellido" id="apellido">
								    <input type="hidden" name="url" id="url" value="../../../img/femenino.png">
								    <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['Id_Doc'] ?>">
								    <button type="button" class="btn btn-primary" name="foto" onclick="sasa()">Subir</button><br><br> 
								   

							        <div class="modal fade" id="mymodal" data-keyboard="true" data-backdrop="false" backdrop="">
							          	<div class="modal-dialog">
							            	<div class="modal-content">
							              		<div class="modal-header">
							                		<button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
							                		<h4 class="modal-title">Confirmación</h4>
							             		</div>
								             	<div class="modal-body">
								               	 	<p> estás seguro de eliminar la sede   ?</p>

								              	</div>
							              		<div class="modal-footer">    
									                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									                <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminar_sede" id="btn" onclick="var io= 37; Inhabilitar(io)">Aceptar</button> 
								                
							              		</div>
							            	</div>
							            </div>
							        </div>
   								</form>
							    
    					</div>
						<!-- /.box-body -->
					</div> 
					<div class="box box-primary" id="oop" style="margin-right: 10px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;" >
						<div style="padding: 10px">
							<div class="box-body">
                                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                                <p class="text-muted"> 
                                     <div id="tables"></div>                             

                               <hr>

                                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                                <p class="text-muted">
                                	Dirección:
                                    <?php echo ' '.$DIRECCION ?> <br>
                                    Barrio: <?php echo ' '.$BARRIO ?>  <br>
                                    Celular: <?php echo ' '.$CELULAR ?>  </p>                             

                                <hr>
                               <a style="color: #fff" data-toggle="modal" data-target="#mymodal">
								      	<div class="btn btn-default btn-file" style="width: 100% ;background-color: #d73925;color: #fff">
								      		<img style="margin-right: 5px; width: 20px" src="data:image/svg+xml;base64,&#10;PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTUxMC4zNzEsMjI2LjUxM2MtMS4wODgtMi42MDMtMi42NDUtNC45NzEtNC42MjktNi45NTVsLTYzLjk3OS02My45NzljLTguMzQxLTguMzItMjEuODI0LTguMzItMzAuMTY1LDAgICAgIGMtOC4zNDEsOC4zNDEtOC4zNDEsMjEuODQ1LDAsMzAuMTY1bDI3LjU4NCwyNy41ODRIMzIwLjAxM2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzNzOS41MzYsMjEuMzMzLDIxLjMzMywyMS4zMzMgICAgIGgxMTkuMTY4bC0yNy41ODQsMjcuNTg0Yy04LjM0MSw4LjM0MS04LjM0MSwyMS44NDUsMCwzMC4xNjVjNC4xNiw0LjE4MSw5LjYyMSw2LjI1MSwxNS4wODMsNi4yNTFzMTAuOTIzLTIuMDY5LDE1LjA4My02LjI1MSAgICAgbDYzLjk3OS02My45NzljMS45ODQtMS45NjMsMy41NDEtNC4zMzEsNC42MjktNi45NTVDNTEyLjUyNSwyMzcuNjA2LDUxMi41MjUsMjMxLjcxOCw1MTAuMzcxLDIyNi41MTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGN0Y1RjUiIGRhdGEtb2xkX2NvbG9yPSIjM0YzRjNGIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0zNjIuNjgsMjk4LjY2N2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzN2MTA2LjY2N2gtODUuMzMzVjg1LjMzM2MwLTkuNDA4LTYuMTg3LTE3LjcyOC0xNS4yMTEtMjAuNDM3ICAgICBsLTc0LjA5MS0yMi4yMjloMTc0LjYzNXYxMDYuNjY3YzAsMTEuNzc2LDkuNTM2LDIxLjMzMywyMS4zMzMsMjEuMzMzczIxLjMzMy05LjU1NywyMS4zMzMtMjEuMzMzdi0xMjggICAgIEMzODQuMDEzLDkuNTU3LDM3NC40NzcsMCwzNjIuNjgsMEgyMS4zNDdjLTAuNzY4LDAtMS40NTEsMC4zMi0yLjE5NywwLjQwNWMtMS4wMDMsMC4xMDctMS45MiwwLjI3Ny0yLjg4LDAuNTEyICAgICBjLTIuMjQsMC41NzYtNC4yNjcsMS40NTEtNi4xNjUsMi42NDVjLTAuNDY5LDAuMjk5LTEuMDQ1LDAuMzItMS40OTMsMC42NjFDOC40NCw0LjM1Miw4LjM3Niw0LjU4Nyw4LjIwNSw0LjcxNSAgICAgQzUuODgsNi41NDksMy45MzksOC43ODksMi41MzEsMTEuNDU2Yy0wLjI5OSwwLjU3Ni0wLjM2MywxLjE5NS0wLjU5NywxLjc5MmMtMC42ODMsMS42MjEtMS40MjksMy4yLTEuNjg1LDQuOTkyICAgICBjLTAuMTA3LDAuNjQsMC4wODUsMS4yMzcsMC4wNjQsMS44NTZjLTAuMDIxLDAuNDI3LTAuMjk5LDAuODExLTAuMjk5LDEuMjM3VjQ0OGMwLDEwLjE3Niw3LjE4OSwxOC45MjMsMTcuMTUyLDIwLjkwNyAgICAgbDIxMy4zMzMsNDIuNjY3YzEuMzg3LDAuMjk5LDIuNzk1LDAuNDI3LDQuMTgxLDAuNDI3YzQuODg1LDAsOS42ODUtMS42ODUsMTMuNTI1LTQuODQzYzQuOTI4LTQuMDUzLDcuODA4LTEwLjA5MSw3LjgwOC0xNi40OTEgICAgIHYtMjEuMzMzSDM2Mi42OGMxMS43OTcsMCwyMS4zMzMtOS41NTcsMjEuMzMzLTIxLjMzM1YzMjBDMzg0LjAxMywzMDguMjI0LDM3NC40NzcsMjk4LjY2NywzNjIuNjgsMjk4LjY2N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y3RjVGNSIgZGF0YS1vbGRfY29sb3I9IiMzRjNGM0YiPjwvcGF0aD4KCQk8L2c+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==">Inhabilitar cuenta 
	                                    </div>
                                	</a>
                                 
                            </div>
						</div>
						 
					</div>
				</div>
<!-- /.col -->
				<div class="col-md-9">
					<div class="nav-tabs-custom" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#activity" data-toggle="tab">Datos Personales</a></li>
							<li><a href="#timeline" data-toggle="tab">Información de Contacto</a></li>
							<li><a href="#settings" data-toggle="tab">Información laboral</a></li>
						</ul>
						<div class="tab-content">
							<div class="active tab-pane" id="activity">
								<form id="myForm" action="" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-4">
												<label for="nombre" id="wwNUMERO_DOCUMENTO">Numero documento</label>
												<input type="text" name="NUMERO_DOCUMENTO" id="NUMERO_DOCUMENTO" class="form-control" value="<?php echo $NUMERO_DOCUMENTO ?>" style=' <?php echo $tin ?>'  onchange='var tex= document.getElementById("NUMERO_DOCUMENTO").value; var columna="NUMERO_DOCUMENTO";actualizar(columna,tex); '>  
												<div id="wNUMERO_DOCUMENTO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-4">
												<label for="genero">Tipo documento</label>
												<select name="TIPO_DOCUMENTO" id="TIPO_DOCUMENTO" class="form-control" value=''  style="  <?php echo  $tin ?>" required=""  onchange='var tex= document.getElementById("TIPO_DOCUMENTO").value; var columna="TIPO_DOCUMENTO";actualizar(columna,tex); '>
								                    <option value="1">Tarjeta de Identidad</option>
								                    <option value="2">Cedula Ciudadania</option>
								                    <option value="3">Cedula Extranjeria</option> 
								                    <option value="5">Permiso Especial Permanencia(PEP)</option> 
								                    <option value="4">Pasaporte</option> 
								                    <option value="6">Registro Civil</option>
								                  </select><div id="wTIPO_DOCUMENTO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-4">
												<label for="genero">Expedida</label>
												<input type="text" class="form-control" placeholder="expedicion" name="expedicion" id="expedicion" value="<?php echo $expedicion ?>"  style=' <?php echo $tin ?>' onchange='var tex= document.getElementById("expedicion").value; var columna="expedicion";actualizar(columna,tex); ' > 
												<div id="wexpedicion" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-4">
												<label for="nombre">Nombres</label>
												<input type="text" name="NOMBRE" id="NOMBRE" class="form-control" value="<?php  echo $NOMBRE?>" style=' <?php echo $tin ?>'       onchange='var tex= document.getElementById("NOMBRE").value; var columna="NOMBRE";actualizar(columna,tex); ' >
												<div id="wNOMBRE" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-4">
												<label for="apellido">Apellidos</label>
												<input type="text" name="APELLIDO" id="APELLIDO" class="form-control" value="<?php  echo $APELLIDO?>" style=' <?php echo $tin ?>' onchange='var tex= document.getElementById("APELLIDO").value; var columna="APELLIDO";actualizar(columna,tex); ' ><div id="wAPELLIDO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-4">
												<label for="apellido">Genero</label>
												<select class="form-control" id="GENERO" name="GENERO" style=' <?php echo $tin ?>'  onchange='var tex= document.getElementById("GENERO").value; var columna="GENERO";actualizar(columna,tex); ' >
													<option value="1">
													Femenino </option>
													<option value="0">Masculino</option>
												</select>
												<div id="wGENERO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-6">
												<label for="fecha_n">Fecha nacimiento</label>
												<input type="date" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" class="form-control" value="<?php echo $FECHA_NACIMIENTO ?>" style=' <?php echo $tin ?>'  onchange='var tex= document.getElementById("FECHA_NACIMIENTO").value; var columna="FECHA_NACIMIENTO";actualizar(columna,tex); ' >
												<div id="wFECHA_NACIMIENTO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-6">
												<label for="nombre">Pais de nacimiento </label><br>
								                  	<select name="pais" id='pais' class="form-control select2"  style="  <?php echo  $style ?>" onchange='              var tex=document.getElementById("pais").value;var columna="pais";actualizar1(columna,tex) ' required>
								                    <option value="<?php echo 's,'.$pais ?>"><?php echo $pais ?></option>
								                    <?php foreach ($paiss as $key ) {
								                    	if ( $key['paisnombre']!=$pais) { ?>
									                      	<option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?>	</option>
									                      <?php
									                  	}
								                    } ?> 
								                  </select>
								                  <div id="wpais" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-6">
												<label for="fecha_n">Departamento nacimiento</label>
												<select name="estado" id='estado' class="form-control select2" onchange='var tex= document.getElementById("estado").value; var columna="estado";actualizar(columna,tex); ' >
													<?php echo $estado ;

													$es=$admin->estado($pais);
													foreach ($es as $key ) {
														if ( $key['estadonombre']!=$estadito) {
															?>
															<option value="<?php echo $key['estadonombre'] ?>"><?php echo $key['estadonombre'] ?></option>
															<?php
														}
													}

													?>
												</select>

												<div id="westado" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-6">
												<label for="lugar_n">ciudad nacimiento</label>
												<input type="text" name="ciudad" id="ciudad" class="form-control" value="<?php echo $ciudad ?>" style=' <?php echo $tin ?>' onchange='var tex= document.getElementById("ciudad").value; var columna="ciudad";actualizar(columna,tex); ' >
												<div id="wciudad" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div> 
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane" id="timeline">
								<form id="Form" action="" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<label for="email">Email</label>
												<input type="email" name="CORREO" value="<?php echo $CORREO ?>" id="CORREO" class="form-control"  style=' <?php echo $tin ?>'  onchange='var tex= document.getElementById("CORREO").value; var columna="CORREO";actualizar(columna,tex); '>
												<div id="wCORREO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-6">
												<label for="celular">Celular</label>
												<input type="number" style=' <?php echo $tin ?>' name="CELULAR" id="CELULAR" class="form-control" value="<?php echo $CELULAR ?>" onchange='var tex= document.getElementById("CELULAR").value; var columna="CELULAR";actualizar(columna,tex); '>
												<div id="wCELULAR" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-6">
												<label for="telefono">Telefono</label>
												<input type="number" style=' <?php echo $tin ?>' name="TELEFONO_CA" id="TELEFONO_CA" class="form-control" value="<?php echo $TELEFONO_CA ?>" onchange='var tex= document.getElementById("TELEFONO_CA").value; var columna="TELEFONO_CA";actualizar(columna,tex); '>
												<div id="wTELEFONO_CA" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-6">
												<label for="direccion">Direccion</label>
												<input type="text" style=' <?php echo $tin ?>' name="DIRECCION" id="DIRECCION" class="form-control" value="<?php echo $DIRECCION ?>" onchange='var tex= document.getElementById("DIRECCION").value; var columna="DIRECCION";actualizar(columna,tex); '>
												<div id="wDIRECCION" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-3"></div>
											<div class="col-md-6">
												<label for="barrio">Barrio</label>
												<input type="text" style=' <?php echo $tin ?>' name="BARRIO" id="BARRIO" class="form-control" value="<?php echo $BARRIO ?>" onchange='var tex= document.getElementById("BARRIO").value; var columna="BARRIO";actualizar(columna,tex); '>
													<div id="wBARRIO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
											</div>
											<div class="col-md-3"></div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane" id="settings">
								<div class="row">
									<div  id="titulos"></div>
									<div class="col-md-3">
										<div class="col-md-3"><br>
											<button style="ma" type="button" onclick="nuevo()" class="btn   btn-info">nuevo titulo</button> 
										</div>
									</div>
								</div>
							</div>
							<!-- /.tab-pane -->
						</div>
						<!-- /.tab-content -->
					</div>
					<!-- /.nav-tabs-custom -->
					<div class="box box-primary" id="titulo_ver" style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 10px " >
						<div class="row"> 
							<div class="col-md-12" style="padding-left: 50px;padding-right: 50px;padding-top: 10px">
							 <div id="_MSG_" style=' <?php echo $tin ?>'></div> 
								<label for="escalafon">Clave actual</label>
								<center>
								<div class="input-group">
								    <input type="password" class="form-control" id="password1" placeholder="Contraseña">
								    <span class="input-group-btn">
								       <button    id='ojo1' onclick="mostrarContrasena1()"  class="btn btn-default" type="button" style="display: none;color: #3c8dbc">
								          <i class="fa fa-eye fa-lg" id=""></i>				
								       </button>
								       <button   onclick="mostrarContrasena1()" id='ojo1n'  class="btn btn-default" type="button" style="color: #3c8dbc">
								          <i class="fa  fa-eye-slash fa-lg" id=""></i>				
								       </button>
								    </span>
								</div></center>



								<br> 
								<label for="escalafon">Nueva Clave</label>
								<center>
								<div class="input-group">
								    <input type="password" class="form-control" id="password2" placeholder="Contraseña">
								    <span class="input-group-btn">
								       <button    id='ojo2' onclick="mostrarContrasena2()"  class="btn btn-default" type="button" style="display: none;color: #3c8dbc">
								          <i class="fa fa-eye fa-lg" id=""></i>				
								       </button>
								       <button   onclick="mostrarContrasena2()" id='ojo2n'  class="btn btn-default" type="button" style="color: #3c8dbc">
								          <i class="fa  fa-eye-slash fa-lg" id=""></i>				
								       </button>
								    </span>
								</div></center>
								
							 	<br>
								<label for="escalafon">Confirmar Clave</label>
								 
								<div class="input-group">
								    <input type="password" class="form-control" id="passwordf" placeholder="Contraseña">
								    <span class="input-group-btn">
								       <button    id='ojo3' onclick="mostrarContrasena()"  class="btn btn-default" type="button" style="display: none;color: #3c8dbc">
								          <i class="fa fa-eye fa-lg" id=""></i>				
								       </button>
								       <button   onclick="mostrarContrasena()" id='ojo3n'  class="btn btn-default" type="button" style="color: #3c8dbc">
								          <i class="fa  fa-eye-slash fa-lg" id=""></i>				
								       </button>
								    </span>
								</div> 

								 <br><button style="ma" type="button" class="btn   btn-info"  onclick="contra()">Actualizar Contraseña</button><br>
								<script>
									function mostrarContrasena(){
									    var tipo = document.getElementById("passwordf");
									    if(tipo.type == "password"){
									          tipo.type = "text";
									          document.getElementById('ojo3').style.display='block'
									          document.getElementById('ojo3n').style.display='none';
									          tipo.focus();
									    }else{
									        tipo.type = "password";tipo.focus(); 
									          document.getElementById('ojo3n').style.display='block';
									          document.getElementById('ojo3').style.display='none';
									    }
									}
									function mostrarContrasena2(){
									    var tipo = document.getElementById("password2");
									    if(tipo.type == "password"){
									          tipo.type = "text";tipo.focus();
									        document.getElementById('ojo2').style.display='block'
									          document.getElementById('ojo2n').style.display='none'
									    }else{
									        tipo.type = "password";tipo.focus();
									        document.getElementById('ojo2').style.display='none'
									          document.getElementById('ojo2n').style.display='block'
									    }
									}
									function mostrarContrasena1(){


									    var tipo = document.getElementById("password1");
									    if(tipo.type == "password"){
									        tipo.type = "text";tipo.focus();
									        document.getElementById('ojo1').style.display='block'
									          document.getElementById('ojo1n').style.display='none'
									    }else{
									        tipo.type = "password";									          tipo.focus();
									        document.getElementById('ojo1').style.display='none'
									          document.getElementById('ojo1n').style.display='block'
									    }
									}
								</script>
							</div> 
						      
						</div>
						
					</div> 
				</div>
			</div>
		</div>

	</div> 
	<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> IBUnotas</b> 1.0
    </div>
    <strong>Desarrollado por  IBUsoft. </strong> 
  </footer>
</div>
<?php include '../enlaces/footer.php'; ?>
<script type="text/javascript">

  
	function contra(){
		var id=<?php echo $_SESSION['Id_Doc']  ?>;
		var  contraseña1=document.getElementById('password1').value; 
		var  contraseña2=document.getElementById('password2').value; 
		var  contraseña3=document.getElementById('passwordf').value; 
		if (contraseña1=='') {
			mensaje(2,'Complete el campo');
			document.getElementById('password1').focus();
			return;
		}
		if (contraseña2=='') {
			mensaje(2,'Complete el campo');
			document.getElementById('password2').focus();
			return;
		}
		if (contraseña3=='') {
			mensaje(2,'Complete el campo');
			document.getElementById('passwordf').focus();
			return;
		}if (contraseña3==contraseña2) {

			$.ajax({   
			    type: "post",

			    data:{id,contraseña1},
			    url:"../../../ajax/rector/admin/admin.php?action=varificar_contrasena",
			      dataType:"text", 

			    success:function(data){  
			       	  	 
			    	if (data>0) {
			    		$.ajax({   
						    type: "post",

						    data:{id,contraseña3},
						    url:"../../../ajax/rector/admin/admin.php?action=actualizar_contra_admin1",
			      			dataType:"text",
			      			success:function(data){  
			    				mensaje(3,'Información: Has cambiado tu Clave');
			    			}
			    		});	
			    	}else{
			    		mensaje(1,'La Clave actual no esta en la base de datos');
			    	} 	    			
			    }  
			});
		}if (contraseña3!=contraseña2) {

			mensaje(2,'Las Claves no coinciden');
			document.getElementById('password2').focus();
			document.getElementById('password2').value='';
			document.getElementById('passwordf').value='';
			return;
		}	
	}
  
	function tabless(){
		var id=<?php echo $_SESSION['Id_Doc']  ?>;
		$.ajax({   
		    type: "post",

		    data:{id},
		    url:"../../../ajax/rector/admin/admin.php?action=tabla",
		      dataType:"text", 

		    success:function(data){  
		       	  	 
		    	$('#tables').html(data); 	 	    			
		    }  
		});	
	}
	tabless();
	function  actualizar(columna,tex){
		var id=<?php echo $_SESSION['Id_Doc']  ?>;
		$.ajax({   
		    type: "post",

		    data:{id,columna,tex},
		    url:"../../../ajax/rector/admin/admin.php?action=actualizar_admin",
		      dataType:"text", 

		    success:function(data){   	     	
		    	document.getElementById('w'+columna).style.display='block';
		     	setTimeout(function(){  
		     	document.getElementById('w'+columna).style.display='none'; }, 3000);

		    }  
		});		
	}
	function  actualizar1(columna,tex){
		var id=<?php echo $_SESSION['Id_Doc']  ?>;
		var porciones = tex.split(',');
        var tex=porciones[1];
		$.ajax({   
		    type: "post",

		    data:{id,columna,tex},
		    url:"../../../ajax/rector/admin/admin.php?action=actualizar_admin",
		      dataType:"text", 

		    success:function(data){  
		    	document.getElementById('w'+columna).style.display='block';
		     	setTimeout(function(){  
		     	document.getElementById('w'+columna).style.display='none'; }, 3000);
		       	var id=document.getElementById("pais").value; pais(id);      

		    }  
		});		
	}
	function  actualizar_titulo_admin(col,nombre,id){
		 
		$.ajax({   
		    type: "post",

		    data:{col,nombre,id},
		    url:"../../../ajax/rector/admin/admin.php?action=actualizar_titulos1",
		      dataType:"text", 

		    success:function(data){  

		    	  	document.getElementById('w'+nombre+id).style.display='block';
		     	setTimeout(function(){  
		     	document.getElementById('w'+nombre+id).style.display='none'; }, 3000);
		          
		    	tabless()
		    }  
		});		
	}
	function titulos(){
		var id=<?php echo $_SESSION['Id_Doc']  ?>;
		var style='<?php echo $tin ?>';
		$.ajax({   
		    type: "post",

		    data:{id,style},
		    url:"../../../ajax/rector/admin/admin.php?action=titulos1",
		      dataType:"text", 

		    success:function(data){  
		         
		     	$('#titulos').html(data);

		    }  
		});
	}
	titulos();
	function liminar_titulo1(ids){
 
		$.ajax({   
		    type: "post",

		    data:{ids},
		    url:"../../../ajax/rector/admin/admin.php?action=liminar_titulo",
		      dataType:"text", 

		    success:function(data){    
		    	titulos();
		    }  
		});

	}
	function nuevo(){

		var id=<?php echo $_SESSION['Id_Doc']  ?>; 
		$.ajax({   
		    type: "post",

		    data:{id},
		    url:"../../../ajax/rector/admin/admin.php?action=nuevo_titulo_admin",
		      dataType:"text", 

		    success:function(data){   
		    	titulos();
		    }  
		});
	}

	function pais(id){
	    
	    $.ajax({   
	      type: "post",

	      data:{id},
	      url:"../../../ajax/seles/seles.php?action=estado",
	      dataType:"text", 

	      success:function(data){  
	         
	       $('#estado').html(data);

	      }  


	    });
	 }


	document.getElementById("TIPO_DOCUMENTO").value = "<?php echo  $TIPO_DOCUMENTO ?>";
	document.getElementById("GENERO").value = "<?php echo  $GENERO ?>";
	function sasa() {
		var foto=document.getElementById("Foto").value; 
		var nombre=document.getElementById("nombre").value; 
		var apellido=document.getElementById("apellido").value; 
		var id=document.getElementById("id").value; 
		var parametros=new FormData($("#formulario-envia")[0]);
		$.ajax({
			data:parametros,
			url:"../../../ajax/rector/admin/admin.php?action=actualizar_img",
			type:"POST",
			contentType:false,
			processData:false,
			success: function(rety){
				window.location.assign( window.location.href); 
									          	 
			}
		});
								        
	} 

	 
</script>