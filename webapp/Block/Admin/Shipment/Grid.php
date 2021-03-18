<?php

namespace Block\Admin\Shipment;

\Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template{

    protected $shipments = null;
    public function __construct()
  {
      $this->setTemplate('./admin/shipment/grid.php');
  }
    public function setShipments($shipments = null)
    {
        if (!$shipments) {
            $shipments = \Mage::getModel("model\shipmentModel");
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

}

?>