<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
	integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<style>
	.seccion-perfil-usuario .perfil-usuario-body,
	.seccion-perfil-usuario {
		display: flex;
		flex-wrap: wrap;
		flex-direction: column;
		align-items: center;
	}

	.seccion-perfil-usuario .perfil-usuario-header {
		width: 100%;
		display: flex;
		justify-content: center;
		background: linear-gradient(#B873FF, transparent);
		margin-bottom: 1.25rem;
	}

	.seccion-perfil-usuario .perfil-usuario-portada {
		display: block;
		position: relative;
		width: 90%;
		height: 17rem;
		background-image: linear-gradient(45deg, #BC3CFF, #317FFF);
		border-radius: 0 0 20px 20px;
	}

	.seccion-perfil-usuario .perfil-usuario-portada .boton-portada {
		position: absolute;
		top: 1rem;
		right: 1rem;
		border: 0;
		border-radius: 8px;
		padding: 12px 25px;
		background-color: rgba(0, 0, 0, .5);
		color: #fff;
		cursor: pointer;
	}

	.seccion-perfil-usuario .perfil-usuario-portada .boton-portada i {
		margin-right: 1rem;
	}

	.seccion-perfil-usuario .perfil-usuario-avatar {
		display: flex;
		width: 180px;
		height: 180px;
		align-items: center;
		justify-content: center;
		border: 7px solid #FFFFFF;
		background-color: #DFE5F2;
		border-radius: 50%;
		box-shadow: 0 0 12px rgba(0, 0, 0, .2);
		position: absolute;
		bottom: -40px;
		left: calc(50% - 90px);
		z-index: 1;
	}

	.imagen {
		border-radius: 50%;
		display: flex;
		height: 170px;
		width: 900px;
		position: relative;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);

	}

	.Botones {
		border-radius: 50%;
		display: flex;
		height: 50px;
		width: 1000px;
		position: relative;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);

	}

	.contenedor {
		display: flex;
		/* Utiliza flexbox para alinear elementos */
		align-items: center;
		/* Alinea los elementos verticalmente */
	}

	#campoTexto {
		flex: 1;
		/* El campo de texto ocupa todo el espacio disponible */
	}

	.button {
		margin-left: 0px;
		/* Agrega un margen a la izquierda del botón */
		/* Estilos adicionales según tus preferencias */
	}
</style>

<?php
require_once "./php/main.php";

$id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
$id = limpiar_cadena($id);


$check_producto = conexion();
$check_producto = $check_producto->query("SELECT * FROM usuario WHERE usuario_id='$id'");

$datos = $check_producto->fetch();
?>
<div class="container is-fluid mb-6">
	<?php if ($id == $_SESSION['id']) { ?>
		<h1 class="title">Mi cuenta</h1>
		<h2 class="subtitle">Actualizar datos de cuenta</h2>
	<?php } else { ?>
		<h1 class="title">Usuarios</h1>
		<h2 class="subtitle">Actualizar usuario</h2>
	<?php } ?>
</div>

