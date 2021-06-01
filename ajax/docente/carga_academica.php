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
    function form()
   {
        include "../../codes/rector/conexion.php";
        $id=$_SESSION['Id_Doc'];
        $columna=$_POST['columna'];
         $periodo=$_POST['periodo'];
        $tipo=$_POST['tipo'];
        $id_a=$_POST['id_a'];
        $id_g=$_POST['id_g'];
        $id_c=$_POST['id_c']; 
        $id_jornada_sede=$_POST['id_jornada_sede'];

        date_default_timezone_set("America/Bogota");
        $hora=date("H:i:s");
        $fecha=date("Y-m-d");
        $ano=date("Y") ; 
        

            $sql="INSERT INTO `nota_independiente` (`id_curso`, `id_grado`, `id_jornada_sede`, `id_tipo_calificacion`, `nombre`, `id_periodo`, `id_area`, `fecha`, `hora`, `ano`) VALUES ( '$id_c', '$id_g','$id_jornada_sede','$tipo',  '$columna','$periodo', '$id_a','$fecha','$hora','$ano')";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array()); 
            $id_nota=$conexion->lastInsertId();
            $id_notaq=$id_nota; 

        
        $a="
            INSERT INTO `materia_por_paso` ( `id_materia_por_periodo`, `id_alumno`, `id_nota_independiente`)
            SELECT materia_por_periodo.id_materia_por_periodo,informeacademico.id_informe_academico,'$id_notaq'  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico   and materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='$id_a';  ";
            $a1=$conexion->prepare($a);
            $a1->execute(array()); 
         
        $a="
           SELECT materia_por_periodo.id_materia_por_periodo  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and  materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='$id_a'     ";
            $a1=$conexion->prepare($a);
            $a1->execute(array()); 
 
             
            foreach ($a1 as  $valueQ) { 

                



                if ($_POST['area']!=1 ) {
                
                    $r=$valueQ['id_materia_por_periodo'];
                    likn($r,$periodo);
                    
                }else{ 
                    $tipo_calificaiones1="
                    SELECT SUM(de.su)as f,de.id_materia_por_periodo from (SELECT materia_por_periodo.id_materia_por_periodo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$valueQ['id_materia_por_periodo']."'  and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de

                    ";
                    $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                    $tipo_calificaiones1->execute(array()); 
                    foreach ($tipo_calificaiones1 as  $value) {
                        $tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = '".$value['f']."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$value['id_materia_por_periodo'];
                        $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                        $tipo_calificaiones1->execute(array()); 
                    }
                }
            }
    }
    /*-------FIN--------------*/

             
