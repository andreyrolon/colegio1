<?php 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.php"); echo($_SESSION['Session']);
} include('../enlaces/head.php');  

include "../../../codes/rector/jornada.php";
$sedes=new jornada();  
$sede=$sedes->mostrar_jornada_sede();
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
}else{
  $sty='';
}  
 $style='';
   if ($sty=='font-size: 23px; font-family: Brush Script MT, Brush Script Std, cursive;') {
    $style='font-size: 24px;';  
  }
  if ($sty=='font: 1.756em/1.3 Gill Sans MT, Gill Sans, My Gill Sans, sans-serif;font-style: italic;') {
     $style='font-size: 17px;';  
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  "> 
      <section class="content">
        <div class="row">
            
          <div class="col-md-3  ">
            <div class="box box-danger" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff">
               <strong style="margin-left: 16px">Buscar alumno:</strong>
              <div class="panel-body">
                <div class="has-feedback">
                  <input type="text" name="Apellidos" placeholder="Apellidos.." class="form-control" id="apellidos" onblur='uni()'>
                  <span class="fa fa-search form-control-feedback" style="color: #CCCCCC "></span>
                </div> 
                 
              </div>
            </div>
            <br><br>
            <div class="box box-primary"  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff">
              <strong style="margin-left: 16px">Buscar curso:</strong>
              <div class="panel-body">
                <form  method="get" action="notas_relleno1.php">
                  <div class="form-group">
                    <div class="icon-addon addon-lg">
                        <select class="form-control select2" id="jornada_sede">
                          <option value="">Seleccione una sede</option>
                          <?php 
                          foreach ($sede as $key) {
                            ?>
                            <option value="<?php echo $key['ID_JS']  ?>">
                              <?php echo 'Sede: '.$key['jornada'].' - Jornada: '.$key['NOMBRE']  ?>
                            </option>
                            <?php
                          } ?>
                        </select>
                        <br><br>
                        <select class="form-control select2" id="curso"></select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="box box-info" id="aa3" style=" display:none;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff">
              <div id="aa" style="display: none; overflow: auto;height: 800px"></div>
              <div id="aa1" style="display: none; overflow: auto;height: 800px"></div>
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
        $.ajax({  

            type: "post",
            data:{ape},
            url:"../../../ajax/rector/notas/notas.php?action=buscar_estudiante_notas_por_saberes",
            dataType:"text", 
            success:function(data){ 
              $('body').loadingModal({text: 'Showing loader animations...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 100;

                delay(time)
                .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                document.getElementById('aa').style.display='block';
                document.getElementById('aa3').style.display='block';
                document.getElementById('aa1').style.display='none'; 
                $('#aa').html(data); 
            } 
        });
   
    }
    

 
       
     
    

    $("#jornada_sede").change(function(){
    var idjs=document.getElementById("jornada_sede").value; 
     mostrar(); 
        $.ajax({  

            type: "post",
            data:{idjs}, 
            url:"../../../ajax/seles/seles.php?action=sacar_curso6",
            dataType:"text", 

            success:function(data){  
                $('body').loadingModal({text: 'Showing loader animations...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 100;

                delay(time)
                .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                $('#curso').html(data); 
            } 
        });  
});
  $("#curso").change(function(){ mostrar();
    var id=document.getElementById("curso").value; 
    var idjs=document.getElementById("jornada_sede").value; 
    if (id!='') {
      $.ajax({   
        type: "post",
        data:{id,idjs}, 
        url:"../../../ajax/rector/notas/notas.php?action=consultar_notas_por_saberes",
        dataType:"text",  

        success:function(data){ 
          $('body').loadingModal({text: 'Showing loader animations...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 100;

                delay(time)
                .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
            document.getElementById('aa').style.display='none';
            document.getElementById('aa1').style.display='block';  
            document.getElementById('aa3').style.display='block';  
            $('#aa1').html(data); 


        }  
      }); 
    }
  });
</script>    