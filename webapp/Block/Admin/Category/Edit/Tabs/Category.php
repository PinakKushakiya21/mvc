<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");
class Category extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate("./admin/category/edit/tabs/category.php");
    }

}