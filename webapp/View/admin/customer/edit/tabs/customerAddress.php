
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
    <form action="<?php echo $this->getUrl()->getUrl('address','customer'); ?>" method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6">
            <?php  
                    $id = $this->getRequest()->getGet('id');
                    $billingData = $this->getAddressData($id,'Billing');
                    $shippingData = $this->getAddressData($id,'Shipping');
            ?>   
            <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title">
                <p class="h2 text-center">Billing Address</p><br>
                </h4>
                <p class="card-text">
                
                <div class="row">
                        <div class="input-field col s6">
                                <input id="address" name="billing[address]" value="<?php echo $billingData->address ?>"  type="text" class="validate">
                                <label for="address">Address</label>
                        </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <div class="row">
                    <div class="input-field col s6">
                        <select class="browser-default" name="billing[city]">
                            <option value="<?php echo $billingData->city ?>" selected><?php echo $billingData->city ?></option>
                            <option value="Vapi">Vapi</option>
                            <option value="Surat">Surat</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="billing[state]">
                            <option value="<?php echo $billingData->state ?>" selected><?php echo $billingData->state ?></option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Punjab">Punjab</option>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                        <input id="zip" name="billing[zipcode]" class="validate" value="<?php echo $billingData->zipcode ?>">
                        <label for="zip">Zipcode</label>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="billing[country]">
                            <option value="<?php echo $billingData->country ?>" selected><?php echo $billingData->country ?></option>
                            <option value="India">India</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                        </select>
                        </div>
                        
                    </div>
                    </div>
                    
                    </div>
                    
                    </div>
                </div>  
            </p>
          </div>
          <div class="col-lg-6 col-md-6">
                
            <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title">
                <p class="h2 text-center">Shipping Address</p><br>
                </h4>
                <p class="card-text">
                
                <div class="row">
                        <div class="input-field col s6">
                                <input id="contact" name="shipping[address]" value="<?php echo $shippingData->address ?>"  type="text" class="validate">
                                <label for="contact">Address</label>
                        </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                        <select class="browser-default" name="shipping[city]">
                            <option value="<?php echo $shippingData->city ?>" selected><?php echo $shippingData->city ?></option>
                            <option value="Vapi">Vapi</option>
                            <option value="Surat">Surat</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="shipping[state]">
                            <option value="<?php echo $shippingData->state ?>" selected><?php echo $shippingData->state ?></option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Punjab">Punjab</option>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                        <input id="zipcode" name="shipping[zipcode]" class="validate" value="<?php echo $shippingData->zipcode ?>" >
                        <label for="zipcode">Zipcode</label>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="shipping[country]">
                            <option value="<?php echo $shippingData->country ?>" selected><?php echo $shippingData->country ?></option>
                            <option value="India">India</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                        </select>
                        </div>
                        
                    </div>
                    </div>
                    
                    </div>
                    </div>
                </div>  
            </p>
          </div>
        </div>
        <div class="text-center">
        <button class="btn btn-primary" type="submit" name="add">Save
                        
                    </button>
                    <button class="btn btn-danger" type="reset" name="cancel">Cancel
                        
        </button>
        </div>
                    
    </div>  
    </div>
    </div>
    
    </form>
 
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
