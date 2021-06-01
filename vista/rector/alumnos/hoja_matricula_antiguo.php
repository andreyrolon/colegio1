
  
 <?php
 session_start();
  if(!isset($_SESSION['Session1'])){
  header("location: ../../../login.php"); echo($_SESSION['Session']);
}

$desplazado='NO';
$desmovilizado='NO';
$hijos_desmovilizado='NO';
$afrocolombiano='NO';
$etnia='NO';
$familia_accion='NO';
$proviene_bienestar='NO';
$subsidiado='NO';
$discapacidad='NO';
$pae='NO';
$nuevo="No"; 
 if ($_GET['desplazado']!='') {
	$desplazado='SI';	
}if ($_GET['desmovilizado']!='') {
	$desmovilizado='SI';	
}if ($_GET['hijos_desmovilizado']!='') {
	$hijos_desmovilizado='SI';	
}if ($_GET['afrocolombiano']!='') {
	$afrocolombiano='SI';	
}if ($_GET['etnia']!='') {
	$etnia='SI';	
}if ($_GET['familia_accion']!='') {
	$familia_accion='SI';	
}if ($_GET['proviene_bienestar']!='') {
	$proviene_bienestar='SI';	
}if ($_GET['subsidiado']!='') {
	$subsidiado='SI';	
}if ($_GET['discapacidad']!='') {
	$discapacidad='SI';	
}if ($_GET['pae']!='') {
	$pae='SI';	
}


$js=$_GET['jornada_sede']; 
$porcion=explode(' ',$_GET['curso']);
$c=$porcion[0];
$g=$porcion[1];
require_once "../../../codes/rector/sede.php";
$sedeq=new Sede();
$curso_array=$sedeq->curso($c,$g,$js);
$acudi=$sedeq->acudiente($_GET["id_alumnos"]);
foreach ($curso_array as  $value) {
	$curso=$value['numero'];
	$grado=$value['grado'];
	$sede=$value['sede'];
	$jornada=$value['jornada'];
} 
$nombres_acu="";
$email="";
$parentesco="";
foreach ($acudi as  $val) {
	$nombres_acu.='
	<tr class="centra">
		<td class="anchor1"  >'.$val['nombre'].'</td>
		<td class="anchor1"   >'.$val['apellido'].'</td>
		<td class="anchor1" >'.$val['tipo_documento'].'</td>
		<td class="anchor1" >'.$val['num_documento'].'</td>
		<td class="anchor1" >'.$val['expedida'].'</td>
    </tr>';
    $parentesco.='
			<tr class="centra">
				<td class="anchor1">'.$val['parentesco'].'</td>
				<td class="anchor1">'.$val['direccion'].'</td>
				<td class="anchor1">'.$val['barrio'].'</td>
				<td class="anchor1">'.$val['celular'].'</td>
				<td class="anchor1">'.$val['ocupacion'].'</td>
			</tr>';
	$email.='
			<tr class="centra">
				<td class="anchor1"	 colspan="2">'.$val['email'].'</td>
				<td colspan="2">'.$val['direccion_trabajo'].'</td>
				<td>'.$val['telefono_trabajo'].'</td>
	        </tr>';
 
  }
  echo($nombres_acu);
require_once   '../../../mpdf/vendor/autoload.php';

date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$ano=date('Y');
$css=file_get_contents('../../../css/style2.css');
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',  'format' => [216 , 279],
  
    'autoMarginPadding' => 5,
  'margin_top' => 31.2,
  'margin_left' => 10,
    'margin_right' => 10,
    'margin_bottom' => 14, 
  'margin_header' => 4.9,
  'margin_footer' => 7.7 ,

  'mirrorMargins' => true,

]);   

