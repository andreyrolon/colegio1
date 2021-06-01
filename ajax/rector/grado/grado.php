


<?php 
if ($_GET)
{
  $action = $_GET["action"];
  if (function_exists($action))
  {
    call_user_func($action);
  }
}


/////////////////////////////////////// funciones de la pagina de la vista grado grado_por_materia.php
function todo_los_grados(){

  include "../../conexion.php";
  $consultar_nivel=" SELECT grado.* FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado GROUP by grado.nombre order by grado.numero";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $todo=$consultar_nivel1->fetchAll(); ?>
  <table class="table table-bordered">
          <thead>
            <tr> 
              <th>grado</th>

              <th>materias</th> 

              <th>nuevo</th> 
            </tr>
          </thead>
          <tbody>
            <?php foreach ($todo as $key ) {
              ?>
            <tr>
              <td><?php echo $key['nombre'] ?></td>
              <td><?php 
                $consultar_nivel=" SELECT area.codigo, are_grado_sede.id_area_grado_sede,are_grado_sede.id_area,are_grado_sede.id_grado_sede,area.nombre FROM are_grado_sede,area WHERE area.area=1 AND are_grado_sede.id_area=area.id_area and are_grado_sede.id_grado_sede in(SELECT grado_sede.id FROM grado_sede WHERE grado_sede.id_grado=".$key['id_grado'].") GROUP BY area.nombre";
                $consultar_nivel1=$conexion->prepare($consultar_nivel);
                $consultar_nivel1->execute(array()); 

        $consultar_nivel12s=$consultar_nivel1->rowCount();
        $e=0;
foreach ($consultar_nivel1 as $ty ) {
echo $ty['nombre'];
$e=$e+1;
if ($e!=$consultar_nivel12s) {
  echo ", ";
}
}
                ?>

              </td>
              <td><a href="grado_por_materia2.php?id=<?php echo $key['id_grado']; ?>"  ><img style="width: 40px;height: 40px" src="data:image/svg+xml;base64,
        PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iNTEyIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIuMDAwMDEgNTEyIiB3aWR0aD0iNTEyIj48Zz48ZyBpZD0ic3VyZmFjZTEiPgo8cGF0aCBkPSJNIDUxMiAyNTYgQyA1MTIgMzk3LjM4NjcxOSAzOTcuMzg2NzE5IDUxMiAyNTYgNTEyIEMgMTE0LjYxMzI4MSA1MTIgMCAzOTcuMzg2NzE5IDAgMjU2IEMgMCAxMTQuNjEzMjgxIDExNC42MTMyODEgMCAyNTYgMCBDIDM5Ny4zODY3MTkgMCA1MTIgMTE0LjYxMzI4MSA1MTIgMjU2IFogTSA1MTIgMjU2ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig5Mi45NDExNzYlLDUxLjM3MjU0OSUsMTcuMjU0OTAyJSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjRUQ4MzJDIj48L3BhdGg+CjxwYXRoIGQ9Ik0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIEwgNDYxLjQ0MTQwNiA0MDguNzczNDM4IEMgNDE0Ljc3NzM0NCA0NzEuNDI1NzgxIDM0MC4xMjg5MDYgNTEyIDI1Ni4wMDM5MDYgNTEyIEMgMjI0Ljg0Mzc1IDUxMiAxOTQuOTkyMTg4IDUwNi40Mjk2ODggMTY3LjM3NSA0OTYuMjMwNDY5IEMgMTYzLjEzMjgxMiA0OTQuNjc1NzgxIDE1OC45NDE0MDYgNDkzLjAwMzkwNiAxNTQuODE2NDA2IDQ5MS4yMTQ4NDQgQyAxMTMuMTk1MzEyIDQ3My4yOTY4NzUgNzcuMjkyOTY5IDQ0NC42NTYyNSA1MC41NjY0MDYgNDA4Ljc3MzQzOCBMIDUwLjU2NjQwNiAyNC4wMTk1MzEgTCAzNzAuODc4OTA2IDI0LjAxOTUzMSBaIE0gNDYxLjQ0MTQwNiAxMTQuNTgyMDMxICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4Ni4yNzQ1MSUsOTIuNTQ5MDIlLDk3LjY0NzA1OSUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RDRUNGOSI+PC9wYXRoPgo8cGF0aCBkPSJNIDE1OC4wNDY4NzUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTEwLjc0NjA5NCBMIDM1My45NTMxMjUgMTM3LjM5MDYyNSBMIDE1OC4wNDY4NzUgMTM3LjM5MDYyNSBaIE0gMTU4LjA0Njg3NSAxMTAuNzQ2MDk0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTExLjM1NTQ2OSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxNjUuNjAxNTYyIEwgNDAwLjY0NDUzMSAxOTIuMjQ2MDk0IEwgMTExLjM1NTQ2OSAxOTIuMjQ2MDk0IFogTSAxMTEuMzU1NDY5IDE2NS42MDE1NjIgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwLjU4ODIzNSUsMTcuMjU0OTAyJSwzOC4wMzkyMTYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiMxQjJDNjEiPjwvcGF0aD4KPHBhdGggZD0iTSAxMTEuMzU1NDY5IDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDIyMC40NTcwMzEgTCA0MDAuNjQ0NTMxIDI0Ny4wOTc2NTYgTCAxMTEuMzU1NDY5IDI0Ny4wOTc2NTYgWiBNIDExMS4zNTU0NjkgMjIwLjQ1NzAzMSAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAuNTg4MjM1JSwxNy4yNTQ5MDIlLDM4LjAzOTIxNiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iIzFCMkM2MSI+PC9wYXRoPgo8cGF0aCBkPSJNIDM3MC44Nzg5MDYgMTE0LjU4MjAzMSBMIDM3MC44Nzg5MDYgMjQuMDE5NTMxIEwgNDYxLjQ0MTQwNiAxMTQuNTgyMDMxIFogTSAzNzAuODc4OTA2IDExNC41ODIwMzEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRkZGRkYiPjwvcGF0aD4KPHBhdGggZD0iTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgTCAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODEuNDcyNjU2IDMxNS41IFogTSAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgTCAxNTIuMTk1MzEyIDQwMy4zNjcxODggTCAxNjAuMTI4OTA2IDM3OS41NDI5NjkgTCAxODYuMzc1IDM3Ni4wMjczNDQgWiBNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiAiIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoODUuODgyMzUzJSw3NS42ODYyNzUlLDY0LjcwNTg4MiUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0RCQzFBNSI+PC9wYXRoPgo8cGF0aCBkPSJNIDYzLjgwNDY4OCAxNzYuOTI5Njg4IEwgNi4wNTg1OTQgMjM0LjY3NTc4MSBDIC0yLjE0NDUzMSAyNDIuODc1IC0yIDI1Ni4yMTg3NSA2LjM3ODkwNiAyNjQuMjQ2MDk0IEwgMzYuNzY5NTMxIDI5My44MTY0MDYgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSA2My44MDQ2ODggMTc2LjkyOTY4OCBMIDI3LjkxMDE1NiAyMTIuODI0MjE5IEMgMTkuNzA3MDMxIDIyMS4wMjczNDQgMTkuODUxNTYyIDIzNC4zNjcxODggMjguMjI2NTYyIDI0Mi4zOTQ1MzEgTCA1OC4wMzkwNjIgMjcxLjQwMjM0NCBMIDEyMS41MzEyNSAyMDQuNDk2MDk0IEwgOTIuNjc5Njg4IDE3Ni41NjI1IEMgODQuNTQyOTY5IDE2OC44MzU5MzggNzEuNzM0Mzc1IDE2OSA2My44MDQ2ODggMTc2LjkyOTY4OCBaIE0gNjMuODA0Njg4IDE3Ni45Mjk2ODggIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDEyMi4zMjAzMTIgMjA1LjI1IEwgMjM2Ljk2MDkzOCAzMTQuMDUwNzgxIEMgMjI1LjI2MTcxOSAzMjYuMzc4OTA2IDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMzguMTAxNTYyIDM1Ny41NzAzMTIgQyAyMjUuNzY5NTMxIDM0NS44NjcxODggMjA2LjI4MTI1IDM0Ni4zNzUgMTk0LjU3ODEyNSAzNTguNzA3MDMxIEMgMTgyLjg3ODkwNiAzNzEuMDM5MDYyIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxOTUuNzE4NzUgNDAyLjIyNjU2MiBDIDE4My4zODY3MTkgMzkwLjUyNzM0NCAxNjMuODk4NDM4IDM5MS4wMzUxNTYgMTUyLjE5OTIxOSA0MDMuMzYzMjgxIEwgMzcuNTU4NTk0IDI5NC41NjY0MDYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMC41ODgyMzUlLDE3LjI1NDkwMiUsMzguMDM5MjE2JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjMUIyQzYxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTIyLjMyMDMxMiAyMDUuMjUgTCAyMzYuOTYwOTM4IDMxNC4wNTA3ODEgQyAyMjUuMjYxNzE5IDMyNi4zNzg5MDYgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIzOC4xMDE1NjIgMzU3LjU3MDMxMiBDIDIyNS43Njk1MzEgMzQ1Ljg2NzE4OCAyMDYuMjgxMjUgMzQ2LjM3NSAxOTQuNTc4MTI1IDM1OC43MDcwMzEgTCA3OS45Mzc1IDI0OS45MTAxNTYgWiBNIDEyMi4zMjAzMTIgMjA1LjI1ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigyMy45MjE1NjklLDM0LjUwOTgwNCUsNTYuODYyNzQ1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjM0Q1ODkxIj48L3BhdGg+CjxwYXRoIGQ9Ik0gMTAxLjEyODkwNiAyMjcuNTgyMDMxIEwgMjM4LjA5NzY1NiAzNTcuNTcwMzEyIEMgMjI1Ljc2OTUzMSAzNDUuODY3MTg4IDIwNi4yODEyNSAzNDYuMzc4OTA2IDE5NC41NzgxMjUgMzU4LjcwNzAzMSBDIDE4Mi44Nzg5MDYgMzcxLjAzOTA2MiAxODMuMzg2NzE5IDM5MC41MjczNDQgMTk1LjcxNDg0NCA0MDIuMjI2NTYyIEwgNTguNzQ2MDk0IDI3Mi4yMzgyODEgWiBNIDEwMS4xMjg5MDYgMjI3LjU4MjAzMSAiIHN0eWxlPSJmaWxsOiMyQTQwN0EiIGRhdGEtb3JpZ2luYWw9IiMyQTQwN0EiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiBzdHJva2U6bm9uZWZpbGwtcnVsZTpub256ZXJvO3JnYigxNi40NzA1ODglLDI1LjA5ODAzOSUsNDcuODQzMTM3JSk7ZmlsbC1vcGFjaXR5OjE7Ij48L3BhdGg+CjxwYXRoIGQ9Ik0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgQyAxMzAuMTk1MzEyIDIwMi4yMDcwMzEgMTMxLjU2MjUgMjA1LjUxOTUzMSAxMzEuNjQ4NDM4IDIwOC44NjMyODEgQyAxMzEuNzM4MjgxIDIxMi4yMDMxMjUgMTMwLjU0Njg3NSAyMTUuNTgyMDMxIDEyOC4wNTQ2ODggMjE4LjIwMzEyNSBMIDUwLjc5Mjk2OSAyOTkuNjE3MTg4IEMgNDUuODIwMzEyIDMwNC44NTU0NjkgMzcuNTQ2ODc1IDMwNS4wNzQyMTkgMzIuMzA0Njg4IDMwMC4xMDE1NjIgQyAyOS42ODM1OTQgMjk3LjYwOTM3NSAyOC4zMTY0MDYgMjk0LjMwMDc4MSAyOC4yMzA0NjkgMjkwLjk1NzAzMSBDIDI4LjE0MDYyNSAyODcuNjE3MTg4IDI5LjMzMjAzMSAyODQuMjM4MjgxIDMxLjgyNDIxOSAyODEuNjEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1Ljg4MjM1MyUsNzUuNjg2Mjc1JSw2NC43MDU4ODIlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQkMxQTUiPjwvcGF0aD4KPHBhdGggZD0iTSAxMjcuNTcwMzEyIDE5OS43MTg3NSBDIDEzMC4xOTUzMTIgMjAyLjIwNzAzMSAxMzEuNTYyNSAyMDUuNTE5NTMxIDEzMS42NDg0MzggMjA4Ljg2MzI4MSBDIDEzMS43MzgyODEgMjEyLjIwMzEyNSAxMzAuNTQ2ODc1IDIxNS41ODIwMzEgMTI4LjA1NDY4OCAyMTguMjAzMTI1IEwgNzQuMDQ2ODc1IDI3NS4xMTMyODEgQyA2OS4wNzAzMTIgMjgwLjM1NTQ2OSA2MC44MDA3ODEgMjgwLjU3MDMxMiA1NS41NTg1OTQgMjc1LjU5NzY1NiBDIDUyLjkzNzUgMjczLjEwOTM3NSA1MS41NzAzMTIgMjY5Ljc5Njg3NSA1MS40ODA0NjkgMjY2LjQ1NzAzMSBDIDUxLjM5NDUzMSAyNjMuMTEzMjgxIDUyLjU4NTkzOCAyNTkuNzM0Mzc1IDU1LjA3ODEyNSAyNTcuMTEzMjgxIEwgMTA5LjA4NTkzOCAyMDAuMjAzMTI1IEMgMTE0LjA1ODU5NCAxOTQuOTYwOTM4IDEyMi4zMzIwMzEgMTk0Ljc0NjA5NCAxMjcuNTcwMzEyIDE5OS43MTg3NSBaIE0gMTI3LjU3MDMxMiAxOTkuNzE4NzUgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk5LjYwNzg0MyUsODguNjI3NDUxJSw3Mi45NDExNzYlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNGRUUyQkEiPjwvcGF0aD4KPHBhdGggZD0iTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgTCAyNzQuMzc4OTA2IDQzNC40NDE0MDYgTCAyMTEuNzk2ODc1IDQxOC41MjczNDQgQyAyMTMuNTUwNzgxIDQxMS41OTc2NTYgMjE2LjQ4NDM3NSA0MDQuODgyODEyIDIyMC41ODU5MzggMzk4LjcyNjU2MiBDIDIyMi42MTcxODggMzk1LjY2Nzk2OSAyMjQuOTM3NSAzOTIuNzQ2MDk0IDIyNy41NDY4NzUgMzg5Ljk5NjA5NCBDIDIzNS40Mjk2ODggMzgxLjY4NzUgMjQ1IDM3NS45NDE0MDYgMjU1LjIxNDg0NCAzNzIuNzc3MzQ0IFogTSAyNTUuMjE0ODQ0IDM3Mi43NzczNDQgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDk0LjkwMTk2MSUsMjYuMjc0NTElLDMzLjMzMzMzMyUpO2ZpbGwtb3BhY2l0eToxOyIgZGF0YS1vcmlnaW5hbD0iI0YyNDM1NSI+PC9wYXRoPgo8cGF0aCBkPSJNIDI3NC4zNzg5MDYgNDM0LjQ0MTQwNiBMIDIxMS43OTY4NzUgNDE4LjUyNzM0NCBDIDIxMy41NTA3ODEgNDExLjU5NzY1NiAyMTYuNDg0Mzc1IDQwNC44ODI4MTIgMjIwLjU4NTkzOCAzOTguNzI2NTYyIFogTSAyNzQuMzc4OTA2IDQzNC40NDE0MDYgIiBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDg1LjQ5MDE5NiUsMTQuOTAxOTYxJSwyNC4zMTM3MjUlKTtmaWxsLW9wYWNpdHk6MTsiIGRhdGEtb3JpZ2luYWw9IiNEQTI2M0UiPjwvcGF0aD4KPHBhdGggZD0iTSAzNDEuNDU3MDMxIDQ1Ny40NjQ4NDQgTCAzMDYuNjQwNjI1IDQyMi42NTIzNDQgTCAzMjEuNDIxODc1IDQwNy44NzEwOTQgTCAzNDEuNDU3MDMxIDQyNy45MTAxNTYgTCAzOTAuNDkyMTg4IDM3OC44Nzg5MDYgTCA0MDUuMjY5NTMxIDM5My42NTYyNSBaIE0gMzQxLjQ1NzAzMSA0NTcuNDY0ODQ0ICIgc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYig4NS40OTAxOTYlLDE0LjkwMTk2MSUsMjQuMzEzNzI1JSk7ZmlsbC1vcGFjaXR5OjE7IiBkYXRhLW9yaWdpbmFsPSIjREEyNjNFIj48L3BhdGg+CjwvZz48L2c+IDwvc3ZnPg==" /></a>              



              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table><?php
}
/////////////////////////////////////// fin de las funciones de la pagina de la vista grado grado_por_materia2.php







/////////////////////////////////////// funciones de la pagina de la vista grado grado_por_materia2.php
function tabla_grado_por_materia()
{   
  if(isset($_POST['id_grado'])){
    $t=$_POST['id_grado'];
  }else{
    $t='';
  }
  include '../../conexion.php';
  $consultar_nivel=" SELECT area.codigo, are_grado_sede.id_area_grado_sede,are_grado_sede.id_area,are_grado_sede.id_grado_sede,area.nombre FROM are_grado_sede,area WHERE area.area=1 AND are_grado_sede.id_area=area.id_area and are_grado_sede.id_grado_sede in(SELECT grado_sede.id FROM grado_sede WHERE grado_sede.id_grado=$t) GROUP BY area.nombre";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $todo=$consultar_nivel1->fetchAll();
       

 ?>


  <form method="post" id="elimini"> 
     

     <div class="table-responsive mailbox-messages">
<input type="hidden" name="identificador" value="<?php echo($t) ?>" id="identificador">
      <table class="table table-bordered">
        <thead>
          <tr> 
            <th>#</th> 
            <th>Areas</th>

            <th>Asignaturas</th> 
            <th>eliminar</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($todo as $key ) {
            ?>
            <tr id="uuu<?php echo $key['id_area'] ?>" >
              <td><input type="checkbox" name="<?php echo 'dm[]' ?>"  value="<?php echo $key['id_area'] ?>">  </td>
              <td><?php echo $key['nombre'] ?></td>

              <td>             
                <?php  


                $consultar_nivel="SELECT area.* FROM area WHERE area.area=0 and area.codigo=".$key['codigo'];
                $consultar_nivel1=$conexion->prepare($consultar_nivel);
                $consultar_nivel1->execute(array());



                $consultar_nivel12s=$consultar_nivel1->rowCount();
                $t=0;
                foreach ($consultar_nivel1 as $value) {
                  $t=$t+1;
                  echo' '. $value['nombre'];
                  if ($t!=$consultar_nivel12s) {
                   echo ", ";
                 }

               } ?>


             </td>
             <td>

              <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $key['id_area'] ?>"><img style="width: 35px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>              
          
                     <div class="modal fade" id="mymodal<?php echo  $key['id_area']?>" data-keyboard="" data-backdrop="">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              <p> estás seguro de eliminar la sede   ?</p>

                            </div>
                            <div class="modal-footer">  
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              <input type="hidden" value='<?php echo $value["ID_JORNADA"]?>'  name="Aceptarr">
                   <button type="button" data-dismiss="modal" name="Aceptar" id="dsd" value='<?php echo $value["ID_JORNADA"]?>'  class="btn btn-primary"
                                  onclick="myFunction3(<?php echo $key['id_area']?>); 
                                  ">Aceptar</button> 
                              </div>


                            </div>
                          </div>
                        </div>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div> <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> 
    <button type="button" class="btn btn-default btn-sm" id="myBtn2"><i class="fa fa-trash-o"></i></button>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Confirmación</h4>
        </div>
        <div class="modal-body"> 
          <p><strong>Nota:</strong> Está seguro de eliminar la jornada?

.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            <button type="submit" class="btn btn-primary" id="uuu"  onclick="
        $('#myModal2').modal('hide');"  >Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </form>
  <script type="text/javascript">
 
  $(document).ready(function(){ 


      var id_grado=document.getElementById("id_grado").value; 
 

        function tabla_de_areas_y_asignaturas_disponibles(){
       $.ajax({   
        type: "post",

        data:{id_grado}, 
        url:"../../../ajax/rector/grado/grado.php?action=tabla_de_areas_y_asignaturas_disponibles",
        dataType:"text", 

        success:function(data){  
          $('#tabla_de_areas_y_asignaturas_disponibles').html(data); 


        }  


      }); 
     }

   $(document).on("submit", "#elimini", function(e){
        e.preventDefault();
        $.ajax({
          type: "post",
           url:"../../../ajax/rector/grado/grado.php?action=elimini", 
          data: $(this).serialize(),
          dataType:"text", 
          success: function(data)
          {  

     tabla_de_areas_y_asignaturas_disponibles();
            $('#_MSG2_').html(data);  

             
          }
        });
      }); 

      $("#myBtn2").click(function(){ 
        $("#myModal2").modal();
      });
      });
      </script> 
 <?php
   include('../../../vista/rector/enlaces/footer.php'); 
}
    


function registrar_relacion_grado_areas(){
  include '../../conexion.php';
  $ts=$_POST['area'];
  $i=$_POST['id_grado'];
  
  foreach ($ts as $t ) {
    ?> 
    <?php
    $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array());
    $consultar_nivel12=$consultar_nivel1->fetchAll(); 
    foreach ($consultar_nivel12 as $key ) {


      $id=$key['id'];
      $consultar_nivel="INSERT INTO `are_grado_sede` (`id_area_grado_sede`, `id_area`, `id_grado_sede`, `id__docente`) VALUES (NULL, '$t', '$id', '')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 

      $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll(); 
      foreach ($consultar_nivel12 as $key ) {

          
        $id_area=$key['id_area'];
         $consultar_nivel="INSERT INTO `are_grado_sede` (`id_area_grado_sede`, `id_area`, `id_grado_sede`, `id__docente`) VALUES (NULL, '$id_area', '$id', '')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
      }
    } 
  }

  echo "<script type='text/javascript'>mensaje(3,'has relacionado las areas  con el grado');</script>";
}
 


function eliminar_relacion_area_asignaturas(){
 
  if(isset($_POST['id_grado'])){
    $i=$_POST['id_grado'];
  }else{
    $i='';
  }
  if(isset($_POST['dsd'])){
    $t=$_POST['dsd'];
  }else{
    $t='';
  }
      $u=0;
      $u1=0;
          include "../../conexion.php";
      $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll(); 
      foreach ($consultar_nivel12 as $key ) {


        $id=$key['id'];
        $consultar_nivel="SELECT * FROM `are_grado_sede` WHERE are_grado_sede.id_area=$t AND are_grado_sede.id_grado_sede=$id AND  are_grado_sede.id__docente  NOT  IN ('0')";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 
 
        foreach ($consultar_nivel1 as $keys ) {
          $keys[0]; 
          $u1=$u1+1;             
        }

        $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array()); 



        foreach ($consultar_nivel1 as $keys ) {
          $id_area=$keys['id_area'];
          
          $consultar_nivel="SELECT are_grado_sede.id_grado_sede FROM `are_grado_sede` WHERE are_grado_sede.id_area=$id_area AND are_grado_sede.id_grado_sede=$id AND  are_grado_sede.id__docente  NOT  IN ('0')";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
 
          foreach ($consultar_nivel1 as $keys ) {
            $keys[0]; 
            $u=$u+1;             
          }
        }
        
      }



      if ($u==0 && $u1==0 ){
        $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        foreach ($consultar_nivel12 as $key ) {


          $id=$key['id'];
          $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 

          $consultar_nivel12ss=$consultar_nivel1->fetchAll(); 
          foreach ($consultar_nivel12ss as $ssa ) {
            $ss=$ssa['id_area'];
               
            $consultar_nivel="DELETE  FROM `are_grado_sede` WHERE are_grado_sede.id_area=$ss AND are_grado_sede.id_grado_sede=$id ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 
          }  
          $consultar_nivel="DELETE  FROM `are_grado_sede` WHERE are_grado_sede.id_area=$t AND are_grado_sede.id_grado_sede=$id ";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array());  
        }      
      }



        if ($u1!=0) {?>
          <script type="text/javascript"> mensaje2(1,'tiene profesores')</script><?php

        }
    }

