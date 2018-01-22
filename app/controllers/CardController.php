<?php 

    class CardController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->cardModel = $this->model('Card');
        }

        public function index() {
            $data = [
                'card_name' => '',
                'company' => '',
                'last_digit' => '',
                'expire' => '',
            ];
            $this->view('cards/index', $data);
        }

        public function save() {
            $error = [];
            if($data = requestData()) {
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
                } else {
                    $message = "{$data['card_name']} is added to your card list!";
                    $data = compact('error', 'data', 'errorExists', 'message');
                    
                    if($this->cardModel->save($data['data'])) {
                        $data['data']['company'] = getCardImage($data['data']['company']);
                        returnJson($data);
                    } else {
                        returnJson($data,503);
                    }
                }


                // $errorExists ? returnJson($data, 503) : returnJson($data);
            }
        }

    }