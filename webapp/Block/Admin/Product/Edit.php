<?php

namespace Block\Admin\Product;

\Mage::loadClassByFileName('block\core\Template');

class Edit extends \Block\Core\Template{
  protected $products = null;
  public function __construct()
  {
      parent::__construct();
      $this->setTemplate('./admin/product/edit.php');
  }
   
  public function getTabContent()
  {
        $tabsObj = \Mage::getBlock("block\Admin\product\Edit\Tabs");
        $tabs = $tabsObj->getTabs();
        $fetchTab = $this->getRequest()->getGet('tab'); //product1 
         if(!array_key_exists($fetchTab,$tabs))   // product1  
         {
            $fetchTab = $tabsObj->getDefault();   // product1 = product 
         }
         $gotTab = \Mage::getBlock($tabs[$fetchTab]['className']); //tabs[product][block_];
         echo $gotTab->toHtml();

  }

}

?>