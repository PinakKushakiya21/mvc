<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class Attribute extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute')->setPrimaryKey('attributeId');
    }

    public function getBackendTypeOption()
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

    public function setAttribute($attributes)
    {
        $this->attribute = $attributes;
        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function getOptions(){
        
    }
}
