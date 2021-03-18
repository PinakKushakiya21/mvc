<?php

namespace Block\Admin\Customer;


\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $customers = null;
    protected $groups = null;

    public function __construct()
    {
        $this->setTemplate('./admin/customer/grid.php');  
    }

    public function getGroupName($id)
    {
        $customers = \Mage::getModel("model\customerGroupModel");
        $data = $customers->load($id);
        
        return $data->name;
    }


    public function setCustomers($customers = null)
    {
        if (!$customers) {
            $customers = \Mage::getModel("model\customerModel");
            $customers = $customers->fetchAll();
        }
        $this->customers = $customers;
        return $this;
    }
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
            
        }
        return $this->customers;     
    }
    public function getTitle()
    {
        return "Manage Customers";
    }

}

?>