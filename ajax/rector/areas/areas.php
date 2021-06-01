

<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
function registrar_intensidad_horaria(){
  include '../../conexion.php';
  $id=$_POST['id'];
  $hora=$_POST['hora']; 
  $grado=$_POST['grado']; 
  $area=$_POST['area']; 
  if ($id=='') {
    $consultar_nivel="INSERT INTO `intensidad_horaria` ( `area`, `grado`, `hora`) VALUES ( '$area', '$grado', '$hora')"; 
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }else{
    $consultar_nivel="UPDATE `intensidad_horaria` SET `hora` = '$hora' WHERE `intensidad_horaria`.`id` = $id;"; 
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
  }
}
function tabla32()
{ 
  include '../../conexion.php';
  $area=$_POST['area'];
   $consultar_nivel="SELECT q.nombre,q.id_grado,q.area,intensidad_horaria.hora,intensidad_horaria.id FROM (select grado.nombre,grado.id_grado,area.nombre as area from are_grado_sede,grado_sede,grado,area WHERE area.nombre='$area' and grado_sede.id_grado=grado.id_grado and are_grado_sede.id_grado_sede=grado_sede.id and area.id_area=are_grado_sede.id_area GROUP by grado.numero,area.nombre)as q LEFT JOIN intensidad_horaria on q.area=intensidad_horaria.area and q.id_grado=intensidad_horaria.grado"; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $nroProductos=$consultar_nivel1->rowCount(); 
  if ($nroProductos>0) { ?>
    <table class="table table-hover">
      <tr>
        <th>Grado</th>
        <th>hora</th>
      </tr>
      <?php $y=0; foreach ($consultar_nivel1 as $key  ) {  $y++ ;?>
        <tr>
          <td><?php echo $key['nombre'] ?></td> 
          <td>
            <input type="hidden"  id="grado<?php echo $y ?>" name="" value="<?php echo $key['id_grado'] ?>">
            <input type="hidden" id="id<?php echo $y ?>" name="" value="<?php echo $key['id'] ?>">
            <input type="number"  tabindex="<?php echo $y ?>" id="hora<?php echo $y ?>" value="<?php echo $key['hora'] ?>" onchange=' var hora=document.getElementById("hora<?php echo $y ?>").value; var id=document.getElementById("id<?php echo $y ?>").value; var grado=document.getElementById("grado<?php echo $y ?>").value; funcion(hora,id,grado)'>
          </td> 
        </tr>
      <?php } ?>
    
    </table><?php
  }else{
    ?>
    <div class="alert alert-info" role="alert">
                                                    <strong>Información!</strong> No se encuentra registrados grados en esta area.
                                                </div>
    <?php
  }

}
/////////////////////////////////////// funciones de la pagina de la vista grado grado_por_materia.php
function tabla()
{     

include '../../conexion.php';


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


$consultar_nivel="SELECT area.* FROM area WHERE area.area=1 and   area.nombre like('%$d%') ORDER by area.id_area DESC   ";

 
 





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


$consultar_nivel="SELECT area.* FROM area WHERE area.area=1  and   area.nombre like('%$d%') ORDER by area.id_area DESC LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  





<form method="post" id="eliminacion_total"> 
 <div class="box-body no-padding" style="margin: 10px">
  
    <button style="margin: 5px" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Nueva area</button>
  <div class="mailbox-controls">
 
    <!-- Check all button -->
    <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button>   
    <div class="btn-group"> 
    
      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button> 
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

    <div class="table-responsive mailbox-messages"    >

  <table class="table table-striped   table-hover">
<thead class="thead-dark">

                    <tr>
                      <th width="40" >#</th> 
                      <th width="120">area</th>
                      <th width="120">descripcion</th>
                      <th  width="30" >codigo</th> 

                      <th  width="80">asignaturas</th>
 
                      <th  width="60" >mostrar</th>  
                      <th  width="60" ><center>eliminar</center></th> 
                    </tr>
                  </thead>
                  <tbody id='table-body'>
      <?php

       $yss=0;
        foreach ($registro as $row) {  $yss= $yss+1; $to=$row['id_area'];?>  
          	<tr id="fila<?php echo $row['id_area']; ?>">
            <td > 
            	<input type="checkbox" class="sss" name="<?php echo("tt[]");?>" value="<?php echo $row['id_area']; ?>">
                 <input type="hidden" value="<?php echo $row['codigo'] ?>" name="<?php echo("cc[]");?>">
            </td>

			
			<td> <input type="text" style="
					  background-color: transparent;
					  border: none; 
					  outline: none;   "   
					  value="<?php echo $row['nombre']; ?>" 
					  id="o<?php echo $row['id_area']; ?>"  
					  readOnly=true 
					  ondblclick='document.getElementById("o<?php echo $row['id_area']; ?>").readOnly=false;' 
					  onchange=' var u=document.getElementById("o<?php echo $row['id_area']; ?>").value; document.getElementById("o<?php echo $row['id_area']; ?>").readOnly=true;
					  var ides=<?php echo $row['id_area']; ?>;
					  var n="nombre";
					  cambiar(u,ides,n);
					  ' ></td>


					  <td> <input type="text" style="
					  background-color: transparent;
					  border: none; 
					  outline: none;   "   
					  value="<?php echo $row['descripcion']; ?>" 
					  id="oo<?php echo $row['id_area']; ?>"  
					  readOnly=true 
					  ondblclick='document.getElementById("oo<?php echo $row['id_area']; ?>").readOnly=false;' 
					  onchange=' var u=document.getElementById("oo<?php echo $row['id_area']; ?>").value; document.getElementById("oo<?php echo $row['id_area']; ?>").readOnly=true;
					  var ides=<?php echo $row['id_area']; ?>;
					  var n="descripcion";
					  cambiar(u,ides,n);
					  ' ></td> 
 

 <td> <input type="txt" minlength="2" maxlength="3" style="width: 37px;
					  background-color: transparent;
					  border: none; 
					  outline: none;   "   
					  value="<?php echo $r=$row['codigo']; ?>" 
					  id="ooo<?php echo $row['id_area']; ?>"  
					  readOnly=true 
					  name="<?php echo 'codigos['.$to.']' ?>"
					  ondblclick='document.getElementById("ooo<?php echo $row['id_area']; ?>").readOnly=false;' 
					  onchange=' var codigo=document.getElementById("ooo<?php echo $row['id_area']; ?>").value; document.getElementById("ooo<?php echo $row['id_area']; ?>").readOnly=true;
					  var tu=<?php echo $row['id_area']; ?>;
					   
					 actuali(tu,codigo);
					  ' ></td> 







			<?php

 

 echo ' <td>';  
         $consultar_nivel="SELECT * FROM area WHERE area.area=0 and area.codigo='$r'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $registros=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
$y=0;
        foreach ($registros as $registro2) {
          echo $registro2['nombre'];
          $y=$y+1;
          if ($y!=$registrow) {
            echo ", ";
          }
        }
 
      echo ' </td>'  ?>

				
                <td><center><a  onclick='  var u= document.getElementById("ooo<?php echo $row['id_area'] ?>").value;
                if(u!=01){
  location.href = "observar.php?id=<?php echo $row['id_area']; ?>&   i="+u+" &ie=<?php echo $row['nombre']; ?>" ;}'  >
                	<img src="../../../logos/observar.JPG" style="width: 40px">
                </a></center></td>
                           
              
              <td><center><a href="#" data-toggle="modal" data-target="#mymodal<?php echo $row['id_area']; ?>"><img style="width: 35px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a></center></td>
                         </tr>
 


                      	<div class="modal fade" id="mymodal<?php echo $row['id_area']; ?>" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p> estás seguro de eliminar el area   ?</p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                               
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

                      onclick="var eliminar=<?php echo $row['id_area']; ?>;
                     
 
                      var codigo= document.getElementById('ooo<?php echo $row['id_area'] ?>').value;

                        elimna(codigo,eliminar)">Aceptar</button> 

                              </div>
                            </div>
                          </div>
                        </div>

<?php  
    }
    echo "</tbody></table>

";?>

   <div class="modal fade" id="may" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> estás seguro de eliminar las areas  ?</p>

              </div>
              <div class="modal-footer">   
                  <input type="hidden" id="elimina" name="docentees" value='<?php echo $id_sede?>'>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit"  value='<?php echo $id_sede?>' class="btn btn-primary"   name="eliminar_sedes" 
                    id="infinity" onclick='
    $("#may").modal({backdrop: false});
    $("#may").modal("hide");'>Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>

    </form>
 
 
<script type="text/javascript">
   
$(document).on(  "submit","#eliminacion_total", function(e){
          e.preventDefault();

          $.ajax({

            type: "post",
            url:"../../../ajax/rector/areas/areas.php?action=eliminacion_totals", 
            data: $(this).serialize(),
            dataType:"text", 
            success: function(data)
            { 
 
              $('#_MSG_').html(data); 
 
  
            }
          });

        });

 function mostrar(){
     $.ajax({   
      type: "post",
      url:"../../../ajax/rector/areas/areas.php?action=tabla",
      dataType:"text", 

      success:function(data){  
        $('#tabla').html(data); 


      }  


    }); }



 




	function elimna(codigo,eliminar){
	 $.ajax({   
        type: "post",
        data:{codigo,eliminar},  
        url:"../../../ajax/rector/areas/areas.php?action=elim",
        dataType:"text", 

        success:function(data){
      $('#_MSG_').html(data);  
 
        }  
      }); 



	}




function	cambiar(u,ides,n){
 $.ajax({   
        type: "post",
        data:{u,ides,n},  
        url:"../../../ajax/rector/areas/areas.php?action=cambiar",
        dataType:"text", 

        success:function(data){
      $('#_MSG_').html(data);  
 
        }  
      }); 


      }

function actuali(tu,codigo){
 $.ajax({   
        type: "post",
        data:{tu,codigo},  
        url:"../../../ajax/rector/areas/areas.php?action=actualizacion2",
        dataType:"text", 

        success:function(data){
      $('#_MSG_').html(data);  
 		 
        }  
      }); 


      }
 

  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
 

 <?php  echo " </div></div>";

    ?>
 
    <?php

    echo '<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> <ul class="pagination" id="pagination">
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button>'.$lista.'</ul>





    
    ' ; 


}
 function cambiar(){
 	if(isset($_POST['u'])){
    $u=$_POST['u'];
  }else{
    $u='';
  }
  if(isset($_POST['ides'])){
    $ides=$_POST['ides'];
  }
  if(isset($_POST['n'])){
    $n=$_POST['n'];
  }
  include "../../conexion.php";
    $consultar_nivel="SELECT * FROM area where area.id_area='$ides' ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    foreach ($consultar_nivel1 as $key ) {
      $nombre=$key['nombre'];
      $descripcion=$key['descripcion'];
    }
  if(preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN]+$/", $u)){
 	  $consultar_nivel="UPDATE `area` SET  `$n` = '$u'  WHERE `area`.`id_area` = $ides;";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); ?>
    <script type="text/javascript">
    	mensaje(3,'Haz actualizado  <?php if ($n=='nombre') {echo 'el '.$n;}else{echo 'la '.$n;} ?> del area ')
		</script><?php
	}else{  
    if($n=='nombre'){
      ?>
    <script type="text/javascript"> 
      document.getElementById("o<?php echo $ides ?>").value = '<?php echo $nombre ?>';
 
      mensaje(2,'  <?php if ($n=='nombre') {echo 'El '.$n.' del area no soporta numeros';}else{echo 'La '.$n;} ?> del area no soporta numeros ')
    </script><?php
    }else{?>
    <script type="text/javascript"> 
      document.getElementById("oo<?php echo $ides ?>").value = '<?php echo $descripcion ?>';
 
      mensaje(2,'  <?php if ($n=='nombre') {echo 'El '.$n.' del area no soporta numeros';}else{echo 'La '.$n;} ?> del area no soporta numeros ')
    </script><?php
    }

    
  }
 }
    function actualizacion2()
    {
if(isset($_POST['tu'])){
     $id=$_POST['tu'];
  }else{
    $id='';
  }
  if(isset($_POST['codigo'])){
     $CODIGO=$_POST['codigo'];
  }else{
    $CODIGO='';
  }

    include "../../conexion.php";


    $consultar_nivel="SELECT area.codigo FROM area where area.id_area=$id ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    foreach ($consultar_nivel1 as $key ) {
	   	$yooo=$key['codigo'];
    }

    
 if( is_numeric($CODIGO)){
 

  


     $consultar_nivel=" SELECT * FROM area WHERE area.area=0 and area.codigo in(SELECT area.codigo FROM area where area.id_area=$id and area.codigo not in('01'))";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $consultar_nivel12s=$consultar_nivel1->rowCount();
    if ($consultar_nivel12s>0){
        if ($CODIGO==01) {?>
            <script> 
               mensaje(1,"actualmente el area tiene asignaturas por tal motivo no podra combiar su codigo a 01"); 
               document.getElementById("ooo<?php echo $id ?>").value = '<?php echo($yooo) ?>';
 			</script><?php
 		}else{

			$consultar_nivel=" SELECT * FROM area WHERE  area.area=1 and  area.codigo=$CODIGO and area.codigo not in('01') and area.id_area not in('$id') ";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array()); 
			$consultar_nivel12s=$consultar_nivel1->rowCount();
			if ($consultar_nivel12s>0){  ?>
            <script> 
               mensaje(1,"actualmente el codigo ya esta asignado a un area"); 
               document.getElementById("ooo<?php echo $id ?>").value = '<?php echo($yooo) ?>';
 			</script><?php
            }else{  


	            $consultar_nivel=" SELECT * FROM area WHERE   area.codigo in(SELECT area.codigo FROM area where area.id_area=$id and area.codigo not in('01'))";
	            $consultar_nivel1=$conexion->prepare($consultar_nivel);
	            $consultar_nivel1->execute(array());
	            $consultar_nivel12=$consultar_nivel1->fetchAll();  
	            foreach ($consultar_nivel12 as $key){
	            	$ry1=$key['codigo'];
	            	$ry2=$key['nombre'];
	            	$ry3=$key['descripcion']; 
	            	$ry4=$key['id_area'];            
	            	$consultar_nivel="UPDATE `area` SET `codigo` = '$CODIGO' WHERE `area`.`id_area` = $ry4;";
	            	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	            	$consultar_nivel1->execute(array()); 
	            }	
                $consultar_nivel="UPDATE `area` SET `codigo` = '$CODIGO' WHERE `area`.`id_area` = $id;";
            	$consultar_nivel1=$conexion->prepare($consultar_nivel);
            	$consultar_nivel1->execute(array()); 
            	?><script>mensaje(3,"el codigo del  area ha sido modificada");</script><?php 
            }
        }
    }else{

        $consultar_nivel=" SELECT * FROM area WHERE   area.codigo=$CODIGO and area.codigo not in('01') and area.id_area not in('$id') ";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
        $consultar_nivel12s=$consultar_nivel1->rowCount();
        if ($consultar_nivel12s>0){?>
        	<script>mensaje(1,"el codigos actualmente esta registrado en otra area"); 
			   document.getElementById("ooo<?php echo $id ?>").value = '<?php echo($yooo) ?>';
			</script><?php 
        }else{ 

          $consultar_nivel="UPDATE `area` SET `codigo` = '$CODIGO' WHERE `area`.`id_area` = $id;";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
            	?><script>mensaje(3,"el codigo del  area ha sido modificada");</script><?php 
        }
    }
}else{

            	?><script>
               document.getElementById("ooo<?php echo $id ?>").value = '<?php echo($yooo) ?>';
            		mensaje(2,"el codigo solo permite ingresar numeros");</script><?php 
}
}
function elim(){
if(isset($_POST['codigo'])){
   echo  $codigo=$_POST['codigo'];
  }else{
    $codigo='';
  }
  if(isset($_POST['eliminar'])){
     $eliminar=$_POST['eliminar'];
  }else{
   echo $eliminar='';
  }

	include "../../conexion.php";
	 $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area='$eliminar' and  area.id_area=are_grado_sede.id_area   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	$consultar_nivel12s=$consultar_nivel1->rowCount();
	if ($consultar_nivel12s>0) {    ?>
	<script>mensaje(1," actualmente el area  esta  relacionado con alguna sede");</script>
	<?php
	}else{ 
           
		if ($codigo==01) {
			$consultar_nivel=" DELETE  FROM area WHERE area.id_area='$eliminar' ";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array()); 


			if($consultar_nivel1){

				?><script>

					$("#fila<?php echo $eliminar ?>").remove();
					mensaje(3,"el area   ha sido  eliminado del sistema");

				</script><?php
			}
		}else{
			$consultar_nivel=" DELETE  FROM area WHERE area.codigo='$codigo' ";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array()); 

			if($consultar_nivel1){
				?><script>$("#fila<?php echo $eliminar ?>").remove();
					mensaje(3,"el area   ha sido  eliminado del sistema");
 
					
				</script><?php
			}
		} 
	}
}
  