function elimini(){
 
   
    if(isset($_POST['dm'])){
    $tt=$_POST['dm'];
    }else{
      $tt='';
    }
    if(isset($_POST['identificador'])){
    $i=$_POST['identificador'];
    }else{
      $i='';
    }
  if ($i=="" or $tt=='') {?>
    <script type="text/javascript">mensaje2(2,'Campos vacios')</script><?php
  }else{ 
    foreach ($tt as $t ) {
     
        $u=0;
        $u1=0;
            include "../../conexion.php";
        $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $consultar_nivel12=$consultar_nivel1->fetchAll(); 
        foreach ($consultar_nivel12 as $key ) {


          $id=$key['id'];
          $consultar_nivel="SELECT * FROM `are_grado_sede` WHERE are_grado_sede.id_area=$t AND are_grado_sede.id_grado_sede=$id AND  are_grado_sede.id__docente  NOT  IN ('0')";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 
   
          foreach ($consultar_nivel1 as $keys ) {
            $keys[0]; 
            $u1=$u1+1;             
          }

          $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array()); 



          foreach ($consultar_nivel1 as $keys ) {
            $id_area=$keys['id_area'];
            
            $consultar_nivel="SELECT * FROM `are_grado_sede` WHERE are_grado_sede.id_area=$id_area AND are_grado_sede.id_grado_sede=$id AND  are_grado_sede.id__docente  NOT  IN ('0')";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 
   
            foreach ($consultar_nivel1 as $keys ) {
              $keys[0]; 
              $u=$u+1;             
            }
          }
          
        }

 

        if ($u==0 && $u1==0 ){ 
?> <script>
$("#uuu<?php echo $t ?>").remove();

       </script><?php
          $consultar_nivel="SELECT grado_sede.id FROM grado , grado_sede WHERE grado_sede.id_grado=grado.id_grado and grado.id_grado=$i";
          $consultar_nivel1=$conexion->prepare($consultar_nivel);
          $consultar_nivel1->execute(array());
          $consultar_nivel12=$consultar_nivel1->fetchAll(); 
          foreach ($consultar_nivel12 as $key ) {


            $id=$key['id'];
            $consultar_nivel="SELECT area.nombre,area.codigo,area.id_area FROM area WHERE area.area NOT in(1) AND area.codigo in (SELECT area.codigo FROM area WHERE area.id_area='$t' and area.area=1 AND area.codigo NOT in('01'))";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array()); 

            $consultar_nivel12ss=$consultar_nivel1->fetchAll(); 
            foreach ($consultar_nivel12ss as $ssa ) {
              $ss=$ssa['id_area'];
                 
              $consultar_nivel="DELETE  FROM `are_grado_sede` WHERE are_grado_sede.id_area=$ss AND are_grado_sede.id_grado_sede=$id ";
              $consultar_nivel1=$conexion->prepare($consultar_nivel);
              $consultar_nivel1->execute(array()); 
            }  
            $consultar_nivel="DELETE  FROM `are_grado_sede` WHERE are_grado_sede.id_area=$t AND are_grado_sede.id_grado_sede=$id ";
            $consultar_nivel1=$conexion->prepare($consultar_nivel);
            $consultar_nivel1->execute(array());  
          }      
        }


        if ($u1!=0) {?>
          <script type="text/javascript"> mensaje2(1,'tiene profesores')</script><?php

        }
    }
  }



}

  function tabla_de_areas_y_asignaturas_disponibles(){

  if(isset($_POST['id_grado'])){
    $e=$_POST['id_grado'];
  }else{
    $e='';
  }
  include '../../conexion.php';
      $consultar_nivel=" SELECT area.* FROM area WHERE area.area=1 AND area.nombre not in (SELECT area.nombre FROM are_grado_sede,area WHERE are_grado_sede.id_area=area.id_area and are_grado_sede.id_grado_sede in(SELECT grado_sede.id FROM grado_sede WHERE grado_sede.id_grado=$e))";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12=$consultar_nivel1->fetchAll();



      ?>
      <thead>
                    <tr>
                      <th>#</th>
                      <th>Area</th>
                      <th>Descripcion</th>
                      <th>Codigo</th>
                      <th>Asignaturas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($consultar_nivel12 as $key) {
                      $drd=$key['id_area'];
                      ?>
                      <tr id="yupi<?php echo($drd)  ?>">
                        <td><input type="checkbox" name="area[]" value="<?php echo($key['id_area']); ?>"></td>
                        <td><?php echo($key['nombre']); ?></td>
                        <td><?php echo($key['descripcion']); ?></td>
                        <td><?php echo($r=$key['codigo']); ?></td>
                        <td>
                          <?php   

                          $consultar="SELECT area.* FROM area WHERE area.area=0 and area.codigo=".$key['codigo'];
                          $consultar1=$conexion->prepare($consultar);
                          $consultar1->execute(array()); 
                          foreach ($consultar1 as $value) {
                           echo' '. $value['nombre'].'   <br>';
                          
                         }
                         ?>
                       </td>
                     </tr>
                     <?php
                   }
                   ?>
                 </tbody>

                 <?php
    }
