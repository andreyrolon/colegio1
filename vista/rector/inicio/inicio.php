 
<!-- Google Font -->
<?php include('../../codes/sede.php');
   
       $c=new sede();
       $sede=$c->mostrar();


 ?>
<?php include('../enlaces/head.php'); ?>

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
				<form id="form1" name="form1" method="post" action="admin_administrativo_editar.php">
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
		  	<select name="sede"  id="sede"  required>
		  		   <option value=""> </option>
		  		   <?php foreach ($sede as $key ) {?>
		  		   	<option value="<?php  echo $key['id'] ; ?>"><?php  echo $key["NOMBRE"] ; ?>		  		   		
		  		   	</option>  <?php } ?>
		  		   </select>
		  </td>
		  <th  align="right"><div align="right">Cargo:</div></th>
		  <td width="21%">
		  	<select name="cargo" id="cargo" required>
		  		<option value="Rector">Rector</option>
		  		<option value="Coordinador">Coordinador</option>
		  		<option value="Secretaria">Secretaria</option>
		  		<option value="Psicoorientador">Psicoorientador</option>
		  		<option value="Auxiliar Administrativo">Auxiliar Administrativo</option>

		  		<option value="Docente">Docente</option>

		  	</select>  	</td>
        <td width="29%" rowspan="5" colspan="2">
        	<div align="center" >	

 <output id="list">
        		 <input type="file" id="files" name="foto" /  onclick="myFunction()">
          </output>
         
        <script>