function del()
   {
        include "../../codes/rector/conexion.php";
        $id=$_POST['id'];
        $id_jornada_sede=$_POST['id_jornada_sede'];
        $id_c=$_POST['id_c'];
        $id_g=$_POST['id_g'];
        $id_a=$_POST['id_a'];
        $periodo=$_POST['periodo'];


  
      

        date_default_timezone_set("America/Bogota");
        $hora=date("H:i:s");
        $fecha=date("Y-m-d");
        $ano=date("Y") ; 
        $r1=0;$r2=0;
        $id_m=0;
        $sum=0;
        $cont=0;
        $uno=0;
        $sql="SELECT materia_por_paso.id_materia_por_paso from materia_por_paso WHERE materia_por_paso.id_nota_independiente=$id and materia_por_paso.nota not in('0') GROUP by materia_por_paso.id_nota_independiente";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 
        $not=$sql1->rowCount(); 
        if($not==0){
            $a=" DELETE FROM `materia_por_paso` WHERE materia_por_paso.id_nota_independiente=$id;DELETE FROM `nota_independiente` WHERE nota_independiente.id_nota_independiente=$id";
            $a1=$conexion->prepare($a);
            $a1->execute(array());  
            $a="SELECT materia_por_periodo.id_materia_por_periodo  from materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and  materia_por_periodo.periodo='$periodo' and materia_por_periodo.id_area='$id_a'; ";
            $a1=$conexion->prepare($a);
            $a1->execute(array());  
            foreach ($a1 as  $valueQ) { 

                $r1=0;$r2=0;
                $id_m=0;
                $sum=0;
                $cont=0;
                $uno=0;

                if ($_POST['area']!=1 ) {
                   $r=$valueQ['id_materia_por_periodo'];
                    likn($r,$periodo);
                }else{ 
                    $tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = ( SELECT SUM(de.su)as f from (SELECT materia_por_periodo.id_materia_por_periodo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='".$valueQ['id_materia_por_periodo']."'  and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$valueQ['id_materia_por_periodo'];
                        $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                        $tipo_calificaiones1->execute(array()); 
                }
            } 
        }else{ 
            echo 1;
        }
    }  



function likn($id_materia_por_periodox,$periodo){
     include "../../codes/rector/conexion.php";
        $r1=0;$r2=0;
                $id_m=0;
                $sum=0;
                $cont=0;
                $uno=0;
    echo $tipo_calificaiones12="SELECT materia_por_periodo.area, materia_por_periodo.id_materia_por_periodo, SUM(DE.su) as nos, materia_por_periodo.nota FROM (SELECT materia_por_periodo.id_informe_academico,materia_por_periodo.area,materia_por_periodo.codigo, SUM(materia_por_paso.nota)/COUNT(materia_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_independiente,tipo_calificaiones, materia_por_periodo,materia_por_paso WHERE materia_por_periodo.id_materia_por_periodo='$id_materia_por_periodox' and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_nota_independiente=nota_independiente.id_nota_independiente and nota_independiente.id_tipo_calificacion=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero) AS DE,materia_por_periodo WHERE materia_por_periodo.periodo='$periodo' AND materia_por_periodo.id_informe_academico=DE.id_informe_academico AND materia_por_periodo.codigo=DE.codigo GROUP by materia_por_periodo.id_materia_por_periodo";
                     $tipo_calificaiones1q=$conexion->prepare($tipo_calificaiones12);
                    $tipo_calificaiones1q->execute(array()); 
                   foreach ($tipo_calificaiones1q as  $value) { 
                           $y= $value['nos'];
                        if( $value['id_materia_por_periodo']==$id_materia_por_periodox){
                         $r1=$value['nos'];   
                            $r2=$value['id_materia_por_periodo'];
                            $uno=1;
                        }
                        if ($value['area']==0 && $value['id_materia_por_periodo']!=$id_materia_por_periodox) {
                           
                            $cont=$cont+1;
                            $sum=$sum+$value['nota'];
                        }

                        if ($value['area']==1) {
                             
                            $id_m=$value['id_materia_por_periodo'];
                        }
                    
 }$cont=$cont+$uno;
                    $sum=$sum+$r1;
                    $sum1=$sum/$cont    ;
                   echo $tipo_calificaiones1="  UPDATE `materia_por_periodo` SET `nota` = '".$y."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_materia_por_periodox."; UPDATE `materia_por_periodo` SET `nota` = '".$sum1."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id_m ;
                    $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                    $tipo_calificaiones1->execute(array()); }
    function form2()
   {
        include "../../codes/rector/conexion.php";
        $id_docente=$_SESSION['Id_Doc'];
        $columna=$_POST['columna'];
         $periodo=$_POST['periodo'];
        $tipo=$_POST['tipo'];
        $id_competencia=$_POST['id'];
        $id_g=$_POST['id_g'];
        $id_c=$_POST['id_c']; 
        $id_jornada_sede=$_POST['id_jornada_sede'];

        date_default_timezone_set("America/Bogota");
        $hora=date("H:i:s");
        $fecha=date("Y-m-d");
        $ano=date("Y") ; 

     


            $sql="INSERT INTO `nota_tecnologica_independiente` ( `id_curso`, `id_grado`, `id_jornada_sede`, `id_tipo_calificaciones`, `nombre`, `id_periodo`, `fecha`, `hora`, `id_competencia`, `ano`) VALUES ( '$id_c', '$id_g','$id_jornada_sede','$tipo',  '$columna','$periodo','$fecha','$hora', '$id_competencia', '$ano')";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array()); 
            $id_nota=$conexion->lastInsertId();
            $id_notaq=$id_nota; 

       

            $a="INSERT INTO `tecnica_por_paso` (`id_tecnologia`, `id_nota_tecnologia_independiente`, `id_informe_academico`)

            SELECT tecnologia.id_tecnologia,'$id_notaq',informeacademico.id_informe_academico  from tecnologia,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=tecnologia.id_informe_academico     and tecnologia.id_competrencia='$id_competencia'";
            $a1=$conexion->prepare($a);
            $a1->execute(array()); 

            
        echo    $a="SELECT tecnologia.id_tecnologia  from tecnologia,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=tecnologia.id_informe_academico   and tecnologia.id_competrencia='$id_competencia'";
            $a1=$conexion->prepare($a);
            $a1->execute(array()); 
        foreach ($a1 as  $valueQ) { 

            $r1=0;$r2=0;
            $id_m=0;
            $sum=0;
            $cont=0;
            $uno=0;
           echo $tipo_calificaiones1="UPDATE `tecnologia` SET `nota` = ( SELECT SUM(de.su)as f from (SELECT tecnologia.id_tecnologia, SUM(tecnica_por_paso.nota)/COUNT(tecnica_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_tecnologica_independiente,tipo_calificaiones, tecnologia,tecnica_por_paso WHERE tecnologia.id_tecnologia='".$valueQ['id_tecnologia']."'  and tecnologia.id_tecnologia=tecnica_por_paso.id_tecnologia and tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and nota_tecnologica_independiente.id_tipo_calificaciones=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `tecnologia`.`id_tecnologia` =".$valueQ['id_tecnologia'];
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array());  
        }  
 

        
    }
    /*-------FIN--------------*/
   





