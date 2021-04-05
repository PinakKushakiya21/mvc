           <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 animate-dropdown top-cart-row">
               <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

               <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                       <div class="items-cart-inner">
                           <div class="basket">
                               <div class="basket-item-count"><span class="count"><?php echo $this->getNumberOfProducts(); ?></span></div>
                               <div class="total-price-basket">
                                   <span class="lbl">Shopping Cart</span>
                                   <span class="value" style="font-size: 18px;">$ <?php echo ($this->getTotal()) ? "{$this->getTotal()}" : "0"; ?></span>
                               </div>
                           </div>
                       </div>
                   </a>
                   <ul class="dropdown-menu">
                       <?php 
                       if ($this->getCartItems()) : 
                        ?>
                           <?php foreach ($this->getCartItems()->getData() as $key => $item) : ?>
                               <?php $product = $this->getProduct($item->productId); ?>
                               <li>
                                   <div class="cart-item product-summary">
                                       <div class="row">
                                           <div class="col-xs-4">
                                               <div class="image"> <a href="detail.html"><img src="./Skin/customer/assets/images/products/p4.jpg" alt=""></a> </div>
                                           </div>
                                           <div class="col-xs-7">
                                               <h3 class="name"><a href="index8a95.html?page-detail"><?php echo $product->productName; ?></a></h3>
                                               <div class="price">$<?php echo $item->price; ?></div>
                                           </div>
                                           <div class="col-xs-1 action"> <a href="<?php echo $this->getUrl()->getUrl('delete', 'admin\cart', ['id' => $item->cartitemId], false); ?>"><i class="fa fa-trash"></i></a> </div>
                                       </div>
                                   </div>
                                   <hr>
                               </li>
                           <?php endforeach; ?>
                       <?php endif; ?>


                       <li>
                           <div class="clearfix"></div>
                           <!-- /.cart-total-->
                           <div class="clearfix cart-total">
                               <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$ <?php echo ($this->getTotal()) ? "{$this->getTotal()}" : "0"; ?></span> </div>
                               <div class="clearfix"></div>
                               <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                           </div>
                       </li>
                   </ul>
                   <!-- /.dropdown-menu-->
               </div>
               <!-- /.dropdown-cart -->

               <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
           </div>