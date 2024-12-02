<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        define("DB_HOST", "localhost");#Direccion web del host (no tienen por que ser constantes)
        define("DB_NOMBRE", "base");#Nombre de la base de datos
        define("DB_USUARIO", "root");#Usuario permitido
        define("DB_CONTRASEGNA", "");#Su contrasegna

        class Conexion{#Clase base para las conexiones
            protected $conexion_db;
            public function __Construct(){
                try{
                    $this->conexion_db = new PDO("mysql:host=" . DB_HOST . "; dbname=base", DB_USUARIO, DB_CONTRASEGNA);
                    #$this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conexion_db->exec("SET CHARACTER SET utf8");
                    return $this->conexion_db;
                }catch(Exception $e){
                    echo "error " . $e;
                }
            }
        }

        class DevuelveDatos extends Conexion{#Clase creada para devolver todos los objetos de x tabla, mediante una consulta (se podria usar otra consulta con otros datos y acciones)
            public function __Construct(){
                parent::__Construct();
            }
            public function get_datos($tabla){
                $sql="SELECT * FROM " . $tabla . ";";
                $sentencia = $this->conexion_db->prepare($sql);
                $sentencia->execute(array());
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                $sentencia->closeCursor();
                return $resultado;
                $this->conexion_db = null;
            }
        }

        $datos = new DevuelveDatos();
        $arrayDatos = $datos->get_datos("tabla");#Recibiendo esos datos
        foreach($arrayDatos as $valor){
            echo $valor["IDobj"];
        }
    ?>
</body>
</html>
