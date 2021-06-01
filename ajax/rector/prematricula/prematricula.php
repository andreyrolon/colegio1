<?php 
if ($_GET)
{
	$action = $_GET["action"];
	if (function_exists($action))
	{
		call_user_func($action);
	}
}
function actualizar(){
	include '../../conexion.php';	

	$id=$_POST['id'];
	$dolor=$_POST['dolor'];
	echo $consultar_nivel="UPDATE `informeacademico` SET `prematicula` = '$dolor' WHERE `informeacademico`.`id_informe_academico` = '$id' " ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
}
function todos(){
	include '../../conexion.php';
	$todos=$_POST['tin'];
	if ($todos=='') {?>
		<script type="text/javascript">
			mensaje(2,'No has seleccionado');
		</script><?php
	}else{ 
		foreach ($todos as $key ) {
			$pedasos=explode(' ', $key);
			$id=$pedasos[1];
			$dolor=$pedasos[0];
			$consultar_nivel=" UPDATE `informeacademico` SET `prematicula` = '$dolor' WHERE `informeacademico`.`id_informe_academico` = '$id'" ;
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());
			# code...
		}
		?>
		<script type="text/javascript">
			mensaje(3,'Has actualizado todo el curso exitosamente');
		</script><?php
	}

}
function buscar()
{     

	include '../../conexion.php';

	$id_jornada_sede=$_POST['id_jornada_sede'];
	$id_curso1=$_POST['id_curso']; 
	$porciones=explode(' ', $id_curso1);
	$id_curso=$porciones[0];
	$id_grado=$porciones[1];

	$ano=date('Y');
	$consultar_nivel="SELECT informeacademico.id_informe_academico, alumnos.genero,alumnos.nombre,alumnos.apellido,alumnos.foto,alumnos.id_alumnos,informeacademico.prematicula from  informeacademico,alumnos  WHERE alumnos.id_alumnos=informeacademico.id_alumno AND informeacademico.id_grado='$id_grado'   and informeacademico.id_curso='$id_curso'   AND  informeacademico.id_jornada_sede='$id_jornada_sede'    and informeacademico.ano='$ano' " ;
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());

	$contadoir=$consultar_nivel1->rowCount();

	$nom=array('checkboax','checkboaxOne','checkboaxTwo','checkboaxThree','checkboaxFour','checkboaxFive','checkboaxSix','checkboaxSeven','checkboaxEight','checkboaxNine','checkboaxTen','checkboaxTwelve','checkboaxThirteen','checkboaxFourteen','checkboaxFifteen','checkboaxSixteen','checkboaxSeventeen','checkboaxEighteen','1checkboaxNineteen','checkboaxTwenty','checkboaxTwenty-one','checkboaxTwenty-tow','checkboaxTwenty-three','checkboaxTwenty-four','1checkboaxTwenty-five','checkboaxTwenty-six','checkboaxTwenty-seven','checkboaxTwenty-eight','checkboaxTwenty-nine','checkboaxThirty','checkboaxThirty-one','checkboaxThirty-two','checkboaxThirty-three','checkboaxThirty-four','checkboaxThirty-five','checkboaxThirty-six','checkboaxThirty-seven','checkboaxThirty-eight','checkboaxThirty-nine','checkboaxForty','checkboaxForty-one','checkboaxForty-two','checkboaxForty-three','checkboaxForty-four','checkboaxForty-five','checkboaxForty-six','checkboaxForty-seven','checkboaxForty-eight','checkboaxForty-nine','checkboaxFifty', 'checkboaxFifty-one','checkboaxFifty-tow','checkboaxFifty-three','checkboaxFifty-four','checkboaxFifty-five','checkboaxFifty-six','checkboaxFifty-seven','checkboaxFifty-eight','checkboaxFifty-nine');
	$uno=0;

	?>
	<div class="" style="overflow: scroll;height: 870px;">
		<div style="background-color: #3c8dbc;padding: 10px">
			<strong style="margin: 10px;color: #fff;font-size: 17px"> Listado de prematriculas <?php echo $contadoir ?>  alunmnos</strong>
		</div><br> 

		<button  class="btn btn-info"  data-toggle="modal" data-target="#myModal"  style="float: right;  margin-top: 13px; margin-right: 10px
		">   masivo</button><br> <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle" style=" margin-left: 5px;  "><i class="fa fa-square-o"></i>
		</button> <strong style="margin-left: 10px; ">todos</strong>
		<br>
		<form  name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
			<table class="table  ">
				<tr>
					<th>#</th>
					<th>foto</th>
					<th>nombre</th> 
					<th>prematiculados</th> 
				</tr>
				<?php 
				foreach ($consultar_nivel1 as $key  ) { 
					$uno=$uno+1;
					$prematicula=$key['prematicula']; 
					if ($prematicula==1) {
						$value=0;
						$checked='checked';
						$style1='style="float: right;display: block;"';
						$style='style="float: right;display: none;"';
					}else{
						$value=1;
						$checked='';
						$style1='style="float: right;display: none;"';
						$style='style="float: right;display: block;"';
					}

					?>
					<tr>
						<td>
							<label class="mailbox-messages"> 
								<input type="checkbox" name="tin[]" id="indetificador1<?php echo $key['id_informe_academico'] ?>"  value="<?php echo $value.' '.$key['id_informe_academico'];  ?>" > 
							</label>
						</td> 
						<td>
							<img   class="profile-user-img" src="<?php if($key['foto']=='' && $key['genero']=='1'){echo '../../../logos/niña.jpg';}  
							if(($key['foto']=='' && $key['genero']=='')  or ($key['foto']=='' && $key['genero']=='0')){echo '../../../logos/niño.png';}else{  echo($key['foto']); } ?>" alt="User profile picture"> 
						</td>
						<td><?php echo $key['apellido'].' '.$key['nombre'] ?></td>
						<td>  <ul class="ksw-cboxtags">
							<li> 
								<input type="checkbox" tabindex="<?php echo $uno ?>"    id="<?php echo $nom[$uno] ?>" name='<?php echo $key['id_informe_academico'] ?>' value="1" <?php echo $checked ?>   onclick='var iii=document.getElementById("<?php echo $nom[$uno] ?>").checked;  
								if (iii==true) {
									document.getElementById("color<?php echo $nom[$uno] ?>").style.display="block";
									document.getElementById("color2<?php echo $nom[$uno] ?>").style.display="none"; 
									var dolor=1;
									var id=<?php echo $key['id_informe_academico'] ?>;
	document.getElementById("indetificador1<?php echo $key['id_informe_academico'] ?>").value="<?php echo 0;echo " ".$key["id_informe_academico"]  ?>";
									funciones(dolor,id);

								}else{
									document.getElementById("color<?php echo $nom[$uno] ?>").style.display="none";
									document.getElementById("color2<?php echo $nom[$uno] ?>").style.display="block";
									var dolor=0;
									var id=<?php echo $key['id_informe_academico'] ?>;
									document.getElementById("indetificador1<?php echo $key['id_informe_academico'] ?>").value="<?php echo 1;echo " ".$key["id_informe_academico"]  ?>";
									funciones(dolor,id);

								}




								'   >
								<label for="<?php echo $nom[$uno] ?>" >
									<div id="color<?php echo $nom[$uno] ?>"  <?php echo $style1 ?> >Si </div>
									<div id="color2<?php echo $nom[$uno] ?>"  <?php echo $style ?> >NO</div>


								</label>
							</li>
						</ul> </td>
					</tr>
					<?php
				} ?>
			</table>

		</form>
	</div>  
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
</script>
<?php

}?>