<?php


namespace app\Helper;


class Registry
{
    private static $servicesOrParams = [];
    private static $forReadOnly = false;

    public static function setServiceOrParam($name, $objectOrParam)
    {
        if (self::$forReadOnly === true){
            throw new \RuntimeException('Can\'t add new param or service');
        }
        self::$servicesOrParams[$name] = $objectOrParam;
    }

    public static function getServiceOrParam($name)
    {
        if (!array_key_exists($name, self::$servicesOrParams)){
            throw new \RuntimeException('Patam or service doesn\'t exist');
        }
        return self::$servicesOrParams[$name];
    }

    public static function forReadOnly()
    {
        self::$forReadOnly = true;
    }
}