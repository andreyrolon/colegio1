<?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
<header class="main-header" style=" " >
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"   ><b>I</b>BU</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"   ><b>IBU</b>soft</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img width="15"    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMzgyLjExNyAzODIuMTE3IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzODIuMTE3IDM4Mi4xMTc7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PHBhdGggZD0iTTMzNi43NjQsNDUuOTQ1SDQ1LjM1NEMyMC4zNDYsNDUuOTQ1LDAsNjUuNDg0LDAsODkuNXYyMDMuMTE3YzAsMjQuMDE2LDIwLjM0Niw0My41NTUsNDUuMzU0LDQzLjU1NWgyOTEuNDEgIGMyNS4wMDgsMCw0NS4zNTMtMTkuNTM5LDQ1LjM1My00My41NTVWODkuNUMzODIuMTE3LDY1LjQ4NCwzNjEuNzcyLDQ1Ljk0NSwzMzYuNzY0LDQ1Ljk0NXogTTMzNi43NjQsMjk3LjcySDQ1LjM1NCAgYy0zLjY3NiwwLTYuOS0yLjM4NC02LjktNS4xMDNWMTE2LjM1OWwxMzEuNzk3LDExMS4yN2MyLjcwMiwyLjI4Miw2LjEzOCwzLjUzOCw5LjY3NiwzLjUzOGwyMi4yNTksMC4wMDEgIGMzLjUzNiwwLDYuOTc0LTEuMjU3LDkuNjc3LTMuNTM5bDEzMS44MDMtMTExLjI3NHYxNzYuMjY0QzM0My42NjQsMjk1LjMzNiwzNDAuNDM5LDI5Ny43MiwzMzYuNzY0LDI5Ny43MnogTTE5MS4wNTksMTkyLjk4NyAgTDYyLjg3LDg0LjM5N2gyNTYuMzc4TDE5MS4wNTksMTkyLjk4N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiIHN0eWxlPSJmaWxsOiNGRkZGRkYiPjwvcGF0aD48L2c+IDwvc3ZnPg==" />
                        <?php if ($mensaje[0]>0) {  ?>
                            <span class="label label-success"><?php echo $mensaje[0] ?></span>
                        <?php } ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($mensaje[0]==0) {  ?>
                            <li class="header">No tienes mensajes nuevos</li>
                        <?php } ?>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                               <?php
                                foreach($mensaje[1] as $key){
                                    if ($key[3]!='' && $key['tabla_de']==5) {
                                        $nombre=$key[3]; 
                                        $foto=$key[4]; 
                                    }
                                    if ($key[5]!='' && ($key['tabla_de']==3 or $key['tabla_de']==2 or $key['tabla_de']==1 or $key['tabla_de']==4) ) {
                                        $nombre=$key[5];
                                        $foto=$key[6];
                                        
                                    }
                                    if ($key[7]!='' && $key['tabla_de']==6) {
                                        $nombre=$key[7];
                                        $foto=$key[8];

                                    }
                                    if ($foto=='') {
                                        $foto='../../../logos/usuario.png';
                                    }
 

                                    ?>
                                    <li>
                                        <!-- start message -->
                                        <a href="../mensajes/read-mail.php?id=<?php echo($key['id']); ?>">
                                            <div class="pull-left">
                                                <img src="<?php echo($foto); ?>" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                <?php echo($nombre ); ?>
                                                <small>
                                                    <i class="fa fa-clock-o"></i>
                                                    <?php $chat->formatearFecha($key['fecha']); ?>
                                                </small>
                                            </h4>
                                            <p><?php echo($key['asunto']); ?></p>
                                        </a>
                                    </li>
                                    <?php 
                                }
                                if (($_SESSION['Fot']=='' && $_SESSION['genero']==0) or  ($_SESSION['Fot']=='' && $_SESSION['genero']=='') ) {
                                    $fot='../../../logos/masculino.png';
                                }
                                if (($_SESSION['Fot']=='' && $_SESSION['genero']==1)  ) {
                                    $fot='../../../logos/femenino.png';
                                }
                                if ($_SESSION['Fot']!='' ) {
                                    $fot=$_SESSION['Fot'];
                                }
                                ?>
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="../mensajes/mailbox.php">Mostrar todo los mensajes</a></li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                 
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo($fot); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo($_SESSION['Nom_U']." "); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo($fot); ?>" class="img-circle" alt="User Image">

                            <p>
                               <?php echo($_SESSION['Nom_U']." ".$_SESSION['Ape_U']); ?>
                                <small>Docente</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="../perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="../../../codes/rector/cerrar.php" class="btn btn-default btn-flat">Cerrar sesion</a>
                            </div>
                        </li>
                    </ul>
                </li>
                
                <!-- Control Sidebar Toggle Button -->
                <li class="dropdown user user-menu" style="font-family: all;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></a>
                    
                    <ul class="dropdown-menu">
                        <?php 
                        $sty='';
                        if(isset($_SESSION['num'])){
                            $sty=$_SESSION['num'];
                           
                        }
                            
                        
                        $bacron1='';
                        $bacron2='';
                        $bacron3='';
                        $bacron4='';
                        $bacron5='';
                        $bacron6='';
                        $bacron10='';
                        $displa12='display:block;';
                        $displa11='display:none;';
                        if ($sty==1) {
                            $bacron10='margin-top: 10px;
                            border: solid 1px #e3e5ea;
                            text-align: -webkit-center;
                            background-color: #7a7a7a;';
                            $displa11='display:block;';
                            $displa12='display:none;';

                        }  
                        $gotica='';
                        $gotica12='display:block;';
                        $gotica11='display:none;';
                        if ($sty==2) {
                            $gotica='margin-top: 10px;
                            border: solid 1px #e3e5ea;
                            text-align: -webkit-center;
                            background-color: #7a7a7a;';
                            $gotica11='display:block;';
                            $gotica12='display:none;';

                        }
                        $cursiva0='';
                        $cursiva012='display:block;';
                        $cursiva011='display:none;';
                        if ($sty==3) {
                            $cursiva0='margin-top: 10px;
                            border: solid 1px #e3e5ea;
                            text-align: -webkit-center;
                            background-color: #7a7a7a;';
                            $cursiva011='display:block;';
                            $cursiva012='display:none;';

                        }
                        $cursiva1='';
                        $cursiva112='display:block;';
                        $cursiva111='display:none;';
                        if ($sty==4) {
                            $cursiva1='margin-top: 10px;
                            border: solid 1px #e3e5ea;
                            text-align: -webkit-center;
                            background-color: #7a7a7a;';
                            $cursiva111='display:block;';
                            $cursiva112='display:none;';

                        }
                        $cursiva2='';
                        $cursiva212='display:block;';
                        $cursiva211='display:none;';
                        if ($sty==5) {
                            $cursiva2='margin-top: 10px;
                            border: solid 1px #e3e5ea;
                            text-align: -webkit-center;
                            background-color: #7a7a7a;';
                            $cursiva211='display:block;';
                            $cursiva212='display:none;';

                        }

                        $gotica2='';
                        $gotica22='display:block;';
                        $gotica21='display:none;';
                        if ($sty==6) {
                            $gotica2='margin-top: 10px;
                            border: solid 1px #e3e5ea;
                            text-align: -webkit-center;
                            background-color: #7a7a7a;';
                            $gotica21='display:block;';
                            $gotica22='display:none;';

                        }
                      
                        if ($sty=='') {
                            $bacron1='background-color: #00000085;color:#fff;';

                        }
                        $bacron8='';
                        if ($sty==8) {
                            $bacron8='background-color: #00000085;color:#fff;';

                        }
                        if ($sty=='font-style: italic;') {
                            $bacron5='background-color: #00000085;color:#fff;';

                        }  
                        if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
                            $bacron6='background-color: #00000085;color:#fff;';

                        }   ?> 
                        <div style="padding: 10px">
                            <button type="button" class="form-control"   style="font-family:sans-serif;width: 100%; margin-top: 10px; <?php echo $bacron1; ?>" onclick=" var a='<?php echo '' ?>';  function_name(a);  ">Tipo de letra normal</button> 

 



                            <button  type="button" class="form-control"  style="width: 100%; margin-top: 10px;font-style: italic;<?php echo $bacron5; ?>" onclick=" var a='<?php echo 'font-style: italic;' ?>';  function_name(a);  ">Tipo de letra italiano 1</button>


                            <button type="button"  class="form-control"  style='width: 100%; margin-top: 10px;font: 1.256em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;<?php echo $bacron6; ?>' onclick=" var a='<?php echo 'font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;' ?>';  function_name(a);  ">Tipo de letra italiano 2</button>
                            <div style="margin-top: 10px;border: solid 1px #e3e5ea;    text-align: -webkit-center;<?php echo $bacron10 ?>
