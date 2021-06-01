<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
<?php 

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

 
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }


include('../enlaces/head.php'); ?>



<style type="text/css">

ul.ksw-cboxtags {
    list-style: none;
    padding: 4px;
}
ul.ksw-cboxtags li{
  display: inline;
}
ul.ksw-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 0px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ksw-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ksw-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\f067";
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="checkbox"]:checked + label::before {
    content: "\f00c";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ksw-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ksw-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ksw-cboxtags li input[type="checkbox"]:focus + label {
 border: 2px solid #e9a1ff;
}





ul.ksw-cboxtags li input[type="radio"]:checked + label::before {
    content: "\f00c";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="radio"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ksw-cboxtags li input[type="radio"] {
  display: absolute;
}
ul.ksw-cboxtags li input[type="radio"] {
  position: absolute;
  opacity: 0;
}
ul.ksw-cboxtags li input[type="radio"]:focus + label {
 border: 2px solid #e9a1ff;
}  

  /* The container */
.dfg {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  
}

/* Hide the browser's default checkbox */
.dfg input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #dbdde0;border-radius: 5px;
}

/* On mouse-over, add a grey background color */
.dfg:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.dfg input:checked ~ .checkmark {
  background-color: #12bbd4;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.dfg input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.dfg .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>

 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }  
 $style=$sty;
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style=' font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
     $style=' font: 1em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;';  
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;">

  <div class="wrapper" class="form-control" style="<?php echo $style; ?>">
    <?php include('../enlaces/header.php');  



    ?>


    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 

      <div class="container">
        <div class="row">

          <div class="col-md-3">
            <br>

            <div class="box bo"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div id="sp"></div>
              <form   method="post">
                <div class="box-header with-border" style="background-color: #d73925;color: #fff">
                  <h4 class="box-title">Buscar docente</h4>
                </div><input type="hidden" value="0" id="tempo" name="">
                <div class="box-body">
                  <!-- the events -->
                  <div id="external-events"> 
                    <div id="sapo"></div> 


                    <br>   

                  </div>
                </div></form>

              </div>
              <br> 
              <br>

            <div class="box bo"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);display: none">
              <div id="mimo"></div>
              

              </div>
              <br> 

            </div> 

          



            <div class="col-md-9"> <br> 
              <div id="luna"></div>
              <div class="nav-tabs-custom" id="koooo" style=" padding: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"  >

                 
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Areas acargo</a></li>
                  <li><a href="#timeline" data-toggle="tab">Carga por area </a></li>
                  <li><a href="#settings" data-toggle="tab">Carga por curso</a></li>
                 
                </ul>
                <div class="tab-content">


                  <div class="active tab-pane" id="activity"> 
                    <div id="_MSG_"></div>
                    <div class="row"> <div class="box-header with-border">
                     <select id="mySelect" style="<?php echo $style; ?>margin-top: -6px;border-radius: 5px;
              border: solid 1px #d2d6de;  " onchange="myFunctions(1)">


                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="20">20</option> 
                    </select>
                    <div class="box-tools pull-right">
                      <div class="has-feedback">
                        <input type="text" style="<?php echo $style; ?> border-radius: 5px" class="form-control input-sm" id='fname' placeholder="Buscador..." onchange="myFunctions(1)">
                        <span class="fa fa-search form-control-feedback" style="color: #babcbf "></span>
                      </div>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <div id="area_acargo"></div>
                </div> 
              </div>


               <div class="tab-pane" id="timeline"><br>

<select class="form-control select2 "  id="seles7"style="<?php echo $style; ?> width: 100%" onchange ="sele2()" ></select>
<br><br>
<select class="form-control select2" id="seles8" style="<?php echo $style; ?> width: 100%" onchange="sele3()"></select>
<br><br>
<div class="box-header with-border" id="opc">
   
             <select id="mySelect12"  onchange="sss1(1)" style="<?php echo $style; ?>margin-top: -6px;border-radius: 5px;
              border: solid 1px #d2d6de;  ">


              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            <div class="box-tools pull-right">
              <div class="has-feedback">
                <input type="text" style="<?php echo $style; ?>border-radius: 5px" class="form-control input-sm" id='fname12' placeholder="Buscardor.." onchange="sss1(1)"  >
                <span class="fa fa-search form-control-feedback" style="color: #babcbf"></span>
              </div>
            </div>
            <!-- /.box-tools -->
          </div>
