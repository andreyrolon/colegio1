  
<?php 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }?>asdasd
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Calendar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="ahortcat icon" href="../../../logos/foto4.ico"/>


  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../../bower_components/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../../bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../../bower_components/jvectormap/jquery-jvectormap.css">
   
  <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">  
 
       

    <script src="../../../dist/js/msg.js"></script>
    <script src="../../../dist/js/validacion.js"></script>   







  
  <link href='../../../css/fullcalendar.css' rel='stylesheet' /> 
    
  <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">  
</head>
<body class="hold-transition skin-blue sidebar-mini">
   <?php
 

include('../../../codes/rector/calendario_actividad.php');
$actividades=new actividades();
$sede='';
$jornada='';

if(isset($_POST['eliminar_cronograma'])){
  $actividades->eliminar_cronograma($_POST['eliminar_cronograma']);

}


if(isset($_POST['button'])){
  $sede=$_POST['sede'];
  $jornada='';
  if (isset($_POST['jornada'])){   
    $jornada=$_POST['jornada']; 
  }
}
if (isset($_POST['guardar'])) {  
  $actividades->registrar($_POST['title'],$_POST['color'],$_POST['Descripcion'],$_POST['Observacion'],$_POST['end'],$_POST['start'],$_POST['se'],$_POST['jo']);
}
if (isset($_POST['nuevo'])) {  
  $actividades->registrar($_POST['nombre'],$_POST['color1'],$_POST['Descrip'],$_POST['observa'],$_POST['end1'],$_POST['fecha1'],$_POST['sede1'],$_POST['jornada1']);
}

include('../enlaces/header.php');
  
 ?>   

 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><br>

    <!-- Content Header (Page header) -->
    <section style="margin-left: 50px;margin-right: 50px"> <div id="_MSG2_">
      <?php

if(isset($_POST['eliminar_completo'])){
   $dx=$_POST['idm'];
  if ($dx=='') {
    echo  " <script type='text/javascript'> mensaje2(2,'campos vacios  ');</script>";
  }else{ 
    foreach ($dx as $key ) {
      $actividades->eliminar_cronograma($key);
    }
  }
}

  if(isset($_POST['actualizar'])) { 
     
          $actividades->actualizacion($_POST['id'],$_POST['obs'],$_POST['ds'],$_POST['n'],$_POST['coloraa'],$_POST['fec'],$_POST['seeee'],$_POST['jooooooo']);
  }

       if (isset($_POST['actualiza'])) { 
  $elim='';
  if(isset($_POST['elim'])) { 
    $elim=$_POST['elim'];
  }


   

  if(isset($_POST['j'])) { 
    $j=$_POST['j'];
      $actividades->actualizar($_POST['id'],$_POST['observaciones'],$_POST['descripcion_actividad'],$_POST['actividad'],$_POST['color'],$_POST['fecha'],$_POST['s'],$j,$elim);
  }else{   $actividades->mensaje();
  } 

} 

$actividad=$actividades->actividad($sede,$jornada); 
?>
    </div></section>
    <section  style="background-color: #fff; margin-left: 50px;margin-right: 50px"> 
    
     <ul class="nav nav-tabs"> 

      <li class="active"> <a data-toggle="tab" href="#menu1"> <h3 style="font-family: serif ">  Calendario
        <small>Cronograma De Actividades</small>
      </h3></a></li>

      <li> <a data-toggle="tab" href="#menu2">
       <h3 style="font-family: serif ">  tabla
        <small>Cronograma De Actividades</small>
      </h3>
      </a></li> 
    </ul>
  </section>
<br>
              <div class="tab-content">
                <div id="menu1" class="tab-pane fade in active" style="padding-left: 50px">
    <!-- Main content --> 
      <div class="row">
        <div class="col-md-3">
          <div class="box bo">
            <form   method="post">
            <div class="box-header with-border">
              <h4 class="box-title">Buscar por:</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events"> 
            <select name="sede" class="form-control select2" id="ko" style="width: 100%;" >
               
                </select>
                <br><br> 
                 <select name="jornada" class="form-control select2 " style="width: 100%;"   id="kooo"  > 
                </select>
                <br>
                <button  type="submit" name="button" class="btn btn-danger pull-right btn-block btn-sm">Buscar</button>
                <br><br>
              </div>
            </div></form>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
         
        </div>
        <!-- /.col -->

  




