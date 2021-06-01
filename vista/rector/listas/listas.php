 
  <!-- Google Font -->

<?php include('../enlaces/head.php'); ?>
<style type="text/css">
ul.ksw-cboxtags {
    list-style: none;
    padding: 4px;
}
ul.ksw-cboxtags li{
  display: inline;
}
ul.ksw-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 0px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ksw-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ksw-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\f067";
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="checkbox"]:checked + label::before {
    content: "\f00c";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ksw-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ksw-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ksw-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ksw-cboxtags li input[type="checkbox"]:focus + label {
 border: 2px solid #e9a1ff;
} 
 
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php include('../enlaces/header.php'); ?>

 
  <!-- AQUI VA EL CONTENIDO -->
  <div class="content-wrapper">
    <br><br>
 
         
    
        <div class="col-md-11 ">
            
 

   <div style="padding-right: 350px;padding-left: 350px;"><div id="_MSG_"></div>
<div  style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff">
                   <div class="panel-heading" style="color: white;font-size: 18px;background-color: #d73925">Listas por curso</div>
                   <div class="panel-body">
                   <form  method="get" action="notas_relleno1.php">
                <div class="form-group">
                <div class="icon-addon addon-lg">

                    <select class="form-control select2" id="tipo_lista" autofocus="true"  >
                      <option value="">Tipo de lista</option>
                      <option value="1">  calificaciones  </option>
                      <option value="2">  retardos  </option>
                      <option value="3">  asistencia  </option>
                      <option value="4">  eventos  </option> 
                    </select>
                    <br><br>
                     <select class="form-control select2" id="tipo_lista" autofocus="true"  >
                      <option value="1">  Carta  </option>
                      <option value="2">  Oficio  </option> 
                    </select>
                    <br><br>
                     <select class="form-control select2" id="tipo_lista" autofocus="true"  >
                      <option value="1">  Vertical  </option>
                      <option value="2">  horizontal  </option> 
                    </select><br><br>
                 
                  
                    <select class="form-control select2" id="incluir">
                      <option value="">No incluye retirado ni desertores</option>
                      <option value="">incluye retirado ni desertores</option>
                    </select>
                    <br><br>
                    <select class="form-control select2" id="jornada_sede"></select>
                    <br><br>
                    <select class="form-control select2" id="curso"></select><br><br>
                      
                              <input type="button" class="form-control" value="Imprimir" style="color: #fff; background-color: #4DBAFF">
                </div>
            </div>
            </form>
  </div>

                   </div></div>



               </div>
               <div class="col-md-1" style="display:none ; margin-right: 20px;margin-left: 20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff" >
                <div id="aa" style="display: none"></div><div id="aa1" style="display: none"></div>
                     <div id="ID_DIV" style="display:none ;">

     
       </div>
               </div>
         
  </div>
 
        
    </div> <!-- /container -->
  
<!-- ./wrapper -->

<?php include('../enlaces/footer.php'); ?>
<script type="text/javascript">
        

  
     
     $.ajax({  

      type: "post",
      url:"../../../ajax/seles/seles.php?action=nuevo_grado",

      dataType:"text", 

      success:function(data){  
        $('#jornada_sede').html(data); 


      } 
     });   

    $("#jornada_sede").change(function(){
    var idjs=document.getElementById("jornada_sede").value; 
     $.ajax({   
        type: "post",
        data:{idjs}, 
        url:"../../../ajax/seles/seles.php?action=sacar_curso", 
        dataType:"text", 

        success:function(data){  
          $('#curso').html(data); 


        }  


      }); 
});
        $("#curso").change(function(){ 
    var id=document.getElementById("curso").value; 
    var tipo_lista=document.getElementById("tipo_lista").value;
    
    if (tipo_lista=='') {
      mensaje(2,'Seleccione un tipo de lista');return;
    }
    if (id=='') {
      mensaje(2,'Seleccione un curso');return;
    }else{ 
     $.ajax({   
        type: "post",
        data:{id,tipo_lista}, 
        url:"../../../ajax/rector/lista/lista.php?action=mostrar",
        dataType:"text", 

        success:function(data){  
          $('#ID_DIV').html(data);
          var ficha = document.getElementById('ID_DIV');
          var ventanaImpresion = window.open(' ', 'popUp');
          ventanaImpresion.document.write(ficha.innerHTML);
          ventanaImpresion.document.close();
          ventanaImpresion.print();
          ventanaImpresion.close(); 


        }  


      });
      } 
});
</script>   