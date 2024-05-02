<?php
// Verificar si se ha enviado una imagen
if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['avatar']['tmp_name'];
    $file_name = $_FILES['avatar']['name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    if(in_array($file_ext, $allowed_extensions)) {
        // Ruta donde se almacenará la imagen
        $upload_dir = 'uploads/'; // Cambia esto según tu lógica de almacenamiento
        $upload_path = $upload_dir . basename($file_name);
        
        // Mover la imagen a la carpeta de subidas
        if(move_uploaded_file($file_tmp, $upload_path)) {
            // Aquí puedes guardar la URL de la imagen en la base de datos o realizar cualquier otro procesamiento necesario
            echo "La imagen de perfil se ha actualizado correctamente.";
        } else {
            echo "Error al cargar la imagen.";
        }
    } else {
        echo "El formato de archivo no está permitido.";
    }
} else {
    echo "No se ha seleccionado ninguna imagen.";
}
?>

