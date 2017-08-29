<?php

namespace app\Model;

use app\Helper\Registry;

class Article
{

    private $content;

    /**
     * Article constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * save article into derictory
     */
    public function saveArticle()
    {
        $name = $this->getNameAndDelete();
        $pathToSave = Registry::getServiceOrParam('path_to_save');

        $f = fopen($pathToSave.DIRECTORY_SEPARATOR.$name.'.txt', 'w+');
        fwrite($f, $this->content);
        fclose($f);
    }

    /**
     * get name of article and after delete from file
     * @return string
     */
    private function getNameAndDelete()
    {
        $path = Registry::getServiceOrParam('files');
        $allNnames = file($path['name_file']);

        $rand = rand(0, count($allNnames)-1);
        $name = $allNnames[$rand];

        unset ($allNnames[$rand]);

        $f = fopen($path['name_file'], 'w');
        fwrite($f, implode('', $allNnames));
        fclose($f);

        return ucfirst(trim($name));
    }


}