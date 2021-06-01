<?php 
session_start();
if ($_GET)
{
    $action = $_GET["action"];
    if (function_exists($action))
    {
        call_user_func($action);
    }
}
 
function notas_tecnica() {

 
    $copp=0; 
    include "../../codes/rector/conexion.php";
    $p=$_POST['p']; 
    $id=$_POST['id'];
    $nomd=$_POST['nomd']; 
    $id_g=$_POST['id_g'];
    $id_c=$_POST['id_c'];
    $id_jornada_sede=$_POST['id_jornada_sede']; 
    $dato='';
    if(isset($_POST['dato'])){
      $dato=' and alumnos.apellido like("%'  .$_POST['dato'].'%")';
       
    }
    $ano=date('Y');        
     $con3="SELECT informeacademico.id_informe_academico,informeacademico.fecha_desercion, informeacademico.fecha_retiro, alumnos.nombre,alumnos.genero, alumnos.apellido, alumnos.foto ,tecnologia.nota,tecnologia.id_tecnologia FROM alumnos, informeacademico ,tecnologia WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso=$id_c AND informeacademico.id_grado=$id_g AND informeacademico.id_jornada_sede=$id_jornada_sede and  informeacademico.ano=$ano and tecnologia.id_informe_academico=informeacademico.id_informe_academico   AND tecnologia.id_competrencia='$id'  $dato order by alumnos.apellido  ";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
 
    $rom='Competencia: '.$_POST['nomd'].' / Curso: '.$_POST['ro'];
    ?>
    <style>
        .cal{
            width: 100%;
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px;
            float: left;
        }
        .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec
        }
          
        .img-circle{
            width: 65px;
            height: 80px;
        }
        .img-circle:hover{
            width: 100px; 
            height: 123px;
        }

        td{ 
            border: solid 1px #d5d5d5; 
            text-align: center;
        }
        th{
             text-align: center; 
        }
        .lp{
            border:none
        } 
        .modal-title{
            text-align: left;
        }
        .inpo{
            float: left;
        }
             .btn{
                font-size: smaller;
             }
        .navin{
             margin-top: -7px;border-left: solid 1px #d5d5d5;height: 41px;padding-top: 6px;
        }
        .na{
            margin-bottom: -13px;    
            width: 100%;
            color: #000;
            border-bottom: 1px solid #d5d5d5;
            padding:10px;
            background: #fff;
        }
        .boton{
            margin-top: 19px;
             width: 34px;
                                        text-align: center;
                                        border-radius: 4px; 
                                        color: #555;
                                        border: 1px solid #ccc;
        }
         
    </style>
    <div id="sapo"></div>
    <div style="background-color: #00a7d0;padding: 10px;color: #fff"> 
        <div style="float: left;">
            <img src="https://colmabrija.edu.co/docentes/imagenes/logros.png" alt="">
        </div>
        <div style="float:  ;">
            <strong style="margin-left: 10px">Asignar Calificaciones Del   <?php echo $p ?> Periodo </div><?php echo mb_convert_case($rom, MB_CASE_TITLE, "UTF-8")   ; ?>
            </strong>
        </div>
        <div class="eliminar" id="sapo"></div>
        <div class="eliminar" id="_MSG5_" style="margin: 7px"></div>
        <br class="eliminar">       
        <button style="margin-left: 10px" type="button" class="btn btn-danger" onclick=' 
        $(".boton").css("width", "33px");
        $(".boton").css("margin-top", "0px");
        $(".boton1").css("font-size", "8px");
        $(".boton1").css("width", "33px");
        $(".btn").css("padding", "0px");
        $("td").css("padding", "0px");
        $("tr").css("font-size", "10px");$( ".eliminar" ).hide(); window.print()'   >
            <i class="fa  fa-file-pdf-o"></i>  Descargar notas
        </button> <br class="eliminar"> 

        <div style="padding: 7px;;padding-left: 10px;float: left;" class="eliminar">
            <form name="formulario-envia1" id="formulario-envia1" enctype="multipart/form-data" method="post">
                <div  class="btn btn-success btn-file">
                    <i class="fa  fa-file-excel-o"></i>  Archivo Notas Excel
                    <input type="file" name="ex" id="ex">
                </div>
                <input type="hidden" value="<?php echo $p ?>" name='p' id='p'>             
                <button type="button"   class="btn btn-primary" name="opopopop" value="enciar" onclick="var u=document.getElementById('ex').value;if(u==''){ mensaje5(2,'Seleccione el archivo excel');}else{   sasa()}">Subir</button> 
            </form> 
        </div>



        <div class="eliminar" style=";padding: 15px;margin-left: 19px;float: right;">
             <strong>Buscardo:</strong> <input type="text" id="apellido" class=" "  onchange="var apellido=document.getElementById('apellido').value;funcion(apellido)" style="
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;   height: 37px; width:200px" placeholder="Apellidos..">
        </div>

        <div style="margin:10px"> 


            <div class="modal fade" id="uuw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">   <div id="gaga"></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button><strong> 
                            <h3 class="modal-title" id="sassaq">  </h3></strong> 
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="">
                                <input type="" name="columna" class="cal" id="columna" placeholder="Ingrese el nombre de la nota" style=' '>
                                <input type="hidden"   name="tipox" id="tipox"><br>

                                <br>
                                <button  class="btn btn-primary"   type="button"   style='width: 100%'  onclick="  
                                var columna = $('#columna').val(); 
                                var tipo = $('#tipox').val(); 
                                nuevos(columna,tipo);">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="table-responsive" style="width: 100%">
                <table   class="  table "  style="width: 100%;" >
                
                        
               
                        <tr style="background: #EEE; " >
                            <th style="border: none; padding: 0px;border-bottom: solid 1px #d5d5d5 ">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>    
                                <nav class="navin"> 
                                    N°
                                </nav>       
                            </th>
                            <th class="eliminar" style="border: none;  padding: 0px;border-bottom: solid 1px #d5d5d5; ">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>
                                <nav class="navin" style=" padding-left: 44px;padding-right: 44px;">foto<nav>
                            </th>
                            <th style="border: none; padding: 0px;border-bottom: solid 1px #d5d5d5">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>
                                <nav class="navin">Estudiante<nav>
                            </th>
                            <th style="border: none; padding: 0px;border-bottom: solid 1px #d5d5d5 ">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>
                                <nav class="navin" >Estado<nav>
                            </th>
                            <?php 
                                     $titulo="SELECT tipo_calificaiones.nombre as tipo_calificaiones, tipo_calificaiones.id_tipo_calificaciones,q.nombre,q.fecha,q.hora,q.id_nota_tecnologica_independiente FROM tipo_calificaiones LEFT join(SELECT id_tipo_calificaciones, nombre,fecha,hora,id_nota_tecnologica_independiente FROM nota_tecnologica_independiente WHERE nota_tecnologica_independiente.ano=$ano and nota_tecnologica_independiente.id_jornada_sede=$id_jornada_sede AND nota_tecnologica_independiente.id_curso=$id_c and nota_tecnologica_independiente.id_grado=$id_g   and nota_tecnologica_independiente.id_competencia='".$_POST['id']."' order by id_tipo_calificaciones)as q on q.id_tipo_calificaciones=tipo_calificaiones.id_tipo_calificaciones  order by id_tipo_calificaciones";
                                    $titulo=$conexion->prepare($titulo);
                                    $titulo->execute(array());
                                    $nota=0;
                                    $id_tipo_calificaciones=0;
                                    foreach ($titulo as   $value) {  $nota++;
                                        if($value['id_tipo_calificaciones']!=$id_tipo_calificaciones){ ?> 
                                            <th style="padding: 0px;border: solid 1px #d5d5d5; ">

                                                <nav class="na" style="   
                                                <?php 
                                                $stin='';
                                                if ($value['id_nota_tecnologica_independiente']=='') {
                                                      $stin='display:none;';
                                                 } ?>
                                                 ">
                                                <a style=" cursor: pointer; text-decoration: none;  color: black;margin-right: 10px" data-toggle="modal" data-target="#uuw" onclick=" document.getElementById('tipox').value='<?php echo  $value['id_tipo_calificaciones'] ?>';
                                                $('#sassaq').html('<?php echo($value['tipo_calificaiones']) ?> '); ">
                                                    <?php echo($value['tipo_calificaiones']) ?>   
                                                </a> 
                                                </nav> <br><?php } 
                                        $id_tipo_calificaciones=$value['id_tipo_calificaciones'];

                                        ?>
                                            <button style=" <?php echo $stin ?> " class="boton1"    data-toggle="modal" data-target="#myModal<?php echo  $value['id_nota_tecnologica_independiente']; ?>" >
                                                <?php echo("N ".$nota); ?>               
                                            </button>  
                                        
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal<?php echo $value['id_nota_tecnologica_independiente'];?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary"  >
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"  >Nota 
                                                                 <?php echo($nota); ?>  
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="hhf<?php echo $value['id_nota_tecnologica_independiente'];?>"></div>

                                                            <label    class='inpo'>Nombre de la nota:</label><br>
                                                            <input type="text" value="<?php echo($value['nombre']); ?>" class="cal" id="nombrew<?php echo($value['id_nota_tecnologica_independiente']); ?>" onchange="
                                                            var nom = document.getElementById('nombrew<?php echo $value['id_nota_tecnologica_independiente']; ?>').value; 
                                                            var id= <?php echo $value['id_nota_tecnologica_independiente'];?>; 
                                                            myF(id,nom)"><br>


                                                            <label   class='inpo'>Fecha y Hora:</label><br>
                                                            <input type="text" value="<?php echo $value['fecha'].' '.$value['hora']; ?>" class="cal"  disabled> <br>
                                                            
                                                            <div style="float: left;margin-right: 10px;margin-top: 10px">
                                                                <a class="btn btn-success" href="excel2.php?id_a=<?php echo $value['id_nota_tecnologica_independiente']; ?>&&rom=<?php echo $rom; ?>&&nom=<?php echo $value['nombre']; ?>&&p=<?php echo $p; ?>" style=" ">
                                                                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar Excel
                                                                </a>
                                                            </div>
                                                            <div style="float: left;margin-right: 10px;margin-top: 10px">
                                                                <button type="submit" class="btn bg-orange " data-dismiss="modal" style=" " onclick="  
                                                                var id_nota_tecnologica_independiente=<?php echo($value['id_nota_tecnologica_independiente']); ?>;
                                                                 del1(id_nota_tecnologica_independiente) "> 
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>  Eliminar
                                                                </button>
                                                            </div>
                                                             
                                                            
                                                        </div><br><br><br>
                                                        <div class="modal-footer">
                                                            <button  style="width: 100%;  margin-top: 15px;" id="myCheck" type="button" class="btn btn-danger" data-dismiss="modal" >
                                                                Cancelar
                                                            </button>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              <?php
                                          
                                    }?>
                                   <th style="padding: 0px;border:solid 1px #d5d5d5"><nav   class="na">Total</nav></hr> 
                        </tr>
                         <?php  
                        $cont=1;
                        $cc=1;
                        foreach($con2 as $key){ $cssS=0; ?>
                            <tr class="ee" id="Form<?php echo($cont); ?>" <?php if ($key['fecha_retiro']!='0000-00-00' or $key['fecha_desercion']!='0000-00-00') {
                            echo 'style="background-color: #d5e8f4"';} ?>> 
                                <td> <br class="eliminar"><?php echo $cc++ ?></td>
                                <td class="eliminar"><img class="profile-user-img img-responsive img-circle" src="
                                    <?php 

                                    if($key['foto']=='' and $key['genero']=='1'){
                                        echo '../../../logos/niña.jpg';
                                    }if(($key['foto']=='' and $key['genero']!='1') ){
                                        echo '../../../logos/niño.jpg';
                                    }if($key['foto']!='' ){echo $key['foto'];   }  ?>" alt="User profile picture">   </td>
                                <td><br class="eliminar"><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>   
                                 </td>
                                <td><br class="eliminar"><?php  
                                    if ($key['fecha_retiro']!='0000-00-00' && $key['fecha_desercion']=='0000-00-00') {
                                        echo'<span class="btn btn-warning ">Retirado</span>';
                                     } 
                                    if ($key['fecha_desercion']!='0000-00-00' && $key['fecha_retiro']=='0000-00-00') {
                                         echo'<span class="btn btn-danger ">Desertor</span>';
                                     }if($key['fecha_desercion']=='0000-00-00' && $key['fecha_retiro']=='0000-00-00'){
                                        echo'<span class="btn btn-info">Cursando</span>';
                                    } ?> </td> 
                                 
                                     <?php 
                   $input2="SELECT tipo_calificaiones.id_tipo_calificaciones,q.id_tecnica_por_paso,q.nota from tipo_calificaiones LEFT JOIN (SELECT nota_tecnologica_independiente.id_tipo_calificaciones, tecnica_por_paso.id_tecnica_por_paso,tecnica_por_paso.nota FROM nota_tecnologica_independiente INNER JOIN tecnica_por_paso ON tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente WHERE tecnica_por_paso.id_informe_academico='".$key['id_informe_academico']."' AND     nota_tecnologica_independiente.id_competencia='".$_POST['id']."' GROUP BY nota_tecnologica_independiente.id_nota_tecnologica_independiente  )as q on q.id_tipo_calificaciones=tipo_calificaiones.id_tipo_calificaciones ORDER BY `tipo_calificaiones`.`id_tipo_calificaciones` ,`q`.`id_tecnica_por_paso` ";
                                        $input1=$conexion->prepare($input2);
                                        $input1->execute(array());
                                        $input=$input1->fetchAll(); 
                                        $uni=0;  $uni2=0;
                                        $id_tipo_calificaciones=0;
                                        foreach($input as $val){ 
                                        $cssS=$cssS+1; 
                                        $uni=$val['nota']+$uni;   
                                        $uni2=$uni2+1;

                                        if ($id_tipo_calificaciones!=$val['id_tipo_calificaciones'] ) {
                                            ?>
                                                    <td   > 
                                            <?php
                                         } ?>

                                          
                                        <input class="boton"  
                                        style="   <?php if ($val['id_tecnica_por_paso']=='') { echo "display:none;"; } ?> "   
                                        TABINDEX='<?php echo $cont;echo($cssS)  ?>'  value="<?php  echo($val['nota']);  ?>"   
                                        <?php  if ($key['fecha_retiro']=='0000-00-00'  && $key['fecha_desercion']=='0000-00-00') {?>  
                                        id="ident<?php echo($val['id_tecnica_por_paso']); ?>" style='width: 38px'   onchange='  var nota = $("#ident<?php echo($val['id_tecnica_por_paso']); ?>").val();  var id=<?php echo($val['id_tecnica_por_paso']); ?>;  var valor=<?php echo($val['nota']) ?>;  id_tecnologia= <?php echo $key['id_tecnologia'] ?>;  inserto2(id_tecnologia,id,nota,valor);        '>  <?php } else{ echo " style='width: 38px'  disabled>";  } ?>
                                           
                                            <?php
                                           
                                        $id_tipo_calificaciones=$val['id_tipo_calificaciones'];
                                    }?> 
                                <td id="definitiva<?php echo $key['id_tecnologia'] ?>">    <?php
                                    $string = "".$key['nota']."";
                                    $t=strlen($string);
                                    if ($t>2) {
                                       $hu=$string[0].$string[1].$string[2];
                                    }if ($t==1){ 
                                        $hu=$string[0];
                                    }
                                    if ($t==2){ 
                                        $hu=$string[0].$string[1];
                                    }
                                     echo $hu ?>
                                           
                                </td>
                            </tr> <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
 
    <script>

 
             function  nuevos(columna,tipo,numero) { 
            if (columna!='') {
                mostrar(); 
                var periodo =<?php echo  $p ?>; 
                var id  =<?php echo $_POST['id'] ?>;
                var id_g =<?php echo  $id_g ?>;
                var id_c =<?php echo  $id_c ?>;
                var id_jornada_sede =<?php echo  $id_jornada_sede ?>; 

                       
                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/carga_academica.php?action=form2",
                    data: { 
                        id,
                        columna,
                        periodo,
                        tipo, 
                        id_g,
                        id_c,
                        id_jornada_sede
                                                            
                    },
                    dataType: "text",
                    success: function(data) {

                            $('body').loadingModal({text: 'Showing loader animations...'});

                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} );
                        window.location.assign( window.location.href); 
                    }
                });
            }else{
                $("#gaga").html('<div  class="alert"     style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;   border-radius: 4px;  border-style: solid;">  </i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> Ingrese el nombre de la nota. </div>');
                window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 3200);
                document.getElementById('columna'+numero).focus(); 
                return
            }
        }
        function  inserto2(id_tecnologia,id,nota,valor) { 
            var maximo =<?php echo $_SESSION["maximo"] ?>;
            var minimo =<?php  echo $_SESSION["minimo"]; ?>;
            var periodo = <?php echo $_POST['p'] ?>;   
            var n = nota.length;
            if(decimaa(nota)){
                if(ESnombre1(nota)){
                    document.getElementById("ident"+id).value=valor; 
                    $('#ph').html('Solo permite numeros deacuerdo a lo estipulado por la institucion');
                    document.getElementById("iss").click(); 
                    return;
                } 
                if(decimaa1(nota)){ 
                    document.getElementById("ident"+id).value=valor; 

                    $('#ph').html('Los numeros decimales  no utilizan coma sino punto');
                    document.getElementById("iss").click(); 
                    return;
                }else{ 
                   
                 document.getElementById("ident"+id).value=valor; 

                    $('#ph').html('El numero esta mal escrito');
                    document.getElementById("iss").click();
                    return;
                } 
            }if(ESnombre1(nota)){ 
                document.getElementById("ident"+id).value=valor; 
                   $('#ph').html('Solo permite numeros deacuerdo a lo estipulado por la institucion ');
                    document.getElementById("iss").click(); 
                    return;
            }if((decimaa2(nota)==true) && n>3){
                if(nota>maximo){ 
                    document.getElementById("ident"+id).value=valor; 
                    $('#ph').html('Recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
                    document.getElementById("iss").click();
                    return;
                }else{  
                    document.getElementById("ident"+id).value=valor; 
                    $('#ph').html('Solo soporta un umero antes del punto');
                    document.getElementById("iss").click();
                    return;
                }
            }
            if(nota<minimo){ 
                document.getElementById("ident"+id).value=valor; 
                $('#ph').html('Recordamos que la nota mas baja es <?php  echo $_SESSION["minimo"]; ?>');
                    document.getElementById("iss").click();
                return;
            }
            if(nota>maximo){ 
                document.getElementById("ident"+id).value=valor; 
                $('#ph').html('Recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
                    document.getElementById("iss").click();
                return;
            }else{ 
                mostrar(); 
                $.ajax({  

                    type: "post",
                    url:"../../../ajax/rector/notas/notas.php?action=actualizar_nota2",
                    data:{id,nota,periodo,id_tecnologia},
                    dataType:"text", 
                    success:function(data){  
        
                            $('#sapo').html(data); 
                        $.ajax({  
                        type: "post",
                        url:"../../../ajax/rector/notas/notas.php?action=definitiva2",
                        data:{id_tecnologia},    dataType:"text",
                        success:function(data){  
                            $('body').loadingModal({text: 'Showing loader animations...'});

                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;
                            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} );
                            var rto='<br>'+data;
                            $('#definitiva'+id_tecnologia).html(rto); 

                        }  
                        });
                    }  
                });   
            }
        }
 

        function sasa() {
            mostrar();
            var archivoRuta = document.getElementById('ex').value;
            var vacio=''; 
            var excel = /(.xlsx)$/i;  
            var parametros=new FormData($("#formulario-envia1")[0]);
            $.ajax({
                data:parametros,
                url:"../../../ajax/rector/notas/notas.php?action=excel2",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){ 
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  
                    window.location.assign( window.location.href); 
                }
            });
        }
        function myF(id,nom) {
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/carga_academica.php?action=RenameName2",
                data: {
                    id,
                    nom
                },
                dataType: "text",
                success: function(data) { 
                   $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    
                   $("#hhf"+id).html('<div  class="alert"     style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    text-align:center;   border-radius: 4px;  border-style: solid;">    <strong>informacion!</strong> <div style="font-weight:normal;" ><i class="fa fa-check fs-xl"></i>  Registro Actualizado.</div>   </div>');
                    window.setTimeout(function  () {
                        $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 7200);  
                }
            });
        }
    </script> <?php
    $input=null;
    $input1=null;
    $tipo_calificaiones2=null;
    $tipo_calificaiones=null;
    $con1=null;
    $count=null;
    $con2=null;
    $titulo=null;
}
function form()
{  
   
    $copp=0; 
    $rdr='';
    $rdr1='';
    include "../../codes/rector/conexion.php";
    
    
                  
    $p=$_POST['p']; 
    $nombr_ma=$_POST['nombre'];
    
    $id_g=$_POST['id_g'];
    $id_area=$_POST['nombre'];
    $area=$_POST['area'];
    $id_c=$_POST['id_c'];
    $id_jornada_sede=$_POST['id_jornada_sede']; 
    $ano=date('Y');   
    $apellido='';
    if(isset($_POST['apellido'])){
      $apellido=' and alumnos.apellido like("%'  .$_POST['apellido'].'%")';
       
    }     
 
       $con3="  SELECT informeacademico.id_informe_academico,informeacademico.fecha_desercion, informeacademico.fecha_retiro, alumnos.nombre,alumnos.genero, alumnos.apellido, alumnos.foto ,materia_por_periodo.nota,materia_por_periodo.id_materia_por_periodo FROM alumnos, informeacademico ,materia_por_periodo WHERE informeacademico.ano=$ano and informeacademico.id_curso=$id_c AND informeacademico.id_grado=$id_g AND informeacademico.id_jornada_sede=$id_jornada_sede and    alumnos.id_alumnos=informeacademico.id_alumno and  materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico  AND materia_por_periodo.periodo=$p AND materia_por_periodo.id_area='$nombr_ma' $apellido  order by alumnos.apellido   ";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
   

    $rom='Area: '.$_POST['nomd'].' / Curso: '.$_POST['ro'];

 
    
    ?>
  <style>
        .cal{
            width: 100%;
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px;
            float: left;
        }
        .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec
        }
          
        .img-circle{
            width: 65px;
            height: 80px;
        }
        .img-circle:hover{
            width: 100px; 
            height: 123px;
        }

        td{ 
            border: solid 1px #d5d5d5; 
            text-align: center;
        }
        th{
             text-align: center; 
        }
        .lp{
            border:none
        } 
        .modal-title{
            text-align: left;
        }
        .inpo{
            float: left;
        }
             .btn{
                font-size: smaller;
             }
        .navin{
             margin-top: -7px;border-left: solid 1px #d5d5d5;height: 41px;padding-top: 6px;
        }
        .na{
            margin-bottom: -13px;    
            width: 100% ;
            color: #000;
            border-bottom: 1px solid #d5d5d5;
            padding:10px;
            background: #fff;
        }
        
        .boton1{ 
                width: 40px;
    font-size: 11px;
    font-weight: bold;
        }
        .boton{
            margin-top: 19px;
             width: 34px;
                                        text-align: center;
                                        border-radius: 4px; 
                                        color: #555;
                                        border: 1px solid #ccc;
        }
         
    </style>
    <div style="background-color: #00a7d0;padding: 10px;color: #fff"> 
                                <div style="float: left;"><img src="https://colmabrija.edu.co/docentes/imagenes/logros.png" alt=""></div>
                                <div style="float:  ;"><strong style="margin-left: 10px">Asignar Calificaciones Del   <?php echo $p ?> Periodo </div><?php echo mb_convert_case($rom, MB_CASE_TITLE, "UTF-8")   ; ?></strong></div>
       
    <div id="sapo"></div>
        <div id="_MSG_" style="padding: 5px"></div>  <br>
        <button style="margin-left: 10px" type="button" value="Imprime esta pagina" class="btn btn-danger" onclick=" window.print()" >
            <i class="fa  fa-file-pdf-o"></i>  Descargar notas
        </button> <br>

        <div style="padding: 7px;;padding-left: 10px;float: left;">
            <form name="formulario-envia1" id="formulario-envia1" enctype="multipart/form-data" method="post">
                <div  class="btn btn-success btn-file">
                    <i class="fa  fa-file-excel-o"></i>  archivo notas excel
                    <input type="file" name="ex" id="ex">
                </div>
                <input type="hidden" value="<?php echo $p ?>" name='p' id='p'>             
                <button type="button" class="btn btn-primary" name="opopopop" value="enciar" onclick="var u=document.getElementById('ex').value;if(u==''){ mensaje(2,'Seleccione el archivo excel');}else{   sasa1()}">Subir</button> 
            </form> 
        </div>
        <div style=";padding: 15px;margin-left: 19px;float: right;">
             <strong>Buscardo:</strong> <input type="text" id="apellido"  onchange="var apellido=document.getElementById('apellido').value;funcion(apellido)" style=" 
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px;" placeholder="Apellidos..">
        </div>