/////////////////////////////////////// finnn    funciones de la pagina de la vista grado grado_por_materia2.php

function eliminis7(){
      include '../../conexion.php';
      date_default_timezone_set("America/Bogota");
      session_start();
      $fecha=date("Y-m-d h:i:sa");
      $ano=date('Y');
  if ($_POST['id']=='') {
      ?>
          <script>mensaje2(2," campos vacios");</script>

          <?php 
  }else{ $r=$_POST['id'];
    foreach ($r as $id) {
      # code...
    

         $consultar_nivel="SELECT informeacademico.id_jornada_sede FROM informeacademico,(SELECT grado_sede. id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso FROM grado_sede WHERE grado_sede.id='".$id."'  )AS f WHERE informeacademico.ano=$ano and  informeacademico.id_grado=f.id_grado and informeacademico.id_jornada_sede=f.id_jornada_sede and informeacademico.id_curso=f.id_curso ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12s=$consultar_nivel1->rowCount();
         if ($consultar_nivel12s>0) {    ?>
          <script>mensaje2(1," actual mente la sede tiene alumnos registrados");</script>

          <?php
        }else{    

          $consultar_nively="UPDATE `grado_sede` SET `inhabilitar` = '1' WHERE `grado_sede`.`id` ='".$id."'";
          $consultar_nivel1=$conexion->prepare($consultar_nively);
          $consultar_nivel1->execute(array()); 

          $consultar_nivel3="INSERT INTO `historial_grado_sede` (`id_historial_grado_sede`, `id_grado_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$id."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
          $consultar_nivel13=$conexion->prepare($consultar_nivel3);
          $consultar_nivel1->execute(array()); 
          ?>
         
      <script>     
         window.location.assign( window.location.href); 
     
      </script>
     
        <?php
      }
    }
  }
}



