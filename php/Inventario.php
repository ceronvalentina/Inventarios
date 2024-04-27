<?php

require_once "../inc/session_start.php";
require_once "main.php";
$conexion=conexion();

$getmysql = new registro();
$getconex = $getmysql->conex();

$Ingreso = $_POST['Ingreso'];
$categoria = $_POST['categoria'];
$Cantidad = $_POST['Cantidad'];
$producto = $_POST['producto'];

$PrecioQuery = mysqli_query($getconex,"SELECT producto_precio FROM producto WHERE producto_id= '$producto'");
$PrecioArray = mysqli_fetch_assoc($PrecioQuery);
$Precio = $PrecioArray['producto_precio'];
$total = $Cantidad * $Precio;

$Mesero=$_SESSION['nombre'];




$insertar = "INSERT INTO registros (Mesero, Categoria, Producto, Cantidad, Precio, Total)
VALUES ('$Mesero', '$categoria', '$producto', '$Cantidad', '$Precio', '$total')";


$resultado = mysqli_query($getconex, $insertar);





if (!$resultado) {
    echo '<script>
    alert("No registrado Correctamente");
    window.history.go(-1); 
    </script>';
} else {
    echo '<script>
    alert("Registrado Correctamente");
    window.history.go(-1); 
    </script>';
}


mysqli_close($getconex);


?>