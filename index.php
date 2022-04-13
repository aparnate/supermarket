<HTML>

<HEAD>
    <TITLE>Virtusa Super Market</TITLE>
    <link href="public/app.css" type="text/css" rel="stylesheet"/>
    <script src="public/app.js"></script>

</HEAD>

<body>
<div class="container">
    <div class="header">
        <div class="text-center site-header">
            <h1>Virtusa Supermarket</h1>
        </div>
    </div>
    <?php

    require_once 'includes/Products.php';
    require_once 'includes/ProductCart.php';
    $product = new Products();
    $productSpecialOffer = $product->getProductSpecialOffers();
    $productCart = new ProductCart($product);
    //session_destroy();
    ?>
    <div class="product-cart">
        <?php include "views/CartItems.php"; ?>
    </div>
    <div>
        <hr>
    </div>
    <div class="text-center">
        <h1>Product List</h1>
    </div>
    <div class="product_lists">
        <?php include "views/ProductList.php"; ?>
    </div>
</div>
</body>

</HTML>