<div  class="tab-content"  id="vista"></div>
               </div>

<!-----horario--->


              <div class="tab-pane" id="horaw" ><br>  
                 <div id="letrero" style="    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;    box-sizing: border-box;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="document.getElementByid('letrero').style.display='none'">×</button>
                <h4><i class="icon fa fa-info" style="margin-right: 1px"></i> Alerta!</h4>
                seleccione la sede, una vez selecccionada mostrara  el horario actual del docente en el cual permite modificarlo por medio de un selector, mostrando el curso y la area de la sede señalada. una vez que cambie el selector del area automaticamente se actualizara eliminando sus registros anteriores.
              </div><br> 
                    <select class="form-control select2" id='ultimo' style="<?php echo $style; ?> width: 100%" onchange="funu()">
                  </select><br><br>
                <div     id="hora">
                 
                </div>

              </div> 

<!-----horario--->

<!-----carga por curso--->
              <div class="tab-pane" id="settings" >

                <form action="" method="post" id="carga_curso">
                  <select class="form-control select2 "  id="seles" style="<?php echo $style; ?> width: 100%" onchange="sele()" ></select><br><br>
                  <select class="form-control select2 " name="grado"  id="grado" style="<?php echo $style; ?> width: 100%" ></select><br><br>
                  <select class="form-control  " id="consul" name="consul"  style="<?php echo $style; ?> width: 100%" onchange="  
                  var consul=document.getElementById('consul').value ;if (consul=='no') {
                    document.getElementById('di').style.display='none';
                    document.getElementById('do').style.display='block'; }
                    if (consul=='todo') {
                    document.getElementById('do').style.display='none';document.getElementById('di').style.display='block'; }
                  ">
                    <option value="todo">Asignar todas las asignaturas</option>
                    <option value="no">Asignar asignatura especifica</option>
                  </select><br>
                  <div id="_MSG5_"></div>
                  <input type="hidden" name="docente2" id="docente2">
               <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#aas" style="width: 100%" >Aceptar</button>

    
                     <div class="modal fade" id="aas" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <div id="di">
                              <p> Eliminará los cursos y asignaturas que tiene a cargo el docente, se le asignará el curso completo señalado. Tambien podrá ordenar el horario  <br> Está seguro de hacer esta acción?</p>
                              </div>
                               <div id="do" style="display:none">
                              <p>Visualiza las áreas y su intensidad horaria con sus docentes acargo, por medio de un boton, en el cual permirte acutalizar el maestro dandole clikc, tambien permite mostrar y actualizar el horario del curso .<br> Está seguro de hacer esta acción?</p>
                              </div>
                            </div>
                            <div class="modal-footer">   
                                <input type="hidden" id="elimina" name="docentees" value=' '>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit"  value=' ' class="btn btn-primary" id="enter"  name="eliminar_sedes" 
                                   onclick='
    $("#aas").modal({backdrop: false});
    $("#aas").modal("hide");'>Aceptar</button> 
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" value="<?php echo $style ?>" name="style">
                    </form>

                <br><br>  
                <div id="tablaa"></div>
                  <div id="ui" style="display: none"> <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity3s" data-toggle="tab">Cargar</a></li>
                   <li><a  onclick=" funcionesa()" id="awa" target="_blank"  >Horario</a></li> 
                 
                </ul>
                      <div     ><br>
            <div class="box-header with-border" id="opc">
   
             <select id="mySelect1" style="<?php echo $style; ?>margin-top: -6px;border-radius: 5px;
              border: solid 1px #d2d6de;  "  onchange="myno(1)">


              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            <div class="box-tools pull-right">
              <div class="has-feedback">
                <input type="text" style="<?php echo $style ?>border-radius: 5px" class="form-control input-sm" id='fname1' placeholder="Buscar area.." onchange="myno(1)" >
                <span class="fa fa-search form-control-feedback" style=" color: #babcbf"></span>
              </div>
            </div>
            <!-- /.box-tools -->
          </div>
          <div  id="ti" class="tab-content">
                  </div>
              </div> </div></div>
