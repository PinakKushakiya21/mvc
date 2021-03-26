<?php

namespace Block\Admin\CustomerGroup;

\Mage::loadClassByFileName('block\core\template');

class Grid extends \Block\Core\Template{

    protected $customerGroups = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/customerGroup/grid.php');
        
    }

    public function setCustomerGroups($customerGroups = null)
    {
        if (!$customerGroups) {
            $customerGroups = \Mage::getModel("model\CustomerGroup");
            $customerGroups = $customerGroups->fetchAll();
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }
    public function getCustomerGroups()
    {
        if (!$this->customerGroups) {
            $this->setCustomerGroups();
            
        }
        return $this->customerGroups;     
    }
    public function getTitle()
    {
        return "Manage Customer Group";
    }

    public function getPaginationCustomerGroups()
    {
        $customerGroups = \Mage::getModel("Model\CustomerGroup");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start =0;
        }
        $query = "SELECT * from customer_group LIMIT {$start},{$recordPerPage}";
        return $customerGroups->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `customer_group`";
        $customerGroup = \Mage::getModel('Model\CustomerGroup');

        $records = $customerGroup->getAdapter()->fetchOne($query);

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