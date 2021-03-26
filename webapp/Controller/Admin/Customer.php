<?php

namespace Controller\Admin;

\Mage::loadClassByFileName('controller\core\admin');

  
class Customer extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
        
    }
   
    public function gridAction()
    {

        $gridBlock = \Mage::getBlock("block\admin\customer\grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock,'Grid');
        $this->renderLayout();
        
    }
    public function formAction(){

        $form = \Mage::getBlock('block\admin\customer\edit');
        $layout = $this->getLayout();


        $customerTab = \Mage::getBlock("block\admin\customer\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($customerTab,'Tab');

        $layout->getChild('Content')->addChild($form,'Grid');
        $this->renderLayout();
    }

    public function addressAction()
    {
       
        try 
        { 
            if(!$this->getRequest()->isPost())
            {
                throw new Exception("Invalid Post Request");
            }
            $customerId = $this->getRequest()->getGet('id');
            $customer = \Mage::getModel("Model\CustomerAddress");
        
            $query="SELECT addressType from customer_address where customerId =".$customerId;
            $existing = $customer->fetchAll($query); 
            $typeArray = [];
            
            if($existing){
                foreach ($existing->getData() as  $record) {
                    $typeArray[] = $record->addressType;
                }
            }

            $customerBillingData = $this->getRequest()->getPost('billing');

            if($customerBillingData['address']){
                if(in_array('Billing',$typeArray)){
                    
                    $customer->customerId = $customerId;
                    $customer->addressType = "Billing";
                    $customer->setData($customerBillingData);
                    $updateData = $customer->getData();

                    $value= array_values($updateData);
                    $field = array_keys($updateData);
                    $final = null;
        
                    for ($i=0; $i < count($field); $i++) {
                        if ($field[$i] == "customerId") {
                            $id = $value[$i];
                            continue;
                        }
                        $final = $final."`".$field[$i]."`='".$value[$i]."',";
                    }
                    $final = rtrim($final,",");
                    
                    $query ="UPDATE `customer_address` SET {$final} WHERE `customerID` = '{$id}' and `addressType` = 'Billing'";
                    
                    $customer->update($query); 
                    $this->getMessage()->setSuccess("Billing Address Updated !!");
                }
                else{
                    $customer->customerId = $customerId;
                    $customer->addressType = "Billing";
                    $customer->setData($customerBillingData);
                    $customer->save();
                    $this->getMessage()->setSuccess("Billing Address Added !!");
                }

        }
        
        $customer->resetArray();
        
        $customerShippingData = $this->getRequest()->getPost('shipping');
        if($customerShippingData['address']){
            
            if(in_array('Shipping',$typeArray)){
                $customer->customerId = $customerId;
                $customer->addressType = "Shipping";
                $customer->setData($customerShippingData);
                $updateData = $customer->getData();

                 $value= array_values($updateData);
                 $field = array_keys($updateData);
                 $final = null;
     
                 for ($i=0; $i < count($field); $i++) {
                     if ($field[$i] == "customerId") {
                         $id = $value[$i];
                         continue;
                     }
                     $final = $final."`".$field[$i]."`='".$value[$i]."',";
                 }
                 $final = rtrim($final,",");
                 
                $query ="UPDATE `customer_address` SET {$final} WHERE `customerID` = '{$id}' and `addressType` = 'Shipping'";
                
                $customer->update($query);
                $this->getMessage()->setSuccess("Shipping Address Updated !!");
            }
            else{
                $customer->customerId = $customerId;
                $customer->addressType = "Shipping";
                $customer->setData($customerShippingData);
                $customer->save();
                $this->getMessage()->setSuccess("Shipping Address Added !!");
            }
        }
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->setFailed($e->getMessage());
        }   

        $this->redirect('form','customer',null,false);
    }
   
    public function saveAction()
    {
        try 
        { 
            $customer = \Mage::getModel("Model\Customer");
            if(!$this->getRequest()->isPost())
            {
                throw new Exception("Invalid Post Request");
            }
            $customerId =$this->getRequest()->getGet('id');
            if (!$customerId) {
                date_default_timezone_set('Asia/Kolkata');
                $customer->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Customer Inserted Successfully");
            }
            else{
                $customer =  $customer->load($customerId);
                if (!$customer) {
                    throw new Exception("Data Not Found");
                }
                date_default_timezone_set('Asia/Kolkata');
                $customer->updatedDate = date("y-m-d h:i:s");
                $this->getMessage()->setSuccess("Customer Updated Successfully");
            }   
        
            $customerData = $this->getRequest()->getPost('customer');
            if(!array_key_exists('status',$customerData)){
                $customerData['status']=0;
            }					
            else{
                $customerData['status']=1;
            }
            $customer->setData($customerData);  
            $customer->save();

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
			$model = \Mage::getModel('model\Customer');
			$model->id =$id;
			$model->status = $st;
			$model->changeStatus();
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Customer Status Updated Successfully");
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
			$delModel = \Mage::getModel('model\Customer');
			$delModel->id = $id;
			$delModel->delete();
            if($delModel->delete()){
                $this->getMessage()->setSuccess("Customer Deleted SuccessFully !!"); 
            }else{
                $this->getMessage()->setFailure("Unable to Delete Customer!!"); 
            }
           
			
		} catch (Exception $e) {
			$this->getMessage()->setFailure($e->getMessage()); 
		}
        $this->redirect('grid',null,null,true);
	}
}
