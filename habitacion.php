<?php
/*-------------------------
	Autor: ROGER GERBER QUIRINO
	Mail: rogergerber@outlook.es
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
    $active_principal="";
	$active_habitacion="active";
	$active_clientes="";
	$active_usuarios="";	
	$title="Sistema | Hotel";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoHabitacion"><span class="glyphicon glyphicon-plus" ></span> Nueva Habitacion</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Habitacion</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
			include("modal/registro_habitacion.php");
			include("modal/editar_habitacion.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Código o nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Código o nombre del Habitacion" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			
		
	
			
			
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/habitacion.js"></script>
  </body>
</html>
<script>
$( "#guardar_habitacion" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_habitacion.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_habitacion").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_habitacion").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_habitacion" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_habitacion.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var codigo_habitacion = $("#codigo_habitacion"+id).val();
			var nombre_habitacion = $("#nombre_habitacion"+id).val();
			var estado = $("#estado"+id).val();
			var precio_habitacion = $("#precio_habitacion"+id).val();
			$("#mod_id").val(id);
			$("#mod_codigo").val(codigo_habitacion);
			$("#mod_nombre").val(nombre_habitacion);
			$("#mod_precio").val(precio_habitacion);
			$("#mod_estado").val(estado);
		}
</script>