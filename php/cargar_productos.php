<?php
// Incluir archivo de conexión a la base de datos
require 'main.php';
$getmysql = new registro();
$getconex = $getmysql->conex();

if(isset($_POST['categoria_id'])) {
    // Obtener el ID de la categoría seleccionada
    $categoria_id = $_POST['categoria_id'];

    // Consulta para obtener los productos de la categoría seleccionada
    $query = "SELECT * FROM producto WHERE categoria_id = '$categoria_id'";
    $result = mysqli_query($getconex, $query);

    // Comprobar si hay resultados
    if(mysqli_num_rows($result) > 0) {
        // Construir las opciones del segundo select
        $options = '<option value="" selected="" required>Seleccione una opción</option>';
        while($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['producto_nombre'] . '">' . $row['producto_nombre']  . '</option>';
        }
        // Devolver las opciones como respuesta
        echo $options;
    } else {
        // Si no hay productos en la categoría seleccionada
        echo '<option value="">No hay productos disponibles</option>';
    }

    // Liberar resultado
    mysqli_free_result($result);
} else {
    // Si no se recibió el ID de la categoría
    echo '<option value="">Error: No se recibió el ID de la categoría</option>';
}

// Cerrar conexión
mysqli_close($getconex);
