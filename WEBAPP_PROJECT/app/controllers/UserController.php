<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->user_model->searchUser($this->session->userdata('userId'));
        define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
    }

    public function baseHome() {
        $data['userName'] = $this->session->userdata('userName');
        $data['userEmail'] = $this->session->userdata('userEmail');
        $data['role'] = 'NOLOGIN';
        $data['userImage'] = $this->session->userdata('userImage');
        $data['products'] = $this->product_model->getProducts();
        $data['message'] = array();
        $data['cart'] = array();
        $data['filteredcart'] = array();
        $this->session->set_userdata('prevUrl', $_SERVER['REQUEST_URI']);
        $this->call->view('home',$data);
    }

    // BASE LOGIN REGISTER AUTHENTICATION
    public function login() {
        if(!$this->session->userdata('isLoggedIn')){
            $prompt['success'] = $this->session->flashdata('registered');
            $prompt['fail'] = $this->session->flashdata('fail');
            $this->session->set_userdata('prevUrl', $_SERVER['REQUEST_URI']);
            $this->call->view('login',$prompt);
        } else {
            redirect('/home');
        }
    }
    public function home() {
        if($this->session->userdata('isLoggedIn')){
            $userId = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');
            $data['userEmail'] = $this->session->userdata('userEmail');
            $data['role'] = $this->session->userdata('role');
            $data['userImage'] = $this->session->userdata('userImage');
            $data['products'] = $this->product_model->getProducts();
            $data['message'] = $this->session->flashdata('message');
            $data['cart'] = $this->cart_model->getCart($userId);
            $data['filteredcart'] = $this->cart_model->getFilteredCart($userId);
            $this->session->set_userdata('prevUrl', $_SERVER['REQUEST_URI']);
            $this->call->view('home',$data);
        } else {
            $this->session->set_flashdata('fail','Login First!');
            redirect('/login');
        }
    }

    public function register() {
        if($this->session->userdata('isLoggedIn')){
            redirect('/home');
        } else {
            $this->call->view('register');
        }
    }

    public function logout() {
        $sesData = array('userName','isLoggedIn','userId','userImage','userEmail','role');
        $this->session->unset_userdata($sesData);
        $this->session->set_flashdata('registered' , 'Successfully Logged Out!');
        redirect('/login');
    }

    public function auth() {
        $username = $this->io->post('username');
        $password = $this->io->post('password');
    
        $user = $this->user_model->getUserByUsername($username);
        if($user != null){
            if($user['status'] == 'UP'){
                if ($user && password_verify($password, $user['password'])) {
                    $sesData = array(
                        'userId' => $user['id'],
                        'userName' => $username,
                        'userImage' => $user['image'],
                        'userEmail' => $user['email'],
                        'role' => $user['role'],
                        'status' => $user['status'],
                        'isLoggedIn' => true
                    );
                    $this->session->set_userdata($sesData);
                    $this->session->set_flashdata('message', "Logged In Successfully!");
                    redirect('/home');
                } else {
                    $this->session->set_flashdata('fail', "Username or Password not found!");
                    redirect('/login');
                }
            } else {
                $this->session->set_flashdata('fail', "Your account is down. Contact an Administrator!");
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('fail', "Username or password does not exist!");
            redirect('/login');
        }
    }
    
    public function createaccount() {
        $username = $this->io->post('username');
        $password = password_hash($this->io->post('password'), PASSWORD_DEFAULT);
        $key = $this->io->post('secretkey');

        $role = ($key == "ADMINISTRATOR") ? 'ADMIN' : (($key == "SALESCLERK") ? 'CLERK' : 'USER');

        $data = array(
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'status' => 'DOWN'
        );
        $this->user_model->addUser($data);
        $this->session->set_flashdata('registered','New User Added');
        redirect('/login');
    }

    public function profileEdit($id) {
        if (!empty($this->user['image'])) {
            $localFilePath = FCPATH . '..\\..\\public\\uploads\\users\\' . $this->user['image'];
            if (file_exists($localFilePath)) {
                if (unlink($localFilePath)) {
                    $this->updateUserFields($id);
                } else {
                    $this->session->set_flashdata('message', 'Error deleting file! (unlink failed)');
                    redirect('/profile');
                }
            } else {
                $this->session->set_flashdata('message', 'File does not exist! (' . $localFilePath . ')');
                redirect('/profile');
            }
        } else {
            $this->updateUserFields($id);
        }
    }
     

    private function updateUserFields($id)
    {
        $this->call->library('upload', $_FILES["avatar"]);
        $this->upload
            ->set_dir('public/uploads/users')
            ->is_image();
    
        if ($this->upload->do_upload()) {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $image = $this->upload->get_filename();
            $data = array(
                'username' => $username,
                'email' => $email,
                'image' => $image
            );
            $this->user_model->updateUser($data, $id);
            $this->session->set_userdata('userName', $username);
            $this->session->set_userdata('userEmail', $email);
            $this->session->set_userdata('userImage', $image);
            $this->session->set_flashdata('message', 'Account Updated!');
            redirect('/profile');
        } else {
            $this->session->set_flashdata('message', 'Updating failed!');
            redirect('/profile');
        }
    }

    public function useraccounts() {
        if (!$this->session->userdata('isLoggedIn')) {
            $this->session->set_flashdata('fail', 'Login First!');
            redirect('/login');
        } elseif($this->session->userdata('role') == 'ADMIN' && $this->session->userdata('isLoggedIn')) {
            $userId = $this->session->userdata('userId');
    
            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');
            $data['userEmail'] = $this->session->userdata('userEmail');
            $data['role'] = $this->session->userdata('role');
            $data['status'] = $this->session->userdata('status');
            $data['userImage'] = $this->session->userdata('userImage');
            $data['users'] = $this->user_model->getUsers();
            $data['message'] = $this->session->flashdata('message');
            $data['cart'] = $this->cart_model->getCart($userId);
            $data['filteredcart'] = $this->cart_model->getFilteredCart($userId);
            $this->session->set_userdata('prevUrl', $_SERVER['REQUEST_URI']);
            $this->call->view('useraccounts', $data);
        } else {
            redirect('/');
        }
    }

    public function deleteuser($id){
        if (!$this->session->userdata('isLoggedIn')) {
            $this->session->set_flashdata('fail', 'Login First!');
            redirect('/login');
        } else {
            $this->user_model->deleteUser($id);
            $this->session->set_flashdata('message','User account deleted!');
            redirect('/useraccounts');
        }
    }

    public function toggleaccess($id){
        if (!$this->session->userdata('isLoggedIn')) {
            $this->session->set_flashdata('fail', 'Login First!');
            redirect('/login');
        } else {
            $data = $this->user_model->searchUser($id);
            if($data['status'] == 'UP'){
                $this->user_model->updateUser(['status' => 'DOWN'], $id);
                $this->session->set_flashdata('message','User account disabled!');
                redirect('/useraccounts');
            } else {
                $this->user_model->updateUser(['status' => 'UP'], $id);
                $this->session->set_flashdata('message','User account enabled!');
                redirect('/useraccounts');
            }
        }
    }

    public function profile() {
        $this->redirectTo('profile');
    }

    public function settings() {
        $this->redirectTo('settings');
    }

    public function about() {
        $this->redirectTo('about');
    }

    public function services() {
        $this->redirectTo('services');
    }

    public function contact() {
        $this->redirectTo('contact');
    }

    public function policies() {
        $this->redirectTo('policies');
    }

    public function licensing() {
        $this->redirectTo('licensing');
    }

    public function redirectTo($to)
    {
        if (!$this->session->userdata('isLoggedIn')) {
            $this->session->set_flashdata('fail', 'Login First!');
            redirect('/login');
        } else {
            $userId = $this->session->userdata('userId');

            $processingReceipts = $this->receipts_model->searchReceiptsByUser($userId);

            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');
            $data['userEmail'] = $this->session->userdata('userEmail');
            $data['role'] = $this->session->userdata('role');
            $data['status'] = $this->session->userdata('status');
            $data['userImage'] = $this->session->userdata('userImage');
            $data['products'] = $this->product_model->getProducts();
            $data['message'] = $this->session->flashdata('message');
            $data['cart'] = $this->cart_model->getCart($userId);
            $data['filteredcart'] = $this->cart_model->getFilteredCart($userId);
            $data['receipts'] = $processingReceipts;
            // echo var_dump($this->cart_model->getFilteredCart($userId));
            $this->session->set_userdata('prevUrl', $_SERVER['REQUEST_URI']);
            $this->call->view($to, $data);
        }
    }
}
?>
