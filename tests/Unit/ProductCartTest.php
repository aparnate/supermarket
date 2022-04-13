<?php

use PHPUnit\Framework\TestCase;

require_once(dirname(__DIR__).'/../includes/ProductCart.php');
require_once(dirname(__DIR__).'/../includes/Products.php');

class ProductCartTest extends Testcase
{
    public Products $products;

    protected function setUp(): void
    {
        $this->products = new Products();
    }

    public function test_get_cart_products()
    {
        $service = $this->createMock(ProductCart::class);
        $service
            ->expects(self::once())
            ->method('getCartProducts')
            ->willReturn([]);

        $this->assertEmpty($service->getCartProducts());
    }

    public function test_get_product_price__single_product()
    {
        $productDetails = $this->products->getDetailsByProductId(1);
        $specialOffer = $this->products->getSpecialOfferByProductId(1);

        $service = $this->createMock(ProductCart::class);
        $service
            ->expects(self::once())
            ->method('getProductPrice')
            ->willReturn(95.00);
        $price = $service->getProductPrice($productDetails, $specialOffer, 1);
        $this->assertIsFloat($price);
        $this->assertEquals(95.00, $price);
    }

    public function test_get_product_price__multiple_product()
    {
        $productDetails = $this->products->getDetailsByProductId(2);
        $specialOffer = $this->products->getSpecialOfferByProductId(2);

        $service = $this->createMock(ProductCart::class);
        $service
            ->expects(self::once())
            ->method('getProductPrice')
            ->willReturn(400);
        $price = $service->getProductPrice($productDetails, $specialOffer, 4);
        $this->assertEquals(400, $price);
    }
}