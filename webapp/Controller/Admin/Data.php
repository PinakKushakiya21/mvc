<?php

namespace Controller\Admin;

class Data extends \Controller\Core\Admin
{
    public function testAction()
    {
        $query = "SELECT * FROM product
        WHERE `productId`=18
        ORDER BY productId ASC";
        $product = \Mage::getModel('Model\Product')->fetchRow($query);
        //$product->SKU = '123';
        $product->productName = 'hello 123';
        echo "<pre>";
        print_r($product);
    }
}



?>