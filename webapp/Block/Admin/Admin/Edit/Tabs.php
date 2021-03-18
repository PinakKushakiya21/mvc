<?php

namespace Block\Admin\Admin\Edit;

\Mage::loadClassByFileName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/admin/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('admin', ["label" => "Admin Information", "className" => 'Block\Admin\Admin\Edit\Tabs\Form']);
        $this->setDefault('admin');
    }
}
?>