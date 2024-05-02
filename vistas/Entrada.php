<div class="container pb-6 pt-6">
	<?php
	require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/Inventario.php" method="POST" class="" autocomplete="off" enctype="multipart/form-data">
		<div class="columns">
			<div class="column">
				<label>Inventario</label><br>
				<div class="select is-rounded">
					<select name="Ingreso" id="ingresoSelect" required onchange="mostrarFechaInput()">
						<option value="Entrada">Entrada</option>
						<option value="Salida" selected ="">Salida</option>
					</select>
				</div>
			</div>

			<div class="columns">

				<div class="column">

					<div id="fechaInput" style="display: none;">
						<div class="select is-rounded">
							<label>Fecha</label>
							<input class="input" type="date" name="Fecha" >
						</div>
					</div>
				</div>
				<div class="column">
					<div class="control">
						<div>
							<div class="select is-rounded">
								<label>Lote</label>
								<input class="input" type="Text" name="Lote" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="column">
				<label>Categoría</label><br>
				<div class="select is-rounded">
					<select name="categoria" id="categoria" onchange="actualizarSubcategorias()">
						<option value="" selected="" required>Seleccione una opción</option>
						<?php
						$categorias = conexion();
						$categorias = $categorias->query("SELECT * FROM categoria");
						if ($categorias->rowCount() > 0) {
							$categorias = $categorias->fetchAll();
							foreach ($categorias as $row) {
								echo '<option value="' . $row['categoria_id'] . '">' . $row['categoria_nombre'] . '</option>';
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



<script>
	function mostrarFechaInput() {
		var ingresoSelect = document.getElementById("ingresoSelect");
		var fechaInput = document.getElementById("fechaInput");

		if (ingresoSelect.value === "Entrada") {
			fechaInput.style.display = "block";
		} else {
			fechaInput.style.display = "none";
		}
	}
</script>