<!-----fin de la carga por curso--->


            </div>




          </div>
          <!-- /.tab-pane -->
        </div>





        <!-- /.col -->
      </div> 
    </div>




 

    <!-- /. box -->
  </div>
  <!-- /.col -->

  <!-- /.content -->



<script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Ibunotas</b> 1.0
    </div>
    <strong>Desarrollado por Ibusoft.
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
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <!-- jQuery 3 -->

 
 
   <!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


 

<script src="../../../js/jquery.loadingModal.js"></script>
<script type="text/javascript">
    function mostrar1(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
 
    function funcionesa(){

var grado =document.getElementById("grado").value;
      document.getElementById('awa').href='../sedes/horario.php?id='+grado;
    }
  for (var i=0; i < 100; i++) {   




   function myno(i) {
     
var docente2 =document.getElementById("docente").value;
var grado =document.getElementById("grado").value;
    var dato=document.getElementById("fname1").value;
    var style='<?php echo $style; ?>';
    var mySelect=document.getElementById("mySelect1").value;
    var consul=document.getElementById('consul').value;
    if(consul=='no'){
    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=tabla_carga_curso",

      data:{consul,i,dato,mySelect,docente2,grado,style},    dataType:"text", 

      success:function(data){  
       
        $('#ti').html(data); 


      }  


    });  }



  }

   function sss1(i) {
  
    mostrar1();

 var dato=document.getElementById("fname12").value;

    var mySelect=document.getElementById("mySelect12").value;

 var docente2=document.getElementById("docente").value;
       var id_js=document.getElementById("seles7").value;

       var id_area=document.getElementById("seles8").value;
       if (id_area!='') {
        var style='<?php echo $style; ?>';
         $.ajax({   
          type: "post", 
          data:{i, id_js,id_area,docente2,mySelect,dato,style},
          url:"../../../ajax/rector/docentes.php?action=carga_por_area", 
          dataType:"text",
          success:function(data){   $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
              $('#vista').html(data);   
          } 
        });
       }

  }


}
    function sele(){
        
mostrar1();
       var idjs=document.getElementById("seles").value;
        $.ajax({   
          type: "post", 
          data:{idjs},
          url:"../../../ajax/seles/seles.php?action=sacar_curso", 
          dataType:"text",
          success:function(data){ 
          $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );   
              $('#grado').html(data);

          } 
        });
    }
    function sele3(){
        mostrar1();
 var docente2=document.getElementById("docente").value;
       var id_js=document.getElementById("seles7").value;
var style='<?php echo $style; ?>';
       var id_area=document.getElementById("seles8").value;
       if (id_area!='') {
         $.ajax({   
          type: "post", 
          data:{id_js,id_area,docente2,style},
          url:"../../../ajax/rector/docentes.php?action=carga_por_area", 
          dataType:"text",
          success:function(data){   
            $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
              $('#vista').html(data);   
          } 
        });
       }
       
    }





    function sele2(){
        mostrar1();

       var id=document.getElementById("seles7").value;
        $.ajax({   
          type: "post", 
          data:{id},
          url:"../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada", 
          dataType:"text",
          success:function(data){ 
          $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );   
              $('#seles8').html(data);   
          } 
        });
    }
   
 





  function toca1(){
    mostrar1();
       var docente2=document.getElementById("docente").value;
       var id_js=document.getElementById("seles7").value;
           var dato=document.getElementById("fname12").value;
           var i=document.getElementById("isi").value;

    var mySelect=document.getElementById("mySelect12").value;
       var id_area=document.getElementById("seles8").value;
       if (id_area!='') {
        var style='<?php echo $style; ?>';
         $.ajax({   
          type: "post", 
          data:{id_js,id_area,docente2,mySelect,dato,i,style},
          url:"../../../ajax/rector/docentes.php?action=carga_por_area", 
          dataType:"text",
          success:function(data){   
            $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
              $('#vista').html(data);   
          } 
        });
       } 
     }
   function myno1() {
    mostrar1();
    var consul=document.getElementById('consul').value;

var docente2 =document.getElementById("docente").value;
var grado =document.getElementById("grado").value;
    var dato=document.getElementById("fname1").value;
    var i=document.getElementById("ios").value;
    var mySelect=document.getElementById("mySelect1").value;
     var consul=document.getElementById('consul').value;var style='<?php echo $style; ?>';
    if(consul=='no'){
    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=tabla_carga_curso",

      data:{consul,docente2,grado,mySelect,dato,i,style},    dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#ti').html(data); 

 
      }  


    });  }



  }
  
     function funuq1(){
mostrar1();
var util=document.getElementById("ultimo").value;
var docente=document.getElementById("docente2").value;
if (util==''){ 

 }
  else{ 
 $.ajax({

          type: "post",  data:{docente,util},
          url:"../../../ajax/rector/docentes.php?action=carga_por_horario", 
        
          dataType:"text", 
          success: function(data)
          {  $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#hora').html(data); 

          }
        });

 
}
}

   function titi(docente,area){
mostrar1();
    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=actualizar_carga_independiente",

      data:{docente,area},    dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
 myno1() ;
        funuq1();toca1();
      }  


    });  
   }

 






    $(document).ready(function(){ 

   function sss1() {
  
    
mostrar1();
 

 var docente2=document.getElementById("docente").value;
       var id_js=document.getElementById("seles7").value;
   var dato=document.getElementById("fname12").value;
           var i=document.getElementById("isi").value;

    var mySelect=document.getElementById("mySelect12").value;
       var id_area=document.getElementById("seles8").value;
       var style='<?php echo $style; ?>';
       if (id_area!='') {
         $.ajax({   
          type: "post", 
          data:{id_js,id_area,docente2,mySelect,i,dato,style},
          url:"../../../ajax/rector/docentes.php?action=carga_por_area", 
          dataType:"text",
          success:function(data){   
            $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
              $('#vista').html(data);   
          } 
        });
       }

  }



   function myno() {
    mostrar1();
    var consul=document.getElementById('consul').value;

var docente2 =document.getElementById("docente").value;
var grado =document.getElementById("grado").value;
    var dato=document.getElementById("fname1").value;

    var mySelect=document.getElementById("mySelect1").value;
    var i=document.getElementById("ios").value;
var style='<?php echo $style; ?>';
 var consul=document.getElementById('consul').value;
    if(consul=='no'){
    $.ajax({  

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=tabla_carga_curso",

      data:{consul,docente2,grado,mySelect,dato,i,style},    dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#ti').html(data); 


      }  


    });  }



  }
     function funuq(){
mostrar1();
var util=document.getElementById("ultimo").value;
var docente=document.getElementById("docente2").value;
if (util==''){ 

 }
  else{
 $.ajax({

          type: "post",  data:{docente,util},
          url:"../../../ajax/rector/docentes.php?action=carga_por_horario", 
        
          dataType:"text", 
          success: function(data)
          {  
            $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#hora').html(data); 

          }
        });

 
}
}$(document).on("submit", "#actualizate3", function(e){
    e.preventDefault();  
    mostrar1();
    $.ajax({

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=actualizar_carga_independiente23",
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      {  
      $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
         
           myno() ;



        funuq();sss1();



      }
    });
  })
  $(document).on("submit", "#actualizatea", function(e){
    e.preventDefault();  
    mostrar1();
    $.ajax({

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=actualizar_carga_independiente2",
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      {  
           myno() ;



        funuq();sss1();
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
      }
    });
  })
    



     $.ajax({

          type: "post",
          url:"../../../ajax/seles/seles.php?action=nuevo_grado", 
          data: $(this).serialize(),
          dataType:"text", 
          success: function(data)
          {  
            $('#seles').html(data); 

          }
        });

   $.ajax({

          type: "post",
          url:"../../../ajax/seles/seles.php?action=sacar_sede_jornada", 
          data: $(this).serialize(),
          dataType:"text", 
          success: function(data)
          { 
            $('#seles7').html(data);
            $('#seles').html(data);
             $('#ultimo').html(data); 


          }
        });


       $("#koooo").hide();
 $("#oop").hide(); 
   $.ajax({   
        type: "post", 
        url:"../../../ajax/seles/seles.php?action=sele_docente2", 
        dataType:"text", 

        success:function(data){  
          $('#sapo').html(data); 

  

        }  


      }); 
 

  
   $(document).on("submit", "#carga_curso", function(e){
    e.preventDefault();
    mostrar1();
    var seles=document.getElementById("seles").value;
    var grado=document.getElementById("grado").value; 
    var consul=document.getElementById("consul").value; 
    if (seles=='') {
      mensaje5(2,'Seleccione una sede');
    } 
    else if (grado=='') {
      mensaje5(2,'Seleccione una curso');
    } else{ 
    $.ajax({

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=tabla_carga_curso", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 
        if(consul=='todo'){     
          document.getElementById('ui').style.display='none';
          document.getElementById('tablaa').style.display='block';
         $('#tablaa').html(data); 
        }else{
          document.getElementById('tablaa').style.display='none';
          document.getElementById('ui').style.display='block'; 
          $('#ti').html(data);
        }

        var dato=document.getElementById("fname").value;
        var mySelect=document.getElementById("mySelect").value;
        var id_docente=document.getElementById("docente").value;
        var style='<?php echo $style; ?>';
        $.ajax({   
          type: "post", 
          data:{id_docente,mySelect,dato,style},
          url:"../../../ajax/rector/docentes.php?action=area_acargo", 
          dataType:"text",
          success:function(data){ 
            $('body').loadingModal({text: 'Showing loader animations...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );   
            $('#area_acargo').html(data);
          } 
        });
      }
    });
  }

 
  });
  
   $(document).on("submit", "#eliminis", function(e){
    e.preventDefault();  
    mostrar1();
    $.ajax({

      type: "post",
      url:"../../../ajax/rector/docentes.php?action=aliminar_area_acargos", 
      data: $(this).serialize(),
      dataType:"text", 
      success: function(data)
      { 
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#_MSG_').html(data); 

      }
    });
  });
 
       });  

    function actualizar(){
      mostrar1();
       var dato=document.getElementById("fname").value;

      var mySelect=document.getElementById("mySelect").value;
      var id_docente=document.getElementById("docente").value; 
      var style='<?php echo $style; ?>';
        $.ajax({   
      type: "post", 
      data:{id_docente,mySelect,dato,style},
      url:"../../../ajax/rector/docentes.php?action=area_acargo", 
      dataType:"text",
      success:function(data){
      $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );    
          $('#area_acargo').html(data);   
      } 
    });
    $("#koooo").show(); 
    }






