<div class="text-center">
    <h1>Cart Items</h1>
</div>
<?php
$cartProducts = $productCart->getCartProducts();
?>
<?php if (count($cartProducts) > 0) { ?>
    <div>
        <table class="product-cart-table">
            <tbody>
            <tr>
                <th>Name</th>
                <th>SKU</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            $totalPrice = 0;
            foreach ($cartProducts as $item) {
                $totalPrice += $item['price'];
                ?>
                <tr>
                    <td><?php echo $item['product_name'] ?></td>
                    <td><?php echo $item['sku'] ?></td>
                    <td><?php echo $item['quantity'] ?></td>
                    <td>
                        <?php echo $item['currency'] ?>
                        <?php echo $item['price'] ?>
                    </td>
                    <td>
                        <form id="remove_<?php echo $item['product_id'] ?>" action="includes/AddToCartProcess.php"
                              method="post">
                            <input type="hidden" name="action" value="remove_from_cart">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id'] ?>"/>
                            <button class="btn">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="5" class="text-right pr-10">
                  <h2>  <b>Total:
                        <?php echo $item['currency'] ?>
                        <?php echo $totalPrice; ?>
                    </b>
                  </h2>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div>
        <span class="text-red ">The cart is empty.</span>
    </div>
<?php } ?>