function eliminacion_totals(){
    include "../../conexion.php";
	$codigos=$_POST['codigos'];$tt=$_POST['tt'];
		if ($tt=='') {
		?>
		<script>mensaje(2," campos vacios");</script>
		<?php
	}else{ 
$r=0;


$var=0;
		foreach ($tt as $eliminar) {

			         
			    
 $codigo= $codigos[$eliminar].'<br>';
          $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area=$eliminar and  area.id_area=are_grado_sede.id_area   ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
          $consultar_nivel12s=$consultar_nivel1->rowCount();
          if ($consultar_nivel12s>0) {    ?>
            <script>mensaje(1," actualmente el area  esta  relacionado con alguna sede");</script>
            <?php
          }else{ 

                    
            if ($codigo==01) {
              $consultar_nivel=" DELETE  FROM area WHERE area.id_area=$eliminar ";
              $consultar_nivel1=$conexion->prepare($consultar_nivel);
              $consultar_nivel1->execute(array()); 


              if($consultar_nivel1){
$var=1
                ?><script> 
					$("#fila<?php echo $eliminar ?>").remove(); 
				</script><?php
              }
            } else{
              $dele="DELETE  FROM area WHERE area.codigo='".$codigos[$eliminar]."' ";
              $dele=$conexion->prepare($dele);
              $dele->execute(array()); 
              $var=1
				?><script> 
					$("#fila<?php echo $eliminar ?>").remove(); 

				</script><?php
               
            } 
          }	

		}
		if ($var==1) { ?>

            <script>mensaje(3," actualmente el area  esta  relacionado con alguna sede");</script> <?php
		}
	}
} 
function nuevo_area()
{	

   	include "../../conexion.php";
	$NOMBRE=$_POST['NOMBRE']; $descripchion=$_POST['descripcion'];  $CODIGO=$_POST['CODIGO'];
	if ($CODIGO!=01) {
		$consultar_nivel="SELECT * FROM area WHERE area.codigo=$CODIGO";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array()); 
		$consultar_nivel12s=$consultar_nivel1->rowCount();
		if ($consultar_nivel12s>0) {
            ?><script>mensaje2(1,"Actualmente el codigo ya esta registrado ");</script><?php 
		 
		
		}else{
			$consultar_nivel="INSERT INTO `area` (`id_area`, `nombre`, `descripcion`, `codigo`, `area`) VALUES (NULL,'$NOMBRE','$descripchion','$CODIGO','1')";
	        $consultar_nivel1=$conexion->prepare($consultar_nivel);
	        $consultar_nivel1->execute(array()); 

            ?><script>mensaje2(3,"El area ha sido registrada");</script><?php 
		}
	}else{

		$consultar_nivel="INSERT INTO `area` (`id_area`, `nombre`, `descripcion`, `codigo`, `area`) VALUES (NULL,'$NOMBRE','$descripchion','$CODIGO','1')";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array()); 
		?><script>mensaje2(3,"El area ha sido registrada");</script><?php 
	} 
}


