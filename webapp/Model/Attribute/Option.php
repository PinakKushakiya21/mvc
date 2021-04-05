<?php

namespace Model\Attribute;

use Exception;

\Mage::loadClassByFileName("Model\Core\Table");

class Option extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute_option')->setPrimaryKey('optionId');
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function getOptions()
    {
        try {
            if (!$this->getAttribute()->attributeId) {
                throw new Exception("Attribute Not Found");
            }

            $query = "SELECT *
            FROM `attribute_option`
            WHERE `attributeId`='{$this->getAttribute()->attributeId}'
            ORDER BY `sortOrder` ASC";

            return $this->fetchAll($query);

            //return $this->getAttribute()->getOptions();
        } catch (Exception $e) {
        }
    }

    // public function getOptions()
    // {
    //     if(!$this->attribute->attributeId)
    //     {
    //         throw new Exception('Invalid ID');
    //     }
    //     //$query = "select `brandId` as optionId, `name` as name, '$this->getAttribute()->attributeId' as attributeId, sortOrder from brand";
    //     $query = "select * from `attribute_option`
    //     where `attributeId`='{$this->getAttribute()->attributeId}'";
    //     return $this->fetchAll();
    //     return $this->getAttribute()->getOptions();
    // }
}
