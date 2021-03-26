<?php

namespace Model\Attribute;

use Exception;

\Mage::loadClassByFileName("Model\Core\Table");

class OptionModel extends \Model\Core\Table
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
        if(!$this->attribute->attributeId)
        {
            throw new Exception('Invalid ID');
        }
        //$query = "select `brandId` as optionId, `name` as name, '$this->getAttribute()->attributeId' as attributeId, sortOrder from brand";
        $query = "select * from `attribute_option`
        where `attributeId`='{$this->getAttribute()->attributeId}'";
        return $this->fetchAll();
        return $this->getAttribute()->getOptions();
    }
}
