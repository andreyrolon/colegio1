


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}
function mostrar_competencias(){
  echo'
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
 <link rel="stylesheet" href="../../../css/chosen.css">';
  require '../conexion.php';  
    $id_tecnica_grado_seder=$_POST['id_tecnica_grado_sede'];
  $id=$_POST['id']; 

 $porciones1 = explode(" ", $id_tecnica_grado_seder);
     $id_tecnica_grado_sede=$porciones1[0]; // porción1
   
     $numero=$porciones1[1];
     	 $consultar_nivel="SELECT tecnica_grado_sede.grado,  competencias.id_periodo,competencias.horas,  competencias.horas, competencias.nombre,competencias.codigo,competencias.id_docente,competencias.id_competencias from competencias,tecnica_grado_sede WHERE competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=$id_tecnica_grado_sede  ORDER BY competencias.id_periodo   ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll(); 
 

	?>

 
			
          <div style="padding: 5px">
          	<strong style="margin: 10px;padding-top: 10px">Tabla De Competencias</strong><br> 
          </div>

	<div class="table table-responsive" style="  padding: 20px">
  



	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#dd"  >Agregar</button>
	    <table class="table  table-striped">
			<thead>
			    <tr > 
			        <th  >Competencia</th>
			        <th  >horas</th>
			        <th  >Codigo</th> 
			        <th  >periodo</th>
			        <th  ><center>Docente</center></th> 
			        <th>horario</th>
			        <th   >Eliminar</th>
			    </tr>
			</thead>
			<tbody>
				<?php foreach ($registro as  $value) { ?>
					<tr id="rt<?php echo $value['id_competencias'] ?>">   
			            <td id="l<?php echo $value['id_competencias']; ?>" 
			            	ondblclick='document.getElementById("l<?php echo $value['id_competencias']; ?>").contentEditable = true;'
			            	class="first_name" data-ides="<?php echo $value['id_competencias']; ?>"  
			            	data-n="nombre"  data-como="<?php echo $value['nombre']; ?>"  
			            	data-codes="ooo1<?php echo $value['id_competencias']; ?>" data-grado=<?php echo $value['grado'];  ?>  
			    	><?php echo   mb_convert_case( $value['nombre'], MB_CASE_TITLE, "UTF-8")   ?>
			    		
			    	</td>  
			            <td> 
			            		<input type="text" style=" width: 10px; 
						  background-color: transparent;
						  border: none; 
						  outline: none;    "   
						  value="<?php echo $value['horas'] ?>" 
						  id="h<?php echo $value['id_competencias']; ?>"  
						  readOnly=true 
						  ondblclick='document.getElementById("h<?php echo $value['id_competencias']; ?>").readOnly=false;' 
						  onchange=' var u=document.getElementById("h<?php echo $value['id_competencias']; ?>").value; document.getElementById("h<?php echo $value['id_competencias']; ?>").readOnly=true;
						  var ides=<?php echo $value['id_competencias']; ?>;
						  var n="horas";
						  var como="<?php echo $value['horas'] ?>";
						  var codes=document.getElementById("ooo1<?php echo $value['id_competencias']; ?>").value;
						  var grado=<?php echo $value['grado'];  ?>;
						  cambiar_compe4(grado,codes,como,u,ides,n);
						  ' > 

				 		 
					</td>  
					<td>
				 		<input type="text" style=" width: 50px;
						  background-color: transparent;
						  border: none; 
						  outline: none;   "   
						  value="<?php echo $value['codigo'] ?>" 
						  id="ooo1<?php echo $value['id_competencias']; ?>"  
						  readOnly=true 
						  ondblclick='document.getElementById("ooo1<?php echo $value['id_competencias']; ?>").readOnly=false;' 
						  onchange=' var u=document.getElementById("ooo1<?php echo $value['id_competencias']; ?>").value; document.getElementById("ooo1<?php echo $value['id_competencias']; ?>").readOnly=true;
						  var ides=<?php echo $value['id_competencias']; ?>;
						  var n="codigo";
						  var como="<?php echo $value['codigo']; ?>";
						  var codes="<?php echo $value['codigo']; ?>";
						  var id_tecnica_grado_sede=<?php echo $id_tecnica_grado_sede ?>;
						  var grado=<?php echo $value['grado'];  ?>;
						  var nombre="<?php echo $value['nombre'] ?>";
						  cambiar_compe2(nombre,grado,id_tecnica_grado_sede,codes,como,u,ides,n);' > 
					</td>
			        <td>
				 		<input type="text" style=" width: 50px;
						  background-color: transparent;
						  border: none; 
						  outline: none;   "   
						  value="<?php echo $value['id_periodo']; ?>" 
						  id="ooor<?php echo $value['id_competencias']; ?>"  
						  readOnly=true 
						  ondblclick='document.getElementById("ooor<?php echo $value['id_competencias']; ?>").readOnly=false;' 
						  onchange=' var u=document.getElementById("ooor<?php echo $value['id_competencias']; ?>").value; document.getElementById("ooor<?php echo $value['id_competencias']; ?>").readOnly=true;
						  var ides=<?php echo $value['id_competencias']; ?>;
						  var n="id_periodo";
						  var como="<?php echo $value['id_periodo']; ?>";
						  var codes=document.getElementById("ooo1<?php echo $value['id_competencias']; ?>").value;
						  var grado=<?php echo $value['grado'];  ?>;
						  var nombre="<?php echo $value['nombre'] ?>";
						  cambiar_compe1(nombre,grado,codes,como,u,ides,n);
						  ' > 
					</td>
			        <td width="200">



			        	<?php  
	$consultar_nivel="SELECT foto,id_docente,nombre,apellido from docente WHERE docente.inhabilitado not in('1')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();?>

	<select id="docente<?php echo $value['id_competencias'] ?>" class=" form-control my-select" style="width: 250px"  onchange=" 
	var docente=document.getElementById('docente<?php echo $value['id_competencias'] ?>').value;
	var competencias=<?php echo $value['id_competencias'] ?>;
	                               doce(competencias,docente)">

<?php
	if ($value['id_docente']==0) {
		echo ' <option value="">Seleccione un docente</option>';
		foreach ($registro as   $valuea) {
			?> 
			  
	 		<option  data-img-src="<?php echo $valuea['foto'] ?>" value="<?php echo $valuea['id_docente'] ?>"><?php echo $valuea['nombre'].' '.$valuea['apellido'] ?></option>  
			<?php
		}
	}else{

		foreach ($registro as   $valuea) {
            if ( $valuea['id_docente']==$value['id_docente']) {
	            ?> 
			  
	 			<option selected="selected" data-img-src="<?php echo $valuea['foto'] ?>" value="<?php echo $valuea['id_docente'] ?>"><?php echo $valuea['nombre'].' '.$valuea['apellido'] ?></option>  
				<?php
            }
            if ( $valuea['id_docente']!=$value['id_docente']) {
	            ?> 
			  
	 			<option  data-img-src="<?php echo $valuea['foto'] ?>" value="<?php echo $valuea['id_docente'] ?>"><?php echo $valuea['nombre'].' '.$valuea['apellido'] ?></option>  
				<?php
            }
			
		}
	}
	
	
 ?>
		</select>	        	

 




			        </td>
			        <td>

  <div class="modal fade" id="hora<?php echo $value['id_competencias']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title">
          		<strong>
          			Horario de <?php echo  mb_convert_case( $value['nombre'], MB_CASE_TITLE, "UTF-8"); ?>
          		</strong>
          </div>
        </div>
        <div class="modal-body">
      <?php   $yuy= $value['id_competencias']; ?>
     <div id="fgr<?php echo $value['id_competencias']; ?>"></div> Dia:
     <select class="form-control" name="dia" id="dia<?php echo $value['id_competencias']?>">
     	<option value=""></option>
     	<option value="1">Lunes</option>
     	<option value="2">Martes</option>
     	<option value="3">Miercoles</option>
     	<option value="4">Jueves</option>
     	<option value="5">Viernes</option>
     	<option value="6">Sabado</option>
     	<option value="7">Domingo</option> 
     </select>		Hora de  inicio:
     <input type="time"  class="form-control" name="inicio" id="inicio<?php echo $value['id_competencias']?>">	Hora de   terminacion:
     <input type="time" class="form-control" name="final" id="final<?php echo $value['id_competencias']?>">	  
     <br> 
     <button   class="btn btn-info" style="width: 100%" onclick="
     var hora=<?php echo($value['horas']) ?>;
     var id_competencias=<?php echo $value['id_competencias']; ?>;
			var dia=document.getElementById('dia<?php echo $value['id_competencias']?>').value;
			var inicio=document.getElementById('inicio<?php echo $value['id_competencias']?>').value;
			var final=document.getElementById('final<?php echo $value['id_competencias']?>').value;
			tabla_registro(hora,dia,inicio,final,id_competencias)">registrar</button> <br>     <br>
			<div class="table-responsive">   
	<div id="tabla<?php echo  $value['id_competencias']; ?>"></div>
	<script type="text/javascript">
		function tabla(){
			var id_competenciass=<?php echo $yuy; ?>;
			$.ajax({   
                type: "post",
                data:{id_competenciass}, 
                url:"../../../ajax/rector/tecnica.php?action=tabla",
                dataType:"text", 

                success:function(data){ 
	   				
	              	$('#tabla<?php echo   $value['id_competencias']; ?>').html(data); 
                }  
            });
		}
	 tabla()
		function tabla_registro(hora,dia,inicio,final,id_competencias){  
			if (dia=='') { 
			 
							$("#fgr"+id_competencias).html('<div    class="alert"   role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> El campo   dia esta vacio. </div>');
							   window.setTimeout(function  () {
			    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
			        $(this).remove(); 
			    });
			}, 4300);
				document.getElementById('dia'+id_competencias).focus();				
				document.getElementById('dia'+id_competencias).value='';
				return

			}   
			if (inicio=='') { 
			 
			$("#fgr"+id_competencias).html('<div   class="alert"    role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> El campo   inicio esta vacio. </div>');
			        window.setTimeout(function  () {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4300);
				document.getElementById('inicio'+id_competencias).focus();				
				document.getElementById('inicio'+id_competencias).value='';
				return

			}
			if (final=='') { 
				
				$("#fgr"+id_competencias).html('<div     class="alert"  role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> El campo  terminacion esta vacio. </div>');
				        window.setTimeout(function  () {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4300);
				document.getElementById('final'+id_competencias).focus();				
				document.getElementById('final'+id_competencias).value='';
				return

			} else{ 
				mostrar1();
				$.ajax({   
	                type: "post",
	                data:{hora,dia,inicio,final,id_competencias}, 
	                url:"../../../ajax/rector/tecnica.php?action=tabla_registro",
	                dataType:"text", 

	                success:function(bb){   
	                	document.getElementById('dia'+id_competencias).focus();				
						document.getElementById('final'+id_competencias).value='';			
						document.getElementById('inicio'+id_competencias).value='';		
						document.getElementById('dia'+id_competencias).value='';
	                	var id_competenciass=id_competencias;
						$.ajax({   
			                type:"post",
			                data:{id_competenciass}, 
			                url:"../../../ajax/rector/tecnica.php?action=tabla",
			                dataType:"text", 

			                success:function(data){ 
				   
				              	$('#tabla'+id_competencias).html(data); 
			                }  
			            });
			            $('body').loadingModal({text: 'Showing loader animations...'});

					    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
					    var time = 100;

					    delay(time)
					    .then(function() { $('body').loadingModal('hide'); return delay(time); } )
					    .then(function() { $('body').loadingModal('destroy') ;} ); 
					 			
                	}  
            	});
            }
		}
	</script>
	<br>
  </div>
</div>  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
      
      </div>
      
    </div>




    <a href="#" data-toggle="modal" data-target="#hora<?php echo $value['id_competencias']; ?>"><img src="../../../logos/004-calendario-2.png" style="width: 35px;"></a></td>
			        <td > 
			        	<a id="oooo<?php echo $value['id_competencias']; ?>" href="#" data-toggle="modal" data-target="#mymodal<?php echo $value['id_competencias']; ?>">
						 <img style="width: 30px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>     

                      	

			        </td>
			    </tr><div class="modal fade" id="mymodal<?php echo $value['id_competencias']; ?>" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p>Esta seguro de eliminar la competencia? tenga en cuenta que liminara el horario y el docente a cargo.   </p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                               
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

                      onclick="
                      var o='<?php echo $value['codigo']; ?>'; 
                      var id='<?php echo $value['id_competencias']; ?>'; 
                      var grado='<?php echo $value['grado']; ?>'; 

                      var nombre='<?php echo $value['nombre']; ?>'; 

                        elimnacomp(nombre,o,id,grado)">Aceptar</button> 

                              </div>
                            </div>
                          </div>
                        </div>
			<?php } ?>
			</tbody>
		</table></div>
		<script type="text/javascript">	
		



		   function cambiar_compe2(nombre,grado,id_tecnica_grado_sede,codes,como,u,ides,n){ 
		   	mostrar1();
        if(ESnumero(u)){
			document.getElementById("ooo1"+ides).value=como; 
            mensaje3(2,"Los codigos de las competencias no soportan letras"); 
           
          } else{ 
          $.ajax({   
                type: "post",
                data:{nombre,grado,u,ides,n,codes,como,id_tecnica_grado_sede}, 
                url:"../../../ajax/rector/tecnica.php?action=cambiar_compe2",
                dataType:"text", 

                success:function(data){ 
   
	              	$('#_MSG3_').html(data); 
	                var id=document.getElementById("ko").value;  

	          		var id_tecnica_grado_sede=document.getElementById("grados").value;  
	         		$.ajax({   
			            type: "post",
			            data:{id_tecnica_grado_sede,id}, 
			            url:"../../../ajax/rector/tecnica.php?action=mostrar_competencias",
			            dataType:"text", 

			            success:function(data){   

			            	
			              $('#mostrar_grados').html(data); 
			 
			            }  


			         }); 
                }  
              });
          }
          	$('body').loadingModal({text: 'Showing loader animations...'});

			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 100;

			delay(time)
			.then(function() { $('body').loadingModal('hide'); return delay(time); } )
			.then(function() { $('body').loadingModal('destroy') ;} ); 
      }
		   function cambiar_compe3(grado,codes,como,u,ides,n){ 
		   	mostrar1();
        if(ESnombre(u)){
			$("#l"+ides).html(como); 
            mensaje3(2,"Los nombres de las competencias no soportan numeros"); 
             
          } else{ 
          $.ajax({   
                type: "post",
                data:{grado,u,ides,n,codes,como}, 
                url:"../../../ajax/rector/tecnica.php?action=cambiar_compe3",
                dataType:"text", 

                success:function(data){ 
   
              		$('#_MSG3_').html(data); 
	                var id=document.getElementById("ko").value;  

	          		var id_tecnica_grado_sede=document.getElementById("grados").value;  
	         		$.ajax({   
			            type: "post",
			            data:{id_tecnica_grado_sede,id}, 
			            url:"../../../ajax/rector/tecnica.php?action=mostrar_competencias",
			            dataType:"text", 

			            success:function(data){    

			              $('#mostrar_grados').html(data); 
			 
			            }  
			        }); 
                }  
             });
          }
          $('body').loadingModal({text: 'Showing loader animations...'});

			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 100;

			delay(time)
			.then(function() { $('body').loadingModal('hide'); return delay(time); } )
			.then(function() { $('body').loadingModal('destroy') ;} ); 
      }


		   function cambiar_compe4(grado,codes,como,u,ides,n){ 
		   	mostrar1();
        if(ESnumero(u)){
			document.getElementById("h"+ides).value=como; 
            mensaje3(2,"solo permite ingresar numeros"); 
       
          } else{ 
          $.ajax({   
                type: "post",
                data:{grado,u,ides,n,codes,como}, 
                url:"../../../ajax/rector/tecnica.php?action=cambiar_compe4",
                dataType:"text", 

                success:function(data){ 
   
              		$('#_MSG3_').html(data); 
	                var id=document.getElementById("ko").value;  

	          		var id_tecnica_grado_sede=document.getElementById("grados").value;  
	         		$.ajax({   
			            type: "post",
			            data:{id_tecnica_grado_sede,id}, 
			            url:"../../../ajax/rector/tecnica.php?action=mostrar_competencias",
			            dataType:"text", 

			            success:function(data){   
			            	 

			              $('#mostrar_grados').html(data); 
			 
			            }  
			        }); 
                }  
             });
          }
          $('body').loadingModal({text: 'Showing loader animations...'});

			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 100;

			delay(time)
			.then(function() { $('body').loadingModal('hide'); return delay(time); } )
			.then(function() { $('body').loadingModal('destroy') ;} ); 
      }

function cambiar_compe1(nombre,grado,codes,como,u,ides,n){ 
	mostrar1();
        if(ESnumero(u)){
			document.getElementById("ooor"+ides).value=como; 
            mensaje3(2,"Este campo no soporta  letras"); 
          
          } else{  
          $.ajax({   
                type: "post",
                data:{nombre,grado,u,ides,n,codes,como}, 
                url:"../../../ajax/rector/tecnica.php?action=cambiar_compe1",
                dataType:"text", 

                success:function(data){ 
   					  
              		$('#_MSG3_').html(data); 
                }  
              });
          }
          $('body').loadingModal({text: 'Showing loader animations...'});

			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 100;

			delay(time)
			.then(function() { $('body').loadingModal('hide'); return delay(time); } )
			.then(function() { $('body').loadingModal('destroy') ;} ); 
      }

			function elimnacomp(nombre,o,id,grado){
				mostrar1();
				$.ajax({   
			        type: "post",
			        data:{nombre,o,grado,id}, 
			        url:"../../../ajax/rector/tecnica.php?action=elimnacompe",
			        dataType:"text", 

			        success:function(data){ 
			        	 
 						$('#_MSG3_').html(data);  
			        }  
		        });
		        $('body').loadingModal({text: 'Showing loader animations...'});

				var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
				var time = 100;

				delay(time)
				.then(function() { $('body').loadingModal('hide'); return delay(time); } )
				.then(function() { $('body').loadingModal('destroy') ;} ); 
			}






			function doce(competencias,docente){
				mostrar1();
                 $.ajax({   
			        type: "post",
			        data:{competencias,docente}, 
			        url:"../../../ajax/rector/tecnica.php?action=carga_docente",
			        dataType:"text", 

			        success:function(data){  
			        	 
			         
			       }  
		        });
                $('body').loadingModal({text: 'Showing loader animations...'});

				var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
				var time = 100;

				delay(time)
				.then(function() { $('body').loadingModal('hide'); return delay(time); } )
				.then(function() { $('body').loadingModal('destroy') ;} ); 
			}	


			$(".my-select").chosen()({
			    placeholder: "Select a state",
			    allowClear: true
			});
		</script> 
		<?php
     
     
}
function tabla_registro(){
	require '../conexion.php';
 
 
 
    	 $SELECT="INSERT INTO `horario_competencias` (`id_horario_competencias`, `dia`, `hora_inicio`, `hora_fin`, `id_competencias`) VALUES (NULL, '".$_POST['dia']."', '".$_POST['inicio']."', '".$_POST['final']."', '".$_POST['id_competencias']."')";
		$SELECT=$conexion->prepare($SELECT);
		$SELECT->execute(array());
 
}
function tabla(){  


	?> 

	<style type="text/css">
		[data-title] {  
    border-radius: 25px;
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -49px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%; font-size: 15px;  border-radius: 6px;
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -28px;
  left: -26px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000; 
}
.ftf:hover td{
    background-color: #55b3ca3d; 
}
	</style>
	
	<div class="clas"></div>
	 <table class="table" style=" ">
    <thead>
        <tr> 
	        <th>Dia</th> 
	        <th>Hora inicio</th> 
	        <th>Hora fin</th> 
	        <th>eliminar</th> 
	         
	       
        </tr>
    </thead>
    <tbody>
    	<?php 
    		require '../conexion.php';

    	 $SELECT="SELECT * FROM `horario_competencias` WHERE id_competencias=".$_POST['id_competenciass']." ORDER BY dia";
		$SELECT=$conexion->prepare($SELECT);
		$SELECT->execute(array());
		foreach ($SELECT as   $valuse) { 
			$dia= $valuse['dia']; ?>

		    <tr id="frt<?php echo $valuse['id_horario_competencias'] ?>" class='ftf'>
		        <td>    
		        	<select  id="dia<?php echo $valuse['id_horario_competencias'] ?>" value="" onchange='  
			        var id=<?php echo $valuse['id_horario_competencias'] ?>;
			        var campo="dia";
			        var nombre=document.getElementById("dia<?php echo $valuse['id_horario_competencias'] ?>").value;
			        var volvere="<?php echo $valuse['dia'] ?>";
			        actualizar_horario2(id,campo,volvere,nombre); ' style='    display: block;
	 
				    height: 34px;
				    padding: 6px 12px;
				    font-size: 14px;
				    line-height: 1.42857143;
				    color: #555;
				    background-color: #fff;
				    background-image: none;
				    border: 1px solid #ccc;
				    border-radius: 4px;
				    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
				    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
				    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
				    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
				    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;'>
						<?php 
						$variable=array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'); 
						 
							echo "<option value='".$dia."'>".$variable[$dia]."</option>";
						foreach ($variable as $key ) {
							if ($variable[$dia]!=$key && $key!='') {
								echo "<option value='".array_search($key,$variable)."'>".$key."</option>";
							} 
						}
						 

						 ?>

					</select>
				</td>
		        <td><input type="time" id='hora_inicio<?php echo $valuse['id_horario_competencias'] ?>' value="<?php echo $valuse['hora_inicio'] ?>" onchange='  
			        var id=<?php echo $valuse['id_horario_competencias'] ?>;
			        var campo="hora_inicio";
			        var nombre=document.getElementById("hora_inicio<?php echo $valuse['id_horario_competencias'] ?>").value;
			        var volvere="<?php echo $valuse['hora_inicio'] ?>";
			        actualizar_horario(id,campo,volvere,nombre); '  style='    display: block;
 
				    height: 34px;
				    padding: 6px 12px;
				    font-size: 14px;
				    line-height: 1.42857143;
				    color: #555;
				    background-color: #fff;
				    background-image: none;
				    border: 1px solid #ccc;
				    border-radius: 4px;
				    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
				    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
				    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
				    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
				    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;'></td>
		        <td><input type="time" id="hora_fin<?php echo $valuse['id_horario_competencias'] ?>" value="<?php echo $valuse['hora_fin'] ?>" onchange='  
			        var id=<?php echo $valuse['id_horario_competencias'] ?>;
			        var campo="hora_fin";
			        var nombre=document.getElementById("hora_fin<?php echo $valuse['id_horario_competencias'] ?>").value;
			        var volvere="<?php echo $valuse['hora_fin'] ?>";
			        actualizar_horario(id,campo,volvere,nombre); '  style='    display: block;
 
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;'></td>
		        <td><a  data-title="Eliminar horario" onclick='
		         var r = confirm("Está  seguro de eliminar esté registro!");
                    if (r == true) {
				        var id_horario_competencias=<?php echo $valuse['id_horario_competencias'] ?>;
				        registro(id_horario_competencias); 
				    }else{
				    	return;
				    }  '><img style="width: 20px;margin-right: 10px;float: left;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" >
		        </a></td>
		    </tr>    
		<?php	}  
		     
		  ?>
    </tbody>
  </table>
  <div id="sapo"></div>
  <script type="text/javascript">
  	function actualizar_horario2(id,campo,volvere,nombre){ 
  		$.ajax({   
			type: "post",
			data:{id,campo,volvere,nombre}, 
			url:"../../../ajax/rector/tecnica.php?action=actualizar_horario",
			dataType:"text", 

			success:function(data){  
			$('.clas').html('<div class="alert" style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">    <strong>informacion!</strong> <div style="font-weight:normal;"><i class="fa fa-check fs-xl"></i>  Registro Actualizado.</div>   </div>');
			window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 3200);
 			
				 
			}  
		}); 

  	}
  	function actualizar_horario(id,campo,volvere,nombre){
  		$.ajax({   
			type: "post",
			data:{id,campo,volvere,nombre}, 
			url:"../../../ajax/rector/tecnica.php?action=actualizar_horario",
			dataType:"text", 

			success:function(data){  
			$('.clas').html('<div class="alert" style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">    <strong>informacion!</strong> <div style="font-weight:normal;"><i class="fa fa-check fs-xl"></i>  Registro Actualizado.</div>   </div>');
			window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 3200);
				 
			}  
		});

  	}
  	function registro(id_horario_competencias){
  		 $.ajax({   
			        type: "post",
			        data:{id_horario_competencias}, 
			        url:"../../../ajax/rector/tecnica.php?action=id_horario_competencias",
			        dataType:"text", 

			        success:function(data){  
			         document.getElementById("frt"+id_horario_competencias).style.visibility = "hidden";

			       }  
		        });
  	}
  </script>
  <?php
}

