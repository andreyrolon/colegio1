 <?php

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../login.php"); echo($_SESSION['Session1']);
    }
include('../../../codes/rector/horario.php'); 
include "../../../codes/rector/conexion.php";
$grado=new horario();
include('../enlaces/head.php');

if (isset($_GET['id'])) {
  $id=$_GET['id'];
}

$data=$grado->consultar_areas_grado($id);
/*
if(isset($_POST['titular_b'])){
    $grado->asignar_titular($_POST['titular'],$id);
}
if(isset($_POST['update_ti'])){
    $grado->asignar_titular($_POST['titular'],$id);
}*/

?>
<style>
 
/* The Modal (background) */
.asd {
  visibility:  hidden; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: #000;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
   
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
 }
th, td{
  padding: 4px
}
</style>
 <div id="sapos">  
 </div>
<?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } 

    $style='';
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
    $style='font-size: 22px;';  
  } 
  $variable=array('color: #886ab5;border: solid 1px #886ab5;','color: #007bff ;border: solid 1px #007bff ;','color: #dc3545 ;border: solid 1px #dc3545 ;','color: #28a745;border: solid 1px #28a745;','color: #fd3995;border: solid 1px #fd3995;','color: #505050;border: solid 1px #505050;','color: #ffc241;border: solid 1px #ffc241;','color: #1dc9b7;border: solid 1px #1dc9b7;','color: #bd1bb8;border: solid 1px #bd1bb8;','color: #5bc0de;border: solid 1px #5bc0de;','color: #717073de;border: solid 1px #717073de;','color: #587ea3;border: solid 1px #587ea3;','color: #dc6008;border: solid 1px #dc6008;','color: #3c8dbc;border: solid 1px #3c8dbc;','color: #886ab5;border: solid 1px #886ab5;','color: #d09de0;border: solid 1px #d09de0;','color: #4f07ffcf;border: solid 1px #4f07ffcf;');

  $variable1=array(' #886ab5',' #007bff ',' #dc3545 ',' #28a745',' #fd3995',' #505050',' #ffc241',' #1dc9b7',' #bd1bb8',' #5bc0de',' #717073de',' #587ea3',' #dc6008',' #3c8dbc',' #886ab5',' #d09de0',' #4f07ffcf');
  $variable2=array(' solid 1px #886ab5',' solid 1px #007bff ',' solid 1px #dc3545 ',' solid 1px #28a745',' solid 1px #fd3995',' solid 1px #505050',' solid 1px #ffc241',' solid 1px #1dc9b7',' solid 1px #bd1bb8',' solid 1px #5bc0de',' solid 1px #717073de',' solid 1px #587ea3','solid 1px #dc6008',' solid 1px #3c8dbc',' solid 1px #886ab5',' solid 1px #d09de0',' solid 1px #4f07ffcf');

  $variables=array('color: white;background-color: #886ab5;','color: white;background-color: #007bff;','color: white;background-color: #dc3545;','color: white;background-color: #28a745;','color: white;background-color: #fd3995;','color: white;background-color: #505050;','color: white;background-color: #ffc241;','color: white;background-color: #1dc9b7;','color: white;background-color: #bd1bb8;','color: white;background-color: #5bc0de;','color: white;background-color: #717073de;','color: white;background-color: #587ea3;','color: white;background-color: #dc6008;','color: white;background-color: #3c8dbc;','color: white;background-color: #886ab5;','color: white;background-color: #d09de0;','color: white;background-color: #4f07ffcf;');
  ?>
  <style type="text/css">
    <?php 

      for ($i=1; $i <18 ; $i++) { 
        ?>
        #cun<?php echo $i ?> {  
          <?php echo $variable[$i] ?>border-radius: 3px;padding-top: 3px;padding-bottom: 3px

        }
        #cun<?php echo $i ?>:hover{  
          <?php echo $variables[$i] ?>

        }<?php
      }
    ?>
  </style> 
