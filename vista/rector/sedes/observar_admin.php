


<?php 
	include('../enlaces/head.php'); 
	include '../../../codes/rector/admin.php';
	$c=new admin(); 

	$vec=$c->mostrar_admin($_GET['id']);
		$NOMBRE='';
		$APELLIDO='';
		$CELULAR='';
		$ID_ADMIN='';
		$TIPO_DOCUMENTO='';
		$FECHA_NACIMIENTO='';
		$LUGAR_NACIMIENTO='';
		$DIRECCION='';
		$BARRIO='';
		$TELEFONO_CA='';
		$ROL='';
		$FOTO='';
		$CORREO='';
		$GENERO='';
		$ESCALAFON='';
		$FECHA='';
		$NUMERO_DOCUMENTO='';
		$decreto_nombramiento ='';
		$decreto_traslado  ='';
		$fecha_traslado  ='';
		$fecha_nombramiento ='';
	foreach ($vec as $key ) {
		$NOMBRE=$key['NOMBRE'];
		$APELLIDO=$key['APELLIDO'];
		$CELULAR=$key['CELULAR'];
		$ID_ADMIN=$key['ID_ADMIN'];
		$TIPO_DOCUMENTO=$key['TIPO_DOCUMENTO'];
		$FECHA_NACIMIENTO=$key['FECHA_NACIMIENTO'];
		$LUGAR_NACIMIENTO=$key['LUGAR_NACIMIENTO'];
		$DIRECCION=$key['DIRECCION'];
		$BARRIO=$key['BARRIO'];
		$TELEFONO_CA=$key['TELEFONO_CA'];
		$ROL=$key['ROL'];
		$FOTO=$key['FOTO'];
		$CORREO=$key['CORREO'];
		$GENERO=$key['GENERO'];
		$ESCALAFON=$key['ESCALAFON']; 
		$FECHA=$key['FECHA'];
	 	$NUMERO_DOCUMENTO=$key['NUMERO_DOCUMENTO'];
	 	$decreto_nombramiento =$key['decreto_nombramiento'];
		$decreto_traslado  =$key['decreto_traslado'];
		$fecha_traslado  =$key['fecha_traslado'];
		$fecha_nombramiento =$key['fecha_nombramiento'];
		$INHABILITADO=$key['INHABILITADO'];
	}
?>
 

 
  ss
<body class="hold-transition skin-blue sidebar-mini" style=" font-family: cursive;">
 
