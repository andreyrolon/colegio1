










<?php
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }
 
include('../../../codes/rector/area.php');

$cs=new area();




$id=$_GET['id'];
if (isset($_POST['eliminar_relacion'])){

 $cs->eliminar_relacion_area_asignaturas($id,$_POST['eliminar_relacion']);

} 

if (isset($_POST['eliminar_relaciones'])){
  $eliminar_relaciones=$_POST['dm'];
  if ($eliminar_relaciones!='') {
    # code...
  
  foreach ($eliminar_relaciones as $key ) {
 

   $cs->eliminar_relacion_area_asignaturas($id,$key);

   }
 }else{
  echo "string";
 }

}

if (isset($_POST['asignar'])) {
  $t=$_POST['area'];
  foreach ($t as $key ) {
  
  $cs->registrar_carga_grado($id,$key);
  }
}






 
$todo=$cs->materias_grado($id);

$sas=$cs->consultar_areas($id);



include('../enlaces/head.php'); ?>




 
  

<body class="hold-transition skin-blue sidebar-mini">
  <input type="hidden" id="id_grado" name="" value="<?php echo $id ?>">
  <?php include('../enlaces/header.php'); ?>
  <div class="content-wrapper">
    <br><br>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
<div id="_MSG_"></div>
      
        <div id="_MSG2_"></div>
  <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
          
           <div class="modal-content" id="cotent">
            <div class="modal-header" id="header" style="">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

              </button>
              <h3 class="modal-title" id="modal-register-label">Asignar areas al grado</h3> 
            </div>

            <div class="modal-body" id="body">

              <form id="registro" method="post">
                <input type="hidden"  name="id_grado" value="<?php echo $id ?>">

     <div class="table-responsive mailbox-messages">
                <table class="table table-striped" id="tabla_de_areas_y_asignaturas_disponibles">
                  
               </table>
             </div>
                <button class="btn btn-danger" name="asignar" type="button" onclick="
        

    $('#myModal').modal('hide');
        "  >Canselar</button>
               <button class="btn btn-primary" name="asignar" type="submit" onclick="
        

    $('#myModal').modal('hide');
        "  >Asignar</button>
             </form>
           </div>
         </div>
       </div>                               
     </div>

<div style="background-color: #fff;padding: 20px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">
 <button class="btn btn-primary" type="button"  onclick="
        

    $('#myModal').modal(); 
        "  >Asignar Areas</button>
<div id="tabla_grado_por_materia">

</div>
</div>




    </div>
    <div class="col-md-3">
    </div>
  </div>

 




<?php include '../enlaces/footer.php'; ?>
<?php include '../enlaces/footer.php'; ?>


 <script type="text/javascript">
  
    
    $(document).ready(function(){  

    

      var id_grado=document.getElementById("id_grado").value;  
       

      function mostrar(){
       $.ajax({   
        type: "post",

        data:{id_grado}, 
        url:"../../../ajax/rector/grado/grado.php?action=tabla_grado_por_materia",
        dataType:"text", 

        success:function(data){  
          $('#tabla_grado_por_materia').html(data); 


        }  


      }); } 

        function tabla_de_areas_y_asignaturas_disponibles(){
       $.ajax({   
        type: "post",

        data:{id_grado}, 
        url:"../../../ajax/rector/grado/grado.php?action=tabla_de_areas_y_asignaturas_disponibles",
        dataType:"text", 

        success:function(data){  
          $('#tabla_de_areas_y_asignaturas_disponibles').html(data); 


        }  


      }); 
     } 
     tabla_de_areas_y_asignaturas_disponibles();
      $(document).on("submit", "#registro", function(e){
        e.preventDefault();
        $.ajax({
          type: "post",
           url:"../../../ajax/rector/grado/grado.php?action=registrar_relacion_grado_areas", 
          data: $(this).serialize(),
          dataType:"text", 
          success: function(data)
          { 
            $('#_MSG_').html(data); 
            mostrar();

     tabla_de_areas_y_asignaturas_disponibles();
             
          }
        });
      });



  
       mostrar();

        });




      function mostrar2(){

     var id_grado=document.getElementById("id_grado").value; 
       $.ajax({   
        type: "post",

        data:{id_grado}, 
        url:"../../../ajax/rector/grado/grado.php?action=tabla_grado_por_materia",
        dataType:"text", 

        success:function(data){  
          $('#tabla_grado_por_materia').html(data); 


        }  


      }); }

          function tabla_de_areas_y_asignaturas_disponibles(){
             var id_grado=document.getElementById("id_grado").value; 
       $.ajax({   
        type: "post",

        data:{id_grado}, 
        url:"../../../ajax/rector/grado/grado.php?action=tabla_de_areas_y_asignaturas_disponibles",
        dataType:"text", 

        success:function(data){  
          $('#tabla_de_areas_y_asignaturas_disponibles').html(data); 
 

        }  


      }); 
     } 
      function myFunction3(dsd){ 


      var id_grado=document.getElementById("id_grado").value; 
      $.ajax({

        type: "post",

        url:"../../../ajax/rector/grado/grado.php?action=eliminar_relacion_area_asignaturas",
        data: {dsd,id_grado},
        dataType:"text", 
        success: function(data)
        {   

  mostrar2();
tabla_de_areas_y_asignaturas_disponibles()

            $('#_MSG2_').html(data);  
        }
      });
    }
      </script>
</body>

</html>
