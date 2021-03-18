<?php

namespace Block\Admin\CustomerGroup\Edit;

\Mage::loadClassByFileName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customerGroup/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('customerGroup', ["label" => "Group Information", "className" => 'Block\Admin\CustomerGroup\Edit\Tabs\Form']);
        $this->setDefault('customerGroup');
    }
}
