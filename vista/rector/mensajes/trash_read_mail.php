

<?php 
session_start();
if(!isset($_SESSION['Session1'])){
    header("location: ../../../login.php");  
}
include "../../../codes/rector/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
$id=$_GET['id'];
$var=$chat->mensajes_recividos($_SESSION['Id_Doc'],$id);
include('../enlaces/head.php');
    

  
?>
<style>
 
[data-title] {  
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 2px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 9px solid #000;
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




<body style=" <?php echo $sty ?>


 " class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper"  >
        <?php include('../enlaces/header.php'); ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
         

            <!-- Main content --> 
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div id="sapo"></div>
                        <a href="compose.php" style="width: 100%" class="btn   btn-primary  "><i class="fa fa-envelope-o" style="margin-right:9px;margin-top: 2px; float: left;"></i> <span style="float: left;">Crear Mensaje</span></a><br> <br>
                        <div class="box box-solid" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                             
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="mailbox.php"><i class="fa    fa-folder-o"></i> Bandeja de entrada
                                            <?php if ($mensaje[0]>0){ ?>
                                                <span class="label label-primary pull-right">
                                                    <?php echo($mensaje[0]); ?> 
                                                </span>
                                            <?php } ?>
                                        </a></li>
                                    <li><a href="sent.php"><i class="fa fa-send-o "></i> Enviados</a></li>
                                    <li><a href="trash.php"><i class="fa fa-trash-o"></i> Papelaria</a></li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class=" " style="border-top:solid 3px #00c0ef; background: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <?php  

 

 

                            foreach($var as $key){ 

                                $tabla_para=$key['tabla_de']; 
                                if ($tabla_para==1) {
                                    $tabla=1;
                                }
                                if ($tabla_para==2) {
                                    $tabla=1;
                                }
                                if ($tabla_para==3) {
                                    $tabla=1;
                                }
                                if ($tabla_para==4) {
                                    $tabla=1;
                                }
                                if ($tabla_para==5) {
                                    $tabla=5   ;                    
                                             }
                                if ($tabla_para==6) {
                                    $tabla=6;
                                }
                                 
                                $para=$key['de'];
                                $de=$_SESSION['Id_Doc'];
                                $reenvio=$key['ides'];

                                if ($key['visto']==0) {
                                    
                                    $chat->actualizar_estado_mensaje($key['id']);
                                }
                                if ($key[6]!='' && $key['tabla_de']==5) {  
                                     $nombre= strtoupper($key[6].' '.$key[7]);
                                     $foto=$key[8];
                                     $rol='Docente';
                                }  

                                if ($key[9]!='' && $key['tabla_de']==1) { 
                                   $nombre= strtoupper($key[9].' '.$key[10]);
                                    $foto=$key[11];

                                    $rol='Rector';
                                } 
                                if ($key[9]!='' && $key['tabla_de']==2) { 
                                    $nombre= strtoupper($key[9].' '.$key[10]);
                                    $foto=$key[11];
                                    $rol='Coordinador';
                                } 
                                if ($key[9]!='' && $key['tabla_de']==3) { 
                                    $nombre= strtoupper($key[9].' '.$key[10]);
                                    $foto=$key[11];
                                    $rol='Psicoorientador';
                                } 
                                if ($key[9]!='' && $key['tabla_de']==4) { 
                                    $nombre= strtoupper($key   [9].' '.$key   [10]);
                                    $foto=$key [11];
                                    $rol='Secretaria';
                                } 
                                if ($key[18]!='' && $key['tabla_de']==6) { 
                                    $nombre= strtoupper($key   [9].' '.$key   [10]);
                                    $foto=$key [11];
                                    $rol='Alumno';
                                } 
                              

                                if ($foto=='') {
                                    $foto='../../../logos/usuario.png';
                                }  
                                  
                                // fin validacion dattos

                                //preguntamos si tiene un mensaje reenviado
                                if ($key['reenvio']!=0) {
                                    //consultamas  el re envio del mensaej y se reccorre

                                    $variable=$chat->consultar_mensaje_reenviado($key['reenvio']);
                                    foreach ($variable as $ke) {  
                                       
   

                                         if ($ke['dirigido']==1) {
                                             
                                            $pin= "Rector";
                                        } if ($ke['dirigido']==2) {
                                            $pin= "Coordinador";
                                           
                                        } if ($ke['dirigido']==3) {
                                            $pin= "Psicoorientador";
                                           
                                        } if ($ke['dirigido']==4) {
                                            $pin= "Secretaria";
                                           
                                        } if ($ke['dirigido']==5) {
                                            $pin= "Docente";
                                             
                                        } if ($ke['dirigido']==6) {
                                            $pin= "Alumno";
                                           
                                        } if ($ke['dirigido']==7) {
                                            $pin= "Todos los administradores";
                                        }  if ($ke['dirigido']==8) {
                                            $pin= "Todos los administradores y docentes";
                                        }  if ($ke['dirigido']==9) {
                                            $pin= "Todos los  docentes y alumnos";
                                        }  if ($ke['dirigido']==10) {
                                            $pin= "Toda la comunidad educativa";
                                        }

                                        $foto1=$_SESSION['foto'];
                                         
                                        if ($_SESSION['foto']=='' && $_SESSION['genero']==1) {
                                            $foto1='../../../logos/femenino.png';
                                        }if ($_SESSION['foto']=='' && $_SESSION['genero']==0) {
                                            $foto1='../../../logos/masculino.png'; 
                                        }
                                        ?>  
                          
                                        <div class="box   collapsed-box  " style="border: solid 3px #fff;">
                                            <div class="box-header with-border">
                                                <span   style=" font-size: 16px">Mensaje Reenviado </span> 
                                                <div class="collapsed-box  box-tools " style="  margin-left: 40px;position: relative; float:right;">
                                                    <small >
                                                        <?php date_default_timezone_set('Europe/Madrid');
                                                        setlocale(LC_TIME, 'es_ES.UTF-8');
                                                        setlocale(LC_TIME, 'spanish');  
                                                        echo$inicio = strftime("%A %d de %B  ", strtotime($ke['fecha']));
                                                        echo date('g:i a', strtotime($ke['fecha'])); ?>
                                                    </small> 
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div> 
                                            </div>  
                                            <div class="box-body" style="display: none;">
                                                
                                                <img class="   img-circle" src="<?php echo $foto1 ?>" alt="" style=" float: left;   margin: 0 auto;width: 109px;  height: 141px;padding: 3px;border: 3px solid #d2d6de;margin: 10px">  

                                                <div class=" " style='margin-left: 10px'>
                                                    <div class=" " style=""><br>
                                                        
                                                        <strong  >
                                                            De:    
                                                        </strong> <?php echo $_SESSION['Nom_U'].' '.$_SESSION['Ape_U'] ?> <br>
                                                        <strong>Rol:</strong><span > <?php echo $_SESSION['Rol'] ?> </span><br> 
                                                        <strong>Para:</strong> <?php echo $pin ?> <br>
                                                        <strong >Asunto: </strong>
                                                        <?php echo$ke['asunto']; ?>  
                                                       
                                                    </div>
                                                    
                                                </div>
                                                <div style="margin-left: 10px ">
                                                     
                                                    <div class="mailbox-read-message table table-responsive">
                                                        <?php echo($ke['mensaje']); ?>
                                                    </div>
                                                </div>  <?php
                                                if($ke['archivo']!=""){
                                                ?>
                                                    <div style="margin: 18px ">
                                                        <strong>Archivo:</strong><br>
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item"    src="../../../ajax/mensajeria/imagen/<?php echo($ke['archivo']) ?>"></iframe>
                                                        </div>
                                                    </div> <?php
                                                }
                                                ?>
                                            </div> 
                                        </div>  <?php 
                                    }// fin de la cunsulta de l recorrido
                                } //fin de la pregunta del reenvi
                                ?>


                                <div class="box-header with-border">
                                    <span  style=" font-size: 16px">  Mensaje enviado</span>
                                    <div style="float:right;">
                                                <small >
                                                    <?php date_default_timezone_set('Europe/Madrid');
                                                    setlocale(LC_TIME, 'es_ES.UTF-8');
                                                    setlocale(LC_TIME, 'spanish');  
                                                    echo$inicio = strftime("%A %d de %B  ", strtotime($key['fecha']));
                                                    echo date('g:i a', strtotime($key['fecha'])); ?>
                                                </small> 

                                             
                                                 
                                            </div>
                                </div>
                                <img class="   img-circle" src="<?php echo $foto ?>" alt="" style=" float: left;   margin: 0 auto;width: 109px;  height: 141px;padding: 3px;border: 3px solid #d2d6de;margin: 10px">  

                                <div class=" " style='margin-left: 10px'>
                                    <div class=" " style=""><br>
                                        
                                        <strong  ><?php echo $nombre ?></strong>  <br>
                                        <strong>Rol:</strong><span > <?php echo $rol ?></span><br> 
                                        <strong>Para:</strong>  
                                        <?php  if ($key['dirigido']==1) {
                                            echo "Rector";
                                        } if ($key['dirigido']==2) {
                                            echo "Coordinador";
                                        } if ($key['dirigido']==3) {
                                            echo "Psicoorientador";
                                        } if ($key['dirigido']==4) {
                                            echo "Secretaria";
                                        } if ($key['dirigido']==5) {
                                            echo "Docente";
                                        } if ($key['dirigido']==6) {
                                            echo "Alumno";
                                        } if ($key['dirigido']==7) {
                                            echo "Todos los administradores";
                                        }  if ($key['dirigido']==8) {
                                            echo "Todos los administradores y docentes";
                                        }  if ($key['dirigido']==9) {
                                            echo "Todos los  docentes y alumnos";
                                        }  if ($key['dirigido']==10) {
                                            echo "Toda la comunidad educativa";
                                        } ?> <br>
                                        <strong >Asunto: </strong>
                                        <?php echo$key['asunto']; ?>  
                                       
                                    </div>
                                    
                                </div>
                                <div style="margin-left: 10px ">
                                     
                                    <div class="mailbox-read-message table table-responsive">
                                        <?php echo($key['mensaje']); ?>
                                    </div>
                                </div>  <?php
                                $archivo=$key['archivo'];
                                $mensaje=$key['mensaje'];
                                $asunto=$key['asunto'];
                                if($key['archivo']!=""){
                                ?>
                                    <div style="margin: 18px ">
                                        <strong>Archivo:</strong><br>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"    src="../../../ajax/mensajeria/imagen/<?php echo($key['archivo']) ?>"></iframe>
                                        </div>
                                    </div> <?php
                                } 

                            } ?><br>
                            <!-- /. box -->
                         
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



<script src="https://don3y87ddu1r5.cloudfront.net/ckeditor/ckeditor.js"></script>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 

<script src="../../../js/jquery.loadingModal.js"></script>


<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
 

  
 