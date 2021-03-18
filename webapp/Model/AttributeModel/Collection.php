<?php

namespace Model\AttributeModel;

\Mage::loadClassByFileName('Model\Core\Collection');

class Collection extends \Model\Core\Collection
{
    public function __construct()
    {
        parent::__construct();
    }
}
