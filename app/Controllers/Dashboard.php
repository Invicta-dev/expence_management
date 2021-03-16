<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\ProcessModel;
use App\Models\ExpenseModel;
use App\Model\ExpenseImageModel;
use App\Models\ExpenseImageModel as ModelsExpenseImageModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ItemModel;
use App\Models\VendorModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $category;
    protected $process;
    protected $expense;
    protected $expenseImage;
    protected $itemModel;
    protected $vendorModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->category = new CategoriesModel();
        $this->process = new ProcessModel();
        $this->expense = new ExpenseModel();
        $this->expenseImage = new ModelsExpenseImageModel();
        $this->itemModel = new ItemModel();
        $this->vendorModel = new VendorModel();
        helper('form', 'url');
    }

    public function index($data = null)
    {
        $data = [];

        if (session()->has('logged_user')) :
            $result = $this->userModel->getUser(session()->get('logged_user'));
            $data['categories'] = $this->category->findAll();
            $data['processes'] = $this->process->findAll();
            session()->set('role', $result['designation']);
            if ($result['designation'] == 'Manager') {
                $data['expense'] = $this->expense->managerRecords($result['id']);
                $data['expense_img'] = $this->expense->getAllExpenses();
            } else { //if admin
                $where = "created_on between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";
                $data['expense'] = $this->expense->where($where)->orderBy('created_on', 'desc')->findAll();
                // echo "<pre>";
                // print_r($data);
                // echo "<pre>";
                // exit;
                $data['expense_img'] = $this->expense->getAllExpenses();
                //gets username for dropdown 
                $data['users'] = $this->userModel->findAll();
            }
            //queriers for counter in dashboard
            $day_count = $this->expense->getDayCounter();
            $data['day_expense_count'] = $day_count['amount'];

            $weekly_count = $this->expense->getWeekCounter();
            $data['weekly_expense'] = $weekly_count['amount'];

            $month_count = $this->expense->getMonthCounter();
            $data['month_expense_count'] = $month_count['amount'];

            $total = $this->expense->totalExpenseCount();
            $data['total_expense_count'] = $total['amount'];
            //queriers for counter in dashboard ends



            return view('Dashboard/dashboard', $data);


        else :
            return redirect()->to(base_url() . '/login');
        endif;
    }
    public function logout()
    {
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to(base_url() . '/login');
    }
    //fuctions related to user registration
    public function user()
    {


        $data['user'] = $this->userModel->findAll();
        // print_r($data);
        return view('Dashboard/user', $data);
    }
    public function addUser()
    {
        $view_data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required|alpha_numeric',
                    'errors' => [
                        'required' => 'Usename field is required',
                        'alpha_numeric' => 'Invalid Username Entered'
                    ]
                ],
                'fullname' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Fullname field is required',
                        'alpha_space' => 'Invalid Fullname Entered'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Fullname field is required',
                        'min_length' => 'Password should be minimum 8 characters'
                    ]
                ],
                'confirm_password' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Confirm Password field is required',
                        'matches' => 'Confirm password mismatched',

                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'User Role field is required'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email field is required',
                        'valid_email' => 'Please enter a valid email'

                    ]
                ]

            ];
            if ($this->validate($rules)) {
                $pwd = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                $confirm_pwd = $this->request->getVar('password');
                $uniid = md5(str_shuffle('affjfukjbcdetyiolkrlpqrstuvwxyz' . time()));
                $data = [
                    'username' => $this->request->getVar('username'),
                    'fullname' => $this->request->getVar('fullname'),
                    'password' => $pwd,
                    'designation' => $this->request->getVar('role'),
                    'uuid' => $uniid,
                    'email' => $this->request->getVar('email')
                ];



                $if_exist = $this->userModel->where('username', $this->request->getVar('username'))->first();

                if (!empty($if_exist)) {
                    // echo "user already exist";
                    return redirect()->back()->with('exist', 'user already exist');
                } else {
                    $this->userModel->insert($data);
                    return redirect()->to(base_url() . '/user');
                }
            } //end if validation if statement
            else {
                $view_data['validation'] = $this->validator;
                return view('Dashboard/add_user', $view_data);
            }
        } else {

            return view('Dashboard/add_user');
        }
    }
    public function deleteUser()
    {
        $user_id = $this->request->uri->getSegment(2);
        $this->userModel->remove($user_id);
        echo json_encode(array("status" => TRUE));
    }
    public function editUser()
    {
        if ($this->request->getMethod('post')) {
            $id = $this->request->getVar('id');
            $updated_data = array(
                'username' => $this->request->getVar('name'),
                'fullname' => $this->request->getVar('fullname'),
                'email' => $this->request->getVar('email'),
                'designation' => $this->request->getVar('role')
            );
            if ($this->userModel->update($id, $updated_data)) {
                echo json_encode(array("status" => TRUE));
            }
        }
    }
    //functions related to category
    public function categories()
    {
        $table_data = [];
        if ($this->request->getMethod() == 'post') {

            $already_exist = $this->category->where('category_name', $this->request->getVar('category'))->first();
            if (!empty($already_exist)) {
                $table_data['error'] = "Category already exist";
            } else {
                $data = ['category_name' => ucfirst($this->request->getVar('category'))];
                $this->category->insert($data);
                $table_data['success'] = "Category Added Successfully";
            }
        }
        $table_data['categories'] = $this->category->findAll();

        return  view('Dashboard/category', $table_data);
    }
    public function deleteCategory($id)
    {

        $this->category->delete($id);
        echo json_encode(array("status" => TRUE));
    }
    //functions related to process
    public function getProcess()
    {
        $table_data['processes'] = $this->process->findAll();

        return view('Dashboard/process', $table_data);
    }
    public function add_process()
    {
        $table_data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = array(
                'process' => [
                    'rules' => 'required|alpha_space',
                    'errors' =>
                    [
                        'alpha_space' => "Invalid Process name"
                    ]
                ]

            );
            if ($this->validate($rules)) {

                $already_exist = $this->process->where('process_name', $this->request->getVar('process'))->first();
                if (!empty($already_exist)) {
                    session()->setFlashdata('error', 'process already exist');
                } else {
                    $data = ['process_name' => ucfirst($this->request->getVar('process'))];
                    $this->process->insert($data);
                    session()->setFlashdata('success', 'Category Added Successfully');
                }
            } else {
                // $table_data['validation'] = $this->validator;
                return redirect()->back()->with('validation', $this->validator);
            }
        }
        return redirect()->to(base_url() . '/process');
    }
    public function deleteProcess($id = null)
    {
        $this->process->delete($id);
        echo json_encode(array("status" => TRUE));
        session()->setFlashdata('success', "Process deleted successfully");
    }

    public function addExpense()
    {
        $data = [];
        $form_data = [];
        $data['processes'] = $this->process->findAll();
        $data['categories'] = $this->category->findAll();
        $image = array();
        $arr = array();

        if ($this->request->getMethod() == 'post') {
            // echo "<pre>";
            // print_r($this->request->getFiles());
            // echo "<pre>";


            $files = $this->request->getFiles();
            //     $rules = ['billDetails' => 'uploaded[billDetails.0]|max_size[billDetails,12024]|ext_in[billDetails,png,jpg,pdf]',

            // ];


            if ($files['BillDetails'][0] == '') {
                $rules = array(
                    // 'BillDetails' => 'uploaded[BillDetails.0]|max_size[BillDetails,1024]|ext_in[BillDetails,png,jpg,pdf,doc]',

                    'ExpenseName' => [
                        'rules' => 'required',
                        'errors' =>
                        [
                            'required' => "Expense name required"
                        ]
                    ],
                    'amount' => 'required'
                );
            } else {


                $rules = array(
                    'BillDetails' => 'uploaded[BillDetails.0]|ext_in[BillDetails,png,jpg,pdf]',
                    'ExpenseName' => [
                        'rules' => 'required',
                        'errors' =>
                        [
                            'required' => "Expense name required"
                        ]
                    ],
                    'amount' => 'required'

                );
            }

            if ($this->validate($rules)) {
                foreach ($files['BillDetails'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        if ($img->move(FCPATH . 'assets\pages\upload')) {
                            // echo "<p>" . $img->getName() . "is moved successfully";
                            $image[] = $img->getName();
                        } else {
                            // echo "<p>" . $img->getErrorString() . "</p>";
                        }
                    }
                }
                //get's user id of the user who enters the expense
                $user_id = $this->userModel->getUser(session()->get('logged_user'));

                //form data
                $form_data = [
                    'expense' => $this->request->getVar('ExpenseName'),
                    'process' => $this->request->getVar('process'),
                    'category' => $this->request->getVar('category'),
                    'currency' => $this->request->getVar('currency'),
                    'amount' => $this->request->getVar('amount'),
                    'user_id' => $user_id['id'],
                    'payment_mode' => $this->request->getVar('paymentMode'),
                    'user' => $user_id['username'],
                    'created_on' => date('Y-m-d'),

                ];
                // print_r($form_data);


                if ($this->expense->insert($form_data)) {
                    //to get the expense id of latest expense to link with bill images
                    $get_expence_id = $this->expense->latestentry();
                    $count = sizeof($image);
                    // echo  $image[0];
                    // print_r($image);
                    foreach ($image as $image_name) {
                        // echo '<pre>';
                        // echo $image_name;
                        $this->expenseImage->insert(['expense_img_id' => $get_expence_id, 'bill_img' => $image_name]);
                    }
                    if (!empty($this->request->getVar('name')) && !empty($this->request->getVar('price'))) {
                        $result = array_combine($this->request->getVar('name'), $this->request->getVar('price'));

                        foreach ($result as $item => $price) :

                            $arr[] =
                                [
                                    'name' => $item,
                                    'price' => $price,
                                    'exp_item_id' => $get_expence_id
                                ];
                        endforeach;
                        // print_r($arr);
                        $this->itemModel->insertBatch($arr);
                    }

                    return redirect()->back()->with('foo', "data submitted successfully");
                }
            } else {

                $data['validation'] = $this->validator;
                return view('Dashboard/add_expense', $data);
            }
        }
        return view('Dashboard/add_expense', $data);
    }
    public function delete_expense()
    {
        $expense_id = $this->request->uri->getSegment(2);
        $get_img = $this->expenseImage->find_img_name_toDelete($expense_id);

        foreach ($get_img as $img) {
            unlink(FCPATH . "assets\pages\upload/" . $img['bill_img']);
        }

        $this->expense->delete($expense_id);
        echo json_encode(array("status" => TRUE));
    }
    public function getAjax()
    {
        $table_data['process'] = $this->process->findAll();
        $table_data['category'] = $this->category->findAll();

        echo json_encode($table_data);
    }
    public function getExpenseByFilters()

    {
        if ($this->request->getMethod() == 'post') {

            $data = [];
            if (session()->get('role') == 'Manager') {
                $data = [
                    'user' => session()->get('logged_user'),
                    'process' => $this->request->getVar('process'),
                    'category' => $this->request->getVar('category'),
                    'enddate' => $this->request->getVar('to'),
                    'startdate' => $this->request->getVar('from')
                ];
            } else {
                $data = [
                    'user' => $this->request->getVar('user'),
                    'process' => $this->request->getVar('process'),
                    'category' => $this->request->getVar('category'),
                    'enddate' => $this->request->getVar('to'),
                    'startdate' => $this->request->getVar('from')
                ];
            }
            session()->setFlashData('billImage', $this->expense->getAllExpenses());
            session()->setFlashData('Filterdata', $this->expense->getSearchResults($data));



            return redirect()->to(base_url() . '/dashboard');
        }
    }
    public function editExpense()
    {
        $images = [];
        $files = $this->request->getFiles();
        $expense_id = $this->request->getVar('unid');

        foreach ($files as $img) {
            if ($img->isValid() && !$img->hasMoved()) {
                if ($img->move(FCPATH . 'assets\pages\upload')) {
                    // echo "<p>" . $img->getName() . "is moved successfully";
                    $image[] = $img->getName();
                } else {
                    // echo "<p>" . $img->getErrorString() . "</p>";
                }
            }
            $images[] = $img->getName();
        }
        if (!empty($images)) {
            $this->expenseImage->where('expense_img_id', $expense_id)->delete();
            // if ($this->expenseImage->where('expense_img_id', $expense_id)->delete()) {
            //     echo "deleted successfully";
            // }
        }
        // echo '<pre>';
        // print_r($files);
        // echo '<pre>';
        foreach ($images as $image_name) {
            $this->expenseImage->insert(['expense_img_id' => $expense_id, 'bill_img' => $image_name]);
        }

        $data = [
            'expense' => $this->request->getVar('expense'),
            'category'    => $this->request->getVar('category'),
            'process' => $this->request->getVar('process'),
            'amount' => $this->request->getVar('amount'),
            'currency' => $this->request->getVar('currency'),
            'payment_mode' => $this->request->getVar('payment_mode')
        ];
        $this->expense->update($expense_id, $data);
        echo json_encode(array("status" => TRUE));
    }
    public function get_add_vendor()
    {
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'vendorName' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'vendor name field is required',
                        'alpha_space' => 'Invalid Vendor name Entered'
                    ]
                ],
                'contactName' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Contact name field is required',
                        'alpha_space' => 'Invalid Contact name entered'
                    ]
                ],
                'phoneNo' => [
                    'rules' => 'required|min_length[10]|max_length[10]',
                    'errors' => [
                        'required' => 'Phone number field is required',
                        'min_length' => 'Phone number should not be less then 10 digits',
                        'max_length' => 'Phone number should not be more then 10 digits'
                    ]
                ],
                'gstNo' => [
                    'rules' => 'required|alpha_numeric_space',
                    'errors' => [
                        'required' => 'GST number is required',
                        'alpha_numeric_space' => 'Invalid GST number entered'
                    ]
                ],
                'location' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Location field is required',
                        'alpha_space' => 'Invalid location entered'
                    ]
                ]
            ];
            if ($this->validate($rules)) {
                $form_data = [
                    'vendor_name' => $this->request->getVar('vendorName'),
                    'contact' => $this->request->getVar('contactName'),
                    'phone' => $this->request->getVar('phoneNo'),
                    'gst_no' => $this->request->getVar('gstNo'),
                    'location' => $this->request->getVar('location')
                ];
                $this->vendorModel->insert($form_data);
                echo "validation successful"; //ajax response
            } else {

                $validation = $this->validator;

                echo $validation->listErrors(); //ajax response
            }
        } else {
            $data['vendors'] = $this->vendorModel->findAll();
            return view('Dashboard/vendor', $data);
        }
    }
    public function deleteVendor()
    {
        $vendorId = $this->request->uri->getSegment(2);
        $this->vendorModel->delete($vendorId);
        echo json_encode(array("status" => TRUE));
    }
    public function searchVendorList()
    {
        $query = $this->request->getVar('query');
        $getResult = $this->vendorModel->getVendorName($query);
        $output = '<ul class="list-group">';
        // print_r($getResult);
        if (!empty($getResult)) {
            foreach ($getResult as $row) {
                $output .= '<li class="list-group-item ">' . $row['vendor_name'] . '</li>';
            }
        }
        $output .= '</ul>';
        echo $output;
    }

    public function item_breakdown()
    {
        if ($this->request->getMethod() == 'post') {
            $itemId = $this->request->getVar('item_id');
            $resultItems = $this->itemModel->get_item_breakdown($itemId);
            if (!empty($resultItems)) {
                $output = ' <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="background-color: #E5FFCC;">Item name</th>
                                                    <th style="background-color: #E5FFCC;">Price</th>
                                                </tr>';
                foreach ($resultItems as $items) {
                    $output .=
                        '<tr>
                    <td>' . $items['name'] . '</td>
                    <td>' . $items['price'] . '</td>
                </tr>';
                }
                $output .= "   </tbody>
                </table>";

                echo $output;
            } else {
                $output = ' <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th> No item found </th>
                    </tr>';
                echo $output;
            }
        } else {
            return false;
        }
    }
}
