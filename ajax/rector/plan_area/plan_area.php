<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
function ver(){
  $va='';
  if(isset($_POST['va1'])){
  $va=$_POST['va1'];
   
  } 
  if ($va=='') {
     ?>
     <div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert">×</button><p>Actualmente no tiene plan de area</p></div><?php return;
   }
    
  include '../../conexion.php';
   $sql="SELECT plan_area.fecha, plan_area.id_plan_area,plan_area.descripcion,plan_area.formato,plan_area.rol  from plan_area,area WHERE area.id_area=$va and plan_area.id_area=area.id_area order by plan_area.id_plan_area desc";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $nroProductos=$sql1->rowCount();
    if ($nroProductos>0) {
         
      ?>
      <button type="button" data-toggle="modal" data-target="#mymodal" style="margin-left: 10px"   class="btn   btn-info" style="<?php echo $_POST['sty'] ?>">Nuevo</button>
       
      <table class="table-hover">
        <tr>
          <th>Fecha</th> 
          <th>Descripción</th>
          <th>Perteneciente</th>
          <th>Ver Formato</th>
          <th>Actualizar</th>
          <th>Eliminar</th>
        </tr>
        <?php foreach ($sql1 as $key  ) {  ?>
          <tr id="op">

            <td><?php echo $key['fecha'] ?> </td>  
            <td><?php echo $key['descripcion'] ?></td>  
            <td><?php   if ($key['rol']==0) {
              echo "Jefe de area";
            }else{ echo 'Aministradores';} ?></td>
            <td><a data-toggle="modal" data-target="#mymodal2" onclick='document.getElementById("myImg").src = "<?php echo $key['formato'] ?>"; ' data-title="Ver plan de area" > <img style=" width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+"></a></td>  
            <td><a data-toggle="modal" data-target="#mymodal3" onclick='document.getElementById("descripcion3").value = "<?php echo $key['descripcion'] ?>";document.getElementById("rutas").value = "<?php echo $key['formato'] ?>";document.getElementById("id_plan_area").value = "<?php echo $key['id_plan_area'] ?>"; ' data-title="Actualizar plan" >
                    <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=">
                  </a>
                </td>
            <td>
              <a data-toggle="modal" data-target="#mymodal126"   data-title="Eliminar" onclick="document.getElementById('id').value='<?php echo $key['id_plan_area'] ?>';document.getElementById('elimini').value='<?php echo $key['formato'] ?>';" >
                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
              </a>
            </td>  
          </tr>
        <?php } ?>
      </table><br>
    <?php }else{ 
      ?>
      <script type="text/javascript">
        mensaje3(4,'Actualmente no tiene plan de area');
      </script>
      <?php

    }
}

