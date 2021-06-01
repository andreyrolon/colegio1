
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"  
        crossorigin="anonymous"> 
 <?php
 session_start();
 require_once "../../../codes/docente/chat.php";
 $chat=new chat(); 
 $consulta_grado_sede=$chat->consulta_grado_sede($_SESSION['Id_Doc']);
 $periodo=$chat->periodo();
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session'])){
  header("location: ../../../login.php");  
}



include('../enlaces/head.php');
?>
 
      <style>
#i{
width: 100px;
}
#i:hover{
width: 300px;
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
      text-decoration: underline;
    }
  </style>
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <div class="row">
        <div class="col-md-12">
          <div id="nop" class="alert bg-info-500" role="alert " style="margin: 10px; color: #0a6ebd; background-color: #e3f2fd;border-color: #82c4f8;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button><strong>Informacion!</strong>  <br>Solo los titulares podran ver los puestos y las mensiones de honor.  </div>
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
                    ?>   
                        <option value="<?php echo $value['id_jornada_sede'].','.$value['id_grado'].','.$value['id_curso']   ?>">Sede: <?php echo $value['sede'].'-'.$value['jornada'].' / Grado: '.$value['grado'].'-'.$value['curso']  ?></option>
                         
                        
                    <?php } ?>
                </select>
                <br>
                <strong>Periodo:</strong><br>
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
                <button data-toggle="modal" data-target="#my" style="width: 100%" type="button" class="btn btn-danger">Modelos</button>
               









                
              </div>
            </div>
          </div> 
          <div class="col-md-9 "  id="r">
            <div id="sapo"></div>
              <div style=" background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
               <div style="background-color: #28A5E6;padding: 10px">
                  <div style="  color: #fff">  <strong>MENSION DE HONOR  
                  </strong> 
                  </div>
                </div>

                   <br>
                
                   
                <div id="boleta"  >
                  
                </div> 
                <br>
             
   
                  
              <a id="qw" target="_blank"></a>
             </div>
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
    var porcion=sede_grado.split(',');
    var id_curso=porcion[2];
    var id_grado=porcion[1];
    var id_jornada_sede=porcion[0];
    var periodo=document.getElementById('periodo').value;
    mostrar(); 
    $.ajax({   
        type: "post",  
        data:{id_curso,id_grado,id_jornada_sede,periodo},
        url:"../../../ajax/docente/reconocimiento.php?action=ver",
        dataType:"text", 

        success:function(data){  
          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );  
          $('#boleta').html(data); 

        }  
      });
 }
  function descargar(){
    
    var seleccion1=document.getElementById('seleccion1').checked ; 
    if (seleccion1==true) {
      seleccion=1;
    }
    var seleccion2=document.getElementById('seleccion2').checked ; 
    if (seleccion2==true) {
      seleccion=2;
    }
    var seleccion3=document.getElementById('seleccion3').checked ; 
    if (seleccion3==true) {
      seleccion=3;
    }
    var seleccion4=document.getElementById('seleccion4').checked ; 
    if (seleccion4==true) {
      seleccion=4;
    }
    var seleccion5=document.getElementById('seleccion5').checked ; 
    if (seleccion5==true) {
      seleccion=5;
    }
    var seleccion6=document.getElementById('seleccion6').checked ; 
    if (seleccion6==true) {
      seleccion=6;
    }
    window.open('mencion_honor2.php?seleccion='+seleccion);
  }
  function descarga(nom,puesto){ 
    var seleccion1=document.getElementById('seleccion1').checked ; 
    if (seleccion1==true) {
      seleccion=1;
    }
    var seleccion2=document.getElementById('seleccion2').checked ; 
    if (seleccion2==true) {
      seleccion=2;
    }
    var seleccion3=document.getElementById('seleccion3').checked ; 
    if (seleccion3==true) {
      seleccion=3;
    }
    var seleccion4=document.getElementById('seleccion4').checked ; 
    if (seleccion4==true) {
      seleccion=4;
    }
    var seleccion5=document.getElementById('seleccion5').checked ; 
    if (seleccion5==true) {
      seleccion=5;
    }
    var seleccion6=document.getElementById('seleccion6').checked ; 
    if (seleccion6==true) {
      seleccion=6;
    }
    window.open('mencion_honor1.php?seleccion='+seleccion+'&&nom='+nom+'&&puesto='+puesto);
  }
  funviones();
  </script>
</body>



