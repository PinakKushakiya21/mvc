<?php

namespace Block\Admin\ConfigGroup;

\Mage::loadClassByFileName('block\core\grid');

class Grid extends \Block\Core\Grid{

    protected $configGroups = null;
    protected $filter = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/configgroup/grid.php');

        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function setFilter($filter = null)
    {
        if (!$filter) {
            $filter = \Mage::getModel('Model\Admin\Filter');
        }
        $this->filter = $filter;
        return $this;
    }

    public function getFilter()
    {
        if (!$this->filter) {
            $this->setFilter();
        }
        return $this->filter;
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'groupID',
            [
                'field' => 'groupId',
                'label' => 'Group Id',
                'type' => 'number'
            ]
        );
        $this->addColumn(
            'name',
            [
                'field' => 'name',
                'label' => ' Name',
                'type' => 'text'
            ]
        );
        
        $this->addColumn(
            'createdDate',
            [
                'field' => 'createdDate',
                'label' => 'Created Date',
                'type' => 'text'
            ]
        );
    }


    public function setConfigGroups($configGroups = null)
    {
        if (!$configGroups) {
            $configGroups = \Mage::getModel("model\configGroup");
            $configGroups = $configGroups->fetchAll();
        }
        $this->configGroups = $configGroups;
        return $this;
    }
    public function getConfigGroups()
    {
        if (!$this->configGroups) {
            $this->setConfigGroups();
            
        }
        return $this->configGroups;     
    }
    public function getTitle()
    {
        return "Manage Config";
    }

    public function getPaginationConfigGroups()
    {
        $configGroups = \Mage::getModel("Model\configGroup");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
       
        $query = "Select * from `config_group`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }
        $query .= " LIMIT {$start},{$recordPerPage}";
        return $configGroups->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `config_group`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }

        $admin = \Mage::getModel('Model\ConfigGroup');

        $records = $admin->getAdapter()->fetchOne($query);

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

    public function prepareActions()
    {
        $this->addAction(
            'edit',
            [
                'label' => 'Edit',
                'class' => 'fa fa-pencil btn-info btn',
                'method' => 'getEditUrl',
            ]
        );

        $this->addAction(
            'delete',
            [
                'label' => 'Delete',
                'class' => 'fa fa-trash btn-danger btn',
                'method' => 'getDeleteUrl',
            ]
        );
    }

    public function prepareButtons()
    {
        $this->addButton(
            'addnew',
            [
                'label' => 'Add Admin',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->groupId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->groupId]);
    }
}
