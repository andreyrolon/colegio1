 
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>I</b>BU</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>IBU</b>NOTAS</span>
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
                        <i class="fa fa-envelope-o"></i>
                        <?php if($mensaje[0]>0){ ?>
                            
                                <span class="label label-success">
                                    <?php   echo $mensaje[0] ?>
                                </span>
                        <?php }  ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">  <?php if ($mensaje[0]==0) { echo "No tienes mensajes";} ?>  </li>
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
                                            <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            <?php echo($nombre." "); ?>
                                            <small><i class="fa fa-clock-o"></i><?php echo($chat->formatearFecha($key['fecha'])); ?></small>
                                        </h4>
                                        <p><?php echo($key['asunto']); ?></p>
                                    </a>
                                </li>
                                <?php 
                                }
                                ?>
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="../mensajes/mailbox.php">Ver todos los mensages</a></li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <?php 
                ?>
                <li class="dropdown user user-menu"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                         <img src="<?php echo  $FOTO=$_SESSION['foto'];

                              if(($FOTO=='' AND $_SESSION['genero']=='0') ){
                               echo $foto= '../../../logos/Masculino.png';
                              }
                              if($FOTO=='' AND $_SESSION['genero']=='1'){
                               echo $foto= '../../../logos/femenino.png';
                              }if($FOTO !=''){
                                echo $foto= $FOTO;
                              }
                            ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo( $_SESSION['Nom_U']); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo $foto;  ?>" class="img-circle" alt="User Image">

                            <p>
                               <?php echo($_SESSION['Nom_U']." ".$_SESSION['Ape_U']); ?>
                                <small><?php echo($_SESSION['Rol']) ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="../perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right" >
                                <a href="../../../codes/rector/cerrar.php" class="btn btn-default btn-flat">Cerra perfil</a>
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
        </div>
    
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

    </nav>
