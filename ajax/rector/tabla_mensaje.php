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

function tabla(){     
 
  include "../../codes/rector/conexion.php";

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
  $id=$_POST['id'];

    $consultar_nivel="SELECT mailbox.tabla_de,mailbox_person.visto as ver, mailbox.fecha, mailbox_person.id,mailbox.asunto,alumnos.nombre as a_n,alumnos.apellido as a_a,docente.nombre as d_n,docente.apellido as d_a, administradores.NOMBRE as admin_n ,administradores.APELLIDO as admin_a from mailbox LEFT JOIN mailbox_person on mailbox_person.id_mailbox=mailbox.id LEFT JOIN docente on docente.id_docente=mailbox.de LEFT JOIN administradores on administradores.ID_ADMIN=mailbox.de LEFT JOIN alumnos on alumnos.id_alumnos=mailbox.de WHERE mailbox_person.para='$id' and mailbox_person.tabla_para=1 and mailbox_person.habilitado=1 and mailbox.asunto LIKE('%$d%') ORDER by mailbox.id DESC
"; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  $registro=$consultar_nivel1->fetchAll();
  $nroProductos=$consultar_nivel1->rowCount();
  if ($nroProductos>0) {


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
      $lista=    '<nav aria-label="..." >
      <ul class="pagination" style="cursor: pointer;" style="padding:10px">  
      
      <li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
      
        <span class="page-link">Anterior</span>
      </li>
      ';
    }else{
      $lista =  '<nav aria-label="...">

      <ul class="pagination">  



      <li class="page-item disabled "   >

      <a class="">Anterior</a>
      </li>
      ';
    } 
         
    $i = max(1, $paginaActual - 2); 
    for ($i; $i < min($paginaActual + 3, $nroPaginas+1); $i++) {
      if($i == $paginaActual){
         
        $lista = $lista.'
        <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
        <span class="page-link">
         '.$i.'
        <span class="sr-only">(current)</span>
         </span>
        </li>  ';
      }else{
        $lista = $lista.'
        <li class="page-item "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
        <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
         </span>
        </li> ';
      }
    }
        
    if($paginaActual < $nroPaginas){
      $lista.= '  
    
      <li  class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
      <span class="page-link">Siguiente</span>
      </li>';
      $o=0;
    }else{
     $lista.= '  

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
    $registrow=$nroLotes; ?>
<form id="envio" name="envio" method="post">
  <div class="box-body no-padding">

    <div class="mailbox-controls">
      <!-- Check all button -->
      <div class="btn-group">
        <a   id="t" class=" bin btn  btn-  btn checkbox-toggle"><i class="fa fa-square-o"></i>
        </a> 

        <a class="bin btn btn-default"  data-toggle="modal" data-target="#mymodal2" name="papelera" id="papelera"><i class="fa fa-trash-o"></i></a> <?php 
        if($paginaActual > 1){
          echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;
        }
        if($paginaActual < $nroPaginas){ 
          echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;
        } ?>
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
        } ?>
        <div class="btn-group"> <?php 

          if($paginaActual > 1){
            echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;
          } 
          if($paginaActual < $nroPaginas){ 
            echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;
          } ?>
        </div> 
      </div>
    </div>
    <div class="table-responsive mailbox-messages" style="padding: 10px"> 
      <br>
      <table class="table  table-condensed ">
        <tbody> <?php
          foreach (array_slice($registro, $limit, $nroLotes) as  $key) {
            if ($key['ver']==0) {
              $disabled='disabled';
              $ver='sin Leer';
            }
            if ($key['ver']==1) {
              $disabled='';
              $ver='Leido';
            } 

 
?> 


            <tr>
              <td style='padding:15px;'>


                <input <?php echo $disabled;  ?> height="5"  type="checkbox" name="trash[]" value="<?php echo($key['id']); ?>" id="trash">
              </td> <?php 

              if ( $key['tabla_de']==1) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Rector</span></center></td>
                <td style='padding:15px;'><a href="read-mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              } 
              if ( $key['tabla_de']==2) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Coordinador</span></center></td>
                <td style='padding:15px;'><a href="read-mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              } 
              if ( $key['tabla_de']==3) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Psicoorientador</span></center></td>
                <td style='padding:15px;'><a href="read-mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              } 
              if ( $key['tabla_de']==4) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Secretarias</span></center></td>
                <td style='padding:15px;'><a href="read-mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              }  






              if ( $key['tabla_de']==6) { ?>
                <td style='padding:15px;'><center><span class="label pull-left bg-teal">Alumno</span></center></td>
                <td style='padding:15px;'><a href="read-mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[5].' '.$key[6] ?></a></td> <?php

              } 

              if (  $key['tabla_de']==5) { ?>
                <td style='padding:15px;'><center><span class="label label-info pull-left">Docente</span></center></td>
                <td style='padding:15px;'><a href="read-mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[7].' '.$key[8] ?></a></td> <?php 
              } ?>

              <td style='padding:15px;' class="mailbox-subject">
                <?php echo($key['asunto']); ?>
              </td>

              <td  style='padding:15px;'class="mailbox-attachment"><?php echo $ver ?></td>

              <td  style='padding:15px;'class="mailbox-date">
                <?php echo(date('Y-d-m / g:i a', strtotime($key['fecha']))); ?>
              </td>
            </tr> <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-group" style="margin: 5px">
    <a   id="t" class=" bin btn  btn-  btn checkbox-toggle"><i class="fa fa-square-o"></i>
    </a> 
    <a class="bin btn btn-default" data-toggle="modal" data-target="#mymodal2" name="papelera" ><i class="fa fa-trash-o"></i></a>
  </div>
  <div class="modal fade in" id="mymodal2" style="background-color: rgba(3, 64, 95, 0.3);  padding-right: 21px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Confirmación</h4>
        </div>

        <div id="_MSG_"></div>
        <div class="modal-body">
          <p> Estás seguro de mover los mensajes recividos a la papelera?</p> 
        </div>
        <div class="modal-footer">    
          <button type="button" id="Cancelar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit"   class="btn btn-primary" name="eliminary2" id="eliminary2"  >Aceptar</button> 
        </div>
      </div>
    </div>
  </div>
</form>

<ul class="pagination" id="pagination" style="margin-left: 5px;" >
  <?php echo $lista ?>
</ul>




<!-- FastClick -->
<script src="../../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App --> 
<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>



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



  </script><?php     
}else{
    ?>
    <div></div>
    <?php
  }

}



