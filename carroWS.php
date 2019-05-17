<?php
require("Toro.php");

class CarroHandlerById{
    function get($id=null){
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        }catch (Exception $e){
            die("Unable to connect: " . $e->getMessage());
        }
        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT * FROM carro WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $stmt->execute();

            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            echo json_encode($data);
        }catch (Exception $e){
            echo "Failed: " . $e->getMessage();
        }
    }
}

class CarroHandlerByUserId{
    function get($id=null){
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        }catch (Exception $e){
            die("Unable to connect: " . $e->getMessage());
        }
        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT * FROM carro WHERE idUsuario = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $stmt->execute();

            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            echo json_encode($data);
        }catch (Exception $e){
            echo "Failed: " . $e->getMessage();
        }
    }
}

class CarroHandlerUpdateOrdenActiva{
    function get($id=null,$activo=null){
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        }catch (Exception $e){
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("UPDATE usuario SET activo = :activo WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':activo', $activo, PDO::PARAM_STR);

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

class CarroHandlerUpdateMetodoPago{
    function get($id=null,$activo=null){
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        }catch (Exception $e){
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("UPDATE usuario SET metodoPago = :activo WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':activo', $activo, PDO::PARAM_STR);

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

class CarroHandlerUpdateSucursal{
    function get($id=null,$activo=null){
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        }catch (Exception $e){
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("UPDATE usuario SET sucursal = :activo WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':activo', $activo, PDO::PARAM_STR);

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

class CarroHandlerUpdateComentario{
    function get($id=null,$activo=null){
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        }catch (Exception $e){
            die("Unable to connect: " . $e->getMessage());
        }
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("UPDATE usuario SET comentario = :activo WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':activo', $activo, PDO::PARAM_STR);

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

Toro::serve(array(
    "/search/:number" => "CarroHandlerById",
    "/searchByUser/:number" => "CarroHandlerByUserId",
    "/activar/:number/:number" => "CarroHandlerUpdateOrdenActiva",
    "/metodopago/:number/:number" => "CarroHandlerUpdateMetodoPago",
    "/sucursal/:number/:number" => "CarroHandlerUpdateSucursal",
    "/comentario/:number/:number" => "CarroHandlerUpdateComentario",
));
?>