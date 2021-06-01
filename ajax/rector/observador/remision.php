


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}

function actualizar(){ 
  session_start();

  if ($_POST["id_observador"]=="" || $_POST["id_remision"]=="" || $_SESSION['Id_Doc']=="") {

    echo 3;
    return;
  }

  if (  (!preg_match ("/^[0-9]+$/", $_POST["id_observador"]))  || (!preg_match ("/^[0-9]+$/", $_POST["id_remision"]))  || (!preg_match ("/^[0-9]+$/", $_POST["proceso"]))   || (!preg_match ("/^[0-9]+$/", $_POST["compromiso"])) ) {
    echo 3;
    return;
  }  
  
  if ($_POST["proceso"]>0 &&  ($_POST["texto_remision"]==""  )) {
    echo 4;
    return;
  }
  if ($_POST["orientacion"]==""  ) {
    echo 11;
    return;
  } 
  if ($_POST["accion"]==""  ) {
    echo 12;
    return;
  } 
  if ($_POST["estado"]==""  ) {
    echo 13;
    return;
  } 

  if (   (!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["orientacion"]))  || (!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["estado"])) || (!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["accion"])) ){
    echo 7;
    return;
  } 
  if ( $_POST["proceso"]>0 &&   (!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["texto_remision"])) ){
    echo 7;
    return;
  } 
  include "../../conexion.php" ; 
  
  $consul=" UPDATE `observacion` SET `id_admin`='".$_SESSION['Id_Doc']."',`compromiso`='".$_POST["compromiso"]."' WHERE observacion.id='".$_POST["id_observador"]."';UPDATE `remision` SET  `estado`='".$_POST["estado"]."',`orientacion`='".$_POST["orientacion"]."',`accion`='".$_POST["accion"]."',`matricula_condicional`='".$_POST["proceso"]."',`texto_remision`='".$_POST["texto_remision"]."' WHERE   id_remision=".$_POST["id_remision"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  



}
function comite(){  

  if ($_POST["grado"]=="" || $_POST["curso"]=="" || $_POST['jornada_sede1']=="") {

    echo 4;
    return;
  }

  if (  (!preg_match ("/^[0-9]+$/", $_POST["grado"]))  || (!preg_match ("/^[0-9]+$/", $_POST["curso"]))  || (!preg_match ("/^[0-9]+$/", $_POST["jornada_sede1"])) ) {
    echo 3;
    return;
  }  

  include "../../conexion.php" ; 

  $apellidos='';
  $ape="";
  if (isset($_POST["apellidos"])) {
    $ape=$_POST["apellidos"];
    $apellidos=' And   alumnos.apellido like("%'.$_POST["apellidos"].'%")';
    if ((!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["apellidos"]))) {
      ?>
      <div class="col-md-12  "><br>
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
          <h4><i class="icon fa fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¡Alerta!</font></font></h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
          El curso señalado no tiene alumnos registrados.  </font>
        </div>
      </div><?php
      return;
    }
  }
  $consul="  SELECT remision.id_remision,remision.texto_remision, observacion.fecha, alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.foto from alumnos,remision,observacion WHERE observacion.id_jornada_sede=".$_POST["jornada_sede1"]." and observacion.id_grado=".$_POST["grado"]." and observacion.id_curso=".$_POST["curso"]." and observacion.id=remision.id_observacion and observacion.id_alumno=alumnos.id_alumnos and remision.matricula_condicional>0  $apellidos Order  by remision.id_remision DESC
  ";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont==0) { ?>
    <div class="col-md-12  "><br>
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
        <h4><i class="icon fa fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¡Alerta!</font></font></h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        El curso señalado no tiene alumnos registrados.  </font></div>
        </div><?php
        return;

      }
      ?>   
      <style type="text/css">
        .im{
          width: 59px;
          height: 70px;
        }
        .im:hover{
          width: 100px; 
          height: 123px;
        }

        td{ 
          border: solid 1px #d5d5d5; 
          text-align: center;
        }
        th{
         text-align: center; 
       }
     </style>

     <div class="col-md-12" style="padding: 9px">
      <div class="col-md-12">
        <div class=" btn-link" style="font-size: 17px"><strong>Tabla de estudiantes con seguimiente  de Comite </strong> 
        </div> 
        Esta tabla muestra estudiantes que tiene remisiones de compromiso academico y disciplinario. mostrando dos novedades. Recuerde que un estudiantes tiene una sola novedad en el sistema <br>
        1. bloqueado. esta opcion no permite que el estudiante vuelva a matricularse en la institucion en el siguiente campo debera explicar el porque<br>
        2. Acelearado. Estudiantes  que perdio el año y tiene oportunidad de que lo promuevas a mitad de año o de periodo<br> <br>

        <input type="hidden" value="1" id="pagina">
        <input type="hidden" value="5" id="cantidad"> 
        <div class=" col-md-12">
          <select class="form-control" id="seleccion" style=" float: left;   width: 63px;
          border-radius: 62px;" onchange=" cambio()">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="40">40</option>
          <option value="80">80</option>
        </select>
        <input id="apellidos" placeholder="Buscar apellidos.." type="" class="form-control" style="float: right; width: 200px;border-radius: 49px"  value="<?php echo $ape ?>" onchange ="buscar()" >
      </div><br><br><br>
      <div class="col-md-12 table-responsive">
        <table id="example" class=" table table-hover table-bordered"  style="width: 100%" >

          <thead>
           <tr >
            <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
            <th>Alumno</th>

            <th>Fecha</th>
            <th >Seguimiento</th>             </tr>
          </thead>
          <tbody>
            <?php 
            $i=0;
            foreach ($consulta as $key ) { 
              $i++; ?>
              <tr class="tab" id="tabla<?php echo $i ?>"  style="display: none;">
                <td>
                  <img class="profile-user-img img-responsive img-circle im" src="<?php echo $key['foto'] ?>" alt="User profile picture">
                </td>
                <td><?php echo $key["nombre"]." ".$key["apellido"]; ?></td>
                <td><?php echo $key["fecha"]?></td>
                <td>
                  <button class="btn btn-info" data-toggle="modal" data-target="#alumno" onclick="seguimiento(<?php echo $key["id_alumnos"].",'".$key["texto_remision"]."',".$key["id_remision"] ?>)">agregar</button>
                </td>   
              </tr>
              <?php   
            }  ?>
          </tbody>
        </table>
        <div id="sapo1"></div>
      </div>
    </div>
  </div>
  <script type="text/javascript">

    function cambio(){ 

      let seleccion=$("#seleccion").val(); 
      $("#cantidad").val(seleccion);

      document.getElementById('pagina').value=1;  
      sele();
    }
    function myFunction(u){
      document.getElementById('pagina').value=u; 
      sele();
    }
    function sele(){ 
      // cada vez que se ejecute este escript el scroll estara al inicio de pagina
      $("html,body,.bin").animate({
        scrollTop:0
      })

      //pagina en la cual estamos
      var paginaActual=parseInt(document.getElementById('pagina').value); 

      //la cantidad de  registros que    queremos ver
      var nroLotes=parseInt(document.getElementById('cantidad').value);


                //EL TOTAL DE LOS REGISTROS
                var nroProductos=<?php echo $cont ?>; 

                //DIVIDIMOS EL TOTAL DE LOS REGISTROS CON  LA CANTIDAD QUE MOSTRAMOS EN NUESTRA PAGINACION para obtener el numeracion de nuestra paginacion
                var nroPaginas = nroProductos/nroLotes;
                var lista='';

                ; 
                if(paginaActual > 1){
                  var p1=paginaActual-1
                  lista = lista+'<nav aria-label="..."><ul class="pagination" style="cursor: pointer;">  <li class="page-item  " id="f'+p1+'" value="'+p1+'"onclick="myFunction('+p1+')"><a class="page-link"><i class="fa fa-reply"></i></a></li>';
                } else{ 
                  lista = lista+'<nav aria-label="..."><ul class="pagination">  <li class="page-item disabled "   ><a class="page-link"><i class="fa fa-reply"></i></a></li>';
                }


                var i = Math.max( paginaActual -2,1); 
                var t=Math.min( nroPaginas+1,paginaActual + 3); 
                for (i; i < Math.min(paginaActual + 3, nroPaginas+1); i++) {
                  if(i == paginaActual){
                    lista = lista+'<li class="page-item active"   id="f'+i+'" class="btn btn-default btn-sm" value="'+i+'"onclick="myFunction('+i+')"> <span class="page-link">'+i+'<span class="sr-only">(current)</span></span></li> ';
                  }else{
                    lista = lista+'<li class="page-item  "   id="f'+i+'" class="btn btn-default btn-sm" value="'+i+'"onclick="myFunction('+i+')"><a class="page-link">'+i+'<span class="sr-only">(current)</span></a></li> ';
                  }
                }
                if(paginaActual < nroPaginas){
                  var p2=paginaActual+1;
                  lista = lista+'<li class="page-item  " style="cursor: pointer;" id="f'+p2+'" value="'+p2+'"onclick="myFunction('+p2+')"><a class="page-link"><i class="fa fa-share"></i></a></li>';
                  
                }else{
                 lista = lista+'<li class="page-item  disabled "   "><a class="page-link"><i class="fa fa-share"></i></a></li>';
               }

               $('#sapo1').html(lista);


                //multiplicamos la cantidad de registros por la pagina actual para saber el ristro maximo que debemos mostrar en nuestro bocle
                var vista_max=parseInt(nroLotes*paginaActual);

                //hacemos el mismo procedimiento que el anterior pero restando primeramente 1 a la pagina actual para poder obtener el registro minimo  y poder colocar el rango en nuestro bucle for
                var vista_inicio=parseInt(nroLotes*(paginaActual-1));

                //desaparecemos todos los registros para que en el for muestre los que son
                $('.tab').hide();

                //si es cero significa que es la primera pagina de nuestra paginacion por ende mostramos el primer registro y le sumamos uno a nuestro rango minimo para que muestre los registros necesarios
                if (vista_inicio<=0) {
                  vista_inicio=1;

                  document.getElementById('tabla1').style.display='revert'; 
                }

                vista_inicio=vista_inicio+1;
                for (vista_inicio;  vista_inicio<vista_max+1 ; vista_inicio++) {  
                  document.getElementById('tabla'+vista_inicio).style.display='revert'; 
                } 
              }
              sele();
            </script>
            <?php 

}

