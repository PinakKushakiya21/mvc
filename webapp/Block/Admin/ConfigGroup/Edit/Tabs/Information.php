<?php

namespace Block\Admin\ConfigGroup\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Information extends \Block\Core\Template
{
    protected $configGroups = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configGroup/edit/tabs/information.php");
    }

    public function setConfigGroup($configGroups = null)
    {
        if (!$configGroups) 
        {
            $configGroups = \Mage::getModel("Model\ConfigGroup");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $configGroup = $configGroups->load($id);
                if (!$configGroup) {
                    return null;
                }
            }  
        }
        $this->configGroups = $configGroups;    
        return $this;
    }

    public function getConfigGroup()
    {
        if (!$this->configGroups) {
            $this->setConfigGroup();
        }
        return $this->configGroups;     
    }  
}
?>