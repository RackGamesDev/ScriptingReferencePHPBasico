<!--php no puede funcionar sin un servidor como apache, al abrirlo con xampp ya puede funcionar -->
<!--Todos los archivos publicos que respondera el servidor estan ordenados por carpetas y indexes.php en la instalacion de xampp en la carpeta htdocs-->
<!--Los .php funcionan como htmls pero con etiquetas php que apache puede interpretar y mandar renderizadas al cliente -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: rgb(245, 239, 223);/*Como de normal*/
        }
    </style>
</head>
<body>
    <!--Las etiquetas php se hacen asi, son perfectamente compatibles con javascript y demas -->
    <?php
        #Varias etiquetas php comparten recursos como funciones, variables, etc
        function fuera(){
            echo "fuera";
        }
    ?>

    <?php
        fuera();#Usando recursos de otras etiquetas
        include ("extra.php");#Importando codigo desde otro archivo a partir de ruta relativa, todo el archivo se ejecutaria aqui, las variables no se sobreescriben, tambien esta el include_once()
        #Require ("extra.php");#lo mismo pero si el archivo no esta crashea, no se puede importar algo 2 veces si se declaran cosas
        # Comentar lineas
        // Tambien comentar lineas
        /* Comentar varias lineas a la vez
        */
        #Lenguaje lineal, se usan ;
        echo "holaa <br>";#Tanto print como echo devuelven texto y etiquetas luego de renderizar el php
        print "asdfasfdasdfsd <br>";
        echo '<script>console.log("ola")</script>';#Se pueden hacer scripts asi, ya que funcionan como de normal

        
        $varString = "aasdf";#Creacion de variables, es dinamico
        $varString = 'bbb';
        $varInt = 23;
        $varBool = TRUE;
        $varBool = 3;#Pueden cambiar
        print $varString . "a";#Se concatena con .
        $varString .= "nuevo";#Concatenar a si mismo
        $varString = "asdf $varInt";#Se pueden mezclar asi (siempre que sean " y no ')
        echo $varBool, $varInt;#Poniendo varias variables, con print esto no va
        $varString = "\" \n \\ \$ \' etc...";#Caracteres especiales con \
        $varString = "&iacute;";#Se puede poner caracteres especiales con &
        $varBool = strcmp($varString, "asdf");#Devuelve 0 si ambos strings son exactamente iguales
        $varString = strtoupper($varString);#En mayusculas, tambien esta strtolower o ucwords para la primera en Mayuscula
        $varInt = 2 + "3";#Aunque las variables sean de distinto tipo pueden tener el mismo valor
        $numeroTexto = (int)$varInt;#De esta manera se obliga a cambiar de tipo

        define("VALOR_CONSTANTE", 3.14);#Declarar constantes, se hacen globales por defecto y solo pueden ser valores simples
        echo VALOR_CONSTANTE;#Usar constantes (ya hay algunas predefinidas)
        #Hay constantes que son __x__ devolviendo varias cosas ej: archivo, clase, funcion

        
        function funcion(){#Funcion simple
            echo "funciona";
            $varString = "sdfa";#Las variables estan aisladas dentro de los {}, no se pueden usar las de fuera y las de dentro no se pueden usar fuera
            global $varInt;#Ahora esta variable de fuera si se puede usar aqui dentro
            echo $varInt . "<br>";
            static $contador = 0;#Al poner static en una variable dentro de {} solo se declara una vez y se guarda su valor para la siguiente vez que se llame
            $contador++; echo $contador . "<br>";
        }
        funcion();#Llamar a funcion
        funcion();

        function datos($entrada, $opcional=3){#Necesita datos, si opcional no se especifica valdria 3
            return "aa" . $entrada;#Devolviendo datos al llamar
        }
        $varString = datos("bb");#Dando datos
        function cambiarVariable(&$var){#Usa la variable con la que es llamada y no una copia
            $var = "a";
            return $var;
        }
        cambiarVariable($varString);#Esta variable se modificaria
        #Ya hay algunas funciones predefinidas sobretodo para funciones matematicas como pow(), sqrt(), round(), rand(), etc...


        if($varBool){#Evalua si entra con 1, true o string que no sea ""
            echo "entro";
        } else if($varString){#E si no evalua otra cosa

        } else {#Y si no...
            echo "no entro";
        }
        $varBool = !$varBool;#Lo contrario
        $varBool = ($varString == "a" || $varString != "b") && $varInt == 1;#== es igual sin importar el tipo, ! es no, || (antes que or) es or y && (antes que and) es and
        $varBool = ($varInt > 1) || ($varInt < 1) || ($varInt <> 1) || ($varInt === 1);# > mayor, < menor, <> diferente, <=, >=, === identico en cuanto a valor y tipo
        $varInt = $varBool ? 1 : 0;#Si varbool es true devuelve 1 y si no 0

        switch ($varInt){#Dependiendo del estado de una variable hace una cosa
            case 1:#No hace falta poner el valor talcual
                #Si es 1
                break;#Si no se pusiese el break tambien evaluaria la siguiente
            case 2:
                break;
            default:
                #Si no es ninguno
                break;
        }
        switch (true):#De esta forma funcionaria como un elseif muy largo
            case $varBool && $varInt == 3:#Estructura que devuelva true o false
                #
                break;
            default:#else ultimo
                #else
                break;
        endswitch;

        try{#Codigo a ejecutar peligroso
            #Codigo peligroso
        } catch(Exception $e){#Si da error, abandona y hace esto
            echo $e;#$e hace referencia al error
        } finally {#Habiendo exito o no esto se ejecuta
            #Se ejecuta si o si
        }

        $i = 0;
        while($i < 5){#Ejecuta lineas hasta que la condicion sea cierta
            #Contenido repetido
            $i++;#Para que pueda salir alguna vez
            break;#Tambien sirve para salir
        }
        $i = 0;

        do{#Igual pero se ejecuta almenos una vez
            $i++;
        }while($i < 5);#Y luego evalua para repetir

        for($i = 0; $i <= 5; $i++){#Instruccion inicial ; condicion para repetir ; instruccion final
            #Ya hace la variable i y la cambia automaticamente, la variable solo se podria usar aqui
            continue;#Abandona las siguientes lineas de codigo y hace la siguiente vuelta de bucle
            break;#Tambien sirve para salir
        }


        echo "<br>";
        class Persona{#Crear la clase
            private int $edad;#Propiedades que tendran las instancias, tambien podrian ser otras clases (en este caso es privada) (hay que especificar el tipo)
            private string $nombre;#Al ser privadas solo se puede acceder desde las funciones de la clase
            public int $publica;#Esta, al ser publica se puede acceder directamente
            static int $siempre = 4;#De esta manera, no hace falta ponerla en el constructor ya que todas las instancias la tendran predefinica, similar a una constante (se puede combinar con public o private)
            public function __construct($nombreBase){#Constructor para dar valores iniciales, podria pedir parametros para al instanciarla usarlos
                $this->edad=0;#Dando valores pordefecto a cada variable, $this es la propia clase
                $this->nombre=$nombreBase;#Utilizando los parametros del constructor, tambien se podria usar para evaluar valores por defecto u otros
                $this->publica=0;
            }
            function saludar(){#Tambien pueden tener funciones
                echo "soy " . $this->nombre;
                echo "estatica es 0 " . self::$siempre;#Accediendo a la variable estatica. self hace referencia a la clase y this a la instancia
            }
            static function fstatica(){#Tambien hay funciones estaticas normalmente para manejar variables estaticas
                self::$siempre++;#Accediendo a variable estatica desde funcion estatica
            }
        }
        $unaPersona = new Persona("nombre base");#Crear una variable de ese tipo, una instancia. en este caso el constructor pedia un string para el nombre
        $unaPersona->saludar();#Y funciones
        echo $unaPersona->publica;#Accediendo directamente a las variables publicas
        echo Persona::$siempre;#Accediendo a la varaible estatica de la clase (no de la instancia) (en caso de que no sea private)
        echo Persona::fstatica();#Ejecutando funcion estatica desde la clase y no desde la variable
        class Heredada extends Persona{#Esta clase hereda de persona, tendra todo lo que tiene persona mas lo suyo
            private int $tamagno;
            public function __construct(){
                $this->tamagno=0;
            }
            function saludar(){#Ya habia una funcion con este nombre, al reescribirla se reemplaza
                parent::saludar();#Si se pone esto, en lugar de reescribirla por completo se le agnadiran lineas. parent:: hace referencia a la clase inmediatamente padre
                echo "mido " . $this->tamagno;
            }
        }
        

        echo "<br>";
        $array[] = "pos0";$array[] = 1;$array[] = "pos2";#Una manera de hacer arrays, se van agnadiendo los valores al final. pueden ser cualquier tipo de valor o incluso otros arrays. tambien se puede poner el indice manualmente
        echo $array[1];#Acceder a una posicion del array
        $array = array("asdf", 34, array(1,2));#Otra forma mejor de hacer arrays
        $array = array("pos0"=>0, "pos1"=>1);#Igual pero en lugar de indice con numero es con string
        echo $array["pos1"];#Accediendo por indice string
        echo is_array($array);#1 si es array
        echo count($array);#Devuelve el length
        unset($array[0]);#Borrar una posicion del array y desplazar a la izquierda las demas
        $array[] = "nuevo";#Agnadir una posicion al final
        sort($array);#Lo ordena segun contenido, por numero mayor a menor o alfabetico
        foreach($array as $clave=>$valor){#Un bucle especifico para recorrer arrays
            echo $clave . $valor;#Clave es el indice (num o string) y valor es el contenido
        }
        $tresde = array(array(array(1,2), array(1,2), array(1,2)),array(array(1,2), array(1,2), array(1,2)));#array de varias dimensiones
        echo $tresde[0][2][1];#Acceder a coordenada especificas
        foreach($tresde as $clave=>$valor){
            #while(list($clave2, $valor2) = each($valor)){#Similar a un foreach dentro de otro

            #}
        }


        setcookie("galleta", "valorrrr");#Guardar una cookie (es ilegal no avisarlo) (no funcionara en carpetas superiores a la del archivo que la genera)
        if(isset($_COOKIE["galleta"])){
            echo $_COOKIE["galleta"];#Leer la cookie, es valido en cualquier parte del dominio sin importar la pagina, se puede establecer una cookie en una pagina y leerla en otra
        }
        setcookie("galleta2", "asdf", time() + 2);#Hace que dure x segundos antes de borrarse (tambien se borra al cerrar el navegador probablemente)
        setcookie("galleta3", "asdf", time() + 200, "/phpprueba/act");#Modifica donde actua la cookie, ahora solo seria valida en los .php de esa carpeta
        setcookie("galleta", "", time() -1);#Eliminar cookie


        $contrasegna = "1234";
        $contrasegnaCifrada = password_hash($contrasegna, PASSWORD_DEFAULT);#Cifra una contrasegna con el algoritmo blowfish, luego se guardaria en la base de datos
        $contrasegnaCifrada = password_hash($contrasegna, PASSWORD_DEFAULT, array("cost"=>12));#Cambia el coste de encriptacion, + coste = + seguridad y + tiempo tarda
        if(password_verify($contrasegna, $contrasegnaCifrada)){#Compara la contrasegna normal y la cifrada como si fuese el ==
        }


        # header("location:form.php");#Redirige a otra pagina, location: haria referencia a este dominio + /
        echo time();#timestamp actual 
        $fechaa = date("Y-m-d H:i:s");#Representa la fecha, el string es para cambiar el formato
        echo $_GET["lugar"];#Aunque se puede usar para los forms, tambien recibe las variables ? de la url
        $textoSeguro = htmlentities(addslashes("adfa4aey·%8a/&(4t"));#Transforma texto peligroso en etiquetas html seguras
    ?>

    <?php
        foreach($array as $elemento):#Imprimir un html por cada elemento en un array, util para los select con bases de datos
    ?>
        <p>esto aparece por cada elemento (<?php $elemento ?>)</p>
    <?php
        endforeach;#Esto se suele usar con el foreach, pero tambien se puede con cualquier otra estructura (ej: if, for, while, etc) y se cierra poniendole end
    ?>
    <script>console.log("olaaaa")</script>
</body>
</html>
