<?php

namespace Block\Home;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Brand extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./home/productDetail.php");
    }
}