function comite2(){  
 
  if (isset($_POST["apellidos"])) {
     
    if ((!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["apellidos"]))) {
      ?>
      <div class="col-md-12  "><br>
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
          <h4><i class="icon fa fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¡Alerta!</font></font></h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
          El curso señalado no tiene alumnos registrados.  </font>
        </div>
      </div><?php
      return;
    }
  }
  include "../../conexion.php" ; 
  $consul="  SELECT remision.id_remision,remision.texto_remision,  observacion.fecha, alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.foto from alumnos,remision,observacion WHERE observacion.id=remision.id_observacion and observacion.id_alumno=alumnos.id_alumnos and remision.matricula_condicional>0 And   alumnos.apellido like('%".$_POST["apellidos"]."%') Order  by remision.id_remision DESC
  ";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont==0) { ?>
    <div class="col-md-12  "><br>
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
        <h4><i class="icon fa fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¡Alerta!</font></font></h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        El curso señalado no tiene alumnos registrados.  </font></div>
        </div><?php
        return;

      }
      ?>   
      <style type="text/css">
        .im{
          width: 59px;
          height: 70px;
        }
        .im:hover{
          width: 100px; 
          height: 123px;
        }

        td{ 
          border: solid 1px #d5d5d5; 
          text-align: center;
        }
        th{
         text-align: center; 
       }
     </style>

     <div class="col-md-12" style="padding: 9px">
      <div class="col-md-12">
        <div class=" btn-link" style="font-size: 17px"><strong>Tabla de estudiantes con seguimiente  de Comite </strong> 
        </div> 
        Esta tabla muestra estudiantes que tiene remisiones de compromiso academico y disciplinario. mostrando dos novedades. Recuerde que un estudiantes tiene una sola novedad en el sistema <br>
        1. bloqueado. esta opcion no permite que el estudiante vuelva a matricularse en la institucion en el siguiente campo debera explicar el porque<br>
        2. Acelearado. Estudiantes  que perdio el año y tiene oportunidad de que lo promuevas a mitad de año o de periodo<br> <br>

        <input type="hidden" value="1" id="pagina">
        <input type="hidden" value="5" id="cantidad"> 
        <div class=" col-md-12">
          <select class="form-control" id="seleccion" style=" float: left;   width: 63px;
          border-radius: 62px;" onchange=" cambio()">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="40">40</option>
          <option value="80">80</option>
        </select> 
      </div><br><br><br>
      <div class="col-md-12 table-responsive">
        <table id="example" class=" table table-hover table-bordered"  style="width: 100%" >

          <thead>
           <tr >
            <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
            <th>Alumno</th>

            <th>Fecha</th>
            <th >Seguimiento</th>             </tr>
          </thead>
          <tbody>
            <?php 
            $i=0;
            foreach ($consulta as $key ) { 
              $i++; ?>
              <tr class="tab" id="tabla<?php echo $i ?>"  style="display: none;">
                <td>
                  <img class="profile-user-img img-responsive img-circle im" src="<?php echo $key['foto'] ?>" alt="User profile picture">
                </td>
                <td><?php echo $key["nombre"]." ".$key["apellido"]; ?></td>
                <td><?php echo $key["fecha"]?></td>
                <td>
                  <button class="btn btn-info" data-toggle="modal" data-target="#alumno" onclick="seguimiento(<?php echo $key["id_alumnos"].",'".$key["texto_remision"]."',".$key["id_remision"] ?>)">agregar</button>
                </td>   
              </tr>
              <?php   
            }  ?>
          </tbody>
        </table>
        <div id="sapo1"></div>
      </div>
    </div>
  </div>
  <script type="text/javascript">

    function cambio(){ 

      let seleccion=$("#seleccion").val(); 
      $("#cantidad").val(seleccion);

      document.getElementById('pagina').value=1;  
      sele();
    }
    function myFunction(u){
      document.getElementById('pagina').value=u; 
      sele();
    }
    function sele(){ 
      // cada vez que se ejecute este escript el scroll estara al inicio de pagina
      $("html,body,.bin").animate({
        scrollTop:0
      })

      //pagina en la cual estamos
      var paginaActual=parseInt(document.getElementById('pagina').value); 

      //la cantidad de  registros que    queremos ver
      var nroLotes=parseInt(document.getElementById('cantidad').value);


                //EL TOTAL DE LOS REGISTROS
                var nroProductos=<?php echo $cont ?>; 

                //DIVIDIMOS EL TOTAL DE LOS REGISTROS CON  LA CANTIDAD QUE MOSTRAMOS EN NUESTRA PAGINACION para obtener el numeracion de nuestra paginacion
                var nroPaginas = nroProductos/nroLotes;
                var lista='';

                ; 
                if(paginaActual > 1){
                  var p1=paginaActual-1
                  lista = lista+'<nav aria-label="..."><ul class="pagination" style="cursor: pointer;">  <li class="page-item  " id="f'+p1+'" value="'+p1+'"onclick="myFunction('+p1+')"><a class="page-link"><i class="fa fa-reply"></i></a></li>';
                } else{ 
                  lista = lista+'<nav aria-label="..."><ul class="pagination">  <li class="page-item disabled "   ><a class="page-link"><i class="fa fa-reply"></i></a></li>';
                }


                var i = Math.max( paginaActual -2,1); 
                var t=Math.min( nroPaginas+1,paginaActual + 3); 
                for (i; i < Math.min(paginaActual + 3, nroPaginas+1); i++) {
                  if(i == paginaActual){
                    lista = lista+'<li class="page-item active"   id="f'+i+'" class="btn btn-default btn-sm" value="'+i+'"onclick="myFunction('+i+')"> <span class="page-link">'+i+'<span class="sr-only">(current)</span></span></li> ';
                  }else{
                    lista = lista+'<li class="page-item  "   id="f'+i+'" class="btn btn-default btn-sm" value="'+i+'"onclick="myFunction('+i+')"><a class="page-link">'+i+'<span class="sr-only">(current)</span></a></li> ';
                  }
                }
                if(paginaActual < nroPaginas){
                  var p2=paginaActual+1;
                  lista = lista+'<li class="page-item  " style="cursor: pointer;" id="f'+p2+'" value="'+p2+'"onclick="myFunction('+p2+')"><a class="page-link"><i class="fa fa-share"></i></a></li>';
                  
                }else{
                 lista = lista+'<li class="page-item  disabled "   "><a class="page-link"><i class="fa fa-share"></i></a></li>';
               }

               $('#sapo1').html(lista);


                //multiplicamos la cantidad de registros por la pagina actual para saber el ristro maximo que debemos mostrar en nuestro bocle
                var vista_max=parseInt(nroLotes*paginaActual);

                //hacemos el mismo procedimiento que el anterior pero restando primeramente 1 a la pagina actual para poder obtener el registro minimo  y poder colocar el rango en nuestro bucle for
                var vista_inicio=parseInt(nroLotes*(paginaActual-1));

                //desaparecemos todos los registros para que en el for muestre los que son
                $('.tab').hide();

                //si es cero significa que es la primera pagina de nuestra paginacion por ende mostramos el primer registro y le sumamos uno a nuestro rango minimo para que muestre los registros necesarios
                if (vista_inicio<=0) {
                  vista_inicio=1;

                  document.getElementById('tabla1').style.display='revert'; 
                }

                vista_inicio=vista_inicio+1;
                for (vista_inicio;  vista_inicio<vista_max+1 ; vista_inicio++) {  
                  document.getElementById('tabla'+vista_inicio).style.display='revert'; 
                } 
              }
              sele();
            </script>
            <?php 

}
function seguimiento(){
    include "../../conexion.php" ; 
  if(!preg_match ("/^[0-9]+$/", $_POST["id"])){ ?>
    <div class="col-md-12  "><br>
      <div class="alert erroneo alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
        <h4><i class="icon fa fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¡Alerta!</font></font></h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        Problemas con las variables.  </font></div>
        </div><?php
        return;
  }
  $consul="  SELECT remision.matricula_condicional,remision.texto_remision,seguimiento_matricula.id,seguimiento_matricula.fecha,seguimiento_matricula.seguimiento,seguimiento_matricula.Descripcion from seguimiento_matricula,remision WHERE remision.id_remision=seguimiento_matricula.id_remision and seguimiento_matricula.id_alumnos=".$_POST["id"];
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont>0) {
    foreach ($consulta as $value) { 
      ?>

      <div>
        <strong>Remision</strong><br>
        <textarea type="" disabled name="" class="form-control"><?php echo $value["texto_remision"] ?></textarea><br>

        <strong>Novedades</strong><br>
        <select class="form-control" id="novedad_actualizar">  
          <option value="1">Bloqueado. Bloquea las matriculas del proximo año</option>
          <option value="2"> Acelerado. Adelantar el  proximo año</option>
        </select><br>
        <strong>Motivo</strong><br>
        <textarea class="form-control" id="motivo_actualizar"><?php echo $value["Descripcion"] ?></textarea><br>
        <strong>Fecha</strong>
        <input type="date" disabled class="form-control" name="" value="<?php echo $value["fecha"] ?>">
        <script type="text/javascript">
          document.getElementById('novedad_actualizar').value=<?php echo $value["seguimiento"] ?>;
        </script><br> 
      </div>


      <div class="modal-footer">
        <input type="hidden" value="0" id="valor" name="">
        <button type="button" class="btn btn-default btn-secondary" data-dismiss="modal">Cancelar</button>     
        <button type="button" class="btn btn-danger btn-secondary"  onclick="eliminar(<?php echo $_POST["id"].",'".$_POST["remision"]."',".$_POST["id_remision"].",".$value["id"] ?>)">Eliminar</button>   
        <button type="button" class="btn btn-primary btn-secondary"   onclick="
        let novedad_actualizar=document.getElementById('novedad_actualizar').value;
        let motivo_actualizar=document.getElementById('motivo_actualizar').value; 
        actualizar(novedad_actualizar,motivo_actualizar,<?php echo $value["id"].",".$value["seguimiento"]. ",'".$value["Descripcion"]. "'" ?>)">Actualizar</button>  
      </div>
      <?php
    }
  }else{ ?>
    <div>
      <strong>Remision</strong><br>
      <textarea class="form-control" disabled=""><?php echo $_POST["remision"] ?></textarea><br>
      <strong>Novedades</strong><br>
      <select class="form-control" id="novedad"> 
        <option value="0">Seleccione</option>
        <option value="1">Bloqueado. Bloquea las matriculas del proximo año</option>
        <option value="2"> Acelerado. Adelantar el  proximo año</option>
      </select><br>
      <strong>Motivo</strong><br>
      <textarea class="form-control" id="motivo"></textarea><br>
      
      <input type="hidden" id="id_alumno" value="" name="">
      <input type="hidden" id="id_remision" value="<?php echo $_POST["id_remision"] ?>" name="">
      <input type="hidden" id="ano" value="<?php echo $ano ?>" name="">
      <input type="hidden" id="fecha" value="<?php echo $fecha_actual ?>" name="">
    </div>
    <div class="modal-footer">
      <input type="hidden" value="0" id="valor" name="">
      <button type="button" class="btn btn-default btn-secondary" data-dismiss="modal">Cancelar</button>        <button type="button" class="btn btn-primary btn-secondary"   onclick="
      let novedad=document.getElementById('novedad').value;
      let motivo=document.getElementById('motivo').value; 
       registrar(<?php echo $_POST["id"].",".$_POST["id_remision"] ?>,novedad,motivo,'<?php echo $_POST["remision"] ?>')">Registrars</button>  
    </div>
    
    <?php
  }
}


