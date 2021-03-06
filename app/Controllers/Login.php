<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        helper('form');
    }
    public function index()
    {
        return view('signin');
    }

    //--------------------------------------------------------------------
    //checks user entered username and psw in login form is valid or not
    public function check()
    {
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getvar('username');
            $password = $this->request->getvar('password');
            $remember = $this->request->getVar('remember');
            $data = ['username' => $username];
            // $userModel = new UserModel();
            $user = $this->userModel->where($data)->first();

            if (!empty($user) && password_verify($password, $user['password'])) {
                // echo 'Password is valid!';

                // $agent = $this->request->getUserAgent();

                // $activity = new UserActivityModel();
                // if ($agent->isBrowser()) {
                //     $log_data = [
                //         'username' => $username,
                //         'browser' => $agent->getBrowser(),
                //         'version' => $agent->getVersion(),
                //         'date' => date("Y-m-d")
                //     ];
                // }
                // $activity->insert($log_data);
                if ($remember == 1) {
                    helper('cookie');
                    set_cookie('cookie_user', $username, '3600');
                    set_cookie('cookie_psw', $password, '3600');
                    set_cookie('cookie_remember', 'yes', '3600');
                }
                session()->set('logged_user', $username);
                $obj = new Dashboard();
                return  $obj->index($data);
            } else {
                // echo 'Invalid password.';
                return redirect()->to(base_url() . '/login');
            }
        }
    }

    public function createUser()
    {
        if ($this->request->getMethod() == 'post') {
            $pwd = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $confirm_pwd = $this->request->getVar('password');
            $uniid = md5(str_shuffle('affjfukjbcdetyiolkrlpqrstuvwxyz' . time()));
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => $pwd,
                'designation' => 'admin',
                'uuid' => $uniid,
                'email' => $this->request->getVar('username') . '@gmail.com'
            ];

            $userModel = new UserModel();

            $if_exist = $userModel->where('username', $this->request->getVar('username'))->first();

            if (!empty($if_exist)) {
                echo "user already exist";
            } else {
                $userModel->insert($data);
                echo "data inserted successfully";
            }
        }
    }
    public function forgotPassword()
    {
        if ($this->request->getMethod() == "post") {
            $userModel = new UserModel();
            $email = $this->request->getVar('email');
            $userdata = $userModel->verifyEmail($email);
            date_default_timezone_set('Asia/Kolkata');
            if (!empty($userdata)) {
                if ($userModel->updatedTime($userdata['uuid'])) {
                    $token = $userdata['uuid'];
                    echo '<a href="' . base_url() . '/reset_password/' . $token . '">Reset password link </a>';
                }
            } else {
                session()->setFlashdata('error', 'Sorry! Email does not exist try again');
                return redirect()->to(base_url() . '/forget-password');
            }
        } else {
            return view('forgot');
        }
    }
    public function reset_password()
    {
        $data = [];
        $userModel = new UserModel();
        $parameter = $this->request->uri->getSegment(2);
        $valid_token = $userModel->verifyToken($parameter);
        $data['token'] = $parameter;

        if (!empty($valid_token)) {
            // print_r($valid_token);

            if ($this->checkExpiryDate($valid_token['updated_at'])) {
                // echo "reset password link is valid";
            } else {
                $data['error'] = "Reset password link has expired";
            }
        } else {
            $data['error'] = "Sorry! User not found";
        }

        // echo  $this->request->uri->getSegment(2);
        return view('change_psw', $data);
    }
    //check for token expiry
    public function checkExpiryDate($update_time)
    {

        date_default_timezone_set('Asia/Kolkata');
        $updated_time = strtotime($update_time);
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $timeDiff = $current_time - $updated_time;
        if ($timeDiff < 900) {
            return true;
        } else {
            return false;
        }
    }
    public function change_pwd()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            //check for validation error
            $rules = [
                'password' => 'required',

                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Invalid email id'
                    ]
                ],
                'confirm' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'matches' => 'Confirm password mismatch'
                    ]
                ]
            ];
            if ($this->validate($rules)) {
                $userdata = $this->userModel->verifyToken($this->request->getVar('token'));
                if (!empty($userdata)) {
                    if ($userdata['email'] == $this->request->getVar('email')) {
                        // print_r($userdata);
                        $pwd = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                        $form_data = [
                            'token' => $this->request->getVar('token'),
                            'password' => $pwd,
                            'email' => $this->request->getVar('email')
                        ];

                        if ($this->userModel->insertData($form_data)) {
                            // echo "password updated";
                            session()->setFlashdata('success', 'Password updated Successfully');
                            return redirect()->to(base_url() . '/login');
                        } else {
                            echo "password update failed";
                        }
                    } else {
                        // $data['error'] = "Invalid!Email id";
                        echo "Invalid!Email id";
                    }
                } else {
                    $data['error'] = 'Sorry! Token expired';
                }
            } else {
                session()->setFlashdata('validation', $this->validator);
                return redirect()->to(base_url() . '/reset_password/' . $this->request->getVar('token'));
                // return view('change_psw', $data);
            }
        }
    }
}