<div class="container pb-6 pt-6">
	<section class="seccion-perfil-usuario">
		<div class="perfil-usuario-header">
			<div class="perfil-usuario-portada">
				<div class="perfil-usuario-avatar">

					<div class="columns">
						<div class="column is-two-fifths">
							<?php if (is_file("./img/usuarios/" . $datos['usuario_imagen'])) { ?>

								<img class="imagen" src="./img/usuarios/<?php echo $datos['usuario_imagen']; ?>">

								<form class="FormularioAjax" action="./php/usuario_img_eliminar.php" method="POST"
									autocomplete="off">

									<input type="hidden" name="img_del_id" value="<?php echo $datos['usuario_id']; ?>">
								</form>
							<?php } ?>

						</div>

						<div class="column">
							<form class="mb-6 has-text-centered FormularioAjax" action="./php/usuario_imagen.php"
								method="POST" enctype="multipart/form-data" autocomplete="off">


								<input type="hidden" name="img_up_id" value="<?php echo $datos['usuario_id']; ?>">

								<div class="Botones">
									<label class="file-label">
										<input class="file-input" type="file" name="usuario_imagen"
											accept=".jpg, .png, .jpeg">
										<span class="file-cta">
											<span class="file-label">Cambiar Imagen de Perfil</span>
										</span>
										<p class="has-text-centered">
											<button type="submit"
												class="button is-success is-rounded">Actualizar</button>
										</p>
									</label>
								</div>

							</form>
						</div>
					</div>



				</div>
			</div>
		</div>
	</section>
	<?php

	include "./inc/btn_back.php";

	/*== Verificando usuario ==*/
	$check_usuario = conexion();
	$check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

	if ($check_usuario->rowCount() > 0) {
		$datos = $check_usuario->fetch();
		?>

		<form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

			<input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required>

			<div class="columns">
				<div class="column">
					<label>Nombre</label>
					<input name="usuario_nombre" class="input" type="text" id="usuario_nombre"
						pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $datos['usuario_nombre']; ?>"
						readonly>
					<button type="button" class="button" onclick="Nombre()">Editar</button>
				</div>
				<div class="column">
					<div class="control">
						<label>Apellidos</label>
						<input name="usuario_apellidos" class="input" type="text" id="usuario_apellidos"
							pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40"
							value="<?php echo $datos['usuario_apellido']; ?>" readonly>
						<button type="button" class="button" onclick="Apellido()">Editar</button>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Usuario</label>
						<input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20"
							id="usuario_usuario" required value="<?php echo $datos['usuario_usuario']; ?>" readonly>
						<button type="button" class="button" onclick="Usuario()">Editar</button>
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Email</label>
						<input class="input" type="email" name="usuario_email" maxlength="70" id="usuario_email"
							value="<?php echo $datos['usuario_email']; ?>" readonly>
						<button type="button" class="button" onclick="Email()">Editar</button>
					</div>
				</div>
			</div>
			<br><br>
			<p class="has-text-centered">
				SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la clave
				deje los campos vacíos.
			</p>
			<br>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Clave</label>
						<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}"
							maxlength="100">
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Repetir clave</label>
						<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}"
							maxlength="100">
					</div>
				</div>
			</div>
			<br><br><br>
			<p class="has-text-centered">
				Para poder actualizar los datos de este usuario por favor ingrese su USUARIO y CLAVE con la que ha iniciado
				sesión
			</p>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Usuario</label>
						<input class="input" type="text" name="administrador_usuario" pattern="[a-zA-Z0-9]{4,20}"
							maxlength="20" required>
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Clave</label>
						<input class="input" type="password" name="administrador_clave" pattern="[a-zA-Z0-9$@.-]{7,100}"
							maxlength="100" required>
					</div>
				</div>
			</div>
			<p class="has-text-centered">
				<button type="submit" class="button is-success is-rounded">Actualizar</button>
			</p>
		</form>
		<?php
	} else {
		include "./inc/error_alert.php";
	}
	$check_usuario = null;
	?>
</div>
<script>

	function Nombre() {
		var campo = document.getElementById("usuario_nombre");

		// Si el campo está bloqueado, habilita la edición
		if (campo.readOnly) {
			campo.readOnly = false;
			campo.focus(); // Coloca el cursor en el campo de texto
		} else {
			// Si el campo está desbloqueado, bloquea la edición
			campo.readOnly = true;
		}
	}

	function Apellido() {
		var campo = document.getElementById("usuario_apellidos");

		// Si el campo está bloqueado, habilita la edición
		if (campo.readOnly) {
			campo.readOnly = false;
			campo.focus(); // Coloca el cursor en el campo de texto
		} else {
			// Si el campo está desbloqueado, bloquea la edición
			campo.readOnly = true;
		}
	}

	function Usuario() {
		var campo = document.getElementById("usuario_usuario");

		// Si el campo está bloqueado, habilita la edición
		if (campo.readOnly) {
			campo.readOnly = false;
			campo.focus(); // Coloca el cursor en el campo de texto
		} else {
			// Si el campo está desbloqueado, bloquea la edición
			campo.readOnly = true;
		}
	}

	function Email() {
		var campo = document.getElementById("usuario_email");

		// Si el campo está bloqueado, habilita la edición
		if (campo.readOnly) {
			campo.readOnly = false;
			campo.focus(); // Coloca el cursor en el campo de texto
		} else {
			// Si el campo está desbloqueado, bloquea la edición
			campo.readOnly = true;
		}
	}
</script>