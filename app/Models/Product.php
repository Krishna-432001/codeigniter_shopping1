<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [  'name',
                                    'price',
                                    'category_id',
                                    'brand_id',
                                    'qty',
                                    'alert_stock',
                                    'image_path',
                                    'description'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getCategory($categoryId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('categories');
        return $builder->getWhere(['id' => $categoryId])->getRow();
    }

    // Fetch brand relation
    public function getBrand($brandId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('brands');
        return $builder->getWhere(['id' => $brandId])->getRow();
    }
    
    // Get Image Path with Domain URL
    public function getImagePath($imagePath)
    {
        return getenv('DOMAIN_URL') . '/uploads/' . $imagePath;
    }
}
