
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"  
        crossorigin="anonymous"> 
 <?php
 session_start();
 require_once "../../../codes/rector/chat.php";
 $chat=new chat(); 
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session1'])){
  header("location: ../../../index.php"); echo($_SESSION['Session']);
}

include '../enlaces/head.php';


?>

 
 <style>
 .container1 {  
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee; border: 1.1px solid #ccc;border-radius: 20%;   
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container1 input:checked ~ .checkmark {
  background-color: #12bbd4;border-radius: 20%;   
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container1 input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container1 .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
 
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
  opacity: 0;
}
ul.ksw-cboxtags li input[type="checkbox"]:focus + label {
 border: 2px solid #e9a1ff;
} 
  
        

        

        .a {
            border: 1px solid;
            font-size: 22px;
            padding: 4px 5px 3px 5px;
        }

        #fa {
            font-size: 25px;
        }
        
        .mod {
            margin-left: 82px;
            margin-top: -58px;
            font-size: 11px;
        }
        
        .pointer {
            cursor: pointer;
        }tr:hover{
            background-color: #e6e6e6;
            border: solid 2px #ddd;
        }

  
  #tablita::-webkit-scrollbar{
width: 6px;


    }
    #tablita::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #00c0ef;


    } body::-webkit-scrollbar{
width: 6px;


    }
    body::-webkit-scrollbar-thumb{
    border-radius: 3px;
    background-color: #3c8dbc;


    }
    </style>
 <?php  
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>


 " class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper">
      <section class="content">
        <div class="row"> 
           
          <div class="col-md-4">
            <div class="box box-danger" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div class="box-body">
                <div id="validacion"></div> 
                <label for="curso">Sedes y jornadas:</label>
                <select class="form-control select2" id="jornada_sede" name="jornada_sede" required></select>   <br>
               <label for="curso" id="fri" style="display:  ;">Cursos:</label>          
               <select class="form-control select2" id="curso" name="curso" onchange=" buscar()"  required></select> 
              


            	<br><br> 
          	</div>
        	</div>  
            
      </div>
      <div class="col-md-8">  

        <div id="_MSG_"  ></div>
        <div class="box   box- " id="ver1" style=" display: none; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          
          <div id="ver"></div>

        </div>
      </section>
    </div>
     <footer class="main-footer"  style="">
        <div class="pull-right hidden-xs">
            <b> IBUnotas</b> 1.0
        </div>
        <strong>Desarrollado por  IBUsoft. </strong> 
    </footer>
  </div>

<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

  

<script src="../../../js/jquery.loadingModal.js"></script>



<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>


<!-- Slimscroll -->
<script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../bower_components/fastclick/lib/fastclick.js"></script> 
<!-- iCheck -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>
 

 
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

  <script>
  function mostrar(){
    $('body').loadingModal({text: 'Cargando...'});

    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


  }
   function buscar(){
      mostrar();
      var id_curso=document.getElementById('curso').value;
      var id_jornada_sede=document.getElementById('jornada_sede').value;
      $.ajax({  

        type: "post",
        data:{id_jornada_sede,id_curso}, 
        url:"../../../ajax/rector/alumno/matricula_curso.php?action=buscar_aprobado",

        dataType:"text", 

        success:function(data){  

          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} );
          document.getElementById("ver1").style.display='block'; 
          $('#ver').html(data); 


        } 
      });

    }

  function todos(){
    mostrar();
    var parametros=new FormData($("#formulario-envia")[0]);
    $.ajax({

      data:parametros,
      url:"../../../ajax/rector/prematricula/prematricula.php?action=todos",

      type:"POST",
      contentType:false,
      processData:false,

      success: function(data){
        $('body').loadingModal({text: 'Showing loader animations...'});

        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 100;

        delay(time)
        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
        .then(function() { $('body').loadingModal('destroy') ;} ); 
        $('#_MSG_').html(data);
        buscar();
      }
    });
  }


  function  funciones(dolor,id){
      mostrar();

      $.ajax({  

        type: "post",
        data:{dolor,id}, 
        url:"../../../ajax/rector/prematricula/prematricula.php?action=actualizar",

        dataType:"text", 

        success:function(data){  

          $('body').loadingModal({text: 'Showing loader animations...'});

          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 100;

          delay(time)
          .then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 


        } 
      });

  }

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
      url:"../../../ajax/seles/seles.php?action=sacar_curso1", 
      dataType:"text", 

      success:function(data){  
        $('#curso').html(data); 


      }  


    }); 
  });
  
  </script>
</body>



