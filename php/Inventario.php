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
$Ingreso= $_POST['Ingreso'];

$PrecioQuery = mysqli_query($getconex,"SELECT producto_precio FROM producto WHERE producto_id= '$producto'");
$PrecioArray = mysqli_fetch_assoc($PrecioQuery);
$Precio = $PrecioArray['producto_precio'];
$total = $Cantidad * $Precio;
$Mesero=$_SESSION['nombre'];


$producto_resultado = mysqli_query($getconex, "SELECT producto_nombre FROM producto WHERE producto_id = '$producto'");

if ($producto_fila = mysqli_fetch_assoc($producto_resultado)) {
    $producto_nombre = $producto_fila['producto_nombre'];
}

$Categoria = mysqli_query($getconex, "SELECT categoria_nombre FROM categoria WHERE categoria_id = '$categoria'");

if ($categoria_fila = mysqli_fetch_assoc($Categoria)) {
    $categoria = $categoria_fila['categoria_nombre'];
}

if($Ingreso=='Salida'){
    $Cantidad= -($Cantidad);
}





$insertar = "INSERT INTO registros (Mesero, Estado, Categoria, Producto, Cantidad, Precio, Total)
VALUES ('$Mesero','$Ingreso', '$categoria', '$producto_nombre', '$Cantidad', '$Precio', '$total')";

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