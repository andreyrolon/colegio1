
<?php 
session_start();

require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
include('../enlaces/head.php'); ?>
<style>
 

/* The Modal (background) */
.z {
  visibility: hidden; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.z-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 60%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

 

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.z-header {
  padding: 2px 16px;
  background-color: #33b5e5;
  color: white;
}

.z-aaa {padding: 2px 16px;}

.z-footer {
  padding: 2px 16px;
  background-color: ;
  color: white;
 
  
}
</style>
 
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%">

  <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?>
 
    	<div class="wrapper">
	        <div class="content-wrapper"> 
	            <section class="content"> 
	                <div class="row">
	                    <div class="col-md-12"> 




 
 







<button id="myBtn">Open Modal</button>

<!-- The Modal -->
      <form name="formulario-envia" id="formulario-envia" enctype="multipart/form-data" method="post">
<div id="myModal" class="z">

  <!-- Modal content -->
  <div class="z-content">
    <div class="z-header">
      <span class="close">&times;</span>
      <h2>Modal Header</h2>
    </div>
    <div class="z-aaa">

					                  <div id="_MSG_"></div>
					                  <div class="form-group">
					                    <label >Tipo de permiso:</label>
					                    <input type="hidden" id="ad" name="ad">
					                    <input type="hidden" id="id_doci" value="<?php echo $_SESSION['Id_Doc']; ?>" name="id_doci">
					                    <select name="tipo" id="tipo" class="form-control">
					                    	<option value="">Seleccione</option>
					                    	<option value="Medico">Medico</option>
					                    	<option value="Familiar">Familiar</option>
					                    	<option value="Estudiantil">Estudiantil</option>

					                    </select>
					                  </div>
					                   <div class="form-group">
					                     	<label  >Tiempo de duracion:</label>
												<select class="form-control" style="width: 19%;" id="tiempo" name="tiempo">
					                                <option value="Horas">Hora</option>
					                                <option value="Dia">Dia</option>
					                                <option value="MES">Mes</option>
					                            </select>
											<input type="number" id="numero" name="numero" class="form-control" value=""  style="    margin-top: -34px; margin-left: 69px; width: 81%;">
					                  </div>
					                  <div class="form-group">
					                    <label >Fecha:</label>
					                    <input type="date" name="fecha" placeholder="Codigo..." class="form-last-name form-control" id="fecha"  maxlength="15"  required="">
					                  </div>
					                  <div class="form-group">
					                    <label >Motivo:</label>
					                    <textarea  id="motivo" name="motivo"  class="form-control" style="height: 250px"></textarea> 
					                  </div>
					                  <div class="form-group">
					                    <label  >Soporte:</label>
					                    <input type="file" name="soporte" class="form-last-name form-control" id="soporte" >
					                  </div>
					                  <div class="form-group">
					                    <label  >Dirigido a:</label>
					                    <div id="adminq"></div>
					                  </div>
					              

    </div>
    <div class="z-footer">
 
          <a type="button" class="btn btn-info waves-effect waves-light">cancelar
            <i class="far fa-gem ml-1"></i>
          </a>
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal" onclick="nuevv()" style="  border: 2px solid #33b5e5!important;
    background-color: transparent!important;
    color: #33b5e5!important;">Aceptar</a>
    
    </div><br><br>
  </div>

</div> 
</form>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.visibility = "visible";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.visibility = "hidden";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.visibility = "hidden";
  }
}
</script>














	                    	
					      
                            
	                    	<input type="hidden" id="sapo1" value="<?php echo $_SESSION['Id_Doc']  ?>" name="">
	                    	<div id="tabla"></div>
	                    </div>
	                </div>
	            </section>
	        </div>
	    </div>
	</div>
</body>
<?php include '../enlaces/footer.php'; ?>
<script type="text/javascript">
	function nuevv(){ 
    var tipo=document.getElementById("tipo").value;
    var tiempo=document.getElementById("tiempo").value;

    var numero=document.getElementById("numero").value;
    var soporte=document.getElementById("soporte").value;
    var fecha=document.getElementById("fecha").value;
    var motivo=document.getElementById("motivo").value; 
    if (tipo=='') { 
      mensaje(2,"Ingrese el tipo de permiso");

      document.getElementById("tipo").focus();
      return false;
    }
    
    
    if (numero=='') { 
      mensaje(2,"Ingrese la cantidad de tiempo que necesita su permiso");

      document.getElementById("numero").focus();
      return false;
    }
      if (fecha=='') { 
      mensaje(2,"Ingrese la fecha que solicita el  permiso");

      document.getElementById("fecha").focus();
      return false;
    }
    if (motivo=='') { 
     
      mensaje(2,"Ingrese el motivo del permiso");

      document.getElementById("motivo").focus();
      return false;
    }

  
   
    else{ 




    		var archivoRuta = document.getElementById('soporte').value;
		var extPermitidas = /(.docx)$/i;
		var extPermitidas1 = /(.pdf)$/i;
		var extPermitidas2 = /(.pptx)$/i;
		var extPermitidas3 = /(.jpg)$/i;
		var extPermitidas4 = /(.png)$/i;
		 
		if(extPermitidas.exec(archivoRuta)){
			
			document.getElementById('ad').value='.docx';
		}
		if(extPermitidas1.exec(archivoRuta)){
			
			document.getElementById('ad').value='.pdf';
		}
		if(extPermitidas2.exec(archivoRuta)){
			
			document.getElementById('ad').value='.pptx';
		}
		if(extPermitidas3.exec(archivoRuta)){
			
			document.getElementById('ad').value='.jpg';
		}
		if(extPermitidas4.exec(archivoRuta)){
			
			document.getElementById('ad').value='.png';
		}
        var parametros=new FormData($("#formulario-envia")[0]);
       
        $.ajax({
      
		    data:parametros,
		    url:"../../../ajax/docente/permisos.php?action=registro",
		    type:"POST",
		    contentType:false,
		    processData:false,
		    success: function(data){
		 
		    }
       });
    }
  }













	$(document).ready(function(){  
        function mostrar() {
            var id_docente =<?php echo $_SESSION['Id_Doc']; ?>;
          
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/permisos.php?action=tabla",
                data: {id_docente},
                dataType: "text",
                success: function(data) {
                    $('#tabla').html(data);
                }
            });
        }
        mostrar()

        function admin() {
            
          
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=admin",
                dataType: "text",
                success: function(data) {
                    $('#adminq').html(data);
                }
            });
        }
        admin()
    });
</script>