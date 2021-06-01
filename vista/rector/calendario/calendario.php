  <?php 

session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
   $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include '../../../codes/rector/jornada.php';
$j=new jornada();
$jornada=$j->mostrar_jornada_sede();
  include('../enlaces/head.php');   
   

  




  ?>

 <link rel="stylesheet" type="text/css" href="../../../css/fullcalendar.css">
 
 
  <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">

  <div class="wrapper" class="form-control"> 
    <?php include('../enlaces/header.php');   ?>
    <div class="content-wrapper"> 
      <div class="row"> 
        <div class="col-md-12">   
          <div id="sapo"></div>
           
          <div class="col-md-1"></div>
          <div class="col-md-10"> <br>
            <div class="table-responsive" style="padding: 10px; background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
           
              






   
                    <h3  style="<?php echo $sty; ?>">Calendario de notificaones y recordatorios</h3>
                    <p >Puedes registrar notificaciones ha cualquier rol (administrador, docentes, padres y alumons). Tambien puedes   recordar tus mensajes y fechas importantes  </p>
                    <center><div id="calendar"   style="<?php echo $sty; ?>">
                    </div></center>
                 
              <!-- /.row -->
          
              <!-- Modal -->
              <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form class="form-horizontal" id="formulario-envia"  method="POST" >
                      <div class="modal-header btn-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong style="<?php echo $sty; ?>">Agregar Evento</strong></h4>
                      </div>
                  <div class="modal-body">
                   
                    <div class="col-sm-12">
                      <label for="title" class=" control-label">Tipo:</label>
                      <select name="tipo" id="tipo" class="form-control"  onchange=" var tipo= document.getElementById('tipo').value;
                        if (tipo==0) {  
                          document.getElementById('q4').style.display='block'; 
                          document.getElementById('q1').style.display='block';
                         admin1();
                        }else{  
                          document.getElementById('q4').style.display='none';
                          document.getElementById('q1').style.display='none';

                          document.getElementById('q2').style.display='none';
                          document.getElementById('q3').style.display='none';  
                        } ">
                          <option value="1">Recordatorio</option>
                          <option value="0">Notificación</option>
                      </select>
                    </div> 
                   
                      <div class="col-sm-12" id="q4" style="display: none">
                        <label for="title" class=" control-label">Rol:</label>
                        <select name="rol" class="form-control" id="rol" onchange="   
                        var rol=document.getElementById('rol').value;
                        if (rol==1) { 
                          document.getElementById('q2').style.display='none';
                          document.getElementById('q3').style.display='none'; 
                          admin1(); 
                        }else{
                          document.getElementById('q1').style.display='block';
                          document.getElementById('q2').style.display='block';
                          document.getElementById('q3').style.display='block';sede1();  
                        }"  >
                          <option value="1">administradores</option>
                          <option value="2">Docentes</option>
                          <option value="3">Alumnos</option>
                          <option value="4">Padres</option>
                        </select>
                      </div> 
                   
                      <div class="col-sm-12" id="q3" style="display: none">
                        <label for="title" class=" control-label">Sede:</label>
                        <select name="sede" id="sede" onchange="sede1()" class="form-control  " style="width: 100%" id="sede">
                          <option value="">Selecciones un elmento de la lista</option>
                          <option value="0.01">Todos</option>
                          <?php foreach ($jornada as $key => $value) { ?>
                            <option value="<?php echo $value['ID_JS'] ?>"><?php echo $value['NOMBRE'].' - ' .$value['jornada']; ?></option>
                          <?php } ?>
                          
                        </select>
                      </div> 
                   
                      <div class="col-sm-12" id="q2" style="display: none">
                        <label for="title"  class=" control-label">Curso:</label>
                        <select name="curo" class="select2 form-control" style="width: 100%" id="curo" onchange=" curso()">
                          
                        </select>
                      </div>
                      <div class="col-sm-12" id="q1" style="display: none ">
                        <label for="title" class=" control-label">Persona:</label>
                        <div id="persona">
                          <select name="" class="form-control" id=""></select> 
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <label for="title" class=" control-label">Titulo:</label>
                        <input name="title" class="form-control" id="title">
                          
                        
                      </div> 
                   
                    
                    
                    <div class="col-sm-12">
                      <label for="title" class=" control-label">Descripcion:</label>
                      <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                    </div>  
                    <div class="col-sm-12"><label for="title" class=" control-label">Color:</label>
                      <select name="color1" class="form-control" id="color1">
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
                    <div class="form-group">
                    <label for="start" class="col-sm-2 control-label" style="display: none;">Fecha Inicial</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="start1" class="form-control" id="start1" readonly >
                  
                 
                      <input type="hidden" name="end1" class="form-control" id="end1" readonly >
                   
                    </div>
                  
                  </div>
                </div>
                  <div class="modal-footer">
                  <button type="button" style="" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="submit"   style=""  class="btn btn-primary">Guardar</button>
                  </div>
                </form>
                </div>
                </div>
              </div>
              
              
              
              <!-- Modal -->
              <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form class="form-horizontal"  id="formulario" method="POST" action="editEventTitle.php">
                  <div class="modal-header btn-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><div style="float: left;margin-right: 10px;">Modificar </div> <div id="tex"></div></h4>
                  </div>
                  <div class="modal-body">
                   <div class="form-group"  id="foto" style="display:  ">
                       
                      </div>
                    <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Titulo</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="Descripcion" class="col-sm-2 control-label">Descripcion</label>
                    <div class="col-sm-10">
                      <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
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
                    <label for="Descripcion" class="col-sm-2 control-label">Visto</label>
                    <div class="col-sm-10">
                      <select name="visto" class="form-control" id="visto">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select> 
                    </div>
                    </div>
                      <div class="form-group"> 
                      <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                        <label class="text-danger"><input type="checkbox" id="delete" value="1"  name="delete"> Eliminar Evento</label>
                        </div>
                      </div>
                    </div>
                    
                    <input type="hidden" name="id" class="form-control" id="id">
                  
                  
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="button"  data-dismiss="modal" onclick="  editar()" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
                </div>
                </div>
              </div>






































                  

            </div> <br><br>
          </div>
          <div class="col-md-1"></div>  
        </div> 
      </div> 
    </div>
    <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> IBUnotas</b> 1.0
    </div>
    <strong>Desarrollado por  IBUsoft. </strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">

    <!-- /.tab-pane -->

  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div> 

  <script src="../../../js/moment.min.js"> </script>
  <script src='../../../js/fullcalendar.min.js'></script>
  <script src='../../../js/fullcalendar.js'></script>
  <script src='../../../js/es.js'></script>
  <!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
