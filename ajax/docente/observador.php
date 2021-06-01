<?php 
session_start();
if ($_GET)
{
    $action = $_GET["action"];
    if (function_exists($action))
    {
        call_user_func($action);
    }
}
function tabla()
   {
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $curso=explode(" ", $_POST['curso']);
    $ano=date('Y');

    $jornada_sede1=( $_POST['jornada_sede1']);
    if((!preg_match ("/^[0-9]+$/",  $curso[0])) or  (!preg_match ("/^[0-9]+$/", $curso[1])) or (!preg_match ("/^[0-9]+$/",  $_POST['jornada_sede1']))){
        ?>
        <div class="erroneo" role="alert" style=" margin: 27px "> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> Los datos estan erroneos. </div> <br> 
        <?php
        return;
    }
     $con3="SELECT informeacademico.id_informe_academico, alumnos.genero, alumnos.foto, alumnos.nombre, alumnos.apellido, alumnos.id_alumnos, informeacademico.estado_aprovado, informeacademico.fecha_retiro, informeacademico.fecha_desercion, informeacademico.id_jornada_sede ,COUNT(observacion.id_alumno)as cont FROM alumnos LEFT JOIN observacion on observacion.id_alumno=alumnos.id_alumnos LEFT JOIN informeacademico on informeacademico.id_alumno=alumnos.id_alumnos WHERE informeacademico.ano=$ano and informeacademico.id_grado='$curso[0]' AND informeacademico.id_curso='$curso[1]' AND informeacademico.id_jornada_sede='$jornada_sede1' GROUP by alumnos.id_alumnos";
    
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
    
    ?>
<style>
  
  .im{
            width: 65px;
            height: 80px;
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
    #padin{ 
        padding: 10px;
    }

[data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.5s;
    visibility: visible;
}

[data-title]:after {
    content: attr(data-title);
    background-color: #333;
    color: #fff;
    font-size: 14px; 
    position: absolute;
    padding: 3px 20px;
    bottom: -1.6em;
    left: -150px;
    white-space: nowrap;
    box-shadow: 1px 1px 3px #222222;
    opacity: 0;
    border: 1px solid #111111;
    z-index: 99999;
    visibility: hidden;
    border-radius: 6px;
    
}
[data-title] {
    position: relative;
}

</style>
<?php if($count > 0){ ?>

<div class="col-md-12">

    <div class="table-responsive" style="padding: 7px" >
        <form action="descargar_curso.php" method="get" target="_blank">
            <input type="hidden" value="<?php echo $_POST['nom_curso']; ?>" name="curso">
            <input type="hidden" value="<?php echo $_POST['sede']; ?>" name="sede">
            <input type="hidden" value="<?php echo $_POST['jornada']; ?>" name="jornada">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N°</th>

                        <th style="padding-left: 44px;padding-right: 44px;">Foto</th>
                        <th>Estudiante</th>
                        <th>Estado</th>
                        <th>Anotaciones</th>
                        <th>Ver</th> 
                        <th>Agregar</th>
                        <th data-title="Descargar todo el curso">
                            <button id="idw"  style="border:none;background-color:#fff"> Todos </button>
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con=0;
                    foreach($con2 as $key){
                        
                       
                        $con++;
                        $foto=$key['foto'];
                        if ($key['foto']=='' && $key['genero']==1 ) {
                            $foto='../../../logos/niña.jpg';
                        }if ($key['foto']=='' && $key['genero']==0 ) {

                            $foto='../../../logos/niño.jpg';
                        }
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="id_informe_academico[]" value="<?php echo ($key['id_informe_academico']) ?>">
                            <input type="hidden" name="id[]" value="<?php echo ($key['id_alumnos']) ?>">
                            <input type="hidden" name="nombre[]" value="<?php echo $nombre =strtoupper ($key['nombre']); ?>">
                            <input type="hidden" name="apellido[]" value="<?php echo $apellido=strtoupper($key['apellido']); ?>">
                            <h4>
                                <?php echo($con); ?>
                            </h4>
                        </td>
                        <td><img class="profile-user-img img-responsive img-circle im" src="<?php echo($foto); ?>" alt="User profile picture">
                        </td>
                        <td> <br> <?php echo $nombre_completo= mb_convert_case(($key['nombre']." ".$key['apellido']), MB_CASE_TITLE, "UTF-8")   ; ?></td>
                        <td> <br>
                            <?php if($key['fecha_retiro'] != '0000-00-00'){
                                echo('<button class="btn btn-warning btn-xs">Retirado</button>');
                            }elseif($key['fecha_desercion'] != '0000-00-00'){
                                echo('<button class="btn btn-danger btn-xs">Desertor</button>');
                            }else {
                                echo('<button class="btn btn-info btn-xs">Cursando</button>');
                            }
                            ?>
                        </td>
                        <td><br>
                            <button type="button" class="btn btn-default btn-xs"><?php echo($key['cont']); ?></button>
                        </td>
                         <td>
                             
                            <a  onclick=' 
                                  document.getElementById("id_informe_academico").value=<?php echo($key['id_informe_academico']); ?>;   observador(<?php echo('"'.$_POST['nom_curso'].'","'.$_POST['jornada'].'","'.$_POST['sede'].'","'.$key['nombre'].'","'.$key['apellido'].'","'.$foto.'","'.$key['id_alumnos'].'"'); ?>);'>
                            <img style=" margin-top: 15px; width: 42px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGQ9Ik0wLDEwNS4yNTlsMC4wNDItNDUuODM3YzAuMDAzLTIuODQsMi4zMDctNS4xNDIsNS4xNDctNS4xNDJoNDUuNjE1ICAgYzIuODQyLDAsNS4xNDcsMi4zMDUsNS4xNDcsNS4xNDd2MTYuMzIzYzAsMi44NDItMi4zMDUsNS4xNDctNS4xNDcsNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLDIuMjk5LTUuMTQ3LDUuMTM4bC0wLjAzNCwxOS4yMzggICBjLTAuMDA1LDIuODM5LTIuMzA4LDUuMTM4LTUuMTQ3LDUuMTM4SDUuMTQ3QzIuMzAzLDExMC40MS0wLjAwMywxMDguMTAzLDAsMTA1LjI1OXoiIGRhdGEtb3JpZ2luYWw9IiM2NDgwOTMiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjNjQ4MDkzIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0Y0OTRGIiBkPSJNNTEyLDEwNS4yNTlsLTAuMDQyLTQ1LjgzN2MtMC4wMDMtMi44NC0yLjMwNy01LjE0Mi01LjE0Ny01LjE0MmgtNDUuNjE1ICAgYy0yLjg0MiwwLTUuMTQ3LDIuMzA1LTUuMTQ3LDUuMTQ3djE2LjMyM2MwLDIuODQyLDIuMzA1LDUuMTQ3LDUuMTQ3LDUuMTQ3aDE5LjM3YzIuODM5LDAsNS4xNDIsMi4yOTksNS4xNDcsNS4xMzhsMC4wMzQsMTkuMjM4ICAgYzAuMDA1LDIuODM5LDIuMzA4LDUuMTM4LDUuMTQ3LDUuMTM4aDE1Ljk1OUM1MDkuNjk3LDExMC40MSw1MTIuMDAzLDEwOC4xMDMsNTEyLDEwNS4yNTl6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTAsNDA2Ljc0MWwwLjA0Miw0NS44MzdjMC4wMDMsMi44NCwyLjMwNyw1LjE0Miw1LjE0Nyw1LjE0Mmg0NS42MTUgICBjMi44NDIsMCw1LjE0Ny0yLjMwNSw1LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDItMi4zMDUtNS4xNDctNS4xNDctNS4xNDdoLTE5LjM3Yy0yLjgzOSwwLTUuMTQyLTIuMjk5LTUuMTQ3LTUuMTM4bC0wLjAzNC0xOS4yMzggICBjLTAuMDA1LTIuODM5LTIuMzA4LTUuMTM4LTUuMTQ3LTUuMTM4SDUuMTQ3QzIuMzAzLDQwMS41ODktMC4wMDMsNDAzLjg5NiwwLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNGNDk0RiIgZD0iTTUxMiw0MDYuNzQxbC0wLjA0Miw0NS44MzdjLTAuMDAzLDIuODQtMi4zMDcsNS4xNDItNS4xNDcsNS4xNDJoLTQ1LjYxNSAgIGMtMi44NDIsMC01LjE0Ny0yLjMwNS01LjE0Ny01LjE0N3YtMTYuMzIzYzAtMi44NDIsMi4zMDUtNS4xNDcsNS4xNDctNS4xNDdoMTkuMzdjMi44MzksMCw1LjE0Mi0yLjI5OSw1LjE0Ny01LjEzOGwwLjAzNC0xOS4yMzggICBjMC4wMDUtMi44MzksMi4zMDgtNS4xMzgsNS4xNDctNS4xMzhoMTUuOTU5QzUwOS42OTcsNDAxLjU4OSw1MTIuMDAzLDQwMy44OTYsNTEyLDQwNi43NDF6IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTEuNTQzLDI1OC42MjljMTE5LjUyMywyMDEuMDQ0LDM4OS4zOTEsMjAxLjA0NCw1MDguOTEzLDBjMC45NjEtMS42MTYsMC45NjEtMy42NDQsMC01LjI1OSAgYy0xMTkuNTIzLTIwMS4wNDQtMzg5LjM5MS0yMDEuMDQ0LTUwOC45MTMsMEMwLjU4MywyNTQuOTg1LDAuNTgzLDI1Ny4wMTQsMS41NDMsMjU4LjYyOXoiIGRhdGEtb3JpZ2luYWw9IiNFMUYwRjQiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRTFGMEY0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0E5RDFENyIgZD0iTTUxMC40NiwyNTguNjI1Yy02NC45NDUsMTA5LjI0LTE3NC4yNjksMTU5LjEyNi0yNzkuNzUzLDE0OS42NDYgIGM4OC42NTItNy45NDcsMTc0LjU4Ny01Ny44MzIsMjI5LjE2OC0xNDkuNjQ2YzAuOTY3LTEuNjA1LDAuOTY3LTMuNjQ0LDAtNS4yNWMtNTQuNTc5LTkxLjgxMy0xNDAuNTE0LTE0MS42OTgtMjI5LjE2OC0xNDkuNjQ2ICBjMTA1LjQ4NC05LjQ4MSwyMTQuODA3LDQwLjQwNCwyNzkuNzUzLDE0OS42NDZDNTExLjQxNywyNTQuOTgsNTExLjQxNywyNTcuMDE5LDUxMC40NiwyNTguNjI1eiIgZGF0YS1vcmlnaW5hbD0iI0MzRDlERiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNDM0Q5REYiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMyMUNCRjk7IiBjeD0iMjU1Ljk5OSIgY3k9IjI1NS45OTkiIHI9IjE1MC4zNTUiIGRhdGEtb3JpZ2luYWw9IiMyMUNCRjkiIGNsYXNzPSIiPjwvY2lyY2xlPjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FGRTgiIGQ9Ik00MDYuMzU2LDI1NmMwLDgzLjA0My02Ny4zMTMsMTUwLjM1Ni0xNTAuMzU2LDE1MC4zNTZjLTguNCwwLTE2LjY0Ni0wLjY5LTI0LjY3NS0yLjAxOCAgQzMwMi42MzMsMzkyLjU3MSwzNTcuMDE3LDMzMC42NDIsMzU3LjAxNywyNTZzLTU0LjM4NS0xMzYuNTcyLTEyNS42OTItMTQ4LjMzOGM4LjAzLTEuMzI4LDE2LjI3NS0yLjAxOCwyNC42NzQtMi4wMTggIEMzMzkuMDQyLDEwNS42NDQsNDA2LjM1NiwxNzIuOTU3LDQwNi4zNTYsMjU2eiIgZGF0YS1vcmlnaW5hbD0iIzFDQUZFOCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMxQ0FGRTgiPjwvcGF0aD48Y2lyY2xlIHN0eWxlPSJmaWxsOiMzRjQ5NEYiIGN4PSIyNTIuOTg1IiBjeT0iMjYxLjk0OCIgcj0iNTAuNTc5IiBkYXRhLW9yaWdpbmFsPSIjNjQ4MDkzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzY0ODA5MyI+PC9jaXJjbGU+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMwMy41NjcsMjYxLjk0N2MwLDI3LjkzOS0yMi42NDcsNTAuNTg1LTUwLjU4NSw1MC41ODVjLTQuNDI3LDAtOC43MTktMC41NjYtMTIuODA2LTEuNjM3ICBjMjEuNzQxLTUuNjcyLDM3Ljc3OS0yNS40MzcsMzcuNzc5LTQ4Ljk0OHMtMTYuMDM4LTQzLjI3Ny0zNy43NzktNDguOTQ4YzQuMDg2LTEuMDcxLDguMzc5LTEuNjM3LDEyLjgwNi0xLjYzNyAgQzI4MC45MTksMjExLjM2MiwzMDMuNTY3LDIzNC4wMDksMzAzLjU2NywyNjEuOTQ3eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojQkNEOUREIiBjeD0iMjgxLjQ0OSIgY3k9IjIyNy42MTUiIHI9IjI4LjE1NCIgZGF0YS1vcmlnaW5hbD0iI0UxRjBGNCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFMUYwRjQiPjwvY2lyY2xlPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDRDlERCIgZD0iTTMwOS41OTksMjI3LjYxOWMwLDE1LjU0OC0xMi42MDQsMjguMTUyLTI4LjE1MiwyOC4xNTJjLTIuNDY0LDAtNC44NTMtMC4zMTUtNy4xMjctMC45MSAgIGMxMi4xLTMuMTU3LDIxLjAyNS0xNC4xNTYsMjEuMDI1LTI3LjI0MnMtOC45MjYtMjQuMDg1LTIxLjAyNS0yNy4yNDJjMi4yNzUtMC41OTYsNC42NjMtMC45MSw3LjEyNy0wLjkxICAgQzI5Ni45OTUsMTk5LjQ2NywzMDkuNTk5LDIxMi4wNywzMDkuNTk5LDIyNy42MTl6IiBkYXRhLW9yaWdpbmFsPSIjRTFGMEY0IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0UxRjBGNCI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6IzU4NkY3RiIgZD0iTTMyNC42OTcsMjQ4LjMzNWgtNjEuMTg0di02MS4xODRjMC00LjE0OC0zLjM2My03LjUxMi03LjUxMi03LjUxMmMtNC4xNDgsMC03LjUxMiwzLjM2My03LjUxMiw3LjUxMiAgdjYxLjE4NGgtNjEuMTg0Yy00LjE0OCwwLTcuNTEyLDMuMzYzLTcuNTEyLDcuNTEyczMuMzYzLDcuNTEyLDcuNTEyLDcuNTEyaDYxLjE4NHY2MS4xODRjMCw0LjE0OCwzLjM2Myw3LjUxMiw3LjUxMiw3LjUxMiAgYzQuMTQ4LDAsNy41MTItMy4zNjMsNy41MTItNy41MTJ2LTYxLjE4NGg2MS4xODRjNC4xNDgsMCw3LjUxMi0zLjM2Myw3LjUxMi03LjUxMlMzMjguODQ1LDI0OC4zMzUsMzI0LjY5NywyNDguMzM1eiIgZGF0YS1vcmlnaW5hbD0iIzU4NkY3RiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzU4NkY3RiI+PC9wYXRoPjwvZz4gPC9zdmc+">
                            </a>
                             
                        </td>
                        <td><a  class="" data-toggle="modal" data-target="#myModalUniversal"
                                    onclick="

                                  document.getElementById('id_tabla').value=0;
                                  document.getElementById('id_informe_academico').value='<?php echo($key['id_informe_academico']); ?>';
                                  document.getElementById('id_alumno').value='<?php echo($key['id_alumnos']); ?>';"><br>
                       <img style=" width: 37px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDQzOC41MzMgNDM4LjUzMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8cGF0aCBkPSJNNDA5LjEzMywxMDkuMjAzYy0xOS42MDgtMzMuNTkyLTQ2LjIwNS02MC4xODktNzkuNzk4LTc5Ljc5NkMyOTUuNzM2LDkuODAxLDI1OS4wNTgsMCwyMTkuMjczLDAgICBjLTM5Ljc4MSwwLTc2LjQ3LDkuODAxLTExMC4wNjMsMjkuNDA3Yy0zMy41OTUsMTkuNjA0LTYwLjE5Miw0Ni4yMDEtNzkuOCw3OS43OTZDOS44MDEsMTQyLjgsMCwxNzkuNDg5LDAsMjE5LjI2NyAgIGMwLDM5Ljc4LDkuODA0LDc2LjQ2MywyOS40MDcsMTEwLjA2MmMxOS42MDcsMzMuNTkyLDQ2LjIwNCw2MC4xODksNzkuNzk5LDc5Ljc5OGMzMy41OTcsMTkuNjA1LDcwLjI4MywyOS40MDcsMTEwLjA2MywyOS40MDcgICBzNzYuNDctOS44MDIsMTEwLjA2NS0yOS40MDdjMzMuNTkzLTE5LjYwMiw2MC4xODktNDYuMjA2LDc5Ljc5NS03OS43OThjMTkuNjAzLTMzLjU5NiwyOS40MDMtNzAuMjg0LDI5LjQwMy0xMTAuMDYyICAgQzQzOC41MzMsMTc5LjQ4NSw0MjguNzMyLDE0Mi43OTUsNDA5LjEzMywxMDkuMjAzeiBNMzQ3LjE3OSwyMzcuNTM5YzAsNC45NDgtMS44MTEsOS4yMzYtNS40MjgsMTIuODQ3ICAgYy0zLjYyLDMuNjE0LTcuOTAxLDUuNDI4LTEyLjg0Nyw1LjQyOGgtNzMuMDkxdjczLjA4NGMwLDQuOTQ4LTEuODEzLDkuMjMyLTUuNDI4LDEyLjg1NGMtMy42MTMsMy42MTMtNy44OTcsNS40MjEtMTIuODQ3LDUuNDIxICAgaC0zNi41NDNjLTQuOTQ4LDAtOS4yMzEtMS44MDgtMTIuODQ3LTUuNDIxYy0zLjYxNy0zLjYyMS01LjQyNi03LjkwNS01LjQyNi0xMi44NTR2LTczLjA4NGgtNzMuMDg5ICAgYy00Ljk0OCwwLTkuMjI5LTEuODEzLTEyLjg0Ny01LjQyOGMtMy42MTYtMy42MS01LjQyNC03Ljg5OC01LjQyNC0xMi44NDd2LTM2LjU0N2MwLTQuOTQ4LDEuODA5LTkuMjMxLDUuNDI0LTEyLjg0NyAgIGMzLjYxNy0zLjYxNyw3Ljg5OC01LjQyNiwxMi44NDctNS40MjZoNzMuMDkydi03My4wODljMC00Ljk0OSwxLjgwOS05LjIyOSw1LjQyNi0xMi44NDdjMy42MTYtMy42MTYsNy44OTgtNS40MjQsMTIuODQ3LTUuNDI0ICAgaDM2LjU0N2M0Ljk0OCwwLDkuMjMzLDEuODA5LDEyLjg0Nyw1LjQyNGMzLjYxNCwzLjYxNyw1LjQyOCw3Ljg5OCw1LjQyOCwxMi44NDd2NzMuMDg5aDczLjA4NGM0Ljk0OCwwLDkuMjMyLDEuODA5LDEyLjg0Nyw1LjQyNiAgIGMzLjYxNywzLjYxNSw1LjQyOCw3Ljg5OCw1LjQyOCwxMi44NDdWMjM3LjUzOXoiIGZpbGw9IiMxOWFhY2YiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIHN0eWxlPSIiIGNsYXNzPSIiPjwvcGF0aD4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+" />
                            </a>
                            <!-- Modal -->
                            
                        </td> 
                       
                        <td> <br><a  target="_blank"data-title="Descargar" href="../../../vista/docente/obserador/descarga_individual.php?sede=<?php echo strtoupper($_POST['sede']) ?>&&jornada=<?php echo strtoupper($_POST['jornada']) ?>&&curso=<?php echo strtoupper($_POST['nom_curso']) ?>&&id_alumnos=<?php echo $key['id_alumnos'] ?>&&nombre=<?php echo $nombre ?>&&apellido=<?php echo $apellido ?>"><img  style="width: 35px" src="data:image/svg+xml;base64,PHN2ZyBpZD0iY29sb3IiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI0IDI0IiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDI0IDI0IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0xMiAwYy02LjYxNyAwLTEyIDUuMzgzLTEyIDEyczUuMzgzIDEyIDEyIDEyIDEyLTUuMzgzIDEyLTEyLTUuMzgzLTEyLTEyLTEyeiIgZmlsbD0iIzAwYmNkNCIvPjxwYXRoIGQ9Im03IDE5aDEwYy41NTMgMCAxLS40NDggMS0xcy0uNDQ3LTEtMS0xaC0xMGMtLjU1MyAwLTEgLjQ0OC0xIDFzLjQ0NyAxIDEgMXoiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMTEuNDcgMTQuNzhjLjE0Ni4xNDcuMzM4LjIyLjUzLjIycy4zODQtLjA3My41My0uMjJsMy4yNS0zLjI1Yy40NzItLjQ3LjEzOS0xLjI4LS41My0xLjI4aC0yLjI1di00LjVjMC0uNTUyLS40NDctMS0xLTFzLTEgLjQ0OC0xIDF2NC41aC0yLjI1Yy0uNjY5IDAtMS4wMDIuODEtLjUzIDEuMjh6IiBmaWxsPSIjZmZmIi8+PHBhdGggZD0ibTEyIDBjLTYuNjE3IDAtMTIgNS4zODMtMTIgMTJzNS4zODMgMTIgMTIgMTJ2LTVoLTVjLS41NTMgMC0xLS40NDgtMS0xcy40NDctMSAxLTFoNXYtMmMtLjE5MiAwLS4zODQtLjA3My0uNTMtLjIybC0zLjI1LTMuMjVjLS40NzItLjQ3LS4xMzktMS4yOC41My0xLjI4aDIuMjV2LTQuNWMwLS41NTIuNDQ3LTEgMS0xeiIgZmlsbD0iIzAwYTRiOSIvPjxnIGZpbGw9IiNkZWRlZGUiPjxwYXRoIGQ9Im0xMiAxN2gtNWMtLjU1MyAwLTEgLjQ0OC0xIDFzLjQ0NyAxIDEgMWg1eiIvPjxwYXRoIGQ9Im0xMiA0Ljc1Yy0uNTUzIDAtMSAuNDQ4LTEgMXY0LjVoLTIuMjVjLS42NjkgMC0xLjAwMi44MS0uNTMgMS4yOGwzLjI1IDMuMjVjLjE0Ni4xNDcuMzM4LjIyLjUzLjIyeiIvPjwvZz48L3N2Zz4=" /></a>
                    </tr> 
                    <?php
                    }
                    ?>
                </tbody>
            </table>
    </div>
</div   >
<?php } else { ?>
    <div class="col-md-12">
        <div class="alert" role="alert" style=" margin:10px;color: rgb(193, 131, 0); background-color: rgb(255, 248, 233); border-color: rgb(255, 205, 101); position: relative; padding: 1rem 1.25rem; margin-bottom: 2rem; border-radius: 4px; border-style: solid; "> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> Actualmente no tienes estudiantes. </div> 
    </div><br>    
<?php }  
}