function actualizar_horario(){
		require '../conexion.php';
	echo$consultar_nivel2="UPDATE `horario_competencias` SET `".$_POST['campo']."` = '".$_POST['nombre']."'  WHERE `horario_competencias`.`id_horario_competencias` =".$_POST['id'];
	$consultar_nivel12=$conexion->prepare($consultar_nivel2);
	$consultar_nivel12->execute(array());
}


function id_horario_competencias(){ 
	require '../conexion.php';
	$consultar_nivel2="DELETE FROM `horario_competencias` WHERE `horario_competencias`.`id_horario_competencias` =".$_POST['id_horario_competencias'];
	$consultar_nivel12=$conexion->prepare($consultar_nivel2);
	$consultar_nivel12->execute(array());
}
function cambiar_compe2(){

	$u=$_POST['u'];$ides=$_POST['ides'];$n=$_POST['n'];$como=$_POST['como'];$codes=$_POST['codes'];$id_tecnica_grado_sede=$_POST['id_tecnica_grado_sede'];$grado=$_POST['grado'];$nombre=$_POST['nombre'];
	require '../conexion.php';
	$consultar_nivel2="SELECT tecnica_grado_sede.id_tecnica_grado_sede FROM tecnica_grado_sede,competencias WHERE competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=$id_tecnica_grado_sede and competencias.codigo=$u";
	$consultar_nivel12=$conexion->prepare($consultar_nivel2);
	$consultar_nivel12->execute(array());
	$inse=$consultar_nivel12->rowCount();
	if ($inse==0) { 
  		$str =strlen($u);
		if($str<=7){
			$consultar_nivel="UPDATE `competencias` SET `$n` = '$u' WHERE `competencias`.`codigo` = $codes and `competencias`.`grado` = '$grado'  and  `competencias`.`nombre` = '$nombre'";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());
			$registro=$consultar_nivel1->fetchAll();
			?>
		<script> 

			document.getElementById('ooo1<?php echo $ides; ?>').value=' '; 
			mensaje3(3,'campo actualizado')</script><?php
		}else{
			?>
		<script>
			document.getElementById('ooo1<?php echo $ides; ?>').value='<?php echo $como; ?>'; 
			mensaje3(1,'El numero pasa de siete digitos')</script><?php
		}
	}	else{
			?>
		    <script>
			document.getElementById('ooo1<?php echo $ides; ?>').value='<?php echo $como; ?>'; 
			mensaje3(1,'El codigo se encuentra repetido')</script><?php

	}
	
} 


