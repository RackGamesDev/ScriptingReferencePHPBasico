<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--formulario para enviar archivo, el enctype es para que se envien archivos, aqui habria que especificar el tipo, cantidad y tamagno de archivos-->
    <form action="datosArchivo.php" method="post" enctype="multipart/form-data">
        <input type="file" name="archivo" size="20">
        <input type="submit" value="enviar archivo">
    </form>
</body>
</html>