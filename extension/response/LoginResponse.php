<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/16
 * Time: 15:18
 */
class LoginResponse
{
    public $success;
    public $errorMessage;
    public $userId;
    public $username;
    public $nickname;

    /**
     * LoginResponse constructor.
     * @param $success
     * @param $errorMessage
     * @param $userId
     * @param $username
     * @param $nickname
     */
    public function __construct($success, $errorMessage, $userId = NULL, $username = NULL, $nickname = NULL)
    {
        $this->success = $success;
        $this->errorMessage = $errorMessage;
        $this->userId = $userId;
        $this->username = $username;
        $this->nickname = $nickname;
    }

}