<body class="hold-transition skin-blue sidebar-mini" id="body" style="<?php echo $sty; ?> ">

  <input type='hidden' value="<?php echo($id) ?>" id="grado_sede">
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
    <div class="content-wrapper"> 
      <div class="row ">
        <div class="col-md-12">
          <div class="col-md-2" style="" ><br>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
          <br>
            <div id="ListaArticulos" class="table-responsive"  style="border-top:solid 3px #3c8dbc;   background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div style="margin-left: 17px;margin-top: 5px;"><strong>Materias  :</strong></div>
               <br>

              <?php $uno=0; foreach ($data[1] as $key  ) { $uno++;?>
               

                <center>
                  <li id="cun<?php echo $uno ?>" style="  cursor: -webkit-grab; cursor: grab;   list-style-type: none;    padding-left: 1px;padding-right: 1px; margin-left: 10px;margin-right: 10px; width:  144px" onmousedown='document.getElementById("cun<?php echo $uno ?>").style.cursor="grabbing";' onmouseup='document.getElementById("cun<?php echo $uno ?>").style.cursor="grab";' >  
                    <?php echo $key['nombre'] ?>  - h: 
                    <span id="precio3<?php echo $uno ?>" class="precio3" style="display:   "><?php echo $key['hora']-$key['s']; ?></span>
                    <span id="precio4" class="precio4" style="display:none   ">precio3<?php echo $uno ?></span>
                    <span id="x<?php echo $key['id_area_grado_sede'] ?>"  style="display:none   ">precio3<?php echo $uno ?></span>
                    <span class="precio" style="display: none"><?php echo $key['nombre'] ?></span>
                    <span class="id_area_grado_sede1" style="display: none;"><?php echo $key['id_area_grado_sede'] ?></span>


                    <span class="precio44" style="display: none; ;"><?php echo $variable1[$uno] ?></span>
                    <span class="precio55" style="display: none; ;"><?php echo $key['hora'] ?></span>
                    <span class="precio444" style="display:none;  ;"><?php echo $variable2[$uno] ?></span>
                  </li> <style>
                  .ee<?php echo $key['id_area_grado_sede']; ?>{
                    <?php echo $variable[$uno] ?>
                  }
                </style></center><br> <?php
              } ?>
            </div>
          </div>
          <div class="col-md-10" style="position: initial;"  ><br>
