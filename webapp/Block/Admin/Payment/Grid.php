<?php

namespace Block\Admin\Payment;

\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $payments = null;
    public function __construct()
    {
        $this->setTemplate('./admin/payment/grid.php');
        
    }
    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payments = \Mage::getModel("model\paymentModel");
            $payments = $payments->fetchAll();
        }
        $this->payments = $payments;
        return $this;
    }
    public function getPayments()
    {
        if (!$this->payments) {
            $this->setPayments();
            
        }
        return $this->payments;     
    }
    public function getTitle()
    {
        return "Manage Payments";
    }
}

?>