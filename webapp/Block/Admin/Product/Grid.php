<?php

namespace Block\Admin\Product;

\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $products = null;
    protected $message = null;

    public function __construct()
    {
        $this->setTemplate('./admin/product/grid.php');
        
    }
    public function setProducts($products = null)
    {
        if (!$products) {
            $products = \Mage::getModel("model\productModel");
            $products = $products->fetchAll();

        }
        $this->products = $products;
         return $this;
    }
    public function getProducts()
    {
        if (!$this->products) {
            $this->setProducts();
            
        }
        return $this->products;     
    }
    public function getTitle()
    {
        return "Manage Products";
    }

    
}

?>