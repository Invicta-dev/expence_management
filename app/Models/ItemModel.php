<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'items';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'price', 'exp_item_id', 'created_at'];

    public function get_item_breakdown($id)
    {
        $builder = $this->db->table('items');
        $builder->where('exp_item_id', $id);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
