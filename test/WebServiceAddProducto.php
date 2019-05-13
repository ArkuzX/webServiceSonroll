<?php
    require("Toro.php");

    class DBHandler {

        function get($nombre=null, $telefono=null, $correo=null) {
            try {
              $dbh = new PDO('mysql:host=localhost;dbname=test', "root", "guaymas");
            } catch (Exception $e) {
              die("Unable to connect: " . $e->getMessage());
            }
            try {
              //$nombre = $_POST['nombre'];
              //$telefono = $_POST['telefono'];
              //$correo = $_POST['correo'];

              $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $stmt = $dbh->prepare("INSERT INTO usuario (nombre, telefono, correo) VALUES (:nombre,
                                    :telefono, :correo)");
              $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
              $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
              $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);

              $dbh->beginTransaction();
              $stmt->execute();
              $dbh->commit();
              echo 'Successfull';
            } catch (Exception $e) {
              $dbh->rollBack();
              echo "Failed: " . $e->getMessage();
            }
        }
    }

    Toro::serve(array(
        "/" => "DBHandler",
        "/usuario" => "DBHandler",
        "/usuario/:alpha/:alpha/:email" => "DBHandler",
    ));
?>