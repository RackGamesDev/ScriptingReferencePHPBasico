<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        #las sesiones sirven para que solo cierta persona tenga un acceso a una pagina, o esta se modifique dependiendo de quien la vea
        session_start();#iniciar la sesion, obviamente despues de haber pasado un login
        $_SESSION["usuario"]="usuario";#guardar una variable en su sesion, "usuario" deberia ser el id del usuario en la base de datos
    ?>

    <!--0000000000000000000000000000000000000 luego en otra pagina:-->

    <?php
        #session_start();#esta parte deberia estar en la pagina que solo los usuarios podrian ver o se veria modificada (esto esta comentado pero de normal si habria que hacerlo)
        if(!isset($_SESSION["usuario"])){#para saber si la sesion esta o no
            header("location:form");
        } else {
            echo $_SESSION["usuario"];#dependiendo de cada variable de session consultar a la base de datos o hacer lo que sea
        }
    ?>
    
    <!--0000000000000000000000000000000000000 luego en otra pagina:-->

    <?php
        #luego en otra pagina, para cerrar la sesion
        #session_start();#para poder hacer cosas con la sesion (esto esta comentado pero de normal si habria que hacerlo)
        session_destroy();#cerrar sesion
        header("location:form.php");#redirigir al login
    ?>
</body>
</html>
