<?php

namespace Controller\Admin;

use Mage;
use Exception;

class Cart extends \Controller\Core\Admin
{
    public function addItemToCartAction()
    {
        try {
            $id = (int)$this->getRequest()->getGet('id');
            $product = \Mage::getModel('Model\Product')->load($id);


            if (!$product) {
                throw new Exception("Product is not Available");
            }

            Mage::getModel('\Model\Admin\Session')->customerId = 16;

            $cart = $this->getCart();


            if ($this->getRequest()->isPost()) {
                $qty = $this->getRequest()->getPost('quantity');
            } else {
                $qty = 1;
            }


            if ($cart->addItem($product, 1, true)) {
                $this->getMessage()->setSuccess('Item added to cart Successfully');
            } else {
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirect('grid', 'admin\product', null, false);
    }


    public function indexAction()
    {

        $gridBlock = Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $cart = $this->getCart();
        $gridBlock->setCart($cart);
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }

    protected function getCart($customerId = NULL)
    {
        $session = \Mage::getModel('Model\Admin\Session');

        if ($customerId) {
            $session->customerId = $customerId;
        }

        $sessionId = \Mage::getModel('Model\Admin\Session')->getId();
        $cart = \Mage::getModel('Model\Cart');
        $query = "SELECT * FROM `cart` WHERE `customerId` = '{$session->customerId}'";
        $cart = $cart->fetchRow($query);

        if ($cart) {
            return $cart;
        }

        $cart = \Mage::getModel('Model\Cart');
        $cart->customerId = $session->customerId;
        $cart->createdDate = date('Y-m-d H:i:s');
        $cart->sessionId = $sessionId;
        $cart->save();
        return $cart;
    }

    public function updateAction()
    {
        try {
            $quantities = $this->getRequest()->getPost('quantity');

            $cart = $this->getCart();

            foreach ($quantities as $cartItemId => $quantity) {
                $cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            $this->getMessage()->setSuccess('Item Update to cart Successfully');
        } catch (\Exception $th) {
            echo $th->getMessage();
        }

        $this->redirect('index');
    }

    public function checkoutAction()
    {
        $checkout = \Mage::getBlock('Block\Admin\Cart\Checkout');
        $cart = $this->getCart();
        $layout = $this->getLayout();


        // $checkout->setCart($cart);
        // $layout->getChild('content')->addChild($checkout);
        // echo $layout->toHtml();
    }
    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');

            if (!$id) {
                throw new \Exception('Id Invalid');
            }
            $item = \Mage::getModel('Model\Cart\Item');
            $item->load($id)->getData();
            if ($item) {
                if ($item->delete()) {
                    $this->getMessage()->setSuccess('Record Deleted Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            } else {
                $this->getMessage()->setFailure('Id Not found');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        header("location:{$_SERVER['HTTP_REFERER']}");
    }

    public function selectCustomerAction()
    {
        $customerId = $this->getRequest()->getPost('customer');
        $this->getCart($customerId);

        $this->redirect('index', 'Admin_Cart', null, true);
    }

    public function saveAction()
    {
        try {
            $shipping = $this->getRequest()->getPost('shipping');
            $billing = $this->getRequest()->getPost('billing');
            $cartId = $this->getCart()->getItems()->getData()[0]->cartId;
            $cart = $this->getCart();

            if ($billing) {
                $cartBillingAddress = Mage::getModel('\Model\Cart\CartAddress');
                $query = "SELECT * FROM cartAddress where cartId={$cartId} and addressType='Billing'";
                if (!$cartBillingAddress->fetchRow($query)) {
                    $cartBillingAddress->setData($billing)->save();
                } else {
                    $cartBillingAddress->setData($billing)->save();
                }

                if ($this->getRequest()->getPost('billingSaveAddressBook')) {
                    $customer = $this->getCart()->getCustomer();
                    $customerAddress = Mage::getModel('\Model\CustomerAddress');

                    if ($customer->customerId) {
                        $query = "SELECT * FROM `address` where `customerId`={$customer->customerId} and `addressType`='Billing'";
                        if ($customerAddress->fetchRow($query)) {
                            $customerAddress->setData($billing)->save();
                        } else {
                            $customerAddress->customerId = $customer->customerId;
                            $customerAddress->AddressType = "Billing";
                            $customerAddress->setData($billing)->save();
                        }
                    }
                }
            }

            if ($shipping) {
                if ($shipping['sameAsBilling']) {
                    $shipping = $billing;
                    $shipping['sameAsBilling'] = 1;
                }
                $cartBillingAddress = Mage::getModel('\Model\Cart\CartAddress');
                $query = "SELECT * FROM cartAddress where cartId={$cartId} and addressType='Shipping'";
                if (!$cartBillingAddress->fetchRow($query)) {
                    $cartBillingAddress->setData($shipping)->save();
                } else {
                    $cartBillingAddress->setData($shipping)->save();
                }

                if ($this->getRequest()->getPost('shippingSaveAddressBook')) {
                    $customer = $this->getCart()->getCustomer();
                    $customerAddress = Mage::getModel('\Model\CustomerAddress');

                    if ($customer->customerId) {
                        $query = "SELECT * FROM `address` where `customerId`={$customer->customerId} and `addressType`='Shipping'";
                        if ($customerAddress->fetchRow($query)) {
                            $customerAddress->setData($shipping);
                            unset($customerAddress->sameAsBilling);
                            $customerAddress->save();
                        } else {
                            $customerAddress->customerId = $customer->customerId;
                            $customerAddress->AddressType = "Shipping";
                            $customerAddress->setData($shipping)->save();
                        }
                    }
                }
            }
        } catch (\Exception $th) {
            $this->getMessage()->setFailure('Unable To Set Record');
        }

        $this->redirect('checkout', 'home\home');
    }






    // public function saveAction()
    // {
    //     $billing = $this->getRequest()->getPost('billing');
    //     $shipping = $this->getRequest()->getPost('shipping');
    //     $cartId = $this->getCart()->getItems()->cartId;

    //     if ($billing) {
    //         $query = "SELECT * FROM `cartaddress` WHERE `addressType`='billing' and `cartId`='{$this->cartId}'";
    //         $cartBillingAddress = \Mage::getModel('Model\CartAddress')->fetchRow($query);
    //         $cartBillingAddress->cartId = $cartId;
    //         $cartBillingAddress->addressType = 'Billing';
    //         $cartBillingAddress->setData();
    //     }
    //     $cartBillingAddress->save();

    //     if ($cartBillingAddress) {
    //         $customerId = $this->getCart()->cartId;
    //         $query = "SELECT * FROM `customer_address` where `customerId`='{$customerId}' and `addressType`='billing'"
    //         $customer = Mage::getModel('Model\CustomerAddress')->fetchRow($query);
    //         $customer->customerId = $cartId;
    //         $customer->addressType = 'billing';
    //         $customer->setData();
    //     }
    //     $customer->save();

    //     if ($cartShippingAddress) {
    //         $customerId = $this->getCart()->cartId;
    //         $query = "SELECT * FROM `customer_address` where `customerId`='{$customerId}' and `addressType`='billing'"
    //         $customer = Mage::getModel('Model\CustomerAddress')->fetchRow($query);
    //         $customer->customerId = $cartId;
    //         $customer->addressType = 'shipping';
    //         $customer->setData();
    //     }

    // }

    /*public function saveAction()
    {
        try {
            echo "<pre>";
            $shipping = $this->getRequest()->getPost('shipping');
            $billing = $this->getRequest()->getPost('billing');
            $cartId = $this->getCart()->getItems()[0]->cartId;

            if ($billing) {
                $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$cartId}' AND `addressType` = 'Billing'";
                $cartBillingAddress = \Mage::getModel('Model\Cart\CartAddress')->fetchRow($query);

                if (!$cartBillingAddress) {
                    $cartBillingAddress = \Mage::getModel('Model\Cart\CartAddress');
                }

                $cartBillingAddress->cartId = $cartId;
                $cartBillingAddress->addressType = 'Billing';
                $cartBillingAddress->setData($billing);

                if ($this->getRequest()->getPost('billingSaveAddressBook')) {
                    $customerId = $this->getCart()->customerId;
                    $query = "SELECT * FROM `customer_address` WHERE `customerId`='{$customerId}' AND `addressType`='Billing'";
                    $customer = \Mage::getModel('Model\CustomerAddress')->fetchAll($query);
                    $customer = $customer[0];
                    if (!$customer) {
                        $customer = \Mage::getModel('Model\CustomerAddress');
                    }
                    $cartBillingAddress->addressId = $customer->id;
                    $customer->customerId = $customerId;
                    $customer->addresstype = 'Billing';
                    $customer->setData($billing);
                    $customer->save();
                }

                if (array_key_exists('sameasbilling', $shipping)) {
                    $cartBillingAddress->sameAsBilling = 1;
                    $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$cartId}' AND `addressType` = 'Shipping'";
                    $cartShippingAddress = \Mage::getModel('Model\Cart\CartAddress')->fetchRow($query);
                    if ($cartShippingAddress) {
                        $cartShippingAddress->delete();
                    }
                    if ($cartBillingAddress->save()) {
                        $this->getMessage()->setSuccess('Record Set Successfully');
                    } else {
                        $this->getMessage()->setFailure('Unable To Delete Record');
                    }
                    $this->redirect('checkout');
                } else {
                    $cartBillingAddress->sameAsBilling = 0;
                }

                if ($cartBillingAddress->save()) {

                    $this->getMessage()->setSuccess('Record Set Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            }
            if ($shipping) {
                $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$cartId}' AND `addressType` = 'Shipping'";
                $cartShippingAddress = \Mage::getModel('Model\Cart\CartAddress')->fetchRow($query);

                if (!$cartShippingAddress) {
                    $cartShippingAddress = \Mage::getModel('Model\Cart\CartAddress');
                }

                if ($this->getRequest()->getPost('shippingSaveAddressBook')) {
                    $customerId = $this->getCart()->customerId;
                    $query = "SELECT * FROM `customer_address` WHERE `customerId`='{$customerId}' AND `addressType`='Shipping'";
                    $customer = \Mage::getModel('Model\CustomerAddress')->fetchAll($query);
                    $customer = $customer[0];
                    if (!$customer) {
                        $customer = \Mage::getModel('Model\CustomerAddress');
                    }
                    $cartShippingAddress->addressId = $customer->id;
                    $customer->customerId = $customerId;
                    $customer->addresstype = 'Shipping';
                    $customer->setData($shipping);
                    $customer->save();
                }

                $cartShippingAddress->cartId = $cartId;
                $cartShippingAddress->addressType = 'Shipping';
                $cartShippingAddress->setData($shipping);
                print_r($customer);
                print_r($cartShippingAddress);

                if ($cartShippingAddress->save()) {
                    $this->getMessage()->setSuccess('Record Deleted Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            }
        } catch (\Exception $th) {
            $this->getMessage()->setFailure('Unable To Set Record');
        }

        $this->redirect('checkout');
    }*/
}