function uno(){
  mostrar1();
    var grado=document.getElementById("grado").value;
 var id_docente=document.getElementById("docente").value;
      var docente2=document.getElementById("docente2").value=id_docente;
      var consul=document.getElementById("consul").value; 
   var seles=document.getElementById("seles").value;
    var grado=document.getElementById("grado").value; 

    var dato=document.getElementById("fname1").value;

    var mySelect=document.getElementById("mySelect1").value;
  
    var consul=document.getElementById("consul").value; 
    if (seles=='') { 
    } 
    else if (grado=='') { 
    } 
    else if (consul=='todo') { 
    } 
     else{
     var opo=document.getElementsByTagName('tempo').value;
     if (opo==1) {
      var i=document.getElementById('ios').value;
     }else{
      var i='';
     }
     var style='<?php echo $style; ?>';
     $.ajax({   
      type: "post", 
      data:{grado,docente2,i,consul,dato,mySelect,style},
      url:"../../../ajax/rector/docentes.php?action=tabla_carga_curso",
      dataType:"text",
      success:function(dd){   
      if(consul=='todo'){      document.getElementById('ui').style.display='none';
 document.getElementById('tablaa').style.display='block';
        $('#tablaa').html(dd);  
}else{ 
 document.getElementById('tablaa').style.display='none';

    document.getElementById('ui').style.display='block'; 
          $('#ti').html(dd);
}





             
      } 
    });} $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
}

