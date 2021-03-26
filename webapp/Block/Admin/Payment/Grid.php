<?php

namespace Block\Admin\Payment;

\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $payments = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/payment/grid.php');
        
    }
    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payments = \Mage::getModel("model\Payment");
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

    public function getPaginationPayments()
    {
        $payments = \Mage::getModel("Model\Payment");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start =0;
        }
        $query = "SELECT * from payment LIMIT {$start},{$recordPerPage}";

        return $payments->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `payment`";
        $payment = \Mage::getModel('Model\Payment');

        $records = $payment->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(2);

        $page = $this->getRequest()->getGet('page'); 

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }
}

?>