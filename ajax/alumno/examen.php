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
    $asignatura=$_POST['asignatura']; 
    $partes=explode(',',  $asignatura);
    $asignatura=$partes[0];
    
    $id_informe_academico=$_SESSION['id_informe_academico'];
    

    $jornada=$_SESSION['jornada'];
    $grado=$_SESSION['grado'];
    $curso=$_SESSION['curso'];
    $sede=$_SESSION['sede'];
    $id_grado=$_SESSION['id_grado'];
    $id_jornada_sede=$_SESSION['id_jornada_sede'];
    $id_curso=$_SESSION['id_curso']; 
    ?> 
         
    <h3>Sede
        <?php echo($sede); ?>
    </h3>
    <h4>Jornada
        <?php echo($jornada); ?> 
    </h4>
    <h5>Curso
        <?php echo($grado." ".$curso); ?>
    </h5>
    <h6>Asignatura 
        <button type="button" class="btn btn-danger">
            <?php echo($asignatura); ?>
        </button>
    </h6>
    <?php 
    $sql=" 

    SELECT nota_independiente.id_nota_independiente,nota_independiente.nombre,examen.id,examen.minutos,examen.fecha, examen.hora, materia_por_paso.id_materia_por_paso,materia_por_paso.nota FROM nota_independiente INNER JOIN materia_por_paso on materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente INNER JOIN examen ON nota_independiente.id_nota_independiente=examen.id_notas_independientes WHERE materia_por_paso.id_alumno=$id_informe_academico and nota_independiente.id_grado=$id_grado AND nota_independiente.id_jornada_sede=$id_jornada_sede AND nota_independiente.id_curso=$id_curso and nota_independiente.id_area=$partes[1] order by examen.id desc ";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    $count=$sql1->rowCount();
    $con2=$sql1->fetchAll();
    if ($count!=0) { ?>
        <div class="table-responsive">
            <table class="table table-striped  table-hover">
                <thead>
                    <tr>
                        <th>Tema</th> 
                        <th>Fecha</th>   
                        <th>Duración</th>    
                        <th>Resultado</th>    
                        <th>Responder</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php              
                    $for=0;
                    foreach($con2 as $var){
                        $for++;             ?>
                        <tr>
                            <td>
                                <?php echo($var['nombre']); ?>
                            </td>
                            <td><?php echo $var['fecha'] .' ' .$var['minutos'] ?></td> 
                            <td> <?php
                                if($var['minutos']!=1){echo($var['minutos']." Minutos");}else{echo($var['minutos']." Minuto");} ?>
                            </td>        
                            <td><?php        
                                if($var['nota']==0){ ?>
                                    <a    data-title="Aún no has respondido el examen" style="  cursor: not-allowed;"  >
                                        <img width="47"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                    </a><?php
                                }else{?>
                                    <a    id="examen_R<?php echo($for); ?>" onclick="click_query(<?php echo($var[0]); ?>,<?php echo $var['nota']?>)"     data-title="puedes visualizar los resultados" >
                                        <img width="47"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                    </a><?php
                                }?>
                            </td>
                            <td> <?php 
                                if($var['nota']==0){  
                                    date_default_timezone_set('America/Bogota');
                                    $fecha_actual=date('Y-m-d');
                                    if($var['fecha']==$fecha_actual){
                                        $hora=$var['hora'] ;  
                                        $min=$var['minutos']-1;
                                        $NuevaFecha = strtotime ( '+'.$min.' minute' , strtotime ($hora) ) ;  
                                        $final = date ( 'H:i:s' , $NuevaFecha); 
                                         
                                         
                                        ?>
                                       <a    id="examen_R<?php echo($for); ?>" onclick="

                                        var base='<?php  echo $var['hora'] ?>'; 
                                        var final='<?php echo $final ?>'; examen_click(<?php echo($var[0]); ?>,'<?php echo($var['nombre']); ?>','<?php echo($var['hora']); ?>','<?php echo($var['minutos']); ?>','<?php echo($var['id_materia_por_paso']); ?>',base,final)"  data-title="puedes responder el examen" > <img width="47"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /> </a>  
                                                         
                                                 
                                        <?php
                                    }if($var['fecha']>$fecha_actual){?>
                                        <a      data-title="A un no es tiempo para presentar el examen"  style=" cursor: not-allowed;">
                                            <img width="47"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                        </a> <?php
                                    }
                                    if($var['fecha']<$fecha_actual){?>
                                        <a      data-title="la fecha ya paso"  style=" cursor: not-allowed;">
                                            <img width="47"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                        </a> <?php
                                    }
                                }else{ ?>
                                    <a   id=" "    data-title="ya has respondido tu examen"  style=" cursor: not-allowed;"  >
                                        <img width="47"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                    </a> <?php
                                } ?>
                            </td> 
                            
                        </tr> <?php
                    }?>
                </tbody>
            </table>
        </div><?php
    }else{?>
        <div class="alert  " role="alert" style="color: #0a6ebd;background-color: #e3f2fd;border-color: #82c4f8; ">
            <strong>Información!</strong> no tienes evaluaciones.
        </div><?php
    }?>
    <input type="hidden" id="for" value="<?php echo($for); ?>">
 
