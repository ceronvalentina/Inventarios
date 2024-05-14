<?php


/*== Almacenando datos ==*/
$user_id_del = limpiar_cadena($_GET['user_id_del']);

if ($_SESSION['id'] == '1') {
    /*== Verificando usuario ==*/
    $check_usuario = chat();
    $check_usuario = $check_usuario->query("SELECT user_id FROM users WHERE user_id='$user_id_del'");

    if ($check_usuario->rowCount() == 1) {

        $eliminar_usuario = chat();
        $eliminar_usuario = $eliminar_usuario->prepare("DELETE FROM users WHERE user_id=:id");

        $eliminar_usuario->execute([":id" => $user_id_del]);

        if ($eliminar_usuario->rowCount() == 1) {
            echo '
		            <div class="notification is-info is-light">
		                <strong>¡USUARIO ELIMINADO!</strong><br>
		                Los datos del usuario se eliminaron con exito
		            </div>
		        ';
        } else {
            echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el usuario, por favor intente nuevamente
		            </div>
		        ';
        }
        $eliminar_usuario = null;

        $check_productos = null;
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO que intenta eliminar no existe
            </div>
        ';
    }
    $check_usuario = null;
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No Tienes permisos para realizar esta accion
            </div>
        ';

}