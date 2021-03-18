<?php
namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");
class CustomerAddress extends \Block\Core\Template
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customer/edit/tabs/customerAddress.php");
    }

    public function setCustomerAddress($customers = null)
    {
        if (!$customers) {
            $customers = \Mage::getModel("Model\customerModel");
            if ($id = $this->getRequest()->getGet('id')) {
                $customer = $customers->load($id);
                if (!$customer) {
                    return null;
                }
            }
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomerAddress()
    {
        if (!$this->customers) {
            $this->setCustomerAddress();
        }
        return $this->customers;
    }

    public function getAddressData($id, $type)
    {
        $customerAddress = \Mage::getModel("Model\CustomerAddressModel");
        $query = "SELECT * from customer_address where customerId = {$id} and addressType='{$type}'";
        if(!$customerAddress->fetchAll($query)){
            return $customerAddress;
        }
        return $customerAddress->fetchAll($query)->getData()[0];
    }

}