<div  style="padding: 10px">




    <!--- modal de crear nota --->
    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <div id="gaga"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3   class="modal-title" id="sassaq"></h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id=""> 
                        <input type="" name="columna" class="cal" id="columna" placeholder="Ingrese nombre de la nota" style=' '>
                        <input type="hidden" value=" " name="tipox" id="tipox"><br>
                       <br>
                       <br>
                        <button  class="btn btn-primary"   type="button" id="b<?php echo $key['nombre'] ?>" style='width: 100%' onclick="
                        var columna = $('#columna').val(); 
                        var tipo = $('#tipox').val(); 
                        nuevo(columna,tipo)">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--- modal de crear nota --->


    <div class="table-responsive" style="width: 100%; pad ">

        <table   class="  table "  style="width: 100%;" >
                 
                <tr style="background: #EEE; " >
                            <th style="border: none; padding: 0px;border-bottom: solid 1px #d5d5d5 ">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>    
                                <nav class="navin"> 
                                    N°
                                </nav>       
                            </th>
                            <th class="eliminar" style="border: none;padding: 0px; border-bottom: solid 1px #d5d5d5; ">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>
                                <nav class="navin" style=" padding-left: 44px;padding-right: 44px;">foto<nav>
                            </th>
                            <th style="border: none; padding: 0px;border-bottom: solid 1px #d5d5d5">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>
                                <nav class="navin">Estudiante<nav>
                            </th>
                            <th style="border: none; padding: 0px;border-bottom: solid 1px #d5d5d5 ">
                                <nav class="na" style="color: #fff;"><a style="cursor: pointer; text-decoration: none;  color: black;margin-right: 10px "></a></nav><br>
                                <nav class="navin" >Estado<nav>
                            </th>
                            <?php 


                            $titulo="SELECT tipo_calificaiones.porceentajes, tipo_calificaiones.nombre as tipo_calificaiones, tipo_calificaiones.id_tipo_calificaciones,q.nombre,q.fecha,q.hora,q.id_nota_independiente FROM tipo_calificaiones LEFT join(SELECT nota_independiente.id_tipo_calificacion, nota_independiente.nombre,nota_independiente.fecha,nota_independiente.hora,nota_independiente.id_nota_independiente FROM nota_independiente WHERE  nota_independiente.ano='$ano' and nota_independiente.id_jornada_sede='$id_jornada_sede' AND nota_independiente.id_curso='$id_c' and  nota_independiente.id_grado='$id_g' AND nota_independiente.id_periodo='$p' AND nota_independiente.id_area='$id_area' )as q on q.id_tipo_calificacion=tipo_calificaiones.id_tipo_calificaciones order by id_tipo_calificaciones";
                                    $titulo=$conexion->prepare($titulo);
                                    $titulo->execute(array());
                                    $nota=0;
                                    $id_tipo_calificaciones=0;
                                    foreach ($titulo as   $value) {  $nota++;
                                        if($value['id_tipo_calificaciones']!=$id_tipo_calificaciones){ ?> 
                                            <th style="padding: 0px;border: solid 1px #d5d5d5; ">

                                                <nav class="na" style="   
                                                <?php 
                                                $stin='';
                                                if ($value['id_nota_independiente']=='') {
                                                      $stin='display:none;';
                                                } ?>
                                                 "> 
                                                <a style=" <?php  $stin=''; if ($value['id_nota_independiente']=='') { $stin='display:none;'; } ?>;display: block; cursor: pointer;width: 100%; text-decoration: none;  color: black;margin-right: 10px" data-toggle="modal" data-target="#nuevo" onclick=" document.getElementById('tipox').value='<?php echo  $value['id_tipo_calificaciones'] ?>';
                                                $('#sassaq').html('<?php echo($value['tipo_calificaiones']) ?> '); ">
                                                    <?php echo($value['tipo_calificaiones'].'  '.$value['porceentajes'].'%') ?>   
                                                </a> 
                                                </nav> <br><?php } 
                                        $id_tipo_calificaciones=$value['id_tipo_calificaciones'];

                                        ?>
                                            <button style=" <?php echo $stin ?> " class="boton1"    data-toggle="modal" data-target="#myModal<?php echo  $value['id_nota_independiente']; ?>" >
                                                <?php echo("N ".$nota); ?>               
                                            </button>  
                                        
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal<?php echo $value['id_nota_independiente'];?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary"  >
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"  >Nota 
                                                                 <?php echo($nota); ?>  
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="hhf<?php echo $value['id_nota_independiente'];?>"></div>

                                                            <label    class='inpo'>Nombre de la nota:</label><br>
                                                            <input type="text" value="<?php echo($value['nombre']); ?>" class="cal" id="nombrew<?php echo($value['id_nota_independiente']); ?>" onchange="
                                                            var nom = document.getElementById('nombrew<?php echo $value['id_nota_independiente']; ?>').value; 
                                                            var id= <?php echo $value['id_nota_independiente'];?>; 
                                                            myF(id,nom)"><br>


                                                            <label   class='inpo'>Fecha y Hora:</label><br>
                                                            <input type="text" value="<?php echo $value['fecha'].' '.$value['hora']; ?>" class="cal"  disabled> <br>
                                                            
                                                            <div style="float: left;margin-right: 10px;margin-top: 10px">
                                                                <a class="btn btn-success" href="excel.php?id_a=<?php echo $value['id_nota_independiente']; ?>&&area=<?php echo $area; ?>&&rom=<?php echo $rom; ?>&&p=<?php echo $p; ?>&&nom=<?php echo($value['nombre']); ?> " style=" "> 
                                                                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar Excel
                                                                </a>
                                                            </div>
                                                            <div style="float: left;margin-right: 10px;margin-top: 10px">
                                                                <button type="submit" class="btn bg-orange " data-dismiss="modal" style=" " onclick="  
                                                                var id_nota_independiente=<?php echo($value['id_nota_independiente']); ?>;
                                                                 del(id_nota_independiente) "> 
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>  Eliminar
                                                                </button>
                                                            </div>
                                                             
                                                            
                                                        </div><br><br><br>
                                                        <div class="modal-footer">
                                                            <button  style="width: 100%;  margin-top: 15px;" id="myCheck" type="button" class="btn btn-danger" data-dismiss="modal" >
                                                                Cancelar
                                                            </button>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              <?php
                                          
                                    }?>
                                   <th style="padding: 0px;border:solid 1px #d5d5d5;">
                                    <nav class="na" >
                                   <a style="  display: block;  width: 100%; text-decoration: none;  color: black;margin-right: 10px"  >
                                                    Total 100%  
                                                </a>  </nav><br>
                                    <nav class="navin" style="" >N F<nav>
                                   </th>
                        </tr>

                  <?php                              
                $cont=1;                          
                $contq=1;
                foreach($con2 as $key){ $cssS=0; 

                    if ($key['fecha_retiro']!='0000-00-00' && $key['fecha_desercion']=='0000-00-00') {
                        $boton='<span class="btn btn-warning ">Retirado</span>';
                        $color='background-color: #a4d4e059;';
                        $disabled='disabled';
                    } 
                    if ($key['fecha_desercion']!='0000-00-00' && $key['fecha_retiro']=='0000-00-00') {
                        $boton='<span class="btn btn-danger ">Desertor</span>';
                        $color='background-color: #a4d4e059;';
                        $disabled='disabled';
                    }if($key['fecha_desercion']=='0000-00-00' && $key['fecha_retiro']=='0000-00-00'){ $boton='';
                        $boton='<span class="btn btn-info">Cursando</span>';
                        $disabled='';
                        $color='';
                    }
                                     ?>
                    <tr class="ee" id="Form<?php echo($cont); ?>" style='<?php echo $color  ?> '> 
                        <td><br><?php echo  $contq++ ?></td>
                        <td>
                            <img style=" " class="profile-user-img img-responsive img-circle" src="<?php if(($key['foto']=='' && $key['genero']=='0') or ($key['foto']=='' && $key['genero']=='')){echo '../../../logos/niño.jpg';}  if($key['foto']=='' && $key['genero']=='1'){echo '../../../logos/niña.jpg';}if($key['foto']!=''){ echo($key['foto']); } ?>" alt="User profile picture"> 
                        </td>
                        <td><br><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>    
                        </td>
                        <td><br><?php echo $boton ?></td>  
                         <?php 

 


                    $input2=" SELECT tipo_calificaiones.id_tipo_calificaciones,q.id_materia_por_paso,q.nota,q.identificador from tipo_calificaiones LEFT JOIN ( SELECT nota_independiente.id_tipo_calificacion, materia_por_paso.id_materia_por_paso,materia_por_paso.nota,materia_por_paso.identificador FROM nota_independiente INNER JOIN materia_por_paso ON materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente WHERE materia_por_paso.id_materia_por_periodo=".$key['id_materia_por_periodo']."  GROUP BY nota_independiente.id_nota_independiente )as q on q.id_tipo_calificacion=tipo_calificaiones.id_tipo_calificaciones ORDER BY `tipo_calificaiones`.`id_tipo_calificaciones` ,`q`.`id_materia_por_paso`  ";
                                        $input1=$conexion->prepare($input2);
                                        $input1->execute(array());
                                        $input=$input1->fetchAll(); 
                                        $uni=0;  $uni2=0;
                                        $id_tipo_calificaciones=0;
                                        foreach($input as $val){ 
                                        $cssS=$cssS+1; 
                                        $uni=$val['nota']+$uni;   
                                        $uni2=$uni2+1;

                                        if ($id_tipo_calificaciones!=$val['id_tipo_calificaciones'] ) {
                                            ?>
                                                    <td   > 
                                            <?php
                                         }  
                                         $id_materia_por_paso='';
                                        if ($val['id_materia_por_paso']=='') {
                                            $id_materia_por_paso='display: none;';
                                        }

                                        if($val['identificador']==0){ ?>
                                            <input  <?php echo $disabled ?>  class="boton"   TABINDEX='<?php echo $cont;echo($cssS)  ?>'  
                                            name="ser<?php echo($cont.$cssS); ?>"    id="ident<?php echo($val['id_materia_por_paso']); ?>" value="<?php  echo($val['nota']);  ?>" style='  
                                            <?php echo $id_materia_por_paso ?>   ' onchange=" 
                                            var nota = $('#ident<?php echo($val['id_materia_por_paso']); ?>').val();
                                            var id_informe=<?php echo($key['id_informe_academico']) ?>;
                                            var id=<?php echo($val['id_materia_por_paso']); ?>;
                                            var valor=<?php echo($val['nota']) ?>;
                                            var id_materia_por_periodo= <?php echo $key['id_materia_por_periodo'] ?>;
                                            inserto(id_materia_por_periodo,id_informe,id,nota,valor);">  <?php   
                                        }else{
                                            ?>
                                            <input  disabled   class="boton"       value="<?php  echo($val['nota']);  ?>" style=' 
                                            <?php echo $id_materia_por_paso ?>    '      > 
                                            <?php
                                        } 
                                        
                                           
                                             
                                           
                                        $id_tipo_calificaciones=$val['id_tipo_calificaciones'];
                                    }?> 
                        <td      id="definitiva<?php echo $key['id_materia_por_periodo'] ?>">   <?php
                                    $string = "".$key['nota']."";
                                    $t=strlen($string);
                                    if ($t>2) {
                                       $hu=$string[0].$string[1].$string[2];
                                    }if ($t==1){ 
                                        $hu=$string[0];
                                    }
                                    if ($t==2){ 
                                        $hu=$string[0].$string[1];
                                    }
                                      ?> 
                                      <div style="padding: 20px">
                                          <?php echo $hu ?>
                                      </div>
                        </td>
                    </tr> <?php
                } ?> 
        </table>
    </div>
    <script>
        function nuevo(columna,tipo) {
            if(columna!=''){ 
                mostrar(); 
                var periodo = <?php echo  $p ?>;
                var id_a = <?php echo $_POST['nombre'] ?>;
                var id_g = <?php echo  $id_g ?>;
                var id_c =<?php echo  $id_c ?>;
                var id_jornada_sede =<?php echo  $id_jornada_sede ?>;
                var area=<?php echo $_POST['area'] ?>;


                $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/carga_academica.php?action=form",
                    data: {
                        area,
                        columna,
                        periodo,
                        tipo,
                        id_a,
                        id_g,
                        id_c,
                        id_jornada_sede

                    },
                    dataType: "text",
                    success: function(data) {

                        $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                        window.location.assign( window.location.href); 

                    }
                });
            }else{
                $("#gaga").html('<div  class="alert"     style="color: #c18300;background-color: #fff8e9;border-color:   #ffcd65;    position: relative;   border-radius: 4px;  border-style: solid;">  </i><strong><i class="fa fa-exclamation-triangle"></i> alerta!</strong> Ingrese el nombre de la nota. </div>');
                window.setTimeout(function  () {
                    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 7200);
                document.getElementById('columna'+numero).focus(); 
                return
            }
        }
        function sasa1() {
            mostrar(); 
            var archivoRuta = document.getElementById('ex').value;
            var vacio=''; 
            var excel = /(.xlsx)$/i;   

            var parametros=new FormData($("#formulario-envia1")[0]);
            $.ajax({

                data:parametros,
                url:"../../../ajax/rector/notas/notas.php?action=excel",

                type:"POST",
                contentType:false,
                processData:false,

                success: function(data){
                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                    window.location.assign( window.location.href); 
                }
            });

        }
        function  inserto(id_materia_por_periodo,id_informe,id,nota,valor) { 
            
            var area=<?php echo $_POST['area'] ?>;
            var codigo= <?php echo $_POST['codigo'] ?>;
            var maximo =<?php echo $_SESSION["maximo"] ?>;
            var minimo =<?php  echo $_SESSION["minimo"]; ?>;
            var periodo = <?php echo $_POST['p'] ?>;   
            var n = nota.length;
            if(decimaa(nota)){
                if(ESnombre1(nota)){
                    document.getElementById('ident'+id).value=valor; 
                    $('#ph').html('Solo permite numeros deacuerdo a lo estipulado por la institucion');
                    document.getElementById("iss").click(); 
                    return;
                } 
                if(decimaa1(nota)){
                    document.getElementById('ident'+id).value=valor; 
                    $('#ph').html('Los numeros decimales  no utilizan coma sino punto');
                    document.getElementById("iss").click(); 
                    return;
                }else{  
                    document.getElementById('ident'+id).value=valor; 
                    $('#ph').html('El numero esta mal escrito');
                    document.getElementById("iss").click();  
                    document.getElementById('ident'+id).focus(); 
                    return;
                }
            }if(ESnombre1(nota)){  
                document.getElementById('ident'+id).value=valor;
                $('#ph').html('Solo permite numeros deacuerdo a lo estipulado por la institucion');
                document.getElementById("iss").click();  
                return;
            }if((decimaa2(nota)==true) && n>3){ 
                if(nota>maximo){  
                    document.getElementById('ident'+id).value=valor;
                    $('#ph').html('Recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?> ');
                    document.getElementById("iss").click();  
                    return;
                }else{  
                    document.getElementById('ident'+id).value=valor;
                    $('#ph').html('Solo soporta un numero antes del punto');
                    document.getElementById("iss").click();  
                    return;
                }
            }
            if(nota<minimo){  
                document.getElementById('ident'+id).value=valor;
                $('#ph').html('Recordamos que la nota mas baja es <?php  echo $_SESSION["minimo"]; ?> ');
                document.getElementById("iss").click();  
                return;
            }
            if(nota>maximo){  
                document.getElementById('ident'+id).value=valor; 
                $('#ph').html('Recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
                document.getElementById("iss").click(); 
                return;
            }else{ 
                mostrar(); 
                $.ajax({  

                    type: "post",
                    url:"../../../ajax/rector/notas/notas.php?action=actualizar_nota",
                    data:{area,id_informe,codigo,id,nota,periodo,id_materia_por_periodo},
                    dataType:"text", 
                    success:function(data){  
      
                        $.ajax({  
                            type: "post",
                            url:"../../../ajax/rector/notas/notas.php?action=definitiva",
                            data:{id_materia_por_periodo},    dataType:"text",
                            success:function(data){  
                                $('body').loadingModal({text: 'Showing loader animations...'});
                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;

                                delay(time)
                                .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} );
                                $('#definitiva'+id_materia_por_periodo).html(data); 

                            }  
                        });
                    }  
                });   
            }
        }
     

     

        function myF(id,nom) {
            mostrar();
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/carga_academica.php?action=RenameName",
                data: {
                    id,
                    nom
                },
                dataType: "text",
                success: function(data) { 
                    $('body').loadingModal({text: 'Showing loader animations...'});
                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} ); 
                    
                   $("#hhf"+id).html('<div  class="alert"     style="color: #45a197;background-color: #edfbf9;border-color:   #a3ebe4;    position: relative;   border-radius: 4px;  border-style: solid;">    <strong>informacion!</strong> <div style="font-weight:normal;" ><i class="fa fa-check fs-xl"></i>  Registro Actualizado.</div>   </div>');
                    window.setTimeout(function  () {
                        $(".alert").fadeTo(1000, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 7200); 
                }
            });
        }

        function del(id) {
            mostrar();
            var  id_c=<?php echo $id_c; ?>;
            var  id_g=<?php echo $id_g; ?>;
            var  periodo=<?php echo $_POST['p']; ?>;

            var  id_a=<?php echo $_POST['nombre']; ?>;
            var  area=<?php echo $_POST['area']; ?>;
            var  id_jornada_sede=<?php echo $id_jornada_sede; ?>;
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
                        window.location.assign( window.location.href); 
                    }  
                }
            });
        }
    </script> 
     
    <?php
    $input=null;
    $input1=null;
    $tipo_calificaiones2=null;
    $tipo_calificaiones=null;
    $con1=null;
    $count=null;
    $con2=null;
    $titulo=null;
}



