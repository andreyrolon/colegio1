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
  select{
  text-transform: uppercase;
}
  input{
  text-transform: uppercase;
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

 <body class="skin-blue sidebar-mini sidebar-collapse" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  "> 
      <section class="content">


        <!-- modal de eliminar acudiente -->
        <div class="modal fade in" id="eliminar_acu" style="background-color: rgba(3, 64, 95, 0.3); ">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" style="">Confirmación</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" id="eliminary" name="eliminary">
                <p> estás seguro de eliminar el acudiente?</p>
              </div>
              <div class="modal-footer">    
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" data-dismiss="modal" class="btn btn-primary" name="eliminar_sede" id="btn" onclick="var io=document.getElementById('eliminary').value;  myFunction3(io)">Aceptar</button> 
              </div>
            </div>
          </div>
        </div>
        <!-- modal de eliminar acudiente -->

        <!-- modal para agregar paises-->
        <div class="modal in" id="my" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post">  
                  <div class="modal-header btn-primary table-responsive">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                        Agregar un nuevo Pais al sistema 
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

        <!-- modal para agregar paises-->


         <div class="modal in" id="padres" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post" id="nuevo_acudiente"> 
                  <div class="modal-header btn-primary table-responsive " style="font-size: 17px">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                      Nuevo acudiente 
                  </div> 
                
                  <div class="modal-body table-responsive" id="pdf"> 
                    <label for="nombre">Usuario Registrado</label>
                    <input type="hidden" name="fry" id="fry">
                    <select class="form-control"   id="selecion" name="selecion" onchange="var q=document.getElementById('selecion').value;if (q==0) {
                      document.getElementById('nombre1a').required=true;
                      document.getElementById('apellido1a').required=true; 
                      document.getElementById('num_documento1a').required=true;
                      document.getElementById('expedida1a').required=true;
                      document.getElementById('direccion1a').required=true;
                      document.getElementById('barrio1a').required=true;
                      document.getElementById('ocupacion1a').required=true;
                      document.getElementById('ob2').style.display='block';
                      document.getElementById('ob1').style.display='none';
                      document.getElementById('id_acudiente').required=false;
                    }else{ 
                      document.getElementById('nombre1a').required=false;
                      document.getElementById('apellido1a').required=false;
                      document.getElementById('num_documento1a').required=false;
                      document.getElementById('expedida1a').required=false;
                      document.getElementById('direccion1a').required=false;
                      document.getElementById('barrio1a').required=false;
                      document.getElementById('ocupacion1a').required=false;
                      document.getElementById('ob1').style.display='block';
                      document.getElementById('ob2').style.display='none';
                      document.getElementById('id_acudiente').required=true;
                    }">
                      <option value="0">No</option>
                      <option value="1">Si</option>
                    </select><br>
                    <div id="ob1" style="display: none"> 
                      <label for="nombre">Numero de identificación</label><br>
                        <input   name="id_acudiente" class="form-control " id="id_acudiente" onchange="verificar_acudiente()"> <br>
                        <div id="div_acudiente"></div>
                      <label for="nombre">Parentesco</label><br>
                        <select name="Parentesco2" class="form-control" id="Parentesco2"> 
                      </select>

                    </div>
                    <div id="ob2">
                      
                      <label for="nombre">Nombres</label>
                      <input type="" class="form-control"   name="nombre1a" id="nombre1a"  required><br>
                      <label for="nombre">Apellido</label>  
                      <input type="" class="form-control" name="apellido1a" id="apellido1a" required><br>
                      <label for="nombre">Correo electronico</label>  
                      <input type="email" class="form-control" name="email1a"  id="email1a" ><br>
                      <label for="nombre">Tipo de documento</label>
                      <select   class="form-control" id="tipo_documento1a" name="tipo_documento1a"  >
                      <option value="2">Cedula de Ciudadania</option><option value="1">Tarjeta de Identidad</option><option value="3">Cedula Extranjeria</option><option value="4">Pasaporte</option> <option value="5">Permiso Especial Permanencia(PEP)</option> <option value="6">Registro Civil</option>                          
                      </select><br>
                      <label for="nombre">Numero de documento</label>  
                      <input type="" class="form-control" name="num_documento1a"   id="num_documento1a" pattern="[0-9]{7,}" title="Ingrese solo numeros mayores a seis digitos " onblur="  
                      var identifay='num_documento1a'; 
                      var num_documentoa1=document.getElementById('num_documento1a').value;   

                      funcion199(identifay,num_documentoa1); " required> <br>

                      <div id="_MSG5_" style="margin-bottom: 10px"></div> 
                      <label for="nombre">Lugar de expedición</label>
                      <input type="text" class="form-control" name="expedida1a" value="" id="expedida1a" required  > <br>
                      <label for="nombre">Dirección</label>
                      <input name="direccion1a"   class="form-control" onchange=" 
                      var nom=document.getElementById('direccion1a').value;
                      if (Esdireccion(nom)) {
                        Swal.fire({ 
                          icon: 'error',
                          title:'El campo direccion solo permite estos caracteres.',
                          text: '0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-',
                          showConfirmButton: true, 
                        });
                        document.getElementById('direccion1a').value='';
                        return;
                      }"   id="direccion1a"  required><br>
                      <label for="nombre">Barrio</label>  
                      <input type="" class="form-control" name="barrio1a"   id="barrio1a" required> <br>
                      <label for="nombre">Telefono o celular</label>
                      <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos" name="celular1a"  id="celular1a"  > <br>
                      <label for="nombre">Ocupación</label>
                      <input name="ocupacion1a" class="form-control"   id="ocupacion1a" required> <br>
                      <label for="nombre">Dirección de trabajo</label>  
                      <input type="" class="form-control" name="direccion_trabajo1a"  id="direccion_trabajo1a"   onchange=" 
                      var nom=document.getElementById('direccion_trabajo1a').value;
                      if (Esdireccion(nom)) {
                        Swal.fire({ 
                          icon: 'error',
                          title:'El campo direccion solo permite estos caracteres.',
                          text: '0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-',
                          showConfirmButton: true, 
                        });
                        document.getElementById('direccion_trabajo1a').value='';
                        return;
                      }" > <br>
                      <label for="nombre">Telefono trabajo</label>
                      <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos" name="telefono_trabajo1a"   id="telefono_trabajo1a"  > <br>
                      <label for="nombre">Parentesco</label>
                      <select name="Parentesco" class="form-control" id="Parentesco"> 
                      </select>
                    </div> 
                  </div>
                  <div class="modal-footer">   <button type="submit"     class="btn  btn-block btn-danger"   value="520">Registra</button> 
                      <button type="button" class="btn  btn-block btn-default" data-dismiss="modal">Cancelar</button>  
                      
                  </div>
                </form>
              </div>
            </div>
        </div>



        <div class="modal in" id="vida" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post">  
                  <div class="modal-header btn-primary table-responsive " style="font-size: 17px">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                       Agregar una nueva empresa de salud 
                  </div> 

                  <div class="modal-body table-responsive" id="pdf">
                    <div id="_MSG8_" style="margin-bottom: 10px"></div>
                    <strong>Nombre del pais</strong>
                    <input type=""id='salud' class="form-control" name=""> 
                    
                     
                  </div>
                  <div class="modal-footer">   <button type="button" onclick="var salud=document.getElementById('salud').value; VIDA(salud)" class="btn  btn-block btn-danger" name="eliminary2" id="eliminary2" onclick="" value="520">Registra</button> 
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
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-tabs-custom" id="koooo" style="border-top:solid 3px #d73925; padding: 10px;   box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;"> 
                    <strong>Buscar alumno:</strong>
                  <input name="" placeholder=" numero de documento" class="form-control " id="alumno_nom" onchange=" versiti() ">
                   <br>
                </div>
                </div> <br>
              </div>



              <div id="_MSG_"></div> 
              <div id="_MSG2_"></div> 
              <div id="sapo"></div>  
              
              <div id="mostrar">
                
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
                      <label for="nombre">Curso</label>  <br>
                      <select class="form-control select2" id="curso" name="curso" onchange="var id=document.getElementById('curso').value; "  required></select> 
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
                      <select   class="form-control" name="ano" id="ano">
                        <?php $ano=date('Y');
                        $ano1=$ano+1; ?>
                        <option value="<?php echo $ano ?>"><?php echo $ano ?></option>
                        <option value="<?php echo $ano1 ?>"><?php echo $ano1 ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12"><br>
                    <div class="col-md-3">

                      <div class="modal fade in" id="mymodal4" style="background-color: rgba(3, 64, 95, 0.3);">
                        <div class="modal-dialog">
                            <div class="modal-content"> 
                              <div class="modal-header">
                                <button type="button" class="close" id="cerrar3" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmación</h4>
                              </div>
                              <div class="modal-body">
                                <p> Está seguro de registrar la matricula? </p>     
                              </div> 
                              <div class="modal-footer">    
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" name="eliminary2" id="eliminary2" onclick="matriculacion()" data-dismiss="modal">Aceptar</button> 
                              </div>
                            </div>
                        </div>
                      </div>
                      <button data-target="#mymodal4" data-toggle="modal" type="button"  class="btn btn-block btn-primary  btn-lg"  > <img style="width: 19px;margin-left: 5px"   src="data:image/svg+xml;base64,
                        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iaG92ZXJlZC1wYXRocyI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzY3LjU3LDI1Ni45MDljLTkuODM5LTQuNjc3LTE5Ljg3OC04LjcwNi0zMC4wOTMtMTIuMDgxQzM3MC41NiwyMTkuOTk2LDM5MiwxODAuNDU1LDM5MiwxMzZDMzkyLDYxLjAxLDMzMC45OTEsMCwyNTYsMCAgICBjLTc0Ljk5MSwwLTEzNiw2MS4wMS0xMzYsMTM2YzAsNDQuNTA0LDIxLjQ4OCw4NC4wODQsNTQuNjMzLDEwOC45MTFjLTMwLjM2OCw5Ljk5OC01OC44NjMsMjUuNTU1LTgzLjgwMyw0Ni4wNjkgICAgYy00NS43MzIsMzcuNjE3LTc3LjUyOSw5MC4wODYtODkuNTMyLDE0Ny43NDNjLTMuNzYyLDE4LjA2NiwwLjc0NSwzNi42MjIsMTIuMzYzLDUwLjkwOEMyNS4yMjIsNTAzLjg0Nyw0Mi4zNjUsNTEyLDYwLjY5Myw1MTIgICAgSDMwN2MxMS4wNDYsMCwyMC04Ljk1NCwyMC0yMGMwLTExLjA0Ni04Ljk1NC0yMC0yMC0yMEg2MC42OTNjLTguNTM4LDAtMTMuNjg5LTQuNzY2LTE1Ljk5OS03LjYwNiAgICBjLTMuOTg5LTQuOTA1LTUuNTMzLTExLjI5LTQuMjM2LTE3LjUxOWMyMC43NTUtOTkuNjk1LDEwOC42OTEtMTcyLjUyMSwyMTAuMjQtMTc0Ljk3N2MxLjc1OSwwLjA2OCwzLjUyNiwwLjEwMiw1LjMwMiwwLjEwMiAgICBjMS43OTMsMCwzLjU3OC0wLjAzNSw1LjM1NC0wLjEwNGMzMS4xMiwwLjczLDYxLjA1LDcuODMyLDg5LjA0NCwyMS4xNGM5Ljk3Nyw0Ljc0LDIxLjkwNywwLjQ5OSwyNi42NDktOS40NzggICAgQzM4MS43ODksMjczLjU4MiwzNzcuNTQ3LDI2MS42NTEsMzY3LjU3LDI1Ni45MDl6IE0yNjAuODc4LDIzMS44NzdjLTEuNjIzLTAuMDI5LTMuMjQ5LTAuMDQ0LTQuODc4LTAuMDQ0ICAgIGMtMS42MTQsMC0zLjIyOCwwLjAxNi00Ljg0LDAuMDQ2QzIwMC40NjUsMjI5LjM1LDE2MCwxODcuMzEyLDE2MCwxMzZjMC01Mi45MzUsNDMuMDY1LTk2LDk2LTk2czk2LDQzLjA2NSw5Niw5NiAgICBDMzUyLDE4Ny4yOTksMzExLjU1NSwyMjkuMzI5LDI2MC44NzgsMjMxLjg3N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OTIsMzk3aC01NXYtNTVjMC0xMS4wNDYtOC45NTQtMjAtMjAtMjBjLTExLjA0NiwwLTIwLDguOTU0LTIwLDIwdjU1aC01NWMtMTEuMDQ2LDAtMjAsOC45NTQtMjAsMjAgICAgYzAsMTEuMDQ2LDguOTU0LDIwLDIwLDIwaDU1djU1YzAsMTEuMDQ2LDguOTU0LDIwLDIwLDIwYzExLjA0NiwwLDIwLTguOTU0LDIwLTIwdi01NWg1NWMxMS4wNDYsMCwyMC04Ljk1NCwyMC0yMCAgICBDNTEyLDQwNS45NTQsNTAzLjA0NiwzOTcsNDkyLDM5N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" /> Matricular  
                      </button>
                    </div>
                   
                    <div class="col-md-3">

                   

  
                      <button type="button" class="btn btn-block  btn-danger btn-lg" onclick="pdf()">
                        <img style="width: 22px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDgyLjE0IDQ4Mi4xNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDgyLjE0IDQ4Mi4xNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIGQ9Ik0xNDIuMDI0LDMxMC4xOTRjMC04LjAwNy01LjU1Ni0xMi43ODItMTUuMzU5LTEyLjc4MmMtNC4wMDMsMC02LjcxNCwwLjM5NS04LjEzMiwwLjc3M3YyNS42OSAgIGMxLjY3OSwwLjM3OCwzLjc0MywwLjUwNCw2LjU4OCwwLjUwNEMxMzUuNTcsMzI0LjM3OSwxNDIuMDI0LDMxOS4xLDE0Mi4wMjQsMzEwLjE5NHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTxwYXRoIGQ9Ik0yMDIuNzA5LDI5Ny42ODFjLTQuMzksMC03LjIyNywwLjM3OS04LjkwNSwwLjc3MnY1Ni44OTZjMS42NzksMC4zOTQsNC4zOSwwLjM5NCw2Ljg0MSwwLjM5NCAgIGMxNy44MDksMC4xMjYsMjkuNDI0LTkuNjc3LDI5LjQyNC0zMC40NDlDMjMwLjE5NSwzMDcuMjMxLDIxOS42MTEsMjk3LjY4MSwyMDIuNzA5LDI5Ny42ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8cGF0aCBkPSJNMzE1LjQ1OCwwSDEyMS44MTFjLTI4LjI5LDAtNTEuMzE1LDIzLjA0MS01MS4zMTUsNTEuMzE1djE4OS43NTRoLTUuMDEyYy0xMS40MTgsMC0yMC42NzgsOS4yNTEtMjAuNjc4LDIwLjY3OXYxMjUuNDA0ICAgYzAsMTEuNDI3LDkuMjU5LDIwLjY3NywyMC42NzgsMjAuNjc3aDUuMDEydjIyLjk5NWMwLDI4LjMwNSwyMy4wMjUsNTEuMzE1LDUxLjMxNSw1MS4zMTVoMjY0LjIyMyAgIGMyOC4yNzIsMCw1MS4zLTIzLjAxMSw1MS4zLTUxLjMxNVYxMjEuNDQ5TDMxNS40NTgsMHogTTk5LjA1MywyODQuMzc5YzYuMDYtMS4wMjQsMTQuNTc4LTEuNzk2LDI2LjU3OS0xLjc5NiAgIGMxMi4xMjgsMCwyMC43NzIsMi4zMTUsMjYuNTgsNi45NjVjNS41NDgsNC4zODIsOS4yOTIsMTEuNjE1LDkuMjkyLDIwLjEyN2MwLDguNTEtMi44MzcsMTUuNzQ1LTcuOTk5LDIwLjY0NiAgIGMtNi43MTQsNi4zMi0xNi42NDMsOS4xNTctMjguMjU4LDkuMTU3Yy0yLjU4NSwwLTQuOTAyLTAuMTI4LTYuNzE0LTAuMzc5djMxLjA5Nkg5OS4wNTNWMjg0LjM3OXogTTM4Ni4wMzQsNDUwLjcxM0gxMjEuODExICAgYy0xMC45NTQsMC0xOS44NzQtOC45Mi0xOS44NzQtMTkuODg5di0yMi45OTVoMjQ2LjMxYzExLjQyLDAsMjAuNjc5LTkuMjUsMjAuNjc5LTIwLjY3N1YyNjEuNzQ4ICAgYzAtMTEuNDI4LTkuMjU5LTIwLjY3OS0yMC42NzktMjAuNjc5aC0yNDYuMzFWNTEuMzE1YzAtMTAuOTM4LDguOTIxLTE5Ljg1OCwxOS44NzQtMTkuODU4bDE4MS44OS0wLjE5djY3LjIzMyAgIGMwLDE5LjYzOCwxNS45MzQsMzUuNTg3LDM1LjU4NywzNS41ODdsNjUuODYyLTAuMTg5bDAuNzQxLDI5Ni45MjVDNDA1Ljg5MSw0NDEuNzkzLDM5Ni45ODcsNDUwLjcxMywzODYuMDM0LDQ1MC43MTN6ICAgIE0xNzQuMDY1LDM2OS44MDF2LTg1LjQyMmM3LjIyNS0xLjE1LDE2LjY0Mi0xLjc5NiwyNi41OC0xLjc5NmMxNi41MTYsMCwyNy4yMjYsMi45NjMsMzUuNjE4LDkuMjgyICAgYzkuMDMxLDYuNzE0LDE0LjcwNCwxNy40MTYsMTQuNzA0LDMyLjc4MWMwLDE2LjY0My02LjA2LDI4LjEzMy0xNC40NTMsMzUuMjI0Yy05LjE1Nyw3LjYxMi0yMy4wOTYsMTEuMjIyLTQwLjEyNSwxMS4yMjIgICBDMTg2LjE5MSwzNzEuMDkyLDE3OC45NjYsMzcwLjQ0NiwxNzQuMDY1LDM2OS44MDF6IE0zMTQuODkyLDMxOS4yMjZ2MTUuOTk2aC0zMS4yM3YzNC45NzNoLTE5Ljc0di04Ni45NjZoNTMuMTZ2MTYuMTIyaC0zMy40MiAgIHYxOS44NzVIMzE0Ljg5MnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+" /> Descargar matriculas
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
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por <a> IBUsoft</a>.
    </footer>
  </div>
 
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
 //mostrar el parenteco de los acudientes
 function cambio1(){

  $('#Parentesco').html('<option   value="Padre">Padre  </option>   ');
  $('#Parentesco2').html('<option   value="Padre">Padre  </option>   ');
 }
 function cambio2(){

  $('#Parentesco').html('<option   value="Madre">Madre  </option>  '); 
  $('#Parentesco2').html('<option   value="Madre">Madre  </option>  '); 
 }
 function cambio3(){
  $('#Parentesco').html(' <option id="poo3" value="Hermano">Hermano  </option> <option id="poo4" value="Hermana">Hermana</option><option id="poo5" value="Tio">Tio</option><option id="poo6" value="Tia">Tia</option><option id="poo7" value="Abuelo">Abuelo</option><option id="poo8" value="Abuela">Abuela </option><option id="poo9" value="Padrastro">Padrastro</option><option id="poo10" value="madrastra">madrastra</option><option  value="Vecino">Vecino</option><option   value="Vecina">Vecina</option>  ');  
  $('#Parentesco2').html(' <option   value="Hermano">Hermano  </option> <option id="poo4" value="Hermana">Hermana</option><option id="poo5" value="Tio">Tio</option><option   value="Tia">Tia</option><option id="poo7" value="Abuelo">Abuelo</option><option id="poo8" value="Abuela">Abuela </option><option   value="Padrastro">Padrastro</option><option  value="madrastra">madrastra</option><option id="poo11" value="Vecino">Vecino</option><option   value="Vecina">Vecina</option>  ');  
 }
  
 





  //la funcion onload
  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});
     
    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) }; 

  }
  function pdf(){

    let pais=$('#PAIS').val();
    let id_alumnos=$('#id_alumnos').val();
    let porcion1= pais.split(',');
    let pais_nacimiento=porcion1[1];
    let estado_nacimiento=$('#departamento_nacimiento').val();
    let ciudad_nacimiento=$('#ciudad_nacimiento').val();
    let tipo_documento=$('#tipo_documento').val();
    let numero_documento=$('#numero_documento').val();
    let PAIS2=$('#pais_expedicion').val();
    let porcion2= PAIS2.split(',');
    let pais_expedicion=porcion2[1];
    let estado_expedicion=$('#departamento_expedicion').val();
    let ciudad_expedicion=$('#ciudad_expedicion').val();
    let nombre=$('#nombre').val();
    let apellido=$('#apellido').val();
    let fecha_nacimiento=$('#fecha_nacimiento').val();
    let edad=$('#edad').val();
    let genero=$('#genero').val();
    let telefono_alumno=$('#telefono').val();
    let direccion_alumno=$('#direccion').val();
    let barrio_alumno=$('#barrio').val();
    let correo_alumno=$('#correo').val();
    let tipo_sangre=$('#tipo_sangre').val();
 
    let afiliado=$('#filiacion_salud').val();
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
    let url=$('#url').val();
    let vive=$('#vive').val();
    let jornada_sede=$('#jornada_sede').val();
    let curso=$('#curso').val();
    let id_periodo=$('#id_periodo').val();
    let metodologia=$('#metodologia').val();
    let ano=$('#ano').val();
    if (jornada_sede!="" && curso!="") { 
      window.open("hoja_matricula_antiguo.php?nombre="+nombre+"&desplazado="+desplazado+"&id_alumnos="+id_alumnos+"&foto="+url+"&apellido="+apellido+"&pais_nacimiento="+pais_nacimiento+"&fecha_nacimiento="+fecha_nacimiento+"&edad="+edad+"&genero="+genero+"&estado_nacimiento="+estado_nacimiento+"&ciudad_nacimiento="+ciudad_nacimiento+"&tipo_documento="+tipo_documento+"&numero_documento="+numero_documento+"&pais_expedicion="+pais_expedicion+"&estado_expedicion="+estado_expedicion+"&ciudad_expedicion="+ciudad_expedicion+"&telefono_alumno="+telefono_alumno+"&direccion_alumno="+direccion_alumno+"&barrio_alumno="+barrio_alumno+"&correo_alumno="+correo_alumno+"&tipo_sangre="+tipo_sangre+"&afiliado="+afiliado+"&sisben_puntaje="+sisben_puntaje+"&numero_carnet="+numero_carnet+"&municipio_Expulsor="+municipio_Expulsor+"&desmovilizado="+desmovilizado+"&estrato="+estrato+"&hijos_desmovilizado="+hijos_desmovilizado+"&afrocolombiano="+afrocolombiano+"&etnia="+etnia+"&cual_etnia="+cual_etnia+"&familia_accion="+familia_accion+"&pae="+pae+"&proviene_bienestar="+proviene_bienestar+"&subsidiado="+subsidiado+"&discapacidad="+discapacidad+"&cual_discapacidad="+cual_discapacidad+"&id_periodo="+id_periodo+"&curso="+curso+"&metodologia="+metodologia+"&jornada_sede="+jornada_sede+"&capacidad_excepcional="+capacidad_excepcional+"&otros_talentos="+otros_talentos+"&ano="+ano+"&nuevo1=1&vive="+vive);
    }else {
      
        Swal.fire('Para imprimir la matricula debe seleccionar la sede y el curso', '', 'info');
    }
  }
  //cuando vas a registra el acudiente ya registrado en el sistema, ingresa el numero de documento y muestra algunos datos como el nombre la cedula para ver si el documento es el de el.
  function verificar_acudiente(){
    var numero_acudiente=document.getElementById('id_acudiente').value;
    mostrar(); 
    $.ajax({  

      type: "post",
      data:{numero_acudiente}, 
        url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=datos_acudiente",

      dataType:"text", 

      success:function(data){  
        
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
       
        document.getElementById('div_acudiente').style.display = 'block';
        if (data!=0) {
          $("#div_acudiente").html(data);
        }else{

          $("#div_acudiente").html(data); 
        }  
      } 
    });
  }


  //cambiar la img
  function readImage (input) {
    Swal.fire({
      title: 'Quieres guardar los camnbios?',
      showDenyButton: true, 
      confirmButtonText: `Guargar `,
      denyButtonText: `No Guardes`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        mostrar();
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#blah').attr('src', e.target.result); // Renderizamos la imagen
          }
          reader.readAsDataURL(input.files[0]);
        }
        //lo anterior era para mostrar la img ahora vamos a guardala
        var parametros=new FormData($("#actualizar_foto")[0]);
        $.ajax({

          data:parametros,
          url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=actalizar_foto",
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
            Swal.fire('Foto actualizada', '', 'success');
            versiti();

          }
        }); 
         
      } else if (result.isDenied) {
        Swal.fire('Los cambios no se guardaran', '', 'info');
      }
    })
    
  }

  $("#imgh").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    readImage(this);
  });





  
  //buscar alumno
  function versiti(){
    mostrar();
    var id_alumno=document.getElementById('alumno_nom').value;
    
    $.ajax({  

      type: "post",
      data:{id_alumno}, 
        url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=matricula_nuevo",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#mostrar').html(data);
      } 
    });

  }

  //registro de empresa de salud
  function VIDA(nombre){
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
        document.getElementById('salud').value='';
        document.getElementById('salud').focus();
        versiti();
        if (data>0) {
          mensaje8(3,"Registro exitoso");
        }else {
          
          mensaje8(1,"Problemas con el registro");
        }
      } 
    });
  }










  //crear un pais
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
  //crear departamento
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
  //valida el documento de identidad que no se repite 
  function funcion1(identifay,num_documentoa1,col,id){ 
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
          var nom=num_documentoa1;
          actualizar_acudiente(nom,id,col);
      } 
    });
  }

  //valida el documento de identidad que no se repite 
  function funcion199(identifay,num_documentoa1){ 
    mostrar();
    $.ajax({  

      type: "post",
      data:{num_documentoa1,identifay}, 
        url:"../../../ajax/rector/alumno/alumno.php?action=validar_documento2",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          $('#_MSG5_').html(data); 
          
      } 
    });
  }
  //validar el numero de documento del estudiante
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
          var nom=document.getElementById('numero_documento').value;
          var col='numero_documento';
          actulizar_alumno(nom,col)

      } 
    });
  }
  //actualizar datos del acudiente
 function  actualizar_acudiente(nom,id,col){
  mostrar();
    $.ajax({  

      type: "post",
      data:{nom,id,col}, 
        url:"../../../ajax/rector/alumno/alumno.php?action=actualizar_acudiente",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          mensaje2(3,'Registro actualizado');
          
      } 
    });
  }
  //actualiza el dato de la tabla alumno_acudiente
 function  actualizar_acudienteww(nom,id,col){
  mostrar();
    $.ajax({  

      type: "post",
      data:{nom,id,col}, 
        url:"../../../ajax/rector/alumno/alumno.php?action=actualizar_acudiente3",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          mensaje2(3,'Registro actualizado');
          
      } 
    });
  }
  //busca el departamento de nacimiento o expedicion segun el pais 
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
       $('#departamento_nacimiento').html(data);

      }  


    });
  }

  //busca el departamento de nacimiento o expedicion segun el pais 
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
       $('#departamento_expedicion').html(data);

      }  


    });
  }
  //muestra la tabla de departamentos para registrar otro segun el pais que seleccione
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
  //actualiza datos del alumno
  function actulizar_alumno(nom,col,id){
 
    mostrar();
  
    $.ajax({   
      type: "post",

      data:{id,nom,col},
      url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=actualizar",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;
        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        mensaje2(3,'Registro actualizado');
          
      }  


    });
  }  
  //permite actualizar departamentos
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





    //elimina la relacion del  acudiente y el estudiante sin eliminar el acudiente del sistema
   function myFunction3(io){
    mostrar();
  
    $.ajax({   
      type: "post",

      data:{io},
      url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=eliminar_acudiente",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
        versiti();

      }   
    });
  }
  //tabla de departamentos
    function myFunction(i){
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




  //registra la matricula segun el año señalado
  function matriculacion(){
    mostrar();
    let jornada_sede=document.getElementById('jornada_sede').value;
    let curso=document.getElementById('curso').value;
    let id_alumno=document.getElementById('id_alumnos').value;
    let ano=document.getElementById('ano').value;
    let metodologia=document.getElementById('metodologia').value;
    let id_periodo=document.getElementById('id_periodo').value;
    
    $.ajax({  

      type: "post",
      data:{id_alumno,ano,jornada_sede,curso,metodologia,id_periodo}, 
        url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=matricula",

      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        if (data==1) {
          Swal.fire('Matricula exitosa', '', 'success');
        }
        if (data==0) {
          Swal.fire('El estudiante ya se encuentra Matriculado', '', 'error');
        }  
        if (data=="a") {
          Swal.fire('Debe seleccionar la sede', '', 'info');
        }
        if (data=="s") {
          Swal.fire('Debe seleccionar el curso', '', 'info');
        } 
        if (data=="d") {
          Swal.fire('Debe seleccionar la metodologia', '', 'info');
        } 
        if (data=="f") {
          Swal.fire('Debe seleccionar la metodologia', '', 'info');
        } 
        if (data=="q") {
          Swal.fire('Debe llenar los campos debidamente', '', 'error');
        } 
      } 
    });

  }
  //registra acudientes nuevos en el sistema
  $(document).on("submit", "#nuevo_acudiente", function(e){
    e.preventDefault(); 
    mostrar();
  
    var parametros=new FormData($("#nuevo_acudiente")[0]);
    $.ajax({

      data:parametros,
      url:"../../../ajax/rector/alumno/matricula_nuevo.php?action=registrar_acudiente1",
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
        
        Swal.fire({ 
          icon: 'success',
          title: 'Registro Exitoso ',
          showConfirmButton: false,
          timer: 2000
        });
        versiti(); 
        document.getElementById('div_acudiente').style.display = 'none';
        $("#padres").modal("hide"); 
        document.getElementById('nombre1a').required=true;
        document.getElementById('apellido1a').required=true; 
        document.getElementById('num_documento1a').required=true;
        document.getElementById('expedida1a').required=true;
        document.getElementById('direccion1a').required=true;
        document.getElementById('barrio1a').required=true;
        document.getElementById('ocupacion1a').required=true;
        document.getElementById('ob2').style.display='block';
        document.getElementById('ob1').style.display='none';
        document.getElementById('id_acudiente').required=false;


       document.getElementById("nuevo_acudiente").reset();
      }
    }); 
    
    
  });
</script>


