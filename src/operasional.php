<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/operasional/add", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "INSERT INTO tm_operasional(keterangan, harga, id_cabang, input_by, tanggal) VALUES (:keterangan,:harga,:id_cabang,:input_by,:tanggal)";
    $stmt = $this->db->prepare($sql);
    $data = [
            ":keterangan" => $param["keterangan"],
            ":harga" => $param["harga"],
            ":id_cabang" => $param["id_cabang"],
            ":input_by" => $param["input_by"],
            ":tanggal" => $param["tanggal"]
    ];
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "Operasional Berhasil Ditambahkan"], 200);
});

$app->get("/api/operasional/all", function (Request $request, Response $response){
    $sql = "SELECT * FROM tm_operasional";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson($result == [] ? "Data Kosong" : $result, 200);
});

$app->get("/api/operasional/bytanggal/{tgl_awal}&{tgl_akhir}", function (Request $request, Response $response, array $args){
    $tgl_awal = $args["tgl_awal"];
    $tgl_akhir = $args["tgl_akhir"];
    $sql = "SELECT * FROM tm_operasional WHERE tanggal BETWEEN :tgl_awal AND :tgl_akhir";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":tgl_awal" => $tgl_awal, ":tgl_akhir" => $tgl_akhir]);
    $result = $stmt->fetchAll();
    return $response->withJson($result == [] ? "Data Kosong" : $result, 200);
});
