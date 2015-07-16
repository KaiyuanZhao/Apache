<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午2:55
 */

class testFormat {

    private  $flag=true;

    public  function testReg( $email, $password,$username, $nickname, $department, $location, $description)
    {
       $this->flag=true;
       $this->testEmail($email);
       $this->testPassword($password);
       $this->testUsername($username);
       $this->testNickname($nickname);
       $this->testDepartment($department);
       $this->testLocation($location);
       return $this->flag;
    }

    public function testLogin($email,$password){
        $this->testEmail($email);
        $this->testPassword($password);
        return $this->flag;
    }

    public function testEmail($email){
        $tmp = explode("@",$email);

        isset($tmp[0])?$value["user"] = $tmp[0]:$value["user"] ='';
        isset($tmp[1])?$value["domain"] = $tmp[1]:$value["domain"] ='';
        //超出长度
        if(!((strlen($value["user"])>0||strlen($value["user"])<=64)
            &&
            (strlen($value["domain"])>0||strlen($value["domain"])<=255)))
            $this->flag=false;
        if(!(preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$/i", $email))){
            $this->flag=false;
        }
    }

    public function testPassword($password){
        if ((strlen($password)>20) or (strlen($password)<6))
            $this->flag=false;
    }

    public function testUsername($username){
        //if(!(preg_match_all("/^([\x81-\xfe][\x40-\xfe])+$/",$username)))
        //    $this->flag=false;
        if ((strlen($username)<2) or (strlen($username)>20))
            $this->flag=false;
    }

    public function testNickname($nickname){
        if (empty($nickname))
     ;//       $this->flag=false;
    }

    public function testDepartment($depart){
        if(!(preg_match_all("/^([\x81-\xfe][\x40-\xfe])+$/",$depart)))
            ;//$this->flag=false;
        if ((strlen($depart)<4) or (strlen($depart)>20))
           ;// $this->flag=false;
    }

    public function testLocation($location){
        if (!(is_numeric($location)))
           ;// $this->flag=false;
        if (strlen($location)!=4)
          ;//  $this->flag=false;
    }

    public function testMeal($email){
        if ((strlen($email)<1) or (strlen($email)>12))
            return false;
        else return true;
    }
}
?>