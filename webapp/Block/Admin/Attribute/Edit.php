<?php

namespace Block\Admin\Attribute;

\Mage::loadClassByFileName('block\core\Template');

class Edit extends \Block\Core\Template
{
  protected $attributes = null;

  public function __construct()
  {
    parent::__construct();
    $this->setTemplate('./admin/product/edit.php');
  }

  public function getTabContent()
  {
    $tabsObj = \Mage::getBlock("Block\Admin\Attribute\Edit\Tabs");
    $tabs = $tabsObj->getTabs();
    $fetchTab = $this->getRequest()->getGet('tab');
    if (!array_key_exists($fetchTab, $tabs)) {
      $fetchTab = $tabsObj->getDefault();
    }
    $gotTab = \Mage::getBlock($tabs[$fetchTab]['className']);
    echo $gotTab->toHtml();
  }
}