function tabla1(){     
 
  include "../../codes/rector/conexion.php";

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
  $id=$_SESSION['Id_Doc'];

  $consultar_nivel="SELECT mailbox.tabla_de,mailbox_person.visto as ver, mailbox.fecha,mailbox_person.id,mailbox.asunto,alumnos.nombre as a_n,alumnos.apellido as a_a,docente.nombre as d_n,docente.apellido as d_a, administradores.NOMBRE as admin_n ,administradores.APELLIDO as admin_a from mailbox LEFT JOIN mailbox_person on mailbox_person.id_mailbox=mailbox.id LEFT JOIN docente on docente.id_docente=mailbox.de LEFT JOIN administradores on administradores.ID_ADMIN=mailbox.de LEFT JOIN alumnos on alumnos.id_alumnos=mailbox.de WHERE mailbox_person.para='$id' and mailbox_person.tabla_para=1 and mailbox_person.habilitado=0 and mailbox.asunto LIKE('%$d%') ORDER by mailbox.id DESC
"; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  $registro=$consultar_nivel1->fetchAll();
  $nroProductos=$consultar_nivel1->rowCount();
  if ($nroProductos>0) {


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
      $lista=    '<nav aria-label="..." >
      <ul class="pagination" style="cursor: pointer;" style="padding:10px">  
      
      <li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
      
        <span class="page-link">Anterior</span>
      </li>
      ';
    }else{
      $lista =  '<nav aria-label="...">

      <ul class="pagination">  



      <li class="page-item disabled "   >

      <a class="">Anterior</a>
      </li>
      ';
    } 
         
    $i = max(1, $paginaActual - 2); 
    for ($i; $i < min($paginaActual + 3, $nroPaginas+1); $i++) {
      if($i == $paginaActual){
         
        $lista = $lista.'
        <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
        <span class="page-link">
         '.$i.'
        <span class="sr-only">(current)</span>
         </span>
        </li>  ';
      }else{
        $lista = $lista.'
        <li class="page-item "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
        <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
         </span>
        </li> ';
      }
    }
        
    if($paginaActual < $nroPaginas){
      $lista.= '  
    
      <li  class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
      <span class="page-link">Siguiente</span>
      </li>';
      $o=0;
    }else{
     $lista.= '  

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
    $registrow=$nroLotes; ?>
<form id="envio" name="envio" method="post">
  <div class="box-body no-padding">

    <div class="mailbox-controls">
      <!-- Check all button -->
      <div class="btn-group">
          <?php 
        if($paginaActual > 1){
          echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;
        }
        if($paginaActual < $nroPaginas){ 
          echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;
        } ?>
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
        } ?>
        <div class="btn-group"> <?php 

          if($paginaActual > 1){
            echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;
          } 
          if($paginaActual < $nroPaginas){ 
            echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;
          } ?>
        </div> 
      </div>
    </div>
    <div class="table-responsive mailbox-messages" style="padding: 10px"> 
      <br>
      <table class="table  table-condensed ">
        <tbody> <?php
          foreach (array_slice($registro, $limit, $nroLotes) as  $key) {
             

 
?> 


            <tr>
              <?php  if ( $key['tabla_de']==1) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Rector</span></center></td>
                <td style='padding:15px;'><a href="trash_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              } 
              if ( $key['tabla_de']==2) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Coordinador</span></center></td>
                <td style='padding:15px;'><a href="trash_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              } 
              if ( $key['tabla_de']==3) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Psicoorientado</span></center></td>
                <td style='padding:15px;'><a href="trash_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              } 
              if ( $key['tabla_de']==4) { ?>
                <td style='padding:15px;'><center><span class="label label-primary pull-left">Secretaria</span></center></td>
                <td style='padding:15px;'><a href="trash_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[9].' '.$key[10] ?></a></td> <?php
              }  

              if ( $key['tabla_de']==6) { ?>
                <td style='padding:15px;'><center><span class="label pull-left bg-teal">Alumno</span></center></td>
                <td style='padding:15px;'><a href="trash_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[5].' '.$key[6] ?></a></td> <?php

              } 

              if (  $key['tabla_de']==5) { ?>
                <td style='padding:15px;'><center><span class="label label-info pull-left">Docente</span></center></td>
                <td style='padding:15px;'><a href="trash_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo $key[7].' '.$key[8] ?></a></td> <?php 
              } ?>

              <td style='padding:15px;' class="mailbox-subject">
                <?php echo($key['asunto']); ?>
              </td>
 

              <td  style='padding:15px;'class="mailbox-date">
                <?php echo(date('Y-d-m / g:i a', strtotime($key['fecha']))); ?>
              </td>
            </tr> <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
 
 
</form>

<ul class="pagination" id="pagination" style="margin-left: 5px;" >
  <?php echo $lista ?>
</ul>



 <?php     
}else{
    ?>
    <div>
      <div class="alert alert-info">
  <strong>Info!</strong> No hay Mensajes en la Papelera.
</div>
    </div>
    <?php
  }

}

