<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class ConfigGroup extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('config_group')->setPrimaryKey('groupId');
    }

    /*public function getBackendTypeOption()
    {
        return [
            'varchar(255)' => 'Varchar',
            'int' => 'Int',
            'decimal' => 'Decimal',
            'text' => 'Text',
            'boolean' => 'Boolean'
        ];
    }

    public function getInputTypeOption()
    {
        return [
            'textbox' => 'Textbox',
            'textarea' => 'Textarea',
            'select' => 'Select',
            'multiple' => 'Select Multiple',
            'checkbox' => 'Checkbox',
            'radio' => 'radio'
        ];
    }

    public function getEntityType()
    {
        return [
            'product' => 'Product',
            'category' => 'Category'
        ];
    }
    */
    public function setConfigGroup($configGroups)
    {
        $this->configGroup = $configGroups;
        return $this;
    }

    public function getConfigGroup()
    {
        return $this->configGroup;
    }

}
