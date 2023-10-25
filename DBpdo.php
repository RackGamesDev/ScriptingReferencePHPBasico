<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--similar a mysqli orientado a objetos pero este solo es a objetos y se puede conectar a mas tipos de bases de datos-->
    <?php
        try{
            $base=new PDO('mysql:host=localhost; dbname=base', 'root', '');#se pone tipo de base de datos, ubicacion del servidor, nombre, usuario y contrasegna
            $base->exec("SET CHARACTER SET utf8");#ejecuta un comando pdo, en este caso poner el utf8 charset
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#para ver errores

            $consulta = "SELECT * FROM TABLA WHERE NOMBRE = ? AND edad = ?";#la consulta es preparada, usando ? como argumento
            $resultado = $base->prepare($consulta);#consulta preparada, en caso de que fuese una consulta que no devuelve nada no se devolveria nada (al estar preparada esta protegida a inyecciones)
            $resultado->execute(array("hola", 100));#ejecutar, se usa un array donde cada posicion representa un ? en el orden en el que aparecen en la consulta

            $consulta = "SELECT * FROM TABLA WHERE NOMBRE = :nombre AND edad = :edad";#tambien se pueden poner varios argumentos asi
            $resultado = $base->prepare($consulta);
            $resultado->execute(array(":nombre" => "hola", ":edad" => 100));#y se especifican por su nombre en el array (asociativo)

            echo $resultado->rowCount() . "<br>";#devuelve el numero de entrys encontrados (en caso de que la consulta sea para recibir algo)
            while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){#similar al mysqli, tambien esta fetch_array
                echo $registro["IDobj"] . $registro["nombre"] . $registro["edad"];
            }
            $resultado->closeCursor();#cerrar resultado

            $seguro = htmlentities(addslashes("z8xc=)T8r"));#otra forma de volver seguro el codigo es con esto, luego habria que meter esta variable en la consulta
        } catch (Exception $e){
            echo $e;
            die("error" . $e->GetMessage());
        } finally {
            $base = null;#cerrar la conexion
        }
    ?>
</body>
</html>
