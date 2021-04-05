<?php $pager = $this->pagination()->getPager(); ?>
<!-- for pagination -->
<div class="row">
    <div class="input-field col s12">

        <?php foreach ($this->getButtons() as $key => $button) : ?>
        <!--add-->

        <div class="input-field col s12">
            <a href="<?php echo $this->getButtonUrl($button['method']); /*$this->getUrl()->getUrl('form')*/?>"
                class="btn btn-primary pink" name="update">Add configGroup
            </a>
        </div>

        <?php endforeach; ?>

        <!-- <a href="<?php //echo $this->getUrl()->getUrl('form'); ?>" class="btn btn-primary pink" name="update">Add Attribute -->

        </a>
    </div>
</div>
<div class="container-fluid">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">ConfigGroup Details</h4>
            <p class="card-text">
            <table class="highlight">
                <thead>
                    <tr>

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
                                    <input type="text" class="form-control" id="<?php echo $filterColumn['field']; ?>"
                                        name="filter[<?php echo $filterColumn['type']; ?>][<?php echo $filterColumn['field']; ?>]"
                                        value="<?php echo $this->getFilter()->getFilterValue($filterColumn['type'], $filterColumn['field']); ?>">
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
            $data = $this->getPaginationConfigGroups();  // line add for pagination
                // $data =$this->getAttributes();
                if($data == ""):
                    echo '<p class=text-center><strong>No Record Found</strong><p>';    
                else:?>
                    <?php foreach ($data->getData() as $key => $value):
                    //print_r($record);
            ?>

                    <tr>
                        <?php foreach ($this->getColumns() as $column) : ?>
                        <th><?php echo $this->getFieldValue($value, $column['field']); ?></th>
                        <?php endforeach; ?>
                        <?php foreach ($this->getActions() as $action) : ?>
                        <th>
                            <a href="<?php echo $this->getMethodUrl($value, $action['method']); ?>">
                                <?php echo $action['label']; ?>
                            </a>
                        </th>
                        <?php endforeach; ?>
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