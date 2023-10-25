<!--php no puede funcionar sin un servidor como apache, al abrirlo con xampp ya puede funcionar -->
<!--todos los archivos publicos que respondera el servidor estan ordenados por carpetas y indexes.php en la instalacion de xampp en la carpeta htdocs-->
<!--los .php funcionan como htmls pero con etiquetas php que apache puede interpretar y mandar renderizadas al cliente -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: rgb(245, 239, 223);/*como de normal*/
        }
    </style>
</head>
<body>
    <!--las etiquetas php se hacen asi, son perfectamente compatibles con javascript y demas -->
    <?php
        #varias etiquetas php comparten recursos como funciones, variables, etc
        function fuera(){
            echo "fuera";
        }
    ?>

    <?php
        fuera();#usando recursos de otras etiquetas
        include ("extra.php");#importando codigo desde otro archivo a partir de ruta relativa, todo el archivo se ejecutaria aqui, las variables no se sobreescriben, tambien esta el include_once()
        #require ("extra.php");#lo mismo pero si el archivo no esta crashea, no se puede importar algo 2 veces si se declaran cosas
        # comentar lineas
        // tambien comentar lineas
        /* comentar varias lineas a la vez
        */
        #lenguaje lineal, se usan ;
        echo "holaa <br>";# tanto print como echo devuelven texto y etiquetas luego de renderizar el php
        print "asdfasfdasdfsd <br>";
        echo '<script>console.log("ola")</script>';# se pueden hacer scripts asi, ya que funcionan como de normal

        
        $varString = "aasdf";#creacion de variables, es dinamico
        $varString = 'bbb';
        $varInt = 23;
        $varBool = TRUE;
        $varBool = 3;#pueden cambiar
        print $varString . "a";# se concatena con .
        $varString .= "nuevo";#concatenar a si mismo
        $varString = "asdf $varInt";# se pueden mezclar asi (siempre que sean " y no ')
        echo $varBool, $varInt;# poniendo varias variables, con print esto no va
        $varString = "\" \n \\ \$ \' etc...";#caracteres especiales con \
        $varString = "&iacute;";#se puede poner caracteres especiales con &
        $varBool = strcmp($varString, "asdf");#devuelve 0 si ambos strings son exactamente iguales
        $varString = strtoupper($varString);#en mayusculas, tambien esta strtolower o ucwords para la primera en Mayuscula
        $varInt = 2 + "3";#aunque las variables sean de distinto tipo pueden tener el mismo valor
        $numeroTexto = (int)$varInt;#de esta manera se obliga a cambiar de tipo

        define("VALOR_CONSTANTE", 3.14);#declarar constantes, se hacen globales por defecto y solo pueden ser valores simples
        echo VALOR_CONSTANTE;#usar constantes (ya hay algunas predefinidas)
        #hay constantes que son __x__ devolviendo varias cosas ej: archivo, clase, funcion

        
        function funcion(){#funcion simple
            echo "funciona";
            $varString = "sdfa";#las variables estan aisladas dentro de los {}, no se pueden usar las de fuera y las de dentro no se pueden usar fuera
            global $varInt;#ahora esta variable de fuera si se puede usar aqui dentro
            echo $varInt . "<br>";
            static $contador = 0;#al poner static en una variable dentro de {} solo se declara una vez y se guarda su valor para la siguiente vez que se llame
            $contador++; echo $contador . "<br>";
        }
        funcion();#llamar a funcion
        funcion();

        function datos($entrada, $opcional=3){#necesita datos, si opcional no se especifica valdria 3
            return "aa" . $entrada;#devolviendo datos al llamar
        }
        $varString = datos("bb");#dando datos
        function cambiarVariable(&$var){#usa la variable con la que es llamada y no una copia
            $var = "a";
            return $var;
        }
        cambiarVariable($varString);#esta variable se modificaria
        #ya hay algunas funciones predefinidas sobretodo para funciones matematicas como pow(), sqrt(), round(), rand(), etc...


        if($varBool){#evalua si entra con 1, true o string que no sea ""
            echo "entro";
        } else if($varString){#y si no evalua otra cosa

        } else {#y si no...
            echo "no entro";
        }
        $varBool = !$varBool;#lo contrario
        $varBool = ($varString == "a" || $varString != "b") && $varInt == 1;#== es igual sin importar el tipo, ! es no, || (antes que or) es or y && (antes que and) es and
        $varBool = ($varInt > 1) || ($varInt < 1) || ($varInt <> 1) || ($varInt === 1);# > mayor, < menor, <> diferente, <=, >=, === identico en cuanto a valor y tipo
        $varInt = $varBool ? 1 : 0;#si varbool es true devuelve 1 y si no 0

        switch ($varInt){#dependiendo del estado de una variable hace una cosa
            case 1:#no hace falta poner el valor talcual
                #si es 1
                break;#si no se pusiese el break tambien evaluaria la siguiente
            case 2:

                break;
            default:
                #si no es ninguno
                break;
        }
        switch (true):#de esta forma funcionaria como un elseif muy largo
            case $varBool && $varInt == 3:#estructura que devuelva true o false
                #
                break;
            default:#else ultimo
                #else
                break;
        endswitch;

        try{#codigo a ejecutar peligroso
            #codigo peligroso
        } catch(Exception $e){#si da error, abandona y hace esto
            echo $e;#$e hace referencia al error
        } finally {#habiendo exito o no esto se ejecuta
            #final
        }

        $i = 0;
        while($i < 5){#ejecuta lineas hasta que la condicion sea cierta
            #contenido repetido
            $i++;#para que pueda salir alguna vez
            break;#tambien sirve para salir
        }
        $i = 0;

        do{#igual pero se ejecuta almenos una vez
            $i++;
        }while($i < 5);#y luego evalua para repetir

        for($i = 0; $i <= 5; $i++){#instruccion inicial ; condicion para repetir ; instruccion final
            #ya hace la variable i y la cambia automaticamente, la variable solo se podria usar aqui
            continue;#abandona las siguientes lineas de codigo y hace la siguiente vuelta de bucle
            break;#tambien sirve para salir
        }


        echo "<br>";
        class Persona{#crear la clase
            private int $edad;#propiedades que tendran las instancias, tambien podrian ser otras clases (en este caso es privada) (hay que especificar el tipo)
            private string $nombre;#al ser privadas solo se puede acceder desde las funciones de la clase
            public int $publica;#esta, al ser publica se puede acceder directamente
            static int $siempre = 4;#de esta manera, no hace falta ponerla en el constructor ya que todas las instancias la tendran predefinica, similar a una constante (se puede combinar con public o private)
            public function __construct($nombreBase){#constructor para dar valores iniciales, podria pedir parametros para al instanciarla usarlos
                $this->edad=0;#dando valores pordefecto a cada variable, $this es la propia clase
                $this->nombre=$nombreBase;#utilizando los parametros del constructor, tambien se podria usar para evaluar valores por defecto u otros
                $this->publica=0;
            }
            function saludar(){#tambien pueden tener funciones
                echo "soy " . $this->nombre;
                echo "estatica es 0 " . self::$siempre;#accediendo a la variable estatica. self hace referencia a la clase y this a la instancia
            }
            static function fstatica(){#tambien hay funciones estaticas normalmente para manejar variables estaticas
                self::$siempre++;#accediendo a variable estatica desde funcion estatica
            }
        }
        $unaPersona = new Persona("nombre base");#crear una variable de ese tipo, una instancia. en este caso el constructor pedia un string para el nombre
        $unaPersona->saludar();#y funciones
        echo $unaPersona->publica;#accediendo directamente a las variables publicas
        echo Persona::$siempre;#accediendo a la varaible estatica de la clase (no de la instancia) (en caso de que no sea private)
        echo Persona::fstatica();#ejecutando funcion estatica desde la clase y no desde la variable
        class Heredada extends Persona{#esta clase hereda de persona, tendra todo lo que tiene persona mas lo suyo
            private int $tamagno;
            public function __construct(){
                $this->tamagno=0;
            }
            function saludar(){#ya habia una funcion con este nombre, al reescribirla se reemplaza
                parent::saludar();#si se pone esto, en lugar de reescribirla por completo se le agnadiran lineas. parent:: hace referencia a la clase inmediatamente padre
                echo "mido " . $this->tamagno;
            }
        }
        

        echo "<br>";
        $array[] = "pos0";$array[] = 1;$array[] = "pos2";#una manera de hacer arrays, se van agnadiendo los valores al final. pueden ser cualquier tipo de valor o incluso otros arrays. tambien se puede poner el indice manualmente
        echo $array[1];#acceder a una posicion del array
        $array = array("asdf", 34, array(1,2));#otra forma mejor de hacer arrays
        $array = array("pos0"=>0, "pos1"=>1);#igual pero en lugar de indice con numero es con string
        echo $array["pos1"];#accediendo por indice string
        echo is_array($array);#1 si es array
        echo count($array);#devuelve el length
        unset($array[0]);#borrar una posicion del array y desplazar a la izquierda las demas
        $array[] = "nuevo";#agnadir una posicion al final
        sort($array);#lo ordena segun contenido, por numero mayor a menor o alfabetico
        foreach($array as $clave=>$valor){#un bucle especifico para recorrer arrays
            echo $clave . $valor;#clave es el indice (num o string) y valor es el contenido
        }
        $tresde = array(array(array(1,2), array(1,2), array(1,2)),array(array(1,2), array(1,2), array(1,2)));#array de varias dimensiones
        echo $tresde[0][2][1];#acceder a coordenada especificas
        foreach($tresde as $clave=>$valor){
            #while(list($clave2, $valor2) = each($valor)){#similar a un foreach dentro de otro

            #}
        }


        setcookie("galleta", "valorrrr");#guardar una cookie (es ilegal no avisarlo) (no funcionara en carpetas superiores a la del archivo que la genera)
        if(isset($_COOKIE["galleta"])){
            echo $_COOKIE["galleta"];#leer la cookie, es valido en cualquier parte del dominio sin importar la pagina, se puede establecer una cookie en una pagina y leerla en otra
        }
        setcookie("galleta2", "asdf", time() + 2);#hace que dure x segundos antes de borrarse (tambien se borra al cerrar el navegador probablemente)
        setcookie("galleta3", "asdf", time() + 200, "/phpprueba/act");#modifica donde actua la cookie, ahora solo seria valida en los .php de esa carpeta
        setcookie("galleta", "", time() -1);#eliminar cookie


        $contrasegna = "1234";
        $contrasegnaCifrada = password_hash($contrasegna, PASSWORD_DEFAULT);#cifra una contrasegna con el algoritmo blowfish, luego se guardaria en la base de datos
        $contrasegnaCifrada = password_hash($contrasegna, PASSWORD_DEFAULT, array("cost"=>12));#cambia el coste de encriptacion, + coste = + seguridad y + tiempo tarda
        if(password_verify($contrasegna, $contrasegnaCifrada)){#compara la contrasegna normal y la cifrada como si fuese el ==
        }


        # header("location:form.php");#redirige a otra pagina, location: haria referencia a este dominio + /
        echo time();#timestamp actual 
        $fechaa = date("Y-m-d H:i:s");#representa la fecha, el string es para cambiar el formato
        echo $_GET["lugar"];#aunque se puede usar para los forms, tambien recibe las variables ? de la url
        $textoSeguro = htmlentities(addslashes("adfa4aey·%8a/&(4t"));#transforma texto peligroso en etiquetas html seguras
    ?>

    <?php
        foreach($array as $elemento):#imprimir un html por cada elemento en un array, util para los select con bases de datos
    ?>
        <p>esto aparece por cada elemento (<?php $elemento ?>)</p>
    <?php
        endforeach;#esto se suele usar con el foreach, pero tambien se puede con cualquier otra estructura (ej: if, for, while, etc) y se cierra poniendole end
    ?>
    <script>console.log("olaaaa")</script>
</body>
</html>
