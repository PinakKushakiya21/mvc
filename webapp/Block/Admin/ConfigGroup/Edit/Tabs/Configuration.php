<?php

namespace Block\Admin\ConfigGroup\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Configuration extends \Block\Core\Template
{
    protected $configs = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configGroup/edit/tabs/configuration.php");
    }

    public function setConfig($configs = null)
    {
        if (!$configs) {
            $configs = \Mage::getModel("\Model\ConfigGroup\Config");
            if ($id = $this->getRequest()->getGet('id')) {
                $query = "SELECT * FROM config WHERE groupId='{$id}'";
                $configs = $configs->fetchAll($query);
                if (!$configs) {
                    return null;
                }
            }
        }
        $this->configs = $configs;
        return $this;
    }

    public function getConfig()
    {
        if (!$this->configs) {
            $this->setConfig();
        }
        return $this->configs;
    }
}
