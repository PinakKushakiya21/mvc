<?php

namespace Block\Admin\CustomerGroup\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Form extends \Block\Core\Template
{
    protected $groups = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customerGroup/edit/tabs/form.php");
    }

    public function setCustomerGroup($groups = null)
    {
        if (!$groups) 
        {
            $groups = \Mage::getModel("Model\CustomerGroup");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $groups = $groups->load($id);
                if (!$groups) {
                    return null;
                }
            }  
        }
        $this->groups = $groups;
        return $this;
    }
    public function getCustomerGroup()
    {
        if (!$this->groups) {
            $this->setCustomerGroup();
        }
        return $this->groups;     
    }
}
