<?php
require("Toro.php");

class ComidaHandler {
    function get(){
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try{
            $stmt = $dbh->prepare("SELECT * FROM comida");
            $stmt->execute();

            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            echo json_encode($data);
        }catch(Exception $e){
            echo "Failed".$e->getMessage();
        }
    }
}

class ComidasByCarroIdHandler {
    function get($id=null){
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=sonroll', "root", "guaymas");
        } catch (Exception $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT * FROM comida as t1 INNER JOIN relcarrocomida ON WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $stmt->execute();

            $data = Array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $result;
            }
            echo json_encode($data);
        } catch (Exception $e){
            echo "Failed".$e->getMessage();
        }
    }
}

Toro::serve(array(
    "/" => "ComidaHandler",
    "/searchByCartId/:number" => "ComidaByCarroIdHandler",
));
?>