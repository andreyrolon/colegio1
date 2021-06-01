 <?php
 session_start();

 require_once "../../../codes/docente/chat.php";
 $chat=new chat();
 $perfil=$chat->perfil_($_SESSION['Id_Doc']);
 $mensaje=$chat->mensajes($_SESSION['Id_Doc']);
 if(!isset($_SESSION['Session'])){
    header("location: ../../../login.php"); echo($_SESSION['Session']);
}
include "../../../codes/docente/foro.php";
include "../../../codes/docente/examen.php";
$foro=new foro();
$examen=new examen();
$vaqr='conocer';
$dat=$foro->jornada_sede($_SESSION['Id_Doc'],$vaqr);


include('../enlaces/head.php');
?>
<style>
.box-tools{
    color: #bfbfbf;
    display: block; 
}

li>a:hover {
    color: #000;
    background: #f7f7f7;
}
a{
    color: #fff
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555; 
    background-color: #;
    /* border: 1px solid #73A1BD; */
    /* border-bottom-color: transparent; */
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    background-color: #4581ab;
    border: 0px  ;
    border-bottom-color: transparent;
}
</style>  <?php 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <?php 
    include('../enlaces/header.php'); ?>
    <div class=" ">
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                     <div class="modal fade" id="mymodal6" >
                        <div class="modal-dialog"   >
                            <div class="modal-content">
                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Actualizar</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div id="123examen123"></div>
                                    <input type="hidden" id='qid_nota_tecnologica_independienteq'>
                                    <input type="hidden" id="qidesq">
                                    <label for="tema">Tema del examen</label>
                                    <textarea class="form-control" id="qtemaq" name="qtemaq" onchange="
                                    var div=1;
                                    var nombre=document.getElementById('qtemaq').value;
                                    var id=document.getElementById('qid_nota_tecnologica_independienteq').value;
                                    var colum='nombre';
                                    actualizar_examnen_tecnico(div,nombre,id,colum)"></textarea><br>

                                    <label for="Tiempo">fecha para presentar el examen</label>
                                    <input type="date" class="form-control"  id="qfechaq"   onchange="
                                    var div=2;
                                    var nombre=document.getElementById('qfechaq').value;
                                    var id=document.getElementById('qidesq').value;
                                    var colum='fecha';
                                    actualizar_examnen_tecnico(div,nombre,id,colum)">
                                    <br>
                                    <label for="Tiempo">Hora en la cual puede presentar el examen</label>
                                    <input type="time" class="form-control"  id="qhoraq"  onchange="
                                    var div=2;
                                    var nombre=document.getElementById('qhoraq').value;
                                    var id=document.getElementById('qidesq').value;
                                    var colum='hora';
                                    actualizar_examnen_tecnico(div,nombre,id,colum)">
                                    <br>

                                    <label for="minutos">Tiempo de duración</label>
                                    <input type="number"  class='form-control' id="qminutosq" onchange="
                                    var div=2;
                                    var nombre=document.getElementById('qminutosq').value;
                                    var id=document.getElementById('qidesq').value;
                                    var colum='minutos';
                                    actualizar_examnen_tecnico(div,nombre,id,colum)">

                                </div>
                               <div class="modal-footer">
                                  <button type="button" data-dismiss="modal" style="width: 100%"   class="btn btn-primary"  name="eliminar_sede"
                                 id="btn"  ><strong>Cerrar</strong></button>
                              </div>
                         </div>
                      </div>
                    </div>

                     <div class="modal fade" id="rrr" >
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style=" color: #fff;  background-color: #33b5e5;">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Registrar Preguntas</h4>
                                </div>
                                <div class="modal-body" >
                                    <form method="post "name="formulario123" id="formulario123"   >
                                        <input type="hidden" name="id_nota_independiente" id="id_nota_independiente">
                                        <textarea class="form-control" id='pregunta' name='pregunta' placeholder="Registre la pregunta" required="" style="height: 80px"></textarea><br>
                                        <textarea class="form-control" id='respuesta1' name='respuesta1' placeholder="Registre la respuesta numero 1" required=""></textarea><br>
                                        <textarea class="form-control" id='respuesta2' name='respuesta2' placeholder="Registre la respuesta numero 2" required=""></textarea><br>
                                        <textarea class="form-control" id='respuesta3' name='respuesta3' placeholder="Registre la respuesta numero 3" required=""></textarea><br>
                                        <textarea class="form-control" id='respuesta4' name='respuesta4' placeholder="Registre la respuesta numero 4" required=""></textarea><br>
                                        <select class="form-control" required=""style="color:  #999898" name="respuesta_correcta" id="respuesta_correcta" onchange=" var y =document.getElementById('respuesta_correcta').value;if(y==''){ document.getElementById('respuesta_correcta').style.color='#999898';}else{ document.getElementById('respuesta_correcta').style.color='black';}">
                                            <option value="">Seleccione el numero de la respuesta correcta</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select><br>
                                        <button type="submit"  class="btn" style=" width: 100%; background-color: #fff; color: #33b5e5; border: 1.5px solid #33b5e5;    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);">Registrar</button>
                                    </form>
                                    <br><br>
                                    <div id="ver_tabla"></div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="modal fade" id="rrr2" >
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style=" color: #fff;  background-color: #33b5e5;">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Registrar Preguntas</h4>
                                </div>
                                <div class="modal-body" >
                                    <form method="post "name="2formulario123" id="2formulario123"   >
                                        <input type="hidden" name="id_nota_independiente2" id="id_nota_independiente2">
                                        <textarea class="form-control" id='2pregunta' name='2pregunta' placeholder="Registre la pregunta" required="" style="height: 80px"></textarea><br>
                                        <textarea class="form-control" id='2respuesta1' name='2respuesta1' placeholder="Registre la respuesta numero 1" required=""></textarea><br>
                                        <textarea class="form-control" id='2respuesta2' name='2respuesta2' placeholder="Registre la respuesta numero 2" required=""></textarea><br>
                                        <textarea class="form-control" id='2respuesta3' name='2respuesta3' placeholder="Registre la respuesta numero 3" required=""></textarea><br>
                                        <textarea class="form-control" id='2respuesta4' name='2respuesta4' placeholder="Registre la respuesta numero 4" required=""></textarea><br>
                                        <select class="form-control" required=""style="color:  #999898" name="2respuesta_correcta" id="2respuesta_correcta" onchange="
                                        var y =document.getElementById('2respuesta_correcta').value;
                                        if(y==''){ document.getElementById('2respuesta_correcta').style.color='#999898';}
                                        else{ document.getElementById('2respuesta_correcta').style.color='black';}">
                                            <option value="">Seleccione el numero de la respuesta correcta</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select><br>
                                        <button type="submit"  class="btn" style=" width: 100%; background-color: #fff; color: #33b5e5; border: 1.5px solid #33b5e5;    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);" >Registrar</button>
                                    </form>
                                    <br><br>
                                    <div id="ver_tabla2"></div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="mymodal5" >
                        <div class="modal-dialog"   >  
                            <div class="modal-content">
                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Actualizar</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div id="123examen"></div>
                                    <input type="hidden" id='id_nota_independiente1'>
                                    <input type="hidden" id="ides">
                                    <label for="tema">Tema del examen</label>                      
                                    <textarea class="form-control" id="tema" name="tema" onchange="
                                    var div=1;
                                    var nombre=document.getElementById('tema').value;
                                    var id=document.getElementById('id_nota_independiente1').value;
                                    var colum='nombre';
                                    actualizar_examnen(div,nombre,id,colum)"></textarea><br>

                                    <label for="Tiempo">fecha para presentar el examen</label>
                                    <input type="date" class="form-control"  id="fecha"   onchange="
                                    var div=2;
                                    var nombre=document.getElementById('fecha').value;
                                    var id=document.getElementById('ides').value;
                                    var colum='fecha';
                                    actualizar_examnen(div,nombre,id,colum)">
                                    <br>
                                    <label for="Tiempo">Hora en la cual puede presentar el examen</label>
                                    <input type="time" class="form-control"  id="hora"  onchange="
                                    var div=2;
                                    var nombre=document.getElementById('hora').value;
                                    var id=document.getElementById('ides').value;
                                    var colum='hora';
                                    actualizar_examnen(div,nombre,id,colum)">
                                    <br>

                                    <label for="minutos">Tiempo de duración</label>
                                    <input type="number"  class='form-control' id="minutos" onchange="
                                    var div=2;
                                    var nombre=document.getElementById('minutos').value;
                                    var id=document.getElementById('ides').value;
                                    var colum='minutos'; 
                                    actualizar_examnen(div,nombre,id,colum)">

                                </div>
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%"   class="btn btn-primary"  name="eliminar_sede" 
                                  id="btn"  ><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="mymodal" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> estás seguro de eliminar la evaluación   ?</p>
                                    <input type="hidden" id="eliminare1" name="">
                                    <input type="hidden" id="id_curso1" name="">
                                    <input type="hidden" id="id_grado1" name="">
                                    <input type="hidden" id="ID_JS1" name="">
                                    <input type="hidden" id="id_periodo1" name="">
                                    <input type="hidden" id="id_area1" name="">
                                    <input type="hidden" id="area1" name="">
                                </div>
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                                  id="btn"   onclick="
                                  var id=document.getElementById('eliminare1').value;
                                  var id_jornada_sede=document.getElementById('id_curso1').value;
                                  var id_c=document.getElementById('id_grado1').value;
                                  var id_g=document.getElementById('ID_JS1').value; 
                                  var periodo=document.getElementById('id_periodo1').value;
                                  var id_a=document.getElementById('id_area1').value; 
                                  var area=document.getElementById('area1').value;  del(id,id_jornada_sede,id_c,id_g,periodo,id_a,area) ">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="mymodal2" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> estás seguro de eliminar la evaluación   ?</p>
                                    <input type="hidden" id="2eliminare1" name="">
                                    <input type="hidden" id="2id_curso1" name="">
                                    <input type="hidden" id="2id_grado1" name="">
                                    <input type="hidden" id="2ID_JS1" name="">
                                    <input type="hidden" id="2id_periodo1" name="">
                                    <input type="hidden" id="2id_competencia1" name=""> 
                                </div>
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                                  id="btn"   onclick="
                                  var id_nota_tecnologica_independiente=document.getElementById('2eliminare1').value;
                                  var id_jornada_sede=document.getElementById('2id_curso1').value;
                                  var id_c=document.getElementById('2id_grado1').value;
                                  var id_g=document.getElementById('2ID_JS1').value; 
                                  var periodo=document.getElementById('id_periodo1').value;
                                  var id=document.getElementById('2id_competencia1').value; 
                                    del2(id,id_jornada_sede,id_c,id_g,periodo,id_nota_tecnologica_independiente) ">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box box-danger" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="box-body">
                                <div id="validacion"></div>
                                <h4>Crear Examen</h4> 
                                <label for="curso">Sedes y jornadas:</label>
                                <select class="form-control" id="jornada_sede1"> 
                                    <?php
                                    foreach($dat[0] as $key){
                                        ?>
                                        <option value="<?php echo($key['ID_JS']).' '.$dat[1] ?>">
                                           Sede: <?php echo($key['sede']." -  Jornada: ".$key['jornada']) ?>
                                        </option>
                                        <?php
                                    }
                                    foreach($dat[2] as $keyq){ ?>
                                                            
                                                           
                                                    <option value="<?php echo($keyq['ID_JS']) ?>">
                                                        <?php echo($keyq['sede']." ".$keyq['jornada']) ?>
                                                    </option> <?php        
                                                }
                                    ?>
                                </select>    
                                <label for="curso" id="fri" style="display: none;">Cursos:</label>          
                                <select class="form-control" id="curso1" style="display: none;">
                                </select>  

                                <label for="curso" id="fri2" style="display: none;">Asignaturas:</label>          
                                <select class=" select2 form-control" id="Asignaturas" style="display: none;" onchange="  var Asignaturas=$('#Asignaturas').val(); 
                                        var porciones = Asignaturas.split(',');
                                        if(porciones[4]==1){ 
                                          document.getElementById('taa').click();
                                      }else{document.getElementById('taa2').click();}">
                                </select>
                                <label for="temaE">Tema del examen:</label>
                                <textarea class="form-control" id="temaE" name="temaE"></textarea>
                                <label for="Tiempo">Tiempo de duracion:</label>
                                <input type=" " name="Tiempo" id="Tiempo" placeholder=" " class="form-control"><br>   
                                <label for="Tiempo">Fecha   de presentación:</label>
                                <input type="date" name="Fecha"  id="Fecha" placeholder=" " class="form-control"  ><br>
                                <label for="Tiempo">Hora de presentación:</label>
                                <input type="time" name="Hora"  id="Hora" placeholder=" " class="form-control"  ><br>
                                <label for="Tiempo">Periodo</label>
                                <input type=" " name="" value="<?php echo  $_SESSION['numero'] ?>" id=" " placeholder=" " class="form-control" disabled><br>

                                <button type="buttom" style="width: 100%" id="Buscar" class="btn btn-danger" onclick="crear()">Crear</button>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-9">  
                         
    <div class="box   box- " style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">



        <!-- Nav tabs -->
        <div class="table-responsive" >

            <ul class="nav nav-tabs" role="tablist" style=" background-color: #3c8dbc;  ">
                <li   id="i" style=" " class="active">
                  <a id="taa2"  data-toggle="tab" href="#home" style=""  onclick="document.getElementById('academico').style.display = 'block';document.getElementById('tecnico_sele').style.display = 'none';document.getElementById('tecnico').style.display = 'none';">Evaluaciones Academicas</a>
              </li>
              <li class="nav-item">
                  <a id="taa"class="nav-link" id=" " data-toggle="tab" href="#menu1" onclick="document.getElementById('tecnico').style.display = 'block';document.getElementById('tecnico_sele').style.display = 'block';document.getElementById('academico').style.display = 'none'; tecnico()" >Evaluaciones tecnicas</a>
              </li> 
          </ul>
        </div>
        <div id="sapo"></div> 
        <div id='academico'>
            <div class="box-header with-border"> <br>
                <select id="mySelect"  onchange="myFunction(1)">


                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select>
                <div class="box-tools pull-right"><br>
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" id='fname' placeholder="buscador.." onkeyup="myFunction(1)">
                        <span class="fa fa-search form-control-feedback" style=" "></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div> 
        <div id="tabla"></div>
        <div id="resultadoExamen" style=" display: none"></div>
        </div>
            <div  id="tecnico_sele"  style="display: none;" class="box-header with-border"> <br>
                <select id="mySelect2"  onchange="myFunction1(1)">


                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select>
                <div class="box-tools pull-right"><br>
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" id='fname2' placeholder="buscador.." onkeyup="myFunction1(1)">
                        <span class="fa fa-search form-control-feedback" style=" "></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
        <div id="tecnico" style=" display: none">
          
        </div>