function dos(){
  mostrar1();
   var docente2=document.getElementById("docente").value;
       var id_js=document.getElementById("seles7").value;

    var dato=document.getElementById("fname12").value;

    var mySelect=document.getElementById("mySelect12").value;
    var style='<?php echo $style; ?>';
       var id_area=document.getElementById("seles8").value;
       if (id_area!='') {
        var i=document.getElementById('isi').value;
         $.ajax({   
          type: "post", 
          data:{id_js,id_area,docente2,dato,i,mySelect,style},
          url:"../../../ajax/rector/docentes.php?action=carga_por_area", 
          dataType:"text",
          success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );  
              $('#vista').html(data);   
          } 
        });
       }
}
  function aliminar_area_acargo(io){ 
    mostrar1();
    $.ajax({   
      type: "post", 
      data:{io},
      url:"../../../ajax/rector/docentes.php?action=aliminar_area_acargo", 
      dataType:"text",
      success:function(data){   
          $('#_MSG_').html(data);  uno();dos(); 
      } 
    });
  }

 function myFunction(){
  mostrar1();
  uno();
  var id_docente=document.getElementById("docente").value;
  var dato=document.getElementById("fname").value;
  var mySelect=document.getElementById("mySelect").value;
  var docente2=document.getElementById("docente").value;
  var style='<?php echo $style; ?>';
  document.getElementById("docente2").value=id_docente;
  $.ajax({   
      type: "post", 
      data:{id_docente,mySelect,dato,style},
      url:"../../../ajax/rector/docentes.php?action=area_acargo", 
      dataType:"text",
      success:function(data){   
          $('#area_acargo').html(data);
    } 
  });
  $("#koooo").show();  
  var util=document.getElementById("ultimo").value;
  var docente=document.getElementById("docente2").value;
  if (util==''){ }
  else{
    $.ajax({

          type: "post",  data:{docente,util},
          url:"../../../ajax/rector/docentes.php?action=carga_por_horario", 
        
          dataType:"text", 
          success: function(data)
          {  $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#hora').html(data); 

          }
    });
  }
  dos();
  document.getElementsByTagName('tempo').value=1;
}

