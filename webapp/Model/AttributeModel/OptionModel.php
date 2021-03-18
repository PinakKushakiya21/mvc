<?php

namespace Model\AttributeModel;

\Mage::loadClassByFileName("Model\Core\Table");

class OptionModel extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute_option')->setPrimaryKey('optionId');
    }
}
