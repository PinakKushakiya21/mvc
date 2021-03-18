<?php

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Form extends \Block\Core\Template{
    
    protected $customers = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customer/edit/tabs/form.php");
    }

    public  function getGroupName()
    {
        $customers = \Mage::getModel("Model\customerGroupModel");
        $data = $customers->fetchAll();
        return $data;
    }

    public  function getSelectedGroup($id)
    {
        $customers = \Mage::getModel("Model\customerGroupModel");
        $data = $customers->load($id);
        return $data->name;
    }

    public function setCustomer($customers = null)
    {
        if (!$customers) 
        {
            $customers = \Mage::getModel("Model\customerModel");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                
                $customer = $customers->load($id);
                if (!$customer) {
                    return null;
                }
            }
        }
        $this->customers = $customers;
        return $this;
    }
    public function getCustomer()
    {
        if (!$this->customers) {
            $this->setCustomer();
        }
        return $this->customers;     
    }    
}