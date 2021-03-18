<?php


namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class CustomerAddressModel extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('customer_address')->setPrimaryKey('address_id');
    }
}

?>