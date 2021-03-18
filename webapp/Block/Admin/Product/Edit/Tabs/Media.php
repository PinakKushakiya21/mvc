<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Media extends \Block\Core\Template{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/Edit/Tabs/media.php");
    }

    public function getImageData($id)
    {
        $mediaModel = \Mage::getModel("model\mediaModel");
        $query = "select * from productgallery where productId =".$id;
        $media = $mediaModel->fetchAll($query);
        return $media;
    }

}