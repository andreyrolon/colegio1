<style>

.tr:hover {
    border:solid 2px #EEEE;
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

$nota=$chat->nivelacion($p);
$nota2=$chat->nivelacion2($p);
 
 
include('../enlaces/head.php');
 
?>

 <?php 
if(isset($_SESSION['fant'])){
  $sty=$_SESSION['fant'];
   
  }else{
    $sty='';
  } ?>
  

<body class="hold-transition skin-blue sidebar-mini"  >
 
    <div class="wrapper" class="form-control"  >
    <?php include('../enlaces/header.php');   ?>
        <div class="content-wrapper"  >  
            <div  >
                <div class="row" >
                <div class="col-md-12">


                    <button type="button" id='iss' style="background-color:transparent;border:0"  data-toggle="modal" data-target="#myModal"  > </button>
                    <div class="modal fade" id="myModal" role="dialog"        >
                        <div class="modal-dialog modal-lg"style=" background-color: #f39c12 ">
                            <div class="modal-content"style=" background-color: #f39c12 ">
                                <div class="modal-body" style="color: #fff"><button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Alerta</h4>
                                    <p id="ph"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                                            
                    <div id="tablaw" ></div>
                    <section class="content" >
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
                            <div class="col-md-9 " style="">
                                    <div id="_MSG2_"></div>
                                <div class="box box-primary bin" style=" height: 482px;
                                overflow: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                                           
                                         
                                    <div class="table table-hover" style="  padding: 10px">
                                        <table  class="table table-hover"  >
                                            <tr>
                                                <th style="width: 270px">AREAS</th>
                                                <th>NIVELACION</th> 
                                            </tr>

                                        </table>
                                        <?php  
                                        foreach ($nota as $value) {
                                            if ($value['area']!=1 or $value['codigo']==01) {
                                             
                                                ?>
                                                <input type="hidden" value="0" id="in<?php  echo $value['id_area'] ?>" name="">
                                                
                                                <table class=" table  table-hover">
                                                <tr class="tr">
                                                    
                                                 <td style="width: 270px"><?php  echo $value['nombre'] ?> </td>
                                                 <td > <a   onclick=" 
                                                 $('.area').hide();
                                                 var id= $('#in<?php  echo $value['id_area'] ?>').val();
                                                if (id==0) {
                                                    $('#in<?php  echo $value['id_area'] ?>').val(1); 
                                                    document.getElementById('tabla<?php  echo $value['id_area'] ?>').style.display='block';
                                                }else{

                                                    $('#in<?php  echo $value['id_area'] ?>').val(0); 
                                                    $('.area').hide();
                                                }
                                                "><img width="35" src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTAgNTEwIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMCA1MTAiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxsaW5lYXJHcmFkaWVudCBpZD0ibGcxIj48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiNmOWY3ZmMiLz48c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiNmMGRkZmMiLz48L2xpbmVhckdyYWRpZW50PjxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfMV8iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iMzkuNTQ2IiB4Mj0iNTE5LjUyNCIgeGxpbms6aHJlZj0iI2xnMSIgeTE9Ii0yNy45NDgiIHkyPSI1NDAuNTI2Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8yXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIzMTYuNDciIHgyPSItMTMuNTE0IiB5MT0iMjg0LjE5NiIgeTI9Ii0yMC4yODkiPjxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iI2U5ZWRmNSIgc3RvcC1vcGFjaXR5PSIwIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjZmZmIi8+PC9saW5lYXJHcmFkaWVudD48bGluZWFyR3JhZGllbnQgaWQ9ImxnMiI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjZjBkZGZjIiBzdG9wLW9wYWNpdHk9IjAiLz48c3RvcCBvZmZzZXQ9Ii4yODg5IiBzdG9wLWNvbG9yPSIjYzhiN2UwIiBzdG9wLW9wYWNpdHk9Ii4yODkiLz48c3RvcCBvZmZzZXQ9Ii41OTE1IiBzdG9wLWNvbG9yPSIjYTU5NWM4IiBzdG9wLW9wYWNpdHk9Ii41OTIiLz48c3RvcCBvZmZzZXQ9Ii44Mzk1IiBzdG9wLWNvbG9yPSIjOGY4MWI4IiBzdG9wLW9wYWNpdHk9Ii44NCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzg3NzliMyIvPjwvbGluZWFyR3JhZGllbnQ+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8zXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI0MDEuNjY5IiB4Mj0iMjQ1LjQwNSIgeGxpbms6aHJlZj0iI2xnMiIgeTE9IjYxOS41ODUiIHkyPSI0NjMuMzIyIi8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF80XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyMzEuNDkxIiB4Mj0iMjMxLjQ5MSIgeGxpbms6aHJlZj0iI2xnMSIgeTE9IjQzNi42OTMiIHkyPSI0ODguOTE3Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF81XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI0MzQuNTQ1IiB4Mj0iNDM2Ljk0NiIgeGxpbms6aHJlZj0iI2xnMSIgeTE9IjUwOS4xNDkiIHkyPSI1MTEuNTUiLz48bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzZfIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjM0NC4yMjIiIHgyPSIyNDguMjIyIiB4bGluazpocmVmPSIjbGcyIiB5MT0iMTMyLjczOSIgeTI9IjM5LjczOSIvPjxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfN18iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iNDE4LjExOSIgeDI9IjI2OC42MTkiIHhsaW5rOmhyZWY9IiNsZzIiIHkxPSIyMDIuMDE4IiB5Mj0iOTIuNTE4Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJsZzMiPjxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iI2ZmNzA0NCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iI2Y5MjgxNCIvPjwvbGluZWFyR3JhZGllbnQ+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF84XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIzMTYuOTg4IiB4Mj0iMzk4LjgxNiIgeGxpbms6aHJlZj0iI2xnMyIgeTE9IjEzNy4wNjQiIHkyPSIxMzcuMDY0Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF85XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyNTQuNzA4IiB4Mj0iNDQ1LjA4NiIgeGxpbms6aHJlZj0iI2xnMyIgeTE9Ijg0Ljc5NSIgeTI9IjE4NS4zMzEiLz48bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzEwXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI0NDkuNDg0IiB4Mj0iMzM3LjQ4NCIgeGxpbms6aHJlZj0iI2xnMiIgeTE9IjIzNi41NjQiIHkyPSIxMjEuNTYzIi8+PHBhdGggZD0ibTQzMi40NTUgNTA5Ljk5OGgtMzM3LjY5MnYtNDc2LjY2MmMwLTE4LjQxMSAxNC45MjUtMzMuMzM2IDMzLjMzNS0zMy4zMzZoMzE4LjQ0OWMxOC41MjcgMCAzMy41NDcgMTUuMDE5IDMzLjU0NyAzMy41NDd2NDI4LjgxMmMuMDAxIDI2LjMxLTIxLjMyOCA0Ny42MzktNDcuNjM5IDQ3LjYzOXoiIGZpbGw9InVybCgjU1ZHSURfMV8pIi8+PHBhdGggZD0ibTE0OS42ODYgMjEuNTg4Yy0xOC40MTEgMC0zMy4zMzYgMTQuOTI1LTMzLjMzNiAzMy4zMzZ2NDU1LjA3NWgzMTYuMTA1YzI2LjMxIDAgNDcuNjM5LTIxLjMyOSA0Ny42MzktNDcuNjM5di00MjguODEzYzAtMy42MDYtLjU3Ni03LjA3Ni0xLjYyOC0xMC4zMzEtMy4yNTUtMS4wNTMtNi43MjUtMS42MjgtMTAuMzMxLTEuNjI4eiIgZmlsbD0idXJsKCNTVkdJRF8yXykiLz48cGF0aCBkPSJtNDcwLjM1MiA0OTEuMjE3LTg2LjYyNS04Ni42MjVjLTEuODE4LTIuNzAyLTQuOTA0LTQuNDgtOC40MDUtNC40OGgtMjgwLjU1OXYxMDkuODg3aDMzNy42OTNjMTUuNDU5LS4wMDEgMjkuMTkzLTcuMzcgMzcuODk2LTE4Ljc4MnoiIGZpbGw9InVybCgjU1ZHSURfM18pIi8+PHBhdGggZD0ibTQzMy4wNzcgNTEwaC0zNTUuNTI2Yy0yNi4zMjMgMC00Ny42NDYtMjEuMzM3LTQ3LjY0Ni00Ny42NDZ2LTUyLjExOWMwLTUuNTkxIDQuNTMzLTEwLjEyNCAxMC4xMjQtMTAuMTI0aDMzNS4yOTJjNS41OTEgMCAxMC4xMjQgNC41MzMgMTAuMTI0IDEwLjEyNHY1Mi4xMTljLjAwMSAyNi4zMDkgMjEuMzIzIDQ3LjY0NiA0Ny42MzIgNDcuNjQ2eiIgZmlsbD0idXJsKCNTVkdJRF80XykiLz48cGF0aCBkPSJtNDM3LjUxMyA1MDkuNzk3di4yMDNoLTQuNDM2YzEuNDkzIDAgMi45NzItLjA3MiA0LjQzNi0uMjAzeiIgZmlsbD0idXJsKCNTVkdJRF81XykiLz48ZyBmaWxsPSIjYmVjM2QyIj48cGF0aCBkPSJtMjk5LjQ5NCAzNzRoLTE0My45M2MtMi4yMjkgMC00LjAzNS0xLjgwNy00LjAzNS00LjAzNXYtMTMuOTNjMC0yLjIyOSAxLjgwNy00LjAzNSA0LjAzNS00LjAzNWgxNDMuOTNjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI4LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1eiIvPjxwYXRoIGQ9Im0zNzAuNzQ2IDM3NGgtNDUuMTgyYy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDQ1LjE4MmMyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjgtMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTQxOS4yOTMgMzc0aC0yMy45MDVjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDctNC4wMzUgNC4wMzUtNC4wMzVoMjMuOTA1YzIuMjI5IDAgNC4wMzUgMS44MDcgNC4wMzUgNC4wMzV2MTMuOTNjMCAyLjIyOC0xLjgwNiA0LjAzNS00LjAzNSA0LjAzNXoiLz48cGF0aCBkPSJtMzcwLjQgMjQwLjI3MWgtMTQzLjkzYy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDE0My45M2MyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjktMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTIwMC43NDYgMjQwLjI3MWgtNDUuMTgyYy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDQ1LjE4MmMyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjktMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTQxOS4yOTMgMjQwLjI3MWgtMjMuOTA1Yy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDIzLjkwNWMyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjktMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTI3NS4zNjMgMTUxLjQwN2gxNDMuOTNjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0xNDMuOTNjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDctNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTIwNC4xMTEgMTUxLjQwN2g0NS4xODJjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC00NS4xODJjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTE1NS41NjQgMTUxLjQwN2gyMy45MDVjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0yMy45MDVjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTIwNC40NTcgMjg1LjEzNmgxNDMuOTNjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0xNDMuOTNjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTM3NC4xMTEgMjg1LjEzNmg0NS4xODJjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC00NS4xODJjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTE1NS41NjQgMjg1LjEzNmgyMy45MDVjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0yMy45MDVjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PC9nPjxwYXRoIGQ9Im00ODAuMDk1IDExMy4xNjYtNTEuNjc3LTUxLjY3NmMtMTkuNjU2LTIwLjk2NS00Ny41ODMtMzQuMDg4LTc4LjUyMS0zNC4wODgtNTkuMzY1IDAtMTA3LjY2MiA0OC4yOTYtMTA3LjY2MiAxMDcuNjYxIDAgMzAuOTM4IDEzLjEyMiA1OC44NjUgMzQuMDg3IDc4LjUyMWwyMDMuNzcyIDIwMy43NzJ2LTMwNC4xOXoiIGZpbGw9InVybCgjU1ZHSURfNl8pIi8+PHBhdGggZD0ibTQ4MC4wOTUgMTU5LjQ4NS04My4xNDUtODMuMTQ1Yy0uMDg2LS4xNTctLjE2Ny0uMzE3LS4yNTktLjQ3MS0xLjQxNy0yLjM2MS0zLjQ4NC0zLjU0Mi02LjE5OS0zLjU0MmgtNjEuNDZjLTMuMzA4IDAtNi4xNDEuNzM5LTguNTAxIDIuMjE0LTIuMzY0IDEuNDc4LTMuNTQzIDMuNTczLTMuNTQzIDYuMjg4djExMi40NzFjMCAyLjY4MiAxLjMyNiA0Ljc1NSAzLjk3NCA2LjIyN2wxNTkuMTMzIDE1OS4xMzN6IiBmaWxsPSJ1cmwoI1NWR0lEXzdfKSIvPjxwYXRoIGQ9Im0zMTYuOTg4IDE5My4yOTl2LTExMi40N2MwLTIuNzE1IDEuMTc5LTQuODEgMy41NDMtNi4yODggMi4zNjEtMS40NzUgNS4xOTQtMi4yMTQgOC41MDEtMi4yMTRoNjEuNDZjMi43MTUgMCA0Ljc4MiAxLjE4MiA2LjE5OSAzLjU0MiAxLjQxNyAyLjM2MyAyLjEyNSA1LjEzNiAyLjEyNSA4LjMyNCAwIDMuNDI2LS43MzggNi4zMTgtMi4yMTQgOC42NzktMS40NzggMi4zNjMtMy41MTUgMy41NDMtNi4xMTEgMy41NDNoLTQ1Ljg3NHYyOS45MzNoMjYuNzQ1YzIuNTk2IDAgNC42MzMgMS4wNjMgNi4xMTEgMy4xODggMS40NzUgMi4xMjUgMi4yMTQgNC42NjYgMi4yMTQgNy42MTYgMCAyLjcxOC0uNzA5IDUuMTM2LTIuMTI1IDcuMjYyLTEuNDE3IDIuMTI1LTMuNDg1IDMuMTg4LTYuMiAzLjE4OGgtMjYuNzQ1djQ1LjY5N2MwIDIuNzE4LTEuMzU5IDQuODEzLTQuMDc0IDYuMjg4LTIuNzE4IDEuNDc4LTUuOTY0IDIuMjE0LTkuNzQxIDIuMjE0LTMuNzgxIDAtNy4wMjctLjczNi05Ljc0MS0yLjIxNC0yLjcxOC0xLjQ3NS00LjA3My0zLjU3LTQuMDczLTYuMjg4eiIgZmlsbD0idXJsKCNTVkdJRF84XykiLz48cGF0aCBkPSJtMzQ5Ljg5NyAyNDIuNzI0Yy01OS4zNjUgMC0xMDcuNjYyLTQ4LjI5Ni0xMDcuNjYyLTEwNy42NjFzNDguMjk3LTEwNy42NjEgMTA3LjY2Mi0xMDcuNjYxIDEwNy42NjEgNDguMjk2IDEwNy42NjEgMTA3LjY2MS00OC4yOTYgMTA3LjY2MS0xMDcuNjYxIDEwNy42NjF6bTAtMjAwLjMyMmMtNTEuMDk0IDAtOTIuNjYyIDQxLjU2OC05Mi42NjIgOTIuNjYxczQxLjU2OCA5Mi42NjEgOTIuNjYyIDkyLjY2MSA5Mi42NjEtNDEuNTY4IDkyLjY2MS05Mi42NjEtNDEuNTY3LTkyLjY2MS05Mi42NjEtOTIuNjYxeiIgZmlsbD0idXJsKCNTVkdJRF85XykiLz48cGF0aCBkPSJtNDgwLjA5IDExMy4xN3YzMDQuMTlsLTIwMy43Ny0yMDMuNzhjMTkuMjYgMTguMDcgNDUuMTUgMjkuMTQgNzMuNTggMjkuMTQgNTkuMzYgMCAxMDcuNjYtNDguMjkgMTA3LjY2LTEwNy42NiAwLTI4LjM5LTExLjA1LTU0LjI2LTI5LjA4LTczLjUxeiIgZmlsbD0idXJsKCNTVkdJRF8xMF8pIi8+PC9zdmc+" /></a></td>
                                                
                                                </tr>
                                                </table>
                                                <div style="display: none;" class="area" id="tabla<?php  echo $value['id_area'] ?>">
                                                    <table class="table table-striped table-bordered">
                                                        <tr>
                                                            <th>Trabajo</th>
                                                            <th>Sustentacion</th>
                                                            <th>Recuperación Total</th>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $value['trabajo'] ?></td>
                                                            <td><?php echo $value['sustentacion'] ?></td>
                                                            <td><?php echo $value['recuperacion'] ?> </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <?php
                                            }
                                        } ?> <?php  
                                        foreach ($nota2 as $value) { 
                                             
                                            ?>
                                            
                                            
                                            <table class=" table  table-hover">
                                            <tr class="tr">
                                                
                                             <td style="width: 270px"><?php  echo $value['nombre'] ?> </td>
                                             <td > 
                                                <input type="hidden" value="0" id="in2<?php  echo $value['id_competrencia'] ?>" name="">
                                                <a  onclick=" 
                                                $('.area').hide();
                                                var id= $('#in2<?php  echo $value['id_competrencia'] ?>').val(); 
                                                if (id==0) { 
                                                    $('#in2<?php  echo $value['id_competrencia'] ?>').val(1); 
                                                    document.getElementById('tabla2<?php  echo $value['id_competrencia'] ?>').style.display='block';
                                                }else{ 
                                                    $('#in2<?php  echo $value['id_competrencia'] ?>').val(0); 
                                                    $('.area').hide();
                                                }
                                                "><img width="35" src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTAgNTEwIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMCA1MTAiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxsaW5lYXJHcmFkaWVudCBpZD0ibGcxIj48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiNmOWY3ZmMiLz48c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiNmMGRkZmMiLz48L2xpbmVhckdyYWRpZW50PjxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfMV8iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iMzkuNTQ2IiB4Mj0iNTE5LjUyNCIgeGxpbms6aHJlZj0iI2xnMSIgeTE9Ii0yNy45NDgiIHkyPSI1NDAuNTI2Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8yXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIzMTYuNDciIHgyPSItMTMuNTE0IiB5MT0iMjg0LjE5NiIgeTI9Ii0yMC4yODkiPjxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iI2U5ZWRmNSIgc3RvcC1vcGFjaXR5PSIwIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjZmZmIi8+PC9saW5lYXJHcmFkaWVudD48bGluZWFyR3JhZGllbnQgaWQ9ImxnMiI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjZjBkZGZjIiBzdG9wLW9wYWNpdHk9IjAiLz48c3RvcCBvZmZzZXQ9Ii4yODg5IiBzdG9wLWNvbG9yPSIjYzhiN2UwIiBzdG9wLW9wYWNpdHk9Ii4yODkiLz48c3RvcCBvZmZzZXQ9Ii41OTE1IiBzdG9wLWNvbG9yPSIjYTU5NWM4IiBzdG9wLW9wYWNpdHk9Ii41OTIiLz48c3RvcCBvZmZzZXQ9Ii44Mzk1IiBzdG9wLWNvbG9yPSIjOGY4MWI4IiBzdG9wLW9wYWNpdHk9Ii44NCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzg3NzliMyIvPjwvbGluZWFyR3JhZGllbnQ+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8zXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI0MDEuNjY5IiB4Mj0iMjQ1LjQwNSIgeGxpbms6aHJlZj0iI2xnMiIgeTE9IjYxOS41ODUiIHkyPSI0NjMuMzIyIi8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF80XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyMzEuNDkxIiB4Mj0iMjMxLjQ5MSIgeGxpbms6aHJlZj0iI2xnMSIgeTE9IjQzNi42OTMiIHkyPSI0ODguOTE3Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF81XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI0MzQuNTQ1IiB4Mj0iNDM2Ljk0NiIgeGxpbms6aHJlZj0iI2xnMSIgeTE9IjUwOS4xNDkiIHkyPSI1MTEuNTUiLz48bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzZfIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjM0NC4yMjIiIHgyPSIyNDguMjIyIiB4bGluazpocmVmPSIjbGcyIiB5MT0iMTMyLjczOSIgeTI9IjM5LjczOSIvPjxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfN18iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iNDE4LjExOSIgeDI9IjI2OC42MTkiIHhsaW5rOmhyZWY9IiNsZzIiIHkxPSIyMDIuMDE4IiB5Mj0iOTIuNTE4Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJsZzMiPjxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iI2ZmNzA0NCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iI2Y5MjgxNCIvPjwvbGluZWFyR3JhZGllbnQ+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF84XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIzMTYuOTg4IiB4Mj0iMzk4LjgxNiIgeGxpbms6aHJlZj0iI2xnMyIgeTE9IjEzNy4wNjQiIHkyPSIxMzcuMDY0Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF85XyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyNTQuNzA4IiB4Mj0iNDQ1LjA4NiIgeGxpbms6aHJlZj0iI2xnMyIgeTE9Ijg0Ljc5NSIgeTI9IjE4NS4zMzEiLz48bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzEwXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI0NDkuNDg0IiB4Mj0iMzM3LjQ4NCIgeGxpbms6aHJlZj0iI2xnMiIgeTE9IjIzNi41NjQiIHkyPSIxMjEuNTYzIi8+PHBhdGggZD0ibTQzMi40NTUgNTA5Ljk5OGgtMzM3LjY5MnYtNDc2LjY2MmMwLTE4LjQxMSAxNC45MjUtMzMuMzM2IDMzLjMzNS0zMy4zMzZoMzE4LjQ0OWMxOC41MjcgMCAzMy41NDcgMTUuMDE5IDMzLjU0NyAzMy41NDd2NDI4LjgxMmMuMDAxIDI2LjMxLTIxLjMyOCA0Ny42MzktNDcuNjM5IDQ3LjYzOXoiIGZpbGw9InVybCgjU1ZHSURfMV8pIi8+PHBhdGggZD0ibTE0OS42ODYgMjEuNTg4Yy0xOC40MTEgMC0zMy4zMzYgMTQuOTI1LTMzLjMzNiAzMy4zMzZ2NDU1LjA3NWgzMTYuMTA1YzI2LjMxIDAgNDcuNjM5LTIxLjMyOSA0Ny42MzktNDcuNjM5di00MjguODEzYzAtMy42MDYtLjU3Ni03LjA3Ni0xLjYyOC0xMC4zMzEtMy4yNTUtMS4wNTMtNi43MjUtMS42MjgtMTAuMzMxLTEuNjI4eiIgZmlsbD0idXJsKCNTVkdJRF8yXykiLz48cGF0aCBkPSJtNDcwLjM1MiA0OTEuMjE3LTg2LjYyNS04Ni42MjVjLTEuODE4LTIuNzAyLTQuOTA0LTQuNDgtOC40MDUtNC40OGgtMjgwLjU1OXYxMDkuODg3aDMzNy42OTNjMTUuNDU5LS4wMDEgMjkuMTkzLTcuMzcgMzcuODk2LTE4Ljc4MnoiIGZpbGw9InVybCgjU1ZHSURfM18pIi8+PHBhdGggZD0ibTQzMy4wNzcgNTEwaC0zNTUuNTI2Yy0yNi4zMjMgMC00Ny42NDYtMjEuMzM3LTQ3LjY0Ni00Ny42NDZ2LTUyLjExOWMwLTUuNTkxIDQuNTMzLTEwLjEyNCAxMC4xMjQtMTAuMTI0aDMzNS4yOTJjNS41OTEgMCAxMC4xMjQgNC41MzMgMTAuMTI0IDEwLjEyNHY1Mi4xMTljLjAwMSAyNi4zMDkgMjEuMzIzIDQ3LjY0NiA0Ny42MzIgNDcuNjQ2eiIgZmlsbD0idXJsKCNTVkdJRF80XykiLz48cGF0aCBkPSJtNDM3LjUxMyA1MDkuNzk3di4yMDNoLTQuNDM2YzEuNDkzIDAgMi45NzItLjA3MiA0LjQzNi0uMjAzeiIgZmlsbD0idXJsKCNTVkdJRF81XykiLz48ZyBmaWxsPSIjYmVjM2QyIj48cGF0aCBkPSJtMjk5LjQ5NCAzNzRoLTE0My45M2MtMi4yMjkgMC00LjAzNS0xLjgwNy00LjAzNS00LjAzNXYtMTMuOTNjMC0yLjIyOSAxLjgwNy00LjAzNSA0LjAzNS00LjAzNWgxNDMuOTNjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI4LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1eiIvPjxwYXRoIGQ9Im0zNzAuNzQ2IDM3NGgtNDUuMTgyYy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDQ1LjE4MmMyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjgtMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTQxOS4yOTMgMzc0aC0yMy45MDVjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDctNC4wMzUgNC4wMzUtNC4wMzVoMjMuOTA1YzIuMjI5IDAgNC4wMzUgMS44MDcgNC4wMzUgNC4wMzV2MTMuOTNjMCAyLjIyOC0xLjgwNiA0LjAzNS00LjAzNSA0LjAzNXoiLz48cGF0aCBkPSJtMzcwLjQgMjQwLjI3MWgtMTQzLjkzYy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDE0My45M2MyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjktMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTIwMC43NDYgMjQwLjI3MWgtNDUuMTgyYy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDQ1LjE4MmMyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjktMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTQxOS4yOTMgMjQwLjI3MWgtMjMuOTA1Yy0yLjIyOSAwLTQuMDM1LTEuODA3LTQuMDM1LTQuMDM1di0xMy45M2MwLTIuMjI5IDEuODA3LTQuMDM1IDQuMDM1LTQuMDM1aDIzLjkwNWMyLjIyOSAwIDQuMDM1IDEuODA3IDQuMDM1IDQuMDM1djEzLjkzYzAgMi4yMjktMS44MDYgNC4wMzUtNC4wMzUgNC4wMzV6Ii8+PHBhdGggZD0ibTI3NS4zNjMgMTUxLjQwN2gxNDMuOTNjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0xNDMuOTNjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDctNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTIwNC4xMTEgMTUxLjQwN2g0NS4xODJjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC00NS4xODJjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTE1NS41NjQgMTUxLjQwN2gyMy45MDVjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0yMy45MDVjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTIwNC40NTcgMjg1LjEzNmgxNDMuOTNjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0xNDMuOTNjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTM3NC4xMTEgMjg1LjEzNmg0NS4xODJjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC00NS4xODJjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PHBhdGggZD0ibTE1NS41NjQgMjg1LjEzNmgyMy45MDVjMi4yMjkgMCA0LjAzNSAxLjgwNyA0LjAzNSA0LjAzNXYxMy45M2MwIDIuMjI5LTEuODA3IDQuMDM1LTQuMDM1IDQuMDM1aC0yMy45MDVjLTIuMjI5IDAtNC4wMzUtMS44MDctNC4wMzUtNC4wMzV2LTEzLjkzYzAtMi4yMjkgMS44MDYtNC4wMzUgNC4wMzUtNC4wMzV6Ii8+PC9nPjxwYXRoIGQ9Im00ODAuMDk1IDExMy4xNjYtNTEuNjc3LTUxLjY3NmMtMTkuNjU2LTIwLjk2NS00Ny41ODMtMzQuMDg4LTc4LjUyMS0zNC4wODgtNTkuMzY1IDAtMTA3LjY2MiA0OC4yOTYtMTA3LjY2MiAxMDcuNjYxIDAgMzAuOTM4IDEzLjEyMiA1OC44NjUgMzQuMDg3IDc4LjUyMWwyMDMuNzcyIDIwMy43NzJ2LTMwNC4xOXoiIGZpbGw9InVybCgjU1ZHSURfNl8pIi8+PHBhdGggZD0ibTQ4MC4wOTUgMTU5LjQ4NS04My4xNDUtODMuMTQ1Yy0uMDg2LS4xNTctLjE2Ny0uMzE3LS4yNTktLjQ3MS0xLjQxNy0yLjM2MS0zLjQ4NC0zLjU0Mi02LjE5OS0zLjU0MmgtNjEuNDZjLTMuMzA4IDAtNi4xNDEuNzM5LTguNTAxIDIuMjE0LTIuMzY0IDEuNDc4LTMuNTQzIDMuNTczLTMuNTQzIDYuMjg4djExMi40NzFjMCAyLjY4MiAxLjMyNiA0Ljc1NSAzLjk3NCA2LjIyN2wxNTkuMTMzIDE1OS4xMzN6IiBmaWxsPSJ1cmwoI1NWR0lEXzdfKSIvPjxwYXRoIGQ9Im0zMTYuOTg4IDE5My4yOTl2LTExMi40N2MwLTIuNzE1IDEuMTc5LTQuODEgMy41NDMtNi4yODggMi4zNjEtMS40NzUgNS4xOTQtMi4yMTQgOC41MDEtMi4yMTRoNjEuNDZjMi43MTUgMCA0Ljc4MiAxLjE4MiA2LjE5OSAzLjU0MiAxLjQxNyAyLjM2MyAyLjEyNSA1LjEzNiAyLjEyNSA4LjMyNCAwIDMuNDI2LS43MzggNi4zMTgtMi4yMTQgOC42NzktMS40NzggMi4zNjMtMy41MTUgMy41NDMtNi4xMTEgMy41NDNoLTQ1Ljg3NHYyOS45MzNoMjYuNzQ1YzIuNTk2IDAgNC42MzMgMS4wNjMgNi4xMTEgMy4xODggMS40NzUgMi4xMjUgMi4yMTQgNC42NjYgMi4yMTQgNy42MTYgMCAyLjcxOC0uNzA5IDUuMTM2LTIuMTI1IDcuMjYyLTEuNDE3IDIuMTI1LTMuNDg1IDMuMTg4LTYuMiAzLjE4OGgtMjYuNzQ1djQ1LjY5N2MwIDIuNzE4LTEuMzU5IDQuODEzLTQuMDc0IDYuMjg4LTIuNzE4IDEuNDc4LTUuOTY0IDIuMjE0LTkuNzQxIDIuMjE0LTMuNzgxIDAtNy4wMjctLjczNi05Ljc0MS0yLjIxNC0yLjcxOC0xLjQ3NS00LjA3My0zLjU3LTQuMDczLTYuMjg4eiIgZmlsbD0idXJsKCNTVkdJRF84XykiLz48cGF0aCBkPSJtMzQ5Ljg5NyAyNDIuNzI0Yy01OS4zNjUgMC0xMDcuNjYyLTQ4LjI5Ni0xMDcuNjYyLTEwNy42NjFzNDguMjk3LTEwNy42NjEgMTA3LjY2Mi0xMDcuNjYxIDEwNy42NjEgNDguMjk2IDEwNy42NjEgMTA3LjY2MS00OC4yOTYgMTA3LjY2MS0xMDcuNjYxIDEwNy42NjF6bTAtMjAwLjMyMmMtNTEuMDk0IDAtOTIuNjYyIDQxLjU2OC05Mi42NjIgOTIuNjYxczQxLjU2OCA5Mi42NjEgOTIuNjYyIDkyLjY2MSA5Mi42NjEtNDEuNTY4IDkyLjY2MS05Mi42NjEtNDEuNTY3LTkyLjY2MS05Mi42NjEtOTIuNjYxeiIgZmlsbD0idXJsKCNTVkdJRF85XykiLz48cGF0aCBkPSJtNDgwLjA5IDExMy4xN3YzMDQuMTlsLTIwMy43Ny0yMDMuNzhjMTkuMjYgMTguMDcgNDUuMTUgMjkuMTQgNzMuNTggMjkuMTQgNTkuMzYgMCAxMDcuNjYtNDguMjkgMTA3LjY2LTEwNy42NiAwLTI4LjM5LTExLjA1LTU0LjI2LTI5LjA4LTczLjUxeiIgZmlsbD0idXJsKCNTVkdJRF8xMF8pIi8+PC9zdmc+" /></a></td>
                                            
                                            </tr>
                                            </table>
                                            <div style="display:none  ;" class="area" id="tabla2<?php  echo $value['id_competrencia'] ?>">
                                                    <table class="table table-striped table-bordered">
                                                        <tr>
                                                            <th>Trabajo</th>
                                                            <th>Sustentacion</th>
                                                            <th>Recuperación Total</th>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $value['trabajo'] ?></td>
                                                            <td><?php echo $value['sustentacion'] ?></td>
                                                            <td><?php echo $value['recuperacion'] ?> </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            <?php
                                             
                                        } ?>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1"></div>
                        </div>
                    </section>
                </div>
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
        window.location.assign('nivelaciones.php?p='+p);
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