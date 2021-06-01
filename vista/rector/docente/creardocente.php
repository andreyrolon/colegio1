 
<!-- Google Font -->
<?php 
 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include('../enlaces/head.php'); 
require_once "../../../codes/rector/admin.php";
$admin=new admin();
$pais=$admin->pais();
$area=$admin->area1();

?>
 
   <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }  

   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
    $style='font-size: 17px;';  
  }else{ 
    $style='';
  }  ?>
 
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">

  <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?> 
    <div class="content-wrapper"> 
 
      <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">





        <div class="row" >  
          <div class="col-md-12"><div id="_MSG_" style="margin : 10px"></div></div>

          <div class="col-md-1"></div>
          <div class="col-md-10"style=" background-color: #fff;margin: 20px ;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="row" style="    background: #d73925;  color: white; padding: 7px;"><div><strong>Información Del  Docente</strong></div></div><br> 
            <div class="col-md-2">
              <center><br>
                <div> 
                  <img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" style="border-style: solid;
                  border-color: #d2d6de; height: 130px;width: 120px; ">
                </div><br>
                <div class="btn btn-default btn-file btn-lg">
                  <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
                  <input type="file" name="imgh" id="imgh" accept="image/*">
                  <input type="hidden" id="ad" name="ad">
                </div>
              </center>
            </div>
            <div class="col-md-10" style="">
              <div class="row">
                <div class="col-md-4">
                  <label for="nombre">Nombres</label>
                  <input class="form-control"  name="NOMBRE" id="NOMBRE"  type="text" value=""  style="  <?php echo  $style ?>"  pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras" required="">
                </div>
                <div class="col-md-4">
                  <label for="nombre">Apellidos</label>
                  <input class="form-control" name="APELLIDO" id="APELLIDO"  type="text"  style="  <?php echo  $style ?>" value="" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras" required=""> 
                </div>
                <div class="col-md-4">
                  <label for="nombre">genero</label><br>
                  <select name="GENERO" class="form-control"  style="  <?php echo  $style ?>">
                    <option value="1">Femenino</option>
                    <option value="0">Maculino</option>
                  </select>
                </div>
               
              </div><br>
              <div class="row">
                <div class="col-md-3">
                       <label for="nombre">Tipo de documento</label>
                  <select name="TIPO_DOCUMENTO" id="TIPO_DOCUMENTO" class="form-control"  style="  <?php echo  $style ?>" required=""> 
                    <option value="2">Cedula de Ciudadania</option>
                    <option value="3">Cedula Extranjeria</option>
                    <option value="5">Permiso Especial Permanencia(PEP)</option> 
                    <option value="4">Pasaporte</option> 
                    <option value="1">Tarjeta de Identidad</option>
                    <option value="6">Registro Civil</option>
                  </select>
                </div>
              
                <div class="col-md-3">
                  <label for="nombre">Numero documento</label>
                  <input name="NUMERO_DOCUMENTO" id="NUMERO_DOCUMENTO"    style="  <?php echo  $style ?>" id="numero_documento" type="text" class="form-control" placeholder=" " pattern="[0-9]{6,}" title="Ingrese solo numeros mayores a seis digitos " value="" onblur="funcion2()" required="">
                </div>
                <div class="col-md-3">
                  <label for="nombre">Lugar de expedicion </label>
                  <input type="text" class="form-control" name="EXPEDICION"  style="  <?php echo  $style ?>" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras" required="">
                </div>
                <div class="col-md-3">
                  <label for="nombre">fecha de nacimiento</label>
                  <input type="date" class="form-control" name="FECHA_NACIMIENTO"  style="  <?php echo  $style ?>" required="">
                </div>
              </div><br>


              <div class="row">
                <div class="col-md-3">
                  <label for="nombre">Pais de nacimiento </label><br>
                  <select name="PAIS" id='PAIS' class="form-control select2"  style="  <?php echo  $style ?>" onchange='var id=document.getElementById("PAIS").value; pais(id)' required>
                    <option value=""></option>
                    <?php foreach ($pais as $key ) {?>
                      <option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?></option>
                      <?php
                    } ?> 
                  </select>
                </div> 
                <div class="col-md-5">
                  <label for="nombre">depártamento o estado donde nacio </label>
                  <select name="ESTADO" class="form-control select2" id="estado"  style="  <?php echo  $style ?>" required="">
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="nombre">Ciudad de nacimiento</label>
                  <input type="" class="form-control" name="CIUDAD"  style="  <?php echo  $style ?>"  required="">
                </div>
              </div><br>

              <div class="row">
                <div class="col-md-3">
                  <label for="nombre">Direccion de vivienda</label>

                  <input type="" class="form-control" name="DIRECCION"  style="  <?php echo  $style ?>"  required="" >  
                </div>

                <div class="col-md-3">
                  <label for="nombre">Barrio</label>
                  <input type="" class="form-control" name="BARRIO"  style="  <?php echo  $style ?>"  required="">
                </div>
                <div class="col-md-3">
                  <label for="nombre">Telefono </label>
                  <input type="" class="form-control" name="TELEFONO_CA"  style="  <?php echo  $style ?>" pattern="[0-9]{7}" title="Solo permite numeros de siete digitos">
                </div>
                <div class="col-md-3">
                  <label for="nombre">Celular</label>

                  <input type="" class="form-control" name="CELULAR"  style="  <?php echo  $style ?>" pattern="[0-9]{10}" title="Solo permite numeros de diez digitos">
                </div>
              </div><br>

              <div class="row">
                <div class="col-md-3">
                  <label for="nombre">Email</label>
                  <input type="email" class="form-control" name="CORREO"  style="  <?php echo  $style ?>">
                </div>
                <div class="col-md-3">
                  <label for="nombre">Escalafon</label>
                  <input type="" class="form-control" name="ESCALAFON"  style="  <?php echo  $style ?>">
                </div>
                <div class="col-md-3">
                  <label for="nombre">Contraseña</label>    
                  <input   class="form-control"  type="password" id="CLAVE" name="CLAVE"  style="  <?php echo  $style ?>"  required="">
                </div>
                <div class="col-md-3">
                  <label for="nombre">Verificación</label>  
                  <input   class="form-control"  type="password" id="c2" name="c2"  style="  <?php echo  $style ?>" onchange=' var d=document.getElementById("CLAVE").value; var d1=document.getElementById("c2").value;if(d!=d1){ mensaje(1,"Las contraseñas no conciden");document.getElementById("CLAVE").value="";document.getElementById("CLAVE").focus();document.getElementById("c2").value=""; } '  required="">
                </div>
              </div> <br><br>
              <div class="row">
                 <div class="col-md-12">
                  <label for="nombre">Area ha cargo</label><br>
                  <select id="Area" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Selecione el area" style="width: 100%;background-color: #000" name="Area[]"   aria-hidden="true">
                  <option value=""></option>
                  <?php 
                  foreach ($area as  $value) {
                    ?><option value="<?php  echo $value['nombre'] ?>"><?php  echo $value['nombre'] ?></option>
                    <?php
                   } ?>
                  </select>
                </div>
              </div><br>
            </div> 
          </div>
        </div>




        <div class="row" >
          <div class="col-md-1"></div>
          <div class="col-md-10"style=" background-color: #fff;margin: 20px ;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="row" style="    background:#3c8dbc; color: white; padding: 7px;"><div><strong>Titulos Adquiridos</strong></div></div>  <br>
            <div class="table-responsive" style="">
           
              <table class="table  "  id="tabla">
                <tr class="fila-fija"> 
                  <td>
                    <label for="nombre">titulo adquirido</label>
                    <input  value="" class="form-control"  name="nombre[]" placeholder="titulo adquirido"   style="  <?php echo  $style ?>" />
                  </td>
                  <td>
                    <label for="nombre">institucion   </label>
                    <input  value=""  class="form-control" name="institucion[]" placeholder="institucion"    style="  <?php echo  $style ?>"    /></td>
                  <td>
                     <label for="nombre">año  </label>
                     <input   class="form-control"  value=""  name="ano[]" placeholder="año"   style="margin-right: 40px;  <?php echo  $style ?>" ></td>
                  <td class="eliminar" id="e" style="display:none;  ;">
                    <br><img style="width: 33px;" id="img" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo="></td>
                </tr  >
              </table>
              <div class="col-md-3"> 
                <button id="adicional" name="adicional"  style="text-align: right; <?php echo  $style ?>;padding-left: 20px;padding-right:20px"  type="button" class="btn btn-block  btn-warning btn-lg"><center> MÁS <strong>+</strong>  </center> 
                </button>
              </div>
              <div class="col-md-3">
                <button type="submit" class="btn btn-block btn-primary  btn-lg"    > <img style="width: 21px;margin-left: 5px" src="data:image/svg+xml;base64,
                        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iaG92ZXJlZC1wYXRocyI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzY3LjU3LDI1Ni45MDljLTkuODM5LTQuNjc3LTE5Ljg3OC04LjcwNi0zMC4wOTMtMTIuMDgxQzM3MC41NiwyMTkuOTk2LDM5MiwxODAuNDU1LDM5MiwxMzZDMzkyLDYxLjAxLDMzMC45OTEsMCwyNTYsMCAgICBjLTc0Ljk5MSwwLTEzNiw2MS4wMS0xMzYsMTM2YzAsNDQuNTA0LDIxLjQ4OCw4NC4wODQsNTQuNjMzLDEwOC45MTFjLTMwLjM2OCw5Ljk5OC01OC44NjMsMjUuNTU1LTgzLjgwMyw0Ni4wNjkgICAgYy00NS43MzIsMzcuNjE3LTc3LjUyOSw5MC4wODYtODkuNTMyLDE0Ny43NDNjLTMuNzYyLDE4LjA2NiwwLjc0NSwzNi42MjIsMTIuMzYzLDUwLjkwOEMyNS4yMjIsNTAzLjg0Nyw0Mi4zNjUsNTEyLDYwLjY5Myw1MTIgICAgSDMwN2MxMS4wNDYsMCwyMC04Ljk1NCwyMC0yMGMwLTExLjA0Ni04Ljk1NC0yMC0yMC0yMEg2MC42OTNjLTguNTM4LDAtMTMuNjg5LTQuNzY2LTE1Ljk5OS03LjYwNiAgICBjLTMuOTg5LTQuOTA1LTUuNTMzLTExLjI5LTQuMjM2LTE3LjUxOWMyMC43NTUtOTkuNjk1LDEwOC42OTEtMTcyLjUyMSwyMTAuMjQtMTc0Ljk3N2MxLjc1OSwwLjA2OCwzLjUyNiwwLjEwMiw1LjMwMiwwLjEwMiAgICBjMS43OTMsMCwzLjU3OC0wLjAzNSw1LjM1NC0wLjEwNGMzMS4xMiwwLjczLDYxLjA1LDcuODMyLDg5LjA0NCwyMS4xNGM5Ljk3Nyw0Ljc0LDIxLjkwNywwLjQ5OSwyNi42NDktOS40NzggICAgQzM4MS43ODksMjczLjU4MiwzNzcuNTQ3LDI2MS42NTEsMzY3LjU3LDI1Ni45MDl6IE0yNjAuODc4LDIzMS44NzdjLTEuNjIzLTAuMDI5LTMuMjQ5LTAuMDQ0LTQuODc4LTAuMDQ0ICAgIGMtMS42MTQsMC0zLjIyOCwwLjAxNi00Ljg0LDAuMDQ2QzIwMC40NjUsMjI5LjM1LDE2MCwxODcuMzEyLDE2MCwxMzZjMC01Mi45MzUsNDMuMDY1LTk2LDk2LTk2czk2LDQzLjA2NSw5Niw5NiAgICBDMzUyLDE4Ny4yOTksMzExLjU1NSwyMjkuMzI5LDI2MC44NzgsMjMxLjg3N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OTIsMzk3aC01NXYtNTVjMC0xMS4wNDYtOC45NTQtMjAtMjAtMjBjLTExLjA0NiwwLTIwLDguOTU0LTIwLDIwdjU1aC01NWMtMTEuMDQ2LDAtMjAsOC45NTQtMjAsMjAgICAgYzAsMTEuMDQ2LDguOTU0LDIwLDIwLDIwaDU1djU1YzAsMTEuMDQ2LDguOTU0LDIwLDIwLDIwYzExLjA0NiwwLDIwLTguOTU0LDIwLTIwdi01NWg1NWMxMS4wNDYsMCwyMC04Ljk1NCwyMC0yMCAgICBDNTEyLDQwNS45NTQsNTAzLjA0NiwzOTcsNDkyLDM5N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg=="> REGISTRO INDIVIDUAL   
                      </button>
              </div>
              <div class="col-md-3" onclick="">
                <div class="btn btn-success  btn-file btn-lg" style="width: 100%" >
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
                          Tenga en cuanta que esta opción permite hacer registros  a docentes  masivamente, para eso debes agragar una hoja de excel con el boton que dice archivo excel, en el cual te permite subir la lista de los docentes que tengas en tu ordenador. Dicha lista debe tener siertos numeros de registro: 
                           <br>  <br> 
                         
                          <strong> El genero de los docentes  se identificara de la siguiente manera:</strong>
                          <br>  <strong>*</strong> el numero 1 si es Mujer  
                          <br>  <strong>*</strong> el numero 0 si es Hombre  <br>    
                          <br> <br>  
                          <strong> en los tipos de documentos se identificará con los siguientes numeros:</strong>
                          <br>  <strong>*</strong> el numero 1 si es Tarjeta de Identidad  
                          <br>  <strong>*</strong> el numero 2 si es Cedula de Ciudadania  
                          <br>  <strong>*</strong> el numero 3 si es Cedula Extranjeria 
                          <br>  <strong>*</strong> el numero 4 si es Permiso Especial Permanencia(PEP)
                          <br>  <strong>*</strong> el numero 5 si es Registro Civil 
                          <br>  <strong>*</strong> el numero 6 si es Pasaporte 
                          <br>  <br> 
                          <strong>el formato de las fecha debe ser dia/mes/año este es un  ejemplo 1/12/2001</strong><br><br>
                          
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
                <button type="button" class="btn btn-block btn-danger btn-lg"  data-toggle="modal" data-target="#may"   >
                  <img style="width: 23px;margin-left: 5px" src="data:image/svg+xml;base64,
                  PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJDYXBhXzEiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUxMiA1MTIiIGhlaWdodD0iNTEyIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMiIgY2xhc3M9IiI+PGc+PHBhdGggZD0ibTMxMC41NzkgMjQwLjcxMmMyMi45MzgtMTguMTIgMzcuNjc2LTQ2LjEwNyAzNy42NzYtNzcuNDU5IDAtNTQuNS00NC41MjctOTguODM5LTk5LjI1OS05OC44MzlzLTk5LjI2IDQ0LjMzOS05OS4yNiA5OC44MzljMCAzLjU3Mi4xOTYgNy4xLjU2OSAxMC41NzUtMTEuMjgyLTYuMTYxLTI0LjIyMS05LjY3Mi0zNy45NzEtOS42NzItNDMuNjkzIDAtNzkuMjM5IDM1LjQwMy03OS4yMzkgNzguOTE5IDAgMjIuNjg4IDkuNjc2IDQzLjE1NiAyNS4xMTcgNTcuNTY2LTM0LjIzNyAxNS4wMzItNTguMjEyIDQ5LjI1Ni01OC4yMTIgODguOTh2OTEuNzcyYzAgMTYuODc3IDEzLjczIDMwLjYwNyAzMC42MDcgMzAuNjA3aDExMS4xOTEgMTAgMjA0LjM5NGMxOS41NiAwIDM1LjQ3Mi0xNS45MTIgMzUuNDcyLTM1LjQ3MnYtMTIwLjM3MWMwLTUzLjA1OS0zMy44NDktOTguMzU2LTgxLjA4NS0xMTUuNDQ1em0tNjEuNTgzLTE0Ni4yOThjMzguMTkgMCA2OS4yNTkgMzAuODgxIDY5LjI1OSA2OC44MzlzLTMxLjA2OSA2OC44MzktNjkuMjU5IDY4LjgzOS02OS4yNi0zMC44ODEtNjkuMjYtNjguODM5IDMxLjA3LTY4LjgzOSA2OS4yNi02OC44Mzl6bS0xMzYuNjYyIDk5Ljc0MmMyNy4xNTEgMCA0OS4yNCAyMS45NDUgNDkuMjQgNDguOTE5IDAgMy45MTItLjQ3MiA3Ljc5NC0xLjM4NiAxMS41NTEtMTMuNzk1IDkuMzg2LTI1LjU4NyAyMS41MDUtMzQuNTg5IDM1LjU3NS00LjI5MyAxLjE5LTguNzM4IDEuNzk0LTEzLjI2NSAxLjc5NC0yNy4xNSAwLTQ5LjIzOS0yMS45NDUtNDkuMjM5LTQ4LjkyIDAtMjYuOTczIDIyLjA4OS00OC45MTkgNDkuMjM5LTQ4LjkxOXptLTgyLjMzNCAyODcuMjM3di05MS43NzJjMC0zNy4wMTQgMzAuMTEzLTY3LjEyNyA2Ny4xMjctNjcuMTI3aDEzLjg5NWMtMy4wNTcgMTAuNzAxLTQuNjk1IDIxLjk5NC00LjY5NSAzMy42NjN2MTIwLjM3MWMwIDEuODYxLjE0NiAzLjY4OC40MjMgNS40NzJoLTc2LjE0M2MtLjMgMC0uNjA3LS4zMDctLjYwNy0uNjA3em0zMzEuNjY0LTQuODY1YzAgMi45NjYtMi41MDYgNS40NzItNS40NzIgNS40NzJoLTIwNC4zOTMtMTBjLTIuOTY2IDAtNS40NzItMi41MDYtNS40NzItNS40NzJ2LTEyMC4zNzFjMC01MS4xMjcgNDEuNTk1LTkyLjcyMiA5Mi43MjItOTIuNzIyaDM5Ljg5M2M1MS4xMjcgMCA5Mi43MjIgNDEuNTk1IDkyLjcyMiA5Mi43MjJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTQ5NyA0Mi4zNThoLTI3LjU3MXYtMjcuMzU4YzAtOC4yODQtNi43MTYtMTUtMTUtMTVzLTE1IDYuNzE2LTE1IDE1djI3LjM1OGgtMjcuNTdjLTguMjg0IDAtMTUgNi43MTYtMTUgMTVzNi43MTYgMTUgMTUgMTVoMjcuNTd2MjcuMzU5YzAgOC4yODQgNi43MTYgMTUgMTUgMTVzMTUtNi43MTYgMTUtMTV2LTI3LjM1OWgyNy41NzFjOC4yODQgMCAxNS02LjcxNiAxNS0xNXMtNi43MTYtMTUtMTUtMTV6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PC9nPiA8L3N2Zz4=" />  REGISTROS MASIVOS
                </button>
              </div> 
             
              <br><br>
            </div> <br>
          </div>
        </div>
      </form>
    </div>
    <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> IBUnotas</b> 1.0
    </div>
    <strong>Desarrollado por  IBUsoft. </strong> 
  </footer>
  </div>
