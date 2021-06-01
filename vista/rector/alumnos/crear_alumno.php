<!-- Google Font -->
<!-- Google Font -->
<?php 


session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.php"); echo($_SESSION['Session']);
}
require_once "../../../codes/rector/admin.php";
$admin=new admin();
$pais=$admin->pais();
$salud=$admin->salud();
include '../../../codes/rector/docente.php';
$periodo=new docente();
$sql1=$periodo->ver_periodos1(); 





include('../enlaces/head.php'); ?>
<body >
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
 <?php 

$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>


 " class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  "> 
      <section id="content" class="content">




        
        <div class="modal in" id="agregar_salud" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post">  
                  <div class="modal-header btn-primary table-responsive">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                    <h4 id="titulo4" class="modal-title">  Filiacion de salud</h4>
                  </div> 

                  <div class="modal-body table-responsive" id="pdf">
                    <div id="_MSG8_" style="margin-bottom: 10px"></div>
                    <strong>Nombre de la Empresa Afiliadora</strong>
                    <input type=""id='nombre_salud' class="form-control" name=""> 
                    
                     
                  </div>
                  <div class="modal-footer">   <button type="button" onclick="var nombre=document.getElementById('nombre_salud').value; agregar_salud(nombre)" class="btn  btn-block btn-danger" name="eliminary2" id="eliminary2" onclick="" value="520">Registra</button> 
                      <button type="button" class="btn  btn-block btn-default" data-dismiss="modal">Cancelar</button> 
                      
                  </div>
                </form>
              </div>
            </div>
        </div>

        
        <div class="modal in" id="my" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post">  
                  <div class="modal-header btn-primary table-responsive">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                    <h4 id="titulo4" class="modal-title">   Agregar Pais al sistema</h4>
                  </div> 

                  <div class="modal-body table-responsive" id="pdf">
                    <div id="_MSG6_" style="margin-bottom: 10px"></div>
                    <strong>Nombre del pais</strong>
                    <input type=""id='papa' class="form-control" name=""> 
                    
                     
                  </div>
                  <div class="modal-footer">   <button type="button" onclick="var pais=document.getElementById('papa').value; insert(pais)" class="btn  btn-block btn-danger" name="eliminary2" id="eliminary2" onclick="" value="520">Registra</button> 
                      <button type="button" class="btn  btn-block btn-default" data-dismiss="modal">Cancelar</button> 
                      
                  </div>
                </form>
              </div>
            </div>
        </div>
        <div class="modal in" id="my22" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post">  
                  <div class="modal-header btn-primary table-responsive">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                    <h4 id="titulo4" class="modal-title">   Agregar Departamento al sistema</h4>
                  </div> 
  
                  <div class="modal-body table-responsive" id="pdf">
                    <div id="_MSG7_"></div>
                    <strong>Nombre del pais</strong><br>
                    <select    id='papi' class="form-control select2"  style=" width: 100%" onchange='var id=document.getElementById("papi").value; pais3(id)' required>
                              <option value="">Seleccione un pais</option>
                              <?php foreach ($pais as $key ) {?>
                                <option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?></option>
                                <?php
                              } ?> 
                            </select><br><br>
                    <strong>Nombre del departamento</strong>
                    <input type=""id='papaaa' class="form-control" name=""> 
                    <div class="modal-footer">   
                      <button type="button" onclick="
                      var pais=document.getElementById('papi').value;

                      var departamento=document.getElementById('papaaa').value; insert2(pais,departamento)" class="btn  btn-block btn-danger" name="eliminary2" id="eliminary2" onclick="" value="520">Registra</button> 
                     <br>
                      <div id="bobo" class="box-header with-border" style="display: none"> <br>
                        <select id="mySelect" class="form-control" onchange="myFunction(1)" style="width:63px;">


                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                          </select>
                          <div class="box-tools pull-right"><br>
                              <div class="has-feedback">
                                  <input type="text" class="form-control   " id="fname" placeholder="buscador.." onkeyup="myFunction(1)" style="margin-top: 5px;">
                                  <span class="fa fa-search form-control-feedback" style=" "></span>
                              </div>
                          </div>
                          <!-- /.box-tools -->
                      </div>
                     <div id="ver_tabla"></div>
                     
                  </div>
                  
                      <button type="button" class="btn  btn-block btn-default" data-dismiss="modal">Cancelar</button> 
                      
                  </div>
                </form>
              </div>
            </div>
        </div>
        <div class="row">
          <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
            <div class="col-md-12" style="margin-top: -15px ">
             <br>
              <div id="_MSG_"></div> 
              <div id="sapo"></div>  
              <div class="nav-tabs-custom" id="koooo" style="    box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;"> 
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activitys" data-toggle="tab" aria-expanded="true">Informacion del alumno</a></li>
                  <li class=""><a href="#timeline1" data-toggle="tab" aria-expanded="false">Informacion de la madre</a></li>
                  <li class=""><a href="#timeline2" data-toggle="tab" aria-expanded="false">Informacion del padre </a></li>
                  <li class=""><a href="#timeline3" data-toggle="tab" aria-expanded="false">Informacion del acudiente </a></li>
                </ul><br>
                <div class="tab-content">
                  <div class="tab-pane active" id="activitys">
                    






                    <div class="row">
                      <div class="col-md-2">
                        <center><br>
                          <div > 
                            <img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" style="border-style: solid;
                            border-color: #d2d6de; height: 130px;width: 120px; " />
                          </div><br>
                          <div class="btn btn-default btn-file  ">
                            <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
                            <input type="file" name="imgh" id="imgh">
                          </div>
                        </center>
                      </div>
                      <div class="col-md-10" style="">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="nombre"><span data-toggle="modal" data-target="#my">+</span> Pais de nacimiento</label> 
                            <select   name="pais_nacimiento" id='PAIS' class="form-control select2"  style="  " onchange='var id=document.getElementById("PAIS").value; pais(id)' required>
                              <option value="">Seleccione un pais</option>
                              <?php foreach ($pais as $key ) {?>
                                <option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?></option>
                                <?php
                              } ?> 
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre"><span data-toggle="modal" data-target="#my22">+</span>  Departamento de N.</label>
                            <select class="form-control select2"  id="estado"   name="departamento_nacimiento" required>
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Ciudad de nacimiento</label>
                            <input type="" id="ciudad_nacimiento" class="form-control" name="ciudad_nacimiento" required>
                          </div>

                          <div class="col-md-3">
                            <label for="nombre">Tipo de documento</label>
                            <select name="tipo_documento"  id="tipo_documento" class="form-control"  required> 
                              <option value="T.I." >Tarjeta de Identidad (T.I.)</option>
                              <option value="C.C." >Cedula de Ciudadania (C.C.)</option>
                              <option value="C.E." >Cedula Extranjeria (C.E.)</option>
                              <option value="Pasaporte" >Pasaporte</option> 
                              <option value="PEP" >Permiso Especial Permanencia(PEP)</option> 
                              <option value="R.C." >Registro Civil (R.C.)</option>
                            </select>
                          </div>
                        </div>
                        <div class="row"><br>
                          <div class="col-md-3">
                            <label for="nombre">Numero documento</label>
                            <input name="numero_documento" id="numero_documento" type="text" class="form-control"    pattern="[0-9]{7,}" title="Ingrese solo numeros mayores a seis digitos " value=""   onblur="funcion()" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Pais expedición</label>
                            <select   name="pais_expedicion" id='PAIS2' class="form-control select2"   onchange='var id=document.getElementById("PAIS2").value; pais2(id)' required>
                              <option value="">Seleccione un pais</option>
                              <?php foreach ($pais as $key ) {?>
                                <option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?></option>
                                <?php
                              } ?> 
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Departamento expedición</label>
                            <select class="form-control select2" name="departamento_expedicion" id="estado2" required >
                              
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Ciudad expedición</label>
                            <input name="ciudad_expedicion"  id="ciudad_expedicion"  type="text" class="form-control"    value=""   required>
                          </div>
                          <br>
                        </div>
                        <div class="row"><br>
                          <div class="col-md-3">
                            <label for="nombre">Nombres</label>
                            <input   class="form-control" name="nombre" id="nombre" type="text" value="" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras" required >
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Apellidos</label>
                            <input   class="form-control" name="apellido" id="apellido" type="text" value="" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"  required> 
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                          </div>

                          <div class="col-md-1">
                            <label for="nombre">Edad</label>
                            <input    class="form-control" name="edad" type="text" id="edad" value=""  size="5" maxlength="2" pattern="([0-9]{2})"   required >
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Genero</label><br>
                            <select name="genero" id="genero" class="form-control"  >
                              <option value="1">Femenino</option>
                              <option value="0">Maculino</option>
                            </select>
                          </div>
                        </div><br>


                        <div class="row">
                          <div class="col-md-3">
                            <label for="nombre">Telefono o celular</label>
                            <input name="telefono" id="telefono_alumno" type="text" value="" class="form-control"    maxlength="10"   pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"     required />
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Direccion</label>
                            <input name="direccion" id="direccion_alumno" type="text" class="form-control"   pattern="([0-9,a-zA-ZÁÉÍÓÚñáéíóú-]{1,}[\s]*)+" title="Solo se permite numeros, letras, coma (,) y guion (-)"  required onblur=" validar_direccion()" />
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Barrio</label>
                            <input name="barrio" id="barrio_alumno" type="text" class="form-control"  required />
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Correo electronico</label>
                            <input type="email" class="form-control" name="correo" id="correo_alumno">
                          </div>
                           
                        </div><br>


                        <div class="row">
                          
                          
                          
                          <div class="col-md-2">
                            <label for="nombre">Tipo de sangre </label>
                            <select name="tipo_sangre"  class="form-control" id="tipo_sangre"  required>
                              <option value="" selected="selected">-Seleccionar-</option>
                              <option value="A+" >A+</option>
                              <option value="A-" >A-</option>
                              <option value="B+" >B+</option>
                              <option value="B-" >B-</option>
                              <option value="O+" >O+</option>
                              <option value="O-" >O-</option>
                              <option value="AB+" >AB+</option>
                              <option value="AB-" >AB-</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre"><span  data-toggle="modal" data-target="#agregar_salud">+</span> Afiliación de salud</label>
                            <div id="div_salud"></div>
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">nivel del sisben</label>
                            <input type="" class="form-control" name="sisben_puntaje"  id="sisben_puntaje">
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Numero del sisben </label>
                            <input type="number" class="form-control" name="numero_carnet" id="numero_carnet">
                          </div>
                          
                          <div class="col-md-2">
                            <label for="nombre">Estracto</label>
                            <input type="" class="form-control" name="estrato" id="estrato">
                          </div>
                        </div><br>

                        <div class="row">
                          <div class="col-md-2">
                            <label for="nombre">Desplazado</label>
                            <select name="desplazado" class=" form-control" id="desplazado">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select>  
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Municipio Expulsor</label>  
                            <input type="text" name="municipio_Expulsor" class="form-control" id="municipio_Expulsor" value="" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"/>
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Desmovilizado</label>
                            <select name="desmovilizado" id="desmovilizado" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select>  
                          </div>
                          
                          <div class="col-md-3">
                            <label for="nombre">Hijo de desmovilizados </label>
                            <select name="hijos_desmovilizado" id="hijos_desmovilizado" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Afrocolombiano</label>  
                            <select name="afrocolombiano" id="afrocolombiano" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>
                        </div><br>

                        <div class="row">
                          
                          <div class="col-md-2">
                            <label for="nombre">Etnia</label> 
                            <select name="etnia" id="etnia" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Cual</label> 
                            <input type="text" name="cual_etnia" id="cual_etnia" class="form-control">
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Familias en A.</label>
                            <select name="familia_accion" id="familia_accion" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>
                          <div class="col-md-1">
                            <label for="nombre">PAE</label>
                            <select name="pae" id="pae" class=" form-control" style="padding: 0">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>

                          <div class="col-md-2">
                            <label for="nombre">Bienestar F.</label>
                            <select name="proviene_bienestar" id="proviene_bienestar" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Subsidiado</label>
                            <select name="subsidiado" id="subsidiado" class=" form-control">
                              <option value="">No</option>
                              <option value="1">Si</option>
                            </select> 
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          <div class="col-md-2">
                            <label for="nombre">Discapacidad</label>
                            <select name="discapacidad" id="discapacidad" class=" form-control">
                              <option value="">no</option>
                              <option value="1">si</option>
                            </select> 
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Cual </label>
                            <input type="text" name="cual_discapacidad" id="cual_discapacidad" class="form-control">
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Habilidades especiales</label>
                            <input type="text" name="capacidad_excepcional" id="capacidad_excepcional" class="form-control">
                          </div>
                          <div class="col-md-4">
                            <label for="nombre">Otras talentos </label>
                            <input type="text" name="otros_talentos" id="otros_talentos" class="form-control">
                          </div>
                        </div> <br>

                        <div class="row">
                          <div class="col-md-2">
                            <label for="nombre">Nuevo</label>
                            <select name="tipo_alumno" class="form-control" id="nuevo1" onchange="var d= document.getElementById('nuevo1').value;
                              if (d=='Si') { document.getElementById('tonto').style.display='block';document.getElementById('tonto1').style.display='block';document.getElementById('tonto2').style.display='block';return;}else { document.getElementById('tonto').style.display='none';document.getElementById('tonto1').style.display='none'; document.getElementById('tonto2').style.display='none';}" style="padding: 0"> >
                              <option value="No">No</option>
                              <option value="Si">Si</option>
                            </select>
                          </div>
                          <div class="col-md-3" id="tonto" style="display: none">
                            <label for="nombre">Colegio de origen</label>  
                            <input type="" class="form-control" name="colegio_origen" id="colegio_origen">
                          </div>
                          <div class="col-md-3" id="tonto1" style="display: none">
                            <label for="nombre">Tipo de Colegio</label>  
                            <select name="tipo_colegio" id="tipo_colegio" class="form-control">
                              <option value="">Publico</option>
                              <option value="1">Privado</option>
                            </select>
                          </div>
                           

                          <div class="col-md-4">
                            <label for="nombre">Con quien vive</label>
                            <select name="vive" class="form-control" id="vive">
                              <option value="mama y papa">mama y papa</option>
                              <option value="mama">mama</option>
                              <option value="papa">papa</option>
                              <option value="tios">tios</option>
                              <option value="abuelos">abuelos</option>
                              <option value="Hermanos">Hermanos</option>
                            </select>
                          </div>
                        </div> <br>

                        <div class="row"  id="tonto2"  style="display: none">
                          <div class="col-md-12">
                            <div class="col-md-3">
                              <label for="nombre">Nombre archivo1</label>
                              <input name="Nombre_archivo1" class="form-control" id="Nombre_archivo1" > 
                            </div>
                            <div class="col-md-3">
                              <label for="nombre"> Archivo1</label>  
                              <input type="file" name="archivo1" class="form-control" id="archivo1"  accept="application/pdf" >
                            </div>
                            <div class="col-md-3">
                              <label for="nombre">Nombre archivo2</label>
                              <input type="text" name="Nombre_archivo2" id="Nombre_archivo2" class="form-control">
                            </div>
                            <div class="col-md-3">
                              <label for="nombre">   Archivo2 </label>
                              <input type="file" name="archivo2" id="archivo2" class="form-control"  accept="application/pdf" >
                            </div><br> 
                          </div>
                          <div class="col-md-12"><br>
                            <div class="col-md-3">
                              <label for="nombre">Nombre archivo3</label>
                              <input name="Nombre_archivo3" class="form-control" id=""> 
                            </div>
                            <div class="col-md-3">
                              <label for="nombre"> Archivo3</label>  
                              <input type="file" name="archivo3" class="form-control" name=""  accept="application/pdf" >
                            </div>
                            <div class="col-md-3">
                              <label for="nombre">Nombre archivo4</label>
                              <input type="text" name="Nombre_archivo4" id="Nombre_archivo4" class="form-control">
                            </div>
                            <div class="col-md-3">
                              <label for="nombre">   Archivo4 </label>
                              <input type="file" name="archivo4" id="archivo4" class="form-control"  accept="application/pdf" >
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> 

                    <!-- comienza mama   -->
                  <div class="tab-pane" id="timeline1"> 

                    <div class="row">
                      <div class="col-md-12">
                        <label for="nombre">El acudiente se encuentra registrado en el sistema?</label>
                        <select name="validacion_r2" id="validacion_r2" class="form-control"    onchange=" var tipo_documentoa3=document.getElementById('validacion_r2').value;if (tipo_documentoa3==0) {
                          document.getElementById('id_mama').value='';
                          document.getElementById('form_mama').style.display='block'; 
                          document.getElementById('ver24').style.display='none';
                          document.getElementById('nombre_mama').value='';
                          document.getElementById('apellido_mama').value='';
                          document.getElementById('correo_mama').value='';
                          document.getElementById('tipo_documento_mama').value='';
                          document.getElementById('numero_documento_mama').value='';
                          document.getElementById('expedida_mama').value='';
                          document.getElementById('direccion_mama').value='';
                          document.getElementById('barrio_mama').value='';
                          document.getElementById('telefono_mama').value='';
                          document.getElementById('ocupacion_mama').value='';
                          document.getElementById('direccion_trabajo_mama').value='';
                          document.getElementById('telefono_trabajo_mama').value='';
                        }else{
                          document.getElementById('form_mama').style.display='none'; 
                          document.getElementById('div_mama').style.display='none';
                          document.getElementById('ver24').style.display='block'; 
                        } ">
                          <option value="0">NO</option>
                          <option value="1">SI</option>
                        </select><br>
                      </div> 
                    </div>

                    <div class="row inputs" id="ver24" style="display: none">
                      <div class="col-md-12">

                        <label for="nombre">Numero de identificación</label><br>
                        <input type="hidden" id="id_mama2" name="id_mama2">
                        <input name="id_mama" value="" class="form-control " id="id_mama" style="width: 100%"   onchange=" 

                        var numero_documento=$('#id_mama').val();

                        acudiente(numero_documento,1)"  >
                        <br>
                        <div id="_MSG4_"></div>
                        <div class="" id="div_mama" style="display: none; padding: 20px; color: #45a197;background-color: #edfbf9;border: solid   1px #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">       </div>
                        
                      </div>

                    </div>
                    <div id="form_mama" class="formulario_acudientes">

                      <div class="row" id="ver2">
                        <div class="col-md-4">
                          <label for="nombre">Nombres</label>
                          <input type="" class="form-control" name="nombre2" id="nombre_mama">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Apellido</label>  
                          <input type="" class="form-control" name="apellido2" id="apellido_mama">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Correo electronico</label>  
                          <input type="email" class="form-control" name="emaila2" id="correo_mama">
                        </div>  
                      </div><br>

                      <div class="row" id="ver21">
                        <div class="col-md-4">
                          <label for="nombre">Tipo de documento</label>
                          <select name="tipo_documentoa2" id="tipo_documento_mama" class="form-control"   >
                            <option value="T.I." >Tarjeta de Identidad (T.I.)</option>
                            <option value="C.C." >Cedula de Ciudadania (C.C.)</option>
                            <option value="C.E." >Cedula Extranjeria (C.E.)</option>
                            <option value="Pasaporte" >Pasaporte</option> 
                            <option value="PEP" >Permiso Especial Permanencia(PEP)</option> 
                            <option value="R.C." >Registro Civil (R.C.)</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Numero de documento</label>  
                          <input type="" class="form-control" name="num_documentoa2" id="numero_documento_mama"     onblur=" var identifay='numero_documento_mama'; var num_documentoa1=document.getElementById('numero_documento_mama').value;   funcion1(identifay,num_documentoa1)">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Lugar de expedició  n</label>
                          <input type="text" class="form-control" name="expedidaa2" id="expedida_mama">
                        </div> 
                      </div><br>

                      <div class="row" id="ver22">
                        <div class="col-md-4">
                          <label for="nombre">Dirección</label>
                          <input name="direcciona2" class="form-control" id="direccion_mama" pattern="([0-9,a-zA-ZÁÉÍÓÚñáéíóú-]{1,}[\s]*)+" title="Solo se permite numeros, letras, coma (,) y guion (-)"> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Barrio</label>  
                          <input type="" class="form-control" name="barrioa2" id="barrio_mama">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono o celular</label>
                          <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"  name="celulara2" id="telefono_mama">
                        </div> 
                      </div><br> 

                      <div class="row" id="ver23">
                        <div class="col-md-4">
                          <label for="nombre">Ocupación</label>
                          <input name="ocupaciona2" class="form-control" id="ocupacion_mama"> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Dirección de trabajo</label>  
                          <input type="" class="form-control" name="direccion_trabajo2"   id="direccion_trabajo_mama">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono trabajo</label>
                          <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"  name="teltrab2" id="telefono_trabajo_mama">
                        </div> 
                      </div><br> 
                    </div>
                  </div> 
                   <!-- fin de mama -->

                   <!-- comienza papa   -->
                  <div class="tab-pane" id="timeline2"> 
                    <div class="row">
                      <div class="col-md-12">
                        <label for="nombre">El acudiente se encuentra registrado en el sistema?</label>
                        <select name="validacion_r1" id="validacion_r1" class="form-control"    onchange=" var tipo_documentoa3=document.getElementById('validacion_r1').value;if (tipo_documentoa3==0) {
                          document.getElementById('id_papa').value=''; 
                          document.getElementById('form_papa').style.display='block'; 
                          document.getElementById('ver14').style.display='none';

                          document.getElementById('nombre_papa').value='';
                          document.getElementById('apellido_papa').value='';
                          document.getElementById('correo_papa').value='';
                          document.getElementById('tipo_documento_papa').value='';
                          document.getElementById('numero_documento_papa').value='';
                          document.getElementById('expedida_papa').value='';
                          document.getElementById('direccion_papa').value='';
                          document.getElementById('barrio_papa').value='';
                          document.getElementById('telefono_papa').value='';
                          document.getElementById('ocupacion_papa').value='';
                          document.getElementById('direccion_trabajo_papa').value='';
                          document.getElementById('telefono_trabajo_papa').value='';

                        }

                          else{
                          document.getElementById('form_papa').style.display='none'; 
                          document.getElementById('div_papa').style.display='none';
                          document.getElementById('ver14').style.display='block';
                          document.getElementById('nombre1').value='';
                          document.getElementById('apellido1').value='';} ">
                          <option value="0">NO</option>
                          <option value="1">SI</option>
                        </select><br>
                      </div> 
                    </div>
                    <div class="row inputs" id="ver14" style="display: none">
                      <div class="col-md-12">

                        <label for="nombre">Numero de identificación</label><br>
                        <input type="hidden"  name="id_papa2" id="id_papa2">
                        <input name="id_papa" value="" class="form-control " id="id_papa" style="width: 100%"   onchange=" 

                        var numero_documento=$('#id_papa').val();

                        acudiente(numero_documento,2)"  >
                        <br>
                        <div id="_MSG3_"></div>
                        <div class="" id="div_papa" style="display: none; padding: 20px; color: #45a197;background-color: #edfbf9;border: solid   1px #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">       </div>
                      </div>
                    </div>
                    <div id="form_papa" class="formulario_acudientes">
                      <div class="row" id='ver1'>
                        <div class="col-md-4">
                          <label for="nombre">Nombres</label>
                          <input type="" class="form-control" name="nombre1" id="nombre_papa">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Apellido</label>  
                          <input type="" class="form-control" name="apellido1" id="apellido_papa">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Correo electronico</label>  
                          <input type="email" class="form-control" name="emaila1" id="correo_papa">
                        </div>  
                      </div><br>

                      <div class="row" id="ver11">
                        <div class="col-md-4">
                          <label for="nombre">  de documento</label>
                          <select name="tipo_documentoa1" class="form-control"  id="tipo_documento_papa"  >
                            <option value="T.I." >Tarjeta de Identidad (T.I.)</option>
                            <option value="C.C." >Cedula de Ciudadania (C.C.)</option>
                            <option value="C.E." >Cedula Extranjeria (C.E.)</option>
                            <option value="Pasaporte" >Pasaporte</option> 
                            <option value="PEP" >Permiso Especial Permanencia(PEP)</option> 
                            <option value="R.C." >Registro Civil (R.C.)</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Numero de documento</label>  
                          <input type="" class="form-control" id="numero_documento_papa" name="num_documentoa1"     onblur="var num_documentoa1=document.getElementById('numero_documento_papa').value;var identifay='numero_documento_papa';   funcion1(identifay,num_documentoa1)">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Lugar de expedició  n</label>
                          <input type="text" class="form-control" name="expedidaa1" id="expedida_papa">
                        </div> 
                      </div><br>

                      <div class="row" id="ver12">
                        <div class="col-md-4">
                          <label for="nombre">Dirección</label>
                          <input name="direcciona1" class="form-control" id="direccion_papa" pattern="([0-9,a-zA-ZÁÉÍÓÚñáéíóú-]{1,}[\s]*)+" title="Solo se permite numeros, letras, coma (,) y guion (-)"> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Barrio</label>  
                          <input type="" class="form-control" name="barrioa1" id="barrio_papa">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono o celular</label>
                          <input type="number" class="form-control"  name="celulara1" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos" id="telefono_papa">
                        </div> 
                      </div><br> 

                      <div class="row" id="ver13">
                        <div class="col-md-4">
                          <label for="nombre">Ocupación</label>
                          <input name="ocupaciona1" class="form-control" id="ocupacion_papa"> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Dirección de trabajo</label>  
                          <input type="" class="form-control" name="direccion_trabajo1" pattern="([0-9,a-zA-ZÁÉÍÓÚñáéíóú-]{1,}[\s]*)+" title="Solo se permite numeros, letras, coma (,) y guion (-)" id="direccion_trabajo_papa">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono trabajo</label>
                          <input type="number" class="form-control" id="telefono_trabajo_papa"  name="teltrab1" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"> 
                        </div> 
                      </div><br> 
                    </div>
                  </div> 
                   <!-- fin de papa -->


                   <!-- comienza acudiente   -->
                  <div class="tab-pane" id="timeline3"> 
                    <div class="row">
                      <div class="col-md-6">
                        <label for="nombre">El acudiente se encuentra registrado en el sistema?</label>
                        <select name="validacion_r3" id="validacion_r3" class="form-control"    onchange=" var tipo_documentoa3=document.getElementById('validacion_r3').value;if (tipo_documentoa3==0) { 
                          document.getElementById('id_acudiente').value='';
                          document.getElementById('form_acu').style.display='block'; 
                          document.getElementById('ver34').style.display='none';


                          document.getElementById('nombre_acudiente').value='';
                          document.getElementById('apellido_acudiente').value='';
                          document.getElementById('correo_acudiente').value='';
                          document.getElementById('tipo_documento_acudiente').value='';
                          document.getElementById('numero_documento_acudiente').value='';
                          document.getElementById('expedida_acudiente').value='';
                          document.getElementById('direccion_acudiente').value='';
                          document.getElementById('barrio_acudiente').value='';
                          document.getElementById('telefono_acudiente').value='';
                          document.getElementById('ocupacion_acudiente').value='';
                          document.getElementById('direccion_trabajo_acudiente').value='';
                          document.getElementById('telefono_trabajo_acudiente').value='';





                        }else{
                          document.getElementById('form_acu').style.display='none';
                          document.getElementById('div_acudiente').style.display='none';
                          document.getElementById('ver34').style.display='block';
                          document.getElementById('nombre3').value='';
                          document.getElementById('apellido3').value='';} ">
                          <option value="0">NO</option>
                          <option value="1">SI</option>
                        </select><br>
                      </div>
                      <div class="col-md-6">
                        <label for="nombre">Parentesco</label>
                        <select name="Parentesco" class="form-control" id="parentesco"> 
                          <option value="Hermano">Hermano  </option> 
                          <option value="Hermana">Hermana</option>
                          <option value="Tio">Tio</option>
                          <option value="Tia">Tia</option>
                          <option value="Abuelo">Abuelo</option>
                          <option value="Abuela">Abuela </option>
                          <option value="Padrastro">Padrastro</option>
                          <option value="madrastra">madrastra</option>
                          <option value="Vecino">Vecino</option>
                        </select>
                      </div>
                    </div>
                    <div class="row inputs" id="ver34" style="display: none">
                      <div class="col-md-6">

                        <label for="nombre">Numero de identificación</label><br>
                        <input type="hidden" id="id_acudiente2"  name="id_acudiente2">
                        <input name="id_acudiente" value="" class="form-control " id="id_acudiente" style="width: 100%"   onchange=" 

                        var numero_documento=$('#id_acudiente').val();

                        acudiente(numero_documento,3)"  >
                        <br>
                        <div id="_MSG2_"></div>
                        <div class="" id="div_acudiente" style="display: none; padding: 20px; color: #45a197;background-color: #edfbf9;border: solid   1px #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">       </div>
                      </div>
                    </div>
                    <div id="form_acu" class="formulario_acudientes">
                      <div class="row" id="ver3">
                         
                        <div class="col-md-4">
                          <label for="nombre">Nombres</label>
                          <input type="" class="form-control" name="nombre3" id="nombre_acudiente">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Apellido</label>  
                          <input type="" class="form-control" name="apellido3" id="apellido_acudiente">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Correo electronico</label>  
                          <input type="email" class="form-control" name="emaila3" id="correo_acudiente">
                        </div>  
                      </div><br>
                      
                      <div class="row" id='ver33'>

                        
                        <div class="col-md-4">
                          <label for="nombre">Tipo de documento</label>
                          <select name="tipo_documentoa3" class="form-control"  id="tipo_documento_acudiente"  >
                            <option value="T.I." >Tarjeta de Identidad (T.I.)</option>
                            <option value="C.C." >Cedula de Ciudadania (C.C.)</option>
                            <option value="C.E." >Cedula Extranjeria (C.E.)</option>
                            <option value="Pasaporte" >Pasaporte</option> 
                            <option value="PEP" >Permiso Especial Permanencia(PEP)</option> 
                            <option value="R.C." >Registro Civil (R.C.)</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Numero de documento</label>  
                          <input type="" class="form-control" name="num_documentoa3" id="numero_documento_acudiente"   onblur="var num_documentoa1=document.getElementById('numero_documento_acudiente').value;var identifay='numero_documento_acudiente';   funcion1(identifay,num_documentoa1)">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Lugar de expedició  n</label>
                          <input type="text" class="form-control" id="expedida_acudiente" name="expedidaa3">
                        </div> 
                      </div><br>

                      <div class="row" id='ver31'>
                        <div class="col-md-4">
                          <label for="nombre">Dirección</label>
                          <input name="direcciona3" class="form-control" id="direccion_acudiente" pattern="([0-9,a-zA-ZÁÉÍÓÚñáéíóú-]{1,}[\s]*)+" title="Solo se permite numeros, letras, coma (,) y guion (-)"> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Barrio</label>  
                          <input type="" class="form-control" name="barrioa3" id="barrio_acudiente">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono o celular</label>
                          <input type="number" class="form-control"  name="celulara3" pattern="[0-9]{7}||[0-9]{10}" id="telefono_acudiente" title="solo puedes registrar numeros de 7 a 10 digitos">
                        </div> 
                      </div><br> 

                      <div class="row" id='ver32'>
                        <div class="col-md-4">
                          <label for="nombre">Ocupación</label>
                          <input name="ocupaciona3" class="form-control" id="ocupacion_acudiente"> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Dirección de trabajo</label>  
                          <input type="" class="form-control" id="direccion_trabajo_acudiente" name="direccion_trabajo3" pattern="([0-9,a-zA-ZÁÉÍÓÚñáéíóú-]{1,}[\s]*)+" title="Solo se permite numeros, letras, coma (,) y guion (-)">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono trabajo</label>
                          <input type="number" class="form-control" id="telefono_trabajo_acudiente"  name="teltrab3" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos">
                        </div> 
                      </div><br> 
                        </div>
                    </div> 
                   <!-- fin de acudiente -->
                </div>
              </div>

              <div class="  "id="koooo" style="background-color: #fff;  box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;"> 
                <div  style=" background-color: #3c8dbc;color: #fff; padding: 5PX  ">
                  <div style="margin-left: 14px;font-size: 16px">Registro</div>
                </div><br> 
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <label for="nombre">Sede:</label><br>
                      <select class="form-control select2" id="jornada_sede" name="jornada_sede" required></select>
                    </div>
                    <div class="col-md-3">
                      <label for="nombre">Curso</label>  
                      <select class="form-control select2" id="curso" name="curso" onchange="var id=document.getElementById('curso').value; mimo(id)"  required></select> 
                    </div>
                    <div class="col-md-3">
                      <label for="nombre">Periodo</label> 
                      <select name="id_periodo" class="form-control" id="id_periodo"> <?php

                        foreach ($sql1 as $key) { ?>
                          <option value="<?php echo($key['numero']) ?>"><?php echo($key['numero']) ?></option><?php
                        }
                        ?>
                      </select>
                    </div>
                     <div class="col-md-3">
                      <label for="nombre">Metodologia </label>
                      <select name="metodologia" id="metodologia" class="form-control">
                        <option value="1" >Educación Tradicional</option>
                        <option value="2" >ESpecial</option>
                        <option value="3" >Acelerado</option> 
                      </select>
                    </div>
                    
                  </div>
                  <div class="col-md-12"><br>

                    <div class="col-md-3">
                      <label for="nombre">clave alumno</label>  
                      <input type="" class="form-control" name="clave"> 
                    </div>

                    <div class="col-md-3">
                      <label for="nombre">Clave acudiente</label>  
                      <input type="" class="form-control" name="clave_padre">
                    </div>
                    <div class="col-md-3">
                      <label for="nombre">Clave acudiente</label>  
                      <input type="" class="form-control" name="clave_padre">
                    </div>
                    <div class="col-md-3">
                      <label for="nombre">Año de matricula</label>  
                      <select   class="form-control" name="ano">
                        <?php $ano=date('Y');
                        $ano1=$ano+1; ?>
                        <option value="<?php echo $ano ?>"><?php echo $ano ?></option>
                        <option value="<?php echo $ano1 ?>"><?php echo $ano1 ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12"><br>
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-block btn-primary    "> <img style="width: 21px;margin-left: 5px"   src="data:image/svg+xml;base64,
                        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iaG92ZXJlZC1wYXRocyI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzY3LjU3LDI1Ni45MDljLTkuODM5LTQuNjc3LTE5Ljg3OC04LjcwNi0zMC4wOTMtMTIuMDgxQzM3MC41NiwyMTkuOTk2LDM5MiwxODAuNDU1LDM5MiwxMzZDMzkyLDYxLjAxLDMzMC45OTEsMCwyNTYsMCAgICBjLTc0Ljk5MSwwLTEzNiw2MS4wMS0xMzYsMTM2YzAsNDQuNTA0LDIxLjQ4OCw4NC4wODQsNTQuNjMzLDEwOC45MTFjLTMwLjM2OCw5Ljk5OC01OC44NjMsMjUuNTU1LTgzLjgwMyw0Ni4wNjkgICAgYy00NS43MzIsMzcuNjE3LTc3LjUyOSw5MC4wODYtODkuNTMyLDE0Ny43NDNjLTMuNzYyLDE4LjA2NiwwLjc0NSwzNi42MjIsMTIuMzYzLDUwLjkwOEMyNS4yMjIsNTAzLjg0Nyw0Mi4zNjUsNTEyLDYwLjY5Myw1MTIgICAgSDMwN2MxMS4wNDYsMCwyMC04Ljk1NCwyMC0yMGMwLTExLjA0Ni04Ljk1NC0yMC0yMC0yMEg2MC42OTNjLTguNTM4LDAtMTMuNjg5LTQuNzY2LTE1Ljk5OS03LjYwNiAgICBjLTMuOTg5LTQuOTA1LTUuNTMzLTExLjI5LTQuMjM2LTE3LjUxOWMyMC43NTUtOTkuNjk1LDEwOC42OTEtMTcyLjUyMSwyMTAuMjQtMTc0Ljk3N2MxLjc1OSwwLjA2OCwzLjUyNiwwLjEwMiw1LjMwMiwwLjEwMiAgICBjMS43OTMsMCwzLjU3OC0wLjAzNSw1LjM1NC0wLjEwNGMzMS4xMiwwLjczLDYxLjA1LDcuODMyLDg5LjA0NCwyMS4xNGM5Ljk3Nyw0Ljc0LDIxLjkwNywwLjQ5OSwyNi42NDktOS40NzggICAgQzM4MS43ODksMjczLjU4MiwzNzcuNTQ3LDI2MS42NTEsMzY3LjU3LDI1Ni45MDl6IE0yNjAuODc4LDIzMS44NzdjLTEuNjIzLTAuMDI5LTMuMjQ5LTAuMDQ0LTQuODc4LTAuMDQ0ICAgIGMtMS42MTQsMC0zLjIyOCwwLjAxNi00Ljg0LDAuMDQ2QzIwMC40NjUsMjI5LjM1LDE2MCwxODcuMzEyLDE2MCwxMzZjMC01Mi45MzUsNDMuMDY1LTk2LDk2LTk2czk2LDQzLjA2NSw5Niw5NiAgICBDMzUyLDE4Ny4yOTksMzExLjU1NSwyMjkuMzI5LDI2MC44NzgsMjMxLjg3N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OTIsMzk3aC01NXYtNTVjMC0xMS4wNDYtOC45NTQtMjAtMjAtMjBjLTExLjA0NiwwLTIwLDguOTU0LTIwLDIwdjU1aC01NWMtMTEuMDQ2LDAtMjAsOC45NTQtMjAsMjAgICAgYzAsMTEuMDQ2LDguOTU0LDIwLDIwLDIwaDU1djU1YzAsMTEuMDQ2LDguOTU0LDIwLDIwLDIwYzExLjA0NiwwLDIwLTguOTU0LDIwLTIwdi01NWg1NWMxMS4wNDYsMCwyMC04Ljk1NCwyMC0yMCAgICBDNTEyLDQwNS45NTQsNTAzLjA0NiwzOTcsNDkyLDM5N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" /> REGISTRO INDIVIDUAL   
                      </button>
                    </div>
                    <div class="col-md-3" onclick="">
                      <div class="btn btn-success  btn-file " style="width: 100%" >
                        <i class="fa fa-file-excel-o  margin-r-5"></i> ARCHIVO EXCEL
                        <input type="file" name="ex" id="ex" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onclick="alert('El archivo debe ser con la estención xlsx y debe cumplir con las  condicones necesarias para que el registro salga exitoso')"  >
                      </div>
                    </div>
                    <div class="col-md-3">

                      <div class="modal fade" id="may" >
                        <div class="modal-dialog modal-lg"   >
                            <div class="modal-content">
                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Información del registro</strong></h4>
                                </div>
                                <div class="modal-body">
                                     <div style="  background-color:#7171711c;box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;padding: 10px  ">
                                       
                                       Tenga en cuanta que esta opción permite hacer matriculas a estudiantes masivamente en un curso especifico, para eso ya debes seleccionar la lista de las sedes y de los cursos. una vez señalado debes agragar una hoja de excel donde se encutra la lista de los estudiantes que vas a matricular. Dicha lista debe tener siertos codigos: 
                                      
 <br>  <br> 
                                      <strong> Los estduiantes que pertenescan a grupos como:</strong><br> desplazados, demovilizado, hijos de desmovilizados, pae, bienestar familiar, afrocolombianos, deportado, familias en acción, subsidiado, etni y discapacitado se marcaran con el numero 1 de lo contrario se dejará vacio
                                       <br> 
                                      <strong> El genero del estudiante se identificara de la siguiente manera:</strong>
                                      <br>  <strong>*</strong> el numero 1 si es Mujer  
                                      <br>  <strong>*</strong> el numero 0 si es Hombre  
 <br>   
                                      <strong> Si el estudiante es nuevo debera escribir en la casilla nuevo 1 de lo contrario 0</strong> 
                                           <br> <br>  
                                    
  
                                      <strong> en la metodologia se identificara con los siguientes numeros:</strong>
                                      <br> <strong>*</strong> el numero 1 si es educación tradicional  
                                      <br> <strong>*</strong> el numero 2 si es especial 
                                      <br> <strong>*</strong> el numero 3 si es acelerado 
 <br> 
 <br> 
                           
 <strong> SI la hoja de excel no cumple la información anterior  es mejor no hacer el registro, de lo contrario el registro será errado</strong>
 
                                     </div>
                                  </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                     <input type="button" data-dismiss="modal" class="btn btn-primary"  data-dismiss="modal"  name="fds" value="Aceptar" onclick=" sasa()">
                                </div>
                           </div>
                        </div>
                      </div>


 
                      <button type="button" class="btn btn-block btn-info "  data-toggle="modal" data-target="#may"   >
                       <img style="width: 23px;margin-left: 5px" src="data:image/svg+xml;base64,
                       PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJDYXBhXzEiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUxMiA1MTIiIGhlaWdodD0iNTEyIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMiIgY2xhc3M9IiI+PGc+PHBhdGggZD0ibTMxMC41NzkgMjQwLjcxMmMyMi45MzgtMTguMTIgMzcuNjc2LTQ2LjEwNyAzNy42NzYtNzcuNDU5IDAtNTQuNS00NC41MjctOTguODM5LTk5LjI1OS05OC44MzlzLTk5LjI2IDQ0LjMzOS05OS4yNiA5OC44MzljMCAzLjU3Mi4xOTYgNy4xLjU2OSAxMC41NzUtMTEuMjgyLTYuMTYxLTI0LjIyMS05LjY3Mi0zNy45NzEtOS42NzItNDMuNjkzIDAtNzkuMjM5IDM1LjQwMy03OS4yMzkgNzguOTE5IDAgMjIuNjg4IDkuNjc2IDQzLjE1NiAyNS4xMTcgNTcuNTY2LTM0LjIzNyAxNS4wMzItNTguMjEyIDQ5LjI1Ni01OC4yMTIgODguOTh2OTEuNzcyYzAgMTYuODc3IDEzLjczIDMwLjYwNyAzMC42MDcgMzAuNjA3aDExMS4xOTEgMTAgMjA0LjM5NGMxOS41NiAwIDM1LjQ3Mi0xNS45MTIgMzUuNDcyLTM1LjQ3MnYtMTIwLjM3MWMwLTUzLjA1OS0zMy44NDktOTguMzU2LTgxLjA4NS0xMTUuNDQ1em0tNjEuNTgzLTE0Ni4yOThjMzguMTkgMCA2OS4yNTkgMzAuODgxIDY5LjI1OSA2OC44MzlzLTMxLjA2OSA2OC44MzktNjkuMjU5IDY4LjgzOS02OS4yNi0zMC44ODEtNjkuMjYtNjguODM5IDMxLjA3LTY4LjgzOSA2OS4yNi02OC44Mzl6bS0xMzYuNjYyIDk5Ljc0MmMyNy4xNTEgMCA0OS4yNCAyMS45NDUgNDkuMjQgNDguOTE5IDAgMy45MTItLjQ3MiA3Ljc5NC0xLjM4NiAxMS41NTEtMTMuNzk1IDkuMzg2LTI1LjU4NyAyMS41MDUtMzQuNTg5IDM1LjU3NS00LjI5MyAxLjE5LTguNzM4IDEuNzk0LTEzLjI2NSAxLjc5NC0yNy4xNSAwLTQ5LjIzOS0yMS45NDUtNDkuMjM5LTQ4LjkyIDAtMjYuOTczIDIyLjA4OS00OC45MTkgNDkuMjM5LTQ4LjkxOXptLTgyLjMzNCAyODcuMjM3di05MS43NzJjMC0zNy4wMTQgMzAuMTEzLTY3LjEyNyA2Ny4xMjctNjcuMTI3aDEzLjg5NWMtMy4wNTcgMTAuNzAxLTQuNjk1IDIxLjk5NC00LjY5NSAzMy42NjN2MTIwLjM3MWMwIDEuODYxLjE0NiAzLjY4OC40MjMgNS40NzJoLTc2LjE0M2MtLjMgMC0uNjA3LS4zMDctLjYwNy0uNjA3em0zMzEuNjY0LTQuODY1YzAgMi45NjYtMi41MDYgNS40NzItNS40NzIgNS40NzJoLTIwNC4zOTMtMTBjLTIuOTY2IDAtNS40NzItMi41MDYtNS40NzItNS40NzJ2LTEyMC4zNzFjMC01MS4xMjcgNDEuNTk1LTkyLjcyMiA5Mi43MjItOTIuNzIyaDM5Ljg5M2M1MS4xMjcgMCA5Mi43MjIgNDEuNTk1IDkyLjcyMiA5Mi43MjJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTQ5NyA0Mi4zNThoLTI3LjU3MXYtMjcuMzU4YzAtOC4yODQtNi43MTYtMTUtMTUtMTVzLTE1IDYuNzE2LTE1IDE1djI3LjM1OGgtMjcuNTdjLTguMjg0IDAtMTUgNi43MTYtMTUgMTVzNi43MTYgMTUgMTUgMTVoMjcuNTd2MjcuMzU5YzAgOC4yODQgNi43MTYgMTUgMTUgMTVzMTUtNi43MTYgMTUtMTV2LTI3LjM1OWgyNy41NzFjOC4yODQgMCAxNS02LjcxNiAxNS0xNXMtNi43MTYtMTUtMTUtMTV6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PC9nPiA8L3N2Zz4=" />  REGISTROS MASIVOS</button>
                                           </div>
                    <div class="col-md-3">
                      <button type="button" onclick="descarga() " class="btn btn-block btn-danger  ">
                        <img style="width: 27px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDgyLjE0IDQ4Mi4xNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDgyLjE0IDQ4Mi4xNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIGQ9Ik0xNDIuMDI0LDMxMC4xOTRjMC04LjAwNy01LjU1Ni0xMi43ODItMTUuMzU5LTEyLjc4MmMtNC4wMDMsMC02LjcxNCwwLjM5NS04LjEzMiwwLjc3M3YyNS42OSAgIGMxLjY3OSwwLjM3OCwzLjc0MywwLjUwNCw2LjU4OCwwLjUwNEMxMzUuNTcsMzI0LjM3OSwxNDIuMDI0LDMxOS4xLDE0Mi4wMjQsMzEwLjE5NHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTxwYXRoIGQ9Ik0yMDIuNzA5LDI5Ny42ODFjLTQuMzksMC03LjIyNywwLjM3OS04LjkwNSwwLjc3MnY1Ni44OTZjMS42NzksMC4zOTQsNC4zOSwwLjM5NCw2Ljg0MSwwLjM5NCAgIGMxNy44MDksMC4xMjYsMjkuNDI0LTkuNjc3LDI5LjQyNC0zMC40NDlDMjMwLjE5NSwzMDcuMjMxLDIxOS42MTEsMjk3LjY4MSwyMDIuNzA5LDI5Ny42ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8cGF0aCBkPSJNMzE1LjQ1OCwwSDEyMS44MTFjLTI4LjI5LDAtNTEuMzE1LDIzLjA0MS01MS4zMTUsNTEuMzE1djE4OS43NTRoLTUuMDEyYy0xMS40MTgsMC0yMC42NzgsOS4yNTEtMjAuNjc4LDIwLjY3OXYxMjUuNDA0ICAgYzAsMTEuNDI3LDkuMjU5LDIwLjY3NywyMC42NzgsMjAuNjc3aDUuMDEydjIyLjk5NWMwLDI4LjMwNSwyMy4wMjUsNTEuMzE1LDUxLjMxNSw1MS4zMTVoMjY0LjIyMyAgIGMyOC4yNzIsMCw1MS4zLTIzLjAxMSw1MS4zLTUxLjMxNVYxMjEuNDQ5TDMxNS40NTgsMHogTTk5LjA1MywyODQuMzc5YzYuMDYtMS4wMjQsMTQuNTc4LTEuNzk2LDI2LjU3OS0xLjc5NiAgIGMxMi4xMjgsMCwyMC43NzIsMi4zMTUsMjYuNTgsNi45NjVjNS41NDgsNC4zODIsOS4yOTIsMTEuNjE1LDkuMjkyLDIwLjEyN2MwLDguNTEtMi44MzcsMTUuNzQ1LTcuOTk5LDIwLjY0NiAgIGMtNi43MTQsNi4zMi0xNi42NDMsOS4xNTctMjguMjU4LDkuMTU3Yy0yLjU4NSwwLTQuOTAyLTAuMTI4LTYuNzE0LTAuMzc5djMxLjA5Nkg5OS4wNTNWMjg0LjM3OXogTTM4Ni4wMzQsNDUwLjcxM0gxMjEuODExICAgYy0xMC45NTQsMC0xOS44NzQtOC45Mi0xOS44NzQtMTkuODg5di0yMi45OTVoMjQ2LjMxYzExLjQyLDAsMjAuNjc5LTkuMjUsMjAuNjc5LTIwLjY3N1YyNjEuNzQ4ICAgYzAtMTEuNDI4LTkuMjU5LTIwLjY3OS0yMC42NzktMjAuNjc5aC0yNDYuMzFWNTEuMzE1YzAtMTAuOTM4LDguOTIxLTE5Ljg1OCwxOS44NzQtMTkuODU4bDE4MS44OS0wLjE5djY3LjIzMyAgIGMwLDE5LjYzOCwxNS45MzQsMzUuNTg3LDM1LjU4NywzNS41ODdsNjUuODYyLTAuMTg5bDAuNzQxLDI5Ni45MjVDNDA1Ljg5MSw0NDEuNzkzLDM5Ni45ODcsNDUwLjcxMywzODYuMDM0LDQ1MC43MTN6ICAgIE0xNzQuMDY1LDM2OS44MDF2LTg1LjQyMmM3LjIyNS0xLjE1LDE2LjY0Mi0xLjc5NiwyNi41OC0xLjc5NmMxNi41MTYsMCwyNy4yMjYsMi45NjMsMzUuNjE4LDkuMjgyICAgYzkuMDMxLDYuNzE0LDE0LjcwNCwxNy40MTYsMTQuNzA0LDMyLjc4MWMwLDE2LjY0My02LjA2LDI4LjEzMy0xNC40NTMsMzUuMjI0Yy05LjE1Nyw3LjYxMi0yMy4wOTYsMTEuMjIyLTQwLjEyNSwxMS4yMjIgICBDMTg2LjE5MSwzNzEuMDkyLDE3OC45NjYsMzcwLjQ0NiwxNzQuMDY1LDM2OS44MDF6IE0zMTQuODkyLDMxOS4yMjZ2MTUuOTk2aC0zMS4yM3YzNC45NzNoLTE5Ljc0di04Ni45NjZoNTMuMTZ2MTYuMTIyaC0zMy40MiAgIHYxOS44NzVIMzE0Ljg5MnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+" /> DESCARGAR MATRICULA
                      </button>
                    </div> 
                  </div> 
                </div><br>          
              </div>
            </div>
            <!-- fin de la columna 12 -->
            <input type="hidden" name="ad" id="ad">
          </form>
        </div>
      </section>
    </div>
    <footer class="main-footer"  style="">
        <div class="pull-right hidden-xs">
            <b> IBUnotas</b> 1.0
        </div>
        <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>
  </div>