<br>
            <div class="table-responsive" style=" border-top: solid 3px #dd4b39; padding: 10px; margin-left: 5px ;  background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <?php
              //TRAER TODO GRADO_SEDE
              $con="  id=$id";
              $datos=$grado->consultar_sede_grados($con);
              foreach ($datos as $key) {
                $jornada=$key['jornada'];
                ?>
                <div  style="<?php echo $sty. $style ; ?> ">Sede:
                  <?php echo($key['sede']); ?> 
                  <br>Curso:
                    <?php echo($key['grado']." ".$key['numero']); ?>
                <br> 
                Jornada:
                  <?php echo($key['jornada']); ?>
                </div>
                  <?php 
              }  
              $titul=$grado->consultar_titular($id);
 
              $titulares=$grado->consultar_docentes_asignatura($id); 

              if($titul[1]==0){ ?>
                <form action="" method="post">
                  <button type="button" class="btn btn-success"  id="myBtn">Asignar Titular</button>
                    <!-- Modal content-->
                    <!-- The Modal -->
                  <div id="myModal" class="asd">

                    <!-- Modal content -->
                    <div class="modal-content">
                      <div id="_MSG3_"></div>
                      <div class="modal-header">
                        <span class="close" >&times;</span>
                        <h2>Asignar Titular</h2>
                      </div>
                      <div class="modal-body"><br>
                       <div id="sapo"></div><br>
                      </div>
                      <div class="modal-footer">    <button type="button" id="Cancelar" class="btn   btn-primary" style="background-color: #80a3b7">Cancelar</button>
                          <button type="button" class="btn   btn-primary" onclick='  
                           var docente = document.getElementById("docente").value; titular(docente)' >Aceptar</button>
                      </div>
                      <br>
                    </div>

                  </div>

                  <script>
                    var grado_sede = document.getElementById('grado_sede').value;
                    function titular(docente){
                      if (docente!=''){
                        $.ajax({   
                          type: "post",
                          data:{docente,grado_sede}, 
                          url:"../../../ajax/rector/horario.php?action=asignar_titular",
                          dataType:"text", 
                          success:function(data){ 
                            $('#_MSG3_').html(data); 
                          }
                        });
                      }else{
                        mensaje3(2,'Seleccione un docente');
                      }
                    }
                    // Get the modal
                    var modal = document.getElementById('myModal');

                    // Get the button that opens the modal
                    var btn = document.getElementById("myBtn");
                    var Cancelar = document.getElementById("Cancelar");

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    // When the user clicks the button, open the modal 
                    btn.onclick = function() {
                      modal.style.visibility = "visible";
                    }

                    // When the user clicks on <span> (x), close the modal
                    Cancelar.onclick = function() {
                      modal.style.visibility = "hidden";
                    }

                    span.onclick = function() {
                      modal.style.visibility = "hidden";
                    }
                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                      if (event.target == modal) {
                        modal.style.visibility = "hidden";
                      }
                    }
                  </script>
                </form> <?php
              }else{

                foreach($titul[0] as $tit){  ?>
                  <div  style="<?php echo $sty. $style ; ?> ">Titular:
                      <?php echo($tit['nombre']." ".$tit['apellido']); ?>
                  </div>
                  <form action="" method="post">
                    <button type="button" class="btn btn-info" name="update" style="margin-left: 80%; margin-top: -45px;"  id="myBtn">Actualiza titular</button>
                      <!-- Modal Eliminar content--> 
                      <!-- Modal content-->
                    <!-- The Modal -->
                    <div id="myModal" class="asd">

                      <!-- Modal content -->
                      <div class="modal-content">
                      <div id="_MSG3_"></div>
                        <div class="modal-header">
                          <span class="close" >&times;</span>
                          <h2>Asignar Titular</h2>
                        </div>
                        <div class="modal-body"><br>
                         <div id="sapo"></div><br>
                        </div>
                        <div class="modal-footer">    <button type="button" id="Cancelar" class="btn   btn-primary" style="background-color: #80a3b7">Cancelar</button>
                          <button type="button" class="btn   btn-primary" onclick='  
                           var docente = document.getElementById("docente").value; titular(docente)'>Aceptar</button>
                      

                        </div>
                        <br>
                      </div>

                    </div>
                    <script>
                      var grado_sede = document.getElementById('grado_sede').value;
                      function titular(docente){
                        if (docente!=''){
                          $.ajax({   
                            type: "post",
                            data:{docente,grado_sede}, 
                            url:"../../../ajax/rector/horario.php?action=asignar_titular",
                            dataType:"text", 
                            success:function(data){ 
                              $('#_MSG3_').html(data); 
                            }
                          });
                        }else{
                          mensaje3(2,'Seleccione un docente');
                        }

                      }
                      // Get the modal
                      var modal = document.getElementById('myModal');

                      // Get the button that opens the modal
                      var btn = document.getElementById("myBtn");
                      var Cancelar = document.getElementById("Cancelar");

                      // Get the <span> element that closes the modal
                      var span = document.getElementsByClassName("close")[0];

                      // When the user clicks the button, open the modal 
                      btn.onclick = function() {
                        modal.style.visibility = "visible";
                      }

                      // When the user clicks on <span> (x), close the modal
                      Cancelar.onclick = function() {
                        modal.style.visibility = "hidden";
                      }

                      span.onclick = function() {
                        modal.style.visibility = "hidden";
                      }
                      // When the user clicks anywhere outside of the modal, close it
                      window.onclick = function(event) {
                        if (event.target == modal) {
                          modal.style.visibility = "hidden";
                        }
                      }
                    </script>
                  </form>  <?php
                }
              } ?>   
     
              <div style="padding-top: 10px; padding-left: 10px;padding-right: 10px" id="_MSG_"></div>
              <div id="opc">
                <table id="ListaArticulos1" class="table table-hover  ">
                  <tr>
                    <th style=" background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">horas</th>
                    <?php if($jornada=='Tarde' or $jornada=='Noche'  or $jornada=='Continua' or $jornada=='MaÃ±ana' or $jornada=='Mañana') {  ?>
                     
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Lunes</th>
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Martes</th>
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Miercoles</th>
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Jueves</th>
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Viernes</th> 
                    <?php } if($jornada=='Sabado noche' or $jornada=='Sabado y domingo noche') { ?>
                      <style type="text/css">
                        #ListaArticulos1{
                          width: 300px;text-align: center;
                        }

                      </style>
                    
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Sabado</th> 
                    <?php } if($jornada=='Domingo noche' or $jornada=='Sabado y domingo noche') { ?>
                      <style type="text/css">
                        #ListaArticulos1{
                          width: 300px;text-align: center;
                        }
                        #opc{
                          text-align: center;
                        }
                      </style>
                      <th style="background-color: #3c8dbc; color: #fff; font-size: 17px; border:solid  #3c8dbc 3px">Domingo</th> 
                    <?php }   ?>
                  </tr>
                  <?php  
                  if ($jornada=='Tarde') {
                     $cantida=5;
                     $numero=6;
                  }
                  if ($jornada=='Noche') {
                     $cantida=4;
                     $numero=6;

                  }if ($jornada=='Continua'){
                    $cantida=8;
                     $numero=6;

                  }

                  if ($jornada=='MaÃ±ana'){
                    $cantida=6;
                     $numero=6;

                  }
                  if ($jornada=='Mañana'){
                    $cantida=6;
                     $numero=6;

                  }


                  if ($jornada=='Sabado noche'){
                    $cantida=4; 
                  }

                  if ($jornada=='Domingo noche'){
                    $cantida=4; 
                  }

                  if ($jornada=='Sabado y domingo noche'){ 
                      $cantida=4; 
                  }
                  for ($i=1; $i <=$cantida  ; $i++) {     
$iy=1;
$numero=6;         if ($jornada=='Domingo noche'){
                    $numero=8;
                      $iy=7;
                  }

                  if ($jornada=='Sabado y domingo noche'){ 
                      $numero=8;
                      $iy=6;
                  }
                     if ($jornada=='Sabado noche'){
                    $numero=7;
                     $iy=6;
                  }


                    if ( $i==1 && $jornada=='Tarde') {
                      $hora_inicio='12:30:00';
                      $hora_fin='13:30:00';
                    }     
                    if ( $i==2 && $jornada=='Tarde') {
                      $hora_inicio='13:30:01';
                      $hora_fin='14:30:00';
                    }     
                    if ( $i==3 && $jornada=='Tarde') {
                      $hora_inicio='14:30:01';
                      $hora_fin='15:30:00';
                    }     
                    if ( $i==4 && $jornada=='Tarde') {
                      $hora_inicio='15:30:01';
                      $hora_fin='16:30:00';
                    }     
                    if ( $i==5 && $jornada=='Tarde') {
                      $hora_inicio='16:30:01';
                      $hora_fin='17:30:00';
                    }







 

                    if ( ( $i==1 && $jornada=='Domingo noche' )or ( $i==1 && $jornada=='Sabado y domingo noche') or ($i==1 && $jornada=='Sabado noche')  ) {
                      $hora_inicio='18:00:00';
                      $hora_fin='19:00:00';
                    }     
                    if (( $i==2 && $jornada=='Domingo noche' )or ( $i==2 &&$jornada=='Sabado y domingo noche') or ($i==2 && $jornada=='Sabado noche')) {
                      $hora_inicio='19:00:01';
                      $hora_fin='20:00:00';
                    }     
                    if (( $i==3 && $jornada=='Domingo noche') or ( $i==3 &&$jornada=='Sabado y domingo noche') or ( $i==3 && $jornada=='Sabado noche')) {
                      $hora_inicio='20:00:01';
                      $hora_fin='21:00:00';
                    }     
                    if (( $i==4 && $jornada=='Domingo noche') or ($i==4 && $jornada=='Sabado y domingo noche') or ($i==4 && $jornada=='Sabado noche')) {
                      $hora_inicio='21:00:01';
                      $hora_fin='22:00:00';
                    } 

                         
                    






                    if ( ($i==1 && $jornada=='MaÃ±ana') or  ($i==1 && $jornada=='Mañana') or ($i==1 && $jornada=='Continua') ) {
                      $hora_inicio='06:00:01';
                      $hora_fin='07:00:00';
                     }     
                    if (($i==1 && $jornada=='MaÃ±ana') or  ( $i==2 && $jornada=='Mañana') or ($i==2 && $jornada=='Continua') ) {
                      $hora_inicio='07:00:01';
                      $hora_fin='08:00:00';
                     }     
                    if (($i==1 && $jornada=='MaÃ±ana') or  ( $i==3 && $jornada=='Mañana') or ($i==3 && $jornada=='Continua') ) {
                      $hora_inicio='08:00:01';
                      $hora_fin='09:00:00';
                     }     
                    if (($i==1 && $jornada=='MaÃ±ana') or  ( $i==4 && $jornada=='Mañana') or ($i==4 && $jornada=='Continua') ) {
                      $hora_inicio='09:00:01';
                      $hora_fin='10:00:00';
                     }     
                    if (($i==1 && $jornada=='MaÃ±ana') or  ( $i==5 && $jornada=='Mañana') or ($i==5 && $jornada=='Continua') ) {
                      $hora_inicio='10:00:01';
                      $hora_fin='11:00:00';
                     }     
                    if (($i==1 && $jornada=='MaÃ±ana') or  ( $i==6 && $jornada=='Mañana') or ($i==6 && $jornada=='Continua') ) {
                      $hora_inicio='11:00:01';
                      $hora_fin='12:00:00';
                     }     
                    if (  ($i==7 && $jornada=='Continua') ) {
                      $hora_inicio='12:00:01';
                      $hora_fin='13:00:00';
                     }     
                    if (($i==8 && $jornada=='Continua') ){
                      $hora_inicio='13:00:01';
                      $hora_fin='14:00:00';
                     }   





                 
                      ?>
                    <tr>
                      <th  style="width: 20px;height:30px; border:solid  #3c8dbc 3px"><?php echo $i  ?></th>
                      <?php 
                      for ($iy ; $iy <$numero ; $iy++) { 
                        ?>

                      <th id="horario1<?php echo  $iy.$i  ?>" style="width: 20px;height:30px; border:solid  #3c8dbc 3px">  
                        <?php 
                        $dia=$iy;
                        $hora=$i;
                        $data1=$grado->consultar_horario_dinamico($id,$dia,$hora);
                        if($data1[0]>0){
                          foreach ($data1[1] as $keyrtr  ) {
                            $area=$keyrtr['nombre'];
                            $id_area_grado_sede=$keyrtr['id_area_grado_sede'];
                            $dias=$keyrtr['dias'];
                            $hora=$keyrtr['hora'];
                          } ?> 
                          <li id="lin<?php echo $iy.$i ?>" class='ee<?php echo  $id_area_grado_sede ?>' style="   width: 160px;  font-weight:normal;  cursor: grab; list-style-type: none;"  onmousedown='document.getElementById("lin<?php echo $iy.$i ?>").style.cursor="grabbing";' onmouseup='document.getElementById("lin<?php echo $iy.$i  ?>").style.cursor="grab";'   >
                            <nav    id='rio1<?php echo $iy.$i  ?>'  style="   font-weight: normal;  padding-left: 10px;padding-right: 10px; display: block   ;  "><?php echo  $area ?></nav>   
                            <nav class="dia" style="display: none"><?php echo $iy; ?></nav>  
                            <nav class="hora" style="display: none"><?php echo  $i; ?></nav>  
                            <nav class="verty"  id="id_area_grado_sede1<?php echo $iy.$i  ?>" style="display: none;  "><?php echo $id_area_grado_sede ?></nav>
                            <nav id='hora_inicio<?php echo $iy.$i  ?>' style=' margin-left: 10px; display: none; '><?php echo $hora_inicio ?></nav>
                            <nav id='hora_fin<?php echo $iy.$i ?>' style=' margin-left: 10px; display:none  '><?php echo $hora_fin ?></nav>  
                            <nav class='ght' id='ght<?php echo $iy.$i ?>' style=' margin-left: 10px; display: none  '></nav>   
                          </li>
                          
                        <?php }else{ 
                         ?>
                          <li  id="lin<?php echo $iy.$i  ?>"    style="font-weight:normal; width: 160px;   cursor: grab; list-style-type: none;"  onmousedown='document.getElementById("lin<?php echo $iy.$i  ?>").style.cursor="grabbing";' onmouseup='document.getElementById("lin<?php echo $iy.$i  ?>").style.cursor="grab";'  >
                            <span  id='rio1<?php echo $iy.$i  ?>'  style="font-weight: normal;   padding-left: 10px;padding-right: 10px; display:   none;  "></span> 
                            <nav class="dia" style="display: none"><?php echo $iy; ?></nav>  
                            <nav class="hora" style="display: none"><?php echo  $i; ?></nav>  
                            <nav id="id_area_grado_sede1<?php echo $iy.$i  ?>" style="display:  "></nav>
                            <nav style=" margin-left: 10px;" id='hora_inicio<?php echo $iy.$i  ?>'><?php echo $hora_inicio ?></nav>
                            <nav style=" margin-left: 10px;" id='hora_fin<?php echo $iy.$i  ?>'><?php echo $hora_fin ?></nav>  
                            <nav class='ght' id='ght<?php echo $iy.$i  ?>' style=' margin-left: 10px; display: none  '></nav>   
                          </li><?php  
                        } ?>
                      </th>
                        <?php
                       } ?>
                      
                    </tr><?php  
                  } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><br>
    </div> 

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>
  </div> 
  </body> 
