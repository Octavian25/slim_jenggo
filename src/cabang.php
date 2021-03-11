<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/cabang/add", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "INSERT INTO tm_cabang(id_cabang, nama_cabang, alamat_cabang)
     VALUES (:id_cabang,:nama_cabang,:alamat_cabang)";
    $stmt = $this->db->prepare($sql);
    $uuid = Uuid::uuid4();
    $data = [
            ":id_cabang" => autonumber(getLastID("tm_cabang", "id_cabang", $this->db), 2, 3),
            ":alamat_cabang" => $param["alamat_cabang"],
            ":nama_cabang" => $param["nama_cabang"],
    ];
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "Tambah Cabang Berhasil", "data" => $result3], 200);
});

$app->get("/api/get/cabang",function (Request $request, Response $response){
        $sql = "SELECT * FROM `tm_cabang`";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $hasil = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $hasil], 200);
});
$app->delete("/api/delete/cabang/{id}",function (Request $request, Response $response, array $args){
        $id = $args["id"];
        $sql = "DELETE FROM `tm_cabang` WHERE id_cabang=:id_cabang";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ":id_cabang" => $id
        ]);
        return $response->withJson(["status" => "success", "data" => "Berhasil Delete Cabang"], 200);
});

$app->get("/api/get/cabang/{id}",function (Request $request, Response $response, array $args){
    $id = $args["id"];
    $sql = "SELECT * FROM `tm_cabang` WHERE id_cabang=:id_cabang";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        ":id_cabang" => $id
    ]);
    $hasil = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $hasil], 200);
});


