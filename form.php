<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--recibir datos de un form al dar al submit-->
    <form action="" method="POST" name="datos" id="datos"><!--en el form se deben especificar esos datos, incluyendo al POST, si en action se pone el nombre de un archivo hara las validaciones alli-->
        <input type="text" name="texto" id="texto"><!--inputs bien nombrados-->
        <input type="text" name="texto2" id="texto2">
        <input type="submit" value="dar" name="enviando" id="enviando"><!--el nombre y id del submit irrepetible-->
    </form>
    <?php
        if(isset($_POST["enviando"])){#este codigo se ejecutara cuando se haga el submit con este nombre, hay que usar el mimso verbo http usado en el form
            $texto=$_POST["texto"];#recibiendo los datos de cada input por su nombre
            $texto2=$_POST["texto2"];#las variables que empiezan por _ son superglobales accesibles en cualquier sitio, son arrays y cada posicion (por texto) es una cosa
            echo $texto;
            echo $texto2;
            #aqui ya se pondria el texto renderizado incluso antes de lo que haya despues
        }
        echo "despues";
    ?>
</body>
</html>