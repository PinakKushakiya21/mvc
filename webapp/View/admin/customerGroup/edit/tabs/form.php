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
<form action="<?php echo $this->getUrl()->getUrl('save');?>" method="post">
    <?php $customerGroup = $this->getCustomerGroup();
    ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Customer Group Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Customer Group Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="categoryname" name="customerGroup[name]" value="<?php echo $customerGroup->name ?>" type="text" class="validate">
                    <label for="categoryname">Group Name</label>
                    </div>
                    <div class="input-field col s6">
                    <div class="switch">
                            <label>
                            Disabled
                            <?php if($customerGroup->status):
                                      $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='customerGroup[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                    </div>
                </div>
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn btn-primary" type="submit" name="add">Add Customer Group
                    
                </button>
                <?php else: ?>
                  <button class="btn btn-warning" type="submit" name="add">Update Customer Group
                    
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