<?php 


session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.php"); echo($_SESSION['Session']);
} 
include "../../../codes/rector/jornada.php";
$sedes=new jornada();  
$sede=$sedes->mostrar_jornada_sede();


include('../enlaces/head.php');
?>
<style>
.box-tools{
    color: #bfbfbf;
    display: block; 
}

 
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555; 
    background-color: #;
    /* border: 1px solid #73A1BD; */
    /* border-bottom-color: transparent; */
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    background-color: #4581ab;
    border: 0px  ;
    border-bottom-color: transparent;
}
</style>  
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
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
<div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  "> 
        <section class="content">
                <div class="row">
                      
                    <div class="modal fade" id="may"  style="background-color: rgba(3, 64, 95, 0.3);  " >
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> estás seguro de hacer el traslado?</p>  
                                </div>
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                                  id="btn"   onclick='  document.getElementById("for").click();'>Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <strong style="margin-left: 9px" >Buscar curso</strong>  <br>
                            <div class="box-body">

                                <strong>Sede:</strong><br>
                                <select name="" class="form-control  select2" id="sede1" onchange="buscar_curso()">
                                    <option>Seleccione un elemento</option>
                                    <?php 
                                    foreach ($sede as $key) {
                                         ?>
                                        <option value="<?php echo $key['ID_JS']  ?>"><?php echo 'Sede: '.$key['jornada'].' - Jornada: '.$key['NOMBRE']  ?></option>
                                         <?php
                                     } ?>
                                </select> <br> 
                                <strong>curso:</strong><br>
                                <select name="" class="form-control select2" id="curso1" onchange="buscar_alumnos()">

                                </select><br> 
                            </div>
                        </div><br><br> 

                        <div class="box box-danger" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <label for="nombre" style="margin-left: 9px">Buscar traslado</label> <br> 
                            <div class="box-body">
                                <strong>Sede:</strong><br>
                                <select name="" class="form-control" id="sede2" onchange="grado2()"></select> <br>
                                <label for="nombre">Grado:</label>  
                                <select name="" class="form-control" id="grado2" onchange='var y=document.getElementById("grado2").value;if(y!=""){ document.getElementById("trasladar").disabled=false;document.getElementById("js").value=document.getElementById("sede2").value;document.getElementById("grado").value=document.getElementById("grado2").value; }else{ document.getElementById("trasladar").disabled=true; }' ></select><br>
                                <button disabled type="buttom" style="width: 100%" id="trasladar" class="btn btn-danger"  data-toggle="modal" data-target="#may"   onclick="crear()">Trasladar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">  
                        <div class="box   box-info " id="most" style=" display: none; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div id="sapo"></div> 
                            <div id='academico'>
                                <div id="www1" class="table-responsive"> <br>
                                    <select id="mySelect"  onchange="myFunction(1)">


                                      <option value="5">5</option>
                                      <option value="10">10</option>
                                      <option value="20">20</option>
                                      <option value="50">50</option>
                                    </select>
                                    <div class="box-tools pull-right"><br>
                                        <div class="has-feedback">
                                            <input type="text" class="form-control input-sm" id='fname' placeholder="buscador.." onkeyup="myFunction(1)">
                                            <span class="fa fa-search form-control-feedback" style=" "></span>
                                        </div>
                                    </div>
                                    <!-- /.box-tools -->
                                </div> 
                                <div id="tabla"></div>
                                    <div id="www" class="callout callout-info" style="margin: 10px;">
                                        <h4>información:</h4>
                                        actualmente este curso no tiene alumnos. 
                                    </div><br>
                                <div id="ver"  >
                                </div>
                            </div>  
                           
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
 
<!-- iCheck --> 


 <?php include '../enlaces/footer.php'; ?>
<script src="../../../js/jquery.loadingModal.js"></script> 
<link rel="stylesheet" href="../../../css/jquery.loadingModal.css"> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
<script type="text/javascript">
    function mostrar(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) }; 

    }

    function buscar_curso(){
        mostrar();
        var idjs=document.getElementById('sede1').value; 
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
                $('#curso1').html(data); 
            } 
        }); 
    }

    

    function buscar_alumnos(){
        var curso1=document.getElementById('curso1').value; 
        var sede1=document.getElementById('sede1').value; 
        if (curso1!='') {
        mostrar();
            $.ajax({  

                type: "post",
                data:{curso1,sede1}, 
                url:"../../../ajax/rector/buscar_alumno/buscar.php?action=buscar",
                dataType:"text", 

                success:function(data){  
                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 100;

                    delay(time)
                    .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    
                    document.getElementById('most').style.display='block';
                    if (data==1) {
                        document.getElementById('www').style.display='block';
                        document.getElementById('www1').style.display='none';

                        $('#ver').html('');
                        
                    }else{
                        $('#ver').html(data);
                        document.getElementById('www1').style.display='block';
                        document.getElementById('www').style.display='none';
                        sede2(curso1);
                    }
                } 
            });

        } 
    }
    function sede2(curso1){
        mostrar();
        var porciones = curso1.split(' ');
        var id_grado=porciones[1]; 
        $.ajax({  

            type: "post",
            data:{id_grado}, 
            url:"../../../ajax/seles/seles.php?action=sede41",
            dataType:"text", 

            success:function(data){  
                $('body').loadingModal({text: 'Showing loader animations...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 100;

                delay(time)
                .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                $('#sede2').html(data); 
            } 
        }); 
    }
    function grado2(curso1){
        mostrar(); 
        var id_js=document.getElementById('sede2').value;
        var curso1=document.getElementById('curso1').value;
        var porciones = curso1.split(' ');
        var id_grado=porciones[1]; 
        $.ajax({  

            type: "post",
            data:{id_grado,id_js}, 
            url:"../../../ajax/seles/seles.php?action=grado41",
            dataType:"text", 

            success:function(data){  
                $('body').loadingModal({text: 'Showing loader animations...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 100;

                delay(time)
                .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                $('#grado2').html(data); 
            } 
        }); 
    }

   $(document).on("submit", "#cambio", function(e){
        e.preventDefault();  
        $.ajax({

            type: "post",
            url:"../../../ajax/rector/buscar_alumno/buscar.php?action=cambio", 
            data: $(this).serialize(),
            dataType:"text", 
            success: function(data)
            { 
                alert(data);

            }
        });
    });
</script>

