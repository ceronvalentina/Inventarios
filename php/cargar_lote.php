<?php
// Incluir archivo de conexión a la base de datos
require_once "main.php";
$getmysql = new registro();
$getconex = $getmysql->conex();

if(isset($_POST['Nombre'])) {
    // Obtener el nombre del producto seleccionado
    $Nombre = $_POST['Nombre'];

    // Consulta para obtener los lotes del producto seleccionado

    $query = "SELECT DISTINCT Lote FROM registros WHERE Producto = '$Nombre';";
    $result = mysqli_query($getconex, $query); 

    // Comprobar si hay resultados
    if(mysqli_num_rows($result) > 0) {
        // Construir las opciones del select de Lote
        $options = '<option value="" selected="" required>Seleccione una opción</option>';
        while($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['Lote'] . '">' . $row['Lote']  . '</option>';
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