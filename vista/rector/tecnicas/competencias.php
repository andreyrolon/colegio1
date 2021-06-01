


<?php 

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['1Session']);
    }

    include '../../../codes/rector/docente.php';
$p=new docente();
$rperiodoo=$p->ver_periodos();

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
    $style='font: 1.190em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic; ';  
  } ?>

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');  ?>
    <div class="content-wrapper"> 
    <div class="row"> 
    <div class="col-md-12">  
      <div id="sapo"></div> 
      <form method="post" id="din">
        <div class="modal fade" id="dd" role="dialog">
             <div class="modal-dialog">
              <div class="modal-content" id="cotent">
                <div class="modal-header btn btn-primary" id="header" style="width: 100%">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                  </button>
                  <div style="font-size: 20px;float: left; <?php echo $sty ?>"> Nueva Competencia </div> 
                </div>

                <div class="modal-body" id="body" >
                  <div id="_MSG2_"></div>
                  
                  <div class="form-group">
                    <label >Nombre</label>
                    <input type="text" style="<?php echo $style ?>" name="nombre" placeholder="Competencia..." class="form-last-name form-control" id="nombre"    >
                  </div>
                  <div class="form-group">
                    <label>Codigo</label>
                    <input type="text"  style="<?php echo $style ?>"name="codigo" placeholder="codigo..." class="form-email form-control" id="codigo" >
                  </div> 
                  <div class="form-group">
                    <label>Intencidad horaria</label>
                    <input type="number" name="hora"  style="<?php echo $style ?>"  class="form-email form-control" id="hora" >
                  </div> 
                  
                  
                    <input type="hidden" id="grado" value="" name="grado" class="form-email form-control" >
                   <input type="hidden" name="id_tecnica_grado_sede" id="id_tecnica_grado_sede">
                  <div class="form-group">
                    <label>Periodo</label>
                    <select class="form-control" style="<?php echo $style ?>" name="periodo" id="periodo">
                      <?php 
                      foreach ($rperiodoo as $keue) {
                        ?><option value="<?php echo $keue['numero'] ?>"><?php echo $keue['numero'] ?></option><?php
                       } ?>
                    </select>
                    <input type="hidden" value="" name="id_tecnica" value="" id="id_tecnica" >
                  </div> 
                   
                  <button type="submit" class="btn btn-primary" style="<?php echo $style ?>" name="" id=" "  ">Registrar</button>
                  <button type="button" data-dismiss="modal" class="btn btn-default" style="<?php echo $style ?>" name="" id=" "  ">Cancelar</button>  
                </div>

              </div>
            </div>
        </div>
      </form>
      
      <div class="col-md-4"  >
        <br>

        <div class="box bo"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">

          <form   method="post">
            <div class="box-header with-border" style="background-color: #d73925;color: #fff">
              <h4 class="box-title " style=" <?php echo $style?> ">Buscar tecnica</h4>

            </div> 
            <div class="box-body"><br>
              <select name="sede" class="form-control select2" id="ko" style="width: 100%; <?php echo  $style?>  " >

              </select><br> 
              <select name="grados" class="form-control select2" id="grados" style="width: 100%;<?php echo  $style?>   " >

              </select>

              <br> 
              <div id="external-events">  


                <br>   

              </div>
            </div></form>

          </div> 
           
      </div>

 

 
        <div class="col-md-7"    > <br>  <div class="table table- " >
            <div id="_MSG3_" ></div> 
          <div class="box box-primary"  id="mostrar_grados" style="  display: none;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          </div>
          </div> </div>
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

  $(document).on('blur', '.first_name', function(){  
    var ides = $(this).data("ides");  
    var n = $(this).data("n");  
    var grado = $(this).data("grado");  
    var codes = $(this).data("codes"); 
    codes=document.getElementById(codes).value; 
    var como = $(this).data("como");  
    var first_name = $(this).text();   
    var u=first_name; 
    cambiar_compe3(grado,codes,como,u,ides,n)
  });


  function mostrat(){
    mostrar1();
    document.getElementById("ko").focus();
    $.ajax({   
      type: "post",

      url:"../../../ajax/seles/seles.php?action=sacar_el_grado_competencia",
      dataType:"text", 

      success:function(data){  
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#ko').html(data); 


      }  
    });
  }
  function elimna(eliminar,i,io,o){
    mostrar1();
    $.ajax({   
      type: "post",
      data:{eliminar,i,io,o}, 
      url:"../../../ajax/rector/tecnica.php?action=eliminar",
      dataType:"text", 

      success:function(data){   
        oio(); mostrat();
        if (data==1) {
          $("#"+io).remove();
          $("#"+o).remove();
          $("#"+i).remove();
          $("#b1"+eliminar).remove();
          $("#b4"+eliminar).remove();
          $("#b2"+eliminar).remove();
          $("#b3"+eliminar).remove();
        }else{

          $('#_MSG_').html(data);
        }

      }   
    }); 
    $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
   }


  function mostrat(){
    mostrar1()
    document.getElementById("ko").focus();
    $.ajax({   
      type: "post",

      url:"../../../ajax/seles/seles.php?action=sacar_el_grado_competencia",
      dataType:"text", 

      success:function(data){ 
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );  
        $('#ko').html(data);  
      }  
    });
  }mostrat();


  $(document).on("submit", "#agregar", function(e){
    e.preventDefault();
    mostrar1();
    var Titulo = $("#Titulo").val();
    var Abreviado = $("#Abreviado").val();
    var Institucion= $("#Institucion").val();
    if (Titulo=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje4(2,"Ingrese el nombre de la tecnica");
      document.getElementById("Titulo").focus();
      return false; 
    } 
    if(ESnombre(Titulo)){
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje4(2,"El nombre de la tecnica no permite numeros");
      document.getElementById("Titulo").value='';
      document.getElementById("Titulo").focus();
      return false; 
    }
    if (Abreviado=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje4(2,"Ingrese el nombre abreviado de la competencia");
      document.getElementById("Abreviado").focus();
      return false; 
    } 
    if(ESnombre(Abreviado)){
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje4(2,"El nombre abreviado de la competencia no permite numeros");
      document.getElementById("Abreviado").focus();   
      document.getElementById("Abreviado").value='';
      return false; 
    }
    if (Institucion=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje4(2,"Ingrese el nombren de la Institucion del convenio");
      document.getElementById("Institucion").focus();
      return false; 
    } 
    if(ESnombre(Institucion)){
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje4(2,"El nombre de la Institucion no permite numeros");
      document.getElementById("Institucion").focus();    
      document.getElementById("Institucion").value='';
      return false; 
    }  
    else{   
      $.ajax({

        type: "post",
        url:"../../../ajax/rector/tecnica.php?action=agregar_tecnica",
        data: $(this).serialize(),
        dataType:"text", 
        success: function(data)
        { 

          document.getElementById("Titulo").value='';
          document.getElementById("Titulo").focus();
          document.getElementById("Institucion").value='';
          document.getElementById("Abreviado").value='';
          mostra_t();
          mostrat();
          
        }
      });
    }
    $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
  });

  function oio(){
    mostrar1();
    id_tecnica=document.getElementById("id_tecnica").value;
    $.ajax({   
      type: "post",
      data:{id_tecnica}, 
      url:"../../../ajax/rector/tecnica.php?action=mostrar_competencias",
      dataType:"text", 

      success:function(data){    
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#mostrar_grados').html(data);  
      }  


    });  
  }

  $(document).on("submit", "#din", function(e){
    e.preventDefault(); 
    mostrar1();
    var hora = $("#hora").val();
    var NOMBRE = $("#nombre").val();
    var CODIGO = $("#codigo").val();
    var grado= $("#grado").val();
    if (NOMBRE=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje2(2,"Ingrese el nombre de la competencia");
      document.getElementById("nombre").focus();
      return false; 
    } 
    if(ESnombre(NOMBRE)){
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje2(2,"El nombre de la competencia no permite numeros");
      document.getElementById("nombre").focus();
      document.getElementById("nombre").value='';
      return false; 
    } if (CODIGO=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje2(2,"Ingrese el codigo de la competencia");
      document.getElementById("codigo").focus();
      return false; 
    } 
    if(ESnumeros(CODIGO)){
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje2(2,"El codigo de la competencia no permite letras");
      document.getElementById("codigo").focus();
      document.getElementById("codigo").value='';
      return false; 
    }if (hora=='') {
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje2(2,"Ingrese la intencidad horaria");
      document.getElementById("hora").focus();
      return false; 
    } 

    if (grado==''){
      $('body').loadingModal({text: 'Showing loader animations...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
      var time = 100;

      delay(time)
      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
      .then(function() { $('body').loadingModal('destroy') ;} ); 
      mensaje2(2,"Ingrese el grtado de la competencia");
      document.getElementById("grado").focus();
      return false; 
    }
    else{ 
      $.ajax({

        type: "post",
        url:"../../../ajax/rector/tecnica.php?action=competenciass",
        data: $(this).serialize(),
        dataType:"text", 
        success: function(data)
        {  


         $('#_MSG2_').html(data); 
         var id=document.getElementById("ko").value;  

         var id_tecnica_grado_sede=document.getElementById("grados").value;  
         $.ajax({   
          type: "post",
          data:{id_tecnica_grado_sede,id,hora}, 
          url:"../../../ajax/rector/tecnica.php?action=mostrar_competencias",
          dataType:"text", 

          success:function(data){   

            $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 100;

            delay(time)
            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#mostrar_grados').html(data); 
            document.getElementById('din').reset();
            document.getElementById('nombre').focus();
          }  


        }); 
       }
     });
    }
    
  });

  $("#ko").change(function(){
    mostrar1();
    var id=document.getElementById("ko").value;  
    $.ajax({   
      type: "post",
      data:{id}, 
      url:"../../../ajax/seles/seles.php?action=sacar_el_grado_competencia2",
      dataType:"text", 

      success:function(data){   

        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#grados').html(data); 

      }  


    }); 
  });


  $("#grados").change(function(){
    mostrar1();
   document.getElementById("mostrar_grados").style.display='block';  
   var id=document.getElementById("ko").value;  

   var id_tecnica_grado_sede=document.getElementById("grados").value;  

   var res = id_tecnica_grado_sede.split(" ");
   document.getElementById("grado").value = res[1];

   document.getElementById("id_tecnica").value = id;
   document.getElementById("id_tecnica_grado_sede").value = res[0];
   $.ajax({   
    type: "post",
    data:{id_tecnica_grado_sede,id}, 
    url:"../../../ajax/rector/tecnica.php?action=mostrar_competencias",
    dataType:"text", 

    success:function(data){   

      $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
      $('#mostrar_grados').html(data); 

    }  


  }); 
});






</script>




 </body>

 </html>
  