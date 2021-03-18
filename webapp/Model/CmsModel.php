<?php


namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class CmsModel extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('cms_page')->setPrimaryKey('id');
    }
}
