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

    }