  <?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
function registro()
{ 
  include '../../conexion.php'; 
  session_start();
 
  if(isset($_POST['curo'])){
     $porcion=explode(' ', $curo);
    $curso=$porcion[0];
    $grado=$porcion[1];
  }else{ 
    $curso='';
    $grado='';
  }
  if(isset($_POST['sede'])){
    $sede=$_POST['sede']; 
  }else{
    $sede='';
  }
 

  $id=$_SESSION['Id_Doc']; 
  $title=$_POST['title'];
  $descripcion=$_POST['descripcion'];
  $color1=$_POST['color1'];
  $start1=$_POST['start1'];
  $end1=$_POST['end1']; 
  $rol=$_POST['rol'];
  $tipo=$_POST['tipo'];
  if(isset($_POST['id_per'])){
    $id_person=$_POST['id_per']; 
  
    foreach ($id_person as  $value) {
      $consultar_nivel="INSERT INTO `notificaciones` ( `tipo`, `dirigido`, `id_jornada_sede`, `id_curso`, `id_grado`, `id_persona`, `title`, `descripcion`, `color`, `start`, `end`, `de`, `visto`) VALUES ('$tipo', '$rol', '$sede', '$curso', '$grado', '$value', '$title', '$descripcion', '$color1', '$start1', '$end1', '$id', '0')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
    }
  }else{
    $consultar_nivel="INSERT INTO `notificaciones` ( `tipo`, `dirigido`, `id_jornada_sede`, `id_curso`, `id_grado`, `id_persona`, `title`, `descripcion`, `color`, `start`, `end`, `de`, `visto`) VALUES ('$tipo', '$rol', '$sede', '$curso', '$grado', '$id', '$title', '$descripcion', '$color1', '$start1', '$end1', '$id', '0')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
  }

 

}


function ver(){
  include '../../conexion.php';
  session_start();
  if ($_SESSION['roll']=='1') {
    # code...
 
    $sql = "SELECT notificaciones.* FROM notificaciones  WHERE notificaciones.de='".$_SESSION['Id_Doc']."'   or notificaciones.id_persona='".$_SESSION['Id_Doc']."'";
    $req = $conexion->prepare($sql);
    $req->execute();
    $events = $req->fetchAll();
    echo json_encode($events); 
  }
}
function observa(){
  include '../../conexion.php';
  $id_curso=$_POST['id_curso'];
  $id_persona=$_POST['id_persona']; 
  $id_grado=$_POST['id_grado'];
  $dirigido=$_POST['dirigido'];
  $id_jornada_sede=$_POST['id_jornada_sede']; 
  $de=$_POST['de']; 
  if($de)

  if ($dirigido==1) {
    if($id_persona==0){
      ?>   
                    <label for="title" class="col-sm-2 control-label">Dirijido</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" value="Para todos los administradores" class="form-control" id="title" placeholder="Titulo">
                    </div>
                   <?php
    }else{

      $sql = "SELECT  administradores.NOMBRE,administradores.APELLIDO,administradores.FOTO,administradores.ROL,administradores.GENERO from administradores WHERE administradores.ID_ADMIN='".$id_persona ."'";
      $req = $conexion->prepare($sql);
      $req->execute();
      $events = $req->fetchAll();
      foreach ($events as $value ) {
        if ($value['FOTO']=='' and $value['GENERO']==1) {
          $foto='../../../logos/femenino.png';  
        }
        if ($value['FOTO']=='' and $value['GENERO']==0) {
          $foto='../../../logos/masculino.png';  
        }if ($value['FOTO']!='') {
          $foto=$value['FOTO']; 
        }
        ?><center> Enviado a: <br>  <?php echo $value['NOMBRE'].' '.$value['APELLIDO'] ?> <br> Rol: <?php echo  $value['ROL'] ?></center>
        <img class="profile-user-img img-responsive img-circle" src="<?php echo $foto ?>" alt="User profile picture" style="    margin: 0 auto;width: 180px;height: 180px;padding: 3px;border: 3px solid #d2d6de;">
        <?php
      }
    }
  }
}

?>