function form1(){
    
       $copp=0; 
    include "../../codes/rector/conexion.php";
    $p=$_POST['p']; 
    $nombr_ma=$_POST['nombre'];
    $id_a=$_POST['id_a'];
    $id_g=$_POST['id_g'];
    $id_c=$_POST['id_c'];
    $id_jornada_sede=$_POST['id_jornada_sede']; 
    $ano=date('Y');
     $apellido='';
    if(isset($_POST['apellido'])){
      $apellido=' and alumnos.apellido like("%'  .$_POST['apellido'].'%")';
       
    }
     $con3=" SELECT materia_por_periodo.recuperacion,materia_por_periodo.sustentacion,materia_por_periodo.trabajo,informeacademico.id_informe_academico, alumnos.nombre,alumnos.genero, alumnos.apellido, alumnos.foto ,materia_por_periodo.nota,materia_por_periodo.id_materia_por_periodo,informeacademico.fecha_retiro,informeacademico.fecha_desercion FROM alumnos, informeacademico ,materia_por_periodo WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso=$id_c AND informeacademico.id_grado=$id_g AND  informeacademico.id_jornada_sede=$id_jornada_sede and  informeacademico.ano=$ano and  informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico AND materia_por_periodo.periodo=$p AND  materia_por_periodo.id_area='$nombr_ma' AND materia_por_periodo.codigo='".$_POST['codigo']."'  AND materia_por_periodo.area='".$_POST['area']."' and materia_por_periodo.nota<'".$_SESSION['desde']."'  $apellido order by alumnos.apellido";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
    ?>
    <style>
        td,th{ 
            border: solid 1px #d5d5d5; 
            text-align: center;
        }
        .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec
        }
        .img-circle{
            width: 65px;
            height: 80px;
        }
        .img-circle:hover{
            width: 115px; 
            height: 145px;
        }
        .btn{
            font-size: smaller;
        }
        .ss{
            width: 70px;
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px; 
        }
        #az{
            color: #000;cursor: pointer;
        }
        #az:hover{
            color: #3c8dbc;
        }
    </style>
        <div style=" margin-left: 10px;margin-top: 5px ;width: 100%"> <strong>
            <?php  $rom='Area: '.$_POST['nombr_ma'].' / Curso: '.$_POST['ro'];
                    echo mb_convert_case($rom, MB_CASE_TITLE, "UTF-8")   ; ?> / <a id="az" href='excel_recuperacion_academico.php?id_g=<?php echo $id_g; ?>&&rom=<?php echo $rom; ?>&&p=<?php echo $p; ?>&&id_c=<?php echo($id_c); ?>&&id_a=<?php echo($id_a); ?>&&id_jornada_sede=<?php echo($id_jornada_sede); ?> '> Descargar excel de nivelación</a></strong>
                    <br><br>
            <button style="margin-left: 10px" type="button" value="Imprime esta pagina" class="btn btn-danger" onclick=" window.print()" >
                <i class="fa  fa-file-pdf-o"></i>  Descargar notas
            </button> <br>

            <div style="padding: 17px;;padding-left: 10px;float: left;">
                <form name="formulario-envia1" id="formulario-envia1" enctype="multipart/form-data" method="post">
                    <div  class="btn btn-success btn-file">
                        <i class="fa  fa-file-excel-o"></i>  archivo notas excel
                        <input type="file" name="ex" id="ex">
                    </div>
                    <input type="hidden" value="<?php echo $p ?>" name='p' id='p'>             
                    <button type="button" class="btn btn-primary" name="opopopop" value="enciar" onclick="var u=document.getElementById('ex').value;if(u==''){ mensaje(2,'Seleccione el archivo excel');}else{   sasa1()}">Subir</button> 
                </form> 
            </div>
            <div style=";padding: 15px;margin-left: 19px;float: right;">
             <strong>Buscardo:</strong> <input type="text" id="apellido"  onchange="var apellido=document.getElementById('apellido').value;funcion(apellido)" style=" 
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px;" placeholder="Apellidos..">
            </div><br>
        </div>
        <div style="padding: 5px; margin-top:20px">
