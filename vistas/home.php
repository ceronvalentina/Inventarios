<style>
    .containeeer {
        background-image: url('img/c.jpg');
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
    <h1 class="title">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h1>
    <p>"La Simona es más que un simple bar, es un oasis urbano donde puedes escapar del ajetreo de la vida diaria <br>
        y sumergirte en un ambiente cálido y acogedor. Somos un refugio para aquellos que buscan disfrutar de <br>
        buena compañía, música agradable y, por supuesto, una gran variedad de bebidas."</p>
</div>
