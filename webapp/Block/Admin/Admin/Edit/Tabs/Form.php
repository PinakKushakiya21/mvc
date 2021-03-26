<?php

namespace Block\Admin\Admin\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Form extends \Block\Core\Template
{
    protected $admins = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/admin/edit/tabs/form.php");
    }

    public function setAdmin($admins = null)
    {
        if (!$admins) 
        {
            $admins = \Mage::getModel("Model\Admin");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $admin = $admins->load($id);
                if (!$admin) {
                    return null;
                }
            }  
        }
        $this->admins = $admins;    
        return $this;
    }

    public function getAdmin()
    {
        if (!$this->admins) {
            $this->setAdmin();
        }
        return $this->admins;     
    }  
}
?>