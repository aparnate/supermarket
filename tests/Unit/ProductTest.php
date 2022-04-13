<?php

use PHPUnit\Framework\TestCase;

require_once(dirname(__DIR__).'/../includes/Products.php');

class ProductTest extends Testcase
{
    public Products $products;

    protected function setUp(): void
    {
        $this->products = new Products();
    }

    public function test_getProductList_method()
    {
        $result = $this->products->getProductList();
        $this->assertCount(8, $result);
        $this->assertEquals(1, $result[0]['product_id']);
        $this->assertEquals('A', $result[0]['product_name']);
        $this->assertEquals(100.00, $result[0]['product_price']);
        $this->assertEquals('A', $result[0]['product_sku']);
    }

    public function test_getProductSpecialOffers_by_product_method()
    {
        $result = $this->products->getProductSpecialOffers();
        $this->assertCount(2, $result);
        $this->assertEquals(1, $result[1][0]['product_id_FK']);
        $this->assertEquals(1, $result[1][0]['product_quantity']);
        $this->assertEquals(95.00, $result[1][0]['discount_product_price']);
    }

    public function test_getSpecialOfferByProductId_method()
    {
        $result = $this->products->getSpecialOfferByProductId(2);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);

        $this->assertEquals(2, $result[0]['product_id_FK']);
        $this->assertEquals(4, $result[0]['product_quantity']);
        $this->assertEquals(400.00, $result[0]['discount_product_price']);

        $this->assertEquals(2, $result[1]['product_id_FK']);
        $this->assertEquals(2, $result[1]['product_quantity']);
        $this->assertEquals(300.00, $result[1]['discount_product_price']);
    }

    public function test_getDetailsByProductId_method()
    {
        $result = $this->products->getDetailsByProductId(1);
        $this->assertNotEmpty($result);
        $this->assertEquals(1, $result['product_id']);
        $this->assertEquals('A', $result['product_name']);
        $this->assertEquals(100.00, $result['product_price']);
        $this->assertEquals('A', $result['product_sku']);
    }
}