function nota()
   {
include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nota=$_POST['nota'];
    $acum1=0;
    $acum2=0;
    $acum3=0;
    $conta1=0;
    $conta2=0;
    $aux=0;
    $porceentajes=0;
    $i=0;

        

        if ($_POST['area']==1 &&  $_POST['codigo']==1) {
     
            
            $tipo_calificaiones1="UPDATE `materia_por_paso` SET `nota` = '".$_POST['nota']."' WHERE `materia_por_paso`.`id_materia_por_paso` =". $_POST['id'];
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array()); 

            $tipo_calificaiones="SELECT materia_por_periodo.periodo, materia_por_periodo.id_materia_por_periodo, materias.id_materias,materias.id_informe_academico,materias.nom_materia,materias.area,materias.codigo from materias,materia_por_periodo,materia_por_paso WHERE materias.id_materias=materia_por_periodo.id_materia and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_materia_por_paso= " .$_POST['id'];
            $tipo_calificaiones=$conexion->prepare($tipo_calificaiones);
            $tipo_calificaiones->execute(array());
            foreach ($tipo_calificaiones as  $ddf) {
                
                $SELECT="SELECT nota_independiente.nombre as nombre_nota,tipo_calificaiones.porceentajes,tipo_calificaiones.nombre, nota_independiente.id_tipo_calificacion, SUM(materia_por_paso.nota)as nota,COUNT(materia_por_paso.nota)as t, materia_por_periodo.periodo, materia_por_periodo.id_materia_por_periodo from tipo_calificaiones, materia_por_paso,materia_por_periodo,nota_independiente WHERE materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_periodo.periodo='".$_POST['periodo']."' AND materia_por_periodo.id_materia_por_periodo='".$ddf['id_materia_por_periodo']."' and tipo_calificaiones.id_tipo_calificaciones=nota_independiente.id_tipo_calificacion and nota_independiente.id_nota_independiente=materia_por_paso.id_nota_independiente GROUP by tipo_calificaiones.id_tipo_calificaciones ORDER BY `tipo_calificaiones`.`porceentajes` ASC";
                    $SELECT=$conexion->prepare($SELECT);
                    $SELECT->execute(array());
                    foreach ($SELECT as  $value) {
                         
                        $porceentajes=$value['nota']/$value['t'];
                        $aux=$value['porceentajes']/100;
                        $acum1=$porceentajes*$aux;
                        $acum2=$acum2+$acum1;
                        $acum3=$acum2;
                        $conta1=$conta1+$acum2;
                    }   
                        $conta2= $acum3+$conta2;
                        echo$tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = '".$acum2."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$ddf['id_materia_por_periodo'];
                        $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                        $tipo_calificaiones1->execute(array()); 
                         $i=$i+1;
                        
                        $acum2=0;
            }
         
        }else{ 
            $tipo_calificaiones1="UPDATE `materia_por_paso` SET `nota` = '".$_POST['nota']."' WHERE `materia_por_paso`.`id_materia_por_paso` =". $_POST['id'];
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array()); 

        echo    $tipo_calificaiones="SELECT materia_por_periodo.id_materia_por_periodo,    materias.area from materias,materia_por_periodo, (SELECT   materia_por_periodo.id_materia_por_periodo, materias.id_materias,materias.id_informe_academico, materias.area,materias.codigo from materias,materia_por_periodo,materia_por_paso WHERE materias.id_materias=materia_por_periodo.id_materia and materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_paso.id_materia_por_paso='".$_POST['id']."') as m WHERE materias.codigo=m.codigo AND materias.id_informe_academico=m.id_informe_academico and materia_por_periodo.id_materia=materias.id_materias and materia_por_periodo.periodo='".$_POST['periodo']."'";
            $tipo_calificaiones=$conexion->prepare($tipo_calificaiones);
            $tipo_calificaiones->execute(array());
            foreach ($tipo_calificaiones as  $ddf) {
                if ($ddf['area']!=1) { 

                    $SELECT="SELECT   tipo_calificaiones.porceentajes,    SUM(materia_por_paso.nota)as nota,COUNT(materia_por_paso.nota)as t, materia_por_periodo.id_materia_por_periodo from tipo_calificaiones, materia_por_paso,materia_por_periodo,nota_independiente WHERE materia_por_periodo.id_materia_por_periodo=materia_por_paso.id_materia_por_periodo and materia_por_periodo.periodo='".$_POST['periodo']."' AND materia_por_periodo.id_materia_por_periodo='".$ddf['id_materia_por_periodo']."' and tipo_calificaiones.id_tipo_calificaciones=nota_independiente.id_tipo_calificacion and nota_independiente.id_nota_independiente=materia_por_paso.id_nota_independiente GROUP by tipo_calificaiones.id_tipo_calificaciones ORDER BY `tipo_calificaiones`.`porceentajes` ASC";
                    $SELECT=$conexion->prepare($SELECT);
                    $SELECT->execute(array());
                    foreach ($SELECT as  $value) {
                         
                        $porceentajes=$value['nota']/$value['t'];
                        $aux=$value['porceentajes']/100;
                        $acum1=$porceentajes*$aux;
                        $acum2=$acum2+$acum1;
                        
                        $conta1=$conta1+$acum2;
                    }   $acum3=$acum2;
                        $conta2= $acum3+$conta2;
                         $tipo_calificaiones1="UPDATE `materia_por_periodo` SET `nota` = '".$acum2."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$ddf['id_materia_por_periodo'];
                        $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
                        $tipo_calificaiones1->execute(array()); 
                         $i=$i+1;
                        
                        $acum2=0;
                        
                    
                }else{
                    $id=$ddf['id_materia_por_periodo']; 
                }               
            }  
            $yuta=$conta2/$i;
            echo "string".$UPDATE="UPDATE `materia_por_periodo` SET `nota` = '".$yuta."' WHERE `materia_por_periodo`.`id_materia_por_periodo` =".$id;
            $UPDATE=$conexion->prepare($UPDATE);
            $UPDATE->execute(array()); 
        }
}