<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

  

<script src="../../../js/jquery.loadingModal.js"></script>



<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
<script>
$('.select2').select2({    
  language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});
 

document.getElementById('PAIS').value='82,Colombia';
document.getElementById('PAIS2').value='82,Colombia';
pais(82);
pais2(82);

  
  
  function readImage (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah').attr('src', e.target.result); // Renderizamos la imagen
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgh").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    readImage(this);
  });



 

  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }
  function sasa() {

    var extPermitidas3 = /(.xlsx)$/i;

    var jornada_sede= document.getElementById('jornada_sede').value;
    var curso= document.getElementById('curso').value;
    if (jornada_sede=='') {
      document.getElementById('jornada_sede').focus();
      Swal.fire({ 
        icon: 'info',
        title: 'Debe llenar el campo  sede', 
      });
      return true;
    }
    if (curso=='') {
      document.getElementById('curso').focus();
      Swal.fire({ 
        icon: 'info',
        title: 'Debe llenar el campo  Curso', 
      });

      return true;
    }

    var archivoRuta= document.getElementById('ex').value;
    if(extPermitidas3.exec(archivoRuta)){
      mostrar();
      var parametros=new FormData($("#formulario-envia")[0]);
      $.ajax({

        data:parametros,
        url:"../../../ajax/rector/alumno/alumno.php?action=excel",

        type:"POST",
        contentType:false,
        processData:false,

        success: function(data){
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
         
        }
      }); 
      Swal.fire({ 
        icon: 'success',
        title: 'Matricula masiva exitosa', 
      });
      return true;
    }else{
      Swal.fire({ 
        icon: 'info',
        title: 'No has señalado el archivo de excel', 
      });
       
    }
   }

  function descarga(){
    let pais=$('#PAIS').val();
    let porcion1= pais.split(',');
    let pais_nacimiento=porcion1[1];
    let estado_nacimiento=$('#estado').val();
    let ciudad_nacimiento=$('#ciudad_nacimiento').val();
    let tipo_documento=$('#tipo_documento').val();
    let numero_documento=$('#numero_documento').val();
    let PAIS2=$('#PAIS2').val();
    let porcion2= PAIS2.split(',');
    let pais_expedicion=porcion2[1];
    let estado_expedicion=$('#estado2').val();
    let ciudad_expedicion=$('#ciudad_expedicion').val();
    let nombre=$('#nombre').val();
    let apellido=$('#apellido').val();
    let fecha_nacimiento=$('#fecha_nacimiento').val();
    let edad=$('#edad').val();
    let genero=$('#genero').val();
    let telefono_alumno=$('#telefono_alumno').val();
    let direccion_alumno=$('#direccion_alumno').val();
    let barrio_alumno=$('#barrio_alumno').val();
    let correo_alumno=$('#correo_alumno').val();
    let tipo_sangre=$('#tipo_sangre').val();
 
    let afiliado=$('#afiliado').val();
    let sisben_puntaje=$('#sisben_puntaje').val();
    let numero_carnet=$('#numero_carnet').val();
    let estrato=$('#estrato').val();
    let desplazado=$('#desplazado').val();
    let municipio_Expulsor=$('#municipio_Expulsor').val();
    let desmovilizado=$('#desmovilizado').val();
    let hijos_desmovilizado=$('#hijos_desmovilizado').val();
    let afrocolombiano=$('#afrocolombiano').val();
    let etnia=$('#etnia').val();
    let cual_etnia=$('#cual_etnia').val();
    let familia_accion=$('#familia_accion').val();
    let pae=$('#pae').val();
    let proviene_bienestar=$('#proviene_bienestar').val();
    let subsidiado=$('#subsidiado').val();
    let discapacidad=$('#discapacidad').val();
    let cual_discapacidad=$('#cual_discapacidad').val();
    let capacidad_excepcional=$('#capacidad_excepcional').val();



    let otros_talentos=$('#otros_talentos').val();
    let nuevo1=$('#nuevo1').val();
    let colegio_origen=$('#colegio_origen').val();
    let tipo_colegio=$('#tipo_colegio').val();
    let vive=$('#vive').val();
    let id_mama=$('#id_mama').val();
    let nombre_mama=$('#nombre_mama').val();
    let nombre_papa=$('#nombre_papa').val();
    let nombre_acudiente=$('#nombre_acudiente').val();
    let apellido_mama=$('#apellido_mama').val();
    let apellido_papa=$('#apellido_papa').val();
    let apellido_acudiente=$('#apellido_acudiente').val();
    let tipo_documento_acudiente=$('#tipo_documento_acudiente').val();
    let tipo_documento_mama=$('#tipo_documento_mama').val();
    let tipo_documento_papa=$('#tipo_documento_papa').val();
    let numero_documento_mama=$('#numero_documento_mama').val();
    let numero_documento_papa=$('#numero_documento_papa').val();
    let numero_documento_acudiente=$('#numero_documento_acudiente').val();
    let expedida_mama=$('#expedida_mama').val();
    let expedida_papa=$('#expedida_papa').val();
    let expedida_acudiente=$('#expedida_acudiente').val();
    let correo_papa=$('#correo_papa').val();
    let correo_mama=$('#correo_mama').val();
    let correo_acudiente=$('#correo_acudiente').val();
    let direccion_mama=$('#direccion_mama').val();
    let direccion_papa=$('#direccion_papa').val();
    let direccion_acudiente=$('#direccion_acudiente').val();
    let barrio_mama=$('#barrio_mama').val();
    let barrio_papa=$('#barrio_papa').val();
    let barrio_acudiente=$('#barrio_acudiente').val();
    let telefono_mama=$('#telefono_mama').val();
    let telefono_papa=$('#telefono_papa').val();
    let telefono_acudiente=$('#telefono_acudiente').val();
    let ocupacion_papa=$('#ocupacion_papa').val();
    let ocupacion_mama=$('#ocupacion_mama').val();
    let ocupacion_acudiente=$('#ocupacion_acudiente').val();
    let direccion_trabajo_mama=$('#direccion_trabajo_mama').val();
    let direccion_trabajo_papa=$('#direccion_trabajo_papa').val();
    let direccion_trabajo_acudiente=$('#direccion_trabajo_acudiente').val();
    let telefono_trabajo_mama=$('#telefono_trabajo_mama').val();
    let telefono_trabajo_papa=$('#telefono_trabajo_papa').val();
    let telefono_trabajo_acudiente=$('#telefono_trabajo_acudiente').val(); 
    let jornada_sede=$('#jornada_sede').val();
    let curso=$('#curso').val();
    let id_periodo=$('#id_periodo').val();
    let metodologia=$('#metodologia').val();
    let validar_mama=$('#validacion_r2').val();
    let validar_papa=$('#validacion_r1').val();
    let validar_acudiente=$('#validacion_r3').val();
    let parentesco=$('#parentesco').val();
    if (jornada_sede!="" && curso!="") { 
      window.open("hoja_matricula.php?nombre="+nombre+"&desplazado="+desplazado+"&apellido="+apellido+"&pais_nacimiento="+pais_nacimiento+"&fecha_nacimiento="+fecha_nacimiento+"&edad="+edad+"&genero="+genero+"&estado_nacimiento="+estado_nacimiento+"&ciudad_nacimiento="+ciudad_nacimiento+"&tipo_documento="+tipo_documento+"&numero_documento="+numero_documento+"&pais_expedicion="+pais_expedicion+"&estado_expedicion="+estado_expedicion+"&ciudad_expedicion="+ciudad_expedicion+"&telefono_alumno="+telefono_alumno+"&direccion_alumno="+direccion_alumno+"&barrio_alumno="+barrio_alumno+"&correo_alumno="+correo_alumno+"&tipo_sangre="+tipo_sangre+"&afiliado="+afiliado+"&sisben_puntaje="+sisben_puntaje+"&numero_carnet="+numero_carnet+"&municipio_Expulsor="+municipio_Expulsor+"&desmovilizado="+desmovilizado+"&estrato="+estrato+"&hijos_desmovilizado="+hijos_desmovilizado+"&afrocolombiano="+afrocolombiano+"&etnia="+etnia+"&cual_etnia="+cual_etnia+"&familia_accion="+familia_accion+"&pae="+pae+"&proviene_bienestar="+proviene_bienestar+"&subsidiado="+subsidiado+"&discapacidad="+discapacidad+"&cual_discapacidad="+cual_discapacidad+"&id_periodo="+id_periodo+"&curso="+curso+"&metodologia="+metodologia+"&jornada_sede="+jornada_sede+"&validar_acudiente="+validar_acudiente+"&validar_papa="+validar_papa+"&validar_mama="+validar_mama+"&parentesco="+parentesco+"&capacidad_excepcional="+capacidad_excepcional+"&otros_talentos="+otros_talentos+"&nuevo1="+nuevo1+"&colegio_origen="+colegio_origen+"&tipo_colegio="+tipo_colegio+"&vive="+vive+"&id_mama="+id_mama+"&nombre_mama="+nombre_mama+"&nombre_papa="+nombre_papa+"&nombre_acudiente="+nombre_acudiente+"&apellido_papa="+apellido_papa+"&apellido_mama="+apellido_mama+"&apellido_acudiente="+apellido_acudiente+"&correo_mama="+correo_mama+"&correo_papa="+correo_papa+"&correo_acudiente="+correo_acudiente+"&tipo_documento_mama="+tipo_documento_mama+"&tipo_documento_papa="+tipo_documento_papa+"&tipo_documento_acudiente="+tipo_documento_acudiente+"&numero_documento_mama="+numero_documento_mama+"&numero_documento_papa="+numero_documento_papa+"&numero_documento_acudiente="+numero_documento_acudiente+"&expedida_mama="+expedida_mama+"&expedida_papa="+expedida_papa+"&expedida_acudiente="+expedida_acudiente+"&direccion_mama="+direccion_mama+"&direccion_papa="+direccion_papa+"&direccion_acudiente="+direccion_acudiente+"&barrio_mama="+barrio_mama+"&barrio_papa="+barrio_papa+"&barrio_acudiente="+barrio_acudiente+"&telefono_mama="+telefono_mama+"&telefono_papa="+telefono_papa+"&ocupacion_papa="+ocupacion_papa+"&ocupacion_mama="+ocupacion_mama+"&ocupacion_acudiente="+ocupacion_acudiente+"&direccion_trabajo_mama="+direccion_trabajo_mama+"&direccion_trabajo_papa="+direccion_trabajo_papa+"&direccion_trabajo_acudiente="+direccion_trabajo_acudiente+"&telefono_trabajo_mama="+telefono_trabajo_mama+"&telefono_trabajo_papa="+telefono_trabajo_papa+"&telefono_trabajo_acudiente="+telefono_trabajo_acudiente+"&telefono_acudiente="+telefono_acudiente);
    }
  }
  function validar_direccion(){
    var direccion=document.getElementById('direccion_alumno').value;
 
    if (Esdireccion(direccion)) {
      Swal.fire({ 
        icon: 'info',
        title: 'el campo direccion solo permite letras, numeros y guion(-)', 
        showConfirmButton: false,
        timer: 6000
      }); 
      document.getElementById("direccion_alumno").value="";  
      return ;
    }
  }
  function mostrar_salud(){ 
    
    mostrar();
    $.ajax({  

      type: "post", 
      url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=mostrar_salud",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          $('#div_salud').html(data);
      } 
    });
    
  }
  mostrar_salud();
  function agregar_salud(nombre){ 
    if (nombre=='') {
      mensaje8(2,'Ingrese el nombre un nombre');
    }else{ 
      mostrar();
      $.ajax({  

        type: "post",
        data:{nombre}, 
          url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=salud",

        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );
            $('#nombre_salud').val('');
            alert(data);
            mostrar_salud();
        } 
      });
    }
  }
  function insert(pais){ 
    if (pais=='') {
      mensaje6(2,'Ingrese el nombre del pais');
    }else{ 
      mostrar();
      $.ajax({  

        type: "post",
        data:{pais}, 
          url:"../../../ajax/rector/admin/admin.php?action=pais",

        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );
             window.location.assign( window.location.href);
        } 
      });
    }
  }
  function insert2(pais,departamento){ 
    if (departamento=='') {
      document.getElementById('papaaa').focus();
      mensaje7(2,'Ingrese el nombre del departamento');
    }
    if (pais=='') {
      document.getElementById('papi').focus();
      mensaje7(2,'Ingrese el nombre del pais');
    }if (pais!='' &&  departamento!=''){ 
      mostrar();
      $.ajax({  

        type: "post",
        data:{pais,departamento}, 
          url:"../../../ajax/rector/admin/admin.php?action=insert_departamento",

        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );
             window.location.assign( window.location.href);
        } 
      });
    }
  }
  function funcion1(identifay,num_documentoa1){ 
    mostrar();
    $.ajax({  

      type: "post",
      data:{num_documentoa1,identifay}, 
        url:"../../../ajax/rector/alumno/alumno.php?action=validar_documento1",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          $('#_MSG_').html(data);
          $('#_MSG_').html(data);
      } 
    });
  }
  function funcion(){
    mostrar();
    var numero_documento= document.getElementById('numero_documento').value;
    var tipo_documento= document.getElementById('tipo_documento').value;
    $.ajax({  

      type: "post",
      data:{numero_documento,tipo_documento}, 
        url:"../../../ajax/rector/alumno/alumno.php?action=validar_documento",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          $('#_MSG_').html(data);
      } 
    });
  }
   function pais(id){
    mostrar();
    $.ajax({   
      type: "post",

      data:{id},
      url:"../../../ajax/seles/seles.php?action=estado",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
       $('#estado').html(data);
   document.getElementById('estado').value="Norte de Santander";

      }  


    });
  }
   function pais2(id){
    mostrar();
    $.ajax({   
      type: "post",

      data:{id},
      url:"../../../ajax/seles/seles.php?action=estado",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
        $('#estado2').html(data);
        document.getElementById('estado2').value="Norte de Santander";
      }  


    });
  }
   function pais3(id){
    mostrar();  
    if (id!='') {
      document.getElementById('bobo').style.display='block';

      document.getElementById('ver_tabla').style.display='block';
    } if (id==''){ 
      document.getElementById('bobo').style.display='none';
      document.getElementById('ver_tabla').style.display='none';
    }
    var mySelect=document.getElementById('mySelect').value;
      var dato=document.getElementById('fname').value;
    $.ajax({   
      type: "post",

      data:{id,dato,mySelect},
      url:"../../../ajax/rector/admin/admin.php?action=departamentos",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
       $('#ver_tabla').html(data);

      }  


    });
  }
  function actualizar(nom,id,ids){

    mostrar();
  
    $.ajax({   
      type: "post",

      data:{ids,nom},
      url:"../../../ajax/rector/admin/admin.php?action=departamentos_actualizar",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
       pais3(id)

      }  


    });
  }
   function eliminar_departamento(ids,id){
    mostrar();
  
    $.ajax({   
      type: "post",

      data:{ids},
      url:"../../../ajax/rector/admin/admin.php?action=eliminar_departamento",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
       window.location.assign( window.location.href);

      }   
    });
  } 
    function myFunction(i){
      mostrar();
      var id=document.getElementById('papi').value;
      var mySelect=document.getElementById('mySelect').value;
      var dato=document.getElementById('fname').value;
      $.ajax({   
        type: "post",

        data:{id,dato,mySelect,i},
        url:"../../../ajax/rector/admin/admin.php?action=departamentos",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );
         $('#ver_tabla').html(data); 
        }   
      });
    } 
  

  function acudiente(numero_documento,num){ 
    
    
    $.ajax({  

      type: "post", 

      url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=acudiente",
       data: { numero_documento
                    },
                    dataType: "json",


      success:function(data){   
        if (data[0]==1) { 
          if (num==1) {
            var texto='mama';
            mensaje4(3,'Acudiente agregado');
          }
          if (num==2) {
            var texto='papa';
            mensaje3(3,'Acudiente agregado');
          }
          if (num==3) {
            var texto='acudiente';
            mensaje2(3,'Acudiente agregado');
          } 
          $('#nombre_'+texto).val(data[1]);
          $('#apellido_'+texto).val(data[2]);
          $('#tipo_documento_'+texto).val(data[3]);
          $('#numero_documento_'+texto).val(data[4]);
          $('#expedida_'+texto).val(data[5]);
          $('#direccion_'+texto).val(data[6]);
          $('#barrio_'+texto).val(data[7]);
          $('#telefono_'+texto).val(data[8]);
          $('#ocupacion_'+texto).val(data[9]);
          $('#direccion_trabajo_'+texto).val(data[10]);
          $('#correo_'+texto).val(data[11]);
          $('#telefono_trabajo_'+texto).val(data[12]);
          $('#id_'+texto+'2').val(data[13]);
          document.getElementById('div_'+texto).style.display = 'block';
          $('#div_'+texto).html('El acudiente '+data[1]+' '+data[2]+' con '+data[3]+' '+data[4]);

        }else{ 
          if (num==1) {
            var texto='mama';
            mensaje4(1,'El numero de documento no existe');
          }
          if (num==2) {
            var texto='papa';
            mensaje3(1,'El numero de documento no existe');
          }
          if (num==3) {
            var texto='acudiente';
            mensaje2(1,'El numero de documento no existe');
          }

          $('#id_'+texto+'2').val("");
          document.getElementById('id_'+texto).value = '';
          document.getElementById('id_'+texto).focus();

          document.getElementById('div_'+texto).style.display = 'none';
          $('#div_'+texto).html(''); 

        }
      } 
    });
  } 

  





   function mimo(id){
     $.ajax({  

      type: "post",
      data:{id}, 
      url:"../../../ajax/seles/seles.php?action=sacar_el_id_grado",

      dataType:"text", 

      success:function(data){  
        $('#id_grado').val(data); 


      } 
    }); 
     $.ajax({  

      type: "post",
      data:{id}, 
      url:"../../../ajax/seles/seles.php?action=sacar_el_id_curso",

      dataType:"text", 

      success:function(data){  
        $('#id_curso').val(data); 


      } 
    }); 
   }
   $.ajax({  

    type: "post",
    url:"../../../ajax/seles/seles.php?action=nuevo_grado",

    dataType:"text", 

    success:function(data){  
      $('#jornada_sede').html(data); 


    } 
  });   
   $("#jornada_sede").change(function(){
    var idjs=document.getElementById("jornada_sede").value; 
    $.ajax({   
      type: "post",
      data:{idjs}, 
      url:"../../../ajax/seles/seles.php?action=sacar_curso1", 
      dataType:"text", 

      success:function(data){  
        $('#curso').html(data); 


      }  


    }); 
  });






  $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault(); 
    mostrar();
    var archivoRuta = document.getElementById('imgh').value;
    var vacio=''; 

    var extPermitidas3 = /(.jpg)$/i;
    var extPermitidas4 = /(.png)$/i;

    if(extPermitidas3.exec(archivoRuta)){

      document.getElementById('ad').value='.jpg';
    }
    if(extPermitidas4.exec(archivoRuta)){

      document.getElementById('ad').value='.png';
    }
    
    if(vacio==archivoRuta){

      document.getElementById('ad').value='';
    }
    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({

      data:parametros,
      url:"../../../ajax/rector/alumno/alumno.php?action=registro",
      type:"POST",
      contentType:false,
      processData:false,
      success: function(data){
        $('#sapo').html(data);
        if (data==2) { 
          Swal.fire({ 
            icon: 'error',
            title: '', 
            showConfirmButton: false,
            timer: 6000
          });
        }
        if (data==1) { }
        if (data==1) { }
        if (data==1) { }
          document.getElementById("formulario-envia").reset();
      
          $("html,body").animate({ scrollTop:0 });
          document.getElementById('div_mama').style.display = 'none';
          document.getElementById('div_acudiente').style.display = 'none';
          document.getElementById('div_mama').style.display = 'none'; 
          $(".inputs").hide();
          $(".formulario_acudientes").show();
          mensaje(3,'Matricula exitosa');
          document.getElementById('PAIS').value='82,Colombia';
          document.getElementById('PAIS2').value='82,Colombia';
          pais(82);
          pais2(82);
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
        
      }
    }); 
  });

</script>


