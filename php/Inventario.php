<?php

require_once "../inc/session_start.php";
require_once "main.php";
$conexion = conexion();
$getmysql = new registro();
$getconex = $getmysql->conex();



$Ingreso = $_POST['Ingreso'];
$categoria = $_POST['categoria'];
$Cantidad = $_POST['Cantidad'];
$producto = $_POST['producto'];
$Ingreso = $_POST['Ingreso'];
$Fecha = $_POST['Fecha'];





$PrecioQuery = mysqli_query($getconex, "SELECT producto_precio FROM producto WHERE producto_nombre= '$producto'");
$PrecioArray = mysqli_fetch_assoc($PrecioQuery);

$Precio = $PrecioArray['producto_precio'];

$total = $Cantidad * $Precio;
$Mesero = $_SESSION['nombre'];

$Stock = mysqli_query($getconex, "SELECT producto_stock FROM producto WHERE producto_nombre= '$producto'");

if ($producto_fila = mysqli_fetch_assoc($Stock)) {
    $producto_stock = $producto_fila['producto_stock'];
}

$producto_resultado = mysqli_query($getconex, "SELECT producto_nombre FROM producto WHERE producto_nombre = '$producto'");

if ($producto_fila = mysqli_fetch_assoc($producto_resultado)) {
    $producto_nombre = $producto_fila['producto_nombre'];
}

$Categoria = mysqli_query($getconex, "SELECT categoria_nombre FROM categoria WHERE categoria_id = '$categoria'");

if ($categoria_fila = mysqli_fetch_assoc($Categoria)) {
    $categoria = $categoria_fila['categoria_nombre'];
}




if ($Ingreso == 'Salida') {
    $Lote = $_POST['Lotes_Nuevos'];

    $Cantidad_lote = mysqli_query($getconex, "SELECT SUM(Cantidad) FROM `registros` WHERE Lote='$Lote' && producto= '$producto_nombre'");
    if ($categoria_fila = mysqli_fetch_assoc($Cantidad_lote)) {
        $Cantidad_lote = $categoria_fila['SUM(Cantidad)'];
    }

    $Suma = mysqli_query($getconex, "SELECT SUM(Cantidad) from registros where producto='$producto_nombre'");
    if ($categoria_fila = mysqli_fetch_assoc($Suma)) {
        $Suma = $categoria_fila['SUM(Cantidad)'];
    }

    if (($Suma - $Cantidad) >= 0) {

        if ($producto_stock >= $Suma) {


            if (($Suma - $Cantidad_lote) <= 0) {
                echo '<script>
        alert("Cantidades en el lote insuficientes");
        window.history.go(-1);
        </script>';

                mysqli_close($getconex);
            }

            echo '<script>
        alert("Stock Minimo Superado");
        window.history.go(-1);
        </script>';

        }
    }else{
        
        echo '<script>
        alert("Cantidad Solicitada Supera las Existencias");
        window.history.go(-1);
        </script>';
        mysqli_close($getconex);
    }

    $Cantidad = -($Cantidad);

    $FechaResult = mysqli_query($getconex, "SELECT `FV` FROM `registros` WHERE Lote='$Lote' && producto= '$producto_nombre'");

    if ($FechaResult) {
        $FechaRow = mysqli_fetch_assoc($FechaResult);

        if ($FechaRow) {
            $Fecha = $FechaRow['FV'];
        } else {

            echo '<script>
            alert("Lote no encontrado ' . $Lote . '");
            window.history.go(-1);
            </script>';

            mysqli_close($getconex);
        }
    }

    $insertar = "INSERT INTO registros(Mesero, Estado, Categoria, Producto, Lote, FV, Cantidad, Precio, Total) 
    VALUES ('$Mesero','$Ingreso', '$categoria', '$producto_nombre','$Lote','$Fecha', '$Cantidad', '$Precio', '$total')";



    $resultado = mysqli_query($getconex, $insertar);

    if (!$resultado) {
        echo '<script>
        alert("No registrado Correctamente ");
        window.history.go(-1);
        </script>';
    } else {
        echo '<script>
    alert("Registrado Correctamente ");
    window.history.go(-1);
    </script>';
    }

    mysqli_close($getconex);

} else {

    
    $Lote = $_POST['Lote'];

    $insertar = "INSERT INTO registros(Mesero, Estado, Categoria, Producto, Lote, FV, Cantidad, Precio, Total) 
    VALUES ('$Mesero','$Ingreso', '$categoria', '$producto_nombre','$Lote','$Fecha', '$Cantidad', '$Precio', '$total')";

    $resultado = mysqli_query($getconex, $insertar);

    if (!$resultado) {
        echo '<script>
    alert("No registrado Correctamente");
    window.history.go(-1);
    </script>';
    } else {
        echo '<script>
    alert("Registrado Correctamente ");
    window.history.go(-1);
    </script>';
    }


    mysqli_close($getconex);

}