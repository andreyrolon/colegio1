<?php 
session_start();
if(!isset($_SESSION['Session2'])){
    header("location: ../../../login.php");  
}
 
include "../../../codes/docente/chat.php";
$chat=new chat();  

$mensaje=$chat->mensajes_alumno($_SESSION['Id_Doc']);

 
 

$id=$_GET['id'];
$var=$chat->mensajes_enviados($id);
include('../enlaces/head.php');
 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper">
        <?php include('../enlaces/header.php'); ?>
        <style type="text/css">
            .bin{
                color: #333;
                background-color: #fff;
                border-color: #ccc;
                height: 33px;
            }
            .label{
                padding: 5px
            }
            tr:hover{
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 4px 0 0 8px rgba(0.4, 0.1, 0.2, 0);
            }
            
        </style>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <a href="compose.php" style="width: 100%" class="btn   btn-primary  "><i class="fa fa-envelope-o" style="margin-right:9px;margin-top: 2px; float: left;"></i> <span style="float: left;">Crear Mensaje</span></a><br> <br>

                        <div class="box box-solid" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                             
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="recividos.php"><i class="fa    fa-folder-o"></i> Bandeja de entrada
                                            <?php if ($mensaje[0]>0){ ?>
                                                <span class="label label-primary pull-right">
                                                    <?php echo($mensaje[0]); ?> 
                                                </span>
                                            <?php } ?>
                                        </a></li>
                                    <li><a href="enviados.php"><i class="fa fa-send-o "></i> Enviados</a></li>
                                    <li><a href="papelera.php"><i class="fa fa-trash-o"></i> Papelaria</a></li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            
                            <!-- /.box-header -->
                            <?php
                              foreach($var as $key){
                            ?>
                                <div style="padding-top:7px;" class="table table-responsive ">
                                    <span   style="margin-left: 19px; font-size: 16px">Mensaje Enviado </span>
                                    <div class=" " style="float:right;margin-right: 10px">
                                        <small >
                                            <?php date_default_timezone_set('Europe/Madrid');
                                            setlocale(LC_TIME, 'es_ES.UTF-8');
                                            setlocale(LC_TIME, 'spanish');  
                                            echo$inicio = strftime("%A %d de %B  ", strtotime($key['fecha']));
                                            echo date('g:i a', strtotime($key['fecha'])); ?>
                                        </small> 
                                                    
                                    </div> 
                                </div> 
                                <div class="box-body" style="display:  ;">
                                    
                                    <img class="   img-circle" src="<?php echo $fot ?>" alt="" style=" float: left;   margin: 0 auto;width: 109px;  height: 141px;padding: 3px;border: 3px solid #d2d6de;margin: 10px">  

                                    <div class=" " style='margin-left: 10px'>
                                        <div class=" " style=""><br>
                                            
                                            <strong  ><?php echo strtoupper($_SESSION['Nom_U'].' '.$_SESSION['Ape_U'] )?></strong>  <br>
                                            <strong>Rol:</strong><span > Alumno</span><br>
                                            <?php 
                                          
                                            if (  $key['dirigido']==5) {
?>

                                                <strong>Para:</strong> Docentes<br> <?php
                                                $jornada=' Todos';
                                                if ($key['jornada']!='') {
                                                    $jornada=$key['sede'].' '.$key['jornada'];

                                                    echo '<strong>Sede:</strong>'.$jornada.'<br>'; 
                                                }
                                                if ($key['todos']==1) {


                                                    echo  " <strong>Dirijido:</strong> Todos ";
                                                    
                                                }if ($key['todos']==0) {
                                                    $bin=$chat->mostra_docente_mensaje($id);
                                                    echo "
                                                        <strong>Dirijido:</strong><br>";
                                                    foreach ($bin as   $value) {?>
                                                        <button style="font-size: 13px; margin-top: 5px;padding: 1px " class="btn btn-info "><?php echo mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8").' '; ?></button><?php
                                                        
                                                    }
                                                }  
                                            }
                                            if (($key['dirigido']==1) || ($key['dirigido']==2) || ($key['dirigido']==3) || ($key['dirigido']==4)) {
                                              
                                                if (  $key['dirigido']==1) {
     
                                                   echo $tem= "
                                                        <strong>Para:</strong> Rector<br>
                                                        <strong>";
                                                }
                                                if (  $key['dirigido']==2) {
     
                                                   echo $tem= "
                                                        <strong>Para:</strong> Coordinador<br>
                                                        <strong>";
                                                }
                                                if (  $key['dirigido']==3) {
                                                   echo $tem= "
                                                        <strong>Para:</strong> Psicoorientador<br>
                                                        <strong>";
                                                }
                                                if (  $key['dirigido']==4) {
                                                   echo $tem= "
                                                        <strong>Para:</strong> Secretaria<br>";
                                                }
                                                if ($key['todos']==0) {
                                                     $bin=$chat->mostra_admin_mensaje($id);
                                                   echo $tem= "<strong> Dirijido:</strong> <br>";
                                                    foreach ($bin as   $value) {?>
                                                        <button style="font-size: 13px; margin-top: 5px;padding: 1px " class="btn btn-info "><?php echo mb_convert_case($value['NOMBRE']." ".$value['APELLIDO'], MB_CASE_TITLE, "UTF-8").' '; ?></button><?php
                                                        
                                                    }
                                                }
                                                if ($key['todos']==1) {
                                                     $bin=$chat->mostra_admin_mensaje($id);
                                                   echo $tem= "<strong> Dirijido:</strong> Todos  ";
                                                    
                                                }
                                            }
                                            if (  $key['grado']!='') {

                                                $bin=$chat->mostra_admin_mensaje($id);
                                               echo $tem= "
                                                    <strong>Para:</strong> Alumnos<br>
                                                    <strong>Sede:</strong> ";
                                                echo $key['sede'].' '.$key['jornada'];
                                                echo "<br><strong>Curso:</strong> ".$key['grado'].'-'.$key['numero'];
                                                
                                                if ($key['todos']==0) {
                                                   echo $too="<br><strong>Dirijido:</strong><br>";
                                                    $bin=$chat->mostra_alumnos_mensaje($id);
                                                    foreach ($bin as   $value) {?>
                                                        <button style="font-size: 12px; margin-top: 5px;padding: 1px " class="btn btn-info "><?php echo mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8").' '; ?></button><?php
                                                        
                                                    }
                                                }if ($key['todos']!=0) {
                                                   echo $too='<br><strong>Dirijido:</strong>  Todos ';
                                                }
                                                 
                                            } ?> 
                                             <br>
                                            <strong >Asunto: </strong>
                                            <?php echo$key['asunto']; ?>  
                                                
                                           
                                        </div>
                                        
                                    </div>
                                    <div style="margin-left: 10px ">
                                         
                                        <div class="mailbox-read-message table table-responsive">
                                            <?php echo($key['mensaje']); ?>
                                        </div>
                                    </div>  <?php
                                    if($key['archivo']!=""){
                                    ?>
                                        <div style="margin: 18px ">
                                            <strong>Archivo:</strong><br>
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item"    src="../../../ajax/mensajeria/imagen/<?php echo($key['archivo']) ?>"></iframe>
                                            </div>
                                        </div> <?php
                                    }
                                    ?>
                                </div> 
                                             
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer>
    </div>
</body>




<?php include('../enlaces/footer.php'); ?>
