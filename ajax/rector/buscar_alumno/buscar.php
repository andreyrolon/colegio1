<?php 
if ($_GET)
{
$action = $_GET["action"];
if (function_exists($action))
{
call_user_func($action);
}
}

function buscar(){

 
    include "../../conexion.php";
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
 	$sede=$_POST['sede1'];
 	$variable=$_POST['curso1']; 
 	$porcion=explode(' ', $variable);
 	$grado=$porcion[1];
 	$curso=$porcion[0];
 	$ano=date('Y');
    $consultar_nivel="SELECT q.nombre,q.apellido  from (SELECT   alumnos.nombre,alumnos.apellido  from informeacademico,alumnos WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso='$curso' and informeacademico.id_grado='$grado' and informeacademico.id_jornada_sede='$sede'  and informeacademico.ano='$ano')AS q WHERE q.nombre LIKE ('%$d%') or q.apellido LIKE ('%$d%')  ";
	$s=$consultar_nivel;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	$nroProductos=$consultar_nivel1->rowCount();
	if ($nroProductos==0) {
		echo 1;
	}else{ 

		if(isset($_POST['mySelect'])){
		   $nroLotes = $_POST['mySelect'];
		}else{
		  $nroLotes = 5;
		}
		echo  '<br>';
		$nroPaginas = ceil($nroProductos/$nroLotes);
		$lista = '';
		$tabla = ''; 

		if($paginaActual > 1){
		  $fttg1=    $lista = $lista.'<nav aria-label="...">
		  <ul class="pagination" style="cursor: pointer;">  

		<li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
		      <a class="page-link">Anterior</a>
		    </li>
		';
		}else{
		    $lista = $lista.'<nav aria-label="...">
		  <ul class="pagination">  

		<li class="page-item disabled "   >
		      <a class="page-link">Anterior</a>
		    </li>
		';
		}

		for($i=1; $i<=$nroPaginas; $i++){
		  if($i == $paginaActual){
		     $lista = $lista.'

		    <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
		      <span class="page-link">
		        '.$i.'
		        <span class="sr-only">(current)</span>
		      </span>
		    </li> ';
		 }else{
		  $lista = $lista.'
		    <li class="page-item  "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
		      <a class="page-link">
		        '.$i.'
		        <span class="sr-only">(current)</span>
		      </a>
		    </li> ';
		}
		}
		if($paginaActual < $nroPaginas){
		  $lista = $lista.'  

		<li class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
		      <a class="page-link">siguiente</a>
		    </li>';
		  $o=0;
		}else{
		   $lista = $lista.'  

		<li class="page-item  disabled "   ">
		      <a class="page-link">Siguiente</a>
		    </li>';
		  $o=1;
		}

		if($paginaActual <= 1){
		  $limit = 0;
		}else{
		  $limit = $nroLotes*($paginaActual-1);
		}
	    $consultar_nivel="SELECT q.nombre,q.apellido,q.genero,q.foto,q.id_informe_academico,q.fecha_desercion,q.fecha_retiro from (SELECT informeacademico.fecha_desercion,informeacademico.fecha_retiro, alumnos.nombre,alumnos.apellido,alumnos.genero, alumnos.foto,informeacademico.id_informe_academico from informeacademico,alumnos WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso='$curso' and informeacademico.id_grado='$grado' and informeacademico.id_jornada_sede='$sede'  and informeacademico.ano='$ano')AS q WHERE q.nombre LIKE ('%$d%') or q.apellido LIKE ('%$d%') order by q.apellido    LIMIT $limit, $nroLotes  ";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll();

		$registrow=$consultar_nivel1->rowCount(); ?>  
		<form method="post" id="cambio">
			
		  			<input type="submit" value="" id="for" name="" style="width: 0px;height:0px;background: transparent;border:none; ">
		   	<div class="box-body no-padding">

		       <div class="mailbox-controls">

			        <!-- Check all button -->
			      
			        <div class="btn-group" style="margin-left: 5px"> 

			 
			          <?php if($paginaActual > 1){
			            echo  ' <button type="button"  style="background-color: #fff;border:solid 1px #C0BFBF;width:32px" class="lop"  style="" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

			            <?php
			            if($paginaActual < $nroPaginas){ echo  ' <button  style="background-color: #fff;border:solid 1px #C0BFBF;width:32px" type="button" style=";" class="lop " id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
			        </div>
			        <!-- /.btn-group --> 
			        <div class="pull-right" style="margin-right: 5px">

			            <?php 

			            $aaa=$registrow+0;
			            $aa=$paginaActual+0;
			            $g=$aa *$aaa;
			            if ($o==0) {
			               echo $g .'-'.$paginaActual.'/'. $nroProductos ;
			           }else{
			            echo $nroProductos;

			            echo   '-'.$paginaActual.'/'. $nroProductos ;
			        	} ?>
				        <div class="btn-group"> 

				            <?php if($paginaActual > 1){
				              echo  ' <button type="button"  style="background-color: #fff;border:solid 1px #C0BFBF;width:32px" class="lop" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

				              <?php
				              if($paginaActual < $nroPaginas){ echo  ' <button  style="background-color: #fff;border:solid 1px #C0BFBF;width:32px" type="button" class="lop" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

				         </div>
			          <!-- /.btn-group -->
			      	</div>
		     	 <!-- /.pull-right -->
		  		</div>
					<style type="text/css">
						tr:hover{
							border: solid 2px #b7b7b7;
						}
					</style>
				
		  		<div   class="table-responsive mailbox-messages" style="padding: 10px">
		  			<button type="button" style="background-color: #fff;border:solid 1px #C0BFBF" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> 
		  			<input type="hidden"  id="js"   name="js" >
		  			<input type="hidden"  id="grado"   name="grado" >
					<table class="table   table-hover"  >
					    <tr>
					    	<th  >#</th>
					        <th  >Id </th>
					        <th style="padding-right: 40px;padding-left: 40px "> <center>Foto</center> </th>
					        <th  >Nombre</th>
					        <th  >Estado</th>
					        
					    </tr>  <?php
					    $con=1;
				        foreach ($registro as $var) { ?>
					        <tr>
					        	<td>
					        		<br>
					        		<input class="sss" type="checkbox" name="id[]" value="<?php echo $var['id_informe_academico'] ?>"  >
					        	</td>
					            <td><br>
					                <?php echo $con++ ?>
					            </td>
					            <td>
					                <img style="width: 100px;height: 115px" class="profile-user-img img-responsive img-circle" src="../../../img_alumno/3497bcf861305c9349ff9681f4af470b.jpg" alt="User profile picture">
					            </td>
					            <td><br>
					                <?php echo($var['nombre']); ?> <?php echo($var['apellido']); ?>
					            </td>
					           
					            <td><br>
					                <?php 

					                if ($var['fecha_desercion']!='0000-00-00') { 
					                	echo'<span class="btn btn-danger ">Desertor</span>';
					                }
					                if ($var['fecha_retiro']!='0000-00-00') { 
					                	echo'<span class="btn btn-warning ">Retirado</span>';
					                }
					                if (($var['fecha_retiro']=='0000-00-00') && ($var['fecha_retiro']=='0000-00-00')) {
					                	echo'<span class="btn btn-info ">Cursando</span>';
					                }

					                ?>
					            </td>
					             
					        </tr> <?php  
						} ?>
					</table> 
					<button type="button" style="background-color: #fff;border:solid 1px #C0BFBF" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> 
					<div  class="mailbox-controls">
					 

						<div class="btn-group" style="float: left;"> <nav aria-label="..."> <ul class="pagination" id="pagination"><?php echo  $lista ?> </ul></nav>


						</div>
						<div class="pull-right" style="margin-top: 44px; margin-right: 25px"><?php  echo $nroProductos ?> archivos en  total
						</div>
					</div>
					<button type="button" style="background-color: #fff;border:solid 1px #C0BFBF" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> 
				</div>
			</div>
		</form> 
		<script type="text/javascript">
 
   
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
</script> <?php
	}
 
 
 

} 

function cambio(){
	$js=$_POST['js'];
    $grado=$_POST['grado'];
	if(isset($_POST['id'])){ 
		$s=$_POST['id'];
		foreach ($s as  $value) {
			$consultar_nivel="UPDATE `materia_por_periodo` SET `nota` = '0' WHERE materia_por_periodo.id_informe_academico=0 and materia_por_periodo.periodo>1 ";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());
		}
	}else{
		$emaila2='';
	}
	
}
?>
