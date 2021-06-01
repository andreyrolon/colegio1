 


 <?php

include 'vendor/autoload.php';
$css=file_get_contents('style.css');
$mpdf = new \Mpdf\Mpdf([
	'margin_top' => 4,
	'margin_left' => 4,
	'margin_right' => 4,
	'mirrorMargins' => true
]);
$html='';
 for ($i=0; $i <1	 ; $i++) { 
  
 $html.='<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Título de la WEB">
  <meta name="description" content="Descripción de la WEB">
  
  <link href=" estilo.css" rel="stylesheet" type="text/css" />
 

</head>

<body>
   
        <div class="container">
         

       <table  style="">
    <tbody class="titulcol">
        <tr>
            <td  style=" width: 130px "> 
                <div style=" padding:5px;">
                  <img src="imagenes/foto4.png"  style="width: 70px ; ">
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
            <td  style="width:129px;padding: 0"> 
            <div style="float: left;padding-top: 18px"><h6>NIT: 45566665</h6>
            <h6>DANE: 4322126</h6>
            <h6>Fecha: 03/06/2020</h6>
            <h6>VERSION:1.1</h6></div>
        </td>

 
        </tr>
         
    </tbody>
</table>
<table style="margin-top: 10px">
    <tr class="titul2 centra">
                    <td class="centra2  " colspan="6">INFORMACIÓN DEL ESTUDIANTE</td> 
    </tr>
    <tr class="centra titulcol ">
        <td class="centra2  " style="width:231px">Estudiante:</td>
        <td class="centra2  " style="width:250px">Sede:</td>
        <td class="centra2  " style="width:124px">Jornada:</td>
        <td class="centra2  " style="width:74px">Curso:</td>
        <td class="centra2  " style="width: 60px">Periodo</td>
        <td class="centra2  " style="width:50px">Año:</td>
    </tr>
    <tr class="  ">
        <td  class="centra1  "style="width:230px">ANDERSON ANDREY ROLON TARAZONA</td>
        <td  class="centra1  "style="width:200px">LUIS GABRIEL CASTRO</td>
        <td  class="centra1  "style="">TARDE NOCHE:</td>
        <td  class="centra1  "style="">2020</td>
        <td  class="centra1  "style="">1  -1</td>
        <td class="centra1  ">1</td>
    </tr>
</table>
 
    <div style="margin-top:5px; text-align: center;font-size: 12px">
        <span style="margin: 10px">[S]=superior</span> <span style="margin: 10px">
            [A]=Alto 
        </span>
        <span style="margin: 10px">
              [BS]=Basico
        </span> 
        <span style="margin: 10px">
            [BJ]=Bajo 
        </span>
    </div>
    <div style="margin-top:5px;margin-bottom: 5px ; text-align: center;font-size: 12px">
        <span style="margin: 10px">
            [R]=Retardo
        </span> <span style="margin: 10px">
            [RJ]=Retardo justificado 
        </span>
        <span style="margin: 10px">
            [I]=Inasistencia
        </span> 
        <span style="margin: 10px">
            [IJ]=Inasistencia justificado
        </span>
    </div>

    <div style="font-size: 12px;margin-left: 20px;margin-bottom: 8px;">
                
    </div>';

    for ($i=0; $i <13 ; $i++) {       
    $html.='
        <table style="">
            <thead>
                <tr class="titul2 centra">
                    <td  id="td1">Area/Asignatura</td>
                    <td  id="td2">Desempeño</td>
                    <td  id="td3">inasistencias o retardos</td>
                    <td id="td4">Calificacion</td>
                </tr>

                

                <tr class="centra titulcol ">
                    <td class="centra1  ">LENGUA CASTELLANA</td>
                    <td class="centra1  ">ALTO</td>
                    <td></td>
                    <td class="centra1  ">4.8</td>
                </tr>
                    <tr class="">
                    <td style=" text-align: left;"colspan="3">

                        <div  style=" text-align: left;">


                             



                            <div  >
                                <h6  > B-  Utiliza el discurso oral para establecer acuerdos a partir del reconocimiento de los argumentos shdssdasd asdsadasdsadasd sadasdas dasd<br> B-  Utiliza el discurso oral para establecer acuerdos a partir del reconocimiento de los argumentos shdssdasd asdsadasdsadasd sadasdas dasd</h6>
                                 
                            </div>




                        </div>

                    </td>

                    <td>
                        <center><img src="imagenes/carafeliz.jpg" width="40"></center>
                    </td>

                </tr>

                    
            </thead>
        </table>';
    }
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


$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->AddPage();

  

// Now the right-margin (inner margin on page 2) = 30

 
}
$mpdf->Output();

?>
