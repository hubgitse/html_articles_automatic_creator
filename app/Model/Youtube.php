<?php


namespace app\Model;

use app\Helper\Registry;

class Youtube extends AbstractModel
{
    private $youtubeArray = [];


    /**
     * HeaderModel constructor.
     * @param array $listsArray
     */
    function __construct(array $youtubeArray)
    {
        $this->youtubeArray = $youtubeArray;
    }

    /**
     * @return array
     */
    public function getYoutubeArray()
    {
        return $this->youtubeArray;
    }

    /**
     * @return Youtube
     */
    public static function getYoutube()
    {
        $path = Registry::getServiceOrParam('files');
        $youtube = file($path['youtube_file']);

        return new Youtube($youtube);
    }

    /**
     * @return array|null
     */
    public function getYoutubeSpecificAmount()
    {
        $range = Registry::getServiceOrParam('youtube_urls');
        $min = $range['min'];
        $max = $range['max'];

        if (!$max)
            return null;

        $rand = rand($min, $max);
        if (!$rand)
            return null;

        $count = count($this->youtubeArray);
        $youtube = [];
        for ($i = 0; $i<$rand; $i++){
            $youtube[] = trim($this->youtubeArray[rand (0, $count)]);
        }


        return $youtube;
    }
}