function registrar_seguimiento(){

  if(  $_POST["id"]=="" ||  $_POST["id_remision"]=="" ||  $_POST["novedad"]=="" ||  $_POST["novedad"]==0 || $_POST["motivo"]==""  ){ 
    echo 9;
    return;
  }
  if(!preg_match ("/^[0-9]+$/", $_POST["id"]) || !preg_match ("/^[0-9]+$/", $_POST["id_remision"]) || !preg_match ("/^[0-9]+$/", $_POST["novedad"])  ){ 
    echo 8;
    return;
  }

  if ((!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["motivo"]))) {
    echo 7;
    return;
  }

  date_default_timezone_set('America/Bogota');
  $fecha_actual=date('Y-m-d');
  $ano=date("Y"); 
  include '../../conexion.php';
  $consul=" SELECT id from seguimiento_matricula WHERE id_alumnos=".$_POST["id"]; 
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  if ($cont==0) {
   
    $consul=" INSERT INTO `seguimiento_matricula` ( `id_remision`, `ano`, `fecha`, `id_alumnos`, `seguimiento`, `Descripcion`) VALUES ( '".$_POST["id_remision"]."','".$ano."', '".$fecha_actual."',  '".$_POST["id"]."', '".$_POST["novedad"]."', '".$_POST["motivo"]."')"; 
    $consulta=$conexion->prepare($consul);
    $consulta->execute(array());
    echo 1;
  }
}
 function eliminar_seguimiento(){
  if(  ($_POST["id_seguimiento"]=="") ||   (!preg_match ("/^[0-9]+$/", $_POST["id_seguimiento"])) ){ 
    echo 0;
    return;
  }
 
   
  include '../../conexion.php';
  $consul=" DELETE  from seguimiento_matricula WHERE id=".$_POST["id_seguimiento"]; 
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  echo 1;
 }