</header>
  <aside class="main-sidebar " style="">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <!-- Sidebar user panel -->
     
        <div class="user-panel">
            <form action="#" method="get" class="sidebar-form">
                <div style="color: #fff;text-align: center;width:100% ">Institución Educativa   <br> Pablo Correa Leon</div>
            </form>

            <center><img src="../../../logos/foto4.png" alt="" style="width: 73%; /*margin-left:24px;*/" class="img-responsive"></center>

        </div>
     
        <ul class="sidebar-menu tree" data-widget="tree"> 
        
            <li class=" treeview  ">
                <a href="#">
                    <i  ><img style="width: 20px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDY0IDQ2NCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDY0IDQ2NDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00NTYsMjE3LjEySDM1My42OHYtMTkuNzZjLTAuMDA1LTIuODg2LTEuNTY0LTUuNTQ2LTQuMDgtNi45NkwyNDAsMTI4LjhWOTcuNDRoMjEuNjh2MTEuOTJjMCw0LjQxOCwzLjU4Miw4LDgsOGg2NS4zNiAgICBjNC40MTgtMC4wMDIsNy45OTgtMy41ODUsNy45OTctOC4wMDNjMC0wLjkyNi0wLjE2Mi0xLjg0NS0wLjQ3Ny0yLjcxN0wzMzYsODhsNi42NC0xOC4yNGMxLjUwMi00LjE1NS0wLjY0OC04Ljc0MS00LjgwMy0xMC4yNDMgICAgYy0wLjg3MS0wLjMxNS0xLjc5LTAuNDc2LTIuNzE3LTAuNDc3aC0yOS43NnYtMTEuNmMwLTQuNDE4LTMuNTgyLTgtOC04SDI0MHYtOS43NmMwLTQuNDE4LTMuNTgyLTgtOC04cy04LDMuNTgyLTgsOHY5OS4xMiAgICBsLTEwOS42LDYxLjUyYy0yLjUxNiwxLjQxNC00LjA3NSw0LjA3NC00LjA4LDYuOTZ2MTkuNzZIOGMtNC40MTgsMC04LDMuNTgyLTgsOHYyMDkuMjhjMCw0LjQxOCwzLjU4Miw4LDgsOGg0NDggICAgYzQuNDE4LDAsOC0zLjU4Miw4LTh2LTIwOS4yQzQ2NCwyMjAuNzAyLDQ2MC40MTgsMjE3LjEyLDQ1NiwyMTcuMTJ6IE0zMDUuMzYsODkuNDRsLTAuMzItMC4zMlY3NS4zNmgxOC4yNEwzMjAsODUuNiAgICBjLTAuNjU1LDEuNzgyLTAuNjU1LDMuNzM4LDAsNS41MmwzLjc2LDEwLjI0aC00Ni4wOHYtMy45MmgxOS42OEMzMDEuNzc4LDk3LjQ0LDMwNS4zNiw5My44NTgsMzA1LjM2LDg5LjQ0eiBNMjQwLDU1LjQ0aDQ5LjM2ICAgIHYxMS45MnYxNC4wOEgyNDBWNTUuNDR6IE0xMTAuMzIsNDI2LjMySDE2di0xOTMuMmg5NC4zMlY0MjYuMzJ6IE0yMjQsNDI2LjMyaC00MnYtOTEuMzZoNDJWNDI2LjMyeiBNMjgyLDQyNi4zMmgtNDJ2LTkxLjM2aDQyICAgIFY0MjYuMzJ6IE0zMzgsNDI2LjMyaC00MHYtOTkuMzZjMC00LjQxOC0zLjU4Mi04LTgtOEgxNzRjLTQuNDE4LDAtOCwzLjU4Mi04LDh2OTkuMzZoLTQwdi0yMjRsMTA2LTU5LjY4TDMzNy42OCwyMDJsMC4zMiwyMy4wNCAgICBWNDI2LjMyeiBNNDQ4LDQyNi4zMmgtOTQuMzJ2LTE5My4ySDQ0OFY0MjYuMzJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0yMzIsMTY3LjEyYy0xOC41MjYsMC4wNDQtMzMuNTIsMTUuMDc0LTMzLjUyLDMzLjZjMC4wNDQsMTguNTEzLDE1LjA4NywzMy40ODQsMzMuNiwzMy40NCAgICBjMTguNTEzLTAuMDQ0LDMzLjQ4NC0xNS4wODcsMzMuNDQtMzMuNkMyNjUuNDc2LDE4Mi4wNzksMjUwLjQ4MSwxNjcuMTIsMjMyLDE2Ny4xMnogTTIzMiwyMTguMTYgICAgYy05LjY3Ni0wLjA0NC0xNy40ODQtNy45MjQtMTcuNDQtMTcuNmMwLjA0NC05LjYxMyw3LjgyNi0xNy4zOTYsMTcuNDQtMTcuNDRjOS42ODksMC4wNDQsMTcuNTIsNy45MTEsMTcuNTIsMTcuNmgwLjA4ICAgIEMyNDkuNTU2LDIxMC4zOTYsMjQxLjY3NiwyMTguMjA0LDIzMiwyMTguMTZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxyZWN0IHg9IjM1LjI4IiB5PSIyNTAuNzIiIHdpZHRoPSIxNiIgaGVpZ2h0PSIzMiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9yZWN0PgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cmVjdCB4PSI3NC43MiIgeT0iMjUwLjcyIiB3aWR0aD0iMTYiIGhlaWdodD0iMzIiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcmVjdD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHJlY3QgeD0iMTUwLjMyIiB5PSIyNTAuNzIiIHdpZHRoPSIzMiIgaGVpZ2h0PSIxNiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9yZWN0PgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cmVjdCB4PSIyMTYiIHk9IjI1MC43MiIgd2lkdGg9IjMyIiBoZWlnaHQ9IjE2IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3JlY3Q+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxyZWN0IHg9IjI4MS42OCIgeT0iMjUwLjcyIiB3aWR0aD0iMzIiIGhlaWdodD0iMTYiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcmVjdD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHJlY3QgeD0iMTUwLjMyIiB5PSIyODgiIHdpZHRoPSIzMiIgaGVpZ2h0PSIxNiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9yZWN0PgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cmVjdCB4PSIyMTYiIHk9IjI4OCIgd2lkdGg9IjMyIiBoZWlnaHQ9IjE2IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3JlY3Q+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxyZWN0IHg9IjI4MS42OCIgeT0iMjg4IiB3aWR0aD0iMzIiIGhlaWdodD0iMTYiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcmVjdD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHJlY3QgeD0iMzUuMjgiIHk9IjMxMy42OCIgd2lkdGg9IjE2IiBoZWlnaHQ9IjMyIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3JlY3Q+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxyZWN0IHg9Ijc0LjcyIiB5PSIzMTMuNjgiIHdpZHRoPSIxNiIgaGVpZ2h0PSIzMiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9yZWN0PgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cmVjdCB4PSIzNS4yOCIgeT0iMzc2LjcyIiB3aWR0aD0iMTYiIGhlaWdodD0iMzIiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcmVjdD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHJlY3QgeD0iNzQuNzIiIHk9IjM3Ni43MiIgd2lkdGg9IjE2IiBoZWlnaHQ9IjMyIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3JlY3Q+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxyZWN0IHg9IjM3My4yOCIgeT0iMjUwLjcyIiB3aWR0aD0iMTYiIGhlaWdodD0iMzIiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcmVjdD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHJlY3QgeD0iNDEyLjcyIiB5PSIyNTAuNzIiIHdpZHRoPSIxNiIgaGVpZ2h0PSIzMiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9yZWN0PgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cmVjdCB4PSIzNzMuMjgiIHk9IjMxMy42OCIgd2lkdGg9IjE2IiBoZWlnaHQ9IjMyIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3JlY3Q+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxyZWN0IHg9IjQxMi43MiIgeT0iMzEzLjY4IiB3aWR0aD0iMTYiIGhlaWdodD0iMzIiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcmVjdD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHJlY3QgeD0iMzczLjI4IiB5PSIzNzYuNzIiIHdpZHRoPSIxNiIgaGVpZ2h0PSIzMiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9yZWN0PgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cmVjdCB4PSI0MTIuNzIiIHk9IjM3Ni43MiIgd2lkdGg9IjE2IiBoZWlnaHQ9IjMyIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3JlY3Q+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" /></i> 
                    <span>Institución</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">13</span>
                    </span>
                </a>
                <ul class="treeview-menu"> 

                        <li><a href="../datos/mi_colegio.php"><i class="fa fa-circle-o"></i> Mi Colegio
                             
                        </a></li>
                         

                    <li class="treeview"> <a href="#"><i class="fa fa-circle-o"></i> Areas
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu"> 
                            <li><a href="../areas/ver_areas.php"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                            <li><a href="../areas/horas.php"><i class="fa fa-circle-o"></i> Hintensidad horaria</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview"> <a href="#"><i class="fa fa-circle-o"></i> grados
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../grado/id_grado.php"><i class="fa fa-circle-o"></i> Identificador</a></li>
                            <li><a href="../grado/nuevo_grado.php"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                            <li><a href="../grado/grado_por_materia.php"><i class="fa fa-circle-o"></i> Cargar areas</a>
                            </li>
                        </ul>
                    </li>

                        <li>
                        <a href="../sedes/ver_sede.php"><i class="fa fa-circle-o"></i> Sedes
                             
                        </a>
                            
                        </li>

                        <li>
                            <a href="../Jornadas/Jornadas.php"><i class="fa fa-circle-o"></i> Jornadas
                             
                        </a>
                        </li>
                    <li><a href="../curso/curso.php"><i class="fa fa-circle-o"></i> Cursos</a></li>
                       
                    <li class="treeview"> 
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Tecnicas
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../tecnicas/nueva_tecnica.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                            <li><a href="../tecnicas/competencias.php"><i class="fa fa-circle-o"></i> Competencia</a></li> 
                            <li><a href="../tecnicas/logros_tecnicas.php"><i class="fa fa-circle-o"></i> Logros</a></li> 
                        </ul>
                    </li>
                       
                    <li class="treeview"> 
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Carga Academica
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../carga/carga_academica_curso.php"><i class="fa fa-circle-o"></i> Curso</a></li>
                            <li><a href="../docente/carga_academica.php"><i class="fa fa-circle-o"></i> Maestro</a></li>  
                        </ul>
                    </li>
                       
                        <li>
                            <a href="../docente/titular.php">
                                <i class="fa fa-circle-o"></i> 
                                Titulares 
                            </a>
                        </li>
                    <li class="treeview"> 
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Horario
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../horario/horario_curso.php"><i class="fa fa-circle-o"></i> Curso</a></li>
                            <li><a href="../horario/docente.php"><i class="fa fa-circle-o"></i> Maestro</a></li> 
                        </ul>
                    </li>
 


                        <li>
                            <a href="../docente/jefes_area.php">
                                <i class="fa fa-circle-o"></i> 
                                Jefe de area 
                            </a>
                        </li>

                        <li>
                            <a href="../calendario/calendario.php">
                                <i class="fa fa-circle-o"></i> 
                                notificacion calendario  
                            </a>
                        </li>
                        <li class="treeview"> <a href="#"><i class="fa fa-folder-open-o"></i> Archivos
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../archivos/manual_convivencia.php"><i class="fa fa-circle-o"></i> Manual De Convivencia</a></li>
                                <li><a href="../archivos/manual_evaluacionphp.php"><i class="fa fa-circle-o"></i> S.I.E.E</a></li> 
                                <li><a href="../archivos/P_I_E.php"><i class="fa fa-circle-o"></i> P.I.E.</a></li>  
                                <li><a href="../archivos/PLAN_AREA.php"><i class="fa fa-circle-o"></i>Plan De Area</a>
                                <li><a href="../archivos/plan_aula.php"><i class="fa fa-circle-o"></i>Plan De Aula</a>
                                <li><a href="../archivos/generales.php"><i class="fa fa-circle-o"></i>Generales</a>
                                </li>
                            </ul>
                        </li>
                         
                    </li>
                </ul>
            </li>

            <li class=" treeview  ">
                <a href="#">
                    <i >
                        <img style="width: 20px;margin-right: 10px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDMwLjUwNCAzMC41MDQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMwLjUwNCAzMC41MDQ7IiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0xOC41MDIsMjIuNjU0Yy0wLjgxNC0wLjU0Ni03Ljc4NS01LjI5NC05LjY2NC04LjYxN2wtMC4xMDMtMC4xODNsLTAuMjEyLTAuMDA4Yy0xLjYxOC0wLjA2Ni0yLjg3NiwwLjg3LTMuNDE1LDEuMzU0ICAgIGMtMC4yMi0wLjIyMy0wLjQ0NC0wLjQ1Mi0wLjY3My0wLjY4OGwtMC4yNzMtMC4yOGwtMC4yNzEsMC4yODJjLTEuMDYxLDEuMTAxLTEuNTMsMi4xMjUtMS4zOTYsMy4wNDggICAgYzAuMTA5LDAuNzQ5LDAuNjIxLDEuNDAxLDEuNDgxLDEuODg4YzAuMTU1LDAuMDg4LDEuOTUsMS4zMDksMy45MDEsMi44NjdjLTAuMzM3LDAuMzQ0LTEuNTYyLDEuMTM3LTIuMDA2LDEuNDUzICAgIGMtMC40OTksMC4zNTQtMi41NzgsMi4yNDEtMi41NzgsMi4yNDFsMS4zNDMsMC4zMTdsMC40NjUsMC45MDhjMCwwLDAuNjM4LTEuNTYyLDEuMzM4LTIuMzMzczEuOTIzLTEuMzg3LDEuOTIzLTEuMzg3ICAgIHMtMC42NjEsMC45NDQtMS4xMzUsMS44NmMtMC40NzMsMC45MTYtMC41OTQsMi41MDQtMC41OTQsMi41MDRsMC44MjEtMC4yNmwwLjU2NiwxLjIzNGMwLDAsMC4xNTEtMS43NDQsMC40OTktMi44OCAgICBjMC4yODEtMC45MTksMC45Ny0xLjc5LDEuMjI2LTIuMDk1YzIuNDc0LDIuMTc4LDUuMDU5LDQuODA4LDUuNTc2LDUuMzM5YzAuMzEyLDAuMzU4LDAuNzE2LDAuNjIyLDEuMjQyLDAuNzM5ICAgIGMwLjE4OCwwLjA0MSwwLjM3OSwwLjA2MSwwLjU2NSwwLjA2MWMxLjA3LDAsMi4wODYtMC42NjcsMi43NC0xLjgzNWMwLjc2NC0xLjM1OSwwLjk3OS0zLjQ0OS0wLjM0Ny00LjgyMiAgICBDMTkuMTU4LDIyLjk4MiwxOC44MTQsMjIuNzY3LDE4LjUwMiwyMi42NTR6IE04LjAxMiwyMS40NTdjLTEuNzktMS40MDgtMy40MjMtMi41MjktMy42NjEtMi42NjQgICAgYy0wLjY1OS0wLjM3My0xLjAzMS0wLjgyNC0xLjEwNi0xLjM0Yy0wLjA4OC0wLjYwNiwwLjIyNC0xLjMyLDAuOTI4LTIuMTI2YzEuNzUxLDEuNzkyLDMuMjQ4LDMuMjE0LDQuNTE5LDQuMzQ1ICAgIEM4LjExNywyMC42MDUsOC4wMTYsMjEuMTA2LDguMDEyLDIxLjQ1N3ogTTkuMTI0LDE5LjA0MWMtMS4wMDktMC44OTctMi4xNjQtMS45ODQtMy40OC0zLjMwMmMwLjQ0Ny0wLjM5MSwxLjQzLTEuMTEsMi42NDctMS4xMzkgICAgYzAuNjM2LDEuMDQzLDEuNjksMi4xODgsMi44NzgsMy4yOTZDMTAuNTUxLDE3Ljk1OSw5Ljc3OSwxOC4yMjksOS4xMjQsMTkuMDQxeiBNOS44OTMsMjMuMDA0ICAgIGMwLjA2NC0wLjQ4NCwwLjIxNC0xLjE1MSwwLjU1Mi0xLjgzOGMyLjIyNiwxLjgxMywzLjQ5LDIuNDc2LDQuMDQzLDIuNzA5Yy0wLjA4NiwwLjYzOC0wLjIzMSwyLjEwOCwwLjAyMSwzLjQ1MiAgICBDMTMuMzE0LDI2LjE0NSwxMS41NTcsMjQuNDQ3LDkuODkzLDIzLjAwNHogTTE5LjIxMiwyNy44MTZjLTAuNDcxLDAuODM5LTEuMzcsMS42NS0yLjQ4MywxLjQwNCAgICBjLTEuOTExLTAuNDIyLTEuNjkyLTQuMTM1LTEuNDQ2LTUuNTNsMC4wNjItMC4zNTNsLTAuMzUxLTAuMDgyYy0wLjAxNS0wLjAwNC0xLjIwNC0wLjMzOC00LjE0Mi0yLjczNyAgICBjMC41NTItMC42NDIsMS40MzYtMC45MjksMi4xMDgtMS4wNTZjMS42NTksMS4zNzcsMy4zMTEsMi41NjcsNC4yOTgsMy4yNTZjLTAuMDMsMC4wMTUtMC4wNTgsMC4wMjktMC4wODMsMC4wNDUgICAgYy0xLjEzOCwwLjY0Ni0xLjYxMywyLjUxNS0xLjM2NiwzLjQxYzAuMjksMS4wNTMsMC45OTMsMS43MjksMS43MzMsMS43MTVjMC4zMTYtMC4wMTIsMS4wODYtMC4xOSwxLjM2Ny0xLjU5NmwwLjA0NC0wLjIxOSAgICBsLTAuMTY5LTAuMTQzYy0xLjA2OC0wLjkwOS0xLjY0Ni0xLjQ0Ni0xLjkyMi0xLjcxNWMwLjE3Ni0wLjM0MiwwLjQwOC0wLjYzOSwwLjY4Ny0wLjc5N2MwLjQyMy0wLjIzOCwwLjkwNC0wLjA4MiwxLjQzMywwLjQ2NyAgICBDMjAuMDM3LDI0Ljk4MywxOS44NDEsMjYuNjkzLDE5LjIxMiwyNy44MTZ6IE0xOC4xMTYsMjYuMzU4Yy0wLjEzMiwwLjQ3OS0wLjM1MywwLjc2Ny0wLjYwNCwwLjc3NGMtMC4wMDMsMC0wLjAwNywwLTAuMDEyLDAgICAgYy0wLjMxNCwwLTAuNzU1LTAuNDAxLTAuOTY0LTEuMTU5Yy0wLjA2Ny0wLjI0Mi0wLjA0OC0wLjYwMywwLjA0Mi0wLjk3OUMxNi44OTEsMjUuMjg3LDE3LjM4LDI1LjcyOSwxOC4xMTYsMjYuMzU4eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGQUZBIiBkYXRhLW9sZF9jb2xvcj0iI0FDQTZBNiI+PC9wYXRoPgoJCTxwYXRoIGQ9Ik01Ljk1OSw4LjYxMWwtMS4xOTYsMy44MzFjMCwwLDQuODg4LDAuNDc1LDguOTU4LDEuNzQ0YzQuMDcyLDEuMjcyLDguMzYxLDMuNjYzLDguMzYxLDMuNjYzbDEuMjE2LTMuODk5ICAgIGMwLDAtMy42NTMtMy42ODItOC4wMDQtNS4wNEMxMC45NDUsNy41NTMsNS45NTksOC42MTEsNS45NTksOC42MTF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0ZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjQUNBNkE2Ij48L3BhdGg+CgkJPHBhdGggZD0iTTMwLjUwNCwxNC4wMDhsLTEuNDIzLTEuNDkzbDAuMTQtMC40NTNjMCwwLDEuMjU0LTIuMzA2LTEuOTA0LTEuODhjLTAuMTY0LDAuMDMyLTAuMjYyLDAuMDg1LTAuMzE3LDAuMTUxbC05LjM5Ny05Ljg1MSAgICBMMCw0LjM2N2w0Ljg0MSw0LjMyNGwwLjI2LTAuODMzYzAsMCw1LjU2MS0xLjE3OSwxMC40MSwwLjMzNGM0Ljg1LDEuNTE1LDguOTI0LDUuNjIsOC45MjQsNS42MmwtMC40NTMsMS40NTNsMy42MzYtMC43MDIgICAgYy0wLjYwNiwxLjkzOC0xLjMwMiw0LjE3MS0xLjUxOSw0Ljg2MmwtMS4wMzUtMC4zMjRsLTAuNzUyLDIuNDA2bDEuNjc2LTAuNTIybDEuMjMyLDEuNDMxbDAuNzUtMi40MDZsLTEuMTE5LTAuMzUxbDEuNjQ0LTUuMjY2ICAgIEwzMC41MDQsMTQuMDA4eiBNMjguNDIsMTMuNDY5Yy0wLjEyNSwwLjQwMi0wLjU1MywwLjYyNi0wLjk1NSwwLjUwMWMtMC40MDItMC4xMjYtMC42MjctMC41NTMtMC41MDItMC45NTUgICAgYzAuMTI3LTAuNDAyLDAuNTU1LTAuNjI2LDAuOTU2LTAuNTAxUzI4LjU0NSwxMy4wNjgsMjguNDIsMTMuNDY5eiBNMjcuNzEsMTEuMDc3YzAuMzk3LTAuMTE4LDEuMDcxLTAuMjQsMC44OTIsMC4zMzQgICAgYy0wLjAxOCwwLjA1Ni0wLjA2NywwLjIxOC0wLjE0MywwLjQ1M0wyNy43MSwxMS4wNzd6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0ZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjQUNBNkE2Ij48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
                    </i> 
                    <span>Educación</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">11</small>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
    
     

                        <a href="#">
                            <i class="fa fa-circle-o"></i> Matriculas
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li><a href="../alumnos/aprobado.php"><i class="fa fa-circle-o"></i> Alumnos aprobados</a></li>
                            <li><a href="../alumnos/prematricula.php"><i class="fa fa-circle-o"></i> Prematricula</a></li>
                            <li><a href="../alumnos/matricula_antiguo.php"><i class="fa fa-circle-o"></i> Matricula antiguo</a></li> 
                            <li><a href="../alumnos/matricula_curso.php"><i class="fa fa-circle-o"></i>Matricula curso</a></li>  
                            <li><a href="../alumnos/crear_alumno.php"><i class="fa fa-circle-o"></i> matricula nuevos</a></li>
                        </ul>
                    </li>
                       <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Logros</a></li>
                             
                        
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Calificaciones
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="../validaciones/habilitar_notas.php"><i class="fa fa-circle-o"></i> Habilitar</a></li>
                                <li><a href="../calificaciones/nosta_por_saberes.php"><i class="fa fa-circle-o"></i> Saberes</a></li>
                                <li><a href="../calificaciones/notas_relleno.php"><i class="fa fa-circle-o"></i> Periodos</a></li> 
                            </ul>
                             
                             <li> <a href="../listas/listas.php"><i class="fa fa-circle-o"></i> Listas</a></li>
                             <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Historial del alumno</a></li>
                             <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Estadisticas</a></li>
                             <li> <a href="../boletines/boletines1.php"><i class="fa fa-circle-o"></i> Boletines</a></li>
                             <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Mencion de honor</a></li>
                             <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Actas de grado</a></li>
                             <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Constancia</a></li>
                             <li> <a href="../traslado/traslado.php"><i class="fa fa-circle-o"></i> Translado</a></li>
                        </li>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i  >
                        <img style="width: 20px;margin-right: 10px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTMxLjEyNCwxMS41OTJjLTAuNDgyLTIuMzY2LTAuMjMtNy4xOS03LjYzNC04LjgzMWMtMC4zNjUtMC4wODQtMC43NDMtMC4xNjMtMS4xNTMtMC4yMjkgICAgYy0wLjUwOS0wLjA4MS0xLjAxNC0wLjE0MS0xLjUxNC0wLjE4MmMtMC4wMTUtMC4wMDEtMC4wMjYtMC4wMDItMC4wMzktMC4wMDNjLTAuNDc5LTAuMDM5LTAuOTUyLTAuMDU3LTEuNDE5LTAuMDU5ICAgIGMtMC4wMjgsMC0wLjA1Ny0wLjAwMy0wLjA4My0wLjAwM2MtMC4wMTUsMC0wLjAyNSwwLjAwMS0wLjAzOSwwLjAwMWMtMC40LDAuMDAxLTAuNzk0LDAuMDE4LTEuMTg3LDAuMDQ1ICAgIGMtMC4wNywwLjAwNS0wLjE0MiwwLjAwOS0wLjIxMSwwLjAxNWMtMC4zODEsMC4wMzItMC43NTUsMC4wNzYtMS4xMjEsMC4xMzJDMTYuNjU2LDIuNDksMTYuNTg3LDIuNSwxNi41MTksMi41MTMgICAgYy0wLjM3MywwLjA2My0wLjczOSwwLjEzNi0xLjA5OSwwLjIyNWMtMC4wNCwwLjAxLTAuMDc4LDAuMDIxLTAuMTE3LDAuMDMyYy0wLjM1MiwwLjA5LTAuNjk0LDAuMTkzLTEuMDI5LDAuMzA5ICAgIGMtMC4wMzMsMC4wMTItMC4wNjcsMC4wMjItMC4xMDIsMC4wMzRjLTAuMzQsMC4xMi0wLjY2NiwwLjI1Ni0wLjk4NiwwLjQwM2MtMC4wNTgsMC4wMjYtMC4xMTUsMC4wNTItMC4xNzQsMC4wOCAgICBjLTAuMzA3LDAuMTQ3LTAuNjA0LDAuMzA3LTAuODkyLDAuNDc5Yy0wLjA1NiwwLjAzMy0wLjEwOSwwLjA2Ny0wLjE2NCwwLjEwMmMtMC4yODgsMC4xNzktMC41NjYsMC4zNjktMC44MzEsMC41NzMgICAgYy0wLjAzNCwwLjAyNy0wLjA2NiwwLjA1Ni0wLjEwMSwwLjA4M2MtMC4yNjEsMC4yMDgtMC41MSwwLjQyNi0wLjc0NCwwLjY1OWMtMC4wMiwwLjAxOC0wLjAzOCwwLjAzNC0wLjA1NywwLjA1MyAgICBjLTAuMjM4LDAuMjM5LTAuNDU4LDAuNDk0LTAuNjY3LDAuNzZDOS41MjEsNi4zNSw5LjQ4NCw2LjM5NSw5LjQ0OSw2LjQ0QzkuMjUyLDYuNjk5LDkuMDcxLDYuOTc0LDguOTAyLDcuMjU5ICAgIEM4Ljg3LDcuMzEzLDguODQsNy4zNjgsOC44MDksNy40MjJDOC42NDQsNy43MTYsOC40OTMsOC4wMjEsOC4zNjEsOC4zMzljLTAuMDE4LDAuMDQzLTAuMDMzLDAuMDg5LTAuMDUsMC4xMzMgICAgQzguMTgsOC44MDEsOC4wNjUsOS4xNDIsNy45Nyw5LjQ5N0M3Ljk2Niw5LjUxLDcuOTYxLDkuNTIyLDcuOTU4LDkuNTM3Yy0wLjA5NCwwLjM1OS0wLjE2MywwLjczNS0wLjIxNiwxLjEyMSAgICBjLTAuMDEsMC4wNi0wLjAyLDAuMTE5LTAuMDI3LDAuMThjLTAuMDQ2LDAuMzc0LTAuMDcsMC43NjItMC4wNzgsMS4xNTljLTAuMDAxLDAuMDc1LTAuMDAxLDAuMTQ5LTAuMDAxLDAuMjI2ICAgIGMwLDAuNDA0LDAuMDE4LDAuODE5LDAuMDYsMS4yNDhjMC4wMDYsMC4wNjMsMC4wMTYsMC4xMjksMC4wMjEsMC4xOTNjMC4wNTEsMC40NTQsMC4xMTgsMC45MTgsMC4yMTYsMS4zOTkgICAgYzAsMS43MzktMy40NCw0LjQzOC0yLjYxMiw1LjM1MWMwLjgyOSwwLjkxNCwyLjIzNiwwLjk0OCwyLjIzNiwwLjk0OHMtMC45MTUsMS43MzktMC41MDQsMi4yMTkgICAgYzAuMDU0LDAuMDYyLDAuMTIsMC4xMTEsMC4xOTUsMC4xNTJjMC4wMjcsMC4wMTcsMC4wNjEsMC4wMjQsMC4wOTEsMC4wMzljMC4wNSwwLjAyMSwwLjA5OSwwLjA0MywwLjE1MiwwLjA1OSAgICBjMC4wNCwwLjAxMSwwLjA4MSwwLjAxOSwwLjEyMiwwLjAyM2MwLjA0OCwwLjAxMSwwLjA5NiwwLjAyMSwwLjE0NSwwLjAyNGMwLjA0OCwwLjAwNiwwLjA5MywwLjAwOCwwLjE0LDAuMDEzICAgIGMwLjA0MiwwLjAwMiwwLjA4NCwwLjAwNiwwLjEyNCwwLjAwNmMwLjAxNCwwLDAuMDI3LDAuMDAyLDAuMDQsMC4wMDJjMC4wNDgsMCwwLjA4OS0wLjAwNCwwLjEzMi0wLjAwNCAgICBjMC4wMTYtMC4wMDIsMC4wMy0wLjAwMiwwLjA0Ni0wLjAwMmMwLjA2NC0wLjAwNCwwLjEyMi0wLjAxLDAuMTc0LTAuMDE2YzAuMDA1LDAsMC4wMS0wLjAwMSwwLjAxNC0wLjAwMSAgICBjMC4xMDktMC4wMTIsMC4xODItMC4wMjIsMC4xODItMC4wMjJzLTEuMDYzLDAuNzY4LTEuMDYzLDEuMzU5YzAsMC41OTMsMS43OTUsMS4zODgsMS43OTUsMS4zODhzLTAuMjkxLDIuOTc1LDIuMDA1LDMuMDYzICAgIGMwLjAzMywwLjAwMywwLjA2NCwwLjAwOCwwLjEwMiwwLjAwOGMwLjA4MywwLDAuMTctMC4wMDIsMC4yNjItMC4wMTFjMi42OTQtMC4yMjksMy4xNDctMC45ODcsMy4xNDctMC45ODdsMC4yNSwxLjA0MWwwLDAgICAgTDE1LjY1NywzMmgxMC40MzJsLTAuMzY0LTcuMjI5QzI1LjcyMywyNC43NzEsMzIuMTI5LDE3LjgxMiwzMS4xMjQsMTEuNTkyeiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJCTxwYXRoIGQ9Ik02Ljc3NSwyNS4yMTVjMC0wLjI2MSwwLjA4My0wLjUxMywwLjIxLTAuNzQ3Yy0wLjIwNy0wLjA5Ni0wLjM3OS0wLjIyNS0wLjUxOS0wLjM4NiAgICBjLTAuNDM4LTAuNTE2LTAuMzE3LTEuMzM5LTAuMDIxLTIuMTMzYy0wLjU0NS0wLjE2MS0xLjE5LTAuNDU5LTEuNjk2LTEuMDE4Yy0wLjg1OC0wLjk0NSwwLjA2MS0yLjE2NCwxLjAzMy0zLjQ1NyAgICBjMC41NjMtMC43NDYsMS4zMjQtMS43NTgsMS4zNzctMi4zNUM2LjQxNSwxMS4zOCw3LjA2Nyw4LjEyMSw5LjA0OCw1LjY5M2MyLjE2OC0yLjY1Nyw1Ljg5OC00LjE4MSwxMC4yMzQtNC4xODEgICAgYzEuMDM4LDAsMi4xMDYsMC4wODcsMy4xNzcsMC4yNTdjMC4wODYsMC4wMTQsMC4xNTksMC4wMzQsMC4yNDQsMC4wNDhjLTEuMTc0LTAuNjgzLTIuNzE5LTEuMjM5LTQuNzg5LTEuNTcgICAgQzkuMzExLTEuMTI1LDEuNTYxLDMuMjQxLDMuNTEsMTIuNzc4YzAsMS43NC0zLjQ0MSw0LjQzOC0yLjYxMiw1LjM1MWMwLjgyOCwwLjkxMywyLjIzNywwLjk0OSwyLjIzNywwLjk0OSAgICBzLTAuOTE2LDEuNzM2LTAuNTA2LDIuMjE4YzAuNDE0LDAuNDc5LDEuNTU3LDAuMjc0LDEuNTU3LDAuMjc0cy0xLjA2MywwLjc2Ny0xLjA2MywxLjM1OWMwLDAuNTk2LDEuNzk1LDEuMzg3LDEuNzk1LDEuMzg3ICAgIHMtMC4zMjksMy4yODksMi4zNjcsMy4wNjJjMC41MS0wLjA0MywwLjkxOC0wLjEwNywxLjI4LTAuMTgzYy0wLjAwMS0wLjAzNC0wLjAwOC0wLjA3Ny0wLjAwOS0wLjExICAgIEM3LjM3MywyNi40OSw2Ljc3NSwyNS44NjEsNi43NzUsMjUuMjE1eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJPC9nPgo8L2c+PC9nPiA8L3N2Zz4=" />
                    </i> <span>Comportamiento</span>
                    <span class="pull-right-container">
                        <small class="label bg-purple label-info">  6 </small> 
                    </span>
                </a>     

                <ul class="treeview-menu">
                    
                        <li>
                            <li class="treeview">
                                <a href="#">
                                    <img style="width: 20px;margin-right: 10px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDkyLjU5OSA5Mi41OTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkyLjU5OSA5Mi41OTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0yNC40MTksMzAuNzE0YzAsMy40MjIsMi43ODQsNi4yMDYsNi4yMDYsNi4yMDZzNi4yMDYtMi43ODQsNi4yMDYtNi4yMDZzLTIuNzg0LTYuMjA2LTYuMjA2LTYuMjA2ICAgIFMyNC40MTksMjcuMjkyLDI0LjQxOSwzMC43MTR6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY4RjgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJPHBhdGggZD0iTTkxLjAzMSw4My40NjljMCwwLTM0Ljk2Ny0zNC45MTItMzUuMTE1LTM1LjAzNmM4LjQzNy0xMS45OTksNy4zMjItMjguNzEzLTMuMzk3LTM5LjQzNCAgICBjLTExLjk5NS0xMS45OTgtMzEuNTItMTEuOTk4LTQzLjUyLDBDLTMsMjAuOTk2LTMsNDAuNTIsOC45OTksNTIuNTE3QzE5LjcyLDYzLjI0LDM2LjQzNCw2NC4zNSw0OC40MzQsNTUuOTEzICAgIGMwLjEyNCwwLjE1MiwzNS4wMzcsMzUuMTE4LDM1LjAzNywzNS4xMThjMi4wODcsMi4wODgsNS40NzQsMi4wODgsNy41NjIsMEM5My4xMjEsODguOTQxLDkzLjEyMSw4NS41NTksOTEuMDMxLDgzLjQ2OXogICAgIE0zMC43MDksNy40ODNjMTEuNjk4LDAsMjEuMzcxLDguNjUsMjIuOTgzLDE5LjkwMmMtNC4xMTYtMy4zNzItMTIuNzkzLTkuMjg3LTIzLjAyMi05LjI4N2MtMTAuMTU1LDAtMTguNzgzLDUuODMyLTIyLjkzNiw5LjIxNSAgICBDOS4zNzcsMTYuMDk3LDE5LjAzNiw3LjQ4MywzMC43MDksNy40ODN6IE00My4zOTIsMzAuNzE0YzAsMi43OTEtMC45MTIsNS4zNjEtMi40MzksNy40NjNjLTMuMTE4LDEuMjU0LTYuNjA3LDIuMTQyLTEwLjI4MSwyLjE0MiAgICBjLTMuNzI0LDAtNy4yNi0wLjkxLTEwLjQxMS0yLjE5MWMtMS41MDQtMi4wOTItMi4zOTktNC42NDYtMi4zOTktNy40MTNjMC0yLjc3NCwwLjktNS4zMzMsMi40MTEtNy40MjggICAgYzMuMTQ3LTEuMjc5LDYuNjgxLTIuMTg4LDEwLjM5OS0yLjE4OGMzLjY2OSwwLDcuMTU0LDAuODg1LDEwLjI3MSwyLjEzN0M0Mi40NzMsMjUuMzQsNDMuMzkyLDI3LjkxNyw0My4zOTIsMzAuNzE0eiAgICAgTTMwLjcwOSw1My45MzFjLTExLjY3MiwwLTIxLjMzLTguNjEyLTIyLjk3NC0xOS44MjhjNC4xNSwzLjM4MywxMi43NzgsOS4yMTUsMjIuOTM1LDkuMjE1YzEwLjIyOSwwLDE4LjkwNS01LjkxNSwyMy4wMjItOS4yODcgICAgQzUyLjA3OCw0NS4yODEsNDIuNDA2LDUzLjkzMSwzMC43MDksNTMuOTMxeiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOEY4IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJPC9nPgo8L2c+PC9nPiA8L3N2Zz4=" /> Observaciones
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="../observador/categoria.php">
                                           <i class="fa fa-circle-o"></i> Categoria
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../observador/tipo.php">
                                           <i class="fa fa-circle-o"></i> Tipo
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../observador/registrar.php">
                                           <i class="fa fa-circle-o"></i> Registrar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../observador/observador_alumno.php">
                                           <i class="fa fa-circle-o"></i> Observador del alumno
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../observador/remision.php">
                                           <i class="fa fa-circle-o"></i> Remisiones
                                        </a>
                                    </li>
                                     
                                </ul>
                                <li>
                                        <a href="../observador/compromiso.php">
                                           <img src="../../../logos/apreton.png"  style=";margin-right: 10px; width: 19px;"> Compromiso
                                        </a>
                                    
                                </li>
                                <li>
                                        <a href="../observador/comite.php">
                                           <img src="../../../logos/comite.png"  style=";margin-right: 10px  ;  width: 17px;"> Comite convivencia
                                        </a>
                                    
                                </li>
                                <li>
                                        <a href="../observador/estado.php">
                                           <img src="../../../logos/estado.png"  style=";margin-right: 10px;    width: 17px;"> Estado del alumno
                                        </a>
                                    
                                </li>
                                <li>
                                        <a href="../alumnos/crear_alumno.php">
                                           <img src="../../../logos/citacion.png"  style=" width: 17px;margin-right: 10px"> Citacion del estudiantes
                                        </a>
                                    
                                </li>
                                <li>
                                        <a href="../observador/inasistencia.php">
                                           <img src="../../../logos/negativo.png"  style="      margin-right: 10px;    width: 17px;"> Inasistencia
                                        </a>
                                    
                                </li>
                                 

                                <ul class="treeview-menu">
                                    <li><a href="../alumnos/crear_alumno.php"><i class="fa fa-circle-o"></i> registrar</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> competencia</a></li> 
                                </ul>
                            </li>
                        </li>
                    </li>
                </ul>
                <li class=" treeview  ">
                    <a href="#">
                        <i  >
                            <img style="width: 20px;margin-right: 10px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDgwLjEzIDgwLjEzIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA4MC4xMyA4MC4xMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSIiPjxnPjxnPgoJPHBhdGggZD0iTTQ4LjM1NSwxNy45MjJjMy43MDUsMi4zMjMsNi4zMDMsNi4yNTQsNi43NzYsMTAuODE3YzEuNTExLDAuNzA2LDMuMTg4LDEuMTEyLDQuOTY2LDEuMTEyICAgYzYuNDkxLDAsMTEuNzUyLTUuMjYxLDExLjc1Mi0xMS43NTFjMC02LjQ5MS01LjI2MS0xMS43NTItMTEuNzUyLTExLjc1MkM1My42NjgsNi4zNSw0OC40NTMsMTEuNTE3LDQ4LjM1NSwxNy45MjJ6IE00MC42NTYsNDEuOTg0ICAgYzYuNDkxLDAsMTEuNzUyLTUuMjYyLDExLjc1Mi0xMS43NTJzLTUuMjYyLTExLjc1MS0xMS43NTItMTEuNzUxYy02LjQ5LDAtMTEuNzU0LDUuMjYyLTExLjc1NCwxMS43NTJTMzQuMTY2LDQxLjk4NCw0MC42NTYsNDEuOTg0ICAgeiBNNDUuNjQxLDQyLjc4NWgtOS45NzJjLTguMjk3LDAtMTUuMDQ3LDYuNzUxLTE1LjA0NywxNS4wNDh2MTIuMTk1bDAuMDMxLDAuMTkxbDAuODQsMC4yNjMgICBjNy45MTgsMi40NzQsMTQuNzk3LDMuMjk5LDIwLjQ1OSwzLjI5OWMxMS4wNTksMCwxNy40NjktMy4xNTMsMTcuODY0LTMuMzU0bDAuNzg1LTAuMzk3aDAuMDg0VjU3LjgzMyAgIEM2MC42ODgsNDkuNTM2LDUzLjkzOCw0Mi43ODUsNDUuNjQxLDQyLjc4NXogTTY1LjA4NCwzMC42NTNoLTkuODk1Yy0wLjEwNywzLjk1OS0xLjc5Nyw3LjUyNC00LjQ3LDEwLjA4OCAgIGM3LjM3NSwyLjE5MywxMi43NzEsOS4wMzIsMTIuNzcxLDE3LjExdjMuNzU4YzkuNzctMC4zNTgsMTUuNC0zLjEyNywxNS43NzEtMy4zMTNsMC43ODUtMC4zOThoMC4wODRWNDUuNjk5ICAgQzgwLjEzLDM3LjQwMyw3My4zOCwzMC42NTMsNjUuMDg0LDMwLjY1M3ogTTIwLjAzNSwyOS44NTNjMi4yOTksMCw0LjQzOC0wLjY3MSw2LjI1LTEuODE0YzAuNTc2LTMuNzU3LDIuNTktNy4wNCw1LjQ2Ny05LjI3NiAgIGMwLjAxMi0wLjIyLDAuMDMzLTAuNDM4LDAuMDMzLTAuNjZjMC02LjQ5MS01LjI2Mi0xMS43NTItMTEuNzUtMTEuNzUyYy02LjQ5MiwwLTExLjc1Miw1LjI2MS0xMS43NTIsMTEuNzUyICAgQzguMjgzLDI0LjU5MSwxMy41NDMsMjkuODUzLDIwLjAzNSwyOS44NTN6IE0zMC41ODksNDAuNzQxYy0yLjY2LTIuNTUxLTQuMzQ0LTYuMDk3LTQuNDY3LTEwLjAzMiAgIGMtMC4zNjctMC4wMjctMC43My0wLjA1Ni0xLjEwNC0wLjA1NmgtOS45NzFDNi43NSwzMC42NTMsMCwzNy40MDMsMCw0NS42OTl2MTIuMTk3bDAuMDMxLDAuMTg4bDAuODQsMC4yNjUgICBjNi4zNTIsMS45ODMsMTIuMDIxLDIuODk3LDE2Ljk0NSwzLjE4NXYtMy42ODNDMTcuODE4LDQ5Ljc3MywyMy4yMTIsNDIuOTM2LDMwLjU4OSw0MC43NDF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0ZERkQiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==" />
                        </i> 
                        <span>personal</span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green">3</small>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#">
                                <img style="width: 20px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDg3LjkgNDg3LjkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ4Ny45IDQ4Ny45OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTIyNy43NTQsMzU4LjdjNS43LTMuNiwxMS4xLTYuOCwxNi4xLTkuOGMxLjYtMSwzLjMtMi4xLDQuOS0zLjFjLTEtMi45LTItNS45LTIuOC05Yy03LjYtMTAuMS0xMS41LTIxLjgtMTMuNi0yOC44ICAgIGMtOS4yLDYuNy0xOS4yLDEzLTMwLjMsMTguOWMtOC44LDQtMTcuNiw4LTI2LjQsMTJjLTIuNCwwLjgtNC44LDIuNC04LDMuMlYxOTUuNGgtMTI3LjVjMC0yNCwwLTQ4LjEsMC03MS4zVjkzLjcgICAgYzQyLjUtNCw4My4zLTIwLjgsMTI3LjQtNTAuNXYxNTIuMmg4MWM0LjEtNi41LDktMTIuOCwxNC43LTE4LjdjNi44LTcuMiwxNC41LTEzLjYsMjIuOS0xOWM3LjktNS40LDE2LjMtOS43LDI1LTEyLjYgICAgYzcuOS0yLjcsMTYuMS00LjMsMjQuNC00LjdjMC4xLDAsMC4yLDAsMC4zLDBWODMuM2MwLTE1LjItOS42LTI1LjYtMjUuNi0yOGwtNi40LTAuOGMtOC44LTAuOC0xNy42LTIuNC0yNS42LTQgICAgYy0yOS42LTYuNC01OC41LTIwLTkwLjUtNDIuNWMtNS42LTQtMTEuMi04LTE5LjItOHMtMTMuNiw0LTE4LjQsNy4yYy00My41LDI5LjYtODIsNDQuOC0xMjEuMiw0Ny4zYy0xMC40LDAuOC0yOCw0LjgtMjgsMjkuNiAgICB2NDAuMWMwLDI3LjIsMCw1My43LDAsODAuOWMtMC44LDEwLjQsMC44LDIxLjYsMy4yLDMzLjZjNi40LDI3LjIsMjAsNTEuMyw0My4zLDc1LjNjMjguOCwyOC44LDY0LjEsNTEuMywxMTAuNSw2OC4xICAgIGMzLjIsMC44LDYuNCwxLjYsOS42LDEuNmM0LjgsMCw4LjgtMC44LDEyLTIuNGwxMi00LjhjOS42LTQsMTkuMi04LDI4LjgtMTMuNkMyMjIuOTU0LDM2MS41LDIyNS4yNTQsMzYwLjEsMjI3Ljc1NCwzNTguN3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZERkJGQiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCQk8cGF0aCBkPSJNNDY4LjQ1NCw0MTcuNGMtMzQuOS0yNy4xLTcwLjEtNDQuOC03Ny42LTQ4LjVjLTAuOS0wLjQtMS41LTEuMy0xLjUtMi4zYzAtMy45LDAtMTQuMSwwLTI0LjljMy43LTcuNyw1LjktMTUuOSw3LjItMjMuMyAgICBjMy4zLDIuMyw4LjksMS4xLDE1LTIwLjVjNS0xNy41LDEuOS0yMy40LTIuMy0yNC45YzEzLjktNjYuNy0xNy45LTY4LjktMTcuOS02OC45cy00LjgtOS4yLTE3LjQtMTYuMmMtOC41LTUtMjAuMy04LjktMzUuOC03LjYgICAgYy01LDAuMi05LjgsMS4yLTE0LjMsMi43bDAsMGMtNS43LDEuOS0xMSw0LjgtMTUuNyw4Yy01LjgsMy43LTExLjMsOC4yLTE2LjIsMTMuNGMtNy43LDcuOC0xNC41LDE4LTE3LjUsMzAuNiAgICBjLTIuOCwxMC43LTIuNywyMi40LDEuNSwzNC4yYy01LjctMC41LTEyLjUsMi44LTYuMSwyNS4zYzQuNiwxNi40LDksMjEsMTIuMiwyMS4zYzEuNSw5LjQsNC40LDE5LjksMTAsMjkuM3YyMS41ICAgIGMwLDEtMC42LDEuOS0xLjUsMi40Yy03LjUsMy43LTQyLjcsMjEuNS03Ny42LDQ4LjVjLTExLjksOS4zLTE4LjgsMjMuNi0xOC44LDM4Ljd2MjIuNWMwLDUuMSw0LjEsOS4yLDkuMiw5LjJoMjc0LjYgICAgYzUuMSwwLDkuMi00LjEsOS4yLTkuMnYtMjIuNUM0ODcuMjU0LDQ0MS4xLDQ4MC4zNTQsNDI2LjcsNDY4LjQ1NCw0MTcuNHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZERkJGQiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" /> administradores
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="../admin/Nuevo_administrador.php">
                                        <img style="width: 18px;margin-right: 10px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjEyLjAwMSA2MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MTIuMDAxIDYxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTU2Ny43MzQsNTcuNDdjLTI4LjU5My0yOC41OTMtNjYuNjA3LTQ0LjMzOC0xMDcuMDQ0LTQ0LjMzOGMtNDAuNDM1LDAtNzguNDUxLDE1Ljc0NS0xMDcuMDQxLDQ0LjMzOCAgICAgYy0yOC41OTMsMjguNTkzLTQ0LjM0LDY2LjYwNi00NC4zNCwxMDcuMDQ0YzAsNDAuNDM1LDE1Ljc0Nyw3OC40NDksNDQuMzQsMTA3LjA0MWMyOC41OTIsMjguNTkzLDY2LjYwNiw0NC4zNDEsMTA3LjA0MSw0NC4zNDEgICAgIGM0MC40MzYsMCw3OC40NTItMTUuNzQ4LDEwNy4wNDQtNDQuMzQxQzYyNi43NTcsMjEyLjUzMiw2MjYuNzU3LDExNi40OTQsNTY3LjczNCw1Ny40N3ogTTU0My42OTcsMjQ3LjUxOSAgICAgYy0yMi4xNzEsMjIuMTc0LTUxLjY1MiwzNC4zODQtODMuMDA3LDM0LjM4NGMtMzEuMzU2LDAtNjAuODMzLTEyLjIxLTgzLjAwNC0zNC4zODRjLTIyLjE3My0yMi4xNzEtMzQuMzgzLTUxLjY0OS0zNC4zODMtODMuMDA0ICAgICBzMTIuMjEtNjAuODM2LDM0LjM4My04My4wMDdjMjIuMTcxLTIyLjE3MSw1MS42NS0zNC4zODIsODMuMDA0LTM0LjM4MmMzMS4zNTYsMCw2MC44MzYsMTIuMjEsODMuMDA3LDM0LjM4MiAgICAgQzU4OS40NjYsMTI3LjI3NSw1ODkuNDY2LDIwMS43NSw1NDMuNjk3LDI0Ny41MTl6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGOUY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik01MDguMzc5LDE0Ni44NTNoLTMyLjY4MnYtMzIuNjgxYzAtOS4zODctNy42MS0xNi45OTYtMTYuOTk2LTE2Ljk5NnMtMTYuOTk2LDcuNjA5LTE2Ljk5NiwxNi45OTZ2MzIuNjgxaC0zMi42ODIgICAgIGMtOS4zODYsMC0xNi45OTYsNy42MS0xNi45OTYsMTYuOTk2YzAsOS4zODksNy42MSwxNi45OTYsMTYuOTk2LDE2Ljk5NmgzMi42ODJ2MzIuNjgzYzAsOS4zODksNy42MSwxNi45OTYsMTYuOTk2LDE2Ljk5NiAgICAgczE2Ljk5Ni03LjYwNywxNi45OTYtMTYuOTk2di0zMi42ODNoMzIuNjgyYzkuMzg2LDAsMTYuOTk2LTcuNjA3LDE2Ljk5Ni0xNi45OTYgICAgIEM1MjUuMzc1LDE1NC40NjMsNTE3Ljc2NiwxNDYuODUzLDUwOC4zNzksMTQ2Ljg1M3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y5RjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCQkJPHBhdGggZD0iTTM2MS40MDgsNDcwLjI1NGMtMjMuMjAyLTE2LjM2LTUwLjc2LTI4LjQzMi04MC43NS0zNS42NzVjMjcuODE1LTI0LjA5Miw0NS44NjUtNjIuNjMyLDQ1Ljg2NS0xMDUuOTg0ICAgICBjMC03Mi44MTktNTAuOTIyLTEzMi4wNjItMTEzLjUxNC0xMzIuMDYyYy02Mi41ODksMC0xMTMuNTEyLDU5LjI0Mi0xMTMuNTEyLDEzMi4wNjJjMCw0My4zNTMsMTguMDUsODEuODkzLDQ1Ljg2NSwxMDUuOTg3ICAgICBjLTI5Ljk4OCw3LjIzOS01Ny41NDYsMTkuMzEyLTgwLjc0OCwzNS42NzJDMjIuOTQ3LDQ5OS42MzMsMCw1MzkuMjczLDAsNTgxLjg3NGMwLDkuMzg2LDcuNjEsMTYuOTk2LDE2Ljk5NiwxNi45OTZoMzkyLjAyNyAgICAgYzkuMzg3LDAsMTYuOTk2LTcuNjEsMTYuOTk2LTE2Ljk5NkM0MjYuMDIsNTM5LjI3Myw0MDMuMDczLDQ5OS42MzMsMzYxLjQwOCw0NzAuMjU0eiBNMzI2LjUyMyw1NjQuODc4di0zMC4zNTUgICAgIGMwLTkuMzg2LTcuNjEtMTYuOTk2LTE2Ljk5Ni0xNi45OTZzLTE2Ljk5Niw3LjYxLTE2Ljk5NiwxNi45OTZ2MzAuMzU1SDEzMy40OXYtMzAuMzU1YzAtOS4zODYtNy42MS0xNi45OTYtMTYuOTk2LTE2Ljk5NiAgICAgcy0xNi45OTYsNy42MS0xNi45OTYsMTYuOTk2djMwLjM1NUgzNS43N2M1LjI0OS0yNC45MjIsMjEuOTg5LTQ4LjE5Niw0OC40MzItNjYuODQxYzM0LjE4My0yNC4xMDIsNzkuOTI5LTM3LjM3NiwxMjguODEtMzcuMzc2ICAgICBzOTQuNjI3LDEzLjI3MiwxMjguODA3LDM3LjM3NmMyNi40NDMsMTguNjQ1LDQzLjE4Myw0MS45MTgsNDguNDMsNjYuODQxSDMyNi41MjN6IE0xMzMuNDksMzI4LjU5NiAgICAgYzAtNTQuMDc2LDM1LjY3My05OC4wNyw3OS41Mi05OC4wN2M0My44NDgsMCw3OS41MjIsNDMuOTk2LDc5LjUyMiw5OC4wN2MwLDU0LjA3OS0zNS42NzMsOTguMDczLTc5LjUyLDk4LjA3MyAgICAgUzEzMy40OSwzODIuNjczLDEzMy40OSwzMjguNTk2eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRjlGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />Nuevo administrador
                                    </a>
                                </li>
                                <li>
                                    <a href="../alumnos/crear_alumno.php">
                                        <img style="width: 20px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2aWV3Qm94PSItMzEgMCA0NzkgNDgwIiB3aWR0aD0iNTEyIiBjbGFzcz0iIj48Zz48cGF0aCBkPSJtMTYuNSAzOTJ2LTM1MmMwLTEzLjI1MzkwNiAxMC43NDYwOTQtMjQgMjQtMjRoMjAwdjU2Yy4wMjczNDQgMjIuMDgyMDMxIDE3LjkxNzk2OSAzOS45NzI2NTYgNDAgNDBoNTZ2NTZoMTZ2LTY0YzAtMi4xMjEwOTQtLjg0Mzc1LTQuMTU2MjUtMi4zNDM3NS01LjY1NjI1bC05Ni05NmMtMS41LTEuNS0zLjUzNTE1Ni0yLjM0Mzc1LTUuNjU2MjUtMi4zNDM3NWgtMjA4Yy0yMi4wODIwMzEuMDI3MzQzOC0zOS45NzI2NTYgMTcuOTE3OTY5LTQwIDQwdjM1MmMuMDI3MzQ0IDIyLjA4MjAzMSAxNy45MTc5NjkgMzkuOTcyNjU2IDQwIDQwaDE1MnYtMTZoLTE1MmMtMTMuMjUzOTA2IDAtMjQtMTAuNzQ2MDk0LTI0LTI0em0yNDAtMzIwdi00NC42ODc1bDY4LjY4NzUgNjguNjg3NWgtNDQuNjg3NWMtMTMuMjUzOTA2IDAtMjQtMTAuNzQ2MDk0LTI0LTI0em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSA0OGgxNnYxNmgtMTZ6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im04MC41IDQ4aDQ4djE2aC00OHptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTQ4LjUgODBoODB2MTZoLTgwem0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSAxNDRoMzJ2MTZoLTMyem0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtOTYuNSAxNDRoNjR2MTZoLTY0em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtMTc2LjUgMTQ0aDEyOHYxNmgtMTI4em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSAxOTJoMTkydjE2aC0xOTJ6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im00OC41IDI0MGg2NHYxNmgtNjR6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im0xMjguNSAyNDBoNDh2MTZoLTQ4em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtMTkyLjUgMjQwaDMydjE2aC0zMnptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTQ4LjUgMjg4aDE4NHYxNmgtMTg0em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSAzMzZoNDh2MTZoLTQ4em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtMTEyLjUgMzM2aDgwdjE2aC04MHptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTM2OC41IDI2NHYtOGM0LjQxNzk2OSAwIDgtMy41ODIwMzEgOC04IDAtMzUuMzQ3NjU2LTI4LjY1MjM0NC02NC02NC02NHMtNjQgMjguNjUyMzQ0LTY0IDY0YzAgNC40MTc5NjkgMy41ODIwMzEgOCA4IDh2OGMwIDMwLjkyOTY4OCAyNS4wNzAzMTIgNTYgNTYgNTZzNTYtMjUuMDcwMzEyIDU2LTU2em0tNTYtNjRjMjMuNDE0MDYyLjAzMTI1IDQzLjQwMjM0NCAxNi45MTc5NjkgNDcuMzM1OTM4IDQwaC00NGwtMjEuNjU2MjUtMjEuNjU2MjVjLTEuOTYwOTM4LTEuOTU3MDMxLTQuNzkyOTY5LTIuNzYxNzE5LTcuNDkyMTg4LTIuMTI1LTIuNjk1MzEyLjYzNjcxOS00Ljg3MTA5NCAyLjYyNS01Ljc0NjA5NCA1LjI1MzkwNmwtNi4yMTA5MzcgMTguNTI3MzQ0aC05LjU5NzY1N2MzLjkzNzUtMjMuMDkzNzUgMjMuOTQxNDA3LTM5Ljk4NDM3NSA0Ny4zNjcxODgtNDB6bTAgMTA0Yy0yMi4wODIwMzEtLjAyNzM0NC0zOS45NzI2NTYtMTcuOTE3OTY5LTQwLTQwdi04aDhjMy40NDE0MDYtLjAwMzkwNiA2LjQ5NjA5NC0yLjIwNzAzMSA3LjU4NTkzOC01LjQ3MjY1NmwzLjkxNzk2OC0xMS43MTA5MzggMTQuODM5ODQ0IDE0LjgzOTg0NGMxLjUgMS41IDMuNTM1MTU2IDIuMzQzNzUgNS42NTYyNSAyLjM0Mzc1aDQwdjhjLS4wMjczNDQgMjIuMDgyMDMxLTE3LjkxNzk2OSAzOS45NzI2NTYtNDAgNDB6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im0zMjguNSAzMjBoLTMyYy00OC41NzgxMjUuMDU4NTk0LTg3Ljk0MTQwNiAzOS40MjE4NzUtODggODh2NjRjMCA0LjQxNzk2OSAzLjU4MjAzMSA4IDggOGgxOTJjNC40MTc5NjkgMCA4LTMuNTgyMDMxIDgtOHYtNjRjLS4wNTg1OTQtNDguNTc4MTI1LTM5LjQyMTg3NS04Ny45NDE0MDYtODgtODh6bTAgMTZjMi44Nzg5MDYuMDE1NjI1IDUuNzUzOTA2LjIwMzEyNSA4LjYwOTM3NS41NjY0MDZsLTI0LjYwOTM3NSAzMy44MzIwMzItMjQuNjA5Mzc1LTMzLjgzMjAzMmMyLjg1NTQ2OS0uMzYzMjgxIDUuNzMwNDY5LS41NTA3ODEgOC42MDkzNzUtLjU2NjQwNnptLTEwNCA3MmMuMDUwNzgxLTI5Ljk0MTQwNiAxOC42MDkzNzUtNTYuNzMwNDY5IDQ2LjYyNS02Ny4yOTY4NzVsMzMuMzc1IDQ1Ljg5ODQzN3Y3Ny4zOTg0MzhoLTQ4di03MmgtMTZ2NzJoLTE2em0xNzYgNTZoLTE2di03MmgtMTZ2NzJoLTQ4di03Ny4zOTg0MzhsMzMuMzc1LTQ1Ljg5ODQzN2MyOC4wMTU2MjUgMTAuNTY2NDA2IDQ2LjU3NDIxOSAzNy4zNTU0NjkgNDYuNjI1IDY3LjI5Njg3NXptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTM0NC41IDM2OGgxNnYxNmgtMTZ6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjwvZz4gPC9zdmc+" /> Hoja de vida
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img style="width: 18px;margin-right: 10px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzk3LjczNiw3OC4zNzhjNi44MjQsMCwxMi4zNTgtNS41MzMsMTIuMzU4LTEyLjM1OFYyNy4wMjdDNDEwLjA5NCwxMi4xMjUsMzk3Ljk3NywwLDM4My4wOCwwSDEyMS42NDEgICAgYy0zLjI3NywwLTYuNDIsMS4zMDMtOC43MzksMy42MkwxMC41MjcsMTA1Ljk5NWMtMi4zMTcsMi4zMTctMy42Miw1LjQ2MS0zLjYyLDguNzM4djM3MC4yMzlDNi45MDgsNDk5Ljg3NSwxOS4wMzIsNTEyLDMzLjkzNSw1MTIgICAgaDM0OS4xNDRjMTQuODk3LDAsMjcuMDE0LTEyLjEyNSwyNy4wMTQtMjcuMDI3VjI5Ni4yODljMC4wMDEtNi44MjQtNS41MzItMTIuMzU4LTEyLjM1Ny0xMi4zNTggICAgYy02LjgyNCwwLTEyLjM1OCw1LjUzMy0xMi4zNTgsMTIuMzU4djE4OC42ODRjMCwxLjI3NC0xLjAzMSwyLjMxMS0yLjI5NywyLjMxMUgzMy45MzZjLTEuMjc0LDAtMi4zMTEtMS4wMzctMi4zMTEtMi4zMTF2LTM1Ny44OCAgICBoNzUuMzZjMTQuODk4LDAsMjcuMDE2LTEyLjEyLDI3LjAxNi0yNy4wMTdWMjQuNzE2SDM4My4wOGMxLjI2NywwLDIuMjk3LDEuMDM3LDIuMjk3LDIuMzExVjY2LjAyICAgIEMzODUuMzc3LDcyLjg0NSwzOTAuOTExLDc4LjM3OCwzOTcuNzM2LDc4LjM3OHogTTEwOS4yODUsMTAwLjA3NWMwLDEuMjY5LTEuMDMyLDIuMzAxLTIuMywyLjMwMUg0OS4xMDdsNjAuMTc4LTYwLjE4VjEwMC4wNzV6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0ZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OTIuODY1LDEwMC4zOTZsLTE0LjU0MS0xNC41MzljLTE2LjMwNC0xNi4zMDQtNDIuODMyLTE2LjMwMi01OS4xMzgsMEwzMDMuNzYzLDIwMS4yOEgxMDMuNTU5ICAgIGMtNi44MjUsMC0xMi4zNTgsNS41MzMtMTIuMzU4LDEyLjM1OGMwLDYuODI1LDUuNTMzLDEyLjM1OCwxMi4zNTgsMTIuMzU4aDE3NS40ODhsLTc0LjM3OSw3NC4zNzlIMTAzLjU1OSAgICBjLTYuODI1LDAtMTIuMzU4LDUuNTMzLTEyLjM1OCwxMi4zNThzNS41MzMsMTIuMzU4LDEyLjM1OCwxMi4zNThoNzYuMzkybC0wLjE5OSwwLjE5OWMtMS41MDgsMS41MDgtMi41OTgsMy4zNzktMy4xNjksNS40MzMgICAgbC0xOS4wODgsNjguNzQ3aC01My45MzZjLTYuODI1LDAtMTIuMzU4LDUuNTMzLTEyLjM1OCwxMi4zNThzNS41MzMsMTIuMzU4LDEyLjM1OCwxMi4zNThoNjMuMzMyYzAuMDAxLDAsMi43MDktMC4zMDYsMy4xMDctMC40MSAgICBjMC4wNjUtMC4wMTcsNzcuOTk3LTIxLjY0Miw3Ny45OTctMjEuNjQyYzIuMDU0LTAuNTcsMy45MjYtMS42NjIsNS40MzMtMy4xNjlsMjM5LjQzOC0yMzkuNDM1ICAgIEM1MDkuMTY4LDE0My4yMjgsNTA5LjE2OCwxMTYuNyw0OTIuODY1LDEwMC4zOTZ6IE0xODQuNjQ0LDM5NC4wNzNsMTAuMDg3LTM2LjMyNmwyNi4yNCwyNi4yNEwxODQuNjQ0LDM5NC4wNzN6IE0yNDQuNjksMzcyLjc1MiAgICBsLTM4LjcyMS0zOC43MjFsMTk3LjY0OC0xOTcuNjQ4bDM4LjcyMiwzOC43MjFMMjQ0LjY5LDM3Mi43NTJ6IE00NzUuMzg3LDE0Mi4wNTRsLTE1LjU3MSwxNS41NzFsLTM4LjcyMi0zOC43MjJsMTUuNTcxLTE1LjU3MSAgICBjNi42NjktNi42NjgsMTcuNTE3LTYuNjY3LDI0LjE4MSwwbDE0LjU0MSwxNC41NDFDNDgyLjA1NCwxMjQuNTQsNDgyLjA1NCwxMzUuMzg4LDQ3NS4zODcsMTQyLjA1NHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRkFGQSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />Seguimiento
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img style="width: 18px;margin-right: 10px"    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTk4LjA0IDE5OC4wNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTk4LjA0IDE5OC4wNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48cGF0aCBkPSJNMTgwLjcyNywxOC40MDFjLTAuMzE4LTIuMTA5LTEuOTQtMy43ODUtNC4wMzgtNC4xNzFMOTkuOTI2LDAuMDgzYy0wLjYtMC4xMS0xLjIxMy0wLjExLTEuODEzLDBMMjEuMzUsMTQuMjMgIGMtMi4wOTgsMC4zODYtMy43MiwyLjA2Mi00LjAzOCw0LjE3MWMtMC4zMjgsMi4xNjktNy44NDEsNTMuNjM1LDcuMjU4LDk4LjE1N2MxNS4yOCw0NS4wNTYsNjkuNTAxLDc5LjI4OSw3MS44MDIsODAuNzI0ICBjMC44MSwwLjUwNSwxLjcyOSwwLjc1OCwyLjY0NiwwLjc1OHMxLjgzNy0wLjI1MiwyLjY0Ni0wLjc1OGMyLjMwMS0xLjQzNSw1Ni41MjItMzUuNjY4LDcxLjgwNC04MC43MjQgIEMxODguNTY5LDcyLjAzNiwxODEuMDU1LDIwLjU3LDE4MC43MjcsMTguNDAxeiBNOTkuMDIsOTcuNDMzSDM1LjIxNWMtNy41MDgtMzMuNDE0LTIuMjc5LTY3LjQxMy0yLjI3OS02Ny40MTNMOTkuMDIsMTguMDhWOTcuNDMzeiAgIE0xNTkuMDM1LDExMC44ODFjLTEyLjgxMiwzNy4wMzctNjAuMDE1LDY1LjkwNi02MC4wMTUsNjUuOTA2Vjk3LjQzM2g2My44MDVDMTYxLjgwOSwxMDEuOTU1LDE2MC41NjIsMTA2LjQ2NiwxNTkuMDM1LDExMC44ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjRkJGNkY2Ij48L3BhdGg+PC9nPiA8L3N2Zz4=" />
                                        permisos
                                    </a>
                                </li> 
                            </ul>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="../alumnos/crear_alumno.php"><i class="fa fa-circle-o"></i> registrar</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o">                                          
                                        </i> competencia
                                    </a>
                                </li>
                            </ul>
                            <a href="#">
                                <img style="width: 20px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDc5LjUzNiA3OS41MzYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDc5LjUzNiA3OS41MzY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz48Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGQkZBRkMiIGQ9Ik0yLjA0NSwyMy4zNDZjMC01Ljc4OSw0LjY5NC0xMC40NzgsMTAuNDkzLTEwLjQ3OGM1Ljc3OSwwLDEwLjQ2Myw0LjY4OSwxMC40NjMsMTAuNDc4ICAgYzAsNS43OTItNC42ODQsMTAuNDczLTEwLjQ2MywxMC40NzNDNi43MzksMzMuODE4LDIuMDQ1LDI5LjEzNywyLjA0NSwyMy4zNDZ6IE00OC40MzgsMzMuMTVjLTEuNjgzLTEuMDEzLTMuODU4LTAuNDg3LTQuODgzLDEuMTg4ICAgbC02Ljk5MSwxMS40NjdsLTkuODU5LTUuNTA3Yy00LjQzMi0yLjczMS02LjU5NC00LjAyNi0xMy4xNzYtNC4wMjZoLTEuMDAyaC0xLjAwMkMtMS4yNDMsMzcuNzY0LDAuOTczLDQ3Ljk5MSwwLjk3Myw0Ny45OTEgICBsMS41NDgsMzEuNTQ1bDIyLjQ3My0wLjI0OWwtMC44ODUtMzEuMjk2bDExLjk4Miw1LjY4NmMwLjU1MiwwLjMxMSwxLjE0MiwwLjQ1LDEuNzI5LDAuNDVjMS4yMDQsMCwyLjM2OS0wLjYwNiwzLjA0Mi0xLjcwNCAgIGw4Ljc3Mi0xNC4zOUM1MC42NDUsMzYuMzU4LDUwLjEyMSwzNC4xNzMsNDguNDM4LDMzLjE1eiBNMjAuMDU3LDMyLjA2M2MtMC43NzksMC42NjgtMS42MjgsMS4yMzgtMi41NTYsMS42ODh2MS42NTIgICBjMC45MjcsMC4xMDksMS43NzYsMC4yNjEsMi41NTYsMC40NzRWMzIuMDYzeiBNNzguNzEsMEgxNy41MDF2MTIuOTQyYzAuOTI3LDAuNDQ1LDEuNzc2LDEuMDE4LDIuNTU2LDEuNjg2VjIuNTVoNTYuMTF2MzguMzgzICAgSDQ5LjE0M2wtMS41NTQsMi41NTJINzguNzFWMHogTTM2LjcwMiw0My40ODVsMS41NjMtMi41NTJoLTguMTcxbDQuNTY0LDIuNTUySDM2LjcwMnogTTU4LjMyMywxNy42MTZsLTEuMjMyLTAuNzA3bC04LjU2NCwxNC45MzcgICBsMS4yMzcsMC43MTJMNTguMzIzLDE3LjYxNnoiIGRhdGEtb3JpZ2luYWw9IiMwMTAwMDIiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiMwMTAwMDIiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+" /> docentes
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="../docente/creardocente.php">
                                        <img style="width: 18px;margin-right: 10px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjEyLjAwMSA2MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MTIuMDAxIDYxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTU2Ny43MzQsNTcuNDdjLTI4LjU5My0yOC41OTMtNjYuNjA3LTQ0LjMzOC0xMDcuMDQ0LTQ0LjMzOGMtNDAuNDM1LDAtNzguNDUxLDE1Ljc0NS0xMDcuMDQxLDQ0LjMzOCAgICAgYy0yOC41OTMsMjguNTkzLTQ0LjM0LDY2LjYwNi00NC4zNCwxMDcuMDQ0YzAsNDAuNDM1LDE1Ljc0Nyw3OC40NDksNDQuMzQsMTA3LjA0MWMyOC41OTIsMjguNTkzLDY2LjYwNiw0NC4zNDEsMTA3LjA0MSw0NC4zNDEgICAgIGM0MC40MzYsMCw3OC40NTItMTUuNzQ4LDEwNy4wNDQtNDQuMzQxQzYyNi43NTcsMjEyLjUzMiw2MjYuNzU3LDExNi40OTQsNTY3LjczNCw1Ny40N3ogTTU0My42OTcsMjQ3LjUxOSAgICAgYy0yMi4xNzEsMjIuMTc0LTUxLjY1MiwzNC4zODQtODMuMDA3LDM0LjM4NGMtMzEuMzU2LDAtNjAuODMzLTEyLjIxLTgzLjAwNC0zNC4zODRjLTIyLjE3My0yMi4xNzEtMzQuMzgzLTUxLjY0OS0zNC4zODMtODMuMDA0ICAgICBzMTIuMjEtNjAuODM2LDM0LjM4My04My4wMDdjMjIuMTcxLTIyLjE3MSw1MS42NS0zNC4zODIsODMuMDA0LTM0LjM4MmMzMS4zNTYsMCw2MC44MzYsMTIuMjEsODMuMDA3LDM0LjM4MiAgICAgQzU4OS40NjYsMTI3LjI3NSw1ODkuNDY2LDIwMS43NSw1NDMuNjk3LDI0Ny41MTl6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGOUY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik01MDguMzc5LDE0Ni44NTNoLTMyLjY4MnYtMzIuNjgxYzAtOS4zODctNy42MS0xNi45OTYtMTYuOTk2LTE2Ljk5NnMtMTYuOTk2LDcuNjA5LTE2Ljk5NiwxNi45OTZ2MzIuNjgxaC0zMi42ODIgICAgIGMtOS4zODYsMC0xNi45OTYsNy42MS0xNi45OTYsMTYuOTk2YzAsOS4zODksNy42MSwxNi45OTYsMTYuOTk2LDE2Ljk5NmgzMi42ODJ2MzIuNjgzYzAsOS4zODksNy42MSwxNi45OTYsMTYuOTk2LDE2Ljk5NiAgICAgczE2Ljk5Ni03LjYwNywxNi45OTYtMTYuOTk2di0zMi42ODNoMzIuNjgyYzkuMzg2LDAsMTYuOTk2LTcuNjA3LDE2Ljk5Ni0xNi45OTYgICAgIEM1MjUuMzc1LDE1NC40NjMsNTE3Ljc2NiwxNDYuODUzLDUwOC4zNzksMTQ2Ljg1M3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y5RjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCQkJPHBhdGggZD0iTTM2MS40MDgsNDcwLjI1NGMtMjMuMjAyLTE2LjM2LTUwLjc2LTI4LjQzMi04MC43NS0zNS42NzVjMjcuODE1LTI0LjA5Miw0NS44NjUtNjIuNjMyLDQ1Ljg2NS0xMDUuOTg0ICAgICBjMC03Mi44MTktNTAuOTIyLTEzMi4wNjItMTEzLjUxNC0xMzIuMDYyYy02Mi41ODksMC0xMTMuNTEyLDU5LjI0Mi0xMTMuNTEyLDEzMi4wNjJjMCw0My4zNTMsMTguMDUsODEuODkzLDQ1Ljg2NSwxMDUuOTg3ICAgICBjLTI5Ljk4OCw3LjIzOS01Ny41NDYsMTkuMzEyLTgwLjc0OCwzNS42NzJDMjIuOTQ3LDQ5OS42MzMsMCw1MzkuMjczLDAsNTgxLjg3NGMwLDkuMzg2LDcuNjEsMTYuOTk2LDE2Ljk5NiwxNi45OTZoMzkyLjAyNyAgICAgYzkuMzg3LDAsMTYuOTk2LTcuNjEsMTYuOTk2LTE2Ljk5NkM0MjYuMDIsNTM5LjI3Myw0MDMuMDczLDQ5OS42MzMsMzYxLjQwOCw0NzAuMjU0eiBNMzI2LjUyMyw1NjQuODc4di0zMC4zNTUgICAgIGMwLTkuMzg2LTcuNjEtMTYuOTk2LTE2Ljk5Ni0xNi45OTZzLTE2Ljk5Niw3LjYxLTE2Ljk5NiwxNi45OTZ2MzAuMzU1SDEzMy40OXYtMzAuMzU1YzAtOS4zODYtNy42MS0xNi45OTYtMTYuOTk2LTE2Ljk5NiAgICAgcy0xNi45OTYsNy42MS0xNi45OTYsMTYuOTk2djMwLjM1NUgzNS43N2M1LjI0OS0yNC45MjIsMjEuOTg5LTQ4LjE5Niw0OC40MzItNjYuODQxYzM0LjE4My0yNC4xMDIsNzkuOTI5LTM3LjM3NiwxMjguODEtMzcuMzc2ICAgICBzOTQuNjI3LDEzLjI3MiwxMjguODA3LDM3LjM3NmMyNi40NDMsMTguNjQ1LDQzLjE4Myw0MS45MTgsNDguNDMsNjYuODQxSDMyNi41MjN6IE0xMzMuNDksMzI4LjU5NiAgICAgYzAtNTQuMDc2LDM1LjY3My05OC4wNyw3OS41Mi05OC4wN2M0My44NDgsMCw3OS41MjIsNDMuOTk2LDc5LjUyMiw5OC4wN2MwLDU0LjA3OS0zNS42NzMsOTguMDczLTc5LjUyLDk4LjA3MyAgICAgUzEzMy40OSwzODIuNjczLDEzMy40OSwzMjguNTk2eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRjlGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />Nuevo docente
                                    </a>
                                </li>
                                <li>
                                    <a href="../docente/carga_academica.php">
                                        <img style="width: 17px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDk4Ljk2NiwzMzkuOTVjLTcuMTk3LDAtMTMuMDM0LDUuODM1LTEzLjAzNCwxMy4wMzR2NDkuODA0YzAsMjguNzQ3LTIzLjM4OCw1Mi4xMzUtNTIuMTM1LDUyLjEzNUg3OC4yMDMgICAgYy0yOC43NDcsMC01Mi4xMzUtMjMuMzg4LTUyLjEzNS01Mi4xMzV2LTQ5LjgwNGMwLTcuMTk5LTUuODM1LTEzLjAzNC0xMy4wMzQtMTMuMDM0QzUuODM1LDMzOS45NSwwLDM0NS43ODUsMCwzNTIuOTg0djQ5LjgwNCAgICBjMCw0My4xMjEsMzUuMDgyLDc4LjIwMyw3OC4yMDMsNzguMjAzaDM1NS41OTRjNDMuMTIxLDAsNzguMjAzLTM1LjA4Miw3OC4yMDMtNzguMjAzdi00OS44MDQgICAgQzUxMiwzNDUuNzg1LDUwNi4xNjUsMzM5Ljk1LDQ5OC45NjYsMzM5Ljk1eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDE5LjgzMywzOTEuMzA1SDkyLjE2N2MtNy4xOTcsMC0xMy4wMzQsNS44MzUtMTMuMDM0LDEzLjAzNHM1LjgzNSwxMy4wMzQsMTMuMDM0LDEzLjAzNGgzMjcuNjY1ICAgIGM3LjE5OSwwLDEzLjAzNC01LjgzNSwxMy4wMzQtMTMuMDM0UzQyNy4wMzEsMzkxLjMwNSw0MTkuODMzLDM5MS4zMDV6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zODYuODgyLDEzNi44MzJMMjc3LjcwOCwzOS4zMDFjLTEyLjM3Ni0xMS4wNTUtMzEuMDQtMTEuMDU3LTQzLjQxNywwbC0xMDkuMTc0LDk3LjUzICAgIGMtNS4zNjksNC43OTUtNS44MzMsMTMuMDM1LTEuMDM3LDE4LjQwNGM0Ljc5NSw1LjM2NywxMy4wMzQsNS44MzUsMTguNDA1LDEuMDM3bDEwMC40ODItODkuNzY0djI1Mi42MSAgICBjMCw3LjE5OSw1LjgzNywxMy4wMzQsMTMuMDM0LDEzLjAzNGM3LjE5OSwwLDEzLjAzNC01LjgzNSwxMy4wMzQtMTMuMDM0VjY2LjUwOGwxMDAuNDgyLDg5Ljc2NCAgICBjMi40ODYsMi4yMjEsNS41ODgsMy4zMTUsOC42NzgsMy4zMTVjMy41ODMsMCw3LjE1LTEuNDY5LDkuNzI2LTQuMzUxQzM5Mi43MTQsMTQ5Ljg2NywzOTIuMjUsMTQxLjYyOSwzODYuODgyLDEzNi44MzJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQkY5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />carga academica
                                    </a>
                                </li>
                                <li>
                                    <a href="../docente/hoja_docente.php">
                                        <img style="width: 20px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2aWV3Qm94PSItMzEgMCA0NzkgNDgwIiB3aWR0aD0iNTEyIiBjbGFzcz0iIj48Zz48cGF0aCBkPSJtMTYuNSAzOTJ2LTM1MmMwLTEzLjI1MzkwNiAxMC43NDYwOTQtMjQgMjQtMjRoMjAwdjU2Yy4wMjczNDQgMjIuMDgyMDMxIDE3LjkxNzk2OSAzOS45NzI2NTYgNDAgNDBoNTZ2NTZoMTZ2LTY0YzAtMi4xMjEwOTQtLjg0Mzc1LTQuMTU2MjUtMi4zNDM3NS01LjY1NjI1bC05Ni05NmMtMS41LTEuNS0zLjUzNTE1Ni0yLjM0Mzc1LTUuNjU2MjUtMi4zNDM3NWgtMjA4Yy0yMi4wODIwMzEuMDI3MzQzOC0zOS45NzI2NTYgMTcuOTE3OTY5LTQwIDQwdjM1MmMuMDI3MzQ0IDIyLjA4MjAzMSAxNy45MTc5NjkgMzkuOTcyNjU2IDQwIDQwaDE1MnYtMTZoLTE1MmMtMTMuMjUzOTA2IDAtMjQtMTAuNzQ2MDk0LTI0LTI0em0yNDAtMzIwdi00NC42ODc1bDY4LjY4NzUgNjguNjg3NWgtNDQuNjg3NWMtMTMuMjUzOTA2IDAtMjQtMTAuNzQ2MDk0LTI0LTI0em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSA0OGgxNnYxNmgtMTZ6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im04MC41IDQ4aDQ4djE2aC00OHptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTQ4LjUgODBoODB2MTZoLTgwem0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSAxNDRoMzJ2MTZoLTMyem0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtOTYuNSAxNDRoNjR2MTZoLTY0em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtMTc2LjUgMTQ0aDEyOHYxNmgtMTI4em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSAxOTJoMTkydjE2aC0xOTJ6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im00OC41IDI0MGg2NHYxNmgtNjR6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im0xMjguNSAyNDBoNDh2MTZoLTQ4em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtMTkyLjUgMjQwaDMydjE2aC0zMnptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTQ4LjUgMjg4aDE4NHYxNmgtMTg0em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtNDguNSAzMzZoNDh2MTZoLTQ4em0wIDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRjlGOSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCBkPSJtMTEyLjUgMzM2aDgwdjE2aC04MHptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTM2OC41IDI2NHYtOGM0LjQxNzk2OSAwIDgtMy41ODIwMzEgOC04IDAtMzUuMzQ3NjU2LTI4LjY1MjM0NC02NC02NC02NHMtNjQgMjguNjUyMzQ0LTY0IDY0YzAgNC40MTc5NjkgMy41ODIwMzEgOCA4IDh2OGMwIDMwLjkyOTY4OCAyNS4wNzAzMTIgNTYgNTYgNTZzNTYtMjUuMDcwMzEyIDU2LTU2em0tNTYtNjRjMjMuNDE0MDYyLjAzMTI1IDQzLjQwMjM0NCAxNi45MTc5NjkgNDcuMzM1OTM4IDQwaC00NGwtMjEuNjU2MjUtMjEuNjU2MjVjLTEuOTYwOTM4LTEuOTU3MDMxLTQuNzkyOTY5LTIuNzYxNzE5LTcuNDkyMTg4LTIuMTI1LTIuNjk1MzEyLjYzNjcxOS00Ljg3MTA5NCAyLjYyNS01Ljc0NjA5NCA1LjI1MzkwNmwtNi4yMTA5MzcgMTguNTI3MzQ0aC05LjU5NzY1N2MzLjkzNzUtMjMuMDkzNzUgMjMuOTQxNDA3LTM5Ljk4NDM3NSA0Ny4zNjcxODgtNDB6bTAgMTA0Yy0yMi4wODIwMzEtLjAyNzM0NC0zOS45NzI2NTYtMTcuOTE3OTY5LTQwLTQwdi04aDhjMy40NDE0MDYtLjAwMzkwNiA2LjQ5NjA5NC0yLjIwNzAzMSA3LjU4NTkzOC01LjQ3MjY1NmwzLjkxNzk2OC0xMS43MTA5MzggMTQuODM5ODQ0IDE0LjgzOTg0NGMxLjUgMS41IDMuNTM1MTU2IDIuMzQzNzUgNS42NTYyNSAyLjM0Mzc1aDQwdjhjLS4wMjczNDQgMjIuMDgyMDMxLTE3LjkxNzk2OSAzOS45NzI2NTYtNDAgNDB6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIGQ9Im0zMjguNSAzMjBoLTMyYy00OC41NzgxMjUuMDU4NTk0LTg3Ljk0MTQwNiAzOS40MjE4NzUtODggODh2NjRjMCA0LjQxNzk2OSAzLjU4MjAzMSA4IDggOGgxOTJjNC40MTc5NjkgMCA4LTMuNTgyMDMxIDgtOHYtNjRjLS4wNTg1OTQtNDguNTc4MTI1LTM5LjQyMTg3NS04Ny45NDE0MDYtODgtODh6bTAgMTZjMi44Nzg5MDYuMDE1NjI1IDUuNzUzOTA2LjIwMzEyNSA4LjYwOTM3NS41NjY0MDZsLTI0LjYwOTM3NSAzMy44MzIwMzItMjQuNjA5Mzc1LTMzLjgzMjAzMmMyLjg1NTQ2OS0uMzYzMjgxIDUuNzMwNDY5LS41NTA3ODEgOC42MDkzNzUtLjU2NjQwNnptLTEwNCA3MmMuMDUwNzgxLTI5Ljk0MTQwNiAxOC42MDkzNzUtNTYuNzMwNDY5IDQ2LjYyNS02Ny4yOTY4NzVsMzMuMzc1IDQ1Ljg5ODQzN3Y3Ny4zOTg0MzhoLTQ4di03MmgtMTZ2NzJoLTE2em0xNzYgNTZoLTE2di03MmgtMTZ2NzJoLTQ4di03Ny4zOTg0MzhsMzMuMzc1LTQ1Ljg5ODQzN2MyOC4wMTU2MjUgMTAuNTY2NDA2IDQ2LjU3NDIxOSAzNy4zNTU0NjkgNDYuNjI1IDY3LjI5Njg3NXptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0Y5RjkiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PHBhdGggZD0ibTM0NC41IDM2OGgxNnYxNmgtMTZ6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkNGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjwvZz4gPC9zdmc+" /> Hoja de
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img style="width: 18px;margin-right: 10px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzk3LjczNiw3OC4zNzhjNi44MjQsMCwxMi4zNTgtNS41MzMsMTIuMzU4LTEyLjM1OFYyNy4wMjdDNDEwLjA5NCwxMi4xMjUsMzk3Ljk3NywwLDM4My4wOCwwSDEyMS42NDEgICAgYy0zLjI3NywwLTYuNDIsMS4zMDMtOC43MzksMy42MkwxMC41MjcsMTA1Ljk5NWMtMi4zMTcsMi4zMTctMy42Miw1LjQ2MS0zLjYyLDguNzM4djM3MC4yMzlDNi45MDgsNDk5Ljg3NSwxOS4wMzIsNTEyLDMzLjkzNSw1MTIgICAgaDM0OS4xNDRjMTQuODk3LDAsMjcuMDE0LTEyLjEyNSwyNy4wMTQtMjcuMDI3VjI5Ni4yODljMC4wMDEtNi44MjQtNS41MzItMTIuMzU4LTEyLjM1Ny0xMi4zNTggICAgYy02LjgyNCwwLTEyLjM1OCw1LjUzMy0xMi4zNTgsMTIuMzU4djE4OC42ODRjMCwxLjI3NC0xLjAzMSwyLjMxMS0yLjI5NywyLjMxMUgzMy45MzZjLTEuMjc0LDAtMi4zMTEtMS4wMzctMi4zMTEtMi4zMTF2LTM1Ny44OCAgICBoNzUuMzZjMTQuODk4LDAsMjcuMDE2LTEyLjEyLDI3LjAxNi0yNy4wMTdWMjQuNzE2SDM4My4wOGMxLjI2NywwLDIuMjk3LDEuMDM3LDIuMjk3LDIuMzExVjY2LjAyICAgIEMzODUuMzc3LDcyLjg0NSwzOTAuOTExLDc4LjM3OCwzOTcuNzM2LDc4LjM3OHogTTEwOS4yODUsMTAwLjA3NWMwLDEuMjY5LTEuMDMyLDIuMzAxLTIuMywyLjMwMUg0OS4xMDdsNjAuMTc4LTYwLjE4VjEwMC4wNzV6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGQ0ZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OTIuODY1LDEwMC4zOTZsLTE0LjU0MS0xNC41MzljLTE2LjMwNC0xNi4zMDQtNDIuODMyLTE2LjMwMi01OS4xMzgsMEwzMDMuNzYzLDIwMS4yOEgxMDMuNTU5ICAgIGMtNi44MjUsMC0xMi4zNTgsNS41MzMtMTIuMzU4LDEyLjM1OGMwLDYuODI1LDUuNTMzLDEyLjM1OCwxMi4zNTgsMTIuMzU4aDE3NS40ODhsLTc0LjM3OSw3NC4zNzlIMTAzLjU1OSAgICBjLTYuODI1LDAtMTIuMzU4LDUuNTMzLTEyLjM1OCwxMi4zNThzNS41MzMsMTIuMzU4LDEyLjM1OCwxMi4zNThoNzYuMzkybC0wLjE5OSwwLjE5OWMtMS41MDgsMS41MDgtMi41OTgsMy4zNzktMy4xNjksNS40MzMgICAgbC0xOS4wODgsNjguNzQ3aC01My45MzZjLTYuODI1LDAtMTIuMzU4LDUuNTMzLTEyLjM1OCwxMi4zNThzNS41MzMsMTIuMzU4LDEyLjM1OCwxMi4zNThoNjMuMzMyYzAuMDAxLDAsMi43MDktMC4zMDYsMy4xMDctMC40MSAgICBjMC4wNjUtMC4wMTcsNzcuOTk3LTIxLjY0Miw3Ny45OTctMjEuNjQyYzIuMDU0LTAuNTcsMy45MjYtMS42NjIsNS40MzMtMy4xNjlsMjM5LjQzOC0yMzkuNDM1ICAgIEM1MDkuMTY4LDE0My4yMjgsNTA5LjE2OCwxMTYuNyw0OTIuODY1LDEwMC4zOTZ6IE0xODQuNjQ0LDM5NC4wNzNsMTAuMDg3LTM2LjMyNmwyNi4yNCwyNi4yNEwxODQuNjQ0LDM5NC4wNzN6IE0yNDQuNjksMzcyLjc1MiAgICBsLTM4LjcyMS0zOC43MjFsMTk3LjY0OC0xOTcuNjQ4bDM4LjcyMiwzOC43MjFMMjQ0LjY5LDM3Mi43NTJ6IE00NzUuMzg3LDE0Mi4wNTRsLTE1LjU3MSwxNS41NzFsLTM4LjcyMi0zOC43MjJsMTUuNTcxLTE1LjU3MSAgICBjNi42NjktNi42NjgsMTcuNTE3LTYuNjY3LDI0LjE4MSwwbDE0LjU0MSwxNC41NDFDNDgyLjA1NCwxMjQuNTQsNDgyLjA1NCwxMzUuMzg4LDQ3NS4zODcsMTQyLjA1NHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZDRkFGQSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />Seguimiento
                                    </a>
                                </li> 
                                <li>
                                    <a href="#">
                                        <img style="width: 18px;margin-right: 10px"    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTk4LjA0IDE5OC4wNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTk4LjA0IDE5OC4wNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48cGF0aCBkPSJNMTgwLjcyNywxOC40MDFjLTAuMzE4LTIuMTA5LTEuOTQtMy43ODUtNC4wMzgtNC4xNzFMOTkuOTI2LDAuMDgzYy0wLjYtMC4xMS0xLjIxMy0wLjExLTEuODEzLDBMMjEuMzUsMTQuMjMgIGMtMi4wOTgsMC4zODYtMy43MiwyLjA2Mi00LjAzOCw0LjE3MWMtMC4zMjgsMi4xNjktNy44NDEsNTMuNjM1LDcuMjU4LDk4LjE1N2MxNS4yOCw0NS4wNTYsNjkuNTAxLDc5LjI4OSw3MS44MDIsODAuNzI0ICBjMC44MSwwLjUwNSwxLjcyOSwwLjc1OCwyLjY0NiwwLjc1OHMxLjgzNy0wLjI1MiwyLjY0Ni0wLjc1OGMyLjMwMS0xLjQzNSw1Ni41MjItMzUuNjY4LDcxLjgwNC04MC43MjQgIEMxODguNTY5LDcyLjAzNiwxODEuMDU1LDIwLjU3LDE4MC43MjcsMTguNDAxeiBNOTkuMDIsOTcuNDMzSDM1LjIxNWMtNy41MDgtMzMuNDE0LTIuMjc5LTY3LjQxMy0yLjI3OS02Ny40MTNMOTkuMDIsMTguMDhWOTcuNDMzeiAgIE0xNTkuMDM1LDExMC44ODFjLTEyLjgxMiwzNy4wMzctNjAuMDE1LDY1LjkwNi02MC4wMTUsNjUuOTA2Vjk3LjQzM2g2My44MDVDMTYxLjgwOSwxMDEuOTU1LDE2MC41NjIsMTA2LjQ2NiwxNTkuMDM1LDExMC44ODF6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZBRkEiIGRhdGEtb2xkX2NvbG9yPSIjRkJGNkY2Ij48L3BhdGg+PC9nPiA8L3N2Zz4=" />permisos
                                    </a>
                                </li> 
                            </ul>
                            <a href="#">
                                <img style="width: 20px;margin-right: 10px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAyOTcgMjk3IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyOTcgMjk3IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+CiAgICA8cGF0aCBkPSJNMTQ4LjUwNSw2MS42NTFjMTYuOTk4LDAsMzAuODI2LTEzLjgyOCwzMC44MjYtMzAuODI2QzE3OS4zMzEsMTMuODI4LDE2NS41MDMsMCwxNDguNTA1LDAgICBjLTE2Ljk5NywwLTMwLjgyNSwxMy44MjgtMzAuODI1LDMwLjgyNkMxMTcuNjgsNDcuODIzLDEzMS41MDgsNjEuNjUxLDE0OC41MDUsNjEuNjUxeiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkRGQ0ZDIiBkYXRhLW9sZF9jb2xvcj0iI0ZCRjlGOSI+PC9wYXRoPgogICAgPHBhdGggZD0ibTIyNi41OSwxNTEuOTUxaC0xNTYuMThjLTQuMjU3LDAtNy43MjIsMy40NjQtNy43MjIsNy43MjJ2MTQuNjIxYzAsNC4yNTcgMy40NjQsNy43MjIgNy43MjIsNy43MjJoMTU2LjE4YzQuMjU3LDAgNy43MjItMy40NjQgNy43MjItNy43MjJ2LTE0LjYyMWMtMC4wMDEtNC4yNTctMy40NjUtNy43MjItNy43MjItNy43MjJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGREZDRkMiIGRhdGEtb2xkX2NvbG9yPSIjRkJGOUY5Ij48L3BhdGg+CiAgICA8cGF0aCBkPSJtMTk4LjU2LDE5NC4zNDhoLTEwMC4xMmMtNS4yNzIsMC05LjU0NSw0LjI3NC05LjU0NSw5LjU0NXY4NC4zNzFjMCw0LjgyNCAzLjkxMSw4LjczNSA4LjczNSw4LjczNWgxMDEuNzRjNC44MjQsMCA4LjczNS0zLjkxMSA4LjczNS04LjczNXYtODQuMzcxYy0yLjg0MjE3ZS0xNC01LjI3MS00LjI3My05LjU0NS05LjU0NS05LjU0NXoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZERkNGQyIgZGF0YS1vbGRfY29sb3I9IiNGQkY5RjkiPjwvcGF0aD4KICAgIDxwYXRoIGQ9Im0yMDguNTU3LDEwMi4zNzNjMC0xMS43My03LjUzOC0yMi4xMzItMTguNjg2LTI1Ljc4NGwtLjA1Mi0uMDE3LTE2LjMwNC0yLjdjLTEuMzg4LTAuNDI3LTIuODcsMC4zMDgtMy4zNjksMS42NzdsLTE4LjUsNTAuNzZjLTEuMDY3LDIuOTI4LTUuMjA5LDIuOTI4LTYuMjc2LDBsLTE4LjUtNTAuNzZjLTAuNDAzLTEuMTA2LTEuNDQ2LTEuNzk5LTIuNTY0LTEuNzk5LTAuMjY1LDAtMTcuMTA5LDIuODE4LTE3LjEwOSwyLjgxOC0xMS4yMzksMy43NDUtMTguNzQ4LDE0LjE2NC0xOC43NDgsMjUuOTQ1djM3LjEwNmgxMjAuMTA5di0zNy4yNDZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGREZDRkMiIGRhdGEtb2xkX2NvbG9yPSIjRkJGOUY5Ij48L3BhdGg+CiAgICA8cGF0aCBkPSJtMTU1LjU3MSw3My4xMDVjLTAuNzQ3LTAuODE0LTEuODQtMS4yMjQtMi45NDYtMS4yMjRoLTguMjQ1Yy0xLjEwNSwwLTIuMTk4LDAuNDEtMi45NDYsMS4yMjQtMS4xNTcsMS4yNjEtMS4zMjUsMy4wODItMC41MDQsNC41MDVsNC40MDcsNi42NDQtMi4wNjMsMTcuNDA1IDQuMDYzLDEwLjgwOGMwLjM5NiwxLjA4NyAxLjkzMywxLjA4NyAyLjMzLDBsNC4wNjMtMTAuODA4LTIuMDYzLTE3LjQwNSA0LjQwNy02LjY0NGMwLjgyMi0xLjQyMyAwLjY1NC0zLjI0NC0wLjUwMy00LjUwNXoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZERkNGQyIgZGF0YS1vbGRfY29sb3I9IiNGQkY5RjkiPjwvcGF0aD4KICA8L2c+PC9nPiA8L3N2Zz4=" />capacitacion
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="../alumnos/crear_alumno.php"><i class="fa fa-circle-o"></i> registrar</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> competencia</a></li> 
                            </ul>                           
                        </li>
                    </ul>
                </li>

                 <li class=" treeview  ">
                <a href="#">
                    <i>
                            <img style="width: 20px;margin-right: 10px"  src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxNzA4IDE3MDguNzQ5NSIgd2lkdGg9IjUxMiIgY2xhc3M9IiI+PGc+PGcgaWQ9InN1cmZhY2UxIj4KPHBhdGggZD0iTSAyMjQuOTQxNDA2IDMwNS4zNTU0NjkgQyAyMzAuMjgxMjUgMzA2LjY5NTMxMiAyMzUuMTY3OTY5IDMwOS40NjQ4NDQgMjM5LjA2MjUgMzEzLjM1NTQ2OSBMIDY3NC4xMzY3MTkgNzQ4LjQzNzUgTCA3NTIuODYzMjgxIDY2OS43MTg3NSBMIDMxNy43ODEyNSAyMzQuNjM2NzE5IEMgMzEzLjg3ODkwNiAyMzAuNzM4MjgxIDMxMS4xMjEwOTQgMjI1LjgzNTkzOCAzMDkuNzczNDM4IDIyMC40ODA0NjkgTCAyODIuMzkwNjI1IDExMS4zMjQyMTkgTCAxMDAuODY3MTg4IDcuNTQ2ODc1IEwgMTEuOTc2NTYyIDk2LjQzMzU5NCBMIDExNS43ODUxNTYgMjc4LjA4MjAzMSBaIE0gMjI0Ljk0MTQwNiAzMDUuMzU1NDY5ICIgc3R5bGU9ImZpbGw6I0ZCRkJGQiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0QxQTBBMCI+PC9wYXRoPgo8cGF0aCBkPSJNIDYxMS44MjQyMTkgMTI5Ny43ODkwNjIgTCAxMzAyLjIxODc1IDYwNy4zODI4MTIgQyAxMzA5Ljc4MTI1IDU5OS44MTI1IDEzMjAuNzUzOTA2IDU5Ni43NzczNDQgMTMzMS4xMjg5MDYgNTk5LjM1OTM3NSBDIDE0MjIuMDI3MzQ0IDYyMi42NTYyNSAxNTE4LjU3ODEyNSA2MDIuNDY4NzUgMTU5Mi41NTg1OTQgNTQ0Ljc1IEMgMTY2Ni41NTA3ODEgNDg3LjAyNzM0NCAxNzA5LjU4OTg0NCAzOTguMjYxNzE5IDE3MDkuMDkzNzUgMzA0LjQyOTY4OCBDIDE3MDkuMDkzNzUgMjk4LjcxNDg0NCAxNzA4LjkyNTc4MSAyOTIuOTU3MDMxIDE3MDguNTU0Njg4IDI4Ny4xNDg0MzggTCAxNTQ3Ljk3NjU2MiA0NDcuNzA3MDMxIEMgMTUzOS44Mzk4NDQgNDU1Ljg1MTU2MiAxNTI3Ljc3MzQzOCA0NTguNzA3MDMxIDE1MTYuODM1OTM4IDQ1NS4wNTg1OTQgTCAxMzM0LjE5OTIxOSAzOTQuMTcxODc1IEMgMTMyNS4xMDU0NjkgMzkxLjE2MDE1NiAxMzE3Ljk3MjY1NiAzODQuMDI3MzQ0IDEzMTQuOTM3NSAzNzQuOTQxNDA2IEwgMTI1NC4wNjY0MDYgMTkyLjMwMDc4MSBDIDEyNTAuNDE0MDYyIDE4MS4zNzg5MDYgMTI1My4yNjE3MTkgMTY5LjMwODU5NCAxMjYxLjQxNzk2OSAxNjEuMTU2MjUgTCAxNDIxLjk5MjE4OCAwLjU4NTkzOCBDIDEzMjUuMjk2ODc1IC01LjQyOTY4OCAxMjMxLjU1MDc4MSAzNS4xOTUzMTIgMTE2OS43ODkwNjIgMTA5LjgzNTkzOCBDIDExMDguMDM1MTU2IDE4NC40OTIxODggMTA4NS43MTg3NSAyODQuMTg3NSAxMTA5LjczODI4MSAzNzguMDM1MTU2IEMgMTExMi4zMzk4NDQgMzg4LjQyNTc4MSAxMTA5LjMwODU5NCAzOTkuMzk0NTMxIDExMDEuNzM4MjgxIDQwNi45NjA5MzggTCA0MTEuMzU1NDY5IDEwOTcuMzIwMzEyIEMgNDAzLjc4MTI1IDExMDQuODMyMDMxIDM5Mi44MjAzMTIgMTEwNy44Nzg5MDYgMzgyLjQzNzUgMTEwNS4zMzU5MzggQyAzNTguNDAyMzQ0IDEwOTkuMTY0MDYyIDMzMy42ODM1OTQgMTA5NS45NjQ4NDQgMzA4Ljg1NTQ2OSAxMDk1Ljg2NzE4OCBDIDE3Ny43NTc4MTIgMTA5NS4wMDM5MDYgNjAuNjIxMDk0IDExNzcuNjQ4NDM4IDE3LjQ1NzAzMSAxMzAxLjQ2NDg0NCBDIC0yNS42ODM1OTQgMTQyNS4yNjk1MzEgMTQuNzE4NzUgMTU2Mi44MjAzMTIgMTE3Ljk2ODc1IDE2NDMuNjI1IEMgMjIxLjIxODc1IDE3MjQuNDI5Njg4IDM2NC40NDUzMTIgMTczMC42MDkzNzUgNDc0LjI1NzgxMiAxNjU4Ljk2ODc1IEMgNTg0LjA3ODEyNSAxNTg3LjMzMjAzMSA2MzYuMTQ4NDM4IDE0NTMuNzY5NTMxIDYwMy43ODUxNTYgMTMyNi42OTkyMTkgQyA2MDEuMjEwOTM4IDEzMTYuMzI4MTI1IDYwNC4yNTM5MDYgMTMwNS4zMzk4NDQgNjExLjgyNDIxOSAxMjk3Ljc4OTA2MiBaIE0gMzgyLjk0OTIxOSAxNTIyLjAzMTI1IEwgMjM0Ljc4NTE1NiAxNTIyLjAzMTI1IEwgMTYxLjcxMDkzOCAxNDAwLjI3NzM0NCBMIDIzNC43ODUxNTYgMTI3OC41MDM5MDYgTCAzODIuOTQ5MjE5IDEyNzguNTAzOTA2IEwgNDU2LjAwNzgxMiAxNDAwLjI3NzM0NCBaIE0gNTAwLjQyNTc4MSAxMTY1LjY2Nzk2OSBMIDExNzAuMDk3NjU2IDQ5NS45ODgyODEgTCAxMjEzLjEzMjgxMiA1MzkuMDMxMjUgTCA1NDMuNDYwOTM4IDEyMDguNzEwOTM4IFogTSA1MDAuNDI1NzgxIDExNjUuNjY3OTY5ICIgc3R5bGU9ImZpbGw6I0ZCRkJGQiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0QxQTBBMCI+PC9wYXRoPgo8cGF0aCBkPSJNIDE0NTkuNSAxNjkyLjg2NzE4OCBDIDE1MjcuMzAwNzgxIDE3MTguMzU5Mzc1IDE2MDMuNzQyMTg4IDE3MDEuODI4MTI1IDE2NTQuOTY0ODQ0IDE2NTAuNjA5Mzc1IEMgMTcwNi4xOTE0MDYgMTU5OS4zNzUgMTcyMi43MjY1NjIgMTUyMi45MjE4NzUgMTY5Ny4yMjI2NTYgMTQ1NS4xMzY3MTkgWiBNIDE0NTkuNSAxNjkyLjg2NzE4OCAiIHN0eWxlPSJmaWxsOiNGQkZCRkIiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiNEMUEwQTAiPjwvcGF0aD4KPHBhdGggZD0iTSAxNjU0Ljk2ODc1IDEzODkuMTk5MjE5IEwgMTMxMy4wODIwMzEgMTA0Ny4xNzU3ODEgQyAxMjc1LjM3MTA5NCAxMDc4Ljg3NSAxMjE5LjY4MzU5NCAxMDc2LjQ2NDg0NCAxMTg0LjgyODEyNSAxMDQxLjY1MjM0NCBDIDExNDkuOTY4NzUgMTAwNi44NDc2NTYgMTE0Ny41MTE3MTkgOTUxLjE3NTc4MSAxMTc5LjE1NjI1IDkxMy40MjU3ODEgTCAxMTMwLjczODI4MSA4NjQuOTQ5MjE5IEwgODY5LjM4MjgxMiAxMTI2LjMxNjQwNiBMIDkxOC4wOTM3NSAxMTc1LjAyMzQzOCBDIDk1NS44MDQ2ODggMTE0My4zMjQyMTkgMTAxMS41IDExNDUuNzI2NTYyIDEwNDYuMzM1OTM4IDExODAuNTI3MzQ0IEMgMTA4MS4xOTE0MDYgMTIxNS4zMzk4NDQgMTA4My42NjQwNjIgMTI3MS4wMTk1MzEgMTA1Mi4wMTU2MjUgMTMwOC43NzM0MzggTCAxMzkzLjYxMzI4MSAxNjUwLjU1MDc4MSBDIDEzOTcuMzM5ODQ0IDE2NTQuMjc3MzQ0IDE0MDEuMjczNDM4IDE2NTcuNzMwNDY5IDE0MDUuMjQ2MDk0IDE2NjEuMDg5ODQ0IEwgMTY2NS41MTU2MjUgMTQwMC44MjAzMTIgQyAxNjYyLjE2NDA2MiAxMzk2LjgzOTg0NCAxNjU4LjY5NTMxMiAxMzkyLjkyMTg3NSAxNjU0Ljk2ODc1IDEzODkuMTk5MjE5IFogTSAxNDc0LjQ5MjE4OCAxNTEzLjEwNTQ2OSBMIDExNzAuMDk3NjU2IDEyMDguNzEwOTM4IEwgMTIxMy4xMzI4MTIgMTE2NS42Njc5NjkgTCAxNTE3LjUzNTE1NiAxNDcwLjA3ODEyNSBaIE0gMTQ3NC40OTIxODggMTUxMy4xMDU0NjkgIiBzdHlsZT0iZmlsbDojRkJGQkZCIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjRDFBMEEwIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==" />
                        </i> <span>Herramienta</span>
                    <span class="pull-right-container"> 
                        <small class="label pull-right bg-teal">6</small>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
    
     

                        <a href="#">
                            <i class="fa fa-circle-o"></i> 
                            Contabilidad    
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Aporte voluntario
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                     
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Articulos  
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
    
     

                        <a href="#">
                            <i class="fa fa-circle-o"></i> 
                            Pago$
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Aporte voluntario
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                     
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Articulos  
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
    
     

                        <a href="#">
                            <i class="fa fa-circle-o"></i> 
                            Pagina web
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Galeria imagenes 
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                     
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Articulos  
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Carnes
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    Estudiantes 
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    maestros 
                                </a>
                            </li>
                            <li>
                                <a href="../alumnos/matricula_antiguo.php">
                                    <i class="fa fa-circle-o"></i> 
                                    maestros 
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Eleciones estudiantil</a></li>
                    <li> <a href="../logros/logros.php"><i class="fa fa-circle-o"></i> Videos Tutoriales</a></li> 
                        
                        
                    </li>
                </ul>
            </li>
               
                    <li class=" treeview  ">
                        <a href="#">
                            <i  >
                                <img style="width: 20px;margin-right: 10px"  src="data:image/svg+xml;base64,
                                PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDQ4IDQ0OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDQ4IDQ0ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxnPgoJCQk8cG9seWdvbiBwb2ludHM9IjIzNC42NjcsMTM4LjY2NyAyMzQuNjY3LDI0NS4zMzMgMzI1Ljk3MywyOTkuNTIgMzQxLjMzMywyNzMuNiAyNjYuNjY3LDIyOS4zMzMgMjY2LjY2NywxMzguNjY3ICAgICIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wb2x5Z29uPgoJCQk8cGF0aCBkPSJNMjU1Ljg5MywzMkMxNDkuNzYsMzIsNjQsMTE3Ljk3Myw2NCwyMjRIMGw4My4wOTMsODMuMDkzbDEuNDkzLDMuMDkzTDE3MC42NjcsMjI0aC02NCAgICAgYzAtODIuNDUzLDY2Ljg4LTE0OS4zMzMsMTQ5LjMzMy0xNDkuMzMzUzQwNS4zMzMsMTQxLjU0Nyw0MDUuMzMzLDIyNFMzMzguNDUzLDM3My4zMzMsMjU2LDM3My4zMzMgICAgIGMtNDEuMjgsMC03OC41MDctMTYuODUzLTEwNS40OTMtNDMuODRMMTIwLjMyLDM1OS42OEMxNTQuOTg3LDM5NC40NTMsMjAyLjg4LDQxNiwyNTUuODkzLDQxNkMzNjIuMDI3LDQxNiw0NDgsMzMwLjAyNyw0NDgsMjI0ICAgICBTMzYyLjAyNywzMiwyNTUuODkzLDMyeiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkJGOUY5IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />
                            </i> 
                            <span>Historia</span>
                            <span class="pull-right-container">

                                   <small class="label pull-right label-info">  4 </small>
                            </span>
                        </a>
                    </li>
            
                    <li class="   ">
                        <a href="../mensajes/compose.php">
                            <i  >
                                <img  style="width: 18px;margin-right: 10px"   src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTEwLjY4OCw5NS4xNTZDODAuOTU4LDE1NC42NjcsMjA0LjI2LDI1OS4zNjUsMjQwLjUsMjkyLjAxYzQuODY1LDQuNDA2LDEwLjA4Myw2LjY0NiwxNS41LDYuNjQ2ICAgICBjNS40MDYsMCwxMC42MTUtMi4yMTksMTUuNDY5LTYuNjA0YzM2LjI3MS0zMi42NzcsMTU5LjU3My0xMzcuMzg1LDIyOS44NDQtMTk2Ljg5NmM0LjM3NS0zLjY5OCw1LjA0Mi0xMC4xOTgsMS41LTE0LjcxOSAgICAgQzQ5NC42MjUsNjkuOTksNDgyLjQxNyw2NCw0NjkuMzMzLDY0SDQyLjY2N2MtMTMuMDgzLDAtMjUuMjkyLDUuOTktMzMuNDc5LDE2LjQzOEM1LjY0Niw4NC45NTgsNi4zMTMsOTEuNDU4LDEwLjY4OCw5NS4xNTZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojRkZGRkZGIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik01MDUuODEzLDEyNy40MDZjLTMuNzgxLTEuNzYtOC4yMjktMS4xNDYtMTEuMzc1LDEuNTQyQzQxNi41MSwxOTUuMDEsMzE3LjA1MiwyNzkuNjg4LDI4NS43NiwzMDcuODg1ICAgICBjLTE3LjU2MywxNS44NTQtNDEuOTM4LDE1Ljg1NC01OS41NDItMC4wMjFjLTMzLjM1NC0zMC4wNTItMTQ1LjA0Mi0xMjUtMjA4LjY1Ni0xNzguOTE3Yy0zLjE2Ny0yLjY4OC03LjYyNS0zLjI4MS0xMS4zNzUtMS41NDIgICAgIEMyLjQxNywxMjkuMTU2LDAsMTMyLjkyNywwLDEzNy4wODN2MjY4LjI1QzAsNDI4Ljg2NSwxOS4xMzUsNDQ4LDQyLjY2Nyw0NDhoNDI2LjY2N0M0OTIuODY1LDQ0OCw1MTIsNDI4Ljg2NSw1MTIsNDA1LjMzMyAgICAgdi0yNjguMjVDNTEyLDEzMi45MjcsNTA5LjU4MywxMjkuMTQ2LDUwNS44MTMsMTI3LjQwNnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiIHN0eWxlPSJmaWxsOiNGRkZGRkYiPjwvcGF0aD4KCQk8L2c+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
                            </i> 
                            <span>Mensajes</span> 
                        </a>
                    </li>
            
                    <li class="   ">
                        <a href="../perfil/perfil.php">
                            <i  >
                                <img style="width: 20px;margin-right: 10px"    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTMgNTMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzIDUzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSJob3ZlcmVkLXBhdGhzIj48Zz48cGF0aCBzdHlsZT0iZmlsbDojMjIyRDMyIiBkPSJNMTguNjEzLDQxLjU1MmwtNy45MDcsNC4zMTNjLTAuNDY0LDAuMjUzLTAuODgxLDAuNTY0LTEuMjY5LDAuOTAzQzE0LjA0Nyw1MC42NTUsMTkuOTk4LDUzLDI2LjUsNTMgIGM2LjQ1NCwwLDEyLjM2Ny0yLjMxLDE2Ljk2NC02LjE0NGMtMC40MjQtMC4zNTgtMC44ODQtMC42OC0xLjM5NC0wLjkzNGwtOC40NjctNC4yMzNjLTEuMDk0LTAuNTQ3LTEuNzg1LTEuNjY1LTEuNzg1LTIuODg4di0zLjMyMiAgYzAuMjM4LTAuMjcxLDAuNTEtMC42MTksMC44MDEtMS4wM2MxLjE1NC0xLjYzLDIuMDI3LTMuNDIzLDIuNjMyLTUuMzA0YzEuMDg2LTAuMzM1LDEuODg2LTEuMzM4LDEuODg2LTIuNTN2LTMuNTQ2ICBjMC0wLjc4LTAuMzQ3LTEuNDc3LTAuODg2LTEuOTY1di01LjEyNmMwLDAsMS4wNTMtNy45NzctOS43NS03Ljk3N3MtOS43NSw3Ljk3Ny05Ljc1LDcuOTc3djUuMTI2ICBjLTAuNTQsMC40ODgtMC44ODYsMS4xODUtMC44ODYsMS45NjV2My41NDZjMCwwLjkzNCwwLjQ5MSwxLjc1NiwxLjIyNiwyLjIzMWMwLjg4NiwzLjg1NywzLjIwNiw2LjYzMywzLjIwNiw2LjYzM3YzLjI0ICBDMjAuMjk2LDM5Ljg5OSwxOS42NSw0MC45ODYsMTguNjEzLDQxLjU1MnoiIGRhdGEtb3JpZ2luYWw9IiNFN0VDRUQiIGNsYXNzPSJob3ZlcmVkLXBhdGggYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjRTdFQ0VEIj48L3BhdGg+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGIiBkPSJNMjYuOTUzLDAuMDA0QzEyLjMyLTAuMjQ2LDAuMjU0LDExLjQxNCwwLjAwNCwyNi4wNDdDLTAuMTM4LDM0LjM0NCwzLjU2LDQxLjgwMSw5LjQ0OCw0Ni43NiAgIGMwLjM4NS0wLjMzNiwwLjc5OC0wLjY0NCwxLjI1Ny0wLjg5NGw3LjkwNy00LjMxM2MxLjAzNy0wLjU2NiwxLjY4My0xLjY1MywxLjY4My0yLjgzNXYtMy4yNGMwLDAtMi4zMjEtMi43NzYtMy4yMDYtNi42MzMgICBjLTAuNzM0LTAuNDc1LTEuMjI2LTEuMjk2LTEuMjI2LTIuMjMxdi0zLjU0NmMwLTAuNzgsMC4zNDctMS40NzcsMC44ODYtMS45NjV2LTUuMTI2YzAsMC0xLjA1My03Ljk3Nyw5Ljc1LTcuOTc3ICAgczkuNzUsNy45NzcsOS43NSw3Ljk3N3Y1LjEyNmMwLjU0LDAuNDg4LDAuODg2LDEuMTg1LDAuODg2LDEuOTY1djMuNTQ2YzAsMS4xOTItMC44LDIuMTk1LTEuODg2LDIuNTMgICBjLTAuNjA1LDEuODgxLTEuNDc4LDMuNjc0LTIuNjMyLDUuMzA0Yy0wLjI5MSwwLjQxMS0wLjU2MywwLjc1OS0wLjgwMSwxLjAzVjM4LjhjMCwxLjIyMywwLjY5MSwyLjM0MiwxLjc4NSwyLjg4OGw4LjQ2Nyw0LjIzMyAgIGMwLjUwOCwwLjI1NCwwLjk2NywwLjU3NSwxLjM5LDAuOTMyYzUuNzEtNC43NjIsOS4zOTktMTEuODgyLDkuNTM2LTE5LjlDNTMuMjQ2LDEyLjMyLDQxLjU4NywwLjI1NCwyNi45NTMsMC4wMDR6IiBkYXRhLW9yaWdpbmFsPSIjNTU2MDgwIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzU1NjA4MCI+PC9wYXRoPgo8L2c+PC9nPiA8L3N2Zz4=" />
                            </i> 
                            <span>Perfil</span> 
                        </a>
                    </li>
                    <li class=" treeview  ">
                        <a href="#">
                            <i  >
                                <img style="width: 20px;margin-right: 10px"  src="data:image/svg+xml;base64,
                                PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTUxMC4zNzEsMjI2LjUxM2MtMS4wODgtMi42MDMtMi42NDUtNC45NzEtNC42MjktNi45NTVsLTYzLjk3OS02My45NzljLTguMzQxLTguMzItMjEuODI0LTguMzItMzAuMTY1LDAgICAgIGMtOC4zNDEsOC4zNDEtOC4zNDEsMjEuODQ1LDAsMzAuMTY1bDI3LjU4NCwyNy41ODRIMzIwLjAxM2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzNzOS41MzYsMjEuMzMzLDIxLjMzMywyMS4zMzMgICAgIGgxMTkuMTY4bC0yNy41ODQsMjcuNTg0Yy04LjM0MSw4LjM0MS04LjM0MSwyMS44NDUsMCwzMC4xNjVjNC4xNiw0LjE4MSw5LjYyMSw2LjI1MSwxNS4wODMsNi4yNTFzMTAuOTIzLTIuMDY5LDE1LjA4My02LjI1MSAgICAgbDYzLjk3OS02My45NzljMS45ODQtMS45NjMsMy41NDEtNC4zMzEsNC42MjktNi45NTVDNTEyLjUyNSwyMzcuNjA2LDUxMi41MjUsMjMxLjcxOCw1MTAuMzcxLDIyNi41MTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGN0Y1RjUiIGRhdGEtb2xkX2NvbG9yPSIjM0YzRjNGIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0zNjIuNjgsMjk4LjY2N2MtMTEuNzk3LDAtMjEuMzMzLDkuNTU3LTIxLjMzMywyMS4zMzN2MTA2LjY2N2gtODUuMzMzVjg1LjMzM2MwLTkuNDA4LTYuMTg3LTE3LjcyOC0xNS4yMTEtMjAuNDM3ICAgICBsLTc0LjA5MS0yMi4yMjloMTc0LjYzNXYxMDYuNjY3YzAsMTEuNzc2LDkuNTM2LDIxLjMzMywyMS4zMzMsMjEuMzMzczIxLjMzMy05LjU1NywyMS4zMzMtMjEuMzMzdi0xMjggICAgIEMzODQuMDEzLDkuNTU3LDM3NC40NzcsMCwzNjIuNjgsMEgyMS4zNDdjLTAuNzY4LDAtMS40NTEsMC4zMi0yLjE5NywwLjQwNWMtMS4wMDMsMC4xMDctMS45MiwwLjI3Ny0yLjg4LDAuNTEyICAgICBjLTIuMjQsMC41NzYtNC4yNjcsMS40NTEtNi4xNjUsMi42NDVjLTAuNDY5LDAuMjk5LTEuMDQ1LDAuMzItMS40OTMsMC42NjFDOC40NCw0LjM1Miw4LjM3Niw0LjU4Nyw4LjIwNSw0LjcxNSAgICAgQzUuODgsNi41NDksMy45MzksOC43ODksMi41MzEsMTEuNDU2Yy0wLjI5OSwwLjU3Ni0wLjM2MywxLjE5NS0wLjU5NywxLjc5MmMtMC42ODMsMS42MjEtMS40MjksMy4yLTEuNjg1LDQuOTkyICAgICBjLTAuMTA3LDAuNjQsMC4wODUsMS4yMzcsMC4wNjQsMS44NTZjLTAuMDIxLDAuNDI3LTAuMjk5LDAuODExLTAuMjk5LDEuMjM3VjQ0OGMwLDEwLjE3Niw3LjE4OSwxOC45MjMsMTcuMTUyLDIwLjkwNyAgICAgbDIxMy4zMzMsNDIuNjY3YzEuMzg3LDAuMjk5LDIuNzk1LDAuNDI3LDQuMTgxLDAuNDI3YzQuODg1LDAsOS42ODUtMS42ODUsMTMuNTI1LTQuODQzYzQuOTI4LTQuMDUzLDcuODA4LTEwLjA5MSw3LjgwOC0xNi40OTEgICAgIHYtMjEuMzMzSDM2Mi42OGMxMS43OTcsMCwyMS4zMzMtOS41NTcsMjEuMzMzLTIxLjMzM1YzMjBDMzg0LjAxMywzMDguMjI0LDM3NC40NzcsMjk4LjY2NywzNjIuNjgsMjk4LjY2N3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0Y3RjVGNSIgZGF0YS1vbGRfY29sb3I9IiMzRjNGM0YiPjwvcGF0aD4KCQk8L2c+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
                            </i>
                            <span>cerrar sesion</span> 
                        </a>
                    </li> 
                </section>
            </aside>