<?php include('../enlaces/header.php'); ?>
<div class="content-wrapper"><br><br>

	<?php if ($INHABILITADO==0) {
		# code...
	 ?>
<div class="row">
    <div class="col-md-3" style="">
 		<div class="box box-primary" id="oop" style="margin-left: 30px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">
<div class="box-body box-profile" id="imagen">


  <img class="profile-user-img img-responsive img-circle" src=" 
  <?php 
 if($FOTO=='' && $GENERO=='Masculino'){
 	echo '../../../logos/masculino.png';
 } if($FOTO=='' && $GENERO=='Femenino'){
 	echo '../../../logos/femenino.png';
 } if($FOTO!=''){
 	echo $FOTO;
 } ?>
 " alt="User profile picture" style="    margin: 0 auto;
  width: 180px;height: 180px;
  padding: 3px;
  border: 3px solid #d2d6de;">
  <h3 class="profile-username text-center">
    <?php echo $NOMBRE.' '.$APELLIDO ?> </h3>
    <p class="text-muted text-center"><?php echo $ROL ?></p>
  <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
      <div class="btn btn-default btn-file">
        <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
        <input type="file" name="Foto" id="Foto">
      </div>
       
      <input type="hidden" name="url" id="url" value="<?php echo $FOTO ?>">
      <input type="hidden" name="id" id="id" value="<?php echo $ID_ADMIN ?>">
      <input type="hidden" id="ad" name="ad">
      <button type="button" class="btn btn-primary" name="foto" onclick="sasa()">Subir</button>
<br><br><a style="color: #fff" data-toggle="modal" data-target="#mymodal">
      <div class="btn btn-default btn-file" style="width: 100% ;background-color: #d73925;color: #fff">

        <img style="margin-right: 5px; width: 20px" src="data:image/svg+xml;base64,&#10;PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTUxMC4zNzEsMjI2LjUxM2MtMS4wODgtMi42MDMtMi42NDUtNC45NzEtNC42MjktNi45NTVsLTYzLjk3OS02My45NzljLTguMzQxLTguMzItMjEuODI0LTguMzItMzAuMTY1LDAgICAgIGMtOC4zNDEsOC4zNDEtOC4zNDEsMjEuODQ1LDAsMzAuMTY1bDI3LjU4NCwyNy41ODRIMzIwLjAxM2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzNzOS41MzYsMjEuMzMzLDIxLjMzMywyMS4zMzMgICAgIGgxMTkuMTY4bC0yNy41ODQsMjcuNTg0Yy04LjM0MSw4LjM0MS04LjM0MSwyMS44NDUsMCwzMC4xNjVjNC4xNiw0LjE4MSw5LjYyMSw2LjI1MSwxNS4wODMsNi4yNTFzMTAuOTIzLTIuMDY5LDE1LjA4My02LjI1MSAgICAgbDYzLjk3OS02My45NzljMS45ODQtMS45NjMsMy41NDEtNC4zMzEsNC42MjktNi45NTVDNTEyLjUyNSwyMzcuNjA2LDUxMi41MjUsMjMxLjcxOCw1MTAuMzcxLDIyNi41MTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGN0Y1RjUiIGRhdGEtb2xkX2NvbG9yPSIjM0YzRjNGIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0zNjIuNjgsMjk4LjY2N2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzN2MTA2LjY2N2gtODUuMzMzVjg1LjMzM2MwLTkuNDA4LTYuMTg3LTE3LjcyOC0xNS4yMTEtMjAuNDM3ICAgICBsLTc0LjA5MS0yMi4yMjloMTc0LjYzNXYxMDYuNjY3YzAsMTEuNzc2LDkuNTM2LDIxLjMzMywyMS4zMzMsMjEuMzMzczIxLjMzMy05LjU1NywyMS4zMzMtMjEuMzMzdi0xMjggICAgIEMzODQuMDEzLDkuNTU3LDM3NC40NzcsMCwzNjIuNjgsMEgyMS4zNDdjLTAuNzY4LDAtMS40NTEsMC4zMi0yLjE5NywwLjQwNWMtMS4wMDMsMC4xMDctMS45MiwwLjI3Ny0yLjg4LDAuNTEyICAgICBjLTIuMjQsMC41NzYtNC4yNjcsMS40NTEtNi4xNjUsMi42NDVjLTAuNDY5LDAuMjk5LTEuMDQ1LDAuMzItMS40OTMsMC42NjFDOC40NCw0LjM1Miw4LjM3Niw0LjU4Nyw4LjIwNSw0LjcxNSAgICAgQzUuODgsNi41NDksMy45MzksOC43ODksMi41MzEsMTEuNDU2Yy0wLjI5OSwwLjU3Ni0wLjM2MywxLjE5NS0wLjU5NywxLjc5MmMtMC42ODMsMS42MjEtMS40MjksMy4yLTEuNjg1LDQuOTkyICAgICBjLTAuMTA3LDAuNjQsMC4wODUsMS4yMzcsMC4wNjQsMS44NTZjLTAuMDIxLDAuNDI3LTAuMjk5LDAuODExLTAuMjk5LDEuMjM3VjQ0OGMwLDEwLjE3Niw3LjE4OSwxOC45MjMsMTcuMTUyLDIwLjkwNyAgICAgbDIxMy4zMzMsNDIuNjY3YzEuMzg3LDAuMjk5LDIuNzk1LDAuNDI3LDQuMTgxLDAuNDI3YzQuODg1LDAsOS42ODUtMS42ODUsMTMuNTI1LTQuODQzYzQuOTI4LTQuMDUzLDcuODA4LTEwLjA5MSw3LjgwOC0xNi40OTEgICAgIHYtMjEuMzMzSDM2Mi42OGMxMS43OTcsMCwyMS4zMzMtOS41NTcsMjEuMzMzLTIxLjMzM1YzMjBDMzg0LjAxMywzMDguMjI0LDM3NC40NzcsMjk4LjY2NywzNjIuNjgsMjk4LjY2N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y3RjVGNSIgZGF0YS1vbGRfY29sb3I9IiMzRjNGM0YiPjwvcGF0aD4KCQk8L2c+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==">Inhabilitar cuenta 
                                    </div></a>
        <div class="modal fade" id="mymodal" data-keyboard="true" data-backdrop="false" backdrop="">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> estás seguro de inhabilitar la  cuenta   ?</p>
                 por que? 
                <textarea class="form-control" id="reto"></textarea>

              </div>
              <div class="modal-footer">    
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminar_sede" id="btn" onclick="var io= <?php echo($ID_ADMIN) ?>;var u=document.getElementById('reto').value; Inhabilitarq(io,u)">Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>
    </form>
 
    </div>
<!-- /.box-body -->
</div>
  	</div> 





<div class="col-md-9"> <br>
<div class="nav-tabs-custom" id="koooo" style="margin-right: 20px; margin-left: 20px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">



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
<div class="col-md-6">
<label for="documento">Documento</label>
<select class="form-control" style="width: 19%;" id="tipo_documento" onchange="
var col=document.getElementById('tipo_documento').value;
var nombre='TIPO_DOCUMENTO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
  <?php 
 if($TIPO_DOCUMENTO=='Cedula Extranjeria'){
 	echo '<option value="Cedula Extranjeria">CE</option><option value="CC">CC</option>';
 } else{
 	echo '<option value="CC">CC</option><option value="Cedula Extranjeria">CC</option>';
 } ?>
 
</select>
<input type="number" class="form-control" name="numero_documento" id="numero_documento" value="<?php echo $NUMERO_DOCUMENTO ?>" style=" margin-top: -34px; margin-left: 69px; width: 81%;" oninput="
var col=document.getElementById('numero_documento').value;
var nombre='NUMERO_DOCUMENTO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-6">
<label for="genero">Genero</label>
<input type="" value="<?php echo $GENERO ?>" class="form-control" id="genero_admin" name="genero" oninput="
var col=document.getElementById('genero_admin').value;
var nombre='GENERO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
 
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label for="nombre">Nombres</label>
<input type="text" name="nombre" id="nombre_admin" class="form-control" value="<?php echo $NOMBRE  ?>" oninput="
var col=document.getElementById('nombre_admin').value;
var nombre='NOMBRE';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-6">
<label for="apellido">Apellidos</label>
<input type="text" name="apellido" id="apellido_admin" class="form-control" value="<?php echo $APELLIDO ?>" oninput="
var col=document.getElementById('apellido_admin').value;
var nombre='APELLIDO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label for="fecha_n">Fecha nacimiento</label>
<input type="date" name="fecha_nacimiento" id="fecha_nacimiento_admin" class="form-control" value="<?php echo $FECHA_NACIMIENTO  ?>" oninput="
var col=document.getElementById('fecha_nacimiento_admin').value;
var nombre='FECHA_NACIMIENTO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-6">
<label for="lugar_n">Lugar nacimiento</label>
<input type="text" name="lugar_nacimiento" id="lugar_nacimiento_admin" class="form-control" value="<?php echo $LUGAR_NACIMIENTO  ?>" oninput="
var col=document.getElementById('lugar_nacimiento_admin').value;
var nombre='LUGAR_NACIMIENTO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
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
<input type="email" name="correo" id="correo_admin" class="form-control" value="<?php echo $CORREO ?>" oninput="
var col=document.getElementById('correo_admin').value;
var nombre='$CORREO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-6">
<label for="celular">Celular</label>
<input type="number" name="celular" id="celular_admin" class="form-control" value="<?php echo $CELULAR ?>" oninput="
var col=document.getElementById('celular_admin').value;
var nombre='CELULAR';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label for="telefono">Telefono</label>
<input type="number" name="telefono" id="telefono_admin" class="form-control" value="<?php echo $TELEFONO_CA ?>" oninput="
var col=document.getElementById('telefono_admin').value;
var nombre='TELEFONO_CA';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-6">
<label for="direccion">Direccion</label>
<input type="text" name="direccion" id="direccion_admin" class="form-control" value="<?php echo $DIRECCION ?>" oninput="
var col=document.getElementById('direccion_admin').value;
var nombre='DIRECCION';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
</div>
<div class="col-md-12">
<div class="col-md-3"></div>
<div class="col-md-6">
<label for="barrio">Barrio</label>
<input type="text" name="barrio" id="barrio_admin" class="form-control" value="<?php echo $BARRIO ?>" oninput="
var col=document.getElementById('barrio_admin').value;
var nombre='BARRIO';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-3"></div>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="settings">
<form id="FormLa" action="" method="post">
<div class="row">
<div class="col-md-12">
<div class="col-md-6">
 
<label for="titulo">Decreto de nombramiento</label>
<input type="text" name="decreto_nombramiento_admin" id="decreto_nombramiento_admin" class="form-control" value="<?php echo $decreto_nombramiento ?>" oninput="
var col=document.getElementById('decreto_nombramiento_admin').value;
var nombre='decreto_nombramiento';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
<div class="col-md-6">
<label for="institucion">Fecha de nombramiento</label>
<input type="date" name="fecha_nombramiento" id="fecha_nombramiento_admin" class="form-control" value="<?php echo $fecha_nombramiento ?>" oninput="
var col=document.getElementById('fecha_nombramiento_admin').value;
var nombre=&quot;fecha_nombramiento&quot;;
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
 
</div>
 <div class="col-md-12"><br>
 
 
<div class="col-md-12"> 
<label for="escalafon">Escalafon</label>
<input type="number" name="escalafon" id="escalafon_admin" class="form-control" value="<?php echo $ESCALAFON ?>" oninput="
var col=document.getElementById('escalafon_admin').value;
var nombre='ESCALAFON';
var id=<?php echo $ID_ADMIN ?>;
   actualizar_hoja_admin1(col,nombre,id) ">
</div>
</div>
 

<div class="col-md-12"><hr>
<div id="titulos">

 
   
    </div>
</div>
<div class="col-md-12">
 
<div class="col-md-3"><button type="button" name="nuevo" id="nuevo" class="btn btn-info" style="margin-top: 23px;"  onclick="nuev()">Nuevo titulo</button></div>
</div>
</div>
</form>
</div>
<!-- /.tab-pane -->
</div>
<!-- /.tab-content -->

<!-- /.nav-tabs-custom -->


 </div>

<br> 
<div class="box box-primary"    style="margin-right: 20px; margin-left: 20px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">
            <div class="box-header">
              <h3 class="box-title">Recuperar contraseña</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
			  <strong>Nueva contraseña:</strong><br>
              <input type="password" id="nueva" class="form-control" name="nueva" placeholder="*******************">
             <br><strong>Confirmar contraseña: </strong><br>
              <input type="password" class="form-control" name="confirmacion" id="confirmacion" placeholder="*******************">

           <br> 
           <div class="btn btn-default btn-file" style="width: 100% ;background-color: #61a9d4;color: #fff" data-toggle="modal" data-target="#mymodalfr">
Aceptar
                                    </div>


           <div class="modal fade" id="mymodalfr" data-keyboard="true" data-backdrop="false" backdrop="" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> estás seguro de actualizar la contraseña   ?</p>

              </div>
              <div class="modal-footer">    
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminar_sede" id="btn" onclick="var io1= document.getElementById('nueva').value; var id=<?php echo $_GET['id'] ?>;var io2=document.getElementById('confirmacion').value; actualizar_contra_admin1(id,io1,io2)">Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>
              
            
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
 </div></div><?php }else{
 	?><div class=" " style="background-color: #fff3cd;padding: 30px;margin: 20px;box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;color: #856404" >
     <strong><h4><i class="icon fa fa-warning"></i> Alerta!</h4></strong> Acabas de suspender temporalmente la cuenta del administrador si deseas devolver esta accion ingrese a historial selecione personal y de clikc donde dice habilitar cuenta.
</div><?php
 } ?>
        

  
