<?php

namespace Block\Admin\Category;

\Mage::loadClassByFileName('block\core\Template');

class Grid extends \Block\Core\Template{

    protected $categories = null;
    public function __construct()
    {
        $this->setTemplate('./admin/category/grid.php');
    }

    public function setCategories($categories = null)
    {
        if (!$categories) {
            $categories = \Mage::getModel("model\categoryModel");
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
        $categoryModel = \Mage::getModel('model\categoryModel');
        if (!$this->categoryOptions) {
            $query = "SELECT `categoryId`,`categoryName` FROM `{$categoryModel->getTableName()}`;";
            $this->categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
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

}

?>