function funu(){
mostrar1();
var util=document.getElementById("ultimo").value;
var docente=document.getElementById("docente2").value;
if (util==''){
mensaje7(2,'Selecione una sede');

 }
  else{
 $.ajax({

          type: "post",  data:{docente,util},
          url:"../../../ajax/rector/docentes.php?action=carga_por_horario", 
        
          dataType:"text", 
          success: function(data)
          {  
            $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#hora').html(data); 

          }
        });

 
}
}
for (var i=0; i < 100; i++) {   




   function myFunctions(i) {
    mostrar1();
 var dato=document.getElementById("fname").value;

      var mySelect=document.getElementById("mySelect").value;
      var id_docente=document.getElementById("docente").value;
      var style='<?php echo $style; ?>'; 
    $.ajax({  

      type: "post",
     url:"../../../ajax/rector/docentes.php?action=area_acargo", 

      data:{id_docente,i,dato,mySelect,style},    dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
      $('#area_acargo').html(data);  


      }  


    });  



  }



}


   function myFunc(io){
    mostrar1();
    $.ajax({   
      type: "post", 
      data:{io},
      url:"../../../ajax/rector/docentes.php?action=aliminar_area_acargo", 
      dataType:"text",
      success:function(data){   
        $('body').loadingModal({text: 'Showing loader animations...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#_MSG_').html(data);  
      } 
    });

  }


    </script>
    
 



