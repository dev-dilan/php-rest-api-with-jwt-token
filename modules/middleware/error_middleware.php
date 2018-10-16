<?php

function sendError($statusCode, $message) {

    http_response_code($statusCode);
    throw new Exception(json_encode([
                            "status" => http_response_code(),
                            "message" => $message
                        ]));
}



?>