function eliminis8(){
      include '../../conexion.php';
      date_default_timezone_set("America/Bogota");
      session_start();
      $fecha=date("Y-m-d h:i:sa");
      $ano=date('Y');
  if ($_POST['id']=='') {
      ?>
          <script>mensaje2(2," campos vacios");</script>

          <?php 
  }else{ $r=$_POST['id'];
    foreach ($r as $id) {
      # code...
    

         $consultar_nivel="SELECT informeacademico.id_jornada_sede FROM informeacademico,(SELECT grado_sede. id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso FROM grado_sede WHERE grado_sede.id='".$id."'  )AS f WHERE informeacademico.ano=$ano and  informeacademico.id_grado=f.id_grado and informeacademico.id_jornada_sede=f.id_jornada_sede and informeacademico.id_curso=f.id_curso ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array());
      $consultar_nivel12s=$consultar_nivel1->rowCount();
         if ($consultar_nivel12s>0) {    ?>
          <script>mensaje2(1," actual mente la sede tiene alumnos registrados");</script>

          <?php
        }else{    

          $consultar_nively="UPDATE `grado_sede` SET `inhabilitar` = '1' WHERE `grado_sede`.`id` ='".$id."'";
          $consultar_nivel1=$conexion->prepare($consultar_nively);
          $consultar_nivel1->execute(array()); 

          $consultar_nivel3="INSERT INTO `historial_grado_sede` (`id_historial_grado_sede`, `id_grado_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$id."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
          $consultar_nivel13=$conexion->prepare($consultar_nivel3);
          $consultar_nivel1->execute(array()); 
          ?>
         
      <script>     
           document.getElementById('fila<?php echo $id ?>').style.display = "none"; 
     
      </script>
     
        <?php
      }
    }
  }
}

///////////////////////////////////////////comienzo de funciones de la carpeta vista en rector sede en la pagina grado.php
function eliminar_curso(){
  include '../../conexion.php';
  date_default_timezone_set("America/Bogota");
  session_start();
  $fecha=date("Y-m-d h:i:sa");
  $ano=date('Y');

     $consultar_nivel="SELECT informeacademico.id_jornada_sede FROM informeacademico,(SELECT grado_sede. id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso FROM grado_sede WHERE grado_sede.id='".$_POST['id']."'  )AS f WHERE informeacademico.ano=$ano and  informeacademico.id_grado=f.id_grado and informeacademico.id_jornada_sede=f.id_jornada_sede and informeacademico.id_curso=f.id_curso ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $consultar_nivel12s=$consultar_nivel1->rowCount();
     if ($consultar_nivel12s>0) {    ?>
      <script>mensaje2(1," actual mente la sede tiene alumnos registrados");</script>

      <?php
    }else{    

      $consultar_nivel="UPDATE `grado_sede` SET `inhabilitar` = '1' WHERE `grado_sede`.`id` ='".$_POST['id']."'";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 

      $consultar_nivel="INSERT INTO `historial_grado_sede` (`id_historial_grado_sede`, `id_grado_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$_POST['id']."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      ?>
      <script>     
         window.location.assign( window.location.href); 
     
      </script>
    <?php
  }
}
function eliminar_curso2(){
  include '../../conexion.php';
  date_default_timezone_set("America/Bogota");
  session_start();
  $fecha=date("Y-m-d h:i:sa");
  $ano=date('Y');

     $consultar_nivel="SELECT informeacademico.id_jornada_sede FROM informeacademico,(SELECT grado_sede. id_grado,grado_sede.id_jornada_sede,grado_sede.id_curso FROM grado_sede WHERE grado_sede.id='".$_POST['id']."'  )AS f WHERE informeacademico.ano=$ano and  informeacademico.id_grado=f.id_grado and informeacademico.id_jornada_sede=f.id_jornada_sede and informeacademico.id_curso=f.id_curso ";
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $consultar_nivel12s=$consultar_nivel1->rowCount();
     if ($consultar_nivel12s>0) {    ?>
      <script>mensaje2(1," actual mente la sede tiene alumnos registrados");</script>

      <?php
    }else{    

      $consultar_nivel="UPDATE `grado_sede` SET `inhabilitar` = '1' WHERE `grado_sede`.`id` ='".$_POST['id']."'";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 

      $consultar_nivel="INSERT INTO `historial_grado_sede` (`id_historial_grado_sede`, `id_grado_sede`, `nombre`, `apellido`, `rol`, `fecha`, `ano`, `inhabilitar`, `habilitar`) VALUES (NULL, '".$_POST['id']."', '".($_SESSION['Nom_U'])."', '".($_SESSION['Ape_U'])."', '".($_SESSION['Rol'])."', '".$fecha."', '".$ano."', '1', '')";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
      ?>
      <script>     
         document.getElementById('fila<?php echo $_POST['id'] ?>').style.display = "none"; 
     
      </script>
    <?php
  }
}
function sede_grado(){ 

    include '../../conexion.php';
    if(isset($_POST['id'])){
      $p=$_POST['id'];
    }else{
      $p='';
    } 
    $consultar_nivel="SELECT d.jorna,d.ID_JS FROM sede LEFT JOIN (SELECT jornada_sede.ID_JS, jornada_sede.ID_SEDE,jornada.ID_JORNADA,jornada.NOMBRE as jorna,jornada.ABREVIACION FROM jornada_sede RIGHT JOIN jornada on jornada_sede.ID_JORNADA=jornada.ID_JORNADA and jornada_sede.inhabilitar=0)as d on sede.ID_SEDE=d.ID_SEDE  WHERE sede.ID_SEDE= " .$p ;
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 


    ?>  
      <div class="mailbox-messages">
  <form method="post" id="dfd">
 <input type="hidden" value="<?php echo $p ?>" name="id_sede">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th>#</th>
              <th style="font-size: 20px">Jornadas</th>
              <th style="font-size: 20px">N_grados</th>
              <th style="font-size: 20px">Observar</th>
              <th style="font-size: 20px">eliminar</th> 
            </tr>
          </thead>
          <tbody>
            <?php  
            foreach ($consultar_nivel1 as $key ){?>
             
            <tr id="ghg<?php echo $key['ID_JS']; ?>">
                <td><input type="checkbox" name="idm[]" value="<?php echo($key['ID_JS']); ?>"></td>
                <td style="font-size: 18px"><?php echo($key['jorna']); ?></td>
                <td style="font-size: 18px">
                  
                  <?php
                    $consultar_nivel="SELECT id_jornada_sede FROM grado_sede WHERE  id_jornada_sede=" .$key['ID_JS'] ;
                    $consultar_nivel1=$conexion->prepare($consultar_nivel);
                    $consultar_nivel1->execute(array()); 
                   echo  $consultar_nivel12s=$consultar_nivel1->rowCount();
                  ?>
                </td>
                <td>
                  <a href="observar_grados.php?id=<?php echo $key['ID_JS']; ?>"  >
                  <img src="../../../logos/observar.jpg" style="width:  40px;height: 40px ;">
                  </a>
                </td>
                <td>

                  <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $key['ID_JS'] ?>"><img style="width: 40px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>              

                  <div class="modal fade" id="mymodal<?php echo  $key['ID_JS']?>" data-keyboard="" data-backdrop="">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" style="<?php echo $_POST['sty']; ?>">Confirmación</h4>
                        </div>
                        <div class="modal-body">
                          <p> estás seguro de eliminar la sede   ?</p>

                        </div>
                        <div class="modal-footer">  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> 
                          <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"    class="btn btn-primary"
                            onclick="myFunction3(<?php echo $key['ID_JS']?>); 
                            ">Aceptar</button> 
                          </div>


                        </div>
                      </div>
                    </div>

                  </td>
                </tr>
                <?php 
              } ?>
            </tbody></table>



            <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" style="<?php echo $_POST['sty']; ?>">Confirmación</h4>
        </div>
        <div class="modal-body"> 
          <p><strong>Nota:</strong> Está seguro de eliminar la jornada?

.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            <button type="submit" class="btn btn-primary" id="uuu"  onclick="
        $('#myModal2').modal('hide');"  >Close</button>
        </div>
      </div>
      
    </div>
  </div>
            <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button><button type="button" class=" btn-primary" id="myBtn2"  style=" border-radius: 5px; border: none;margin-left : 30px">eliminar</button>
    <br><br></form>
        </div>





        <script type="text/javascript">
 
  $(document).ready(function(){  

      $("#myBtn2").click(function(){ 
        $("#myModal2").modal();
      }); 


      var mio=document.getElementById("mio").value; 
     

       function sel(){ 
         $.ajax({   
          type: "post",

          data:{mio}, 
          url:"../../../ajax/rector/sedes/sedes.php?action=sele",
          dataType:"text", 

          success:function(data){  
            $('#sele').html(data); 
       


          }  

        });  }
 

    $(document).on("submit", "#dfd", function(e){
          e.preventDefault();

          $.ajax({

            type: "post",
            url:"../../../ajax/rector/sedes/sedes.php?action=elim2", 
            data: $(this).serialize(),
            dataType:"text", 
            success: function(data)
            { 

              document.getElementById("dfd").reset();
              $('#_MSG2_').html(data); 
 sel();
  
            }
          });

        });



  
     
  
   
  }); 
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script> 
            <?php


}
///////////////////////////////////////////fin de funciones de la carpeta vista en rector sede en la pagina grado.php






function actualizar(){
  include '../../conexion.php'; 
  $id=$_POST['id'];
  $num=$_POST['num'];

  
  $consultar_nivel="UPDATE `grado_sede` SET `capacidad` = '$num' WHERE `grado_sede`.`id` =$id;";
  $s=$consultar_nivel;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
}


///////////////////////comienzo de las funciones de la carpeta vista en rector sede en la pagina observar_grados.php

function observar_grados(){    
include '../../conexion.php';

if(isset($_POST['id_jornada_sede'])){
      $id_jornada_sede=$_POST['id_jornada_sede'];
    }else{
      $id_jornada_sede='';
    }
  if(isset($_POST['dato'])){
   $d=$_POST['dato'];
 }else{
  $d='';
}
if(isset($_POST['i'])){
 $paginaActual = $_POST['i'];
}else{
 $paginaActual=1;
}

  
$consultar_nivel="SELECT grado_sede.id ,grado.nombre as grado,curso.numero as curso FROM grado_sede,curso,grado WHERE grado_sede.inhabilitar=0 and  grado_sede.id_grado=grado.id_grado and grado_sede.id_curso=curso.id_curso and grado_sede.id_jornada_sede=$id_jornada_sede and grado.nombre like '%$d%' ORDER by grado.numero";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
 $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}

$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
   $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}
