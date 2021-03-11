<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Ramsey\Uuid\Uuid;


$container = $app->getContainer();
$app->post("/api/orderBahan", function (Request $request, Response $response){
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
