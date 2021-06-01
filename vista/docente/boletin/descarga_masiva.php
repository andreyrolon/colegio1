 
<?php   
ini_set("pcre.backtrack_limit", "22900000");
 session_start();
  if(!isset($_SESSION['Session'])){
  header("location: ../../../login.php"); echo($_SESSION['Session']);
}
include '../../../codes/rector/sede.php';
$sede1= new sede(); 

$i=0;
$id=$_GET['id'];
$nombre=$_GET['nombre'];
$sede=$_GET['sede'];
$puesto=$_GET['puesto'];
$avg=$_GET['avg']; 
$p=$_GET['p']; 
 

 $ano=date('Y');

require_once   '../../../mpdf/vendor/autoload.php';

 
$ano=date('Y'); 
$css=file_get_contents('../../../css/style.css');
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',  'format' => [216 , 279],
  'margin_top' => 31.2,
  'margin_left' => 10,
    'margin_right' => 10,
    'margin_bottom' => 14,
  'mirrorMargins' => true,
  'margin_header' => 4.9,
  'margin_footer' => 8.7
]);   

  $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
  $mpdf->useSubstitutions = false; 
  $mpdf->simpleTables = true;
$mpdf->SetFooter('<div style="padding-top:10px">Institucion Educativa Pablo Correa Leon</div>');
$mpdf->SetHeader('
  <div  ><table  style="">
      <tbody class="titulcol">
        <tr>
          <td  style=" width: 130px "> 
            <div style=" padding:5px;">
              <img src="../../../logos/foto4.jpg"  style="width: 70px ; ">
            </div>
          </td>
          <td class="centra" style="width:500px;height: 80px;"  > 
            <h2 style="margin: 0px">
              INTITUCION EDUCATIVO PABLO CORREA LEON
            </h2> 
            <h4 style="margin-top: 2px">
              Resolución de aprobación N°12323 del 2001/02/12 
              <p style="margin-top: 2px">"Educamos para la vida el trabajo"</p> 
            </h4>
            <h3 style="margin-top: 2px">
              HOJA DE MATRICULA
            </h3> 
          </td>
          <td  style="width:155px;padding-left: 10px"> 
            <div style="float: left;padding-top: 18px"><h6>NIT: 45566665</h6>
            <h6>DANE: 4322126</h6>
            <h6>Fecha: 03/06/2020</h6>
            <h6>VERSION:1.1</h6></div>
          </td>
        </tr>
        </tbody>
      </table> <br> </div> ');
      $html='';
      $contad=0;
foreach ($id as $q) { 
  
    
$logros_notas=$sede1->logros_notas($q,1);
          $id_materia_por_periodo=''; 

  
 $html.=' 
  <div class="container">
    
      <table style="margin-top: 10px">
        <tr class="titul2 centra">
          <td class="centra2  " colspan="6">INFORMACIÓN DEL ESTUDIANTE</td> 
        </tr>
        <tr class="centra titulcol ">
          <td class="centra2  " style="width:231px">Estudiante:</td>
          <td class="centra2  " style="width:240px">Sede:</td>
          <td class="centra2  " style="width:154px">Jornada:</td>
          <td class="centra2  " style="width:60px">Curso:</td>
          <td class="centra2  " style="width: 60px">Periodo</td>
          <td class="centra2  " style="width:50px">Año:</td>
        </tr>
        <tr class="  ">
          <td  class="centra1  "style="width:230px">'.$nombre[$i++].'</td>
          <td  class="centra1  "style="width:200px">'.$_GET['sede'].'</td>
          <td  class="centra1  "style="">'.$_GET['jornada'].'</td>
          <td  class="centra1  "style=""> '.$_GET['grado'].'-'.$_GET['curso'].'</td>
          <td  class="centra1  "style="">'.$_GET['p'].'</td>
          <td class="centra1  ">'.$ano.'</td>
        </tr>
      </table><br>
      <table> 

 
        <tr class="titul2 centra ">
          <th style="width:200px" class="centra2">Escala de valorizacion </th>
          <th style="width:130px" class="centra2">SUPERIOR: 9.6 - 10</th>
          <th style="width:154px" class="centra2">ALTO: 8.0 - 9.5</th> 
          <th style="width:149px" class="centra2">BASICO: 6.0 - 7.9</th> 
          <th style="width:149px" class="centra2">BAJO: 1.0 - 5.9</th> 
        </tr>
        <tr class="centra titulcol">
          <td class="centra2  " >
            <h5>
              <center>ESTADISTICAS DE RENDIMIENTO</center>
            </h5>
          </td>
          <td class="centra2">Puesto: '.$puesto[$contad].'</td> 
          <td class="centra2">Promedio Estudiante:'.$avg[$contad].'</td> 
          
          <td class="centra2 " colspan="2" >Promedio del Curso: '.$_GET['grupo'].'</td>
        </tr> 
        <tr class="titul2 centra ">
          <th style="width:200px" class="centra2">Nomenclatura Calificaciones</th>
          <th style="width:130px" class="centra2">[R]=Retardo</th>
          <th style="width:154px" class="centra2">[RJ]=Retardo justificado</th> 
          <th style="width:149px" class="centra2">[I]=Inasistencia</th> 
          <th style="width:149px" class="centra2">[IJ]=Inasistencia justificado</th> 
        </tr>
        <tr class="centra titulcol">
          <td class="centra2  " > 
              <center>Nomenclatura Logros</center>
          </td>
          <td class="centra2">[L]= Logro</td> 
          <td class="centra2">[R]=Recomendación</td> 
          
          <td class="centra2 " colspan="2" >[D]= Dificultad</td>
      
        </tr>
      </table><br>';
      $html.='
      <table style="">
         ';
          $id_materia_por_periodo='';
          foreach ($logros_notas as  $key) { 
            $logro=$key['logro'];
            
            $string = "".$key['nota']."";
            $t      =strlen($string);
            if ($t>2) {
              $nota   =$string[0].$string[1].$string[2];
            }if ($t ==1){ 
              $nota   =$string[0];
            }
            if ($t  ==2){ 
              $nota   =$string[0].$string[1];
            } 
  
            if ($key['nota']<1) {
              $nota=1;
            }
            if(  ($key['nota']>=0 and $key['nota']<6)) {
              $valorizacion     ='Malo';
            }
            $tipo=' ';
            if ($key['tipo']==1) {
              $tipo='L - ';
            }
            if ($key['tipo']==2) {
              $tipo='R - ';
            }
            if ($key['tipo']==3) {
              $tipo='D - ';
            }

            if( ($key['nota']>=6 and $key['nota']<8)) {
              $valorizacion='Basico';
            }
            if ( ($key['nota']>=8 and $key['nota']<9.6)) {
              $valorizacion='Alto';
            }
            if ( ($key['nota']>=9.6 and $key['nota']<=10)) {
              $valorizacion='Superior';
            }
            if ($id_materia_por_periodo!=$key['id_materia_por_periodo']) {
              if ($key['area']==1) {
                $html.='
                <tr class="titul2 centra">
                  <td  id="td1">Area/Asignatura</td>
                  <td  id="td2">Desempeño</td>
                  <td  id="td3">inasistencias o retardos</td>
                  <td id="td4">Calificacion</td>
                </tr>;';
              }
              $html.='
              <tr class="centra titulcol ">
                <td class="centra1  ">'.$key['nombre_materia'].'</td>
                <td class="centra1  ">'.$valorizacion.'</td>
                <td>';
                  $inasistencias=$sede1->inasistenciaa($key['id_area'],$q,$p);
                  foreach ($inasistencias as $kyu) {
                    if ($kyu['inasistencia']==1) {
                      $inasistenciaa='I';
                    }
                    if ($kyu['inasistencia']==2) {
                      $inasistenciaa='Ij';
                    }
                    if ($kyu['inasistencia']==3) {
                      $inasistenciaa='R';
                    }
                    if ($kyu['inasistencia']==4) {
                      $inasistenciaa='RJ';
                    }
                    $html.='[<span style="margin-right: 10px"> '. $inasistenciaa.' '.$kyu['q'].'</span>]';
                  }
                  $html.=' 
                </td>
                <td class="centra1  ">'.$nota.'</td>
              </tr>
              <tr class="">
              <td style=" padding-left:5px; font-size: 11.5px; border:none;text-align: left;"colspan="4">';
            }
            if ($id_materia_por_periodo!=$key['id_materia_por_periodo']) {
              $html.=
              $tipo.' '.$logro;
            }
            if ($id_materia_por_periodo==$key['id_materia_por_periodo']) {
              $html.=' <tr class="">
              <td style=" padding-left:5px;  font-size: 11.5px; text-align: left;border:none;"colspan="4"> '.$tipo.' '.$key['logro'].' </td> </rt>';
            }
            if ($id_materia_por_periodo!=$key['id_materia_por_periodo']) {
              $html.='</td>
              </tr>' ;
            }
            $id_materia_por_periodo=$key['id_materia_por_periodo'];
          }
          $id_tecnologia=0;

$tec=$sede1->logro_tecnica($q,$p);
          foreach ($tec as  $key) { 
            $logro=$key['logro'];
            
            $string = "".$key['nota']."";
            $t      =strlen($string);
            if ($t>2) {
              $nota   =$string[0].$string[1].$string[2];
            }if ($t ==1){ 
              $nota   =$string[0];
            }
            if ($t  ==2){ 
              $nota   =$string[0].$string[1];
            } 
  
            if ($key['nota']<1) {
              $nota=1;
            }
            if(  ($key['nota']>=0 and $key['nota']<6)) {
              $valorizacion     ='Malo';
            }
            $tipo=' ';
            if ($key['tipo']==1) {
              $tipo='L - ';
            }
            if ($key['tipo']==2) {
              $tipo='R - ';
            }
            if ($key['tipo']==3) {
              $tipo='D - ';
            }

            if( ($key['nota']>=6 and $key['nota']<8)) {
              $valorizacion='Basico';
            }
            if ( ($key['nota']>=8 and $key['nota']<9.6)) {
              $valorizacion='Alto';
            }
            if ( ($key['nota']>=9.6 and $key['nota']<=10)) {
              $valorizacion='Superior';
            }
            if ($id_tecnologia!=$key['id_tecnologia']) {
              
                $html.='
                <tr class="titul2 centra">
                  <td  id="td1">Competencias</td>
                  <td  id="td2">Desempeño</td>
                  <td  id="td3">inasistencias o retardos</td>
                  <td id="td4">Calificacion</td>
                </tr>;';
               
              $html.='
              <tr class="centra titulcol ">
                <td class="centra1  ">'.$key['competencia'].'</td>
                <td class="centra1  ">'.$valorizacion.'</td>
                <td>';
                  $inasistencias=$sede1->inasistenciaa($key['id_tecnologia'],$q,$p);
                  foreach ($inasistencias as $kyu) {
                    if ($kyu['inasistencia']==1) {
                      $inasistenciaa='I';
                    }
                    if ($kyu['inasistencia']==2) {
                      $inasistenciaa='Ij';
                    }
                    if ($kyu['inasistencia']==3) {
                      $inasistenciaa='R';
                    }
                    if ($kyu['inasistencia']==4) {
                      $inasistenciaa='RJ';
                    }
                    $html.='[<span style="margin-right: 10px"> '. $inasistenciaa.' '.$kyu['q'].'</span>]';
                  }
                  $html.=' 
                </td>
                <td class="centra1  ">'.$nota.'</td>
              </tr>
              <tr class="">
              <td style=" padding-left:5px; font-size: 11.5px; border:none;text-align: left;"colspan="4">';
            }
            if ($id_tecnologia!=$key['id_tecnologia']) {
              $html.=
              $tipo.' '.$logro;
            }
            if ($id_tecnologia==$key['id_tecnologia']) {
              $html.=' <tr class="">
              <td style=" padding-left:5px;  font-size: 11.5px; text-align: left;border:none;"colspan="4"> '.$tipo.' '.$key['logro'].' </td> </rt>';
            }
            if ($id_tecnologia!=$key['id_tecnologia']) {
              $html.='</td>
              </tr>' ;
            }
            $id_tecnologia=$key['id_tecnologia'];
          }
        $html.='     
      </table>';
      $html.='
      <table   >
        <tr class="titul2 centra">
          <td colspan="3"><strong>Firmas</strong></td>
        </tr>
        <tr class="centra titulcol">
          <td  width="200">Firma docente</td>
          <td  width="200">Firma rector</td>
          <td  width="400" >Observación</td> 
        </tr>
        <tr  >
          <td  height="30"></td>
          <td  height="30"></td>
          <td  height="30" ></td> 
        </tr>
      </table>
      <br>
    </div>
  </body>
</html>';
$mpdf->WriteHTML($html);
 $html='';

  $mpdf->AddPage(); 
}
 




 
$mpdf->Output();
?>