///fin de las funciones de ver_area.php






//comienza las funciones de observar.php en las areas

function mostrar_asignatura()
{ 
  if(isset($_POST['codigo'])){
   $codigo=$_POST['codigo'];
 }else{
   echo $codigo='';
 }
 include "../../conexion.php";
 $consultar_nivel="SELECT * from area WHERE area.codigo ='$codigo' and area.area=0";
 $consultar_nivel1=$conexion->prepare($consultar_nivel);
 $consultar_nivel1->execute(array());
 $drd=$consultar_nivel1->fetchAll();
 ?>


 <input type="hidden" value="<?php echo $codigo; ?>" id='mo' name="">
 <form  id="eee"  method='post'>
  <div>
  </div><!-- /.row -->


  <div>
    <div>
    </div>
    <div   style=" background-color: #fff;padding: 10px">
      <div class="table-responsive mailbox-messages"    >

        <button type="button" class="  btn-info " style=" " data-toggle="modal" data-target="#myM" >NUEVO</button> 
        <table class="table table-striped table-hover ">
          <thead class="">

            <tr>
              <th >#</th> 
              <th >Asignatura</th> 
              <th   >codigo</th>  
              <th >eliminar</th>
            </tr>
          </thead>
          <tbody id='table-body'><?php  $y=1; 
          foreach($drd as $row) {?>
            <tr id="fila<?php echo $row['id_area']; ?>">
              <td><input type="checkbox" class="sss" name="<?php echo("idm[]");?>" value="<?php echo $row['id_area']; ?>"></td>


              <td> <input type="text" style="
              background-color: transparent;
              border: none; 
              outline: none;   "   
              value="<?php echo $row['nombre']; ?>" 
              id="jj<?php echo $row['id_area']; ?>"  
              readOnly=true 
              ondblclick='document.getElementById("jj<?php echo $row['id_area']; ?>").readOnly=false;' 
              onchange=' var u=document.getElementById("jj<?php echo $row['id_area']; ?>").value; document.getElementById("jj<?php echo $row['id_area']; ?>").readOnly=true;
              var ides=<?php echo $row['id_area']; ?>;

              cambi(u,ides);
              ' ></td> 
              <td>
                <input type="text" style="
                background-color: transparent;
                border: none; 
                outline: none;   "   
                value="<?php echo $row['codigo']; ?>" 
                id="ooo<?php echo $row['id_area']; ?>"  
                readOnly=true>
              </td>
              <td><a href="#" data-toggle="modal" data-target="#mymodal<?php echo $row['id_area']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
              <div class="modal fade" id="mymodal<?php echo $row['id_area']; ?>" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Confirmación   </h4>
                    </div>
                    <div class="modal-body">
                      <p> estás seguro de eliminar el area   ?</p> 
                    </div>
                    <div class="modal-footer">  
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

                      onclick="var eliminar=<?php echo $row['id_area']; ?>;


                      var codigo= document.getElementById('ooo<?php echo $row['id_area'] ?>').value;

                      elimnasss(codigo,eliminar)">Aceptar</button>  
                    </div>
                  </div>
                </div>
              </div>
            </tr>
            <?php
          }?>
        </tbody>
      </table>
      <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
      </button> 
      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#mymodalaaq"><i class="fa fa-trash-o"></i></button>  
      <div>
      </div>
    </div>
    <div class="modal fade" id="mymodalaaq" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Confirmación</h4>
          </div>
          <div class="modal-body">
            <p>Está seguro de   eliminar el area?</p>

          </div>
          <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit"  name="ax" value='<?php echo $row["id"]?>' class="btn btn-primary" id="btn"  onclick='
    $("#mymodalaaq").modal({backdrop: false});
    $("#mymodalaaq").modal("hide");'>Aceptar</button> 

          </div>
        </div>
      </div>
    </div>  
  </form>
  <script type="text/javascript">

   $(document).on(  "submit","#eee", function(e){
    e.preventDefault();

    $.ajax({

      type: "post",
      url:"../../../ajax/rector/areas/areas.php?action=elim3", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 

        $('#_MSG_').html(data); 


      }
    });

  });

   function mostrar(){
    codigo=  $('#mo').val();
    $.ajax({   
      type: "post",

      data:{codigo}, 
      url:"../../../ajax/rector/areas/areas.php?action=mostrar_asignatura",
      dataType:"text", 

      success:function(data){  
        $('#tabla').html(data); 


      }  


    }); }
    function num(codi,ido){
       
     $.ajax({   
      type: "post",

      data:{codi,ido}, 
      url:"../../../ajax/rector/areas/areas.php?action=numss",
      dataType:"text", 

      success:function(data){ 
      document.getElementById('area1').value='';
      document.getElementById('area1').focus(); 
        $('#_MSG2_').html(data); 
        mostrar();

      }  


    }); 
   }
   function elimnasss(codigo,eliminar){
     $.ajax({   
      type: "post",
      data:{codigo,eliminar},  
      url:"../../../ajax/rector/areas/areas.php?action=elim2",
      dataType:"text", 

      success:function(data){
        $('#_MSG_').html(data);   
      }  
    }); 



   }
   function  cambi(u,ides){

    $.ajax({   
      type: "post",
      data:{u,ides},  
      url:"../../../ajax/rector/areas/areas.php?action=cambi",
      dataType:"text", 

      success:function(data){
        $('#_MSG_').html(data);  
        mostrar();
      }  
    }); 
    

  }
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  }); 
</script>

