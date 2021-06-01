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
 


function curso_logro(){ 
  include "../../codes/rector/conexion.php";
  $id_jornada_sede=$_POST['id_jornada_sede']; 
  $id_a=$_POST['id_a']; 
  $id_g=$_POST['id_g']; 
  $id_c=$_POST['id_c']; 
  $p=$_POST['p'];  
  $ano=date('Y');
  $con=0;
  
  $num=0;
  $cont2=0;
  $con1ww=0;
  $cont1=0;
  if(isset($_POST['palabra'])){
  $palabra= ' AND alumnos.apellido LIKE "%'.$_POST['palabra'].'%" ';
   
  }else{
    $palabra='';

  }
  $ano=date('Y');
  $con3="SELECT alumnos.nombre,alumnos.apellido,alumnos.genero,alumnos.foto,materia_por_periodo.id_materia_por_periodo,informeacademico.fecha_desercion,informeacademico.fecha_retiro from informeacademico,materia_por_periodo,alumnos WHERE    informeacademico.id_grado='$id_g'   and informeacademico.id_curso='$id_c'  and informeacademico.id_jornada_sede='$id_jornada_sede'  and informeacademico.ano='$ano' and informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and informeacademico.id_alumno=alumnos.id_alumnos  and materia_por_periodo.id_area='$id_a'  AND materia_por_periodo.periodo='$p' $palabra ORDER BY apellido ";
  $con1=$conexion->prepare($con3);
  $con1->execute(array());
  $count=$con1->rowCount();
  $con2=$con1->fetchAll();

  ?>
  <style>
      table {
    border-collapse: collapse;
    width: 100%;
  }

 
     
      #op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
      }
      .op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
      }
      #lll{
        width: 100px
      }
      .img-circle{
            width: 65px;
            height: 80px;
        }
        .img-circle:hover{
            width: 100px; 
            height: 123px;
        }
        
  </style>  
  
