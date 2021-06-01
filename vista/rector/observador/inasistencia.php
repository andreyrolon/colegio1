<?php 
session_start();
//mensajeria
require_once "../../../codes/rector/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

//session
if(!isset($_SESSION['Session1'])){
  header("location: ../../../login.php"); 
}
//trae los datos de la jornada y la sede
include "../../../codes/rector/jornada.php";
$js=new jornada();
$jornada_sede=$js->mostrar_jornada_sede();
 

 

include('../enlaces/head.php'); 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;
?>
 






<body style=" <?php echo $sty ?> " class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper"  >
    <?php  include('../enlaces/header.php'); ?>
    <div class="content-wrapper"  > 
      <section id="content" class="content">
           <div class="modal fade bd-example-modal-lg in" id="my" aria-labelledby="myLargeModalLabel" style="background-color: rgb(2 72 107 / 48%); ">
                        <div class="modal-dialog modal-lg">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><strong>Historial de inasistencia </strong> 
                                        </h4>
                                </div> <br> 
                                    <div style="  margin-left: 10px;margin-right: 10px" id=" ">
                                        <div style="float: left; margin-right: 14px"> <strong> Total de registros </strong><strong id="qwq">3</strong></div>
                                        <div id="busca1" style="float: right; display: block;"><strong> Buscar:</strong>
                                        <input type="" class="form-control" placeholder="nombre Materias" id="busca" name="busca" style="height: 26px; width: 200px;display: unset;margin-left: 8px;" onchange=" 
                                        var id_informe_academico=document.getElementById('id_informe_academicov').value;
                                        var id_area=document.getElementById('id_areav').value;
                                        var titular=document.getElementById('titularv').value;
                                        var tu=document.getElementById('tuv').value;
                                        var id_arema=document.getElementById('id_aremav').value;
                                        var fecha=document.getElementById('fechav').value;
                                        var busca1=document.getElementById('busca').value;
                                        var tec=document.getElementById('tecxx').value;
                                        
                                        mostrarw(tec,id_informe_academico,id_area,titular,tu,id_arema,fecha,busca1); "></div>
                                        
                                    </div><div style="width: 100%;color:#fff;margin-bottom: 6px">s</div> 
                                    <div class="modal-body table-responsive" id="mostrar1">
    <script type="text/javascript">
        document.getElementById('busca1').style.display='block'; 
    </script>  
    <style type="text/css">
        .asd:hover{
            background-color: #c3c3c38f;
    border: solid 2px #A2A0A4;
        }
    </style>
    <script type="text/javascript">
        document.getElementById('qwq').innerHTML='3';
    </script>
    <input type="hidden" value="38" id="id_informe_academicov">
    <input type="hidden" value="13" id="id_areav">
    <input type="hidden" value="53" id="titularv">
    <input type="hidden" value="1" id="tuv">
    <input type="hidden" value="and inasistencia.id_area=13" id="id_aremav">
    <input type="hidden" value="2020-01-17" id="fechav"> 
    <input type="hidden" value="0" id="tecxx"> 
    <div id="_MSG2_"></div>
  
    <table class="table table-bordered"> 
            <tbody><tr>
                <th>Periodo</th>
                <th>Fecha de registro</th>
                <th>Hora de registro</th>
                <th>Dia</th> 
                <th>Materia</th> 
                <th style="">Lista</th>
                
                <th>Eliminar</th>
                
            </tr> 
        </tbody><tbody>

            
                        <tr class="asd" id="fialo1">
                <td>
                        <input style="    width: 51px;" id="ere21" value="1" class="form-control" disabled=""></td>

                <td>                        <input type="date" style="    width: 147px;" id="ere1" class="form-control" value="2020-01-17" disabled="">                </td> 


                <td> 
                                            <input type="time" style="    width: 145px;" id="ere21" value="06:48:00" class="form-control" disabled="">
                                        </td>
                <td>

                                                <input style="    width: 88px;" disabled="" class="form-control" value="Viernes" name="">
                     
                </td>
              
                <td> <input style=" background-color: #eee;   width: 126px;" class="form-control" value="espaÃ±ol" name="">
                </td>
                <td>   
                    <select name="" style="width: 140px" class="form-control" id="asis1q1" onchange="
                    var id_inasistencia=1;
                    var asis=document.getElementById('asis1q1').value;
                     actualizar_asisten(id_inasistencia,asis);ben(); ">    <option value="1">Inasistencia</option><option value="0" disabled="">Asistencia</option><option value="2">Inasistencia J</option><option value="3">Retardos</option><option value="4">Retardos J</option>                            </select>
                </td>
                 
                <td>
                    <a style="top: -8px" data-title="Eliminar inasistencia" onclick="var r = confirm('Está  seguro de eliminar esté registro!');
                    if (r == true) {   
                    var id_inasistencia=1;
                        eliminar_re11(id_inasistencia); ben();document.getElementById('fialo1').style.display='none'; 
                         
                    } else {
                        return;
                    }">
                        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
                    </a>
                </td>
                            </tr>
                        <tr class="asd" id="fialo2">
                <td>
                        <input style="    width: 51px;" id="ere22" value="1" class="form-control" disabled=""></td>

                <td>                        <input type="date" style="    width: 147px;" id="ere2" class="form-control" value="2020-01-17" disabled="">                </td> 


                <td> 
                                            <input type="time" style="    width: 145px;" id="ere22" value="07:07:00" class="form-control" disabled="">
                                        </td>
                <td>

                                                <input style="    width: 88px;" disabled="" class="form-control" value="Viernes" name="">
                     
                </td>
              
                <td> <input style=" background-color: #eee;   width: 126px;" class="form-control" value="ingles" name="">
                </td>
                <td>   
                    <select name="" style="width: 140px" class="form-control" id="asis1q2" onchange="
                    var id_inasistencia=2;
                    var asis=document.getElementById('asis1q2').value;
                     actualizar_asisten(id_inasistencia,asis);ben(); ">    <option value="1">Inasistencia</option><option value="0" disabled="">Asistencia</option><option value="2">Inasistencia J</option><option value="3">Retardos</option><option value="4">Retardos J</option>                            </select>
                </td>
                 
                <td>
                    <a style="top: -8px" data-title="Eliminar inasistencia" onclick="var r = confirm('Está  seguro de eliminar esté registro!');
                    if (r == true) {   
                    var id_inasistencia=2;
                        eliminar_re11(id_inasistencia); ben();document.getElementById('fialo2').style.display='none'; 
                         
                    } else {
                        return;
                    }">
                        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
                    </a>
                </td>
                            </tr>
                        <tr class="asd" id="fialo3">
                <td>
                        <input style="    width: 51px;" id="ere23" value="1" class="form-control" disabled=""></td>

                <td>                        <input type="date" style="    width: 147px;" id="ere3" class="form-control" value="2020-01-17" disabled="">                </td> 


                <td> 
                                            <input type="time" style="    width: 145px;" id="ere23" value="06:51:00" class="form-control" disabled="">
                                        </td>
                <td>

                                                <input style="    width: 88px;" disabled="" class="form-control" value="Viernes" name="">
                     
                </td>
              
                <td> <input style=" background-color: #eee;   width: 126px;" class="form-control" value="religion" name="">
                </td>
                <td>   
                    <select name="" style="width: 140px" class="form-control" id="asis1q3" onchange="
                    var id_inasistencia=3;
                    var asis=document.getElementById('asis1q3').value;
                     actualizar_asisten(id_inasistencia,asis);ben(); ">    <option value="1">Inasistencia</option><option value="0" disabled="">Asistencia</option><option value="2">Inasistencia J</option><option value="3">Retardos</option><option value="4">Retardos J</option>                            </select>
                </td>
                 
                <td>
                    <a style="top: -8px" data-title="Eliminar inasistencia" onclick="var r = confirm('Está  seguro de eliminar esté registro!');
                    if (r == true) {   
                    var id_inasistencia=3;
                        eliminar_re11(id_inasistencia); ben();document.getElementById('fialo3').style.display='none'; 
                         
                    } else {
                        return;
                    }">
                        <img style="width: 33px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4Ij48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MS4zODY3MTktMTE0LjYxMzI4MSAyNTYtMjU2IDI1NnMtMjU2LTExNC42MTMyODEtMjU2LTI1NiAxMTQuNjEzMjgxLTI1NiAyNTYtMjU2IDI1NiAxMTQuNjEzMjgxIDI1NiAyNTZ6bTAgMCIgZmlsbD0iI2ZmOTI5ZiIvPjxwYXRoIGQ9Im0yMjkuMTk1MzEyIDE0MS45NzY1NjJjNTIuNjY3OTY5LTQwLjY0NDUzMSA3OS4wNzAzMTMtOTguNDcyNjU2IDkxLjA4MjAzMi0xMzMuODM5ODQzLTIwLjUzOTA2My01LjMxMjUtNDIuMDc4MTI1LTguMTM2NzE5LTY0LjI3NzM0NC04LjEzNjcxOS0xNDEuMzg2NzE5IDAtMjU2IDExNC42MTMyODEtMjU2IDI1NnMxMTQuNjEzMjgxIDI1NiAyNTYgMjU2YzEwLjU5Mzc1IDAgMjEuMDQ2ODc1LS42NDQ1MzEgMzEuMzA0Njg4LTEuODk0NTMxLTExMS4yNjU2MjYtOTMuMzk0NTMxLTEyNy45MTQwNjMtMTg5LjI5Mjk2OS0xMjAuNjMyODEzLTI1Ni4zMzk4NDQgNC44MDA3ODEtNDQuMTc5Njg3IDI3LjM0Mzc1LTg0LjYzNjcxOSA2Mi41MjM0MzctMTExLjc4OTA2M3ptMCAwIiBmaWxsPSIjZmY3MzdkIi8+PHBhdGggZD0ibTMzMy45NzI2NTYgMjQyLjUxMTcxOSA1OS4zMzk4NDQtNTkuMzM1OTM4YzE3LjczMDQ2OS0xNy43MzQzNzUgMTcuNzMwNDY5LTQ2Ljc1MzkwNiAwLTY0LjQ4NDM3NS0xNy43MzQzNzUtMTcuNzM0Mzc1LTQ2Ljc1MzkwNi0xNy43MzQzNzUtNjQuNDg4MjgxIDBsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTcuNDQ5MjE5IDcuNDQ5MjE4LTE5LjUyNzM0MyA3LjQ0OTIxOC0yNi45NzY1NjIgMGwtNTkuMzM1OTM4LTU5LjMzNTkzOGMtMTcuNzM0Mzc1LTE3LjczNDM3NS00Ni43NS0xNy43MzQzNzUtNjQuNDg0Mzc1IDAtMTcuNzM0Mzc1IDE3LjczMDQ2OS0xNy43MzQzNzUgNDYuNzUgMCA2NC40ODQzNzVsNTkuMzM1OTM4IDU5LjMzNTkzOGM3LjQ0OTIxOCA3LjQ0OTIxOSA3LjQ0OTIxOCAxOS41MjczNDMgMCAyNi45NzY1NjJsLTU5LjMzNTkzOCA1OS4zMzU5MzhjLTE3LjczNDM3NSAxNy43MzQzNzUtMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1IDE3LjczNDM3NSA2NC40ODQzNzUgMGw1OS4zMzU5MzgtNTkuMzM1OTM4YzcuNDQ5MjE5LTcuNDQ5MjE4IDE5LjUyNzM0My03LjQ0OTIxOCAyNi45NzY1NjIgMGw1OS4zMzU5MzggNTkuMzM1OTM4YzE3LjczNDM3NSAxNy43MzQzNzUgNDYuNzUzOTA2IDE3LjczNDM3NSA2NC40ODgyODEgMCAxNy43MzA0NjktMTcuNzMwNDY5IDE3LjczMDQ2OS00Ni43NSAwLTY0LjQ4NDM3NWwtNTkuMzM5ODQ0LTU5LjMzNTkzOGMtNy40NDkyMTgtNy40NDkyMTktNy40NDkyMTgtMTkuNTI3MzQzIDAtMjYuOTc2NTYyem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMjE2LjkzNzUgMTUyLjQ1MzEyNS0zMy43NjE3MTktMzMuNzY1NjI1Yy0xNy43MzQzNzUtMTcuNzMwNDY5LTQ2Ljc1LTE3LjczMDQ2OS02NC40ODQzNzUgMC0xNy43MzQzNzUgMTcuNzM0Mzc1LTE3LjczNDM3NSA0Ni43NTM5MDYgMCA2NC40ODgyODFsNTEuMjU3ODEzIDUxLjI1NzgxM2M3LjI1NzgxMi0zMS4zMTY0MDYgMjMuNTg1OTM3LTU5Ljg4NjcxOSA0Ni45ODgyODEtODEuOTgwNDY5em0wIDAiIGZpbGw9IiNiZGZhZmYiLz48cGF0aCBkPSJtMTgzLjE3NTc4MSAzOTMuMzA4NTk0IDUuODk4NDM4LTUuODk4NDM4Yy0xNy41MTE3MTktMzcuODYzMjgxLTIzLjY5MTQwNy03My42ODM1OTQtMjMuODcxMDk0LTEwNS4xMDE1NjJsLTQ2LjUxNTYyNSA0Ni41MTU2MjVjLTE3LjczMDQ2OSAxNy43MzQzNzUtMTcuNzMwNDY5IDQ2Ljc1MzkwNiAwIDY0LjQ4NDM3NSAxNy43MzQzNzUgMTcuNzM0Mzc1IDQ2Ljc1MzkwNiAxNy43MzQzNzUgNjQuNDg4MjgxIDB6bTAgMCIgZmlsbD0iI2NjZjhmZiIvPjwvc3ZnPgo=">
                    </a>
                </td>
                            </tr>
                    </tbody>
    </table>    
