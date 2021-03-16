<?php

namespace App\Models;

use CodeIgniter\Model;


class ExpenseImageModel extends Model
{

    protected $table      = 'expense_bill_image';
    protected $primaryKey = 'id';



    protected $allowedFields = ['expense_img_id', 'bill_img'];

    public function find_img_name_toDelete($id)
    {
        $builder = $this->db->table('expense_bill_image');
        $builder->select('bill_img');
        $builder->where('expense_img_id', $id);
        $result = $builder->get()->getResultArray();

        return $result;
    }
}
