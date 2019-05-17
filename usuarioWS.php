<?php
require("Toro.php");

class UsuarioHandler {
    function get() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $stmt = $dbh->prepare("SELECT * FROM usuario");
            $stmt->execute();

            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }
}

class UsuarioAddHandler {
    function get($nombre=null, $apellidopaterno=null, $apellidomaterno=null, $telefono=null, $contrasena=null,  $correo=null) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("INSERT INTO usuario (nombre, apellidopaterno, apellidomaterno, telefono, correo, contrasena) 
            VALUES (:nombre, :apellidopaterno, :apellidomaterno, :telefono, :correo, :contrasena)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellidopaterno', $apellidopaterno, PDO::PARAM_STR);
            $stmt->bindParam(':apellidomaterno', $apellidomaterno, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);

            $dbh->beginTransaction();
            $stmt->execute();
            $dbh->commit();

            
            //echo 'Successful';
        } catch (Exception $e) {
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        }
        //Get New User
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $stmt = $dbh->prepare("SELECT * FROM usuario ORDER BY id DESC LIMIT 1");
            $stmt->execute();
            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            $json = json_encode($data);
            echo $json;
        } catch (Exception $e) {
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        }
        //Create Cart
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo $json;
            $idUsuario=null;
            foreach ($data as $usuario){
                $idUsuario = $usuario['id'];
            }
            //echo $idUsuario;
            $stmt = $dbh->prepare("INSERT INTO carro (idUsuario, activo, metodoPago, sucursal) 
            VALUES (:idUsuario, 0, 0, 0)");
            $stmt->bindParam(':idUsuario', $idUsuario);

            $dbh->beginTransaction();
            $stmt->execute();
            $dbh->commit();

            
            //echo 'Successful';
        } catch (Exception $e) {
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}

class UsuarioUpdateHandler {
    function get($id=null, $nombre=null, $apellidopaterno=null, $apellidomaterno=null, $telefono=null, $correo=null) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("UPDATE usuario SET nombre = :nombre, apellidopaterno = :apellidopaterno,
             apellidomaterno = :apellidomaterno, telefono = :telefono, correo = :correo WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellidopaterno', $apellidopaterno, PDO::PARAM_STR);
            $stmt->bindParam(':apellidomaterno', $apellidomaterno, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);

            $dbh->beginTransaction();
            $stmt->execute();
            $dbh->commit();
            echo 'Successful';
        } catch (Exception $e) {
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}

class UsuarioDeleteHandler {
    function get($id=null) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("DELETE FROM usuario WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $dbh->beginTransaction();
            $stmt->execute();
            $dbh->commit();
            header('Location: http://localhost/sonroll/index.php');
        } catch (Exception $e) {
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}

class UsuarioHandlerById {
    function get($id=null) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT * FROM usuario WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $stmt->execute();

            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }
}

Toro::serve(array(
    "/" => "UsuarioHandler",
    "/:alpha/:alpha/:alpha/:number/:alpha/:email" => "UsuarioAddHandler",
    "/update/:number/:alpha/:alpha/:alpha/:number/:email" => "UsuarioUpdateHandler",
    "/delete/:number" => "UsuarioDeleteHandler",
    "/search/:number" => "UsuarioHandlerById",
));
?>