function cambiar_compe3(){

	$u=$_POST['u'];$ides=$_POST['ides'];$n=$_POST['n'];$como=$_POST['como'];$codes=$_POST['codes'];$grado=$_POST['grado'];
	require '../conexion.php';
 	$consultar_nivel2x="SELECT competencias.codigo FROM competencias  WHERE competencias.nombre='$u'";
	$consultar_nivel12x=$conexion->prepare($consultar_nivel2x);
	$consultar_nivel12x->execute(array());
	$insex=$consultar_nivel12x->rowCount();
	if($insex==0){  
	 	$consultar_nivel="UPDATE `competencias` SET `$n` = '$u' WHERE `competencias`.`nombre` = '$como' and `competencias`.`codigo` = '$codes'  and  `competencias`.`grado` = $grado";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll(); ?>
		<script> mensaje3(3,'campo actualizado')</script><?php
	}else{
			?>
		    <script>
			document.getElementById('l<?php echo $ides; ?>').value='<?php echo $como; ?>'; 
			mensaje3(1,'El nombre se encuentra repetido')</script><?php
	}
	 
	
	
}

function cambiar_compe4(){

	$u=$_POST['u'];$ides=$_POST['ides'];$n=$_POST['n'];$como=$_POST['como'];$codes=$_POST['codes'];$grado=$_POST['grado'];
	require '../conexion.php';
 	  
	 	$consultar_nivel="UPDATE `competencias` SET `$n` = '$u' WHERE `competencias`.`codigo` = '$codes'   ";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll(); ?>
		<script> mensaje3(3,'campo actualizado')</script><?php
	  
	 
	
	
}
function cambiar_compe1(){

	$u=$_POST['u'];$ides=$_POST['ides'];$n=$_POST['n'];$como=$_POST['como'];$codes=$_POST['codes'];$grado=$_POST['grado'];
$nombre=$_POST['nombre'];
	require '../conexion.php';
	           // HELLO WORLD!
	 $sql="SELECT numero FROM periodo where numero='$u' order by numero";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $inse=$sql1->rowCount();

	if ($inse>0) {
		$consultar_nivel="UPDATE `competencias` SET `$n` = '$u' WHERE `competencias`.`codigo` = $codes and `competencias`.`grado` = '$grado'  and  `competencias`.`nombre` = '$nombre'";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll();
		?>
	<script> 
		mensaje3(3,'periodo actualizado')</script><?php
	}else{?>
	<script>
		document.getElementById('ooor<?php echo $ides; ?>').value='<?php echo $como; ?>'; 
		mensaje3(1,'periodo invalido')</script><?php
	}
	
} 
function elimnacompe(){

	require '../conexion.php';
	$competencias=$_POST['o'];
	$id=$_POST['id'];
	$grado=$_POST['grado'];
	$nombre=$_POST['nombre'];
	$ano=date('Y');
	echo$consultar_nivel2="SELECT  informeacademico.id_informe_academico  from informeacademico,tecnologia WHERE informeacademico.id_informe_academico=tecnologia.id_informe_academico and tecnologia.id_competrencia=$id and informeacademico.ano=$ano LIMIT 4";
	$consultar_nivel12=$conexion->prepare($consultar_nivel2);
	$consultar_nivel12->execute(array());
	 $inse=$consultar_nivel12->rowCount();
	if ($inse==0) { 
		$consultar_nivel="DELETE FROM `competencias`  WHERE  `competencias`.`codigo` = '$competencias';
						DELETE FROM `horario_competencias` WHERE `horario_competencias`.`id_competencias`  = '$id'  ";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll();
		?>
		<script type="text/javascript">
			$("#rt<?php echo $id ?>").remove();  
			mensaje3(3,'Competencia eliminada');
		</script>
		<?php
	}else{
		?>

		<script type="text/javascript">
			mensaje3(1,'Actualmente hay estudiantes con esta competencia');
		</script>

		<?php
	}
}
function carga_docente(){
	require '../conexion.php';
	$competencias=$_POST['competencias'];
	$docente=$_POST['docente'];

	 
	if ($docente=='') {
		$consultar_nivel="UPDATE `competencias` SET `id_docente` = '0' WHERE `competencias`.`id_competencias` = $competencias";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll();

	}else{
		$consultar_nivel="UPDATE  `competencias` SET `id_docente` = '$docente' WHERE `competencias`.`id_competencias` = $competencias";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$registro=$consultar_nivel1->fetchAll();

	}
	
}

