<?php

namespace Model\ConfigGroup;

\Mage::loadClassByFileName('Model\Core\Table\Collection');

class Collection extends \Model\Core\Table\Collection
{
    public function __construct()
    {
        parent::__construct();
    }
}
