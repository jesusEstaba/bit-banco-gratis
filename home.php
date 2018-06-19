<?php 
    session_start();

    if ( !isset($_SESSION['nombre']) ) {
        header('Location: index.php');
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
            </div>
        </div>
    </div>
</body>
</html>