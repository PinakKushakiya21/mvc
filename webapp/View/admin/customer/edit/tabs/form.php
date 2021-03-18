
<!doctype html>
<html lang="en">
  <head>
    <title>Add Customer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"> </script> 
  
  </head>
  <body>
    <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">
        <?php $customer = $this->getCustomer(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
        <p class="h2 text-center">Update Customer Details</p><br>
        <?php else: ?>
            <p class="h2 text-center">Add Customer Details</p><br>
        <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="fname" name="customer[firstName]" value="<?php echo $customer->firstName ?>" type="text" class="validate">
                    <label for="fname">First Name</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="lname" name="customer[lastName]" value="<?php echo $customer->lastName ?>" type="text" class="validate">
                    <label for="lname">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                    <input id="email" name="customer[email]" value="<?php echo $customer->email ?>" type="email" class="validate">
                    <label for="email">Email</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="pass" name="customer[password]" value="<?php echo $customer->password ?>" type="password" class="validate">
                    <label for="pass">Password</label>
                    </div>
                    
                </div>
                <div class="row">
                        <div class="input-field col s6">
                            <input id="contact" name="customer[contactNo]" value="<?php echo $customer->contactNo ?>" type="text" maxlegth="10" class="validate">
                            <label for="contact">Contact No</label>
                        </div>
                        <div class="input-field col s6">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($customer->status):
                                    $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='customer[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                    <select class="browser-default" name="customer[group_id]">
                    <?php if($this->getRequest()->getGet('id')) :?>
                      <option value="<?php echo $customer->group_id ;?>"><?php echo $this->getSelectedGroup($customer->group_id); ?></option>
                      <?php else: ?>
                      <option value="" disabled selected>Please Choose Group Name</option>
                      <?php endif; ?>
                      <?php
                            $groupNames = $this->getGroupName();
                            foreach ($groupNames->getData() as $key => $value):
                      ?>
                          <option value="<?php echo $value->group_id ?>"><?php echo $value->name ?></option>
                    <?php  endforeach; ?>                     
                    </select>
                    </div> 
                </div>
                
                <?php if(!$this->getRequest()->getGet('id')): ?>
                <button class="btn btn-primary" type="submit" name="add">Add Customer
                    
                </button>
                <?php else: ?>
                  <button class="btn btn-warning" type="submit" name="add">Update Customer
                    
                </button>
                <?php endif; ?>
                <button class="btn btn-danger" type="reset" name="cancel">Cancel
                    
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