

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
  $consulta="SELECT COUNT(area.id_area)as t FROM area,are_grado_sede,grado_sede WHERE  grado_sede.id_grado='$id_grado'   and grado_sede.id_curso='$id_curso'   AND  grado_sede.id_jornada_sede='$id_jornada_sede' and
  grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id_area=area.id_area
  " ;
  $consultas=$conexion->prepare($consulta);
  $consultas->execute(array());
  foreach ($consultas as $key ) {
    $final=$key[0]*4*7;
  }


  echo$consultar_nivel="SELECT SUM(materia_por_periodo.nota)as nota, alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.genero,alumnos.foto,informeacademico.estado_aprovado,informeacademico.prematicula from informeacademico,alumnos,materia_por_periodo WHERE informeacademico.ano='2020'  AND informeacademico.id_grado='$id_grado'   and informeacademico.id_curso='$id_curso'   AND  informeacademico.id_jornada_sede='$id_jornada_sede'  and alumnos.id_alumnos=informeacademico.id_alumno AND materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico GROUP BY informeacademico.id_informe_academico order by apellido
  " ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());

  $contadoir=$consultar_nivel1->rowCount();

  $nom=array('checkboax','checkboaxOne','checkboaxTwo','checkboaxThree','checkboaxFour','checkboaxFive','checkboaxSix','checkboaxSeven','checkboaxEight','checkboaxNine','checkboaxTen','checkboaxTwelve','checkboaxThirteen','checkboaxFourteen','checkboaxFifteen','checkboaxSixteen','checkboaxSeventeen','checkboaxEighteen','1checkboaxNineteen','checkboaxTwenty','checkboaxTwenty-one','checkboaxTwenty-tow','checkboaxTwenty-three','checkboaxTwenty-four','1checkboaxTwenty-five','checkboaxTwenty-six','checkboaxTwenty-seven','checkboaxTwenty-eight','checkboaxTwenty-nine','checkboaxThirty','checkboaxThirty-one','checkboaxThirty-two','checkboaxThirty-three','checkboaxThirty-four','checkboaxThirty-five','checkboaxThirty-six','checkboaxThirty-seven','checkboaxThirty-eight','checkboaxThirty-nine','checkboaxForty','checkboaxForty-one','checkboaxForty-two','checkboaxForty-three','checkboaxForty-four','checkboaxForty-five','checkboaxForty-six','checkboaxForty-seven','checkboaxForty-eight','checkboaxForty-nine','checkboaxFifty', 'checkboaxFifty-one','checkboaxFifty-tow','checkboaxFifty-three','checkboaxFifty-four','checkboaxFifty-five','checkboaxFifty-six','checkboaxFifty-seven','checkboaxFifty-eight','checkboaxFifty-nine');
  $uno=0;

  ?>
 
    <div style="background-color: #3c8dbc;padding: 10px">
      <strong style="margin: 10px;color: #fff;font-size: 17px"> Listado de maticulas <?php echo $contadoir ?>  alunmnos</strong>
    </div><br> 
    <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle" style=" margin-left: 5px;  "><i class="fa fa-square-o"></i>
    </button> <strong style="margin-left: 10px; ">todos</strong>

  <div class ="table-responsive" style="   padding: 14px">

 
    <br>
    <style type="text/css">
      [data-title] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 8px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   
 .im{
            width: 65px; 
        }
        .im:hover{
            width: 97px;  
        }
    </style>
    <form  name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
      <table class="table table-hover  ">
        <tr>
          <th>#</th>
          <th>foto</th>
          <th style=" 
          padding-left: 111px;
          padding-right: 102px;
          
          ">Nombre</th>
          <th>Aprobado</th> 
          <th>Prematiculados</th> 
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
          $disable="";
          
          $pre='<i   class="fa  fa-check-circle" style="
                font-size: 30px;
                color: #42b184;
            "></i>';
          $estado='<i data-title="ddd"  class="fa  fa-check-circle" style="
                font-size: 30px;
                color: #42b184;
            "></i>';
          $id_alumno=$key["id_alumnos"];
          if ($key["prematicula"]==0) {
            $disable="disabled";
            $id_alumno="";
            $pre='<span data-title="No se puede matricular hasta que hallas hecho la prematricula"><i   class="fa fa-fw fa-times-circle" style="
    color: #cc3737;
    font-size: 32px;
" ></i></span>';
          }
          if ($key["estado_aprovado"]==0) {
            $disable="disabled";
            $id_alumno="";
            $estado='<span data-title="El estudiante perdio el año" > <i class="fa fa-fw fa-times-circle" style="
    color: #cc3737;
    font-size: 32px;
"></i></span>';
          }
          $foto=$key['foto'];
          if($key['foto']=='' && $key['genero']=='1'){
            $foto= '../../../logos/niña.jpg';
          }  
          if(($key['foto']=='' && $key['genero']=='')  or ($key['foto']=='' && $key['genero']=='0'))
          {
            $foto= '../../../logos/niño.jpg';
          }
          ?>
          <tr>
            <td>
              <label class="mailbox-messages"> 
                <input type="checkbox" name="tin[]" id="indetificador1<?php echo $key['id_informe_academico'] ?>"  value="<?php echo $id_alumno;  ?>"  <?php echo $disable ?>> 
              </label>
            </td> 
            <td>

              <img   class="profile-user-img im" src="<?php echo $foto  ?>" > 
            </td>
            <td><?php echo $key['apellido'].' '.$key['nombre'] ?></td>
            <td><?php echo $estado ?></td>
            <td> <?php echo $pre ?></i> </td>
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

}
function buscar_aprobado()
{     

  include '../../conexion.php';

  $id_jornada_sede=$_POST['id_jornada_sede'];
  $id_curso1=$_POST['id_curso']; 
  $porciones=explode(' ', $id_curso1);
  $id_curso=$porciones[0];
  $id_grado=$porciones[1];

  $ano=date('Y');
  $consulta="SELECT COUNT(area.id_area)as t FROM area,are_grado_sede,grado_sede WHERE  grado_sede.id_grado='$id_grado'   and grado_sede.id_curso='$id_curso'   AND  grado_sede.id_jornada_sede='$id_jornada_sede' and
  grado_sede.id=are_grado_sede.id_grado_sede and are_grado_sede.id_area=area.id_area
  " ;
  $consultas=$conexion->prepare($consulta);
  $consultas->execute(array());
  foreach ($consultas as $key ) {
    $final=$key[0]*4*7;
  }


  echo$consultar_nivel="SELECT informeacademico.id_informe_academico, materia_por_periodo.nota,materia_por_periodo.recuperacion, alumnos.id_alumnos,alumnos.nombre,alumnos.apellido,alumnos.genero,alumnos.foto,informeacademico.estado_aprovado from informeacademico,alumnos,materia_por_periodo WHERE informeacademico.ano='2020'  AND informeacademico.id_grado='$id_grado'   and informeacademico.id_curso='$id_curso'   AND  informeacademico.id_jornada_sede='$id_jornada_sede'  and alumnos.id_alumnos=informeacademico.id_alumno AND materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico    order by informeacademico.id_informe_academico
  " ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
 
  $contadoir=$consultar_nivel1->rowCount();

  $nom=array('checkboax','checkboaxOne','checkboaxTwo','checkboaxThree','checkboaxFour','checkboaxFive','checkboaxSix','checkboaxSeven','checkboaxEight','checkboaxNine','checkboaxTen','checkboaxTwelve','checkboaxThirteen','checkboaxFourteen','checkboaxFifteen','checkboaxSixteen','checkboaxSeventeen','checkboaxEighteen','1checkboaxNineteen','checkboaxTwenty','checkboaxTwenty-one','checkboaxTwenty-tow','checkboaxTwenty-three','checkboaxTwenty-four','1checkboaxTwenty-five','checkboaxTwenty-six','checkboaxTwenty-seven','checkboaxTwenty-eight','checkboaxTwenty-nine','checkboaxThirty','checkboaxThirty-one','checkboaxThirty-two','checkboaxThirty-three','checkboaxThirty-four','checkboaxThirty-five','checkboaxThirty-six','checkboaxThirty-seven','checkboaxThirty-eight','checkboaxThirty-nine','checkboaxForty','checkboaxForty-one','checkboaxForty-two','checkboaxForty-three','checkboaxForty-four','checkboaxForty-five','checkboaxForty-six','checkboaxForty-seven','checkboaxForty-eight','checkboaxForty-nine','checkboaxFifty', 'checkboaxFifty-one','checkboaxFifty-tow','checkboaxFifty-three','checkboaxFifty-four','checkboaxFifty-five','checkboaxFifty-six','checkboaxFifty-seven','checkboaxFifty-eight','checkboaxFifty-nine');
  $uno=0;

  ?>
 
    <div style="background-color: #3c8dbc;padding: 10px">
      <strong style="margin: 10px;color: #fff;font-size: 17px"> Listado de maticulas <?php echo $contadoir ?>  alunmnos</strong>
    </div><br> 
    <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle" style=" margin-left: 5px;  "><i class="fa fa-square-o"></i>
    </button> <strong style="margin-left: 10px; ">todos</strong>

  <div class ="table-responsive" style="   padding: 14px">

 
    <br>
    <style type="text/css">
      [data-title] { 
  font-size: 30px; /*optional styling*/
  
  position: relative; 
}

[data-title]:hover::before {
  content: attr(data-title);
  position: absolute;
  bottom: -26px;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 2px;
  background: #000;
  color: #fff;
  font-size: 12px;
  font-family: sans-serif;
  white-space: nowrap;right: 1%
}
[data-title]:hover::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 4px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}   
 .im{
            width: 65px; 
        }
        .im:hover{
            width: 97px;  
        }
    </style>
    <form  name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
      <table class="table table-hover  ">
        <tr>
          <th>#</th>
          <th>fotos</th>
          <th style=" 
          padding-left: 111px;
          padding-right: 102px;
          
          ">Nombre</th>
          <th>AprobadoS</th>  
        </tr>
        <?php 
        $id=0;
        $estado='<span data-title="alcanso los logros propuestos " ><i  class="fa  fa-check-circle" style="
                font-size: 30px;
                color: #42b184;
            "></i></span>';
            $not="";
            $nom="";$disable="";
        foreach ($consultar_nivel1 as $key  ) { 
          if ((  $key["nota"]<6  )) {
            $disable="disabled";
            $id_alumno="";
            $estado='<span data-title="El estudiante perdio el año" > <i class="fa fa-fw fa-times-circle" style="
              color: #cc3737;
              font-size: 32px;
            "></i></span>'; 
          $not=$key["nota"]." ".$key["nombre"];
          } echo$key["nota"] ;
            # code...
           echo $nom=" ".$key["nombre"]." ";
           echo $nom=$key["apellido"];

           echo "<br>";
        if ($id!=$key["id_informe_academico"]) {
            
          $uno=$uno+1;
         
          
          
          
           
          $id_alumno=$key["id_alumnos"];
          
          
          $foto=$key['foto'];
          if($key['foto']=='' && $key['genero']=='1'){
            $foto= '../../../logos/niña.jpg';
          }  
          if(($key['foto']=='' && $key['genero']=='')  or ($key['foto']=='' && $key['genero']=='0'))
          {
            $foto= '../../../logos/niño.jpg';
          }
          ?>
          <tr>
            <td><?php echo $key['id_informe_academico']; ?>
              <label class="mailbox-messages"> 
                <input type="checkbox" name="tin[]" id="indetificador1<?php echo $key['id_informe_academico'] ?>"  value="<?php echo $id_alumno;  ?>"  <?php echo $disable ?>> 
              </label>
            </td> 
            <td>

              <img   class="profile-user-img im" src="<?php echo $foto  ?>" > 
            </td>
            <td><?php echo $key['apellido'].' '.$key['nombre'] ?></td>
            <td><?php echo $estado ?></td> 
          </tr>
          <?php
          $id=$key["id_informe_academico"]; $estado='<span data-title="alcanso los logros propuestos " ><i  class="fa  fa-check-circle" style="
                font-size: 30px;
                color: #42b184;
            "></i></span>';
            $not="";
        }
        
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

}


?>