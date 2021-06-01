<?php
session_start();
require_once "../../../codes/alumno/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes();
$acudiente=$chat->acudiente();

 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../login.php");
    } 
include('../../docente/enlaces/head.php'); 
?>
 
 
  
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  <style type="text/css">
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
    #sapo{
        height: 664px;
                                overflow: auto;
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
            .label{
                padding: 5px
            }
           
            .bin{
                color: #333;
                background-color: #fff;
                border-color: #ccc;
                height: 33px;
            }
    .na{
        float: left;margin-right: 15px
    }


        </style>

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
 
    <div class="wrapper" class="form-control"  >
    <?php include('../enlaces/header.php');  
        $foto=$_SESSION['Foto'];
        $genero='Masculino'; 
        if ($_SESSION['Foto']=='' && $_SESSION['genero']==1) {
            $foto='../../../logos/niña.jpg'; 
            $genero='Femenino';   
        }
        if ( $_SESSION['genero']==1) { 
            $genero='Femenino';   
        }
        if ($_SESSION['Foto']=='' && $_SESSION['genero']==0) {
            $foto='../../../logos/niño.jpg';  
            $genero='Masculino';  
        }
       
        
     ?> 

        <div class="content-wrapper"   >  
            <div   class=" "> 
                 
             


                   
                   <nav style="font-size: 1px;">hhoih</nav>
                                            
                    <div id="tablaw" ></div>
                    <div  id="sapo"><br>  
                        <section class=" " >
                            <div  >
                                <div class="col-md-3">
                                    
                                    <div class="box box-info" style=" padding: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding-top: 10px">
                                         
                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $foto ?>" style="">
                                     
                                        <div style="padding-left: 10px;margin-top: 10px">
                                            <strong>Alumno:</strong> <br>
                                            <textarea disabled class="form-control"><?php echo mb_convert_case($_SESSION['Nom_U']." ".$_SESSION['Ape_U'], MB_CASE_TITLE, "UTF-8") ?>   </textarea class="form-control">
                                             <br>         
                                            <strong>Curso:</strong> <input disabled  type="text" class="form-control" value="<?php echo $_SESSION['grado'].'-'.$_SESSION['curso'] ?>"> 
                                             <br>     
                                            <strong>Sede:</strong><input  disabled type="text" class="form-control" value=" <?php echo $_SESSION['sede']  ?>"> <br>
                                            <strong>Jornada:</strong><input disabled  type="text" class="form-control" value=" <?php echo $_SESSION['sede']  ?>"> <br>
                                        </div>
                                         <br>

                                    </div>
                                    <!-- /.box -->
                                </div>
                                <div class="col-md-9">
                                    <div   style=" background-color: #fff;top: 0;padding-top: 0;
                                    overflow: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="tablaF">
                                         
                                        <div class="table-responsive"> 
                                            <table class="table"  >
                                                <tbody><tr>
                                                    <td id="rr1"style="border-top:solid 3px rgb(10 194 240);">
                                                        <a onclick="
                                                         document.getElementById('alumno').style.display = 'block';
                                                         document.getElementById('acudiente').style.display = 'none';
                                                         document.getElementById('disciplina').style.display = 'none';
                                                         var td1=document.getElementById('rr1').style.borderTop ='solid  3px #0ac2f0'; 
                                                         var td1=document.getElementById('rr2').style.borderTop ='solid #fff';
                                                         var td1=document.getElementById('rr3').style.borderTop ='solid #fff'; " href="#periodos" data-toggle="tab" aria-expanded="false" style="  color: #000 ">
                                                            <nav class='na' id="">Informacion del estudiantes</nav>
                                                        </a></td> 
                                                    <td id="rr2"  >
                                                        <a onclick="
                                                         document.getElementById('acudiente').style.display = 'block';
                                                         document.getElementById('alumno').style.display = 'none';
                                                         document.getElementById('disciplina').style.display = 'none';
                                                         var td1=document.getElementById('rr2').style.borderTop ='solid #0ac2f0'; 
                                                         var td1=document.getElementById('rr1').style.borderTop ='solid #fff';
                                                         var td1=document.getElementById('rr3').style.borderTop ='solid #fff'; " href="#TIPO" data-toggle="tab" aria-expanded="false" style="  color: #000 ">
                                                            <nav class='na' id="">Informacion del acudiente </nav>
                                                        </a>
                                                    </td>  
                                                 
                                                     <td id="rr3"  >
                                                        <a onclick="
                                                         document.getElementById('acudiente').style.display = 'none';
                                                         document.getElementById('alumno').style.display = 'none';
                                                         document.getElementById('disciplina').style.display = 'block';
                                                         var td1=document.getElementById('rr3').style.borderTop ='solid #0ac2f0'; 
                                                         var td1=document.getElementById('rr2').style.borderTop ='solid #fff';
                                                         var td1=document.getElementById('rr1').style.borderTop ='solid #fff';
                                                         var td1=document.getElementById('rr5').style.borderTop ='solid #fff';
                                                         var td1=document.getElementById('rr4').style.borderTop ='solid #fff';" href="#disciplina" data-toggle="tab" aria-expanded="false" style="color: #000 ">
                                                            <nav class='na' id="">Informacion del Disciplinaria </nav> 
                                                        </a>
                                                    </td>
                                                     
                                                </tr>
                                            </tbody></table>
                             
                                        </div>
                                        <div id="disciplina" style="display: none;">
                                            
                                        </div>
                                        <div id="acudiente" style="display: none;">
                                        <?php foreach ($acudiente as $key ){   ?>
                                                <div class="tab-pane active" id="timeline1"> 

                                                <strong style="    margin-left: 15px;" > <button class="btn btn-info"> Parentesco: <?php  echo $key['parentesco'] ?></button> </strong><br><br>
                                                    <div class="">
                                                        <div class="col-md-4">
                                                            <label for="nombre">Nombres</label>
                                                            <input type="" disabled  class="form-control" value="<?php echo $key['nombre'] ?>" name="nombre2" title='Nombres' ><br>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="nombre">Apellidos</label>  
                                                            <input type="" class="form-control" name="apellido2"value="<?php echo $key['apellido'] ?>" title='Apellidos'   disabled><br>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="nombre">Correo electronico</label>  
                                                            <input type="email" disabled title="Correo electronico"  class="form-control"value="<?php echo $key['email'] ?>"  name="emaila2"><br>
                                                        </div>
                                                    </div>   

                                                    <div class=" " id="ver21">
                                                      <div class="col-md-4">
                                                        <label for="nombre">Tipo de documento</label>
                                                        
                                                        <input type="" disabled title="Tipo de documento" class="form-control" value="<?php echo $key['tipo_documento'] ?>" ><br>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="nombre">Numero de documento</label>  
                                                        <input type="" disabled  title="Numero de documento" class="form-control" value="<?php echo $key['num_documento'] ?>" ><br>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="nombre">Lugar de expedición</label>
                                                        <input type="text" disabled title="Lugar de expedición" class="form-control"value="<?php echo $key['expedida'] ?>" ><br>
                                                      </div> 
                                                    </div><br>

                                                    <div class=" " id="ver22">
                                                      <div class="col-md-4">
                                                        <label for="nombre">Dirección</label>
                                                        <input name="direcciona2" disabled title="Dirección"  class="form-control" value="<?php echo $key['direccion'] ?>" ><br> 
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="nombre">Barrio</label>  
                                                        <input type="" disabled  title="barrio" class="form-control" value="<?php echo $key['barrio'] ?>" ><br>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="nombre">Telefono o celular</label>
                                                        <input type=" " disabled title="telefono"  class="form-control"  name="celulara2" value="<?php echo $key['celular'] ?>" ><br>
                                                      </div> 
                                                    </div>

                                                    <div class=" " id="ver23">  
                                                      <div class="col-md-4">
                                                        <label for="nombre">Ocupación</label>
                                                        <input name="ocupaciona2" title="Ocupación" disabled  class="form-control" id="" value="<?php echo $key['ocupacion'] ?>" > 
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="nombre">Dirección de trabajo</label>  
                                                        <input type=""  disabled class="form-control" title="Dirección de trabajo" name="direccion_trabajo2" value="<?php echo $key['direccion_trabajo'] ?>" >
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="nombre">Telefono de trabajo</label>
                                                        <input type="" disabled  class="form-control"  title="Telefono de trabajo"  value="<?php echo $key['telefono_trabajo'] ?>" ><br>
                                                      </div> 
                                                    </div> 
                                                </div>
                                        <?php } ?>
                                            </div>
                                        <div id="alumno">
                                            <div class="col-md-12">
                                                
                                                <div class="col-md-3">
                                                    <strong title="Pais de nacimiento">Pais N</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['pais_nacimiento'] ?>" disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Departamento de nacimiento">Departamento N</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['departamento_nacimiento'] ?>"  disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3"> 
                                                    <strong title="Ciudad xde nacimiento">Ciudad N</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['ciudad_nacimiento'] ?>"  disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Tipo de Documento">Tipo de Documento</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['tipo_documento'] ?>"  disabled>
                                                    <br>
                                                </div> 
                                            </div> 

                                            <div class="col-md-12">
                                               
                                                <div class="col-md-3">
                                                    <strong title="Numero Documento">Numero Documento</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['numero_documento'] ?>"  disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Pais de Expedicion">Pais Ex</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['pais_expedicion'] ?>"  disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Departamento de expedición">Departamento Ex</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['departamento_expedicion'] ?>" disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Ciudad de expedición">Ciudad Ex</strong>
                                                    <input type="" class="form-control"  value=" <?php echo $_SESSION['ciudad_expedido'] ?>"  disabled>
                                                    <br>
                                                </div> 
                                            </div>

                                            <div class="col-md-12">
                                               
                                                <div class="col-md-3">
                                                    <strong title="Fecha de Nacimiento">Fecha N</strong>
                                                    <input   class="form-control" value="<?php echo $_SESSION['fecha_nacimiento'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-2">
                                                    <strong title="Edad">Edad</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['edad'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Genero">Genero</strong>
                                                    <input type="" class="form-control" value=" <?php echo $genero ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-4">
                                                    <strong title="Pais de nacimiento">Correo electronico</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['correo'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                            </div>

                                            <div class="col-md-12">
                                               
                                                <div class="col-md-3">
                                                    <strong title="Dirección">Barrio</strong>
                                                    <input   class="form-control" value=" <?php echo $_SESSION['barrio'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-4">
                                                    <strong title="Edad">Dirección</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['direccion'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Telefono">Telefono</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['telefono'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-2">
                                                    <strong title="Estracto">Estracto</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['estrato'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                            </div>
                                            <div class="col-md-12">
                                               
                                                <div class="col-md-3">
                                                    <strong title="Dirección">Tipo Sangre</strong>
                                                    <input  class="form-control" value=" <?php echo $_SESSION['tipo_sangre'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Edad">Afiliación Salud</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['filiacion_salud'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Telefono">NIvel sisben</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['sisben_puntaje'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                                <div class="col-md-3">
                                                    <strong title="Estracto">Numero sisben</strong>
                                                    <input type="" class="form-control" value=" <?php echo $_SESSION['numero_carnet'] ?>"   disabled>
                                                    <br>
                                                </div> 
                                            </div>
                                        </div>
                                    </div> <br>

                                           
                                    
                                </div>
                                 
                            </div>
                        </section>
                        <div class="col-md-12 main" style=" background-color: #fff"> 
                                    <div  style="padding-bottom: 10px;padding-top: 10px" >
                                        <div class="pull-right -xs">
                                            <b> IBUnotas</b> 1.0
                                        </div>
                                        <strong>Desarrollado por  IBUsoft.  </strong>  
                                    </div>
                                </div>
                    </div>
                </div>
            </div> 
        </div>
         
         
    </body>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 

<script src="../../../js/jquery.loadingModal.js"></script>


<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>


<script type="text/javascript">

  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});
    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
  }

  function disciplina(){
    mostrar();
    $.ajax({
      type: "post",
      url: "../../../ajax/alumno/observador.php?action=mostrar",
     
      dataType: "text",
      success: function(data) {
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;
        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );  
        $('#disciplina').html(data); 
      }
    });
  }
  disciplina();
</script>
     

   
 