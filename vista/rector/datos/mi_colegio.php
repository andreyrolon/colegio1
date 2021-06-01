
 


 <?php 

  session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session']);
    }

include '../../../codes/rector/conexion.php';
 $ano=date('Y');
 $consultar_nivel="SELECT * FROM datos ";
 $consultar_nivel1=$conexion->prepare($consultar_nivel);
 $consultar_nivel1->execute(array()); 
 foreach ($consultar_nivel1 as $key ) {
 	$nombre=$key['nombre'];$id_datos=$key['id_datos'];$mision=$key['mision'];$vision=$key['vision'];$resena=$key['resena'];$ciudad=$key['ciudad'];$direccion=$key['direccion'];$eslogan=$key['eslogan'];$aprobado=$key['aprobado'];$telefono1=$key['telefono1'];$telefono2=$key['telefono2'];$decreto=$key['decreto'];$nit=$key['nit'];$dane=$key['dane'];$caracter=$key['caracter'];$correo=$key['correo'];$reprobado=$key['reprobado'];$departamento=$key['departamento'];$decreto_evaluacion=$key['decreto_evaluacion'];
 }



 $ano=date('Y');
 $consultar_nivel="SELECT id FROM histrorial_datos WHERE histrorial_datos.ano='$ano'";
 $sql1=$conexion->prepare($consultar_nivel);
 $sql1->execute(array()); 
 $nsql1os=$sql1->rowCount();

 $boton='<button type="button" class="btn btn-danger"   onclick="registrar_datos()">Registrar información</button><br>';
 if ($nsql1os>0) {
 	$boton='<button type="button" class="btn btn-danger"  onclick="actualizar_datos()">Actualizar información</button><br>';
 }
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } 

    $style='';
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
    $style='font-size: 16.7px;';  
  }	


 
include('../enlaces/head.php'); ?>


 <style>
 	.form-control{
 		<?php echo $style ?>
 	}
 </style>
  
