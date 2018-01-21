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

                $data = ['error' => $error, 'data' => $data];

                $errorExists ? returnJson($data, 503) : returnJson($data);
            }
        }

    }