<div style="padding: 15px">
    <div id="_MSG_"></div>
    <form id="tinti"  > 

      <table class="   table-hover" style="border-top: 2px solid #ddd;">
        <tbody>
        <tr style="background: #EEE">
          <th>ID</th>
          <th  >FOTO</th>
          <th>NOMBRE</th>
          <th>Estado</th>
          <th><input class="log1" type="checkbox" value="0" id="w1" onclick=' var w=$("#w1").val();
          if (w==0) { document.getElementById("w1").value=1; $(".log1").prop("checked", true);}else{ document.getElementById("w1").value=0; $(".log1").prop("checked", false);  } '> LOGRO N1</th>
          <th><input class="log2" type="checkbox" value="0" id="w2" onclick=' var w=$("#w2").val();
          if (w==0) { document.getElementById("w2").value=1; $(".log2").prop("checked", true);}else{ document.getElementById("w2").value=0; $(".log2").prop("checked", false);  } '> LOGRO N2</th>
          <th><input class="log3" type="checkbox" value="0" id="w3" onclick=' var w=$("#w3").val();
          if (w==0) { document.getElementById("w3").value=1; $(".log3").prop("checked", true);}else{ document.getElementById("w3").value=0; $(".log3").prop("checked", false);  } '> LOGRO N3</th>
          <th><input class="log4" type="checkbox" value="0" id="w4" onclick=' var w=$("#w4").val();
          if (w==0) { document.getElementById("w4").value=1; $(".log4").prop("checked", true);}else{ document.getElementById("w4").value=0; $(".log4").prop("checked", false);  } '> LOGRO N4</th>
          <th><input class="log5" type="checkbox" value="0" id="w5" onclick=' var w=$("#w5").val();
          if (w==0) { document.getElementById("w5").value=1; $(".log5").prop("checked", true);}else{ document.getElementById("w5").value=0; $(".log5").prop("checked", false);  } '> LOGRO N5</th>
        </tr>
        <?php $con12=0;
        foreach($con2 as $key){ 

          if(($key['foto']=='' && $key['genero']=='') or ($key['foto']=='' && $key['genero']=='0')){ 
            $FOOTO= '../../../logos/niño.jpg';
          } 
          if($key['foto']=='' && $key['genero']=='1'){ $FOOTO= '../../../logos/niña.jpg';} 
          if($key['foto']!=''){ $FOOTO= $key['foto'];}   
          ?>
          <tr id="op">
              <td  ><?php  $cont=$con++; echo$cont+1 ?></td>
              <td>
               <?php  ?>

                 <img   class="profile-user-img img-responsive img-circle" src="<?php echo $FOOTO ?>" alt="User profile picture"><div style="width: 100px"></div> </td>
              <td><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?></td>
              <td><?php 
                if ($key['fecha_retiro']!='0000-00-00' && $key['fecha_desercion']=='0000-00-00') {
                  echo'<span class="btn btn-warning ">Retirado</span>';
                  $disabled='disabled';
                } 
                if ($key['fecha_desercion']!='0000-00-00' && $key['fecha_retiro']=='0000-00-00') {
                  echo'<span class="btn btn-danger ">Desertor</span>';
                  $disabled='disabled';
                }if($key['fecha_desercion']=='0000-00-00' && $key['fecha_retiro']=='0000-00-00'){
                  echo'<span class="btn btn-info">Cursando</span>';
                  $disabled='';
                } ?>
                                 </td>
              
           
                <?php 
                $conE="SELECT logro.tipo, logro.logro,logro.id_logro,logro_periodo.id_logro_periodo FROM logro,logro_periodo WHERE logro.id_logro=logro_periodo.id_logro and logro_periodo.id_materia_por_periodo=".$key['id_materia_por_periodo']." LIMIT 5";
                $conW=$conexion->prepare($conE);
                $conW->execute(array()); 
                foreach ($conW as   $value) {
                  $cont1=$con1ww++; 
                  $con12=$cont1+1;
                  if ($value['tipo']==1) {
                    $color='#28a745';
                    $color1='#28a745d4';
                  }
                  if ($value['tipo']==2) {
                    $color='#dc3545';
                    $color1='#dc3545d9';

                  }
                  if ($value['tipo']==3) {
                    $color='#343a40';
                    $color1='#000000b0';

                  }
                  ?>
                  <td>   <a data-title="<?php echo($value['logro']); ?>"> 
                    <div class="input-group margin" style="width: 90px ;    top:-21px">
                      <div class="input-group-btn" style="border:solid 1px <?php echo $color ?>;padding: 3px;background-color: <?php echo $color1 ?>">
                        <div class="input-group-text" >
                          <input type="checkbox" aria-label="Checkbox for following text input"  class="log<?php echo $con12  ?>" name="logro[]" value='<?php echo $key['id_materia_por_periodo'].' '.$value['id_logro_periodo']; ?>'  >
                        </div>
                      </div>
                      <input  <?php echo $disabled ?>   type="text" style="border:solid 1px <?php echo $color ?>;" value="<?php echo $value['id_logro']; ?>" class="form-control"  id="logro<?php echo $con12.$key['id_materia_por_periodo']; ?>"   onchange=' var id_materia_por_periodo= <?php echo $key['id_materia_por_periodo'] ?>; var value=document.getElementById("logro<?php echo $con12.$key['id_materia_por_periodo']; ?>").value; var id_logro="<?php echo $value['id_logro_periodo']; ?>"; var id="logro<?php echo $con12.$key['id_materia_por_periodo']; ?>"; registro(id_logro,id_materia_por_periodo,value,id)' >
                    </div></a>
                  </td>
                  <?php
                }
                $num=6-$con12;
                for ($i=1; $i <$num ; $i++) {  $to=$i+$cont2+$con12; ?>
                  <td>  
                    <div class="input-group margin" style="width: 90px">
                      <div class="input-group-btn" style="border:solid 1px #ccc;padding: 3px;background-color: #e9ecef">
                        <div class="input-group-text" >
                          <input type="checkbox" aria-label="Checkbox for following text input"  class="log<?php echo $to ?>"   name="logro[]" value='<?php echo $key['id_materia_por_periodo'].' 0'; ?>'  >
                        </div>
                      </div> 
                      <input <?php echo $disabled ?> type="text" class="form-control"    id="logro<?php echo $to.$key['id_materia_por_periodo']; ?>" name="" onchange=' var id_materia_por_periodo=<?php echo $key['id_materia_por_periodo'] ?>; var value=document.getElementById("logro<?php echo $to.$key['id_materia_por_periodo']; ?>").value;var id_logros=""; var id="logro<?php echo $to.$key['id_materia_por_periodo']; ?>";  registro(id_logros,id_materia_por_periodo,value,id)'>
                    </div>
                  </td>
                <?php }$con12=0;  $cont1=0;$con1ww=0; 
                    ?>
              
              
          </tr> 
          <?php
        }
        ?></tbody>
      </table>
      
      
      <div class="modal fade in" id="my" style="background-color: rgba(3, 64, 95, 0.3);  ">
                          <div class="modal-dialog modal-lg">  
                              <div class="modal-content" style=" background-color: #fff;">
                                  <div class="modal-header btn-primary table-responsive">
                                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                      <h4 id="titulos" class="modal-title"></h4>
                                  </div>
                                    <div id="formulario" style="padding: 10px;  display: none;  background-color: #fff;  ">  
                                      <div id="alerta_2" style="padding: 1px"></div>
                                      <label id="curso"></label>
                                      <textarea class="form-control" id="looogro" ></textarea><br>
                                      <input type="hidden" id="text">
                                      <button type="button" onclick="nuevos()"   class="btn btn-info" name="eliminar_sede" id="btn">Registro                                       </button> 
                                    </div>
                                      <input type="hidden"  id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                                       <div id="alerta_1" style="padding: 5px"></div>



