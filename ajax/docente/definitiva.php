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
 
function definitiva_tecnica() {

 
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
       $con3="SELECT informeacademico.id_informe_academico,informeacademico.fecha_desercion, informeacademico.fecha_retiro, alumnos.nombre,alumnos.genero, alumnos.apellido, alumnos.foto ,tecnologia.nota,tecnologia.id_tecnologia FROM alumnos, informeacademico ,tecnologia WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso=$id_c AND informeacademico.id_grado=$id_g AND informeacademico.id_jornada_sede=$id_jornada_sede and  informeacademico.ano=$ano and tecnologia.id_informe_academico=informeacademico.id_informe_academico  AND tecnologia.id_periodo=$p AND tecnologia.id_competrencia='$id'  $dato order by alumnos.apellido";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();

   
    $rom='Competencia: '.$_POST['nomd'].' / Curso: '.$_POST['ro'];
    ?>
    <style type="text/css">
                .ee:hover{
                    border:solid 2px #C9C7C7;
                    background-color: #ececec
                }
                td,th{
                    border: solid 1px #d5d5d5; 
                    text-align: center;
                } 
 
            [data-title] {  
              
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
              left: 18px;
              display: inline-block;
              color: #fff;
              border: 11px solid transparent;    
              border-bottom: 11px solid #000;
            }
            tr:hover td{
                border-top:solid 2px #C9C7C7;
                border-bottom :solid 2px #C9C7C7;
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
                .btn{
                font-size: smaller;
             }
            </style>
    <div id="sapo"></div>
    <div id="_MSG5_" style="margin: 7px"></div>
        <strong style="margin-left: 10px"><?php echo mb_convert_case($rom, MB_CASE_TITLE, "UTF-8")   ; ?></strong><br> <br>
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
                <button type="button" class="btn btn-primary" name="opopopop" value="enciar" onclick="var u=document.getElementById('ex').value;if(u==''){ mensaje5(2,'Seleccione el archivo excel');}else{   sasa()}">Subir</button> 
            </form> 
        </div>



        <div style=";padding: 15px;margin-left: 19px;float: right;">
             <strong>Buscardo:</strong> <input type="text" id="apellido"  onchange="var apellido=document.getElementById('apellido').value;funcion(apellido)" style="
            padding: 6px 12px; 
            color: #555; 
            border: 1px solid #ccc;   height: 37px; width:200px"  placeholder="Apellidos..">
        </div>
        <div style="margin:10px"> 
            
            <div class="table-responsive" style="width: 100%">
                <table   class="  table "  style="width: 100%;" >
                
                         
                        <tr style=" color: #3c8dbc; background: #EEE" >
                            <th style="  color: #3c8dbc; border-top:solid 1px #d5d5d5;">Id</th>
                            <th style="  color: #3c8dbc; border-top:solid 1px #d5d5d5;padding-left: 40px;padding-right: 40px">foto</th>
                            <th style=" color: #3c8dbc; border-top:solid 1px #d5d5d5;">Estudiante</th><th style="border-top:solid 1px #d5d5d5;">Estado</th>  
                            <th style="cursor: pointer; border-top:solid 1px #d5d5d5;" id="hove" ondblclick="excel()"> <a data-title="De doble click para descargar las definitivas en excel"  >
                               Descargar    Nota  Periodo <?php echo $p ?></a>
                            </th>

                        </tr> <?php  
                        $cont=1;
                        $cc=1;
                        foreach($con2 as $key){ $cssS=0; ?>
                            <tr class="ee" id="Form<?php echo($cont); ?>" <?php if ($key['fecha_retiro']!='0000-00-00' or $key['fecha_desercion']!='0000-00-00') {
                            echo 'style="background-color: #d5e8f4"';} ?>> 
                                <td> <br><?php echo $cc++ ?></td>
                                <td>

                                    <img   class="profile-user-img img-responsive img-circle" src="<?php 

                                    if($key['foto']=='' && $key['genero']=='1'){
                                        echo '../../../logos/niña.jpg';
                                    }  if($key['foto']=='' && $key['genero']==''){
                                        echo '../../../logos/niño.jpg';
                                    }if($key['foto']=='' && $key['genero']=='0'){
                                        echo '../../../logos/niño.jpg';
                                    }if($key['foto']!='' ){  echo($key['foto']); } ?>" alt="User profile picture"> 
                                </td>
                                <td >  <br>
                                    <?php $ff=($key['nombre']." ".$key['apellido']);  
                                    echo mb_convert_case($ff, MB_CASE_TITLE, "UTF-8")   ; ?> 
                                </td>
                                <td>
                                    <br><?php 
                                    if ($key['fecha_retiro']!='0000-00-00' && $key['fecha_desercion']=='0000-00-00') {
                                        echo'<span class="btn btn-warning ">Retirado</span>';
                                     } 
                                    if ($key['fecha_desercion']!='0000-00-00' && $key['fecha_retiro']=='0000-00-00') {
                                         echo'<span class="btn btn-danger ">Desertor</span>';
                                     }if($key['fecha_desercion']=='0000-00-00' && $key['fecha_retiro']=='0000-00-00'){
                                        echo'<span class="btn btn-info">Cursando</span>';
                                    }
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
                                 </td>  
                                        <td> <br> 
                                     
                                        <input  style="    width: 45px;
                                        text-align: center;
                                        border-radius: 4px; 
                                        color: #555;
                                        border: 1px solid #ccc;"   TABINDEX='<?php echo $cont;echo($cssS)  ?>'  value="<?php  echo($hu);  ?>"   <?php  if ($key['fecha_retiro']=='0000-00-00'  && $key['fecha_desercion']=='0000-00-00') {?>     id="ident<?php echo $key['id_tecnologia'] ?>" style='width: 38px'   onchange='  var nota = $("#ident<?php echo($key['id_tecnologia']); ?>").val();  var id=<?php echo($key['id_tecnologia']); ?>;  var valor=<?php echo($hu) ?>;    inserto2(id,nota,valor);        '>  <?php } else{ echo " style='width: 38px'  disabled>";  } ?>
                                    </td> 
                                
                            </tr> <?php
                        } ?> 
                                
                           
                </table>
            </div>
        </div>
 
    <script>
        function excel(){
            location.href = 'excel_tecnica.php?id_g=<?php echo $id_g; ?>&&rom=<?php echo $rom; ?>&&p=<?php echo $p; ?>&&id_c=<?php echo($id_c); ?>&&id=<?php echo($id); ?>&&id_jornada_sede=<?php echo($id_jornada_sede); ?> '
        }
  
        function  inserto2(id,nota,valor) { 
            var maximo =<?php echo $_SESSION["maximo2"] ?>;
            var minimo =<?php  echo $_SESSION["minimo2"]; ?>;
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
            }
            if((decimaa2(nota)==true) && n>3){ 
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

            else{  
                mostrar(); 
                $.ajax({ 
                    url: "../../../ajax/docente/definitiva.php?action=registro_tecnica",
                    type:"POST",
                    data: {id,nota },
                    dataType: "text",
                    success: function(data) { 
                        $('body').loadingModal({text: 'Showing loader animations...'});
                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );   
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
                url:"../../../ajax/docente/definitiva.php?action=excel3",
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
function definitiva() {

 
    $copp=0; 
    include "../../codes/rector/conexion.php";
    $p=$_POST['p'];  
    $id_a=$_POST['id_a']; 
    $id_g=$_POST['id_g'];
    $id_c=$_POST['id_c'];
    $id_jornada_sede=$_POST['id_jornada_sede']; 
    $dato='';
    if(isset($_POST['dato'])){
      $dato=' and alumnos.apellido like("%'  .$_POST['dato'].'%")';
       
    }
    $ano=date('Y');        
    $con3="SELECT informeacademico.id_informe_academico,informeacademico.estado_aprovado, alumnos.nombre,alumnos.genero, alumnos.apellido, alumnos.foto ,materia_por_periodo.nota,materia_por_periodo.id_materia_por_periodo FROM alumnos, informeacademico ,materia_por_periodo WHERE alumnos.id_alumnos=informeacademico.id_alumno and informeacademico.id_curso=$id_c AND informeacademico.id_grado=$id_g AND informeacademico.id_jornada_sede=$id_jornada_sede and  informeacademico.ano=$ano and materia_por_periodo.id_informe_academico=informeacademico.id_informe_academico  AND materia_por_periodo.periodo=$p AND materia_por_periodo.id_area='$id_a' $dato  order by alumnos.apellido";
    $con1=$conexion->prepare($con3);
    $con1->execute(array());
    $count=$con1->rowCount();
    $con2=$con1->fetchAll();

   
    $rom='area: '.$_POST['nomd'].' / Curso: '.$_POST['ro'];
    ?>
      <script language="Javascript"  >
        
    </script>
    <div id="sapo"></div>
    <div id="_MSG5_" style="margin: 7px"></div>
        <strong style="margin-left: 10px"><?php echo mb_convert_case($rom, MB_CASE_TITLE, "UTF-8")   ; ?></strong><br> <br>
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
                <button type="button" class="btn btn-primary" name="opopopop" value="enciar" onclick="var u=document.getElementById('ex').value;if(u==''){ mensaje5(2,'Seleccione el archivo excel');}else{   sasa()}">Subir</button> 
            </form> 
        </div>



        <div style=";padding: 15px;margin-left: 19px;float: right;">
             <strong>Buscardo:</strong> <input type="text" id="apellido"  onchange="var apellido=document.getElementById('apellido').value;funcion(apellido)" style="padding-left: 10px;  height: 26px; width:200px" placeholder="Apellidos..">
        </div>
        <div style="margin:10px"> 
            <style type="text/css">
                .ee:hover{
                    border:solid 2px #C9C7C7;
                    background-color: #ececec
                }
                td,th{
                    border: solid 1px #d5d5d5; 
                    text-align: center;
                } 
 
            [data-title] {  
              
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
              left: 18px;
              display: inline-block;
              color: #fff;
              border: 11px solid transparent;    
              border-bottom: 11px solid #000;
            }
            tr:hover td{
                border-top:solid 2px #C9C7C7;
                border-bottom :solid 2px #C9C7C7;
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
            </style>
            <div class="table-responsive" style="width: 100%">
                <table   class="  table "  style="width: 100%;" >
                
                         
                        <tr style=" color: #3c8dbc; background: #EEE" >
                            <th style="  color: #3c8dbc; border-top:solid 1px #d5d5d5;">Id</th>
                            <th style="  color: #3c8dbc; border-top:solid 1px #d5d5d5;padding-left: 40px;padding-right: 40px">foto</th>
                            <th style=" color: #3c8dbc; border-top:solid 1px #d5d5d5;">Estudiante</th><th style="border-top:solid 1px #d5d5d5;">Estado</th>  
                            <th style="cursor: pointer; border-top:solid 1px #d5d5d5;" id="hove" ondblclick="excel()"> <a data-title="De doble click para descargar las definitivas en excel"  >
                               Descargar    Nota  Periodo <?php echo $p ?></a>
                            </th>

                        </tr> <?php  
                        $cont=1;
                        $cc=1;
                        foreach($con2 as $key){ $cssS=0; ?>
                            <tr class="ee" id="Form<?php echo($cont); ?>"> 
                                <td> <br><?php echo $cc++ ?></td>
                                <td style="padding: 3px">

                                    <img  style="" class="profile-user-img img-responsive img-circle" src="<?php 

                                    if($key['foto']=='' && $key['genero']=='1'){
                                        echo '../../../logos/niña.jpg';
                                    }  if($key['foto']=='' && ($key['genero']=='' or $key['genero']=='0')){
                                        echo '../../../logos/niño.jpg';
                                    } if($key['foto']!='' ){  echo($key['foto']); } ?>" alt="User profile picture"> 
                                </td>
                                <td >  <br>
                                    <?php $ff=($key['nombre']." ".$key['apellido']);  
                                    echo mb_convert_case($ff, MB_CASE_TITLE, "UTF-8")   ; ?>  
                                </td>
                                <td>
                                    <br><?php 
                                    $hu = number_format($key['nota'], 1, '.', ''); 
                                    if ($key['estado_aprovado']==1) {
                                        echo'<span class="btn btn-warning ">Retirado</span>';
                                        
                                        $mostra=" style='width: 38px'  disabled";
                                     } 
                                    if ($key['estado_aprovado']==2) {
                                        $mostra=" style='width: 38px'  disabled";
                                         echo'<span class="btn btn-danger ">Desertor</span>';
                                     }if($key['estado_aprovado']==0){

                                        echo'<span class="btn btn-info">Cursando</span>';
                                        $mostra= '   id="ident'.$key['id_materia_por_periodo']. '"style=\'width: 38px\'   onchange=\'  var nota = $("#ident'.$key['id_materia_por_periodo'].'").val();  var id='.$key['id_materia_por_periodo'].';  var valor='.$hu.';    inserto2(id,nota,valor);        \' ';
                                    }  ?>
                                 </td>  
                                        <td> <br> 
                                     
                                        <input  style="    width: 45px;
                                        text-align: center;
                                        border-radius: 4px; 
                                        color: #555;
                                        border: 1px solid #ccc;"   TABINDEX='<?php echo $cont;echo($cssS)  ?>'  value="<?php  echo($hu);  ?>"   <?php echo   $mostra ?>   >
                                    </td> 
                                
                            </tr> <?php
                        } ?> 
                                
                           
                </table>
            </div>
        </div>
 
    <script>
        function excel(){
            location.href = 'excel_academico.php?id_g=<?php echo $id_g; ?>&&rom=<?php echo $rom; ?>&&p=<?php echo $p; ?>&&id_c=<?php echo($id_c); ?>&&id_a=<?php echo($id_a); ?>&&id_jornada_sede=<?php echo($id_jornada_sede); ?> '
        }
  
        function  inserto2(id,nota,valor) { 
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
            }
            if((decimaa2(nota)==true) && n>3){ 
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

            else{  
                mostrar(); 
                $.ajax({ 
                    url: "../../../ajax/docente/definitiva.php?action=registro_academico",
                    type:"POST",
                    data: {id,nota },
                    dataType: "text",
                    success: function(data) { 
                        $('body').loadingModal({text: 'Showing loader animations...'});
                        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                        var time = 0;
                        delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                        .then(function() { $('body').loadingModal('destroy') ;} );   
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
                url:"../../../ajax/docente/definitiva.php?action=excel4",
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

 function excel4(){
 

 
    include '../conexion.php';
    include '../../Classes/PHPExcel/IOFactory.php';
    $c = $_FILES['ex']; 

    $nombreArchivo=$c['tmp_name']; 

    $objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
    $objPHPExcel->setActiveSheetIndex(0);
    $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


    $NOTAAA = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();
    $patrones = array ('/[^0-9]/'); 
    $Periodo= preg_replace($patrones, '', $NOTAAA);
    $Periodo;
    
 
    

    date_default_timezone_set("America/Bogota");
     
    $fecha=date("Y-m-d");
    $hora=date("h:i:s");
   

        for($i = 4; $i <= $numRows; $i++){

            $ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
            $NOTA = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();

             

              
           echo $tipo_calificaione="INSERT INTO `seguimiento_notas_definitivas` ( `rol`, `id_materia_por_periodo`, `fecha`, `notas`, `nombre`, `apellido`, `hora`)   VALUES ( '".$_SESSION['Rol']."', '".$ID."', '$fecha', '".$NOTA."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."') ;
             UPDATE `materia_por_periodo` SET `nota` =  '".$NOTA."' WHERE materia_por_periodo.id_materia_por_periodo= ".$ID;
            $tipo_calificaione=$conexion->prepare($tipo_calificaione);
            $tipo_calificaione->execute(array());  

            seguir($ID,$Periodo);
        
        }
    
}

function seguir($ID,$Periodo){
            include '../conexion.php';
          echo  '<br><br>/<br>'.   $tipo_calificaione1="SELECT materia_por_periodo.id_materia_por_periodo,materia_por_periodo.nota, materia_por_periodo.area from materia_por_periodo ,(SELECT materia_por_periodo.id_informe_academico ,materia_por_periodo.codigo from materia_por_periodo WHERE materia_por_periodo.id_materia_por_periodo='$ID' AND materia_por_periodo.area=0 )as q WHERE  materia_por_periodo.id_informe_academico=q.id_informe_academico and materia_por_periodo.codigo=q.codigo and materia_por_periodo.periodo='$Periodo'";
            $tipo_calificaione2=$conexion->prepare($tipo_calificaione1);
            $tipo_calificaione2->execute(array());  
         echo  '<br>'.    $count=$tipo_calificaione2->rowCount();
            if ($count>0) {
                $cont=0;
                $sum=0;
                foreach ($tipo_calificaione2 as  $value) {
                   
                    if ($value['area']==0 ) {
                        $cont=$cont+1;
                        $sum=$sum+$value['nota'];
                    }

                    if ($value['area']==1) {
                        $id_m=$value['id_materia_por_periodo'];
                    }
                }
      
                $sum1=$sum/$cont    ;
                echo  '<br><br>'.$tipo_calificaiones1="  UPDATE `materia_por_periodo` SET `nota` = '".$sum1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_m ;
                $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                $tipo_calificaiones1->execute(array());  
            }
}





 function excel3(){
 

 
    include '../conexion.php';
    include '../../Classes/PHPExcel/IOFactory.php';
    $c = $_FILES['ex']; 

    $nombreArchivo=$c['tmp_name']; 

    $objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
    $objPHPExcel->setActiveSheetIndex(0);
    $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


    $NOTAAA = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();
    $patrones = array ('/[^0-9]/'); 
    $Periodo= preg_replace($patrones, '', $NOTAAA);
    $Periodo;
    
    $zx=''; 
    if(isset($_SESSION['id_periodo'])){
   
        foreach ($_SESSION['id_periodo'] as   $value) { 
            if ($Periodo==$value) {
                $zx=1;
            }
        }
    }


    if(isset($_SESSION['numero'])){
   
        foreach ($_SESSION['numero'] as   $valuse) { 
            if ($Periodo==$valuse) {
                $zx=1;
            }
        }
    }
    

    date_default_timezone_set("America/Bogota");
     
    $fecha=date("Y-m-d");
    $hora=date("h:i:s");
    if ($zx>0) { 

        for($i = 3; $i <= $numRows; $i++){

            $ID = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();  
            $NOTA = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();

             

           echo '<br><br>'.
            $tipo_calificaione="INSERT INTO `seguimiento_tecnica_definitiva` (`rol`, `id_tecnologia`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$ID."', '$fecha', '".$NOTA."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."') ;
             UPDATE `tecnologia` SET `nota` =  '".$NOTA."' WHERE tecnologia.id_tecnologia= ".$ID;
            $tipo_calificaione=$conexion->prepare($tipo_calificaione);
            $tipo_calificaione->execute(array());   
        }
    }
}


function  registro_tecnica(){
    include '../conexion.php';
    date_default_timezone_set("America/Bogota"); 
    $fecha=date("Y-m-d");
    $hora=date("h:i:s");

    $con3="INSERT INTO `seguimiento_tecnica_definitiva` (`rol`, `id_tecnologia`, `fecha`, `notas`, `nombre`, `apellido`, `hora`) VALUES ( '".$_SESSION['Rol']."', '".$_POST['id']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$_POST['nota']."') ;

    UPDATE `tecnologia` SET `nota` = '".$_POST['nota']."' WHERE `tecnologia`.`id_tecnologia` = '".$_POST['id']."';";
    $con1=$conexion->prepare($con3);
    $con1->execute(array()); 

}

function  registro_academico(){
    include '../conexion.php';
    date_default_timezone_set("America/Bogota"); 
    $fecha=date("Y-m-d");
    $hora=date("h:i:s");

    $con3="INSERT INTO `seguimiento_notas_definitivas` ( `rol`, `id_materia_por_periodo`, `fecha`, `notas`, `nombre`, `apellido`, `hora`)   VALUES ( '".$_SESSION['Rol']."', '".$_POST['id']."', '$fecha', '".$_POST['nota']."', '".$_SESSION['Nom_U']."', '".$_SESSION['Ape_U']."', '".$hora."') ;
        UPDATE `materia_por_periodo` SET `nota` =  '".$_POST['nota']."' WHERE materia_por_periodo.id_materia_por_periodo= ".$_POST['id']  ;
    $con1=$conexion->prepare($con3);
    $con1->execute(array()); 

}
?>