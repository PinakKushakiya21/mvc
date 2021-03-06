<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>

</head>

<body>
    <nav>
        <div class="nav-wrapper orange">
            <a href="#!" class="brand-logo" style="padding-left:20px">QuesteCom</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\configGroup', null, true) ?>">Config Group</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\brand') ?>">Brand</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\attribute') ?>">Attribute Options</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\shipment') ?>">Shipping</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\payment') ?>">Payments</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\product') ?>">Products</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\category') ?>">Categories</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\customer') ?>">Customer</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\admin') ?>">Admin</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\customergroup') ?>">Customer Group</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo $this->getUrl()->getUrl('grid', 'admin\cms') ?>">CMS Pages</a></li>
            </ul>
        </div>
    </nav>
</body>

</html>