<script>
$('.select2').select2({    
  language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});
</script>
  
  <script>
     function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }

 

   $(document).on("submit", "#formulario-envia", function(e){
    e.preventDefault(); 
    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({

      data:parametros,
      url:"../../../ajax/rector/cronograma_actividades/calendario_cronograma.php?action=registro",
      type:"POST",
      contentType:false,
      processData:false,
      success: function(data){
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );
        
        alert(data); 
      }
    }); 
    
  });
    function curso(){
      mostrar();
      var ID_JS=document.getElementById('sede').value;
      var rol=document.getElementById('rol').value;
      var curo=document.getElementById('curo').value;
      var num=0;
      if (curo==num) {
        var id_curso='';
        var id_grado='';
      } if (curo!=num){

        var porciones = curo.split(' ');
        var id_curso=porciones[0];
        var id_grado=porciones[1];
      }
      if (rol==2) {
        $.ajax({
          type: "post",
          url:"../../../ajax/seles/seles.php?action=docente_por_curso", 
            data: { ID_JS,id_curso,id_grado},
          dataType: 'text',
          success: function(data)
          {
              $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );
   
            $('#persona').html(data);  
          }
        });
      }
      if (rol==3) {
        $.ajax({
          type: "post",
          url:"../../../ajax/seles/seles.php?action=alumnos_por_curso", 
          data: { ID_JS,id_curso,id_grado},
          dataType: 'text',
          success: function(data)
          {
              $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );
   
            $('#persona').html(data);  
          }
        });
      }
      if (rol==4) {
        $.ajax({
          type: "post",
          url:"../../../ajax/seles/seles.php?action=alumnos_por_curso", 
          data: { ID_JS,id_curso,id_grado},
          dataType: 'text',
          success: function(data)
          {
              $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );
   
            $('#persona').html(data);  
          }
        });
      }
      
    }


    function admin1(){
      $.ajax({
        type: "post",
        url:"../../../ajax/seles/seles.php?action=admin", 
        dataType: 'text',
        success: function(data)
        {
 
          $('#persona').html(data);  
        }
      }); 
    }



    function sede1(){
      mostrar(); 
      document.getElementById('q2').style.display='none';
      var ID_JS=document.getElementById('sede').value;
      var rol=document.getElementById('rol').value;
      if (ID_JS==0.01 && rol==2) { 
        $.ajax({
          type: "post",
          url:"../../../ajax/seles/seles.php?action=sele_docente3", 
          dataType: 'text',
          success: function(data)
          {
            $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );

         
          $('#persona').html(data);  
          }
        }); 
      }
      if (ID_JS==0.01 && rol==3) { 
        $.ajax({
          type: "post",
          url:"../../../ajax/seles/seles.php?action=sele_docente4", 
          dataType: 'text',
          success: function(data)
          {
            $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );
 
          $('#persona').html(data);  
          }
        }); 
      }
      if (ID_JS==0.01 && rol==4) { 
        $.ajax({
          type: "post",
          url:"../../../ajax/seles/seles.php?action=sele_docente4", 
          dataType: 'text',
          success: function(data)
          {
            $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );
 
          $('#persona').html(data);  
          }
        }); 
      }if (ID_JS!=0.01 ){
        var idjs=ID_JS;
        $.ajax({
          type: "post",

          data: {idjs},
          url:"../../../ajax/seles/seles.php?action=sacar_curso133", 
          dataType: 'text',
          success: function(data)
          {
            $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );

          document.getElementById('q2').style.display='block';
          $('#curo').html(data);  
          }
        });
      }
    }
    var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();







        function Fttt(){ 
    
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
          
          $('#ModalAdd #start1').val(moment(start).format('YYYY-MM-DD'));
          $('#ModalAdd #end1').val(moment(end).format('YYYY-MM-DD'));
          $('#ModalAdd').modal('show');
        },
        eventRender: function(event, element) {
          element.bind('dblclick', function() {
            $('#ModalEdit #id').val(event.id_notificaiones);
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit #descripcion').val(event.descripcion);
            $('#ModalEdit #color').val(event.color);
            var tipo=event.tipo;
            var visto=event.visto;
            if (visto==0) {
               document.getElementById("visto").value = "No";
            }
            if (visto==1) {
               document.getElementById("visto").value = "No";
            }
            if (tipo==1) {
              $('#ModalEdit #tex').html('recordatorio');
            }if (tipo==0) {
              var id_jornada_sede=event.id_jornada_sede;
              var id_curso=event.id_curso;
              var id_grado=event.id_grado;
              var dirigido=event.dirigido;
              var id_persona=event.id_persona; 
              var de=event.de; 
              $.ajax({
                type: "post",
                url:'../../../ajax/rector/cronograma_actividades/calendario_cronograma.php?action=observa', 
                data: {id_jornada_sede,id_curso,id_grado,dirigido,id_persona,de},
                dataType: 'text',
                success: function(data)
                {       
                  $('#foto').html(data);
                }
              });
            }
            $('#ModalEdit').modal('show');
          });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position

          edit(event);

        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

          edit(event);

        },
        events: '../../../ajax/rector/cronograma_actividades/calendario_cronograma.php?action=ver'
      });
    } 
    Fttt(); 
    
     
    var nuevo_evento;

      function recolector(){
        nuevo_evento={ 
            start:$('#start1').val(),
            end:$('#end1').val(),
            title:$('#title').val(),
            color:$('#color').val(),
            id:$('#id').val(),
          } 
      }
    function nue(start,end,title,color){ 
      
 
        $.ajax({
          type: "post",
          url:"addEvent.php",
          data: {start,end,title,color},
          dataType: 'text',
          success: function(data)
          {  

        nuevo_evento={ 
            start:$('#start1').val(),
            end:$('#end1').val(),
            title:$('#title1').val(),
            color:$('#color1').val(),
            id:data
          }
      
        $('#calendar').fullCalendar('renderEvent',nuevo_evento);
          }
        });   
      }
      function  editar(){

        var eliminar=document.getElementById('delete');
        if (eliminar.checked == false) { 
          var title=$('#title').val();
        var color=$('#color').val();
        var id=$('#id').val(); 
          $.ajax({
              type: "post",
              url:"editEventTitle.php",
              data: {title,color,id},
              dataType: 'text',
              success: function(data)
              {       
                $('#calendar').fullCalendar('refetchEvents');
                
              }
            });
        }else{ 

        var id=$('#id').val(); 
        var delete1=document.getElementById('delete').value;
          $.ajax({
              type: "post",
              url:"editEventTitle.php",
              data: {id,delete1},
              dataType: 'text',
              success: function(data)
              {       
                $('#calendar').fullCalendar('refetchEvents'); 
              }
            });
            document.getElementById("formulario").reset();  
        }
      }

</script>
 


   