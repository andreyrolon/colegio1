
<?php
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.php"); echo($_SESSION['Session']);
}
 
include('../enlaces/head.php'); 
?>

<style>
    table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left; 
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
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">
    <div class="wrapper" class="form-control">
        <?php include('../enlaces/header.php');  ?>
            <div class="content-wrapper"> 
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="col-md-12">
 
                            <div  class=" col-md-3"><br>
                                <div class=" box box-danger" style=" background-color: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); display:  ;">
                                     
                                 
                                    <div style="padding: 10px">
                                    
                                        <form action="" id="apellido">  
                                            <label for="documento" style="margin-left: 10px"> Buscar estudiante:</label><br>
                                            <input type="" style="width:  %" class=" form-control" name="apellido" placeholder='busqueda por apellido' required="">
                                            <br> 
                                           <button type="submit"  class="btn btn-block btn-danger"  >Buscar</button>
                                        </form>
                                        
                                    </div> 
                                </div>
                                <div class=" box box-primary" style=" background-color: #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); display:  ;">
                                      
                                    
                                 
                                         
                                        
                                    
                                    <div style="padding: 10px">
                                    	<label for="documento" style="margin-left: 10px">Buscar por curso:</label> <br>
                                        <select name="" class="form-control" id="">
                                            <option value="">Seleccione una sede - jornada</option>
                                        </select> <br>  
                                        <select name="" class="form-control" id="">
                                            <option value="">Seleccione un curso</option>
                                        </select><br>
                                    
                                   <button type="button"  class="btn btn-block btn-primary">Buscar</button> 
                                        
                                    </div> 
                                </div>
                            </div>
                            

                            <div  class="col-md-9"><br>
                                <div class="box box-primary" id="boletin1" style=" overflow:auto;height: 800px;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); display:none   ;">
                                     
                                    <div style="width: 100%; background-color: #3c8dbc;color: #fff;height: 30px; font-size: 19px">
                                        <strong style="margin-left: 9px"> Boletines</strong><br><br>
                                    </div>
                                    <br>
                                    <div id="boletin"> 
                                    </div>
                                </div> 
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
</body>

<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>


<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>

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
<script type="text/javascript">
     function mostrar1(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
    $(document).on("submit", "#apellido", function(e){
        e.preventDefault();  
        mostrar1();
        $.ajax({

            type: "post",
            url:"../../../ajax/rector/boletines/boletines1.php?action=ver", 
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
                document.getElementById('boletin1').style.display='block';
                $('#boletin').html(data);
            }
        });
    });	 
	     
</script> 