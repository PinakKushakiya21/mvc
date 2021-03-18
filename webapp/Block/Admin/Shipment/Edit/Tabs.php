<?php

namespace Block\Admin\Shipment\Edit;

\Mage::loadClassByFileName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/shipment/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('shipment', ["label" => "Shipment Information", "className" => 'Block\Admin\Shipment\Edit\Tabs\Form']);
        $this->setDefault('shipment');
    }
}
