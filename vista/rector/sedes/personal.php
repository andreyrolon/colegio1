<?php 

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }
include('../enlaces/head.php');
include '../../../codes/rector/sede.php';  
$sede=new sede();

$corer=$sede->mostrar4($_GET['id']);

if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  <style>
 .profile-user-img {
        margin: 0;
        width: 90px;
        height: 90px;
        border: 3px solid #3c8dbc;
    } 





  .lop{   
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
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
  border-radius: 2px;
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
  left: 8px;
  display: inline-block;
  color: #fff;
  border: 11px solid transparent;    
  border-bottom: 11px solid #000;
}
tr:hover td{
    background-color: #55b3ca3d;
    padding:40px;
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
    <?php include('../enlaces/header.php');   ?>
    <div class="modal fade in" id="mymodal1" data-keyboard="false" data-backdrop="static" style="background-color: rgba(3, 64, 95, 0.3);  ">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" style="width: 100%;<?php echo $sty; ?>">Confirmación</h4>
          </div>
          <div class="modal-body">Recuerde que si  inhabilita al docente, sus cargas acemicas de los cursos que tiene acargo que daran sin vacias.
            <p> estás seguro de Inhabilitar al docentes?</p>

          </div>
          <div class="modal-footer">  
          <button type="button" class="btn btn-eliminary2default" data-dismiss="modal">Cancelar</button>
          <input type="hidden" value="" name="eliminary2" id="eliminary2">
            <button type="button" data-dismiss="modal" name="Aceptar" id="dsd" value="1" class="btn btn-primary" onclick="
            var io=document.getElementById('eliminary2').value; Inhabilitar(io)">Aceptar</button> 
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade in" id="sww" data-keyboard="false" data-backdrop="static" style="background-color: rgba(3, 64, 95, 0.3);  ">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" style="width: 100%;<?php echo $sty; ?>">Confirmación</h4>
          </div>
          <div class="modal-body">
            <p> estás seguro de Inhabilitar al coordinador de esta sede?</p>

          </div>
          <div class="modal-footer">  
          <button type="button" class="btn btn-eliminary2default" data-dismiss="modal">Cancelar</button>
          <input type="hidden" value="" name="eliminary3" id="eliminary3">
            <button type="button" data-dismiss="modal" name="Aceptar" id="dsd" value="1" class="btn btn-primary" onclick="
            var io=document.getElementById('eliminary3').value; Inhabilitar_administrador(io)">Aceptar</button> 
          </div>
        </div>
      </div>
    </div>



    <div class="content-wrapper"> 
      <div class="row"> 
        <div class="modal fade in" id="my" style="background-color: rgba(3, 64, 95, 0.3);  ">
          <div class="modal-dialog">  
            <div class="modal-content">
              <div class="modal-header btn-primary table-responsive">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" style="width: 100%;<?php echo $sty; ?>">
                  Carga academica
                </h4>
              </div>
              <div id="table" style="padding: 20px"></div>
              <div class="modal-footer">     
                <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-12">  
        <div class="col-md-2">
           <div class="row">
            <br><br> 
            <div  class="nav-tabs-custom" id="koooo"  style=" 
    background-color: #d73925;
    color: #fff; margin: 13px;padding: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 

              <?php 
              foreach ($corer as $key  ) {
                 echo '<label for="documento">Sede:</label> '. $key['sede'];
                 echo '<br><label for="documento">Jornada:</label> '. $key['jornada']; 
               } ?>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
            <br><br>
            <div  class="nav-tabs-custom" id="koooo"  style="margin: 13px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <ul class="nav nav-tabs" >
                <li class="active"> <a  data-toggle="tab" href="#menu1" onclick="document.getElementById('admin').style.display='block';document.getElementById('menu2').style.display='none';" ><h4><strong style=" <?php echo $sty; ?>"> Docentes </strong></h4></a></li>
                <li > <a  href="#menu2" data-toggle="tab" onclick="mostrar2();document.getElementById('admin').style.display='none';document.getElementById('menu2').style.display='block'; " ><h4><strong style=" <?php echo $sty; ?>" > Coodinadores  </strong></h4></a></li>  
              </ul>
                <div class="tab-content">
                  <input type="hidden" name="id_js" id="id_js" value="<?php echo $_GET['id'] ?>">
                  <input type="hidden" name="id_jornada" id="id_jornada" value="<?php echo $_GET['id1'] ?>">
                  <input type="hidden" name="id_sede" id="id_sede" value="<?php echo $_GET['id2'] ?>">
                  <div class="tab-pane active" id="menu1">
                          <div class="box-header with-border"> <br>
                <select id="mySelect"  class="form-control" onchange="myFunction(1)" style="width:66px;">


                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select>
                <div class="box-tools pull-right"><br>
                    <div class="has-feedback">
                        <input type="text" class="form-control   " id='fname' placeholder="buscador.." onkeyup="myFunction(1)" style="margin-top: 5px;">
                        <span class="fa fa-search form-control-feedback" style=" "></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
                    <div  class="tab-content"  id="admin"> 

                    </div>
                  </div> 
                  <div class=" tab-pane active" style="" id="menu2"  style=""> 
                  </div>  
                </div> 
              </div> 
             
         </div>

       </div>
     </div> 
 </div>
 <!-- /.row -->

 <!-- /.content -->
</div>






<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> IBUnotas</b> 1.0
    </div>
    <strong>Desarrollado por  IBUsoft. </strong> 
  </footer>

 
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <!-- jQuery 3 -->



 

 <!-- jQuery 3 -->
 <!-- jQuery 3 -->

<script type="text/javascript">
  
  var id_js=<?php echo $_GET['id'] ?>; 

  var sty='<?php echo $sty; ?>';
  function  docente(id_docente){
    $.ajax({   
      type: "post",

      data:{id_js,id_docente,sty},
      url:"../../../ajax/rector/admin/admin.php?action=carga",
      dataType:"text", 

      success:function(data){  
        $('#table').html(data);  
      }  
    }); 
  }


  for (var i=0; i < 100; i++) {   




    function myFunction(i) {

      var id_js=document.getElementById("id_js").value;  
      var dato=document.getElementById("fname").value; 
      var mySelect=document.getElementById("mySelect").value; 
      var sty='<?php echo $sty; ?>';
      $.ajax({  

        type: "post",
        data:{id_js,i,mySelect,dato,sty},
        url:"../../../ajax/rector/admin/admin.php?action=ver_DOCENTE",
        dataType:"text", 

        success:function(data){  
          $('#admin').html(data); 


        }  


      });  
    }
  }

    function mostrar2(){
    $.ajax({   
      type: "post",

      data:{id_js,sty},
      url:"../../../ajax/rector/admin/admin.php?action=coodinador_ver",
      dataType:"text", 

      success:function(data){  
        $('#menu2').html(data); 


      }  


    }); 
  } 
  function Inhabilitar_administrador(io){
    $.ajax({   
      type: "post",

      data:{io,id_js},
      url:"../../../ajax/rector/admin/admin.php?action=Inhabilitar_administrador",
      dataType:"text", 

      success:function(data){  
        mostrar2() 


      }  


    });
  }


  function sasa(id){
    $.ajax({   
      type: "post",

      data:{id_js,id},
      url:"../../../ajax/rector/admin/admin.php?action=actualizar_jornada_sede",
      dataType:"text", 

      success:function(data){  
        mostrar2() 


      }  


    });
  }
  function mostrar(){
    $.ajax({   
      type: "post",

      data:{id_js,sty},
      url:"../../../ajax/rector/admin/admin.php?action=ver_DOCENTE",
      dataType:"text", 

      success:function(data){  
        $('#admin').html(data); 


      }  


    }); 
  }
  mostrar();


  function   Inhabilitar(io){
    $.ajax({   
      type: "post", 
      data:{io},
      url:"../../../ajax/rector/docentes.php?action=Inhabilitar", 
      dataType:"text", 

      success:function(data){   
        $('#sapo').html(data);
        mostrar();
      }  
    });
  }
 




</script><?php include '../enlaces/footer.php'; ?>