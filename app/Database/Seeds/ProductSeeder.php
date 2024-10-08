<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Product A',
                'price'         => 100.00,
                'category_id'   => 1, // Make sure this category exists
                'brand_id'      => 1, // Make sure this brand exists
                'qty'           => 50,
                'alert_stock'   => 10,
                'image_path'    => 'path/to/image_a.jpg',
                'description'   => 'Description for Product A',
            ],
            [
                'name'          => 'Product B',
                'price'         => 150.50,
                'category_id'   => 2, // Make sure this category exists
                'brand_id'      => 2, // Make sure this brand exists
                'qty'           => 30,
                'alert_stock'   => 5,
                'image_path'    => 'path/to/image_b.jpg',
                'description'   => 'Description for Product B',
            ],
            [
                'name'          => 'Product C',
                'price'         => 75.00,
                'category_id'   => 3, // Make sure this category exists
                'brand_id'      => 3, // Make sure this brand exists
                'qty'           => 100,
                'alert_stock'   => 20,
                'image_path'    => 'path/to/image_c.jpg',
                'description'   => 'Description for Product C',
            ],
            [
                'name'          => 'Product D',
                'price'         => 200.00,
                'category_id'   => 4, // Make sure this category exists
                'brand_id'      => 4, // Make sure this brand exists
                'qty'           => 10,
                'alert_stock'   => 2,
                'image_path'    => 'path/to/image_d.jpg',
                'description'   => 'Description for Product D',
            ],
        ];

        // Using Query Builder to insert data
        $this->db->table('products')->insertBatch($data);
    }
}
