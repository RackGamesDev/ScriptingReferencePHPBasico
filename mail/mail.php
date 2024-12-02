<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        #El host que interpreta el php debe tener un servidor de correo encendido
        $texto = "aaa\r\nasdfaswdf";#Texto del correo
        $destinatario = "yesterlag1@gmail.com";#A quien va, no valida si el correo existe
        $asunto = "afdasfdsaf";#Asunto del correo
        $headers="MIME-Version: 1.0\r\n";#headers varios no obligatorios
        $headers.="Content-type: text/html; charset=iso-8859-1\r\n";
        $headers.="From: usuario que envia < prueba@asdfg.es >\r\n";#Quien lo envia, obviamente es falso
        $exito = mail($destinatario, $asunto, $texto, $headers);#Enviarlo
        if(!$exito){
            echo "error";
        } else {
            echo "bien";
        }
    ?>
</body>
</html>
