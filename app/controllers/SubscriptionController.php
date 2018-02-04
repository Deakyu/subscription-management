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

        public function show($id) {
            $subscription = $this->subscriptionModel->where(['id'], ['='], [$id]);
            // Due Manipulation
            $due = Carbon::parse($subscription[0]->due);
            $subscription[0]->due = implode([$due->month, $due->day, substr($due->year, 2, 2)], '-');
            switch ($subscription[0]->period) {
                case 'w':
                    $next_due = $due->addWeek();
                    break;
                case 'm':
                    $next_due = $due->addMonth();
                    break;
                case 'y':
                    $next_due = $due->addYear();
                    break;
                default:
                    $next_due = $due;
                    break;
            }
            $subscription[0]->next_due = implode([$next_due->month, $next_due->day, substr($next_due->year, 2, 2)], '-');
            returnJson($subscription);
        }

        public function update() {
            $error = [];
            if(isset($_POST)) {
                $data = $_POST;
                if(isset($_FILES['logo'])) {
                    $fileOrError = saveFile($_FILES['logo'], '/images/');
                    $data['logo'] = $fileOrError;
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
                    $message = "{$data['name']} is added to your subscription list!";
                    $data['due'] = convertDateFromClient($data['due'], $data['time'], $data['timezone']);
                    $data = compact('error', 'data', 'errorExists', 'message');
                    
                    if($this->subscriptionModel->update($data['data'])) {
                        returnJson($data);
                    } else {
                        returnJson($data,503);
                    }
                }
            }
        }

        public function delete() {
            $id = requestData()['id'];
            if($this->subscriptionModel->delete($id)) {
                returnJson($id);
            } else {
                returnJson($id, 503);
            }
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

    }