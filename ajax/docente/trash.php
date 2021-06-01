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
function tabla()
   {     
 
      include "../../codes/rector/conexion.php";
        $id=$_SESSION['Id_Doc'];

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
   

           $consultar_nivel="SELECT docente.nombre, docente.apellido, mailbox.* FROM mailbox INNER JOIN docente ON docente.id_docente=mailbox.de WHERE mailbox.para=$id AND trash=1 AND docente.nombre LIKE('%$d%') ORDER BY mailbox.id DESC";
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


  $consultar_nivel="SELECT docente.nombre, docente.apellido, mailbox.* FROM mailbox INNER JOIN docente ON docente.id_docente=mailbox.de WHERE mailbox.para=$id AND trash=1 AND docente.nombre LIKE('%$d%') ORDER BY mailbox.id DESC LIMIT $limit, $nroLotes ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
        $count=$consultar_nivel1->rowCount();
        $registro=$consultar_nivel1->fetchAll();

            $registrow=$consultar_nivel1->rowCount();
?>

<div class="box-body no-padding">

    <div class="mailbox-controls">
        <!-- Check all button -->
        <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
        </button>
        <!--<div class="btn-group">
            <button class="btn btn-default btn-sm"> <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTI0LDE0LjA1OVY1LjU4NEwxOC40MTQsMEgwdjMyaDI0di0wLjA1OWM0LjQ5OS0wLjUsNy45OTgtNC4zMSw4LTguOTQxICAgIEMzMS45OTgsMTguMzY2LDI4LjQ5OSwxNC41NTYsMjQsMTQuMDU5eiBNMTcuOTk4LDIuNDEzTDIxLjU4Niw2aC0zLjU4OEMxNy45OTgsNiwxNy45OTgsMi40MTMsMTcuOTk4LDIuNDEzeiBNMiwzMFYxLjk5OGgxNCAgICB2Ni4wMDFoNnY2LjA2Yy0xLjc1MiwwLjE5NC0zLjM1MiwwLjg5LTQuNjUyLDEuOTQxSDR2MmgxMS41MTdjLTAuNDEyLDAuNjE2LTAuNzQzLDEuMjg5LTAuOTk0LDJINHYyaDEwLjA1OSAgICBDMTQuMDIyLDIyLjMyOSwxNCwyMi42NjEsMTQsMjNjMCwyLjgyOSwxLjMwOCw1LjM1MiwzLjM1LDdIMnogTTIzLDI5Ljg4M2MtMy44MDEtMC4wMDktNi44NzYtMy4wODQtNi44ODUtNi44ODMgICAgYzAuMDA5LTMuODAxLDMuMDg0LTYuODc2LDYuODg1LTYuODg1YzMuNzk5LDAuMDA5LDYuODc0LDMuMDg0LDYuODgzLDYuODg1QzI5Ljg3NCwyNi43OTksMjYuNzk5LDI5Ljg3NCwyMywyOS44ODN6IiBmaWxsPSIjMDAwMDAwIi8+CgkJPHJlY3QgeD0iNCIgeT0iMTIiIHdpZHRoPSIxNiIgaGVpZ2h0PSIyIiBmaWxsPSIjMDAwMDAwIi8+CgkJPHBvbHlnb24gcG9pbnRzPSIyNC4wMDIsMjIgMjQuMDAyLDE4IDIyLDE4IDIyLDIyIDE4LDIyIDE4LDI0IDIyLDI0IDIyLDI4IDI0LjAwMiwyOCAyNC4wMDIsMjQgMjgsMjQgICAgIDI4LDIyICAgIiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" / style='width: 18px;height: 18px'></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>-->
        <?php if($paginaActual > 1){
                      echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
                      if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
        <!--</div>-->
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

    <div class="table-responsive mailbox-messages">

        <?php

   echo '<br><table class="table table-striped table-condensed table-hover">';
    ?>
        <tbody>
            <?php
            if($count>0){
                                            foreach($registro as $key){
                                            ?>
            <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="../mensajes/sent_read_mail.php?id=<?php echo($key['id']); ?>">
                        <?php echo($key['nombre']." ".$key['apellido']); ?></a></td>
                <td class="mailbox-subject">
                    <?php echo($key['asunto']); ?>
                </td>
                <td class="mailbox-attachment"></td>
                <td class="mailbox-date">
                    <?php echo(date('g:i a', strtotime($key['fecha']))); ?>
                </td>
            </tr>
            <?php
                                            }
                    }else{
                echo('<div class="alert alert-info">
  <strong>Info!</strong> No hay Mensajes en la Papelera.
</div>');
            }
                                            ?>
        </tbody>
        <?php
        echo "</table></div></div>";

    echo '<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button> <ul class="pagination" id="pagination">
                  <!--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>-->'.$lista.'</ul>



 

<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>

<script src="../../../dist/js/demo.js"></script>

' ;
?>
        <script>
            $(function() {
                //Enable iCheck plugin for checkboxes
                //iCheck for checkbox and radio inputs
                $('.mailbox-messages input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                    radioClass: 'iradio_flat-blue'
                });

                //Enable check and uncheck all functionality
                $(".checkbox-toggle").click(function() {
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
                $(".mailbox-star").click(function(e) {
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
