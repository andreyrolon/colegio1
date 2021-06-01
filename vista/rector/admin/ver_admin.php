 
<!-- Google Font -->
<?php 
require_once "../../codes/admin.php";

$c=new admin(); 
if(isset($_POST['registro']))
{ 
  $fecha1 = date('20y-m-d');
  move_uploaded_file($_FILES ['foto']['tmp_name'], '../../img/'.$_FILES ['foto']['name']);
  $destino= '../../img/'.$_FILES ['foto']['name'];


  $c->registrar( $_POST['NOMBRE'],  $_POST['APELLIDO'], $_POST['TIPO_DOCUMENTO'], $_POST['NUMERO_DOCUMENTO'], $_POST['FECHA_NACIMIENTO'], $_POST['LUGAR_NACIMIENTO'], $_POST['DIRECCION'], $_POST['BARRIO'], $_POST['CELULAR'], $_POST['TELEFONO_CA'], $_POST['ROL'], $_POST['CLAVE'], $destino, $_POST['CORREO'], $_POST['GENERO'],$_POST['ESCALAFON'],$fecha1,$_POST['sede'],$_POST['jornada'],$_POST['nombre'],$_POST['institucion'],$_POST['ano']);


}
$variable=$c->mostrar();
include('../../codes/sede.php');
$ui='';
$cs=new sede();
$sede=$cs->mostrar($ui);
include('../../codes/jornada.php');

$csa=new jornada();
$aaaa=$csa->mostrar();

foreach ($variable as $key ) {
 $NOMBRE= $key['NOMBRE'];
 $APELLIDO=$key['APELLIDO'];
 $TIPO_DOCUMENTO=$key['TIPO_DOCUMENTO'];
 $NUMERO_DOCUMENTO=$key['NUMERO_DOCUMENTO'];
 $FECHA_NACIMIENTO=$key['FECHA_NACIMIENTO'];
 $LUGAR_NACIMIENTO=$key['LUGAR_NACIMIENTO'];
  $DIRECCION=$key['DIRECCION'];
  $BARRIO=$key['BARRIO'];
  $CELULAR=$key['CELULAR'];
  $TELEFONO_CA=$key['TELEFONO_CA'];
  $ROL=$key['ROL'];
  $CLAVE=$key['CLAVE'];
  $FOTO=$key['FOTO'];
  $CORREO=$key['CORREO'];
  $GENERO=$key['GENERO'];
  $ESCALAFON=$key['ESCALAFON'];
  $NOMBRE_J=$key['NOMBRE_J'];
  $NOMBRE_S=$key['NOMBRE_S']; 

}


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
        
                        <form   method="post"  enctype="multipart/form-data" >
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
                  <select name="sede"  id="sede" class="form-control"  required>
                    <option value=""><?php  echo $key['NOMBRE_S'] ; ?> </option>
                    <?php foreach ($sede as $key ) {?>
                      <option value="<?php  echo $key['ID_SEDE'] ; ?>"><?php  echo $key["NOMBRE"] ; ?>                
                      </option>  <?php } ?>
                    </select>
                  </td>
                  <th  align="right"><div align="right">Rol:</div></th>
                  <td width="21%">
                    <select name="ROL" class="form-control" placeholder="Rol"    required >
                      <option value=""><?php  echo $key['ROL'] ; ?></option>
                      <option value="Secretaria">Secretaria</option>
                      <option value="Pagadores">Pagadores</option>
                      <option value="Psicoorientadores">Psicoorientadores</option>
                      <option value="Coordinacion">Coordinacion</option>
                      <option value="Rectoria">Rectoria</option>

                    </select>

                      </td>
                  <td width="29%" rowspan="5" colspan="2">
                    <div align="center" > 

                      <output id="list">
                        <input type="file" id="files" name="foto"   onclick="s()">
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

            document.getElementById('boton').onclick=function(){


                             c1=document.getElementById('c1').value;

                c2=document.getElementById('c2').value;

      
        
                if(c2!=c1){
                 document.getElementById('c1').value='';

                    document.getElementById('c2').value='';

                    document.getElementById('c1').focus();
                  
                    swal("contraseña y confirmacion son incorectas!", "", "error"); 
                    return false;
                }
                  
              var fileSize = $('#files')[0].files[0].size; 
                var l = parseInt(fileSize);

                if(l>=42448788){

                   alert('la imagen pesama mas de kb 42448 ');
                   return false;
                }
    
                var str =document.getElementById('files').value ;
                var res = str.substring(16);
                var n = res.length;
                
                if(n>=10){ 
     
                   alert('el nombre de la imagen tiene mas de diez caracteres'); 
                   return false;
                } 
            }
        }









