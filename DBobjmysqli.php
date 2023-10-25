<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        define("DB_HOST", "localhost");#direccion web del host (no tienen por que ser constantes)
        define("DB_NOMBRE", "base");#nombre de la base de datos
        define("DB_USUARIO", "root");#usuario permitido
        define("DB_CONTRASEGNA", "");#su contrasegna

        class Conexion{#clase base para las conexiones
            protected $conexion_db;
            public function __Construct(){
                $this->conexion_db = new mysqli(DB_HOST, DB_USUARIO, DB_CONTRASEGNA, DB_NOMBRE);
                if($this->conexion_db->connect_errno){
                    echo "error " . $this->conexion_db->connect_error;
                    return;
                }
                $this->conexion_db->set_charset("utf8");
            }
        }
        
        class DevuelveDatos extends Conexion{#clase creada para devolver todos los objetos de x tabla, mediante una consulta (se podria usar otra consulta con otros datos y acciones)
            public function __Construct(){
                parent::__Construct();
            }
            public function get_datos($tabla){
                $resultado = $this->conexion_db->query("SELECT * FROM " . $tabla);
                $datos = $resultado->fetch_all(MYSQLI_ASSOC);
                return $datos;
            }
        }

        $datos = new DevuelveDatos();
        $arrayDatos = $datos->get_datos("tabla");#recibiendo esos datos
        foreach($arrayDatos as $valor){
            echo $valor["IDobj"];
        }
    ?>
</body>
</html>