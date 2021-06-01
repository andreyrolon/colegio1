


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}

function tabla2(){ 
   
  include "../../conexion.php" ; 

  $apellido=$_POST["apellido"];
  $consul="  SELECT alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.foto,observacion.ano,sede.NOMBRE as sede,jornada.NOMBRE as jornada,grado.numero as numero ,curso.numero as curso from observacion left JOIN alumnos on alumnos.id_alumnos=observacion.id_alumno LEFT JOIN grado on grado.id_grado=observacion.id_grado left join curso on curso.id_curso=observacion.id_curso left join jornada_sede on jornada_sede.ID_JS=observacion.id_jornada_sede LEFT JOIN sede ON jornada_sede.ID_SEDE=sede.ID_SEDE LEFT JOIN jornada on jornada.ID_JORNADA=jornada_sede.ID_JORNADA WHERE alumnos.apellido like('%$apellido%')
";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array()); ?>
  <style type="text/css">
      .im{
            width: 49px;
            height: 63px;
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
  <div class="col-md-12">
    <div class=" btn-link" style="font-size: 19px"><strong>Tabla de Acomulado de Observaciones</strong></div><br>
    <div class="table-responsive">
      <table id="example" class=" table table-hover table-bordered"  style="width: 100%" >

        <thead>
          <tr>
            <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
            <th>Estudiante</th>
            <th>Mostrar</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $id_alumnos=0;
          foreach ($consulta as $key ) { 
            if ($id_alumnos!=$key["id_alumnos"]) { ?>

              <tr>
                <td>
                  <img class="profile-user-img img-responsive img-circle im" src="<?php echo $key['foto'] ?>" alt="User profile picture">
                </td>
                <td><?php echo  $nombre= mb_convert_case(($key['nombre']." ".$key['apellido']), MB_CASE_TITLE, "UTF-8")   ; ?></td>
                <td><button class="btn btn-info " data-toggle="modal" data-target="#alumno" onclick="mostrar2(<?php echo $key["id_alumnos"] .",'".$key['nombre']."','".$key['apellido']."' "?>) "> mostra</button></td>
              </tr><?php
              $id_alumnos=$key["id_alumnos"];
            }   
          } ?> 
        </tbody> 
      </table>
    </div>
  </div><?php   

}
function tabla1(){ 
   
  include "../../conexion.php" ; 

  $apellido=$_POST["apellido"];
  $ano=date("Y");
  $consul="  SELECT alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.foto,observacion.ano,sede.NOMBRE as sede,jornada.NOMBRE as jornada,grado.numero as grado ,curso.numero as curso from observacion left JOIN alumnos on alumnos.id_alumnos=observacion.id_alumno LEFT JOIN grado on grado.id_grado=observacion.id_grado left join curso on curso.id_curso=observacion.id_curso left join jornada_sede on jornada_sede.ID_JS=observacion.id_jornada_sede LEFT JOIN sede ON jornada_sede.ID_SEDE=sede.ID_SEDE LEFT JOIN jornada on jornada.ID_JORNADA=jornada_sede.ID_JORNADA WHERE alumnos.apellido like('%$apellido%') and  observacion.ano=$ano
";
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array()); ?>
  <style type="text/css">
      .im{
            width: 49px;
            height: 63px;
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
  <div class="col-md-12">
    <div class=" btn-link" style="font-size: 19px"><strong>Tabla de Acomulado de Observaciones</strong></div><br>
    <table id="example" class=" table table-hover table-bordered"  style="width: 100%" >

      <thead>
        <tr>
          <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
          <th>Estudiante</th>
          <th>ver</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $id_alumnos=0;
        foreach ($consulta as $key ) { 
          if ($id_alumnos!=$key["id_alumnos"]) { ?>

            <tr>
              <td>
                <img class="profile-user-img img-responsive img-circle im" src="<?php echo $key['foto'] ?>" alt="User profile picture">
              </td>
              <td><?php echo  $nombre= mb_convert_case(($key['nombre']." ".$key['apellido']), MB_CASE_TITLE, "UTF-8")   ; ?></td>
              
                <td><a href="descarga_individual.php?id_alumnos=<?php echo $key["id_alumnos"] ?>&&nombre=<?php echo $key['nombre'] ?>&&apellido=<?php echo$key['apellido'] ?>&&sede=<?php echo $key["sede"] ?>&&jornada=<?php echo $key["jornada"] ?>&&curso=<?php echo $key["grado"]."-". $key["curso"]?>"  target="_blank" class="btn btn-info xs"  > Descargar</a></td>
            </tr><?php
            $id_alumnos=$key["id_alumnos"];
          }   
        } ?> 
      </tbody> 
    </table><?php   

}

function mostrar2(){ 
   
  include "../../conexion.php" ; 
 
  $consul="SELECT observacion.ano,sede.NOMBRE as sede,jornada.NOMBRE as jornada,grado.numero as grado ,curso.numero as curso from observacion  LEFT JOIN grado on grado.id_grado=observacion.id_grado left join curso on curso.id_curso=observacion.id_curso left join jornada_sede on jornada_sede.ID_JS=observacion.id_jornada_sede LEFT JOIN sede ON jornada_sede.ID_SEDE=sede.ID_SEDE LEFT JOIN jornada on jornada.ID_JORNADA=jornada_sede.ID_JORNADA WHERE  observacion.id_alumno=".$_POST["id"]  ;
  $consulta=$conexion->prepare($consul);
  $consulta->execute(array()); ?>
 
  <div class="row" style="padding: 9px">
      <div class=" btn-link" style="font-size: 17px">Historial de    Observaciones del estudiante <?php echo $_POST["nombre"]." ".$_POST['apellido'] ?></div><br>
    <div class="table-responsive">
      <table id="example" class=" table table-hover table-bordered"  style="width: 100%" >

        <thead>
          <tr>
            <th>Sede</th>
            <th>Jornada</th>
            <th>curso</th>
            <th>Año</th>
            <th>Observaciones</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $ano=0;
          foreach ($consulta as $key ) { 
            if ($ano!=$key["ano"]) { ?>

              <tr>
                <td>
                  <?php echo $sede= $key["sede"] ?>
                </td>
                <td>
                  
                  <?php echo $jornada=$key["jornada"] ?>
                </td>
                <td>
                  
                  <?php echo $curso=$key["grado"]."-".$key["curso"] ?>
                </td>
                <td><?php echo $key["ano"] ?> </td>
                <td><a href="descarga_anual.php?id_alumnos=<?php echo $_POST["id"] ?>&&nombre=<?php echo $_POST["nombre"] ?>&&apellido=<?php echo $_POST["apellido"] ?>&&ano=<?php echo $key["ano"] ?>&&sede=<?php echo $key["sede"] ?>&&jornada=<?php echo $key["jornada"] ?>&&curso=<?php echo $key["grado"]."-". $key["curso"]?>"  target="_blank" class="btn btn-info btn-xs"  > Descargar</a></td>
              </tr><?php
              $ano=$key["ano"];
            }   
          } ?> 
        </tbody> 
      </table>  
    </div>
      <a target="_blank" class="btn btn-danger btn-xs" href="descargar_acomulado.php?id_alumnos=<?php echo $_POST["id"] ?>&&nombre=<?php echo $_POST["nombre"] ?>&&apellido=<?php echo $_POST["apellido"] ?>&&ano=<?php echo $key["ano"] ?>&&sede=<?php echo $sede ?>&&jornada=<?php echo $jornada ?>&&curso=<?php echo $curso ?>">Descarga observador</a> 
  </div><?php   

}

function actualizar_estado(){ 
  if (  (!preg_match ("/^[0-9]+$/", $_POST["id"]))  || (!preg_match ("/^[0-9]+$/", $_POST["sele"])) ){ 
    echo 0;
  }
  include '../../conexion.php';
  date_default_timezone_set('America/Bogota');
  $fecha=date("Y-m-d");
  if ($_POST["sele"]==3) {
    
    
    $consul="  UPDATE `informeacademico` SET `estado_aprovado` = '".$_POST["sele"]."',`fecha_retiro` = '0000-00-00',`fecha_desercion` = '$fecha' WHERE `informeacademico`.`id_informe_academico` =  ".$_POST["id"];
    $consulta=$conexion->prepare($consul);
    $consulta->execute(array());
    echo 1;
  }if($_POST["sele"]==2){ 
    $consul="  UPDATE `informeacademico` SET `estado_aprovado` = '".$_POST["sele"]."',`fecha_retiro` = '$fecha',`fecha_desercion` = '0000-00-00' WHERE `informeacademico`.`id_informe_academico` =  ".$_POST["id"];
    $consulta=$conexion->prepare($consul);
    $consulta->execute(array());
    echo 1;
  }if($_POST["sele"]==0){ 
    $consul="  UPDATE `informeacademico` SET `estado_aprovado` = '".$_POST["sele"]."',`fecha_retiro` = '0000-00-00' ,`fecha_desercion` = '0000-00-00' WHERE `informeacademico`.`id_informe_academico` =  ".$_POST["id"];
    $consulta=$conexion->prepare($consul);
    $consulta->execute(array());
    echo 1;
  }
}
function estado(){ 
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
  $ano=date("Y");
  $consul="  SELECT informeacademico.id_informe_academico, alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.foto ,informeacademico.estado_aprovado from alumnos,informeacademico WHERE informeacademico.ano=$ano and informeacademico.id_jornada_sede=".$_POST["jornada_sede1"]." and informeacademico.id_grado=".$_POST["grado"]." and informeacademico.id_curso=".$_POST["curso"]."  and alumnos.id_alumnos=informeacademico.id_alumno $apellidos
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
          width: 54px; 
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
        <div class=" btn-link" style="font-size: 17px"><strong>Tabla de estudiantes con su estado actual</strong> 
        </div>  <br>

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
            <th >N°</th>
            <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
            <th>Alumno</th>
 
            <th >estado</th>             </tr>
          </thead>
          <tbody>
            <?php 
            $i=0;
            foreach ($consulta as $key ) { 
              $i++; ?>
              <tr class="tab" id="tabla<?php echo $i ?>"  style="display: none;">
                <td><?php echo $i ?> </td>
                <td>
                  <img class="profile-user-img img-responsive img-circle im" src="<?php echo $key['foto'] ?>" alt="User profile picture">
                </td>
                <td><?php echo $key["nombre"]." ".$key["apellido"]; ?></td> 
                <td>
                 <select class="form-control" id="sele<?php echo $key["id_informe_academico"] ?>" onchange=" 
                 var sele=$('#sele<?php echo $key["id_informe_academico"] ?>').val();enviar(sele,<?php echo $key["id_informe_academico"].",".$key["estado_aprovado"] ?>) " >
                     
                    <?php if ($key["estado_aprovado"]==0) { ?>
                      <option value="0">Cursando</option>
                      <option value="2">Retirado</option>
                      <option value="3">Desertado</option>
                    <?php } ?>
                    <?php if ($key["estado_aprovado"]==2) { ?>
                      <option value="2">Retirado</option>
                      <option value="0">Cursando</option>
                      <option value="3">Desertado</option>
                    <?php } ?>
                    <?php if ($key["estado_aprovado"]==3) { ?>
                      <option value="3">Desertado</option>
                      <option value="2">Retirado</option>
                      <option value="0">Cursando</option> 
                    <?php } ?>
                 </select>
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

 
 
 