$ano=date('Y');

 $consultar_nivel="SELECT grado.id_grado,curso.id_curso, grado_sede.id,grado_sede.capacidad ,grado.nombre as grado,curso.numero as curso FROM grado_sede,curso,grado  WHERE grado_sede.inhabilitar=0 and grado_sede.id_grado=grado.id_grado and grado_sede.id_curso=curso.id_curso and grado_sede.id_jornada_sede=$id_jornada_sede and grado.nombre like '%$d%' ORDER by grado.numero ASC   LIMIT $limit, $nroLotes";
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());
$registro=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="eliminis7"> 
  <div class="box-body no-padding">
    <div class="mailbox-controls">
      <div class="btn-group">  

        <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button>  
        <button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button> 
        <?php if($paginaActual > 1){
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
      </div>
        <!-- /.btn-group --> 
      <div class="pull-right">

        <?php 

        $aaa=$registrow+0;
        $aa=$paginaActual+0;
        $g=$aa *$aaa;
        if ($o==0) {
         echo $g .'-'.$paginaActual.'/'. $nroProductos ;
       }else{
          echo $nroProductos;

          echo   '-'.$paginaActual.'/'. $nroProductos ;
        }





        ?>
        <div class="btn-group"> 

          <?php if($paginaActual > 1){
            echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

            <?php
            if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
          <!-- /.btn-group -->
      </div>
        <!-- /.pull-right -->
    </div>

    <div class="table-responsive mailbox-messages">
      <br>
      <table class="table table-striped table-condensed table-hover">
        <tr>
          <th>#</th>
          <th >Grados</th>
          <th >curso</th>
          <th>Capacidad</th>
          <th>alumnos </th>
          <th >Asinaturas</th>
          <th >Horario</th>
          <th >eliminar</th> 
        </tr> <?php
        foreach ($registro as $registro2) {
         $consultar_nivel=" select  informeacademico.id_alumno  as contador_total from informeacademico WHERE informeacademico.id_grado='".$registro2['id_grado']."' and informeacademico.id_curso='".$registro2['id_curso']."' and informeacademico.id_jornada_sede='$id_jornada_sede' and informeacademico.ano='$ano'";
        $consultar_nivel1=$conexion->prepare($consultar_nivel);
        $consultar_nivel1->execute(array());
        $nsql1os=$consultar_nivel1->rowCount();

        echo'<tr id="fila'.$registro2['id'].'">
        <td>

        <input class="sss" type="checkbox" name="id[]" value="'.$registro2['id'].'"></td> 
        <td>'.($registro2['grado']).'</td>
        <td>'.$registro2['curso'].'</td>'  ;?>

        <td><input type="number"  id="num<?php echo $registro2['id'] ?>"  value="<?php echo $registro2['capacidad'] ?>" style='width: 70px;background-color: transparent;border:none;'  onchange=" var num= document.getElementById('num<?php echo $registro2['id'] ?>').value;var id=<?php echo $registro2['id'] ?>; actualiza(id,num); "></td>  
        <td><?php echo $nsql1os ?></td>    

        
  

        <td> <a href="asignar_area_grado.php?id=<?php echo $registro2['id']; ?>"  ><img width="35" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ5Ni40ODUgNDk2LjQ4NSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjQ4NSA0OTYuNDg1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHJlY3QgeD0iNzMuNjk3IiB5PSIxMS42MzYiIHN0eWxlPSJmaWxsOiMyRUEyREI7IiB3aWR0aD0iMzI1LjgxOCIgaGVpZ2h0PSIzNTkuMTc2Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNMzk5LjUxNSwzNzguNTdINzMuNjk3Yy0zLjg3OSwwLTcuNzU4LTMuMTAzLTcuNzU4LTcuNzU4VjExLjYzNmMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICBoMzI1LjgxOGMzLjg3OSwwLDcuNzU4LDMuMTAzLDcuNzU4LDcuNzU4djM1OS4xNzZDNDA3LjI3MywzNzQuNjkxLDQwNC4xNywzNzguNTcsMzk5LjUxNSwzNzguNTd6IE04MS40NTUsMzYzLjA1NWgzMTEuMDc5VjE4LjYxOCAgSDgxLjQ1NVYzNjMuMDU1eiIvPgo8Zz4KCTxyZWN0IHg9IjEwMy45NTIiIHk9IjQxLjExNSIgc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHdpZHRoPSIyNjUuMzA5IiBoZWlnaHQ9IjI5OS40NDIiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDQuOTk0LDExLjYzNmMtMjAuOTQ1LDAtMzcuMjM2LDE2LjI5MS0zNy4yMzYsMzcuMjM2VjMzMi44YzAsMjAuOTQ1LDE3LjA2NywzNy4yMzYsMzcuMjM2LDM3LjIzNiAgIGgyOC43MDN2LTM1OC40SDQ0Ljk5NHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTczLjY5NywzNzguNTdINDQuOTk0QzIwLjE3LDM3OC41NywwLDM1OC40LDAsMzMzLjU3NlY0OC44NzNDMCwyNC4wNDgsMjAuMTcsMy44NzksNDQuOTk0LDMuODc5ICBoMjguNzAzYzMuODc5LDAsNy43NTgsMy4xMDMsNy43NTgsNy43NTh2MzU5LjE3NkM4MS40NTUsMzc0LjY5MSw3OC4zNTIsMzc4LjU3LDczLjY5NywzNzguNTd6IE00NC45OTQsMTguNjE4ICBjLTE2LjI5MSwwLTMwLjI1NSwxMy4xODgtMzAuMjU1LDMwLjI1NVYzMzIuOGMwLDE2LjI5MSwxMy4xODgsMzAuMjU1LDMwLjI1NSwzMC4yNTVoMjEuNzIxVjE4LjYxOEg0NC45OTR6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNDUxLjQ5MSwxMS42MzZoLTUxLjJ2MzU5LjE3Nmg1MS4yYzIwLjk0NSwwLDM3LjIzNi0xNy4wNjcsMzcuMjM2LTM3LjIzNlY0OC44NzMgIEM0ODguNzI3LDI3LjkyNyw0NzIuNDM2LDExLjYzNiw0NTEuNDkxLDExLjYzNnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTQ1MS40OTEsMzc4LjU3aC01MS4yYy0zLjg3OSwwLTcuNzU4LTMuMTAzLTcuNzU4LTcuNzU4VjExLjYzNmMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICAgaDUxLjJjMjQuODI0LDAsNDQuOTk0LDIwLjE3LDQ0Ljk5NCw0NC45OTRWMzMyLjhDNDk2LjQ4NSwzNTcuNjI0LDQ3Ni4zMTUsMzc4LjU3LDQ1MS40OTEsMzc4LjU3eiBNNDA3LjI3MywzNjMuMDU1aDQ0LjIxOCAgIGMxNi4yOTEsMCwzMC4yNTUtMTMuMTg4LDMwLjI1NS0zMC4yNTVWNDguODczYzAtMTYuMjkxLTEzLjE4OC0zMC4yNTUtMzAuMjU1LTMwLjI1NWgtNDQuMjE4VjM2My4wNTV6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTQxLjExNSwyMjQuOTdjLTMuODc5LDAtNy43NTgtMy4xMDMtNy43NTgtNy43NTh2LTUxLjk3NmMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICAgYzMuODc5LDAsNy43NTgsMy4xMDMsNy43NTgsNy43NTh2NTEuOTc2QzQ4LjA5NywyMjEuMDkxLDQ0Ljk5NCwyMjQuOTcsNDEuMTE1LDIyNC45N3oiLz4KPC9nPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNFMUU2RTk7IiBjeD0iNDQ0LjUwOSIgY3k9IjE5MC44MzYiIHI9IjIxLjcyMSIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNMTY2LjAxMiwyMDcuOTAzbC02LjIwNiwxNC43MzlIMTQ4LjE3bDI3LjkyNy02Mi44MzZoMTEuNjM2bDI3LjkyNyw2Mi44MzZoLTExLjYzNmwtNi4yMDYtMTQuNzM5ICAgSDE2Ni4wMTJ6IE0xOTMuMTY0LDE5OC41OTRsLTExLjYzNi0yNi4zNzZsLTEwLjg2MSwyNi4zNzZIMTkzLjE2NHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNMjM2LjYwNiwyMDguNjc5di0xNy4wNjdoLTE3LjA2N3YtOC41MzNoMTcuMDY3di0xNy4wNjdoNy43NTh2MTcuMDY3aDE3LjA2N3Y4LjUzM2gtMTcuMDY3djE3LjA2NyAgIEgyMzYuNjA2eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzE5MzY1MTsiIGQ9Ik0zMDIuNTQ1LDIyMi42NDJoLTI3LjkyN3YtNjIuODM2aDI0LjgyNGM0LjY1NSwwLDcuNzU4LDAuNzc2LDEwLjg2MSwxLjU1MiAgIGMzLjEwMywwLjc3Niw1LjQzLDIuMzI3LDYuOTgyLDMuODc5YzMuMTAzLDMuMTAzLDQuNjU1LDYuOTgyLDQuNjU1LDEwLjg2MWMwLDQuNjU1LTEuNTUyLDguNTMzLTQuNjU1LDEwLjg2MSAgIGMtMC43NzYsMC43NzYtMS41NTIsMS41NTItMi4zMjcsMS41NTJjLTAuNzc2LDAtMS41NTIsMC43NzYtMi4zMjcsMC43NzZjMy44NzksMC43NzYsNi45ODIsMi4zMjcsOS4zMDksNS40MyAgIGMyLjMyNywyLjMyNywzLjEwMyw2LjIwNiwzLjEwMywxMC4wODVjMCw0LjY1NS0xLjU1Miw4LjUzMy00LjY1NSwxMS42MzZDMzE3LjI4NSwyMjAuMzE1LDMxMS44NTUsMjIyLjY0MiwzMDIuNTQ1LDIyMi42NDJ6ICAgIE0yODYuMjU1LDE4NS40MDZoMTMuMTg4YzcuNzU4LDAsMTEuNjM2LTIuMzI3LDExLjYzNi03Ljc1OGMwLTMuMTAzLTAuNzc2LTUuNDMtMy4xMDMtNi4yMDZjLTEuNTUyLTEuNTUyLTQuNjU1LTIuMzI3LTguNTMzLTIuMzI3ICAgaC0xMy45NjR2MTYuMjkxSDI4Ni4yNTV6IE0yODYuMjU1LDIxMi41NThoMTYuMjkxYzMuODc5LDAsNi45ODItMC43NzYsOS4zMDktMS41NTJjMi4zMjctMS41NTIsMy4xMDMtMy44NzksMy4xMDMtNi45ODIgICBjMC01LjQzLTQuNjU1LTguNTMzLTEzLjE4OC04LjUzM2gtMTUuNTE1VjIxMi41NTh6Ii8+CjwvZz4KPGc+Cgk8cmVjdCB4PSIxODguNTA5IiB5PSI3OS4xMjciIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiB3aWR0aD0iMTQuNzM5IiBoZWlnaHQ9IjE0LjczOSIvPgoJPHJlY3QgeD0iMjI5LjYyNCIgeT0iNzkuMTI3IiBzdHlsZT0iZmlsbDojMTkzNjUxOyIgd2lkdGg9IjE0LjczOSIgaGVpZ2h0PSIxNC43MzkiLz4KCTxyZWN0IHg9IjI2OS45NjQiIHk9Ijc5LjEyNyIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iMTQuNzM5Ii8+CjwvZz4KPGc+Cgk8cmVjdCB4PSIxODguNTA5IiB5PSIyODcuODA2IiBzdHlsZT0iZmlsbDojMTkzNjUxOyIgd2lkdGg9IjE0LjczOSIgaGVpZ2h0PSIxNC43MzkiLz4KCTxyZWN0IHg9IjIyOS42MjQiIHk9IjI4Ny44MDYiIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiB3aWR0aD0iMTQuNzM5IiBoZWlnaHQ9IjE0LjczOSIvPgoJPHJlY3QgeD0iMjY5Ljk2NCIgeT0iMjg3LjgwNiIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iMTQuNzM5Ii8+CjwvZz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0YxNjA1MTsiIHBvaW50cz0iMjcuOTI3LDQ0OC4zODggOTMuODY3LDQ4NC44NDkgOTMuODY3LDQxMS45MjcgIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNOTMuODY3LDQ5Mi42MDZjLTEuNTUyLDAtMi4zMjcsMC0zLjg3OS0wLjc3NkwyNC4wNDgsNDU1LjM3Yy0yLjMyNy0xLjU1Mi0zLjg3OS0zLjg3OS0zLjg3OS02LjIwNiAgYzAtMy4xMDMsMS41NTItNS40MywzLjg3OS02LjIwNmw2NS45MzktMzYuNDYxYzIuMzI3LTEuNTUyLDUuNDMtMS41NTIsNy43NTgsMGMyLjMyNywxLjU1MiwzLjg3OSwzLjg3OSwzLjg3OSw2LjIwNnY3Mi45MjEgIGMwLDIuMzI3LTEuNTUyLDUuNDMtMy44NzksNi4yMDZDOTYuMTk0LDQ5Mi42MDYsOTUuNDE4LDQ5Mi42MDYsOTMuODY3LDQ5Mi42MDZ6IE00My40NDIsNDQ4LjM4OGw0Mi42NjcsMjQuMDQ4di00Ny4zMjEgIEw0My40NDIsNDQ4LjM4OHoiLz4KPHJlY3QgeD0iOTMuODY3IiB5PSI0MTEuOTI3IiBzdHlsZT0iZmlsbDojRkZGRkZGOyIgd2lkdGg9IjM0Mi4xMDkiIGhlaWdodD0iNzIuOTIxIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiBkPSJNNDM1Ljk3Niw0OTIuNjA2SDkzLjg2N2MtMy44NzksMC03Ljc1OC0zLjEwMy03Ljc1OC03Ljc1OHYtNzIuOTIxYzAtMy44NzksMy4xMDMtNy43NTgsNy43NTgtNy43NTggIGgzNDIuMTA5YzMuODc5LDAsNy43NTgsMy4xMDMsNy43NTgsNy43NTh2NzIuOTIxQzQ0My43MzMsNDg5LjUwMyw0MzkuODU1LDQ5Mi42MDYsNDM1Ljk3Niw0OTIuNjA2eiBNMTAxLjYyNCw0NzcuODY3aDMyNy4zNyAgdi01OC4xODJoLTMyNy4zN1Y0NzcuODY3eiIvPgo8cmVjdCB4PSI0MzUuOTc2IiB5PSI0MjcuNDQyIiBzdHlsZT0iZmlsbDojRjE2MDUxOyIgd2lkdGg9IjQ1Ljc3IiBoZWlnaHQ9IjQyLjY2NyIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTQ4MS43NDUsNDc3LjA5MWgtNDUuNzdjLTMuODc5LDAtNy43NTgtMy4xMDMtNy43NTgtNy43NTh2LTQyLjY2N2MwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4ICBoNDUuNzdjMy44NzksMCw3Ljc1OCwzLjEwMyw3Ljc1OCw3Ljc1OHY0Mi42NjdDNDg5LjUwMyw0NzMuOTg4LDQ4NS42MjQsNDc3LjA5MSw0ODEuNzQ1LDQ3Ny4wOTF6IE00NDMuNzMzLDQ2Mi4zNTJoMzEuMDNWNDM1LjIgIGgtMzEuMDNWNDYyLjM1MnoiLz4KPGc+Cgk8cmVjdCB4PSIxNTUuMTUyIiB5PSI0MzkuODU1IiBzdHlsZT0iZmlsbDojMTkzNjUxOyIgd2lkdGg9IjE0LjczOSIgaGVpZ2h0PSIxNy4wNjciLz4KCTxyZWN0IHg9IjE5NS40OTEiIHk9IjQzOS44NTUiIHN0eWxlPSJmaWxsOiMxOTM2NTE7IiB3aWR0aD0iMTQuNzM5IiBoZWlnaHQ9IjE3LjA2NyIvPgoJPHJlY3QgeD0iMjM2LjYwNiIgeT0iNDM5Ljg1NSIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iMTcuMDY3Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkzNjUxOyIgZD0iTTI3LjkyNyw0NTYuMTQ1SDE0LjczOWMtMy44NzksMC03Ljc1OC0zLjEwMy03Ljc1OC03Ljc1OGMwLTMuODc5LDMuMTAzLTcuNzU4LDcuNzU4LTcuNzU4aDEyLjQxMiAgIGMzLjg3OSwwLDcuNzU4LDMuMTAzLDcuNzU4LDcuNzU4QzM0LjkwOSw0NTMuMDQyLDMxLjgwNiw0NTYuMTQ1LDI3LjkyNyw0NTYuMTQ1eiIvPgoJPHJlY3QgeD0iMzY2LjkzMyIgeT0iNDExLjkyNyIgc3R5bGU9ImZpbGw6IzE5MzY1MTsiIHdpZHRoPSIxNC43MzkiIGhlaWdodD0iNzIuOTIxIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /></a>
        </td>


         <td><a href="horario.php?id=<?php echo($registro2['id']); ?>"><img src="../../../logos/004-calendario-2.png" style="width: 45px;"></a></td>

        <td>

                  <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $registro2['id'] ?>"><img style="width: 40px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>              

                  <div class="modal fade" id="mymodal<?php echo $registro2['id']?>" data-keyboard="" data-backdrop="">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" style="<?php echo $_POST['sty']; ?>">Confirmación</h4>
                        </div>
                        <div class="modal-body">
                          <p> estás seguro de eliminar el grado   ?</p>

                        </div>
                        <div class="modal-footer">  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> 
                          <button type="button" data-dismiss="modal" name="Aceptar" id="dsd"    class="btn btn-primary"
                            onclick="myFunction3(<?php echo $registro2['id']?>); 
                            ">Aceptar</button> 
                          </div>


                        </div>
                      </div>
                    </div>

                  </td>






                      </tr><?php  
                    }
                    echo "

                ";?>
      </table>
    </div>
  </div>
</form> 
 
    <?php

    echo '<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> <ul class="pagination" id="pagination">
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button>'.$lista.'</ul>





    
    ' ;
    ?>
    <script type="text/javascript">
       $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
    </script>
<?php

}
 

 function nuevo_grado(){

  include '../../conexion.php';
  $id_jornada_sede=$_POST['id_jornada_sede'];
  $id_curso=$_POST['id_curso'];
  $id_grado=$_POST['id_grado'];
  $cantidad=$_POST['cantidad'];
    


   

 
    if ($id_curso!='' &&  $id_grado!='') {
 


    $consultar_nivel="INSERT INTO `grado_sede` ( `id_grado`, `id_jornada_sede`, `id_curso`, `salon`, `titular`, `inhabilitar`,`capacidad`) VALUES  ( '$id_grado', '$id_jornada_sede', '$id_curso', '', '','0','$cantidad')";
    $consultar_nivel1=$conexion->prepare($consultar_nivel);
    $consultar_nivel1->execute(array()); 
    $id_grado_sede =$conexion->lastInsertId() ;
    


  
   


       $consultar_nivel="INSERT INTO `are_grado_sede` (`id_area`, `id_grado_sede`, `id__docente`)
      
      SELECT  area.id_area,'$id_grado_sede','' from are_grado_sede,area,grado_sede WHERE  area.id_area=are_grado_sede.id_area AND grado_sede.id=are_grado_sede.id_grado_sede and  grado_sede.id_grado=$id_grado GROUP by area.id_area ";
      $consultar_nivel1=$conexion->prepare($consultar_nivel);
      $consultar_nivel1->execute(array()); 
 





    ?>
    <script type="text/javascript">
       
      mensaje(3,'Registro exitoso');

      document.getElementById("grado").focus();
      document.getElementById("grado").value='';
      document.getElementById("curso").value='';
      document.getElementById("cantidad").value='';
    </script>
     <?php
 }

}


///////////////////////fin de las funciones de la carpeta vista en rector sede en la pagina observar_grados.php




///////////////////////fin de las funciones de la carpeta vista en rector sede en la pagina asignar_area_grado.php


function ver_areas(){
  include "../../conexion.php";
   if(isset($_POST['id'])){
      $id=$_POST['id'];
    }else{
      $id='';
    }
   $sql="SELECT area.codigo,area.area,area.nombre, are_grado_sede.id__docente, are_grado_sede.id_area_grado_sede FROM area INNER JOIN are_grado_sede ON are_grado_sede.id_area=area.id_area WHERE are_grado_sede.id_grado_sede=$id GROUP BY area.id_area";
  $sql1=$conexion->prepare($sql);
  $sql1->execute(array());
  $count=$sql1->rowCount();
  $sql2=$sql1->fetchAll();
 
  if ($count==0) {
    ?>
    <div class="callout callout-info">
        <h4>información!</h4>
        actualmente no se encuentran areas asignadas
      </div><?php
  }else{ 
  $Seleccione1="SELECT docente.nombre,docente.foto,docente.apellido,docente.id_docente from docente";
  $Seleccion1=$conexion->prepare($Seleccione1);
  $Seleccion1->execute(array()); 
  $var=$Seleccion1->fetchAll();?>
<link rel="stylesheet" href="../../../css/chosen.css">
  <link rel="stylesheet" href="../../../css/ImageSelect.css">
 
<script src="../../../js/chosen.jquery.js"></script>
<script src="../../../js/ImageSelect.jquery.js"></script>
<style>
      table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left; 
}
   
    tr:hover{ border-bottom :#cbcfd5 solid 2.3px;   border-top  :#d2d6de solid 2.3px; border-right  :#d2d6de solid 2.3px; border-left  :#d2d6de solid 2.3px;      
    }
</style>
<div class="col-md-12" style="    background-color: #dee1e482;
    padding: 10px; 
    border: solid 1.1px #BEBEBE ;"> <strong style="margin-right: 50px">  Asignar todo el curso:</strong> <select class="form-control my-select" name="doc"  id="doc" TABINDEX="0"  style='margin-left: 100px; width: 70%;' onchange='
    var r = confirm("está seguro de asignarle toda la carga academica al docente que señalo?");
  var doc=document.getElementById("doc").value;
if (r == true) { todos(doc);
} else{

  document.getElementById("doc").value=""; 
}  '>
        <option>Seleccione un docente</option>
        <?php 
                 
                  
                  foreach ($var  as $key) {
                    $pl=$key['id_docente']; ?>
                      <option data-img-src="<?php echo $key['foto'] ?>" value="<?php echo  $key['id_docente'] ?>"><?php echo $key['nombre'].' '.$key['apellido'] ?></option> <?php
                   }
                  
                    
                    ?>
                </select></div><br>
    <form id="pro" method="post">
      <div class="table table-rasponsive">
       <strong style="margin-right: 20px;
    margin-left: 8px;
}">



                <br>
      <table class="  table-hover" >
        <thead>
          <tr> 
            <th>Asignatura</th>
            <th>Codigo</th>
            <th width="300">Profesor</th>
          </tr>
        </thead>
        <tbody><?php
        $r=0;
          foreach ($sql2 as $key ) {  
            if ($key['codigo']!='01' && $key['area']=='1') {
              # code...
            }else{ 
           $r=$r+2; $t=$key['id_area_grado_sede'];?>
            <tr> 
              <td><?php echo($key['nombre']); ?></td>
              <td><?php echo($key['codigo']); ?></td>
              <td>
                <select class="form-control my-select" name="doc[]"  id="doc<?php echo $key['id_area_grado_sede'] ?>" TABINDEX="<?php echo($r) ?>"  style='width: 100%;' onchange='var id=<?php echo $key['id_area_grado_sede'] ?>; var doc= document.getElementById("doc<?php echo $key['id_area_grado_sede'] ?>").value; funct(doc,id)'><?php
                  $id__docente=$key['id__docente'];
                  if ($id__docente>0) {
                    foreach ($var as $o) {
                      $rt=$o['id_docente'];
                      if($rt==$id__docente){?>
<option selected="selected" data-img-src="<?php echo $o['foto'] ?>" value="<?php echo  $o['id_docente'].' '.$t ?>"><?php echo $o['nombre'].' '.$o['apellido'] ?></option>   <?php
                      }
                    }
                  }else{?>
                    <option value="">Seleccione un docente</option><?php 
                  }
                  
                  foreach ($var  as $key) {
                    $pl=$key['id_docente'];
                    if ($pl!=$id__docente) {?>
                      <option data-img-src="<?php echo $key['foto'] ?>" value="<?php echo  $key['id_docente'].' '.$t ?>"><?php echo $key['nombre'].' '.$key['apellido'] ?></option> <?php
                  } }
                  
                    
                    ?>
                </select>
              </td>
            </tr>     <?php      
          }  }?>
        </tbody>
      </table>
    <?php ($r=$r+1) ?>  </div>
    </form>

</select><script>
 $(".my-select").chosen()({
    placeholder: "Select a state",
    allowClear: true
});
</script>
  <?php   
   
}
}

