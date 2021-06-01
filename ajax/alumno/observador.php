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

function mostrar(){   
    include "../../codes/rector/conexion.php";
 
    $id=$_SESSION['Id_Doc'];
    $obser="SELECT observador_compromiso.texto, docente.id_docente,administradores.NOMBRE,administradores.APELLIDO,administradores.FOTO, observacion.id_admin, observacion_categotia.nombre as nom_t,observacion_tipo.nombre as nom_c,observacion.area, docente.nombre,docente.apellido,docente.genero,docente.foto,observacion.descripcion,observacion.fecha,observacion_tipo.nombre as tipo,observacion_categotia.id as categoria,observacion.id ,observacion_tipo.id as tipo,observacion.compromiso FROM observacion LEFT JOIN observador_compromiso on observador_compromiso.id=observacion.compromiso LEFT JOIN  administradores on  administradores.ID_ADMIN=observacion.id_admin LEFT JOIN docente on docente.id_docente=observacion.id_docente LEFT JOIN observacion_tipo on observacion.id_observacion_tipo=observacion_tipo.id LEFT JOIN observacion_categotia on observacion_categotia.id=observacion_tipo.id_observacion_categoria WHERE observacion.id_alumno=$id";
    $obser1=$conexion->prepare($obser);
    $obser1->execute(array());
    $obser2=$obser1->fetchAll();
    $cont=$obser1->rowCount();
 
    if( $cont==0){
        ?>
        <div style="margin:10px" class="callout callout-info">
        <h4>Información!</h4>
        No se encuentran Observaciones
      </div>
        <?php return;
    }
    ?> 
     

    <script>
       
        $(".my-select").chosen()({
          placeholder: "Select a state",
          allowClear: true
        });
    </script>
    <span class="btn-link" style="margin-left: 27px;"> 
        <strong><?php echo $cont  ?> Observaciones</strong>
    </span>
     

        
    <?php

    foreach ($obser2 as  $value) {
        $foto=$value['foto'];
        if ($value['foto']=='' && $value['genero']==1) {
            $foto='../../../logos/femenino.png';
        }
        if ($value['foto']=='' && $value['genero']==0) {
            $foto='../../../logos/masculino.png';
        }
        ?><br>
        <div class="  ">

            <div  style="border: solid #d5d5d5;background: #e6e6e6;padding:17px;margin: 13px;">
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
                    <?php if ($value['id_admin']>0) {  ?>
                        <div style="margin-top: 10px;margin-bottom: 10px">
                            <span class="btn btn-link btn-xs"><strong>Remitido a</strong></span>  

                            <select id="admin" class=" form-control my-select"     > 
                                <option selected="selected" data-img-src="<?php echo($value['FOTO']); ?>" aria-disabled="true"  ><?php echo($value['NOMBRE']." ".$value['APELLIDO']); ?></option>
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
                   
                    
            </div>
        </div>

        <?php
    }
 
} 