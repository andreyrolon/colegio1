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
    $con=0;
    $apellido=$_POST['apellido'];
    $apellido='';
    $nombre='';
    include '../../conexion.php'; 
    $ano=date('Y');
     $consultar_nivel="SELECT alumnos.foto, alumnos.nombre,alumnos.apellido,alumnos.genero,informeacademico.id_informe_academico,materia_por_periodo.periodo from alumnos,informeacademico,materia_por_periodo WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.ano='$ano' and informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and alumnos.apellido like '%$apellido%' GROUP by informeacademico.id_informe_academico,materia_por_periodo.periodo ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $nroProductos=$consultar_nivel1->rowCount();
    if ($nroProductos>0) { 
        ?>
        <div style="padding: 10px">
            <div style="float:  ;"><strong> Buscador:</strong>
                <input style="margin-left: 10px;    height: 27px; 
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 2px;" type="text" class="form-" placeholder="Buscar estudiante.."name="search">
            </div> <br> 
            <table class="table-hover">
                <tr>
                   <th>Id</th>
                   <th>Foto</th>
                   <th>Nombre</th>
                   <th>Estado</th>

                    <th>
                        <button class="form-control" id="idw" style='color: #  ;width: 110px' class="button"><span  class="icon"><i   class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"><span>1 periodo</span></span></button>
                    </th>
                    <th>
                        <button id="idw"  style='   width: 110px' class="form-control"><span class="icon"><i class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"><span>2 periodo</span></span></button>
                    </th>
                    <th>
                        <button  id="idw" style='  width: 110px' class="form-control"><span class="icon"><i class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"><span>3 periodo</span></span></button>
                    </th>
                    <th>
                        <button  id="idw"  style=' width: 110px'class="form-control"><span class="icon"><i class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"><span>4 periodo</span></span></button>
                    </th>
                </tr> 
                <?php
                foreach ($consultar_nivel1 as $key) { $r=$con++; 
                    if ($key['nombre']!=$nombre and $key['apellido']!=$apellido) { 
                                ?>
                        <tr id="op">
                            <td><?php echo $r+1  ?></td>
                            <td>
                                <img style="width: 65px;height: 65px" class="profile-user-img img-responsive img-circle" src="<?php if($key['foto']=='' && $key['genero']=='1'){echo '../../../logos/niño.png';}  if($key['foto']=='' && $key['genero']==''){echo '../../../logos/niña.jpg';}else{ echo($key['foto']); } ?>" alt="User profile picture"> 
                            </td>

                            <td>    
                                <?php echo $key['nombre'].' '.$key['apellido']; ?>   
                            </td>

                            <td>Cursando</td>
                            
                            <td> 
                                <button id="idww" class="form-control" style="width: 110px"><span class="icon is-small"><i class="fa fa-download"></i></span><span>1P</span></button> 
                            </td>
                            <td> 
                                <button id="idww" class="form-control" style="width: 110px"><span class="icon is-small"><i class="fa fa-download"></i></span><span>2P</span></button> 
                            </td>
                            <td> 
                                <button id="idww" class="form-control" style="width: 110px"><span class="icon is-small"><i class="fa fa-download"></i></span><span>3P</span></button> 
                            </td>
                            <td> 
                                <button id="idww" class="form-control" style="width: 110px"><span class="icon is-small"><i class="fa fa-download"></i></span><span>4P</span></button> 
                            </td>
                        <tr><?php
                    }
                    $nombre=$key['nombre'];
                    $apellido=$key['apellido'];
                } ?>
            </table>
        </div> <?php
    }else{
        ?> 
        <div class="alert" role="alert" style="height:100px;margin-left: 20px;margin-right: 20px; color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Alerta!</strong> <br>No se encuentra alumnos con ese apellido. </div>
        <?php
    }
}

?>