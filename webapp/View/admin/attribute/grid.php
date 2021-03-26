<?php $pager = $this->pagination()->getPager(); ?> <!-- for pagination -->
    <div class="row">
         <div class="input-field col s12">
         <a href="<?php echo $this->getUrl()->getUrl('form'); ?>" class="btn btn-primary pink" name="update">Add Attribute
                    
        </a>                    
        </div>
   </div>
    <div class="container-fluid">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">Attribute Details</h4>
            <p class="card-text">
            <table class="highlight">
            <thead>
            <tr>
                <th>Attribute Id</th>
                <th>Entity Type ID</th>
                <th>Name</th>
                <th>Code</th>
                <th>Input Type</th>
                <th>Backend Type</th>
                <th>Sort Order</th>
                <th>Backend Model</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $data = $this->getPaginationAttributes();  // line add for pagination
                // $data =$this->getAttributes();
                if($data == ""):
                    echo '<p class=text-center><strong>No Record Found</strong><p>';    
                else:
                    foreach ($data->getData() as $key => $value):
                    //print_r($record);
            ?>
            <tr id="txtData">
                <td><?php echo $value->attributeId; ?></td>
                <td><?php echo $value->entityTypeId; ?></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->code ?></td>
                <td><?php echo $value->inputType ?></td>
                <td><?php echo $value->backendType ?></td>
                <td><?php echo $value->sortOrder ?></td>
                <td><?php echo $value->backendModel ?></td>

                <th><a href="<?php echo $this->getUrl()->getUrl('form',NULL,['id'=>$value->attributeId]); ?>" class="btn btn-warning yellow">edit</a></th>
                <th><a href="<?php echo $this->getUrl()->getUrl('delete',NULL,['id'=>$value->attributeId]); ?>" class="btn btn-danger red">delete</a></th>
            
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
    