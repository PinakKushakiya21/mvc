<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Product extends \Block\Core\Template
{

    public function __construct()
    {
        $this->setTemplate('./home/product.php');
    }

    public function getProducts()
    {
        return Mage::getModel('Model\Product')->fetchAll();
    }

    public function getMedia($id)
    {
        $query = "select * from productmedia where small=1 and productId={$id}";
        if ($media = Mage::getModel('Model\Product')->fetchRow($query)) {
            return $media->getData();
        }
        return false;
    }
}
