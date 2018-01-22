<?php 

    class Card extends Model{

        protected $hidden = [];

        public function __construct() {
            parent::__construct();
        }

        public function save($data) {
            $this->db->query("INSERT INTO cards (card_name, company, last_digits, expire) VALUES (?, ?, ?, ?)");
            $this->db->bind("ssss", [
                $data['card_name'],
                $data['company'],
                $data['last_digit'],
                $data['expire']
            ]);
            if($this->db->execute()) {
                return true;
            }
            return false;
        }

    }