function ver2(){
 
  if(isset($_POST['va2'])){
  $va2=$_POST['va2'];
   
  } 
  if(isset($_POST['id_docente'])){
  $id_docente=$_POST['id_docente'];
   
  } 
    
 
        



  if(isset($_POST['va1'])){
  $va=$_POST['va1'];
   
  } 
    
  include '../../conexion.php';
   $sql="SELECT plan_area.fecha, plan_area.id_plan_area,plan_area.descripcion,plan_area.formato,plan_area.rol  from plan_area,area WHERE plan_area.id_area=area.id_area and area.nombre='$va' order by plan_area.id_plan_area desc";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $nroProductos=$sql1->rowCount();
    if ($nroProductos>0) {







      ?>
       
      <table class="table-hover">
        <tr>
          <th>Fecha</th> 
          <th>Descripción</th>
          <th>Perteneciente</th>
          <th>Ver Formato</th>
          <?php 
          if ($id_docente==$va2) {
             # code...
            ?>
            <th>Actualizar</th>
            <th>Eliminar</th>
          <?php } ?>
        </tr>
        <?php foreach ($sql1 as $key  ) {  ?>
          <tr id="op">

            <td><?php echo $key['fecha'] ?> </td>  
            <td><?php echo $key['descripcion'] ?></td>  
            <td><?php   if ($key['rol']==0) {
              echo "Jefe de area";
            }else{ echo 'Aministradores';} ?></td>
            <td><a data-toggle="modal" data-target="#mymodal2" onclick='document.getElementById("myImg").src = "<?php echo $key['formato'] ?>"; ' data-title="Ver plan de area" > <img style=" width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+"></a></td> 
            <?php 
            if ($id_docente==$va2) {
             # code...
            ?> 
              <td><a <?php   if ($key['rol']==0) { ?>  data-toggle="modal" data-target="#mymodal3"  onclick='document.getElementById("descripcion3").value = "<?php echo $key['descripcion'] ?>";document.getElementById("rutas").value = "<?php echo $key['formato'] ?>";document.getElementById("id_plan_area").value = "<?php echo $key['id_plan_area'] ?>"; ' data-title="Actualizar plan" <?php }else{ ?>data-title="Solamente el administrador puede actualizar este plan de area"<?php } ?> >
                      <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=">
                    </a>
                  </td>
              <td>
                <a   <?php   if ($key['rol']==0) { ?>  data-toggle="modal" data-target="#mymodal126" onclick="document.getElementById('id').value='<?php echo $key['id_plan_area'] ?>';document.getElementById('elimini').value='<?php echo $key['formato'] ?>';" data-title="Eliminar plan de area" <?php }else{ ?>data-title="Solamente el administrador puede eliminar el  plan de area"<?php } ?> >
                  <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
                </a>
              </td> 
            <?php } ?> 
          </tr>
        <?php } ?>
      </table><br>
    <?php }else{ 
      ?>
      <script type="text/javascript">
        mensaje3(4,'Actualmente no tiene plan de area');
      </script>
      <?php

    }
}


function actualizar(){
  include '../../conexion.php';

  $Foto=$_FILES['Foto3'];
    $url=$_POST['rutas'];
    $t='';
    echo $Foto['tmp_name'];echo "-";
    if ($Foto['tmp_name']!='') { 
      $urll= $url ;
      unlink("$urll");
      $na=md5($Foto['tmp_name']).'.pdf';
      $ruta2='../../../archivos_colegio/'.$na;
      move_uploaded_file($Foto['tmp_name'], $ruta2);



      $t=",`formato`='$ruta2'";
     
    } 
      $descripcion3=$_POST['descripcion3']; 
      $rol3=$_POST['rol3']; 
       echo$consultar_nivel= "UPDATE `plan_area` SET  `descripcion`='$descripcion3',`rol`='$rol3'  $t  WHERE plan_area.id_plan_area=".$_POST['id_plan_area'].""; 
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
}


function actualizar_general(){
    include '../../conexion.php';

  $Foto=$_FILES['Foto3'];
    $url=$_POST['rutas'];
    $t='';
     $Foto['tmp_name'];echo "-";
    if ($Foto['tmp_name']!='') { 
      $urll= $url ;
      unlink("$urll");
      $na=md5($Foto['tmp_name']).'.pdf';
      $ruta2='../../../archivos_colegio/'.$na;
      move_uploaded_file($Foto['tmp_name'], $ruta2);



      $t=",`archivo`='$ruta2'";
     
    } 
      $descripcion3=$_POST['descripcion3'];  
      $nombre=$_POST['nombres'];  
 echo      $consultar_nivel= "UPDATE `archivos_general` SET  `descripcion`='$descripcion3',`nombre`='$nombre'  $t  WHERE archivos_general.id_archivos_general=".$_POST['id_archivos_general'].""; 
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
}





