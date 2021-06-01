
 
 <?php

 session_start();
 require_once "../../../codes/docente/chat.php";
 $chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);

 $periodo=$chat->periodo();
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session'])){
  header("location: ../../../login.php"); echo($_SESSION['Session']);
}

 $consulta_grado_sede=$chat->consulta_grado_sede($_SESSION['Id_Doc']);



include('../enlaces/head.php');
?>
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
      <style>
 .container1 {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 13px;
    font-weight: normal;

  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container1 input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container1 input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container1 .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
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
  border-radius: 4px;
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
  left: 5px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 8px solid #000;
}
   table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left; 
}
tr:hover  {
 
   
     padding:10px;border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;  
}
  #idw{
        color: #3c8dbc; 
    }
    #idw:hover{  color:#fff;background-color: #3c8dbc
    }
    #idww:hover{   ;border: solid 0.5px;
    }
    #op:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
    }
</style>
<?php 

$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper" class="form-control">
  <?php include('../enlaces/header.php');  ?>
  <style type="text/css">
    a:hover{
      color: #000; 
    }
  </style>
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <div class="row">
        <div class="col-md-12">
          <input type="hidden" value="<?php echo $id ?>" id="id">
          <input type="hidden" id="mio" value="<?php echo $id ?>">
         <br> 
          <div class="col-md-3"  id="r">
            <div  class="box box-primary"  style="background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div style="padding: 10px">
                <strong>Cursos:</strong> 
                <select class="form-control" id='sede_grado' onchange="  funviones();">
                    <?php
                    foreach ($consulta_grado_sede as   $value) { 
                      $sede=mb_convert_case($value['sede'], MB_CASE_TITLE, "UTF-8");
                    ?>   
                        <option value="<?php echo $value['id_jornada_sede'].','.$value['id_grado'].','.$value['id_curso'].','.$sede.','.$value['jornada'].','.$value['grado'].','.$value['curso']   ?>">Sede: <?php echo $value['sede'].'-'.$value['jornada'].' / Grado: '.$value['grado'].'-'.$value['curso']  ?></option>
                         
                        
                    <?php } ?>
                </select>
<br>       <strong>Periodo:</strong><br>
                <select class="form-control" id="periodo"  onchange="  funviones();">
                    <option value="<?php   echo $_SESSION['numero'] ?>"><?php   echo $_SESSION['numero'] ?> Periodo</option>
                    <?php foreach ($periodo as $key ) {
                        if ($_SESSION['numero']!=$key['numero'] ) { 
                            ?>

                            <option value="<?php   echo $key['numero'] ?>"><?php   echo $key['numero'] ?> Periodo</option>
                            <?php
                        }
                    } ?>
                </select><br>
   
<body>
 
<label class="container1">Tamaño Carta
  <input type="radio" checked="checked" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container1">Tamaño Oficio
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label> 
              </div>
            </div>
          </div>
          <div class="col-md-9 "  id="r">
            <div id="sapo"></div>
              <div style="background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
               <div style="background-color: #28A5E6;padding: 10px">
                  <div style="  color: #fff">  <strong>MIS ARCHIVOS Y GUIAS 
                  </strong> 
                  </div>
                </div>

                   <br>
                <div id="todos" style="display: none;">
                  
               
                <div id="boleta" style="  ">
                  
                </div>
                </div>
                
             
   
                  
             
             </div><br>
            </div>
          </div>
        </div>
      </div> 
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b> IBUnotas</b> 1.0
      </div>
      <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>
  </div>

<!-- Slimscroll -->
<script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../bower_components/fastclick/lib/fastclick.js"></script> 
<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>
 




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
 
  


 function funviones(){
  var sede_grado=document.getElementById('sede_grado').value;
  var periodo=document.getElementById('periodo').value;
  var porcion=sede_grado.split(',');
  var curso=porcion[6];
  var grado=porcion[5];
  var jornada=porcion[4];
  var sede=porcion[3];
  var id_curso=porcion[2];
  var id_grado=porcion[1];
  var id_jornada_sede=porcion[0];
  mostrar(); 
    $.ajax({   
        type: "post",  
        data:{id_curso,id_grado,id_jornada_sede,periodo,sede,curso,grado,jornada},
        url:"../../../ajax/docente/boletin.php?action=ver",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 

          document.getElementById('todos').style.display='block'; 
          $('#boleta').html(data);

        }  
      });
 }
 funviones();
  </script>
</body>