function s() {

   var v =document.getElementById('v').value ;
    if(v==0){
alert('el nombre de la imagen debe ser menor o igual a dies carcteres y debe tener un peso menor de kb 42447')
    document.getElementById('v').value=1 ;
    }
 }





        </script>

      </div></td>
  </tr>
  <tr><input type='hidden' id='v'>
    <th align="right" ><div align="right">Tipo:</div></th>
    <td >
      <select name="TIPO_DOCUMENTO" class="form-control" required>
        <option value="CC" style="top: 0;padding: 10px" >Cedula de Ciudadania</option>
        <option value="TI" >Tarjeta de Identidad</option>
        <option value="CE" >Cedula Extranjeria</option>
        <option value="RC" >Registro Civil</option>
      </select></td>
      <th  align="right"><div align="right">Identificacion:</div></th>
      <td>
        <input name="NUMERO_DOCUMENTO" type="text"  class="form-control" placeholder="Numero de Documento"   pattern="[0-9]{7,}" title="Ingrese solo numeros mayores a seis digitos " value="<?php echo $NUMERO_DOCUMENTO ?>" required="" ></td>
      </tr>
      <tr> 
        <th align="right"><div align="right">Apellidos:</div></th>
        <td><input name="APELLIDO" type="text"  class="form-control" placeholder="Primer Apellido" value="<?php echo $APELLIDO ?>" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"  required=""  ></td>
      </tr>
      <tr> 
        <th align="right"><div align="right">Nombres:</div></th>
        <td><input name="NOMBRE" type="text"  class="form-control" placeholder="Primer Nombre" value="<?php echo $NOMBRE ?>" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"  required=""></td>
      </tr>
      <tr>
        <th  align="right" ><div align="right">Direccion:</div></th>
        <td><input name="DIRECCION" type="text"  class="form-control" placeholder="Dirección" value="<?php echo $DIRECCION ?>" pattern=".{1,25}" title="solo soporta 25  caracteres"  required=""></td>
        <th align="right"><div align="right">Barrio:</div></th>
        <td>
          <input name="BARRIO" type="text"  class="form-control" placeholder="Barrio" value="" value="<?php echo $BARRIO ?>" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"  required="" ></td>
        </tr>
        <tr>
          <th align="right"><div align="right">Telefono:</div></th>
          <td><input name="TELEFONO_CA" type="text"  class="form-control" placeholder="Telefono" value="<?php echo $TELEFONO_CA ?>"   pattern="([0-9]{7})" title="Ingrese solo numeros de Siete  digitos "   >
          </td>
          <th align="right"><div align="right">Celular:</div></th>
          <td colspan="2"><input name="CELULAR" type="text"  class="form-control" placeholder="Celular" value="<?php echo $CELULAR ?>"    pattern="([0-9]{10})" title="Ingrese solo numeros de Diez digitos "  ></td>
        </tr>
        <tr>
          <th align="right"><div align="right">Fecha de Nacimiento:</div></th>
          <td><input name="FECHA_NACIMIENTO" type="date"  class="form-control" placeholder="Fecha de Nacimiento" value="<?php echo $FECHA_NACIMIENTO ?>" required>
          </td>
          <th align="right"><div align="right">Lugar de Nacimiento:</div></th>
          <td  ><input name="LUGAR_NACIMIENTO" type="text"  class="form-control" placeholder="Lugar de Nacimiento" value="<?php echo $LUGAR_NACIMIENTO ?>"   required ></td>
        </tr>
        <tr>
          <th align="right"><div align="right">Email:</div></th>
          <td>
            <span id="sprytextfield1">
              <input name="CORREO" type="email"  class="form-control" placeholder="Correo" value="<?php echo $CORREO ?>"   > </td>
              <th align="right"><div align="right">G&eacute;nero:</div></th>
              <td colspan="2">
                femenino  <input type="radio" name="GENERO"  value="Femenino">   masculino  <input type="radio" value="Masculino" name="GENERO"></td>

              </tr>
              <tr>
                <th align="right"><div align="right"></div></th>
                <td colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
              </tr>
              <tr>
                <th align="right"><div align="right">Jornada:</div></th>
                <td>
                  <select name="jornada"  id="jornada" class="form-control"  required>
                    <option value=""><?php echo $NOMBRE_J ?></option>
                    <?php foreach ($aaaa as $aa ) {?>
                      <option value="<?php  echo $aa['ID_JORNADA'] ; ?>"><?php  echo $aa["NOMBRE"] ; ?>               
                      </option>  <?php } ?>
                    </select>
                  </td>
                  <th align="right" ><div align="right"><strong>Clave de Acceso: </strong> <br><br><strong>Autentificacion de Clave: </strong></div></th>
                  <td colspan="2">

                    <input name="CLAVE" id="c1" type="password"  class="form-control" placeholder="Clave" value=""  required="" >    
                    <input  id="c2" type="password"  class="form-control" placeholder="Clave" value=""  required="" >

                  </td>
                </tr>
                <tr>
                </tr>
                <tr>

                  <th align="right" ><div align="right">Escalaf&oacute;n:</div></th>
                  <td colspan="2"><label>
                    <input name="ESCALAFON" type="text"  class="form-control"  value="<?php echo $ESCALAFON ?>"   >
                  </label></td><td></td>
                </tr>
              </table> 
          </div>

            <h3 class="bg-primary text-center pad-basic no-btm">Nivel Educativo </h3>

            <table class="table bg-info"  id="tabla">
              <tr > 
                <td><input  value="" class="form-control"  name="nombre[]" placeholder="titulo adquirido" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"/></td>
                <td><input  value=""  class="form-control" name="institucion[]" placeholder="institucion" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"/></td>
                <td><input   class="form-control"  value=""  name="ano[]" placeholder="año"  pattern="[0-9]{4}" title="ingrese solo cuatro  caracteres "></td>
                <td class="eliminar" id="e" style="display: none;"><input type="button"    value="Menos -"/></td>
              </tr class="fila-fija" >
            </table>







            <input   type="submit" class="btn btn-info" style="
            text-align: left;" id="boton" value="registro" name="registro" />
            <button id="adicional" name="adicional"  style="
            text-align: right;"  type="button" class="btn btn-warning"> Más + </button>
          
        </form>


      </div> 
      <?php include('../enlaces/footer.php'); ?>