<div class="mailbox-controls">

        <!-- Check all button -->
      
        <div class="btn-group"> 
 <select id="mySelect" class="form-control"   onchange="myFunction(1)" style="width:63px;margin-top: 5px;height: 31px;">


                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select>      </div>
          <!-- /.btn-group --> 
          <div class="pull-right">

                       <div class="btn-group"> 
<div class="has-feedback">
                        <input type="text"  class="form-control"   id="fname" placeholder="buscador.." onkeyup="myFunction(1)" style="margin-top: 5px;height: 31px;">
                        <span class="fa fa-search form-control-feedback" style="    color: #c3c3c3; "></span>
                    </div>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>

















                         
                                  <div    style="padding-left: 10px;padding-right: 10px;    " class="modal-body table-responsive" id="koooo">
                                  </div><input type="hidden" id="idsss" name="idsss"> <input type="hidden" id="tipo_codigo" name="tipo_codigo"> 
                                  <div class="modal-footer">  
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="submit"  class="btn btn-primary" name="eliminar_sede" id="btn"  >Aceptar</button> 
                                </div> 
                                   
                              </div>
                          </div>
                      </div>
    </form> 
                    <script type="text/javascript">
  function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


    }
        for (var i =1; i <= 100; i++) {

    function myFunction(i) {
      var toa=document.getElementById('text').value; 
      var materia='<?php echo "$id_a"; ?>'; 
                        var grado='<?php echo "$id_g"; ?>';  
      var dato=document.getElementById("fname").value;  
      var mySelect=document.getElementById("mySelect").value; 
      $.ajax({  
        type: "post",
        url: "../../../ajax/docente/logro.php?action=logro1",
        data:{i,dato,mySelect,grado,materia,toa},    
        dataType:"text",
        success:function(data){ 
          $('#koooo').html(data); 
        }  
      });  
    }
  }
                     
                       function   mostrarr(n){
                         
                        var materia='<?php echo "$id_a"; ?>'; 
                        var grado='<?php echo "$id_g"; ?>';  
                         var toa=n;
                        $.ajax({  
                          type: "post",
                          url: "../../../ajax/docente/logro.php?action=logro1",
                          data:{ grado,materia,toa},    
                          dataType:"text",
                          success:function(data){  
                            $('#koooo').html(data); 
                          }  
                        });  
                      }
                      function myFunction3i(io){
                         
                         
                            $.ajax({   
                              type: "post", 
                              data:{io},  
                              url:"../../../ajax/rector/logros/logros.php?action=eliminar",
                              dataType:"text", 

                              success:function(data){  

                           var n=document.getElementById('text').value; 
                                   
                                   if (data==0) {
                                      mostrarr(n)
                                   }else{
                                    mensaje2(1,'Atualmente, estudiantes tiene ese logro');
                                   }

                              }  


                            });
                      }
                       function   nuevos(){
                         
                        var logro=document.getElementById('looogro').value; 
                        if (logro=='') {
                          document.getElementById('looogro').focus();
                          document.getElementById("alerta_2").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> <br>Complete el campo. </div>';
                          window.setTimeout(function  () {
                                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                            }, 2900);
                            return false;
                        }else{
                          var materia='<?php echo "$id_a"; ?>'; 
                          var grado='<?php echo "$id_g"; ?>';  
                           var tipo=document.getElementById('text').value;
                           var n=tipo;
                          $.ajax({  
                            type: "post",
                            url:"../../../ajax/rector/logros/logros.php?action=registro", 
                            data:{ grado,materia,tipo,logro},    
                            dataType:"text",
                            success:function(data){    
                              document.getElementById('looogro').value='';
                              document.getElementById('looogro').focus();
                               mostrarr(n);
                               document.getElementById("alerta_2").innerHTML = '<div class="alert" style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">    <strong>informacion!</strong> <div style="font-weight:normal;"><i class="fa fa-check fs-xl"></i>  Registro agregado.</div>   </div>';
                               window.setTimeout(function  () {
                                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                            }, 2900);

                            }  
                          }); 
                        } 
                      }
            
                      function  registro(id_logros,id_materia_por_periodo,value,id){
                        if (value!='') {
                          var id_a=<?php echo $id_a=$_POST['id_a'] ?>; 
                          var id_g=<?php echo $id_g=$_POST['id_g'] ?>; 
                           $.ajax({  
                            type: "post",
                            url: "../../../ajax/docente/logro.php?action=validar_logro",
                            data:{ id_a,id_g,value},    
                            dataType:"text",
                            success:function(data){    
                              if (data>0) {
                                $.ajax({  
                                  type: "post",
                                  url: "../../../ajax/docente/logro.php?action=registro_logro_alumno",
                                  data:{ id_logros,id_materia_por_periodo,value},    
                                  dataType:"text",
                                  success:function(dataq){    
                                     mensaje(3,'Registro Exitoso');
                                  }  
                                });
                              }else{
                                document.getElementById(id).value='';
                                document.getElementById(id).focus();;
                                mensaje(1,'Codigo correcto');
                              }
                            }  
                          }); return;
                       }else{
                        $.ajax({  
                                  type: "post",
                                  url: "../../../ajax/docente/logro.php?action=registro_logro_alumno",
                                  data:{ id_logros,id_materia_por_periodo,value},    
                                  dataType:"text",
                                  success:function(data){   
                                     mensaje(3,'Registro Exitoso');
                                  }  
                                }); 
                       }
                      }
                    </script>
  </div><?php
}

