<?php
namespace Block\Admin\CustomerGroup;


\Mage::loadClassByFileName('block\core\Template');

class Edit extends \Block\Core\Template{


  public function __construct()
  {
      parent::__construct();
      $this->setTemplate('./admin/customerGroup/edit.php');

  }
     
  public function getTabContent()
  {
    $tabsObj = \Mage::getBlock("block\admin\customerGroup\Edit\Tabs");
    $tabs = $tabsObj->getTabs();
    $fetchTab = $this->getRequest()->getGet('tab');
    if (!array_key_exists($fetchTab, $tabs)) {
      $fetchTab = $tabsObj->getDefault();
    }
    $gotTab = \Mage::getBlock($tabs[$fetchTab]['className']);
    echo $gotTab->toHtml();
  }

}

?>