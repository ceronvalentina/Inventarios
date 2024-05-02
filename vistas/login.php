<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/cabecera.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

<div class="main-container">
    
	<form class="box login" action="" method="POST" autocomplete="off">
		<h5 class="title is-5 has-text-centered is-uppercase">Inventario La Simona</h5>

		<div class="field">
			<label class="label">Usuario</label>
			<div class="control">
				<input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20"
					required>
			</div>
		</div>

		<div class="field">
			<label class="label">Clave</label>
			<div class="control">
				<input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
					required>
			</div>
			<div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>
		</div>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>

		<?php
		if (isset($_POST['login_usuario']) && isset($_POST['login_clave'])) {
			require_once "./php/main.php";
			require_once "./php/iniciar_sesion.php";
		}
		?>
	</form>


</div>