<br>    
            <div class="table-responsive" >
        <div id="_MSG_"></div> 
        <table class="table  "  >
            <tr style="background: #EEE;border: solid 2px #d5d5d5; ">
                <th>Id</th>
                <th style="padding-right: 44px;padding-left: 44px">Foto</th>
                <th>Estudiantes</th>
                <th>Estado</th>
                <th>Definitiva</th>
                <th>Trabajo</th>
                <th>Sutentacion</th>
                <th>Recuperacion</th>
            </tr>
            <?php 
            $cont=0;    
            foreach ($con2 as $key ) {
                $cont++;
                       $string = "".$key['recuperacion']."";
                $t=strlen($string);
                if ($t>2) {
                $hu=$string[0].$string[1].$string[2];
                }if ($t==1){ 
                    $hu=$string[0];
                }
                if ($t==2){ 
                    $hu=$string[0].$string[1];
                }


                       $string1 = "".$key['nota']."";
                $t1=strlen($string1);
                if ($t1>2) {
                $hu1=$string1[0].$string1[1].$string1[2];
                }if ($t1==1){ 
                    $hu1=$string1[0];
                }
                if ($t1==2){ 
                    $hu1=$string1[0].$string1[1];
                }
              
                if ($key['fecha_retiro']!='0000-00-00' && $key['fecha_desercion']=='0000-00-00') {
                    $boton='<span class="btn btn-warning ">Retirado</span>';
                    $color='background-color: #cabdbc36;';
                    $disabled='disabled';
                } 
                if ($key['fecha_desercion']!='0000-00-00' && $key['fecha_retiro']=='0000-00-00') {
                    $boton='<span class="btn btn-danger ">Desertor</span>';
                    $color='background-color: #cabdbc36;';
                    $disabled='disabled';
                }if($key['fecha_desercion']=='0000-00-00' && $key['fecha_retiro']=='0000-00-00'){ $boton='';
                    $boton='<span class="btn btn-info">Cursando</span>';
                    $disabled='';
                    $color='';
                }
                                 ?>
                <tr class="ee" id="Form<?php echo($cont); ?>" style='<?php echo $color  ?> '> 
                    <td><?php echo  $cont?></td>
                    <td class='xr' > 
                            <center><img style=" " class="profile-user-img img-responsive img-circle" src="<?php if(($key['foto']=='' && $key['genero']=='0') or ($key['foto']=='' && $key['genero']=='')){echo '../../../logos/niño.jpg';}  if($key['foto']=='' && $key['genero']=='1'){echo '../../../logos/niña.jpg';}if($key['foto']!=''){ echo($key['foto']); } ?>" alt="User profile picture"></center> 
                        </td>
                    <td class='xr' ><br><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>    
                    <td class='xr' ><br><?php echo $boton ?></td>
                    <td class='xr' >
                        <br>
                         <input type="text" class="ss" value="<?php echo $hu1 ?>" disabled >  
                    </td>
                    <td class='xr' >
                         <br>
                            <input type="text" class="ss" value="<?php echo $key['trabajo'] ?>" id='trabajo<?php echo $key['id_materia_por_periodo'] ?>' <?php echo $disabled ;if ($disabled=='') {    ?> onchange='var id_informe=<?php echo $key['id_informe_academico'] ?>;var nota=document.getElementById("trabajo<?php echo $key['id_materia_por_periodo'] ?>").value; var valor=<?php echo $key['trabajo'] ?>; var id=<?php echo $key['id_materia_por_periodo'] ?>; var campo="trabajo"; actualizar_recuperacion(id_informe,id,valor,nota,campo)' <?php } ?>> 
                    </td>
                    <td class='xr' >
                        <br> <input type="text" class="ss" value="<?php echo $key['sustentacion'] ?>" id='sustentacion<?php echo $key['id_materia_por_periodo'] ?>' <?php echo $disabled ;if ($disabled=='') {    ?> onchange='var id_informe=<?php echo $key['id_informe_academico'] ?>;var nota=document.getElementById("sustentacion<?php echo $key['id_materia_por_periodo'] ?>").value; var valor=<?php echo $key['sustentacion'] ?>; var id=<?php echo $key['id_materia_por_periodo'] ?>; var campo="sustentacion"; actualizar_recuperacion(id_informe,id,valor,nota,campo)' <?php } ?>  > 
                    </td>
                    <td class='xr'  id="recuperacion<?php echo $key['id_materia_por_periodo'] ?>"><br> 
                         <?php echo $hu ?>
                    </td>
                </tr><?php
             } ?>
        </table></div>
        </div>
        <script type="text/javascript">
        function sasa1() {
            mostrar(); 
            var archivoRuta = document.getElementById('ex').value;
            var vacio=''; 
            var excel = /(.xlsx)$/i;   

            var parametros=new FormData($("#formulario-envia1")[0]);
            $.ajax({

                data:parametros,
                url:"../../../ajax/rector/notas/notas.php?action=excel_recuperacion_academico",

                type:"POST",
                contentType:false,
                processData:false,

                success: function(data){
                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                        window.location.assign( window.location.href); 
                }
            });

        }
            function actualizar_recuperacion(id_informe,id,valor,nota,campo){ 
         var area=<?php echo $_POST['area'] ?>;
        var codigo= <?php echo $_POST['codigo'] ?>;
        var maximo =<?php echo $_SESSION["maximo"] ?>;
        var minimo =<?php  echo $_SESSION["minimo"]; ?>;
        var periodo = <?php echo $_POST['p'] ?>;   
        var n = nota.length;
           if(decimaa(nota)){
            if(ESnombre1(nota)){

            document.getElementById(campo+id).value=valor; 

                $('#ph').html('! Solo permite numeros deacuerdo a lo estipulado por la institucion');
                document.getElementById("iss").click(); 
            return;
          } 
            if(decimaa1(nota)){
            document.getElementById(campo+id).value=valor; 
            $('#ph').html('! Los numeros decimales  no utilizan coma sino punto');
            document.getElementById("iss").click(); 
            return;
          }  else{  
            document.getElementById(campo+id).value=valor; 
            $('#ph').html('! El numero esta mal escrito');
            document.getElementById("iss").click();  
         
            return;}
          } if(ESnombre1(nota)){  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('! solo permite numeros deacuerdo a lo estipulado por la institucion');
            document.getElementById("iss").click();  
            return;
          }if((decimaa2(nota)==true) && n>3){ if(nota>maximo){  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('! recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?> ');
            document.getElementById("iss").click();  
            return;
          }else{  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('!  solo soporta un umero antes del punto');
            document.getElementById("iss").click();  
            return;}
          }
          if(nota<minimo){  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('! recordamos que la nota mas baja es <?php  echo $_SESSION["minimo"]; ?> ');
            document.getElementById("iss").click();  
            return;
          }
          if(nota>maximo){  
            document.getElementById(campo+id).value=valor; 
            $('#ph').html('! recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
            document.getElementById("iss").click(); 
            return;
          }




            else{ 
                mostrar();
                $.ajax({  

                    type: "post",
                    url:"../../../ajax/rector/notas/notas.php?action=actualizar_recuperacion",

                    data:{id_informe,id,valor,nota,campo,area,codigo,periodo},    dataType:"text", 

                    success:function(data){     
                        $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );
                                $('#recuperacion'+id).html(data); 
                             
                    }  
                }); 
            }}
        </script>
        <?php


}

