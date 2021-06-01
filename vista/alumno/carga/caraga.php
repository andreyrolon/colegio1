<?php
session_start();
 
    if(!isset($_SESSION['Session2'])){
        header("location: ../../../login.php");
    }
include  "../../../codes/alumno/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);

        $p=$_SESSION['numero'];
 
    if (isset($_GET['p'])) {
        $p=$_GET['p'];
    }

$nota=$chat->notas($_SESSION['id_informe_academico'],$p); 
$nota_t=$chat->notas_t($_SESSION['id_informe_academico'],$p);
  
include('../enlaces/head.php');
 
 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  <style>

.tr:hover {
    border:solid 2px #DDD; 
}
#er2 {
    width: 123px;background-color: #fff;
    margin-left: 10PX;
    color: #dc3545;
    border: solid #dc3545 1px;
    padding: .375rem .75rem;
    background-color: transparent;
    border-radius: .25rem;
    margin-top: 5px;
}
#er1 {
    width: 123px;background-color: #fff;
    margin-left: 10PX;
    color: #343a40;
    border: solid #343a40 1px;
    padding: .375rem .75rem;
    background-color: transparent;
    border-radius: .25rem;
    margin-top: 5px;
}
#er3 {
    width: 123px;background-color: #fff;
    margin-left: 10PX;
    color: #28a745;
    border: solid #28a745 1px;
    padding: .375rem .75rem;
    background-color: transparent;
    border-radius: .25rem;
    margin-top: 5px;
}
#er2:hover{
    width: 123px;background-color: #dc3545;
    margin-left: 10PX;
    color: #fff; 
}
#er1:hover {
    width: 123px;background-color: #343a40;
    margin-left: 10PX;
    color: #fff; 
}
#er3:hover {
    width: 123px;background-color: #28a745; 
    color: #fff; 
}
    body::-webkit-scrollbar{
width: 0px;


    }
    .bin::-webkit-scrollbar{
width: 6px;


    }
    .bin::-webkit-scrollbar-thumb{
    border-radius: 5px;
    background-color: #3c8dbc;


    }
</style>