</body> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.js"></script>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
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
</script>
<script type="text/javascript">

  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
  }

  function funcion2(){ 
    var numero_documento= document.getElementById('NUMERO_DOCUMENTO').value;
    var tipo_documento= document.getElementById('TIPO_DOCUMENTO').value;
    $.ajax({  

      type: "post",
      data:{numero_documento,tipo_documento}, 
        url:"../../../ajax/rector/docentes.php?action=validar_documento",

      dataType:"text", 

      success:function(data){  
          $('#_MSG_').html(data);
      }  
    });
  }



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
   $(function(){ 
        // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
        $("#adicional").on('click', function(){
          document.getElementById('img').style.display='display';
          $(".fila-fija").clone().removeClass('fila-fija').appendTo("#tabla");
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

      }  


    });
  }

  function sasa() {
    mostrar(); 
    var ex=document.getElementById('ex').value;
    if (ex=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});
      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;
      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} );
      mensaje(2,'Seleccione un  archivo de excel');
    }else{
      var parametros=new FormData($("#formulario-envia")[0]);
      $.ajax({
        
        data:parametros,
        url:"../../../ajax/rector/docentes.php?action=excel",
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
          swal(
            "Registro exitoso!",
            " ",
            "success"
          );
        }
      }); 
    }
   
  }
       
  function myFunction() {
    window.location.assign( window.location.href);
  } 
             
  $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault(); 
    mostrar();
    var archivoRuta = document.getElementById('imgh').value;
    var vacio=''; 
    var extPermitidas3 = /(.jpg)$/i;
    var extPermitidas4 = /(.png)$/i;
    if(vacio==archivoRuta){
        document.getElementById('ad').value='';
    }
    if(extPermitidas3.exec(archivoRuta)){
      document.getElementById('ad').value='.jpg';
    }
    if(extPermitidas4.exec(archivoRuta)){ 
      document.getElementById('ad').value='.png';
    } 
    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({
        
      data:parametros,
      url:"../../../ajax/rector/docentes.php?action=registro",
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
        swal(
          "Registro exitoso!",
          " ",
          "success"
        );
        setTimeout(myFunction, 1000) 

 

      }
    });
  }); 
  








      </script> 