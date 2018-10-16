<?php

class User{

    private $db;

    public function __construct()
    {
        $this->db = new DbConn();
        $this->db->connect();
    }

    public function getUsers()
    {
        $this->db->query("SELECT * FROM user_tb LIMIT 10");
        return sendData(OK, $this->db->resultSet());
    }

    public function singleUser($userId)
    {
        $this->db->query("SELECT * FROM user_tb WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $result = sendData(OK, $this->db->singleResult());
        if($this->db->rowCount() <= 0)
        {
            sendError(NOT_FOUND, "User not found");

        }

        return $result;
    }

    public function login($username)
    {
        $this->db->query("SELECT * FROM user_tb WHERE username = :username");
        $this->db->bind(':username', $username);
        $result = sendData(OK, $this->db->singleResult());

        if($this->db->rowCount() <= 0)
        {
            sendError(NOT_FOUND, "User not found");

        }

        return $result;
    }
}

?>