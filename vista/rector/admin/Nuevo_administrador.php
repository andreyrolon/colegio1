 
<!-- Google Font -->
<?php 
 


include('../enlaces/head.php'); ?>

<style type="text/css">
#cssmenu li { margin: 0; padding: 0;}
#cssmenu ul { margin: 60; padding: 60;}
#cssmenu a { margin: 0; padding: 0;}
#cssmenu ul {list-style: none;}
#cssmenu a {text-decoration: none;}
#cssmenu > ul > li {
	float: left;
	list-style-type: none;
	padding: 0; 	
	margin: auto;
	text-align: mensacenter;	
	position: relative;
	left:150px;
}
#cssmenu > ul > li > a {
	color: rgb(250,250,250);
	font-family: Verdana, 'Lucida Grande';
	font-size: 12px;
	line-height: 70px;
	padding: 15px 20px;
	z-index: 999;
	-webkit-transition: color .15s;
	-moz-transition: color .15s;
	-o-transition: color .15s;
	transition: color .15s;
}
#cssmenu > ul > li > a:hover {color: rgb(160,160,160); }

/*Menu*/
#cssmenu > ul > li > ul {
	opacity: 0;
	visibility: hidden;
	padding: 10px 0 10px 0;
	background-color: rgb(250,250,250);
	text-align: left;
	position: absolute;
	top: 55px;
	left: 50%;
	margin-left: -90px;
	width: 200px;
	z-index: 999;
	-webkit-transition: all .3s .1s;
	-moz-transition: all .3s .1s;
	-o-transition: all .3s .1s;
	transition: all .3s .1s;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0px 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0px 1px 3px rgba(0,0,0,.4);
	box-shadow: 0px 1px 3px rgba(0,0,0,.4);
}
#cssmenu > ul > li:hover > ul {
	opacity: 1;
	top: 65px;
	visibility: visible;
}

#cssmenu > ul > li > ul:before{
	content: '';
	display: block;
	border-color: transparent transparent rgb(250,250,250) transparent;
	border-style: solid;
	border-width: 10px;
	position: absolute;
	top: -20px;
	left: 50%;
	z-index: 999;
	margin-left: -10px;
}
#cssmenu > ul ul > li { position: relative;}

#cssmenu ul ul a{
	color: rgb(50,50,50);
	font-family: Verdana, 'Lucida Grande';
	font-size: 13px;
	background-color: rgb(250,250,250);
	padding: 5px 8px 7px 16px;
	z-index: 999;
	display: block;
	-webkit-transition: background-color .1s;
	-moz-transition: background-color .1s;
	-o-transition: background-color .1s;
	transition: background-color .1s;
}

#cssmenu ul ul a:hover {background-color: rgb(240,240,240);}

#reportes_docente{
	position:absolute;
	right:10px;
	top: 10px;

}

.inicio{
	padding-left:5px;
	padding-top:20px;
}
/*submenu*/
#cssmenu ul ul ul {
	visibility: hidden;
	opacity: 0;
	position: absolute;
	top: -10px;
	left: 200px;
	padding: 10px 0 10px 0;
	background-color: rgb(250,250,250);
	text-align: left;
	z-index: 999;
	width: 200px;
	-webkit-transition: all .3s;
	-moz-transition: all .3s;
	-o-transition: all .3s;
	transition: all .3s;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0px 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0px 1px 3px rgba(0,0,0,.4);
	box-shadow: 0px 1px 3px rgba(0,0,0,.4);
}
#cssmenu ul ul > li:hover > ul { opacity: 1; left: 20 px; visibility: visible;}
#cssmenu ul ul a:hover{
	background-color: rgb(171,213,245);
	color: rgb(240,240,240);
}

#videos_docente{
	position:absolute;
	right:60px;
	top: 10px;

}

#escudo_colegio{
	position:absolute;
	float: left;
	top: 10px;
	left:20px;
}
.titulo_colegio1 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8px;
	font-style: italic;
	font-weight: bold;
	color: #FFF;
	text-shadow: 0.1em 0.1em #333;
	background-color: #369;
}
.titulo_colegio2 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	font-style: italic;
	font-weight: bold;
	color: #FFF;
	text-shadow: 0.1em 0.1em #333;
	background-color: #369;
}
.titulo_colegio3 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	font-style: italic;
	font-weight: bold;
	color: #FFF;
	text-shadow: 0.1em 0.1em #333;
	background-color: #369;
	width:250px;
}
#guion{
	float:right;	
}

