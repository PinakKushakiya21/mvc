<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class CustomerGroupModel extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('customer_group')->setPrimaryKey('group_id');
    }
}

?>