<div id="tablas"></div>






 
        <div class="col-md-8">
          <div class="box bo">
       <div id="calendar" class="col-centered">
                </div>
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form   method="POST" >
      
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
        </div>
        <div class="modal-body">
        
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Actividad</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo" required="">

            <input type="hidden" name="se" value='todas'  id="l1">
            <input type="hidden" name="jo"  value='todas' id="l2"> 
          </div>
          </div>
          <br>
          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-10">
            <select name="color" class="form-control" id="color" required="">
                    <option value="">Seleccionar</option>
              <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
              <option style="color:#008000;" value="#008000">&#9724; Verde</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
              <option style="color:#000;" value="#000">&#9724; Negro</option>
              
            </select>
          </div>
          </div>
          <br>
          <div class="form-group">
          <label for="start" class="col-sm-2 control-label">Descripcion</label>
          <div class="col-sm-10">

            <textarea name="Descripcion" class="form-control"></textarea>
            <input type="hidden" name="start" class="form-control" id="start" readonly>
          </div>
          </div><br><br>
          <div class="form-group">
          <label for="end" class="col-sm-2 control-label">Observacion</label>
          <div class="col-sm-10">
            <textarea name="Observacion" class="form-control"></textarea>
            <input type="hidden" name="end" class="form-control" id="end" readonly>
          </div>
          </div><br>
        
        </div><br><br>
        <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
        </div><br>
      </form>
      </div>
      </div>
    </div>
    
    
    
    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form  method="POST"  >
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
        </div>
        <div class="modal-body">
        
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">actividad</label>
          <div class="col-sm-10">           
            <input type="text" name="actividad" class="form-control" id="title" placeholder="Titulo">
            
          </div>
          </div>
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">observacion</label>
          <div class="col-sm-10">           

            <textarea id="observaciones" class="form-control" name="observaciones"> </textarea>
          </div>
          </div>
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">descripcion</label>
          <div class="col-sm-10">            
        
            <textarea id="descripcion_actividad" class="form-control" name="descripcion_actividad"> </textarea>
          </div>
          </div>

          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">sede</label>
          <div class="col-sm-10">                 
                     <select name="s" class="form-control select2 " style="width: 100%;"   id="oo"  > 

                </select>
            
          </div>
          </div>
  <div class="form-group">
          <label for="title" class="col-sm-2 control-label">jornada</label>
          <div class="col-sm-10">                     
                 <select name="j" class="form-control select2 " style="width: 100%;"   id="ooo"  > 

                </select>
            
          </div>
          </div>

<!-- Select2 -->
<!-- Select2 -->

 
           
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">fecha</label>
          <div class="col-sm-10">            
        <input type="date" name="fecha" id="sss">
          </div>
          </div>
          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-10">
            <select name="color" class="form-control" id="color">
              <option value="">Seleccionar</option>
              <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
              <option style="color:#008000;" value="#008000">&#9724; Verde</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
              <option style="color:#000;" value="#000">&#9724; Negro</option>
              
            </select>
          </div>
          </div>
            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
              <label class="text-danger"><input type="checkbox"  name="elim"> Eliminar Evento</label>
              </div>
            </div>
          </div>
          
          <input type="hidden" name="id" class="form-control" id="id">
        
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="actualiza" class="btn btn-primary">Guardar</button>
        </div>
      </form>
      </div>
      </div>
    </div>
 
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>

        <div class="col-md-8"></div>
      </div> 
    <!-- /.content -->
  </div>
  <div id="menu2" class="tab-pane fade"> 
      <div class="modal fade" id="mymo" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> estás seguro de eliminar la sede   ?</p>

              </div>
              <div class="modal-footer">    
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit"  value=' ' class="btn btn-primary"  name="eliminar_sede" 
                  id="btn">Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>
    <div class="col-md-1">
      
    </div>
    <div class="col-md-10">
        <div class="box-header with-border">
             <select id="mySelect"  onchange="myFunction(1)">


            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" id='fname' placeholder="Search Mail" onkeyup="myFunction(1)">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
       <div id="tabla">
         
       </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
</div>
  <!-- /.content-wrapper -->
    
