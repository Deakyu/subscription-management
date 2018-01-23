<?php 

    class SubscriptionController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->subscriptionModel = $this->model('Subscription');
            $this->userModel = $this->model('User');
        }

        public function index() {
            $subscriptions = $this->subscriptionModel->all();
            $cards = $this->userModel->cards($_SESSION['user_id']);
            $data = compact('subscriptions', 'cards');

            $this->view('subscriptions/index', $data);
        }

        public function show($id) {
            
        }

    }