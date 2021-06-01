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

 
function ver(){
   
    $con=0; 
    $apellido='';
    $nombre='';
    include '../conexion.php'; 
    $ano=date('Y');
    $dato='';
    $id_c='';
    $id_g='';
    $id_js='';
    $periodo=$_POST['periodo'];
    if(isset($_POST['dato'])){
       $d=$_POST['dato'];
    }
    if(isset($_POST['id_jornada_sede'])){
    $id_js=$_POST['id_jornada_sede'];
    }
    if(isset($_POST['id_grado'])){
    $id_g=$_POST['id_grado'];
    }
    if(isset($_POST['id_curso'])){
    $id_c=$_POST['id_curso'];
    }
 
 

    $consultar_nivel=" SELECT  AVG(materia_por_periodo.nota)as q, informeacademico.fecha_desercion,informeacademico.fecha_retiro,alumnos.foto, alumnos.nombre,alumnos.apellido,alumnos.genero,informeacademico.id_informe_academico from alumnos,informeacademico,materia_por_periodo WHERE informeacademico.ano='$ano' and informeacademico.id_grado='$id_g' and informeacademico.id_curso='$id_c' and informeacademico.id_jornada_sede='$id_js' and alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and materia_por_periodo.periodo='$periodo' GROUP BY informeacademico.id_informe_academico   
ORDER BY q   desc limit 50
  ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 

    $nroProductos=$consultar_nivel1->rowCount();
    $con2=$consultar_nivel1->fetchAll();
$ry=0;
    
    if ($nroProductos>0) { 
        ?>
        <style type="text/css">
            .img-circle{
            width: 65px;
            height: 80px;
        }
        .img-circle:hover{ 
            width: 100px; 
            height: 123px;
        }

        </style>
        <div class=" table-responsive" style="padding: 10px">
            <form action="descarga_masiva.php" method="get" target="_blank">
                <table class=" table table-hover">
                    <tr>
                       <th width="50">Puesto</th>
                       
                       <th width="100" style="padding-left: 20px;padding-right: 20px"><center>Foto</center></th>
                       <th width="100" style="width: 100px">Nombre</th>
                       <th width="100">Estado</th>           
                       <th width="100">
                           <button  id="idw"  style=' 'class="form-control"><span class="icon"><i class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"><span> <?php echo $_POST['periodo'] ?>P Todos</span></span></button>
                        </th>
                    </tr> 
                    <?php
                    $contador=0;
                    $contador1=0;
                    $i=1;
                    foreach ($con2 as $key) {  
                            $r=$i++;   
                             
                            if($key['foto']=='' && $key['genero']=='1'){
                                $foto='../../../logos/niña.jpg';
                            }  
                            if($key['foto']=='' && $key['genero']=='0')
                            {
                                $foto='../../../logos/niño.jpg';
                            }if ($key['foto']!='') {
                                $foto=$key['foto'];
                            }
                            $estado='Cursando';
                            if ($key['fecha_desercion']!='0000-00-00') {
                                $estado='Desertor';
                            }
                            if ($key['fecha_retiro']!='0000-00-00') {
                                $estado='Retirado';
                            }
                            $PROM=$key['q'];
                            if ($key['q']<1) {
                                $PROM=1;  
                            }
                            $ran= round($PROM,1);
                            $contador1=$contador+$ran;
                            $contador=$contador1;

                                    ?>
                                    <input type="hidden" value="<?php  echo $nom=mb_convert_case($key['nombre'].' '.$key['apellido'], MB_CASE_TITLE, "UTF-8") ?>" name='nombre[]'><input type="hidden" value="<?php echo $key['id_informe_academico'] ?>" name='id[]'>
                                    <input type="hidden" value="<?php echo $r ?>" name='puesto[]'> 
                                    <input type="hidden" value="<?php echo $ran ?>" name='avg[]'>
                            <tr id="op">
                                <td><?php echo $r ?></td>
                                <td>
                                    <img  class="profile-user-img img-responsive img-circle" src="<?php echo $foto;  ?>" alt="User profile picture"> 
                                </td>

                                <td>    
                                    <?php  echo $nom=mb_convert_case($key['nombre'].' '.$key['apellido'], MB_CASE_TITLE, "UTF-8") ?>  
                                </td>

                                <td>
                                    <?php echo $estado ?>
                                <td> 
                                    
                                   <a  id="na<?php echo $r ?>" onclick='
                                   var grupo=document.getElementById("grupo").value;
                                   var na=document.getElementById("na<?php echo $r ?>").href="descarga.php?grupo="+grupo+"&&id_js=<?php echo($id_js); ?>&&id_g=<?php echo($id_g); ?>&&nom=<?php echo($nom); ?>&&id_c=<?php echo($id_c); ?>&&id_i=<?php echo $key['id_informe_academico'] ?>&&p=<?php echo $_POST['periodo'] ?>&&sede=<?php echo $_POST['sede'] ?>&&jornada=<?php echo $_POST['jornada'] ?>&&curso=<?php echo $_POST['curso'] ?>&&grado=<?php echo $_POST['grado'] ?>&&puesto=<?php echo $r ?>&&avg=<?php echo $ran ?>" '    
                                    id="idww" class="form-control" style="width: 100%" target="_blank"><span class="icon is-small" ><i class="fa fa-download" ></i></span><span><?php echo $_POST['periodo'] ?>P</span></a> 

                                </td> 
                                 
                            <tr><?php  
                    } 
                    $ui=$contador1/$r;
                    $dr= round($contador1,2);?>
                </table>
                <input type="hidden" id="grupo" value="<?php  echo $dr ?>" name="grupo">
                <input type="hidden" id="sede" value="<?php  echo  $_POST['sede'] ?>" name="sede">
                <input type="hidden" id="jornada" value="<?php  echo  $_POST['jornada'] ?>" name="jornada">
                <input type="hidden" id="curso" value="<?php  echo   $_POST['curso'] ?>" name="curso">
                <input type="hidden" id="grado" value="<?php  echo  $_POST['grado']?>" name="grado">
                <input type="hidden" id="p" value="<?php  echo $_POST['periodo'] ?>" name="p">
                <input type="hidden" id="grupo" value="<?php  echo $dr ?>" name="grupo">
                <input type="hidden" id="grupo" value="<?php  echo $dr ?>" name="grupo">
            </form>
        </div> <?php 
    }else{
        ?> 
        <div class="alert" role="alert" style="height:100px;margin-left: 20px;margin-right: 20px; color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Alerta!</strong> <br>No se encuentra alumnos registrados. </div><br>
        <script>
            document.getElementById('b').style.display='none';
        </script>
        <?php
    }
}

?>