<body class="hold-transition skin-blue sidebar-mini" id="body" style="<?php echo $sty; ?> ">
 
	 <div class="wrapper" class="form-control">
	 	<?php include('../enlaces/header.php');  ?>
   	 		<div class="content-wrapper"> 
      			<div class="row ">
		 
					<div class="col-md-12">  <br>

						<div class="nav-tabs-custom" id="koooo" style="margin-right: 20px; margin-left: 20px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">



							<ul class="nav nav-tabs">
								<li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">DATOS</a></li>
								<li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">MISION Y VISION</a></li>
								<li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">FRASES Y RESEÑA HISTORICA </a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="activity">
									<form id="myForm" action="" method="post">
										<div class="row">
											<div class="col-md-12" style="margin-bottom: 20px">
												<div class="col-md-6">
													<label for="genero">Institucion</label>
													<input type="" style="<?php echo $style;  ?>" value="<?php echo $nombre ?>" class="form-control" id="nombreww" name="nombre" onchange="
													var col=document.getElementById('nombreww').value;
													var nombre='nombre';
													var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">

												</div>
												<div class="col-md-6">
													<label for="genero">Email</label>
													<input type=""  style="<?php echo $style;  ?>"  value="<?php echo $correo ?>" class="form-control" id="correo" name="correo" onchange="
													var col=document.getElementById('correo').value;
													var nombre='correo';
													var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">

												</div>
											</div>
											<div class="col-md-12" style="margin-bottom: 20px">
												<div class="col-md-4">
													<label for="nombre">Departamento</label>
													<input type="text"  style="<?php echo $style;  ?>"  name="departamento" id="departamento" class="form-control" value="<?php echo $departamento ?> " onchange="
													var col=document.getElementById('departamento').value;
													var nombre='departamento';
													
													var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
												<div class="col-md-4">
													<label for="nombre">Ciudad</label>
													<input type="text"  style="<?php echo $style;  ?>"  name="ciudad" id="ciudad" class="form-control" value="<?php echo $ciudad ?>" onchange="
													var col=document.getElementById('ciudad').value;
													var nombre='ciudad';
													var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
												<div class="col-md-4">
													<label for="nombre">Direccion</label>
													<input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion ?>" onchange="
													var col=document.getElementById('direccion').value;
													var nombre='direccion';
													var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
											</div>
											<div class="col-md-12" style="margin-bottom: 20px">
												<div class="col-md-6">


													<label for="nombre">Resolución de Aprobación </label>
													<input type="text"  style="<?php echo $style;  ?>"  name="decreto" id="decreto" class="form-control" value="<?php echo $decreto ?>" onchange="
													var col=document.getElementById('decreto').value;
													var nombre='decreto';
														var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
														
												<div class="col-md-6">
													<label for="genero">Decreto de evaluacion</label>
													<input type=""  style="<?php echo $style;  ?>"  value="<?php echo $decreto_evaluacion ?>" class="form-control" id="decreto_evaluacion" name="decreto_evaluacion" onchange="
													var col=document.getElementById('decreto_evaluacion').value;
													var nombre='decreto_evaluacion';
													var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">

												</div>
											</div> 
											<div class="col-md-12" style="margin-bottom: 20px">
												<div class="col-md-4">
												


													<label for="nombre">Caracter</label>
													<input type="text"  style="<?php echo $style;  ?>"  name="caracter" id="caracter" class="form-control" value="<?php echo $caracter ?>" onchange="
													var col=document.getElementById('caracter').value;
													var nombre='caracter';
														var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">

												</div>
												<div class="col-md-4">
													<label for="nombre">Dane</label>
													<input type="text"  style="<?php echo $style;  ?>"  name="dane" id="dane" class="form-control" value="<?php echo $dane ?>" onchange="
													var col=document.getElementById('dane').value;
													var nombre='dane';
														var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
												<div class="col-md-4">
													<label for="nombre">Nit</label>
													<input type="text"  style="<?php echo $style;  ?>"  name="nit" id="nit" class="form-control" value="<?php echo $nit ?>" onchange="
													var col=document.getElementById('nit').value;
													var nombre='nit';
														var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
											</div>
											<div class="col-md-12" style="margin-bottom: 20px">
											
												<div class="col-md-6">
													<label for="nombre">Telefono</label>
													<input type="text"  style="<?php echo $style;  ?>"  name="telefono1" id="telefono1" class="form-control" value="<?php echo $telefono1 ?>" onchange="
													var col=document.getElementById('telefono1').value;
													var nombre='telefono1';
														var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
												</div>
												<div class="col-md-6">
													<label for="nombre">Telefono </label>
													<input type="text"  style="<?php echo $style;  ?>"  name="telefono2" id="telefono2" class="form-control" value="<?php echo $telefono2 ?>" onchange="
													var col=document.getElementById('telefono2').value;
													var nombre='telefono2';
														var id=<?php echo $id_datos ?>;
													actualizar_dato(col,nombre,id) ">
													</div> 
												

											</div>
											<div lass="col-md-12" style="margin-bottom: 20px">
												<div class="col-md-6">
													<div class="col-md-6">
														<?php echo $boton ?>
													</div><br>
												</div><br>
											</div><br>
										</div><br>
									</form>
								</div>



















								<div class="tab-pane" id="timeline">
									<div class="row">
											<div class="col-md-12"> <br>
												<strong>Mision:</strong>
												<textarea class="form-control" style="height: 100px;<?php echo $style;  ?>" id="mision" onchange="
												var col=document.getElementById('mision').value;
												var nombre='mision';
												var id=<?php echo $id_datos ?>;
												actualizar_dato(col,nombre,id) "><?php echo $mision ?></textarea>
											</div>
										<div class="col-md-12"> <br>

											<strong>Vision:</strong>
											<textarea class="form-control" style="height: 100px;<?php echo $style;  ?>"  id="vision" onchange="
												var col=document.getElementById('vision').value;
												var nombre='vision';
												var id=<?php echo $id_datos ?>;
												actualizar_dato(col,nombre,id) "><?php echo $vision ?>
											</textarea>
										</div>
									</div>
								</div>














								<div class="tab-pane" id="settings">
									<div class="row">
										<div class="col-md-12" style="margin-bottom: 20px">
											<div class="col-md-6">
												<label for="genero">Frase de promocion</label>
												<input type="" style="<?php echo $style;  ?>"  value="<?php echo $aprobado ?>" class="form-control" id="aprobado" name="aprobado" onchange="
												var col=document.getElementById('aprobado').value;
												var nombre='aprobado';
												var id=<?php echo $id_datos ?>;
												actualizar_dato(col,nombre,id) ">  

											</div>
											<div class="col-md-6">
												<label for="genero">Frase de reprobado</label>
												<input type="" style="<?php echo $style;  ?>"  value="<?php echo $reprobado ?>" class="form-control" id="reprobado" name="reprobado" onchange="
												var col=document.getElementById('reprobado').value;
												var nombre='reprobado';
												var id=<?php echo $id_datos ?>;
												actualizar_dato(col,nombre,id) "> 

											</div>
										</div>
										<div class="col-md-12" style="margin-bottom: 20px">

											<div class="col-md-12">
												<label for="nombre">Eslogan </label>
												<input type="text" style="<?php echo $style;  ?>"  name="eslogan" id="eslogan" class="form-control" value="<?php echo $eslogan ?>" onchange="
												var col=document.getElementById('eslogan').value;
												var nombre='eslogan';
												var id=<?php echo $id_datos ?>;
												actualizar_dato(col,nombre,id) ">  
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12"> 
											<div class="col-md-12"> 
												<label for="nombre">Reseña Historica </label>
												<textarea class="form-control" style="height: 100px;<?php echo $style;  ?>" id="resena" onchange="
												var col=document.getElementById('resena').value;
												var nombre='resena';
												var id=<?php echo $id_datos ?>;
												actualizar_dato(col,nombre,id) "> <?php echo $resena ?></textarea>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>








			 







































						<div class="nav-tabs-custom" id="koooo" style="margin-right: 20px; margin-left: 20px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px; ">


							<div class="table-responsive"   > 
							 	<table class="table" style="width: 1000px; ">
							 		<tr>
							 			<td  id="rr1"  style="width: 100px ;  border-top: solid 3px #3c8dbc">
							 				<a   onclick="
								 			 var td1=document.getElementById('rr1').style.borderTop ='solid #3c8dbc'; 
								 			 var td1=document.getElementById('rr2').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr3').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr5').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr4').style.borderTop ='solid #fff';"  
								 			 href="#periodos" data-toggle="tab" aria-expanded="false" style="  color: #000 ">
								 				PERIODOS
								 			</a></td> 
							 			<td  id="rr2"  style="width: 150px">
							 				<a onclick="
								 			 var td1=document.getElementById('rr2').style.borderTop ='solid #3c8dbc'; 
								 			 var td1=document.getElementById('rr1').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr3').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr5').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr4').style.borderTop ='solid #fff';"   href="#TIPO" data-toggle="tab" aria-expanded="false" style="  color: #000 ">
								 				TIPO DE NOTAS
								 			</a>
								 		</td>  
									 
										 <td   id="rr3" >
										 	<a onclick="
								 			 var td1=document.getElementById('rr3').style.borderTop ='solid #3c8dbc'; 
								 			 var td1=document.getElementById('rr2').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr1').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr5').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr4').style.borderTop ='solid #fff';"   href="#academico" data-toggle="tab" aria-expanded="false" style="color: #000 ">
								 				ESCALA DE VALORIZACIÓN ACADEMICA
								 			</a>
								 		</td>
										 <td id="rr4" >
										 	<a  onclick="
								 			 var td1=document.getElementById('rr4').style.borderTop ='solid #3c8dbc'; 
								 			 var td1=document.getElementById('rr2').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr3').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr5').style.borderTop ='solid #fff';
								 			 var td1=document.getElementById('rr1').style.borderTop ='solid #fff';"  href="#tecnico" data-toggle="tab" aria-expanded="true" style="  color: #000 ">
											 	ESCALA DE VALORIZACIÓN TECNICA
											 </a>
										</td>
										 <td id="rr5" >
										 	<a  onclick="
									 			 var td1=document.getElementById('rr5').style.borderTop ='solid #3c8dbc'; 
									 			 var td1=document.getElementById('rr2').style.borderTop ='solid #fff';
									 			 var td1=document.getElementById('rr3').style.borderTop ='solid #fff';
									 			 var td1=document.getElementById('rr4').style.borderTop ='solid #fff'; "  href="#habilitar" data-toggle="tab" aria-expanded="true" style=" color: #000  ">
									 			HABILITAR 
									 		</a>
									 	</td>
							 		</tr>
							 	</table>
							 
							</div>
								 
							<div class="tab-content">
								<div class="tab-pane active" id="periodos">
									<form id="myForm" action="" method="post">
										<div class="row" id="peri">

										
										</div>
									</form>
								</div>


								<div class="tab-pane " id="TIPO">
									<form id="myForm" action="" method="post">
										<div class="row" id="TIPO_N">	 
										</div>
									</form>
								</div>  

								<div class="tab-pane " id="academico">
									<form id="myForm" action="" method="post">
										<div class="row" id="academico1">

												 
										</div>
									</form>
								</div> 


								<div class="tab-pane " id="tecnico">
									<form id="myForm" action="" method="post">
										<div class="row" id="tecno">

												 
										</div>
									</form> 

								</div> 

								<div class="tab-pane" id="habilitar">
								 	<div class="row">
										<div class="col-md-12" id="mostra"> 
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
				 
					<form method="post" id="agregar_periodo">
						<div class="modal fade" id="myModal" role="dialog" style="background-color: rgba(3, 64, 95, 0.3);" >
							<div class="modal-dialog"style=" " >
								<div class="modal-content" id="cotent" style="border-radius: 7px  " >
									<div class="modal-header" id="header" style="border-radius: 5px;background-color: #3c8dbc;color: #fff">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
										</button>
										<div style=" <?php echo $style ?>"><strong>Nuevo Periodo</strong></div> 
									</div>

									<div class="modal-body" id="body" style=" background-color: #">
										<div id="_MSG4_"></div>

										<div class="form-group">
											<label   >Nombre:</label>
											<input style="<?php echo $style ?>" type="text" name="Nombre" placeholder="Nombre..." class="form-last-name form-control" id="Nombre"      >
										</div>
										<div class="form-group">
											<label  >Fecha De Inicio:</label>
											<input type="date" name="Fecha_ini" placeholder="Fecha_ini..." class="form-email form-control" id="Fecha_ini" >
										</div>
										<div class="form-group">
											<label  >Fecha De terminacion:</label>
											<input style="<?php echo $style ?>" type="date" name="Fecha_fin" placeholder="Fecha_fin..." class="form-email form-control" id="Fecha_fin" >
										</div>
										<div class="form-group">
											<label >Orden de lista:</label>
											<input style="<?php echo $style ?>" type="text" name="numero" placeholder="numero..." class="form-email form-control" id="numero" >
										</div>

										<button type="submit" name="registro" id="btn1" style=" <?php echo $style ?> background-color: #3c8dbc;color: #fff;width: 100%"   class="btn">Registrar</button>  
										<button type="button" class="btn btn-danger"   data-dismiss="modal"  style=" <?php echo $style ?> width: 100%;margin-top: 5px"   class="btn">Cancelar</button>  
									</div>

								</div>
							</div>
						</div> 
					</form> 
					<form method="post" id="agregar_academico">
						<div class="modal fade" id="myModal2" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content" id="cotent">
									<div class="modal-header" id="header" style="background-color: #3c8dbc;color: #fff">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
										</button> <strong>Registrar Escala De Valorización Academica</strong> 
									</div>

									<div class="modal-body" id="body" >
										<div id="_MSG3_"></div>

										<div class="form-group">
											<strong>Nombre de la calificación:</strong><br>
											<input type="text" name="SS"   class="form-last-name form-control" id="SS"      >
										</div>
										<div class="form-group">
											<strong>Sigla:</strong><br>
											<input type="" name="Sigla"   class="form-email form-control" id="Sigla" >
										</div>
										<div class="form-group">
											<strong>rango minimo de la calificación:</strong><br>
											<input type="" name="Desde"   class="form-email form-control" id="Desde" >
										</div>
										<div class="form-group">
											<strong>rango maximo de la calificación:</strong><br>
											<input type="" name="Hasta"   class="form-email form-control" id="Hasta" >
										</div>
										<div class="form-group">
											<strong>numero de orden:</strong><br>
											<input type="" name="numer1" class="form-email form-control" id="numer1" >
										</div>
										<div class="form-group">
											<strong>La calificacion es la minima para aprovar:</strong><br>
											<select class="form-email form-control" id="minimo" name="minimo">
												<option value=""  >No</option>
												<option value="1">Si</option>
											</select>
										</div><button type="submit" name="registro" id="btn1"  class="btn btn-block btn-primary">Registrar</button>
