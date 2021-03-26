<?php $pager = $this->pagination()->getPager(); ?> <!-- for pagination -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="row">
         <div class="input-field col s12">
         <a href="<?php echo $this->getUrl()->getUrl('form');?>" class="btn btn-primary pink" name="update">Add Category
                    
        </a>                    
        </div>
   </div>
    <div class="container-fluid">
  
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title"><?php echo $this->getTitle(); ?></h4>
            <p class="card-text">
            <table class="highlight">
            <thead>
            <tr>
                <th>Category Name</th>
                <th>Parent Id</th>
                <th>Path Id</th>
                <th>Status</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $data = $this->getPaginationCategories();  // line add for pagination
                //$data = $this->getCategories();
                if($data == ""):
                    echo '<p class=text-center><strong>No Record Found</strong><p>';    
                else:
                    foreach($data->getData() as $record):
            ?>
            <tr id="txtData">
                <td><?php echo $record->categoryName ?></td>
                <td><?php echo $record->parentId ?></td>
                <td><?php echo $record->pathId ?></td>
                <td><?php 
                        if($record->status):
                            echo 'Enabled';
                        else:
                            echo 'Disabled';
                        endif;
                    ?>
                </td>
                <td><?php echo $record->description ?></td>
                <th>
                    <a href="<?php echo $this->getUrl()->getUrl('changeStatus',NULL,['id'=>$record->categoryId,'status'=>$record->status],true);?>" class="btn btn-secondary orange">
                        
                            <?php
                                if($record->status == 1):
                                    echo "Enabled";
                                else:
                                    echo "Disabled";
                                endif;
                            ?>
                        
                    </a>
                </th>
                <th><a href="<?php echo $this->getUrl()->getUrl('form',NULL,['id'=>$record->categoryId]); ?>" class="btn btn-warning yellow">edit</a></th>
                <th><a href="<?php echo $this->getUrl()->getUrl('delete',NULL,['id'=>$record->categoryId]); ?>" class="btn btn-danger red">delete</a></th>
            
            </tr>
           <?php 
                endforeach;
            endif;
           ?> 
            </tbody>
        </table>
            </p>

            <div class="d-flex justify-content-center">
            <ul class="pagination pagination-lg">

                <li class="page-item <?php echo (!$pager->getPrevious()) ? 'disabled' : ''; ?>">
                    <a class="page-link orange text-white" href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getPrevious()], true); ?>">Previous</a>
                </li>

                <?php foreach (range($pager->getStart(), $pager->getNoOfPages()) as $value) : ?>
                    <li class="page-item <?php echo ($this->getRequest()->getGet('page') == $value) ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $value], true); ?>"><?php echo $value; ?></a>
                    </li>
                <?php endforeach; ?>

                <li class="page-item <?php echo (!$pager->getNext()) ? 'disabled' : ''; ?>">
                    <a class="page-link orange text-white" href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getNext()], true); ?>">Next</a>
                </li>
            </ul>
        </div>


          </div>
          
        </div>
       
    </div>  
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>