function competenciass(){
	$id_tecnica_grado_sede=$_POST['id_tecnica_grado_sede'];
	$id_tecnica=$_POST['id_tecnica'];
	$grado=$_POST['grado'];
	$periodo=$_POST['periodo'];
	$codigo=$_POST['codigo'];
	$nombre=$_POST['nombre'];
	$hora=$_POST['hora'];
	require '../conexion.php'; 
	$consultar_nivel2x="SELECT competencias.codigo FROM competencias  WHERE competencias.nombre='$nombre'";
	$consultar_nivel12x=$conexion->prepare($consultar_nivel2x);
	$consultar_nivel12x->execute(array());
	$insex=$consultar_nivel12x->rowCount();
	if($insex==0){  
	
		$consultar_nivel2="SELECT tecnica_grado_sede.id_tecnica_grado_sede FROM tecnica_grado_sede,competencias WHERE competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and tecnica_grado_sede.id_tecnica_grado_sede=$id_tecnica_grado_sede and competencias.codigo=$codigo";
		$consultar_nivel12=$conexion->prepare($consultar_nivel2);
		$consultar_nivel12->execute(array());
		$inse=$consultar_nivel12->rowCount();
		if ($inse==0) { 
		   echo $consultar_nivel="INSERT INTO `competencias` ( `id_tecnica_grado_sede`, `nombre`, `codigo`, `id_periodo`, `grado`, `horas`)  
		     SELECT tecnica_grado_sede.id_tecnica_grado_sede,'$nombre','$codigo','$periodo','$grado','$hora' from tecnica_grado_sede,tecnicas WHERE tecnica_grado_sede.id_tecnica=tecnicas.id_tecnica AND tecnica_grado_sede.id_tecnica=$id_tecnica  and tecnica_grado_sede.grado=$grado";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());
			 ?>
			<script>  

	          	document.getElementById("din").reset();
				mensaje2(3,'Has realizado el registro  ')
			</script><?php
		}else{ ?>
			<script>  
				document.getElementById("codigo").value='';
				document.getElementById("codigo").focus();
				mensaje2(1,'el codigo se encuentra repetido  ')
			</script><?php
		}
	}else{ ?>
		<script>  
			document.getElementById("nombre").value='';
			document.getElementById("nombre").focus();
			mensaje2(1,'el nombre se encuentra repetido  ')
		</script><?php		
	}
}
function mostrar_grados(){
echo '
 <link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>';
  require '../conexion.php'; 
  $id_sede=$_POST['id_sede'];
   $consultar_nivel="SELECT ju.jorna,grado.numero as grad,grado_sede.id,curso.numero FROM grado_sede INNER JOIN grado on grado_sede.id_grado=grado.id_grado INNER JOIN curso on curso.id_curso=grado_sede.id_curso INNER JOIN (SELECT jornada_sede.ID_SEDE,jornada.NOMBRE as jorna,jornada_sede.ID_JS from jornada,jornada_sede WHERE jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.ID_SEDE=$id_sede and jornada_sede.inhabilitar=0 )as ju on grado_sede.id_jornada_sede=ju.ID_JS where grado.numero in('10','11','12') and grado_sede.inhabilitar=0 ";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();?>
	<a onclick=" var id_sede=<?php echo $id_sede ?>; functiond(id_sede)"><img style="width: 20px ;margin-top: 10px;margin-left: 10px" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDQzOC41MjkgNDM4LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDM4LjUyOSA0MzguNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQzMy4xMDksMjMuNjk0Yy0zLjYxNC0zLjYxMi03Ljg5OC01LjQyNC0xMi44NDgtNS40MjRjLTQuOTQ4LDAtOS4yMjYsMS44MTItMTIuODQ3LDUuNDI0bC0zNy4xMTMsMzYuODM1ICAgIGMtMjAuMzY1LTE5LjIyNi00My42ODQtMzQuMTIzLTY5Ljk0OC00NC42ODRDMjc0LjA5MSw1LjI4MywyNDcuMDU2LDAuMDAzLDIxOS4yNjYsMC4wMDNjLTUyLjM0NCwwLTk4LjAyMiwxNS44NDMtMTM3LjA0Miw0Ny41MzYgICAgQzQzLjIwMyw3OS4yMjgsMTcuNTA5LDEyMC41NzQsNS4xMzcsMTcxLjU4N3YxLjk5N2MwLDIuNDc0LDAuOTAzLDQuNjE3LDIuNzEyLDYuNDIzYzEuODA5LDEuODA5LDMuOTQ5LDIuNzEyLDYuNDIzLDIuNzEyaDU2LjgxNCAgICBjNC4xODksMCw3LjA0Mi0yLjE5LDguNTY2LTYuNTY1YzcuOTkzLTE5LjAzMiwxMy4wMzUtMzAuMTY2LDE1LjEzMS0zMy40MDNjMTMuMzIyLTIxLjY5OCwzMS4wMjMtMzguNzM0LDUzLjEwMy01MS4xMDYgICAgYzIyLjA4Mi0xMi4zNzEsNDUuODczLTE4LjU1OSw3MS4zNzYtMTguNTU5YzM4LjI2MSwwLDcxLjQ3MywxMy4wMzksOTkuNjQ1LDM5LjExNWwtMzkuNDA2LDM5LjM5NyAgICBjLTMuNjA3LDMuNjE3LTUuNDIxLDcuOTAyLTUuNDIxLDEyLjg1MWMwLDQuOTQ4LDEuODEzLDkuMjMxLDUuNDIxLDEyLjg0N2MzLjYyMSwzLjYxNyw3LjkwNSw1LjQyNCwxMi44NTQsNS40MjRoMTI3LjkwNiAgICBjNC45NDksMCw5LjIzMy0xLjgwNywxMi44NDgtNS40MjRjMy42MTMtMy42MTYsNS40Mi03Ljg5OCw1LjQyLTEyLjg0N1YzNi41NDJDNDM4LjUyOSwzMS41OTMsNDM2LjczMywyNy4zMTIsNDMzLjEwOSwyMy42OTR6IiBmaWxsPSIjMDAwMDAwIi8+CgkJPHBhdGggZD0iTTQyMi4yNTMsMjU1LjgxM2gtNTQuODE2Yy00LjE4OCwwLTcuMDQzLDIuMTg3LTguNTYyLDYuNTY2Yy03Ljk5LDE5LjAzNC0xMy4wMzgsMzAuMTYzLTE1LjEyOSwzMy40ICAgIGMtMTMuMzI2LDIxLjY5My0zMS4wMjgsMzguNzM1LTUzLjEwMiw1MS4xMDZjLTIyLjA4MywxMi4zNzUtNDUuODc0LDE4LjU1Ni03MS4zNzgsMTguNTU2Yy0xOC40NjEsMC0zNi4yNTktMy40MjMtNTMuMzg3LTEwLjI3MyAgICBjLTE3LjEzLTYuODU4LTMyLjQ1NC0xNi41NjctNDUuOTY2LTI5LjEzbDM5LjExNS0zOS4xMTJjMy42MTUtMy42MTMsNS40MjQtNy45MDEsNS40MjQtMTIuODQ3YzAtNC45NDgtMS44MDktOS4yMzYtNS40MjQtMTIuODQ3ICAgIGMtMy42MTctMy42Mi03Ljg5OC01LjQzMS0xMi44NDctNS40MzFIMTguMjc0Yy00Ljk1MiwwLTkuMjM1LDEuODExLTEyLjg1MSw1LjQzMUMxLjgwNywyNjQuODQ0LDAsMjY5LjEzMiwwLDI3NC4wOHYxMjcuOTA3ICAgIGMwLDQuOTQ1LDEuODA3LDkuMjMyLDUuNDI0LDEyLjg0N2MzLjYxOSwzLjYxLDcuOTAyLDUuNDI4LDEyLjg1MSw1LjQyOGM0Ljk0OCwwLDkuMjI5LTEuODE3LDEyLjg0Ny01LjQyOGwzNi44MjktMzYuODMzICAgIGMyMC4zNjcsMTkuNDEsNDMuNTQyLDM0LjM1NSw2OS41MjMsNDQuODIzYzI1Ljk4MSwxMC40NzIsNTIuODY2LDE1LjcwMSw4MC42NTMsMTUuNzAxYzUyLjE1NSwwLDk3LjY0My0xNS44NDUsMTM2LjQ3MS00Ny41MzQgICAgYzM4LjgyOC0zMS42ODgsNjQuMzMzLTczLjA0Miw3Ni41Mi0xMjQuMDVjMC4xOTEtMC4zOCwwLjI4MS0xLjA0NywwLjI4MS0xLjk5NWMwLTIuNDc4LTAuOTA3LTQuNjEyLTIuNzE1LTYuNDI3ICAgIEM0MjYuODc0LDI1Ni43Miw0MjQuNzMxLDI1NS44MTMsNDIyLjI1MywyNTUuODEzeiIgZmlsbD0iIzAwMDAwMCIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /></a>
	<div style="padding: 20px" class="table-responsive"> 
		 
	<table class="table table-rasponsibe table-condensed">
		<thead>
			<th width="100">Jornada</th>
			<th width="100">grado</th>

			<th width="100">curso</th>
			<th  width="130">modalidad</th>  
		</thead>
	

	<?php
	foreach ($registro as $key) {
		$grado_sede=$key['id'];
		$consultar_nivel2="SELECT tecnicas.nombre_tecnica,tecnicas.id_tecnica,tecnicas.abrevido FROM tecnica_grado_sede INNER JOIN tecnicas on tecnicas.id_tecnica=tecnica_grado_sede.id_tecnica where tecnica_grado_sede.id_grado_sede=$grado_sede ";
		$consultar_nivel12=$conexion->prepare($consultar_nivel2);
		$consultar_nivel12->execute(array());
		$registro2=$consultar_nivel12->fetchAll();



		?>
		<tr>
			<td><?php echo($key['jorna']) ?></td>
			<td><?php echo($key['grad']) ?></td>
			<td><?php echo($key['numero']) ?></td>
			<td><?php 
				$rt='';
				foreach ($registro2 as $f ) {
					 $rt=$f['abrevido'];
				 	 $id_tecnicafff=$f['id_tecnica'];
					
				}?>
				<select id="ui<?php echo $grado_sede ?>" class="  form-control" 
					onchange="
					var grado=<?php echo($key['grad']) ?>;
					var grado_sede=<?php echo($grado_sede) ?>;
					var sele=document.getElementById('ui<?php echo $grado_sede ?>').value;
					actualizar_modalidad(grado,sele,grado_sede)
					">

				<?php
				if($rt==''){?>
					<option value="">Academico</option><?php

				}else{
					echo '<option value="'.$id_tecnicafff.'">'.$rt.'</option>';
				}
				$SELECT="SELECT * FROM tecnicas WHERE tecnicas.abrevido not in('$rt') ";
				$SELECT=$conexion->prepare($SELECT);
				$SELECT->execute(array()); 
				foreach ($SELECT as $key ) {
					 echo '<option value="'.$key['id_tecnica'].'">'.$key['abrevido'].'</option>';
				}
				if($rt!=''){?>
					<option value="">Academico</option><?php

				}
				 ?>
				</select>
			</td>
			 
		</tr>
		<?php
	}
	?>
	</table></div><script type="text/javascript">
			 
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script> 
	 
	<?php
}


