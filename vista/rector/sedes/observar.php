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
  include('../../../codes/rector/sede.php'); 

  $cs=new sede();


  $u= $_GET['id'];



  $uu=' WHERE sede.ID_SEDE= '.$u;
  $sede1=$cs->mostrar($uu); 




  ?>

 <style>
 
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
 
   <style type="text/css">



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

  select { width: 100%;
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
  <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty; ?>">

  <div class="wrapper" class="form-control"> 
    <?php include('../enlaces/header.php');   ?>
    <div class="content-wrapper"> 
      <div class="row"> 
        <div class="col-md-12">  

           
          <input type="hidden" name="" id="mi" value="<?php echo $u ?>">
          <input type="hidden" name="" id="mio" value="<?php echo $u ?>">
          <br> <?php  
          foreach ($sede1 as   $value) {
            $q1=  $value['NOMBRE'];
            $q2= $value['CODIGO'];
            $q3=  $value['DIRECCION'];
            $q4 = $value['BARRIO'];
            $q5= $value['DANE'];
            $q6= $value['TELEFONO'];
            $q62= $value['ID_SEDE'];
          }?>
          <div class="col-md-12"> 
            <div class="table-responsive" style=" background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
          
              <div class="" style="padding: 14px; height: 50PX;
    background-color: #33b5e5;
    width: 100%;
    border: 3px solid #00acd6;
    border-radius: 3px;"> 

                <strong style="text-align: left;color: #fff;float: left;">DATOS DE LA SEDE</strong>
              </div><br>
              <form method="post" id="myForm">
               
                
                <div class="col-md-4"><br>
                  <lavel>Sede:</lavel>  <input type="" value="<?php echo $q1?>"  name="sede" class="form-control">
                  <br> <lavel>codigo</lavel><input type="" name="codigo" value="<?php echo $q2 ?>"  class="form-control">

                  <br><br>
                </div>

                <div class="col-md-4"><br>
                  <lavel>direccion</lavel>  <input type="" value="<?php echo $q3?>"  name="direccion" class="form-control">
                  <br> <lavel>barrio</lavel><input type="" name="barrio"  value="<?php echo $q4 ?>" class="form-control">

                  <br><br>
                </div>

                <div class="col-md-4"><br>
                  <lavel>telefono</lavel>  <input type="" value="<?php echo $q6 ?>"  name="telefono" class="form-control">
                  <br> <lavel>dane</lavel><input type="" name="dane" value="<?php echo $q5 ?>"  class="form-control">
                  <input type="hidden" name="io" id="io" value="<?php echo $u ?>"> <br>
                </div><br>
              </form> 
            </div><br>
          </div> 


          <div class="col-md-12"> 
            <div class="table-responsive" style=" background-color: #fff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
          
             <div class="btn-primary  table-responsive" style="padding: 14px"> 

                <strong>JORNADAS</strong>

              </div><br><div id="_MSG2_"></div>
              <form method="post" id="mo">
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
                                   

                                  <select id="sele" class="form-control select2" multiple="multiple" data-placeholder="Selecione Curso" style="width: 100%;background-color: #000" name="sele[]">
                                  </select>
                                  <input type="hidden" name="mio" id="mio" value="<?php echo $u ?>">
                                </div> 
                                <button type="submit" name="registro" id="btn1" class="btn"   onclick='
                                $("#nmn").modal({backdrop: false});
                                $("#nmn").modal("hide");'>Registrar</button>

                              </div>
                            </div>
                          </div>
                        </div>  
                        </form>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#nmn">nuevo</button><br>
                        <div id="jornada">
                        </div><br>
            </div> <br><br>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">

    <!-- /.tab-pane -->

  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div> 

   
   
    <script type="text/javascript">

      
      $(document).ready(function(){  

      

        var mio=document.getElementById("mio").value; 
        var mi=document.getElementById("mi").value; 
        function mostrar(){
        var sty='<?php echo $sty; ?>';
         $.ajax({   
          type: "post",

          data:{mi,sty}, 
          url:"../../../ajax/rector/sedes/sedes.php?action=jornada",
          dataType:"text", 

          success:function(data){  
            $('#jornada').html(data); 


          }  


        }); } 

         function sel(){ 
           $.ajax({   
            type: "post",

            data:{mio}, 
            url:"../../../ajax/rector/sedes/sedes.php?action=sele",
            dataType:"text", 

            success:function(data){  
              $('#sele').html(data); 
            


            }  


          });  }

           $(document).on("submit", "#mo", function(e){
            e.preventDefault();

            $.ajax({
              type: "post",
              url:"../../../ajax/rector/sedes/sedes.php?action=jornada_sede", 
              data: $(this).serialize(),
              dataType:"text", 
              success: function(data)
              { 
                $('#_MSG_').html(data); 
                mostrar();
                sel()

              }
            });

          });

       







   
     

           mostrar();
           sel()














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

        var mio=document.getElementById("mio").value;

        $.ajax({
          type: "post",

          url:"../../../ajax/rector/sedes/sedes.php?action=elim", 
          data: {dsd,mio},
          dataType:"text", 
          success: function(data)
          {  
            $('#_MSG2_').html(data);

   
           sels();


          }
        });
      }

   
    </script>

  <?php 
     include('../../../vista/rector/enlaces/footer.php');  ?>


   