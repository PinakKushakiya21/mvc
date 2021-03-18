<?php

namespace Block\Admin\Product\Edit;

\Mage::loadClassByFileName("block\core\Template");

class Tabs extends \Block\Core\Template{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('product',["label"=>"Product Information","className"=>'Block\Admin\Product\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('id')){
            $this->addTab('media',["label"=>"Media","className"=>'Block\Admin\Product\Edit\Tabs\Media']);
            $this->addTab('attribute', ["label" => "Attribute", "className" => 'Block\Admin\Product\Edit\Tabs\Attribute']);
            $this->addTab('groupPrice',["label"=>"Group Price","className"=>'Block\Admin\Product\Edit\Tabs\GroupPrice']);
        }   
        $this->addTab('category',["label"=>"Category","className"=>'Block\Admin\Product\Edit\Tabs\Category']);
        $this->setDefault('product');
    }

    public function setDefault($key)
    {
        $this->default = $key;
        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }
    
    public function addTab($key,$tabs = [])
    {
                      
        $this->tabs[$key] = $tabs;
        return $this;
    }
    
    public function removeTab($key)
    {
        if(!array_key_exists($key,$this->tabs)){
            return null;
        }
        unset($this->tabs[$key]);
        return $this;
    }
    
    public function getTab($key)
    {
        if(!array_key_exists($key,$this->tabs)){
            return null;
        }
        return $this->tabs[$key]; 
    }
    
}