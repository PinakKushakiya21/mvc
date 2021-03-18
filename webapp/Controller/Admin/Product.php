<?php

namespace Controller\Admin;

\Mage::loadClassByFileName('controller\core\admin');

  
class Product extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
        
    }

    public function gridAction()
    {
        $gridBlock = \Mage::getBlock("block\admin\product\grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock,'Grid');
        $this->renderLayout();   
    }
    public function indexAction()
    {
        $productId = (int)$this->getRequest()->getGet('id');
        $product = \Mage::getModel("Model\productModel")->load($productId);
        if(!$product){
            throw new Exception("No Record Found.!", 1);
            
        }
        $grid = \Mage::getBlock("Block\Admin\Product\Edit\Tabs\GroupPrice")->setProduct($product);   
               
        $layout = $this->getLayout();
        $productTab = \Mage::getBlock("block\admin\product\Edit\Tabs");
        $layout->getChild('Content')->addChild($grid,'Grid');
        $layout->getChild('Sidebar')->addChild($productTab,'Tab');
        
        $this->renderLayout();
    }
    public function formAction(){
        try { 
                   
            $form = \Mage::getBlock('block\admin\product\edit');
            $layout = $this->getLayout();
            $productTab = \Mage::getBlock("block\admin\product\Edit\Tabs");
            $layout->getChild('Content')->addChild($form,'Grid');
            $layout->getChild('Sidebar')->addChild($productTab,'Tab');
            
            $this->renderLayout();

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
   
    public function saveAction()
    {
        try 
        {
            $product = \Mage::getModel("Model\productModel");
            

            if(!$this->getRequest()->isPost())
            {
                throw new Exception("Invalid Post Request", 1);
            }
            $productId =$this->getRequest()->getGet('id');
            if (!$productId) {
                date_default_timezone_set('Asia/Kolkata');
                $product->createdDate = date("Y-m-d H:i:s");
                
                $this->getMessage()->setSuccess("Product Inserted SuccessFully !!");

            }
            else{
                $product =  $product->load($productId);
                if (!$product) {
                    throw new Exception("Data Not Found", 1);
                }
                date_default_timezone_set('Asia/Kolkata');
                $product->updatedDate = date("y-m-d h:i:s");
                $product->productId = $productId;
                
                $this->getMessage()->setSuccess("Product Updated SuccessFully !!"); 
            }   
            
            $productData = $this->getRequest()->getPost('product');

            
            foreach ($productData as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                    $productData[$key] = $value;
                }
            }


            if(!array_key_exists('status',$productData)){
               $productData['status']=0;
           }					
           else{
               $productData['status']=1;
           }

            $product->setData($productData); 
            $product->save();
           
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->setFailure($e->getMessage());
            
        }   
        $this->redirect('grid');       
    }
	public function changeStatusAction(){
		try {

			$id = $this->getRequest()->getGet('id');
			$st = $this->getRequest()->getGet('status');
			$model = \Mage::getModel('model\productModel');
			$model->id =$id;
			$model->status = $st;
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Status Changed Successfully"); 
            }
            
		} catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage()); 
		}
        $this->redirect('grid',null,null,true);
	}
	public function deleteAction(){
		try {
			if($this->request->isPost())
            {
                throw new Exception("Invalid Request", 1);
             
            }
			
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\productModel');
			$delModel->id = $id;
			$delModel->delete();
            if($delModel->delete()){
                $this->getMessage()->setSuccess("Product Deleted SuccessFully !!"); 
            }else{
                $this->getMessage()->setFailure("Error While Deleting Data!!"); 
            }
            
		} catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage()); 
			die();
		}
        $this->redirect('grid',null,null,true);
	}
}
?>

