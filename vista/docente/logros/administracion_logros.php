<?php 
       session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../index.html"); echo($_SESSION['Session']);
    }
include "../../../codes/docente/carga_academica.php";
$carga=new carga();
$dat=$carga->tabla($_SESSION['Id_Doc']); 
$competencias=$carga->competencias($_SESSION['Id_Doc']); 
 
 
include('../enlaces/head.php'); 
?>
<style>
    table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left; 
}
   
    #op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
    }
</style>
<?php 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <?php  include('../enlaces/header.php'); ?>
    <div class=" ">
        <div class="content-wrapper"> 
            <section class="content"> 
                <div class="row">
                    <div class="col-md-12" >
                        <div class="nav-tabs-custom" style=" margin: 20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#activity" data-toggle="tab"     >
                                        <strong>materias</strong>
                                    </a>
                                </li>
                                <?php if($competencias[1]>0){ ?>
                                <li><a href="#timeline" data-toggle="tab"  ><strong>tecnicas</strong></a></li> <?php } ?>
                            </ul>
                            <div class="tab-content ">
                                <div class="active tab-pane  " id="activity"> 
                                    <div class="table-responsive" style="padding: 10px">
                                        <table class="table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Sede</th>
                                                    <th>Jornada</th>
                                                    <th>Asignatura</th>
                                                    <th>Curso</th> 
                                                    <th>Logros</th>
                                                    <!--<th>Archivos</th>--> 
                                                    <th>N_estudiantes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach($dat as $key){
                                                    if ($key['area']!=1 or $key['codigo']==01) { ?>
                                                        <tr id="op">
                                                            <td>
                                                                <?php echo($key['sede']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo($key['jornada']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo($key['nombre']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo($key['grado']."-".$key['curso']); ?>
                                                            </td>
                                                            <td>  <?php 
                                                                $pe=$carga->periodo();
                                                                foreach ($pe as $value) {
                                                                    if ($value['activar_periodo']==1) {  ?>

                                                                        <a class="btn btn-info" href="../logros/logros.php?nombre=<?php echo($key['id_area']); ?>&&id=<?php echo($key['id_area']); ?>&&id_g=<?php echo($key['id_grado']); ?>&&id_c=<?php echo($key['id_curso']); ?>&&id_jornada_sede=<?php echo($key['id_jornada_sede']); ?>&&p=<?php echo $value['numero'] ?>&&nomd=<?php echo $key['nombre'] ?>&&codigo=<?php echo $key['codigo'] ?>&&area=<?php echo $key['area'] ?>">P<?php echo $value['numero']  ?></a><?php
                                                                    }else{
                                                                        $periodo_docente=$carga->periodo_docente($_SESSION['Id_Doc'],$value['numero']);
                                                                        foreach ($periodo_docente as $ke) {
                                                              
                                                                            if ($ke['activo_nota']==1) {  ?>
                                                                                <a class="btn btn-info" href="asignar_nota.php?nombre=<?php echo($key['id_area']); ?>&&id=<?php echo($key['id_area']); ?>&&id_g=<?php echo($key['id_grado']); ?>&&id_c=<?php echo($key['id_curso']); ?>&&id_jornada_sede=<?php echo($key['id_jornada_sede']); ?>&&p=<?php echo $value['numero'] ?>&&nomd=<?php echo $key['nombre'] ?>&&codigo=<?php echo $key['codigo'] ?>&&area=<?php echo $key['area'] ?>">P<?php echo $value['numero']  ?></a><?php
                                                                            }
                                                                        }
                                                                    }
                                                                }?>
                                                            </td> 
                                                          
                                                            <td>
                                                                <?php $n=$carga->n_est($key['id_grado'],$key['id_curso'],$key['id_jornada_sede'],$key['id_area']);
                                                                foreach($n as $n1){ 
                                                                    echo($n1['d']); //FALTA IMPRIMIR BIEN 
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr> <?php 
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane table-responsive" id="timeline">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sede</th>
                                                    <th>Jornada</th>
                                                    <th>Curso</th>
                                                    <th>Competencia</th> 
                                                    <th>Logro</th>
                                                    <th>N_estudiantes</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php
                                                foreach($competencias[0] as $key){
                                                    $pe=$carga->periodo(); 
                                                    foreach ($pe as $value) {

                                                        date_default_timezone_set("America/Bogota");
                                                        $fecha=date("Y-m-d");
                                                        $fecha_inicio = strtotime($value['fecha_inicio']);
                                                        $fecha_fin = strtotime($value['fecha_fin']);
                                                        $fecha = strtotime($fecha);
                                                        if ( ($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin  && $value['numero']==$key['id_periodo']) or ($value['activar_periodo']==1 && $value['numero']==$key['id_periodo']) ){ ?>
                                                            <tr>
                                                                <td>
                                                                    
                                                                    <?php echo($key['sede']); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo($key['jornada']); ?>
                                                                </td>
                                                                <td> 
                                                                    <?php echo($key['grado']."-".$key['curso']); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo($key['competencia']); ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-info" href="logro_tecnico.php?id=<?php echo($key['id_competrencia']); ?>&&codigo=<?php echo($key['codigo']); ?>&&id_g=<?php echo($key['id_grado']); ?>&&id_c=<?php echo($key['id_curso']); ?>&&id_jornada_sede=<?php echo($key['id_jornada_sede']); ?>&&p=<?php echo $value['numero'] ?>&&nomd=<?php echo $key['competencia'] ?>"  target="_blank">P<?php echo $h=$value['numero']  ?></a>
                                                                </td>
                                                           
                                                                <td><?php  
                                                                    $n=$carga->n_est2($key['id_grado'],$key['id_curso'], $key['id_jornada_sede'],$value['numero'],$key['id_competrencia']);
                                                                    foreach($n as $n1){ 
                                                                        echo($n1['d']) ;
                                                                    } ?>
                                                                </td>
                                                            </tr><?php
                                                        }else{
                                                           $periodo_docente=$carga->periodo_docente($_SESSION['Id_Doc'],$value['numero']);
                                                            foreach ($periodo_docente as $ke) {
                                                                if ($ke['activo_nota']==1  && $value['numero']==$key['id_periodo'] ) { ?>
                                                                    <tr>
                                                                        <td>
                                                                            
                                                                            <?php echo($key['sede']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo($key['jornada']); ?>
                                                                        </td>
                                                                        <td> 
                                                                            <?php echo($key['grado']."-".$key['curso']); ?>
                                                                        </td> 

                                                                        <td>
                                                                            <?php echo($key['competencia']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <a class="btn btn-info" href="logro_tecnico.php?id=<?php echo($key['id_competrencia']); ?>&&codigo=<?php echo($key['codigo']); ?>&&id_g=<?php echo($key['id_grado']); ?>&&id_c=<?php echo($key['id_curso']); ?>&&id_jornada_sede=<?php echo($key['id_jornada_sede']); ?>&&p=<?php echo $value['numero'] ?>&&nomd=<?php echo $key['competencia'] ?>"  target="_blank">P<?php echo $h=$value['numero']  ?></a>
                                                                        </td>
                                                                   
                                                                        <td><?php  
                                                                            $n=$carga->n_est2($key['id_grado'],$key['id_curso'], $key['id_jornada_sede'],$value['numero'],$key['id_competrencia'] );
                                                                            foreach($n as $n1){ 
                                                                                echo($n1['d']) ;
                                                                            } ?>
                                                                        </td>
                                                                    </tr><?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<?php include('../enlaces/footer.php'); ?>
