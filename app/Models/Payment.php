<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = ['payment_type_id', 'currency_id','amount', 'type', 'feedback'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'payment_type_id' => 'required',
        'currency_id' => 'required',
        'amount' => 'required',
        'type' => 'required',
    ];
    protected $validationMessages   = [
        'payment_type_id' => [
            'required' => 'Payment type is required'
        ],
        'currency_id' => [
            'required' => 'Currency is required'
        ],
        'amount' => [
            'required' => 'Amount is required'
        ],
        'type' => [
            'required' => 'Type is required'
        ],
    ];
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
}
