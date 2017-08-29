<?php

namespace app\Model;

use app\Helper\Registry;

class ListItem extends AbstractModel
{
    private $listsArray = [];


    /**
     * HeaderModel constructor.
     * @param array $listsArray
     */
    function __construct(array $listsArray)
    {
        $this->listsArray = $listsArray;
    }

    /**
     * @return array
     */
    public function getListsArray()
    {
        return $this->listsArray;
    }

    public static function getList()
    {
        $path = Registry::getServiceOrParam('files');
        $allLists = file($path['key_file']);

        return new ListItem($allLists);
    }

    /**
     * @return array|null
     */
    public function getListsSpecificAmount()
    {
        $range = Registry::getServiceOrParam('lists');
        $min = $range['min'];
        $max = $range['max'];

        if (!$max)
            return null;

        $rand = rand($min, $max);

        if (!$rand)
            return null;

        $count = count($this->listsArray);
        $lists = [];

        for ($i = 0; $i<$rand; $i++){
            $lists[] = $this->genereteLists();
        }


        return $lists;
    }

    /**
     * @return array
     */
    private function genereteLists()
    {
        $range = Registry::getServiceOrParam('list_items');
        $min = $range['min'];
        $max = $range['max'];

        if (!$min || !max)
            throw new \RuntimeException('items_list_range min, max should be > 0, change config');

        $rand = rand($min, $max);
        $count = count($this->listsArray);
        $arr=[];

        for ($i = 0; $i<$rand; $i++){
            $arr[] = trim($this->listsArray[rand (0, $count)]);
        }

        return $arr;
    }

}