">

                                <img src="../../../logos/animada1.PNG" style=" <?php echo $displa12 ?>   width: 171px;" alt="" onclick='function_name(1);'>
                                <img src="../../../logos/animada1colorPNG.PNG" style=" <?php echo $displa11 ?>   width: 171px;"  alt="" onclick='function_name(1);'>
                            </div>
                            <div style="margin-top: 10px;border: solid 1px #e3e5ea;    text-align: -webkit-center;<?php echo $gotica ?>
">

                                <img src="../../../logos/gotica.PNG" style=" <?php echo $gotica12 ?>   width: 171px;" alt="" onclick='function_name(2);'>
                                <img src="../../../logos/gotica1.PNG" style=" <?php echo $gotica11 ?>   width: 171px;"  alt="" onclick='function_name(2);'>
                            </div>
                            <div style="margin-top: 10px;border: solid 1px #e3e5ea;    text-align: -webkit-center;<?php echo $gotica2 ?>
">

                                <img src="../../../logos/gotica2.PNG" style=" <?php echo $gotica22 ?>   width: 171px;" alt="" onclick='function_name(6);'>
                                <img src="../../../logos/gotica2c.PNG" style=" <?php echo $gotica21 ?>   width: 171px;"  alt="" onclick='function_name(6);'>
                            </div>
                            <div style="margin-top: 10px;border: solid 1px #e3e5ea;    text-align: -webkit-center;<?php echo $cursiva0 ?>