</div>  
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>

        <div class="row">
          <div class="col-md-3"> <br> 
                
            <div class="box box-info"   style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <form   method="post">
                <div class="box-header with-border"  >
                  <strong>Buscar curso:</strong>
                </div>
                <div class="box-body">
                  <!-- the events --> 
                  Sede <br> 
                  <select class="form-control select2" id="jornada_sede1" autofocus>
                    <option value="">Seleccione una sede</option>
                    <?php 
                    foreach ($jornada_sede as $key  ) { ?>

                      <option value="<?php echo($key['ID_JS'].",".$key['sede'].",".$key['jornada']) ?>">
                        <?php echo($key['sede']." ".$key['jornada']) ?>
                      </option> <?php
                     } ?>
                  </select> <br>
                   
                  Curso <br>
                  <select class="form-control" id="curso1" >
                  </select>  <br>

                  <button type="button" class="btn btn-block btn-info" onclick=" buscar()">buscar</button>
                </div>
              </form>
            </div>
            <br> 
                
        
          </div> 
          <div class="col-md-9">
            <br> 
            <div class="box box-primary"  id="col" style=" display: none; padding:4px;  background-color: #ffff;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
              <div id="_MSG2_"></div>
              <div id="tabla" class="row" > </div> 
            </div> 
          </div>
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
</body>

 
  

    
 
 
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

  

