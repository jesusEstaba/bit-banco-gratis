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
        "SELECT * FROM usuarios" #la consulta SQL
    );

    $cantidadDeRegistros = mysqli_num_rows($resultado);
    
    $datos = [];

    
    for ($i=0; $i <= $cantidadDeRegistros; $i++) { 
        $datos[] = mysqli_fetch_assoc($resultado);
    }

    if (count($datos)) {
        if ($datos[0]['clave'] == $password) {
            echo "PUEDES PASAR FRODO";
        } else {
            echo "contraseña equi";
        }
    } else {
        echo "no exist";
    }

    


