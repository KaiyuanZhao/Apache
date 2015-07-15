<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午9:50
 */

class Response
{
    public $success;
    public $errormessage;

    function __construct($success, $errormessage = "")
    {
        $this->success = $success;
        $this->errormessage = $errormessage;
    }

    function __toString()
    {
        return "{ success = {$this->success}}";
    }
}

