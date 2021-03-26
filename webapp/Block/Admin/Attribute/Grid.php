<?php

namespace Block\Admin\Attribute;

\Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $attributes = null;
    protected $message = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/attribute/grid.php');
    }
    public function setAttributes($attributes = null)
    {
        if (!$attributes) {
            $attributes = \Mage::getModel("Model\Attribute");
            $attributes = $attributes->fetchAll();
        }
        $this->attributes = $attributes;
        return $this;
    }
    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }
    public function getTitle()
    {
        return "Manage Attributes";
    }

    public function getPaginationAttributes()
    {
        $attributes = \Mage::getModel("Model\Attribute");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start =0;
        }
        $query = "SELECT * from attribute LIMIT {$start},{$recordPerPage}";
        return $attributes->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `attribute`";
        $attribute = \Mage::getModel('Model\Attribute');

        $records = $attribute->getAdapter()->fetchOne($query);

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
