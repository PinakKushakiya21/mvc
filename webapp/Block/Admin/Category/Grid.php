<?php

namespace Block\Admin\Category;

\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $categories = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/category/grid.php');
    }

    public function setCategories($categories = null)
    {
        if (!$categories) {
            $categories = \Mage::getModel("model\Category");
            $query = "select * from `category`";
            $categories = $categories->fetchAll($query);
        }
        $this->categories = $categories;
        return $this;
    }
    public function getCategories()
    {
        if (!$this->categories) {
            $this->setCategories();
            
        }
        return $this->categories;     
    }
    public function getTitle()
    {
        return "Manage Categories";
    }

    public function getName($category)
    {
        $Category = \Mage::getModel('model\Category');
        if (!$this->categoryOptions) {
            $query = "SELECT `categoryId`,`categoryName` FROM `{$Category->getTableName()}`;";
            $this->categoryOptions = $Category->getAdapter()->fetchPairs($query);
        }

        $pathIds = explode("/",$category->pathId);
        foreach ($pathIds as $key => &$id) {
            if (array_key_exists($id,$this->categoryOptions)) {
                $id = $this->categoryOptions[$id];
            }
        }
        $name = implode("=>",$pathIds);  
        return $name;
    }

    public function getPaginationCategories()
    {
        $categories = \Mage::getModel("Model\Category");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start =0;
        }
        $query = "SELECT * from category LIMIT {$start},{$recordPerPage}";
        return $categories->fetchAll($query);
    }


    public function pagination()
    {
        $query = "Select * from `category`";
        $category = \Mage::getModel('Model\Category');

        $records = $category->getAdapter()->fetchOne($query);

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

?>