function form2(){
    
       $copp=0; 
    include "../../codes/rector/conexion.php";
    $p=$_POST['p'];   
    $id_g=$_POST['id_g'];
    $id_c=$_POST['id_c'];
    $id=$_POST['id'];
    $id_jornada_sede=$_POST['id_jornada_sede']; 
    $ano=date('Y');
     $apellido='';
    if(isset($_POST['apellido'])){
      $apellido=' and alumnos.apellido like("%'  .$_POST['apellido'].'%")';
       
    }
    $con3="SELECT tecnologia.recuperacion,tecnologia.sustentacion,tecnologia.trabajo,informeacademico.id_informe_academico, alumnos.nombre,alumnos.genero, alumnos.apellido, alumnos.foto ,tecnologia.nota,tecnologia.id_tecnologia,informeacademico.fecha_retiro,informeacademico.fecha_desercion FROM tecnologia,informeacademico,alumnos WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.ano='$ano' and informeacademico.id_curso='$id_c' and informeacademico.id_grado='$id_g' and informeacademico.id_jornada_sede='$id_jornada_sede' and informeacademico.id_informe_academico=tecnologia.id_informe_academico AND tecnologia.id_periodo='$p' and tecnologia.id_competrencia='$id' $apellido and tecnologia.nota<'".$_SESSION['desde2']."'  ORDER BY alumnos.apellido ";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();
    ?>
    <style>
        td,th{ 
            border: solid 1px #d5d5d5; 
            text-align: center;
        }
        .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec
        }
        .img-circle{
            width: 60px;
            height: 80px;
        }
        .img-circle:hover{
            width: 113px; 
            height: 145px;
        }
        .btn{
            font-size: smaller;
        }
        .ss{
            width: 70px;
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px; 
        }
        #az{
            color: #000;cursor: pointer;
        }
        #az:hover{
            color: #3c8dbc;
        }
    </style>
        <div style=" margin-left: 10px;margin-top: 5px ;width: 100%"> <strong>
            <?php  $rom='Competencia: '.$_POST['nombr_ma'].' / Curso: '.$_POST['ro'];
                    echo mb_convert_case($rom, MB_CASE_TITLE, "UTF-8")   ; ?> / <a  id="az" href='excel_recuperacion_tecnico.php?id_g=<?php echo $id_g; ?>&&rom=<?php echo $rom; ?>&&p=<?php echo $p; ?>&&id_c=<?php echo($id_c); ?>&&id=<?php echo($id); ?>&&id_jornada_sede=<?php echo($id_jornada_sede); ?> '> Descargar excel de nivelación</a></strong>
                    <br><br>
            <button style="margin-left: 10px" type="button" value="Imprime esta pagina" class="btn btn-danger" onclick=" window.print()" >
                <i class="fa  fa-file-pdf-o"></i>  Descargar notas
            </button> <br>

            <div style="padding: 17px;;padding-left: 10px;float: left;">
                <form name="formulario-envia1" id="formulario-envia1" enctype="multipart/form-data" method="post">
                    <div  class="btn btn-success btn-file">
                        <i class="fa  fa-file-excel-o"></i>  archivo notas excel
                        <input type="file" name="ex" id="ex">
                    </div>
                    <input type="hidden" value="<?php echo $p ?>" name='p' id='p'>             
                    <button type="button" class="btn btn-primary" name="opopopop" value="enciar" onclick="var u=document.getElementById('ex').value;if(u==''){ mensaje(2,'Seleccione el archivo excel');}else{   sasa1()}">Subir</button> 
                </form> 
            </div>
            <div style=";padding: 15px;margin-left: 19px;float: right;">
             <strong>Buscardo:</strong> <input type="text" id="apellido"  onchange="var apellido=document.getElementById('apellido').value;funcion(apellido)" style=" 
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;
            border-radius: 4px;" placeholder="Apellidos..">
            </div><br>
        </div>
        <div style="padding: 5px; margin-top:20px">