function carga_docentes(){ 

  include "../../conexion.php";
 
  $doc=$_POST['doc'];
  $id=$_POST['id'];
  $consultar_nivel="UPDATE `are_grado_sede` SET `id__docente` = '$doc' WHERE `are_grado_sede`.`id_area_grado_sede` =$id"  ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
   
}
function carga_docentes_todos(){ 

  include "../../conexion.php";
 
  $doc=$_POST['doc'];
  $id=$_POST['id'];
  $consultar_nivel="UPDATE `are_grado_sede` SET `id__docente` = '$doc' WHERE `are_grado_sede`.`id_grado_sede` =$id"  ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
   
}





///////////////////////fin de las funciones de la carpeta vista en rector sede en la pagina asignar_area_grado.php













///////////////comienza las dos funciones de selesc de grado y curso

function curso(){
  include '../../conexion.php';
    if(isset($_POST['id_jornada_sede'])){
      $id_jornada_sede=$_POST['id_jornada_sede'];
    }else{
      $id_jornada_sede='';
    }
     
    if(isset($_POST['grado'])){
      $grado=$_POST['grado'];
    }else{
      $grado='';
    }



    echo $consultar_nivel="SELECT curso.id_curso,curso.nombre,curso.numero from curso WHERE curso.id_curso not in(SELECT curso.id_curso from curso,grado_sede WHERE curso.id_curso=grado_sede.id_curso AND grado_sede.id_jornada_sede=$id_jornada_sede AND grado_sede.id_grado=$grado )" ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $sede1=$consultar_nivel1->fetchAll(); ?>
 <option value="">Seleccione el curso</option>
  <?php
  foreach ($sede1 as $key ) {
    ?>
    <option value="<?php echo $key['id_curso'] ?>"><?php echo $key['numero'] ?></option>
    <?php
  }
}

