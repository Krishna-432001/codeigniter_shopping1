<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Milk',
                'price'         => 100.00,
                'category_id'   => 1, // Make sure this category exists
                'brand_id'      => 1, // Make sure this brand exists
                'qty'           => 50,
                'alert_stock'   => 10,
                'image_path'    => 'images/products/milk.webp',
                'description'   => 'Description for Milk ',
            ],
            [
                'name'          => 'Mobile',
                'price'         => 150.50,
                'category_id'   => 2, // Make sure this category exists
                'brand_id'      => 2, // Make sure this brand exists
                'qty'           => 30,
                'alert_stock'   => 5,
                'image_path'    => 'images/products/mobile.jfif',
                'description'   => 'Description for Mobile',
            ],
            [
                'name'          => 'labtop ',
                'price'         => 75.00,
                'category_id'   => 3, // Make sure this category exists
                'brand_id'      => 3, // Make sure this brand exists
                'qty'           => 100,
                'alert_stock'   => 20,
                'image_path'    => 'images/products/labtop.webp',
                'description'   => 'Description for labtop ',
            ],
            [
                'name'          => 'vegitable',
                'price'         => 200.00,
                'category_id'   => 4, // Make sure this category exists
                'brand_id'      => 4, // Make sure this brand exists
                'qty'           => 10,
                'alert_stock'   => 2,
                'image_path'    => 'images/products/vegitable.webp',
                'description'   => 'Description for vegitable',
            ],
        ];

        // Using Query Builder to insert data
        $this->db->table('products')->insertBatch($data);
    }
}
