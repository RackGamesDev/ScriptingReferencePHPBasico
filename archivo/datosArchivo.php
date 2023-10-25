<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>archivo recibido</h1>
<?php
    $nombre_archivo = $_FILES["archivo"]["name"];#variable que devuelve archivos, se especifica su nombre en el form y la propiedad a sacar
    $tipo_archivo = $_FILES["archivo"]["type"];
    $tamagno_archivo = $_FILES["archivo"]["size"];
    $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/phpbasico/archivo/archivos/";#especificar la carpeta de destino apartir del htdocs

    move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo);#guardarlo en la carpeta, conviene ponerle un nombre unequivoco (ej: timestamp)
    

    $conexion = mysqli_connect("localhost", "root", "");#ahora se guardara el archivo en una base de datos, con el campo blob (longblob)
    mysqli_select_db($conexion, "base");
    mysqli_set_charset($conexion, "utf8");
    $archivo_objetivo = fopen($carpeta_destino . $nombre_archivo, "r");#abre un archivo local, la r es de read ya que hay de varios tipos (mirar documentacion)
    $contenido = fread($archivo_objetivo, $tamagno_archivo);#el contenido del archivo ya esta volcado en esta variable
    $contenido = addslashes($contenido);
    fclose($archivo_objetivo);#cerrar el archivo
    $consulta="INSERT INTO archivos (nombre, tipo, contenido) VALUES ('$nombre_archivo', '$tipo_archivo', '$contenido')";#consulta para insertar el archivo (ya no hace falta tenerlo en local)
    $resultado = mysqli_query($conexion, $consulta);
    if(mysqli_affected_rows($conexion) > 0){
        echo "guardado";
    } else {
        echo "error";
    }

    echo "<img src='data:image/png; base64," . base64_encode($contenido) . "'>";#en caso de que el archivo sea una imagen se representa asi, para otros tipos de archivo hay que cambiar lo de data:image/png al tipo de archivo
?>
</body>
</html>