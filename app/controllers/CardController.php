<?php 

    class CardController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->cardModel = $this->model('Card');
        }

        public function index() {
            $cards = $this->cardModel->where(['user_id'], ['='], [$_SESSION['user_id']]);
            foreach($cards as &$card) {
                $card->company = getCardImage($card->company);
            }
            unset($card);
            $this->view('cards/index', $cards);
        }

        public function show($id) {
            $card = $this->cardModel->where(['id'], ['='], [$id]);
            returnJson($card);
        }

        public function delete() {
            $id = requestData()['id'];
            if($this->cardModel->delete($id)) {
                returnJson($id);
            } else {
                returnJson($id,503);
            }
        }

        public function update() {
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
                    $data = compact('error', 'data', 'errorExists', 'message');
                    returnJson($data);
                } else {
                    $message = "{$data['card_name']} is updated!";
                    $data = compact('error', 'data', 'errorExists', 'message');
                    if($this->cardModel->update($data['data'])) {
                        returnJson($data);
                    } else {
                        returnJson($data,503);
                    }
                }
            }
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
                    $data = compact('error', 'data', 'errorExists', 'message');
                    returnJson($data);
                } else {
                    $message = "{$data['card_name']} is added to your card list!";
                    $data = compact('error', 'data', 'errorExists', 'message');
                    
                    if($this->cardModel->save($data['data'])) {
                        returnJson($data);
                    } else {
                        returnJson($data,503);
                    }
                }


                // $errorExists ? returnJson($data, 503) : returnJson($data);
            }
        }

    }