<script src="../../../js/jquery.loadingModal.js"></script>



<script src="../../../alert/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 

<link rel="stylesheet" href="../../../alert/node_modules/sweetalert2/dist/sweetalert2.min.css"></link>
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
  <script type="text/javascript">
     
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
    
    function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
    }
    //trae el curso se gun la sede
    $("#jornada_sede1").change(function() {
      mostrar(); 
      var jornada_sede2 = $('#jornada_sede1').val(); 
      let porcion1= jornada_sede2.split(",");
      let id_js=porcion1[0]; 
      $.ajax({
        type: "post",
        url: "../../../ajax/seles/seles.php?action=sacar_curso_observador_rector",
        data: {
          id_js
        },
        dataType: "text",
        success: function(data) {   

          $('body').loadingModal({text: 'Showing loader animations...'});
          var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
          var time = 0;
          delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
          .then(function() { $('body').loadingModal('destroy') ;} ); 
          $('#curso1').html(data);         
        }
      });

    });

 

    //trae el curso
    function buscar(){ 

      let curso1 = $('#curso1').val();
      let apellidos = $('#apellidos').val(); 
      let porcion_= curso1.split(" "); 
      let grado=porcion_[0]; 
      let curso=porcion_[1]; 
      
      let jornada_sede2 = $('#jornada_sede1').val();
      let porcion1= jornada_sede2.split(",");
      let sede=porcion1[1]; 
      let jornada=porcion1[2];
      let jornada_sede1=porcion1[0];

     
 
      if (curso != '') {
        mostrar();
        $.ajax({
          type: "post",
          url: "../../../ajax/rector/asistencia/asistencia.php?action=inasistencia",
          data: {
            jornada_sede1,curso,sede,jornada ,grado,apellidos
          },
          dataType: "text",
          success: function(data) {

            $('body').loadingModal({text: 'Showing loader animations...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 0;
            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} ); 
            $('#col').css('display', 'block');
            $('#tabla').html(data);
          }
        });
      }
    }

    function enviar(sele,id,valor){

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: '¿Estás seguro?',
        text: "¡Quieres actualizar el estado del estudiante!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Actualiselo!',
        cancelButtonText: 'No, cancelalo!',
        reverseButtons: true
      }).then((result) => {
                //si se confirma se elimina por medio de ajax
        if (result.isConfirmed) {


          $.ajax({
            type: "post",
          url: "../../../ajax/rector/observador/observador_alumno.php?action=actualizar_estado",
            data: {
              sele,id
            },
            dataType: "text",
            success: function(data) {   
              $('body').loadingModal({text: 'Showing loader animations...'});
              var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
              var time = 0;    
              delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
              .then(function() { $('body').loadingModal('destroy') ;} );  
              if (data==0) {
                Swal.fire({ 
                  icon: 'error',
                  title: 'Error en la actualización',
                  showConfirmButton: true, 
                });
                return;
              } 
              if (data==1) {
                Swal.fire({ 
                  icon: 'success',
                  title: 'Registro Actualizado',
                  showConfirmButton: true, 
                });
                return;
              }  
                                      
            }
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          document.getElementById('sele'+id).value=valor
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'Los datos no se han Actualizado :)',
            'error'
            )
        }
      })
    } 

    
    
    
  </script>




</body>

</html>
 