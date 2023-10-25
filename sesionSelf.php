<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--igual que las sesiones normales pero todo en la misma pagina-->
    <?php
        if(isset($_POST["enviar"])){#nombre del boton submit del formulario
            #comprobacion del formulario (de llegada con _POST)
        }
    ?>

    <?php
        if(!isset($_SESSION["usuario"])){
            include("sesionForm.html");#incluir el formulario si no se ha iniciado sesion
        } else {
            echo $_SESSION["usuario"];#mostrar contenido exclusivo de cuenta
        }
    ?>
    <h2>contenido normal de la pagina principal o lo que sea</h2>
</body>
</html>
