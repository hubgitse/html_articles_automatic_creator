<?php

namespace app\Model;

use app\Helper\Registry;

class Header extends AbstractModel
{
    private $headersArray = [];


    /**
     * HeaderModel constructor.
     * @param array $headersArray
     */
    function __construct(array $headersArray)
    {
        $this->headersArray = $headersArray;
    }

    /**
     * @return array
     */
    public function getHeadersArray()
    {
        return $this->headersArray;
    }

    public static function getHeader()
    {
        $path = Registry::getServiceOrParam('files');
        $headers = file($path['key_file']);


        return new Header($headers);
    }

    /**
     * @return array|null
     */
    public function getHeadersSpecificAmount()
    {
        $range = Registry::getServiceOrParam('headers');
        $min = $range['min'];
        $max = $range['max'];

        if (!max)
            return null;

        $rand = rand($min, $max);

        if (!$rand)
            return null;

        $headers = [];
        $count = count($this->headersArray);
        for ($i = 0; $i<$rand; $i++){
            $headers[] = trim($this->headersArray[rand (0, $count)]);
        }


        return $headers;
    }


}