function actualizar_modalidad(){
	echo $sele=$_POST['sele'];echo "<br>";
	echo $grado_sede=$_POST['grado_sede'];
    require '../conexion.php';
    if($sele!='') {
	     $consultar_nivelw="SELECT tecnica_grado_sede.id_tecnica_grado_sede  FROM `tecnica_grado_sede` WHERE tecnica_grado_sede.id_grado_sede=$grado_sede ";
		$consultar_nivel1w=$conexion->prepare($consultar_nivelw);
		$consultar_nivel1w->execute(array()); 
		foreach ($consultar_nivel1w as $kvalue) {
			$id_tecnica_grado_sede=$kvalue['id_tecnica_grado_sede'];
		}
		$inse=$consultar_nivel1w->rowCount();

		if ($inse==0) {
	    echo $consultar_nivel="INSERT INTO `tecnica_grado_sede` ( `id_grado_sede`, `id_tecnica`,`grado`) VALUES ('$grado_sede', '$sele', '".$_POST['grado']."')";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
		$f =$conexion->lastInsertId() ;


		$consultar_nivel="
		INSERT INTO `competencias` ( `id_tecnica_grado_sede`, `nombre`, `codigo`, `id_periodo`, `grado`) 
		SELECT '$f',competencias.nombre,competencias.codigo, competencias.id_periodo,competencias.grado from competencias,tecnica_grado_sede WHERE competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and tecnica_grado_sede.id_tecnica='$sele'  and competencias.grado='".$_POST['grado']."'  GROUP by competencias.codigo ";
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());  


			# code...
		}else{
			$consultar_nivel="UPDATE `tecnica_grado_sede` SET `id_tecnica` = '$sele' WHERE `tecnica_grado_sede`.`id_grado_sede` = $grado_sede;DELETE FROM `competencias`  WHERE `competencias`.`id_tecnica_grado_sede` =  $id_tecnica_grado_sede;
			INSERT INTO `competencias` ( `id_tecnica_grado_sede`, `nombre`, `codigo`, `id_periodo`, `grado`) 
			SELECT '$id_tecnica_grado_sede',competencias.nombre,competencias.codigo, competencias.id_periodo,competencias.grado from competencias,tecnica_grado_sede WHERE competencias.id_tecnica_grado_sede=tecnica_grado_sede.id_tecnica_grado_sede and tecnica_grado_sede.id_tecnica='$sele'  and competencias.grado='".$_POST['grado']."'  GROUP by competencias.codigo ";
			$consultar_nivel1=$conexion->prepare($consultar_nivel);
			$consultar_nivel1->execute(array());  
		}
    }else{
    	echo$consultar_nivelw="SELECT competencias.nombre, tecnica_grado_sede.id_tecnica_grado_sede,competencias.id_competencias FROM tecnica_grado_sede,competencias WHERE tecnica_grado_sede.id_tecnica_grado_sede=competencias.id_tecnica_grado_sede AND tecnica_grado_sede.id_grado_sede=$grado_sede ";
		$consultar_nivel1w=$conexion->prepare($consultar_nivelw);
		$consultar_nivel1w->execute(array()); 
		foreach ($consultar_nivel1w as $kvalue) {

			$id_tecnica_grado_sede=$kvalue['id_tecnica_grado_sede'];
			$consultw="DELETE FROM `horario_competencias` WHERE horario_competencias.id_competencias =$id_tecnica_grado_sede";
			$consultw=$conexion->prepare($consultw);
			$consultw->execute(array()); 
			
		}
    	 $consultar_nivelmini="DELETE FROM `competencias`  WHERE `competencias`.`id_tecnica_grado_sede` =  $id_tecnica_grado_sede ;DELETE FROM `tecnica_grado_sede`  WHERE tecnica_grado_sede.id_grado_sede=$grado_sede ";
		$consultar_nivel1=$conexion->prepare($consultar_nivelmini);
		$consultar_nivel1->execute(array());
    }


}
function mostrar_tecnicas(){

	require '../conexion.php';
	$consultar_nivel="SELECT * FROM tecnicas";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());
	$registro=$consultar_nivel1->fetchAll();?>

	<div class="table-responsive"><center><p style="font-size:20px; ">
		<div style="margin: 10px" id="_MSG7_"> </div>
		Carreras Tecnicas</p>
		<img style="width: 100px;align-self: center;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6I0M5MkIzMTsiIGQ9Ik01MDQuMDI2LDE5Mi4zNzRDNDc1LjczNyw4MS43NzEsMzc1LjQyLDAsMjU2LDBDMTE0LjYxNiwwLDAsMTE0LjYxNiwwLDI1NiAgYzAsMTE5LjQyLDgxLjc3MSwyMTkuNzM3LDE5Mi4zNzQsMjQ4LjAyNkw1MDQuMDI2LDE5Mi4zNzR6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiM5RDI0MjI7IiBkPSJNNTEyLDI1NmMwLTIxLjk2NS0yLjc3LTQzLjI4My03Ljk3NC02My42MjZMMzg5LjU2NSw3Ny45MTNsLTI2Ny4xMywzNTYuMTc0bDY5LjkzOSw2OS45MzkgIEMyMTIuNzE3LDUwOS4yMywyMzQuMDM1LDUxMiwyNTYsNTEyQzM5Ny4zODQsNTEyLDUxMiwzOTcuMzg0LDUxMiwyNTZ6Ii8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNGOUJFMDI7IiBwb2ludHM9IjI1Niw3Ny45MTMgMjExLjQ3OCwyNTYgMjU2LDQzNC4wODcgMzg5LjU2NSw0MzQuMDg3IDM4OS41NjUsNzcuOTEzICIvPgo8cmVjdCB4PSIxMjIuNDM1IiB5PSI3Ny45MTMiIHN0eWxlPSJmaWxsOiNGQkQ4Njc7IiB3aWR0aD0iMTMzLjU2NSIgaGVpZ2h0PSIzNTYuMTc0Ii8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNGRUYyQ0M7IiBwb2ludHM9IjI1NiwxMDAuMTc0IDIxOC44OTksMjU2IDI1Niw0MTEuODI2IDM2Ny4zMDQsNDExLjgyNiAzNjcuMzA0LDEwMC4xNzQgIi8+CjxyZWN0IHg9IjE0NC42OTYiIHk9IjEwMC4xNzQiIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiB3aWR0aD0iMTExLjMwNCIgaGVpZ2h0PSIzMTEuNjUyIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNGNjMzNDE7IiBwb2ludHM9IjI5NC45NTcsMzg5LjU2NSAyNTYsMzUwLjYwOSAyMzMuNzM5LDI2MS41NjUgMjk0Ljk1NywyNjEuNTY1ICIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRjg1QzY3OyIgcG9pbnRzPSIyMTcuMDQzLDM4OS41NjUgMjU2LDM1MC42MDkgMjU2LDI2MS41NjUgMjE3LjA0MywyNjEuNTY1ICIvPgo8cGF0aCBzdHlsZT0iZmlsbDojOUQyNDIyOyIgZD0iTTI1NiwyMTEuNDc4bC0yMi4yNjEsNTUuNjUyTDI1NiwzMjIuNzgzYzMwLjczNiwwLDU1LjY1Mi0yNC45MTcsNTUuNjUyLTU1LjY1MiAgUzI4Ni43MzYsMjExLjQ3OCwyNTYsMjExLjQ3OHoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQzkyQjMxOyIgZD0iTTIwMC4zNDgsMjY3LjEzYzAsMzAuNzM2LDI0LjkxNyw1NS42NTIsNTUuNjUyLDU1LjY1MlYyMTEuNDc4ICAgQzIyNS4yNjQsMjExLjQ3OCwyMDAuMzQ4LDIzNi4zOTUsMjAwLjM0OCwyNjcuMTN6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQzkyQjMxOyIgZD0iTTI1NiwyMzMuNzM5bC0xMy4zNTcsMzMuMzkxTDI1NiwzMDAuNTIyYzE4LjQ0MiwwLDMzLjM5MS0xNC45NDksMzMuMzkxLTMzLjM5MSAgIFMyNzQuNDQyLDIzMy43MzksMjU2LDIzMy43Mzl6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6I0Y2MzM0MTsiIGQ9Ik0yMjIuNjA5LDI2Ny4xM2MwLDE4LjQ0MiwxNC45NDksMzMuMzkxLDMzLjM5MSwzMy4zOTF2LTY2Ljc4MyAgQzIzNy41NTksMjMzLjczOSwyMjIuNjA5LDI0OC42OSwyMjIuNjA5LDI2Ny4xM3oiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6IzM5NEI0ODsiIHBvaW50cz0iMjU2LDE2Ni45NTcgMjQwLjUyMywxNzguMDg3IDI1NiwxODkuMjE3IDM0NS4wNDMsMTg5LjIxNyAzNDUuMDQzLDE2Ni45NTcgIi8+CjxyZWN0IHg9IjE2Ni45NTciIHk9IjE2Ni45NTciIHN0eWxlPSJmaWxsOiM2MTZGNkQ7IiB3aWR0aD0iODkuMDQzIiBoZWlnaHQ9IjIyLjI2MSIvPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojMzk0QjQ4OyIgcG9pbnRzPSIyNTYsMTIyLjQzNSAyNDAuNTIzLDEzMy41NjUgMjU2LDE0NC42OTYgMzQ1LjA0MywxNDQuNjk2IDM0NS4wNDMsMTIyLjQzNSAiLz4KPHJlY3QgeD0iMTY2Ljk1NyIgeT0iMTIyLjQzNSIgc3R5bGU9ImZpbGw6IzYxNkY2RDsiIHdpZHRoPSI4OS4wNDMiIGhlaWdodD0iMjIuMjYxIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /></center>
		<br>
		<?php foreach ($registro as $key ) {?>


			<div class="modal fade" id="mymodal<?php echo $key['id_tecnica']; ?>" data-keyboard="false" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
							Confirmación 
						</div>
						<div class="modal-body">
							<p>Si elimina la tecnica  eliminara sus competencias estás seguro de hacerlo  ?</p>

						</div>
						<div class="modal-footer">  
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

							<button type="button" data-dismiss="modal" name="Aceptar" id="dsd"   class="btn btn-primary" 

							onclick="var eliminar=<?php echo $key['id_tecnica']; ?>;
							var i='filarii<?php echo $key['id_tecnica']; ?>'; 

							elimna(eliminar,i )">Aceptar</button> 

						</div>
					</div>
				</div>
			</div>

			<div id="filarii<?php echo $key['id_tecnica']; ?>">
				<a id="oooo<?php echo $key['id_tecnica']; ?>" href="#" data-toggle="modal" data-target="#mymodal<?php echo $key['id_tecnica']; ?>">
					<img style="width: 20px;margin-right: 10px;float: left;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=" />
				</a>










				<div  style="margin-left:  28px"  id="oo<?php echo $key['id_tecnica']; ?>"  ondblclick='document.getElementById("oo<?php echo $key['id_tecnica']; ?>").contentEditable = true;' 
				onblur=' var u=$("#oo<?php echo $key['id_tecnica']; ?>").html(); document.getElementById("oo<?php echo $key['id_tecnica']; ?>").readOnly=true;
				var ides=<?php echo $key['id_tecnica']; ?>;
				var n="nombre_tecnica";
				var valor1="<?php echo $key['nombre_tecnica']?>";
				var valor2="oo<?php echo $key['id_tecnica']; ?>";
				cambiar(u,ides,n,valor1,valor2);  '><?php echo $key['nombre_tecnica']?></div> 




				<nav  id="zz<?php echo $key['id_tecnica']; ?>"  style="float: left; margin-left: 30px;margin-right: 8px">Institucion:</nav>
				<div  style="margin-left:  28px"  id="zz<?php echo $key['id_tecnica']; ?>"  ondblclick='document.getElementById("zz<?php echo $key['id_tecnica']; ?>").contentEditable = true;' 
					onblur=' var  u=$("#zz<?php echo $key['id_tecnica']; ?>").html();  
					var ides=<?php echo $key['id_tecnica']; ?>;
					var n="nombre_institucion";					 
					var valor1="<?php echo $key['nombre_institucion']?>";
					var valor2="zz<?php echo $key['id_tecnica']; ?>";
					cambiar(u,ides,n,valor1,valor2);  '><?php echo $key['nombre_institucion']?>
						
				</div> 
				<nav  id="zz<?php echo $key['id_tecnica']; ?>"  style="float: left; margin-left: 30px;margin-right: 8px">Abreviatura:</nav>
				<div   style="margin-left:  28px" id="ooo<?php echo $key['id_tecnica']; ?>"  ondblclick='document.getElementById("ooo<?php echo $key['id_tecnica']; ?>").contentEditable = true;' 
						onblur=' var  u=$("#ooo<?php echo $key['id_tecnica']; ?>").html();  
						var ides=<?php echo $key['id_tecnica']; ?>;
						var n="abrevido";					 
						var valor1="<?php echo $key['abrevido']?>";
						var valor2="ooo<?php echo $key['id_tecnica']; ?>";
						cambiar(u,ides,n,valor1,valor2);  '><?php echo mb_convert_case(  $key['abrevido'] , MB_CASE_TITLE, "UTF-8")?>
							
				</div>
			</div> 
			<br id="b2<?php echo $key['id_tecnica']; ?>"> <?php
		} ?>
	</div>
	<button type="button" class=" btn-block btn-primary btn-lg" data-toggle="modal" data-target="#myModal"  >Nuevo titulo</button>
	<script type="text/javascript">
		function cambiar(u,ides,n,valor1,valor2){
			if (u!='') {
				$.ajax({   
					type: "post",
					data:{u,ides,n}, 
					url:"../../../ajax/rector/tecnica.php?action=actualizar",
					dataType:"text", 
					success:function(data){  
	           			mensaje7(3,'Registro Actualizado.');
						document.getElementById(valor2).contentEditable=false; 
					}  
				});
			}else{
				$('#'+valor2).html(valor1)
				mensaje7(2,'No se permite campos vacios.');
				document.getElementById(valor2).contentEditable=false; 
			} 
		}
	</script>	<?php
}
 