function actualizar_plan_aula(){
  include '../../conexion.php';

  $Foto=$_FILES['Foto3'];
    $url=$_POST['rutas'];
    $t='';
    echo $Foto['tmp_name'];echo "-";
    if ($Foto['tmp_name']!='') { 
      $urll= $url ;
      unlink("$urll");
      $na=md5($Foto['tmp_name']).'.pdf';
      $ruta2='../../../archivos_colegio/'.$na;
      move_uploaded_file($Foto['tmp_name'], $ruta2);



      $t=",`archivo`='$ruta2'";
     
    } 
      $descripcion3=$_POST['descripcion3']; 
      $rol3=$_POST['rol3']; 
       echo$consultar_nivel= "UPDATE `plan_aula` SET  `descripcion`='$descripcion3'   $t  WHERE plan_aula.id_plan_aula=".$_POST['id_plan_aula'].""; 
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
}
function registrar_plan_aula(){
  include '../../conexion.php';
  $descripcion=$_POST['descripcion'];
  $id_area=$_POST['id_are_grado'];  
  date_default_timezone_set("America/Bogota");
  
  $fecha=date("Y-m-d");

 
  if(isset($_FILES['Foto'])){ 
      $soporte=$_FILES['Foto'];
  }
  if ($soporte['tmp_name']!='') {
      # code...
    
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).'.pdf';
        $ruta2='../../../archivos_colegio/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
    }
    $sql="INSERT INTO `plan_aula` ( `fecha`, `descripcion`, `id_are_grado_sede`, `archivo`) VALUES ('$fecha', '$descripcion', '$id_area', '$ruta2')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    echo 0;
  }else{
    echo 1;
  }
}

