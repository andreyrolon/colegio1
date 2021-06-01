
<style>

 
 
    body::-webkit-scrollbar{
width: 0px;


    }
    #sapo::-webkit-scrollbar{
width: 6px;


    }
    #sapo::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #3c8dbc;


    }
    #sapo{
    	height: 664px;
                                overflow: auto;
    }
  
	  
    @media only screen and (max-width: 1700px) {
  #sapo { 
    height:670px;
                                overflow: auto;
  }
}  
    @media only screen and (max-width: 1500px) {
  #sapo { 
    height: 591px;
                                overflow: auto;
  }
}
       @media only screen and (max-width: 1400px) {
  #sapo {
 
    
    height: 527px;
                                overflow: auto;
  }
}
       @media only screen and (max-width: 1200px) {
  #sapo {
 
    
    height: 400px;
                                overflow: auto;
  }
}

.pino{
	    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#pa{
	   padding: 10px
}
  
</style>
<?php
session_start();
 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../login.php");
    }
include  "../../../codes/alumno/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']); 

        $p=$_SESSION['numero'];
 
    if (isset($_GET['p'])) {
        $p=$_GET['p'];
    }

$horario=$chat->horario(); 
$horario_t=$chat->horario_t(); 
 
 
include('../enlaces/head.php');
 
?>

 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  

<body class="hold-transition skin-blue sidebar-mini"  >
 
    <div class="wrapper" class="form-control"  >
    <?php include('../enlaces/header.php');   ?> 
        <div class="content-wrapper" style="    min-height: auto;