function grado(){
  include '../../conexion.php';
  

   $consultar_nivel="SELECT id_grado,nombre,numero FROM grado"  ;
  $consultar_nivel1=$conexion->prepare($consultar_nivel);
  $consultar_nivel1->execute(array());
  $sede1=$consultar_nivel1->fetchAll();
  ?>
  <option value="">Seleccione el grado</option>
  <?php
  foreach ($sede1 as $key ) {
    ?>
    <option value="<?php echo $key['id_grado'] ?>"><?php echo $key['nombre'] ?></option>
    <?php
  }

}

///////////////fin las dos funciones de selesc de grado y curso



































///crea grados en su respectiva sede  y jornada

function tabla()
{     

  include '../../conexion.php';
  
if(isset($_POST['js'])){
   $js=$_POST['js'];
 }else{
  $js='';
}

 




  if(isset($_POST['dato'])){
   $d=$_POST['dato'];
 }else{
  $d='';
}
if(isset($_POST['i'])){
 $paginaActual = $_POST['i'];
}else{
 $paginaActual=1;
}


   $consultar_nivel="SELECT q.id, q.numero,q.grado,q.curso from (SELECT grado.numero, grado_sede.id,grado.nombre as grado,curso.numero as curso FROM grado_sede,grado,curso WHERE curso.id_curso=grado_sede.id_curso AND  grado_sede.inhabilitar=0 and  grado.id_grado=grado_sede.id_grado and grado_sede.id_jornada_sede=$js)as q  where q.numero like('%$d%') or  q.curso like('%$d%') or  q.grado like('%$d%') ORDER by q.numero    ";
$s=$consultar_nivel;
$consultar_nivel1=$conexion->prepare($consultar_nivel);
$consultar_nivel1->execute(array());

$nroProductos=$consultar_nivel1->rowCount();


if(isset($_POST['mySelect'])){
 $nroLotes = $_POST['mySelect'];
}else{
  $nroLotes = 5;
}

$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
  $fttg1=    $lista = $lista.'<li>    <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button></li>';
}

for($i=1; $i<=$nroPaginas; $i++){
  if($i == $paginaActual){
   $lista = $lista.'<li  ><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
 }else{
  $lista = $lista.'<li><button type="button" id="f'.$i.'" class="btn btn-default btn-sm" value="'.$i.'"onclick="myFunction('.$i.')">'.$i.'</button></li>';
}
}
if($paginaActual < $nroPaginas){
  $lista = $lista.'<li>
  <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button></li>';
  $o=0;
}else{
  $o=1;
}

if($paginaActual <= 1){
  $limit = 0;
}else{
  $limit = $nroLotes*($paginaActual-1);
}

 
$consultar_nivels= $s."    LIMIT $limit, $nroLotes ";
$consultar_nivel1=$conexion->prepare($consultar_nivels);
$consultar_nivel1->execute(array());
$andrey=$consultar_nivel1->fetchAll();