$mpdf->SetFooter('<div style="padding-top:10px">Institucion Educativa Pablo Correa Leon</div>');

 
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
            <strong style="font-size:18px">
            	INTITUCION EDUCATIVO PABLO CORREA LEON
            </strong>
            <h3 style="margin-top: 2px">
              Resolución de aprobación N°12323 del 2001/02/12 
              <p style="margin-top: 2px">"Educamos para la vida el trabajo"</p> 
            </h3>
            <h2 style="margin-top: 2px">
              Hoja de Matricula
            </h2> 
          </td>
          <td   class="centra1"  style="width:110px;" > 
         <h3 class="centra"  style="margin-top: 2px">  
         <nav style="margin: 12px" >NIT: 45566665</nav>
 
 
DANE: 4322126
Fecha: 03/06/2020
VERSION:1.1</p> 
            </h3> 
		            
		         
		 
          </td>
        </tr>
        </tbody>
      </table></div> ');
$html='';

  
 $html.=' 
<table style="padding-left: 25px;padding-right:  10px;padding-top: 5px;width:780px">
	<tbody>
		<tr class="titul2 centra">
			<td colspan="5">Datos Personales</td>
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1" >Nombre</td>
			<td class="anchor1" >Apellido</td>
			<td class="anchor1" >Tipo De Documento</td>
			<td class="anchor1"  >Documento</td>
			<td>Foto</td>
		</tr>
		<tr class="centra1 ">
			<td class="anchor1"  >'.$_GET['nombre'].'</td>
			<td class="anchor1"  >'.$_GET['apellido'].'</td>
			<td class="anchor1"   >'.$_GET['tipo_documento'].'</td>
			<td class="anchor1">'.$_GET['numero_documento'].'</td>
			<th rowspan="6	"  style="padding: 0px;width: 100px; background: #fff"> <img src="'.$_GET['foto'].'" style="width: 98px; " > </th>
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1">Pais De Expedicion</td>
			<td class="anchor1">Departamento De Nacimiento</td>
			<td class="anchor1">Ciudad De Expedicion</td>
			<td class=" anchor1 borde_foto">Genero</td>
		</tr>
		<tr class="centra1">
			<td class="anchor1">'.$_GET['pais_expedicion'].'</td>
			<td class="anchor1">'.$_GET['estado_expedicion'].'</td>
			<td class="anchor1">'.$_GET['ciudad_expedicion'].'</td>
			
			<td class="anchor1">MASCULINO</td>
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1">Pais De Nacimiento</td>
			<td class="anchor1">Departamento De Nacimiento</td>
			<td class="anchor1">Ciudad De Naciminto</td>
			<td class=" anchor1 borde_foto">F De Nacimiento</td> 
        </tr>
        
        <tr class="centra1">
			<td class="anchor1">'.$_GET['pais_nacimiento'].'</td>
			<td class="anchor1">'.$_GET['estado_nacimiento'].'</td>
			<td class="anchor1">'.$_GET['ciudad_nacimiento'].'</td>
			<td class="anchor1">'.$_GET['fecha_nacimiento'].'</td> 
        </tr>
        
        <tr class=" centra titulcol">
			<td class="anchor1"   >
				Telefono
			</td>
			<td class="anchor1">Dirreccion</td>
			<td class="anchor1">Barrio</td>
			<td class="anchor1  borde_foto" >Correo</td>
			
        </tr>

        
        <tr class=" centra1">
			<td  class="anchor1"  >
				'.$_GET['telefono_alumno'].'
			</td>
			<td class="anchor1" > '.$_GET['direccion_alumno'].'</td>
			<td class="anchor1">'.$_GET['barrio_alumno'].'</td>
			<td class="anchor1" colspan="2">'.$_GET['correo_alumno'].'</td>
        </tr>
        </tbody>