</div>
</div>
</section>
</div>
</div>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">


<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script>
    //academica

    function actualizar_pregunta(id_nota_independiente,text,id,nom,colum){
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=actualizar_pregunta",
            data: {
                id,nom,colum 
            },
            dataType: "text",
            success: function(data) 
            {    
              document.getElementById(id+"examen"+id_nota_independiente).innerHTML = '<br> <div class="alert" role="alert" style="    color: #45a197;background-color: #f7fdfc;border-color: #a3ebe4;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Excelente!</strong> '+text+'. </div>'; 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3600); 
          }
      })
    }
    function actualizar_pregunta2(id_nota_independiente2,text2,id2,nom2,colum2){
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=actualizar_pregunta2",
            data: {
                id2,nom2,colum2 
            },
            dataType: "text",
            success: function(data) 
            {    
              document.getElementById(id2+"2examen"+id_nota_independiente2).innerHTML = '<br> <div class="alert" role="alert" style="    color: #45a197;background-color: #f7fdfc;border-color: #a3ebe4;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> Excelente!</strong> '+text2+'. </div>'; 
              window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3600); 
          }
      })
    }
    function tecnico(){
        var id_docente=<?php echo  $_SESSION['Id_Doc'] ?>;
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=examen_tecnico",
            data: {
                id_docente 
            },
            dataType: "text",
            success: function(data) { 
                $('#tecnico').html(data);
            }
        });
    }
    function  ver_preguntas(id_nota_independiente){

        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=ver_preguntas",
            data: {
                id_nota_independiente 
            },
            dataType: "text",
            success: function(data) {
                $('#ver_tabla').html(data)
            }
        });
    }    
    function  ver_preguntas2(id_nota_independiente2){

        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=ver_preguntas2",
            data: {
                id_nota_independiente2 
            },
            dataType: "text",
            success: function(data) {
                $('#ver_tabla2').html(data)
            }
        });
    }
    $(document).on("submit", "#formulario123", function(e){
        e.preventDefault(); 
        var id_nota_independiente=document.getElementById('id_nota_independiente').value;
        $.ajax({

            type: "post",
            url:"../../../ajax/docente/examen.php?action=crear_preguntas",
            data: $(this).serialize(),
            dataType:"text", 
            success: function(data)
            { 
                $('#pregunta').val("");
                $('#respuesta1').val("");
                $('#respuesta2').val("");
                $('#respuesta3').val("");
                $('#respuesta4').val("");
                ver_preguntas(id_nota_independiente)
                document.getElementById("formulario123").reset();
            }
        });
    });
    $(document).on("submit", "#2formulario123", function(e){
        e.preventDefault(); 
        var id_nota_independiente2=document.getElementById('id_nota_independiente2').value;
        $.ajax({

            type: "post",
            url:"../../../ajax/docente/examen.php?action=crear_preguntas2",
            data: $(this).serialize(),
            dataType:"text", 
            success: function(data)
            { 
                ver_preguntas2(id_nota_independiente2)
                document.getElementById("2formulario123").reset();

            }
        });
    });
    function eliminar_preguntas(id,id_nota_independiente){

        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=eliminar_preguntas",
            data: {
                id 
            },
            dataType: "text",
            success: function(data) 
            { 
                ver_preguntas(id_nota_independiente);
            }
        });

    }
    function eliminar_preguntas2(id2,id_nota_independiente2){
        debugger;
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=eliminar_preguntas2",
            data: {
                id2 
            },
            dataType: "text",
            success: function(data) 
            { 
                console.log(data);
                ver_preguntas2(id_nota_independiente2);
            }
        });

    }


    function mostrar(){
        $('body').loadingModal({text: 'Cargando...'});
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }


    function tabla(){
        var id_docente=<?php echo  $_SESSION['Id_Doc'] ?>;
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=examen_academico",
            data: {
                id_docente 
            },
            dataType: "text",
            success: function(data) { 
                $('#tabla').html(data);
            }
        });
    }
    tabla();

    function del(id,id_jornada_sede,id_c,id_g,periodo,id_a,area) {
        mostrar(); 
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/carga_academica.php?action=del",
            data: {
                id_jornada_sede,id_c,id_g,id_a,periodo,id,area,
            },
            dataType: "text",
            success: function(data) {
                $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                if (data==1) {
                    mensaje2(1,'No se puede eliminar la nota, Actualmente  esta calificada'); 
                }  else{
                 tabla();
             }  
         }
     });
    }
    function del2(id,id_jornada_sede,id_c,id_g,periodo,id_nota_tecnologica_independiente) {
        mostrar(); 
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/carga_academica.php?action=del2",
            data: {
                id,id_jornada_sede,id_c,id_g,periodo,id_nota_tecnologica_independiente
            },
            dataType: "text",
            success: function(data) {
                $('body').loadingModal({text: 'Showing loader animations...'});
                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 0;
                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} ); 
                if (data==1) {
                    mensaje2(1,'No se puede eliminar la nota, Actualmente  esta calificada'); 
                }  else{
                 tecnico();
             }  
         }
     });
    }
    function actualizar_examnen(div,nombre,id,colum){ 
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=actualizar_examnen",
            data: {
                div,nombre,id,colum,  
            },
            dataType: "text",
            success: function(data) { 
             document.getElementById("123examen").innerHTML = '<br> <div class="alert" role="alert" style="    color: #45a197;background-color: #f7fdfc;border-color: #a3ebe4;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong> Excelente!</strong>  campo actualizado. </div>'; 
             window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3900); 
             tabla();
         }
     }); 
    }

    function actualizar_examnen_tecnico(div,nombre,id,colum){ 
        $.ajax({
            type: "post",
            url: "../../../ajax/docente/examen.php?action=actualizar_examnen2",
            data: {
                div,nombre,id,colum,  
            },
            dataType: "text",
            success: function(data) { 
                 document.getElementById("123examen123").innerHTML = '<br> <div class="alert" role="alert" style="    color: #45a197;background-color: #f7fdfc;border-color: #a3ebe4;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong> Excelente!</strong>  campo actualizado. </div>'; ; 
                 window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 3900); 
                 tecnico();
            }
        }); 
    }
    function crear(){
        debugger;
        var jornada_sede1=$('#jornada_sede1').val(); 
        var curso1=$('#curso1').val(); 
        var Asignaturas=$('#Asignaturas').val(); 
        var tema=$('#temaE').val(); 
        var Tiempo=$('#Tiempo').val();
        var Fecha=$('#Fecha').val(); 
        var Hora=$('#Hora').val(); 

        if (tema==''){
            document.getElementById("temaE").focus();
            document.getElementById("validacion").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong><br> El campo Tema esta vacio. </div>'; 
            window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3000);  
            return false;
        }
        if (Tiempo==''){
            document.getElementById("Tiempo").focus();
            document.getElementById("validacion").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> <br>El campo   Tiempo de duracion esta vacio. </div>';
            window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3500);
            return false;

        }
        if(ESnumero(Tiempo)){
            document.getElementById("Tiempo").focus();
            document.getElementById("Tiempo").value='';
            document.getElementById("validacion").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> <br>El campo   Tiempo de duración solamente permite numeros entero. </div>';
            window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4300);
            return false;

        }
        if (Fecha==''){
            document.getElementById("Fecha").focus();
            document.getElementById("validacion").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> <br>Complete el campo fecha, para la presentacion del examen. </div>';
            window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3500);
            return false;

        }
        if (Hora==''){
            document.getElementById("Hora").focus();
            document.getElementById("validacion").innerHTML = ' <div class="alert" role="alert" style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;padding: 1rem 1.25rem;margin-bottom: 2rem; border-radius: 4px;  border-style: solid;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times-square"></i></span></button><i class="admin/"></i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> <br>Complete el campo hora, para la presentacion del examen. </div>';
            window.setTimeout(function  () {
                $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3500);
            return false;

        }else{
            var porciones = Asignaturas.split(',');
            if(porciones[4]==1){ 
                mostrar(); 
                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/examen.php?action=crear_examen2",
                    data: {
                        jornada_sede1, 
                        curso1, 
                        Asignaturas,
                        tema,
                        Tiempo,
                        Fecha,
                        Hora
                    },
                    dataType: "text",
                    success: function(data) { 
                        $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                        tabla();
                        document.getElementById('Hora').value='';
                        document.getElementById('Fecha').value='';
                        document.getElementById('Tiempo').value='';
                        document.getElementById('tema').value='';
                        tecnico();
                    }
                }); 
            }else{
                mostrar(); 
                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/examen.php?action=crear_examen",
                    data: {
                        jornada_sede1, 
                        curso1, 
                        Asignaturas,
                        tema,
                        Tiempo,
                        Fecha,
                        Hora
                    },
                    dataType: "text",
                    success: function(data) { 

                        $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} ); 
                        tabla();
                        document.getElementById('Hora').value='';
                        document.getElementById('Fecha').value='';
                        document.getElementById('Tiempo').value='';
                        document.getElementById('tema').value='';
                        tabla();
                    }
                }); 
            }
             
        } 
    }


    var id_js = $('#jornada_sede1').val();
    var id=<?php echo $_SESSION['Id_Doc'] ?>;
    $.ajax({
        type: "post",
        url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
        data: {
            id_js,id
        },
        dataType: "text",
        success: function(data) {
            $('#curso1').css('display', 'block'); 
            $('#fri').css('display', 'block'); 
            $('#curso1').html(data);  
            let id_grado_sede = $('#curso1').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                data: {
                    id_grado_sede,id
                },
                dataType: "text",
                success: function(data) {
                    $('#fri2').css('display', 'block');
                    $('#Asignaturas').css('display', 'block');
                    $('#Asignaturas').html(data);
                    var Asignaturas=$('#Asignaturas').val(); 
                    var porciones = Asignaturas.split(',');
                    if(porciones[4]==1){ 
                          document.getElementById("taa").click();
                    }
                }
            });
        }
    });



    function curso(){ 
        $("#curso1").change(function() {
            let id_grado_sede = $('#curso1').val();
            var id=<?php echo $_SESSION['Id_Doc'] ?>;
            $.ajax({
                type: "post",
                url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                data: {
                    id_grado_sede,id
                },
                dataType: "text",
                success: function(data) {
                    $('#fri2').css('display', 'block');
                    $('#Asignaturas').css('display', 'block');
                    $('#Asignaturas').html(data);
                    var Asignaturas=$('#Asignaturas').val(); 
                    var porciones = Asignaturas.split(',');
                    if(porciones[4]==1){ 
                        document.getElementById("taa").click();
                    }
                }
            });
        });

    }
    curso()
    $("#jornada_sede1").change(function() {
        var id_js = $('#jornada_sede1').val();
        var id=<?php echo $_SESSION['Id_Doc'] ?>;
        $.ajax({
            type: "post",
            url: "../../../ajax/seles/seles.php?action=sacar_curso_docente",
            data: {
                id_js,id
            },
            dataType: "text",
            success: function(data) {
                $('#curso1').css('display', 'block'); 
                $('#fri').css('display', 'block'); 
                $('#curso1').html(data);
                let id_grado_sede = $('#curso1').val();
                var id=<?php echo $_SESSION['Id_Doc'] ?>;
                $.ajax({
                    type: "post",
                    url: "../../../ajax/seles/seles.php?action=sacar_areas_sede_jornada_docente",
                    data: {
                        id_grado_sede,id
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#fri2').css('display', 'block');
                        $('#Asignaturas').css('display', 'block');
                        $('#Asignaturas').html(data);
                        var Asignaturas=$('#Asignaturas').val(); 
                        var porciones = Asignaturas.split(',');
                        if(porciones[4]==1){ 
                            document.getElementById("taa").click();
                        }
                    }
                });
            }
        });

    });
    for (var i=0; i < 100; i++) {   
        function myFunction(i) {

            var id_docente=<?php echo  $_SESSION['Id_Doc'] ?>;
            var dato=document.getElementById("fname").value;

            var mySelect=document.getElementById("mySelect").value;

            $.ajax({  

              type: "post",
              url: "../../../ajax/docente/examen.php?action=examen_academico",

              data:{i,id_docente,dato,mySelect},    dataType:"text", 

              success:function(data){  
                $('#tabla').html(data); 


            }
        });  
        }
        function myFunction1(i) {

            var id_docente=<?php echo  $_SESSION['Id_Doc'] ?>;
            var dato=document.getElementById("fname2").value;

            var mySelect=document.getElementById("mySelect2").value;

            $.ajax({  

              type: "post",
              url: "../../../ajax/docente/examen.php?action=examen_tecnico",

              data:{i,id_docente,dato,mySelect},    dataType:"text", 

              success:function(data){  
                $('#tecnico').html(data); 


            }
        });  
        }
    }  
    /////////////tecnico



    
    
    function resultado(resultado, curso, grado, id_js){
        debugger;
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/examen.php?action=resultado",
                data: {
                    resultado,
                    curso, 
                    grado,
                    id_js
                },
                dataType: "text",
                success: function(data) {
                    $('#tabla').css('display', 'none');
                    $('#resultadoExamen').css('display', 'block');
                    $('#resultadoExamen').html(data);
                }
            });
        }
</script>
</body>



