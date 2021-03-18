<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Form extends \Block\Core\Template{
    protected $products = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/form.php");
    }

    public function setProduct($products = null)
    {
        if (!$products) 
        {
            $products = \Mage::getModel("Model\productModel");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $product = $products->load($id);
                if (!$product) {
                    return null;
                }
            }  
        }
        $this->products = $products;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->products) {
            $this->setProduct();
        }
        return $this->products;     
    }  

}