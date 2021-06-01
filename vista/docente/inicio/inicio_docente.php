<?php
 session_start();
require_once "../../../codes/docente/chat.php";
$chat=new chat(); 
$mensaje=$chat->mensajes($_SESSION['Id_Doc']);
    if(!isset($_SESSION['Session'])){
        header("location: ../../../index.html"); echo($_SESSION['Session']);
    }
include "../../../codes/docente/carga_academica.php"; 
include('../enlaces/head.php');
include('../enlaces/header.php'); 
$sty='';
$link='';
if(isset($_SESSION['sty'])){
  $sty=$_SESSION['sty'];
  $link=$_SESSION['link'];
   
}
echo $link;

   ?> 




<body style=" <?php echo $sty ?>" class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); display: none;">
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<?php include('../enlaces/footer.php'); ?>
