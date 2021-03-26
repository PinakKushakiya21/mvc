<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class GroupPrice extends \Block\Core\Template{

    protected $product = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/groupPrice.php");
    }

    public function setProduct(\Model\Product $product)
    {
        $this->product = $product;
        return $this;
    } 

    public function getProduct()
    {
        return $this->product;
    }
    
    public function getCustomerGroup()
    {
        $query = "SELECT cg.*,pgp.productId,pgp.entityId,pgp.groupPrice, 
                if(p.productPrice IS NULL,'{$this->getProduct()->productPrice}',p.productPrice) as price
                FROM customer_group cg
                    LEFT JOIN product_group_price pgp 
                        ON pgp.groupId = cg.group_id
                            AND pgp.productId = '{$this->getProduct()->productId}'
                    LEFT JOIN product p
                        ON pgp.productId = p.productId
        ";
        $customerGroups = \Mage::getModel("Model\CustomerGroup");   
        $customerGroup =  $customerGroups->fetchAll($query);
        return $customerGroup;
    }
    
}   
