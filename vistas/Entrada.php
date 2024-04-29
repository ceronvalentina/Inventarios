<div class="container pb-6 pt-6">
	<?php
	require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/Inventario.php" method="POST" class="FormularioAjax" autocomplete="off"
		enctype="multipart/form-data">
		<div class="columns">
			<div class="column">
				<label>Inventario</label><br>
				<div class="select is-rounded">
					<select name="Ingreso" required>
						<option value="Entrada" selected="">Entrada</option>
						<option value="Salida" selected="">Salida</option>
					</select>
				</div>
			</div>
			<div class="column">
				<label>Categoría</label><br>
				<div class="select is-rounded">
					<select name="categoria">
						<option value="" selected="" required>Seleccione una opción</option>
						<?php
						$categorias = conexion();
						$categorias = $categorias->query("SELECT * FROM categoria");
						if ($categorias->rowCount() > 0) {
							$categorias = $categorias->fetchAll();
							foreach ($categorias as $row) {
								echo '<option value="' . $row['categoria_id'] . '" >' . $row['categoria_nombre'] . '</option>';
							}
						}
						$categorias = null;
						?>
					</select>
				</div>
			</div>
			<div class="column">
				<label>Producto</label><br>
				<div class="select is-rounded">
					<select name="producto" required>
						<option value="" selected="">Seleccione una opción</option>
						<?php
						$producto = conexion();
						$producto = $producto->query("SELECT * FROM producto");
						if ($producto->rowCount() > 0) {
							$producto = $producto->fetchAll();
							foreach ($producto as $row) {
								echo '<option value="' . $row['producto_id'] . '" >' . $row['producto_nombre'] . '</option>';
							}
						}
						$producto = null;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="column">
			<div class="control">
				<label>Cantidad</label>
				<input class="input" type="number" name="Cantidad" maxlength="25" required>
			</div>
		</div>

		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
	crossorigin="anonymous"> </script>

</body>

</html>