function modal(){   
    include "../../codes/rector/conexion.php";
    $foto_alumno=$_POST['foto'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $curso=$_POST['curso'];
    $jornada=$_POST['jornada'];
    $sede=$_POST['sede'];
    $id=$_SESSION['Id_Doc'];
    $id_i=$_POST['id_i'];
    $obser="SELECT observador_compromiso.texto, docente.id_docente,administradores.NOMBRE,administradores.APELLIDO,administradores.GENERO,administradores.FOTO, observacion.id_admin, observacion_categotia.nombre as nom_t,observacion_tipo.nombre as nom_c,observacion.area, docente.nombre,docente.apellido,docente.genero,docente.foto,observacion.descripcion,observacion.fecha,observacion_tipo.nombre as tipo,observacion_categotia.id as categoria,observacion.id ,observacion_tipo.id as tipo,observacion.compromiso FROM observacion LEFT JOIN observador_compromiso on observador_compromiso.id=observacion.compromiso LEFT JOIN  administradores on  administradores.ID_ADMIN=observacion.id_admin LEFT JOIN docente on docente.id_docente=observacion.id_docente LEFT JOIN observacion_tipo on observacion.id_observacion_tipo=observacion_tipo.id LEFT JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria WHERE observacion.id_alumno=$id_i";
    $obser1=$conexion->prepare($obser);
    $obser1->execute(array());
    $obser2=$obser1->fetchAll();

 

    ?> 
     
<script>
    $(".my-select").chosen()({
      placeholder: "Select a state",
      allowClear: true
    });
    </script>
    
    <a style="margin-left: 27px;"      >  
        <strong><?php echo $obser1->rowCount() ?> Observaciones</strong>
    </a>
    <br><br>
    <div class="col-md-12" >
        <div class="row" >
            <div class="col-md-3">
                 <div class="box-body box-profile center-block">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $foto_alumno ?>" alt="User profile picture" style="width: 120px;"><br>
 
                    
                </div>
            </div>  
            <div class="col-md-9"> 
                <div class="col-md-6">
                    <label for="genero">Sede:</label> 
                    <input type="text" class="form-control" value="<?php echo $sede ?>" disabled=""><br>
                </div> 
                <div class="col-md-6">
                    <label for="genero">Jornada</label> 
                    <input type="text" class="form-control" value="<?php echo $jornada ?>" disabled=""><br>
                </div>  
                <div class="col-md-6">
                    <label for="genero">Nombre</label> 
                    <input type="text" class="form-control" value="<?php echo $nombre. " ".$apellido ?>" disabled=""><br>
                </div> 
                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-8">
                        <label for="genero">Curso</label> 
                        <input type="text" class="form-control" value="<?php echo $curso ?>" disabled=""><br>
                    </div> 
                    <div class="col-md-4">
                        <label for="genero">Año</label> 
                        <input type="text" class="form-control" value="<?php echo date("Y") ?>" disabled=""><br>
                    </div> 
                    </div> 
                </div> 
                <div class="col-md-12">  
                    <button class="btn btn-primary  " data-toggle="modal" data-target="#myModalUniversal"
                    onclick="document.getElementById('id_alumno').value='<?php echo($id_i); ?>';document.getElementById('nombre_vista').value='<?php echo $nombre ?>';document.getElementById('foto_vista').value='<?php echo $foto_alumno ?>';document.getElementById('apellido_vista').value='<?php echo $apellido ?>';document.getElementById('id_tabla').value='1';"> Agregar</button>
                    <a target="_blank" href="descarga_individual.php?sede=<?php echo($sede); ?>&&jornada=<?php echo($jornada); ?>&&curso=<?php echo($curso); ?>&&id_alumnos=<?php echo($id_i); ?>&&nombre=<?php echo($nombre); ?>&&apellido=<?php echo($apellido); ?>"   class=" btn     btn-danger  ">
                        <img style="width: 17px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDgyLjE0IDQ4Mi4xNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDgyLjE0IDQ4Mi4xNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIGQ9Ik0xNDIuMDI0LDMxMC4xOTRjMC04LjAwNy01LjU1Ni0xMi43ODItMTUuMzU5LTEyLjc4MmMtNC4wMDMsMC02LjcxNCwwLjM5NS04LjEzMiwwLjc3M3YyNS42OSAgIGMxLjY3OSwwLjM3OCwzLjc0MywwLjUwNCw2LjU4OCwwLjUwNEMxMzUuNTcsMzI0LjM3OSwxNDIuMDI0LDMxOS4xLDE0Mi4wMjQsMzEwLjE5NHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTxwYXRoIGQ9Ik0yMDIuNzA5LDI5Ny42ODFjLTQuMzksMC03LjIyNywwLjM3OS04LjkwNSwwLjc3MnY1Ni44OTZjMS42NzksMC4zOTQsNC4zOSwwLjM5NCw2Ljg0MSwwLjM5NCAgIGMxNy44MDksMC4xMjYsMjkuNDI0LTkuNjc3LDI5LjQyNC0zMC40NDlDMjMwLjE5NSwzMDcuMjMxLDIxOS42MTEsMjk3LjY4MSwyMDIuNzA5LDI5Ny42ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8cGF0aCBkPSJNMzE1LjQ1OCwwSDEyMS44MTFjLTI4LjI5LDAtNTEuMzE1LDIzLjA0MS01MS4zMTUsNTEuMzE1djE4OS43NTRoLTUuMDEyYy0xMS40MTgsMC0yMC42NzgsOS4yNTEtMjAuNjc4LDIwLjY3OXYxMjUuNDA0ICAgYzAsMTEuNDI3LDkuMjU5LDIwLjY3NywyMC42NzgsMjAuNjc3aDUuMDEydjIyLjk5NWMwLDI4LjMwNSwyMy4wMjUsNTEuMzE1LDUxLjMxNSw1MS4zMTVoMjY0LjIyMyAgIGMyOC4yNzIsMCw1MS4zLTIzLjAxMSw1MS4zLTUxLjMxNVYxMjEuNDQ5TDMxNS40NTgsMHogTTk5LjA1MywyODQuMzc5YzYuMDYtMS4wMjQsMTQuNTc4LTEuNzk2LDI2LjU3OS0xLjc5NiAgIGMxMi4xMjgsMCwyMC43NzIsMi4zMTUsMjYuNTgsNi45NjVjNS41NDgsNC4zODIsOS4yOTIsMTEuNjE1LDkuMjkyLDIwLjEyN2MwLDguNTEtMi44MzcsMTUuNzQ1LTcuOTk5LDIwLjY0NiAgIGMtNi43MTQsNi4zMi0xNi42NDMsOS4xNTctMjguMjU4LDkuMTU3Yy0yLjU4NSwwLTQuOTAyLTAuMTI4LTYuNzE0LTAuMzc5djMxLjA5Nkg5OS4wNTNWMjg0LjM3OXogTTM4Ni4wMzQsNDUwLjcxM0gxMjEuODExICAgYy0xMC45NTQsMC0xOS44NzQtOC45Mi0xOS44NzQtMTkuODg5di0yMi45OTVoMjQ2LjMxYzExLjQyLDAsMjAuNjc5LTkuMjUsMjAuNjc5LTIwLjY3N1YyNjEuNzQ4ICAgYzAtMTEuNDI4LTkuMjU5LTIwLjY3OS0yMC42NzktMjAuNjc5aC0yNDYuMzFWNTEuMzE1YzAtMTAuOTM4LDguOTIxLTE5Ljg1OCwxOS44NzQtMTkuODU4bDE4MS44OS0wLjE5djY3LjIzMyAgIGMwLDE5LjYzOCwxNS45MzQsMzUuNTg3LDM1LjU4NywzNS41ODdsNjUuODYyLTAuMTg5bDAuNzQxLDI5Ni45MjVDNDA1Ljg5MSw0NDEuNzkzLDM5Ni45ODcsNDUwLjcxMywzODYuMDM0LDQ1MC43MTN6ICAgIE0xNzQuMDY1LDM2OS44MDF2LTg1LjQyMmM3LjIyNS0xLjE1LDE2LjY0Mi0xLjc5NiwyNi41OC0xLjc5NmMxNi41MTYsMCwyNy4yMjYsMi45NjMsMzUuNjE4LDkuMjgyICAgYzkuMDMxLDYuNzE0LDE0LjcwNCwxNy40MTYsMTQuNzA0LDMyLjc4MWMwLDE2LjY0My02LjA2LDI4LjEzMy0xNC40NTMsMzUuMjI0Yy05LjE1Nyw3LjYxMi0yMy4wOTYsMTEuMjIyLTQwLjEyNSwxMS4yMjIgICBDMTg2LjE5MSwzNzEuMDkyLDE3OC45NjYsMzcwLjQ0NiwxNzQuMDY1LDM2OS44MDF6IE0zMTQuODkyLDMxOS4yMjZ2MTUuOTk2aC0zMS4yM3YzNC45NzNoLTE5Ljc0di04Ni45NjZoNTMuMTZ2MTYuMTIyaC0zMy40MiAgIHYxOS44NzVIMzE0Ljg5MnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZGRkZGRiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+"> Descargae Matricula
                      </a>
              
                     
                </div>  
            </div>
        </div>
    </div>
    <?php

    foreach ($obser2 as  $value) {
        $foto=$value['foto'];
        if ($value['foto']=='' && $value['genero']==1) {
            $foto='../../../logos/femenino.png';
        }
        if ($value['foto']=='' && ($value['genero']==0   )) {
            $foto='../../../logos/masculino.png';
        } 
        ?><br>
        <div class=" col-md-12">

            <div  style="border: solid #d5d5d5;background: #e6e6e6;padding: 10px;margin: 10px;">
                <div class="user-block">
                    <img style="width: 80px;height: 90px;margin-right: 10px" class="profile-user-img img-responsive img-circle" src="<?php echo $foto ?>" alt="user image">
                        <span class="username">
                          <a ><?php echo mb_convert_case(($value['nombre']." ".$value['apellido']), MB_CASE_TITLE, "UTF-8")   ; ?></a> 
                        </span>
                    <span class="description">Publicado el <?php echo $value['fecha'] ?></span>
                    <span class="description">Area: <?php echo $value['area'] ?></span><br>
                </div><br>
                <!-- /.user-block -->
                 
                    <span class="btn btn-warning btn-xs">Tipo de Observacion</span> <span class="btn btn-default btn-xs"> <?php echo $value['nom_t'] ?></span><br>
                <p>
                    <div style="margin-top: 10px;margin-bottom: 10px">
                        <span class="btn btn-info btn-xs">Categoria</span>  <span class="btn btn-default btn-xs"><?php echo $value['nom_c'] ?></span>
                    <br>
                    </div>
                    <?php if ($value['id_admin']>0) {  
                        $fotografia=$value['FOTO'];
                        if ($value['FOTO']=='' && $value['GENERO']==1) {
                            $fotografia='../../../logos/femenino.png';
                        }
                        if ($value['FOTO']=='' && ($value['GENERO']==0   )) {
                            $fotografia='../../../logos/masculino.png';
                        } 

                        ?>
                        <div style="margin-top: 10px;margin-bottom: 10px">
                            <span class="btn btn-link btn-xs"><strong>Remitido a</strong></span>  

                            <select  class=" form-control my-select"     > 
                                <option selected="selected" data-img-src="<?php echo($fotografia); ?>" aria-disabled="true"  ><?php echo($value['NOMBRE']." ".$value['APELLIDO']); ?></option>
                            </select>
                        <br>
                        </div>
                    <?php } ?> 
                    
                    
                    
                <p>
                    <span class="btn btn-primary btn-xs">Descripcion</span> 
                    <div   class="  btn-default btn-xs">
                        <?php echo $value['descripcion'] ?>
                    </div>
                    <div style="margin-top: 10px;margin-bottom: 10px">
                        <span class="btn btn-link btn-xs"><strong>Compromiso</strong></span>  

                        <div   class="  btn-default btn-xs">
                            <?php 
                            if ($value['compromiso']==0) {
                                echo "El acudiente y el estudiante no se han comprometido a la  observación";
                             }
                            if ($value['compromiso']!=0) {
                                echo $value['texto'];
                            } ?>
                        </div>
                        <br>
                    </div>
                   
                    <?php if ($value['id_docente']==$_SESSION['Id_Doc']){ ?>
                        <button type="button" class="btn btn-success" data-target="#actualizar" data-toggle="modal" onclick="
                        document.getElementById('nombre_vista').value='<?php echo $nombre ?>';
                        document.getElementById('foto_vista').value='<?php echo $foto_alumno ?>';
                        document.getElementById('apellido_vista').value='<?php echo $apellido ?>'; actual(<?php echo $value['compromiso'].','.$id_i.','.$value['id_admin'].','.$value['categoria'].','.$value['tipo'].','.$value['id'] ?>,'<?php echo $value['descripcion'] ?>');"><span class="icon"><i class="fa fa-pencil-square-o"></i></span> Actualizar</button>
                         
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('nombre_vista').value='<?php echo $nombre ?>';
                        document.getElementById('foto_vista').value='<?php echo $foto_alumno ?>';
                        document.getElementById('apellido_vista').value='<?php echo $apellido ?>';executeExample(<?php echo $value['id'].','.$id_i ?>)"><span class="icon"><i class="fa fa-trash-o"></i></span> Eliminar
                        </button> 
                    <?php } ?>
            </div>
        </div>

        <?php
    }
 
}
function eliminar(){
    
    if(!preg_match ("/^[0-9]+$/",  $_POST['id'])){

        echo $num='Error en el registro'; return;
    }else{


        include "../../codes/rector/conexion.php";
        
        $obser="SELECT remision.id_remision from remision WHERE remision.id_observacion='".$_POST['id']."'  and remision.estado='Atendida'";
        $obser1=$conexion->prepare($obser);
        $obser1->execute(array());
        $cont=$obser1->rowCount();
        if ($cont>0) {
            echo $num='Error en el registro';  
        }else{
            $obser="DELETE FROM observacion WHERE observacion.id = ".$_POST['id'].";DELETE FROM remision WHERE remision.id_observacion= ".$_POST['id'];
            $obser1=$conexion->prepare($obser);
            $obser1->execute(array());
            echo 1;

        }
        
    }

}
function actualizar(){
    if ($_POST['categoria']=='') {
      
        echo $num='El campo tipo es requerido'; return;
    }
    if ($_POST['tipo']==0) {
       
        echo $num='El campo categoria es requerido'; return;
    }
    if ( (!preg_match ("/^[0-9]+$/",  $_POST['id_admin'])) && (!preg_match ("/^[0-9]+$/",  $_POST['tipo'])) && (!preg_match ("/^[0-9]+$/",  $_POST['id_observacion'])) && (!preg_match ("/^[0-9]+$/",  $_POST['compromiso']))) 
    {
          
        echo $num='Error en el registro'; return;
    } 
    $descripcion=$_POST['descripcion'];
    if (  (!preg_match ("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\ .Ã±,ñÑ:Ã³]+$/", $descripcion)) )
    {

        echo $num='No se permite caracteres especiales, ni punto y coma (;) ni un salto de linea con la tecla enter'; return;
    }

    if ($_POST['categoria']>2 && $_POST['id_admin']==0) {
       
        echo $num='El campo Remitido es requerido'; return;
    }
    include "../../codes/rector/conexion.php";
    $obser="SELECT remision.id_remision from remision WHERE remision.id_observacion='".$_POST['id_observacion']."'  and remision.estado='1'";
    $obser1=$conexion->prepare($obser);
    $obser1->execute(array());
    $cont=$obser1->rowCount();
    if ($cont>0) {
        echo $num='La remisión se encuentra respondida por tal motivo el archivo no   puede modificarse :)';  
    }else{
        $obser="UPDATE `observacion` SET `descripcion`='".$_POST['descripcion']."',`id_observacion_tipo`='".$_POST['tipo']."',`id_admin`='".$_POST['id_admin']."',`compromiso`='".$_POST['compromiso']."' WHERE id=".$_POST['id_observacion'];
        $obser1=$conexion->prepare($obser);
        $obser1->execute(array());

        echo $num=1; return;
    }
}
?>
