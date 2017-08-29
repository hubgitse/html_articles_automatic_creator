<?php

namespace app\Model;

use app\Helper\Registry;

class Line extends AbstractModel
{
    private $linesArray = [];


    /**
     * HeaderModel constructor.
     * @param array $headersArray
     */
    function __construct(array $linesArray)
    {
        $this->linesArray = $linesArray;
    }

    /**
     * @return array
     */
    public function getLinesArray()
    {
        return $this->linesArray;
    }

    /**
     * @return Line
     */
    public static function getLine()
    {
        $path = Registry::getServiceOrParam('files');

        $allLines = file($path['content_file']);

        return new Line($allLines);
    }

    /**
     * @return array
     */
    public function getLinesSpecificAmount()
    {
        $range = Registry::getServiceOrParam('paragraph_lines');
        $min = $range['min'];
        $max = $range['max'];

        if (!$min || !$max)
            throw new \RuntimeException('Lines quantity should be > 0');

        $rand = rand($min, $max);

        $count = count($this->linesArray);
        $lines = [];

        for ($i = 0; $i<$rand; $i++){
            $lines[] = trim($this->linesArray[rand (0, $count)]);
        }

        return $lines;
    }


}