<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
function inasistencia(){   
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
        <div class=" btn-link" style="font-size: 17px"><strong>Tabla de Asistencia</strong> 
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
 
            <th >estado</th>  
            <th>Agregar</th>  
            <th>Mostrar</th>           
          </tr>
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
                     
                    <?php if ($key["estado_aprovado"]==0) { ?>
                      <button class="btn btn-info">Cursando</button>

                    <?php } ?>
                    <?php if ($key["estado_aprovado"]==2) { ?>
                      <button class="btn btn-warning">Retirado</button>
                    <?php } ?>
                    <?php if ($key["estado_aprovado"]==3) { ?>
                      <button class="btn btn-danger">Desertor</button>
                    <?php } ?>
                 </select>
                </td> 
                <td>
                  <a href="">
                    <img width="37" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==">
                  </a>
                </td> 
                <td>
                  <a data-toggle="modal" data-target="#my">
                    <img width="40" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTUuOTgxIDU1Ljk4MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTUuOTgxIDU1Ljk4MTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiMxMkJCRDQiIGQ9Ik00NC42MjcsNTJIOS4zNTRjLTQuNjE5LDAtOC4zNjQtMy43NDUtOC4zNjQtOC4zNjRWOC4zNjRDMC45OTEsMy43NDUsNC43MzUsMCw5LjM1NCwwaDM1LjI3MiAgICBjNC42MTksMCw4LjM2NCwzLjc0NSw4LjM2NCw4LjM2NHYzNS4yNzJDNTIuOTkxLDQ4LjI1NSw0OS4yNDYsNTIsNDQuNjI3LDUyeiIgZGF0YS1vcmlnaW5hbD0iIzNBQkNBNyIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzNBQkNBNyI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDQuOTkxLDE0aC0xOGMtMC41NTMsMC0xLTAuNDQ3LTEtMXMwLjQ0Ny0xLDEtMWgxOGMwLjU1MywwLDEsMC40NDcsMSwxUzQ1LjU0MywxNCw0NC45OTEsMTR6IiBkYXRhLW9yaWdpbmFsPSIjRkZGRkZGIiBjbGFzcz0iIj48L3BhdGg+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik00NC45OTEsMjhoLTE4Yy0wLjU1MywwLTEtMC40NDctMS0xczAuNDQ3LTEsMS0xaDE4YzAuNTUzLDAsMSwwLjQ0NywxLDFTNDUuNTQzLDI4LDQ0Ljk5MSwyOHoiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiIGNsYXNzPSIiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTQ0Ljk5MSw0MmgtMThjLTAuNTUzLDAtMS0wLjQ0Ny0xLTFzMC40NDctMSwxLTFoMThjMC41NTMsMCwxLDAuNDQ3LDEsMVM0NS41NDMsNDIsNDQuOTkxLDQyeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDE3Yy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDE2Ljg4MSwxMy4zNDQsMTcsMTMuMDYxLDE3eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDMxYy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDMwLjg4MSwxMy4zNDQsMzEsMTMuMDYxLDMxeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDQ1Ljk5OWMtMC4yMDksMC0wLjQyLTAuMDY1LTAuNTk5LTAuMkw3Ljg5MSw0Mi4zN2MtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzMSwxLjM5OS0wLjJsMy44MjIsMi44NjZsNi4yNDgtNy4yODdjMC4zNTgtMC40MiwwLjk5Mi0wLjQ2OCwxLjQwOS0wLjEwOCAgICBjMC40MiwwLjM1OSwwLjQ2OSwwLjk5LDAuMTA4LDEuNDA5bC02Ljg1Nyw3Ljk5OUMxMy42MjUsNDUuODgsMTMuMzQ0LDQ1Ljk5OSwxMy4wNjEsNDUuOTk5eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJPC9nPgoJPGc+CgkJPGNpcmNsZSBzdHlsZT0iZmlsbDojRDBFOEY5OyIgY3g9IjQwLjc2OCIgY3k9IjQwLjc5NiIgcj0iOS43OTYiIGRhdGEtb3JpZ2luYWw9IiNEMEU4RjkiPjwvY2lyY2xlPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNFQUY2RkQ7IiBkPSJNNDQuMzIxLDMxLjY3NEwzMS42NDcsNDQuMzQ4YzAuNzA2LDEuODEsMS45MywzLjM1NywzLjQ5NSw0LjQ1OUw0OC43OCwzNS4xNyAgICBDNDcuNjc4LDMzLjYwNCw0Ni4xMzEsMzIuMzgsNDQuMzIxLDMxLjY3NHoiIGRhdGEtb3JpZ2luYWw9IiNFQUY2RkQiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojQjFEM0VGOyIgZD0iTTU0LjcxMyw1NC4yOTFsLTUuOTctNi4yNDRjMS43NDYtMS45MTksMi44Mi00LjQ1OCwyLjgyLTcuMjUxQzUxLjU2NCwzNC44NDMsNDYuNzIxLDMwLDQwLjc2OCwzMCAgICBzLTEwLjc5Niw0Ljg0My0xMC43OTYsMTAuNzk2czQuODQzLDEwLjc5NiwxMC43OTYsMTAuNzk2YzIuNDQyLDAsNC42ODktMC44MjQsNi40OTktMi4xOTZsNi4wMDEsNi4yNzYgICAgYzAuMTk2LDAuMjA2LDAuNDU5LDAuMzA5LDAuNzIzLDAuMzA5YzAuMjQ5LDAsMC40OTctMC4wOTIsMC42OTEtMC4yNzdDNTUuMDgxLDU1LjMyMyw1NS4wOTUsNTQuNjg5LDU0LjcxMyw1NC4yOTF6ICAgICBNMzEuOTcyLDQwLjc5NmMwLTQuODUsMy45NDYtOC43OTYsOC43OTYtOC43OTZzOC43OTYsMy45NDYsOC43OTYsOC43OTZzLTMuOTQ2LDguNzk2LTguNzk2LDguNzk2UzMxLjk3Miw0NS42NDYsMzEuOTcyLDQwLjc5NnoiIGRhdGEtb3JpZ2luYWw9IiNCMUQzRUYiIGNsYXNzPSIiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+">
                  </a>
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