" >  
        


                
                                             
                    <section   >
                        <div ><br>
                        	<div id="sapo" ><?php   ?>
                        		<div class="col-md-12">
                        			<div  class="pino" > 
                        				<div style="background-color: #00a7d0;padding: 5px;color: #fff"> 
                        					<div style="float: left;">  <img src="../../../img_alumno/calendar.png" alt="" style="width: 71px">  </div>
                        					<div style="float:  ;"><strong style="margin-left: 10px">HORARIO:  <?php echo $_SESSION['sede'] ?> <?php echo $_SESSION['jornada'] ?></strong></div><strong style="margin-left: 10px">Curso:<?php echo $_SESSION['grado'] ?>-<?php echo $_SESSION['curso'] ?> </strong>
                        				</div>
                        				<div   class="  box box-info"  style="padding: 10px" >


	                                    	<?php 
	                                    	 $variable=array('color: #886ab5;border: solid 1px #886ab5;','color: #007bff ;border: solid 1px #007bff ;','color: #dc3545 ;border: solid 1px #dc3545 ;','color: #28a745;border: solid 1px #28a745;','color: #fd3995;border: solid 1px #fd3995;','color: #505050;border: solid 1px #505050;','color: #ffc241;border: solid 1px #ffc241;','color: #1dc9b7;border: solid 1px #1dc9b7;','color: #bd1bb8;border: solid 1px #bd1bb8;','color: #5bc0de;border: solid 1px #5bc0de;','color: #717073;border: solid 1px #717073;','color: #587ea3;border: solid 1px #587ea3;','color: #dc6008;border: solid 1px #dc6008;','color: #3c8dbc;border: solid 1px #3c8dbc;','color: #886ab5;border: solid 1px #886ab5;','color: #d09de0;border: solid 1px #d09de0;','color: #4f07ffcf;border: solid 1px #4f07ffcf;','color: #117a65;border: solid 1px #117a65;','color: #a9cce3;border: solid 1px #a9cce3;','color: #A98307;border: solid 1px #A98307;');
											$variableS=array('background-color: #886ab5;color:#fff','background-color: #007bff;color:#fff','background-color: #dc3545;color:#fff','background-color: #28a745;color:#fff','background-color: #fd3995;color:#fff','background-color: #505050;color:#fff','background-color: #ffc241;color:#fff','background-color: #1dc9b7;color:#fff','background-color: #bd1bb8;color:#fff','background-color: #5bc0de;color:#fff','background-color: #717073;color:#fff','background-color: #587ea3;color:#fff','background-color: #dc6008;color:#fff','background-color: #3c8dbc;color:#fff','background-color: #886ab5;color:#fff','background-color: #d09de0;color:#fff','background-color: #4f07ffcf;color:#fff','background-color: #117a65;color:#fff','background-color: #a9cce3;color:#fff','background-color: #A98307;color:#fff');
											$w=0; 

											for ($w=1; $w <20 ; $w++) { 
											 	?>
												<style type="text/css">
												 	#t<?php echo $w  ?>	{
														<?php echo $variable[$w] ?>
												 	}
										 		</style>
												<style type="text/css">
													#t<?php echo $w  ?>:hover	{
														<?php echo $variableS[$w] ?>
												 	}
												</style><?php
											}
											$i=1;
	                                    	foreach ($horario as $key) {
	                                    		?>
	                                    		<style type="text/css">
	                                    			 
	                                    			#we<?php echo $key['id_area']; ?>{
										    			z-index:1;
										    			<?php   echo $variable[$i]  ?>
										    		}
										    		#we<?php echo $key['id_area']; ?>:hover{
										    			z-index:1;
										    			<?php   echo $variableS[$i]  ?>
										    		}
	                                    		</style>
	                                    		<div id="t<?php echo $i++; ?>" style="border-radius: 5px; display: inline-block;   padding: 5px; margin-right: 10px; margin-top: 10px;  width: 185px; text-align: center;  "><center><?php echo $key['nombre']; ?> </center></div>
	                                    		<?php
	                                    	}
	                                    	foreach ($horario_t as $key) {
	                                    		if ($key['dia']=1) {
	                                    			$dia='Lunes';
	                                    		}
	                                    		if ($key['dia']=2) {
	                                    			$dia='Martes';
	                                    		}
	                                    		if ($key['dia']=3) {
	                                    			$dia='Miercoles';
	                                    		}
	                                    		if ($key['dia']=4) {
	                                    			$dia='Jueves';
	                                    		}
	                                    		if ($key['dia']=5) {
	                                    			$dia='Viernes';
	                                    		}
	                                    		if ($key['dia']=6) {
	                                    			$dia='Sabado';
	                                    		}
	                                    		if ($key['dia']=7) {
	                                    			$dia='Domingo';
	                                    		}
	                                    		?>
	                                    		 
	                                    		<div id="t<?php echo $i++; ?>" style="border-radius: 5px; display: inline-block;   padding: 5px; margin-right: 10px; margin-top: 10px;    text-align: center;  "><center>  <?php echo $key['nombre']; ?>/Dia: <?php echo $dia; ?>/Hora inicio: <?php echo $key['hora_inicio']; ?>/Hora fin: <?php echo $key['hora_fin']; ?></center></div>
	                                    		<?php
	                                    	}
	                                    	 ?>
	                                        
	                                    </div> 
	                                </div>
	                            </div>
	                            <div class="col-md-12 " style=""id="pa">
	                                <div class="pino"   >
		                                <div  class=" table-responsive box box-primary  " id="pa" >
		                                	        <style>
												tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      }
											    td,th{
											    	border:solid #d5d5d5 2px ;

												}
											</style>
											 
											<button style=" " type="button" value="Imprime esta pagina" class="btn btn-danger" onclick=" 


											  var ficha=document.getElementById('sapo');
											  var ventimp=window.open(' ','popimpr');
											  ventimp.document.write(ficha.innerHTML);
											  ventimp.document.close();
											  ventimp.print();
											  ventimp.close();
											">
									            <i class="fa  fa-file-pdf-o"></i>  Descargar Horario  
									        </button><br><br>
											<style>
												tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      }
											    td,th{
											    	border:solid #d5d5d5 2px ;

												}
											</style>
											 
											<table id="table" class=" table table-hover">
										                                	 
										                                 
												<tr style="border:solid #d5d5d5 2px ;background: #EEE;">
													<th style="width: 50px;">Horas</th>
													<th>Lunes</th>
													<th>Martes</th>
													<th>Miercoles</th>
													<th>Jueves</th>
													<th>Viernes</th>
													<th>Sabado</th>
													<th>Domingo</th>
												</tr>
												<?php 
												for ($i=1; $i <10 ; $i++) { ?>
													<tr>
														<td style="width: 10px;"><strong><?php echo $i ?></strong></td>
														<?php
														for ($o=1; $o <8 ; $o++) {
															
															?> 
															
															<td style="width: 80px ;height: 40px; ">
																<?php 

																 $chat->horario2($o,$i);  ?>
															</td>
															<?php

														} ?>
													</tr> <?php
												} ?>
											</table>		                                      
		                                </div>
		                            </div>
	                            </div>
	                            <br><br>
	                            <div class="col-md-12 main" style=" background-color: #fff"><br>
	                            	<div  >
							            <div class="pull-right -xs">
							                <b> IBUnotas</b> 1.0
							            </div>
							            <strong>Desarrollado por  IBUsoft. <br></strong> <br>
	                            	</div>
						        </div>

	                        </div> 

                        </div>
                    </section>
                </div>    
       
     <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 
<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
     
</body> 