<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save', 'admin\configGroup\config'); ?>" method="post">
                            <p class="h2 text-center">Add/Update Config Details</p><br>
                    <div class="row">
                        <div class="form-group col-md-9">
                        </div>
                        <div class="form-group col-md-3">
                        <button class="btn waves-effect waves-light" type="button" name="add" onclick="addConfig();">Add&nbsp;Config
                            <i class="material-icons right">add</i>
                        </button>
                        </div>
                    </div>

                    <?php $config = $this->getConfig();
                    ?>

                    <div class="row" id="existingOption">
                        <?php if ($config) : ?>
                            <?php foreach ($config->getData() as $key => $value) : ?>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-5">
                                        <label for="name<?php echo $value->configId; ?>">Config Name</label>
                                        <input id="name<?php echo $value->configId; ?>" name="existing[<?php echo $value->configId; ?>][title]" value="<?php echo $value->title ?>" type="text" class="validate" require>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="name<?php echo $value->configId; ?>">Config Code</label>
                                        <input id="name<?php echo $value->configId; ?>" name="existing[<?php echo $value->configId; ?>][code]" value="<?php echo $value->code ?>" type="text" class="validate" require>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="name<?php echo $value->configId; ?>">Config Value</label>
                                        <input id="name<?php echo $value->configId; ?>" name="existing[<?php echo $value->configId; ?>][value]" value="<?php echo $value->value ?>" type="text" class="validate" require>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="remove">&nbsp;</label>
                                        <a href="<?php echo $this->getUrl()->getUrl('delete', 'admin\configGroup\config') . "&configId={$value->configId}"; ?>" class="btn waves-effect waves-light red" >Delete
                                            <i class="material-icons black">trash</i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="btn waves-effect waves-light text-dark yellow" type="submit" name="add">Update Config
                        <i class="material-icons right">edit</i>
                    </button>
            </form>

        </div>
    </div>
</div>

<div style="display: none;" id="newOption">
    <div class="row col-md-12">
        <div class="form-group col-md-5">
            <label for="name">Config Title</label>
            <input id="name" name="new[title][]" type="text" class="validate form-control" require>
        </div>

        <div class="form-group col-md-5">
            <label for="name">Config Code</label>
            <input id="name" name="new[code][]" type="text" class="validate form-control" require>
        </div>

        <div class="form-group col-md-5">
            <label for="name">Config Value</label>
            <input id="name" name="new[value][]" type="text" class="validate form-control" require>
        </div>

        <div class="form-group col-md-3">
            <label for="remove">&nbsp;</label>
            <button class="btn waves-effect waves-light red" type="button" onclick="removeConfig(this);" name="add">Delete
                    <i class="material-icons right">trash</i>
            </button>
        </div>
    </div>
</div>

<script>
    function removeConfig(removeButton) {
        var option = removeButton.parentElement.parentElement.remove();
    }

    function addConfig() {
        var existingOption = document.getElementById('existingOption');
        var newOption = document.getElementById('newOption').children[0];
        existingOption.prepend(newOption.cloneNode(true));
    }
</script>

