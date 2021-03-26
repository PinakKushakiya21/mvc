<?php $pager = $this->pagination()->getPager(); ?>
<!-- for pagination -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="row">

        <?php foreach ($this->getButtons() as $key => $button) : ?>
        <!--add-->

        <div class="input-field col s12">
            <a href="<?php echo $this->getButtonUrl($button['method']); /*$this->getUrl()->getUrl('form')*/?>"
                class="btn btn-primary pink" name="update">Add Admin
            </a>
        </div>

        <?php endforeach; ?>
        <!--add -->

    </div>
    <div class="container-fluid">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title"><?php echo $this->getTitle();?></h4>
                <p class="card-text">
                <table class="highlight">
                    <thead>
                        <tr>
                            <!-- <th>Admin Name</th>
                                <th>Admin Status</th>
                                <th>Created Date</th> -->
                            <?php foreach ($this->getColumns() as $key => $column) : ?>
                            <th><?php echo $column['label']; ?></th>
                            <?php endforeach; ?>
                            <th colspan="3">Action</th>
                        </tr>
                        <tr>
                            <form action="<?php echo $this->getUrl()->getUrl('filter'); ?>" method="POST">
                                <?php foreach ($this->getColumns() as $filterColumn) : ?>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" id="<?php echo $filterColumn['field']; ?>" name="filter[<?php echo $filterColumn['type']; ?>][<?php echo $filterColumn['field']; ?>]" value="<?php echo $this->getFilter()->getFilterValue($filterColumn['type'], $filterColumn['field']); ?>">
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </td>
                            </form>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = $this->getPaginationAdmins();  // line add for pagination
                //$data = $this->getAdmin();
                if($data == ""):
                    echo '<p class=text-center><strong>No Record Found</strong><p>';    
                else: ?>
                     <?php foreach($data->getData() as $record): ?>
                        
                        <tr>
                                    <?php foreach ($this->getColumns() as $column) : ?>
                                        <th><?php echo $this->getFieldValue($record, $column['field']); ?></th>
                                    <?php endforeach; ?>
                                    <?php foreach ($this->getActions() as $action) : ?>
                                        <th>
                                            <a href="<?php echo $this->getMethodUrl($record, $action['method']); ?>">
                                                <?php echo $action['label']; ?>
                                            </a>
                                        </th>
                            <?php endforeach; ?>
                        </tr>
            <?php /*
                        <tr id="txtData">
                            <td><?php echo $record->adminName ?></td>
                            <td><?php 
                        if($record->status):
                            echo 'Enabled';
                        else:
                            echo 'Disabled';
                        endif;
                                ?>
                            </td>
                            <td><?php echo $record->createdDate ?></td>
                            <th>
                                <a href="<?php echo $this->getUrl()->getUrl('changeStatus',NULL,['id'=>$record->adminId,'status'=>$record->status],true);?>"
                                    class="btn btn-secondary orange">

                                    <?php
                                if($record->status == 1):
                                    echo "Enabled";
                                else:
                                    echo "Disabled";
                                endif;
                            ?>

                                </a>
                            </th>
                            <th><a href="<?php echo $this->getUrl()->getUrl('form',NULL,['id'=>$record->adminId]); ?>"
                                    class="btn btn-warning yellow">edit</a></th>
                            <th><a href="<?php echo $this->getUrl()->getUrl('delete',NULL,['id'=>$record->adminId]); ?>"
                                    class="btn btn-danger red">delete</a></th>

                        </tr> 
                    */ ?>
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
                            <a class="page-link orange text-white"
                                href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getPrevious()], true); ?>">Previous</a>
                        </li>

                        <?php foreach (range($pager->getStart(), $pager->getNoOfPages()) as $value) : ?>
                        <li
                            class="page-item <?php echo ($this->getRequest()->getGet('page') == $value) ? 'active' : ''; ?>">
                            <a class="page-link"
                                href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $value], true); ?>"><?php echo $value; ?></a>
                        </li>
                        <?php endforeach; ?>

                        <li class="page-item <?php echo (!$pager->getNext()) ? 'disabled' : ''; ?>">
                            <a class="page-link orange text-white"
                                href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getNext()], true); ?>">Next</a>
                        </li>
                    </ul>
                </div>


            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>