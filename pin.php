<?php

    session_start();

    if ( !isset($_SESSION['nombre']) ) {
        header('Location: index.php');
    }

    $id_del_usuario = $_SESSION['id'];
    $monto = $_GET['monto'];
    $pin = rand(100000, 999999);

    $conexion = mysqli_connect(
        'localhost', #servidor de MySQL 
        'root', #usuario
        '', #constraseña
        'banco_gratis' #nombre de la BD
    );

    mysqli_query(
        $conexion, 
        "INSERT INTO pins 
        (usuario, monto, codigo) 
        VALUES 
        ('$id_del_usuario', '$monto', '$pin') "
    );
?>

<h1><?php echo $pin; ?></h1>
<a href="home.php">Volver</a>
