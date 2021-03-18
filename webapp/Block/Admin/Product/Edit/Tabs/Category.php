<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Category extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate("./admin/product/edit/tabs/category.php");
    }

}