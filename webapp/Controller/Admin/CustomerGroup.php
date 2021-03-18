<?php

namespace Controller\Admin;

\Mage::loadClassByFileName('controller\core\admin');

  
class CustomerGroup extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
        
    }
   
    public function gridAction()
    {

        $gridBlock = \Mage::getBlock("block\admin\customerGroup\grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock,'Grid');
        $this->renderLayout();
        
    }
    public function formAction(){

        $form = \Mage::getBlock('block\admin\customerGroup\edit');
        $layout = $this->getLayout();
        $customerGroupTab = \Mage::getBlock("block\admin\customerGroup\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($customerGroupTab, 'Tab');
        $layout->getChild('Content')->addChild($form,'Grid');
        $this->renderLayout();
    }
   
    public function saveAction()
    {
        try 
        { 
            $customerGroup = \Mage::getModel("Model\customerGroupModel");
            if(!$this->getRequest()->isPost())
            {
                throw new Exception("Invalid Post Request");
            }
            $customerGroupId =$this->getRequest()->getGet('id');
            if (!$customerGroupId) {
                date_default_timezone_set('Asia/Kolkata');
                $customerGroup->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Customer Group Inserted Successfully");
            }
            else{
                $customerGroup =  $customerGroup->load($customerGroupId);
                if (!$customerGroup) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Customer Group Updated Successfully");
            }   
        
            $customerGroupData = $this->getRequest()->getPost('customerGroup');
            if(!array_key_exists('status',$customerGroupData)){
                $productData['status']=0;
            }					
            else{
                $productData['status']=1;
            }
            $customerGroup->setData($customerGroupData);  
            $customerGroup->save();
            
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->setFailed($e->getMessage());
        }   
        $this->redirect('grid',null,null,true);       
    }
	public function changeStatusAction(){
		try {

			$id = $this->getRequest()->getGet('id');
			$st = $this->getRequest()->getGet('status');
			$customerGroup = \Mage::getModel('model\customerGroupModel');
			$customerGroup->id =$id;
			$customerGroup->status = $st;
			$customerGroup->changeStatus();
            if($customerGroup->changeStatus()){
                $this->getMessage()->setSuccess("Customer Group Status Updated Successfully");
            }
            
			
		} catch (Exception $e) {
            $this->getMessage()->setFailed($e->getMessage());
		}
        $this->redirect('grid',null,null,true);
	}   

	public function deleteAction(){
		try {
			if($this->request->isPost())
            {
                throw new Exception("Invalid Request");
            }
			
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\customerGroupModel');
			$delModel->id = $id;
			$delModel->delete();
            if($delModel->delete()){
                $this->getMessage()->setSuccess("Customer Group Deleted SuccessFully !!"); 
            }else{
                $this->getMessage()->setFailure("Unable to Delete Customer Group!!"); 
            }
           
			
		} catch (Exception $e) {
			$this->getMessage()->setFailure($e->getMessage()); 
		}
        $this->redirect('grid',null,null,true);
	}
}
?>

