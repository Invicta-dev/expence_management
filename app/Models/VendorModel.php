<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table      = 'vendors';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'vendor_name', 'contact', 'phone', 'gst_no', 'location'];
    public function getVendorName($match)
    {

        $builder = $this->db->table('vendors');
        $builder->select('vendor_name');
        $builder->like('vendor_name', $match, 'both'); // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
        $query = $builder->get()->getResultArray();
        // foreach ($query->getResult() as $row) {
        //     echo $row->vendor_name;
        // }
        return $query;
    }
}
