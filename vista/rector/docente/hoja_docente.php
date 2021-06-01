


 <?php 
 
 session_start();
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session1']);
    }

include('../enlaces/head.php'); ?>
 

 
  
<body class="hold-transition skin-blue sidebar-mini">
 
<?php include('../enlaces/header.php'); ?>
<div class="content-wrapper"><br><br>
<div class="row">
        <div class="col-md-3" style="">
<br>

  <div class="box bo"  style="margin-left: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div id="sp"></div>
    <form   method="post">
      <div class="box-header with-border" style="background-color: #d73925;color: #fff">
        <h4 class="box-title">Buscar docente</h4>
      </div>
      <div class="box-body">
        <!-- the events -->
        <div id="external-events"> 
          <div id="sapo"></div> 
         
           
          <br>   
         
        </div>
      </div></form>

    </div>
    <br> 
    <div class="box box-primary" id="oop" style="margin-left: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
<div class="box-body box-profile" id="imagen">

</div>
<!-- /.box-body -->
</div>  
  </div> 





<div class="col-md-9"> <br>
<div class="nav-tabs-custom" id="koooo" style="margin-right: 20px;margin-left: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

<!-- /.col -->
</div>

<div class="col-md-1"></div>
 </div>
 
        

  
<script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>

<?php 
include('../enlaces/footer.php'); ?>
  <script type="text/javascript">
    function u(){
         $.ajax({   
        type: "post", 
        url:"../../../ajax/seles/seles.php?action=sele_docente", 
        dataType:"text", 

        success:function(data){  
          $('#sapo').html(data); 


        }  


      }); 
    }
   
       function   Inhabilitar(io){
          $.ajax({   
      type: "post", 
      data:{io},
      url:"../../../ajax/rector/docentes.php?action=Inhabilitar", 
      dataType:"text", 

      success:function(data){   
 $("#koooo").hide();
 $("#oop").hide();
u();
      }  
    });

  }
    
    $(document).ready(function(){ 
       $("#koooo").hide();
 $("#oop").hide(); 
   $.ajax({   
        type: "post", 
        url:"../../../ajax/seles/seles.php?action=sele_docente", 
        dataType:"text", 

        success:function(data){  
          $('#sapo').html(data); 


        }  


      }); 
 

 
 
 
       });  

    </script>




</body>

</html>
 