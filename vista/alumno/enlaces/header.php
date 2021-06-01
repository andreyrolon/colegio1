<style>
    .sidebar::-webkit-scrollbar{
width: 7px;


    }
    .sidebar::-webkit-scrollbar-thumb{
    border-radius: 3px;
    background-color: #367fa9;


    }
.sidebar{
    height: 682px;
    overflow: auto;
}

   @media only screen and (max-width: 1700px) {
  .sidebar { 
    height:650px;
                                overflow: auto;
  }
}  
    @media only screen and (max-width: 1500px) {
  .sidebar { 
    height: 580px;
                                overflow: auto;
  }
}
       @media only screen and (max-width: 1400px) {
  .sidebar {
 
    
    height: 519px;
                                overflow: auto;
  }
}
       @media only screen and (max-width: 1200px) {
  .sidebar {
 
    
    height: 440px;
                                overflow: auto;
  }
}
</style>
 
    
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
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
                                        <a href="../mensajeria/abrir_mensaje.php?id=<?php echo($key['id']); ?>">
                                            <div class="pull-left">
                                                <img src="<?php echo($foto); ?>" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                <?php echo($nombre ); ?>
                                                <small><i class="fa fa-clock-o"></i><?php echo($chat->formatearFecha($key['fecha'])); ?></small>
                                            </h4>
                                            <p><?php echo($key['asunto']); ?></p>
                                        </a>
                                    </li>
                                    <?php 
                                }
                                if (($_SESSION['Foto']=='' && $_SESSION['genero']==0) or  ($_SESSION['Foto']=='' && $_SESSION['genero']=='') ) {
                                    $fot='../../../logos/niño.jpg';
                                }
                                if (($_SESSION['Foto']=='' && $_SESSION['genero']==1)  ) {
                                    $fot='../../../logos/niña.jpg';
                                }
                                if ($_SESSION['Foto']!='' ) {
                                    $fot=$_SESSION['Foto'];
                                }
                                ?>
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="../mensajeria/recividos.php">Mostrar todo los mensajes</a></li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                 
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo($fot); ?>" class="user-image" alt="User Image" style='width: 24px;
    height: 26px;'>
                        <span class="hidden-xs"><?php echo($_SESSION['Nom_U']." "); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo($fot); ?>" class="img-circle" alt="User Image" style='width: 88px;
    height: 111px;'>

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
                        if(isset($_SESSION['fant'])){
                            $sty=$_SESSION['fant'];
                           
                        }else{
                            $sty='';
                        }
                        $bacron1='';
                        $bacron2='';
                        $bacron3='';
                        $bacron4='';
                        $bacron5='';
                        $bacron6='';
                        if ($sty=='font-family:serif') {
                            $bacron3='background-color: #00000085;color:#fff;';

                        }
                        if ($sty=='font-family:cursive') {
                            $bacron2='background-color: #00000085;color:#fff;';

                        }
                        if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
                            $bacron4='background-color: #00000085;color:#fff;';

                        } 
                        if ($sty=='') {
                            $bacron1='background-color: #00000085;color:#fff;';

                        }
                        if ($sty=='font-style: italic;') {
                            $bacron5='background-color: #00000085;color:#fff;';

                        }  
                        if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
                            $bacron6='background-color: #00000085;color:#fff;';

                        }   ?> 
                        <div style="padding: 10px">
                            <button type="button" class="form-control"   style="font-family:sans-serif;width: 100%; margin-top: 10px; <?php echo $bacron1; ?>" onclick=" var a='<?php echo '' ?>';  function_name(a);  ">Tipo de letra normal</button> 


                            <button  type="button" class="form-control"  style="width: 100%; margin-top: 10px;font-family: serif;<?php echo $bacron3; ?>" onclick=" var a='<?php echo 'font-family:serif' ?>';  function_name(a);  ">Tipo de letra serif</button>


                            <button type="button" class="form-control"   style="width: 100%; margin-top: 10px;font-family: cursive;<?php echo $bacron2; ?>" onclick=" var a='<?php echo 'font-family:cursive' ?>';  function_name(a);  ">Tipo de letra cursive 1</button>  

                            <button  class="form-control"  style="width: 100%; margin-top: 10px;font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;<?php echo $bacron4; ?>" onclick=" var a='<?php echo 'font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;' ?>';  function_name(a);  ">Tipo de letra cursive 2</button> 



                            <button  type="button" class="form-control"  style="width: 100%; margin-top: 10px;font-style: italic;<?php echo $bacron5; ?>" onclick=" var a='<?php echo 'font-style: italic;' ?>';  function_name(a);  ">Tipo de letra italiano 1</button>


                            <button type="button"  class="form-control"  style='width: 100%; margin-top: 10px;font: 1.256em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;<?php echo $bacron6; ?>' onclick=" var a='<?php echo 'font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;' ?>';  function_name(a);  ">Tipo de letra italiano 2</button>

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
                        }
                    }); 
                            window.location.assign( window.location.href); 
                }
            </script>
        </div>

    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="">
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
        <ul class="sidebar-menu" data-widget="tree">
            <li><a id="asw" href="../carga/caraga.php"><i class="fa fa-graduation-cap"></i> <span>Mis notas</span></a></li>
            <li><a id="asw" href="../carga/nivelaciones.php"><i class="fa fa-eraser"></i> <span>Nivelaciones</span></a></li>
            <li><a id="asw" href="../archivo/archivo.php"><i class="fa fa-copy"></i> <span>Guias</span></a></li>
            <li><a id="asw" href="../archivo/horario.php"><i class="fa fa-calendar-times-o"></i> <span>Horario</span></a></li>
            <li><a href="../foro/foro.php"><i class="fa fa-users"></i> <span>Foro</span></a></li>
            <li><a href="../examen/examen.php"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Examen</span></a></li>
            <li><a id="asw" href="../mensajeria/recividos.php"><i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
            <li><a id="asw" href="../mensajes/mailbox.php"><i class="fa  fa-archive"></i> <span>Votacion</span></a></li>

            <li><a id="asw" href="../estadisticas/estadisticas.php"><i class="fa fa-bar-chart-o"></i> <span>Estadisticas</span></a></li>
            <li class=""><a href="../perfil/perfil.php"><i class="fa fa-user"></i> <span>perfil</span></a></li>
            <li><a href="../../../codes/rector/cerrar.php"><i class="fa fa-circle-o text-aqua"></i> <span>Salir</span></a></li> 


        </ul>
    </section>
    <!-- /.sidebar -->
</aside> 