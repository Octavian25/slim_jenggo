<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/bahan-baku/orderBahan", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "INSERT INTO tt_order_bahan_baku(id_order, tanggal, id_cabang, no_faktur, status) VALUES (:id,:tanggal,:id_cabang,:no_faktur,:status)";
    $stmt = $this->db->prepare($sql);
    $uuid = Uuid::uuid4();
    $data = [
            ":tanggal" => $param["tanggal"],
            ":id_cabang" => $param["id_cabang"],
            ":no_faktur" => $uuid,
            ":status" => $param["status"],
            ":id" => $uuid
    ];
    $detail_barang = $param["detail_barang"];
    foreach ($detail_barang as $key) {
        $id = $key["id_barang"];
        $qty = $key["qty"];
        $sql = "SELECT harga FROM tm_barang WHERE id_barang=:id_barang";
        $stmt2 = $this->db->prepare($sql);
        $result =$stmt2->execute([":id_barang" => $id]);
        $harga = $stmt2->fetch();
        $total = intval($harga["harga"]) * intval($qty);
        $sql2 = "INSERT INTO tt_order_bahan_baku_detail(no_faktur, id_barang, qty, total_harga) VALUES (:no_faktur,:id_barang,:qty,:total)";
        $stmt3 = $this->db->prepare($sql2);
        $result2 = $stmt3->execute([
            ":no_faktur" => $uuid,
            ":id_barang" => $id,
            ":qty" => $qty,
            ":total" => $total
        ]);
    }
    $result3 = $stmt->execute($data);
    return $response->withJson(["status" => "success", "data" => $result3], 200);
});


$app->get("/api/bahan-baku/all", function (Request $request, Response $response){
    $sql = "SELECT * FROM `tt_order_bahan_baku`";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $sql2 = "SELECT * FROM tt_order_bahan_baku_detail WHERE no_faktur=:no_faktur";
    $stmt2 = $this->db->prepare($sql2);
    $stmt2->execute([
        ":no_faktur" => $result[0]["no_faktur"]
    ]);
    $result2 = $stmt2->fetch(all);
    return $response->withJson($result == [] ? "Data Kosong" : ["tanggal" => $result[0]["tanggal"], "id_cabang" => $result["id_cabang"], "no_faktur" => $result["no_faktur"], "status" => $result["result"], "detail_barang" => $result2], 200);
});