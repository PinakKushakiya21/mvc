<?php

namespace Model;
\Mage::loadClassByFileName("Model\Core\Table");
class AdminModel extends \Model\Core\Table{
    
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('admin')->setPrimaryKey('adminId');
    }
   
}

?>