$registrow=$consultar_nivel1->rowCount();
?>  
<form method="post" id="eliminis">
 <div class="box-body no-padding">

  <div class="mailbox-controls">
 
    <!-- Check all button -->
    <button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> 
    <div class="btn-group"> 
  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button>
      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#nmn"> <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTI0LDE0LjA1OVY1LjU4NEwxOC40MTQsMEgwdjMyaDI0di0wLjA1OWM0LjQ5OS0wLjUsNy45OTgtNC4zMSw4LTguOTQxICAgIEMzMS45OTgsMTguMzY2LDI4LjQ5OSwxNC41NTYsMjQsMTQuMDU5eiBNMTcuOTk4LDIuNDEzTDIxLjU4Niw2aC0zLjU4OEMxNy45OTgsNiwxNy45OTgsMi40MTMsMTcuOTk4LDIuNDEzeiBNMiwzMFYxLjk5OGgxNCAgICB2Ni4wMDFoNnY2LjA2Yy0xLjc1MiwwLjE5NC0zLjM1MiwwLjg5LTQuNjUyLDEuOTQxSDR2MmgxMS41MTdjLTAuNDEyLDAuNjE2LTAuNzQzLDEuMjg5LTAuOTk0LDJINHYyaDEwLjA1OSAgICBDMTQuMDIyLDIyLjMyOSwxNCwyMi42NjEsMTQsMjNjMCwyLjgyOSwxLjMwOCw1LjM1MiwzLjM1LDdIMnogTTIzLDI5Ljg4M2MtMy44MDEtMC4wMDktNi44NzYtMy4wODQtNi44ODUtNi44ODMgICAgYzAuMDA5LTMuODAxLDMuMDg0LTYuODc2LDYuODg1LTYuODg1YzMuNzk5LDAuMDA5LDYuODc0LDMuMDg0LDYuODgzLDYuODg1QzI5Ljg3NCwyNi43OTksMjYuNzk5LDI5Ljg3NCwyMywyOS44ODN6IiBmaWxsPSIjMDAwMDAwIi8+CgkJPHJlY3QgeD0iNCIgeT0iMTIiIHdpZHRoPSIxNiIgaGVpZ2h0PSIyIiBmaWxsPSIjMDAwMDAwIi8+CgkJPHBvbHlnb24gcG9pbnRzPSIyNC4wMDIsMjIgMjQuMDAyLDE4IDIyLDE4IDIyLDIyIDE4LDIyIDE4LDI0IDIyLDI0IDIyLDI4IDI0LjAwMiwyOCAyNC4wMDIsMjQgMjgsMjQgICAgIDI4LDIyICAgIiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" / style='width: 14px;height: 14px'></button>
     <button type="button" class="btn btn-default btn-sm" onclick="myFunction(1)"> <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGcgaWQ9Imxvb3BfeDVGX2FsdDIiPgoJCTxnPgoJCQk8cGF0aCBkPSJNMTkuOTQ1LDIybDYuMDA4LThMMzIsMjJoLTR2MmMwLDMuMzA5LTIuNjkxLDYtNiw2SDEwYy0zLjMwOSwwLTYtMi42OTEtNi02di0yaDR2MiAgICAgYzAsMS4xMDIsMC44OTgsMiwyLDJoMTJjMS4xMDIsMCwyLTAuODk4LDItMnYtMkgxOS45NDV6IiBmaWxsPSIjMDAwMDAwIi8+CgkJCTxwYXRoIGQ9Ik0xMi4wNTUsMTBsLTYuMDA4LDhMMCwxMGg0VjhjMC0zLjMwOSwyLjY5MS02LDYtNmgxMmMzLjMwOSwwLDYsMi42OTEsNiw2djJoLTRWOCAgICAgYzAtMS4xMDItMC44OTgtMi0yLTJIMTBDOC44OTgsNiw4LDYuODk4LDgsOHYySDEyLjA1NXoiIGZpbGw9IiMwMDAwMDAiLz4KCQk8L2c+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" style="width: 14px;height: 14px"></button>
      <?php if($paginaActual > 1){
        echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-reply"></i></button>' ;} ?>

        <?php
        if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-share"></i></button>' ;} ?>
      </div>
      <!-- /.btn-group --> 
      <div class="pull-right">

        <?php 

        $aaa=$registrow+0;
        $aa=$paginaActual+0;
        $g=$aa *$aaa;
        if ($o==0) {
         echo $g .'-'.$paginaActual.'/'. $nroProductos ;
       }else{
        echo $nroProductos;

        echo   '-'.$paginaActual.'/'. $nroProductos ;
      }





      ?>
      <div class="btn-group"> 

        <?php if($paginaActual > 1){
          echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual-1).'" value="'.($paginaActual-1).'"onclick="myFunction('.($paginaActual-1).')"><i class="fa fa-chevron-left"></i></button>' ;} ?>

          <?php
          if($paginaActual < $nroPaginas){ echo  ' <button type="button" class="btn btn-default btn-sm" id="f'.($paginaActual+1).'" value="'.($paginaActual+1).'"onclick="myFunction('.($paginaActual+1).')"><i class="fa fa-chevron-right"></i></button>' ;} ?>

        </div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>

    <div class="table-responsive mailbox-messages" style="
  
  text-align: justify; /* For Edge */
  -moz-text-align-last: left; /* For Firefox prior 58.0 */
  text-align-last: left; ">

      <?php

      echo '<br><table class="table table-striped  table-hover">
      <tr><th width="100">#</th> 
      <th width="100">Numero</th>  

      <th width="100">Grado</th>

      <th width="100" >Curso</th> 
      <th width="100">ELIMINAR</th>

      </tr>';
      foreach ($andrey as $registro2) {

        echo'<tr id="fila'.$registro2['id'].'">
        <td>

        <input class="sss" type="checkbox" name="id[]" value="'.$registro2['id'].'"></td> 
        <td>'.$registro2['numero'].'</td>  

        <td>'.($registro2['grado']).'</td>

        <td>'.($registro2['curso']).'</td>
      ';    ?> 


<td>

  <a href="#" data-toggle="modal" data-target="#mymodal<?php echo $registro2['id']?>"><img style="width: 35px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE4LjU4OCAxOC41ODgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE4LjU4OCAxOC41ODg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMTMuODQ5LDMuNDE0TDEyLjgxNiwwLjJsLTEuMTQ3LDEuMDIxTDkuMjg3LDBMOS4xNzksMS44NTZMOC4xNjMsMC44MzlMNS4yNzIsMy40MTRIMi4wNTR2Mi42MzEgICBoMS4xNzdsMC45MTIsMTAuNDU0YzAuMDE0LDEuMTU0LDAuOTU3LDIuMDg5LDIuMTE1LDIuMDg5aDYuMDc1YzEuMTU5LDAsMi4xMDQtMC45MzgsMi4xMTUtMi4wOTdsMC45My0xMC40NDZoMS4xNTdWMy40MTRIMTMuODQ5eiAgICBNNy4xMzcsOS4xNjNsMi4xOS0yLjE4OWwyLjE5LDIuMTg5bC0yLjE5LDIuMTlMNy4xMzcsOS4xNjN6IE0xMS4wMjMsMTMuOTMxbC0xLjY5NSwxLjY5NGwtMS42OTUtMS42OTRsMS42OTUtMS42OTRMMTEuMDIzLDEzLjkzMSAgIHogTTkuMjg0LDYuMDQ0aDAuMDg3TDkuMzI4LDYuMDg4TDkuMjg0LDYuMDQ0eiBNOS43Nyw2LjUzMWwwLjQ4NS0wLjQ4NmgyLjgwOWwwLjc4NiwwLjc4NmwtMS44OSwxLjg5TDkuNzcsNi41MzF6IE0xMy4zMjQsMy40MTQgICBoLTIuNTg3TDEwLjM3LDMuMDQ4bDIuMjA0LTEuOTY0TDEzLjMyNCwzLjQxNHogTTkuNzQxLDAuNzk0bDEuNTI3LDAuNzg0bC0xLjI1MiwxLjExNEw5LjY1MiwyLjMyOEw5Ljc0MSwwLjc5NHogTTguMTQzLDEuNTI3ICAgbDEuODg3LDEuODg3SDYuMDI1TDguMTQzLDEuNTI3eiBNNS41OTEsNi4wNDRIOC40TDguODg2LDYuNTNsLTIuMTksMi4xODlsLTEuODkxLTEuODlMNS41OTEsNi4wNDR6IE00LjIxLDYuMDQ0aDAuNDk3TDQuMzYzLDYuMzg4ICAgTDQuMjI3LDYuMjUzTDQuMjEsNi4wNDR6IE00LjYyNCwxMC43OTJMNC4zMjEsNy4zMTVsMC4wNDMtMC4wNDJsMS44OSwxLjg5TDQuNjI0LDEwLjc5MnogTTYuNjk2LDkuNjA0bDIuMTksMi4xOWwtMS42OTQsMS42OTUgICBsLTIuMTktMi4xOTFMNi42OTYsOS42MDR6IE02Ljc0OSwxMy45MzJsLTEuMzcsMS4zNjlsLTAuMzYtMy4wOTlMNi43NDksMTMuOTMyeiBNNi4yNTgsMTcuNjExYy0wLjYyOCwwLTEuMTM5LTAuNTExLTEuMTM5LTEuMTM5ICAgbC0wLjAwMi0wLjAyNGwwLjE5OC0wLjE5OGwxLjM2MSwxLjM2MUg2LjI1OHogTTcuMjU3LDE3LjMwOGwtMS41LTEuNTAxbDEuNDM0LTEuNDM0bDEuNjk0LDEuNjk0bC0xLjI0LDEuMjRMNy4yNTcsMTcuMzA4ICAgTDcuMjU3LDE3LjMwOHogTTguNTMsMTcuMzA4bDAuNzk4LTAuNzk4bDAuNzk3LDAuNzk4SDguNTN6IE0xMS4wMSwxNy4zMDhsLTEuMjQtMS4yNGwxLjY5NC0xLjY5NGwxLjQzNSwxLjQzNGwtMS41MDEsMS41MDEgICBMMTEuMDEsMTcuMzA4TDExLjAxLDE3LjMwOHogTTEzLjQ3MywxNi40MzZsLTAuMDAxLDAuMDM2YzAsMC42MjgtMC41MTEsMS4xMzktMS4xMzksMS4xMzloLTAuMzU0bDEuMzYtMS4zNjFsMC4xMzgsMC4xMzcgICBMMTMuNDczLDE2LjQzNnogTTEzLjI3NiwxNS4zMDFsLTEuMzctMS4zN2wxLjcyOS0xLjcyOUwxMy4yNzYsMTUuMzAxeiBNMTEuNDY0LDEzLjQ5bC0xLjY5NC0xLjY5NWwyLjE5LTIuMTlsMS42OTQsMS42OTQgICBMMTEuNDY0LDEzLjQ5eiBNMTMuOTgxLDEwLjc0MmwtMS41NzgtMS41NzlsMS44ODgtMS44ODlMMTMuOTgxLDEwLjc0MnogTTE0LjM3Niw2LjMwM2wtMC4wODQsMC4wODVsLTAuMzQ0LTAuMzQ0aDAuNDUxICAgTDE0LjM3Niw2LjMwM3oiIGZpbGw9IiM1ZTRjNjkiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>              
         

      </td>








      </tr><div class="modal fade" id="mymodal<?php echo $registro2['id']?>" data-keyboard="false" data-backdrop="true"  backdrop="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="<?php echo $_POST['sty'] ?>">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p>Estás seguro de inhabilitar el grado?</p>

              </div>
              <div class="modal-footer">    
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" data-dismiss="modal"   class="btn btn-primary"  name="eliminar_sede" 
                  id="btn"   onclick="var id= <?php echo($registro2['id']) ?>; eliminarrelacion(id)">Aceptars</button> 
                
              </div>
            </div>
          </div>
        </div><?php  
    }
    echo "


    </table>

";?>

   <div class="modal fade" id="may" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="<?php echo $_POST['sty'] ?>">Confirmación</h4>
              </div>
              <div class="modal-body">
                <p> Estás seguro de inhabilitar los grados?</p>

              </div>
              <div class="modal-footer">   
                  <input type="hidden" id="elimina" name="docentees" value='<?php echo $id_sede?>'>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit"  value='<?php echo $id_sede?>' class="btn btn-primary"  name="eliminar_sedes" 
                  onclick='
    $("#may").modal({backdrop: false});
    $("#may").modal("hide");'>Aceptar</button> 
                
              </div>
            </div>
          </div>
        </div>

    </form>



 <?php  echo " </div></div>";

    ?>
 
    <?php

    echo '<button type="button" id="t" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button> <ul class="pagination" id="pagination">
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#may"><i class="fa fa-trash-o"></i></button>'.$lista.'</ul>





    
    ' ;
    ?>
    <script type="text/javascript">
       $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
    </script>
<?php




}


///crea grados en su respectiva sede  y jornada finnnnnnnnnnnn









?>
