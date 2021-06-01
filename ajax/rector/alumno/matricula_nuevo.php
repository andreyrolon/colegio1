<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}
function matricula(){
  include '../../conexion.php'; 
  $fecha = date('Y-m-d');
  if ($_POST["jornada_sede"]=="") {
    echo "a";
    return;
  } 
  if ($_POST["curso"]=="") {
    echo "s";
    return;
  } 
  if ($_POST["metodologia"]=="") {
    echo "d";
    return;
  }
  if ($_POST["id_periodo"]=="") {
    echo "f";
    return;
  } 
  if (!preg_match ("/^[0-9]+$/", $_POST["jornada_sede"])) {
    echo "q";
    return;
  }
  if (!preg_match ("/^[0-9]+$/", $_POST["id_periodo"])) {
    echo "q";
    return;
  }
  if (!preg_match ("/^[0-9 ]+$/", $_POST["curso"])) {
    echo "q";
    return;
    
  }
  if (!preg_match ("/^[0-9]+$/", $_POST["id_alumno"])) {
    echo "q";
    return;
    
  }
  if (!preg_match ("/^[0-9]+$/", $_POST["ano"])) {
    echo "q";
    return;
    
  }
  if (!preg_match ("/^[0-9]+$/", $_POST["metodologia"])) {
    echo "q";
    return;
    
  }
  $jornada_sede=$_POST["jornada_sede"];
  $id_periodo=$_POST["id_periodo"];
  $porciones=explode(" ", $_POST["curso"]);
  $id_grado=$porciones[1];
  $id_curso=$porciones[0];
  $ano=$_POST["ano"];
  $consultar_nivel="SELECT informeacademico.id_informe_academico FROM informeacademico WHERE informeacademico.ano='".$_POST["ano"]."'   and informeacademico.id_alumno='".$_POST["id_alumno"]."' " ; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $fila=$consultar_nivel1->rowCount();
  if ($fila==0) {
    $consultar_nivel=" INSERT INTO `informeacademico` ( `id_alumno`, `fecha`,   `metodologia`, `ano`, `estado_aprovado`, `id_grado`, `id_curso`, `id_jornada_sede`) VALUES ( '".$_POST["id_alumno"]."', '$fecha', '".$_POST["metodologia"]."', '".$_POST["ano"]."' , '0', '".$id_grado."', '$id_curso', '".$_POST["jornada_sede"]."') " ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $f =$conexion->lastInsertId() ;

    $periodo="INSERT INTO `materia_por_periodo` ( `periodo`, `id_informe_academico`, `id_area`, `codigo`, `area`, `nombre_materia`)
    SELECT r.numero,'$f',q.id_area,q.codigo,q.area,q.nombre from(SELECT area.nombre,area.area,area.codigo,area.id_area from area,are_grado_sede,grado_sede WHERE are_grado_sede.id_grado_sede=grado_sede.id and grado_sede.id_jornada_sede='".$jornada_sede."' and grado_sede.id_grado='".$id_grado."'  and grado_sede.id_curso='".$id_curso."' and are_grado_sede.id_area=area.id_area)as q,(SELECT periodo.numero from periodo)as r;

    INSERT INTO `tecnologia` (`competencia`, `id_periodo`, `id_informe_academico`,  `id_competrencia`) SELECT competencias.nombre,competencias.id_periodo,'$f',competencias.id_competencias from grado_sede,tecnica_grado_sede,competencias WHERE  grado_sede.id_grado='".$id_grado."'  and grado_sede.id_jornada_sede= '".$jornada_sede."' and   grado_sede.id_curso='".$id_curso."'  and grado_sede.id=tecnica_grado_sede.id_grado_sede  and competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede";
    $con=$conexion->prepare($periodo);
    $con->execute(array()); 
 
    $consultar_nivel="INSERT INTO `materia_por_paso` ( `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`, `nota`, `identificador`)
      SELECT materia_por_periodo.id_materia_por_periodo,'$f', nota_independiente.id_nota_independiente,'0','0' from materia_por_periodo,nota_independiente WHERE nota_independiente.ano='$ano' and  nota_independiente.id_curso='$id_curso' and nota_independiente.id_grado='$id_grado' and nota_independiente.id_jornada_sede='$jornada_sede' and nota_independiente.id_periodo='$id_periodo'  AND materia_por_periodo.id_informe_academico='$f' AND materia_por_periodo.periodo='$id_periodo' and nota_independiente.id_area=materia_por_periodo.id_area;INSERT INTO `tecnica_por_paso` ( `nota`, `id_tecnologia`, `id_nota_tecnologia_independiente`, `id_informe_academico`, `identificador`) 
        SELECT '0', tecnologia.id_tecnologia, nota_tecnologica_independiente.id_nota_tecnologica_independiente,'$f','0' from nota_tecnologica_independiente,tecnologia WHERE nota_tecnologica_independiente.ano=$ano and  nota_tecnologica_independiente.id_curso='$id_curso' and nota_tecnologica_independiente.id_grado='$id_grado' and nota_tecnologica_independiente.id_jornada_sede='$jornada_sede' and nota_tecnologica_independiente.id_periodo='$id_periodo' and tecnologia.id_informe_academico='$f' and tecnologia.id_competrencia=nota_tecnologica_independiente.id_competencia ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      echo "1";
  }else{
    echo 0;
  }
}
function datos_acudiente(){

  include '../../conexion.php';
  $consultar_nivel="SELECT id_acudiente, nombre,apellido,num_documento,tipo_documento from acudiente where num_documento=".$_POST["numero_acudiente"];
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $fila=$consultar_nivel1->rowCount();
  if ($fila>0) {
    foreach ($consultar_nivel1 as $key ) {
      echo "
      <input type='hidden' name='id_datos' id='id_datos' value='".$key["id_acudiente"]."'>  <div class='bonito'> El acudiente ".$key["nombre"]." ".$key["apellido"]." con ".$key["tipo_documento"]."  ".$key["num_documento"]."</div><br>" ;
    }
  }else{
    echo "<div  class='erroneo'>No se encuentra regitrado en el sistema</div><br>";
  }
}
function actalizar_foto(){
  include '../../conexion.php';

  $Foto=$_FILES['imgh'];
  $url=$_POST['url'];
  if ($url!='') { 
    unlink("$url");
  }
  $na=md5($Foto['tmp_name']).'.jpg';
  $ruta2='../../../img_alumno/'.$na;
  move_uploaded_file($Foto['tmp_name'], $ruta2);
  $consultar_nivel="UPDATE `alumnos` SET `foto`='$ruta2' WHERE alumnos.id_alumnos=".$_POST["id_alumnos"];
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}


