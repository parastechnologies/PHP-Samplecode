<?php

namespace App\Models;

use CodeIgniter\Model;

class BusinessStaffAccountModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_businessStaffAccount';
    protected $primaryKey       = 'SID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['SID','BID','userID','name','email','phoneNumber','phoneCode','designation','profileImage','qrCode','profileLink','status','countryCode','isDelete','createdDate','updatedDate'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdDate';
    protected $updatedField  = 'updatedDate';
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
}
