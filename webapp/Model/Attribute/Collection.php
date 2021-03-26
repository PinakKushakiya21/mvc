<?php

namespace Model\Attribute;

\Mage::loadClassByFileName('Model\Core\Collection');

class Collection extends \Model\Core\Collection
{
    public function __construct()
    {
        parent::__construct();
    }
}
