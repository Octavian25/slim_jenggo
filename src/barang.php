<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$container = $app->getContainer();
$cekAPIKey = function(Request $request, Response $response, $next){
    // $key = $request->getQueryParam("key");
    $key = $request->getHeader("x-auth-token")[0];
    if(!isset($key)){
        return $response->withJson(["status" => "API Key required"], 401);
    }
    
    $sql = "SELECT * FROM users WHERE api_key=:api_key";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":api_key" => $key]);
    
    if($stmt->rowCount() > 0){
        $result = $stmt->fetch();
        if($key == $result["api_key"]){
        
            // update hit
            $sql = "UPDATE users SET hit=hit+1 WHERE api_key=:api_key";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":api_key" => $key]);
            
            return $response = $next($request, $response);
        }
    }

    return $response->withJson(["status" => "Unauthorized"], 401);
};

$app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
    // Sample log message
    $container->get('logger')->info("Slim-Skeleton '/' route");

    // Render index view
    return $container->get('renderer')->render($response, 'index.phtml', $args);
});
$app->get("/api/barang/all", function (Request $request, Response $response){
    $sql = "SELECT * FROM tm_barang";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});
$app->get("/api/barang/id/{id}", function (Request $request, Response $response, array $args){
    $id = $args["id"];
    $sql = "SELECT * FROM tm_barang WHERE id_barang= :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});
$app->post("/api/addBarang",function (Request $request, Response $response){
    if($request->isPost()){
        $sql = "INSERT INTO tm_barang (id_barang, nama_barang, qty, harga) VALUES (:id_barang,:nama_barang,:qty,:harga)";
    $stmt = $this->db->prepare($sql);
    $param = $request->getParsedBody();
    $data = [
        ":id_barang" => autonumber(getLastID("tm_barang","id_barang", $this->db), 2,3),
        ":nama_barang" => $param["nama_barang"],
        ":qty" => $param["qty"],
        ":harga" => $param["harga"]
    ];

    if($stmt->execute($data)){
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    } else {
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
    } else {
        return "GET";
    }
})->add($cekAPIKey);


function autonumber($id_terakhir, $panjang_kode, $panjang_angka) {
 
    // mengambil nilai kode ex: KNS0015 hasil KNS
    $kode = substr($id_terakhir, 0, $panjang_kode);
 
    // mengambil nilai angka
    // ex: KNS0015 hasilnya 0015
    $angka = intval(substr($id_terakhir, $panjang_kode, $panjang_angka));
 
    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
 
    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode.$angka_baru;
 
    return $id_baru;
}
function getLastID($tabel, $ref, $db){
    $sql = "SELECT * FROM ".$tabel." ORDER BY ".$tabel.".".$ref." DESC LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result[$ref];
}
