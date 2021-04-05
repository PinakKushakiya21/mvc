<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Option extends \Block\Core\Template
{
    protected $options = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/attribute/edit/tabs/option.php");
    }

    public function setOption($options = null)
    {
        if (!$options) {
            $options = \Mage::getModel("Model\Attribute\Option");
            if ($id = $this->getRequest()->getGet('id')) {
                $query = "select * from attribute_option where attributeId={$id}";
                $options = $options->fetchAll($query);
                if (!$options) {
                    return $this;
                }
            }
        }
        $this->options = $options;
        return $this;
    }

    public function getOption()
    {
        if (!$this->options) {
            $this->setOption();
        }
        return $this->options;
    }
}
