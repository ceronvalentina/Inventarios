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
?>

<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/Muestra.css">
	<link rel="stylesheet" href="css/estilo.css">

</head>


<body>


	<div class="container-table">



		<div class="table_header">Fecha</div>
		<div class="table_header">Mesero</div>
		<div class="table_header">Producto</div>
		<div class="table_header">Categoria</div>
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


	<form method="post">
		<p class="t">Borrar Un Dato</p>
		<div class="container-table3">
			<div class="table_header">Cliente</div>
			<div class="table_header">Producto</div>
			<div class="table_header">Cantidad</div>

			<div class="table_ _item"><input type="text" name='Cliente'></div>
			<div class="table_ _item"><input type="text" name='Producto'></div>
			<div class="table_ _item"><input type="text" name='Cantidad'></div>

		</div>
		<div class="table_ _item"><input type="submit" name='Enviar'></div>

	</form>

	<form method="post">
		<input type="submit" name='borrar' value="Borrar todos los datos">
	</form>

	<form action="Grafica.php">
		<input type="submit" value="Imprimir Informe">
	</form>





</body>

</html>