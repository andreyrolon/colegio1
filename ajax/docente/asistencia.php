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


 
 
function tabla1(){
    include "../../codes/rector/conexion.php";
    $id=$_SESSION['Id_Doc'];
    $numero=$_SESSION['numero']; 

 


    setlocale(LC_TIME, 'es_CO.UTF-8'); 

    date_default_timezone_set ('America/Bogota');  
    $fecha=strftime("%F");
  
    $dia=strftime("%A");
    if ('lunes'==$dia  or 'Lunes'==$dia  or 'monday'==$dia  or 'Monday'==$dia) {
         $valor=1;
    }
    if ('martes'==$dia  or 'Martes'==$dia  or 'Tuesday'==$dia  or 'tuesday'==$dia) {
         $valor=2;
    }
    if ('Mircoles'==$dia  or 'mircoles'==$dia  or 'Wednesday'==$dia  or 'wednesday'==$dia) {
         $valor=3;
    }
    if ('jueves'==$dia  or 'Jueves'==$dia  or 'Thursday'==$dia  or 'thursday'==$dia) {
         $valor=4;
    }
    if ('Viernes'==$dia  or 'viernes'==$dia  or 'Friday'==$dia  or 'friday'==$dia) {
         $valor=5;
    }
    if ('Sábado'==$dia  or 'sábado'==$dia  or 'Saturday'==$dia  or 'saturday'==$dia) {
         $valor=6;
    }
    if ('domingo'==$dia  or 'Domingo'==$dia  or 'sunday'==$dia  or 'Sunday'==$dia) {
         $valor=7;
    }
    $id_area='';
    $titular=''; 
    $ano=date("Y");
     
    $con0="SELECT grado_sede.titular,grado.numero,  horario.hora , are_grado_sede.id_area,area.nombre, horario.dias  ,grado_sede.id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso,CURRENT_TIME as AA    from grado,grado_sede,horario,are_grado_sede,area WHERE are_grado_sede.id__docente='$id' AND grado_sede.id=are_grado_sede.id_grado_sede and horario.id_area_grado_sede=are_grado_sede.id_area_grado_sede and are_grado_sede.id_area=area.id_area AND CURRENT_TIME>=horario.hora_inicio and CURRENT_TIME<=horario.hora_fin and horario.dias=$valor and grado.id_grado=grado_sede.id_grado ";
    $con0=$conexion->prepare($con0);
    $con0->execute(array());
    $coun0=$con0->rowCount(); 
    foreach ($con0 as  $value) {
         $hora_cp=$value['AA'];
        $numero_grado=$value['numero']; 
        $id_area=$value['id_area'];
        $dias=$value['dias'];
        $area=mb_convert_case($value['nombre'], MB_CASE_TITLE, "UTF-8");
        $id_grado=$value['id_grado'];
        $id_jornada_sede=$value['id_jornada_sede'];
        $id_curso=$value['id_curso'];
        $titular=$value['titular'];
    } 
    $id_arema1='and inasistencia.id_area='.$id_area;
    if ($titular==$_SESSION['Id_Doc']) {
        $id_arema='';
    }else{

        $id_arema='and inasistencia.id_area='.$id_area;
    }
    //////si esta dictando una  materia  en este momento
    if ($coun0>0) {

        
echo
  

              $con3="SELECT dd.c,ddd.inasistencia, informeacademico.estado_aprovado, alumnos.foto, alumnos.nombre, alumnos.apellido, alumnos.id_alumnos, informeacademico.id_informe_academico FROM informeacademico LEFT JOIN alumnos on alumnos.id_alumnos=informeacademico.id_alumno LEFT JOIN

(SELECT COUNT(inasistencia.id_informe_academico)as c, id_informe_academico from inasistencia WHERE inasistencia.inasistencia=1 and inasistencia.ano='$ano' and inasistencia.tecnica='0' and inasistencia.id_area='$id_area' GROUP by inasistencia.id_informe_academico)as dd on dd.id_informe_academico=informeacademico.id_informe_academico LEFT JOIN

(SELECT inasistencia.inasistencia, id_informe_academico from inasistencia WHERE    inasistencia.tecnica='0' and inasistencia.fecha='$fecha' and inasistencia.id_area='$id_area')as ddd on ddd.id_informe_academico=informeacademico.id_informe_academico 


WHERE   informeacademico.id_grado='$id_grado' AND informeacademico.id_curso='$id_curso' AND informeacademico.id_jornada_sede='$id_jornada_sede' and informeacademico.ano='$ano' GROUP by informeacademico.id_informe_academico ORDER BY alumnos.apellido"; 
        $con1=$conexion->prepare($con3);
        $con1->execute(array());
        $count=$con1->rowCount();
        $con2=$con1->fetchAll();
         
       
        ?>
     
        <?php if($count > 0){ 
    
            $uno=0;
            ?>
            <input type="hidden" value="0" id="tecnic">
            <input type="hidden" value="<?php echo $titular ?>" id="titular">
            <input type="hidden" value="<?php echo $id_grado  ?>" id="id_grado1">
            <input type="hidden" value="<?php echo $id_jornada_sede  ?>" id="id_jornada_sede1">
            <input type="hidden" value="<?php echo $id_curso  ?>" id="id_curso1">
            <input type="hidden" value="<?php echo $id_area  ?>" id="id_area1">
            <div style=" padding-bottom: 15px;padding-top: 5px; background-color:#3c8dbc;color: #fff "><div style="margin-left: 13px;font-size: 19px">Clase de <?php echo $area ?></div></div><br>
        
           <div id="_MSG_"></div>
           <a   class="myButton" style="cursor: pointer;" onclick="consultar_radicacion(<?php echo $titular .",". $id_jornada_sede .",". $id_grado .",". $id_curso .",". $id_area   ?>,0,0)"  data-target="#radicacion" data-toggle="modal"
           >Remitir estudiantes</a>
            <br>

           
            <form action="" method="post">
                <div class="table-responsive" style="padding: 5px">
                    <table class="table table-hover"> 
                            <tr>
                                <th style="width:20px;">N°</th>
                                <th style="padding-left: 40px;padding-right: 40px">Foto</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Asistencia</th>
                                <th>Inasistencia</th> 
                                <th>mostrar</th>
                            </tr> 
                        <tbody>
                            <?php
                            $cont=0;
                            foreach($con2 as $key){
                                $cont++;
                                $uno=$uno+1;
                                

                                  ?>
                          
                            <tr class="ee"> 
                                <td>
                                    <input type="hidden" id="inasistencia<?php echo $key['id_informe_academico']  ?>">
                                    <h4>
                                        <?php echo($cont); ?>
                                    </h4>
                                </td>
                               <td>

                                    <img    class="profile-user-img img-responsive img-circle" src="<?php  echo $key['foto']  ?>" alt="User profile picture"> 
                                </td>
                                <td><br><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>   
                                </td>
                                <td> <br><?php 
                                    if ($key['estado_aprovado']==2){
                                        echo'<span class="btn btn-warning ">Retirado</span>';
                                     } 
                                    if ($key['estado_aprovado']==3) {
                                         echo'<span class="btn btn-danger ">Desertor</span>';
                                     }if($key['estado_aprovado']==0){
                                        echo'<span class="btn btn-info">Cursando</span>';
                                    } ?>
                                 </td>
                                 <td><br>  
                                    <select style="width: 145px" name="" class="form-control" id="asis<?php echo $key['id_informe_academico']  ?>" onchange=" var asis=document.getElementById('asis<?php echo $key['id_informe_academico']  ?>').value;  
                                        var fecha='<?php  echo $fecha ?>';
                                        var id_area='<?php  echo $id_area ?>'; 
                                        var id_informe_academico=<?php echo $key['id_informe_academico']  ?>; 
                                        var periodo='<?php echo $_SESSION['numero']; ?>';
                                        var hora='<?php echo $hora_cp ?>'; 
                                        var dias='<?php echo $dias ?>';
                                        var area='<?php echo $area ?>';
                                        var tecnica='0';
                                        tomar_asistencia(dias,tecnica,hora,asis,fecha,id_area,id_informe_academico,periodo,area);

                                        " > <?php 
                                        $t=array( '<option value="0">Asistencia</option>','<option value="1">Inasistencia</option>','<option value="2">Inasistencia J</option>','<option value="3">Retardos</option>','<option value="4">Retardos J</option>');
                                        $tt=$key['inasistencia'];
                                        echo $t[$tt];
                                        foreach ($t as $keys ) {
                                            if ($t[$tt]==$keys) {
                                                # code...
                                            }else{
                                                echo $keys;
                                            }

                                        } ?>
                                    </select>
                                </td>
                                <td id="td1<?php echo $key['id_informe_academico']  ?>"><br><center><span class="btn btn-default"><?php echo $key['c']  +0 ?></span></center></td > 
                   
                                
                                <td><br>
                                    <a data-toggle="modal" data-target="#my" onclick="
                                    var id_informe_academico=<?php echo $key['id_informe_academico']  ?>; 
                                    var id_area=<?php echo $id_area ?>;
                                    var titular=<?php echo($titular) ?>; 




     
                                    var tec=0;
                                    mostrar2(tec,id_informe_academico,id_area,titular);  ">
                                        <img width="40" style="     "  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTUuOTgxIDU1Ljk4MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTUuOTgxIDU1Ljk4MTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiMxMkJCRDQiIGQ9Ik00NC42MjcsNTJIOS4zNTRjLTQuNjE5LDAtOC4zNjQtMy43NDUtOC4zNjQtOC4zNjRWOC4zNjRDMC45OTEsMy43NDUsNC43MzUsMCw5LjM1NCwwaDM1LjI3MiAgICBjNC42MTksMCw4LjM2NCwzLjc0NSw4LjM2NCw4LjM2NHYzNS4yNzJDNTIuOTkxLDQ4LjI1NSw0OS4yNDYsNTIsNDQuNjI3LDUyeiIgZGF0YS1vcmlnaW5hbD0iIzNBQkNBNyIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzNBQkNBNyI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDQuOTkxLDE0aC0xOGMtMC41NTMsMC0xLTAuNDQ3LTEtMXMwLjQ0Ny0xLDEtMWgxOGMwLjU1MywwLDEsMC40NDcsMSwxUzQ1LjU0MywxNCw0NC45OTEsMTR6IiBkYXRhLW9yaWdpbmFsPSIjRkZGRkZGIiBjbGFzcz0iIj48L3BhdGg+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik00NC45OTEsMjhoLTE4Yy0wLjU1MywwLTEtMC40NDctMS0xczAuNDQ3LTEsMS0xaDE4YzAuNTUzLDAsMSwwLjQ0NywxLDFTNDUuNTQzLDI4LDQ0Ljk5MSwyOHoiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiIGNsYXNzPSIiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTQ0Ljk5MSw0MmgtMThjLTAuNTUzLDAtMS0wLjQ0Ny0xLTFzMC40NDctMSwxLTFoMThjMC41NTMsMCwxLDAuNDQ3LDEsMVM0NS41NDMsNDIsNDQuOTkxLDQyeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDE3Yy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDE2Ljg4MSwxMy4zNDQsMTcsMTMuMDYxLDE3eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDMxYy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDMwLjg4MSwxMy4zNDQsMzEsMTMuMDYxLDMxeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDQ1Ljk5OWMtMC4yMDksMC0wLjQyLTAuMDY1LTAuNTk5LTAuMkw3Ljg5MSw0Mi4zN2MtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzMSwxLjM5OS0wLjJsMy44MjIsMi44NjZsNi4yNDgtNy4yODdjMC4zNTgtMC40MiwwLjk5Mi0wLjQ2OCwxLjQwOS0wLjEwOCAgICBjMC40MiwwLjM1OSwwLjQ2OSwwLjk5LDAuMTA4LDEuNDA5bC02Ljg1Nyw3Ljk5OUMxMy42MjUsNDUuODgsMTMuMzQ0LDQ1Ljk5OSwxMy4wNjEsNDUuOTk5eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJPC9nPgoJPGc+CgkJPGNpcmNsZSBzdHlsZT0iZmlsbDojRDBFOEY5OyIgY3g9IjQwLjc2OCIgY3k9IjQwLjc5NiIgcj0iOS43OTYiIGRhdGEtb3JpZ2luYWw9IiNEMEU4RjkiPjwvY2lyY2xlPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNFQUY2RkQ7IiBkPSJNNDQuMzIxLDMxLjY3NEwzMS42NDcsNDQuMzQ4YzAuNzA2LDEuODEsMS45MywzLjM1NywzLjQ5NSw0LjQ1OUw0OC43OCwzNS4xNyAgICBDNDcuNjc4LDMzLjYwNCw0Ni4xMzEsMzIuMzgsNDQuMzIxLDMxLjY3NHoiIGRhdGEtb3JpZ2luYWw9IiNFQUY2RkQiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojQjFEM0VGOyIgZD0iTTU0LjcxMyw1NC4yOTFsLTUuOTctNi4yNDRjMS43NDYtMS45MTksMi44Mi00LjQ1OCwyLjgyLTcuMjUxQzUxLjU2NCwzNC44NDMsNDYuNzIxLDMwLDQwLjc2OCwzMCAgICBzLTEwLjc5Niw0Ljg0My0xMC43OTYsMTAuNzk2czQuODQzLDEwLjc5NiwxMC43OTYsMTAuNzk2YzIuNDQyLDAsNC42ODktMC44MjQsNi40OTktMi4xOTZsNi4wMDEsNi4yNzYgICAgYzAuMTk2LDAuMjA2LDAuNDU5LDAuMzA5LDAuNzIzLDAuMzA5YzAuMjQ5LDAsMC40OTctMC4wOTIsMC42OTEtMC4yNzdDNTUuMDgxLDU1LjMyMyw1NS4wOTUsNTQuNjg5LDU0LjcxMyw1NC4yOTF6ICAgICBNMzEuOTcyLDQwLjc5NmMwLTQuODUsMy45NDYtOC43OTYsOC43OTYtOC43OTZzOC43OTYsMy45NDYsOC43OTYsOC43OTZzLTMuOTQ2LDguNzk2LTguNzk2LDguNzk2UzMxLjk3Miw0NS42NDYsMzEuOTcyLDQwLjc5NnoiIGRhdGEtb3JpZ2luYWw9IiNCMUQzRUYiIGNsYXNzPSIiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />
                                    </a>
                                </td>
                               
                            </tr>
                            <?php
                            }
                            ?> 
                        </tbody>
                    </table><br> 
                </div> 
            </form>

            <?php 
        }else { ?>
            <script>
                swal("No hay alumnos registrados")
            </script><?php 
        }

    ////////este else es para ver si esta dictando una       
    }else{

        $id_periodo=$_SESSION['numero'];
        $con0="    

        SELECT grado.numero as numero_grado, horario_competencias.dia,horario_competencias.hora_inicio,horario_competencias.id_horario_competencias, grado_sede.titular, competencias.nombre,competencias.codigo,grado_sede.id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso,CURRENT_TIME as AA  FROM tecnica_grado_sede,competencias,horario_competencias,grado_sede,grado   WHERE competencias.id_docente=$id and  competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and grado_sede.id=tecnica_grado_sede.id_grado_sede and horario_competencias.id_competencias=competencias.id_competencias  AND CURRENT_TIME>=horario_competencias.hora_inicio and CURRENT_TIME<=horario_competencias.hora_fin and horario_competencias.dia='$valor' and competencias.id_periodo=$id_periodo and grado_sede.id_grado=grado.id_grado  ";
        $con0=$conexion->prepare($con0);
        $con0->execute(array());
        $coun0=$con0->rowCount(); 
        foreach ($con0 as  $value) {
            $numero_grado=$value['numero_grado'];
            $hora_cp=$value['AA']; 
            $id_area=$value['codigo'];
            $dias=$value['dia'];
            $area=mb_convert_case($value['nombre'], MB_CASE_TITLE, "UTF-8") ;
            $id_grado=$value['id_grado'];
            $id_jornada_sede=$value['id_jornada_sede'];
            $id_curso=$value['id_curso'];
            $titular=$value['titular']; 
        } 

            $id_arema='and inasistencia.id_area='.$id_area;
        
        //////si esta dictando una  materia  en este momento
        if ($coun0>0) {

            
 
      

         echo     $con3="SELECT dd.c,ddd.inasistencia,  informeacademico.estado_aprovado,  alumnos.foto, alumnos.nombre, alumnos.apellido, alumnos.id_alumnos, informeacademico.id_informe_academico FROM informeacademico LEFT JOIN alumnos on alumnos.id_alumnos=informeacademico.id_alumno LEFT JOIN

(SELECT COUNT(inasistencia.id_informe_academico)as c, id_informe_academico from inasistencia WHERE inasistencia.inasistencia=1 and inasistencia.ano='$ano' and    inasistencia.tecnica='$id_area' GROUP by inasistencia.id_informe_academico)as dd on dd.id_informe_academico=informeacademico.id_informe_academico LEFT JOIN

(SELECT inasistencia.inasistencia, id_informe_academico from inasistencia WHERE     inasistencia.fecha='$fecha' and inasistencia.tecnica='$id_area')as ddd on ddd.id_informe_academico=informeacademico.id_informe_academico 


WHERE   informeacademico.id_grado='$id_grado' AND informeacademico.id_curso='$id_curso' AND informeacademico.id_jornada_sede='$id_jornada_sede' and informeacademico.ano='$ano' GROUP by informeacademico.id_informe_academico ORDER BY alumnos.apellido"; 
            $con1=$conexion->prepare($con3);
            $con1->execute(array());
            $count=$con1->rowCount();
            $con2=$con1->fetchAll();
             
           
            ?>
         
            <?php if($count > 0){ 
                
                ?>

                <input type="hidden" value="2" id="tecnic">
                <input type="hidden" value="<?php echo $titular ?>" id="titular">
                <input type="hidden" value="<?php echo $id_grado  ?>" id="id_grado1">
                <input type="hidden" value="<?php echo $id_jornada_sede  ?>" id="id_jornada_sede1">
                <input type="hidden" value="<?php echo $id_curso  ?>" id="id_curso1">
                <input type="hidden" value="<?php echo $id_area  ?>" id="id_area1">

                <div style=" padding-bottom: 15px;padding-top: 5px; background-color:#3c8dbc;color: #fff "><div style="margin-left: 13px;font-size: 19px">Clase de <?php echo $area?></div></div><br>
        

           <div id="_MSG_"></div>
               
           <a   class="myButton" style="cursor: pointer;" onclick="consultar_radicacion(<?php echo $titular .",". $id_jornada_sede .",". $id_grado .",". $id_curso .",". $id_area   ?>,1,0)"  data-target="#radicacion" data-toggle="modal"
           >Remitir estudiantes</a>
                <br>
                 
                <form action="" method="post">
                    <div class="table-responsive" >
                        <table class="table table-bordered">
                                <tr>
                                <th style="width:20px;">N°</th>
                                <th style="padding-left: 40px;padding-right: 40px">Foto</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Asistencia</th>
                                <th>Inasistencia</th> 
                                <th>mostrar</th>
                            </tr>  
                            <tbody>
                                <?php
                                $cont=0;$uno=0;
                                foreach($con2 as $key){
                                    $cont++;
                                    $uno=$uno+1;
                                    

                                      ?>     
                                <tr class="ee"> 
                                    <td>
                                    <input type="hidden" id="inasistencia<?php echo $key['id_informe_academico']  ?>">
                                    <h4>
                                        <?php echo($cont); ?>
                                    </h4>
                                </td>
                               <td>

                                    <img    class="profile-user-img img-responsive img-circle" src="<?php echo $key['foto'] ?>" alt="User profile picture"> 
                                </td>
                                <td><br><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>   
                                </td>
                                <td> <br><?php 
                                    if ($key['estado_aprovado']==2) {
                                        echo'<span class="btn btn-warning ">Retirado</span>';
                                     } 
                                    if ($key['estado_aprovado']==3) {
                                         echo'<span class="btn btn-danger ">Desertor</span>';
                                     }if($key['estado_aprovado']==0){
                                        echo'<span class="btn btn-info">Cursando</span>';
                                    } ?>
                                 </td>
                                    <td><br>
                                    <select style="width: 145px" name="" class="form-control" id="asis<?php echo $key['id_informe_academico']  ?>" onchange=" var asis=document.getElementById('asis<?php echo $key['id_informe_academico']  ?>').value;  
                                        var fecha='<?php  echo $fecha ?>';
                                        var id_area='<?php  echo $id_area ?>'; 
                                        var id_informe_academico=<?php echo $key['id_informe_academico']  ?>; 
                                        var periodo='<?php echo $_SESSION['numero']; ?>';
                                        var hora='<?php echo $hora_cp ?>'; 
                                        var dias='<?php echo $dias ?>';
                                        var area='<?php echo $area ?>';
                                        var tecnica='1';
                                        tomar_asistencia(dias,tecnica,hora,asis,fecha,id_area,id_informe_academico,periodo,area);

                                        " > <?php 
                                        $t=array( '<option value="0">Asistencia</option>','<option value="1">Inasistencia</option>','<option value="2">Inasistencia J</option>','<option value="3">Retardos</option>','<option value="4">Retardos J</option>');
                                        $tt=$key['inasistencia'];
                                        echo $t[$tt];
                                        foreach ($t as $keys ) {
                                            if ($t[$tt]==$keys) {
                                                # code...
                                            }else{
                                                echo $keys;
                                            }

                                        } ?>
                                    </select>
                                    </td>
                                    <td id="td1<?php echo $key['id_informe_academico']  ?>"><br><center><span class="btn btn-default"><?php echo $key['c']  +0 ?></span></center></td > 
                                    
                                    <td><br>
                                        <a data-toggle="modal" data-target="#my" onclick="
                                    
                                    var id_informe_academico=<?php echo $key['id_informe_academico']  ?>; 
                                    var id_area=<?php echo $id_area ?>;
                                    var titular=<?php echo($titular) ?>; 




     
                                    var tec=1;

                                    mostrar2(tec,id_informe_academico,id_area,titular); 
                                        ">
                                            <img width="40"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTUuOTgxIDU1Ljk4MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTUuOTgxIDU1Ljk4MTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiMxMkJCRDQiIGQ9Ik00NC42MjcsNTJIOS4zNTRjLTQuNjE5LDAtOC4zNjQtMy43NDUtOC4zNjQtOC4zNjRWOC4zNjRDMC45OTEsMy43NDUsNC43MzUsMCw5LjM1NCwwaDM1LjI3MiAgICBjNC42MTksMCw4LjM2NCwzLjc0NSw4LjM2NCw4LjM2NHYzNS4yNzJDNTIuOTkxLDQ4LjI1NSw0OS4yNDYsNTIsNDQuNjI3LDUyeiIgZGF0YS1vcmlnaW5hbD0iIzNBQkNBNyIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzNBQkNBNyI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDQuOTkxLDE0aC0xOGMtMC41NTMsMC0xLTAuNDQ3LTEtMXMwLjQ0Ny0xLDEtMWgxOGMwLjU1MywwLDEsMC40NDcsMSwxUzQ1LjU0MywxNCw0NC45OTEsMTR6IiBkYXRhLW9yaWdpbmFsPSIjRkZGRkZGIiBjbGFzcz0iIj48L3BhdGg+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik00NC45OTEsMjhoLTE4Yy0wLjU1MywwLTEtMC40NDctMS0xczAuNDQ3LTEsMS0xaDE4YzAuNTUzLDAsMSwwLjQ0NywxLDFTNDUuNTQzLDI4LDQ0Ljk5MSwyOHoiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiIGNsYXNzPSIiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTQ0Ljk5MSw0MmgtMThjLTAuNTUzLDAtMS0wLjQ0Ny0xLTFzMC40NDctMSwxLTFoMThjMC41NTMsMCwxLDAuNDQ3LDEsMVM0NS41NDMsNDIsNDQuOTkxLDQyeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDE3Yy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDE2Ljg4MSwxMy4zNDQsMTcsMTMuMDYxLDE3eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDMxYy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDMwLjg4MSwxMy4zNDQsMzEsMTMuMDYxLDMxeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDQ1Ljk5OWMtMC4yMDksMC0wLjQyLTAuMDY1LTAuNTk5LTAuMkw3Ljg5MSw0Mi4zN2MtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzMSwxLjM5OS0wLjJsMy44MjIsMi44NjZsNi4yNDgtNy4yODdjMC4zNTgtMC40MiwwLjk5Mi0wLjQ2OCwxLjQwOS0wLjEwOCAgICBjMC40MiwwLjM1OSwwLjQ2OSwwLjk5LDAuMTA4LDEuNDA5bC02Ljg1Nyw3Ljk5OUMxMy42MjUsNDUuODgsMTMuMzQ0LDQ1Ljk5OSwxMy4wNjEsNDUuOTk5eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJPC9nPgoJPGc+CgkJPGNpcmNsZSBzdHlsZT0iZmlsbDojRDBFOEY5OyIgY3g9IjQwLjc2OCIgY3k9IjQwLjc5NiIgcj0iOS43OTYiIGRhdGEtb3JpZ2luYWw9IiNEMEU4RjkiPjwvY2lyY2xlPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNFQUY2RkQ7IiBkPSJNNDQuMzIxLDMxLjY3NEwzMS42NDcsNDQuMzQ4YzAuNzA2LDEuODEsMS45MywzLjM1NywzLjQ5NSw0LjQ1OUw0OC43OCwzNS4xNyAgICBDNDcuNjc4LDMzLjYwNCw0Ni4xMzEsMzIuMzgsNDQuMzIxLDMxLjY3NHoiIGRhdGEtb3JpZ2luYWw9IiNFQUY2RkQiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojQjFEM0VGOyIgZD0iTTU0LjcxMyw1NC4yOTFsLTUuOTctNi4yNDRjMS43NDYtMS45MTksMi44Mi00LjQ1OCwyLjgyLTcuMjUxQzUxLjU2NCwzNC44NDMsNDYuNzIxLDMwLDQwLjc2OCwzMCAgICBzLTEwLjc5Niw0Ljg0My0xMC43OTYsMTAuNzk2czQuODQzLDEwLjc5NiwxMC43OTYsMTAuNzk2YzIuNDQyLDAsNC42ODktMC44MjQsNi40OTktMi4xOTZsNi4wMDEsNi4yNzYgICAgYzAuMTk2LDAuMjA2LDAuNDU5LDAuMzA5LDAuNzIzLDAuMzA5YzAuMjQ5LDAsMC40OTctMC4wOTIsMC42OTEtMC4yNzdDNTUuMDgxLDU1LjMyMyw1NS4wOTUsNTQuNjg5LDU0LjcxMyw1NC4yOTF6ICAgICBNMzEuOTcyLDQwLjc5NmMwLTQuODUsMy45NDYtOC43OTYsOC43OTYtOC43OTZzOC43OTYsMy45NDYsOC43OTYsOC43OTZzLTMuOTQ2LDguNzk2LTguNzk2LDguNzk2UzMxLjk3Miw0NS42NDYsMzEuOTcyLDQwLjc5NnoiIGRhdGEtb3JpZ2luYWw9IiNCMUQzRUYiIGNsYXNzPSIiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />
                                        </a>
                                    </td>
                                   
                                </tr>
                                <?php
                                }
                                ?> 
                            </tbody>
                        </table><br> 
                    </div> 
                </form>
             



                <?php 
            }else { ?>
                <script>
                    swal("No hay alumnos registrados")
                </script><?php 
            }  
        }else{ ?> <br> 
            <div class="alert" role="alert" style=" margin: 10PX;font-size: 19px;   color: #45a197;background-color: #e3f2fd;border-color: #82c4f8;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i>  En este momento no tienes una que dar clase   <br> </div> <br>
            <script type="text/javascript">
                document.getElementById('tabla1').innerHTML='  <div class="alert" role="alert" style="margin: 13px; color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> no se encuentra registrado ningun estudiante remetido a proceso de inasistencia. </div> <br>';
            </script>
            <?php 

         
        }

     
    }

   
     
}
 function remision(){ 
    include '../conexion.php';                    
    $id_area=$_POST['id_area'];
     $id_curso=$_POST['id_curso'];
     $id_grado=$_POST['id_grado'];
        $id_jornada_sede=$_POST['id_jornada_sede']; 
    $numero_grado=$_POST['numero_grado']; 
    $id_grado=$_POST['id_grado']; 
    $ano=date('Y');
    $max=$_SESSION['max_inasistencia'];
    $numero=$_SESSION['numero'];
    $person=$_SESSION['Id_Doc'];
    $nom=0;
    $id_person=0;

        $rtaq='';
        $rta= '';
    if ($numero_grado>5) {
        $rta= ' and inasistencia.id_area='.$id_area;
        $rtaq= ' and remisiones.id_area='.$id_area;
    } 

      
    
      $er=" INSERT INTO `remisiones` ( `id_informe_academico`, `id_docente`, `tipo_de_radicacion`, `tema`, `vista`, `detalle_solucion`, `solucionado`, `id_periodo`, `ano`, `id_area`, `sigue`)  
    SELECT informeacademico.id_informe_academico,'$person','2','El estudiante paso el limite de inasistencias','0','','0' ,'$numero','$ano','$id_area','1'   from informeacademico,inasistencia  WHERE informeacademico.id_grado='$id_grado'  AND informeacademico.id_curso=$id_curso    AND informeacademico.id_jornada_sede=$id_jornada_sede   and informeacademico.ano='$ano'  AND  inasistencia.id_informe_academico=informeacademico.id_informe_academico  and inasistencia.ano='$ano'  $rta     and inasistencia.inasistencia=1  and informeacademico.id_informe_academico not in( 
    SELECT remisiones.id_informe_academico from remisiones WHERE ( remisiones.ano='$ano' and remisiones.sigue='0') or (remisiones.ano='$ano'  $rtaq and remisiones.tipo_de_radicacion='2') )

    GROUP by informeacademico.id_informe_academico  HAVING COUNT(informeacademico.id_informe_academico)>='$max'";
    $erq=$conexion->prepare($er);
    $erq->execute(array()); 
    $recupera1 =$conexion->lastInsertId() ;
    if ($recupera1) {
        echo  $nom1='  información!  los estudiantes que superaron el límite de ausencia están remitodos  a procesos asistencial.';     
    }else{
        echo $nom1='   actualmente no tines ningun estudiante que allá excedido el limite de inasistencia.';
    }
}

    
 
                            
       