function myFunction(){
              function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("list").innerHTML = ['<img  width="160" height="190" top="0" src="', e.target.result,'" title="', escape(theFile.name),  '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
    document.getElementById("files").style.display = "none";
              document.getElementById('files').addEventListener('change', archivo, false);}
      </script>  
                </div></td>
	  </tr>
		<tr>
		  <th align="right" ><div align="right">Tipo:</div></th>
		  <td ><select name="tipodocumento" tabindex="1" required>
		    <option value="CC" style="top: 0;padding: 10px" >Cedula de Ciudadania</option>
		    <option value="TI" >Tarjeta de Identidad</option>
		    <option value="CE" >Cedula Extranjeria</option>
		    <option value="RC" >Registro Civil</option>
          </select></td>
		  <th  align="right"><div align="right">Identificacion:</div></th>
		  <td><input name="dociden" type="number" readonly style="color:#666" value="" required /></td>
	    </tr>
		<tr>
		  <th scope="row"><div align="right">Primer Apellido:</div></th>
		  <td><input name="apellido1" type="text" value="" id="apellido1" /></td>
		  <th align="right"><div align="right">Segundo Apellido:</div></th>
		  <td><input name="apellido2" type="text" value="" id="apellido2" onBlur="this.value=this.value.toUpperCase()" /></td>
	    </tr>
		<tr>
		  <th align="right"><div align="right">Primer Nombre:</div></th>
		  <td><input name="nombre1" type="text" value="" id="nombre1" /></td>
		  <th align="right"><div align="right">Segundo Nombre:</div></th>
		  <td><input name="nombre2" type="text" value="" id="nombre2" /></td>
	    </tr>
		<tr>
		  <th  align="right" ><div align="right">Direccion:</div></th>
		  <td><input name="direccion" type="text" value="" id="direccion" /></td>
		  <th align="right"><div align="right">Barrio:</div></th>
		  <td><input name="barrio" type="text" value="" id="barrio"  /></td>
	    </tr>
		<tr>
		  <th align="right"><div align="right">Telefono:</div></th>
		  <td><input name="telefono" type="text" value="" /></td>
		  <th align="right"><div align="right">Celular:</div></th>
		  <td colspan="2"><input name="celular" type="text" value="" /></td>
	    </tr>
		<tr>
		  <th align="right"><div align="right">Fecha de Nacimiento:</div></th>
		  <td><input id="fechana" name="fechana" readonly type="text" value="" size="15" />
          </td>
		  <th align="right"><div align="right">Lugar de Nacimiento:</div></th>
		  <td colspan="2"><input name="lugarna" re type="text" value="" id="Lugarma" onBlur="this.value=this.value.toUpperCase()"/></td>
	    </tr>
		<tr>
		  <th align="right"><div align="right">Email:</div></th>
		  <td>
          <span id="sprytextfield1">
          <input name="email" type="text" id="email" placeholder="ejemplo: nombrecorreo@servidor.com" value="" size="55" maxlength="50" />
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
          <th align="right"><div align="right">G&eacute;nero:</div></th>
		  <td colspan="2"><label for="genero"></label>
		    <select name="genero" id="genero">
		      <option value="Masculino" >Masculino</option>
		      <option value="Femenino" >Femenino</option>
          </select></td>
		  
	  </tr>
		<tr>
		  <th align="right"><div align="right"></div></th>
		  <td colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
	  </tr>
		<tr>
			<th align="right"><div align="right">Jornada:</div></th>
			<td><select name="idjornada" tabindex="1" title="C">
              			  <option value="C">Completa</option>
			  			  <option value="F">Sábado y Domingo</option>
			  			  <option value="M">Mañana</option>
			  			  <option value="N">Noche</option>
			  			  <option value="S">Sábado</option>
			  			  <option value="T">Tarde</option>
			              </select></td>
		  <th align="right" ><div align="right"><strong>Clave de Acceso: </strong></div></th>
		  <td colspan="2">
          
          <input name="clave" type="password" value="" />          </td>
	    </tr>
		<tr>
		  <th colspan="5" align="center" class="titulo_seccion">DATOS LABORALES</th>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Decreto de Nombramiento:</div></th>
		  <td><label>
		    <input type="text" name="decreto" id="decreto" value="" />
	      </label></td>
		  <th align="right" ><div align="right">Escalaf&oacute;n:</div></th>
		  <td colspan="2"><label>
		    <input type="text" name="escalafon" id="escalafon" value="" />
	      </label></td>
	  </tr>
</table>
      <table align="center" border="1" width="100%">
		<tr>
		  <th colspan="5" align="center" class="titulo_seccion">DATOS ACAD&Eacute;MICOS</th>
	  </tr>
		<tr>
		  <th width="15%" class="titulo_columna">Nivel</th>
		  <th width="38%" class="titulo_columna">T&iacute;tulo</th>
		  <th width="10%"  class="titulo_columna"><div align="center">A&ntilde;o</div></th>
		  <th width="37%" class="titulo_columna" colspan="2">Instituci&oacute;n</th>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Primaria</div></th>
		  <td><label>
		    <input name="titulo_ba" type="text" id="titulo_ba" size="40" value="" />
	      </label></td>
		  <td align="center" ><label>
		    <input type="text" name="ano_pri" id="ano_pri" value="" />
	      </label></td>
		  <td colspan="2"><label>
		    <input name="institucion_pri" type="text" id="institucion_pri" size="40" value=""/>
	      </label></td>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Bachillerato</div></th>
		  <td><label>
		    <input name="titulo_ba" type="text" id="titulo_ba" size="40" value="" />
	      </label></td>
		  <td align="right" ><label>
		    <input type="text" name="ano_ba" id="ano_ba" value="" />
	      </label></td>
		  <td colspan="2"><label>
		    <input name="institucion_ba" type="text" id="institucion_ba" size="40" value="" />
	      </label></td>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Pregrado</div></th>
		  <td><label>
		    <input name="titulo_pre" type="text" id="titulo_pre" size="40" value="" />
	      </label></td>
		  <td align="right" ><label>
		    <input type="text" name="ano_pre" id="ano_pre" value="" />
	      </label></td>
		  <td colspan="2"><label>
		    <input name="institucion_pre" type="text" id="institucion_pre" size="40" value="" />
	      </label></td>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Especializaci&oacute;n</div></th>
		  <td><label>
		    <input name="titulo_es" type="text" id="titulo_es" size="40" value="" />
	      </label></td>
		  <td align="right" ><label>
		    <input type="text" name="ano_es" id="ano_es" value="" />
	      </label></td>
		  <td colspan="2"><label>
		    <input name="institucion_es" type="text" id="institucion_es" size="40" value="" />
	      </label></td>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Maestr&iacute;a</div></th>
		  <td><label>
		    <input name="titulo_ma" type="text" id="titulo_ma" size="40" value="" />
	      </label></td>
		  <td align="right" ><label>
		    <input type="text" name="ano_ma" id="ano_ma" value=""/>
	      </label></td>
		  <td colspan="2"><label>
		    <input name="institucion_ma" type="text" id="institucion_ma" size="40" value=""/>
	      </label></td>
	  </tr>
		<tr>
		  <th align="right"><div align="right">Otros</div></th>
		  <td><label>
		    <input name="titulo_o" type="text" id="titulo_o" size="40" value="" />
	      </label></td>
		  <td align="right" ><label>
		    <input type="text" name="ano_o" id="ano_o" value="" />
	      </label></td>
		  <td colspan="2"><label>
		    <input name="institucion_o" type="text" id="institucion_o" size="40" value="" />
	      </label></td>
	  </tr>
 		<tr>
		 <th colspan="5" class="titulo_seccion">OTROS ESTUDIOS</th>
		  </tr>
		<tr>
		<tr>
        	<th><div align="right">Formación:</div>
            <div style="text-align-last:right; color:#999">(Requiere<br /> certificación)</div>
            </th>
            <td  colspan="4"><textarea name="formacion" cols="80%" rows="6"></textarea></td>
		</tr>
		<tr>
        	<th><div align="right">Capacitación:</div>
            <div style="text-align-last:right; color:#999">(No requiere<br /> certificación)</div>
            </th>
            <td  colspan="4"><textarea name="capacitacion" cols="80%" rows="6"></textarea></td>
		</tr>
		<tr>
        	<th><div align="right">Habilidades:</div>
            <div style="text-align-last:right; color:#999">(Talentos o<br />  destrezas)</div></th>
            <td  colspan="4"><textarea name="habilidades" cols="80%" rows="6"></textarea></td>
 
  </table>
<table width="100%" border="0">
	<!--DWLayoutTable-->
	<tr>
   	<td class="titulo_columna"><div align="center">
    <input type="hidden" name="botoned" value="" />
 	<input type="hidden" name="tipo" value="" />
		<input name="boton4" type="submit" class="botonCancelar" id="boton" value="Cancelar" />
		</div></td>
	</tr>
</table>
</div>
</form>
 
		</div> 
				<?php include('../enlaces/footer.php'); ?>