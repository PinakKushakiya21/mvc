<?php echo $this->createBlock('Block\Home\Header')->toHtml(); ?>

<div class="body-content outer-top-vs" id="top-banner-and-menu">
    <div class="container">

        <!-- Product Start -->
        <?php echo $this->createBlock('Block\Home\SingleProduct')->toHtml(); ?>


        <?php echo $this->createBlock('Block\Home\Brand')->toHtml(); ?>

    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
<?php echo $this->createBlock('Block\Home\Footer')->toHtml(); ?>