</table>
<table style="padding-left: 25px;padding-right:  10px;padding-top: 5px;width:780px">
	<tbody>
        
        <tr class="titul2 centra">
			<td colspan="5">Datos De Salud</td>
        </tr>
        
        <tr class="titulcol centra">
			<td class="anchor1" >Edad</td>
			<td class="anchor1" >Tipo De Sangre</td>
			<td class="anchor1" >Afiliado en salud</td>
			<td class="anchor1" >Nivel De Sisven</td>
			<td class="anchor1" >Numero   Sisben</td>
			<td class="anchor1" >Estrato</td>
        </tr>

        <tr >
			<td class="anchor1">'.$_GET['edad'].' </td>
			<td class="anchor1">'.$_GET['tipo_sangre'].'</td>
			<td class="anchor1">'.$_GET['afiliado'].'</td>
			<td class="anchor1">'.$_GET['sisben_puntaje'].'</td>
			<td class="anchor1">'.$_GET['numero_carnet'].'</td>
			<td class="anchor1">'.$_GET['estrato'].'</td>
        </tr>
	</tbody>
</table>
 

<table style="padding-left: 25px;padding-right:  10px;width: 780px">
	<tbody>
		<tr class="titul2 centra">
			<td colspan="7">Datos Adicionales</td>
		</tr>
		<tr class="titulcol centra"> 
			<td class="anchor1" style="width: 80px">Desplazado</td>
			<td class="anchor1"  style="width: 210px">Municipio Expulsor</td>
			<td class="anchor1" style="">Desmovilizado</td>
			<td class="anchor1" style="">H. Desmovilizados</td>
			<td class="anchor1" style="">Afrocolombiano</td>
			<td class="anchor1"  >	Familias A.</td>
			<td class="anchor1" style="padding-left: 10px;padding-right: 9px">PAE</td>
		</tr>
		<tr class="centra">
			<td class="anchor1">'.$desplazado.'</td>
			<td class="anchor1">'.$_GET['municipio_Expulsor'].'</td>
			<td class="anchor1">'.$desmovilizado.'</td>
			<td class="anchor1">'.$hijos_desmovilizado.'</td>
			<td class="anchor1">'.$afrocolombiano.'</td>
			<td class="anchor1">'.$familia_accion.'</td>
			 
			<td class="anchor1">'.$pae.'</td> 
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1">Etnia</td>
			<td  class="anchor1" >Cual</td>
			
			<td class="anchor1">Bienestar f.</td>
			<td class="anchor1">Subsidiado</td>
			<td class="anchor1">Vive con</td> 
			<td class="anchor1" colspan="2">Discapacidad</td> 
		</tr>
		 
		<tr class="centra1">
			<td class="anchor1" >'.$etnia.'</td>
			<td class="anchor1" >'.$_GET['cual_etnia'].'</td>
			<td class="anchor1" >'.$proviene_bienestar.'</td>
			<td class="anchor1"   >'.$subsidiado.'</td>
			<td class="anchor1" >'.$_GET['vive'].'</td> 
			<td class="anchor1"  colspan="2">'.$discapacidad.'</td>
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1" colspan="2">Cual Discapacidad</td>
			<td class="anchor1" colspan="2">Habilidades Especiales</td>
			<td class="anchor1" colspan="3">Otros Talentos</td> 
			
		</tr>
		<tr class="centra">
			<td  class="anchor1" colspan="2"> '.$_GET['cual_discapacidad'].'</td> 
			<td  class="anchor1" colspan="2">'.$_GET['capacidad_excepcional'].'</td>
			<td  class="anchor1" colspan="3">'.$_GET['otros_talentos'].'</td>
			
		</tr>
	</tbody>
</table>


<table style="padding-left: 25px;padding-right:  10px;  ">
	<tbody>
		<tr class="centra titul2">
			<td colspan="5">Datos Acudiente</td>
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1" style="width: 170px">Nombre</td>
			<td class="anchor1" style="width: 170px">Apellido</td>
			<td class="anchor1" style=" width: 150px; ">Tipo de    Documento</td>
			<td class="anchor1" style=" width: 100px;padding-left: 2px;padding-right: 2px">N.   Documento</td>
			<td class="anchor1" style="width: 152px">Lugar De Expedicion</td>
		</tr>'.$nombres_acu;
		 
	 
		 
	 	$html.='
		<tr class="titulcol centra">
			<td class="anchor1">Parentesco</td>
			<td class="anchor1">Direccion</td>
			<td class="anchor1">Barrio</td>
			<td class="anchor1">Telefono</td>
			<td class="anchor1">Ocupacion</td>
		</tr>'.$parentesco;
		 
		
		 
		$html.='
		<tr class="centra titulcol">
			<td  class="anchor1" colspan="2">Correo</td>
			<td  class="anchor1" colspan="2">Direccion De Trabajo</td>
			<td class="anchor1" >Telefono Del Trabajo</td>
		</tr>'.$email;
		 
	 
		$html.='
        
        
	</tbody>
