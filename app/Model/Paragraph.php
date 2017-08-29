<?php

namespace app\Model;

use app\Helper\Registry;

class Paragraph extends AbstractModel
{
    private $paragraphMinQuantity;
    private $paragraphMaxQuantity;

    private $paragraphsSpecificAmount;

    function __construct($paragraphMinQuantity, $paragraphMaxQuantity)
    {
        if (!$paragraphMinQuantity || !$paragraphMaxQuantity)
            throw new \RuntimeException('Paragraph quantity should be > 0, change config');

        $this->paragraphMinQuantity = $paragraphMinQuantity;
        $this->paragraphMaxQuantity = $paragraphMaxQuantity;
    }

    /**
     * @return int
     */
    public function getParagraphMinQuantity()
    {
        return $this->paragraphMinQuantity;
    }

    /**
     * @return int
     */
    public function getParagraphMaxQuantity()
    {
        return $this->paragraphMaxQuantity;
    }


    /**
     * @return Paragraph
     */
    public static function getParagraph()
    {
        $range = Registry::getServiceOrParam('paragraphs');
        $min = $range['min'];
        $max = $range['max'];

        return new Paragraph($min, $max);
    }

    /**
     * set paragraphsSpecificAmount and return true
     * @return bool
     */
    public function setParagraphSpecificAmount()
    {
        if ($this->paragraphsSpecificAmount)
            throw new \RuntimeException('paragraphsSpecificAmount already specified');

        $this->paragraphsSpecificAmount = rand ($this->paragraphMinQuantity, $this->paragraphMaxQuantity);
        return true;
    }

    /**
     * @return mixed
     */
    public function getParagraphSpecificAmount()
    {
        if (!$this->paragraphsSpecificAmount)
            throw new \RuntimeException('First you should call setParagraphsSpecificAmount method');

        $quantity = $this->paragraphsSpecificAmount;
        $this->paragraphsSpecificAmount = null;
        return $quantity;
    }
}