<button type="button"  data-dismiss="modal" name="registro" id="btn1"  class="btn btn-block btn-danger">Cancelar</button>  
										  
										
									</div>

								</div>
							</div>
						</div> 
					</form> 
					<div id="sapo"></div>


					<form method="post" id="agregar_tecn">
						<div class="modal fade" id="myModal23" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content" id="cotent">
									<div class="modal-header" id="header" style="">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
										</button>
										<h3 class="modal-title" id="modal-register-label">NUEVA ESCALA DE VALORIZACIONA TECNICA</h3> 
									</div>

									<div class="modal-body" id="body" >
										<div id="_MSG5_"></div>

										<div class="form-group">
											<label class="sr-only" for="form-last-name">Nombre</label>
											<input type="text" name="SS2" placeholder="Nombre..." class="form-last-name form-control" id="SS2"      >
										</div>
										<div class="form-group">
											<label class="sr-only" for="form-email">Sigla</label>
											<input type="" name="Sigla2" placeholder="Sigla..." class="form-email form-control" id="Sigla2" >
										</div>
										<div class="form-group">
											<label class="sr-only" for="form-email">Desde</label>
											<input type="" name="Desde2" placeholder="Desde..." class="form-email form-control" id="Desde2" >
										</div>
										<div class="form-group">
											<label class="sr-only" for="form-email">Hasta</label>
											<input type="" name="Hasta2" placeholder="Hasta..." class="form-email form-control" id="Hasta2" >
										</div>
										<div class="form-group">
											<label class="sr-only" for="form-email">Orden de lista</label>
											<input type="" name="numer12" placeholder="numero..." class="form-email form-control" id="numer12" >
										</div>

										<button type="submit" name="registro" id="btn1"   class="btn">Registrar</button>  
									</div>

								</div>
							</div>
						</div> 
					</form> 



					<form method="post" id="agregar_TIPO_N">
						<div class="modal fade" id="TIPO_Nfff" role="dialog" style="background-color: rgba(3, 64, 95, 0.3);">
							<div class="modal-dialog">
								<div class="modal-content" id="cotent">
									 
									<div class="modal-header" id="header" style=" background-color: #3c8dbc;color: #fff">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
										</button>
										<div style=" <?php echo $style ?>"><strong>Registrar Tipo De Nota</strong></div> 
									</div>

									<div class="modal-body" id="body" >
										<div id="_MSG7_"></div>

										<div class="form-group">
											<label  >Nombre:</label>
											<input type="text" name="Nombre7" placeholder="Nombre..." class="form-last-name form-control" id="Nombre7"      style=" <?php echo $style?>" >
										</div>
										<div class="form-group">
											<label  >Descripción:</label>
											<input type="" name="Descripcion" placeholder="Descripcion..." class="form-email form-control" id="Descripcion"  style=" <?php echo $style ?>">
										</div>
										<div class="form-group">
											<label  >Porcentaje:</label>
											<input type="" name="Porcentaje" placeholder="Porcentaje..." class="form-email form-control" id="Porcentaje"  style=" <?php echo $style ?>">
										</div>

										<div class="form-group">
											<label  >Orden de lista:</label>
											<input type="" name="numer123" placeholder="numero..." class="form-email form-control" id="numer123"  style=" <?php echo $style ?>">
										</div>
 
										<button type="submit" name="registro" id="btn1" style=" <?php echo $style ?> background-color: #3c8dbc;color: #fff;width: 100%"   class="btn">Registrar</button>  
										<button type="button" class="btn btn-danger"   data-dismiss="modal"  style=" <?php echo $style ?> width: 100%;margin-top: 5px"   class="btn">Cancelar</button>    
									</div>

								</div>
							</div>
						</div> 
					</form>
				</div>
			</div>
			<footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>
		</div>

