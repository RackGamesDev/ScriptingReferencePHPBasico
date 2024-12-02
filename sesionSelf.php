<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Igual que las sesiones normales pero todo en la misma pagina-->
    <?php
        if(isset($_POST["enviar"])){#Nombre del boton submit del formulario
            #Comprobacion del formulario (de llegada con _POST)
        }
    ?>

    <?php
        if(!isset($_SESSION["usuario"])){
            include("sesionForm.html");#Incluir el formulario si no se ha iniciado sesion
        } else {
            echo $_SESSION["usuario"];#Mostrar contenido exclusivo de cuenta
        }
    ?>
    <h2>contenido normal de la pagina principal o lo que sea</h2>
</body>
</html>
