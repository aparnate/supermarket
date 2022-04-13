<?php
require_once(dirname(__DIR__).'/includes/Queries.php');

class Products extends Queries
{
    public function getProductList(): array
    {
        $sql = "SELECT * FROM products as p left join currency as c on p.currency_id_FK = c.currency_id";
        return $this->getResult($sql);
    }

    public function getProductSpecialOffers(): array
    {
        $sql = "SELECT * FROM product_special_offer as spo join product_special_offer_type as spot on spo.product_special_offer_type_id_FK=spot.product_special_offer_type_id";
        $result = $this->getResult($sql);
        $records = [];
        foreach ($result as $row) {
            $records[$row['product_id_FK']][] = $row;
        }
        return $records;
    }

    public function getSpecialOfferByProductId(int $productId): array
    {
        $sql = "SELECT * FROM product_special_offer where product_id_FK=".$productId.' order by product_quantity DESC';
        return $this->getResult($sql);
    }

    public function getDetailsByProductId(int $productId): array
    {
        $sql = "SELECT * FROM products as p left join currency as c on p.currency_id_FK = c.currency_id where product_id=".$productId;
        return $this->getSingleRecord($sql);
    }
}