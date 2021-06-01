<?php
session_start();
require_once "../../../codes/alumno/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../login.php");
    } 
include('../../docente/enlaces/head.php'); 
 
 $id=$_GET['id'];
$var=$chat->mensajes_recividos($_SESSION['Id_Doc'],$id);
include('../enlaces/head.php');
    

  
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
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
     body::-webkit-scrollbar{
width: 0px;


    }
    #sapo::-webkit-scrollbar{
width: 6px;


    }
    #sapo::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #3c8dbc;


    }
       
    @media only screen and (max-width: 1700px) {
  #sapo { 
    height:670px;
                                overflow: auto;
  }
}  
    @media only screen and (max-width: 1500px) {
  #sapo { 
    height: 590px;
                                overflow: auto;
  }
}
       @media only screen and (max-width: 1400px) {
  #sapo {
 
    
    height: 527px;
                                overflow: auto;
  }
}
  



       @media only screen and (max-width: 1200px) {
  #sapo {  
    height: 474px;
                                overflow: auto;
  }
}
</style>
<body style="<?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper"  >
        <?php include('../enlaces/header.php'); ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
         

            <!-- Main content -->
            <nav style="font-size: 1px;">hhoih</nav>
            <div id="sapo"  >
                <section class="content">
                
                    <div class="col-md-3">
                        <a href="enviar.php" style="width: 100%" class="btn   btn-primary  "><i class="fa fa-envelope-o" style="margin-right:9px;margin-top: 2px; float: left;"></i> <span style="float: left;">Crear Mensaje</span></a><br> <br>
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

                        <div id="_MSG_"  ></div>
                        <div class=" " style="margin-bottom: 10px; border-top:solid 3px #00c0ef; background: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <?php  

 

 

                            foreach($var as $key){ 
                                
                                if ($key['visto']==0) {
                                    
                                    $chat->actualizar_estado_mensaje($key['id']);
                                }
                                $tabla_para=$key['tabla_de']; 
                                $para=$key['de'];
                                $de=$_SESSION['Id_Doc'];
                                $reenvio=$key['ides'];
                                // validar datos del remitente como foto nombre y rol
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
                                    $nombre= strtoupper($key[9].' '.$key[10]);
                                    $foto=$key[11];
                                    $rol='Secretaria';
                                } 
                                if ($key[17]!='' && $key['tabla_de']==6) {  
                                    $nombre= strtoupper($key[17].' '.$key[18]);
                                    $foto=$key[19];
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
                                        if ($tabla_para==6) {
                                            $pin='Alumno';
                                        } 
                                        if ($tabla_para==5) {
                                            $pin='Docente';
                                        } 
                                        if ($tabla_para==2) {
                                            $pin='Coordinador';
                                        } 
                                        if ($tabla_para==3) {
                                            $pin='Sicoorientador';
                                        } 
                                        if ($tabla_para==4) {
                                            $pin='Secretaria';
                                        } 
                                        if ($tabla_para==1) {
                                            $pin='Rector';
                                        }


                                        if ($ke[2]!='' && $ke['tabla_de']==5) {  
                                             $nombre1= strtoupper($ke[2].' '.$ke[3]);
                                             $foto1=$ke[4];
                                             $rol1='Docente';
                                        }
                                        if ($ke[2]!='' && $ke['tabla_de']==6) {  
                                             $nombre1= strtoupper($ke[2].' '.$ke[3]);
                                             $foto1=$ke[4];
                                             $rol1='Alumno';
                                        }  

                                        if ($ke[5]!='' && $ke['tabla_de']==1) { 
                                            $nombre1= strtoupper($ke[5].' '.$ke[6]);
                                            $foto1=$ke[7];
                                            $rol1='Rector';
                                        } 

                                        if ($ke[5]!='' && $ke['tabla_de']==2) { 
                                            $nombre1= strtoupper($ke[5].' '.$ke[6]);
                                            $foto1=$ke[7];
                                            $rol1='Coordinador';
                                        } 

                                        if ($ke[5]!='' && $ke['tabla_de']==3) { 
                                            $nombre1= strtoupper($ke[5].' '.$ke[6]);
                                            $foto1=$ke[7];
                                            $rol1='Psicoorientador';
                                        } 

                                        if ($ke[5]!='' && $ke['tabla_de']==4) { 
                                            $nombre1= strtoupper($ke[5].' '.$ke[6]);
                                            $foto1=$ke[7];
                                            $rol1='Secretaria';
                                        } 

                                       





                                        if ($ke[8]!='' && $ke['tabla_de']==6) {  
                                            $nombre1= strtoupper($ke[8].' '.$ke[9]);
                                            $foto1=$ke[10];
                                            $rol1='Alumno';
                                        } 

                                        if ($foto1=='') {
                                            $foto1='../../../logos/usuario.png';
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
                                                        
                                                        <strong  ><?php echo $nombre1 ?></strong>  <br>
                                                        <strong>Rol:</strong><span > <?php echo $rol1 ?></span><br> 
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
                                    <span  style=" font-size: 16px">Mensaje enviado</span>
                                    <div style="float:right;">
                                                <small >
                                                    <?php date_default_timezone_set('Europe/Madrid');
                                                    setlocale(LC_TIME, 'es_ES.UTF-8');
                                                    setlocale(LC_TIME, 'spanish');  
                                                    echo$inicio = strftime("%A %d de %B  ", strtotime($key['fecha']));
                                                    echo date('g:i a', strtotime($key['fecha'])); ?>
                                                </small> 

                                                <button  style="background: #fff;border: none" type="button" class="lop" style="" id="f1" value="1" data-title="Responder" 
                                                onclick="
                                                var re= document.getElementById('re').value;
                                                if (re==0) {

                                                    document.getElementById('ver').style.display='block';
                                                    document.getElementById('ver52').style.display='none'; 
                                                    document.getElementById('asunto1').focus();
                                                    
                                                    document.getElementById('re2').value=0;
                                                    document.getElementById('re').value=1;
                                                }else{

                                                    document.getElementById('ver').style.display='none'; 
                                                    document.getElementById('re').value=0;

                                                }"><i class="fa fa-reply"></i></button>

                                                <button  style="background: #fff;border: none" type="button" style=";" class="lop " id="f3" data-title="  Reenviar  " value="3" onclick="
                                                var re= document.getElementById('re2').value;
                                                if (re==0) {

                                                    document.getElementById('ver52').style.display='block';
                                                    document.getElementById('ver').style.display='none';
                                                    document.getElementById('re').value=0;  
                                                    document.getElementById('re2').value=1;
                                                }else{

                                                    document.getElementById('ver52').style.display='none'; 
                                                    document.getElementById('re2').value=0;

                                                }"><i class="fa fa-share"></i></button> 
                                                 
                                            </div>
                                </div>
                                <img class="   img-circle" src="<?php echo $foto ?>" alt="" style=" float: left;   margin: 0 auto;width: 109px;  height: 141px;padding: 3px;border: 3px solid #d2d6de;margin: 10px">  

                                <div class=" " style='margin-left: 10px'>
                                    <div class=" " style=""><br>
                                        
                                        <strong  ><?php echo $nombre ?></strong>  <br>
                                        <strong>Rol:</strong><span > <?php echo $rol ?></span><br> 
                                        <strong>Para:</strong>  
                                        <?php
                                         if ($key['dirigido']==1) {
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

                            } ?>
                            <!-- /. box -->
                            <div class="box-footer">
                                <form action="" method="post">
                                    <input type="hidden" id="re" value="0">
                                    <input type="hidden" id="re2" value="0">
                                    <button   style="background: #fff;border: solid 1px #EEE;" class="btn btn" type="button" class="lop" style="" id="f1" value="1" onclick="
                                    var re= document.getElementById('re').value;
                                    if (re==0) {

                                        document.getElementById('re').value=1;
                                        document.getElementById('ver52').style.display='none'; 
                                        document.getElementById('ver').style.display='block';
                                        document.getElementById('asunto1').focus();
                                        document.getElementById('re2').value=0;
                                    }else{

                                        document.getElementById('ver').style.display='none'; 
                                        document.getElementById('re').value=0;

                                    }">
                                        <i class="fa fa-reply"></i> Responder
                                    </button>
                                    <button  style="background: #fff;border: solid 1px #EEE;" class="btn btn" type="button" style=";" class="lop " id="f3" value="3" onclick="
                                    var re= document.getElementById('re2').value;
                                    if (re==0) {

                                        mostrar_do();
                                        document.getElementById('re').value=0;
                                        document.getElementById('re2').value=1;
                                        document.getElementById('ver52').style.display='block'; 
                                        document.getElementById('ver').style.display='none'; 
                                    }else{

                                        document.getElementById('ver52').style.display='none'; 
                                        document.getElementById('re2').value=0;

                                    } ">
                                        Reenviar <i class="fa fa-share"></i>
                                    </button>
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i> Papelera</button>
                                    <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Mover a Papelera</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Desea  mover el mensaje a la  papelera?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="var elim=<?php echo $id ?>; eliminar(elim)" name="aceptar" class="btn btn-primary">  Aceptar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="ver52" style="display: none;">
                                <form action="" id="formulario-envia" name="formulario-envia" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" id="tabla" name="tabla">
                                            <label for="usuario">Para:</label>
                                            
                                            <div  id="select_docentef"  >
                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <strong>Asunto:</strong>
                                            <input class="form-control" placeholder="" value="<?php echo $asunto ?>" name="asunto" id='asunto' required>
                                        </div>
                                        <div class="form-group">

                                            
                                            <textarea id="compose-textarea" class="form-control" style="height: 300px" name="mensaje"><?php echo $mensaje ?></textarea> 
                                        </div>

                                        <div style="background-color: #f5f5f5;border: 1px solid transparent;" class="alert  ">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="
                                            document.getElementById('fifi').style.display='block';
                                            document.getElementById('invisible').value='';">×</button>

                                            <input type="hidden" name="invisible"  value="<?php echo $archivo ?>">
                                            <i class=" fa  fa-cloud-upload"></i>  

                                            <?php echo $archivo ?>
                                        </div>

                                        <div id="fifi" class="form-group" style="display: none;">
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> Adjuntar archivo
                                                <input type="file" name="files" value="">
                                            </div>
                                            <p class="help-block">Max. 20MB</p>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer"> 
                                        <button type="submit" style="" class="btn btn-primary" name="send"><i class="fa  fa-send-o"></i> Enviar Mensaje</button>
                                        <button type="button" style="" class="btn btn-danger"onclick="document.getElementById('ver52').style.display='none'"  name="send"><i class="fa fa-remove" ></i> Cancelar Mensaje</button> 
                                    </div>
                                </form>
                            </div>
                            <div id="ver" style="display: none;">
                                <form action="" id="formulario-envia1" name="formulario-envia1" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" id="tabla_para" name="tabla_para" value="<?php echo $tabla_para ?>">
                                        <input type="hidden" id="reenvio" name="reenvio" value="<?php echo $reenvio ?>">
                                        <input type="hidden" id="de" name="de" value="<?php echo $de ?>">
                                        <input type="hidden" id="para" name="para" value="<?php echo $para ?>">
                                        

                                        
                                          
                                        
                                    <div class="form-group">
                                        <strong>Asunto:</strong>
                                        <input class="form-control" placeholder="" value="" name="asunto1" id="asunto1" required>
                                    </div>
                                    <div class="form-group">

                                        
                                        <textarea id="compose-textarea1" class="form-control" style="height: 300px" name="mensaje1"></textarea> 
                                    </div>
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Adjuntar archivo
                                            <input type="file" name="files1" >
                                        </div>
                                        <p class="help-block">Max. 20MB</p>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer"> 
                                    <button type="submit" style="" class="btn btn-primary" name="send"><i class="fa  fa-send-o"></i> Enviar Mensaje</button>
                                    <button type="button" style="" class="btn btn-danger" name="send" onclick="document.getElementById('ver').style.display='none'"><i class="fa fa-remove" ></i> Cancelar Mensaje</button> 
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                </section><div class="col-md-12 main" style=" background-color: #fff"> 
                                    <div  style="padding: 10px" >
                                        <div class="pull-right -xs">
                                            <b> IBUnotas</b> 1.0
                                        </div>
                                        <strong>Desarrollado por  IBUsoft. <br></strong>  
                                    </div>
                                </div>
                <!-- /.row -->
            </div>
            <!-- /.content -->
        </div>

         
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
<script>

  

    $('.select2').select2({});
 
    function mostrar(){
        $('body').loadingModal({text: 'Cargando...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }

    CKEDITOR.replace('compose-textarea',{
        height:300,
        filebrowserUploadUrl:'../../../ajax/mensajeria/mensaje.php' 
    });
    var editor = CKEDITOR.instances['compose-textarea'];

    CKEDITOR.replace('compose-textarea1',{
        height:300,
        filebrowserUploadUrl:'../../../ajax/mensajeria/mensaje.php' 
    });
    var editor1 = CKEDITOR.instances['compose-textarea1'];

    function eliminar(elim){
        mostrar();
        $.ajax({

            type: "post",
            url: "../../../ajax/docente/mensaje.php?action=papelera",

            data: {
                elim
            },
            dataType: "text",

            success: function(data) {
                location.assign("recividos.php");
            }
        }); 
    }

    $(document).on("submit", "#formulario-envia1", function(e){
    e.preventDefault();  
        mostrar();
  
        var parametros=new FormData($("#formulario-envia1")[0]);
        $.ajax({

            data:parametros,
            url:"../../../ajax/alumno/mensaje.php?action=reenvio",
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
    });


    function mostrar_do() {  
        mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/mensaje.php?action=consultar_docente",
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    $('#select_docentef').html(data);
                }
            });
        }
    $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault();  
        mostrar();
  
        var parametros=new FormData($("#formulario-envia")[0]);
        $.ajax({

            data:parametros,
            url:"../../../ajax/alumno/mensaje.php?action=registrar",
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
    });


 
</script>