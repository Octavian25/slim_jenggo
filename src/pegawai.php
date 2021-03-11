<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/pegawai/add", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "INSERT INTO `tm_pegawai`(`id_pegawai`, `nama_pegawai`, `alamat`, `jenis_kelamin`, `gaji`, `no_telp`, `id_cabang`)
     VALUES (:id_pegawai,:nama_pegawai,:alamat,:jenis_kelamin,:gaji,:no_telp,:id_cabang)";
    $stmt = $this->db->prepare($sql);
    $uuid = Uuid::uuid4();
    $data = [
            ":id_pegawai" => autonumber(getLastID("tm_pegawai", "id_pegawai", $this->db), 2, 3),
            ":nama_pegawai" => $param["nama_pegawai"],
            ":alamat" => $param["alamat"],
            ":jenis_kelamin" => $param["jenis_kelamin"],
            ":gaji" => $param["gaji"],
            ":no_telp" => $param["no_telp"],
            ":id_cabang" => $param["id_cabang"],
    ];
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "Tambah Data Berhasil", "data" => $result3], 200);
});

$app->get("/api/get/pegawai/bycabang/{id}",function (Request $request, Response $response,  array $args){
        $id_cabang = $args["id"];
        $sql = "SELECT * FROM `tm_pegawai` WHERE id_cabang=:id_cabang";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ":id_cabang" => $id_cabang,
        ]);
        $hasil = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $hasil], 200);
});


