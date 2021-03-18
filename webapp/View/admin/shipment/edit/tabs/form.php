<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
<form  action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">
<?php $shipment =$this->getShipment(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Shipment Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Shipment Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="productname" name="shipment[name]" value="<?php echo $shipment->name ?>" type="text" class="validate">
                    <label for="productname">Name</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="productname" name="shipment[code]" value="<?php echo $shipment->code ?>" type="text" class="validate">
                    <label for="productname">Code</label>
                    </div>
                </div>
                <div class="row">
                        <div class="input-field col s12">
                        <textarea id="desc" name="shipment[description]" class="materialize-textarea"><?php echo $shipment->description ?></textarea>
                        <label for="desc">Description</label>
                        </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                    <input id="productname" name="shipment[amount]" value="<?php echo $shipment->amount ?>"  type="text" class="validate">
                    <label for="productname">Amount</label>
                    </div>
                        <div class="input-field col s12">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($shipment->status) {
                                    $label = 'checked'; 
                                    }else{
                                        $label = '!checked';  
                                    }
                                ?>
                            <input name='shipment[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn btn-primary" type="submit" name="add">Add Shipment
                    
                </button>
                <?php else: ?>
                  <button class="btn btn-primary" type="submit" name="add">Update Shipment
                    
                </button>
                <?php endif; ?>
                <button class="btn btn-primary" type="reset" name="cancel">Cancel
                    
                </button>
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
    </form>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>