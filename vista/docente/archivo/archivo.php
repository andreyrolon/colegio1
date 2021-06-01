  
                                  <?php
  session_start();

require_once "../../../codes/docente/chat.php";
$chat=new chat();
$perfil=$chat->perfil_($_SESSION['Id_Doc']);
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../index.html"); echo($_SESSION['Session']);
    }
include "../../../codes/docente/foro.php";
$foro=new foro();
include('../enlaces/head.php');
$vaqr='hacer';
 $dat=$foro->jornada_sede($_SESSION['Id_Doc'],$vaqr);

 
?>
<style>
 .lop{   
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
  }
.box-tools{
    color: #bfbfbf;
    display: block; 
}

li>a:hover {
    color: #000;
    background: #f7f7f7; cursor: pointer;
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
    border-bottom-color: transparent;cursor: pointer;
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




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <?php 
include('../enlaces/header.php'); ?>
    <div class="wrapper ">
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
 
                    <div class="modal fade in" id="my" style="background-color: rgba(3, 64, 95, 0.3)" >
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><a target="_blank"   onclick=' 
                                    var link=document.getElementById("tito").value;
                                    var likn2="../../../guias/"+link;
                                    location.href = likn2;
                                    '  style="text-decoration: none;color:#fff"><strong style="font-size: 24px">Descargue aquí </strong> 
                                        <img style="width: 45px;margin-left: 0px;margin-top: 17px"  src="data:image/svg+xml;base64,
                                        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDMgNTEyLjAwMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMyA1MTIuMDAzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPGc+CgkJPGc+CgkJCTxwYXRoIGQ9Ik0xMzYuNTMzLDI0Ny41OTZjMC00LjcxLTMuODIzLTguNTMzLTguNTMzLTguNTMzYy02MS4xNjcsMC0xMTAuOTMzLTQ5Ljc2Ni0xMTAuOTMzLTExMC45MzMgICAgIEMxNy4wNjcsNjYuOTYyLDY2LjgzMywxNy4xOTYsMTI4LDE3LjE5NnMxMTAuOTMzLDQ5Ljc2NiwxMTAuOTMzLDExMC45MzNjMCwxNi45MDQtMy43MDMsMzMuMTM1LTExLjAwOCw0OC4yMyAgICAgYy0yLjA0OCw0LjI0MS0wLjI3Myw5LjM0NCwzLjk2OCwxMS40MDFjNC4yNSwyLjA1Nyw5LjM0NCwwLjI4MiwxMS40MDEtMy45NjhDMjUxLjcyNSwxNjYuMzU5LDI1NiwxNDcuNjM3LDI1NiwxMjguMTI5ICAgICBjMC03MC41NzktNTcuNDIxLTEyOC0xMjgtMTI4UzAsNTcuNTUsMCwxMjguMTI5czU3LjQyMSwxMjgsMTI4LDEyOEMxMzIuNzEsMjU2LjEyOSwxMzYuNTMzLDI1Mi4zMDcsMTM2LjUzMywyNDcuNTk2eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkZGRkZGIiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJCQk8cGF0aCBkPSJNNTExLjM2OSw0MDcuNzU4Yy04LjQ5MS0yMC43ODctMTAuNDAyLTM1Ljk3Ny0xMi4yNTQtNTAuNjYyYy0yLjUxNy0yMC4wMDItNS4xMjktNDAuNjc4LTIzLjc5MS03Mi40NjVsLTUwLjg4NC04Ni42MzkgICAgIGMtOC4zOC0xNC4yNjgtMjkuMTc1LTE5Ljc3Mi00My42NDgtMTEuNTU0Yy00LjU5MSwyLjU5NC04LjQ0LDYuNDE3LTExLjIwNCwxMC45ODJjLTExLjg1My0xNS44MzgtMzQuMjEtMjAuNzUzLTUxLjktMTAuNzA5ICAgICBjLTguMjQzLDQuNjc2LTE0LjM4NywxMS45MTMtMTcuNTg3LDIwLjYyNWMtMTIuNDA3LTkuNjA5LTMwLjAyLTExLjM5Mi00NC40ODQtMy4xNzRjLTguMjk0LDQuNzEtMTQuNDY0LDEyLjAxNS0xNy42MzgsMjAuODA0ICAgICBsLTc0LjUyMi0xMDEuOTMxYy0xNC4xODItMTkuNjc4LTMyLjkxMy0yNS42MDktNTAuMDgyLTE1Ljg1NWMtOC41MTYsNC44My0xNC4yOTMsMTIuMTA5LTE2LjcsMjEuMDYgICAgIGMtMi42NjIsOS45NDEtMC44NzksMjAuOTY2LDUuMTk3LDMxLjMxN2wxMTYuMzc4LDE4Mi43NzVjMi41MzQsMy45NzcsNy44MDgsNS4xNTQsMTEuNzg1LDIuNjIgICAgIGMzLjk3Ny0yLjUzNCw1LjE0Ni03LjgwOCwyLjYyLTExLjc4NEwxMTYuNDM3LDE1MC42NTdjLTMuNTg0LTYuMTEtNC43NTMtMTIuNTAxLTMuMjc3LTE3Ljk4OCAgICAgYzEuMjAzLTQuNTA2LDQuMTEzLTguMDgxLDguNjM2LTEwLjY0MWM5LjM1My01LjMyNSwxOC43MjItMS42MywyNy44NTMsMTEuMDQybDkxLjgzNiwxMjUuNjExICAgICBjMi42OCwzLjY2OSw3Ljc3NCw0LjU5MSwxMS41NzEsMi4wOTFjMy43OTctMi40OTIsNC45NzUtNy41MjYsMi42NzEtMTEuNDUyYy0yLjk4Ny01LjA5NC0zLjc5Ny0xMS4wMjUtMi4yNzgtMTYuNyAgICAgYzEuNTQ1LTUuNzc3LDUuMzA4LTEwLjYxNSwxMC41OS0xMy42MTljMTAuOTMxLTYuMTg3LDI0LjkyNi0yLjUyNiwzMS4yMDYsOC4xNjZsNy44MjUsMTMuMzM4ICAgICBjMi4zODEsNC4wNyw3LjYwMyw1LjQxOSwxMS42ODIsMy4wMzhjNC4wNjItMi4zODEsNS40MjctNy42MTIsMy4wMzgtMTEuNjc0bC0wLjAwOS0wLjAxN2MtMi45ODctNS4wODYtMy43OTctMTEuMDE3LTIuMjctMTYuNjkxICAgICBjMS41NDUtNS43NzcsNS4zMDgtMTAuNjA3LDEwLjU5OC0xMy42MTFjMTAuOTE0LTYuMjEyLDI0LjktMi41MzQsMzEuMTg5LDguMTc1bDExLjc0MiwxOS45ODUgICAgIGMyLjM5OCw0LjA3LDcuNjIsNS40MjcsMTEuNjgyLDMuMDM4YzQuMDYyLTIuMzg5LDUuNDE5LTcuNjEyLDMuMDM4LTExLjY3NGwtMC4wMTctMC4wMjZjLTEuODQzLTMuMTQ5LTIuMjg3LTYuOTcyLTEuMjcxLTEwLjc3OCAgICAgYzEuMDMzLTMuODc0LDMuNDktNy4xNTEsNi43NDEtOC45OTRjNi40NDMtMy42NTIsMTYuODAyLTAuOTY0LDIwLjUxNCw1LjM1bDUwLjg3Niw4Ni42NDcgICAgIGMxNi44OTYsMjguNzU3LDE5LjA2Myw0NS45OTUsMjEuNTgxLDY1Ljk1NGMxLjc3NSwxNC4xMjMsMy42MSwyOC42ODEsMTAuNjY3LDQ3Ljk2NmwtMTUwLjQwOSw4NS4zNzYgICAgIGMtNTUuNDQxLTU4LjYxNS0xNTguNzg4LTExMi42OTEtMjEwLjc4Mi0xMjYuMzc5Yy05LjI0Mi0yLjQ0MS0yNS44OS03LjY2My0yOC45ODgtOC42MjdsMS4yNTQtNC4zNTIgICAgIGMzLjI2OC0xMS45OTgsMjkuMjI3LTI2LjY1OCw0MS40OTgtMjMuNDY3bDM2Ljg3Myw5LjcxOWM0LjU4MiwxLjE5NSw5LjIyNS0xLjUxOSwxMC40MjgtNi4wNzYgICAgIGMxLjIwMy00LjU1Ny0xLjUxOS05LjIyNS02LjA3Ni0xMC40MTlsLTM2Ljg4MS05LjcyOGMtMjEuMTU0LTUuNTQ3LTU2LjY0NCwxNC42NzctNjIuMjc2LDM1LjM2MmwtMS4zOTksNC44MzggICAgIGMtMC4wODUsMC4yOTktMC4xNTQsMC42MTQtMC4yMTMsMC45MjJjLTEuNDM0LDguNDIyLDIuMTE2LDE1LjQyLDkuNTE1LDE4LjczMWMwLjI5LDAuMTI4LDAuNTk3LDAuMjM5LDAuODk2LDAuMzQxICAgICBjMC44MjgsMC4yNTYsMjAuMjU4LDYuNDE3LDMxLjAxOSw5LjI1OWM1MS40MywxMy41NDIsMTU1LjA4NSw2OC4xNTYsMjA3LjA4NywxMjYuMzM2YzEuNjY0LDEuODYsNC4wMDIsMi44NDIsNi4zNjYsMi44NDIgICAgIGMxLjQ0MiwwLDIuODg0LTAuMzU4LDQuMjA3LTEuMTA5bDE2Mi43MTQtOTIuMzU2QzUxMS40MTEsNDE2LjI5Miw1MTIuOTksNDExLjcyNiw1MTEuMzY5LDQwNy43NTh6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0xMjgsNjguMzk2YzMyLjkzOSwwLDU5LjczMywyNi43OTUsNTkuNzMzLDU5LjczM2MwLDQuNzEsMy44MjMsOC41MzMsOC41MzMsOC41MzNzOC41MzMtMy44MjMsOC41MzMtOC41MzMgICAgIGMwLTQyLjM0Mi0zNC40NTgtNzYuOC03Ni44LTc2LjhzLTc2LjgsMzQuNDU4LTc2LjgsNzYuOGMwLDI3LjQ0MywxNC43OTcsNTIuOTc1LDM4LjYyMiw2Ni42NDUgICAgIGMxLjM0LDAuNzY4LDIuNzk5LDEuMTM1LDQuMjMyLDEuMTM1YzIuOTYxLDAsNS44MzctMS41MzYsNy40MTUtNC4yOTJjMi4zNDctNC4wODcsMC45My05LjMwMS0zLjE1Ny0xMS42MzkgICAgIGMtMTguNTM0LTEwLjYzMy0zMC4wNDYtMzAuNTA3LTMwLjA0Ni01MS44NDlDNjguMjY3LDk1LjE5MSw5NS4wNjEsNjguMzk2LDEyOCw2OC4zOTZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJPC9nPgoJPC9nPgo8L2c+PC9nPiA8L3N2Zz4=" /></a></h4>
                                </div>
                                    <input type="hidden" id="tito" name="">
                                <div class="modal-body table-responsive" id="pdf">
                                    

                                </div>
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade in" id="my2" style="background-color: rgba(3, 64, 95, 0.3)" >
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary table-responsive">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><a target="_blank"   onclick=' 
                                    var link=document.getElementById("tito2").value;
                                    var likn2="../../../guias/"+link;
                                    location.href = likn2;
                                    '  style="text-decoration: none;color:#fff"><strong style="font-size: 24px">Descargue aquí </strong> 
                                        <img style="width: 45px;margin-left: 0px;margin-top: 17px"  src="data:image/svg+xml;base64,
                                        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDMgNTEyLjAwMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMyA1MTIuMDAzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPGc+CgkJPGc+CgkJCTxwYXRoIGQ9Ik0xMzYuNTMzLDI0Ny41OTZjMC00LjcxLTMuODIzLTguNTMzLTguNTMzLTguNTMzYy02MS4xNjcsMC0xMTAuOTMzLTQ5Ljc2Ni0xMTAuOTMzLTExMC45MzMgICAgIEMxNy4wNjcsNjYuOTYyLDY2LjgzMywxNy4xOTYsMTI4LDE3LjE5NnMxMTAuOTMzLDQ5Ljc2NiwxMTAuOTMzLDExMC45MzNjMCwxNi45MDQtMy43MDMsMzMuMTM1LTExLjAwOCw0OC4yMyAgICAgYy0yLjA0OCw0LjI0MS0wLjI3Myw5LjM0NCwzLjk2OCwxMS40MDFjNC4yNSwyLjA1Nyw5LjM0NCwwLjI4MiwxMS40MDEtMy45NjhDMjUxLjcyNSwxNjYuMzU5LDI1NiwxNDcuNjM3LDI1NiwxMjguMTI5ICAgICBjMC03MC41NzktNTcuNDIxLTEyOC0xMjgtMTI4UzAsNTcuNTUsMCwxMjguMTI5czU3LjQyMSwxMjgsMTI4LDEyOEMxMzIuNzEsMjU2LjEyOSwxMzYuNTMzLDI1Mi4zMDcsMTM2LjUzMywyNDcuNTk2eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRkZGRkZGIiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJCQk8cGF0aCBkPSJNNTExLjM2OSw0MDcuNzU4Yy04LjQ5MS0yMC43ODctMTAuNDAyLTM1Ljk3Ny0xMi4yNTQtNTAuNjYyYy0yLjUxNy0yMC4wMDItNS4xMjktNDAuNjc4LTIzLjc5MS03Mi40NjVsLTUwLjg4NC04Ni42MzkgICAgIGMtOC4zOC0xNC4yNjgtMjkuMTc1LTE5Ljc3Mi00My42NDgtMTEuNTU0Yy00LjU5MSwyLjU5NC04LjQ0LDYuNDE3LTExLjIwNCwxMC45ODJjLTExLjg1My0xNS44MzgtMzQuMjEtMjAuNzUzLTUxLjktMTAuNzA5ICAgICBjLTguMjQzLDQuNjc2LTE0LjM4NywxMS45MTMtMTcuNTg3LDIwLjYyNWMtMTIuNDA3LTkuNjA5LTMwLjAyLTExLjM5Mi00NC40ODQtMy4xNzRjLTguMjk0LDQuNzEtMTQuNDY0LDEyLjAxNS0xNy42MzgsMjAuODA0ICAgICBsLTc0LjUyMi0xMDEuOTMxYy0xNC4xODItMTkuNjc4LTMyLjkxMy0yNS42MDktNTAuMDgyLTE1Ljg1NWMtOC41MTYsNC44My0xNC4yOTMsMTIuMTA5LTE2LjcsMjEuMDYgICAgIGMtMi42NjIsOS45NDEtMC44NzksMjAuOTY2LDUuMTk3LDMxLjMxN2wxMTYuMzc4LDE4Mi43NzVjMi41MzQsMy45NzcsNy44MDgsNS4xNTQsMTEuNzg1LDIuNjIgICAgIGMzLjk3Ny0yLjUzNCw1LjE0Ni03LjgwOCwyLjYyLTExLjc4NEwxMTYuNDM3LDE1MC42NTdjLTMuNTg0LTYuMTEtNC43NTMtMTIuNTAxLTMuMjc3LTE3Ljk4OCAgICAgYzEuMjAzLTQuNTA2LDQuMTEzLTguMDgxLDguNjM2LTEwLjY0MWM5LjM1My01LjMyNSwxOC43MjItMS42MywyNy44NTMsMTEuMDQybDkxLjgzNiwxMjUuNjExICAgICBjMi42OCwzLjY2OSw3Ljc3NCw0LjU5MSwxMS41NzEsMi4wOTFjMy43OTctMi40OTIsNC45NzUtNy41MjYsMi42NzEtMTEuNDUyYy0yLjk4Ny01LjA5NC0zLjc5Ny0xMS4wMjUtMi4yNzgtMTYuNyAgICAgYzEuNTQ1LTUuNzc3LDUuMzA4LTEwLjYxNSwxMC41OS0xMy42MTljMTAuOTMxLTYuMTg3LDI0LjkyNi0yLjUyNiwzMS4yMDYsOC4xNjZsNy44MjUsMTMuMzM4ICAgICBjMi4zODEsNC4wNyw3LjYwMyw1LjQxOSwxMS42ODIsMy4wMzhjNC4wNjItMi4zODEsNS40MjctNy42MTIsMy4wMzgtMTEuNjc0bC0wLjAwOS0wLjAxN2MtMi45ODctNS4wODYtMy43OTctMTEuMDE3LTIuMjctMTYuNjkxICAgICBjMS41NDUtNS43NzcsNS4zMDgtMTAuNjA3LDEwLjU5OC0xMy42MTFjMTAuOTE0LTYuMjEyLDI0LjktMi41MzQsMzEuMTg5LDguMTc1bDExLjc0MiwxOS45ODUgICAgIGMyLjM5OCw0LjA3LDcuNjIsNS40MjcsMTEuNjgyLDMuMDM4YzQuMDYyLTIuMzg5LDUuNDE5LTcuNjEyLDMuMDM4LTExLjY3NGwtMC4wMTctMC4wMjZjLTEuODQzLTMuMTQ5LTIuMjg3LTYuOTcyLTEuMjcxLTEwLjc3OCAgICAgYzEuMDMzLTMuODc0LDMuNDktNy4xNTEsNi43NDEtOC45OTRjNi40NDMtMy42NTIsMTYuODAyLTAuOTY0LDIwLjUxNCw1LjM1bDUwLjg3Niw4Ni42NDcgICAgIGMxNi44OTYsMjguNzU3LDE5LjA2Myw0NS45OTUsMjEuNTgxLDY1Ljk1NGMxLjc3NSwxNC4xMjMsMy42MSwyOC42ODEsMTAuNjY3LDQ3Ljk2NmwtMTUwLjQwOSw4NS4zNzYgICAgIGMtNTUuNDQxLTU4LjYxNS0xNTguNzg4LTExMi42OTEtMjEwLjc4Mi0xMjYuMzc5Yy05LjI0Mi0yLjQ0MS0yNS44OS03LjY2My0yOC45ODgtOC42MjdsMS4yNTQtNC4zNTIgICAgIGMzLjI2OC0xMS45OTgsMjkuMjI3LTI2LjY1OCw0MS40OTgtMjMuNDY3bDM2Ljg3Myw5LjcxOWM0LjU4MiwxLjE5NSw5LjIyNS0xLjUxOSwxMC40MjgtNi4wNzYgICAgIGMxLjIwMy00LjU1Ny0xLjUxOS05LjIyNS02LjA3Ni0xMC40MTlsLTM2Ljg4MS05LjcyOGMtMjEuMTU0LTUuNTQ3LTU2LjY0NCwxNC42NzctNjIuMjc2LDM1LjM2MmwtMS4zOTksNC44MzggICAgIGMtMC4wODUsMC4yOTktMC4xNTQsMC42MTQtMC4yMTMsMC45MjJjLTEuNDM0LDguNDIyLDIuMTE2LDE1LjQyLDkuNTE1LDE4LjczMWMwLjI5LDAuMTI4LDAuNTk3LDAuMjM5LDAuODk2LDAuMzQxICAgICBjMC44MjgsMC4yNTYsMjAuMjU4LDYuNDE3LDMxLjAxOSw5LjI1OWM1MS40MywxMy41NDIsMTU1LjA4NSw2OC4xNTYsMjA3LjA4NywxMjYuMzM2YzEuNjY0LDEuODYsNC4wMDIsMi44NDIsNi4zNjYsMi44NDIgICAgIGMxLjQ0MiwwLDIuODg0LTAuMzU4LDQuMjA3LTEuMTA5bDE2Mi43MTQtOTIuMzU2QzUxMS40MTEsNDE2LjI5Miw1MTIuOTksNDExLjcyNiw1MTEuMzY5LDQwNy43NTh6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJCTxwYXRoIGQ9Ik0xMjgsNjguMzk2YzMyLjkzOSwwLDU5LjczMywyNi43OTUsNTkuNzMzLDU5LjczM2MwLDQuNzEsMy44MjMsOC41MzMsOC41MzMsOC41MzNzOC41MzMtMy44MjMsOC41MzMtOC41MzMgICAgIGMwLTQyLjM0Mi0zNC40NTgtNzYuOC03Ni44LTc2LjhzLTc2LjgsMzQuNDU4LTc2LjgsNzYuOGMwLDI3LjQ0MywxNC43OTcsNTIuOTc1LDM4LjYyMiw2Ni42NDUgICAgIGMxLjM0LDAuNzY4LDIuNzk5LDEuMTM1LDQuMjMyLDEuMTM1YzIuOTYxLDAsNS44MzctMS41MzYsNy40MTUtNC4yOTJjMi4zNDctNC4wODcsMC45My05LjMwMS0zLjE1Ny0xMS42MzkgICAgIGMtMTguNTM0LTEwLjYzMy0zMC4wNDYtMzAuNTA3LTMwLjA0Ni01MS44NDlDNjguMjY3LDk1LjE5MSw5NS4wNjEsNjguMzk2LDEyOCw2OC4zOTZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+CgkJPC9nPgoJPC9nPgo8L2c+PC9nPiA8L3N2Zz4=" /></a></h4>
                                </div>
                                    <input type="hidden" id="tito2" name="">
                                <div class="modal-body table-responsive" id="pdf2">
                                    

                                </div>
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade in" id="mymodal5" style="background-color: rgba(3, 64, 95, 0.3)" >
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><strong>Actualizar</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 3px">
                                        <div id="_MSG2_"></div>
                                    </div>
                                    <form name="formulario-envia12" id="formulario-envia12" enctype="multipart/form-data" method="post">
                                        <div id="123examen"><br> </div> 
                                        <input type="hidden" id="guia1" name="guia1">
                                        <input type="hidden" id="id_guias1" name="id_guias1">
                                        <label for="tema">Descripción del taller</label>                      
                                        <textarea class="form-control" id="nombre1" name="nombre1" onchange="
                                       
                                        var nombre=document.getElementById('nombre1').value;
                                        var i=1;
                                        var id=document.getElementById('id_guias1').value;
                                        var colum='nombre';
                                        actualizar_examnen(i,nombre,id,colum)"></textarea><br>

                                        <label for="Tiempo">fecha para presentar el examen</label>
                                        <input type="date" class="form-control" id="fecha1" name="fecha1" onchange="
                                        var div=2;
                                        var nombre=document.getElementById('fecha1').value;
                                        var i=1;
                                        var id=document.getElementById('id_guias1').value;
                                        var colum='fecha_presentacion';
                                        actualizar_examnen(i,nombre,id,colum)">
                                        <br>
                                        

 
                                    </form>
                                   
                                </div>
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade in" id="mymodal51" style="background-color: rgba(3, 64, 95, 0.3)" >
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title"><strong>Actualizar</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 3px">
                                        <div id="_MSG3_"></div>
                                    </div>
                                    <form name="formulario-envia123" id="formulario-envia123" enctype="multipart/form-data" method="post">
                                        <div id="123examen"><br> </div> 
                                        <input type="hidden" id="guia2" name="guia2">
                                        <input type="hidden" id="id_guias2" name="id_guias2">
                                        <label for="tema">Tema del taller</label>                      
                                        <textarea class="form-control" id="nombre2" name="nombre2" onchange="
                                       
                                        var nombre=document.getElementById('nombre2').value;
                                        var i=1;
                                        var id=document.getElementById('id_guias2').value;
                                        var colum='nombre';
                                        actualizar_examnen3(i,nombre,id,colum)"></textarea><br>

                                        <label for="Tiempo">fecha para presentar el examen</label>
                                        <input type="date" class="form-control" id="fecha2" name="fecha2" onchange="
                                        var div=2;
                                        var nombre=document.getElementById('fecha2').value;
                                        var i=1;
                                        var id=document.getElementById('id_guias2').value;
                                        var colum='fecha_presentacion';
                                        actualizar_examnen3(i,nombre,id,colum)">
                                        <br>
                                        

 
                                    </form>
                                   
                                </div>
                                <div class="modal-footer">     
                                  <button type="button" data-dismiss="modal" style="width: 100%" class="btn btn-primary" name="eliminar_sede" id="btn"><strong>Cerrar</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>











                    <div class="modal fade" id="mymodal2" style="background-color: rgba(3, 64, 95, 0.3)">
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> estás seguro de eliminar el taller   ?</p>
                                    <input type="hidden" id="2eliminare1" name=""> 
                                </div>
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminary2" 
                                  id="eliminary2"   onclick="
                                  var id_guia=document.getElementById('eliminary2').value;
                                  
                                    eliminar(id_guia) ">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="mymodal21" style="background-color: rgba(3, 64, 95, 0.3)" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <p> estás seguro de eliminar el taller   ?</p>
                                    <input type="hidden" id="2eliminare1" name=""> 
                                </div>
                                <div class="modal-footer">    
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminary22" 
                                  id="eliminary22"   onclick="
                                  var id_guias_tecnico=document.getElementById('eliminary22').value;
                                  
                                    eliminar2(id_guias_tecnico) ">Aceptar</button> 
                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="sapo"></div>
                    <div class="col-md-3"> 
                        

                        <div class="box box-info" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                             <form name="formulario-envia1" id="formulario-envia1" enctype="multipart/form-data" method="post">
                                <div class="box-body">
                                    <input type="hidden" name="ad" id="ad">
                                    <div id="validacion"></div>
                                    <div id="tutu" style=" display: none;">
                                        <div class="alert bg-info-500" role="alert "  style="color: #0a6ebd; background-color: #e3f2fd;border-color: #82c4f8;" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button><strong>Informacion!</strong>  <br> seleccione el grado con la materia para registrar talleres masivos, tenga en cuenta que solo visualizará, grados repetidos con sus mismas areas. Este proceso ayudará ha registrar talleres para todos los cursos, con el mismo grado  y la misma area  </div>
                                    </div>
                                    <label for="">Crear talleres o guias</label><br><br>

                                        Tipo de seleccion:
              
                                        <select class="form-control" id="todos" name="todos" onchange="  

                                            var todos=$('#todos').val();  
                                            if (todos==0){ 

 
                                                document.getElementById('tutu').style.display='none'; 

                                                document.getElementById('graditos').required = false; 
                                                document.getElementById('j').style.display='block'; 
                                                document.getElementById('gradito').style.display='none'; 
                                                return;
                                            } 
                                            if (todos==1) {  
                                                document.getElementById('j').style.display='none'; 

                                                document.getElementById('gradito').style.display='block'; 
                                                                       
                                                document.getElementById('tutu').style.display = 'block';
                                                window.setTimeout(function  () {
                                                    $('.alert').fadeTo(1000, 0).slideUp(500, function(){
                                                        $(this).remove(); 
                                                    });
                                                }, 28800);
                                                
                                                $.ajax({
                                                    type: 'post',
                                                    url: '../../../ajax/seles/seles.php?action=grado_solito',
                                                    
                                                    dataType: 'text',
                                                    success: function(data) { 
                                                        $('#graditos').html(data);
                                                    }
                                                });

                                            } if (todos==2){ 

                                                document.getElementById('taa2').click();
                                                document.getElementById('gradito').style.display='none'; 
                                                document.getElementById('j').style.display='none'; 
 
                                                                       
                                                document.getElementById('tutu').style.display='none'; 
                                            } if (todos==3){ 

                                                document.getElementById('taa').click();
                                                document.getElementById('gradito').style.display='none'; 
                                                document.getElementById('j').style.display='none'; 
 
                                                                       
                                                document.getElementById('tutu').style.display='none'; 
                                            }
                                            "> 
                                            <option value="0">Para un curso especifico</option>
                                            <option value="1">Para cursos con el mismo grado y la misma materia</option>
                                            <option value="2">todo los cursos academicos</option>
                                            <option value="3">todos los cursos tecnicos</option>
                                        </select><br>
                                        
                                        <div id="j">
                                             Sedes y jornadas:
                                            <input type="hidden" value="<?php echo $_SESSION['Id_Doc'] ?>" name="do" id='do'>
                                            <input type="hidden" value="<?php echo $dat[1] ?>" name="jx" id='jx'>
                                            <select class="form-control" id="jornada_sede1" name="jornada_sede1" required> 
                                               <?php
                                                $js1='';
                                                foreach($dat[0] as $key){
                                                ?>
                                                    <option value="<?php echo($key['ID_JS']) ?>">
                                                        <?php echo($key['sede']." ".$key['jornada']) ?>
                                                    </option>
                                                    <?php
                                                    $js  = ($js1.''.$key['ID_JS']);
                                                    $js1=$key['ID_JS'];
                                                }
                                                foreach($dat[2] as $keyq){ ?>
                                                            
                                                           
                                                    <option value="<?php echo($keyq['ID_JS']) ?>">
                                                        <?php echo($keyq['sede']." ".$keyq['jornada']) ?>
                                                    </option> <?php        
                                                }                                                
                                                ?>
                                            </select>
                                                <br> 
                                            
                                             cursos:       <br>   
                                            <select class="form-control select2"     id="curso1" name="curso1" style="width: 100%"  >
                                            </select>  <br><br>

                                             Asignaturas:  
 

                                            <select class="form-control select2"  data-placeholder="Selecione Curso"    id="Asignaturas"  name="Asignaturas"  onchange="  var Asignaturas=$('#Asignaturas').val(); 
                                        var porciones = Asignaturas.split(',');
                                        if(porciones[4]==1){ 
                                          document.getElementById('taa').click();
                                      }else{document.getElementById('taa2').click();}"  >
                                            </select> 

                                        </div>
                                        <div id="gradito" style=" display: none;">

                                        grados y materias repetidas:
                                            <select class="form-control" name="graditos" id="graditos"  onchange=" 
                                             var Asignaturas=$('#graditos').val(); 
                                             var porciones = Asignaturas.split(',');
                                             if(porciones[5]==1){
                                                document.getElementById('taa').click();
                                            }else{
                                                document.getElementById('taa2').click();
                                            }" ></select> 
                                        </div><br>
                                         Tema:
                                        <textarea class="form-control" id="tema" name="tema" required></textarea>
                                         <br> 
                                         Fecha de entrega:
                                        <input type="date" class="form-control" id="fecha" name="fecha" required=""> 
                                        <br>
                                        
                                       
                                         
                                            <input class="form-control" type="file" name="files" id="files" style="width: 100%" required > 
                                        <br><br>
                                        <button type="submit" style="width: 100%" id="Buscar" class="btn btn-info" onclick=" ">Crear</button>
                                  
                                </div>
                            </form>
                        </div>
                         
                    </div>
                    <div class="col-md-9">
                    
                        <div class="box   box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="bd-example" >
                                <ul class="nav nav-tabs" role="tablist" style=" background-color: #3c8dbc;  ">
                                    <li   id="i" style=" " class="active">
                                        <a id="taa2"  data-toggle="tab"  style=""  onclick="document.getElementById('academico').style.display = 'block';document.getElementById('tecnico_sele').style.display = 'none';document.getElementById('tecnico').style.display = 'none';">Evaluaciones Academicas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="taa"class="nav-link" id=" " data-toggle="tab"   onclick="document.getElementById('tecnico').style.display = 'block';document.getElementById('tecnico_sele').style.display = 'block';document.getElementById('academico').style.display = 'none'; tecnico()" >Evaluaciones tecnicas</a>
                                    </li> 
                                </ul>
                            </div>  
                                <div style="padding: 5px">
                                    <div id="_MSG_"></div>
                                </div>
                            <div id='academico'>
                               <div class="box-header with-border"> <br>
                <select id="mySelect"  class="form-control" onchange="myFunction(1)" style="width:63px;">


                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select>
                <div class="box-tools pull-right"><br>
                    <div class="has-feedback">
                        <input type="text" class="form-control   " id='fname' placeholder="buscador.." onkeyup="myFunction(1)" style="margin-top: 5px;">
                        <span class="fa fa-search form-control-feedback" style=" "></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div> 
                                <div id="tabla"></div> 
                            </div>
                            <div  id="tecnico_sele"  style="display: none;" class="box-header with-border"> <br>
                                <select id="mySelect2" class="form-control" onchange="myFunction1(1)" style="width: 63px;" >
                                    <option value="5"> 5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                                <div class="box-tools pull-right"><br>
                                    <div class="has-feedback">
                                        <input type="text" class="form-control  " id='fname2' placeholder="buscador.." onkeyup="myFunction1(1)" style="margin-top: 5px;">
                                        <span class="fa fa-search form-control-feedback" style=" "></span>
                                    </div>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <div id="tecnico" style=" display: none"> </div>
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
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../../css/jquery.loadingModal.css">

 

<script src="../../../js/jquery.loadingModal.js"></script>


<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Slimscroll --> 
<!-- FastClick --> 
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- iCheck --> 

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select1').select2({placeholder:"selee"})

    $('.select2').select2({
});
    //Datemask dd/mm/yyyy
   
  })