">

                                <img src="../../../logos/cursiva0.PNG" style=" <?php echo $cursiva012 ?>   width: 171px;" alt="" onclick='function_name(3);'>
                                <img src="../../../logos/cursiva0c.PNG" style=" <?php echo $cursiva011 ?>   width: 171px;"  alt="" onclick='function_name(3);'>
                            </div>
                            <div style="margin-top: 10px;border: solid 1px #e3e5ea;    text-align: -webkit-center;<?php echo $cursiva1 ?>
">

                                <img src="../../../logos/cursiva1.PNG" style=" <?php echo $cursiva112 ?>   width: 171px;" alt="" onclick='function_name(4);'>
                                <img src="../../../logos/cursiva1c.PNG" style=" <?php echo $cursiva111 ?>   width: 171px;"  alt="" onclick='function_name(4);'>
                            </div>
                            <div style="margin-top: 10px;border: solid 1px #e3e5ea;    text-align: -webkit-center;<?php echo $cursiva2 ?>
">

                                <img src="../../../logos/cursiva2.PNG" style=" <?php echo $cursiva212 ?>   width: 171px;" alt="" onclick='function_name(5);'>
                                <img src="../../../logos/cursiva2c.PNG" style=" <?php echo $cursiva211 ?>   width: 171px;"  alt="" onclick='function_name(5);'>
                            </div>
                            <button  type="button" class="form-control"  style="width: 100%; margin-top: 10px;font-family: cursive;<?php echo $bacron8; ?>" onclick=" var a='<?php echo 'font-style: italic;' ?>';  function_name(8);  ">Tipo de letra cursiva 3</button>
                                <br>
                        </div> 
                    </ul>
                </li>
                </ul>
        
            <script type="text/javascript">
                function function_name(a) {
                  
                   $.ajax({   
                        type:"post",
                        data:{a}, 
                        url:"../../../ajax/rector/horario.php?action=sesion",
                        dataType:"text", 
                        success:function(data){ 
                        window.location.assign( window.location.href);  
                        }
                    }); 
                }
            </script>
        </div>

    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <form action="#" method="get" class="sidebar-form">
                <div style="color: #fff;text-align: center;width:100% ">Institución Educativa Colegio <br> Pablo Correa Leon</div>
            </form>

            <center><img src="../../../logos/foto4.png" alt="" style="width: 73%; /*margin-left:24px;*/" class="img-responsive"></center>

        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <style>
            #asw:hover{
                border-left-color: #3c8dbc;
            }
        </style>
        <ul class="sidebar-menu" data-widget="tree">
            <li><a id="asw" href="../carga_academica/carga_academica.php"><i class="fa fa-graduation-cap"></i> <span>Carga de notas</span></a></li>
            <li><a id="asw" href="../carga_academica/carga_nivelacion.php"><i class="fa fa-eraser"></i> <span>Nivelaciones</span></a></li>
            <li><a id="asw" href="../logros/administracion_logros.php"><i class="fa fa-pencil-square-o"></i> <span>Administrar Logros</span></a></li> 
            

            
            <li><a id="asw"  href="../archivo/archivo.php"><i class="fa fa-copy"></i> <span>Trabajos</span></a></li>
            <li><a id="asw"  href="../examen/examen.php"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Examén</span></a></li>
            <li><a id="asw"  href="../foro/foro.php"><i class="fa fa-users"></i> <span>Foro</span></a></li>
            <li><a id="asw"  href="../estadisticas/estadisticas.php"><i class="fa fa-bar-chart-o"></i> <span>Estadisticas</span></a></li>
 


            <?php if (isset($_SESSION['habilitar_asistencia'])==1) {?>

                <li><a id="asw"  href="../asistencia/asistencia.php"><i class="fa fa-check-square"></i> <span>Asistencia</span></a></li> 
                <?php
            } ?>


            <?php if (isset($_SESSION['habilitar_asistencia'])==1) {?>

                <li><a href="../reconocimiento/reconocimiento.php" ><i class="fa fa-trophy"></i> <span>rerconocimento</span></a></li>
                <?php
            } ?>
            
 


 
            <li><a id="asw"  href="../obserador/observardor.php"><i class="fa fa-eye"></i> <span>Observador</span></a></li>
             <?php if (isset($_SESSION['contador'])==1) {?>

                <li><a id="asw"  href="../boletin/boletin.php"><i class="fa fa-newspaper-o"></i> <span>Boletines  </span></a></li> 
                <?php
            } ?>
            <li><a id="asw"  href="../mensajes/mailbox.php"><i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
            <li><a id="asw"  href="../horario/horario.php"><i class="fa fa-calendar-times-o"></i> <span>Horario</span></a></li>
            
            
 