function salud(){
  include '../../conexion.php';
  if ($_POST['nombre']!="") {
    echo "1";
    $consultar_nivel="INSERT INTO `salud` (`nombre`) VALUES ('".$_POST['nombre']."')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    return;
  }
  echo "0";
}
function acudiente(){
  include '../../conexion.php';

  $consultar_nivel="SELECT * from acudiente WHERE acudiente.num_documento=".$_POST['numero_documento'];
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());

    $nombre='';
    $apellido='';
    $tipo_documento='';
    $num_documento='';
    $expedida='';
    $direccion='';
    $barrio='';
    $celular='';
    $ocupacion='';
    $direccion_trabajo='';
    $email='';
    $telefono_trabajo=''; 
    $valor=0;
    $numero_documento='';
    $id_acudiente="";
  foreach ($consultar_nivel1 as $key ) {
    $nombre=$key['nombre'];
    $apellido=$key['apellido'];
    $tipo_documento=$key['tipo_documento'];
    $num_documento=$key['num_documento'];
    $expedida=$key['expedida'];
    $direccion=$key['direccion'];
    $barrio=$key['barrio'];
    $celular=$key['celular'];
    $ocupacion=$key['ocupacion'];
    $direccion_trabajo=$key['direccion_trabajo'];
    $email=$key['email'];
    $telefono_trabajo=$key['telefono_trabajo']; 
    $valor=1;
    $numero_documento=$_POST['numero_documento'];
    $id_acudiente=$key["id_acudiente"];
  }

  $var=array($valor,$nombre,$apellido,$tipo_documento,$numero_documento,$expedida,$direccion,$barrio,$celular,$ocupacion,$direccion_trabajo,$email,$telefono_trabajo,$id_acudiente);

  echo json_encode($var); 

}
function mostrar_salud(){
  include '../../conexion.php';

  $consultar_nivel="SELECT   nombre FROM `salud`";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  ?>
  <select class="form-control" name="filiacion_salud" id="afiliado"   >
    <option value="" selected="selected">-Seleccionar-</option>
    <?php 
    foreach ($consultar_nivel1 as $key) {
      ?>
      <option value="<?php echo $key[0] ?>" selected="selected"><?php echo $key[0] ?></option>
      <?php
    }
    ?>
  </select><?php
}

function actualizar(){
  include '../../conexion.php';

 echo $consultar_nivel="UPDATE `alumnos` SET `".$_POST['col']."` = '".$_POST['nom']."' WHERE `alumnos`.`id_alumnos` = '".$_POST['id']."';";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}




