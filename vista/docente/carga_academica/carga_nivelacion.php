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
  text-align: left; 
}
   
    tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
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
    <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper">  
            <div class="row">
                <div class="col-md-12">



                        <div class="nav-tabs-custom" style=" margin: 20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#activity" data-toggle="tab"     >
                                        <strong>Tabla de area perdidas</strong>
                                    </a>
                                </li>
                                <?php if($competencias[1]>0){ ?>
                                <li><a href="#timeline" data-toggle="tab"  ><strong>Tabla de competencias perdidas </strong></a></li> <?php } ?>
                            </ul>
                            <div class="tab-content ">
                                <div class="active tab-pane  table-responsive" id="activity">  
                                    
                                    <div class="table-responsive" style=" ">
                                        <table class="table table-hover"> 



                                                <tr style="background-color: #d2d2d26e;
                                                border: solid 2px #a9a8a894; 
                                                color: #1b1919ba;">
                                                    <th style="padding-right: 10px;padding-left: 10px">Sede</th>
                                                    <th>Jornada</th>
                                                    <th>Asignatura</th>
                                                    <th>Curso</th>
                                                    <th>Recuperación</th> 
                                                    <th>N estudiantes</th>  
                                                     
                                                </tr> 
                                            <tbody>
                                                <?php
                                                foreach($dat as $key){
                                                    if ($key['area']!=1 or $key['codigo']==01) { ?>
                                                        <tr id="op">
                                                            <td style="padding-right: 10px;padding-left: 10px">
                                                                <?php echo($key['sede']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo($key['jornada']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo($key['nombre']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ro=($key['grado']."-".$key['curso']); ?>
                                                            </td>
                                                           
                                                            <td>  <?php 
                                                                $pe=$carga->periodow();
             
                                                                 

                                                                foreach ($pe as $value) {        ?>

                                                                        <a class="btn btn-info" href="recuperacion.php?nombre=<?php echo($key['id_area']); ?>&&ro=<?php echo($ro); ?>&&id=<?php echo($key['id_area']); ?>&&id_g=<?php echo($key['id_grado']); ?>&&id_c=<?php echo($key['id_curso']); ?>&&id_jornada_sede=<?php echo($key['id_jornada_sede']); ?>&&p=<?php echo $value['numero'] ?>&&nomd=<?php echo $key['nombre'] ?>&&codigo=<?php echo $key['codigo'] ?>&&area=<?php echo $key['area'] ?>">P<?php echo $value['numero']  ?></a><?php
                                                                     
                                                                }?>
                                                            </td> 

                                                            
                                                            <td>
                                                                <?php

                                                                $xar=0;
                                                                foreach ($pe as $value) {        
                                                                    $n=$carga->n_est3($key['id_grado'],$key['id_curso'],$key['id_jornada_sede'],$key['id_area'],$value['numero']);
                                                                    foreach($n as $n1){
                                                                        if ($xar!=0) {
                                                                            echo " - ";
                                                                         } 
                                                                        echo($n1['d'] ); //FALTA IMPRIMIR BIEN 
                                                                        $xar=1;
                                                                    } 
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
                                    <div class="table-responsive" style="padding: 10px">
                                        <table class="table table-hover"> 
                                                <tr>
                                                    <th>Sede</th>
                                                    <th>Jornada</th>
                                                    <th>Curso</th>
                                                    <th>Competencia</th>
                                                    <th>Recuperación</th> 
                                                    <th>N_estudiantes</th> 
                                                </tr> 
                                            <tbody> <?php
                                                foreach($competencias[0] as $key){ 

                                                    foreach ($pe as $value) { 
                                                        if ($key['id_periodo']==$value['numero']) { ?>
                                                            <tr>
                                                                <td>
                                                                    
                                                                    <?php echo($key['sede']); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo($key['jornada']); ?>
                                                                </td>
                                                                <td> 
                                                                    <?php echo $ro=($key['grado']."-".$key['curso']); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo($key['competencia']); ?>
                                                                </td> 
                                                                <td><?php 
                                                                    $pe=$carga->periodow();
                                                                            ?>
                                                                        <a class="btn btn-info" href="recuperacion_tecnica.php?id=<?php echo($key['id_competrencia']); ?>&&ro=<?php echo($ro); ?>&&id_g=<?php echo($key['id_grado']); ?>&&id_c=<?php echo($key['id_curso']); ?>&&id_jornada_sede=<?php echo($key['id_jornada_sede']); ?>&&p=<?php echo $value['numero'] ?>&&nomd=<?php echo $key['competencia'] ?>"  target="_blank">P<?php echo $key['id_periodo']  ?></a> 
                                                                </td>
                                                                <td>
                                                                    <?php      
                                                                        $n=$carga->n_est4($key['id_grado'],$key['id_curso'],$key['id_jornada_sede'],$key['id_competrencia'],$value['numero']);
                                                                        foreach($n as $n1){ 
                                                                            echo($n1['dd']); //FALTA IMPRIMIR BIEN 
                                                                        }  
                                                                    ?>
                                                                </td>
                                                                 
                                                            </tr><?php 
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
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                Desarrollado por IBUsoft.

            </div>
            <strong>IBUnotas 1.0.
        </footer>
    </div>
</body>
<?php include('../enlaces/footer.php'); ?>
