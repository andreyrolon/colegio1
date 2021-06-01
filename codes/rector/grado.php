    <?PHP
    class grado{


        //CONSULTAR GRADO_SEDE MUESTRA CURSO EXACTO DE LA SEDE CON LA JORNADA
        function consultar_sede_grado($e){
            include "conexion.php";
             $sql="SELECT grado.nombre as grado, curso.nombre, curso.numero, grado_sede.id_jornada, grado_sede.id FROM grado_sede INNER JOIN grado ON grado.id_grado=grado_sede.id_grado INNER JOIN curso ON curso.id_curso=grado_sede.id_curso $e  ";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        //CONSULTAR CURSO
        function consultar_curso(){
            include "conexion.php";
            $sql="SELECT * FROM curso";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        //CONULTAR GRADO
        function consultar_grado(){
            include "conexion.php";
            $sql="SELECT * FROM grado";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        //REGISTRAR GRADO SEDE
        function registro_grado($id,$nom,$cur,$jor){

            include "conexion.php";
           
                $sql="INSERT INTO `grado_sede`(`id`, `id_grado`, `id_sede`, `id_jornada`, `id_curso`) VALUES ('','$nom','$id','$jor','$cur')";
                $sql1=$conexion->prepare($sql);
                $sql1->execute(array());
              
        }

        //CONSULTAR AREAS 
        function consultar_areas($id){
            include "conexion.php";
              $sql="SELECT area.* FROM area WHERE area.area=1 AND area.nombre not in (SELECT area.nombre FROM area LEFT JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area WHERE area.area=1 and are_grado_sede.id_grado_sede=$id)";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }

        //FUNCION PARA REGISTRAR LAS ASIGNATURAS DEL GRADO SEDE
        function registrar_area_grado($id,$area){
            include "conexion.php";
            foreach ($area as $key) {
                $selec="SELECT area.codigo FROM area WHERE area.id_area=$key";
                $sql1=$conexion->prepare($selec);
                $sql1->execute(array());
                $sql2=$sql1->fetchAll();
                foreach ($sql2 as $value) { 
                    $r=$value['codigo'];
                    if($r==01){
                        $selec1="SELECT area.id_area FROM area WHERE area.codigo=$r AND area.id_area=$key";    
                    }else{
                        $selec1="SELECT area.id_area FROM area WHERE area.codigo=$r";
                    }
                    $sql3=$conexion->prepare($selec1);
                    $sql3->execute(array());
                    $sql4=$sql3->fetchAll();
                    foreach ($sql4 as $key1) {
                        $var=$key1['id_area'];
                        foreach($area as $value){
                        $validar="SELECT * FROM are_grado_sede WHERE id_grado_sede=$id AND id_area=$var";
                        $vali=$conexion->prepare($validar);
                        $vali->execute(array());
                        $inse=$vali->rowCount();
                        if($inse==0){
                        $sql="INSERT INTO `are_grado_sede`(`id_area_grado_sede`, `id_area`, `id_grado_sede`, `id__docente`) VALUES ('','$var','$id','')";
                        $sql5=$conexion->prepare($sql);
                        $sql5->execute(array());
                        }
                    }
                    }
                }
                ?>
            <script>
                alert("Se a agregado el area");
            </script>
            <?php
            }

        }

        //FUNCION PARA CONSULTAR LAS ASIGNATURAS DEL GRADO SEDE
        function consultar_areas_grado($id){
            include "conexion.php";
            $sql="SELECT area.*, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area WHERE are_grado_sede.id_grado_sede=$id GROUP BY area.id_area";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $count=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            return array($count,$sql2);

        }
        
     
        
        //CONSULTA NOMBRE DE LA SEDE Y DEL CURSO
        function consultar_sede_grados($e){
            include "conexion.php";
              $sql="SELECT grado.nombre as grado, curso.nombre, curso.numero, grado_sede.id_jornada_sede, grado_sede.id, sede.NOMBRE AS sede, jornada.NOMBRE as jornada FROM grado,curso,sede,jornada,jornada_sede,grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado_sede.id_jornada_sede=jornada_sede.ID_JS and grado_sede.id_curso=curso.id_curso and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA and  
$e  ";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        //FUNCION PARA ELIMINAR ASIGNATURAS Y TODA EL AREA
        function eliminar_asignatura($e,$f){
            include "conexion.php";
       echo     $con="SELECT id_are_grado_sede FROM are_grado_sede WHERE id_area=$e";
            $con1=$conexion->prepare($con);
            $con1->execute(array());
            $con2=$con1->rowCount();
            if($con2 == 0){ 
                $sele="SELECT area.codigo FROM area WHERE area.id_area=$e";
                $selec=$conexion->prepare($sele);
                $selec->execute(array());
                $se=$selec->fetchAll();
                foreach($se as $r){ 
                    $va=$r[0];
                    if ($va!=01) {
                       $cod="SELECT id_area FROM area WHERE codigo=$va";
                       $codi=$conexion->prepare($cod);
                       $codi->execute(array());
                       $co=$codi->fetchAll();
                       foreach($co as $key){   
                           $sql="DELETE FROM `are_grado_sede` WHERE id_area=$key[0] and id_grado_sede=$f";
                           $sql1=$conexion->prepare($sql);
                           $sql1->execute(array());
                       }
                    }
                    else{
                        $sql="DELETE FROM `are_grado_sede` WHERE id_area=$e and id_grado_sede=$f";
                        $sql1=$conexion->prepare($sql);
                        $sql1->execute(array());
                    }
                }
            }else{
                ?>
                <script>
                    alert('No se puede eliminar esta asignatura tiene notas regstradas');
                </script>
                <?php
            }
        }

        //FUNTION PARA COSULTAR DOCENTES PARA AGREGAR A ASIGNATURA
        function consultar_docente($e){
            include "conexion.php";
             $sql="SELECT docente.id_docente, docente.nombre, docente.apellido FROM docente $e";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $sql2=$sql1->fetchAll();
            return $sql2;

        }
        
        //FUNCION PARA AGREGAR Y ACTUALIZAR EL DOCENTE DEL GRADO SEDE
        function actualizar_area_grado_sede($id,$doc,$id_g){
            include "conexion.php";
        
            
            $sql="UPDATE `are_grado_sede` SET `id__docente`=$doc WHERE id_area=$id";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            ?>
            <script> alert('Docente asignado');</script>
            <?php
             
        }
        
         
        
  

    }

    ?>