<?php

}
function cambi(){ 
  if(isset($_POST['u'])){
    $u=$_POST['u'];
  }else{
    $u='';
  }
  if(isset($_POST['ides'])){
    $ides=$_POST['ides'];
  }

  include "../../conexion.php";
  $consultar_nivel="SELECT area.codigo FROM area where area.id_area=$ides ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  foreach ($consultar_nivel1 as $key ) {
    $yooo=$key['codigo'];
  }
  $direccion='2323';
  if(preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN]+$/", $u)){

    echo $consultar_nivel="UPDATE `area` SET  `nombre` = '$u'  WHERE `area`.`id_area` = $ides;";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); ?>
    <script type="text/javascript">
      mensaje(3,'Haz actualizado el nombre del area ')
      </script><?php
  }else{?>
    <script type="text/javascript"> 
      mensaje(2,'El nombre de la asignatura no lleva numeros'); 
    </script><?php
  }
}

function numss(){
  if(isset($_POST['codi'])){
    $codi=$_POST['codi'];
  }else{
    $codi='';
  }
  if(isset($_POST['ido'])){
    $ido=$_POST['ido'];
  }
  if ($ido=='') {
    ?><script>mensaje2(2,"ingrese un area");</script><?php
  }

  if(preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN]+$/", $ido)){
    include "../../conexion.php";  
    $consultar_nivel="SELECT * FROM area WHERE area.nombre='$ido' and area.area=0";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $consultar_nivel12s=$consultar_nivel1->rowCount();

    if ($consultar_nivel12s>0) {
      ?><script>mensaje2(1,"actualmente el area ya tiene esa asignatura");</script><?php 
    }else{

      $consultar_nivel="INSERT INTO `area` (`id_area`, `nombre`, `descripcion`, `codigo`, `area`) VALUES (NULL,'$ido','','$codi','0')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());

        ?><script>mensaje2(3,"La asignatura ha sido registrada");</script><?php 
    }
  }else{
    ?><script>mensaje2(2,"la asignatura solo permite letras");</script><?php
  }
}