<script>
	function actualizar_contra_admin1(id,io1,io2){
		if (io1==''){
			alert('el campo campo de la nueva contraseña esta vacio');
		} 
		if (io1!=io2){
			alert('el campo de la contraseña y la confirmacion  no son iguales');
		}
		if (io1==io2) {
			$.ajax({   
			   type: "post",

			   data:{id,io1}, 
			   url:"../../../ajax/rector/admin/admin.php?action=actualizar_contra_admin1",
			   dataType:"text", 

				success:function(data){  
				   document.getElementById('nueva').value='';
				   document.getElementById('confirmacion').value='';alert(data);
				}  
			}); 			
		}
	}
	function Inhabilitarq(io,u){
		$.ajax({   
		   type: "post",

		   data:{io,u}, 
		   url:"../../../ajax/rector/admin/admin.php?action=Inhabilitarq_admin1",
		   dataType:"text", 

			success:function(data){  
			  window.location.assign( window.location.href); 
			}  
		}); 
	}
	function sasa(){ 
		var archivoRuta = document.getElementById('Foto').value;
    		var vacio='';
		var extPermitidas = /(.docx)$/i;
		var extPermitidas1 = /(.pdf)$/i;
		var extPermitidas2 = /(.pptx)$/i;
		var extPermitidas3 = /(.jpg)$/i;
		var extPermitidas4 = /(.png)$/i;
		if(extPermitidas.exec(archivoRuta)){
			
			alert('solo soporta imagenes formato png o jpg')
		}
		if(extPermitidas1.exec(archivoRuta)){
			
			alert('solo soporta imagenes formato png o jpg')
		}
		if(extPermitidas2.exec(archivoRuta)){
			
			alert('solo soporta imagenes formato png o jpg')
		}
			if(extPermitidas3.exec(archivoRuta)){
			
			document.getElementById('ad').value='.jpg';
			        var parametros=new FormData($("#formulario-envia")[0]);
	        $.ajax({
	      
			    data:parametros,
			    url:"../../../ajax/rector/admin/admin.php?action=actualizar_foto_admin1",
			    type:"POST",
			    contentType:false,
			    processData:false,
			    success: function(data){
			 		  window.location.assign( window.location.href); 
			    }
	       });
		}
		if(extPermitidas4.exec(archivoRuta)){
			
			document.getElementById('ad').value='.png';
			        var parametros=new FormData($("#formulario-envia")[0]);
	        $.ajax({
	      
			    data:parametros,
			    url:"../../../ajax/rector/admin/admin.php?action=actualizar_foto_admin1",
			    type:"POST",
			    contentType:false,
			    processData:false,
			    success: function(data){
			 		  window.location.assign( window.location.href); 
			    }
	       });
		} 
	}
	function actualizar_titulo_admin(col,nombre,id){
		$.ajax({   
		   type: "post",

		   data:{col,nombre,id}, 
		   url:"../../../ajax/rector/admin/admin.php?action=actualizar_titulos1",
		   dataType:"text", 

			success:function(data){  
			 
			}  
		}); 
	}
	function liminar_titulo(ids){
		$.ajax({   
		   type: "post",

		   data:{ids}, 
		   url:"../../../ajax/rector/admin/admin.php?action=liminar_titulo",
		   dataType:"text", 

			success:function(data){  
			 	id=<?php echo $_GET['id'] ?> ;
				$.ajax({   
			        type: "post",

			        data:{id}, 
			        url:"../../../ajax/rector/admin/admin.php?action=titulos1",
			        dataType:"text", 

			        success:function(data){  
			            $('#titulos').html(data);
			        }  
			    });
			}  
		});
	}
	function nuev(){
		id=<?php echo $_GET['id'] ?>;
		$.ajax({   
			data:{id},
	        type: "post", 
	        url:"../../../ajax/rector/admin/admin.php?action=nuevo_titulo_admin",
	        dataType:"text", 

	        success:function(data){  
		        $.ajax({   
		        type: "post",

		        data:{id}, 
		        url:"../../../ajax/rector/admin/admin.php?action=titulos1",
		        dataType:"text", 

			        success:function(data){  
			            $('#titulos').html(data);
			        }  
		    	});    
	        }  
	    });		
	}
	function actualizar_hoja_admin1(col,nombre,id){
		$.ajax({   
	        type: "post",

	        data:{col,nombre,id}, 
	        url:"../../../ajax/rector/admin/admin.php?action=actualizar_admin",
	        dataType:"text", 

	        success:function(data){  
	             
	        }  
	    });
	}

	$(document).ready(function(){ 
		id=<?php echo $_GET['id'] ?> ;
		$.ajax({   
	        type: "post",

	        data:{id}, 
	        url:"../../../ajax/rector/admin/admin.php?action=titulos1",
	        dataType:"text", 

	        success:function(data){  
	            $('#titulos').html(data);
	        }  
	    }); 
	}); 

	 $(".my-select").chosen()({
	    placeholder: "Select a state",
	    allowClear: true
	});
</script>

<?php 
include('../enlaces/footer.php'); ?>
  <script type="text/javascript">
   
    </script>




</body>

</html>