function RenameName()
   {
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    echo $sql="UPDATE `nota_independiente` SET `nombre`='$nom' WHERE id_nota_independiente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}

function RenameName2()
   {
    include "../../codes/rector/conexion.php";
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    echo $sql="UPDATE `nota_tecnologica_independiente` SET `nombre`='$nom' WHERE id_nota_tecnologica_independiente=$id";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array());
}


function del2(){
    include "../../codes/rector/conexion.php";
    $id_nota_tecnologia_independiente=$_POST['id_nota_tecnologica_independiente'];
    $id_jornada_sede=$_POST['id_jornada_sede'];
    $id_c=$_POST['id_c'];
    $id_g=$_POST['id_g']; 
    $periodo=$_POST['periodo'];
    $id=$_POST['id'];

  
      

    date_default_timezone_set("America/Bogota");
    $hora=date("H:i:s");
    $fecha=date("Y-m-d");
    $ano=date("Y") ; 
     
          $sql="SELECT tecnica_por_paso.id_tecnica_por_paso FROM `tecnica_por_paso` WHERE tecnica_por_paso.id_nota_tecnologia_independiente=$id_nota_tecnologia_independiente  and  tecnica_por_paso.nota not in ('0')  GROUP BY tecnica_por_paso.id_nota_tecnologia_independiente";
    $sql1=$conexion->prepare($sql);
    $sql1->execute(array()); 
    $not=$sql1->rowCount(); 
    if($not==0){
           
  
       

            $a="DELETE FROM `tecnica_por_paso` WHERE tecnica_por_paso.id_nota_tecnologia_independiente=$id_nota_tecnologia_independiente;DELETE FROM `nota_tecnologica_independiente` WHERE nota_tecnologica_independiente.id_nota_tecnologica_independiente=$id_nota_tecnologia_independiente";
            $a1=$conexion->prepare($a);
            $a1->execute(array());  
            echo$a="SELECT tecnologia.id_tecnologia  from tecnologia,informeacademico WHERE  informeacademico.ano='$ano' and  informeacademico.id_grado='$id_g'    and informeacademico.id_curso='$id_c'   and informeacademico.id_jornada_sede='$id_jornada_sede'     and   informeacademico.id_informe_academico=tecnologia.id_informe_academico and  tecnologia.id_competrencia='$id' ";
            $a1=$conexion->prepare($a);
            $a1->execute(array());  
            foreach ($a1 as  $valueQ) { 


            $r1=0;$r2=0;
            $id_m=0;
            $sum=0;
            $cont=0;
            $uno=0;
         "<br><br>".    $tipo_calificaiones1="UPDATE `tecnologia` SET `nota` = ( SELECT SUM(de.su)as f from (SELECT tecnologia.id_tecnologia, SUM(tecnica_por_paso.nota)/COUNT(tecnica_por_paso.nota)*tipo_calificaiones.porceentajes/100 as su FROM nota_tecnologica_independiente,tipo_calificaiones, tecnologia,tecnica_por_paso WHERE tecnologia.id_tecnologia='".$valueQ['id_tecnologia']."'  and tecnologia.id_tecnologia=tecnica_por_paso.id_tecnologia and tecnica_por_paso.id_nota_tecnologia_independiente=nota_tecnologica_independiente.id_nota_tecnologica_independiente and nota_tecnologica_independiente.id_tipo_calificaciones=tipo_calificaiones.numero GROUP by tipo_calificaiones.numero)as de) WHERE `tecnologia`.`id_tecnologia` =".$valueQ['id_tecnologia'];
            $tipo_calificaiones1=$conexion->prepare($tipo_calificaiones1);
            $tipo_calificaiones1->execute(array());  
        }
        ?>

      
        
         <?php
    }else{ ?>

      <script type="text/javascript">
           mensaje2(1,'No se puede eliminar la nota, Actualmente  esta calificada');  
      </script>
        
         <?php
    }
}




?>