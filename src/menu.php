<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/menu/add", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "INSERT INTO `tm_menu`(`id_menu`, `id_barang`, `nama_barang`, `harga_barang`, `id_cabang`) 
    VALUES (:id_menu,:id_barang,:nama_barang,:harga_barang,:id_cabang)";
    $stmt = $this->db->prepare($sql);
    $uuid = Uuid::uuid4();
    $data = [
            ":id_menu" => autonumber(getLastID("tm_menu", "id_menu", $this->db), 2, 3),
            ":id_barang" => $param["id_barang"],
            ":nama_barang" => $param["nama_barang"],
            ":harga_barang" => $param["harga_barang"],
            ":id_cabang" => $param["id_cabang"],
    ];
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "Tambah Menu Berhasil", "data" => $result3], 200);
});

$app->put("/api/edit/menu/{id}", function (Request $request, Response $response,array $args){
    $id = $args["id"];
    $param = $request->getParsedBody();
    
    $sql = "UPDATE tm_menu SET id_barang=:id_barang,nama_barang=:nama_barang,harga_barang=:harga_barang,id_cabang=:id_cabang WHERE id_menu=:id_menu";
    $stmt = $this->db->prepare($sql);
    $uuid = Uuid::uuid4();
    $data = [
            ":id_menu" => $id,
            ":id_barang" => $param["id_barang"],
            ":nama_barang" => $param["nama_barang"],
            ":harga_barang" => $param["harga_barang"],
            ":id_cabang" => $param["id_cabang"],
    ];
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "Edit Menu Berhasil", "data" => $result3], 200);
});

$app->get("/api/get/menu/bycabang/{id}",function (Request $request, Response $response,  array $args){
        $id_cabang = $args["id"];
        $sql = "SELECT * FROM `tm_menu` WHERE id_cabang=:id_cabang";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ":id_cabang" => $id_cabang,
        ]);
        $hasil = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $hasil], 200);
});