<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


 

<script src="../../../js/jquery.loadingModal.js"></script>
<script type="text/javascript">
    function mostrar1(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }


function horarios(h,id){
  $.ajax({   
            type: "post",

            data:{h,id}, 
            url:"../../../ajax/rector/horario.php?action=Actualiza",
            dataType:"text", 

            success:function(data){  
          
              
 }
          });
}
$(document).ready(function(){  
var grado_sede=document.getElementById("grado_sede").value;
    $.ajax({   
            type: "post",

            data:{grado_sede}, 
            url:"../../../ajax/seles/seles.php?action=titulars",
            dataType:"text", 

            success:function(data){  
          
        $('#sapo').html(data); 
              
 }
          });
 
  $(document).on("submit", "#registro", function(e){
    e.preventDefault();  
    mostrar1();
    $.ajax({

      type: "post",
      url:"../../../ajax/rector/horario.php?action=registrar", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 
       
                document.getElementById('boletin1').style.display='block';
        $('#_MSG2_').html(data); 

      }
    });
  });
 
 }); 
              $(document).on('ready',  function() {
                $('#ListaArticulos li').draggable({
                  helper:'clone'
                });
                $('#ListaArticulos1 li').draggable({
                  helper:'clone'
                }); 
                $('#ListaArticulos').droppable({
                   drop:eventoDrop
                });
                function eventoDrop(evento,ui){ 
                  mostrar1();
                  var dia= (ui.draggable.children('.dia').text()); 
                  var hora= (ui.draggable.children('.hora').text()); 
                  var mimo1= (ui.draggable.children('.precio').text()); 
                  var ght= (ui.draggable.children('.ght').text()); 

                  if (ght!='') {
                    var tt= $('#'+ght).html();
                    var y=parseInt(tt)+1;
                    $('#'+ght).html(y); 
                    var val=document.getElementById(ght).value; 

                  }else{
                    var verty= (ui.draggable.children('.verty').text());   

                    var tt= $('#x'+verty).html(); 
                    var r= $('#'+tt).html(); 
                    var t= parseInt(r)+1; 
                    $('#'+tt).html(t); 
                  }
                  if (mimo1=='') { 
                    document.getElementById('rio1'+dia+hora).innerHTML="";
                    id_area_grado_sede1=$('#id_area_grado_sede1'+dia+hora).text();
 
 
                    document.getElementById('hora_fin'+dia+hora).style.display="block";
                    document.getElementById('hora_inicio'+dia+hora).style.display="block";
                    document.getElementById('id_area_grado_sede1'+dia+hora).style.display="none";

                    document.getElementById('rio1'+dia+hora).style.display="none";
                    $.ajax({   
                      type: "post",
                      data:{dia,hora,id_area_grado_sede1}, 
                      url:"../../../ajax/rector/horario.php?action=eliminar",
                      dataType:"text", 
                      success:function(data){ 
                         $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 100;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                      }
                    }); 
                  }$('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 100;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                }
        
                <?php 
                for ($i=1; $i <=8 ; $i++) {  
                  for ($w=1; $w <=9 ; $w++) {  ?>
                    $('#horario1<?php echo $w.$i ?>').droppable({
                      drop:eventoDrop<?php echo $w.$i  ?>
                    });

                    function eventoDrop<?php echo $w.$i  ?>(evento,ui){
                      mostrar1();
                      var precio= (ui.draggable.children('.precio').text());  
                      var id_area_grado_sede1= (ui.draggable.children('.id_area_grado_sede1').text());  
                      var num=<?php echo $w.$i  ?>; 
                      var validacion=$('#rio1<?php echo $w.$i ?>').text(); 
                      var mimo3= (ui.draggable.children('.precio3').text()); 
                      var mimo4= (ui.draggable.children('.precio4').text()); 
                      var mimo44= (ui.draggable.children('.precio44').text()); 
                      var mimo444= (ui.draggable.children('.precio444').text()); 
                      var mimo55= (ui.draggable.children('.precio55').text()); 
                       
                      if (validacion=='' && precio!='' && mimo3>0 ) {
                        
                        var hora_inicio=$('#hora_inicio<?php echo $w.$i ?>').text();
                        var hora_fin=$('#hora_fin<?php echo $w.$i ?>').text();
                        var dia=<?php echo $w ?>;
                        var hora=<?php echo $i ?>; 

                       
                        $.ajax({   
                          type: "post",
                          data:{mimo55,hora_inicio,hora_fin,dia,hora,id_area_grado_sede1}, 
                          url:"../../../ajax/rector/horario.php?action=registrar",
                          dataType:"text", 
                          success:function(data){  
                            $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 100;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                            if(data==1){ 
                              mensaje(1,'La hora que señala ya tiene un area, por favor recargue la pagina para  verificar.');
                            }
                            if(data==11){ 
                              mensaje(1,'Ya alcanzo el numero de horas correspondiente, recargue la paginas para asesorarse.');
                            } if(data==0){
                               var t=mimo3-1; 
                        ui.draggable.children('.precio3').text(t); 
                              document.getElementById('hora_inicio<?php echo $w.$i ?>').style.display="none";
                              document.getElementById('hora_fin<?php echo $w.$i ?>').style.display="none";
                              document.getElementById('id_area_grado_sede1<?php echo $w.$i ?>').style.display="none";
                              document.getElementById('rio1<?php echo $w.$i ?>').style.display="block";
                              document.getElementById('lin<?php echo $w.$i ?>').style.border= mimo444;  
                              document.getElementById('lin<?php echo $w.$i ?>').style.color= mimo44;  
                              $('#rio1<?php echo $w.$i ?>').html(precio);  
                              $('#ght<?php echo $w.$i ?>').html(mimo4);          
                              $('#id_area_grado_sede1<?php echo $w.$i ?>').html(id_area_grado_sede1);  
                            }
                          }
                        }); 
                      }   $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 100;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 

                    }<?php
                  }
                }?>
              });
            </script>

 
