<?php

class Core {

    private $currentObj;
    private $currentMethode;
    private $endPoint = array();

    public function __construct()
    {

    }

    private function get_url()
    {        
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        
    }

    public function init()
    {
        $url = $this->get_url();

        $error = "Cannot handle this request";
        
        $classFile = '../modules/controllers/'.ucwords($url[0]).'.php';

        try{

            if(!file_exists($classFile))
            {
                sendError(BAD_REQUEST, $error);  
            }

            require_once $classFile;
            $this->currentObj = new $url[0];

            unset($url[0]);

            if(!empty($url[1])){

                if(!method_exists($this->currentObj, $url[1]))
                {
                    sendError(BAD_REQUEST, $error);

                }
                elseif(!empty($url[2]))
                {
                    $this->currentMethode = $url[1];

                    unset($url[1]);

                    $this->endPoint = $url ? array_values($url) : [];
                    
                    call_user_func_array([$this->currentObj, $this->currentMethode], $this->endPoint); 
                }
                else
                {

                    $this->currentMethode = $this->currentObj->$url[1]();

                    unset($url[1]);
                }                   
                   
            }           

           
        }catch(Exception $e){

            print_r($e->getMessage());

        }
       

    }
}

?>