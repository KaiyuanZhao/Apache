<?php

date_default_timezone_set('PRC');

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/14
 * Time: 14:07
 */
class TimeUtils
{

    /**
     * @return String
     */
    public static function getCurrentDate()
    {
        $dt = new DateTime();
        return self::formatDate($dt);
    }

    /**
     * @param $date DateTime
     * @return String
     */
    public static function formatDate($date)
    {
        $result = $date->format('Y-m-d');
        return $result;
    }

    /**
     * @return String
     */
    public static function getCurrentTime()
    {
        $dt = new DateTime();
        return self::formatTime($dt);
    }

    /**
     * @param $date DateTime
     * @return String
     */
    public static function formatTime($date)
    {
        $result = $date->format('Y-m-d H:i:s');
        return $result;
    }

    /**
     * whether the time is between 15:00 to 17:00
     * @return bool
     */
    public static function isTimeAvailable()
    {
        $dt = new DateTime('now');
        $beginTime = new DateTime();
        $beginTime->setTime(15, 0);
        $endTime = new DateTime();
        $endTime->setTime(17, 0);
        $beginInterval = $dt->diff($beginTime);
        $endInterval = $dt->diff($endTime);
        if ($beginInterval->invert == 1 && $endInterval->invert == 0)
            return true;
        return false;
    }

}