<?php
}

function examenR()
{
    $final=$_POST['final'];
    $base=$_POST['base'];
    date_default_timezone_set("America/Bogota");
    $tiempo=date('H:i:s');
    if ($tiempo<$base) {
        echo -1;
       
    } 
    
    if (($tiempo>=$base) && ($tiempo<$final)){

        include "../../codes/rector/conexion.php";
        $id=$_POST['id']; 
        
        $tema=$_POST['nombre'];
        $m=$_POST['minutos'];
        $h=$_POST['hora'];
        $sql2="SELECT id,pregunta,respuesta1,respuesta2,respuesta3,respuesta4,respuestaCorecta FROM `examen_pregunta` WHERE examen_pregunta.id_notas_independientes=$id ORDER BY RAND()";
        $sql3=$conexion->prepare($sql2);
        $sql3->execute(array());
        $count=$sql3->rowCount();
        $con2=$sql3->fetchAll();
        shuffle($con2);
        $n=0;
        ?>  
        <center>
            <h4>Tema:
                <?php 
                $hora=$h ;    

                $NuevaFecha = strtotime ( '+'.$m.' minute' , strtotime ($hora) ) ;  
                $sum = date ( 'H:i:s' , $NuevaFecha);  

                date_default_timezone_set("America/Bogota");
                $actual = date('H:i:s');

                $actual = strtotime($actual); 
                $sum = strtotime($sum);

                $hf=$sum-$actual;
                $time = gmdate("H:i:s", $hf); // feed seconds
                $ime=explode(':', $time);
                $horas=$ime[1]+($ime[0]*60); 

                $horas.'.'.$ime[2];
                 echo($tema).("<input type='hidden' value='".$horas.'.'.$ime[2]."' id='minutos'"); //Colocar [0] para que reloj funcione?>
            </h4>
            <h1 id="timerDiv">00:00:00</h1>
        </center>

        <div style=" float: left;">
            <select class="form-control" id="sele" onchange ="var va=document.getElementById('sele').value;

            document.getElementById('pagina').value=1; 
            document.getElementById('cantidad').value=va;  ddd()">
                <option value="3">3</option>
                <option value="6">6</option>
                <option value="12">12</option>
                <option value="24">24</option> 
            </select>
        </div>
        <div class="">
            <div  id="sapo1" class="" style="margin-top: -20px;float: right;">
               
            </div>
        </div>
        <br><br> <br><br> 
        <div id="sapoe"></div>
        <form role="form" action="" method="post" id="formulario-envia">

            <input type="hidden" value="<?php echo $_POST['id_materia_por_paso'] ?>" name='id_materia_por_paso'>
            <input type="hidden" value="<?php echo $id ?>" name='id_notas_independientes'>
            <?php
            $n=1;
            foreach($con2 as $key){
                $r=$n++;
                ?>
                <div style="display: none;"  class='tab' id="tabla<?php echo $r ?>">
                    <div    style=" border: solid 2px #33b5e5;" >
                        <div style="
                        font-size: 16px;
                        background-color: #33b5e5;
                        color: #fff;
                        padding: 6px;
                        ">
                            <nav style="float: left;margin-right: 10px;">
                                <?php echo  $r ?>.
                            </nav>

                            <?php echo $key['pregunta'] ?>

                        </div>
                        <input type="hidden" value="<?php echo $key['respuestaCorecta'] ?>" name='respuesta_c[]'>
                        <input type="hidden" value="<?php echo $key['id'] ?>" name='pregunta<?php echo($r); ?>'>
                        <table class="table   table-hover">
                        
                            <tr>
                                <td><input type="radio" class="iradio_flat-red" name="respuesta<?php echo($r); ?>" value="1"  >
                                    <?php echo($key['respuesta1']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="radio" class="iradio_flat-red" name="respuesta<?php echo($r); ?>" value="2">
                                    <?php echo($key['respuesta2']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="radio" class="iradio_flat-red" name="respuesta<?php echo($r); ?>" value="3">
                                           <?php echo($key['respuesta3']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="radio" class="iradio_flat-red" name="respuesta<?php echo($r); ?>" value="4">
                                    <?php echo($key['respuesta4']); ?>
                                </td>
                            </tr>
                        </table>
                    </div><br>

                    <?php 
                    if ($count==$r) {
                        ?>
                        <button class="btn btn-danger" style="    background-color: #33b5e5;
                        /* color: #fff; */
                        width: 197px;
                        color: #fff;
                        border: solid 1px #25a3d2;
                        margin-bottom: 14px;
                        border-radius: 4px;
                        font-size: 16px;
                        float: right;
                        height: 34px;">Guardar Respuestas</button>
                        <?php 
                    } ?>
                </div><?php
            } ?>
        </form>     
        <div  id="sapo2" class="" style="margin-top: -20px;"></div>
            <!--Fin wizard-->
            <input type="hidden" value="1" id="pagina">
            <input type="hidden" value="3" id="cantidad"> 
      
        <script>
            $(document).on("submit", "#formulario-envia", function(e){
                e.preventDefault();  
                mostrar(); 
                $.ajax({

                    type: "post",
                    url: "../../../ajax/alumno/examen.php?action=insertR",
                    data: $(this).serialize(),
                    dataType:"text", 
                    success: function(data)
                    { 
                        $('body').loadingModal({text: 'Showing loader animations...'});
                                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                    var time = 0;
                                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                    .then(function() { $('body').loadingModal('destroy') ;} ); 

                                    window.location.assign( window.location.href);
                    }
                });
            });

            $(document).ready(function() {
                debugger;
                let minutos = parseInt($("#minutos").val());
                let M = minutos * 60;
                $('#timerDiv').timer('remove');
                $('#timerDiv').timer({
                    countdown: true,
                    duration: M,
                    callback: function() {

                        mostrar(); 

                        var parametros=new FormData($("#formulario-envia")[0]);
                        $.ajax({

                            data:parametros,
                            url: "../../../ajax/alumno/examen.php?action=insertR",
                            type:"POST",
                            contentType:false,
                            processData:false,

                            success: function(data){ 
                                $('body').loadingModal({text: 'Showing loader animations...'});
                                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                    var time = 0;
                                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                    .then(function() { $('body').loadingModal('destroy') ;} ); 

                                    window.location.assign( window.location.href);
                            }
                        });   
                        
                    },
                    format: '%H:%M:%S'
                });
            });
            //funcion del select
            function myFunction(u){
                document.getElementById('pagina').value=u; 
                ddd();
            }
            //funcion de la paginacion
            function ddd(){

                // cada vez que se ejecute este escript el scroll estara al inicio de pagina
                $("html,body,.bin").animate({
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

                    document.getElementById('tabla1').style.display='block'; 
                }

                vista_inicio=vista_inicio+1;
                for (vista_inicio;  vista_inicio<vista_max+1 ; vista_inicio++) {  
                    document.getElementById('tabla'+vista_inicio).style.display='block'; 
                } 
               
            }

            ddd();
         
            

        </script><?php
    }
    if ($tiempo>$final) {
        echo 0;
        
    }
}

function insertR()
{
    $id_notas_independientes=$_POST['id_notas_independientes'];
    $respuesta_c=$_POST['respuesta_c']; 
    $id_materia_por_paso=$_POST['id_materia_por_paso'];
    $id_informe_academico=$_SESSION['id_informe_academico'];
    $con1=0;
    $i=0;
    $tex="";
    foreach ($respuesta_c as $key ) {
        $i++;  
        if (isset($_POST['respuesta'.$i])) {

            $tex.="INSERT INTO `examen_respuesta` (`id_notas_independientes`, `id_examen_pregunta`, `respuesta`, `id_alumno`) VALUES ( '$id_notas_independientes', '".$_POST['pregunta'.$i]."', '".$_POST['respuesta'.$i]."', '$id_informe_academico');";
            if ($_POST['respuesta'.$i]===$key) {
                $con1++;
                
            }
        }
    } 
    $valor= 10/$i;
    $final=$valor*$con1;
    $t=round($final, 1);

    include "../../codes/rector/conexion.php";
     
   echo $sql="$tex UPDATE `materia_por_paso` SET `nota` = '$t' WHERE `materia_por_paso`.`id_materia_por_paso` = ".$id_materia_por_paso;
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
    
}
/*-------------------------------*/
function resultadoE()
{
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nota=$_POST['nota'];
    $alum=$_SESSION['id_informe_academico'];
   ?> 
     
         
    
         
 
    <style>
        .bien{
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
                border-radius: 12px;
        }
         
        .vacio{
            display: none;
        }
    </style>
   <div class="modal fade" id="ver"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(3, 64, 95, 0.3);">
                            <div class="modal-dialog modal-lg"   >
                                <div class="modal-content" >
                                    <div class="modal-header btn-primary">
                                        <nav style="font-size: 18px">Resultado
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button></nav>
                                    </div>
                                    <div class="modal-body "> 
                                            <?php
                                            $sql="SELECT examen_pregunta.*,q.respuesta from examen_pregunta LEFT JOIN (SELECT examen_pregunta.id, examen_respuesta.respuesta FROM `examen_pregunta` INNER JOIN examen_respuesta ON examen_respuesta.id_examen_pregunta=examen_pregunta.id WHERE examen_pregunta.id_notas_independientes=$id AND examen_respuesta.id_alumno=$alum) as q on q.id=examen_pregunta.id WHERE examen_pregunta.id_notas_independientes=$id GROUP BY examen_pregunta.id
    ";
                                            $sql1=$conexion->prepare($sql);
                                            $sql1->execute(array());
                                            $exa=$sql1->fetchAll();
                                            $n=0;
                                            $c=0;
                                            $inc=0;
                                            foreach($exa as $exa1){
                                                $n++;

                                                
                                                $clas1='class="padin"';
                                                $clas2='class="padin"';
                                                $clas3='class="padin"';
                                                $clas4='class="padin"'; 
                                                $flecha1='';
                                                $flecha2='';
                                                $flecha3='';
                                                $flecha4=''; 

                                                if (1==$exa1['respuestaCorecta']) {
                                                    
                                                    $clas1='class="bien padin"';
                                                    $flecha1='<i class="fa    fa-check" style="font-size: 17px;"></i>';
                                                 
                                                    
                                                }

                                                if (2==$exa1['respuestaCorecta'] ) {
                                                    
                                                    $clas2='class="bien padin"';
                                                    $flecha2='<i class="fa    fa-check" style="font-size: 17px;"></i>';
                                                  
                                                    
                                                }

                                                if (3==$exa1['respuestaCorecta'] ) {
                                                    
                                                    $clas3='class="bien padin"';
                                                    $flecha3='<i class="fa    fa-check" style="font-size: 17px;"></i>';
                                                  
                                                    
                                                }

                                                if (4==$exa1['respuestaCorecta']) {
                                                    
                                                    $clas4='class="bien padin"';
                                                    $flecha4='<i class="fa    fa-check" style="font-size: 17px;"></i>';

                                                    
                                                    
                                                }
                                                $id=0; 
                                                if ( $exa1['respuesta']==$exa1['respuestaCorecta'] ) {
                                                     
                                                    $id=1;

                                                    $color='#d4edda';
                                                    $color2='#155724';
                                                    $c++;
                                                    
                                                } 
                                                ///resultado malo


                                                if ($id==0) {
                                                    $color='#f8d7da';
                                                    $color2='#721c24';
                                                    $inc++
                                                ?>  
                                                    <style type="text/css">
                                                        #respuesta<?php echo $exa1['id'] ?><?php echo $exa1['respuesta'] ?>{
                                                            color: #721c24;
                                                            background-color: #f8d7da; 
                                                            border-radius: 12px;
                                                        }
                                                        #vacio<?php echo $exa1['id'] ?><?php echo $exa1['respuesta'] ?>{
                                                            display: block
                                                        }
                                                    </style>
                                                <?php 
                                                } ?>
                                                     
                                                <div class="row padin" style=" ">
                                                    <div class="table table-responsive" style="border: solid 2px <?php echo $color ?>;">
                                                        <div class="padin"  style="   background-color: <?php echo $color ?>;">

                                                                  <?php
                                                                    echo('<nav style="float: left;margin-right: 10px;">'.$n.'.</nav> '.$exa1['pregunta']); 
                                                                    ?>
                                                        </div>
                                                           
                                                            
                                                        <div <?php echo $clas1 ?> id='respuesta<?php echo $exa1['id'] ?>1'>
                                                                    <div  >
                                                                    
                                                                        <nav style="float: left;margin-right: 10px;">a.</nav>
                                                                        <?php
                                                                        echo($exa1['respuesta1']); 
                                                                        ?>
                                                                    </div>

                                                                    <?php   echo $flecha1 ?>
                                                                    <nav class="vacio" id="vacio<?php echo $exa1['id'] ?>1">
                                                                    <i class="fa   fa-close" style="font-size: 17px;"></i></nav>
                                                        </div> 

                                                        <div  <?php echo $clas2 ?> id='respuesta<?php echo $exa1['id'] ?>2'>
                                                                    <div >
                                                                    
                                                                        <nav style="float: left;margin-right: 10px;">b.</nav>
                                                                        <?php
                                                                        echo($exa1['respuesta2']); 
                                                                        ?>
                                                                    </div>

                                                                    <?php   echo $flecha2 ?> 
                                                                    <nav class="vacio" id="vacio<?php echo $exa1['id'] ?>2">
                                                                    <i class="fa   fa-close" style="font-size: 17px;"></i></nav>
                                                        </div>
                                                        <div <?php echo $clas3 ?> id='respuesta<?php echo $exa1['id'] ?>3'>
                                                                    <div >
                                                                    
                                                                        <nav style="float: left;margin-right: 10px;">c.</nav>
                                                                        <?php
                                                                        echo($exa1['respuesta3']); 
                                                                        ?>
                                                                    </div>
                                                                    <?php   echo $flecha3 ?>
                                                                    <nav class="vacio" id="vacio<?php echo $exa1['id'] ?>3">
                                                                    <i class="fa   fa-close" style="font-size: 17px;"></i></nav>
                                                               
                                                        </div>
                                                        <div <?php echo $clas4 ?> id='respuesta<?php echo $exa1['id'] ?>4'>
                                                                    <div >
                                                                    
                                                                        <nav style="float: left;margin-right: 10px;">d.</nav>
                                                                        <?php
                                                                        echo($exa1['respuesta4']); 
                                                                        ?>
                                                                    </div>

                                                                    <?php   echo $flecha4 ?>
                                                                    <nav class="vacio" id="vacio<?php echo $exa1['id'] ?>4">
                                                                    <i class="fa   fa-close" style="font-size: 17px;"></i></nav>
                                                        </div>
                                                        <nav style="    color: <?php echo $color2 ?>;margin: 8px;">
                                                            <?php 
                                                            if ($id==1) {
                                                                echo 'Correcto';
                                                            }else{
                                                                echo 'Incorrecto';
                                                            }
                                                             ?>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            
                                            ?>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" style=" ">Close</button>
                                        </div> 
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
    <button type="button" class="btn btn-warning"  >  N° preguntas <?php echo $n ?>  </button>
    <button type="button" class="btn btn-success" >   Correctas <?php echo $c ?></button>
    <button type="button" class="btn btn-danger" >Incorrecta <?php echo $inc ?></button>
    <button type="button" class="btn btn-primary" >Definitiva <?php echo $nota ?></button>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ver">Ver prueba</button>
<?php
}


?>
