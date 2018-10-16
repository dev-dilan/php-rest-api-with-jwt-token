<?php

function sendData($statusCode, $data){

    http_response_code($statusCode);
    return json_encode(array([
                                "status" => http_response_code(),
                                "data" => $data
                            ]), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

}

?>