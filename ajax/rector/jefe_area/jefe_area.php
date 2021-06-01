<?php 
 
 

 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
 


function inser2()
{
  include '../../conexion.php';
  $area=$_POST['sele2'];
  $docente=$_POST['ss1']; 
  foreach ($area as  $value) {
     
    $consultar_nivel="INSERT INTO `area_docente` (`area`, `id_docente`) VALUES ('$value', '$docente')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  } 
}

function inser()
{
  include '../../conexion.php';
  $area=$_POST['sele'];
  $docente=$_POST['docente']; 
  foreach ($area as  $value) {
     
    $consultar_nivel="INSERT INTO `area_docente` (`area`, `id_docente`) VALUES ('$value', '$docente')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  } 
}

function ver()
{

  include '../../conexion.php';
  
  if(isset($_POST['dato'])){
    $d=$_POST['dato'];
  }else{
    $d='';
  }
  if(isset($_POST['i'])){
     $paginaActual = $_POST['i'];
  }else{
     $paginaActual=1;
  }
 

  $consultar_nivel=" SELECT q.nombre,q.apellido,q.foto,q.id_docente,q.id_docente, q.genero FROM (SELECT docente.genero, docente.nombre ,docente.apellido ,docente.foto,docente.id_docente from docente,area_docente WHERE docente.id_docente=area_docente.id_docente GROUP BY docente.id_docente ORDER by area_docente.id_docente desc) as q WHERE q.nombre LIKE ('%$d%') or q.apellido LIKE('%$d%')  ";
   
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $registro=$consultar_nivel1->fetchAll();
  $count=$consultar_nivel1->rowCount();

 
?>  
  <div  >
   
  </div>
  <div class="">
    
  </div>
  <form method="post" id="eliminis">

   <div class="box-body no-padding">
    
    <div class="table-responsive"  style="padding: 10px">
      <style>
 
        [data-title] { 
          font-size: 30px; /*optional styling*/
          
          position: relative; 
        }

        [data-title]:hover::before {
          content: attr(data-title);
          position: absolute;
          bottom: -26px;
          display: inline-block;
          padding: 3px 6px;
          border-radius: 2px;
          background: #000;
          color: #fff;
          font-size: 12px;
          font-family: sans-serif;
          white-space: nowrap;right: 1%
        }
        [data-title]:hover::after {
          content: '';
          position: absolute;
          bottom: -10px;
          left: 8px;
          display: inline-block;
          color: #fff;
          border: 11px solid transparent;    
          border-bottom: 11px solid #000;
        }
        tr:hover  {
         
           
             padding:10px;border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;  
        }
      </style>
      <br>
      <table class="  table-hover" style=" ">
        <tr>
          <th>Foto </th>
          <th>Docente</th> 
          <th   >Mostrar</th>    
        </tr>  <?php
        $i=0;
        foreach ($registro as  $var) {
          $i++;
          $foto=$var['foto'];
          if ($var['foto']=='' && $var['genero']==1) {
            $foto='../../../logos/femenino.png';
          }
          if ($var['foto']=='' && $var['genero']==0) {
            $foto='../../../logos/masculino.png';
          }

         ?>
          <tr class="tab" id="tabla<?php echo $i ?>">
            <td> 
                <img  class="profile-user-img img-responsive img-circle" src="<?php echo($foto); ?>"  style="    width: 140px;height: 140px; border: 3px solid #d2d6de;">
            </td>
            <td>
                <?php echo($var['nombre']); ?> <?php echo($var['apellido']); ?>
            </td>
       
            <td>
              <a  style="top: -8px"  data-title=' <?php titulo($var['id_docente']) ?> '   data-toggle="modal" data-target="#my"  onclick=" 
                $('#titu').html('<?php  echo  $var['nombre']." ".$var['apellido'] ;?>'); 
                document.getElementById('img').src ='<?php echo($var['foto']); ?>' ;
                 document.getElementById('ss').value='<?php  echo $var['id_docente'] ?>';
                 document.getElementById('ss1').value='<?php  echo $var['id_docente'] ?>';
                 var id='<?php  echo $var['id_docente'] ?>';
                  che(id) "  >
                <img style=" width: 42px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+" />
              </a>
            </td> 
          </tr> <?php  
        } ?>
      </table>
      <div  id="sapo1" class=""  >
       
    </div>
    </div>
  </form> 


            <input type="hidden" value="1" id="pagina">
            <input type="hidden" value="3" id="cantidad"> 

  <script type="text/javascript">
      function myFunction(u){
                document.getElementById('pagina').value=u; 
                ddd();
            }
            //funcion de la paginacion
            function ddd(){

                // cada vez que se ejecute este escript el scroll estara al inicio de pagina
                $("html").animate({
                    scrollTop:0
                })

                //pagina en la cual estamos
                var paginaActual=parseInt(document.getElementById('pagina').value); 

                //la cantidad de  registros que    queremos ver
                var nroLotes=parseInt(document.getElementById('cantidad').value);

              


              

                //EL TOTAL DE LOS REGISTROS
                var nroProductos=<?php echo $count ?>; 

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
                $('#sapo2').html(lista);



                //multiplicamos la cantidad de registros por la pagina actual para saber el ristro maximo que debemos mostrar en nuestro bocle
                var vista_max=parseInt(nroLotes*paginaActual);

                //hacemos el mismo procedimiento que el anterior pero restando primeramente 1 a la pagina actual para poder obtener el registro minimo  y poder colocar el rango en nuestro bucle for
                var vista_inicio=parseInt(nroLotes*(paginaActual-1));

                //desaparecemos todos los registros para que en el for muestre los que son
                $('.tab').hide();

                //si es cero significa que es la primera pagina de nuestra paginacion por ende mostramos el primer registro y le sumamos uno a nuestro rango minimo para que muestre los registros necesarios
                if (vista_inicio<=0) {
                    vista_inicio=1;

                    document.getElementById('tabla1').style.display='REVERT'; 
                }

                vista_inicio=vista_inicio+1;
                for (vista_inicio;  vista_inicio<vista_max+1 ; vista_inicio++) {  
                    document.getElementById('tabla'+vista_inicio).style.display='REVERT'; 
                } 
               
            }

            ddd();  
  </script>
 
 
<?php

} 

function titulo($id){ 
  include '../../conexion.php';
   
     $wq="SELECT area.nombre from area,area_docente WHERE area.nombre=area_docente.area and area_docente.id_docente=$id GROUP BY area_docente.id";
    $consultar_nivel1=$conexion->prepare($wq);
    $consultar_nivel1->execute(array());
    foreach ($consultar_nivel1 as   $value) {
      
       echo $value['nombre'].' ';   
    }
  }
function prueva(){ 
  include '../../conexion.php';
  $id=$_POST['id'];
     $wq="SELECT area.nombre from area,area_docente WHERE area.nombre=area_docente.area and area_docente.id_docente=$id GROUP BY area_docente.id";
    $consultar_nivel1=$conexion->prepare($wq);
    $consultar_nivel1->execute(array());
    foreach ($consultar_nivel1 as   $value) {
      
      ?>
      <label class="containerq"> <?php echo $value['nombre'];   ?> <input name="ty[]" type="checkbox" value="<?php echo $value['nombre'];   ?>"  >
        <span class="checkmark"></span>
      </label> 
      <?php 
    }
  }
  function el(){
    include '../../conexion.php';
    
    $ss= $_POST['ss'];
    if(isset($_POST['ty'])){ 
    $r= $_POST['ty'];
      foreach ($r as $value) {
        $wq="DELETE FROM `area_docente` WHERE  area_docente.area='$value'  and   area_docente.id_docente='$ss' ";
        $consultar_nivel1=$conexion->prepare($wq);
        $consultar_nivel1->execute(array());
      }
      echo 0;
    }else{
      echo 1;
    }
  }
?>