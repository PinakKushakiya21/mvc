<?php

namespace Block\Admin\Cms\Edit;

\Mage::loadClassByFileName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/cms/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('cms', ["label" => "CMS Information", "className" => 'Block\Admin\Cms\Edit\Tabs\Form']);


        $this->setDefault('cms');
    }
}
