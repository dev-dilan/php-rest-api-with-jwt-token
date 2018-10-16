<?php

class Users extends Appcontrol{

    private $modal = 'User';
    private $modal_obj;

    public function __construct()
    {
        $this->modal_obj = Appcontrol::modal($this->modal);

    }

    public function getusers()
    {
        Appcontrol::get();
        $payload = decodeToken();

        if($payload->userData->user_id == 16){
            echo $this->modal_obj->getUsers();
        }else{
            sendError(FORBIDDEN, "Not Authrized");
        }
        // echo $this->modal_obj->getUsers();
    }

    public function getuser($param)
    {
        Appcontrol::get();
        echo $this->modal_obj->singleUser($param);
    }

    public function postuser()
    {
        $post = Appcontrol::post();
        echo sendData($post);
    }

    public function login()
    {
        $post = Appcontrol::post();
        $reqUsername = $post['username'];
        $reqPassword = $post['password'];

        $result = $this->modal_obj->login($reqUsername);

        $data = json_decode($result);
        $data = $data[0];

        $emailadddress = $data->data->emailadddress;
        $user_id = $data->data->user_id;
        $userPassword = $data->data->password;

        if($reqPassword !== $userPassword){
            return sendError(UNAUTHORIZED, "Username or Password is incorrect");
        }

        $userData = [
                        "user_id" => $user_id,
                        "email" => $emailadddress
                    ];

        generateToken($userData);

        echo $result;
        return;
    }

}
?>