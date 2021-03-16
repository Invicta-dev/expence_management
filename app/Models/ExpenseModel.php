<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Array_;

class ExpenseModel extends Model
{

    protected $table      = 'expense_reports';
    protected $primaryKey = 'expense_id';



    protected $allowedFields = ['user_id', 'user', 'expense', 'process', 'category', 'currency', 'payment_mode', 'amount', 'created_on'];
    public function managerRecords($id)
    {
        $builder = $this->db->table('expense_reports');
        $builder->where('user_id', $id);
        $condition = "created_on between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";
        $builder->where($condition);
        $data = $builder->get()->getResultArray();
        return $data;
    }
    public function getSearchResults($form_data)
    {
        $builder = $this->db->table('expense_reports');
        // print_r($form_data);
        if (!empty($form_data['process']) && !empty($form_data['category']) && !empty($form_data['user']) && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['process' => $form_data['process'], 'category' => $form_data['category'], 'user' => $form_data['user'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['process']) && !empty($form_data['category'])  && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['process' => $form_data['process'], 'category' => $form_data['category'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['user']) && !empty($form_data['category'])  && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['user' => $form_data['user'], 'category' => $form_data['category'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['process']) && !empty($form_data['user'])  && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['process' => $form_data['process'], 'user' => $form_data['user'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['user'])  && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['user' => $form_data['user'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['process'])  && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['process' => $form_data['process'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['category'])  && !empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['category' => $form_data['category'], 'created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['process']) && !empty($form_data['category'])  && !empty($form_data['user'])) {
            $condition = ['process' => $form_data['process'], 'category' => $form_data['category'], 'user' => $form_data['user']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['process']) && !empty($form_data['category'])) {
            $condition = ['process' => $form_data['process'], 'category' => $form_data['category']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['process']) && !empty($form_data['user'])) {
            $condition = ['process' => $form_data['process'], 'user' => $form_data['user']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['category']) && !empty($form_data['user'])) {
            $condition = ['category' => $form_data['category'], 'user' => $form_data['user']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }

        if (!empty($form_data['process'])) {
            $builder->where('process', $form_data['process']);
            $result = $builder->get()->getResultArray();
            //code to get the sum of total amount
            $builder->where('process', $form_data['process']);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['startdate']) && !empty($form_data['enddate'])) {
            $condition = ['created_on >=' => $form_data['startdate'], 'created_on <=' => $form_data['enddate']];
            $builder->where($condition);
            $result = $builder->get()->getResultArray();
            //code to get the sum of total amount
            $builder->where($condition);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['user'])) {
            $builder->where('user', $form_data['user']);
            $result = $builder->get()->getResultArray();
            //code to get the sum of total amount
            $builder->where('user', $form_data['user']);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }
        if (!empty($form_data['category'])) {
            $builder->where('category', $form_data['category']);
            $result = $builder->get()->getResultArray();
            //code to get the sum of total amount
            $builder->where('category', $form_data['category']);
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        } else {
            $result = $builder->get()->getResultArray();
            $builder->selectSum('amount');
            $total = $builder->get()->getRowArray();
            array_push($result, $total);
            return $result;
        }

        // $total = array("Final_amount" => 1000);
        // array_push($result, $total);
        // echo "<pre>";
        // print_r($result);
        // echo "<pre>";
        // exit;


    }

    public function latestentry()
    {
        $builder = $this->db->table('expense_reports');
        $builder->select('expense_id');
        $builder->orderBy('expense_id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRowArray();
        if (count($query) == 1) {
            return $query;
        } else {
            return false;
        }
    }
    public function getAllExpenses()
    {
        $builder = $this->db->table('expense_reports');
        $builder->select(['expense_img_id', 'bill_img']);
        $builder->join('expense_bill_image', 'expense_bill_image.expense_img_id = expense_reports.expense_id');
        $query = $builder->get()->getResultArray();
        return $query;
    }
    public function getMonthCounter()
    {

        $builder = $this->db->table('expense_reports');
        $builder->selectSum('amount');
        $where = "created_on between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";
        $builder->where($where);
        $query = $builder->get()->getRowArray();
        return $query;
    }
    public function getDayCounter()
    {
        $builder = $this->db->table('expense_reports');
        $builder->selectSum('amount');
        //expense total day wise
        $builder->where('created_on', 'CURDATE()', FALSE);
        $query = $builder->get()->getRowArray();
        return $query;
    }
    public function totalExpenseCount()
    {
        $builder = $this->db->table('expense_reports');
        $where = "created_on between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";
        $builder->where($where);
        $builder->selectSum('amount');
        $query = $builder->get()->getRowArray();
        return $query;
    }
    public function getWeekCounter()
    {
        $builder = $this->db->table('expense_reports');
        $builder->selectSum('amount');
        //  expense total weekly wise
        // $where = "created_on > DATE_SUB(NOW(), INTERVAL 7 DAY )";
        $where = "YEARWEEK(`created_on`, 1) = YEARWEEK(CURDATE(), 1)";
        $builder->where($where);
        $query = $builder->get()->getRowArray();
        return $query;
    }
}
