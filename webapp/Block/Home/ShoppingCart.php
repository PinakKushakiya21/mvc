<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class ShoppingCart extends \Block\Core\Template
{
    protected $cart = null;

    public function __construct()
    {
        $this->setTemplate('./home/shoppingCart.php');
    }

    public function setCart()
    {
        $session = Mage::getModel('\Model\Admin\Session');

        if (!$session->customerId) {
            return false;
        }

        $query = "SELECT *
        FROM `cart`
        WHERE `customerId` = '{$session->customerId}';";

        $this->cart = Mage::getModel("Model\Cart")->getAdapter()->fetchRow($query);
        return $this;
    }

    public function getCart()
    {
        if (!$this->cart) {
            $this->setCart();
        }
        return $this->cart;
    }

    public function getCartItems()
    {
        $cartItem = Mage::getModel('\Model\Cart\Item');
        $query = "select * from `cartitem` where `cartId`='{$this->getCart()['cartId']}'";

        return $cartItem->fetchAll($query);
    }

    public function getProduct($id)
    {
        $product = Mage::getModel('\Model\Product');

        return $product->load($id);
    }

    public function getTotal()
    {
        $cartItem = Mage::getModel('\Model\Cart\Item');
        $query = "select cast(sum((`price`-(`price`*`discount`/100))*`quantity`) as DECIMAL(10,2)) as `total` from `cartitem` where `cartId`='{$this->getCart()['cartId']}'";
        return $cartItem->getAdapter()->fetchRow($query)['total'];
    }

    public function getNumberOfProducts()
    {
        $cartItem = Mage::getModel('\Model\Cart\Item');
        $query = "select count(cartId) as `count` from `cartitem` where `cartId`='{$this->getCart()['cartId']}'";
        return $cartItem->getAdapter()->fetchRow($query)['count'];
    }
}
