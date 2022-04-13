<?php
foreach ($product->getProductList() as $product) { ?>
    <form id="add_id=<?php echo $product['product_id'] ?>" action="includes/AddToCartProcess.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?> ">
        <input type="hidden" name="action" value="add_to_cart">
        <div class="product">
            <div class="text-left">
                <span>Name: <?php echo $product['product_sku'] ?></span>
            </div>
            <div class="text-left">
                <span>
                    Price:
                    <?php echo $product['currency_symbol'] ?>
                    <?php echo $product['product_price'] ?>
                </span>
            </div>
            <?php if (isset($productSpecialOffer[$product['product_id']])) {
                foreach ($productSpecialOffer[$product['product_id']] as $productOffer) {
                    ?>
                    <div class="text-left">
                    <span>
                        <?php echo $productOffer['product_special_offer_type_name'] ?> :
                        <?php echo $productOffer['product_quantity'] ?> for
                        <?php echo $product['currency_symbol'] ?>
                        <?php echo $productOffer['discount_product_price'] ?>
                    </span>
                    </div>
                <?php }
            } ?>
            <div class="text-left">
                Quantity: <input type="text" name="quantity" class="form-control" value="1"
                                 onkeypress="return isNumber()">
            </div>
            <div class="text-center">
                <button class="btn position-absolute" type="submit">
                    Add to Cart
                </button>
            </div>
        </div>
    </form>
<?php } ?>
