<style>
    .containeeer {
        background: linear-gradient(to right, #061A42, #000000 );
        color: white; 
        height: 100vh;
        display: flex;
        flex-direction: row; 
        justify-content: center; 
        align-items: center; 
        text-align: center;
    }
    .image-contai {
        flex: 1; 
    }

    .image-contai img {
        max-width: 100%; 
        height: auto; 
    }
    .content {
        display: flex;
        flex-direction: column; 
        align-items: center; 
    }

    .coont {
        margin-top: 20px; 
    }
.btn{
    position: relative;
    padding: 20px 50px;
    text-decoration: none;
    color: #fff;
    letter-spacing: 10px;
    text-indent: 10px;
    z-index: 2;
}
.btn-2{
    border: 3px solid;
}

.btn-2:hover{
    background-color: #001a2b;
    box-shadow: 0 0 20px var(--color);
    border-color: var(--color);
}

.btn-2 span:nth-child(n){
    position: absolute;
    width: 10px;
    height: 10px;
    border: 3px solid;
    transition: all 0.6s ease;
}

.btn-2 span:nth-child(1){
    right: 10%;
    top: -10px;
    background-color: #fff;
}

.btn-2 span:nth-child(2){
    left: 10%;
    bottom: -10px;
}

.btn-2:hover span:nth-child(1){
    right: 80%;
    transform: rotate(90deg);
    color: var(--color);
    background-color: var(--color);
    
}

.btn-2:hover span:nth-child(2){
    left: 80%;
    transform: rotate(90deg);
    color: var(--color);
}

</style>

<div class="containeeer">
    <div class="image-contai">
        <img id="slider" src="img/x.png" alt="100">
    </div>
    <div class="content">
        <h1 class="title">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h1>
        <p>"La Simona es más que un simple bar, es un oasis urbano donde puedes escapar del ajetreo de la vida diaria <br>
            y sumergirte en un ambiente cálido y acogedor. Somos un refugio para aquellos que buscan disfrutar de <br>
            buena compañía, música agradable y, por supuesto, una gran variedad de bebidas."</p>
            <div class="coont">
                <a href="index.php?vista=Entrada" class="btn btn-2"> Empieza</a>
           </div>
    </div>
</div>

<script>
    
    var images = ['img/x.png', 'img/Z.jpg', 'img/p.jpg', 'img/H.jpg'];
    var currentIndex = 0;
    var imgElement = document.getElementById('slider');

    
    function changeImage() {
        currentIndex = (currentIndex + 1) % images.length;
        imgElement.src = images[currentIndex];
    }

    
    setInterval(changeImage, 3000);
</script>





