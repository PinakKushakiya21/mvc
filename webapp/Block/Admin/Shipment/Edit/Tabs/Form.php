<?php

namespace Block\Admin\Shipment\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Form extends \Block\Core\Template
{
    protected $shipments = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/shipment/edit/tabs/form.php");
    }

      public function setShipment($shipments = null)
      {
          if (!$shipments) 
          {
              $shipments = \Mage::getModel("Model\shipmentModel");
              if ($id = $this->getRequest()->getGet('id')) 
              {
                  $shipment = $shipments->load($id);
                  if (!$shipment) {
                      return null;
                  }
              }  
          }
          $this->shipments = $shipments;
          return $this;
      }
      public function getShipment()
      {
          if (!$this->shipments) {
              $this->setShipment();
          }
          return $this->shipments;     
      }  

}
