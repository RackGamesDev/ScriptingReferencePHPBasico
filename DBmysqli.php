<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Desde xampp hay que encender apache y mysql y entrar en localhost/phpmyadmin/ para gestionarlo o escribir (ruta)\xampp\mysql\bin\mysql.exe -u root -p base   donde root es el usuario y base es el nombre de la base de datos-->
    <!--Las consultas sql y operaciones se pueden hacer desde la consola o phpmyadmin (aunque sea mariadb)-->
    <?php
        define("DB_HOST", "localhost");#Direccion web del host (no tienen por que ser constantes)
        define("DB_NOMBRE", "base");#Nombre de la base de datos
        define("DB_USUARIO", "root");#Usuario permitido
        define("DB_CONTRASEGNA", "");#Su contrasegna
        $conexion = mysqli_connect(DB_HOST, DB_USUARIO, DB_CONTRASEGNA, DB_NOMBRE);#Conexion a la base de datos, si no se especificase el ultimo parametro se haria con mysqli_connect_database(conexion, nombre) or die ("error)
        if(mysqli_connect_errno()){#Si falla
            echo "falla";
            exit();#Bloquea el flujo de ejecucion
        }
        mysqli_set_charset($conexion, "utf8");#Mas caracteres

        $consulta="SELECT * FROM tabla";#Crear consulta desde variable
        $consulta=(string)file_get_contents("consultas/recibirDatosLimpio.sql");#Desde archivo.sql (no serian necesarios los use)
        $resultado = mysqli_query($conexion, $consulta);#Usando la conexion y la consulta para obtener datos
        $fila=mysqli_fetch_row($resultado);#Devuelve un array
         echo $fila[0];#Develve la propiedad x del primer entry, donde x es el index del array
         echo $fila[1]; echo $fila[2]; echo "<br>";
        $fila=mysqli_fetch_row($resultado);#Al volver a llamarla, hace lo mismo pero con el siguiente entry. esto es mas conveniente con bucles
         echo $fila[0]; echo $fila[1]; echo $fila[2]; echo "<br>";
         $fila=mysqli_fetch_row($resultado); echo $fila[0]; echo $fila[1]; echo $fila[2]; echo "<br>";# Otra vez
        while(($fila=mysqli_fetch_row($resultado))==true){#Ejemplo para hacerlo correctamente con un bucle (en este caso no funcionaria porque la funcion ya ha sido ejecutada varias veces antes)
            #Imprimir informacion
            echo $fila[0];
        }
        echo "<br>";

        while(($fila=mysqli_fetch_array($resultado))==true){#Igual pero en el array se indexa con strings
            echo $fila["IDobj"];
        }


        $consulta=(string)file_get_contents("consultas/insertarDatoLimpio.sql");
        mysqli_query($conexion, $consulta);#Tambien se pueden hacer consultas que modifiquen la base de datos, en este caso no seria necesario recibir ningun valor
        echo mysqli_affected_rows($conexion);#Numero de rows afectadas por consultas anteriores
        $usuario = mysqli_real_escape_string($conexion, 'usuariooo=="%&');#Para evitar inyecciones sql, esta funcion devuelve el string sin caracteres peligrosos (util al introducir parametros desde formulario) (tambien se puede usar mysqli_addslashes())
        
        #Para mas seguridad ante inyecciones, usar consultas preparadas (SELECT)
        $criterioBusqueda = "hola";#Lo que busca el usuario
        $consulta = "SELECT * FROM tabla WHERE nombre = ?";#? donde valla a ir la variable
        $resultado = mysqli_prepare($conexion, $consulta);#Devuelve un objeto mysqli_stmt
        $ok = mysqli_stmt_bind_param($resultado, "s", $criterioBusqueda);#s=string, i=int, d=float (lo que tenga en el campo de parametro de busqueda) (devuelve true si va todo bien)
        $ok=mysqli_stmt_execute($resultado);#Ejecuta finalmente la consulta (devuelve true si va todo bien)
        if($ok==false){
            echo "error";
        } else {
            $ok = mysqli_stmt_bind_result($resultado, $IDobj, $nombre, $edad);#(sin contar resultado) declara variables por cada parametro de los entrys encontarados
            echo "econtrados: <br>";
            while(mysqli_stmt_fetch($resultado)){
                echo $IDobj . " " . $nombre . " " . $edad . "<br>";#Cada vuelta del bucle estas variables tendran valores distintos, en caso de que haya mas de un entry encontrado
            }
            mysqli_stmt_close($resultado);#Cerrar la conexion (si solo se usan consultas preparadas el mysqli_close() no hace falta)
        }

        #Para mas seguridad ante inyecciones, usar consultas preparadas (modificar)
        $entrarNombre = "holaaaa";#Variables supuestamente sacadas de un formulario? (optimizadas y protegidas de inyecciones)
        $entrarEdad = 99;
        $consulta = "INSERT INTO tabla (nombre, edad) VALUES (?,?)";#Los ? representan cada parametro a introducir en la counsulta (vale para cualquier consulta que modifique datos, no solo insert)
        $resultado = mysqli_prepare($conexion, $consulta);#idem
        $ok = mysqli_stmt_bind_param($resultado, "isi", $entrarNombre, $entrarEdad);#Cada variable del formulario en el mismo orden de la tabla ("isi" = int string int, al haber 3 parametros)
        $ok = mysqli_stmt_execute($resultado);#idem
        if($ok==false){
            echo "error";
        } else {
            echo "todo bien";
            mysqli_stmt_close($resultado);#idem
        }


        mysqli_close($conexion);#Cerrar la conexion al final


        #Lo mismo pero orientado a objetos:
        $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_CONTRASEGNA, DB_NOMBRE);#hacer conexion
        if($conexion->connect_errno){#Error de conexion
            echo "error" . $conexion->connect_errno;
        }
        $conexion->set_charset("utf8");#Asi se cambia el charset, el resto de funciones se hacen muy igual a esto, poniendo conexion->funcion()
        $resultado = $conexion->query("SELECT * FROM tabla");#Haciendo consulta
        if($conexion->errno){#Error de consulta
            die($conexion->error);
        }
        while($fila = $resultado->fetch_assoc()){#Imprimir resultados, y tambien esta fetch_array()
            echo $fila["nombre"] . "<br>";
        }
        $conexion->close();#Cerrar conexion

        $seguro = htmlentities(addslashes("z8xc=)T8r"));#Otra forma de volver seguro el codigo es con esto, luego habria que meter esta variable en la consulta
    ?>
</body>
</html>
