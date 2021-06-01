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

 
function ver(){
    $con=0; 
    $apellido='';
    $nombre='';
    include '../conexion.php'; 
    $ano=date('Y'); 
    if(isset($_POST['id_grado'])){
    
        $id_js=$_POST['id_jornada_sede'];
        $id_g=$_POST['id_grado'];
        $id_c=$_POST['id_curso'];
        $periodo=$_POST['periodo'];
   

        $consultar_nivel="SELECT sum(materia_por_periodo.nota) as r, alumnos.foto, alumnos.nombre,alumnos.apellido,alumnos.genero,informeacademico.id_informe_academico,informeacademico.estado_aprovado from alumnos,informeacademico,materia_por_periodo WHERE  informeacademico.ano=$ano and   informeacademico.id_grado='$id_g' and informeacademico.id_curso='$id_c' and informeacademico.id_jornada_sede='$id_js' and alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico  and  materia_por_periodo.periodo=$periodo  GROUP by informeacademico.id_informe_academico ORDER BY `r` DESC limit 5";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $sql2=$consultar_nivel1->fetchAll();
        $nroProductos=$consultar_nivel1->rowCount();
        $ry=0;
     

        
        if ($nroProductos>0) { 
            ?>
            <style type="text/css">
                .img-circle{
                width: 65px;
                height: 80px;
            }
            .img-circle:hover{
                margin-left: 20px;margin-right: 20px;
                width: 100px; 
                height: 123px;
            }

            </style>

            <div class=" table-responsive" style="padding: 10px">
              
                <form action="mencion_honor2.php" method="get" target="_blank">

                     <div class="modal fade in" id="my" style="background-color: rgba(3, 64, 95, 0.3); ">
                      <div class="modal-dialog modal-lg">  
                        <div class="modal-content" style=" background-color: #fff;">
                          <div class="modal-header btn-primary table-responsive">
                            <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" style="color: #fff">×</button>
                            <h4 id="titulos" class="modal-title">Tabla De Modelos de mención de honor</h4>
                          </div>
                          <div class="table table-responsive" style="padding:10px;">
                            <table class="table table-hover">
                             <tr>
                               <th>Modelo</th>
                               <th>Seleccione</th> 
                             </tr>
                             <tr>
                               <td><img id="i" src="../../../mencion/ejemplos final/Nueva carpeta/puesto1.png"></td>
                               <td><input type="radio" name="seleccion" id="seleccion1" value="1"  checked></td> 
                             </tr>
                             <tr>
                               <td><img id="i" src="../../../mencion/ejemplos final/Nueva carpeta (2)/puesto1.png"></td>
                               <td><input type="radio" name="seleccion" id="seleccion2" value="2"></td> 
                             </tr>
                             <tr>
                               <td><img id="i" src="../../../mencion/ejemplos final/Nueva carpeta (3)/puesto1.png"></td>
                               <td><input type="radio" name="seleccion" id="seleccion3" value="3"></td> 
                             </tr>
                             <tr>
                               <td><img id="i" src="../../../mencion/ejemplos final/Nueva carpeta (4)/puesto1.png"></td>
                               <td><input type="radio" name="seleccion" id="seleccion4" value="4"></td> 
                             </tr>
                             <tr>
                               <td><img id="i" src="../../../mencion/niño1.png"></td>
                               <td><input type="radio" name="seleccion" id="seleccion5" value="5"></td> 
                             </tr>
                             <tr>
                               <td><img id="i" src="../../../mencion/niño3.png"></td>
                               <td><input type="radio" name="seleccion" id="seleccion6" value="6"></td> 
                             </tr>
                           </table>
                          </div>

                          <div class="modal-footer">  
                            <button type="button" style="width: 100%" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                             
                          </div> 

                        </div>
                      </div>
                    </div> 
                    <table class=" table table-hover">
                        <tr>
                           <th>Puesto</th>
                           <th style="margin-left: 40px;margin-right: 40px"><center>Foto</center></th>
                           <th>Nombre</th>
                           <th>Estado</th>

                          
                      
        	                            <th>
        			                        <center><button  id="idw" onclick="
                                            var text='<?php echo $separado_por_comas ?>';descargar(text)"  style=' width: 150px 'class="form-control"><span class="icon"><i class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"><span> Todos</span></span></button></center>
        			                    </th>
        	                
                            
                        </tr> 
                        <?php
                        $contador=0;
                        $i=0;
                        foreach ($sql2 as $key) {  
                        		$r=$con++;  
        	                	$foto=$key['foto'];
        	                	$e=$r+1;
        	                	$var1=$key['r'];
        	                	$ry=$var1;
        	                	if ($key['r']< $ry) {
        	                		$i=$e; $ry=$key['r'].'<br>';
        	                	}else{
        	                		 $ry=$key['r'].'<br>';
        	                		$i=1;
        	                	}
        	                	if($key['foto']=='' && $key['genero']=='1'){
        	                		$foto='../../../	logos/niña.jpg';
        	                	}  
        	                	if($key['foto']=='' && $key['genero']=='0')
        	                	{
        	                		$foto='../../../logos/niño.jpg';
        	                	}if ($key['foto']!='') {
        	                		# code...
        	                	}
                                        ?>
                                <input type="hidden" name="nombre<?php echo $e   ?>" value="<?php  echo $nom=mb_convert_case($key['nombre'].' '.$key['apellido'], MB_CASE_TITLE, "UTF-8") ?>">
                                <tr id="op">
                                    <td><?php echo $e   ?></td>
                                    <td>
                                        <img  class="profile-user-img img-responsive img-circle" src="<?php echo $foto;  ?>" alt="User profile picture"> 
                                    </td>

                                    <td>    
                                        <?php  echo $nom ?>   
                                    </td>

                                    <td><?php 
                                        if ($key['estado_aprovado']==-1  ) {
                                            echo "Retirado";
                                        }
                                        if ($key['estado_aprovado']==-2  ) {
                                            echo "Desertor";
                                        }
                                        if ($key['estado_aprovado']==0  ) {
                                            echo "cursando";
                                        }
                                     ?></td>
                                     <td>
                                        <center>
                                            <button onclick="var puesto=<?php echo $e   ?>;  var nom='<?php echo $nom ?>'; descarga(nom,puesto)" id="idw"  style=' width: 110px'class="form-control"><span class="icon"><i class="fa fa-download fa-lg"></i></span><span data-label="Descargar boletines primer periodo del curso" class="is-dark is-top is-medium b-tooltip" style="transition-delay: 0ms;"> </span></button>
                                        </center>
                                     </td>
                                     
                                     
                                <tr><?php  
                        } ?>
                    </table>
                </form>
            </div> <?php  
        }else{
            ?> 
            <div class="alert" role="alert" style="height:100px;margin-left: 20px;margin-right: 20px; color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Alerta!</strong> <br>No se encuentra alumnos registrados. </div>
            <script>
                document.getElementById('b').style.display='none';
            </script>
            <?php
        }
    }
    else{
            ?> 
            <div class="alert" role="alert" style="height:100px;margin-left: 20px;margin-right: 20px; color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Alerta!</strong> <br>No se encuentra alumnos registrados. </div>
            <script>
                document.getElementById('b').style.display='none';
            </script>
            <?php
    }
}

?>