function matricula_nuevo(){
  include '../../conexion.php';
     
  require_once "../../../codes/rector/admin.php";
  $admin=new admin();
  $pais=$admin->pais();
  $departamentos=$admin->departamento();
  $salud=$admin->salud();
  $ano=date('Y');
  




    
$ro1='';
$s='';



   




    $consultar_nivel="SELECT alumnos.vive, alumnos.id_alumnos,  alumnos.nombre,alumnos.apellido,informeacademico.id_informe_academico ,informeacademico.id_grado ,alumnos.tipo_sangre,alumnos.estrato,alumnos.sisben_puntaje,alumnos.numero_carnet,alumnos.subsidiado,alumnos.proviene_bienestar,alumnos.desplazado,alumnos.discapacidad

  ,alumnos.etnia
  ,alumnos.cual_etnia
  ,alumnos.pae
  ,alumnos.familia_accion
  ,alumnos.foto
  ,alumnos.clavea
  ,alumnos.claves
  ,alumnos.zona
  ,alumnos.deportado
  ,alumnos.capacidad_excepcional
  ,alumnos.otros_talentos
  ,alumnos.pais_nacimiento

  ,alumnos.departamento_nacimiento
  ,alumnos.pais_expedicion
  ,alumnos.departamento_expedicion 
  ,alumnos.cual_discapacidad, alumnos.desmovilizado,alumnos.hijos_desmovilizado, alumnos.municipio_desmovilizado,alumnos.religion,alumnos.filiacion_salud,alumnos.correo,alumnos.celular,alumnos.telefono,alumnos.barrio,alumnos.direccion,alumnos.genero,alumnos.edad,alumnos.ciudad_expedido,alumnos.numero_documento,alumnos.tipo_documento,alumnos.ciudad_nacimiento,alumnos.fecha_nacimiento from informeacademico,alumnos WHERE alumnos.id_alumnos=informeacademico.id_alumno and alumnos.numero_documento='".$_POST['id_alumno']."' ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  $fila=$consultar_nivel1->rowCount(); 
  if ($fila==0) { ?>
    <div class="borde_bonito" style="padding: 10px"><br>
      <div class="bonito">
        <h4>Información!</h4>
        Actualmente no hay ningun estudiante con ese numero de documento.
      </div><br>
    </div><br><?php
    return;
  }   
  foreach ($consultar_nivel1 as $key ) { 
    $nombre=$key['nombre'];
    $vive=$key['vive'];
    $apellido=$key['apellido'];
    $fecha_nacimiento=$key['fecha_nacimiento'];
     $ciudad_nacimiento=$key['ciudad_nacimiento']; 
    $tipo_documento=$key['tipo_documento'];
     $numero_documento=$key['numero_documento'];
    $ciudad_expedido=$key['ciudad_expedido'];
    $edad=$key['edad'];
    $genero=$key['genero'];
    $direccion=$key['direccion'];
    $barrio=$key['barrio'];
    $telefono=$key['telefono'];
    $celular=$key['celular'];
    $correo=$key['correo'];
    $religion=$key['religion'];
    $filiacion_salud=$key['filiacion_salud'];
    $tipo_sangre=$key['tipo_sangre'];
    $estrato=$key['estrato'];
    $sisben_puntaje=$key['sisben_puntaje'];
    $numero_carnet=$key['numero_carnet'];
    $subsidiado=$key['subsidiado'];
    $proviene_bienestar=$key['proviene_bienestar'];
    $desplazado=$key['desplazado'];
    $discapacidad=$key['discapacidad'];
    $cual_discapacidad=$key['cual_discapacidad'];
    $desmovilizado=$key['desmovilizado'];
    $hijos_desmovilizado=$key['hijos_desmovilizado'];
    $municipio_desmovilizado=$key['municipio_desmovilizado'];
    $etnia=$key['etnia'];
    $cual_etnia=$key['cual_etnia'];
    $familia_accion=$key['familia_accion'];
    $pae=$key['pae'];
    $foto=$key['foto'];
    $clavea=$key['clavea'];
    $claves=$key['claves'];
    $zona=$key['zona'];
    $deportado=$key['deportado'];
    $capacidad_excepcional=$key['capacidad_excepcional'];
    $otros_talentos=$key['otros_talentos'];
    $pais_nacimiento=$key['pais_nacimiento'];
    $departamento_nacimiento=$key['departamento_nacimiento'];
    $pais_expedicion=$key['pais_expedicion'];
     $departamento_expedicion=$key['departamento_expedicion'];
    $id_informe_academico=$key['id_informe_academico'];
    $id_grado=$key['id_grado'];
  
    $id_alumnos=$key['id_alumnos'];
    $hijos_desmovilizado=$key['hijos_desmovilizado'];
    $hijos_desmovilizado=$key['hijos_desmovilizado'];
  }
  ?> 
  <script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
  <script>
  $('.select2').select2({    
    language: {

      noResults: function() {

        return "No hay resultado";        
      },
      searching: function() {

        return "Buscando..";
      }
    }
  });
   

  </script> 
     <div class="modal in" id="my22" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog" role="document">
              <div class="modal-content "  >
                <form  method="post">  
                  <div class="modal-header btn-primary table-responsive">
                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style='color: #fff' >×</button>
                    <h4 id="titulo4" class="modal-title">   Agregar Departamento al sistema</h4>
                  </div> 
  
                  <div class="modal-body table-responsive" id="pdf">
                    <div id="_MSG7_"></div>
                    <strong>Nombre del pais</strong><br>
                    <select    id='papi' class="form-control select2"  style=" width: 100% <?php echo  $style ?>" onchange='var id=document.getElementById("papi").value; pais3(id)' required>
                              <option value="">Seleccione un pais</option>
                              <?php foreach ($pais as $key ) {?>
                                <option value="<?php echo $key['id'].','.$key['paisnombre']  ?>"><?php echo $key['paisnombre'] ?></option>
                                <?php
                              } ?> 
                            </select><br><br>
                    <strong>Nombre del departamento</strong>
                    <input type=""id='papaaa' class="form-control" name=""> 
                    <div class="modal-footer">   
                      <button type="button" onclick="
                      var pais=document.getElementById('papi').value;

                      var departamento=document.getElementById('papaaa').value; insert2(pais,departamento)" class="btn  btn-block btn-danger" name="eliminary2" id="eliminary2" onclick="" value="520">Registra</button> 
                     <br>
                      <div id="bobo" class="box-header with-border" style="display: none"> <br>
                        <select id="mySelect" class="form-control" onchange="myFunction(1)" style="width:63px;">


                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                          </select>
                          <div class="box-tools pull-right"><br>
                              <div class="has-feedback">
                                  <input type="text" class="form-control   " id="fname" placeholder="buscador.." onkeyup="myFunction(1)" style="margin-top: 5px;">
                                  <span class="fa fa-search form-control-feedback" style=" "></span>
                              </div>
                          </div>
                          <!-- /.box-tools -->
                      </div>
                     <div id="ver_tabla"></div>
                     
                  </div>
                  
                      <button type="button" class="btn  btn-block btn-default" data-dismiss="modal">Cancelar</button> 
                      
                  </div>
                </form>
              </div>
            </div>
        </div>

  <div class="nav-tabs-custom" id="koooo" style="    box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;"> 
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activitys" data-toggle="tab" aria-expanded="true">Informacion del alumno</a></li>
                  <li class=""><a href="#timeline1" data-toggle="tab" aria-expanded="false">Informacion del padre</a></li>
                  <li class=""><a href="#timeline2" data-toggle="tab" aria-expanded="false">Informacion de la madre </a></li>
                  <li class=""><a href="#timeline3" data-toggle="tab" aria-expanded="false">Informacion del acudiente </a></li> 
                </ul><br>
                <div class="tab-content">
                  <div class="tab-pane active" id="activitys">
                    


<style>
  .select2,select,input{
  text-transform: uppercase;
}
</style>

<!-- Bootstrap 3.3.7 -->
 
 



<!-- Slimscroll --> 
<!-- FastClick -->  
<!-- iCheck --> 



 
 
                  
                    <div class="row">
                      <div class="col-md-2">
                        <center><br>
                          <div > 
                            <img id="blah" src="<?php echo $foto  ?>" alt="Tu imagen" style="border-style: solid;
                            border-color: #d2d6de; width: 120px; " />
                          </div><br>
                          <form method="post" id="actualizar_foto" name="actualizar_foto" enctype="multipart/form-data" method="post">

                            <input type="hidden" value="<?php  echo $id_alumnos ?>" name="id_alumnos" id="id_alumnos">
                            <input type="hidden" id="url" name="url" value="<?php echo $foto  ?>">
                            <div class="btn btn-default btn-file btn-lg">
                              <i class="fa fa-picture-o margin-r-5"></i> Cambiar Foto
                              <input type="file" name="imgh" id="imgh" onchange=" readImage(this);">
                            </div>
                          </form>
                        </center>
                      </div>
                      <div class="col-md-10" style="">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="nombre"><span data-toggle="modal" data-target="#my">+</span> Pais de nacimiento</label> 
                            <select   name="pais_nacimiento" id='PAIS' class="form-control select2"  style="   " onchange='
                            var id=document.getElementById("PAIS").value; 
                            pais(id);  
                            var col="pais_nacimiento";
                            var porciones = id.split(",");
                            var nom=porciones[1]; 
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);' required>

                              <?php
                              $select_pais="";
                              foreach ($pais as $key ) { 
                                if ($pais_nacimiento ==$key['paisnombre']) {
                                  
                                  echo '<option value="'.$key['id'].','.$key['paisnombre'].'">'.$key['paisnombre'].'</option>';
                                }else{
                                  $select_pais.='<option value="'.$key['id'].','.$key['paisnombre'].'">'.$key['paisnombre'].'</option>';
                                } 
                              }
                              echo $select_pais; ?> 

                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre"><span data-toggle="modal" data-target="#my22">+</span>  Departamento de nacimiento</label>
                            <select class="form-control select2"  id="departamento_nacimiento"   name="departamento_nacimiento" onchange="
                            var nom=document.getElementById('departamento_nacimiento').value;
                            var col='departamento_nacimiento';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <option value="<?php echo $departamento_nacimiento ?>"><?php echo $departamento_nacimiento ?></option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Ciudad de nacimiento</label>
                            <input type="" class="form-control" id="ciudad_nacimiento" name="ciudad_nacimiento" onchange="
                            var nom=document.getElementById('ciudad_nacimiento').value;
                            var col='ciudad_nacimiento';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" value="<?php echo $ciudad_nacimiento ?>" required>
                          </div>

                          <div class="col-md-3">
                            <label for="nombre">Tipo de documento</label>
                            <select name="tipo_documento"  id="tipo_documento" class="form-control" onchange="
                            var nom=document.getElementById('tipo_documento').value;
                            var col='tipo_documento';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);"  required> 
                              <option value="<?php echo $tipo_documento ?>"><?php echo $tipo_documento ?></option>
                              <option></option>
                            </select>
                          </div>
                        </div>
                        <div class="row"><br>
                          <div class="col-md-3">
                            <label for="nombre">Numero documento</label>
                            <input name="numero_documento" id="numero_documento" type="text" class="form-control"    pattern="[0-9]{7,}" title="Ingrese solo numeros mayores a seis digitos " value="<?php echo $numero_documento; ?>"   onblur="
                              var nom=document.getElementById('numero_documento').value;
                              if (nom!=<?php echo $numero_documento; ?>) { 
                                funcion() ;}" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Pais expedición</label>
                            <select   name="pais_expedicion" id='pais_expedicion' class="form-control select2"  style="  <?php echo  $style ?>" onchange='
                            var id=document.getElementById("pais_expedicion").value;
                            pais2(id);
                            var porciones = id.split(",");
                            var nom=porciones[1]; 
                            var col="pais_expedicion"

                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);   ' required>
                            <?php
                              $select_pais2="";
                              foreach ($pais as $key ) { 
                                if ($pais_expedicion ==$key['paisnombre']) {
                                  
                                  echo '<option value="'.$key['id'].','.$key['paisnombre'].'">'.$key['paisnombre'].'</option>';
                                }else{
                                  $select_pais2.='<option value="'.$key['id'].','.$key['paisnombre'].'">'.$key['paisnombre'].'</option>';
                                } 
                              }
                              echo $select_pais2; ?> 

                            
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Departamento expedición</label>
                            <select class="form-control select2" name="departamento_expedicion"  id="departamento_expedicion" onchange="
                            var nom=document.getElementById('departamento_expedicion').value;
                            var col='departamento_expedicion';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);"  required >
                              <option value="<?php echo $departamento_expedicion ?>"><?php echo $departamento_expedicion ?></option>

                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Ciudad expedición</label>
                            <input name="ciudad_expedicion" id="ciudad_expedicion" value="<?php echo $ciudad_expedido ?>"   type="text" class="form-control"    value=""    onchange="
                            var nom=document.getElementById('ciudad_expedicion').value;
                            var col='ciudad_expedido';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <br>
                        </div>
                        <div class="row"><br>
                          <div class="col-md-3">
                            <label for="nombre">Nombres</label>
                            <input   class="form-control" name="nombre" id="nombre" type="text"   pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras" value="<?php  echo $nombre ?>"  onchange="
                            var nom=document.getElementById('nombre').value;
                            var col='nombre';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Apellidos</label>
                            <input   class="form-control" name="apellido" id="apellido" type="text"   pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras"  value="<?php  echo $apellido ?>"  onchange="
                            var nom=document.getElementById('apellido').value;
                            var col='apellido';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"  value="<?php  echo $fecha_nacimiento ?>"  onchange="
                            var nom=document.getElementById('fecha_nacimiento').value;
                            var col='fecha_nacimiento';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>

                          <div class="col-md-1">
                            <label for="nombre">Edad</label>
                            <input    class="form-control" name="edad" type="text" id="edad"   size="5" maxlength="2" pattern="([0-9]{2})"   value="<?php  echo $edad ?>"  onchange="
                            var nom=document.getElementById('edad').value;
                            var col='edad';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Genero</label><br>
                            <select name="genero" class="form-control" id="genero"     onchange="
                            var nom=document.getElementById('genero').value;
                            var col='genero';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php 
                                $rt=array('<option value="0">Maculino</option>','<option value="1">Femenino</option>');
                                echo $w=$rt[$genero];
                                foreach ($rt as $key) {
                                  if ($w!=$key) {
                                    echo $key;  
                                  } 
                                }
                                ?>
                            </select>
                          </div>
                        </div><br>


                        <div class="row">
                          <div class="col-md-3">
                            <label for="nombre">Telefono o celular</label>
                            <input name="telefono" type="text"  class="form-control" id="telefono"   maxlength="10"   pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"     value="<?php  echo $telefono ?>"  onchange="
                            var nom=document.getElementById('telefono').value;
                            var col='telefono';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Direccion</label>
                            <input name="direccion" type="text" class="form-control"  id="direccion"    value="<?php  echo $direccion ?>"  onchange="

                            var nom=document.getElementById('direccion').value;
                            if (Esdireccion(nom)) {
                              Swal.fire({ 
                                icon: 'error',
                                title:'El campo direccion solo permite estos caracteres.',
                                text: '0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-',
                                showConfirmButton: true, 
                              });
                              document.getElementById('direccion').value='<?php echo $direccion ?>';
                              return;
                            }
                            var col='direccion';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Barrio</label>
                            <input name="barrio" type="text" class="form-control" id="barrio"  value="<?php  echo $barrio ?>"  onchange="
                            var nom=document.getElementById('barrio').value;
                            var col='barrio';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Correo electronico</label>
                            <input type="email" class="form-control" name="correo" id="correo" value="<?php  echo $correo ?>"  onchange="
                            var nom=document.getElementById('correo').value;
                            var col='correo';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                           
                        </div><br>


                        <div class="row">
                          
                          
                          
                          <div class="col-md-2">
                            <label for="nombre">Tipo de sangre </label>
                            <select name="tipo_sangre" id="tipo_sangre" class="form-control"    onchange="
                            var nom=document.getElementById('tipo_sangre').value;
                            var col='tipo_sangre';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <option value="<?php echo $tipo_sangre  ?>"><?php echo $tipo_sangre  ?></option>
                              <option value="A+" >A+</option>
                              <option value="A-" >A-</option>
                              <option value="B+" >B+</option>
                              <option value="B-" >B-</option>
                              <option value="O+" >O+</option>
                              <option value="O-" >O-</option>
                              <option value="AB+" >AB+</option>
                              <option value="AB-" >AB-</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre"><span data-toggle="modal" data-target="#vida">+</span>Afiliación de salud</label>
                            <select   class="form-control select2" name="filiacion_salud" id="filiacion_salud"   onchange="
                            var nom=document.getElementById('filiacion_salud').value;
                            var col='filiacion_salud';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <option  value="<?php echo $filiacion_salud ?>"><?php echo $filiacion_salud ?></option>
                               <?php 
                               foreach ($salud as $key) {
                                  if ($filiacion_salud!=$key['nombre']) {
                                    ?>
                                    <option  value="<?php echo $key['nombre'] ?>"><?php echo $key['nombre'] ?></option>
                                    <?php
                                  }
                                } ?>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">nivel del sisben</label>
                            <input type="" class="form-control" name="sisben_puntaje"  id="sisben_puntaje" value="<?php echo $sisben_puntaje ?>" onchange="
                            var nom=document.getElementById('sisben_puntaje').value;
                            var col='sisben_puntaje';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Numero del sisben </label>
                            <input type="number" class="form-control" id="numero_carnet" value="<?php echo $numero_carnet ?>" name="numero_carnet" onchange="
                            var nom=document.getElementById('numero_carnet').value;
                            var col='numero_carnet';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          
                          <div class="col-md-2">
                            <label for="nombre">Estracto</label>
                            <input type="" class="form-control" name="estrato" id="estrato" value="<?php echo $estrato ?>"  onchange="
                            var nom=document.getElementById('estrato').value;
                            var col='estrato';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                        </div><br>

                        <div class="row">
                          <div class="col-md-2">
                            <label for="nombre">Desplazado</label>
                            <select name="desplazado" id="desplazado" class=" form-control"   onchange="
                            var nom=document.getElementById('desplazado').value;
                            var col='desplazado';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($desplazado==''   or $desplazado==0 ) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select>  
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Municipio Expulsor</label>  
                             
                            <select  name="municipio_Expulsor" class="form-control select2" id="municipio_Expulsor" value="<?php echo $municipio_desmovilizado ?>" pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Ingrese solo letras" onchange="
                            var nom=document.getElementById('municipio_desmovilizado').value;
                            var col='municipio_desmovilizado';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" >
                            <option value="<?php echo $municipio_desmovilizado ?>"><?php echo $municipio_desmovilizado ?></option>
                              <?php foreach ($departamentos as  $value) {
                                if ($value['estadonombre']!=$municipio_desmovilizado) { 
                                  ?>
                                  <option value="<?php echo $value['estadonombre'] ?>"><?php echo $value['estadonombre'] ?></option>
                                  <?php
                                }
                              } ?>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Desmovilizado</label>
                            <select name="desmovilizado"  id="desmovilizado" class=" form-control" onchange="
                            var nom=document.getElementById('desmovilizado').value;
                            var col='desmovilizado';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($desmovilizado==''  or $desmovilizado==0 ) {
                                ?>
                                <option value="0">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="0">No</option>
                                <?php
                              } ?>
                            </select>  
                          </div>
                          
                          <div class="col-md-3">
                            <label for="nombre">Hijo de desmovilizados </label>
                            <select name="hijos_desmovilizado" id="hijos_desmovilizado" class=" form-control"  onchange="
                            var nom=document.getElementById('hijos_desmovilizado').value;
                            var col='hijos_desmovilizado';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($hijos_desmovilizado==''  or $hijos_desmovilizado==0 ) {
                                ?>
                                <option value="0">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="0">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Afrocolombiano</label>  
                            <select name="afrocolombiano" id="afrocolombiano" class=" form-control"  onchange="
                            var nom=document.getElementById('afrocolombiano').value;
                            var col='afrocolombiano';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($afrocolombiano==''  or $afrocolombiano==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                        </div><br>

                        <div class="row">
                          
                          <div class="col-md-2">
                            <label for="nombre">Etnia</label> 
                            <select name="etnia" id="etnia" class=" form-control" onchange="
                            var nom=document.getElementById('etnia').value;
                            var col='etnia';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($etnia=='' or $etnia==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Cual</label> 
                            <input type="text" name="cual_etnia" id="cual_etnia" value="<?php echo $cual_etnia ?>" class="form-control" onchange="
                            var nom=document.getElementById('cual_etnia').value;
                            var col='cual_etnia';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Familias en acción</label>
                            <select name="familia_accion" id="familia_accion" class=" form-control"  onchange="
                            var nom=document.getElementById('familia_accion').value;
                            var col='familia_accion';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($familia_accion=='' or $familia_accion==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                          <div class="col-md-1">
                            <label for="nombre">PAE</label>
                            <select name="pae" id="pae" class=" form-control" style="padding: 0"  onchange="
                            var nom=document.getElementById('pae').value;
                            var col='pae';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($pae==''  or $pae==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>

                          <div class="col-md-2">
                            <label for="nombre">Provenie de bienestar</label>
                            <select name="proviene_bienestar" id="proviene_bienestar" class=" form-control"  onchange="
                            var nom=document.getElementById('proviene_bienestar').value;
                            var col='proviene_bienestar';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($proviene_bienestar=='' or $proviene_bienestar==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                          <div class="col-md-2">
                            <label for="nombre">Subsidiado</label>
                            <select name="subsidiado" id="subsidiado" class=" form-control"  onchange="
                            var nom=document.getElementById('subsidiado').value;
                            var col='subsidiado';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($subsidiado=='' or $subsidiado==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          <div class="col-md-2">
                            <label for="nombre">Discapacidad</label>
                            <select name="discapacidad" id="discapacidad" class=" form-control"   onchange="
                            var nom=document.getElementById('discapacidad').value;
                            var col='discapacidad';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                              <?php if ($discapacidad=='' or $discapacidad==0) {
                                ?>
                                <option value="">No</option>
                              <option value="1">Si</option>
                                <?php
                              }else{
                                ?>
                              <option value="1">Si</option>
                                <option value="">No</option>
                                <?php
                              } ?>
                            </select> 
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Cual </label>
                            <input type="text" name="cual_discapacidad" value="<?php echo $cual_discapacidad ?>" id="cual_discapacidad" class="form-control" onchange="
                            var nom=document.getElementById('cual_discapacidad').value;
                            var col='cual_discapacidad';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-3">
                            <label for="nombre">Habilidades especiales</label>
                            <input type="text" name="capacidad_excepcional"  value="<?php echo $capacidad_excepcional ?>"  id="capacidad_excepcional" class="form-control"  onchange="
                            var nom=document.getElementById('capacidad_excepcional').value;
                            var col='capacidad_excepcional';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                          <div class="col-md-4">
                            <label for="nombre">Otras talentos </label>
                            <input type="text" name="otros_talentos" id="otros_talentos"   value="<?php echo $otros_talentos ?>"  class="form-control" onchange="
                            var nom=document.getElementById('otros_talentos').value;
                            var col='otros_talentos';
                            var id=<?php echo $id_alumnos ?>;
                            actulizar_alumno(nom,col,id);" required>
                          </div>
                        </div> <br>

                        <div class="row">
                          
                           
                          
                           

                          <div class="col-md-4">
                            <label for="nombre">Con quien vive</label>
                             <input type="" value="<?php echo $vive ?>" class="form-control" id="vive" name="vive">
                          </div>
                        </div> <br>

                         
                      </div>
                    </div>
                  </div> 

                  <!-- comienza mama   -->
                  <?php 
                  $consultar_nivel=" SELECT acudiente.*,alumno_acudiente.parentesco,alumno_acudiente.id from acudiente,alumno_acudiente WHERE alumno_acudiente.id_alumnos='".$id_alumnos."' and alumno_acudiente.id_acudiente=acudiente.id_acudiente ORDER by alumno_acudiente.parentesco ASC";
                  $consultar_nivel1=$conexion->prepare($consultar_nivel);
                  $consultar_nivel1->execute(array());  
                  $can=1;
                  foreach ($consultar_nivel1 as $key ) {  $can1=$can++;
                       $hhh=3;

                    if( $key['parentesco']=="Mamá" || $key['parentesco']=="Madre" ||  $key['parentesco']=="madre" ||  $key['parentesco']=="mama" ||  $key['parentesco']=="Mama"){
                      $hhh=2;
                    }
                    if($key['parentesco']=="Papá" || $key['parentesco']=="Padre" ||  $key['parentesco']=="papa" ||  $key['parentesco']=="Papa" ||  $key['parentesco']=="padre"){
                      $hhh=1;
                    }  ?> 
                    <div class="tab-pane" id="timeline<?php echo $hhh ?>"> 

                      
                      
                       
                      <div class="row" id="ver2"> 
                        <div class="col-md-4">
                          <label for="nombre">Nombres</label>
                          <input type="" class="form-control" value="<?php echo $key['nombre'] ?>" name="nombre<?php echo $can1 ?>"  id="nombre<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('nombre<?php echo $can1 ?>').value;
                          var col='nombre'; 
                          actualizar_acudiente(nom,id,col); ">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Apellido</label>  
                          <input type="" class="form-control" name="apellido<?php echo $can1 ?>" value="<?php echo $key['apellido'] ?>"  id="apellido<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('apellido<?php echo $can1 ?>').value;
                          var col='apellido'; 
                          actualizar_acudiente(nom,id,col); ">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Correo electronico</label>  
                          <input type="email" class="form-control" name="email<?php echo $can1 ?>" value="<?php echo $key['email'] ?>"  id="email<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('email<?php echo $can1 ?>').value;
                          var col='email'; 
                          actualizar_acudiente(nom,id,col); ">
                        </div>  
                      </div><br>

                      <div class="row" id="ver21">
                        <div class="col-md-4">
                          <label for="nombre">Tipo de documento</label>
                          <select name="tipo_documento<?php echo $can1 ?>" class="form-control"   id="tipo_documento<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('tipo_documento<?php echo $can1 ?>').value;
                          var col='tipo_documento'; 
                          actualizar_acudiente(nom,id,col); ">
                           <option value="<?php echo $key['tipo_documento'] ?>" ><?php echo $key['tipo_documento'] ?></option>
                           <option value="T.I." >Tarjeta de Identidad (T.I.)</option>
                              <option value="C.C." >Cedula de Ciudadania (C.C.)</option>
                              <option value="C.E." >Cedula Extranjeria (C.E.)</option>
                              <option value="Pasaporte" >Pasaporte</option> 
                              <option value="PEP" >Permiso Especial Permanencia(PEP)</option> 
                              <option value="R.C." >Registro Civil (R.C.)</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Numero de documento</label>  
                          <input type="" class="form-control" name="num_documento<?php echo $can1 ?>" 
                          value="<?php echo $key['num_documento'] ?>"
                          id="num_documento<?php echo $can1 ?>"  
                          pattern="[0-9]{7,}" title="Ingrese solo numeros mayores a seis digitos "  
                          onblur=" 
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var identifay='num_documento<?php echo $can1 ?>'; 
                          var num_documentoa1=document.getElementById('num_documento<?php echo $can1 ?>').value;  
                          var col='num_documento'; 
                          if (num_documentoa1!=<?php echo $key['num_documento'] ?>) {

                          funcion1(identifay,num_documentoa1,col,id);
                          }">
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Lugar de expedició  n</label>
                          <input type="text" class="form-control" name="expedida<?php echo $can1 ?>" value="<?php echo $key['expedida'] ?>"  id="expedida<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('expedida<?php echo $can1 ?>').value;
                          var col='expedida'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div> 
                      </div><br>

                      <div class="row" id="ver22">
                        <div class="col-md-4">
                          <label for="nombre">Dirección</label>
                          <input name="direccion<?php echo $can1 ?>"class="form-control"   value="<?php echo $key['direccion'] ?>"  id="direccion<?php echo $can1 ?>" onchange="
                          var nom=document.getElementById('direccion<?php echo $can1 ?>').value;
                          if (Esdireccion(nom)) {
                              Swal.fire({ 
                                icon: 'error',
                                title:'El campo direccion solo permite estos caracteres.',
                                text: '0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-',
                                showConfirmButton: true, 
                              });
                              document.getElementById('direccion<?php echo $can1 ?>').value='<?php echo $key['direccion'] ?>';
                              return;
                            }
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var col='direccion'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Barrio</label>  
                          <input type="" class="form-control" name="barrio<?php echo $can1 ?>"   value="<?php echo $key['barrio'] ?>"  id="barrio<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('barrio<?php echo $can1 ?>').value;
                          var col='barrio'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Telefono o celular</label>
                          <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"  name="celular<?php echo $can1 ?>"  value="<?php echo $key['celular'] ?>"  id="celular<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('celular<?php echo $can1 ?>').value;
                          var col='celular'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div> 
                      </div><br> 

                      <div class="row" id="ver23">
                        
                        <?php if ($hhh!=3) { ?>
                          <div class="col-md-4">
                          <label for="nombre">Ocupación</label>
                          <input name="ocupacion<?php echo $can1 ?>" class="form-control"   value="<?php echo $key['ocupacion'] ?>"  id="ocupacion<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('ocupacion<?php echo $can1 ?>').value;
                          var col='ocupacion'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Dirección de trabajo</label>  
                          <input type="" class="form-control" name="direccion_trabajo<?php echo $can1 ?>" value="<?php echo $key['direccion_trabajo'] ?>"  id="direccion_trabajo<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('direccion_trabajo<?php echo $can1 ?>').value;
                          if (Esdireccion(nom)) {
                            Swal.fire({ 
                              icon: 'error',
                              title:'El campo direccion solo permite estos caracteres.',
                              text: '0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-',
                              showConfirmButton: true, 
                            });
                            document.getElementById('direccion_trabajo<?php echo $can1 ?>').value='<?php echo $key['direccion'] ?>';
                            return;
                          }
                          var col='direccion_trabajo'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div>
                          <div class="col-md-4">
                            <label for="nombre">Telefono trabajo</label>
                            <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"  name="telefono_trabajo<?php echo $can1 ?>" value="<?php echo $key['telefono_trabajo'] ?>"  id="telefono_trabajo<?php echo $can1 ?>" onchange="
                            var id=<?php echo $key['id_acudiente'] ?>; 
                            var nom=document.getElementById('telefono_trabajo<?php echo $can1 ?>').value;
                            var col='telefono_trabajo'; 
                            actualizar_acudiente(nom,id,col); "> 
                          </div> 
                          <div class="col-md-2"> <br><br>
                              <button type="button" style="    margin-top: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#eliminar_acu" onclick="document.getElementById('eliminary').value=<?php echo $key['id'] ?>;  "> Eliminar</button>
                 
                          </div> <?php 
                        }else{
                          ?>
                          <div class="col-md-4">
                          <label for="nombre">Ocupación</label>
                          <input name="ocupacion<?php echo $can1 ?>" class="form-control"   value="<?php echo $key['ocupacion'] ?>"  id="ocupacion<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('ocupacion<?php echo $can1 ?>').value;
                          var col='ocupacion'; 
                          actualizar_acudiente(nom,id,col); "> 
                        </div>
                        <div class="col-md-4">
                          <label for="nombre">Dirección de trabajo</label>  
                          <input type="" class="form-control" name="direccion_trabajo<?php echo $can1 ?>" value="<?php echo $key['direccion_trabajo'] ?>"  id="direccion_trabajo<?php echo $can1 ?>" onchange="
                          var id=<?php echo $key['id_acudiente'] ?>; 
                          var nom=document.getElementById('direccion_trabajo<?php echo $can1 ?>').value;
                          var col='direccion_trabajo'; 
                          if (Esdireccion(nom)) {
                            Swal.fire({ 
                              icon: 'error',
                              title:'El campo direccion solo permite estos caracteres.',
                              text: '0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-',
                              showConfirmButton: true, 
                            });
                            document.getElementById('direccion_trabajo<?php echo $can1 ?>').value='<?php echo $key['direccion'] ?>';
                            return;
                          }
                          actualizar_acudiente(nom,id,col); "> 
                        </div>
                          <div class="col-md-4">
                            <label for="nombre">Telefono trabajo</label>
                            <input type="number" class="form-control" pattern="[0-9]{7}||[0-9]{10}" title="solo puedes registrar numeros de 7 a 10 digitos"  name="telefono_trabajo<?php echo $can1 ?>" value="<?php echo $key['telefono_trabajo'] ?>"  id="telefono_trabajo<?php echo $can1 ?>" onchange="
                            var id=<?php echo $key['id_acudiente'] ?>; 
                            var nom=document.getElementById('telefono_trabajo<?php echo $can1 ?>').value;
                            var col='telefono_trabajo'; 
                            actualizar_acudiente(nom,id,col); "> 
                          </div> 
                          <div class="col-md-4"> 
                            <label for="nombre">Parentesco</label> 
                            <select name="parentesco<?php echo $can1 ?>" class="form-control" id="parentesco<?php echo $can1 ?>"  onchange="
                            var id=<?php echo $ee=$key['id'] ?>; 
                            var nom=document.getElementById('parentesco<?php echo $can1 ?>').value;
                            var col='parentesco'; 
                            actualizar_acudienteww(nom,id,col); ">  
                               
                              <option value=" <?php echo $key['parentesco'] ?>"><?php echo $key['parentesco'] ?></option>
                              <option value="Hermano">Hermano</option>
                              <option value="Hermana">Hermana</option>
                              <option value="Tio">Tio</option>
                              <option value="Tia">Tia</option>
                              <option value="Abuelo">Abuelo</option>
                              <option value="Abuela">Abuela </option>
                              <option value="Padrastro">Padrastro</option>
                              <option value="madrastra">madrastra</option>
                              <option value="Vecino">Vecino</option>
                              <option value="Vecina">Vecina</option>
                              
                            </select>
                          </div> 
                          <div class="col-md-2"> <br> 
                              <button type="button" style="    margin-top: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#eliminar_acu" onclick="document.getElementById('eliminary').value=<?php echo $ee ?>;  "> Eliminar Acudiente</button>
                              
                          </div> 
                          <?php
                        } ?>
                      </div><br> 
                    </div> 

                   <!-- fin de mama -->  
                  <?php } ?><div class="tab-pane" id="timeline1"> 
                    <form method="post" id="registrar1">
                      <div class="row" >
                        <div c  style="margin-bottom: 16px;
                        margin-left: 16px;
                        margin-right: 12px;
                        border: solid 1.3px #82c4f8;
                        color: #0a6ebd;
                        background-color: #e3f2fd;
                        /* border-color: #82c4f8; */
                        padding: 10px;">
                            <h4>Información!</h4>
                            El padre del estudiante no se encuentra registrado en el sisitema.  <br>
                            si de seas registrarlo ingrese los datos a este formulario y de click en el boton nuevo.
                          </div> 
                           </div>
                      <div class="row">
                        <div class="col-md-1"> 
                         
                          <button type="button"    class="btn btn-info" data-toggle="modal" data-target="#padres" onclick=" document.getElementById('fry').value=<?php echo $id_alumnos ?> ;  cambio1()"> Nuevo</button>
                        </div>
                      </div> 
                    </form>
              </div>












              <div class="tab-pane" id="timeline2"> 
                  <form method="post" id="registrar2" >  
                <div class="row" >
                          <div   style="margin-bottom: 16px;
                    margin-left: 16px;
                    margin-right: 12px;
                    border: solid 1.3px #82c4f8;
                    color: #0a6ebd;
                    background-color: #e3f2fd;
                    /* border-color: #82c4f8; */
                    padding: 10px;">
                            <h4>Información!</h4>
                            La madre del estudiante no se encuentra registrado en el sisitema. <br>
                            si de seas registrarla ingrese los datos a este formulario y de click en el boton nuevo.
                          </div> 
                           </div>
                            <div class="row">
                        <div class="col-md-1"> 
                          <button type="button" onclick=" document.getElementById('fry').value=<?php echo $id_alumnos ?> ; cambio2()" style='width: 100%' class="btn btn-info" data-toggle="modal" data-target="#padres"> Nuevo</button>
                        </div>
                      </div>
                    </form>
              </div>














              <div class="tab-pane" id="timeline3">   
                <form method="post" id="registrar3"><div class="row" >
                          <div   style="margin-bottom: 16px;
    margin-left: 16px;
    margin-right: 12px;
    border: solid 1.3px #82c4f8;
    color: #0a6ebd;
    background-color: #e3f2fd;
    /* border-color: #82c4f8; */
    padding: 10px;">
                            <h4>Información!</h4>
                            El acudiente del estudiante no se encuentra registrado en el sisitema. <br>
                            si de seas registrarlo ingrese los datos a este formulario y de click en el boton nuevo. 
                          </div> 
                         </div> 
                      <div class="row">
                        <div class="col-md-1"> 
                          <button type="button" onclick="document.getElementById('fry').value=<?php echo $id_alumnos ?> ; cambio3()"  class="btn btn-info" data-toggle="modal" data-target="#padres"> Nuevo</button>
                        </div>
                      </div>  
                    </form>
              </div>




              <div class="tab-pane" id="timeline4">   
                <div class="row">
                  <div class="col-md-10">
                  <?php 
                    $consultar_nivel="SELECT grado.nombre as grado,curso.numero ,sede.NOMBRE,jornada.NOMBRE as jornada,informeacademico.ano from jornada,jornada_sede,sede,grado,curso ,informeacademico WHERE informeacademico.id_grado=grado.id_grado and curso.id_curso=informeacademico.id_curso and informeacademico.id_jornada_sede=jornada_sede.ID_JS and jornada.ID_JORNADA=jornada_sede.ID_JORNADA and jornada_sede.ID_SEDE=sede.ID_SEDE";
                    $consultar_nivel1=$conexion->prepare($consultar_nivel);
                    $consultar_nivel1->execute(array()); ?> 

                  </div>
                </div>
              </div>
                </div>
              </div>
            
            
  <?php
}
function eliminar_acudiente(){
  include '../../conexion.php';
  $consultar_nivel="DELETE FROM `alumno_acudiente` WHERE `alumno_acudiente`.`id` = ".$_POST['io'];
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}
function registrar_acudiente1(){
  $selecion=$_POST['selecion'];
  include '../../conexion.php';
  if ($selecion==1) {
    $id_acudiente=$_POST['id_datos'];
    $fry=$_POST['fry'];
    if(isset($_POST['Parentesco2'])){ $Parentesco2=$_POST['Parentesco2']; }else{$Parentesco2='';}

    $consultar_nivel="INSERT INTO `alumno_acudiente` (  `id_acudiente`, `id_alumnos`, `parentesco`) VALUES (  '$id_acudiente', '$fry', '$Parentesco2')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }else{
    if(isset($_POST['nombre1a'])){ $nombre1a=$_POST['nombre1a']; }else{$nombre1a='';} 
    if(isset($_POST['email1a'])){ $email1a=$_POST['email1a']; }else{$email1a='';} 
    if(isset($_POST['apellido1a'])){ $apellido1a=$_POST['apellido1a']; }else{$apellido1a='';}
    if(isset($_POST['tipo_documento1a'])){ $tipo_documento1a=$_POST['tipo_documento1a']; }else{$tipo_documento1a='';}
    if(isset($_POST['num_documento1a'])){ $num_documento1a=$_POST['num_documento1a']; }else{$num_documento1a='';}
    if(isset($_POST['expedida1a'])){ $expedida1a=$_POST['expedida1a']; }else{$expedida1a='';}
    if(isset($_POST['direccion1a'])){ $direccion1a=$_POST['direccion1a']; }else{$direccion1a='';}
    if(isset($_POST['barrio1a'])){ $barrio1a=$_POST['barrio1a']; }else{$barrio1a='';}
    if(isset($_POST['celular1a'])){ $celular1a=$_POST['celular1a']; }else{$celular1a='';}
    if(isset($_POST['ocupacion1a'])){ $ocupacion1a=$_POST['ocupacion1a']; }else{$ocupacion1a='';}
    if(isset($_POST['direccion_trabajo1a'])){ $direccion_trabajo1a=$_POST['direccion_trabajo1a']; }else{$direccion_trabajo1a='';}
    if(isset($_POST['telefono_trabajo1a'])){ $telefono_trabajo1a=$_POST['telefono_trabajo1a']; }else{$telefono_trabajo1a='';}
    if(isset($_POST['Parentesco'])){ $Parentesco=$_POST['Parentesco']; }else{$Parentesco='';}
    if(isset($_POST['fry'])){ $fry=$_POST['fry']; }else{$fry='';}

   echo "<br>". $consultar_nivel="INSERT INTO `acudiente` (`nombre`, `apellido`, `tipo_documento`, `num_documento`, `expedida`, `direccion`, `barrio`, `celular`, `ocupacion`, `direccion_trabajo`, `email`, `telefono_trabajo`) VALUES ( '$nombre1a', '$apellido1a', '$tipo_documento1a', '$num_documento1a', '$expedida1a', '$direccion1a', '$barrio1a', '$celular1a', '$ocupacion1a', '$direccion_trabajo1a', '$email1a', '$telefono_trabajo1a')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    echo "<br>".$recupera1 =$conexion->lastInsertId() ;

    echo "<br>". $consultar_nivel="INSERT INTO `alumno_acudiente` (  `id_acudiente`, `id_alumnos`, `parentesco`) VALUES (  '$recupera1', '$fry', '$Parentesco')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
   $consultar_nivel1->execute(array());

  }
}
?>