function eliminar(){
 

 	require '../conexion.php';

 	$consultar_nivel="SELECT *  FROM `tecnica_grado_sede`  WHERE `tecnica_grado_sede`.`id_tecnica` = ".$_POST['eliminar'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array()); 
	$inse=$consultar_nivel1->rowCount();

	if ($inse==0) {  
	 	$consultar_nivel="DELETE FROM `tecnicas`  WHERE `tecnicas`.`id_tecnica` = ".$_POST['eliminar'];
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());
	 	$consultar_nivel="DELETE FROM `competencias`  WHERE `competencias`.`id_tecnica` = ".$_POST['eliminar'];
		$consultar_nivel1=$conexion->prepare($consultar_nivel);
		$consultar_nivel1->execute(array());  
		echo $inse;
	}else{ 
		echo $inse;

	}

}


function agregar_tecnica(){ 

	 	require '../conexion.php';
 	$Abreviado=$_POST['Abreviado'];
 	$Institucion=$_POST['Institucion'];
 	$Titulo=$_POST['Titulo'];
 	$consultar_nivel="INSERT INTO `tecnicas` (`id_tecnica`, `nombre_tecnica`, `nombre_institucion`, `abrevido`) VALUES (NULL, '$Titulo', '$Institucion', '$Abreviado')";
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());

}

 function actualizar(){
 	require '../conexion.php';
 	$n=$_POST['n'];
 	$u=$_POST['u'];
 	echo$consultar_nivel="UPDATE `tecnicas` SET `$n` = '$u' WHERE `tecnicas`.`id_tecnica` = ".$_POST['ides'];
	$consultar_nivel1=$conexion->prepare($consultar_nivel);
	$consultar_nivel1->execute(array());

 }
?>
