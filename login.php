<?php
    $password = $_GET['clave'];
    $email = $_GET['email'];

    $conexion = mysqli_connect(
        'localhost', #servidor de MySQL 
        'root', #usuario
        '', #constraseña
        'banco_gratis' #nombre de la BD
    );

    $resultado = mysqli_query(
        $conexion, 
        "SELECT * FROM usuarios WHERE correo='$email' "
    );

    $cantidadDeRegistros = mysqli_num_rows($resultado);
    
    $datos = [];

    
    for ($i=0; $i <= $cantidadDeRegistros; $i++) { 
        $datos[] = mysqli_fetch_assoc($resultado);
    }

    if (count($datos)) {
        if ($datos[0]['clave'] == $password) {
            session_start();
            $_SESSION['nombre'] = $datos[0]['nombre'];
            header('Location: home.php');
        } else {
            echo "contraseña equi";
        }
    } else {
        echo "no exist";
    }

    