</style>
<!--==============================header=================================-->
<header> 
	<body class="hold-transition skin-blue sidebar-mini">


		<div class="wrapper">
			<?php include('../enlaces/header.php'); ?>


			<!-- AQUI VA EL CONTENIDO -->
			<div class="content-wrapper"> 
      <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
					<input type="hidden" name="idadministrativo" value="">
					<input type="hidden" name="nit" value="8" />
					<div class="contenedor3">
						<table width="100%" border="1" align="center"><!--DWLayoutTable-->

							<tr>
								<th colspan="5" style="font-size: 20px;font-family: initial;" ><center>DATOS PERSONALES</center></th>
							</tr>

							<tr>
								<th align="right">
									<div align="right">
										sede:
									</div>
								</th>
								<td class="celda1" >
									<select name="sede"  id="sede" class="form-control select2"  required>
									 
										</select>
									</td>
									<th  align="right"><div align="right">Rol:</div></th>
									<td width="21%">
										<select name="ROL" id="ROL" class="form-control" >
											<option value="">Rol</option>
											<option value="Secretarias">Secretarias</option>
											<option value="Pagadores">Pagadores</option>
											<option value="Psicoorientadores">Psicoorientadores</option>
											<option value="Coordinares">Coordinares</option>
											<option value="Rector">Rector</option>

										</select>

									   	</td>
									<td width="29%" rowspan="5" colspan="2">
										<div align="center" >	

											<output id="list">
												<input type="file" id="foto" name="foto"    >
											</output>

								 

      <script>

      	$(function(){ 
				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
				});

				// Evento que selecciona la fila y la elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
	    });


      	window.onload=function(){

      		var nom;  


      		document.getElementById('adicional').onclick=function(){

      			document.getElementById('e').style.display = "block";
            }
 
        }









 




      	</script>

      </div></td>
  </tr>
  <tr><input type='hidden' id='v'>
  	<th align="right" ><div align="right">Tipo:</div></th>
  	<td >
  		<select name="TIPO_DOCUMENTO" id="TIPO_DOCUMENTO" class="form-control" >
  			<option value="Cedula de Ciudadania" style="top: 0;padding: 10px" >Cedula de Ciudadania</option>
  			
  			<option value="Cedula Extranjeria" >Cedula Extranjeria</option>
  			<option value="Tarjeta de Identidad" >Tarjeta de Identidad</option>
  			<option value="Registro Civil" >Registro Civil</option>
  		</select></td>
  		<th  align="right"><div align="right">Identificacion:</div></th>
  		<td>
  			<input name="NUMERO_DOCUMENTO" id="NUMERO_DOCUMENTO" type="text"  class="form-control" placeholder="Numero de Documento"   ></td>
  		</tr>
  		<tr> 
  			<th align="right"><div align="right">Apellidos:</div></th>
  			<td><input name="APELLIDO" id="APELLIDO" type="text"  class="form-control" ></td>
  		</tr>
  		<tr> 
  			<th align="right"><div align="right">Nombres:</div></th>
  			<td><input name="NOMBRE" id="NOMBRE" type="text"  class="form-control" ></td>
  		</tr>
  		<tr>
  			<th  align="right" ><div align="right">Direccion:</div></th>
  			<td><input name="DIRECCION" id="DIRECCION" type="text"  class="form-control" ></td>
  			<th align="right"><div align="right">Barrio:</div></th>
  			<td>
  				<input name="BARRIO" id="BARRIO" type="text"  class="form-control" ></td>
  			</tr>
  			<tr>
  				<th align="right"><div align="right">Telefono:</div></th>
  				<td><input name="TELEFONO_CA" id="TELEFONO_CA" type="text"  class="form-control" placeholder="Telefono" >
  				</td>
  				<th align="right"><div align="right">Celular:</div></th>
  				<td colspan="2"><input name="CELULAR" id="CELULAR" type="text"  class="form-control" placeholder="Celular" ></td>
  			</tr>
  			<tr>
  				<th align="right"><div align="right">Fecha de Nacimiento:</div></th>
  				<td><input name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" type="date"  class="form-control" >
  				</td>
  				<th align="right"><div align="right">Lugar de Nacimiento:</div></th>
  				<td  ><input name="LUGAR_NACIMIENTO" id="LUGAR_NACIMIENTO" type="text"  class="form-control"  ></td>
  			</tr>
  			<tr>
  				<th align="right"><div align="right">Email:</div></th>
  				<td>
  					<span id="sprytextfield1">
  						<input name="CORREO" id="CORREO" type="email"  class="form-control" > </td>
  						<th align="right"><div align="right">G&eacute;nero:</div></th>
  						<td colspan="2">
  							femenino	<input type="radio" name="GENERO"  value="Femenino">   masculino	<input type="radio" value="Masculino" name="GENERO"></td>

  						</tr>
  						<tr>
  							<th align="right"><div align="right"></div></th>
  							<td colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
  						</tr>
  						<tr>
  							<th align="right"><div align="right">Clave de Acceso:</div></th>
  							<td>
  							
  									<input name="CLAVE" id="CLAVE" type="password"  class="form-control" placeholder="Clave"  > 
  								</td>
  								<th align="right" ><div align="right"> <strong>Autentificacion de Clave: </strong></div></th>
  								<td colspan="2">
   
  									<input  id="c2" type="password"   class="form-control" placeholder="Clave" value=""  >

  								</td>
  							</tr>
  							<tr>
  							</tr>
  							<tr>

  								<th align="right" ><div align="right">Escalaf&oacute;n:</div></th>
  								<td colspan="2"><label>
  									<input name="ESCALAFON" id="ESCALAFON" type="text"  class="form-control"  value=""   sty>
  								</label></td><th><div align="right"> fecha de ingreso en la institucion </div></th><td><input type="date" name="fecha2" id="fecha2"></td>
  							</tr>
  							<tr><td><strong>fecha de nombramiento:</strong></td><td><input type="date" class="form-control" name="fecha_nombramiento" id="fecha_nombramiento"></td>
								<td><strong>decreto nombramiento:</strong></td><td><input type="text" class="form-control" name="decreto_nombramiento" id="decreto_nombramiento"></td>
  							</tr>
  						</table> 
  				</div>
