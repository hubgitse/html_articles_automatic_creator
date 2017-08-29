<?php

namespace app\Model;


use app\Helper\Registry;

class Image extends AbstractModel
{
    private $imagesArray = [];


    /**
     * HeaderModel constructor.
     * @param array $headersArray
     */
    function __construct(array $imagesArray)
    {
        $this->imagesArray = $imagesArray;
    }

    /**
     * @return array
     */
    public function getImagesArray()
    {
        return $this->imagesArray;
    }

    /**
     * @return Image
     */
    public static function getImage()
    {
        $path = Registry::getServiceOrParam('files');

        $allImages = file($path['img_file']);


        return new Image($allImages);
    }

    /**
     * @return array|null
     */
    public function getImagesSpecificAmount()
    {
        $range = Registry::getServiceOrParam('images');
        $min = $range['min'];
        $max = $range['max'];

        $rand = rand($min, $max);
        if (!$rand)
            return null;

        $images = [];
        $count = count($this->imagesArray);
        for ($i = 0; $i<$rand; $i++){
            $images[] = trim($this->imagesArray[rand (0, $count)]);
        }

        return $images;
    }

}