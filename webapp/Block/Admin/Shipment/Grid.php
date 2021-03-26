<?php

namespace Block\Admin\Shipment;

\Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template{

    protected $shipments = null;
    public function __construct()
  {
      parent::__construct();
      $this->setTemplate('./admin/shipment/grid.php');
  }
    public function setShipments($shipments = null)
    {
        if (!$shipments) {
            $shipments = \Mage::getModel("model\Shipment");
            $shipments = $shipments->fetchAll();
        }
        $this->shipments = $shipments;
        return $this;
    }
    public function getShipment()
    {
        if (!$this->shipments) {
            $this->setShipments();
            
        }
        return $this->shipments;     
    }
    public function getTitle()
    {
        return "Manage Shipments";
    }

    public function getPaginationShipments()
    {
        $shipments = \Mage::getModel("Model\Shipment");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start =0;
        }
        $query = "SELECT * from shipping LIMIT {$start},{$recordPerPage}";
        return $shipments->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `shipping`";
        $shipment = \Mage::getModel('Model\Shipment');

        $records = $shipment->getAdapter()->fetchOne($query);

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