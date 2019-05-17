<?php
if(isset($_POST['sent'])){
    $path = "http://localhost/sonroll/usuarioWS.php/".$_POST['nombre']."/".$_POST['paterno']."/".$_POST['materno']."/".$_POST['telefono']."/".$_POST['contrasena']."/".$_POST['email']."";

    $data = file_get_contents($path);
    
}
//echo $data;
$path = "http://localhost/sonroll/usuarioWS.php/";
//http://192.168.0.16/sonroll/usuarioWS.php/nombre/apellidopat/apellidomat/telefono/contrasena/email

$data = file_get_contents($path);
$json = json_decode($data, true);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="index.php" method="post">
        <table>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombre" /></td>
            </tr>
            <tr>
                <td>Apellido Paterno</td>
                <td><input type="text" name="paterno" /></td>
            </tr>
            <tr>
                <td>Apellido Materno</td>
                <td><input type="text" name="materno" /></td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td><input type="text" name="telefono" /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" /></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" name="contrasena" /></td>
            </tr>
            <tr>
                <td>Guardar</td>
                <td><input type="submit" name="sent" /></td>
            </tr>
        </table>
    </form>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($json as $row){ ?>
        <tr>
            <td><?php echo $row['nombre']?></td>
            <td><?php echo $row['apellidopaterno']?></td>
            <td><?php echo $row['apellidomaterno']?></td>
            <td><?php echo $row['telefono']?></td>
            <td><?php echo $row['correo']?></td>
            <td>
            <a href="http://localhost/sonroll/comidaWS.php/ua/<?php echo $row['id'];?>" >Eliminar</a>
            </td>
            <td>
            <a href="http://localhost/sonroll/usuarioWS.php/delete/<?php echo $row['id'];?>" >Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>