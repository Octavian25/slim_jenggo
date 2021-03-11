<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;



$container = $app->getContainer();
$app->post("/api/login", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    $sql = "SELECT * FROM users WHERE user_id=:user_id AND password=:password";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([":user_id" => $param["user_id"],":password" => $param["password"]]);
    $token = bin2hex(random_bytes(20));
    $update = "UPDATE users SET token=:token WHERE user_id=:user_id";
    $stmt2 = $this->db->prepare($update);
    $result = $stmt2->execute([":token" => $token, ":user_id" => $param["user_id"]]);
    return $response->withJson(["status" => "success", "data" => $result, "token" => $token ], 200);
});

$app->post("/api/register", function (Request $request, Response $response){
    $param = $request->getParsedBody();
    // $sql = "INSERT INTO users(id, user_id, user_name, level, created_at, last_login, id_cabang, token, hit, password) VALUES (:id,:user_id, :user_name, :level, :created_at, :last_login, :id_cabang, :token, :hit)";
    $sql = "INSERT INTO users ( user_id, user_name, level, created_at, last_login, id_cabang, token, hit, password)
     VALUES (:user_id, :user_name, :level, :created_at, :last_login, :id_cabang, :token, :hit, :password);";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        
        ":user_id" => $param["user_id"],
        ":user_name" => $param["user_name"],
        ":level" => $param["level"],
        ":created_at" => date("Y-m-d"),
        ":last_login" =>date("Y-m-d"),
        ":id_cabang" => "CB002",
        ":token" => "-",
        ":hit" => 2,
        ":password" => $param["password"]
    ];
 
    $result = $stmt->execute($data);
    return $response->withJson(["status" => "success", "data" => $result ], 200);
});
