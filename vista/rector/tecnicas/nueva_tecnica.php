


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


<style type="text/css">select:focus{
  border: 1px solid #000; }</style>

 


 
 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } 

    $style=$sty;
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 22px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
    $style='font: 1.190em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic; ';  
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');  ?>
    <div class="content-wrapper"> <br> 
      <div class="row">
        <form method="post" id="agregar">
            <div class="modal fade" id="myModal" role="dialog">
             <div class="modal-dialog">
              <div class="modal-content" id="cotent">
                <div class="modal-header btn btn-primary" style="width: 100%;border-radius: 0px" id="header" style="">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                  </button>
                  <div style=" <?php echo $style ?> float: left;">Nueva Tecnica</div> 
                </div>

                <div class="modal-body" id="body" >
                  <div id="_MSG4_"></div>
                  
                  <div class="form-group">
                    <label class="sr-only" for="form-last-name">Titulo</label>
                    <input type="text" name="Titulo" placeholder="Titulo..." class="form-last-name form-control" id="Titulo"      >
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="form-email">Abreviado</label>
                    <input type="text" name="Abreviado" placeholder="Abreviado..." class="form-email form-control" id="Abreviado" >
                  </div>
                   <div class="form-group">
                    <label class="sr-only" for="form-email">Institucion</label>
                    <input type="text" name="Institucion" placeholder="Institucion..." class="form-email form-control" id="Institucion" >
                  </div>
                  
                   
                  
                    
                
                </div>
                <div class="modal-footer">
                  <button class="btn btn-danger" type="button" data-dismiss='modal'>Cancelar</button>  
                  <button type="submit" name="registro" id="btn1"   class="btn btn-primary">Registrar</button> 
                </div>

              </div>
            </div></div> 
        </form>
        <div class="col-md-3" style="margin: 20px;">
          <div class="box bo"  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <form   method="post">
              <div class="box-header with-border" style="background-color: #d73925;color: #fff">
                <div style=" <?php echo $style ?> float: left;">Buscar Docente</div>
              </div>
              <div class="box-body"><br>
                <select name="sede" class="form-control select2" id="koo" style= " <?php echo $style ?>width: 100%;" >
                </select>
                <br> 
                <div id="external-events"> 
                  <div id="sapo"></div> <br>   
                </div>
              </div>
            </form>
          </div>
          <br> 
          <div class="box box-primary" id="" style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div id="_MSG_" ></div> 
            <div class="box-body box-profile" id="tec">

            </div>
            <!-- /.box-body -->
          </div>  
        </div> 
        <div class="col-md-1"></div>

 
        <div class="col-md-7"> <br>
          <div class="nav-tabs-custom" id="mostrar_grados" style="margin: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

            <!-- /.col -->
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
  function actualizar_modalidad(grado,sele,grado_sede){
    mostrar1();
      $.ajax({   
            type: "post",

              data:{grado,sele,grado_sede}, 
            url:"../../../ajax/rector/tecnica.php?action=actualizar_modalidad",
            dataType:"text", 

            success:function(data){  
              $('body').loadingModal({text: 'Showing loader animations...'});

              var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
              var time = 100;

              delay(time)
              .then(function() { $('body').loadingModal('hide'); return delay(time); } )
              .then(function() { $('body').loadingModal('destroy') ;} ); 

            }  
          });
  
    }

  function mostrat(){ 
    mostrar1();
    $.ajax({   
      type: "post",

      url:"../../../ajax/seles/seles.php?action=sele_tecnica",
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
  function elimna(eliminar,i){
    mostrar1();
    $.ajax({   
      type: "post",
      data:{eliminar}, 
      url:"../../../ajax/rector/tecnica.php?action=eliminar",
      dataType:"text", 

      success:function(data){   
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );    
        if (data>0) {
          mensaje(1,'Actualmente tiene grados registrados');
        }else{
          var id_sede=document.getElementById('koo').value;
          functiond(id_sede); 
          $("#"+i).remove(); 

          mensaje(3,'Registro Eliminado');

        }

      }  


    }); 
  }
 

function functiond(id_sede){
  mostrar1();
    $.ajax({   
            type: "post",
            data:{id_sede}, 
            url:"../../../ajax/rector/tecnica.php?action=mostrar_grados",
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
 
      function ver_todo(){
        mostrar1();
        document.getElementById("koo").focus(); 
        $.ajax({   
          type: "post",

          url:"../../../ajax/seles/seles.php?action=sele_sede",
          dataType:"text", 

          success:function(data){  
            $('#koo').html(data); 
            $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 


          }  
        });
      } ver_todo();



function mostra_t(){ 
  mostrar1();
        $.ajax({   
          type: "post",

          url:"../../../ajax/rector/tecnica.php?action=mostrar_tecnicas",
          dataType:"text", 

          success:function(data){  
            $('#tec').html(data);
            $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} );  


          }  
        }); }mostra_t();

$(document).on("submit", "#agregar", function(e){
    e.preventDefault();
      var Titulo = $("#Titulo").val();
    var Abreviado = $("#Abreviado").val();
    var Institucion= $("#Institucion").val();
    if (Titulo=='') {
      mensaje4(2,"Ingrese el nombre de la tecnica");
      document.getElementById("Titulo").focus();
      return false; 
    } 
    if(ESnombre(Titulo)){
      mensaje4(2,"El nombre de la tecnica no permite numeros");
      document.getElementById("Titulo").value='';
      document.getElementById("Titulo").focus();
      return false; 
    }
    if (Abreviado=='') {
      mensaje4(2,"Ingrese el nombre abreviado de la competencia");
      document.getElementById("Abreviado").focus();
      return false; 
    } 
    if(ESnombre(Abreviado)){
      mensaje4(2,"El nombre abreviado de la competencia no permite numeros");
      document.getElementById("Abreviado").focus();   
      document.getElementById("Abreviado").value='';
      return false; 
    }
    if (Institucion=='') {
      mensaje4(2,"Ingrese el nombren de la Institucion del convenio");
      document.getElementById("Institucion").focus();
      return false; 
    } 
    if(ESnombre(Institucion)){
      mensaje4(2,"El nombre de la Institucion no permite numeros");
      document.getElementById("Institucion").focus();    
      document.getElementById("Institucion").value='';
      return false; 
    }  
    else{   
      mostrar1();
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
          var id_sede=document.getElementById('koo').value;
          functiond(id_sede);
          $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        }
      });
    }
  });



        $("#koo").change(function(){
          mostrar1();
          var id_sede=document.getElementById("koo").value; 
          $.ajax({   
            type: "post",
            data:{id_sede}, 
            url:"../../../ajax/rector/tecnica.php?action=mostrar_grados",
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
