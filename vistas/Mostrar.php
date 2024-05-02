<?php

require_once "php\main.php";
$getmysql = new registro();
$getconex = $getmysql->conex();
$registros = "SELECT * FROM registros";

function formatNumber($num)
{
	return number_format($num, 0, ',', '.');
}

if (isset($_POST['borrar'])) {
	$sql = "delete from registros";
	mysqli_query($getconex, $sql);
	if (!$sql) {
		echo '<script>
			alert("No Eliminados");
		
			</script>';
	} else {
		echo '<script>
			alert("Registros Eliminados");
			
			</script>';
	}
}

if (isset($_POST['Enviar'])) {

	$Cliente = $_POST['Cliente'];
	$Producto = $_POST['Producto'];
	$Cantidad = $_POST['Cantidad'];

	$sql = "DELETE from registros where Cantidad='$Cantidad' and Cliente='$Cliente' and Botella='$Producto'";
	mysqli_query($getconex, $sql);

	if (!$sql) {
		echo '<script>
			alert("No Eliminado");
			
			</script>';
	}
}

if (isset($_POST['fecha'])) {
	// Obtener la fecha seleccionada por el usuario
	$fecha_filtro = $_POST['fecha'];

	$registros = "SELECT * FROM registros WHERE fecha = '$fecha_filtro'";
}


?>

<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/Tabla.css">
	<link rel="stylesheet" href="css/estilo.css">

</head>


<body>
	<div class="container-table2">

		<div class="table_header">Producto</div>
		<div class="table_header">Cantidad Total</div>
		<?php
		$Suma = mysqli_query($getconex, "SELECT Producto, SUM(Cantidad) from registros GROUP BY Producto;");
		while ($row = mysqli_fetch_assoc($Suma)) { ?>
			<div class="table_ _item">
				<?php echo $row["Producto"]; ?>
			</div>
			<div class="table_ _item">
				<?php echo formatNumber($row["SUM(Cantidad)"]); ?>
			</div>
			<?php
		}
		mysqli_free_result($Suma);
		?>


	</div>
	<div>
		<form method="post">
			<label for="fecha">Fecha:</label>
			<input type="date" id="fecha" name="fecha">
			<input type="submit" value="Filtrar">
		</form>
		<form action="vistas\PDF.php" method="POST" target="_blank">
			<label for="fecha">Informe por Fecha:</label>
			<input type="date" value="Imprimir Informe" name="dia">
			<input type="submit" value="Imprimir Informe">
		</form>
		<form action="vistas\PDF.php" method="POST" target="_blank">
			<div class="column">
				<label>Informe Por Producto</label><br>
				<div class="select is-rounded">
					<select name="producto" id="subcategoria">
						<option value="" selected="" required>Seleccione una opción</option>

						<?php
						$categorias = conexion();
						$categorias = $categorias->query("SELECT * FROM producto");
						if ($categorias->rowCount() > 0) {
							$categorias = $categorias->fetchAll();
							foreach ($categorias as $row) {
								echo '<option value="' . $row['producto_id'] . '">' . $row['producto_nombre'] . '</option>';
							}
						}
						$categorias = null;
						?>

					</select>
				</div>
				<input type="submit" value="Imprimir Informe">
			</div>
			
		</form>
	</div>



	<div class="container-table">

		<div class="table_header">Fecha</div>
		<div class="table_header">Mesero</div>
		<div class="table_header">Estado</div>
		<div class="table_header">Categoria</div>
		<div class="table_header">Producto</div>
		<div class="table_header">Cantidad</div>
		<div class="table_header">Precio</div>

		<div class="table_header">Total</div>

		<?php
		$resultado = mysqli_query($getconex, $registros);

		while ($row = mysqli_fetch_assoc($resultado)) { ?>
			<div class="table_ _item">
				<?php echo $row["Fecha"]; ?>
			</div>
			<div class="table_ _item">
				<?php echo $row["Mesero"]; ?>
			</div>
			<div class="table_ _item">
				<?php echo $row["Estado"]; ?>
			</div>
			<div class="table_ _item">
				<?php echo $row["Categoria"]; ?>
			</div>
			<div class="table_ _item">
				<?php echo $row["Producto"]; ?>
			</div>
			<div class="table_ _item">
				<?php echo formatNumber($row["Cantidad"]); ?>
			</div>
			<div class="table_ _item">
				<?php echo formatNumber($row["Precio"]); ?>
			</div>
			<div class="table_ _item">
				<?php echo formatNumber($row["Total"]); ?>
			</div>


			<?php
		}
		mysqli_free_result($resultado);
		?>

	</div>








</body>

</html>