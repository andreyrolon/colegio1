<?php  
    class login
    {
        function logueo($docu,$pass){
            include "./codes/rector/conexion.php";
            session_start();
            $ano=date('Y');
            $sql="SELECT * FROM `docente` WHERE docente.numero_documento='$docu'";
            $sql1=$conexion->prepare($sql);
            $sql1->execute(array());
            $con=$sql1->rowCount();
            $sql2=$sql1->fetchAll();
            if($con>0){
            foreach($sql2 as $login){ 
                $max="SELECT datos.calificaciones, datos.actualizar_asistencia,datos.habilitar_asistencia,datos.personal_acargo,datos.max_inasistencia,datos.max_retardos FROM datos ";
                $max=$conexion->prepare($max);
                $max->execute(array());
                foreach ($max as $kne) {
                    $_SESSION['roll']=2;
                    $_SESSION['personal_acargo']=$kne['personal_acargo'];
                    $_SESSION['max_retardos']=$kne['max_retardos'];
                    $_SESSION['max_inasistencia']=$kne['max_inasistencia'];
                    $_SESSION['actualizar_asistencia']=$kne['actualizar_asistencia'];
                    $_SESSION['habilitar_asistencia']=$kne['habilitar_asistencia'];
                    $_SESSION['calificaciones']=$kne['calificaciones'];
                }
                $max="SELECT escala_academica.desde,escala_academica.hasta,escala_tecnica.desde as desde2,escala_tecnica.hasta as hasta2 FROM escala_tecnica,escala_academica WHERE escala_tecnica.mini=1 and escala_academica.mini=1";
                $max=$conexion->prepare($max);
                $max->execute(array());
                foreach ($max as $kne) {
                    $_SESSION['desde']=$kne['desde'];
                    $_SESSION['desde2']=$kne['desde2'];
                    $_SESSION['hasta']=$kne['hasta'];
                }
                $consultar_nivel="SELECT grado_sede.id_grado FROM grado_sede WHERE grado_sede.titular=".$login['id_docente']; 
                $consultar_nivel1=$conexion->prepare($consultar_nivel);
                $consultar_nivel1->execute(array()); 
                $not=$consultar_nivel1->rowCount();
                $_SESSION['contador']=$not;

                $SELECTe="SELECT MIN(escala_academica.desde)as minimo,MAX(escala_academica.hasta)as maximo,MIN(escala_tecnica.desde)as minimo2,MAX(escala_tecnica.hasta)as maximo2 FROM escala_academica,escala_tecnica";
                $SELECTe=$conexion->prepare($SELECTe);
                $SELECTe->execute(array());
                foreach ($SELECTe as $k) {
                    $_SESSION['minimo']=$k['minimo'];
                    $_SESSION['maximo']=$k['maximo'];
                    $_SESSION['minimo2']=$k['minimo2'];
                    $_SESSION['maximo2']=$k['maximo2'];
                }

                $rdrqq='';
               
                $maxq="SELECT periodo.numero FROM `periodo` WHERE ( curdate()>=fecha_inicio and curdate()<=fecha_fin )  ";
                $maxq=$conexion->prepare($maxq);
                $maxq->execute(array());
                foreach ($maxq as $kne) {
                   $_SESSION['numero'] = $kne['numero']; 
                } 
                  

                $rdr='';
                $rdr1='';
              $maxqqq="SELECT periodo.numero FROM docente_habilitado INNER JOIN periodo on periodo.numero=docente_habilitado.id_periodo WHERE (docente_habilitado.id_docente=".$login['id_docente']." and docente_habilitado.activo_nota=1) or periodo.activar_periodo=1 GROUP by periodo.numero ";
                $maxqqqf=$conexion->prepare($maxqqq);
                $maxqqqf->execute(array()); 
                foreach ($maxqqqf as $knea) {   
                      $aa .=  ','.$knea['numero']; 
                } 
                $_SESSION['id_periodo']=  $aa;


 
                $_SESSION['Pas']=$login['clave'];
                $_SESSION['genero']=$login['genero'];
                $_SESSION['Nom_U']=$login['nombre'];
                $_SESSION['Ape_U']=$login['apellido'];
                $_SESSION['Doc']=$login['numero_documento'];
                $_SESSION['Fot']=$login['foto'];
                $_SESSION['Id_Doc']=$login['id_docente'];
                 $_SESSION['Rol']=$login['rol'];
                 $_SESSION['Session']=(rand(1.50).$login['clave']);
                    header("location: ./vista/docente/inicio/inicio_docente.php");
                 
           }
            
           }else{
            //ADMINSTRADORES VALIDACON SESSION
            echo$admin="SELECT GENERO,FOTO,APELLIDO,NOMBRE,CLAVE,NUMERO_DOCUMENTO,ROL ,ID_ADMIN FROM `administradores` WHERE administradores.NUMERO_DOCUMENTO='$docu'";
            $admin1=$conexion->prepare($admin);
            $admin1->execute(array());
            $con1=$admin1->rowCount();
            $admin2=$admin1->fetchAll();
                if($con1>0){
                    foreach($admin2 as $login){
                            $_SESSION['roll']=1;
                            $_SESSION['Pas']=$login['CLAVE'];
                            $_SESSION['Nom_U']=$login['NOMBRE'];
                            $_SESSION['Ape_U']=$login['APELLIDO'];
                            $_SESSION['Doc']=$login['NUMERO_DOCUMENTO'];
                            $_SESSION['foto']=$login['FOTO'];
                            $_SESSION['genero']=$login['GENERO'];
                            $_SESSION['Id_Doc']=$login['ID_ADMIN'];
                            $_SESSION['Rol']=$login['ROL'];
                            $SELECTe="SELECT MIN(escala_academica.desde)as minimo,MAX(escala_academica.hasta)as maximo,MIN(escala_tecnica.desde)as minimo2,MAX(escala_tecnica.hasta)as maximo2 FROM escala_academica,escala_tecnica";
                            $SELECTe=$conexion->prepare($SELECTe);
                            $SELECTe->execute(array());
                                foreach ($SELECTe as $k) {
                                    $_SESSION['minimo']=$k['minimo'];
                                    $_SESSION['maximo']=$k['maximo'];
                                    $_SESSION['minimo2']=$k['minimo2'];
                                    $_SESSION['maximo2']=$k['maximo2'];
                                }
                            $_SESSION['Session1']=(rand(1.50).$login['CLAVE']);
                            header("location: ./vista/rector/sedes/ver_sede.php");
                        
                    }
                }else{
            //ALUMNO VALIDACON SESSION
                    $ano=date('Y');
                    echo "<br><br><br>";
           echo  $estu="SELECT alumnos.ciudad_nacimiento,alumnos.pais_nacimiento,alumnos.departamento_nacimiento,alumnos.ciudad_expedido,alumnos.pais_expedicion,alumnos.departamento_expedicion,alumnos.nombre,alumnos.apellido,alumnos.id_alumnos,alumnos.foto,alumnos.genero,alumnos.fecha_nacimiento,alumnos.tipo_documento,alumnos.numero_documento,alumnos.edad,alumnos.direccion,alumnos.barrio,alumnos.telefono,alumnos.correo,alumnos.filiacion_salud,alumnos.tipo_sangre,alumnos.estrato,alumnos.sisben_puntaje,alumnos.numero_carnet,informeacademico.id_jornada_sede, grado.nombre as grado , curso.nombre as curso,sede.NOMBRE as sede,jornada.NOMBRE as jornada,jornada.ID_JORNADA,sede.ID_SEDE,curso.id_curso,grado.id_grado,

             alumnos.*,informeacademico.id_informe_academico FROM  grado,curso,jornada,jornada_sede,sede,alumnos,informeacademico WHERE informeacademico.id_alumno=alumnos.id_alumnos and alumnos.numero_documento='$docu' and informeacademico.ano=$ano AND informeacademico.id_grado=grado.id_grado and curso.id_curso=informeacademico.id_curso and jornada_sede.ID_JS=informeacademico.id_jornada_sede and jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA";  echo "<br><br><br>";
            $estu1=$conexion->prepare($estu);
            $estu1->execute(array());
            $con2=$estu1->rowCount();
            $estu2=$estu1->fetchAll();
            if($con2>0){
            foreach($estu2 as $login){
            if(($pass== $login['clavea'])){ 
                 $maxq="SELECT periodo.numero FROM `periodo` WHERE ( curdate()>=fecha_inicio and curdate()<=fecha_fin )  ";
                $maxq=$conexion->prepare($maxq);
                $maxq->execute(array());
                foreach ($maxq as $kne) {
                   $_SESSION['numero'] = $kne['numero']; 
                } 



                $_SESSION['fecha_nacimiento']=$login['fecha_nacimiento'];
                $_SESSION['tipo_documento']=$login['tipo_documento'];
                $_SESSION['numero_documento']=$login['numero_documento'];
                $_SESSION['edad']=$login['edad'];
                $_SESSION['direccion']=$login['direccion'];
                $_SESSION['barrio']=$login['barrio'];
                $_SESSION['telefono']=$login['telefono'];
                $_SESSION['filiacion_salud']=$login['filiacion_salud'];
                $_SESSION['correo']=$login['correo'];
                $_SESSION['tipo_sangre']=$login['tipo_sangre'];
                $_SESSION['estrato']=$login['estrato'];
                $_SESSION['sisben_puntaje']=$login['sisben_puntaje'];
                $_SESSION['numero_carnet']=$login['numero_carnet']; 
                $_SESSION['ciudad_nacimiento']=$login['ciudad_nacimiento'];
                $_SESSION['ciudad_expedido']=$login['ciudad_expedido'];
                $_SESSION['pais_nacimiento']=$login['pais_nacimiento'];
                $_SESSION['pais_expedicion']=$login['pais_expedicion'];
                $_SESSION['departamento_expedicion']=$login['departamento_expedicion'];
                $_SESSION['departamento_nacimiento']=$login['departamento_nacimiento'];

                $_SESSION['roll']=3;
                $_SESSION['id_jornada_sede']=$login['id_jornada_sede'];
                $_SESSION['grado']=$login['grado'];
                $_SESSION['curso']=$login['curso'];
                $_SESSION['sede']=$login['sede'];
                $_SESSION['jornada']=$login['jornada'];
                $_SESSION['ID_JORNADA']=$login['ID_JORNADA'];
                $_SESSION['ID_SEDE']=$login['ID_SEDE'];
                $_SESSION['id_curso']=$login['id_curso'];
                $_SESSION['id_grado']=$login['id_grado']; 
                $_SESSION['Pas']=$login['clavea'];

                $_SESSION['id_informe_academico']=$login['id_informe_academico'];
                $_SESSION['Nom_U']=$login['nombre'];
                $_SESSION['Ape_U']=$login['apellido'];
                $_SESSION['Doc']=$login['numero_documento'];
                $_SESSION['Id_Doc']=$login['id_alumnos'];
                $_SESSION['genero']=$login['genero']; 
                $_SESSION['Foto']=$login['foto'];
                $_SESSION['Session2']=(rand(1.50).$login['clavea']);
                header("location: ./vista/alumno/inicio/inicio.php");
            }else{
                ?>
                <script>alert("Hubo un error con usuario o clave");</script>
                <?php
            } 
                }
            }else{
            //ACUDIENTE VALIDACON SESSION
            echo $acu="SELECT * FROM `acudiente` WHERE alumnos.num_documento='$docu'";
            $acu1=$conexion->prepare($acu);
            $acu1->execute(array());
            $con3=$acu1->rowCount();
            $acu2=$acu1->fetchAll();
                    if($con2>0){
                        foreach($acu2 as $login){
                            echo $pass."/".$login['clavea'];
                if(($pass== $login['clavea'])){
                    session_start();
                 $_SESSION['Pas']=$login['clavea'];
                 $_SESSION['Nom_U']=$login['nombre'];
                 $_SESSION['Ape_U']=$login['apellido'];
                 $_SESSION['Doc']=$login['numero_documento'];
                 $_SESSION['Session2']=(rand(1.50).$login['clavea']);
                    header("location: ./vista/sedes/ver_sede.php");
                }
            }
                    }else{
                    ?>
                    <script>alert("Hubo un4e error con usuario o clave");</script>
                    <?php
                }
            }
                }
            }
       }
 }
    ?>