function actualizar_seguimiento(){ 
  if(  $_POST["id"]=="" ||  $_POST["motivo_actualizar"]=="" ||  $_POST["seguimiento"]=="" ||  $_POST["seguimiento"]==0 ||  $_POST["descripcion"]=="" ||  $_POST["novedad_actualizar"]=="" ||  $_POST["novedad_actualizar"]==0    ){ 
    echo 9;
    return;
  }
  if(!preg_match ("/^[0-9]+$/", $_POST["id"])  || !preg_match ("/^[0-9]+$/", $_POST["seguimiento"])  ){ 
    echo 3;
    return;
  }
  if(!preg_match ("/^[0-9]+$/", $_POST["novedad_actualizar"])   ){ 
    echo 8;
    return;
  }

  if ((!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\sÃ±.,:Ã³]+$/", $_POST["motivo_actualizar"])) ) {
    echo 7;
    return;
  }
  if ( $_POST["descripcion"]==$_POST["motivo_actualizar"] && $_POST["novedad_actualizar"]==$_POST["seguimiento"]) {
    echo 4;
    return;
  }
  include '../../conexion.php';
echo  $consul=" UPDATE `seguimiento_matricula` SET `seguimiento`='".$_POST["novedad_actualizar"]."',`Descripcion`='".$_POST["motivo_actualizar"]."'  WHERE id=".$_POST["id"]; 
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array());
  $cont=$consulta->rowCount();
  echo 1;
}
