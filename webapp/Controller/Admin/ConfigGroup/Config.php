<?php

namespace Controller\Admin\ConfigGroup;

use Controller\Core\Admin;
use Exception;
use Mage;

Mage::loadClassByFileName('Controller\Core\Admin');

class Config extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $data = $this->getRequest()->getPost();


            $groupId = $this->getRequest()->getGet('id');

            if (array_key_exists('existing', $data)) {
                foreach ($data['existing'] as $configId => $configValue) {
                    $configuration = Mage::getModel("Model\ConfigGroup\Config");
                    $query = "Update `config` set `title`= '{$configValue['title']}', `code`='{$configValue['code']}', `value`='{$configValue['value']}' where `groupId`={$groupId} and `configId`={$configId}";

                    if ($configuration->update($query)) {
                        $this->getMessage()->setSuccess("Config Updated SuccessFully !!");
                    }
                }
            }

            if (array_key_exists('new', $data)) {

                array_map(function ($title, $code, $value) {
                    echo "<pre>";
                    if (($title != null && $title != "") && ($title != null && $title != "") && ($value != null && $value != "")) {
                        $configuration = Mage::getModel("Model\ConfigGroup\Config");
                        $configuration->groupId = $this->getRequest()->getGet('id');
                        $configuration->title = $title;
                        $configuration->code = $code;
                        $configuration->value = $value;
                        $configuration->save();
                    }
                }, $data['new']['title'], $data['new']['code'], $data['new']['value']);
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\configGroup', null, false);
    }
    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('configId');

            $delModel = \Mage::getModel('Model\ConfigGroup\Config');
            $delModel->configId = $id;
            //$delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("config Deleted SuccessFully !!");
            } else {
                throw new Exception("Error While Deleting Data!!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\configGroup', null, false);
    }
}
