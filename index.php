<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-6 offset-md-3">
                <form action="login.php">
                    <div class="form-group">
                        <input name="email" type="text" placeholder="Correo o usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <input name="clave" type="password" placeholder="Constraseña" class="form-control">
                    </div>
                    
                    <button class="btn btn-outline-primary">Iniciar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>