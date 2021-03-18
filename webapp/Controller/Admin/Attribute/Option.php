<?php

namespace Controller\Admin\Attribute;

use Controller\Core\Admin;
use Exception;
use Mage;

Mage::loadClassByFileName('Controller\Core\Admin');

class Option extends \Controller\Core\Admin
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
            $attributeId = $this->getRequest()->getGet('id');

            if (array_key_exists('existing', $data)) {
                foreach ($data['existing'] as $optionId => $optionValue) {
                    $priceGroupModel = Mage::getModel("Model\AttributeModel\OptionModel");
                    $query = "Update `attribute_option` set `name`= '{$optionValue['name']}', `sortOrder`='{$optionValue['sortOrder']}' where  `attributeId`={$attributeId} and `optionId`={$optionId}";

                    if ($priceGroupModel->update($query)) {
                        $this->getMessage()->setSuccess("Option Updated SuccessFully !!");
                    }
                }
            }

            if (array_key_exists('new', $data)) {

                $data['new'] = array_combine($data['new']['name'], $data['new']['sortOrder']);
                foreach ($data['new'] as $name => $sortOrder) {
                    if ($name) {
                        $priceGroupModel = Mage::getModel("Model\AttributeModel\OptionModel");
                        $priceGroupModel->attributeId  = $attributeId;
                        $priceGroupModel->name = "$name";
                        $priceGroupModel->sortOrder = "$sortOrder";
                        if ($priceGroupModel->save()) {
                            $this->getMessage()->setSuccess("Option Updated SuccessFully !!");
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirect('form', 'attribute', null, false);
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('optionId');

            $delModel = Mage::getModel('Model\AttributeModel\OptionModel');
            $delModel->id = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Option Deleted SuccessFully !!");
            } else {
                throw new Exception("Error While Deleting Data!!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'attribute', null, false);
    }
}
