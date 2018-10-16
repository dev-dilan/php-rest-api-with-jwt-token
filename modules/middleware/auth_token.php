<?php

function generateToken($userData){

    $payload = [
        "iat" => time(),
        "iss" => 'localhost',
        "exp" => time() + (24 * (60 * 60)),
        "userData" => $userData
    ];

    $token = JWT::encode($payload, PRIVATE_KEY);
    header("X-Auth-Token: $token");
}

function decodeToken(){

    $token = null;

    foreach (getallheaders() as $name => $value) {

        if($name === 'X-Auth-Token'){
            $token = $value;
        }            
    }
    
    if($token === null){
        sendError(UNAUTHORIZED, "No token provided");
    }

    return JWT::decode($token, PRIVATE_KEY, ['HS256']);

}


?>