<li class=" treeview  ">
                <a id="asw"  href="#">
                     <i class="fa fa-folder-open-o"></i> <span>Archivos</span> 
                    <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                    </span> 
                             
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
    
     
 
 
                             
                        <li><a id="asw"  href="../archivo/manual_convivencia.php"><i class="fa fa-circle-o"></i> Manual De Convivencia</a></li>
                                <li><a id="asw"  href="../archivo/manual_evaluacion.php"><i class="fa fa-circle-o"></i> S.I.E.E</a></li> 
                                <li><a id="asw"  href="../archivo/pie.php"><i class="fa fa-circle-o"></i> P.I.E.</a></li>  
                                <li><a id="asw"  href="../archivo/plan_area.php"><i class="fa fa-circle-o"></i>Plan De Area</a>
                                </li><li><a id="asw"  href="../archivo/plan_aula.php"><i class="fa fa-circle-o"></i>Plan De Aula</a>
                                </li><li><a id="asw"  href="../archivo/general.php"><i class="fa fa-circle-o"></i>Generales</a>
                                </li><li><a  id="asw" href="../archivo/mio.php"><i class="fa fa-circle-o"></i>Mis archivos</a>
                                </li>
                        
                    
                </ul>
            </li>





            <li class=""><a href="../permisos/permisos.php"><img style="width: 18px;margin-right: 10px" src="data:image/svg+xml;base64,&#10;PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTk4LjA0IDE5OC4wNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTk4LjA0IDE5OC4wNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48cGF0aCBkPSJNMTgwLjcyNywxOC40MDFjLTAuMzE4LTIuMTA5LTEuOTQtMy43ODUtNC4wMzgtNC4xNzFMOTkuOTI2LDAuMDgzYy0wLjYtMC4xMS0xLjIxMy0wLjExLTEuODEzLDBMMjEuMzUsMTQuMjMgIGMtMi4wOTgsMC4zODYtMy43MiwyLjA2Mi00LjAzOCw0LjE3MWMtMC4zMjgsMi4xNjktNy44NDEsNTMuNjM1LDcuMjU4LDk4LjE1N2MxNS4yOCw0NS4wNTYsNjkuNTAxLDc5LjI4OSw3MS44MDIsODAuNzI0ICBjMC44MSwwLjUwNSwxLjcyOSwwLjc1OCwyLjY0NiwwLjc1OHMxLjgzNy0wLjI1MiwyLjY0Ni0wLjc1OGMyLjMwMS0xLjQzNSw1Ni41MjItMzUuNjY4LDcxLjgwNC04MC43MjQgIEMxODguNTY5LDcyLjAzNiwxODEuMDU1LDIwLjU3LDE4MC43MjcsMTguNDAxeiBNOTkuMDIsOTcuNDMzSDM1LjIxNWMtNy41MDgtMzMuNDE0LTIuMjc5LTY3LjQxMy0yLjI3OS02Ny40MTNMOTkuMDIsMTguMDhWOTcuNDMzeiAgIE0xNTkuMDM1LDExMC44ODFjLTEyLjgxMiwzNy4wMzctNjAuMDE1LDY1LjkwNi02MC4wMTUsNjUuOTA2Vjk3LjQzM2g2My44MDVDMTYxLjgwOSwxMDEuOTU1LDE2MC41NjIsMTA2LjQ2NiwxNTkuMDM1LDExMC44ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjRkJGNkY2Ij48L3BhdGg+PC9nPiA8L3N2Zz4="><span>Permisos</span></a></li>
            <li class=""><a href="../perfil/perfil.php"><i class="fa fa-user"></i> <span>perfil</span></a></li> }
            <li class=""><a href="../../../codes/rector/cerrar.php"><i class="fa fa-circle-o text-aqua"></i> <span>Salir</span></a></li> 
            <li class=""><a href="../../../codes/rector/cerrar.php">  <span> </span></a></li> 
            
        </ul><br>  
    </section>
    <!-- /.sidebar -->
</aside>