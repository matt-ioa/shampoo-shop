<?php

declare(strict_types=1);


namespace App\Models;


use PDO;

class ShampooModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getShampoos(): array
    {
        $query = $this->db->prepare(
            'SELECT `brand`, `variant`, `hair_type`, `size`, `scent`, `ingredient`, `price`
            FROM `shampoos`'
        );
        $query->execute();
        return $query->fetchAll();
    }

    public function getShampoo(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT `brand`, `variant`, `hair_type`, `size`, `scent`, `ingredient`, `price`
            FROM `shampoos` WHERE `id` = :id'
        );
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function addShampoo(array $shampoo): void
    {
        $query = $this->db->prepare(
            'INSERT INTO `shampoos` (`brand`, `variant`, `scent`, `hair_type`, `price`)
            VALUES (:brand, :variant, :scent, :hair_type, :price)'
        );

        $query->bindParam(':brand', $shampoo['brand']);
        $query->bindParam(':variant', $shampoo['variant']);
        $query->bindParam(':scent', $shampoo['scent']);
        $query->bindParam(':hair_type', $shampoo['hair_type']);
        $query->bindParam(':price', $shampoo['price']);
        $query->execute();
    }


}