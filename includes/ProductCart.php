<?php

class ProductCart
{
    public Products $products;

    public function __construct(products $products)
    {
        session_start();
        $this->products = $products;
    }

    public function addProductToCart(int $productId, int $quantity): array
    {
        $productCartItems = $this->getCartProducts();
        if (isset($productCartItems[$productId])) {
            $quantity += $productCartItems[$productId]['quantity'];
        }

        $productDetails = $this->products->getDetailsByProductId($productId);
        $specialOffer = $this->products->getSpecialOfferByProductId($productId);
        $productCartItems[$productId] = [
            'product_id' => $productDetails['product_id'],
            'product_name' => $productDetails['product_name'],
            'sku' => $productDetails['product_sku'],
            'price' => $this->getProductPrice($productDetails, $specialOffer, $quantity),
            'quantity' => $quantity,
            'currency' => $productDetails['currency_symbol']
        ];
        $_SESSION['cart_product'] = $productCartItems;
        return $productCartItems;
    }

    public function removeFromCart(int $productId): void
    {

        $allProducts = $this->getCartProducts();
        unset($allProducts[$productId]);
        $_SESSION['cart_product'] = $allProducts;
    }

    public function getCartProducts(): array
    {
        return $_SESSION['cart_product'] ?? [];
    }

    public function getProductPrice(array $productDetails, array $specialOffers, int $quantity, float $price = 0)
    {
        if ($this->isProductHasSpecialPrice($specialOffers, $quantity)) {
            return $this->getProductSpecialPrice($productDetails, $specialOffers, $quantity, $price);
        }
        return $quantity * $productDetails['product_price'];
    }

    public function isProductHasSpecialPrice(array $specialOffers, int $quantity)
    {
        $hasSpecialOffer = false;
        if (count($specialOffers) == 0) {
            return $hasSpecialOffer;
        }
        foreach ($specialOffers as $specialOffer) {
            if ($quantity >= $specialOffer['product_quantity']) {
                $hasSpecialOffer = true;
            }
        }
        return $hasSpecialOffer;

    }

    public function getProductSpecialPrice(array $productDetails, array $specialOffers, int $quantity, float $price = 0): float
    {
        foreach ($specialOffers as $specialOffer) {
            $price += ((int)($quantity / $specialOffer['product_quantity'])) * $specialOffer['discount_product_price'];
            $quantity = $quantity % $specialOffer['product_quantity'];
        }
        if ($quantity > 0) {
            if ($this->isProductHasSpecialPrice($specialOffers,$quantity)) {
                return $this->getProductSpecialPrice($productDetails, $specialOffers, $quantity, $price);
            } else {
                return $price += ($quantity * $productDetails['product_price']);
            }
        }

        return $price;
    }
}