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
    return $response->withJson(["status" => "success", "data" => $result, "token" => $token ], 200);
});