function registrar(){
  include '../../conexion.php';
  $descripcion=$_POST['descripcion'];
  $id_area=$_POST['id_area'];
  $rol=$_POST['rol'];
  $nombre=$_POST['nombre'];
  date_default_timezone_set("America/Bogota");
  
  $fecha=date("Y-m-d");

 
  if(isset($_FILES['Foto'])){ 
      $soporte=$_FILES['Foto'];
  }
  if ($soporte['tmp_name']!='') {
      # code...
    
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).'.pdf';
        $ruta2='../../../archivos_colegio/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
    }
    echo$sql="INSERT INTO `plan_area` ( `descripcion`, `formato`, `rol`, `id_area`, `fecha`) VALUES ('$descripcion', '$ruta2', '$rol',  '$id_area', '$fecha')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    echo 0;
  }else{
    echo 1;
  }
}
function eliminar(){
  include '../../conexion.php';
    $el=$_POST['elimini'];
    unlink("$el");
   $sql="DELETE FROM `plan_area` WHERE `plan_area`.`id_plan_area` = ".$_POST['id'];
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}
function eliminar_general(){
   include '../../conexion.php';
    $el=$_POST['elimini'];
    unlink("$el");
   
   $sql="DELETE FROM archivos_general  WHERE archivos_general.id_archivos_general = ".$_POST['id'];
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}
function eliminar_plan_aula(){
  include '../../conexion.php';
    $el=$_POST['elimini'];
    unlink("$el");
   $sql="DELETE FROM `plan_aula` WHERE `plan_aula`.`id_plan_aula` = ".$_POST['id'];
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}
function ver_aula(){
    if(isset($_POST['Asignaturas'])){
  $Asignaturas=$_POST['Asignaturas'];
   
  } 
    
  include '../../conexion.php';
  $sql="SELECT plan_aula.fecha,plan_aula.descripcion,plan_aula.id_plan_aula,plan_aula.archivo FROM plan_aula WHERE plan_aula.id_are_grado_sede=$Asignaturas  order by  plan_aula.id_plan_aula   DESC" ;
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $nroProductos=$sql1->rowCount();
    if ($nroProductos>0) {
         
      ?>
       
      <table class="table-hover">
        <tr>
          <th  >Fecha</th> 
          <th>Descripción</th> 
          <th  >Ver Formato</th>
          <th  >Actualizar</th>
          <th >Eliminar</th>
        </tr>
        <?php foreach ($sql1 as $key  ) {  ?>
          <tr id="op">

            <td><?php echo $key['fecha'] ?> </td>  
            <td><?php echo $key['descripcion'] ?></td>   
            <td><a data-toggle="modal" data-target="#mymodal2" onclick='document.getElementById("myImg").src = "<?php echo $key['archivo'] ?>"; ' data-title="Ver plan de aula" > <img style=" width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+"></a></td>  
            <td><a data-toggle="modal" data-target="#mymodal3" onclick='document.getElementById("descripcion3").value = "<?php echo $key['descripcion'] ?>";document.getElementById("rutas").value = "<?php echo $key['archivo'] ?>";document.getElementById("id_plan_aula").value = "<?php echo $key['id_plan_aula'] ?>"; ' data-title="Actualizar el  plan de aula" >
                    <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=">
                  </a>
                </td>
            <td>
              <a data-toggle="modal" data-target="#mymodal126"   data-title="Eliminar" onclick="document.getElementById('id').value='<?php echo $key['id_plan_aula'] ?>';document.getElementById('elimini').value='<?php echo $key['archivo'] ?>';" >
                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
              </a>
            </td>  
          </tr>
        <?php } ?>
      </table><br>
    <?php }else{ 
      ?>
      <script type="text/javascript">
        mensaje3(4,'Actualmente no se encuentran registrado el  plan de aula');
      </script>
      <?php

    }
}
function insert(){
 


    include '../../conexion.php';
  $descripcion=$_POST['descripcion'];
  $nombre=$_POST['nombre'];    date_default_timezone_set("America/Bogota");
  
  $fecha=date("Y-m-d");

 
  if(isset($_FILES['Foto'])){ 
      $soporte=$_FILES['Foto'];
  }
  if ($soporte['tmp_name']!='') {
      # code...
    
    if ($soporte=='') {
        $ruta2='';
    }else{ 
        $na=md5($soporte['tmp_name']).'.pdf';
        $ruta2='../../../archivos_colegio/'.$na; 
        move_uploaded_file($soporte['tmp_name'], $ruta2);
    }
    $sql="INSERT INTO `archivos_general` (`nombre`, `descripcion`, `archivo`, `fecha`) VALUES ('$nombre', '$descripcion', '$ruta2', '$fecha')";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    echo 0;
  }else{
    echo 1;
  }

}
function ver_general(){
  $uno='';
  if(isset($_POST['uno'])){
    $uno=$_POST['uno'];
   
  } 
    
  include '../../conexion.php';
  $sql="SELECT * FROM `archivos_general`  order by  archivos_general.id_archivos_general   DESC" ;
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $nroProductos=$sql1->rowCount();
    if ($nroProductos>0) {
         
      ?>
       
      <div class="table-responsive" style=" padding: 10px">
        <table class="table-hover">
        <tr>
          <th width="130">Fecha</th> 
          <th>Nombre</th> 
          <th>Descripción</th> 
          <th width="125">Ver Formato</th>
          <?php 
          if ($uno=='') { ?>

            <th width="125">Actualizar</th>
            <th width="125">Eliminar</th> <?php
           } ?>
        </tr>
        <?php foreach ($sql1 as $key  ) {  ?>
          <tr id="op">

            <td><?php echo $key['fecha'] ?> </td>  
            <td><?php echo $key['nombre'] ?></td>  
            <td><?php echo $key['descripcion'] ?></td>   
            <td><a data-toggle="modal" data-target="#mymodal2" onclick='document.getElementById("myImg").src = "<?php echo $key['archivo'] ?>"; ' data-title="Ver plan de aula" > <img style=" width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+"></a></td>  
            <?php 
          if ($uno=='') { ?>
            <td><a data-toggle="modal" data-target="#mymodal3" onclick='document.getElementById("descripcion3").value = "<?php echo $key['descripcion'] ?>";document.getElementById("rutas").value = "<?php echo $key['archivo'] ?>";document.getElementById("nombres").value = "<?php echo $key['nombre'] ?>";document.getElementById("id_archivos_general").value = "<?php echo $key['id_archivos_general'] ?>"; ' data-title="Actualizar el  plan de aula" >
                    <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=">
                  </a>
                </td>
            <td>
              <a data-toggle="modal" data-target="#mymodal126"   data-title="Eliminar" onclick="document.getElementById('id').value='<?php echo $key['id_archivos_general'] ?>';document.getElementById('elimini').value='<?php echo $key['archivo'] ?>';" >
                <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
              </a>
            </td> <?php } ?> 
          </tr>
        <?php } ?>
      </table><br>
      </div>
    <?php }else{ 
      ?>
      <script type="text/javascript">
        mensaje3(4,'Actualmente no se encuentra registrado   ningun archivo general');
      </script>
      <?php

    }
}




?>