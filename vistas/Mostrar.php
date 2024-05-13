<?php

require_once "php\main.php";
$getmysql = new registro();
$getconex = $getmysql->conex();
$registros = "SELECT * FROM registros where Fecha= CURDATE();";

function formatNumber($num)
{
	return number_format($num, 0, ',', '.');
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
	<link rel="stylesheet" href="css/Tablaa.css">
	<link rel="stylesheet" href="css/estiloo.css">
	

</head>

<style>
	input[type="submit"] {
		padding: 3px;
		color: #fff;
		background: #0063b4;
		width: 150px;
		margin: 20px 20px;
		margin-top: 0;
		border-radius: 30px;
		cursor: pointer;
		font-size: 15px;
	}
</style>

<body>
	<hr>
	<form action="vistas\PDF.php" method="POST" target="_blank">
		<div class="columns">

			<div class="column">
				<label for="fecha">Informe Ventas o Ingresos</label>
				<input class="select is-rounded" type="date" value="" name="dia" required>
				<div class="select is-rounded">
					<select name="Ingreso_Salida">
						<option value="">Entradas y Salidas</option>
						<option value="Entrada">Entrada</option>
						<option value="Salida">Salida</option>
					</select>
				</div>
				<input type="submit" value="Imprimir Informe">
			</div>
		</div>
	</form>
	</div>

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



	<div class="columns">
		<div class="column">
			<form method="post">
				<label for="fecha">Fecha:</label>
				<input type="date" id="fecha" name="fecha">
				<input type="submit" value="Filtrar">
			</form>
		</div>

		<form action="vistas\PDF.php" method="POST" target="_blank">

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
    
	<div style="display: flex; flex-direction: row; justify-content: center; margin-top: 50px;">
    <form method="post" style="margin-right: 20px;">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
        <input type="submit" value="Filtrar">
    </form>
    <form action="vistas\PDF.php" method="POST" target="_blank" style="margin-right: 20px;">
        <label for="fecha">Informe por Fecha:</label>
        <input type="date" value="Imprimir Informe" name="dia">
        <input type="submit" value="Imprimir Informe">
    </form>
    <form action="vistas\PDF.php" method="POST" target="_blank">
        <div style="display: flex; align-items: center;">
            <label style="margin-right: 10px;">Informe Por Producto</label>
            <div class="select is-rounded" style="margin-right: 10px;">
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









</body>

</html>