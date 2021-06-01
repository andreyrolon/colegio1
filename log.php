<!DOCTYPE html>
<html>
<head>
	<title></title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
</head>
<style type="text/css">
	#ListaArticulos li{
		border:1px solid;
		display: inline-block;
		height: 150px;
		list-style: none;widows: 200px;
	}
</style>
<body>
	<script type="text/javascript">
		$(document).on('ready',  function() {
			$('#ListaArticulos li').draggable({
				helper:'clone'
			});
			$('.carrito').draggable({
				helper:'clone'
			});
			$('.carrito').droppable({
				drop:eventoDrop

			});
			function eventoDrop(evento,ui){
				 
  
				var precio=parseFloat(ui.draggable.children('.precio').text()); 
				var i=$('#precio').text(); 
				alert(precio+' '+i);
			}
		});
	</script>
	<section id="Articulos">
		<ul id="ListaArticulos">
			<li style=" background: white" data-articulo='arroz'>arroz $ <span class="precio1"   style="display: none;"> 8 </span> <nav class="precio">232</nav> </li>
			<li style=" background: red" data-articulo='tomate'>tomate $<nav class="precio">2000</nav></li>
			<li style=" background: brown" data-articulo='papa'>papa $<span class="precio">3000</span></li>
			<li style=" background: yellow" data-articulo='azucAr'>azucAr $<span class="precio">4000</span></li> 
		</ul>
	</section>
<br><br>
	<div class="carrito"><img src="logos/mas.JPG" style="width: 250px"> <span id="precio" class="precio">44</span></div>
	<div class="carrito"><img src="logos/mas.JPG" style="width: 250px"> <span class="precio">232</span></div>

</body>
</html>