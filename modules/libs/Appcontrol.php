<?php

class Appcontrol{

    private $error = "Cannot handle this request";

    public function modal($modal)
    {
        require_once '../modules/modals/'.ucwords($modal).'.php';
        return new $modal;
    }

    public function get($mime_type = 'application/json')
    {
        if($_SERVER["REQUEST_METHOD"] === 'POST' || $_SERVER["REQUEST_METHOD"] === 'PUT' || $_SERVER["REQUEST_METHOD"] === 'DELETE'){
            return sendError(BAD_REQUEST, $this->error);
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: '. $mime_type);

    }

    public function post($mime_type = 'application/json'){

        if($_SERVER["REQUEST_METHOD"] === 'GET' || $_SERVER["REQUEST_METHOD"] === 'PUT' || $_SERVER["REQUEST_METHOD"] === 'DELETE'){
            return sendError(BAD_REQUEST, $this->error);
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: '. $mime_type);
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $rawData = trim(file_get_contents("php://input"));
        $rawData = json_decode($rawData, true);
        return $rawData;
    }
    
    public function put($mime_type = 'application/json'){

        if($_SERVER["REQUEST_METHOD"] === 'POST' || $_SERVER["REQUEST_METHOD"] === 'GET' || $_SERVER["REQUEST_METHOD"] === 'DELETE'){
            return sendError(BAD_REQUEST, $this->error);
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: '. $mime_type);
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $rawData = trim(file_get_contents("php://input"));
        $rawData = json_decode($rawData, true);
        return $rawData;
    }

    public function delete($mime_type = 'application/json'){

        if($_SERVER["REQUEST_METHOD"] === 'POST' || $_SERVER["REQUEST_METHOD"] === 'GET' || $_SERVER["REQUEST_METHOD"] === 'PUT'){
            return sendError(BAD_REQUEST, $this->error);
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: '. $mime_type);
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $rawData = trim(file_get_contents("php://input"));
        $rawData = json_decode($rawData, true);
        return $rawData;
    }
}


?>