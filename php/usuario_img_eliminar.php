<?php
	require_once "main.php";

	/*== Almacenando datos ==*/
    $product_id=limpiar_cadena($_POST['img_del_id']);
    
    if($_SESSION['id']=='Administrador'){
    /*== Verificando producto ==*/
    $check_producto=conexion();
    $check_producto=$check_producto->query("SELECT * FROM usuario WHERE usuario_id='$product_id'");

    if($check_producto->rowCount()==1){
    	$datos=$check_producto->fetch();
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del PRODUCTO que intenta eliminar no existe
            </div>
        ';
        exit();
    }
    $check_producto=null;


    /* Directorios de imagenes */
	$img_dir='../img/usuarios/';

	/* Cambiando permisos al directorio */
	chmod($img_dir, 0777);


	/* Eliminando la imagen */
	if(is_file($img_dir.$datos['usuario_imagen'])){

		chmod($img_dir.$datos['usuario_imagen'], 0777);

		if(!unlink($img_dir.$datos['usuario_imagen'])){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Error al intentar eliminar la imagen del producto, por favor intente nuevamente
	            </div>
	        ';
	        exit();
		}
	}


	/*== Actualizando datos ==*/
    $actualizar_producto=conexion();
    $actualizar_producto=$actualizar_producto->prepare("UPDATE usuario SET usuario_imagen=:foto WHERE usuario_id=:id");

    $marcadores=[
        ":foto"=>"",
        ":id"=>$product_id
    ];

    if($actualizar_producto->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                La imagen del producto ha sido eliminada exitosamente, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=product_img&product_id_up='.$product_id.'" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    }else{
        echo '
            <div class="notification is-warning is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                Ocurrieron algunos inconvenientes, sin embargo la imagen del producto ha sido eliminada, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=product_img&product_id_up='.$product_id.'" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    }
    $actualizar_producto=null;
}else
{
	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No Tienes permisos para realizar esta accion
            </div>
        ';

}