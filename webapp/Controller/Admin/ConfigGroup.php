<?php

namespace Controller\Admin;

use Exception;

\Mage::loadClassByFileName('controller\core\admin');

class ConfigGroup extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        $gridBlock = \Mage::getBlock("block\admin\configGroup\grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        //$layout->setTemplate("./core/layout/two_column_leftBar.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
    public function formAction()
    {

        $form = \Mage::getBlock('block\admin\configGroup\edit');
        $layout = $this->getLayout();
        $configGroupTab = \Mage::getBlock("block\admin\configGroup\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($configGroupTab, 'Tab');
        $layout->setTemplate("./core/layout/two_column_leftBar.php");
        $layout->getChild('Content')->addChild($form, 'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $configGroup = \Mage::getModel("Model\ConfigGroup");

            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }
            $configGroupId = $this->getRequest()->getGet('id');
            if ($configGroupId) {
                $configGroup =  $configGroup->load($configGroupId);
                if (!$configGroup) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("configGroup Updated Successfully !!");
            } else {
                $this->getMessage()->setSuccess("configGroup Inserted Successfully !!");
            }
            $configGroupData = $this->getRequest()->getPost('configGroup');
            $configGroup->setData($configGroupData);
            $configGroup->createdDate = date("Y-m-d H:i:s");
            $configGroup->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function deleteAction()
    {
        try {
            if ($this->request->isPost()) {
                throw new Exception("Invalid Request");
            }

            $id = $this->getRequest()->getGet('id');
            $delModel = \Mage::getModel('model\ConfigGroup');
            $delModel->groupId = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("configGroup Deleted Successfully !!");
            } else {
                $this->getMessage()->setFailure("Unable To Delete configGroup !!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function filterAction()
    {
        try {
            

            $filters = $this->getRequest()->getPost('filter');

            $filterModel = \Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);

            $gridBlock = \Mage::getBlock("Block\Admin\ConfigGroup\Grid")->setFilter($filterModel);
            $layout = $this->getLayout();
            $layout->setTemplate("./core/layout/one_column.php");
            $layout->getChild("Content")->addChild($gridBlock, 'Grid');
            $this->renderLayout();

        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
}
