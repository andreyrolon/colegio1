<?php 

if ($_GET)
{
    $action = $_GET["action"];
    if (function_exists($action))
    {
        call_user_func($action);
    }
}
function ver_estadisticas(){
    include "../../codes/rector/conexion.php";
    $periodo=$_POST['periodo'];
    $asignatura=$_POST['asignatura'];
    $porciones = explode(",", $asignatura);
    $curso=$_POST['curso'];
    $porciones2 = explode(" ", $curso);
    $ano=date('Y');
    $jornada_sede1=$_POST['jornada_sede1'];
    $input=$_POST['input'];
    if ($porciones[4]>0) {
         
         $sql=" 


SELECT q.nota,q.nombre,q.apellido from (select alumnos.nombre,alumnos.apellido, tecnologia.nota FROM alumnos,  tecnologia,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$porciones2[0]'  and informeacademico.id_curso='$porciones2[1]'   and informeacademico.id_jornada_sede='$jornada_sede1'  and informeacademico.id_informe_academico=tecnologia.id_informe_academico and tecnologia.id_competrencia='$porciones[2]'   AND alumnos.id_alumnos=informeacademico.id_alumno)as q WHERE q.nota like ('%$input%') or q.nombre like ('%$input%') or q.apellido like ('%$input%')  ORDER BY q.nota";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 


        $sqlw="SELECT desde,hasta,nombre FROM `escala_academica` ORDER BY desde";
        $sql1w=$conexion->prepare($sqlw);
        $sql1w->execute(array()); 
        $text='';
        $t='';
        $text1='';
        $t1='';
        $text12='';
        $t12='';
        foreach ($sql1w as   $value) {
              $text= mb_convert_case($value['nombre']  , MB_CASE_TITLE, "UTF-8").': '.$value['desde'].' - '.$value['hasta'];
              $t.='"'.$text.'",' ;

              $text1=$value['desde'].','.$value['hasta'];
              $t1.=$text1.',' ;

              $text12=mb_convert_case($value['nombre']  , MB_CASE_TITLE, "UTF-8") ;
              $t12.=$text12.',' ;

        } 
          $t;
        $porcion1=explode(',', $t12);
        $i=$porcion1[0];
        $a=$porcion1[1];
        $s=$porcion1[2];
        $e=$porcion1[3];




        $porcion=explode(',', $t1);
        $i1=$porcion[0];
        $i2=$porcion[1];
        $a1=$porcion[2];
        $a2=$porcion[3];
        $s1=$porcion[4];
        $s2=$porcion[5];
        $e1=$porcion[6];
        $e2=$porcion[7];         
        ?>
 
        <style type="text/css">
            .sp{
                color: #fff;
                padding: 5px;
                border-radius: 3px
            }
            #footer_tr{
                border: solid 2px #d5d5d5;
                background: #EEE;
            }
            .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec82
        }
        td{
            border: 1px solid #d5d5d5;
            text-align: center;
        }
        th{
            border: 1px solid #d5d5d5;
            text-align: center;
        }
        </style>
        <canvas id="myChart" width="100" height="50" class="responsive"></canvas>
        <br><br>
        <canvas id="myChart1" width="100" height="50" class="responsive"></canvas>
        <br><br>

        <span onclick="var input= document.getElementById('input').value; estadistica(input)" style="    
        background-color: #EEE;
        border: solid 1px #d5d5d5;
        padding: 4px;
        border-radius: 2px;">
            Buscar
        </span> <input style="border: solid 1px #d5d5d5;     height: 25px;" class="form- "  id="input" type="text"><br><br>
        <center>
            <table class="table ">
            <tr id="footer_tr">
                <th>N°</th>
                <th>tipo N</th>
                <th>nota</th>
                <th style="padding-right: 60px">nombre del estudiante</th>
            </tr>
            <?php 
            $cont=1;
            $mayor=0;
            $menor=0;
            $conw4=0;
            $conw3=0;
            $conw2=0;
            $conw1=0;

            foreach ($sql1 as $value) {

                if ($value['nota']>6) {
                    $mayor++;
                }
                if ($value['nota']<6) {
                    $menor++;
                }

                if ($value['nota']>=$e1 && $value['nota']<=$e2) {
                   $color='rgb(66, 134,244,0.5);';
                   $conw4++;
                   $nom=$e;
                }
                elseif ($value['nota']>=$s1 && $value['nota']<$e1) {
                   $color='rgb(74, 135,72,0.5);';
                   $conw3++;
                   $nom=$s;
                }
                elseif ($value['nota']>=$a1 && $value['nota']<$s2) {
                   $color='rgb(243, 174,62,0.5);';
                   $conw2++;
                   $nom=$a;
                }else   {
                   $color='rgb(229, 89,50,0.5);';
                   $conw1++;
                   $nom=$i;
                }

                 ?>
                
                <tr class="ee">
                    <td> <?php echo $cont++ ?></td>
                <td> <span class="sp" style="  background: <?php echo $color ?>"><?php echo $nom ?></span></td>
                <td> 
                    <?php  $string = "".$value['nota']."";
                                    $t1=strlen($string);
                                    if ($t1>2) {
                                       $hu=$string[0].$string[1].$string[2];
                                    }if ($t1==1){ 
                                        $hu=$string[0];
                                    }
                                    if ($t1==2){ 
                                        $hu=$string[0].$string[1];
                                    }
                                     echo $hu  ?>
                        
                    </td>
                <td> <span><?php echo  mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8") ?></span></td>
                </tr>
                
                <?php
            }

             ?>
        </table>
        </center>
        <script type="text/javascript"> 
            if (window.Barra) {
                window.Barra.clear();
                window.Barra.destroy();
            }


                var ctx=document.getElementById('myChart1').getContext('2d');
                    var myChart= new Chart(ctx,{
                        type:'pie',
                        data:{
                            labels:[<?php       echo $t; ?>
                            ],
                            datasets:[{
                                label:'numen',
                                data:[<?php echo $conw1 ?>,<?php echo $conw2 ?>,<?php echo $conw3 ?>,<?php echo $conw4 ?>],

                                backgroundColor:[
                                    'rgb(229, 89,50,0.5)',
                                    'rgb(243, 174,62,0.5)',
                                    'rgb(74, 135,72,0.5)',
                                    'rgb(66, 134,244,0.5)'
                                ]
                            }]
                        },

                        options:{
                 scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });








var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
                          labels: ['Perdidos', 'Aprobados'],
                          datasets: [{
                            label: '  Perdidos',
                            data: [<?php echo $menor ?>, ] ,
                            backgroundColor:[ 
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                            borderColor:[ 
                                    'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                                ],
                                 borderWidth: 1,
                            
                          } , {
                label: 'Aprovados',
                data: [ ,<?php echo $mayor ?> ] ,
                            backgroundColor:[  
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                            borderColor:[ 
                                      'rgba(54, 162, 235, 1)',
                                      'rgba(54, 162, 235, 1)',
                                ],
                                 borderWidth: 1,
                //fill:false
              }]
                        },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
}); 


 
        </script>
        <?php
    }
else{
        
        
        $sql="SELECT q.nota,q.nombre,q.apellido from (select alumnos.nombre,alumnos.apellido, materia_por_periodo.nota FROM alumnos,  materia_por_periodo,informeacademico WHERE informeacademico.ano='$ano' and  informeacademico.id_grado='$porciones2[0]'  and informeacademico.id_curso='$porciones2[1]'   and informeacademico.id_jornada_sede='$jornada_sede1'  and informeacademico.id_informe_academico=materia_por_periodo.id_informe_academico and materia_por_periodo.id_area='$porciones[2]'  and materia_por_periodo.periodo='$periodo' AND alumnos.id_alumnos=informeacademico.id_alumno)as q WHERE q.nota like ('%$input%') or q.nombre like ('%$input%') or q.apellido like ('%$input%')  ORDER BY q.nota";
        $sql1=$conexion->prepare($sql);
        $sql1->execute(array()); 


        $sqlw="SELECT desde,hasta,nombre FROM `escala_academica` ORDER BY desde";
        $sql1w=$conexion->prepare($sqlw);
        $sql1w->execute(array()); 
        $text='';
        $t='';
        $text1='';
        $t1='';
        $text12='';
        $t12='';
        foreach ($sql1w as   $value) {
              $text= mb_convert_case($value['nombre']  , MB_CASE_TITLE, "UTF-8").': '.$value['desde'].' - '.$value['hasta'];
              $t.='"'.$text.'",' ;

              $text1=$value['desde'].','.$value['hasta'];
              $t1.=$text1.',' ;

              $text12=mb_convert_case($value['nombre']  , MB_CASE_TITLE, "UTF-8") ;
              $t12.=$text12.',' ;

        } 
          $t;
        $porcion1=explode(',', $t12);
        $i=$porcion1[0];
        $a=$porcion1[1];
        $s=$porcion1[2];
        $e=$porcion1[3];




        $porcion=explode(',', $t1);
        $i1=$porcion[0];
        $i2=$porcion[1];
        $a1=$porcion[2];
        $a2=$porcion[3];
        $s1=$porcion[4];
        $s2=$porcion[5];
        $e1=$porcion[6];
        $e2=$porcion[7];         
        ?>
 
        <style type="text/css">
            .sp{
                color: #fff;
                padding: 5px;
                border-radius: 3px
            }
            #footer_tr{
                border: solid 2px #d5d5d5;
                background: #EEE;
            }
            .ee:hover{
            border:solid 2px #C9C7C7;
            background-color: #ececec82
        }
        td{
            border: 1px solid #d5d5d5;
            text-align: center;
        }
        th{
            border: 1px solid #d5d5d5;
            text-align: center;
        }
        </style>
        <canvas id="myChart" width="100" height="50" class="responsive"></canvas>
        <br><br>
        <canvas id="myChart1" width="100" height="50" class="responsive"></canvas>
        <br><br>

        <span onclick="var input= document.getElementById('input').value; estadistica(input)" style="    
        background-color: #EEE;
        border: solid 1px #d5d5d5;
        padding: 4px;
        border-radius: 2px;">
            Buscar
        </span> <input style="border: solid 1px #d5d5d5;     height: 25px;" class="form- "  id="input" type="text"><br><br>
        <center>
            <table class="table ">
            <tr id="footer_tr">
                <th>N°</th>
                <th>tipo N</th>
                <th>nota</th>
                <th style="padding-right: 60px">nombre del estudiante</th>
            </tr>
            <?php 
            $cont=1;
            $mayor=0;
            $menor=0;
            $conw4=0;
            $conw3=0;
            $conw2=0;
            $conw1=0;

            foreach ($sql1 as $value) {

                if ($value['nota']>6) {
                    $mayor++;
                }
                if ($value['nota']<6) {
                    $menor++;
                }

                if ($value['nota']>=$e1 && $value['nota']<=$e2) {
                   $color='rgb(66, 134,244,0.5);';
                   $conw4++;
                   $nom=$e;
                }
                elseif ($value['nota']>=$s1 && $value['nota']<$e1) {
                   $color='rgb(74, 135,72,0.5);';
                   $conw3++;
                   $nom=$s;
                }
                elseif ($value['nota']>=$a1 && $value['nota']<$s2) {
                   $color='rgb(243, 174,62,0.5);';
                   $conw2++;
                   $nom=$a;
                }else   {
                   $color='rgb(229, 89,50,0.5);';
                   $conw1++;
                   $nom=$i;
                }

                 ?>
                
                <tr class="ee">
                    <td> <?php echo $cont++ ?></td>
                <td> <span class="sp" style="  background: <?php echo $color ?>"><?php echo $nom ?></span></td>
                <td> 
                    <?php  $string = "".$value['nota']."";
                                    $t1=strlen($string);
                                    if ($t1>2) {
                                       $hu=$string[0].$string[1].$string[2];
                                    }if ($t1==1){ 
                                        $hu=$string[0];
                                    }
                                    if ($t1==2){ 
                                        $hu=$string[0].$string[1];
                                    }
                                     echo $hu  ?>
                        
                    </td>
                <td> <span><?php echo  mb_convert_case($value['nombre']." ".$value['apellido'], MB_CASE_TITLE, "UTF-8") ?></span></td>
                </tr>
                
                <?php
            }

             ?>
        </table>
        </center>
        <script type="text/javascript"> 
            if (window.Barra) {
                window.Barra.clear();
                window.Barra.destroy();
            }


                var ctx=document.getElementById('myChart1').getContext('2d');
                    var myChart= new Chart(ctx,{
                        type:'pie',
                        data:{
                            labels:[<?php       echo $t; ?>
                            ],
                            datasets:[{
                                label:'numen',
                                data:[<?php echo $conw1 ?>,<?php echo $conw2 ?>,<?php echo $conw3 ?>,<?php echo $conw4 ?>],

                                backgroundColor:[
                                    'rgb(229, 89,50,0.5)',
                                    'rgb(243, 174,62,0.5)',
                                    'rgb(74, 135,72,0.5)',
                                    'rgb(66, 134,244,0.5)'
                                ]
                            }]
                        },

                        options:{
                 scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });








var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
                          labels: ['Perdidos', 'Aprobados'],
                          datasets: [{
                            label: '  Perdidos',
                            data: [<?php echo $menor ?>, ] ,
                            backgroundColor:[ 
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                            borderColor:[ 
                                    'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                                ],
                                 borderWidth: 1,
                            
                          } , {
                label: 'Aprovados',
                data: [ ,<?php echo $mayor ?> ] ,
                            backgroundColor:[  
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                            borderColor:[ 
                                      'rgba(54, 162, 235, 1)',
                                      'rgba(54, 162, 235, 1)',
                                ],
                                 borderWidth: 1,
                //fill:false
              }]
                        },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
}); 


 
        </script>
        <?php
    }









    
 
}


 ?>