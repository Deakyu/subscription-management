<?php 

    class UserController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->userModel = $this->model('User');
        }

        public function index() {
            
        }

        // Param Example
        public function show($id) {
            // $this->view('/users/register', ['id'=>$id]);
        }

        // Get request for register
        public function register() {
            // Init Data
            $data = [
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
            ];

            // Load view
            $this->view('users/register', $data);
        }

        // Post request for register
        public function signup() {
            // validate empty inputs and spit out data and/or errors
            $response = $this->validate($_POST);
                
            if($response->validated) {
                if($this->userModel->userExists($response->data['email'])) {
                    $response->data['email_err'] = 'Email taken by someone else!';
                    $this->view('users/register', $response->data);
                } else {
                    if($response->data['password'] != $response->data['confirm_password']) {
                        $response->data['confirm_password_err'] = "Passwords Don't Match!";
                        $this->view('users/register', $response->data);
                    } else {
                        $response->data['password'] = password_hash($response->data['password'], PASSWORD_DEFAULT);

                        if($this->userModel->register($response->data)) {
                            flash('register_success', 'Registered!');
                            redirect('user/login');
                        } else {
                            die('Error registering..');
                        }
                    }
                }
            } else {
                $this->view('users/register', $response->data);
            }
        }

        // Get request for login form
        public function login() {
            $data = [
                'email'=>'',
                'password'=>'',
                'email_err'=>'',
                'password_err'=>'',
            ];

            // Load view
            $this->view('users/login', $data);
            return true;
        }

        // Post request for login form
        public function signin() {
            $response = $this->validate($_POST);
            if($response->validated) {
                if($this->userModel->userExists($response->data['email'])) {
                    // User found
                    if($loggedUser = $this->userModel->login($response->data['email'], $response->data['password'])) {
                        // Create session
                        $this->createUserSession($loggedUser);
                    } else {
                        $response->data['password_err'] = 'Incorrect credentials, please try again';
                        $this->view('users/login', $response->data);
                    }

                } else {
                    $response->data['email_err'] = "Email doesn't exist";
                    $this->view('users/login', $response->data);
                }
            } else {
                $this->view('users/login', $response->data);
            }
        }

        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            flash('login_success', "Welcome, {$_SESSION['user_name']}!");
            redirect('subscriptions');
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('user/login');
        }

        public function isLoggedIn() {
            return isset($_SESSION['user_id']) ? true : false;
        }
    }