<script src='../../../js/fullcalendar/locale/es.js'></script>
 
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
<!-- Page Script -->

 
  
 
<script src="../../../js/ful11.css"></script>
<!-- Page specific script -->

  <script src='../../../js/ful1.css'></script>

<script type="text/javascript">
    $(document).ready(function(){    
 

  document.getElementById("kooo").innerHTML = "<option value='todas'>todas las  jornada</option>";
  
  $("#ko").change(function(){
    var id=document.getElementById("ko").value;
    document.getElementById("l1").value=id;
     $.ajax({   
        type: "post",
        data:{id}, 
        url:"../../../ajax/seles/seles.php?action=select2_jornada_sede",
        dataType:"text", 

        success:function(data){  
          $('#kooo').html(data); 


        }  


      }); 
});
  
 
       $.ajax({   
        type: "post",
 
        url:"../../../ajax/seles/seles.php?action=select2_sedes_cronograma",
        dataType:"text", 

        success:function(data){  
          $('#ko').html(data); 


        }  


      }); 
 
  $("#kooo").change(function(){
    var id2=document.getElementById("kooo").value;
    document.getElementById("l2").value=id2;
  });
       });  

    </script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY ' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>

  $(document).ready(function() {

    var date = new Date();
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
    var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
      header: {
         language: 'es',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay',
      },
      defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD '));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD '));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element){
        element.bind('dblclick', function(){
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit #observaciones').val(event.observaciones); 
          var ida=(event.id);
          $.ajax({   
            type: "post",
            data:{ida},
            url:"../../../ajax/seles/seles.php?action=seleccion1",
            dataType:"text", 
            success:function(data){  
              $('#oo').html(data); 
            } 
          }); 
          $.ajax({   
            type: "post",
            data:{ida}, 
            url:"../../../ajax/seles/seles.php?action=seleccion",
            dataType:"text", 

            success:function(data){  
              $('#ooo').html(data); 


            } 
          }); 
          $("#oo").change(function(){
            var ida=document.getElementById("oo").value;
            document.getElementById("l1").value=ida;
            $.ajax({   
              type: "post",
              data:{ida}, 
              url:"../../../ajax/seles/seles.php?action=seleccion11",
              dataType:"text", 
              success:function(data){  
                $('#ooo').html(data);  
              }  
            }); 
          });
          $('#ModalEdit #sss').val(event.start);  
          $('#ModalEdit #descripcion_actividad').val(event.descripcion_actividad);  
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position
        edit(event);
      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
        edit(event);

      },
      events: [ 
      ]
    });
    
    function edit(event){
      start = event.start.format('YYYY-MM-DD ');
      if(event.end){
        end = event.end.format('YYYY-MM-DD ');
      }else{
        end = start;
      }
      
      id =  event.id;
      
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
 
 
      $.ajax({

      url:"../../../ajax/rector/Cronograma_actividades/calendario_cronograma.php?action=edi",
       
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
         location.reload();
        }
      }); 
    }
  





 


function mostrar(){

   $.ajax({   
    type: "post",
    url:"../../../ajax/rector/Cronograma_actividades/calendario_cronograma.php?action=tabla",
    dataType:"text", 

    success:function(data){  

   
      $('#tabla').html(data); 



    }  


  }); }

   
 

$(document).on("submit", "#agregar", function(e){
  e.preventDefault(); 

  $.ajax({
    type: "post",
      url:"../../../ajax/rector/sedes/sedes.php?action=agregar",
    data: $(this).serialize(),
    dataType: 'text',
    success: function(data)
    { 
                alert(data);       mostrar();
                document.getElementById("agregar").reset();

    }
  });
});
 
  mostrar();  
  
  

 


});













 

for (var i=0; i < 100; i++) {   




   function myFunction(i) {

    var dato=document.getElementById("fname").value;

    var mySelect=document.getElementById("mySelect").value;

    $.ajax({  

      type: "post",
    url:"../../../ajax/rector/Cronograma_actividades/calendario_cronograma.php?action=tabla",

      data:{i,dato,mySelect},    dataType:"text", 

      success:function(data){  
        $('#tabla').html(data); 

       
      }  


    });  



  }

 

}

 
 
 

 
 
</script>