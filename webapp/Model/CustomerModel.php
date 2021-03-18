<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class CustomerModel extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('customer')->setPrimaryKey('customerId');
    }
}

?>