<input type="hidden" name="ad" id="ad">
  					<h3 class="bg-primary text-center pad-basic no-btm">Nivel Educativo </h3>

  					<table class="table bg-info"  id="tabla">
  						<tr > 
  							<td><input  value="" class="form-control"  name="nombre[]" placeholder="titulo adquirido"  /></td>
  							<td><input  value=""  class="form-control" name="institucion[]" placeholder="institucion"      /></td>
  							<td><input   class="form-control"  value=""  name="ano[]" placeholder="año"  ></td>
  							<td class="eliminar" id="e" style="display: none;"><input type="button"    value="Menos -"/></td>
  						</tr class="fila-fija" >
  					</table>







  					<input   type="button" class="btn btn-info" style="
  					text-align: left;" id="boton" value="registro" name="registro" onclick="nuevv()" />
  					<button id="adicional" name="adicional"  style="
  					text-align: right;"  type="button" class="btn btn-warning"> Más + </button>
  				
  			</form>
				<form name="formulario-envia1" id="formulario-envia1" enctype="multipart/form-data" method="post">
		<input type="file" name="ex">
		<input type="button" name="fds" value="sd" onclick="sasa()">
	</form>

  		</div>  
  		<script type="text/javascript">


  			function sasa() {
		 
		var parametros=new FormData($("#formulario-envia1")[0]);
		$.ajax({
			
			data:parametros,
			url:"../../../ajax/rector/admin/admin.php?action=excel",
			type:"POST",
			contentType:false,
			processData:false,
			success: function(data){
				alert(data);
			}
		   });
	}
  		 

            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=nuevo_grado",
             
                dataType: "text",
                success: function(data) {
                    $('#sede').html(data);
                }
            });
  			function nuevv(){ 
    var sede=document.getElementById("sede").value;
    var ROL=document.getElementById("ROL").value;
 
    var TIPO_DOCUMENTO=document.getElementById("TIPO_DOCUMENTO").value;
    var NUMERO_DOCUMENTO=document.getElementById("NUMERO_DOCUMENTO").value;
    var APELLIDO=document.getElementById("APELLIDO").value; 
    
    var NOMBRE=document.getElementById("NOMBRE").value; 
    
    var DIRECCION=document.getElementById("DIRECCION").value; 
    
    var BARRIO=document.getElementById("BARRIO").value; 
    
    var TELEFONO_CA=document.getElementById("TELEFONO_CA").value; 
    
    var CELULAR=document.getElementById("CELULAR").value; 
    
    var FECHA_NACIMIENTO=document.getElementById("FECHA_NACIMIENTO").value; 
    
    var LUGAR_NACIMIENTO=document.getElementById("LUGAR_NACIMIENTO").value; 
    
    var CORREO=document.getElementById("CORREO").value; 
    
    var CLAVE=document.getElementById("CLAVE").value; 
    
    var ESCALAFON=document.getElementById("ESCALAFON").value; 
 
  

  
   
  



    		var archivoRuta = document.getElementById('foto').value;
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
		if(vacio==archivoRuta){
			
				document.getElementById('ad').value='';
			        var parametros=new FormData($("#formulario-envia")[0]);
	        $.ajax({
	      
			    data:parametros,
			    url:"../../../ajax/rector/admin/admin.php?action=registro",
			    type:"POST",
			    contentType:false,
			    processData:false,
			    success: function(data){
			 		alert(data);
			    }
	       });
		}
		if(extPermitidas3.exec(archivoRuta)){
			
			document.getElementById('ad').value='.jpg';
			        var parametros=new FormData($("#formulario-envia")[0]);
	        $.ajax({
	      
			    data:parametros,
			    url:"../../../ajax/rector/admin/admin.php?action=registro",
			    type:"POST",
			    contentType:false,
			    processData:false,
			    success: function(data){
			 		alert(data);
			    }
	       });
		}
		if(extPermitidas4.exec(archivoRuta)){
			
			document.getElementById('ad').value='.png';
			        var parametros=new FormData($("#formulario-envia")[0]);
	        $.ajax({
	      
			    data:parametros,
			    url:"../../../ajax/rector/admin/admin.php?action=registro",
			    type:"POST",
			    contentType:false,
			    processData:false,
			    success: function(data){
			 		alert(data);
			    }
	       });
		} 

		
	    
    }
  








  		</script><?php include('../enlaces/footer.php'); ?>