function masivo_registro(){
  $idsss='';
  if(isset($_POST['idsss'])){
    $idsss=$_POST['idsss'];
  }
  $logro='';
  if(isset($_POST['logro'])){
    $logro=$_POST['logro'];
    
  } 
  if ($logro=='') {
    echo 1;
  }
  if ($idsss=='') {
    echo 0;
  }if($logro!='' && $idsss!=''){
    
    foreach ($logro as $key) {
       $porcion=explode(' ', $key);
      echo  $id=$porcion[0];
      echo  $logross=$porcion[1];echo "<br>";
      if ($logross!=0) {
        include '../conexion.php';
        $consultar_nivel="UPDATE `logro_periodo` SET `id_logro` = '$idsss' WHERE `logro_periodo`.`id_logro_periodo` ='$logross'  ";
        
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
      if ($logross==0) {
        include '../conexion.php';
        $consultar_nivel="INSERT INTO `logro_periodo` ( `id_materia_por_periodo`, `id_logro`) VALUES ( '$id', '$idsss')";
         
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
      }
       
    }
  }

    
 
 
}
function logro1(){

  include '../conexion.php'; 
  if(isset($_POST['grado'])){
    $grado=$_POST['grado'];

  }
  if(isset($_POST['materia'])){
    $materia=$_POST['materia'];

  }
  if(isset($_POST['toa'])){
    $toa=$_POST['toa'];

  }
 
  if ($toa==1) {
    $var='Logro';
  }
 
  if ($toa==2) {
    $var='Recomendacion';
  }
 
  if ($toa==3) {
    $var='Dificultades';
  }
 


  if(isset($_POST['dato'])){
    $d=$_POST['dato'];
  }else{
    $d='';
  }
  if(isset($_POST['i'])){
    $paginaActual = $_POST['i'];
  }else{
    $paginaActual=1;
  }
//logro.NOMBRE like('%$d%')

     $consultar_nivel="  SELECT logro.logro,logro.id_logro, grado.nombre,area.nombre ,logro.tipo FROM logro,grado,area WHERE area.id_area=logro.id_area and logro.id_grado=grado.id_grado and logro.tipo='$toa' and logro.logro like('%$d%') and logro.id_area=$materia and logro.id_grado=$grado      ORDER by logro.id_logro DESC   ";
  $s=$consultar_nivel;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());

  $nroProductos=$consultar_nivel1->rowCount();


  if(isset($_POST['mySelect'])){
    $nroLotes = $_POST['mySelect'];
  }else{
    $nroLotes = 5;
  }

  $nroPaginas = ceil($nroProductos/$nroLotes);
  $lista = '';
  $tabla = '';

  if($paginaActual > 1){
    $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
  }

  for($i=1; $i<=$nroPaginas; $i++){ 
    if($i == $paginaActual){
      $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
    }else{
      $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
    }
  }
  if($paginaActual < $nroPaginas){
    $lista = $lista.'<li>
    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
    $o=0;
  }else{
    $o=1;
  }

  if($paginaActual <= 1){
    $limit = 0;
  }else{
    $limit = $nroLotes*($paginaActual-1);
  }


    $consultar_nivel="  SELECT logro.logro,logro.id_logro, grado.nombre,area.nombre ,logro.tipo FROM logro,grado,area WHERE area.id_area=logro.id_area and logro.id_grado=grado.id_grado and logro.tipo='$toa' and logro.logro like('%$d%') and logro.id_area=$materia and logro.id_grado=$grado      ORDER by logro.id_logro DESC   LIMIT $limit, $nroLotes ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $registro=$consultar_nivel1->fetchAll();

  $registrow=$consultar_nivel1->rowCount();
  ?> 
<div id="_MSG2_"></div>
<form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
    <div class="box-body no-padding">

      <div class="mailbox-controls">

        <!-- Check all button -->
         <button type="button" clas id="comprovacion" value="0" onclick="var va=document.getElementById('comprovacion').value;
         if (va==0) {document.getElementById('formulario').style.display='block';document.getElementById('comprovacion').value=1;}else{
          document.getElementById('formulario').style.display='none';document.getElementById('comprovacion').value=0;
         } "> Nuevo</button>
        <div class="btn-group"> 

           
          <?php if($paginaActual > 1){
            echo  ' <button type="button"  style="margin-bottom: 3px;"  id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button"  style="margin-bottom: 3px;"  id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
          </div>
          <!-- /.btn-group --> 
          <div class="pull-right">

            <?php 

            $aaa=$registrow+0;
            $aa=$paginaActual+0;
            $g=$aa *$aaa;
            if ($o==0) {
              echo $g .'-'.$paginaActual.'/'. $nroProductos ;
            }else{
              echo $nroProductos;

              echo   '-'.$paginaActual.'/'. $nroProductos ;
            }





            ?>
            <div class="btn-group"> 

              <?php if($paginaActual > 1){
                echo  ' <button type="button"  style="margin-bottom: 3px;"  id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

                <?php
                if($paginaActual < $nroPaginas){ echo  ' <button type="button"  style="margin-bottom: 3px;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
          <style type="text/css">
            [data-titles] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 
}

[data-titles]:hover::before {
  content: attr(data-titles);
  position: absolute;
  bottom: -26px;    
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 14px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-titles]:hover::after {
  content: '';
  position: absolute;
  bottom: -7px;
  left: 2px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}
          </style>
          
          <div class="table-responsive" style="
            padding: 5px;
          text-align: justify; /* For Edge */
          -moz-text-align-last: left; /* For Firefox prior 58.0 */
          text-align-last: left; ">

           <br><table class="  table table-hover ">
          <tr style="background: #EEE"><th  style="border-top: 1px solid #ddd;" width="15"># </th> 
            <th width="15" style="border-top: 1px solid #ddd;">codigo </th> 
 
          <th width="" style="border-top: 1px solid #ddd;"><?php echo $var ?></th>  
          <th width="30" style="border-top: 1px solid #ddd;">Editar</th>
          <th width="30" style="border-top: 1px solid #ddd;">Eliminar</th>

          </tr><?php
          foreach ($registro as $registro2) { ?>
 

            <tr class="op"   >

            <td>

            <input class="sss" type="radio" name="ids" id="ids<?php echo $registro2['id_logro']?>" onclick="var o=document.getElementById('ids<?php echo $registro2['id_logro']?>').value;document.getElementById('idsss').value=o;" value="<?php echo $registro2['id_logro']?>" ></td>  
                <td><?php echo $registro2['id_logro']?> </td>
            <td id="uiu<?php echo $registro2['id_logro']; ?>" contenteditable="false" 
              onblur='document.getElementById("uiu<?php echo $registro2['id_logro']; ?>").contentEditable = false; 

                var w="uiu<?php echo $registro2['id_logro']; ?>"; 
                var ides=<?php echo $registro2['id_logro'] ?>;
                var n="logro";
                var u = $("#uiu<?php echo $registro2['id_logro']; ?>").text(); 
                var identificador="<?php echo $registro2['logro']?>";
                if (identificador==u) {
                  return;
                }else{ 
                cambiar(u,ides,n,w); } '><?php echo $registro2['logro']?></td>  
             




              
           
            <td><a  data-titles="Actualizar <?php echo $var ?>" onclick='document.getElementById("uiu<?php echo $registro2['id_logro']; ?>").contentEditable = true; document.getElementById("uiu<?php echo $registro2['id_logro']; ?>").focus();' >
              <img  style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjI1NSA1My4yNTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjI1NSA1My4yNTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRDc1QTRBOyIgZD0iTTM5LjU5OCwyLjM0M2MzLjEyNC0zLjEyNCw4LjE5LTMuMTI0LDExLjMxNCwwczMuMTI0LDguMTksMCwxMS4zMTRMMzkuNTk4LDIuMzQzeiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSI0Mi40MjYsMTcuODk5IDE2LjUxMiw0My44MTQgMTUuOTgyLDQ4LjU4NyA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUQ4QTE5OyIgcG9pbnRzPSIxMC4zMjUsNDIuOTMgMTUuMDk4LDQyLjQgNDEuMDEyLDE2LjQ4NSAzNi43NywxMi4yNDMgMTAuODU1LDM4LjE1NyAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0VEOEExOTsiIHBvaW50cz0iMzUuMzU2LDEwLjgyOSAzMy4yMzQsOC43MDcgMzMuMjM0LDguNzA3IDQuNjY4LDM3LjI3MyA5LjQ0MSwzNi43NDMgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNDN0NBQzc7IiBwb2ludHM9IjQ4Ljc5LDE1Ljc3OCA0OC43OSwxNS43NzggNTAuOTEyLDEzLjY1NyAzOS41OTgsMi4zNDMgMzcuNDc2LDQuNDY1IDM3LjQ3Nyw0LjQ2NSAiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0M3Q0FDNzsiIHBvaW50cz0iMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSAzNC42NDgsNy4yOTMgMzQuNjQ4LDcuMjkzIDQ1Ljk2MiwxOC42MDYgNDUuOTYyLDE4LjYwNiAgIDQ3LjM3NiwxNy4xOTIgNDcuMzc2LDE3LjE5MiAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZCQ0U5RDsiIGQ9Ik0xNC40MjQsNDQuNDg4bC01LjEyMiwwLjU2OWMtMC4wMzYsMC4wMDQtMC4wNzMsMC4wMDYtMC4xMDksMC4wMDZjMCwwLTAuMDAxLDAtMC4wMDEsMEg5LjE5Mkg5LjE5MiAgYy0wLjAwMSwwLTAuMDAxLDAtMC4wMDEsMGMtMC4wMzYsMC0wLjA3My0wLjAwMi0wLjEwOS0wLjAwNmMtMC4wMzktMC4wMDQtMC4wNzEtMC4wMjYtMC4xMDgtMC4wMzUgIGMtMC4wNzItMC4wMTctMC4xNDEtMC4wMzUtMC4yMDctMC4wNjdjLTAuMDUtMC4wMjQtMC4wOTMtMC4wNTMtMC4xMzgtMC4wODRjLTAuMDU3LTAuMDQtMC4xMDktMC4wODMtMC4xNTctMC4xMzQgIGMtMC4wMzgtMC4wNC0wLjA2OS0wLjA4MS0wLjEtMC4xMjdjLTAuMDM4LTAuMDU3LTAuMDY5LTAuMTE2LTAuMDk1LTAuMTgxYy0wLjAyMi0wLjA1NC0wLjAzOC0wLjEwNy0wLjA1LTAuMTY1ICBjLTAuMDA3LTAuMDMyLTAuMDI0LTAuMDU5LTAuMDI4LTAuMDkyYy0wLjAwNC0wLjAzOCwwLjAxLTAuMDczLDAuMDEtMC4xMWMwLTAuMDM4LTAuMDE0LTAuMDcyLTAuMDEtMC4xMWwwLjU2OS01LjEyMmwtNS4xMjIsMC41NjkgIGMtMC4wMzcsMC4wMDQtMC4wNzUsMC4wMDYtMC4xMTEsMC4wMDZjLTAuMDc5LDAtMC4xNTItMC4wMjQtMC4yMjctMC4wNDJMMC40NDIsNTEuMzk5bDIuMTA2LTIuMTA2YzAuMzkxLTAuMzkxLDEuMDIzLTAuMzkxLDEuNDE0LDAgIHMwLjM5MSwxLjAyMywwLDEuNDE0bC0yLjEwNiwyLjEwNmwxMi4wMy0yLjg2NGMtMC4wMjYtMC4xMDktMC4wNDMtMC4yMjItMC4wMy0wLjMzOUwxNC40MjQsNDQuNDg4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMzg0NTRGOyIgZD0iTTMuOTYyLDQ5LjI5M2MtMC4zOTEtMC4zOTEtMS4wMjMtMC4zOTEtMS40MTQsMGwtMi4xMDYsMi4xMDZMMCw1My4yNTVsMS44NTYtMC40NDJsMi4xMDYtMi4xMDYgIEM0LjM1Miw1MC4zMTYsNC4zNTIsNDkuNjg0LDMuOTYyLDQ5LjI5M3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YyRUNCRjsiIHBvaW50cz0iNDguNzksMTUuNzc4IDM3LjQ3Nyw0LjQ2NSAzNy40NzYsNC40NjUgMzYuMDYyLDUuODc5IDM2LjA2Miw1Ljg3OSA0Ny4zNzYsMTcuMTkyICAgNDcuMzc2LDE3LjE5MiA0OC43OSwxNS43NzggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFQkJBMTY7IiBkPSJNNDEuMDEyLDE2LjQ4NUwxNS4wOTgsNDIuNGwtNC43NzMsMC41M2wwLjUzLTQuNzczTDM2Ljc3LDEyLjI0M2wtMS40MTQtMS40MTRMOS40NDEsMzYuNzQzICBsLTQuNzczLDAuNTNsLTEuMTMzLDEuMTMzbC0wLjIyOCwwLjk1N2MwLjA3NSwwLjAxOCwwLjE0NywwLjA0MiwwLjIyNywwLjA0MmMwLjAzNiwwLDAuMDc0LTAuMDAyLDAuMTExLTAuMDA2bDUuMTIyLTAuNTY5ICBsLTAuNTY5LDUuMTIyYy0wLjAwNCwwLjAzOCwwLjAxLDAuMDczLDAuMDEsMC4xMWMwLDAuMDM4LTAuMDE0LDAuMDcyLTAuMDEsMC4xMWMwLjAwNCwwLjAzMywwLjAyMSwwLjA2LDAuMDI4LDAuMDkyICBjMC4wMTIsMC4wNTcsMC4wMjksMC4xMTIsMC4wNSwwLjE2NWMwLjAyNiwwLjA2NCwwLjA1NywwLjEyNCwwLjA5NSwwLjE4MWMwLjAzLDAuMDQ1LDAuMDYzLDAuMDg4LDAuMSwwLjEyNyAgYzAuMDQ3LDAuMDUsMC4xLDAuMDk0LDAuMTU3LDAuMTM0YzAuMDQ0LDAuMDMxLDAuMDg5LDAuMDYxLDAuMTM4LDAuMDg0YzAuMDY1LDAuMDMxLDAuMTM1LDAuMDUsMC4yMDcsMC4wNjcgIGMwLjAzOCwwLjAwOSwwLjA2OSwwLjAzLDAuMTA4LDAuMDM1YzAuMDM2LDAuMDA0LDAuMDcyLDAuMDA2LDAuMTA5LDAuMDA2aDAuMDAxaDBoMC4wMDFoMC4wMDFjMCwwLDAuMDAxLDAsMC4wMDEsMGgwICBjMC4wMzUsMCwwLjA3Mi0wLjAwMiwwLjEwOS0wLjAwNmw1LjEyMi0wLjU2OWwtMC41NjksNS4xMjJjLTAuMDEzLDAuMTE4LDAuMDA0LDAuMjMsMC4wMywwLjMzOWwwLjk2My0wLjIyOWwxLjEzMy0xLjEzMmwwLjUzLTQuNzczICBsMjUuOTE0LTI1LjkxNUw0MS4wMTIsMTYuNDg1eiIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjJFQ0JGOyIgcG9pbnRzPSI0NS45NjIsMTguNjA2IDM0LjY0OCw3LjI5MyAzNC42NDgsNy4yOTMgMzMuMjM0LDguNzA3IDMzLjIzNCw4LjcwNyAzNS4zNTYsMTAuODI5ICAgMzYuNzcsMTIuMjQzIDQxLjAxMiwxNi40ODUgNDIuNDI2LDE3Ljg5OSA0NC41NDgsMjAuMDIgNDQuNTQ4LDIwLjAyIDQ1Ljk2MiwxOC42MDYgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
            </a></td>   
 
            <td> 
              <a   data-titles="Eliminar <?php echo $var ?>"  onclick=' 
                var r = confirm("Estas seguro de eliminar este logro");
                if (r == true) {
                  var io="<?php echo $registro2['id_logro']; ?>";
                   myFunction3i(io)
                } else {
                  return;
                } '> <img style="width: 26px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo="></a>              
             

            </td>








            </tr><?php  
          } ;?>
</table>
 
          
</div></div>  
     
 
 <script type="text/javascript">
    function cambiar(u,ides,n,w){
      $.ajax({  
        type: "post",
        url:"../../../ajax/rector/logros/logros.php?action=actualizar1",
        data:{u,ides,n,w},    
        dataType:"text",
        success:function(data){ 
          $('#_MSG2_').html(data); 
        }  
      });
    }
 </script>

          <?php

          echo ' <ul class="pagination" id="pagination"> '.$lista.'</ul>






          ' ;
 
 

}

function registro_logro_alumno(){
  include '../conexion.php'; 
  $value=$_POST['value'];
  $id_logro=$_POST['id_logros'];
  echo$id_materia_por_periodo=$_POST['id_materia_por_periodo'];
  if ($id_logro!='' and $value=='') {
    echo$consultar_nivel="DELETE FROM `logro_periodo` WHERE `logro_periodo`.`id_logro_periodo` = '".$id_logro."'   ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }if ($id_logro=='' and $value!=''){

    echo$consultar_nivel="INSERT INTO `logro_periodo` ( `id_materia_por_periodo`, `id_logro`) VALUES ( '$id_materia_por_periodo', '$value')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }if ($id_logro!='' and $value!=''){ 

    echo  $consultar_nivel="UPDATE `logro_periodo` SET `id_logro` = '".$value."' WHERE `logro_periodo`.`id_logro_periodo`  = ".$id_logro;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }
}
function validar_logro(){
  include '../conexion.php';
  $value=$_POST['value'];
  $id_a=$_POST['id_a'];
  $id_g=$_POST['id_g'];
  $consultar_nivel="SELECT logro.id_logro from logro WHERE logro.id_logro='$value'  and  logro.id_area='$id_a' AND logro.id_grado='$id_g' ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  echo$nroProductos=$consultar_nivel1->rowCount();
}
?>