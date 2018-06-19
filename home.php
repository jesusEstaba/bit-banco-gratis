<?php 
    session_start();

    if ( !isset($_SESSION['nombre']) ) {
        header('Location: index.php');
    }

    $id_del_usuario = $_SESSION['id'];

    $conexion = mysqli_connect(
        'localhost', #servidor de MySQL 
        'root', #usuario
        '', #constraseña
        'banco_gratis' #nombre de la BD
    );

    $resultado = mysqli_query(
        $conexion, 
        "SELECT * FROM transacciones WHERE usuario='$id_del_usuario' "
    );

    $cantidadDeRegistros = mysqli_num_rows($resultado);
    
    $transacciones = [];
    
    for ($i=0; $i <= $cantidadDeRegistros; $i++) { 
        $transacciones[] = mysqli_fetch_assoc($resultado);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Home</h1>
                <h4>Bienvenido <?php echo $_SESSION['nombre']?></h4>
                <a href="logout.php">Cerrar Sesión</a>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Tipo de transacción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $transacciones as $transaccion ): ?>
                            <tr>
                                <td><?php echo $transaccion['monto'] ?></td>
                                <td><?php echo $transaccion['tipo'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>
</html>