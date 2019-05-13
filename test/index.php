<?php
    $path = "http://192.168.0.16/service/examples/test/WebServiceProducto.php/";

    $data = file_get_contents($path);
    $json = json_decode($data, true);

    if(isset($_POST['sent'])){
        /*$url = 'http://192.168.0.16/service/examples/test/WebServiceAddProducto.php/usuario/nombre/telefono/correo';

        $data = array('nombre'=>$_POST['nombre'],'telefono'=>$_POST['telefono'],
                    'correo' => $_POST['correo']);
        $options = array(
                'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);*/
        $paths = "http://192.168.0.16/service/examples/test/WebServiceAddProducto.php/usuario/ura/telefono/correo";

        $datas = file_get_contents($paths);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    table, th, td {
        border: 1px solid black;
    }
    </style>
</head>
<body>
    <table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
    </tr>
        <?php
            foreach($json as $row){
        ?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['nombre']?></td>
            <td><?php echo $row['telefono']?></td>
            <td><?php echo $row['correo']?></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <form action="index.php" method="post">
        <label>Nombre <input type="text" name="nombre" /></label>
        <label>Telefono <input type="text" name="telefono" /></label>
        <label>Correo <input type="text" name="correo" /></label>
        <input type="submit" name="sent" />
    </form>
</body>
</html>