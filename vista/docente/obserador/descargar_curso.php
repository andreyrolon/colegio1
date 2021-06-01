 
  
 <?php
 session_start();
  if(!isset($_SESSION['Session'])){
  header("location: ../../../login.php"); echo($_SESSION['Session']);
}


include('../../../codes/docente/observador.php');
$obser=new observador();  
  
require_once   '../../../mpdf/vendor/autoload.php';

 
$ano=date('Y');
require_once   '../../../mpdf/vendor/autoload.php';

 
$ano=date('Y'); 
$css=file_get_contents('../../../css/style1.css');
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',  'format' => [216 , 279],
  'margin_top' => 31.2,
  'margin_left' => 10,
    'margin_right' => 10,
    'margin_bottom' => 14,
  'mirrorMargins' => true,
  'margin_header' => 4.9,
  'margin_footer' => 8.7
]);   

  $mpdf->useSubstitutions = false; 
  $mpdf->simpleTables = true;

  $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetHeader('
  	<div  ><table  style="">
      <tbody class="titulcol">
        <tr>
          <td  style=" width: 130px "> 
            <div style=" padding:5px;">
              <img src="../../../logos/foto4.png"  style="width: 70px ; ">
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
              OBSERVADOR DEL ALUMNO
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

$nombre=$_GET['nombre'];
$apellido=$_GET['apellido'];
$sum=0;
foreach ($_GET['id'] as $q) {  

	$acu=$obser->consutar_estudiante_acudiente($q);
	$observacion=$obser->consutar_observacion($q);
	$html.='
	<table style="width:900px; padding-left: 25px;padding-right:  10px;padding-top: 5px">
		 <tbody>
			<tr class="titul2 centra">
				<td colspan="5">Datos Del Estudiante</td>
			</tr>';
		$num_alumno=0;
		$i=0;
		foreach ($acu as   $value) {
			$i++;
			if($num_alumno!=$value['num_alumno']){ 
				$html.=' 
				<tr class="titulcol centra">
					<td class="anchor1" >Nombre</td>
					<td class="anchor1" >Apellido</td>
					<td class="anchor1" >Tipo De Documento</td>
					<td class="anchor2"  >Documento</td>
					<td>Foto</td>
				</tr>
				<tr class="centra1 ">
					<td class="anchor1"  >'.$nombre[$sum].'</td>
					<td class="anchor1"  >'.$apellido[$sum].'</td>
					<td class="anchor1"   >'.$value['tipo_alumno'].'</td>
					<td class="anchor2">'.$value['num_alumno'].'</td>
					<th rowspan="6	"  style="padding: 0px;width: 100px;height: 110px;background: #fff"> <img src="'.$value['foto'].'" style="width: 90px;height: 119px"> </th>
				</tr>
				<tr class="titulcol centra">
					<td class="anchor1">Sede</td>
					<td class="anchor1">Jornada</td>
					<td class="anchor1">Curso</td>
					<td class=" anchor2 borde_foto">Año</td>
				</tr>
				<tr class="centra1">
					<td class="anchor1">'.$_GET['sede'].'</td>
					<td class="anchor1">'.$_GET['jornada'].'</td>
					<td class="anchor1">'.$_GET['curso'].'</td>
					
					<td class="anchor2">'.date('Y').'</td>
				</tr>
				<tr class="titulcol centra">
					<td class="anchor1">Barrio</td>
					<td class="anchor1">Direccion</td>
					<td class="anchor1">Telefono</td>
					<td class=" anchor2 borde_foto">Vive con</td>
				</tr>
				<tr class=" centra">
					<td class="anchor1">'.$value['b'].'</td>
					<td class="anchor1">'.$value['d'].'</td>
					<td class="anchor1">'.$value['t'].'</td>
					<td class=" anchor2 borde_foto">'.$value['vive'].'</td>
				</tr>';	
			}

		 
			if($num_alumno!=$value['num_alumno']){ 
				$html.=' 
				<tr class="titul2 centra">
					<td colspan="4">Datos Del Acudiente</td>
				</tr>
				<tr class="titulcol centra">
					<td class="anchor1">Nombre Del acudiente</td>
					<td class="anchor1">Apellido Del acudiente</td>
					<td class="anchor1">Tipo De Documento</td>
					<td colspan="2" class=" anchor2 borde_foto">Numero de documento</td> 
		        </tr>';
		    }
		    $html.='
		    <tr class="centra1">
				<td class="anchor1">'.$value['nombre'].'</td>
				<td class="anchor1">'.$value['apellido'].'</td>
				<td class="anchor1">'.$value['tipo_documento'].'</td>
				<td colspan="2" class=" anchor2 borde_foto">'.$value['num_documento'].'</td> 
	        </tr>';
	        $num_alumno=$value['num_alumno'];
	    }

	    $html.=' 
	    <tr class="titulcol centra">
			<td class="anchor1">Barrio</td>
			<td class="anchor1">Dirección</td>
			<td class="anchor1">Telefono</td>
			<td class=" anchor2 borde_foto">Parentesco</td>
			<td>Compromiso</td> 
	    </tr>';
	     

		foreach ($acu as   $value) {
	        $num_alumno=$value['num_alumno'];
	        $html.=' 
	      
	        <tr class="centra">
				<td class="anchor1">'.$value['barrio'].'</td>
				<td class="anchor1">'.$value['direccion'].'</td>
				<td class="anchor1">'.$value['celular'].'</td>
				<td class=" anchor2 borde_foto">'.$value['parentesco'].'</td>
				<td></td> 
	        </tr>';
		}


	$html.='</table><br>

	<table style="width:900px; padding-left: 25px;padding-right:  10px;padding-top: 5px">';
	     
	   	$periodo=0;
		foreach ($observacion as   $valueq) {
			if ($valueq['periodo']!=$periodo) {
				 
				$html.=' 
		        <tr class="titul2 centra">
					<td colspan="5">Observador '.$valueq['periodo'].'p</td>
		        </tr>';
		    }
		    $periodo=$valueq['periodo'];
	        $html.=' 
	        
	        <tr class="titulcol centra">
					<td class="anchor3">Fecha</td>
				<td class="anchor2">Categoria</td>
				<td class="tipo">Tipo </td>
				<td colspan="2" class=" anchor2 borde_foto">Docente </td>
				
	        </tr>

	        <tr class="  centra">
					<td class="anchor3"> '.$valueq['fecha'].'</td>
				<td class="anchor2"> '.$valueq['categoria'].'</td>
				<td class="tipo"> '.$valueq['tipo'].'</td>
				<td colspan="2"  > '.$valueq['nombre'].'</td>
				
	        </tr>

	        <tr class="titulcol centra">
				<td colspan="4">Descripcion Del evento</td>
				<td>Area</td>
				 
	        </tr>
	        <tr class="  ">
				<td class="descripcion" colspan="4">'.$valueq['descripcion'].' </td>
				<td>'.$valueq['area'].'</td> x	
				 
	        </tr>

	        <tr class="titulcol centra">
				<td colspan="4">Compromiso</td>
				<td>Firma Estudiante	</td>
				 
	        </tr>
	        <tr class="  centra">
				<td rowspan="3" class="compromiso" colspan="4">'.$valueq['compromiso'].'</td>
				<td class="firma">  </td>
				 
	        </tr>
	          <tr class="titulcol centra"> 
				<td>Firma Acudiente</td>
				 
	        </tr>
	        <tr class=" centra"> 
				<td class="firma"></td> 
	        </tr>';
	    }
	$html.=' </table>';

 

 	$sum++;

$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
 $html='';

  $mpdf->AddPage(); 
}
 




 
$mpdf->Output();

?>

 