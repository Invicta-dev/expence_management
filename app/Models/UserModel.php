<?php

namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
{

    protected $table      = 'users';
    protected $primaryKey = 'id';



    protected $allowedFields = ['username', 'password', 'fullname', 'email', 'designation', 'uuid', 'updated_at'];
    public function verifyEmail($email)
    {
        $builder = $this->db->table('users');
        $builder->select("uuid,designation,username");
        $builder->where("email", $email);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
    public function updatedTime($uniid)
    {
        $builder = $this->db->table('users');
        $builder->where('uuid', $uniid);

        if ($builder->update(['updated_at' => date('Y-m-d h:i:s')])) {
            return true;
        } else {
            return false;
        }
    }
    public function verifyToken($token = null)

    {
        $builder = $this->db->table('users');
        $builder->select("username,uuid,email,updated_at");
        $builder->where('uuid', $token);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
    //Reset password
    public function insertData($data = null)
    {
        $builder = $this->db->table('users');
        $builder->where('uuid', $data['token']);
        if ($builder->update(['password' => $data['password']])) {
            return true;
        } else {
            return false;
        }
    }
    public function remove($id)
    {
        $builder = $this->db->table('users');
        $builder->where('id', $id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUser($username)
    {
        $builder = $this->db->table('users');
        $builder->where('username', $username);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
}
