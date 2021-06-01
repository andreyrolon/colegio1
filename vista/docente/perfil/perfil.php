<?php 
 session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../login.php"); echo($_SESSION['Session']);
    }
include "../../../codes/rector/docente.php"; 
$docente=new docente(); 
if(isset($_POST['foto'])){
    if($_FILES['file']['name']!=""){
        $url=$_POST['url'];
        unlink("$url");/* Esto es para borrar un archivo en este caso la foto de perfil :D*/
        $chat->form6($_POST['id'],$_FILES);
    }
}

require_once "../../../codes/rector/admin.php";
$admin=new admin();
$paiss=$admin->pais();


include('../enlaces/head.php');
include('../enlaces/header.php');
$where="WHERE docente.id_docente=".$_SESSION['Id_Doc'];
$consulta=$docente->docente_ver($where);
?>
<style>
    .col-md-12 {
        margin-bottom: 20px;
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
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <?php
                foreach($consulta as $key){
                    $estadito='';
                    if($key['estado']!=''){
                        $estado='<option value="'.$key['estado'].'">'.$key['estado'].'</option>'; 
                        $estadito=$key['estado'];
                    } else{
                        $estado='';
                    }
                    if($key['ciudad']!=''){
                        $ciudad=$key['ciudad'];    
                    } else{
                        $ciudad='';
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo($key['foto']); ?>" alt="User profile picture" style="height: 100px;">
                                    <h3 class="profile-username text-center">
                                        <?php echo($key['nombre']." ".$key['apellido']); ?>
                                    </h3>

                                    <p class="text-muted text-center">Docente</p>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Sobre mi</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                                    <p class="text-muted">
                                        <?php
                                            $var="WHERE titulos.ID_ADMIN=".$_SESSION['Id_Doc'];
                                            $consul=$docente->titulos_perfil($var);
                                            foreach($consul as $value){
                                                echo('<i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 9px;"></i> '.$value['nombre']."<br>");
                                            }
                                        ?>
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                                    <p class="text-muted">
                                        <?php echo($key['direccion']) ?>
                                        <?php echo($key['barrio']) ?>
                                    </p>

                                    <hr>
                                    <form action="" method="post" enctype="multipart/form-data" id="formAjax">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
                                            <input type="file" name="file" id="file">
                                        </div>
                                        <input type="hidden" name="url" id="url" value="<?php echo($key['foto']); ?>">
                                        <input type="hidden" name="id" id="id" value="<?php echo($_SESSION['Id_Doc']); ?>">
                                        <button type="submit" class="btn btn-primary" name="foto" id="foto">Subir</button>
                                    </form>
                                    <hr>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#activity" data-toggle="tab">Datos Personales</a></li>
                                <li><a href="#timeline" data-toggle="tab">Información de Contacto</a></li>
                                <li><a href="#settings" data-toggle="tab">Información laboral</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <form id="myForm" action="" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <label for="genero">Tipo documento</label>
                                                <select name="tipo_documento" id="tipo_documento" class="form-control" value=''  style="  <?php echo  $tin ?>" required=""  onchange='var tex= document.getElementById("tipo_documento").value; var columna="tipo_documento";actualizar(columna,tex); '>
                                                    <option value="1">Tarjeta de Identidad</option>
                                                    <option value="2">Cedula Ciudadania</option>
                                                    <option value="3">Cedula Extranjeria</option> 
                                                    <option value="5">Permiso Especial Permanencia(PEP)</option> 
                                                    <option value="4">Pasaporte</option> 
                                                    <option value="6">Registro Civil</option>
                                                  </select><div id="wTIPO_DOCUMENTO" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div> 
                                                </div>


                                                <div class="col-md-4">
                                                    <label for=" ">Documento</label><br>
                                                     <input type="number" class="form-control" value="<?php echo($key['numero_documento']); ?>"  onchange='var tex= document.getElementById("numero_documento").value; var columna="numero_documento";actualizar(columna,tex); '>

                                                     <div id="wnumero_documento" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div> 
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=" ">Expedida</label><br>
                                                     <input type=" " class="form-control" value="<?php echo($key['expedicion']); ?>"  onchange='var tex= document.getElementById("expedicion").value; var columna="expedicion";actualizar(columna,tex); '>
                                                     
                                                     <div id="wexpedicion" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div> 
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                

                                                <div class="col-md-4">
                                                    <label for=" ">Nombres</label><br>
                                                     <input type=" " class="form-control" value="<?php echo($key['nombre']); ?>"  onchange='var tex= document.getElementById("nombre").value; var columna="nombre";actualizar(columna,tex); '>
                                                     
                                                     <div id="wnombre" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div> 
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=" ">Apellidos</label><br>
                                                     <input type=" " class="form-control" value="<?php echo($key['apellido']); ?>"  onchange='var tex= document.getElementById("apellido").value; var columna="apellido";actualizar(columna,tex); '>
                                                     
                                                     <div id="wapellido" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div> 
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="apellido">Genero</label>
                                                    <select class="form-control" id="genero" name="genero" style=' <?php echo $tin ?>'  onchange='var tex= document.getElementById("genero").value; var columna="genero";actualizar(columna,tex); ' >
                                                        <option value="1">
                                                        Femenino </option>
                                                        <option value="0">Masculino</option>
                                                    </select>
                                                    <div id="wgenero" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div> 
                                                </div>

 
                                            </div>
                                             
                                            <div class="col-md-12">
                                            <div class="col-md-6">
                                                <label for="fecha_n">Fecha nacimiento</label>
                                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo $key['fecha_nacimiento'] ?>" style=' <?php echo $tin ?>'  onchange='var tex= document.getElementById("fecha_nacimiento").value; var columna="fecha_nacimiento";actualizar(columna,tex); ' >
                                                <div id="wfecha_nacimiento" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nombre">Pais de nacimiento </label><br>
                                                    <select name="pais" id='pais' class="form-control select2"  style="  <?php echo  $style ?>" onchange='              var tex=document.getElementById("pais").value;var columna="pais";actualizar1(columna,tex) ' required>
                                                    <option value="<?php echo 's,'.$key['pais'] ?>"><?php echo $key['pais'] ?></option>
                                                    <?php foreach ($paiss as $key ) {
                                                        if ( $key['paisnombre']!=$key['pais']) { ?>
                                                            <option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?>   </option>
                                                          <?php
                                                        }
                                                    } ?> 
                                                  </select>
                                                  <div id="wpais" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

 
                                            <div class="col-md-6">
                                                <label for="fecha_n">Departamento nacimiento</label>
                                                <select name="estado" id='estado' class="form-control select2" onchange='var tex= document.getElementById("estado").value; var columna="estado";actualizar(columna,tex); ' >
                                                    <?php echo $estado ;

                                                    $es=$admin->estado($key['pais']);
                                                    foreach ($es as $key ) {
                                                        if ( $key['estadonombre']!=$estadito) {
                                                            ?>
                                                            <option value="<?php echo $key['estadonombre'] ?>"><?php echo $key['estadonombre'] ?></option>
                                                            <?php
                                                        }
                                                    }

                                                    ?>
                                                </select>

                                                <div id="westado" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lugar_n">ciudad nacimiento</label>
                                                <input type="text" name="ciudad" id="ciudad" class="form-control" value="<?php echo $ciudad ?>" style=' <?php echo $tin ?>' onchange='var tex= document.getElementById("ciudad").value; var columna="ciudad";actualizar(columna,tex); ' >
                                                <div id="wciudad" style=" display: none; color: #4BB1F1"><i style="margin-top: 10px; " class="fa fa-check"></i>Campo Actualizado <br></div><br>
                                            </div> 
                                        </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="timeline">
                                    <form id="Form" action="" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" value="<?php echo($key['correo']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="celular">Celular</label>
                                                    <input type="number" name="celular" id="celular" class="form-control" value="<?php echo($key['celular']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label for="telefono">Telefono</label>
                                                    <input type="number" name="telefono" id="telefono" class="form-control" value="<?php echo($key['telefono']) ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="direccion">Direccion</label>
                                                    <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo($key['direccion']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <label for="barrio">Barrio</label>
                                                    <input type="text" name="barrio" id="barrio" class="form-control" value="<?php echo($key['barrio']); ?>">
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <form id="FormLa" action="" method="post">
                                        <div class="row">
                                            <?php
                                            $var="WHERE titulos.ID_ADMIN=".$_SESSION['Id_Doc'];
                                            $consul=$docente->titulos_perfil($var);
                                            $con=0;
                                            foreach($consul as $value){
                                                $con++;
                                            ?>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <label for="titulo">Titulo</label>
                                                    <input type="text" name="titulo<?php echo($con); ?>" id="titulo<?php echo($value['id_titulos']); ?>" class="form-control" value="<?php echo($value['nombre']); ?>" onchange="xxx(<?php echo($value['id_titulos']); ?>)">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="institucion">Graduado de</label>
                                                    <input type="text" name="institucion<?php echo($con); ?>" id="institucion<?php echo($value['id_titulos']); ?>" class="form-control" value="<?php echo($value['institucion']); ?>" onchange="ins(<?php echo($value['id_titulos']); ?>)">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="institucion">Graduado de</label>
                                                    <input type="text" name="institucion<?php echo($con); ?>" id="anual<?php echo($value['id_titulos']); ?>" class="form-control" value="<?php echo($value['ano']); ?>" onchange="anual(<?php echo($value['id_titulos']); ?>)">
                                                </div>
                                            </div>
                                            <?php  
                                        }
                                    ?>
                                            <div class="col-md-12">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <label for="escalafon">Escalafon</label>
                                                    <input type="number" name="escalafon" id="escalafon" class="form-control" value="<?php echo($key['escalafon']) ?>">
                                                </div>
                                                <div class="col-md-3"><button type="button" name="nuevo" id="nuevo" class="btn btn-info" style="margin-top: 23px;">Nuevo titulo</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                         <div class="box box-primary" id="titulo_ver" style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 10px " >
                        <div class="row"> 
                            <div class="col-md-12" style="padding-left: 50px;padding-right: 50px;padding-top: 10px">
                             <div id="_MSG_" style=' <?php echo $tin ?>'></div> 
                                <label for="escalafon">Clave actual</label>
                                <center>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password1" placeholder="Contraseña">
                                    <span class="input-group-btn">
                                       <button    id='ojo1' onclick="mostrarContrasena1()"  class="btn btn-default" type="button" style="display: none;color: #3c8dbc">
                                          <i class="fa fa-eye fa-lg" id=""></i>             
                                       </button>
                                       <button   onclick="mostrarContrasena1()" id='ojo1n'  class="btn btn-default" type="button" style="color: #3c8dbc">
                                          <i class="fa  fa-eye-slash fa-lg" id=""></i>              
                                       </button>
                                    </span>
                                </div></center>



                                <br> 
                                <label for="escalafon">Nueva Clave</label>
                                <center>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password2" placeholder="Contraseña">
                                    <span class="input-group-btn">
                                       <button    id='ojo2' onclick="mostrarContrasena2()"  class="btn btn-default" type="button" style="display: none;color: #3c8dbc">
                                          <i class="fa fa-eye fa-lg" id=""></i>             
                                       </button>
                                       <button   onclick="mostrarContrasena2()" id='ojo2n'  class="btn btn-default" type="button" style="color: #3c8dbc">
                                          <i class="fa  fa-eye-slash fa-lg" id=""></i>              
                                       </button>
                                    </span>
                                </div></center>
                                
                                <br>
                                <label for="escalafon">Confirmar Clave</label>
                                 
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passwordf" placeholder="Contraseña">
                                    <span class="input-group-btn">
                                       <button    id='ojo3' onclick="mostrarContrasena()"  class="btn btn-default" type="button" style="display: none;color: #3c8dbc">
                                          <i class="fa fa-eye fa-lg" id=""></i>             
                                       </button>
                                       <button   onclick="mostrarContrasena()" id='ojo3n'  class="btn btn-default" type="button" style="color: #3c8dbc">
                                          <i class="fa  fa-eye-slash fa-lg" id=""></i>              
                                       </button>
                                    </span>
                                </div> 

                                 <br><button style="ma" type="button" class="btn   btn-info"  onclick="contra()">Actualizar Contraseña</button><br>
                                <script>
                                    function mostrarContrasena(){
                                        var tipo = document.getElementById("passwordf");
                                        if(tipo.type == "password"){
                                              tipo.type = "text";
                                              document.getElementById('ojo3').style.display='block'
                                              document.getElementById('ojo3n').style.display='none';
                                              tipo.focus();
                                        }else{
                                            tipo.type = "password";tipo.focus(); 
                                              document.getElementById('ojo3n').style.display='block';
                                              document.getElementById('ojo3').style.display='none';
                                        }
                                    }
                                    function mostrarContrasena2(){
                                        var tipo = document.getElementById("password2");
                                        if(tipo.type == "password"){
                                              tipo.type = "text";tipo.focus();
                                            document.getElementById('ojo2').style.display='block'
                                              document.getElementById('ojo2n').style.display='none'
                                        }else{
                                            tipo.type = "password";tipo.focus();
                                            document.getElementById('ojo2').style.display='none'
                                              document.getElementById('ojo2n').style.display='block'
                                        }
                                    }
                                    function mostrarContrasena1(){


                                        var tipo = document.getElementById("password1");
                                        if(tipo.type == "password"){
                                            tipo.type = "text";tipo.focus();
                                            document.getElementById('ojo1').style.display='block'
                                              document.getElementById('ojo1n').style.display='none'
                                        }else{
                                            tipo.type = "password";                                           tipo.focus();
                                            document.getElementById('ojo1').style.display='none'
                                              document.getElementById('ojo1n').style.display='block'
                                        }
                                    }
                                </script>
                            </div> 
                              
                        </div>
                        
                    </div> 
                        <!-- /.col -->
                    </div>
                </div>
                <?php
                     }
                ?>

            </section>
        </div>
    </div>
    <script>
    document.getElementById('tipo_documento').value='<?php echo($key['tipo_documento']); ?>';
    document.getElementById('genero').value='<?php echo($key['genero']); ?>';
     
    $(document).ready(function(){ 
        $("#myForm").change(function() {alert('sdfsf');
        });});
        $("#Form").change(function() {
            var str = $("#Form").serialize();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/perfil.php?action=form2",
                data: str,
                dataType: "text",
                success: function(data) {
                    swal("Datos actualizados!!")
                }
            });
        });
        $("#FormLa").change(function() {
            var str = $("#FormLa").serialize();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/perfil.php?action=form5",
                data: str,
                dataType: "text",
                success: function(data) {
                    swal("Datos actualizados!!")
                }
            });
        });

        function xxx(c) {
            var x = $('#titulo' + c).val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/perfil.php?action=form3",
                data: {
                    x,
                    c
                },
                dataType: "text",
                success: function(data) {
                    swal("Datos actualizados!!")
                }
            });
        }

        function ins(c) {
            var x = $('#institucion' + c).val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/perfil.php?action=form4",
                data: {
                    x,
                    c
                },
                dataType: "text",
                success: function(data) {
                    swal("Datos actualizados!!")
                }
            });
        }

        function anual(c) {
            var x = $('#anual' + c).val();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/perfil.php?action=form7",
                data: {
                    x,
                    c
                },
                dataType: "text",
                success: function(data) {
                    swal("Datos actualizados!!")
                }
            });
        }
        $("#ingresar").click(function(event) {
            event.preventDefault();
            var str = $("#FormT").serialize();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/perfil.php?action=nuevo_titulo",
                data: str,
                dataType: "text",
                success: function(data) {
                    swal("Ingresado Nuevo Titulo!!")
                    $('#titulo_ver').css('display', 'none');
                }
            });
        });
         

    </script><div class="col-md-3"><button type="submit" name="ingresar" id="ingresar" class="btn btn-primary" style="margin-top: 24px;">Ingresar</button></div>
</body>




<?php include('../enlaces/footer.php'); ?>
