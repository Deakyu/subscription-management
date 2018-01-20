<?php 

    class SubscriptionController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->subscriptionModel = $this->model('Subscription');
        }

        public function index() {
            $this->view('subscriptions/index');
        }

        public function show($id) {
            
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

    }