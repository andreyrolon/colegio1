<?php 

 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }


include('../../../codes/rector/sede.php'); 
$cs=new sede();  
include('../enlaces/head.php');

 

$id= $_GET['id'];

$idd= $_GET['id'];

 
?>  <style type="text/css">



select {
  height: 50px;
  margin: 0;
  padding: 0 20px;
  vertical-align: middle;
  background: #333;
  border: 1px solid #333;
  font-family: 'Roboto', sans-serif;
  font-size: 16px;
  font-weight: 300;
  line-height: 50px;
  color: #888;
  -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
  -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
  -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

textarea,
textarea.form-control {
  padding-top: 10px;
  padding-bottom: 10px;
  line-height: 30px;
}

select{ width: 100%;
  outline: 0;
  background: #444;
  border: 3px solid #555;
  -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
}
#im { color: #888; } 



#btn1 {
  width: 100%;
  height: 50px;
  margin: 0;
  padding: 0 20px;
  vertical-align: middle;
  background: #fd625e;
  border: 0;
  font-family: 'Roboto', sans-serif;
  font-size: 16px;
  font-weight: 300;
  line-height: 50px;
  color: #fff;
  -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
  text-shadow: none;
  -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
  -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

#btn1:hover { opacity: 0.6; color: #fff; }

#btn1:active { outline: 0; opacity: 0.6; color: #fff; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }

#btn1:focus { outline: 0; opacity: 0.6; background: #fd625e; color: #fff; }

#btn1:active:focus{ outline: 0; opacity: 0.6; background: #fd625e; color: #fff; }
#content {
  background: #3a3a3a;
  -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
  border: 0;
  text-align: left;
}

#header {
  padding: 25px 25px 15px 25px;
  background: #333;
  border: 0;
  -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; border-radius: 4px 4px 0 0;
  color: #888;
}

#header .close {
  font-size: 36px;
  color: #eee;
  font-weight: 300;
  text-shadow: none;
  opacity: 1;
}

#title {
  margin-bottom: 10px;
  line-height: 30px;
  color: #eee;
}

#body {
  padding: 25px 25px 30px 25px;
  background: #3a3a3a;
  text-align: left;
  -moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;
}



#body form textarea {
  height: 100px;
}

#body form .input-error {
  border-color: #fd625e;
}

</style>
<style>
body {
   
  background: #e2e2e2;
  border-bottom: 3px solid: red;
}
#d{
  padding: 30px;
}
#myTopnav{
  border-top-style: solid; 
  border-bottom-style: solid;
  font-size: 18px;
  padding: 4px 6px;
  color: red;
  height: 62px; 
}


#s{
  border-top-style: solid; 

}
#t-u{
  border-right-style: 10px;
}
#fd{
  padding: 10px;
  border-bottom-style: solid; 
}

#r {
  margin:10px;
  background-color: #fff;  
}
#boton{
 margin-left: 20px;
 margin-top: 5px;
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
    <!-- AQUI VA EL CONTENIDO -->
    <div class="content-wrapper"> 
      <div class="container">
        <div class="row">
          <input type="hidden" value="<?php echo $id ?>" id="id">
          <input type="hidden" id="mio" value="<?php echo $id ?>"><br> 
          <div class="col-md-11 "  id="r" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div id="cuadrohonor_widget-3" class="widget-main" style="font-size: 13px">
              <div id="_MSG2_"></div>
              <h3 style="  border-bottom: 5px solid ;padding-bottom: 1px;<?php echo $sty; ?>">
                Sede:
                <?php 

                $uu=' WHERE sede.ID_SEDE= '.$id.' GROUP by sede.CODIGO';
                $aa=$cs->mostrar($uu); 
                foreach ($aa as $as ) {

                  echo $as['NOMBRE'];
                }?>
                <br>
                Jornadas disponibles
              </h3> 

              <form method="post" id="agregar">
                <div class="modal fade" id="nmn" role="dialog">
                  <div class="modal-dialog"> 
                    <div class="modal-content" id="cotent">

                      <div class="modal-header" id="header" style="">
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h3 class="modal-title" id="modal-register-label" style="<?php echo $sty; ?>">NUEVA SEDE</h3> 
                      </div>

                      <div class="modal-body" id="body" >
                        <div id="_MSG_"></div>
                        <div class="form-group">
                          <label class="sr-only" for="form-first-name"></label>

                          <select id="sele" class="form-control select2" multiple="multiple" data-placeholder="Selecione Curso" style="width: 100%;" name="sele[]">
                          </select>
       

                          <input type="hidden" name="mio" id="mio" value="<?php echo $id  ?>">
                        </div> 
                        <button type="submit" name="registro" id="btn1" class="btn"    onclick='
                        $("#nmn").modal({backdrop: false});
                        $("#nmn").modal("hide");'>Registrar</button>

                      </div>

                    </div>
                  </div>
                </div>  
              </form>
              <button class="btn btn-danger" data-toggle="modal" data-target="#nmn">nuevo</button>
              <div id="sede_grado" class="table-responsive"></div> 
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

 

<?php 
   include('../../../vista/rector/enlaces/footer.php');  ?>


<script type="text/javascript">
  $(document).ready(function(){  

    var id=document.getElementById("id").value;
    var mio=document.getElementById("mio").value;
    var sty='<?php echo $sty  ?>';
    function mostrar(){
      $.ajax({   
        type: "post",
        data:{id,sty},  
        url:"../../../ajax/rector/grado/grado.php?action=sede_grado",
        dataType:"text", 

        success:function(data){  
          $('#sede_grado').html(data); 
        }  
      }); 
    }
   
    function sel(){ 
      $.ajax({   
        type: "post",

        data:{mio}, 
        url:"../../../ajax/rector/sedes/sedes.php?action=sele",
        dataType:"text", 

        success:function(data){  
          $('#sele').html(data);
        }
      });  
    }


    $(document).on("submit", "#agregar", function(e){
      e.preventDefault(); 

      $.ajax({
        type: "post",
        url:"../../../ajax/rector/sedes/sedes.php?action=jornada_sede",
        data: $(this).serialize(),
        dataType: 'text',
        success: function(data)
        { 

              $('#_MSG_').html(data); 
          sel();     mostrar(); 

        }
      });
    });



    sel();
    mostrar();
   });


   function sels(){ 

      var mio=document.getElementById("mio").value; 
         $.ajax({   
          type: "post",

          data:{mio}, 
          url:"../../../ajax/rector/sedes/sedes.php?action=sele",
          dataType:"text", 

          success:function(data){  
            $('#sele').html(data); 
            


          }  


        });  }
    function myFunction3(dsd){ 



      $.ajax({
        type: "post",

        url:"../../../ajax/rector/sedes/sedes.php?action=elim", 
        data: {dsd},
        dataType:"text", 
        success: function(data)
        {  
          $('#_MSG2_').html(data);

 
       


        }
      });
    }
 </script>