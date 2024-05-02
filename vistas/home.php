<style>
    .containeeer {
        background-image: url('img/fondoo.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh; /* Esto ajustará la altura de la pantalla al 100% del tamaño de la ventana del navegador */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
</style>

<div class="containeeer">
	<h1 class="title">Home</h1>
	<h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h2>
</div>