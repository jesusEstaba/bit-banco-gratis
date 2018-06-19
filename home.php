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
    
    for ($i=0; $i < $cantidadDeRegistros; $i++) { 
        $transacciones[] = mysqli_fetch_assoc($resultado);
    }

    $resultado = mysqli_query(
        $conexion, 
        "SELECT SUM(monto) as ingreso FROM transacciones WHERE usuario='$id_del_usuario' AND tipo='Ingreso' "
    );

    $ingresos = mysqli_fetch_assoc($resultado);

    $resultado = mysqli_query(
        $conexion, 
        "SELECT SUM(monto) as egreso FROM transacciones WHERE usuario='$id_del_usuario' AND tipo='Egreso' "
    );

    $egresos = mysqli_fetch_assoc($resultado);


    $saldo = $ingresos['ingreso'] - $egresos['egreso'];
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Banco Gratis</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Cerrar Sesión</a>
        </li>
      </ul>
      <form class="form-inline" action="pin.php">
        <input class="form-control mr-sm-2" name="monto" type="text" placeholder="Monto">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Generar PIN</button>
      </form>
    </div>
  </nav>



    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                <h3>
                    Tu saldo es de $ <?php echo number_format($saldo, 2) ?>
                </h3>

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
                                <td>$ <?php echo number_format($transaccion['monto'], 2) ?></td>
                                <td>
                                    <?php 
                                        if ($transaccion['tipo'] == 'Ingreso') {
                                            echo '<span class="badge badge-success">Ingreso</span>';
                                        } else {
                                            echo '<span class="badge badge-danger">Egreso</span>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>
</html>