<br>    
            <div class="table-responsive" >
        <div id="_MSG_"></div> 
        <table class="table  "  >
            <tr style="background: #EEE;border: solid 2px #d5d5d5; ">
                <th>Id</th>
                <th style="padding-right: 44px;padding-left: 44px">Foto</th>
                <th>Estudiantes</th>
                <th>Estado</th>
                <th>Definitiva</th>
                <th>Trabajo</th>
                <th>Sutentacion</th>
                <th>Recuperacion</th>
            </tr>
            <?php 
            $cont=0;    
            foreach ($con2 as $key ) {
                $cont++;
                       $string = "".$key['recuperacion']."";
                $t=strlen($string);
                if ($t>2) {
                $hu=$string[0].$string[1].$string[2];
                }if ($t==1){ 
                    $hu=$string[0];
                }
                if ($t==2){ 
                    $hu=$string[0].$string[1];
                }


                       $string1 = "".$key['nota']."";
                $t1=strlen($string1);
                if ($t1>2) {
                $hu1=$string1[0].$string1[1].$string1[2];
                }if ($t1==1){ 
                    $hu1=$string1[0];
                }
                if ($t1==2){ 
                    $hu1=$string1[0].$string1[1];
                }
              
                if ($key['fecha_retiro']!='0000-00-00' && $key['fecha_desercion']=='0000-00-00') {
                    $boton='<span class="btn btn-warning ">Retirado</span>';
                    $color='background-color: #cabdbc36;';
                    $disabled='disabled';
                } 
                if ($key['fecha_desercion']!='0000-00-00' && $key['fecha_retiro']=='0000-00-00') {
                    $boton='<span class="btn btn-danger ">Desertor</span>';
                    $color='background-color: #cabdbc36;';
                    $disabled='disabled';
                }if($key['fecha_desercion']=='0000-00-00' && $key['fecha_retiro']=='0000-00-00'){ $boton='';
                    $boton='<span class="btn btn-info">Cursando</span>';
                    $disabled='';
                    $color='';
                }
                                 ?>
                <tr class="ee" id="Form<?php echo($cont); ?>" style='<?php echo $color  ?> '> 
                    <td><?php echo  $cont?></td>
                    <td class='xr' > 
                            <center><img style=" " class="profile-user-img img-responsive img-circle" src="<?php if(($key['foto']=='' && $key['genero']=='0') or ($key['foto']=='' && $key['genero']=='')){echo '../../../logos/niño.jpg';}  if($key['foto']=='' && $key['genero']=='1'){echo '../../../logos/niña.jpg';}if($key['foto']!=''){ echo($key['foto']); } ?>" alt="User profile picture"></center> 
                        </td>
                    <td class='xr' ><br><?php echo mb_convert_case($key['nombre']." ".$key['apellido'], MB_CASE_TITLE, "UTF-8")  ?>    
                    <td class='xr' ><br><?php echo $boton ?></td>
                    <td class='xr' >
                        <br>
                         <input type="text" class="ss" value="<?php echo $hu1 ?>" disabled >  
                    </td>
                    <td class='xr' >
                         <br>
                            <input type="text" class="ss" value="<?php echo $key['trabajo'] ?>" id='trabajo<?php echo $key['id_tecnologia'] ?>' <?php echo $disabled ;if ($disabled=='') {    ?> onchange='var id_informe=<?php echo $key['id_informe_academico'] ?>;var nota=document.getElementById("trabajo<?php echo $key['id_tecnologia'] ?>").value;var nota2=document.getElementById("sustentacion<?php echo $key['id_tecnologia'] ?>").value; var valor=<?php echo $key['trabajo'] ?>; var id=<?php echo $key['id_tecnologia'] ?>; var campo="trabajo"; var campo2="sustentacion"; actualizar_recuperacion(id_informe,id,valor,nota,campo,nota2,campo2)' <?php } ?>> 
                    </td>
                    <td class='xr' >
                        <br> <input type="text" class="ss" value="<?php echo $key['sustentacion'] ?>" id='sustentacion<?php echo $key['id_tecnologia'] ?>' <?php echo $disabled ;if ($disabled=='') {    ?> onchange='var id_informe=<?php echo $key['id_informe_academico'] ?>;var nota=document.getElementById("sustentacion<?php echo $key['id_tecnologia'] ?>").value; var valor=<?php echo $key['sustentacion'] ?>; var id=<?php echo $key['id_tecnologia'] ?>; var campo="sustentacion"; var campo2="trabajo";var nota2=document.getElementById("trabajo<?php echo $key['id_tecnologia'] ?>").value; actualizar_recuperacion(id_informe,id,valor,nota,campo,nota2,campo2)' <?php } ?>  > 
                    </td>
                    <td class='xr'  id="recuperacion<?php echo $key['id_tecnologia'] ?>"><br> 
                         <?php echo $hu ?>
                    </td>
                </tr><?php
             } ?>
        </table></div>
        </div>
        <script type="text/javascript">
            function sasa1() {
                mostrar(); 
                var archivoRuta = document.getElementById('ex').value;
                var vacio=''; 
                var excel = /(.xlsx)$/i;   

                var parametros=new FormData($("#formulario-envia1")[0]);
                $.ajax({

                    data:parametros,
                    url:"../../../ajax/rector/notas/notas.php?action=excel_recuperacion_tecnico",

                    type:"POST",
                    contentType:false,
                    processData:false,

                    success: function(data){
                        $('body').loadingModal({text: 'Showing loader animations...'});

                            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                            var time = 0;

                            delay(time)
                            .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                            .then(function() { $('body').loadingModal('destroy') ;} );
                            window.location.assign( window.location.href); 
                    }
                });

            }
            function actualizar_recuperacion(id_informe,id,valor,nota,campo,nota2,campo2){ 
          
        var maximo =<?php echo $_SESSION["maximo"] ?>;
        var minimo =<?php  echo $_SESSION["minimo"]; ?>;
        var periodo = <?php echo $_POST['p'] ?>;   
        var n = nota.length;
           if(decimaa(nota)){
            if(ESnombre1(nota)){

            document.getElementById(campo+id).value=valor; 

                $('#ph').html('! Solo permite numeros deacuerdo a lo estipulado por la institucion');
                document.getElementById("iss").click(); 
            return;
          } 
            if(decimaa1(nota)){
            document.getElementById(campo+id).value=valor; 
            $('#ph').html('! Los numeros decimales  no utilizan coma sino punto');
            document.getElementById("iss").click(); 
            return;
          }  else{  
            document.getElementById(campo+id).value=valor; 
            $('#ph').html('! El numero esta mal escrito');
            document.getElementById("iss").click();  
         
            return;}
          } if(ESnombre1(nota)){  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('! solo permite numeros deacuerdo a lo estipulado por la institucion');
            document.getElementById("iss").click();  
            return;
          }if((decimaa2(nota)==true) && n>3){ if(nota>maximo){  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('! recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?> ');
            document.getElementById("iss").click();  
            return;
          }else{  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('!  solo soporta un umero antes del punto');
            document.getElementById("iss").click();  
            return;}
          }
          if(nota<minimo){  
            document.getElementById(campo+id).value=valor;
            $('#ph').html('! recordamos que la nota mas baja es <?php  echo $_SESSION["minimo"]; ?> ');
            document.getElementById("iss").click();  
            return;
          }
          if(nota>maximo){  
            document.getElementById(campo+id).value=valor; 
            $('#ph').html('! recordamos que la nota mas alta es <?php  echo $_SESSION["maximo"]; ?>');
            document.getElementById("iss").click(); 
            return;
          }




            else{ 
                mostrar();
                $.ajax({  

                    type: "post",
                    url:"../../../ajax/rector/notas/notas.php?action=actualizar_recuperacion_tecnico",

                    data:{id_informe,id,valor,nota,campo, periodo,nota2,campo2},    dataType:"text", 

                    success:function(data){ 
                    $('body').loadingModal({text: 'Showing loader animations...'});

                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;

                        delay(time)
                        .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );    
                        $('#recuperacion'+id).html(data); 
                             
                    }  
                }); 
            }}
        </script>
        <?php


}