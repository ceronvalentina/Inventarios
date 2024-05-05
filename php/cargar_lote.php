<?php
// Incluir archivo de conexión a la base de datos
require_once "./php/main.php";
$getmysql = new registro();
$getconex = $getmysql->conex();

if(isset($_POST['Producto_nombre'])) {
    // Obtener el nombre del producto seleccionado
    $Producto_nombre = $_POST['Producto_nombre'];

    // Consulta para obtener los lotes del producto seleccionado
    $query = "SELECT DISTINCT * FROM registros WHERE Producto = '$Producto_nombre';";
    $result = mysqli_query($getconex, $query);

    // Comprobar si hay resultados
    if(mysqli_num_rows($result) > 0) {
        // Construir las opciones del select de Lote
        $options = '<option value="" selected="" required>Seleccione una opción</option>';
        while($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['id'] . '">' . $row['Lote']  . '</option>';
        }
        // Devolver las opciones como respuesta
        echo $options;
    } else {
        // Si no hay lotes disponibles para el producto seleccionado
        echo '<option value="">No hay Lotes disponibles</option>';
    }

    // Liberar resultado
    mysqli_free_result($result);
} else {
    // Si no se recibió el nombre del producto
    echo '<option value="">Error: No se recibió el nombre del producto</option>';
}

// Cerrar conexión
mysqli_close($getconex);
?>