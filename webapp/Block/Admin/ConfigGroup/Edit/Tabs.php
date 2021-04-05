<?php

namespace Block\Admin\ConfigGroup\Edit;

\Mage::loadClassByFileName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configGroup/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('information', ["label" => "Information", "className" => 'Block\Admin\ConfigGroup\Edit\Tabs\Information']);
        $this->addTab('configuration', ["label" => "Configuration", "className" => 'Block\Admin\ConfigGroup\Edit\Tabs\Configuration']);
        $this->setDefault('information');
    }
}
?>