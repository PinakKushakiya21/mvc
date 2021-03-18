<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class ProductModel extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('product')->setPrimaryKey('productId');
    }
}

?>