<body class="hold-transition skin-blue sidebar-mini" style="width: 100%;<?php echo $sty ?>">
 
    <div class="wrapper" class="form-control">
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper">  
            <div class="row">
                <div class="col-md-12">


                   
                                            
                    <div id="tablaw"></div>
                    <section class="content">
                        <div class="row"><div id="sapo"></div>
                            <div class="col-md-3">
                                 <div class="box box-info" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <div style="padding: 10px;">
                                    
                                        <strong>Sede:</strong>
                                        <input disabled style="margin-bottom: 10px" type="" class="form-control" value="<?php echo $_SESSION['sede']  ?>"  name="">  
                                        <strong>Jornada:</strong>
                                        <input disabled style="margin-bottom: 10px" type="" class="form-control" value="<?php echo $_SESSION['jornada']  ?>"  name="">  
                                        <strong>Curso:</strong>
                                        <input disabled style="margin-bottom: 10px" type="" class="form-control" value="<?php echo $_SESSION['grado'].' '.$_SESSION['curso']  ?>"  name="">

                                        <strong>Periodo:</strong>
                                        <select id="periodo" class="form-control" onchange=" tec()">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select> 
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div id="_MSG2_"></div>
                                <div class="box box-primary bin" style=" height: 482px;
                                overflow: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                                           
                                         
                                    <div class="table table-hover" style="  padding: 10px">
                                        <table  class="table table-hover"  >
                                            <tr>
                                                <th style="width: 270px">AREAS</th>
                                                <th>NOTAS</th>
                                                <th>LOGROS</th> 
                                            </tr>

                                        </table>
                                        <?php  
                                        foreach ($nota as $value) {
                                            if ($value['area']!=1 or $value['codigo']==01) {
                                             
                                                ?>
                                                <input type="hidden" value="0" id="in<?php  echo $value['id_materia_por_periodo'] ?>" name="">
                                                
                                                <table class=" table  table-hover ">
                                                <tr class="tr">
                                                    
                                                 <td style="width: 270px"><?php  echo $value['nombre'] ?> </td>
                                                 <td> <a  onclick="var id=<?php  echo $value['id_materia_por_periodo'] ?>; carga(id)"><img style="width: 35px" src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNTEyIDUxMiIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxnPjxnPjxnPjxnPjxnPjxnPjxnPjxnPjxnPjxjaXJjbGUgY3g9IjI1NiIgY3k9IjI1NiIgZmlsbD0iIzAwYzhjOCIgcj0iMjU2Ii8+PC9nPjwvZz48L2c+PC9nPjwvZz48L2c+PC9nPjwvZz48cGF0aCBkPSJtNTEyIDI1NmMwLTE0LjE0NS0xLjE0Ny0yOC4wMjItMy4zNTQtNDEuNTQzbC0xMjUuNTg3LTEyNS41ODgtMjU0LjExOCAzMzQuMjYyIDg1LjUxNSA4NS41MTVjMTMuNTIyIDIuMjA3IDI3LjM5OSAzLjM1NCA0MS41NDQgMy4zNTQgMTQxLjM4NSAwIDI1Ni0xMTQuNjE1IDI1Ni0yNTZ6IiBmaWxsPSIjMTNhYWFhIi8+PGc+PHBhdGggZD0ibTIwNy43NzIgODguODY5LTc4LjgzMSA3OC44MzF2MjU1LjQzMWgyNTQuMTE4di0zMzQuMjYyeiIgZmlsbD0iI2ZmZiIvPjwvZz48Zz48cGF0aCBkPSJtMjU2IDg4Ljg2OWgxMjcuMDU5djMzNC4yNjJoLTEyNy4wNTl6IiBmaWxsPSIjZTllZGY1Ii8+PC9nPjxnPjxwYXRoIGQ9Im0yMDcuNzcyIDE2Ny43di03OC44MzFsLTc4LjgzMSA3OC44MzF6IiBmaWxsPSIjZTllZGY1Ii8+PC9nPjxnPjxwYXRoIGQ9Im0xNjYuODc5IDMxMy42NjZoMTc4LjI0MnYzMGgtMTc4LjI0MnoiIGZpbGw9IiM5MTk2YWEiLz48L2c+PGc+PHBhdGggZD0ibTI1NiAzMTMuNjY2aDg5LjEyMXYzMGgtODkuMTIxeiIgZmlsbD0iIzcwNzc4OSIvPjwvZz48Zz48cGF0aCBkPSJtMTk4LjAwOSAzNTYuOTYyaDExNS45ODJ2MzBoLTExNS45ODJ6IiBmaWxsPSIjOTE5NmFhIi8+PC9nPjxnPjxwYXRoIGQ9Im0yNTYgMzU2Ljk2Mmg1Ny45OTF2MzBoLTU3Ljk5MXoiIGZpbGw9IiM3MDc3ODkiLz48L2c+PGc+PHBhdGggZD0ibTI4MC4wMTYgMjkwLjQ0NS00Ljc5NC0xMy45NDVoLTM4LjIwNGwtNC43OTQgMTMuOTQ1aC0yOC4zMjZsMzYuNDYxLTk2Ljg5MWgzMS4zNzdsMzYuNjA2IDk2Ljg5MXptLTI0LjAxNi03Mi4xOTYtMTIuMyAzNi40NjFoMjQuNjk1eiIgZmlsbD0iIzc1ODRmMiIvPjwvZz48Zz48cGF0aCBkPSJtMjU2IDIxOC4yNDkgMTIuMzk1IDM2LjQ2MWgtMTIuMzk1djIxLjc5aDE5LjIyM2w0Ljc5MyAxMy45NDVoMjguMzI3bC0zNi42MDctOTYuODkxaC0xNS43MzZ6IiBmaWxsPSIjNjA2YWVhIi8+PC9nPjxwYXRoIGQ9Im0zNTkuMjEgMTUzLjc1OWgtMjAuNjJ2LTIwLjYyaC0zMHYyMC42MmgtMjAuNjJ2MzBoMjAuNjJ2MjAuNjJoMzB2LTIwLjYyaDIwLjYyeiIgZmlsbD0iIzYwNmFlYSIvPjwvZz48L3N2Zz4=" /></a></td>
                                                 <td> <a  onclick="var id=<?php  echo $value['id_materia_por_periodo'] ?>; logro(id)"><img width="35" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="></a></td>
                                                </tr>
                                                </table>
                                                <div id="tabla<?php  echo $value['id_materia_por_periodo'] ?>"></div>
                                                <?php
                                            }
                                        } ?>
                                        <div id="tecnico"> <?php
 
                                            foreach ($nota_t as $value) {
                                                
                                             
                                                ?>
                                                <input type="hidden" value="0" id="in2<?php  echo $value['id_competencias'] ?>" name="">
                                                
                                                <table class=" table table-hover">
                                                <tr class="tr">
                                                 <td style="width: 270px"><?php  echo $value['nombre'] ?> </td>
                                                 <td> <a  onclick="var id=<?php  echo $value['id_competencias'] ?>; carga2(id)"><img style="width: 35px" src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNTEyIDUxMiIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxnPjxnPjxnPjxnPjxnPjxnPjxnPjxnPjxnPjxjaXJjbGUgY3g9IjI1NiIgY3k9IjI1NiIgZmlsbD0iIzAwYzhjOCIgcj0iMjU2Ii8+PC9nPjwvZz48L2c+PC9nPjwvZz48L2c+PC9nPjwvZz48cGF0aCBkPSJtNTEyIDI1NmMwLTE0LjE0NS0xLjE0Ny0yOC4wMjItMy4zNTQtNDEuNTQzbC0xMjUuNTg3LTEyNS41ODgtMjU0LjExOCAzMzQuMjYyIDg1LjUxNSA4NS41MTVjMTMuNTIyIDIuMjA3IDI3LjM5OSAzLjM1NCA0MS41NDQgMy4zNTQgMTQxLjM4NSAwIDI1Ni0xMTQuNjE1IDI1Ni0yNTZ6IiBmaWxsPSIjMTNhYWFhIi8+PGc+PHBhdGggZD0ibTIwNy43NzIgODguODY5LTc4LjgzMSA3OC44MzF2MjU1LjQzMWgyNTQuMTE4di0zMzQuMjYyeiIgZmlsbD0iI2ZmZiIvPjwvZz48Zz48cGF0aCBkPSJtMjU2IDg4Ljg2OWgxMjcuMDU5djMzNC4yNjJoLTEyNy4wNTl6IiBmaWxsPSIjZTllZGY1Ii8+PC9nPjxnPjxwYXRoIGQ9Im0yMDcuNzcyIDE2Ny43di03OC44MzFsLTc4LjgzMSA3OC44MzF6IiBmaWxsPSIjZTllZGY1Ii8+PC9nPjxnPjxwYXRoIGQ9Im0xNjYuODc5IDMxMy42NjZoMTc4LjI0MnYzMGgtMTc4LjI0MnoiIGZpbGw9IiM5MTk2YWEiLz48L2c+PGc+PHBhdGggZD0ibTI1NiAzMTMuNjY2aDg5LjEyMXYzMGgtODkuMTIxeiIgZmlsbD0iIzcwNzc4OSIvPjwvZz48Zz48cGF0aCBkPSJtMTk4LjAwOSAzNTYuOTYyaDExNS45ODJ2MzBoLTExNS45ODJ6IiBmaWxsPSIjOTE5NmFhIi8+PC9nPjxnPjxwYXRoIGQ9Im0yNTYgMzU2Ljk2Mmg1Ny45OTF2MzBoLTU3Ljk5MXoiIGZpbGw9IiM3MDc3ODkiLz48L2c+PGc+PHBhdGggZD0ibTI4MC4wMTYgMjkwLjQ0NS00Ljc5NC0xMy45NDVoLTM4LjIwNGwtNC43OTQgMTMuOTQ1aC0yOC4zMjZsMzYuNDYxLTk2Ljg5MWgzMS4zNzdsMzYuNjA2IDk2Ljg5MXptLTI0LjAxNi03Mi4xOTYtMTIuMyAzNi40NjFoMjQuNjk1eiIgZmlsbD0iIzc1ODRmMiIvPjwvZz48Zz48cGF0aCBkPSJtMjU2IDIxOC4yNDkgMTIuMzk1IDM2LjQ2MWgtMTIuMzk1djIxLjc5aDE5LjIyM2w0Ljc5MyAxMy45NDVoMjguMzI3bC0zNi42MDctOTYuODkxaC0xNS43MzZ6IiBmaWxsPSIjNjA2YWVhIi8+PC9nPjxwYXRoIGQ9Im0zNTkuMjEgMTUzLjc1OWgtMjAuNjJ2LTIwLjYyaC0zMHYyMC42MmgtMjAuNjJ2MzBoMjAuNjJ2MjAuNjJoMzB2LTIwLjYyaDIwLjYyeiIgZmlsbD0iIzYwNmFlYSIvPjwvZz48L3N2Zz4=" /></a></td>
                                                 <td> <a   onclick="var id=<?php  echo $value['id_competencias'] ?>; logro2(id)"><img width="35" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojM0E5OUQ3OyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMjU2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyNjgyQkY7IiBkPSJNNTExLjE3NiwyNzguNDE5QzQ5OS44MDIsNDA5LjMwNCwzOTAuMDE3LDUxMiwyNTYuMTY1LDUxMmMtMy4xMzIsMC02LjI2NCwwLTkuMzk2LTAuMTY1ICBMMTI1LjYxLDM5MC42NzZsMjE5LjczNS0yNzguMDg5TDUxMS4xNzYsMjc4LjQxOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRDYzMDsiIGQ9Ik0xMzYuOTg0LDEwNi45ODJjNjguOTA0LDAsMTI1LjI4LDAsMTk0LjY3OCwwYzEwLjU1LDAsMTkuMTIyLDguNTcyLDE5LjEyMiwxOS4xMjJ2MTE0LjA3MXYyNy4wMzQgIHY5NS45Mzh2OC4yNDJjMCwxMi44NTgtMTAuMzg1LDIzLjI0My0yMy4yNDMsMjMuMjQzSDEzNi45ODRjLTEwLjU1LDAtMTkuMTIyLTguNTcyLTE5LjEyMi0xOS4xMjJWMTI2LjEwNCAgQzExNy44NjIsMTE1LjU1NCwxMjYuNDM1LDEwNi45ODIsMTM2Ljk4NCwxMDYuOTgyeiIvPgo8cmVjdCB4PSIxMzAuMjIyIiB5PSIxMTguMTkxIiBzdHlsZT0iZmlsbDojRjdGN0Y4OyIgd2lkdGg9IjIwOC4xOTUiIGhlaWdodD0iMjY1LjA2OSIvPgo8Zz4KCTxjaXJjbGUgc3R5bGU9ImZpbGw6I0U4NEY0RjsiIGN4PSIzNjkuNzM3IiBjeT0iMzMyLjQ5MiIgcj0iNjUuNjEyIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTE0Ny4yMDQsMTM5Ljk1MWgyNi44Njl2MzAuOTloLTI2Ljg2OVYxMzkuOTUxeiBNMTQ3LjIwNCwzMDYuNDQyaDI2Ljg2OXYzMC45OWgtMjYuODY5VjMwNi40NDJ6ICAgIE0xNDcuMjA0LDI1MC44OWgyNi44Njl2MzAuOTloLTI2Ljg2OVYyNTAuODl6IE0xNDcuMjA0LDE5NS4zMzhoMjYuODY5djMwLjk5aC0yNi44NjlWMTk1LjMzOHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOTk5OTk5OyIgZD0iTTE4Ni43NjYsMTUxLjMyNWg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDE1MS4zMjVMMTg2Ljc2NiwxNTEuMzI1eiBNMTg2Ljc2NiwzMTcuODE2aDkxLjgxNyAgdjguMDc4aC05MS44MTdMMTg2Ljc2NiwzMTcuODE2TDE4Ni43NjYsMzE3LjgxNnogTTE4Ni43NjYsMjYyLjI2NGg5MS44MTd2OC4wNzhoLTkxLjgxN0wxODYuNzY2LDI2Mi4yNjRMMTg2Ljc2NiwyNjIuMjY0eiAgIE0xODYuNzY2LDIwNi43MTJoOTEuODE3djguMDc4aC05MS44MTdMMTg2Ljc2NiwyMDYuNzEyTDE4Ni43NjYsMjA2LjcxMnoiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZENjMwOyIgY3g9IjM2OS43MzciIGN5PSIzMzIuNDkyIiByPSI1NS4zOTIiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMjIuOTI2LDMzNC4zbDE3LjYzOS0xLjk3OGwxOS4xMjIsMTYuOTc5YzAsMCw5LjIzMi0zOC41NzMsNTIuNDItNDcuNjQgIGMtMjEuMSwxMS4zNzQtMzQuMTIyLDMzLjk1OC00Mi44NTksNjUuMTEzYy0yLjE0Myw3LjkxMi03LjkxMiw1Ljc2OS05LjcyNiwzLjQ2MWMtMi45NjctMy43OTItMjIuNzQ4LTI2LjM3NS0zNi41OTUtMzYuMTAxVjMzNC4zeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTg0RjRGOyIgZD0iTTIxNS45NDMsOTAuODI4aDIuOTY3Yy0wLjgyNC0xLjMxOC0xLjMxOC0yLjk2Ny0xLjMxOC00LjYxNXYtOS44OTFjMC01LjQ0LDQuOTQ2LTkuODksMTEuMDQ0LTkuODkgIGgxMS4zNzRjNi4wOTksMCwxMS4wNDQsNC40NTEsMTEuMDQ0LDkuODl2OS44OWMwLDEuNjQ5LTAuNDk0LDMuMTMyLTEuMzE5LDQuNjE1aDIuOTY3YzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDAgIEgxNzkuMDE5bDAsMGMwLTE4LjI5NywxNi42NDktMzMuMTMzLDM2Ljc1OS0zMy4xMzNoMC4xNjVWOTAuODI4eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojQzk0NTQ1OyIgZD0iTTIzNC40MDYsNjYuNDMxaDUuNzY5YzYuMDk5LDAsMTEuMDQ0LDQuNDUxLDExLjA0NCw5Ljg5djkuODljMCwxLjY0OS0wLjQ5NCwzLjEzMi0xLjMxOSw0LjYxNWgyLjk2NyAgYzIwLjI3NiwwLDM2Ljc1OSwxNS4wMDEsMzYuNzU5LDMzLjEzM2wwLDBoLTU1LjIyMkwyMzQuNDA2LDY2LjQzMUwyMzQuNDA2LDY2LjQzMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="></a></td>
                                                </tr>
                                                </table>
                                                <div id="tabla2<?php  echo $value['id_competencias'] ?>"></div>
                                                <?php                                            
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1"></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="hidden" value="" id="visi">
        <input type="hidden" value="" id="visi2">
        <footer class="main-footer"  style="">
            <div class="pull-right hidden-xs">
                <b> IBUnotas</b> 1.0
            </div>
            <strong>Desarrollado por  IBUsoft. </strong> 
        </footer>
    </div>
     <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 
<script src="../../../js/jquery.loadingModal.js"></script>



<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 




<script src="../../../bower_components/select2/dist/js/select2.min.js"></script>
    <script>
 
    document.getElementById('periodo').value=<?php echo $p; ?>;
   function mostrar(){
      $('body').loadingModal({text: 'Cargando...'});

      var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };


    }
    function tec(){

        var p=document.getElementById('periodo').value; 
        window.location.assign('caraga.php?p='+p);
    }
    function carga(id){
        var p=document.getElementById('periodo').value; 
        mostrar();
        var bi=document.getElementById('in'+id).value;
        var i=<?php echo $_SESSION['id_informe_academico'] ?>;
        var ino=document.getElementById('visi').value;
        $('#tabla'+ino).html('');
        if(bi==0){  
            document.getElementById('in'+id).value=1;
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/perfil.php?action=carga",
                data: {
                    id,p,i
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  
                    $('#tabla'+id).html(data);
                    document.getElementById('visi').value=id;
                }
            });
        }else{ 

                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  

        var ino=document.getElementById('visi').value;
        $('#tabla'+ino).html('');
            document.getElementById('in'+id).value=0;
            $('#tabla'+id).html('');
        }
    }
    function logro(id){
        var p=document.getElementById('periodo').value; 
        mostrar();
        var bi=document.getElementById('in'+id).value;
        var i=<?php echo $_SESSION['id_informe_academico'] ?>;
        var ino=document.getElementById('visi').value;
        $('#tabla'+ino).html('');
        if(bi==0){ 
            document.getElementById('in'+id).value=1;
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/perfil.php?action=logro",
                data: {
                    id,p,i
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  
                    $('#tabla'+id).html(data);
                    document.getElementById('visi').value=id;
                }
            });
        }else{ 

                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  

        var ino=document.getElementById('visi').value;
        $('#tabla'+ino).html('');
            document.getElementById('in'+id).value=0;
            $('#tabla'+id).html('');
        }
    }
    function carga2(id){
        var p=document.getElementById('periodo').value; 
        mostrar();
        var bi=document.getElementById('in2'+id).value;
        var i=<?php echo $_SESSION['id_informe_academico'] ?>;
        var ino=document.getElementById('visi2').value;
        $('#tabla2'+ino).html('');
        if(bi==0){ 
            document.getElementById('in2'+id).value=1;
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/perfil.php?action=carga2",
                data: {
                    id,p,i
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  
                    $('#tabla2'+id).html(data);
                    document.getElementById('visi2').value=id;
                }
            });
        }else{ 

                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  

        var ino=document.getElementById('visi2').value;
        $('#tabla2'+ino).html('');
            document.getElementById('in2'+id).value=0;
            $('#tabla2'+id).html('');
        }
    }
    function logro2(id){
        var p=document.getElementById('periodo').value; 
        mostrar();
        var bi=document.getElementById('in2'+id).value;
        var i=<?php echo $_SESSION['id_informe_academico'] ?>;
        var ino=document.getElementById('visi2').value;
        $('#tabla2'+ino).html('');
        if(bi==0){ 
            document.getElementById('in2'+id).value=1;
            $.ajax({
                type: "post",
                url: "../../../ajax/alumno/perfil.php?action=logro2",
                data: {
                    id,p,i
                },
                dataType: "text",
                success: function(data) {
                    $('body').loadingModal({text: 'Showing loader animations...'});

                    var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                    var time = 0;
                    delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                    .then(function() { $('body').loadingModal('destroy') ;} );  
                    $('#tabla2'+id).html(data);
                    document.getElementById('visi2').value=id;
                }
            });
        }else{ 

            $('body').loadingModal({text: 'Showing loader animations...'});

            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
            var time = 0;
            delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
            .then(function() { $('body').loadingModal('destroy') ;} );  

            var ino=document.getElementById('visi2').value;
            $('#tabla2'+ino).html('');
            document.getElementById('in2'+id).value=0;
            $('#tabla2'+id).html('');
        }
    }
 

    </script> 
</body> 