<script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>

<?php 
include('../enlaces/footer.php'); ?>
  <script type="text/javascript">
  	function actualizar_datos(){
  		var nombre=document.getElementById('nombreww').value;
  		var correo=document.getElementById('correo').value;
  		var departamento=document.getElementById('departamento').value;
  		var ciudad=document.getElementById('ciudad').value;
  		var direccion=document.getElementById('direccion').value;
  		var decreto=document.getElementById('decreto').value;
  		var decreto_evaluacion=document.getElementById('decreto_evaluacion').value;
  		var caracter=document.getElementById('caracter').value;
  		var dane=document.getElementById('dane').value;
  		var nit=document.getElementById('nit').value;
  		var telefono1=document.getElementById('telefono1').value;
  		var telefono2=document.getElementById('telefono2').value;
  		var mision=document.getElementById('mision').value;
  		var vision=document.getElementById('vision').value;
  		var aprobado=document.getElementById('aprobado').value;
  		var reprobado=document.getElementById('reprobado').value;
  		var resena=document.getElementById('resena').value;
  		var mision=document.getElementById('mision').value; 
  		var eslogan=document.getElementById('eslogan').value;
  		$.ajax({   
	        type: "post", 
            data:{nombre,correo,departamento,ciudad,direccion,eslogan,decreto,decreto_evaluacion,caracter,dane,nit,telefono1,telefono2,mision,vision ,aprobado,reprobado,resena}, 
	        url:"../../../ajax/rector/mi_colegio.php?action=actualizar_datos_anuales", 
	        dataType:"text", 

	        	success:function(data){  
	        		window.location.assign( window.location.href); 
	      	} 
      	});
  	}
  	function registrar_datos(){
  		var nombre=document.getElementById('nombreww').value;
  		var correo=document.getElementById('correo').value;
  		var departamento=document.getElementById('departamento').value;
  		var ciudad=document.getElementById('ciudad').value;
  		var direccion=document.getElementById('direccion').value;
  		var decreto=document.getElementById('decreto').value;
  		var decreto_evaluacion=document.getElementById('decreto_evaluacion').value;
  		var caracter=document.getElementById('caracter').value;
  		var dane=document.getElementById('dane').value;
  		var nit=document.getElementById('nit').value;
  		var telefono1=document.getElementById('telefono1').value;
  		var telefono2=document.getElementById('telefono2').value;
  		var mision=document.getElementById('mision').value;
  		var vision=document.getElementById('vision').value;
  		var aprobado=document.getElementById('aprobado').value;
  		var reprobado=document.getElementById('reprobado').value;
  		var resena=document.getElementById('resena').value; 
  		var eslogan=document.getElementById('eslogan').value;
  		$.ajax({   
	        type: "post", 
            data:{nombre,correo,departamento,ciudad,direccion,eslogan,decreto,decreto_evaluacion,caracter,dane,nit,telefono1,telefono2,mision,vision ,aprobado,reprobado,resena}, 
	        url:"../../../ajax/rector/mi_colegio.php?action=registrar_datos_anuales", 
	        dataType:"text", 

	        	success:function(data){  
	        		window.location.assign( window.location.href); 
	      	} 
      	});
  	}
    function fun(col2,col,col1){
		$.ajax({   
	        type: "post", 
            data:{col2,col,col1}, 
	        url:"../../../ajax/rector/mi_colegio.php?action=actualizar_va", 
	        dataType:"text", 

	        	success:function(data){  
	        		$('#sapo').html(data);
	      	} 
      	});
    }
    function actualizar_dato(col,nombre,id){  

   		$.ajax({   
	        type: "post", 
            data:{col,nombre,id}, 
	        url:"../../../ajax/rector/mi_colegio.php?action=mis_datos", 
	        dataType:"text", 

	        success:function(data){   
	      	} 
      	});
    }
	$(document).ready(function(){ 

		function mostra(){
			$.ajax({   
		        type: "post",

		        url:"../../../ajax/rector/mi_colegio.php?action=mostrar_validation",
		        dataType:"text", 

		        success:function(data){  
		       		$('#mostra').html(data); 
		       	}  
		    });
		}mostra();
		function periodo(){
			$.ajax({   
		        type: "post",

		        url:"../../../ajax/rector/mi_colegio.php?action=periodo",
		        dataType:"text", 

		        success:function(data){  
		       		$('#peri').html(data); 
		       	}  
		    });
		}periodo();
		function academico(){
			$.ajax({   
		        type: "post",

		        url:"../../../ajax/rector/mi_colegio.php?action=academico",
		        dataType:"text", 

		        success:function(data){  
		       		$('#academico1').html(data); 
		       	}  
		    });
		}
		
		$(document).on("submit", "#agregar_academico", function(e){
		    e.preventDefault();
		      var SS = $("#SS").val();
		      var minimo = $("#minimo").val();
		      var Sigla = $("#Sigla").val();
		    var Desde = $("#Desde").val();
		    var Fecha_fin= $("#Fecha_fin").val();
		    var numer1= $("#numer1").val();
		    var Hasta= $("#Hasta").val();

		    if (SS=='') {
		      mensaje3(2,"Ingrese el nombre del rango de calificacion");
		      document.getElementById("SS").focus();
		      return false; 
		    } 
		    if(ESnombre(SS)){
		      mensaje3(2,"El nombre  no permite numeros");
		      document.getElementById("SS").value='';
		      document.getElementById("SS").focus();
		      return false; 
		    }
		    if (Sigla=='') {
		      mensaje3(2,"Ingrese  la abrevicion del nombre");
		      document.getElementById("Sigla").focus();
		      return false; 
		    } 
		    if(ESnombre(Sigla)){
		      mensaje3(2,"El abreviatura no permite numeros");
		      document.getElementById("Sigla").value='';
		      document.getElementById("Sigla").focus();
		      return false; 
		    }

		    if (Desde=='') {
		      mensaje3(2,"Ingrese  la nota minima");
		      document.getElementById("Desde").focus();
		      return false; 
		    } 
		      if(decimaa(Desde)){
		      mensaje3(2,"La nota minima solo permirte numeros enteros o decimales con punto");
		      document.getElementById("Desde").focus();    
		      document.getElementById("Desde").value='';
		      return false; 
		    }
		     
		    if (Hasta=='') {
		      mensaje3(2,"Ingrese  la nota maxima");
		      document.getElementById("Hasta").focus();
		      return false; 
		    }
		   
		      if(decimaa(Hasta)){
		      mensaje3(2,"La nota minima solo permirte numeros enteros o decimales con punto");
		      document.getElementById("Hasta").focus();    
		      document.getElementById("Hasta").value='';
		      return false; 
		    }
		    if(numer1==''){
		      mensaje3(2,"Ingrese el numero para ordenar los clasificacion de notas");
		      document.getElementById("numer1").focus();    
		      document.getElementById("numer1").value='';return false; 
		    } 
		  
		    if(ESnumero(numer1)){
		      mensaje3(2,"Este campo  no permite letras");
		      document.getElementById("numer1").focus();    
		      document.getElementById("numer1").value='';
		      return false; 
		    } 
		    else{   
		      $.ajax({

		        type: "post",
		        url:"../../../ajax/rector/mi_colegio.php?action=registrar_academico",
		        data: $(this).serialize(),
		        dataType:"text", 
		        success: function(data)
		        {   
		        	if (data==1) { 
		            	mensaje3(3,'Registro actualizado');
		            	document.getElementById("SS").focus();
				        academico();
				        document.getElementById("agregar_academico").reset();
		            }if (data==0) { 
		              mensaje3(1,'Un dato que  ingresó ya esta en la base de datos');
		            }if (data==3) { 
		              mensaje3(1,'Las escalas de valorizacion solo se pueden registrar el 3 al  31 de Diciembre o del  1 al 15 de enero ');
		            }
		          
		        }
		      });
		    }
		  });


academico();
		$(document).on("submit", "#agregar_periodo", function(e){
		    e.preventDefault();
		      var Nombre = $("#Nombre").val();
		    var Fecha_ini = $("#Fecha_ini").val();
		    var Fecha_fin= $("#Fecha_fin").val();
		    var numero= $("#numero").val();
		    if (Nombre=='') {
		      mensaje4(2,"Ingrese el nombre del periodo");
		      document.getElementById("Nombre").focus();
		      return false; 
		    } 
		    if(ESnombre(Nombre)){
		      mensaje4(2,"El nombre del periodo no permite numeros");
		      document.getElementById("Nombre").value='';
		      document.getElementById("Nombre").focus();
		      return false; 
		    }
		    if (Fecha_ini=='') {
		      mensaje4(2,"Ingrese  la Fecha que inicia el periodo");
		      document.getElementById("Fecha_ini").focus();
		      return false; 
		    } 
		     
		    if (Fecha_fin=='') {
		      mensaje4(2,"Ingrese  la Fecha que termina el periodo");
		      document.getElementById("Fecha_fin").focus();
		      return false; 
		    } 
		    if(ESnumero(numero)){
		      mensaje4(2,"Este campo  no permite letras");
		      document.getElementById("numero").focus();    
		      document.getElementById("numero").value='';
		      return false; 
		    }
		    if( numero==''){
		      mensaje4(2,"Ingrese el numero para ordenar los periodos");
		      document.getElementById("numero").focus();    
		      document.getElementById("numero").value='';
		      return false; 
		    }  
		    else{   
		      $.ajax({

		        type: "post",
		        url:"../../../ajax/rector/mi_colegio.php?action=registrar_periodo",
		        data: $(this).serialize(),
		        dataType:"text", 
		        success: function(data)
		        { 
		        	if (data==1) {
		        		mensaje4(3,'Registro exitoso');
		        	}if (data==0){
		        		mensaje4(1,'Un campo se encuentra registrado en la base de datos. ');
		        	}
		        	if (data==3){ 
		        		mensaje4(1,'Los periodos solo se pueden registrar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
		        	}
		          document.getElementById("numero").value='';
		          document.getElementById("Nombre").value='';
		          document.getElementById("Nombre").focus();
		          document.getElementById("Fecha_fin").value='';
		          document.getElementById("Fecha_ini").value='';
		          periodo();
		           
		        }
		      });
		    }
		});




		function tecn(){
			$.ajax({   
		        type: "post",

		        url:"../../../ajax/rector/mi_colegio.php?action=tecnico",
		        dataType:"text", 

		        success:function(data){  

		       		$('#tecno').html(data); 
		       	}  
		    });
		}
		
		$(document).on("submit", "#agregar_tecn", function(e){
		     e.preventDefault();
		      var SS2 = $("#SS2").val();
		      var Sigla2 = $("#Sigla2").val();
		    var Desde2 = $("#Desde2").val();
		    var numer12= $("#numer12").val();
		    var Hasta2= $("#Hasta2").val();

		    if (SS2=='') {
		      mensaje5(2,"Ingrese el nombre del rango de calificacion");
		      document.getElementById("SS2").focus();
		      return false; 
		    } 
		    if(ESnombre(SS2)){
		      mensaje5(2,"El nombre  no permite numeros");
		      document.getElementById("SS2").value='';
		      document.getElementById("SS2").focus();
		      return false; 
		    }
		    if (Sigla2=='') {
		      mensaje5(2,"Ingrese  la abrevicion del nombre");
		      document.getElementById("Sigla2").focus();
		      return false; 
		    } 
		    if(ESnombre(Sigla2)){
		      mensaje5(2,"El abreviatura no permite numeros");
		      document.getElementById("Sigla2").value='';
		      document.getElementById("Sigla2").focus();
		      return false; 
		    }

		    if (Desde2=='') {
		      mensaje5(2,"Ingrese  la nota minima");
		      document.getElementById("Desde2").focus();
		      return false; 
		    } 
		      if(decimaa(Desde2)){
		      mensaje5(2,"La nota minima solo permirte numeros enteros o decimales con punto");
		      document.getElementById("Desde2").focus();    
		      document.getElementById("Desde2").value='';
		      return false; 
		    }
		     
		    if (Hasta2=='') {
		      mensaje5(2,"Ingrese  la nota maxima");
		      document.getElementById("Hasta2").focus();
		      return false; 
		    }
		   
		      if(decimaa(Hasta2)){
		      mensaje5(2,"La nota minima solo permirte numeros enteros o decimales con punto");
		      document.getElementById("Hasta2").focus();    
		      document.getElementById("Hasta2").value='';
		      return false; 
		    }
		    if(numer12==''){
		      mensaje5(2,"Ingrese el numero para ordenar los clasificacion de notas");
		      document.getElementById("numer12").focus();    
		      document.getElementById("numer12").value='';
		      return false;
		    } 
		  
		    if(ESnumero(numer12)){
		      mensaje5(2,"Este campo  no permite letras");
		      document.getElementById("numer12").focus();    
		      document.getElementById("numer12").value='';
		      return false; 
		    } 
		    else{   
		      $.ajax({

		        type: "post",
		        url:"../../../ajax/rector/mi_colegio.php?action=agregar_tecnico",
		        data: $(this).serialize(),
		        dataType:"text", 
		        success: function(data)
		        { 

		           document.getElementById("agregar_tecn").reset();
		          document.getElementById("SS2").focus();
		          tecn();

		        }
		      });
		    }
		  });

tecn();
	     		function NOTAS_T(){
			$.ajax({   
		        type: "post",

		        url:"../../../ajax/rector/mi_colegio.php?action=TIPO_N",
		        dataType:"text", 

		        success:function(data){  
		       		$('#TIPO_N').html(data); 
		       	}  
		    });
		}
		NOTAS_T();
		$(document).on("submit", "#agregar_TIPO_N", function(e){
		    e.preventDefault();
		      var Nombre7 = $("#Nombre7").val();
		      var Descripcion = $("#Descripcion").val();
		    var Porcentaje = $("#Porcentaje").val();  
		    var numer123= $("#numer123").val();

		    if (Nombre7=='') {
		      mensaje7(2,"Ingrese el nombre tipo de nota");
		      document.getElementById("Nombre7").focus();
		      return false; 
		    } 
		    if(ESnombre(Nombre7)){
		      mensaje7(2,"El tipo de nota  no permite numeros");
		      document.getElementById("Nombre7").value='';
		      document.getElementById("Nombre7").focus();
		      return false; 
		    }
		    if (Descripcion=='') {
		      mensaje7(2,"Ingrese  la descripcion ");
		      document.getElementById("Descripcion").focus();
		      return false; 
		    } 
		    if(ESnombre(Descripcion)){
		      mensaje7(2,"la descripcion  no permite numeros");
		      document.getElementById("Descripcion").value='';
		      document.getElementById("Descripcion").focus();
		      return false; 
		    }

		    if (Porcentaje=='') {
		      mensaje7(2,"Ingrese  el porcentaje");
		      document.getElementById("Porcentaje").focus();
		      return false; 
		    } 
		      if(decimaa(Porcentaje)){
		      mensaje7(2,"El porcentaje solo permirte numeros enteros o decimales con punto");
		      document.getElementById("Porcentaje").focus();    
		      document.getElementById("Porcentaje").value='';
		      return false; 
		    }
		     
		    if (numer123=='') {
		      mensaje7(2,"Debe ingresar un numero para ordenar el registro");
		      document.getElementById("numer123").focus();
		      return false; 
		    }
		   
		      if(ESnumero(numer123)){
		      mensaje7(2,"El numero no permite letras");
		      document.getElementById("numer123").focus();    
		      document.getElementById("numer123").value='';
		      return false; 
		    }
		    
		    else{   
		      $.ajax({

		        type: "post",
		        url:"../../../ajax/rector/mi_colegio.php?action=agregar_tipo",
		        data: $(this).serialize(),
		        dataType:"text", 
		        success: function(data)
		        {   
		        	if (data==1) {
		        		mensaje7(3,'Registro exitoso');
		        		document.getElementById("Nombre7").focus();
				        NOTAS_T();
				        document.getElementById("agregar_TIPO_N").reset();
		        	}if (data==0){
		        		mensaje7(1,'Un campo se encuentra registrado en la base de datos. ');
		        	}
		        	if (data==3){ 
		        		mensaje7(1,'Los tipos de notas solo se pueden registrar del 3 al  31 de Diciembre o del  1 al 15 de enero ');
		        	}

		          
		        }
		      });
		    }
		  });
	 });
    </script>




</body>

</html>
 