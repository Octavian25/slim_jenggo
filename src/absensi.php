<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/absensi", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "INSERT INTO tt_absensi(id_absensi, tanggal_absensi, id_pegawai) VALUES (:id,:tanggal,:id_pegawai)";
    $stmt = $this->db->prepare($sql);
    $uuid = Uuid::uuid4();
    $data = [
            ":tanggal" => $param["tanggal"],
            ":id" => $uuid,
            ":id_pegawai" => $param["id_pegawai"]
    ];
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "Absensi Berhasil", "data" => $result3], 200);
});

$app->get("/api/get/absensi/{tgl_awal}&{tgl_akhir}",function (Request $request, Response $response,  array $args){
        $tgl_awal = $args["tgl_awal"];
        $tgl_akhir = $args["tgl_akhir"];
        $sql = "SELECT * FROM tt_absensi WHERE tanggal_absensi BETWEEN :tgl_awal AND :tgl_akhir";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ":tgl_awal" => $tgl_awal,
            ":tgl_akhir" => $tgl_akhir
        ]);
        $hasil = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $hasil], 200);
});
