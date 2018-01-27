<?php 

    use Carbon\Carbon;

    class SubscriptionController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->subscriptionModel = $this->model('Subscription');
            $this->userModel = $this->model('User');
        }

        public function index() {
            $this->AuthMiddleware();
            $subscriptions = $this->subscriptionModel->byPeriod();
            $cards = $this->userModel->cards($_SESSION['user_id']);
            $data = compact('subscriptions', 'cards');

            $this->view('subscriptions/index', $data);
        }

        public function save() {
            $error = [];
            if(isset($_POST)) {
                $data = $_POST;
                if(isset($_FILES['logo'])) {
                    $fileOrError = saveFile($_FILES['logo'], '/images/');
                    $data['logo'] = $fileOrError;
                } else {
                    $data['logo'] = '/images/placeholder_small.png';
                }
                // Validate empty inputs
                foreach($data as $key=>$value) {
                    $error[$key] = empty($value) ? "$key is required" : '';
                }
                $errorExists = false;
                foreach($error as $err=>$value) {
                    if(!empty($value)) $errorExists = true;
                }

                if($errorExists) {
                    $message = '';
                    $data = compact('error', 'data', 'errorExists', 'message');
                    returnJson($data);
                } else {
                    $message = "{$data['subscription_name']} is added to your subscription list!";
                    $data['due'] = convertDateFromClient($data['due'], $data['time'], $data['timezone']);
                    $data = compact('error', 'data', 'errorExists', 'message');
                    
                    if($this->subscriptionModel->save($data['data'])) {
                        returnJson($data);
                    } else {
                        returnJson($data,503);
                    }
                }
            }
        }

        public function show($id) {
            
        }

    }