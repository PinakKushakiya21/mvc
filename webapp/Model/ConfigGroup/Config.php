<?php

namespace Model\ConfigGroup;

use Exception;

\Mage::loadClassByFileName("Model\Core\Table");

class Config extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('config')->setPrimaryKey('configId');
    }

    public function setConfigGroup($configGroup)
    {
        $this->configGroup = $configGroup;
        return $this;
    }

    public function getConfigGroup()
    {
        return $this->configGroup;
    }

    public function getOptions()
    {
        try {
            if (!$this->getConfigGroup()->groupId) {
                throw new Exception("ConfigGroup Not Found");
            }

            $query = "SELECT *
            FROM `config_group`
            WHERE `groupId`='{$this->getConfigGroup()->groupId}'
            ORDER BY `sortOrder` ASC";

            return $this->fetchAll($query);

            //return $this->getAttribute()->getOptions();
        } catch (Exception $e) {
        }
    }

    // public function getOptions()
    // {
    //     if(!$this->attribute->groupId)
    //     {
    //         throw new Exception('Invalid ID');
    //     }
    //     //$query = "select `brandId` as optionId, `name` as name, '$this->getAttribute()->groupId' as groupId, sortOrder from brand";
    //     $query = "select * from `attribute_option`
    //     where `groupId`='{$this->getAttribute()->groupId}'";
    //     return $this->fetchAll();
    //     return $this->getAttribute()->getOptions();
    // }
}
