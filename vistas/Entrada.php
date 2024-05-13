<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
						<option value="Salida" selected="">Salida</option>
					</select>
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
					<select name="producto" id="productoSelect" onchange="ActualizarLotes()" required>
						<option value="" selected="">Seleccione una opción</option>
					</select>
				</div>
			</div>


			<div class="columns">
				<div div class="column" id="loteInputSelect" style="display: none;">
					<div class="control">
						<div>
							<div class="select is-rounded">
								<label>Lote (Entrada)</label>
								<input class="input" type="text" name="Lote" id="Lote" onchange="checkEmpty(this)">
							</div>
						</div>
					</div>
				</div>

				<div class="column" id="loteInputText">
					<div class="select is-rounded">
						<label>Lote (Salida)</label>
						<select name="Lotes_Nuevos" id="loteSelect">
							<option value="">Seleccione un lote</option>

						</select>
					</div>
				</div>


				<div class="column">

					<div id="fechaInput" style="display: none;">
						<div class="select is-rounded">
							<label>Fecha</label>
							<input class="input" type="date" name="Fecha">
						</div>
					</div>

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
		var loteInputText = document.getElementById("loteInputText");
		var loteInputSelect = document.getElementById("loteInputSelect");

		if (ingresoSelect.value === "Entrada") {
			fechaInput.style.display = "block";
			loteInputText.style.display = "none";
			loteInputSelect.style.display = "block";
		} else {
			fechaInput.style.display = "none";
			loteInputText.style.display = "block";
			loteInputSelect.style.display = "none";
		}
	}



	function actualizarSubcategorias() {
		var categoriaSelect = document.getElementById("categoria").value;
		var productoSelect = document.getElementById("productoSelect");

		$.ajax({
			url: 'php/cargar_productos.php',
			method: 'POST',
			data: { categoria_id: categoriaSelect },
			success: function (data) {
				productoSelect.innerHTML = data;
			}
		});
	}
	function ActualizarLotes() {
		var productoSelect = document.getElementById("productoSelect").value;
		var loteSelect = document.getElementById("loteSelect");

		$.ajax({
			url: 'php/cargar_lote.php',
			method: 'POST',
			data: { Nombre: productoSelect },
			success: function (data) {
				loteSelect.innerHTML = data;
			}
		});
	}

	function checkEmpty(input) {
		if (input.value.trim() === '') {
			input.value = null;
		}
	}
</script>