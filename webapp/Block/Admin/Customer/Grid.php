<?php

namespace Block\Admin\Customer;


\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $customers = null;
    protected $groups = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/customer/grid.php');  
    }

    public function getGroupName($id)
    {
        $customers = \Mage::getModel("model\CustomerGroup");
        $data = $customers->load($id);
        
        return $data->name;
    }


    public function setCustomers($customers = null)
    {
        if (!$customers) {
            $customers = \Mage::getModel("model\Customer");
            $customers = $customers->fetchAll();
        }
        $this->customers = $customers;
        return $this;
    }
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
            
        }
        return $this->customers;     
    }
    public function getTitle()
    {
        return "Manage Customers";
    }

    public function getZipCode($id)
    {
        $zipcode = \Mage::getModel("Model\CustomerAddress");
        $query = "select `zipcode` from `customer_address` where `addressType`='Billing' and `customerId`={$id}";

        $data = $zipcode->getAdapter()->fetchRow($query);

        //return $data['zipcode'];
    }

    public function getPaginationCustomers()
    {
        $customers = \Mage::getModel("Model\Customer");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start =0;
        }
        $query = "SELECT * from customer LIMIT {$start},{$recordPerPage}";
        return $customers->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `customer`";
        $customer = \Mage::getModel('Model\Customer');

        $records = $customer->getAdapter()->fetchOne($query);

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