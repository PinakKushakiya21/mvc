<?php

namespace Block\Admin\Admin;

\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $admins = null;
    public function __construct()
    {
        $this->setTemplate('./admin/admin/grid.php');
    }

    public function setAdmin($admins = null)
    {
        if (!$admins) {
            $admins = \Mage::getModel("model\adminModel");
            $admins = $admins->fetchAll();
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
    public function getTitle()
    {
        return "Manage Admins";
    }

}

?>