function mail_papelera_masivo(){
    include "../../codes/rector/conexion.php";
     
    if (isset($_POST['trash'])) {
      foreach($_POST['trash'] as $key){ 
        $consultar_nivel="UPDATE `mailbox_person` SET `habilitado` = '0' WHERE `mailbox_person`.`id` = $key";
        $consultar_nivel1q.=$consultar_nivel.';';
      }
      $consultar_nivel1=$conexion->prepare($consultar_nivel1q);
      $consultar_nivel1->execute(array());
      echo 9;
    }else{
      echo 1;
    }
}



function envios(){     
 
  include "../../codes/rector/conexion.php";

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
  $id=$_POST['id'];
 
   $consultar_nivel="SELECT mailbox.id , mailbox.dirigido, mailbox.fecha, mailbox.asunto from mailbox  WHERE mailbox.de='$id' and mailbox.tabla_de not in ('5','6') AND mailbox.asunto like('%$d%') GROUP by mailbox.id  ORDER BY `id`  DESC  "; 
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array()); 
  $registro=$consultar_nivel1->fetchAll();
  $nroProductos=$consultar_nivel1->rowCount();
  if ($nroProductos>0) { 

   

    if(isset($_POST['mySelect'])){
      $nroLotes = $_POST['mySelect'];
    }else{
      $nroLotes = 5;
    }

    echo  '<br>';
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';
    $lista='';
    if($paginaActual > 1){
      $lista=    '<nav aria-label="..." >
      <ul class="pagination" style="cursor: pointer;" style="padding:10px">  
      
      <li class="page-item  " id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')">
      
        <span class="page-link">Anterior</span>
      </li>
      ';
    }else{
      $lista =  '<nav aria-label="...">

      <ul class="pagination">  



      <li class="page-item disabled "   >

      <a class="">Anterior</a>
      </li>
      ';
    } 
         
    $i = max(1, $paginaActual - 2); 
    for ($i; $i < min($paginaActual + 3, $nroPaginas+1); $i++) {
      if($i == $paginaActual){
         
        $lista = $lista.'
        <li class="page-item active"   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
        <span class="page-link">
         '.$i.'
        <span class="sr-only">(current)</span>
         </span>
        </li>  ';
      }else{
        $lista = $lista.'
        <li class="page-item "   id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">
        <span class="page-link">
        '.$i.'
        <span class="sr-only">(current)</span>
         </span>
        </li> ';
      }
    }
        
    if($paginaActual < $nroPaginas){
      $lista.= '  
    
      <li  class="page-item  " style="cursor: pointer;" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')">
      <span class="page-link">Siguiente</span>
      </li>';
      $o=0;
    }else{
     $lista.= '  

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
    $registrow=$nroLotes; ?>
    <form id="envio" name="envio" method="post">
      <div class="box-body no-padding">

        <div class="mailbox-controls">
          <!-- Check all button -->
          <div class="btn-group">
              
            <?php 
            if($paginaActual > 1){
              echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;
            }
            if($paginaActual < $nroPaginas){ 
              echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;
            } ?>
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
            } ?>
            <div class="btn-group"> <?php 

              if($paginaActual > 1){
                echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;
              } 
              if($paginaActual < $nroPaginas){ 
                echo  ' <button type="button" class="bin btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;
              } ?>
            </div> 
          </div>
        </div>
        <div class="table-responsive mailbox-messages" style="padding: 10px"> 
          <br>
          <table class="table  table-condensed ">
            <tbody> <?php
              foreach (array_slice($registro, $limit, $nroLotes) as  $key) {
                 ?> 
                <tr>
                    

                  <td class="mailbox-subject" style='padding:15px '>
                  <?php 

                  if ($key['dirigido']==1) { ?>
                    <span class="label label-primary pull-left">Rector</span>  <?php
                  } 

                  if ($key['dirigido']==2) { ?>
                    <span class="label label-primary pull-left">Coordinador</span>  <?php
                  } 

                  if ($key['dirigido']==3) { ?>
                    <span class="label label-primary pull-left">Sicoorientador</span>  <?php
                  } 

                  if ($key['dirigido']==4) { ?>
                    <span class="label label-primary pull-left">Secretaria</span>  <?php
                  } 

                     
                  if ($key['dirigido']==7) { ?>
                    <span class="label label-primary pull-left"> Administrativos</span>  <?php
                  }  
                  if ($key['dirigido']==8) { ?>
                    <span class="label label-primary pull-left">Administrativos y Docentes</span>  <?php
                  }  
                  if ($key['dirigido']==9) { ?>
                    <span class="label label-primary pull-left">Alumnos y Docentes</span>  <?php
                  }  
                  if ($key['dirigido']==10) { ?>
                    <span class="label label-primary pull-left">Comunidad educativa</span>  <?php
                  }  

                  if ($key['dirigido']==6  ) { ?> <span class="label pull-left bg-teal">Alumno</span>  <?php

                  } 

                  if ($key['dirigido']==5) { ?> <span class="label label-info pull-left">Docente</span>  <?php 
                  } ?>
                  </td>
                  <td style='padding:15px;' class="mailbox-subject">
                    <a href="sent_read_mail.php?id=<?php echo $key['id'] ?>"><?php echo($key['asunto']); ?></a>
                  </td>
                  <td  style='padding:15px;'class="mailbox-date">
                    <span style="float: right;"><?php echo(date('Y-d-m / g:i a', strtotime($key['fecha']))); ?></span>
                  </td>
                </tr> <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
       
    </form>

    <ul class="pagination" id="pagination" style="margin-left: 5px;" >
      <?php echo $lista ?>
    </ul>




    <!-- FastClick -->
    <script src="../../../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App --> 
    <!-- iCheck -->
    <script src="../../../plugins/iCheck/icheck.min.js"></script>



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



      </script><?php     
  }else{
    ?>
    <div></div>
    <?php
  }

}
