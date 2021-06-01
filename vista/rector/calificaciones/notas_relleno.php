 
  <!-- Google Font -->

<?php 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session']);
    }
    include('../enlaces/head.php'); ?>
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  }  
 $style='';
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
     $style='font-size: 17px;';  
  } ?>
  <style>
    tr:hover{
      border:solid 2px #C7C6C6;
    }
  </style>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  "> 
      <section class="content">
        <div class="row">      


          <div class="modal fade in" id="mymodal" style="background-color: rgba(3, 64, 95, 0.3);  ">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header btn-primary table-responsive">
                  <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true" ><strong style="color: #fff"> ×</strong></button>
                  <h4 id="titulo" class="modal-title" style=" <?php echo $style.$sty ?>">  Calificaciones Por Periodo</h4>
                </div> <div id="_MSG_" style=" margin: 10px"></div>
                <input type="hidden" id="tito" name="" value="c4986f127e53f68fb897157e6f33ee2c.pdf">
                <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
                  <div id="sapo" style=" margin:10px"></div>
                  <div class="modal-body table-responsive" id="ver">

                  </div>
                  <div class="modal-footer">    
                    <button type="button" class="btn  btn-block btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>




          <div class="col-md-3  "> 
            <div class="box box-danger" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff">
              <div style="margin-left: 13px" ><strong> Buscar alumno</strong></div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="icon-addon addon-lg">
                    <input type="text" name="Apellidos"  style=" <?php echo $style ?>" placeholder="Apellidos.." class="form-control" id="apellidos" onblur='uni()'> 
                  </div>
                </div>
              </div>
            </div>
            <br><br>
            <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff">
              <div   style="margin-left: 13px"><strong> Buscar curso</strong></div>
              <div class="panel-body">
                <form  method="get" action="notas_relleno1.php">
                  <div class="form-group">
                    <div class="icon-addon addon-lg">
                      <select class="form-control select2"  style=" <?php echo $style ?>"s id="jornada_sede"></select>
                      <br><br>
                      <select class="form-control select2"  style=" <?php echo $style ?>"s id="curso"></select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>  
          <div class="col-md-9" >
            <div class="box box-info col-md-12" id="qaq" style="display: none; padding-left: 10px;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff;<?php echo $style ?>">
              <div style="padding-left: 10px;padding-top: 3px;padding-bottom: 10px">
                <strong>Lista de estudiantes</strong><br>
                Seleccione el estudiante que desea ver sus calificaciones por periodo.
              </div> 
              <div id="aa"   style="overflow: auto;height: 780px">
              </div>
              <div id="aa1" style="display: none;overflow: auto;height: 780px"></div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
         Desarrollado por IBUsoft.
        </div>
        <strong>IBUnotas 1.0.
    </footer>
  </div>
</body>

         
  


























 <?php include '../enlaces/footer.php'; ?>