</script>
 


    <script>
         
        function funcion(guia){
            document.getElementById('pdf').innerHTML ='<iframe src="../../../guias/'+guia+'" style="width:100%;height: 400px" frameborder="0"></iframe>'
        } 
        function funcion2(guia){
            document.getElementById('pdf2').innerHTML ='<iframe src="../../../guias/'+guia+'" style="width:100%;height: 400px" frameborder="0"></iframe>'
        } 
        function tecnico(){ 
            var mySelect=document.getElementById('mySelect').value; 
            var fname=document.getElementById('fname').value; 
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/guias.php?action=tabla_tecnico",
                data: { mySelect,fname
                },
                dataType: "text",
                success: function(data) {
                    $('#tecnico').html(data);
                }
            });
        }
         
        function mostrar(){
            $('body').loadingModal({text: 'Cargando...'});
            var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        }
        function tabla_academico(){ 
            var mySelect=document.getElementById('mySelect').value; 
            var fname=document.getElementById('fname').value; 
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/guias.php?action=tabla_academico",
                data: { mySelect,fname
                },
                dataType: "text",
                success: function(data) {
                    $('#tabla').html(data);
                }
            });
        }
        tabla_academico();




        function actualizar_examnen(i,nombre,id,colum){
            if (i==1) {
               $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/guias.php?action=actualizar_guia1_1",
                    data: { nombre,id,colum
                    },
                    dataType: "text",
                    success: function(data) {
                        mensaje2(3,'Registro actualizado');
                        tabla_academico();
                    }
                }); 
            }else{ 
                var parametros=new FormData($("#formulario-envia1")[0]);
                $.ajax({
                    data:parametros,
                    url:"../../../ajax/docente/guias.php?action=crear",
                    type:"POST",
                    contentType:false,
                    processData:false,
                    success: function(data){ 
                    }
                });
            }
        }


        function actualizar_examnen3(i,nombre,id,colum){
            if (i==1) {
               $.ajax({
                    type: "post",
                    url: "../../../ajax/docente/guias.php?action=actualizar_guia2_1",
                    data: { nombre,id,colum
                    },
                    dataType: "text",
                    success: function(data) {
                        tecnico(); 
                        mensaje3(3,'Registro actualizado');
                    }
                }); 
            }else{ 
                var parametros=new FormData($("#formulario-envia123")[0]);
                $.ajax({
                    data:parametros,
                    url:"../../../ajax/docente/guias.php?action=crear",
                    type:"POST",
                    contentType:false,
                    processData:false,
                    success: function(data){ 
                    }
                });
            }
        }





        
        $(document).on("submit", "#formulario-envia1", function(e){
            e.preventDefault();
            mostrar();
            var identificador=document.getElementById('todos').value; 

            var Asignaturas=$('#Asignaturas').val(); 
            var porciones = Asignaturas.split(',');
            var archivoRuta = document.getElementById('files').value; 
            var extPermitidas = /(.docx)$/i; 
            var extPermitidas1 = /(.pdf)$/i;
            var extPermitidas2 = /(.doc)$/i; 

            

            // si es una sola materia o tecnica
            if(identificador==0){ 
                // identifico si es una tecnica o una area
                if(porciones[4]==0){ 
                    //octengo la extencion del documento
                    //pregunto si es un pdf
                    if(extPermitidas1.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.pdf';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(3,'Registro exitoso');
                                tabla_academico();
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                    }
                    //pregunto si es un word
                    if(extPermitidas.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.docx';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tabla_academico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }
                    //pregunto si es un word
                    if(extPermitidas2.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.doc';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tabla_academico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }else{
                        $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(1,'solo soporta documentos con extención pdf, doc y docx ');
                        return false;
                    }
                    
                }else{
                     if(extPermitidas1.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.pdf';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                 
                                tecnico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                    }
                    //pregunto si es un word
                    if(extPermitidas.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.docx';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                              
                               tecnico();
                               document.getElementById('formulario-envia1').reset();
                                mensaje(3,'Registro exitoso');
                        return false;
                            }
                        });
                       
                    }else{
                        $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(1,'solo soporta documentos con extención pdf, doc y docx ');
                        return false;
                    }
                }
                
            }
            // si son varias   materias o tecnicas
            if(identificador==1){

            var graditos=$('#graditos').val();
            var porciones2 = graditos.split(',');
                if(porciones2[5]==0){  
                    //octengo la extencion del documento
                    //pregunto si es un pdf
                    if(extPermitidas1.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.pdf';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear2",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(3,'Registro exitoso');
                                tabla_academico();
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                    }
                    //pregunto si es un word
                    if(extPermitidas.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.docx';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear2",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tabla_academico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }
                    //pregunto si es un word
                    if(extPermitidas2.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.doc';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear2",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tabla_academico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }else{
                        $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(1,'solo soporta documentos con extención pdf, doc y docx ');
                        return false;
                    }
                    
                }else{
                    if(extPermitidas2.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.doc';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico2",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){ 
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                 
                                tecnico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }
                    if(extPermitidas1.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.pdf';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico2",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                 
                                tecnico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                    }
                    //pregunto si es un word
                    if(extPermitidas.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.docx';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico2",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){ 
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                 
                                tecnico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }else{
                        $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(1,'solo soporta documentos con extención pdf, doc y docx ');
                        return false;
                    }
                }
            }
            if(identificador==2){ 
                    //octengo la extencion del documento
                    //pregunto si es un pdf
                    if(extPermitidas1.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.pdf';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear3",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                                tabla_academico();
                            }
                        });
                        return false;
                    }
                    //pregunto si es un word
                    if(extPermitidas.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.docx';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear3",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tabla_academico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }
                    //pregunto si es un word
                    if(extPermitidas2.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.doc';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear3",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tabla_academico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }else{
                        $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(1,'solo soporta documentos con extención pdf, doc y docx ');
                        return false;
                    }
                     
            }

            if(identificador==3){ 
                    //octengo la extencion del documento
                    //pregunto si es un pdf
                    if(extPermitidas1.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.pdf';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico3",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                                tecnico();
                            }
                        });
                        return false;
                    }
                    //pregunto si es un word
                    if(extPermitidas.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.docx';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico3",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tecnico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }
                    //pregunto si es un word
                    if(extPermitidas2.exec(archivoRuta)){
                      
                        document.getElementById('ad').value='.doc';
                        var parametros=new FormData($("#formulario-envia1")[0]);
                        $.ajax({
                            
                            data:parametros,
                            url:"../../../ajax/docente/guias.php?action=crear_tecnico3",
                            type:"POST",
                            contentType:false,
                            processData:false,
                            success: function(data){
                                $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                             
                                tecnico();
                                mensaje(3,'Registro exitoso');
                                document.getElementById('formulario-envia1').reset();
                            }
                        });
                        return false;
                       
                    }else{
                        $('body').loadingModal({text: 'Showing loader animations...'});

                                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                                var time = 0;
                                delay(time).then(function() { $('body').loadingModal('hide'); return delay(time); } )
                                .then(function() { $('body').loadingModal('destroy') ;} ); 
                                
                                mensaje(1,'solo soporta documentos con extención pdf, doc y docx ');
                        return false;
                    }
                     
            }


            
        })
 
         







         

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
             
                if (data==1) {
                    data='<option value="">Vacio</option>';
                }              
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
          
       
      
        function  eliminar(id_guia){
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/guias.php?action=eliminar",
                data: {
                    id_guia
                },
                dataType: "text",
                success: function(data) {
                    tabla_academico();
                    mensaje(3,'Archivo eliminado')
                    
                }
            });
        }
      
        function  eliminar2(id_guias_tecnico){
            $.ajax({
                type: "post",
                url: "../../../ajax/docente/guias.php?action=eliminar2",
                data: {
                    id_guias_tecnico
                },
                dataType: "text",
                success: function(data) {
                    tecnico();
                    mensaje(3,'Archivo eliminado')
                }
            });
        }




        
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
 
            var dato=document.getElementById("fname").value;

            var mySelect=document.getElementById("mySelect").value;

            $.ajax({  

                  type: "post",
                  url: "../../../ajax/docente/guias.php?action=tabla_academico",

                  data:{i,dato,mySelect},    dataType:"text", 

                  success:function(data){  
                    $('#tabla').html(data); 


                }
            });  
        }
        function myFunction1(i) {

            var dato=document.getElementById("fname2").value;

            var mySelect=document.getElementById("mySelect2").value;

            $.ajax({  

                  type: "post",
                  url: "../../../ajax/docente/guias.php?action=tabla_tecnico",

                  data:{i,dato,mySelect},    dataType:"text", 

                  success:function(data){  
                    $('#tecnico').html(data); 


                }
            });  
        }
    }  
    </script>
</body>


 
