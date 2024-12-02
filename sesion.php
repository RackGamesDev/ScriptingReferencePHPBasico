<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        #Las sesiones sirven para que solo cierta persona tenga un acceso a una pagina, o esta se modifique dependiendo de quien la vea
        session_start();#Iniciar la sesion, obviamente despues de haber pasado un login
        $_SESSION["usuario"]="usuario";#Guardar una variable en su sesion, "usuario" deberia ser el id del usuario en la base de datos
    ?>

    <!--   Luego en otra pagina:-->

    <?php
        #session_start();#esta parte deberia estar en la pagina que solo los usuarios podrian ver o se veria modificada (esto esta comentado pero de normal si habria que hacerlo)
        if(!isset($_SESSION["usuario"])){#para saber si la sesion esta o no
            header("location:form");
        } else {
            echo $_SESSION["usuario"];#dependiendo de cada variable de session consultar a la base de datos o hacer lo que sea
        }
    ?>
    
    <!--   Luego en otra pagina:-->

    <?php
        #Luego en otra pagina, para cerrar la sesion
        #session_start();#Para poder hacer cosas con la sesion (esto esta comentado pero de normal si habria que hacerlo)
        session_destroy();#Cerrar sesion
        header("location:form.php");#Redirigir al login
    ?>
</body>
</html>