</table>

<table style="padding-left: 25px;padding-right:  10px;width: 776px">
	<tbody>
		<tr class="titul2 centra">
			<td colspan="7">Datos Institucionales</td>
		</tr>
		<tr class="titulcol centra">
			<td class="anchor1" colspan="2" style="width: 276px">Sede</td>
			<td class="anchor1" style="padding-left: 70px;padding-right: 70px">Jornada</td>
			<td class="anchor1" style="padding-left: 10px;padding-right: 10px">Curso</td> 
			<td class="anchor1" style="padding-left: 10px;padding-right: 10px">Periodo</td> 
			<td colspan="2" class="anchor1"   style="padding-left: 10px;padding-right: 10px">Metodologia</td>
			 
		</tr>
		<tr class="centra">
			<td class="anchor1" colspan="2">'.$sede.'</td>
			<td class="anchor1">'.$jornada.'</td>
			<td class="anchor1">'.$grado.'-'.$curso.'</td>
			<td class="anchor1">'.$_GET['id_periodo'].'</td>
			<td colspan="2" class="anchor1">'.$_GET['metodologia'].'</td> 
		</tr>
		<tr class="titulcol centra">
			<td class=" " style="width:100px">Nuevo</td>
			<td class="anchor1" colspan="2	">Proviene De</td>
			<td class="anchor1" >Fecha </td> 
			<td class="anchor1" style="padding: 1px">Año </td>
			<td colspan="2" class="anchor1" style="padding: 1px">Estado</td>
		</tr>
		 
	 
		<tr class="centra">
			<td class=" " style="width:100px">No</td>
			<td class="anchor1" colspan="2	">	</td> 
			<td class="anchor1">'.$fecha.'</td>
			<td class="anchor1">'.$_GET["ano"].'</td>
			<td colspan="2" class="anchor1">Matriculado</td>
		</tr>
	</tbody>
</table> 


 <div style="  color:#494d54; padding-left: 25px;padding-right:  10px; font-size: 11px">
 	"El estudiante y el acudiente acetan  comprometersen en el cumplimiento del manual de convivencia, incluyendo las normas  tomadas por los directivos de la institución."
 </div>
  
<table style="border:none;margin-bottom:12.5px">
	<tbody>
	 
		<tr   style="border:none">
			<td style="padding-right: 10px;width:  200px;border:none"><br><br>
			_____________________________________________<br>firma del Estudiante</td>
			<td style="padding-right: 10px;width:  200px;border:none"><br><br>____________________________________<br>firma del Docente</td>
			<td style="padding-right: 10px;width:  200px;border:none"><br><br>____________________________________<br>firma del Rector</td>  
		</tr>
		 
		 
		 
	</tbody>
</table><br><br> 


<table style="padding-left: 25px;padding-right:  10px; ">
	<tbody>
		<tr class="centra titul2">
			<td colspan="3">Retiro del Estudiante </td>
		</tr>
		<tr class="titulcol centra">
			<td style="width: 110px">Fecha</td>
			<td style="  width: 440px">motivo</td>
			<td style="width: 190px">Firma acudiente</td>  
		</tr>
		<tr class="centra">
			<td style="height: 20px"><br><br></td>
			<td><br><br><br></td>
			<td><br><br></td> 
		</tr>
		 
		 
	</tbody>
</table>
  


</div>
 
   ';


$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

	 
$mpdf->Output();
?>

 