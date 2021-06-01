 <?php 
 session_start();
require_once "../../../codes/rector/sede.php";
$sede=new sede();
 $rr=$sede->curso($_GET['id_curso'],$_GET['id_grado'],$_GET['id_jornada_sede']);
require_once "../../../codes/rector/chat.php";
$chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session1'])){
        header("location: ../../../index.php"); echo($_SESSION['Session']);
    }

include('../enlaces/head.php'); ?>



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
           
          <div id="sapo"></div>
          <div class="col-md-3 "  >
            <div class="box box-primary" id="oop" style=" width: 280px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;">  
              <div class="box-body box-profile" id="imagen" style="">
                <img   class="profile-user-img img-responsive img-circle" width="60px" src="<?php if($_GET['foto']=='' && $_GET['genero']!=1){
                  echo '../../../logos/niño.jpg';
                }if($_GET['foto']=='' && $_GET['genero']==1){
                  echo '../../../logos/niña.jpg';
                }if($_GET['foto']!=''){
                  echo $_GET['foto'];
                } ?>"  alt="User profile picture" style="    margin: 0 auto;
                width: 180px;height: 180px;
                padding: 3px;
                border: 3px solid #d2d6de;"><br>  
                <div style="text-align: center;"> 
                  <strong>Alumno:</strong>   
                  <?php echo $_GET['nombre'] ?>   <?php echo  $_GET['apellido'] ?>
                </div>  
                <?php foreach ( $rr as $key) {?>
    
                  <div style="text-align: center;">
                  <strong style="color: ">Sede:</strong> <?php echo $key['sede']; ?><br>
                  <strong style="color: ">Jornada:</strong> <?php echo $key['jornada']; ?><br>
                  <strong style="color: ">Curso:</strong> <?php echo $key['grado'].' '.$key['numero']; ?>
                  </div> <?php
                } ?> 
              </div>
            </div>
          </div>
          <div class="col-md-9 ">  <div id="_MSG_"></div><div id="sopo"></div>      <div   class=" box box-info" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff"> <a> <strong>Calificaciones Por Competencias:</strong> </a><br><br>    <div id="opo"  class="table-responsive " ></div></div>
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


  <script type="text/javascript">
 
    function ver(){   
       var id_curso = <?php echo $_GET['id_curso'] ?>;  
       var id_grado = <?php echo $_GET['id_grado'] ?>;  
       var id_jornada_sede = <?php echo $_GET['id_jornada_sede'] ?>;  
       var numero = <?php echo $_GET['numero'] ?>;  
       var id = <?php echo $_GET['id'] ?>;   


       $.ajax({  

        type: "post",
        url:"../../../ajax/rector/notas/notas.php?action=materias_periodo_por_saberes",

        data:{id,id_curso,id_jornada_sede,id_grado,numero},    dataType:"text", 

        success:function(data){  
          $('#opo').html(data); 


        }  


      });   
    }

    ver();
                    
    function  funtines(campo,area,codigo,maximo,minimo,id,nota,qw,valor){ 
       var n = nota.length; var periodo = <?php echo $_GET['numero'] ?>; 
                   if(decimaa(nota)){
            if(ESnombre1(nota)){
            mensaje(2,'Solo permite numeros deacuerdo a lo estipulado por la institucion '); 
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;
          } 
            if(decimaa1(nota)){
            mensaje(2,'Los numeros decimales  no utilizan coma sino punto'); 
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;
          }  else{ 
            mensaje(2,' El numero esta mal escrito ');
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
         
            return;}
          } if(ESnombre1(nota)){
            mensaje(2,'solo permite numeros deacuerdo a lo estipulado por la institucion ');
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;
          }if((decimaa2(nota)==true) && n>3){ if(nota>maximo){
            mensaje(2,'la nota   mas alta es  '+maximo);
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;
          }else{ 
            mensaje(2,'solo soporta un umero antes del punto ');
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;}
          }
          if(nota<minimo){
            mensaje(2,'La nota mas baja es  '+minimo);
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;
          }
          if(nota>maximo){
            mensaje(2,'la nota es mas alta esq '+maximo);
            document.getElementById(qw).focus(); 
            document.getElementById(qw).value=valor; 
            return;
          }


          else{ 
      $.ajax({  

        type: "post",
        url:"../../../ajax/rector/notas/notas.php?action=actualizar_recuperacion",

        data:{campo,id,nota,area,codigo,periodo},    dataType:"json", 

        success:function(data){   
          
          $('#recuperacion'+id).html(data[1]);  
          $('#recuperacion'+data[2]).html(data[3]);    
        }  
      });   
    }

  }

 
 </script>



 <?php include('../enlaces/footer.php'); ?>