//muestra la lista de inacistencia  
function mostrar2(){ 
    include '../conexion.php';  
    $busca=$_POST["busca"]; 
    if ($_POST['titular']==$_SESSION['Id_Doc']   ) { 

        $er="SELECT inasistencia.tecnica, DAYNAME(inasistencia.fecha) AS diasn,inasistencia.inasistencia, inasistencia.id_inasistencia,inasistencia.id_periodo,inasistencia.fecha,inasistencia.hora,inasistencia.dias, inasistencia.materia as nombre from inasistencia WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' $busca ORDER BY inasistencia.fecha";
     
    }  
    if ($_POST['titular']!=$_SESSION['Id_Doc']  and  $_POST['tec']==0 ) { 

        $er="SELECT DAYNAME(inasistencia.fecha) AS diasn,inasistencia.inasistencia, inasistencia.id_inasistencia,inasistencia.id_periodo,inasistencia.fecha,inasistencia.hora,inasistencia.dias,inasistencia.materia as nombre from inasistencia  WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' and   inasistencia.id_area='".$_POST['id_area']."' $busca GROUP by inasistencia.id_inasistencia ORDER BY inasistencia.fecha";
     
    } 
    if ($_POST['titular']!=$_SESSION['Id_Doc']  and  $_POST['tec']>0) { 

        $er="SELECT DAYNAME(inasistencia.fecha) AS diasn,inasistencia.inasistencia, inasistencia.id_inasistencia,inasistencia.id_periodo,inasistencia.fecha,inasistencia.hora,inasistencia.dias,area.nombre from inasistencia  WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."'        $busca ORDER BY inasistencia.fecha";
    

    }   
    $erq=$conexion->prepare($er);
    $erq->execute(array()); 
    $nroProductos=$erq->rowCount();  

    ?>  
    
    <script type="text/javascript">
        document.getElementById('qwq').innerHTML='<?php echo $nroProductos ?>';
    </script>
    <input type="hidden" value="<?php echo $_POST['id_informe_academico']  ?>" id='id_informe_academicov'>
    <input type="hidden" value="<?php echo $_POST['id_area']  ?>" id='id_areav'>
    <input type="hidden" value="<?php echo $_POST['titular']  ?>" id='titularv'> 
    <input type="hidden" value="<?php echo $_POST['tec']  ?>" id='tecxx'> 
    <div id="_MSG2_"></div>
  
    <table class="table table-bordered"> 
            <tr>
                <th>Periodo</th>
                <th>Fecha de registros</th>
                <th>Hora </th>
                <th>Dia</th> 
                <th>Materia</th> 
                <th style="">Lista</th>
                <?php if ($_SESSION['actualizar_asistencia']==0) {?>

                <th>Eliminar</th><?php  
                } ?>

                
            </tr> 
        <tbody  >

            
            <?php foreach ($erq as $key  ) { ?>
            <tr class="ee" id="fialo<?php echo $key['id_inasistencia']  ?>">
                <td>
                    <?php echo $key['id_periodo'] ?>
                <td>
                    <?php echo $key['fecha'] ?> 
                </td> 


                <td> 
                    <?php echo $key['hora'] ; ?>
                </td>
                <td>

                        <?php     
                        $variable1=array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                        $variablea=array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'); 
                        $diaq=$key['diasn']; 
                        foreach ($variable1 as $key1 ) { 
                            if ($diaq===$key1  ) {                  
                                  $IO=array_search($key1,$variable1);
                                  $ry=  $variablea[$IO] ;
                            }  
                        }?>
                        <?php echo $ry ?> 
                     
                </td>
              
                <td> 
                    <?php echo $key['nombre'] ?> 
                <td> 
                    <select name=""  style="width: 140px" class="form-control" id="asis1q<?php echo $key['id_inasistencia']  ?>"  <?php if ($_SESSION['actualizar_asistencia']==0) {?> onchange="
                    var id_inasistencia=<?php echo $key['id_inasistencia']  ?>;
                    var asis=document.getElementById('asis1q<?php echo $key['id_inasistencia']  ?>').value;
                     actualizar_asisten(id_inasistencia,asis); " <?php }else{ echo "disabled";} ?>>    <?php 
                                $t=array( '<option value="0" disabled>Asistencia</option>','<option value="1">Inasistencia</option>','<option value="2">Inasistencia J</option>','<option value="3">Retardos</option>','<option value="4">Retardos J</option>');
                                $tt=$key['inasistencia'];
                                echo $t[$tt];
                                foreach ($t as $keys ) {
                                    if ($t[$tt]==$keys) {
                                        # code...
                                    }else{
                                        echo $keys;
                                    }

                                } ?>
                            </select>
                </td>
                <?php if ($_SESSION['actualizar_asistencia']==0) {?> 
                <td>
                    <a style="top: -8px" data-title="Eliminar inasistencia" onclick="var r = confirm('Está  seguro de eliminar esté registro!');
                    if (r == true) {   
                        var id_inasistencia=<?php echo $key['id_inasistencia']  ?>;
                        eliminar_re11(id_inasistencia); document.getElementById('fialo<?php echo $key['id_inasistencia']  ?>').style.display='none'; 
                        let num=document.getElementById('qwq').innerHTML;
                        document.getElementById('qwq').innerHTML=num-1;
                         
                    } else {
                        return;
                    }">
                        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
                    </a>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>    
<?php
} 

function actualizar_asisten() {
    include '../conexion.php';  
     
   
       echo     $con ="UPDATE inasistencia SET inasistencia = '".$_POST['asis']."' WHERE inasistencia.id_inasistencia='".$_POST['id_inasistencia']."'";
            $con1q=$conexion->prepare($con);
            $con1q->execute(array()); 
      
      
}

function eliminar_remision(){
    include '../conexion.php'; 
    $er="DELETE FROM remisiones WHERE    remisiones.id_remisiones= '".$_POST['id']."'  ";
    $erq=$conexion->prepare($er);
    $erq->execute(array());
}


function eliminar_re1(){
    include '../conexion.php'; 
    $er="DELETE FROM `inasistencia` WHERE     `inasistencia`.`id_inasistencia` = '".$_POST['id_inasistencia']."'  ";
    $erq=$conexion->prepare($er);
    $erq->execute(array());
}
function inasistencia(){
    include '../conexion.php';
    $ina1=0;
    $ina=0;
    $er="SELECT inasistencia.id_inasistencia, inasistencia.inasistencia,inasistencia.justificacion_inacistencia,inasistencia.asistencia from inasistencia WHERE `inasistencia`.`fecha` =  '".$_POST['fecha']."'  and  `inasistencia`.`id_area` =  '".$_POST['id_area']."' and inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' ".$_POST['id_arema']." ";
    $erq=$conexion->prepare($er);
    $erq->execute(array());
    foreach ($erq as $key  ) {
        $ina=$key['inasistencia'];
        $ina1=$key['justificacion_inacistencia'];
        $ina12=$key['asistencia'];
        $id_inasistencia=$key['id_inasistencia'];
    } 

    $con ="SELECT q.justificacion,w.inasistencia FROM (SELECT COUNT(inasistencia.justificacion_inacistencia)as justificacion from inasistencia WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' AND inasistencia.justificacion_inacistencia=1  ".$_POST['id_arema'].")as q,(SELECT COUNT(inasistencia.inasistencia)as inasistencia from inasistencia WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' AND inasistencia.inasistencia=1  ".$_POST['id_arema'].")as w ";
    $con1q=$conexion->prepare($con);
    $con1q->execute(array()); 

    foreach ($con1q as  $value) {
        $inasistencia=$value['inasistencia'];
        $justificacion=$value['justificacion']; 
    }
    if ($ina!=0 and $ina1!=0) {
        $q=3;
    }
    if ($ina!=0 and $ina1==0) {
        $q=2;
    }
    if ($ina==0 and $ina1==0 and $ina12==1) {
        $q=1;
    }

    $var=array($inasistencia,$justificacion,$q,$id_inasistencia,$er);

    echo json_encode($var);
}
function inasistencia2(){
    include '../conexion.php';
    $ina1=0;
    $ina=0;
    

    $con ="SELECT q.justificacion,w.inasistencia FROM (SELECT COUNT(inasistencia.justificacion_inacistencia)as justificacion from inasistencia WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' AND inasistencia.justificacion_inacistencia=1  ".$_POST['id_arema'].")as q,(SELECT COUNT(inasistencia.inasistencia)as inasistencia from inasistencia WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."' AND inasistencia.inasistencia=1  ".$_POST['id_arema'].")as w ";
    $con1q=$conexion->prepare($con);
    $con1q->execute(array()); 

    foreach ($con1q as  $value) {
        $inasistencia=$value['inasistencia'];
        $justificacion=$value['justificacion']; 
    }
  

    $var=array($inasistencia,$justificacion,$con);

    echo json_encode($var);
}

function tomar_asistencia1(){
    include '../conexion.php';  
    $ano=date('Y');
    $con ="SELECT inasistencia.id_inasistencia from inasistencia WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."'  and inasistencia.fecha='".$_POST['fecha']."'  and inasistencia.id_area='".$_POST['id_area']."' and inasistencia.tecnica='".$_POST['tecnica']."'";
    $con1q=$conexion->prepare($con);
    $con1q->execute(array()); 
    $contador=$con1q->rowCount();
    if ($contador>0) {
        
        if ($_POST['asis']=='0') {
            $con ="DELETE FROM `inasistencia` WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."'  and inasistencia.fecha='".$_POST['fecha']."'  and inasistencia.id_area='".$_POST['id_area']."' and inasistencia.tecnica='".$_POST['tecnica']."'";
            $con1q=$conexion->prepare($con);
            $con1q->execute(array()); 
        }else{
            $con ="UPDATE inasistencia SET inasistencia = '".$_POST['asis']."' WHERE inasistencia.id_informe_academico='".$_POST['id_informe_academico']."'  and inasistencia.fecha='".$_POST['fecha']."'  and inasistencia.id_area='".$_POST['id_area']."' and inasistencia.tecnica='".$_POST['tecnica']."'";
            $con1q=$conexion->prepare($con);
            $con1q->execute(array()); 
        }
    }else{
        if ($_POST['tecnica']>0) {
           $tecnica=$_POST['id_area'];
           $id_area=0;
        }else {
           $tecnica=0;
           $id_area=$_POST['id_area'];
        }

        $con ="INSERT INTO `inasistencia` (`id_informe_academico`, `id_periodo`, `fecha`, `hora`, `inasistencia`, `id_area`, `dias`, `ano`, `tecnica`, `materia`) VALUES ('".$_POST['id_informe_academico']."', '".$_POST['periodo']."', '".$_POST['fecha']."', '".$_POST['hora']."', '".$_POST['asis']."', '".$id_area."', '".$_POST['dias']."', '".$ano."', '".$tecnica."', '".$_POST['area']."')";
        $con1q=$conexion->prepare($con);
        $con1q->execute(array()); 
    }


       
 

}
 

function regist(){
    include '../conexion.php';  
    
    date_default_timezone_set ('America/Bogota'); 
    $dia= date('l', strtotime($_POST['fech']));
    if ('lunes'==$dia  or 'Lunes'==$dia  or 'monday'==$dia  or 'Monday'==$dia) {
         $valor=1;
    }
    if ('martes'==$dia  or 'Martes'==$dia  or 'Tuesday'==$dia  or 'tuesday'==$dia) {
         $valor=2;
    }
    if ('Mircoles'==$dia  or 'mircoles'==$dia  or 'Wednesday'==$dia  or 'wednesday'==$dia) {
         $valor=3;
    }
    if ('jueves'==$dia  or 'Jueves'==$dia  or 'Thursday'==$dia  or 'thursday'==$dia) {
         $valor=4;
    }
    if ('Viernes'==$dia  or 'viernes'==$dia  or 'Friday'==$dia  or 'friday'==$dia) {
         $valor=5;
    }
    if ('Sábado'==$dia  or 'sábado'==$dia  or 'Saturday'==$dia  or 'saturday'==$dia) {
         $valor=6;
    }
    if ('domingo'==$dia  or 'Domingo'==$dia  or 'sunday'==$dia  or 'Sunday'==$dia) {
         $valor=7;
    }
 

    $ano=date('Y');
    $id_tecnica=0;
    $id_area=0;
    if ($_POST['idtecni']>0) {
        $id_tecnica=$_POST['id_aa'];
        $id_area=0;
    }
    if ($_POST['idtecni']==0) {
        $id_tecnica=0;
        $id_area=$_POST['id_aa'];
    }
     $con ="INSERT INTO `inasistencia` ( `id_informe_academico`, `id_periodo`, `fecha`, `hora`, `inasistencia`, `id_area`, `dias`, `ano`, `tecnica`, `materia`) VALUES 
    ('".$_POST['id_al']."','".$_SESSION['numero']."','".$_POST['fech']."','".$_POST['hora_']."','".$_POST['listas']."','".$id_area."' ,'$valor' ,'".$ano."','".$id_tecnica."','".$_POST['nombre_materia']."') ";
    $con1q=$conexion->prepare($con);
    $con1q->execute(array());  


}


function tabla11(){ 
    include '../conexion.php'; 

    date_default_timezone_set ('America/Bogota');  
    $fecha=strftime("%F");
    $ano=date('Y');
      $curso=$_POST['curso'];
    $id_area1=$_POST['id_area'];

    $porcion=explode(',', $id_area1);
    $id_area=$porcion[2];
    $tec=$porcion[4];

    $porcion=explode(',', $curso);

    $ID_JORNADA=$porcion[4];
    $id_jornada_sede=$porcion[0];
    $id_grado=$porcion[1];
    $id_curso=$porcion[2];
    $docent=$_SESSION['Id_Doc'];  
    $nomb=$_POST["mate"];
    $numero_grado=$porcion[4];
    $con3="SELECT grado_sede.titular FROM grado_sede WHERE grado_sede.id_grado='$id_grado' and grado_sede.id_jornada_sede='$id_jornada_sede'   and grado_sede.id_curso='$id_curso'    ";
    $con2=$conexion->prepare($con3);
    $con2->execute(array()); 
    $count1=$con2->rowCount();
    foreach ($con2 as $key ) {
       $titular=$key['titular']; 
    }
   
    $con3="SELECT informeacademico.estado_aprovado,    alumnos.foto, alumnos.nombre, alumnos.apellido, alumnos.id_alumnos,  informeacademico.id_informe_academico FROM informeacademico , alumnos WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_grado' AND informeacademico.id_curso='$id_curso' AND informeacademico.id_jornada_sede='$id_jornada_sede' and  alumnos.id_alumnos=informeacademico.id_alumno     ORDER BY  alumnos.apellido  "; 
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll(); 

     
    if($count > 0){  ?>
            <input type="hidden" value="0" id="tecnic">
            <input type="hidden" value="<?php echo $titular ?>" id="titular">
            <input type="hidden" value="<?php echo $id_grado  ?>" id="id_grado1">
            <input type="hidden" value="<?php echo $id_jornada_sede  ?>" id="id_jornada_sede1">
            <input type="hidden" value="<?php echo $id_curso  ?>" id="id_curso1">
            <input type="hidden" value="<?php echo $id_area  ?>" id="id_area1">
            <div style=" padding-bottom: 15px;padding-top: 5px; background-color:#3c8dbc;color: #fff "><div style="margin-left: 13px;font-size: 19px">materia: <?php echo $nomb ?></div></div><br>
        
           <a   class="myButton" style="cursor: pointer;" onclick="consultar_radicacion(<?php echo $titular .",". $id_jornada_sede .",". $id_grado .",". $id_curso .",". $id_area.",". $tec   ?>,0)"  data-target="#radicacion" data-toggle="modal"
           >Remitir estudiantes</a>
            <br>
 
          
            <form action="" method="post">
                <div class="table-responsive"  style="padding: 5px">
                    <table class="table table-bordered">
                         
                            <tr>
                                <th style="width:20px;">N°</th>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Estado</th> 
                                <th>Agregar</th> 
                                <th>Mostrar</th>
                            </tr>
                         
                        <tbody>
                            <?php
                            $cont=0;
                            $uno=0;
                            foreach($con2 as $key){
                                $cont++;
                                $uno=$uno+1;
                                

                                  ?>
                               
                            <tr>
                                <td>
                                    <br>
                                    <h4>
                                        <?php echo($cont); ?>
                                    </h4>
                                </td>
                                <td>

                                    <img    class="profile-user-img img-responsive img-circle" src="<?php echo $key['foto'] ?>" alt="User profile picture"> 
                                </td>
                                <td><br><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>   
                                </td>

                                <td> <br><?php 
                                    if ($key['estado_aprovado']==2) {
                                        echo'<span class="btn btn-warning ">Retirado</span>';
                                     } 
                                    if ($key['estado_aprovado']==3) {
                                         echo'<span class="btn btn-danger ">Desertor</span>';
                                     }if($key['estado_aprovado']==0){
                                        echo'<span class="btn btn-info">Cursando</span>';
                                    } ?>
                                 </td>
                                 
                                <td> 

                                    <a     style='    top: 12px;    top: 12px;top:12px'   data-toggle="modal" data-target="#my1"    data-title="Agragar inacistencias"  onclick="
                                    var id_informe_academico=<?php echo $key['id_informe_academico']  ?>; 
                                    var id_area=<?php echo $id_area ?>;
                                    document.getElementById('id_al').value=id_informe_academico; 
                                    document.getElementById('id_aa').value=id_area;   ">
                                        <img width="37" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRjQzMkU7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIyNTYiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0RCMDQwNDsiIGQ9Ik01MTEuMjgsMjc1LjI4TDM4OS4zMzMsMTUzLjMzM0wxMjIuNjY3LDQyMS41bDg2LjE0Miw4Ni4xNDJDMjI0LjEwNiw1MTAuNDkzLDIzOS44NzYsNTEyLDI1Niw1MTIgIEMzOTAuODk4LDUxMiw1MDEuNDIyLDQwNy42NTksNTExLjI4LDI3NS4yOHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHBvaW50cz0iMzExLDc1IDEyMi42NjcsNzUgMTIyLjY2Nyw0MjEuNSAzODkuMzMzLDQyMS41IDM4OS4zMzMsMTUzLjMzMyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRjZGQzsiIHBvaW50cz0iMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAyNTUuNTcxLDc1IDI1NS41NzEsNDIxLjUgMzg5LjMzMyw0MjEuNSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RDRTFFQjsiIHBvaW50cz0iMzExLDE1My4zMzMgMzg5LjMzMywxNTMuMzMzIDMxMSw3NSAiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojMDBDOEM4OyIgY3g9IjI1NiIgY3k9IjI3MiIgcj0iMTA1LjY3Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0FEQjU7IiBkPSJNMjU2LDE2Ni4zMzNjLTAuMTQzLDAtMC4yODUsMC4wMDUtMC40MjksMC4wMDVWMzc3LjY2YzAuMTQzLDAuMDAxLDAuMjg1LDAuMDA1LDAuNDI5LDAuMDA1ICBjNTguMzU4LDAsMTA1LjY2Ny00Ny4zMDksMTA1LjY2Ny0xMDUuNjY3UzMxNC4zNTgsMTY2LjMzMywyNTYsMTY2LjMzM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0RCRUVGRjsiIHBvaW50cz0iMzIzLjYyNSwyNTEuNjE2IDI3Ni4wMDksMjUxLjYxNiAyNzYuMDA5LDIwNCAyMzUuOTkxLDIwNCAyMzUuOTkxLDI1MS42MTYgMTg4LjM3NSwyNTEuNjE2ICAgMTg4LjM3NSwyOTEuNjM0IDIzNS45OTEsMjkxLjYzNCAyMzUuOTkxLDMzOS4yNSAyNzYuMDA5LDMzOS4yNSAyNzYuMDA5LDI5MS42MzQgMzIzLjYyNSwyOTEuNjM0ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojQkZFMUZGOyIgcG9pbnRzPSIyNzYuMDA5LDI1MS42MTYgMjc2LjAwOSwyMDQgMjU1LjU3MSwyMDQgMjU1LjU3MSwzMzkuMjUgMjc2LjAwOSwzMzkuMjUgMjc2LjAwOSwyOTEuNjM0ICAgMzIzLjYyNSwyOTEuNjM0IDMyMy42MjUsMjUxLjYxNiAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==">
                                    </a>      
                                </td>
                                
                                <td> 
                                    <a  style='top:12px'   data-toggle="modal" data-target="#my" data-title="Mostrar historial de aisitencia" onclick="
                                    var id_informe_academico=<?php echo $key['id_informe_academico']  ?>; 
                                    var id_area=<?php echo $id_area ?>;
                                    var titular=<?php echo($titular) ?>; 




      
                                    var tec=<?php echo $tec ?>;

                                    mostrar2(tec,id_informe_academico,id_area,titular);  ">
                                        <img width="40"    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTUuOTgxIDU1Ljk4MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTUuOTgxIDU1Ljk4MTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiMxMkJCRDQiIGQ9Ik00NC42MjcsNTJIOS4zNTRjLTQuNjE5LDAtOC4zNjQtMy43NDUtOC4zNjQtOC4zNjRWOC4zNjRDMC45OTEsMy43NDUsNC43MzUsMCw5LjM1NCwwaDM1LjI3MiAgICBjNC42MTksMCw4LjM2NCwzLjc0NSw4LjM2NCw4LjM2NHYzNS4yNzJDNTIuOTkxLDQ4LjI1NSw0OS4yNDYsNTIsNDQuNjI3LDUyeiIgZGF0YS1vcmlnaW5hbD0iIzNBQkNBNyIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzNBQkNBNyI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDQuOTkxLDE0aC0xOGMtMC41NTMsMC0xLTAuNDQ3LTEtMXMwLjQ0Ny0xLDEtMWgxOGMwLjU1MywwLDEsMC40NDcsMSwxUzQ1LjU0MywxNCw0NC45OTEsMTR6IiBkYXRhLW9yaWdpbmFsPSIjRkZGRkZGIiBjbGFzcz0iIj48L3BhdGg+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik00NC45OTEsMjhoLTE4Yy0wLjU1MywwLTEtMC40NDctMS0xczAuNDQ3LTEsMS0xaDE4YzAuNTUzLDAsMSwwLjQ0NywxLDFTNDUuNTQzLDI4LDQ0Ljk5MSwyOHoiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiIGNsYXNzPSIiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTQ0Ljk5MSw0MmgtMThjLTAuNTUzLDAtMS0wLjQ0Ny0xLTFzMC40NDctMSwxLTFoMThjMC41NTMsMCwxLDAuNDQ3LDEsMVM0NS41NDMsNDIsNDQuOTkxLDQyeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDE3Yy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDE2Ljg4MSwxMy4zNDQsMTcsMTMuMDYxLDE3eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDMxYy0wLjIwOSwwLTAuNDItMC4wNjUtMC41OTktMC4ybC00LjU3MS0zLjQyOWMtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzLDEuMzk5LTAuMmwzLjgyMiwyLjg2Nmw2LjI0OC03LjI4OGMwLjM1OC0wLjQyLDAuOTkyLTAuNDY4LDEuNDA5LTAuMTA4ICAgIGMwLjQyLDAuMzU5LDAuNDY5LDAuOTksMC4xMDgsMS40MDlsLTYuODU3LDhDMTMuNjI1LDMwLjg4MSwxMy4zNDQsMzEsMTMuMDYxLDMxeiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTMuMDYxLDQ1Ljk5OWMtMC4yMDksMC0wLjQyLTAuMDY1LTAuNTk5LTAuMkw3Ljg5MSw0Mi4zN2MtMC40NDItMC4zMzEtMC41MzItMC45NTgtMC4yLTEuMzk5ICAgIGMwLjMzMi0wLjQ0MywwLjk1OS0wLjUzMSwxLjM5OS0wLjJsMy44MjIsMi44NjZsNi4yNDgtNy4yODdjMC4zNTgtMC40MiwwLjk5Mi0wLjQ2OCwxLjQwOS0wLjEwOCAgICBjMC40MiwwLjM1OSwwLjQ2OSwwLjk5LDAuMTA4LDEuNDA5bC02Ljg1Nyw3Ljk5OUMxMy42MjUsNDUuODgsMTMuMzQ0LDQ1Ljk5OSwxMy4wNjEsNDUuOTk5eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJPC9nPgoJPGc+CgkJPGNpcmNsZSBzdHlsZT0iZmlsbDojRDBFOEY5OyIgY3g9IjQwLjc2OCIgY3k9IjQwLjc5NiIgcj0iOS43OTYiIGRhdGEtb3JpZ2luYWw9IiNEMEU4RjkiPjwvY2lyY2xlPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNFQUY2RkQ7IiBkPSJNNDQuMzIxLDMxLjY3NEwzMS42NDcsNDQuMzQ4YzAuNzA2LDEuODEsMS45MywzLjM1NywzLjQ5NSw0LjQ1OUw0OC43OCwzNS4xNyAgICBDNDcuNjc4LDMzLjYwNCw0Ni4xMzEsMzIuMzgsNDQuMzIxLDMxLjY3NHoiIGRhdGEtb3JpZ2luYWw9IiNFQUY2RkQiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojQjFEM0VGOyIgZD0iTTU0LjcxMyw1NC4yOTFsLTUuOTctNi4yNDRjMS43NDYtMS45MTksMi44Mi00LjQ1OCwyLjgyLTcuMjUxQzUxLjU2NCwzNC44NDMsNDYuNzIxLDMwLDQwLjc2OCwzMCAgICBzLTEwLjc5Niw0Ljg0My0xMC43OTYsMTAuNzk2czQuODQzLDEwLjc5NiwxMC43OTYsMTAuNzk2YzIuNDQyLDAsNC42ODktMC44MjQsNi40OTktMi4xOTZsNi4wMDEsNi4yNzYgICAgYzAuMTk2LDAuMjA2LDAuNDU5LDAuMzA5LDAuNzIzLDAuMzA5YzAuMjQ5LDAsMC40OTctMC4wOTIsMC42OTEtMC4yNzdDNTUuMDgxLDU1LjMyMyw1NS4wOTUsNTQuNjg5LDU0LjcxMyw1NC4yOTF6ICAgICBNMzEuOTcyLDQwLjc5NmMwLTQuODUsMy45NDYtOC43OTYsOC43OTYtOC43OTZzOC43OTYsMy45NDYsOC43OTYsOC43OTZzLTMuOTQ2LDguNzk2LTguNzk2LDguNzk2UzMxLjk3Miw0NS42NDYsMzEuOTcyLDQwLjc5NnoiIGRhdGEtb3JpZ2luYWw9IiNCMUQzRUYiIGNsYXNzPSIiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />
                                    </a>
                                </td>
                               
                            </tr>
                            <?php
                            }
                            ?> 
                        </tbody>
                    </table><br> 
                </div> 
            </form>
              <?php
        }else{ 
           ?>   
            <div class="alert" role="alert" style=" margin: 10PX;font-size: 19px;   color: #45a197;background-color: #e3f2fd;border-color: #82c4f8;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i>  En este momento no tiene  alumnos registrados   <br> </div> <br>
            <script type="text/javascript">
                document.getElementById('tabla1').innerHTML='  <div class="alert" role="alert" style="margin: 13px; color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> no se encuentra registrado ningun estudiante remetido a proceso de inasistencia. </div> <br>';
            </script>
            <?php 
 
        }
}

function consultar_radicado(){
    include '../conexion.php';
    $ano=date("Y"); 
   echo $_POST["num"];
    $con ="SELECT alumnos.nombre,alumnos.apellido,alumnos.foto ,alumnos.id_alumnos,COUNT(inasistencia.id_inasistencia)as cont from alumnos,inasistencia,informeacademico WHERE informeacademico.ano='".$ano."' and  informeacademico.id_jornada_sede='".$_POST["id_jornada_sede"]."' and informeacademico.id_grado='".$_POST["id_grado"]."'  and informeacademico.id_curso='".$_POST["id_curso"]."' AND informeacademico.id_informe_academico=inasistencia.id_informe_academico and inasistencia.inasistencia=1 and informeacademico.id_alumno=alumnos.id_alumnos group by (alumnos.id_alumnos) HAVING cont>1";
    $con1q=$conexion->prepare($con);
    $con1q->execute(array());     ?>
    <select class="form-control" id="numero_sele" onchange="let num= document.getElementById('numero_sele').value; consultar_radicacion (<?php echo $_POST["titular"] .",".$_POST["id_jornada_sede"] .",".$_POST["id_grado"] .",".$_POST["id_curso"] .",".$_POST["id_area"] .",".$_POST["tecnica"] ?>,num)">
        <option value="0">Todos los cursos</option>
        <option value="1">Area respectiva</option>
    </select> <br>
    <table class="table-hover table">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Estudiante</th>
            <th>Inasistencia</th>
            <th>Mostrar</th>
        </tr><?php
        $id=0;
        foreach ($con1q as $key  ) {                
            ?>
            <tr>
                <td><input type="checkbox" name="id[]" value="<?php echo $key["id_alumnos"] ?>"></td>
                <td><img class="profile-user-img img-responsive img-circle" src="<?php echo $key["foto"] ?>" alt="User profile picture"></td>
                <td><?php echo $key["nombre"]. " ". $key["apellido"] ?></td>

                <td><?php echo $key["cont"]  ?></td>
                <td><button class="btn btn-primary btn-xs" > mostrar</button></td>
            </tr>
            <tr id="m<?php echo $key["id_alumnos"] ?>" style="display: none">
                <td colspan="5">4</td>
            </tr>
            <?php  
        } ?>
    </table>



<?php    
}
 
?>