<script src="../../../js/jquery.loadingModal.js"></script> 
<link rel="stylesheet" href="../../../css/jquery.loadingModal.css"> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
<script type="text/javascript">

  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});
    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
  }




  function uni(){

    mostrar();
    var ape = document.getElementById("apellidos").value;
    var style='<?php echo $style ?>';
    $.ajax({  

      type: "post",
      data:{ape,style},
      url:"../../../ajax/rector/notas/notas.php?action=consultar_estudiantes_por_apellido",
      dataType:"text", 
      success:function(data){ 
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        document.getElementById('aa').style.display='none';
        document.getElementById('aa1').style.display='block'; 
        document.getElementById('qaq').style.display='block';   
        $('#aa1').html(data); 
        document.getElementById('aa').style.display='block';
        document.getElementById('aa1').style.display='none';
                document.getElementById('qaq').style.display='block';  
        $('#aa').html(data); 
      } 
    });

  }
    

 
       
     
     $.ajax({  

      type: "post",
      url:"../../../ajax/seles/seles.php?action=nuevo_grado",

      dataType:"text", 

      success:function(data){  
        $('#jornada_sede').html(data); 


      } 
     });   

    $("#jornada_sede").change(function(){
    var idjs=document.getElementById("jornada_sede").value; 
     $.ajax({   
        type: "post",
        data:{idjs}, 
        url:"../../../ajax/seles/seles.php?action=sacar_curso", 
        dataType:"text", 

        success:function(data){  
          $('#curso').html(data); 


        }  


      }); 
});
  $("#curso").change(function(){ 
    var id=document.getElementById("curso").value; 
    mostrar();
    $.ajax({   
      type: "post",
      data:{id}, 
      url:"../../../ajax/rector/notas/notas.php?action=consultar_curso_por_periodo",
      dataType:"text", 
      success:function(data){ 
         $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;

        delay(time)
 .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
        document.getElementById('aa').style.display='none';
        document.getElementById('aa1').style.display='block';  
        document.getElementById('qaq').style.display='block';  
        $('#aa1').html(data); 
      }  
    }); 
  });

  function myfun2(minimo,maximo, id_nota, notar,nombre,nota,ui){
     if(decimaa(nota)){
            if(ESnombre1(nota)){ 
              var datra='<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">alert!</h4><p>Solo permite numeros deacuerdo a lo estipulado por la institucion</p></div>';
              $('#sapo').html(datra);  
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                $(this).remove();});
              }, 9300);
              document.getElementById(nombre).focus();

              document.getElementById(nombre).value=0;
            } 
            if(decimaa1(nota)){ 
              var datra='<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">alert!</h4><p>Los numeros decimales se  escriben con punto</p></div>'
              $('#sapo').html(datra); 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                $(this).remove();});
              }, 9300);
              document.getElementById(nombre).focus();

              document.getElementById(nombre).value=0;
                return;
            }else{  
              var datra='<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">alert!</h4><p>El numero esta mal escrito</p></div>'
              $('#sapo').html(datra); 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                $(this).remove();});
              }, 9300);
              document.getElementById(nombre).focus();

              document.getElementById(nombre).value=0;
                return;
            }
        }


        if(nota<minimo){ 
          var datra='<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">Error!</h4><p>  recordamos que la nota mas baja es  '+minimo+'</p></div>'
          $('#sapo').html(datra); 
          window.setTimeout(function  () {
            $(".alert").fadeTo(1000, 0).slideUp(500, function(){
            $(this).remove();});
          }, 9300);
          document.getElementById(nombre).focus();

          document.getElementById(nombre).value=0;
          return;
        }
        if(nota>maximo){ 
          var datra='<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">Error!</h4><p>recordamos que la nota mas alta es   '+maximo+'</p></div>'
          $('#sapo').html(datra); 
          window.setTimeout(function  () {
            $(".alert").fadeTo(1000, 0).slideUp(500, function(){
            $(this).remove();});
          }, 9300);

          document.getElementById(nombre).focus();
          document.getElementById(nombre).value=0;
            return;
        }else{ 
            $.ajax({   
                type: "post",
                data:{ id_nota, nota },
                url:"../../../ajax/rector/notas/notas.php?action=actulizar_nota_periodo2",
                dataType:"text", 
                success:function(data){ 
                  var datra='<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">información!</h4><p>Nota registrada</p></div>';
                    $('#sapo').html(datra); 
                  window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove();});
                  }, 9300);
 
                }  
            });   
        }
  }       


 function  myfun(minimo,maximo,ui,id_nota,notar,nombre,nota,area,codigo,periodo){ 
            
        if(decimaa(nota)){
            if(ESnombre1(nota)){ 
              var datra='<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">alert!</h4><p>Solo permite numeros deacuerdo a lo estipulado por la institucion</p></div>'
              $('#fg'+ui).html(datra); 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                $(this).remove();});
              }, 9300);
              document.getElementById(nombre).focus();

              document.getElementById(nombre).value=0;
            } 
            if(decimaa1(nota)){ 
              var datra='<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">alert!</h4><p>Los numeros decimales se  escriben con punto</p></div>'
              $('#fg'+ui).html(datra); 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                $(this).remove();});
              }, 9300);
              document.getElementById(nombre).focus();

              document.getElementById(nombre).value=0;
                return;
            }else{  
              var datra='<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">alert!</h4><p>El numero esta mal escrito</p></div>'
              $('#fg'+ui).html(datra); 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                $(this).remove();});
              }, 9300);
              document.getElementById(nombre).focus();

              document.getElementById(nombre).value=0;
                return;
            }
        }


        if(nota<minimo){ 
          var datra='<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">Error!</h4><p>  recordamos que la nota mas baja es  '+minimo+'</p></div>'
          $('#fg'+ui).html(datra); 
          window.setTimeout(function  () {
            $(".alert").fadeTo(1000, 0).slideUp(500, function(){
            $(this).remove();});
          }, 9300);
          document.getElementById(nombre).focus();

          document.getElementById(nombre).value=0;
          return;
        }
        if(nota>maximo){ 
          var datra='<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">Error!</h4><p>recordamos que la nota mas alta es   '+maximo+'</p></div>'
          $('#fg'+ui).html(datra); 
          window.setTimeout(function  () {
            $(".alert").fadeTo(1000, 0).slideUp(500, function(){
            $(this).remove();});
          }, 9300);

          document.getElementById(nombre).focus();
          document.getElementById(nombre).value=0;
            return;
        }else{ 
            $.ajax({   
                type: "post",
                data:{ui,id_nota,nombre,nota,notar,codigo,area,periodo},
                url:"../../../ajax/rector/notas/notas.php?action=actulizar_nota_periodo",
                dataType:"text", 
                success:function(data){ 
                  var datra='<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button> <h4 style="<?php echo $sty ?>">info!</h4><p>Nota registrada</p></div>'
                  $('#fg'+ui).html(datra); 
                  window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                      $(this).remove();
                    });
                  }, 9300); 
                  if (data==0) {
                    var id=ui;
                    funcion(id);
                  }
                }  
            });   
        }
    }


  function funcion(id){
    var style='<?php echo $style ?>';
    var sty='<?php echo $sty ?>';
    mostrar(); 
    $.ajax({  

      type: "post",
      data:{id,style,sty},
      url:"../../../ajax/rector/notas/notas.php?action=tabla_materias",
      dataType:"text", 
      success:function(data){ 
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 0;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#ver').html(data);
      } 
    });
  }

    </script>