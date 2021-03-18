<?php

namespace Controller\Admin;

\Mage::loadClassByFileName('controller\core\admin');
  
class Category extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
    }
   
    public function gridAction()
    {

        $gridBlock = \Mage::getBlock("block\admin\category\grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock,'Grid');
        $this->renderLayout();

    }
    public function formAction(){

        $form = \Mage::getBlock('block\admin\category\edit');
        $layout = $this->getLayout();

        $categoryTab = \Mage::getBlock("block\admin\category\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($categoryTab,'Tab');

        $layout->getChild('Content')->addChild($form,'Grid');
        $this->renderLayout();
    }
   
    public function saveAction()
    {
        try 
        { 
            if (!$this->getRequest()->isPost()) 
            {
                throw new \Exception("Invalid Request");
            }
            $category = \Mage::getModel('model\categoryModel');
            $categoryId = $this->getRequest()->getGet('id');
            if ($categoryId) 
            {
                $category = $category->load($categoryId);
                if (!$category) {
                    throw new \Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Data Update Successfully..");
            }
            else 
            {
                $this->getMessage()->setSuccess("Data Insert Successfully..");
            }
            $categoryPathId = $category->pathId;
            $categoryData = $this->getRequest()->getPost('category');   
            if(!array_key_exists('status',$categoryData)){
                     $categoryData['status']=0;
                 }					
             else{
                    $categoryData['status']=1;
            }
            $category->setData($categoryData);  
            
            $category->Save();

            if (!$category->parentId) {
                $pathId = $category->categoryId;  
            }
            else
            {   
                $parent = \Mage::getModel('model\categoryModel')->load($category->parentId);
                if (!$parent) {
                    throw new \Exception("Unable to load parent");
                } 
                $pathId = $parent->pathId."=".$category->categoryId;
            }
            $category->pathId = $pathId;
            $category->save(); 
            $category->updateChildernPathIds($pathId, $parentId = null);

            // if(!$this->getRequest()->isPost())
            // {
            //     throw new Exception("Invalid Post Request");
            // }
            // $category = \Mage::getModel("Model\categoryModel");
            // $categoryId =$this->getRequest()->getGet('id');
            // if ($categoryId) {
            //     $category =  $category->load($categoryId);
            //     if (!$category) {
            //         throw new Exception("Data Not Found");
            //     }
            //     $this->getMessage()->setSuccess("Category Updated SuccessFully !!"); 
            // } 
            // else{
            //    $this->getMessage()->setSuccess("Category Inserted SuccessFully !!"); 
            // }  
            
            // $categoryData = $this->getRequest()->getPost('category');
            
            // if(!array_key_exists('status',$categoryData)){
            //     $categoryData['status']=0;
            // }					
            // else{
            //     $categoryData['status']=1;
            // }
            
            
            // $category->setData($categoryData);  
            // $data = $category->save();
            // $category->parentId =$data->getAdapter()->getConnect()->insert_id;
            
            // if(!$category->parentId){
            //     $pathId = $category->categoryId;
            // }
            // else{
            //     $parent = \Mage::getModel("model\categoryModel")->load($category->parentId);
            //     if(!$parent)
            //     {
            //         throw new Exception("Unable To Load Parent.", 1);   
            //     }
                
            //     $pathId = $parent->pathId."=".$parent->categoryId;
                       
            // }
            
            // $category->pathId = $pathId;
            // $category->save();
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->setFailure($e->getMessage()); 
        
        }          
        $this->redirect('grid',null,null,true);
    }
	public function changeStatusAction(){
		try {

			$id = $this->getRequest()->getGet('id');
			$st = $this->getRequest()->getGet('status');
			$model = \Mage::getModel('model\categoryModel');
			$model->id =$id;
			$model->status = $st;
			$model->changeStatus();
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Status Changed Successfully"); 
            }
            
		} catch (Exception $e) {
			$this->getMessage()->setSuccess($e->getMessage());
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
			$delModel = \Mage::getModel('model\categoryModel');
			$delModel->id = $id;
			$delModel->delete();
            $delModel->delete();
            if($delModel->delete()){
                $this->getMessage()->setSuccess("Category Deleted SuccessFully !!"); 
            }else{
                $this->getMessage()->setFailure("Unable to Delete Category!!"); 
            }
			
		} catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage()); 
			
		}
        $this->redirect('grid',null,null,true);
    }
}
?>

