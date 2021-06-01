

<?php 

if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}

function permiso_profe(){
   
 
  include "../../conexion.php"; 

  $id_docente_habilitado =$_POST['i']; 

 $consul="SELECT * FROM `docente_habilitado`  WHERE   docente_habilitado.id_docente_habilitado=$id_docente_habilitado";
  $consul=$conexion->prepare($consul);
  $consul->execute(array());
  foreach ($consul as   $value) {
    $i=$value['activo_nota'];
  } 
    if ($i==0) {
      $consul="UPDATE `docente_habilitado` SET `activo_nota` = '1'  WHERE   docente_habilitado.id_docente_habilitado=$id_docente_habilitado";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    else {
      $consul="UPDATE `docente_habilitado` SET `activo_nota` = '0'  WHERE   docente_habilitado.id_docente_habilitado=$id_docente_habilitado";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    

}

function permiso_profe2(){
   
 
    include "../../conexion.php"; 

  $id_docente_habilitado =$_POST['i']; 

 $consul="SELECT * FROM `docente_habilitado`  WHERE   docente_habilitado.id_docente_habilitado=$id_docente_habilitado";
  $consul=$conexion->prepare($consul);
  $consul->execute(array());
  foreach ($consul as   $value) {
    $i=$value['activo_recuperacion'];
  } 
    if ($i==0) {
    echo  $consul="UPDATE `docente_habilitado` SET `activo_recuperacion` = '1'  WHERE   docente_habilitado.id_docente_habilitado=$id_docente_habilitado";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    else {
    echo  $consul="UPDATE `docente_habilitado` SET `activo_recuperacion` = '0'  WHERE   docente_habilitado.id_docente_habilitado=$id_docente_habilitado";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    

}
function docentes(){

  include "../../conexion.php";   

   
  if(isset($_POST['id_js'])){
   $id_js=$_POST['id_js'];
 }else{
  $id_js='';
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
 
 if ($id_js=='rector' or $id_js=='RECTOR' OR $id_js=='Rector') {
   $id_js=1;
 } 


    $consultar_nivel="SELECT docente.id_docente as doce, docente.foto, docente.nombre,docente.apellido,
  docente.id_docente FROM docente  WHERE docente.nombre like('%$d%') or docente.apellido like('%$d%')   ";
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


$consultar_nivel="SELECT docente.id_docente as doce, docente.foto,docente.genero, docente.nombre,docente.apellido,
  docente.id_docente FROM docente  WHERE docente.nombre like('%$d%') or docente.apellido like('%$d%')  LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>
<style>
/* The container */
.aa {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.aa input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 23px;
  border-radius:5px;
  background-color: #ccc;
}

/* On mouse-over, add a grey background color */
.aa:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.aa input:checked ~ .checkmark {
  background-color: #0fbf99;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.aa input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.aa .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<form method="post">
 <div class="box-body no-padding">

  <div class="mailbox-controls">

    <!-- Check all button -->
    
    <div class="btn-group">  
      <?php if($paginaActual > 1){
        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>

    <div class="">

      

      <br>
      <table class="table table-striped table-condensed table-hover">
       <thead>
        <tr>
          <th>foto</th>
          <th>nombre</th>
          <th>apellido</th>
          <?php 
          $consultar_nivelx="SELECT * FROM periodo order by numero";
          $consultar_nivel1x=$conexion->prepare($consultar_nivelx);
          $consultar_nivel1x->execute(array());
          $consultar_nivel12x=$consultar_nivel1x->fetchAll(); 
          foreach ($consultar_nivel12x as $keyx ) {
            echo "<th>".$keyx['nombre']."<th>";

          } 
          ?>
        </tr>
      </thead>


      <?php
      foreach ($registro as $key) { 
               $id_docente=$key['doce']; ?>

          <tr>
             <td><img class="profile-user-img img-responsive img-circle" src="<?php if($key['foto']=='' && $key['genero']=='Femenino'){echo '../../../logos/femenino.png';}if($key['foto']=='' && $key['genero']=='Masculino'){echo '../../../logos/masculino.png';}else{echo $key['foto'];
            } ?>" alt="User profile picture">
</td>
            <td><?php echo $key['nombre'] ?>  </td>
            <td><?php echo $key['apellido'] ; ?> </td>

            <?php 
 
            $selecc="SELECT periodo.numero as b, docente_habilitado.id_periodo,docente_habilitado.id_docente_habilitado,docente_habilitado.activo_nota,periodo.nombre FROM docente_habilitado LEFT JOIN  periodo on periodo.id_periodo=docente_habilitado.id_periodo WHERE docente_habilitado.id_docente='$id_docente' order by docente_habilitado.id_periodo  ASC ";
            $selecc=$conexion->prepare($selecc);
            $selecc->execute(array());

             foreach ($selecc as $keyx ) {

             $activo_nota=$keyx['activo_nota']; 
             $n=$keyx['id_docente_habilitado']; 
             if($activo_nota==1){ 
               ?>
 


               <td style="padding-left:30px">  
                <label class="ee"> 
                  <input type="checkbox" checked="checked" onclick="var i=<?php echo $n; ?>; che(i)">
                  <span class="checkmark"></span> 
                  <?php
                } else{

               ?>
               <td style="padding-left:30px">  
                 
                <label class="aa"> 
                  <input type="checkbox"   onclick="var i=<?php echo $n; ?>; che(i)">
                  <span class="checkmark"></span> 
                  <?php
          }
          ?></r><td><?php

        }
         ?>
 
          </tr>
        
    <?php } ?>

    </tbody></table>

    <?php
     
echo ' </i> <ul class="pagination" id="pagination"> '.$lista.'</ul>';

}
  function docentes2(){

  include "../../conexion.php";   

   
  if(isset($_POST['id_js'])){
   $id_js=$_POST['id_js'];
 }else{
  $id_js='';
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
 
 if ($id_js=='rector' or $id_js=='RECTOR' OR $id_js=='Rector') {
   $id_js=1;
 } 


    $consultar_nivel="SELECT docente.id_docente as doce, docente.foto, docente.nombre,docente.apellido,
  docente.id_docente FROM docente  WHERE docente.nombre like('%$d%') or docente.apellido like('%$d%')   ";
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
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
   $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction1('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction1('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}


$consultar_nivel="SELECT docente.id_docente as doce, docente.foto, docente.nombre,docente.apellido,docente.genero,
  docente.id_docente FROM docente  WHERE docente.nombre like('%$d%') or docente.apellido like('%$d%')  LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>
<style>
/* The container */
.aa {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.aa input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 23px;

  border-radius:5px;
  background-color: #ccc;
}

/* On mouse-over, add a grey background color */
.aa:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.aa input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.aa input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.aa .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<form method="post">
 <div class="box-body no-padding">

  <div class="mailbox-controls">
 
    <!-- Check all button -->
    
    <div class="btn-group">  
      <?php if($paginaActual > 1){
        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
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
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction1('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction1('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>

    <div class="">

      

      <br>
      <table class="table table-striped table-condensed table-hover">
       <thead>
        <tr>
          <th>foto</th>
          <th>nombre</th>
          <th>apellido</th>
          <?php 
          $consultar_nivelx="SELECT * FROM periodo order by numero";
          $consultar_nivel1x=$conexion->prepare($consultar_nivelx);
          $consultar_nivel1x->execute(array());
          $consultar_nivel12x=$consultar_nivel1x->fetchAll(); 
          foreach ($consultar_nivel12x as $keyx ) {
            echo "<th>".$keyx['nombre']."<th>";

          } 
          ?>
        </tr>
      </thead>


      <?php
      foreach ($registro as $key) { 
               $id_docente=$key['doce']; ?>

          <tr>
            <td><img class="profile-user-img img-responsive img-circle" src="<?php if($key['foto']=='' && $key['genero']=='Femenino'){echo '../../../logos/femenino.png';}if($key['foto']=='' && $key['genero']=='Masculino'){echo '../../../logos/masculino.png';}else{echo $key['foto'];
            } ?>" alt="User profile picture">
</td>
            <td><?php echo $key['nombre'] ?></td>
            <td><?php echo $key['apellido'] ; ?>  </td>

            <?php 
 
            $selecc="SELECT periodo.numero, docente_habilitado.*,periodo.nombre FROM docente_habilitado LEFT JOIN  periodo on periodo.id_periodo=docente_habilitado.id_periodo WHERE docente_habilitado.id_docente='$id_docente' order by periodo.numero  ASC ";
            $selecc=$conexion->prepare($selecc);
            $selecc->execute(array());

             foreach ($selecc as $keyx ) {

             $activo_nota=$keyx['activo_recuperacion']; 
             $n=$keyx['id_docente_habilitado']; 
             if($activo_nota==1){ 
               ?>
 


               <td style="padding-left:30px"> 
                <label class="aa"> 
                  <input type="checkbox" checked="checked" onclick="var i=<?php echo $n; ?>; noche(i)">
                  <span class="checkmark"></span> 
                  <?php
                } else{

               ?>
               <td style="padding-left:30px"> 
                 
                <label class="aa"> 
                  <input type="checkbox"   onclick="var i=<?php echo $n; ?>; noche(i)">
                  <span class="checkmark"></span> 
                  <?php
          }
          ?> <td><?php

        }
         ?>
 
          </tr>
        
    <?php } ?>

    </tbody></table>

    <?php
     
echo ' </i> <ul class="pagination" id="pagination"> '.$lista.'</ul>';

}
function recup(){
   
 
  include "../../conexion.php"; 

  $id =$_POST['i']; 

  $consul="SELECT * FROM `periodo` WHERE periodo.id_periodo=$id";
  $consul=$conexion->prepare($consul);
  $consul->execute(array());
  foreach ($consul as   $value) {
    $i=$value['activar_recuperacion'];
  } 
    if ($i==0) {
      $consul="UPDATE `periodo` SET `activar_recuperacion` = '1'  WHERE   periodo.id_periodo=$id";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    else {
      $consul="UPDATE `periodo` SET `activar_recuperacion` = '0'  WHERE   periodo.id_periodo=$id";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    

}
function notap(){
   
 
  include "../../conexion.php"; 

  $id =$_POST['i']; 

  $consul="SELECT * FROM `periodo` WHERE periodo.id_periodo=$id";
  $consul=$conexion->prepare($consul);
  $consul->execute(array());
  foreach ($consul as   $value) {
    $i=$value['activar_periodo'];
  } 
    if ($i==0) {
      $consul="UPDATE `periodo` SET `activar_periodo` = '1'  WHERE   periodo.id_periodo=$id";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    else {
      $consul="UPDATE `periodo` SET `activar_periodo` = '0'  WHERE   periodo.id_periodo=$id";
      $consul=$conexion->prepare($consul);
      $consul->execute(array()); 
    } 
    

}
function notas(){
        include "../../conexion.php";

        $consultar_nivel="SELECT * FROM periodo order by numero";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll();  
        ?><style>
/* The container */
.ee {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.ee input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 23px;
  border-radius:5px;
  background-color: #ccc;
}

/* On mouse-over, add a grey background color */
.ee:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.ee input:checked ~ .checkmark {
  background-color: #0fbf99;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.ee input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.ee .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style><br>
 <table>
        <tr style="margin-top: 170px"> 
          <?php 

          foreach ($consultar_nivel12 as $key){ 

            $t=$key['activar_periodo'];

            $st=$key['id_periodo'];
            if ($t==1) { 
               ?>
 


<td ><?php echo $key['nombre']; ?></td>               <td style="padding-left: 10px; padding-right:30px"> 
                <label class="ee"> 
                  <input type="checkbox" checked="checked" onclick="var i=<?php echo $st; ?>; notap(i)">
                  <span class="checkmark"></span> 
                  <?php
                } else{

               ?>
<td ><?php echo $key['nombre']; ?></td>               <td style="padding-left: 10px; padding-right:30px"> 
                 
                <label class="ee"> 
                  <input type="checkbox"   onclick="var i=<?php echo $st; ?>; notap(i)">
                  <span class="checkmark"></span> 
                  <?php
          }
          ?> <td><?php
        } ?>   
        </tr> 
 </table>

 <br>
        <?php  
      }

      function recuperacion(){
        include "../../conexion.php";

        $consultar_nivel="SELECT * FROM periodo order by numero";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll();  
        ?><br>
 <table>
        <tr style="margin-top: 170px"> 
          <?php 

          foreach ($consultar_nivel12 as $key){ 

            $t=$key['activar_recuperacion'];

            $st=$key['id_periodo'];
            if ($t==1) { 
               ?>
 


<td ><?php echo $key['nombre']; ?></td>               <td style="padding-left: 10px; padding-right:30px"> 
                <label class="aa"> 
                  <input type="checkbox" checked="checked" onclick="var i=<?php echo $st; ?>; recup(i)">
                  <span class="checkmark"></span> 
                  <?php
                } else{

               ?>
<td ><?php echo $key['nombre']; ?></td>               <td style="padding-left: 10px; padding-right:30px"> 
                 
                <label class="aa"> 
                  <input type="checkbox"   onclick="var i=<?php echo $st; ?>; recup(i)">
                  <span class="checkmark"></span> 
                  <?php
          }
          ?> <td><?php
        } ?>   
        </tr> 
 </table>

 <br>
        <?php  
      }
     
       

 ?>