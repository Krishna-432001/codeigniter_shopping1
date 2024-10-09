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

    // Relationship to Category
    public function getCategory()
    {
        $categoryModel = new \App\Models\Category();
        return $categoryModel->find($this->category_id); // Fetch the related category using category_id
    }

    // Relationship to Brand
    public function getBrand()
    {
        $brandModel = new \App\Models\Brand();
        return $brandModel->find($this->brand_id); // Fetch the related brand using brand_id
    }

    // Get Full Image Path with Domain URL
    public function getImagePath()
    {
        return getenv('DOMAIN_URL') . '/uploads/' . $this->image_path;
    }
}
