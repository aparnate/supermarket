<?php
require_once(dirname(__DIR__).'/includes/ProductCart.php');
require_once(dirname(__DIR__).'/includes/Products.php');

$productCart = new ProductCart(new Products());
if ($_POST['action']) {

    switch ($_POST['action']) {
        case 'add_to_cart':
            $quantity = (empty($_POST['quantity']) || $_POST['quantity'] == 0) ? 1 : $_POST['quantity'];
            $productCart->addProductToCart($_POST['product_id'], $quantity);
            break;
        case 'remove_from_cart':
            $productCart->removeFromCart($_POST['product_id']);
            break;
        default:
            header("Location: ../index.php");
    }
}

header("Location: ../index.php");
die();