function elim2(){
if(isset($_POST['codigo'])){
   echo  $codigo=$_POST['codigo'];
  }else{
    $codigo='';
  }
  if(isset($_POST['eliminar'])){
     $eliminar=$_POST['eliminar'];
  }else{
   echo $eliminar='';
  }

  include "../../conexion.php";
   $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area='$eliminar' and  area.id_area=are_grado_sede.id_area   ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  $consultar_nivel12s=$consultar_nivel1->rowCount();
  if ($consultar_nivel12s>0) {    ?>
  <script>mensaje(1," actualmente el area  esta  relacionado con alguna sede");</script>
  <?php
  }else{ 
            
    $consultar_nivel=" DELETE  FROM area WHERE area.id_area='$eliminar' ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
 
      ?><script>

        $("#fila<?php echo $eliminar ?>").remove();
        mensaje(3,"el area   ha sido  eliminado del sistema");

      </script><?php
      
  }
}
function elim3(){
  if(isset($_POST['idm'])){
     $idm=$_POST['idm'];
  }else{
   echo $idm='';
  }
$rr=0;
if ($idm=='') {?>
    <script>mensaje(2,"Señale alguna asignatura");</script>
    <?php
}else{ 
  include "../../conexion.php";
  foreach ($idm as $eliminar) {
    $consultar_nivel="SELECT * FROM are_grado_sede, area WHERE are_grado_sede.id_area='$eliminar' and  area.id_area=are_grado_sede.id_area   ";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $consultar_nivel12s=$consultar_nivel1->rowCount();
    if ($consultar_nivel12s>0) {    ?>
    <script>mensaje(1," actualmente el area  esta  relacionado con alguna sede");</script>
    <?php
    }else{ 
              $rr=1;
      $consultar_nivel=" DELETE  FROM area WHERE area.id_area='$eliminar' ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
   
        ?><script>

          $("#fila<?php echo $eliminar ?>").remove(); 
        </script><?php
        
    }
       
  }
}
if ($rr==1) {
      ?>
      <script>
 
          mensaje(3,"el area   ha sido  eliminado del sistema");

        </script>
        <?php
    }  
}






//fin de  las funciones de observar.php en las areas
?>
		
		    