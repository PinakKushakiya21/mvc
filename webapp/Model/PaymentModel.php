<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class PaymentModel extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('payment')->setPrimaryKey('methodId');
    }
}

?>